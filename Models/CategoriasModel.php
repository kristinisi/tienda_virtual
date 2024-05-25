<?php

class CategoriasModel extends Mysql
{
    public $intIdcategoria;
    public $strCategoria;
    public $strDescripcion;
    public $intStatus;
    public $strPortada;
    public $strRuta;

    public function __construct()
    {
        parent::__construct();
    }

    //método para insertar categoría
    public function inserCategoria(string $nombre, string $descripcion, string $portada, string $ruta, int $status)
    {

        $return = 0;
        $this->strCategoria = $nombre;
        $this->strDescripcion = $descripcion;
        $this->strPortada = $portada;
        $this->strRuta = $ruta;
        $this->intStatus = $status;

        //comprobamos si ya existe la categoría
        $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}' ";
        $request = $this->select_all($sql);

        if (empty($request)) {
            //almacenamos la categoría
            $query_insert  = "INSERT INTO categoria(nombre,descripcion,portada,ruta,status) VALUES(?,?,?,?,?)";
            $arrData = array(
                $this->strCategoria,
                $this->strDescripcion,
                $this->strPortada,
                $this->strRuta,
                $this->intStatus
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    //método para extraer las categorías
    public function selectCategorias()
    {
        $sql = "SELECT * FROM categoria 
                WHERE status != 0 ";
        $request = $this->select_all($sql);
        return $request;
    }

    //método para extraer una una categoria específica
    public function selectCategoria(int $idcategoria)
    {
        $this->intIdcategoria = $idcategoria;
        $sql = "SELECT * FROM categoria
                WHERE idcategoria = $this->intIdcategoria";
        $request = $this->select($sql);
        return $request;
    }

    //método para actualizar una categoría
    public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada, string $ruta, int $status)
    {
        $this->intIdcategoria = $idcategoria;
        $this->strCategoria = $categoria;
        $this->strDescripcion = $descripcion;
        $this->strPortada = $portada;
        $this->strRuta = $ruta;
        $this->intStatus = $status;

        //comprobamos si ya existe una categoría con ese nombre que estamos enviando y que sea diferente al id que estamos enviando para que no se duplique
        $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCategoria}' AND idcategoria != $this->intIdcategoria";
        $request = $this->select_all($sql);

        //si no existe la categoría procedemos a actualizar los datos
        if (empty($request)) {
            $sql = "UPDATE categoria SET nombre = ?, descripcion = ?, portada = ?, ruta = ?, status = ? WHERE idcategoria = $this->intIdcategoria ";
            $arrData = array(
                $this->strCategoria,
                $this->strDescripcion,
                $this->strPortada,
                $this->strRuta,
                $this->intStatus
            );
            $request = $this->update($sql, $arrData);
        } else {
            $request = "exist";
        }
        return $request;
    }

    //método para eliminar una categoría
    public function deleteCategoria(int $idcategoria)
    {
        $this->intIdcategoria = $idcategoria;

        //comprobamos si hay productos asociados a la categoría pasada por parámetro
        $sql = "SELECT * FROM producto WHERE categoriaid = $this->intIdcategoria";
        //hacemos la consulta
        $request = $this->select_all($sql);

        if (empty($request)) { //no encontro ninguna coincidencia en la consulta anterior
            $sql = "DELETE FROM categoria WHERE idcategoria = $this->intIdcategoria ";
            $request = $this->delete($sql);
            if ($request) {
                $request = 'ok';
            } else {
                $request = 'error';
            }
        } else { //si lo encuentra ponemos un exit
            $request = 'exist';
        }
        return $request;
    }

    public function getCategoriasFooter()
    {
        $sql = "SELECT * FROM categoria WHERE status = 1";
        $request = $this->select_all($sql);
        if (count($request) > 0) {
            for ($i = 0; $i < count($request); $i++) {
                $request[$i]['portada'] = BASE_URL . "/Assets/images/uploads/" . $request[$i]["portada"];
            }
        }
        return $request;
    }
}
