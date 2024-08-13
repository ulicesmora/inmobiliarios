<?php

namespace Model;

use Model\ActiveRecord;

class Propiedad extends ActiveRecord {

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorid', 'municipio', 'estado', 'colonia', 'tipoid', 'statusid'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorid;
    public $estado;
    public $municipio;
    public $colonia;
    public $tipoid;
    public $statusid;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args ['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorid = $args['vendedorid'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->municipio = $args['municipio'] ?? '';
        $this->colonia = $args['colonia'] ?? '';
        $this->tipoid = $args['tipoid'] ?? '';
        $this->statusid = $args['statusid'] ?? '';
    }

    public function validar() {

        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = 'El precio es obligatorio';
        }

        if( strlen( $this->descripcion ) < 50 ) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$this->habitaciones) {
            self::$errores[] = 'El Número de habitaciones es obligatorio';
        }

        if(!$this->wc) {
            self::$errores[] = 'El número de baños es obligatorio';
        }

        if(!$this->estacionamiento) {
            self::$errores[] = 'El número de lugares de estacionamiento es obligatorio';
        }

        if(!$this->vendedorid) {
            self::$errores[] =  'Elige un vendedor';
        }

        if(!$this->imagen) {
             self::$errores[] = 'La imagen es obligatoria';
         }

        if(!$this->estado) {
            self::$errores[] = 'Elige un estado';
        }

        if(!$this->municipio) {
            self::$errores[] = 'Elige un municipio';
        }

        if(!$this->colonia) {
            self::$errores[] = 'Ingresa una colonia';
        }

        if(!$this->tipoid) {
            self::$errores[] = 'Selecciona un tipo de propiedad';
        }

        if(!$this->statusid) {
            self::$errores[] = 'Selecciona el status de la propiedad';
        }

        return self::$errores;
    }
}