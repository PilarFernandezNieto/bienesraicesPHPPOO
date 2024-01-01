<?php

namespace App;

class Propiedad extends ActiveRecord {
    protected static $tabla = "propiedades";
    protected static $columnasDB = [
        "id",
        "titulo",
        "descripcion",
        "precio",
        "imagen",
        "habitaciones",
        "wc",
        "estacionamiento",
        "creado",
        "vendedorId"
    ];
    public $id;
    public $titulo;
    public $descripcion;
    public $precio;
    public $imagen;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;
    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args["vendedorId"] ?? "";
    }
    public function validar() {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "El número de habitaciones es obligatorio";
        }
        if (!$this->wc) {
            self::$errores[] = "El número de wc es obligatorio";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "El número de estacionamientos es obligatorio";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen es obligatoria";
        }

        return self::$errores;
    }
    
}
