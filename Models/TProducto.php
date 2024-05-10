<!-- TRAIT CATEGORIA -->
<?php
require_once("Libraries/Core/Mysql.php"); //archivo que hace el crud en nuestra bbdd
trait TProducto
{
    private $con;
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
                        p.status 
                FROM producto p 
                INNER JOIN categoria c
                ON p.categoriaid = c.idcategoria";
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
}
?>