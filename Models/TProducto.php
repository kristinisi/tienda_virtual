<?php
require_once("Libraries/Core/Mysql.php"); //archivo que hace el crud en nuestra bbdd
trait TProducto
{
    private $con;
    private $strCategoria;
    private $intIdCategoria;
    private $intIdProducto;
    private $strProducto;
    private $cant;
    private $option;
    private $strRuta;

    //método que retorna los productos
    public function getProductosT()
    {
        $this->con = new Mysql(); //creamos el objeto mysql
        $sql = "SELECT p.idproducto,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.stock,
                        p.ruta,
                        p.status 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria ORDER BY p.idproducto DESC LIMIT " . CANTPORHOME;
        $request = $this->con->select_all($sql);
        if (count($request) > 0) { //si hay resultado de búsquedas recorremos el array de productos
            for ($i = 0; $i < count($request); $i++) {
                $intIdProducto = $request[$i]['idproducto'];
                //sacamos las imágenes de cada producto
                $sqlImg = "SELECT img
                FROM imagen
                WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($j = 0; $j < count($arrImg); $j++) {
                        //creamos un item para la ruta de la imagen
                        $arrImg[$j]['url_image'] =  media() . "/images/uploads/" . $arrImg[$j]["img"];
                    }
                }
                //colocamos el array de las imágenes a cada producto
                $request[$i]['images'] = $arrImg;
            }
        }
        return $request;
    }

    public function getProductosPage($desde, $porpagina)
    {
        $this->con = new Mysql(); //creamos el objeto mysql
        $sql = "SELECT p.idproducto,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        p.precio,
                        p.stock,
                        p.ruta,
                        p.status 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria ORDER BY p.idproducto DESC LIMIT $desde, $porpagina";
        $request = $this->con->select_all($sql);
        if (count($request) > 0) { //si hay resultado de búsquedas recorremos el array de productos
            for ($i = 0; $i < count($request); $i++) {
                $intIdProducto = $request[$i]['idproducto'];
                //sacamos las imágenes de cada producto
                $sqlImg = "SELECT img
                FROM imagen
                WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($j = 0; $j < count($arrImg); $j++) {
                        //creamos un item para la ruta de la imagen
                        $arrImg[$j]['url_image'] =  media() . "/images/uploads/" . $arrImg[$j]["img"];
                    }
                }
                //colocamos el array de las imágenes a cada producto
                $request[$i]['images'] = $arrImg;
            }
        }
        return $request;
    }

    //método que retorna los productos por categoría
    public function getProductosCategoriaT(int $idcategoria, string $ruta) //le pasamos por parámetro la categoría para que nos saque sus productos
    {
        $this->intIdCategoria = $idcategoria;
        $this->strRuta = $ruta;

        $this->con = new Mysql(); //creamos el objeto mysql
        $sql_cat = "SELECT idcategoria, nombre FROM categoria WHERE idcategoria = '{$this->intIdCategoria}'";
        $request = $this->con->select($sql_cat); //extraemos el id

        //Validamos si se ha encontrado
        if (!empty($request)) {
            $this->strCategoria = $request['nombre']; //almacenamos el nombre de la categoria
            $sql = "SELECT p.idproducto,
                    p.nombre,
                    p.descripcion,
                    p.categoriaid,
                    c.nombre as categoria,
                    p.precio,
                    p.ruta,
                    p.stock
                    FROM producto p 
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.categoriaid = $this->intIdCategoria AND c.ruta = '{$this->strRuta}'";
            $request = $this->con->select_all($sql);
            if (count($request) > 0) { //si hay resultado de búsquedas recorremos el array de productos
                for ($i = 0; $i < count($request); $i++) {
                    $intIdProducto = $request[$i]['idproducto'];
                    //sacamos las imágenes de cada producto
                    $sqlImg = "SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";
                    $arrImg = $this->con->select_all($sqlImg);
                    if (count($arrImg) > 0) {
                        for ($j = 0; $j < count($arrImg); $j++) {
                            //creamos un item para la ruta de la imagen
                            $arrImg[$j]['url_image'] =  media() . "/images/uploads/" . $arrImg[$j]["img"];
                        }
                    }
                    //colocamos el array de las imágenes a cada producto
                    $request[$i]['images'] = $arrImg;
                }
            }
            $request = array(
                'idcategoria' => $this->intIdCategoria,
                'categoria' => $this->strCategoria,
                'productos' => $request
            );
        }
        return $request;
    }

    //método que retorna un producto específico
    public function getProductoT(int $idproducto, string $ruta)
    {
        $this->con = new Mysql(); //creamos el objeto mysql
        $this->intIdProducto = $idproducto;
        $this->srtRuta = $ruta;

        $sql = "SELECT p.idproducto,
                        p.nombre,
                        p.descripcion,
                        p.categoriaid,
                        c.nombre as categoria,
                        c.ruta as ruta_categoria, 
                        p.precio,
                        p.stock,
                        p.ruta,
                        p.status 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria
                WHERE p.idproducto = '{$this->intIdProducto}' AND p.ruta = '{$this->srtRuta}'";
        $request = $this->con->select($sql);

        if (!empty($request)) { //si hay resultado de búsquedas recorremos el array de productos

            $intIdProducto = $request['idproducto'];
            //sacamos las imágenes de cada producto
            $sqlImg = "SELECT img
                FROM imagen
                WHERE productoid = $intIdProducto";
            $arrImg = $this->con->select_all($sqlImg);
            if (count($arrImg) > 0) {
                for ($j = 0; $j < count($arrImg); $j++) {
                    //creamos un item para la ruta de la imagen
                    $arrImg[$j]['url_image'] =  media() . "/images/uploads/" . $arrImg[$j]["img"];
                }
            } else {
                $arrImg[0]['url_image'] =  media() . '/images/uploads/no_producto.png';
            }
            //colocamos el array de las imágenes a cada producto
            $request['images'] = $arrImg;
        }
        return $request;
    }

    //sacar productos relacionados con la categoria de manera aleatoria
    public function getProductosRandomT(int $idcategoria, int $cant, string $option)
    {
        $this->intIdCategoria = $idcategoria;
        $this->cant = $cant;
        $this->option = $option;
        $this->con = new Mysql(); //creamos el objeto mysql

        if ($option == "r") {
            $this->option = " RAND() ";
        } else if ($option == "a") {
            $this->option = " idproducto ASC ";
        } else {
            $this->option = " idproducto DESC ";
        }

        $sql = "SELECT p.idproducto,
                    p.nombre,
                    p.descripcion,
                    p.categoriaid,
                    c.nombre as categoria,
                    p.precio,
                    p.ruta,
                    p.stock
                    FROM producto p 
                    INNER JOIN categoria c
                    ON p.categoriaid = c.idcategoria
                    WHERE p.categoriaid = $this->intIdCategoria 
                    ORDER BY $this->option LIMIT $this->cant";
        $request = $this->con->select_all($sql);

        if (count($request) > 0) { //si hay resultado de búsquedas recorremos el array de productos
            for ($i = 0; $i < count($request); $i++) {
                $intIdProducto = $request[$i]['idproducto'];
                //sacamos las imágenes de cada producto
                $sqlImg = "SELECT img
                                FROM imagen
                                WHERE productoid = $intIdProducto";
                $arrImg = $this->con->select_all($sqlImg);
                if (count($arrImg) > 0) {
                    for ($j = 0; $j < count($arrImg); $j++) {
                        //creamos un item para la ruta de la imagen
                        $arrImg[$j]['url_image'] =  media() . "/images/uploads/" . $arrImg[$j]["img"];
                    }
                }
                //colocamos el array de las imágenes a cada producto
                $request[$i]['images'] = $arrImg;
            }
        }

        return $request;
    }

    //método que retorna un producto mediante el id
    public function getProductoIDT(int $idproducto)
    {
        $this->con = new Mysql();
        $this->intIdProducto = $idproducto;
        $sql = "SELECT p.idproducto,
						p.nombre,
						p.descripcion,
						p.categoriaid,
						c.nombre as categoria,
						p.precio,
						p.ruta,
						p.stock
				FROM producto p 
				INNER JOIN categoria c
				ON p.categoriaid = c.idcategoria
				WHERE p.idproducto = '{$this->intIdProducto}' ";
        $request = $this->con->select($sql);

        if (!empty($request)) {
            $intIdProducto = $request['idproducto'];
            $sqlImg = "SELECT img
							FROM imagen
							WHERE productoid = $intIdProducto";
            $arrImg = $this->con->select_all($sqlImg);
            if (count($arrImg) > 0) {
                for ($i = 0; $i < count($arrImg); $i++) {
                    $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
                }
            } else {
                $arrImg[0]['url_image'] = media() . '/images/uploads/no_producto.png';
            }
            $request['images'] = $arrImg;
        }
        return $request;
    }

    public function cantProductos()
    {
        $this->con = new Mysql();
        $sql = "SELECT COUNT(*) as total_registro FROM producto WHERE status = 1";
        $result_register = $this->con->select($sql);
        $total_registro = $result_register;
        return $total_registro;
    }
}
