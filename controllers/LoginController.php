<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;
use Model\Propiedad;

class LoginController {
    public static function login(Router $router) {

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)) {
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    //Verificar si el usuario existe o no(mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    //verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado)  {
                        //autenticar el usuario
                        $auth->autenticar();
                    } else {
                        //Password Incorrecto (mensaje de error)
                        $errores = Admin::getErrores();
                    }

                    
                }

                
            }
        }

        $router->render('auth/login', [
            'errores'=>$errores
        ]);
    }

    public static function logout() {
        session_start();

        $_SESSION = [];

        header('location: /');
    }

    public static function crear(Router $router) {

        $router->render('auth/crear-cuenta');
    }

    public static function olvide(Router $router) {

        $router->render('auth/olvide-password');
    }
}