<?php
require_once("Libraries/Core/Mysql.php");
trait TCliente
{
    private $con;
    private $intIdUsuario;
    private $strIdentificacion;
    private $strNombre;
    private $strApellido;
    private $intTelefono;
    private $strEmail;
    private $strPassword;
    private $strToken;
    private $intTipoId;
    private $intIdTransaccion;

    public function insertCliente(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid)
    {
        $this->con = new Mysql();
        $this->strIdentificacion = $identificacion;
        $this->strNombre = $nombre;
        $this->strApellido = $apellido;
        $this->intTelefono = $telefono;
        $this->strEmail = $email;
        $this->strPassword = $password;
        $this->intTipoId = $tipoid;

        $return = 0;

        //comprobamos si ya hay un cliente con ese mismo emai
        $sql = "SELECT * FROM persona WHERE 
				email_user = '{$this->strEmail}'";
        $request = $this->con->select_all($sql);

        if (empty($request)) {
            $query_insert  = "INSERT INTO persona(identificacion,nombre,apellidos,telefono,email_user,password,rolid) 
							  VALUES(?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strIdentificacion,
                $this->strNombre,
                $this->strApellido,
                $this->intTelefono,
                $this->strEmail,
                $this->strPassword,
                $this->intTipoId
            );
            $request_insert = $this->con->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }
}
