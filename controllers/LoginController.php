<?php

namespace Controller;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $auth = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->sincronizar($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                //usuario agrego email y password
                //compobrar que exista usuario
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    //primero debemos verificar si el usuario esta confirmado
                    $resultado = $usuario->comprobarPassAndVerifi($auth->password);
                    if ($resultado) {
                        //contraseña correcta 
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        //debuguear($_SESSION);
                        //redireccionamiento
                        if ($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    } else {
                        Usuario::setAlerta('arriba', 'Correo o contraseña incorrectos', 'error');
                    }
                } else {
                    Usuario::setAlerta('arriba', 'Correo o contraseña incorrectos', 'error');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'usuario' => $auth,
            'alertas' => $alertas
        ]);
    }

    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];

        header('Location: /');
    }

    public static function repass(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if (empty($alertas)) {
                $usuario = Usuario::where('email', $auth->email);

                if ($usuario && $usuario->confirmado === '1') {
                    //si esta confirmado y existe
                    $usuario->crearToken();
                    $usuario->guardar();

                    $mail = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $mail->enviarInstrucciones();

                    header('Location: /mensajeRepass');
                } else {
                    Usuario::setAlerta('arriba', 'El usuario no existe o no ha sido confirmado', 'error');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router)
    {
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        $error = false;

        if (empty($usuario)) {
            Usuario::setAlerta('arriba', 'Token no valido', 'error');
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $auth->validarFormatoPassword();

            if (empty($alertas) && !$error) {
                //si no hay alertas y el token es valido...
                $usuario->password = null;
                $usuario->password = $usuario->auth;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if ($resultado) {
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'alertas' => $alertas
        ]);
    }

    public static function crear(Router $router)
    {
        $usuario = new Usuario($_POST);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validar();

            if (empty($alertas)) {
                //si no hay alertas verificamos si no esta registrado
                $resultado = $usuario->existeUsuario();

                if (!$resultado->num_rows) {
                    //si no existe el usuario continuamos con su guardado...
                    $usuario->hashPassword();
                    //generar token unico
                    $usuario->crearToken();

                    //enviar email para verificar usuario
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    debuguear($resultado);
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //debuguear($alertas);
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    public static function confirmar(Router $router)
    {
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if (empty($usuario)) {
            Usuario::setAlerta('arriba', 'Token no valido', 'error');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('arriba', 'Usuario confirmado correctamente', 'exito');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router)
    {
        $router->render('auth/mensaje');
    }
    public static function mensajeRepass(Router $router)
    {
        $router->render('auth/mensaje-repass');
    }
}
