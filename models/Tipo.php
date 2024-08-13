<?php

namespace Model;

use Model\ActiveRecord;

class Tipo extends ActiveRecord {

    protected static $tabla = 'tipos';
    protected static $columnasDB = ['tipo_id', 'tipo_inmueble'];

    public $tipo_id;
    public $tipo_inmueble;

    public function __construct($args = [])
    {
        $this->tipo_id = $args['tipo_id'] ?? NULL;
        $this->tipo_inmueble = $args['tipo_inmueble'] ?? '';
    }

    public function validar() {

        if(!$this->tipo_inmueble) {
            self::$errores[] = "El tipo es obligatorio";
        }

        return self::$errores;
    }
}