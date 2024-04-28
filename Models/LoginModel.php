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

    public function sessionLogin(int $iduser)
    {
        $this->intIdUsuario = $iduser;
        //BUSCAR ROL
        $sql = "SELECT p.idpersona, p.identificacion, p.nombre, p.apellidos, p.telefono,
                p.email_user, p.nit, p.nombrefiscal, p.direccionfiscal, r.idrol, r.nombrerol, p.status
                FROM persona p INNER JOIN rol r ON p.rolid = r.idrol WHERE p.idpersona = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }
}
