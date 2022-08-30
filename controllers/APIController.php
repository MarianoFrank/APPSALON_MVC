<?php

namespace Controller;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();
        //convertir de arreglo a json
        echo json_encode($servicios);
        //el echo imprime todo el json en la url
        //para luego leer el contenido de la url con JS
    }
    public static function guardar()
    {
        //Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $idCita = $resultado['id'];

        //Almacena la cita y servicio
        $idServicios = explode(',', $_POST['servicios']); //convierte de string a arreglo tomando el separador
        //almacena los servicios con el id de la cita
        foreach ($idServicios as $idServicio) {
            $args = [
                'citaId' => $idCita,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
}
