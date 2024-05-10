<?php

class ProductosModel extends Mysql
{
    private $intIdProducto;
    private $strNombre;
    private $strDescripcion;
    private $intCategoriaId;
    private $strPrecio;
    private $intStock;
    private $intStatus;
    private $strImagen;

    public function __construct()
    {
        parent::__construct();
    }

    //método para sacar los productos con las categorías
    public function selectProductos()
    {
        $sql = "SELECT p.idproducto,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.stock,
                        p.status 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria";
        $request = $this->select_all($sql);
        return $request;
    }

    //método que inserta un producto
    public function insertProducto(string $nombre, string $descripcion, int $categoriaid, string $precio, int $stock, int $status)
    {
        $this->strNombre = $nombre;
        $this->strDescripcion = $descripcion;
        $this->intCategoriaId = $categoriaid;
        $this->strPrecio = $precio;
        $this->intStock = $stock;
        $this->intStatus = $status;
        $return = 0;
        //comprobamos si ya existe ya ese mismo producto con ese nombre
        $sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $query_insert  = "INSERT INTO producto(categoriaid,
                                                    nombre,
                                                    descripcion,
                                                    precio,
                                                    stock,
                                                    status) 
                              VALUES(?,?,?,?,?,?)";
            $arrData = array(
                $this->intCategoriaId,
                $this->strNombre,
                $this->strDescripcion,
                $this->strPrecio,
                $this->intStock,
                $this->intStatus
            );
            $request_insert = $this->insert($query_insert, $arrData);
            $return = $request_insert;
        } else {
            $return = "exist";
        }
        return $return;
    }

    //método para actualizar un producto
    public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $categoriaid, string $precio, int $stock, int $status)
    {
        $this->intIdProducto = $idproducto;
        $this->strNombre = $nombre;
        $this->strDescripcion = $descripcion;
        $this->intCategoriaId = $categoriaid;
        $this->strPrecio = $precio;
        $this->intStock = $stock;
        $this->intStatus = $status;
        $return = 0;
        $sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}' AND idproducto != $this->intIdProducto ";
        $request = $this->select_all($sql);
        if (empty($request)) {
            $sql = "UPDATE producto 
                    SET categoriaid=?,
                        nombre=?,
                        descripcion=?,
                        precio=?,
                        stock=?,
                        status=? 
                    WHERE idproducto = $this->intIdProducto ";
            $arrData = array(
                $this->intCategoriaId,
                $this->strNombre,
                $this->strDescripcion,
                $this->strPrecio,
                $this->intStock,
                $this->intStatus
            );

            $request = $this->update($sql, $arrData);
            $return = $request;
        } else {
            $return = "exist";
        }
        return $return;
    }

    //método que extrae un producto determinado
    public function selectProducto(int $idproducto)
    {
        $this->intIdProducto = $idproducto;
        $sql = "SELECT p.idproducto,
                        p.nombre,
                        p.descripcion,
                        p.precio,
                        p.stock,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.status
                FROM producto p
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria
                WHERE idproducto = $this->intIdProducto";
        $request = $this->select($sql);
        return $request;
    }

    //método para insertar imagen de un producto
    public function insertImage(int $idproducto, string $imagen)
    {
        $this->intIdProducto = $idproducto;
        $this->strImagen = $imagen;
        $query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
        $arrData = array(
            $this->intIdProducto,
            $this->strImagen
        );
        $request_insert = $this->insert($query_insert, $arrData);
        return $request_insert;
    }

    //método que extrae las imágenes de la base de datos
    public function selectImages(int $idproducto)
    {
        $this->intIdProducto = $idproducto;
        $sql = "SELECT productoid,img
                FROM imagen
                WHERE productoid = $this->intIdProducto";
        $request = $this->select_all($sql);
        return $request;
    }

    //método que elimina una imagen de la base de datos
    public function deleteImage(int $idproducto, string $imagen)
    {
        $this->intIdProducto = $idproducto;
        $this->strImagen = $imagen;
        $query  = "DELETE FROM imagen 
                    WHERE productoid = $this->intIdProducto 
                    AND img = '{$this->strImagen}'";
        $request_delete = $this->delete($query);
        return $request_delete;
    }

    //método que elimina un producto de la base de datos
    public function deleteProducto(int $idproducto)
    {
        $this->intIdProducto = $idproducto;
        $sql = "DELETE FROM producto WHERE idproducto = $this->intIdProducto ";
        $request = $this->delete($sql);
        return $request;
    }
}
