<?php
require_once("Models/TCategoria.php"); //para poder usar los métodos de TCategoria
require_once("Models/TProducto.php"); //para poder usar los métodos de TProducto
class Home extends Controllers
{
    //para hacer uso de los trait debemos colocar:
    use TCategoria, TProducto;
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function home($parems)
    {
        //invocamos la vista para la página principal
        $data['page_tag'] = "HANAKO";
        $data['page_title'] = "Página principal";
        $data['page_name'] = "home";
        $data['slider'] = $this->getCategoriasT(CAT_SLIDER);
        $data['banner'] = $this->getCategoriasT(CAT_BANNER);
        $data['productos'] = $this->getProductosT();

        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "home", $data);
    }
}
