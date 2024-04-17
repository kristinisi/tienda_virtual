<?php

class Conexion
{

    private \PDO $connect; //es una propiedad privada de la clase que debe contener un objerto de la clase PDO

    public function __construct()
    {
        $connectionString = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_CHARSET;
        try {
            $this->connect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //esto nos ayuda a detectar los errores
        } catch (Exception $e) {
            $this->connect = "Error de conexion";
            echo "ERROR: " . $e->getMessage(); //Nos muestra el error
        }
    }

    public function connect()
    {
        return $this->connect;
    }
}
