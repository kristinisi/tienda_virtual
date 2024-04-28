<?php

class Login extends Controllers
{
    public function __construct()
    {
        session_start(); //con session_start ya podemos crear variables de sesión
        if (isset($_SESSION['login'])) { //verificamos si existe la variable de sesion
            header('Location: ' . base_url() . '/dashboard'); //lo dejamos entrar al dahsboard
        }
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
                    $arrResponse = array("status" => false, "msg" => "El usuario o la contraseña es incorrecto");
                } else {
                    $arrData = $requestUser; //nos devuelve el id persona y es status
                    if ($arrData['status'] == 1) { //si se encuentra activo el usuario
                        //colocamos las variables de sesión
                        $_SESSION['idUser'] = $arrData['idpersona'];
                        $_SESSION['login'] = true;

                        //hacemos lo siguiente para que cada veez que estemos en nuestro usuario y hagamos algun cambio se cargue automátigamente sin tener que cerrar sesion
                        $arrData = $this->model->sessionLogin($_SESSION['idUser']); //nos devuelve lo que nos da el método en el modelo, le mandamos como parámetro el id del usuario
                        $_SESSION['userData'] = $arrData; //creamos la variable de sesión con los datos del array

                        $arrResponse = array('status' => true, 'msg' => "ok");
                    } else {
                        $arrResponse = array("status" => false, "msg" => "El usuario se encuentra inactivo");
                    }
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); //convertimos en formato JSON el array pasado por parámetro
        }
        die();
    }
}
