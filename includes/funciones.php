<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL',__DIR__ . 'funciones.php');
define('CARPETA_IMAGNES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function  incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/" . $nombre. ".php";
}

function estaAutenticado() : bool {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
    return false;
}

function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</rpe>";
    exit;
}

// Escapa / Sanitiza el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo, $tipos);
}

//Muestra los mensajes
function mostrarNotificaciones($codigo) {
    $mensaje = '';

    switch($codigo) {
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url) {
    //Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: $url");
    }
    return $id;
}