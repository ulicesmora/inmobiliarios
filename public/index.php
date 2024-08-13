<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;
use Controllers\AdministrarController;

$router = new Router();

//Zona Privada
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/importar', [PropiedadController::class, 'importar']);
$router->post('/propiedades/importar', [PropiedadController::class, 'importar']);

$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);

//Zona Pública                                        
$router->get('/', [PaginasController::class, 'index']);
$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);
$router->get('/blog', [PaginasController::class, 'blog']);
$router->get('/entrada', [PaginasController::class, 'entrada']);
$router->get('/contacto', [PaginasController::class, 'contacto']);
$router->post('/contacto', [PaginasController::class, 'contacto']);
$router->get('/construccion', [PaginasController::class, 'construccion']);
$router->get('/preguntas', [PaginasController::class, 'preguntas']);

//Login y Autenticación
$router ->get('/login', [LoginController::class, 'login']);
$router ->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
// $router->get('/recuperar', [loginController::class, 'recuperar']);
// $router->post('/recuperar', [loginController::class, 'recuperar']);

//Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

//confirmar cuenta
// $router->get('/confirmar-cuenta',[loginController::class, 'confirmar']);
// $router->get('/mensaje',[loginController::class, 'mensaje']);

//administrar cuenta
$router->get('/administrar-cuenta', [AdministrarController::class, 'administrar']);
$router->post('/administrar-cuenta', [AdministrarController::class, 'administrar']);

$router->comprobarRutas();