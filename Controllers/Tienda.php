<?php
require_once("Models/TCategoria.php"); //para poder usar los métodos de TCategoria
require_once("Models/TProducto.php"); //para poder usar los métodos de TProducto
class Tienda extends Controllers
{
    //para hacer uso de los trait debemos colocar:
    use TCategoria, TProducto;
    public function __construct()
    {
        parent::__construct();
    }

    //fución para la vista de la tienda
    public function tienda($parems)
    {
        //invocamos la vista para la página principal
        $data['page_tag'] = "HANAKO";
        $data['page_title'] = "Tienda virtual";
        $data['page_name'] = "tienda";
        $data['productos'] = $this->getProductosT();

        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "tienda", $data);
    }

    //fucnión para la vista de los productos de la categoría
    public function categoria($params)
    {
        if (empty($params)) {
            header("Location:" . base_url()); //si no se han encontrado elementos redireccionamos a la página principal
        } else {

            $arrParams = explode(",", $params); //convertimos a un array los parametros
            $idCategoria = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoCategoria = $this->getProductosCategoriaT($idCategoria, $ruta);

            $data['page_tag'] = "HANAKO | " . $infoCategoria['categoria'];
            $data['page_title'] = $infoCategoria['categoria'];
            $data['page_name'] = "categoria";
            $data['productos'] = $infoCategoria['productos'];
            $this->views->getView($this, "categoria", $data);
        }
    }

    //función para la vista del detalle del producto
    public function producto($params)
    {
        if (empty($params)) {
            header("Location:" . base_url()); //si no se han encontrado elementos redireccionamos a la página principal
        } else {

            $arrParams = explode(",", $params); //convertimos a un array los parametros
            $idProducto = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoProducto = $this->getProductoT($idProducto, $ruta);

            if (empty($infoProducto)) {
                header("Location:" . base_url());
            }


            $data['page_tag'] = "HANAKO | " . $infoProducto['nombre'];
            $data['page_title'] = $infoProducto['nombre'];
            $data['page_name'] = "producto";
            $data['producto'] =  $infoProducto; //ya tenemos los datos del producto
            $data['productos'] = $this->getProductosRandomT($infoProducto['categoriaid'], 4, "r"); //obtenemos los productos de la categoria(para mostrarlos como sugerencia) y necesitamos 4, y la r significa que vamos a sacar los productos de forma aleatoria
            $this->views->getView($this, "producto", $data);
        }
    }
}
