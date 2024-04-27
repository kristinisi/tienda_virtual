<?php

class Home extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home($parems)
    {


        //invocamos la vista para la página principal
        $data['page_id'] = 1;
        $data['page_tag'] = "Home";
        $data['page_title'] = "Página principal";
        $data['page_name'] = "home";
        $data['page_content'] = "Este es un texo de ejemplo";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "home", $data);
    }
}
