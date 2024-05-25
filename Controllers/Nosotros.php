<?php
class Nosotros extends Controllers
{

    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function nosotros($parems)
    {
        //invocamos la vista para la página principal
        $data['page_tag'] = "HANAKO";
        $data['page_title'] = "Nosotros";
        $data['page_name'] = "nosotros";;

        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "nosotros", $data);
    }
}
