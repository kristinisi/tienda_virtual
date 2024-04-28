<?php

class Dashboard extends Controllers
{
    public function __construct()
    {
        parent::__construct();

        //estamos inicializando la sesión para validar si ya existe una variable sesión login para que nos muestre la vista, de lo contrario nos redirecciona a alogin
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
        }
    }

    public function dashboard($parems)
    {
        //invocamos la vista para la página principal
        $data['page_id'] = 2;
        $data['page_tag'] = "Dashboard - HANAKO";
        $data['page_title'] = "Dashboard - HANAKO";
        $data['page_name'] = "dashboard";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "dashboard", $data);
    }
}
