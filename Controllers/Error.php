<?php

class Errors extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        $data['page_tag'] = "HANAKO";
        $data['page_title'] = "Error";
        $data['page_name'] = "error";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "error", $data);
        // $this->views->getView($this, "error");
    }
}

$notFound = new Errors();
$notFound->notFound();
