<?php

namespace Controllers;
use MVC\Router;

class AdministrarController {
    public static function administrar(Router $router) {

        $router->render('auth/administrar-cuenta');
    }
}