<?php

class UsuariosModel extends Mysql
{
    private $intIdUsuario;
    private $strIdentificacion;
    private $strNombre;
    private $strApellido;
    private $intTelefono;
    private $strEmail;
    private $strPassword;
    private $strToken;
    private $intTipoId;
    private $intStatus;

    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
    }

    public function insertUsuario(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid, int $status)
    {

        $this->strIdentificacion = $identificacion;
        $this->strNombre = $nombre;
        $this->strApellido = $apellido;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->intTipoId = $tipoid;
        $this->intStatus = $status;
        $return = 0;

        //comprobamos si ya hay una persona con un email o una identificación igual a la que queremos introducir
        $sql = "SELECT * FROM persona WHERE 
                email_user = '{$this->strEmail}' or identificacion = '{$this->strIdentificacion}' ";
        $request = $this->select_all($sql);

        //si la request está vacío no encontró ninguna persona y lo va a insertar
        if (empty($request)) {
            $query_insert  = "INSERT INTO persona(identificacion,nombre,apellidos,telefono,email_user,password,rolid,status) 
                              VALUES(?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->intTelefono,
                $this->strEmail,
                $this->strPassword,
                $this->intTipoId,
                $this->intStatus
            );
            $request_insert = $this->insert($query_insert, $arrData); //insertamos la consulta con los datos
            $return = $request_insert; //obtenemos el resultado
        } else {
            $return = false;
        }
        return $return;
    }


    //Funcion que nos devuelve los usuarios con los datos para la datetable
    public function selectUsuarios()
    {
        $sql = "SELECT p.idpersona,p.identificacion,p.nombre,p.apellidos,p.telefono,p.email_user,p.status,r.nombrerol 
					FROM persona p 
					INNER JOIN rol r
					ON p.rolid = r.idrol
					WHERE p.status != 0 ";
        $request = $this->select_all($sql);
        return $request;
    }

    //Método que recibe un entero(id) desde el controlador y devuelve el usuario
    public function selectUsuario(int $idpersona)
    {
        $this->intIdUsuario = $idpersona;
        $sql = "SELECT p.idpersona,p.identificacion,p.nombre,p.apellidos,p.telefono,p.email_user,p.nit,p.nombrefiscal,
                    p.direccionfiscal,r.idrol,r.nombrerol,p.status, 
                    DATE_FORMAT(p.datecreated, '%d-%m-%Y') as fechaRegistro 
                FROM persona p
                INNER JOIN rol r
                ON p.rolid = r.idrol
                WHERE p.idpersona = $this->intIdUsuario";
        $request = $this->select($sql);
        return $request;
    }
}
