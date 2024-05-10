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

    //método que se encarga de buscar y recuperar información a través de un id de usuario
    public function sessionLogin(int $iduser)
    {
        $this->intIdUsuario = $iduser;
        //BUSCAR ROL
        $sql = "SELECT p.idpersona, p.identificacion, p.nombre, p.apellidos, p.telefono,
                p.email_user, r.idrol, r.nombrerol, p.status
                FROM persona p INNER JOIN rol r ON p.rolid = r.idrol WHERE p.idpersona = $this->intIdUsuario";
        $request = $this->select($sql);
        $_SESSION['userData'] = $request; //lo que nos devuelve la consulta va a ser almacenado en la variable de sesión(SE CREA AL HACER LOGIN)
        return $request;
    }
}
