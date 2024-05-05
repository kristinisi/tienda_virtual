<?php

class PermisosModel extends Mysql
{
    public $intIdPermiso;
    public $intRolid;
    public $intModuloid;
    public $r;
    public $w;
    public $u;
    public $d;

    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
    }

    //mérodo que extrae los módulos de la bbdd
    public function selectModulos()
    {
        $sql = "SELECT * FROM modulo WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    //método que devuelve los permisos de un rol 
    public function selectPermisosRol(int $idrol)
    {
        $this->intRolid = $idrol;
        $sql = "SELECT * FROM permisos WHERE rolid = $this->intRolid";
        $request = $this->select_all($sql);
        return $request;
    }

    //método que borra los permisos de un rol 
    public function deletePermisos(int $idrol)
    {
        $this->intRolid = $idrol;
        $sql = "DELETE FROM permisos WHERE rolid = $this->intRolid";
        $request = $this->delete($sql);
        return $request;
    }

    //método que inserta los permisos pasados por parámetros a un rol
    public function insertPermisos(int $idrol, int $idmodulo, int $r, int $w, int $u, int $d)
    {
        $this->intRolid = $idrol;
        $this->intModuloid = $idmodulo;
        $this->r = $r;
        $this->w = $w;
        $this->u = $u;
        $this->d = $d;
        $query_insert  = "INSERT INTO permisos(rolid,moduloid,r,w,u,d) VALUES(?,?,?,?,?,?)";
        $arrData = array($this->intRolid, $this->intModuloid, $this->r, $this->w, $this->u, $this->d);
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    //extrae los permisos de los modulos a traves es un rol(id)
    public function permisosModulo(int $idrol)
    {
        $this->intRolid = $idrol;
        $sql = "SELECT p.rolid,
                       p.moduloid,
                       m.titulo as modulo,
                       p.r,
                       p.w,
                       p.u,
                       p.d 
                FROM permisos p 
                INNER JOIN modulo m
                ON p.moduloid = m.idmodulo
                WHERE p.rolid = {$this->intRolid}";
        $request = $this->select_all($sql);
        $arrPermisos = array();
        for ($i = 0; $i < count($request); $i++) { //agragamos los elementos al array
            $arrPermisos[$request[$i]['moduloid']] = $request[$i]; //el nuevo array va a iniciar en la posición del id del modulo dentro del elemento
        }
        return $arrPermisos;
    }
}
