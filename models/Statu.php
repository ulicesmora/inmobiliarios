<?php

namespace Model;

use Model\ActiveRecord;

class Statu extends ActiveRecord {

    protected static $tabla = 'status';
    protected static $columnasDB = ['status_id', 'status'];

    public $status_id;
    public $status;

    public function __construct($args = [])
    {
        $this->status_id = $args['status_id'] ?? NULL;
        $this->status = $args['status'] ?? '';
    }

    public function validar() {

        if(!$this->status) {
            self::$errores[] = "El estatus es obligatorio";
        }

        return self::$errores;
    }
}