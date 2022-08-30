<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->nombre = $arg['nombre'] ?? '';
        $this->apellido = $arg['apellido'] ?? '';
        $this->email = $arg['email'] ?? '';
        $this->password = $arg['password'] ?? '';
        $this->telefono = $arg['telefono'] ?? '';
        $this->admin = $arg['admin'] ?? 0;
        $this->confirmado = $arg['confirmado'] ?? 0;
        $this->token = $arg['token'] ?? '';
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$alertas['nombre'] = 'Agrege su nombre';
        }
        if (!$this->apellido) {
            self::$alertas['apellido'] = 'Agrege su apellido';
        }
        if (!$this->email) {
            self::$alertas['email'] = 'Agrege su email';
        }
        if (!$this->telefono) {
            self::$alertas['telefono'] = 'Un telefono es obligatorio';
        }else if (strlen($this->telefono) == 11 ) {
            self::$alertas['telefono'] = 'Telefono debe tener 11 digitos';
        }
        if (!$this->password) {
            self::$alertas['password'] = 'Agrege un password';
        } else if (
            strlen($this->password) < 6 ||
            !preg_match('`[a-z]`', $this->password) ||
            !preg_match('`[A-Z]`', $this->password) ||
            !preg_match('`[0-9]`', $this->password)
        ) {
            self::$alertas['password'] = 'El password debe tener min. 6 caracteres y al menos 1 letra minuscula, 1 mayuscula y 1 numero';
        }

        return self::$alertas;
    }

    public function existeUsuario()
    {
        //revisa si el usario ya existe en ls base de datos por medio del email
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        //debuguear($query);
        $resultado = self::$db->query($query);
        if ($resultado->num_rows) {
            //si hay resultado
            self::setAlerta('arriba', 'Usuario ya registrado', 'error');
        }
        return $resultado;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken()
    {
        $this->token = uniqid();
    }

    public function validarLogin()
    {
        if (!$this->email) {
            self::$alertas['email'] = 'Agrege su email';
        }
        if (!$this->password) {
            self::$alertas['password'] = 'Agrege un password';
        }
        return self::$alertas;
    }

    public function comprobarPassAndVerifi($inputPass)
    {
        if ($this->confirmado) {
            //si existe el usuario y esta confirmado comprobamos contraseña
            return password_verify($inputPass, $this->password);
        } else {
            Usuario::setAlerta('arriba', 'Falta confirmar correo, revisa tu bandeja', 'error');
        }
        return false;
    }

    public function validarEmail()
    {
        if (!$this->email) {
            self::$alertas['email'] = 'Agrege su email';
        }

        return self::$alertas;
    }

    public function validarFormatoPassword()
    {
        if (!$this->password) {
            self::$alertas['password'] = 'Agrege un password';
        } else if (
            strlen($this->password) < 6 ||
            !preg_match('`[a-z]`', $this->password) ||
            !preg_match('`[A-Z]`', $this->password) ||
            !preg_match('`[0-9]`', $this->password)
        ) {
            self::$alertas['password'] = 'El password debe tener min. 6 caracteres y al menos 1 letra minuscula, 1 mayuscula y 1 numero';
        }

        return self::$alertas;
    }
}
