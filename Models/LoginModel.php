<?php

class LoginModel extends Mysql
{

    private $intIdUsuario;
    private $strUsuario;
    private $strPassword;

    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
    }

    //Función que nos devuelve el resultado de la consulta login al controlador
    public function loginUser(string $usuario, string $password)
    {
        $this->strUsuario = $usuario;
        $this->strPassword = $password;

        $sql = "SELECT idpersona, status FROM persona WHERE email_user = '$this->strUsuario' 
                AND password = '$this->strPassword' AND status != 0";

        $request = $this->select($sql);
        return $request;
    }
}
