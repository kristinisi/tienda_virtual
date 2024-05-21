<?php
class Pedidos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        getPermisos(5); //5 porque el módulo pedidos tiene ese número
    }

    public function Pedidos()
    {
        //Si no tiene permiso de lectura se redirecciona a la página ppal
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag'] = "Pedidos";
        $data['page_title'] = "PEDIDOS HANAKO";
        $data['page_name'] = "pedidos";
        $data['page_functions_js'] = "functions_pedidos.js";
        $this->views->getView($this, "pedidos", $data);
    }
}
