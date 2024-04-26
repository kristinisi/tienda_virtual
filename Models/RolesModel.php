<?php

class RolesModel extends Mysql //Mysql es el archivo que hace el crud a la base de datos
{

    public $intIdrol;
    public $strRol;
    public $strDescripcion;
    public $intStatus;

    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
    }

    //Método que extrae los roles
    public function selectRoles()
    {
        $sql = "SELECT * FROM rol WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    //método qu extrae un rol a través de un id
    public function selectRol(int $idrol)
    {
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM rol WHERE idRol = $this->intIdrol";
        $request = $this->select($sql);
        return $request;
    }

    //Método que recibe los parámetros para hacer la inserción del rol en mysql
    public function insertRol(string $rol, string $descripcion, int $estatus)
    {
        $return = "";
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $estatus;

        //Consultamos si el rol ya existe
        $sql = "SELECT * FROM rol WHERE nombrerol = '{this->strRol}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            //insertamos el rol
            $query_insert = "INSERT INTO rol(nombrerol, descripcion, status) VALUES(?,?,?)"; //hacemos la consulta
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus); //armamos el array de datos
            $request_insert = $this->insert($query_insert, $arrData); //enviamos los datos al método insertar
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    //método que recibe los parámetros para hacer la actualización del rol en mysql
    public function updateRol(int $idrol, string $rol, string $descripcion, int $status)
    {
        $this->intIdrol = $idrol;
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM rol WHERE nombrerol = '$this->strRol' AND idrol != $this->intIdrol";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE rol SET nombrerol = ?, descripcion = ?, status = ? WHERE idrol = $this->intIdrol";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método que recibeun id y elimina el rol deseado
    public function deleteRol(int $idrol)
    {
        $this->intIdrol = $idrol;

        $sql = "SELECT * FROM persona WHERE rolid = $this->intIdrol"; //si el rol ya está asociado a una persona no sebemos permitir que se elimine
        $request = $this->select_all($sql);

        if (empty($request)) {
            $sql = "UPDATE rol SET status = ? WHERE idrol = $this->intIdrol";
            $arrData = array(0); //SE MARCA COMO ELIMINADO O INACTIVO SI EL STATUS ES 0 
            $request = $this->update($sql, $arrData);
            if ($request) {
                $request = "ok";
            } else {
                $request = "error";
            }
        } else {
            $request = "exist";
        }
        return $request;
    }
}
