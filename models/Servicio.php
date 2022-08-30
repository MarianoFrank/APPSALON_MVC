<?php

namespace Model;

class Servicio extends ActiveRecord{
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;
    
    public function __construct($arg = [])
    {
        $this->id = $arg['id'] ?? null;
        $this->nombre = $arg['nombre'] ?? '';
        $this->precio = $arg['precio'] ?? '';
    }

    public function validar()
    {
        if(!$this->nombre){
            self::$alertas['nombre'] = 'Debe agregar un nombre';
        }
        if(!$this->precio){
            self::$alertas['precio'] = 'Debe agregar un precio';
        }else if(is_numeric(!$this->precio)){
            self::$alertas['precio'] = 'Dato inválido';
        }
        
        return self::$alertas;
    }
}