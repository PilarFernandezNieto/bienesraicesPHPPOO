<?php

namespace App;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    protected static $errores = [];

    // Definir la conexion a la bbdd
    public static function setDB($database) {
        self::$db = $database;
    }


    public static function findAll() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }
    // listado con un número limitado de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    public static function findById($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = '$id'";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public function guardar() {
        if (!is_null($this->id)) {
            $this->actualizar();
        } else {
            $this->crear();
        }
    }

    public function crear() {
        // Santitizar los datos
        $atributos = $this->sanitizarDatos();

        // Insertar en la base de datos
        $sql = "INSERT INTO " . static::$tabla . " ( ";
        $sql .= join(", ", array_keys($atributos));
        $sql .= ") VALUES (' ";
        $sql .= join("', '", array_values($atributos));
        $sql .= "');";

        $resultado = self::$db->query($sql);
   
        if ($resultado) {
            header('Location:/bienesraices/admin/?resultado=1');
        }
    }
    public function actualizar() {
        $atributos = $this->sanitizarDatos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key ='$value'";
        }


        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);
        if ($resultado) {
            header('Location: /bienesraices/admin/?resultado=2');
        }
    }

    public function delete() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        if ($resultado) {
            $this->borrarImagen();
            header("location: /bienesraices/admin?resultado=3");
        }
        return $resultado;
    }

    /**
     * Identifica los atributos de la base de datos
     */
    public function atributos() {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }
    // Subida de archivos
    public function setImagen($imagen) {
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . '/' . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . '/' . $this->imagen);
        }
    }

    // Validacion
    public static function getErrores() {
        return static::$errores;
    }
    public function validar() {
        static::$errores = [];


        return static::$errores;
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados formateados
        return $array;
    }
    protected static function crearObjeto($registro) {
        $objeto = new static; // Crea una nueva instancia de Propiedad dentro de la clase
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
