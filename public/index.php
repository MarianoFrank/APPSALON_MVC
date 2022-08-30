<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\APIController;
use Controller\CitaController;
use Controller\LoginController;
use Controller\AdminController;
use Controller\ServicioController;

$router = new Router();

//iniciar sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
//recuperar password
$router->get('/repass', [LoginController::class, 'repass']);
$router->post('/repass', [LoginController::class, 'repass']);
$router->get('/recover', [LoginController::class, 'recuperar']);
$router->post('/recover', [LoginController::class, 'recuperar']);
//crer cuenta
$router->get('/newacount', [LoginController::class, 'crear']);
$router->post('/newacount', [LoginController::class, 'crear']);
//confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/mensajeRepass', [LoginController::class, 'mensajeRepass']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador

//Area privada
$router->get('/cita', [CitaController::class, 'index']);

//Api de citas
$router->get('/api/servicios',[APIController::class,'index']);
$router->post('/api/citas',[APIController::class,'guardar']);
$router->post('/api/eliminar',[APIController::class,'eliminar']);

//Admin
$router->get('/admin',[AdminController::class,'index']);

//CRUD de servicios
$router->get('/servicios',[ServicioController::class,'index']);
$router->get('/servicios/crear',[ServicioController::class,'crear']);
$router->post('/servicios/crear',[ServicioController::class,'crear']);
$router->get('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/actualizar',[ServicioController::class,'actualizar']);
$router->post('/servicios/eliminar',[ServicioController::class,'eliminar']);

$router->comprobarRutas();
