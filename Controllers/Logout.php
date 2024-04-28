<?php

class Logout
{
    public function __construct()
    {
        session_start(); //inicializar sesion
        session_unset(); //limpiar variables de sesion
        session_destroy(); //destruir todas las sesiones
        header("location:" . base_url() . "/login"); //redireccionamos a la ruta del login
    }
}
