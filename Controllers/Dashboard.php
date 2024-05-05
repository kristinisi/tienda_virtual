<?php

class Dashboard extends Controllers
{
    public function __construct()
    {
        // session_set_cookie_params(0, '/tienda_virtual', $_SERVER['HTTP_HOST'], false, true); //Establece los parámetros de la cookie para las sesiones
        //estamos inicializando la sesión para validar si ya existe una variable sesión login para que nos muestre la vista
        session_start();
        parent::__construct();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
        getPermisos(1);
    }

    public function dashboard($parems)
    {
        //invocamos la vista para la página principal
        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - HANAKO";
        $data['page_title'] = "Dashboard - HANAKO";
        $data['page_name'] = "dashboard";
        $data['page_functions_js'] = "functions_dashboard.js";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "dashboard", $data);
    }
}
