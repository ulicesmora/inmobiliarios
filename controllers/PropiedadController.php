<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Tipo;
use Model\Statu;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {

        $propiedades =  Propiedad::all();

        $vendedores = Vendedor::all();

        $tipos = Tipo::all();

        $status = Statu::all();
        
        //muestra un mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores,
            'tipos' => $tipos,
            'status' => $status
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $tipos = Tipo::all();
        $status = Statu::all();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
             /* Crea una nueva instancia */
        $propiedad = new Propiedad($_POST['propiedad']);

        /* Subida de archivos */

        //Generar un nombre único
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        //Setear la imagen
        //Realiza un resize a la imgaen con Intervention
        if($_FILES['propiedad']['tmp_name']['imagen']) {
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        //Validar
        $errores = $propiedad->validar();

        //Revisar que el array de errores este vacio
        if(empty($errores)){
            //Crear la carpeta par subir las imgenes
            if(!is_dir(CARPETA_IMAGNES)) {
                mkdir(CARPETA_IMAGNES);
            }

            //Guardar la imagen en el servidor
            $image->save(CARPETA_IMAGNES . $nombreImagen);

            //Guarda en la base de datos
            $propiedad->guardar();
        }
        }
        
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            'tipos' => $tipos,
            'status' => $status
        ]);
    }

    public static function importar(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $tipos = Tipo::all();
        $status = Statu::all();

        //Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener el valor del campo de texto
            $nombre = $_POST['total'];
            if(!$nombre) {
                $errores = $propiedad->validar();
            }
            /* Crea una nueva instancia */
            for ($i=1; $i <= $nombre; $i++) { 
                $propiedad = new Propiedad($_POST['propiedad'.$i]);
                /* Subida de archivos */
    
                //Generar un nombre único
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                
                //Setear la imagen
                //Realiza un resize a la imgaen con Intervention
                // if($_FILES['propiedad']['tmp_name']['imagen']) {
                //     $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                //     $propiedad->setImagen($nombreImagen);
                // }
    
                //Validar
                $errores = $propiedad->validar();
    
                //Revisar que el array de errores este vacio
                if(empty($errores)){
                    //Crear la carpeta par subir las imgenes
                    // if(!is_dir(CARPETA_IMAGNES)) {
                    //     mkdir(CARPETA_IMAGNES);
                    // }
    
                    //Guardar la imagen en el servidor
                    // $image->save(CARPETA_IMAGNES . $nombreImagen);
    
                    //Guarda en la base de datos
                    $propiedad->guardar();
                }
            }


        }

        $router->render('propiedades/importar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            'tipos' => $tipos,
            'status' => $status
        ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);
        

        $vendedores = Vendedor::all();

        $tipos = Tipo::all();

        $status = Statu::all();

        $errores = Propiedad::getErrores();

        //Ejecutar el código despues de que el usuario envía el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los atributos
            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            //Validación
            $errores = $propiedad->validar();

            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            //Subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            //Revisar que el array de errores este vacio
            if(empty($errores)){
                //Almacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGNES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            'tipos' => $tipos,
            'status' => $status
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
    
                $tipo = $_POST['tipo'] ;
    
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}