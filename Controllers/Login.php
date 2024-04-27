<?php

class Login extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login($parems)
    {

        //invocamos la vista para la página principal
        $data['page_tag'] = "Login";
        $data['page_title'] = "Login";
        $data['page_name'] = "login";
        $data['page_functions_js'] = "functions_login.js";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "login", $data);
    }

    public function loginUser()
    {
        // dep($_POST);
        if ($_POST) {
            //validamos que los campos no vayan vacios
            if (empty($_POST['txtEmail']) || empty($_POST['txtPassword'])) {
                $arrResponse = array("status" => false, "msg" => "Error de datos");
            } else { //si no está vacio
                //recogemos los datos
                $strUsuario = strtolower(strClean($_POST['txtEmail']));
                $strPassword = hash("SHA256", $_POST['txtPassword']); //encriptamos la contraseña que recibimos
                //llamamos al método del modelo para la consulta
                $requestUser = $this->model->loginUser($strUsuario, $strPassword);

                if (empty($requestUser)) {
                }
            }
        }
        die();
    }
}
