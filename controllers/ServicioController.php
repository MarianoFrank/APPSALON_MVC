<?php

namespace Controller;

use Model\Servicio;
use MVC\Router;

class ServicioController
{
    public static function  index(Router $router)
    {
        session_start();
        isAdmin();

        $servicios = Servicio::all();

        $router->render('/servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function  crear(Router $router)
    {
        session_start();
        isAdmin();

        $servicio = new Servicio();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                //si todo esta bien
                $servicio->guardar();

                header('Location: /servicios');
            }
        }

        $alertas = Servicio::getAlertas();

        $router->render('/servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function  actualizar(Router $router)
    {
        session_start();
        isAdmin();

        $id = $_GET['id'];
        if (!is_numeric($id)) {
            header('Location: /servicios');
            return;
        }
        $servicio = Servicio::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                //si todo esta bien
                $servicio->guardar();

                header('Location: /servicios');
            }
        }

        $alertas = Servicio::getAlertas();

        $router->render('/servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function  eliminar()
    {
        session_start();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    }
}
