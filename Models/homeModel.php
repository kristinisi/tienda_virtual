<?php
// require_once("CategoriasModel.php");

class HomeModel extends Mysql
{

    private $objCategoria;

    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
        // $this->objCategoria = new CategoriasModel(); //creamos el objeto para poder usar sus métodos
    }
}
