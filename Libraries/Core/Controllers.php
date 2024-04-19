<?php
//Este archivo hace la carga de los controladores y llamado hacia los modelos

class Controllers
{
    public $model;
    public $views;

    public function __construct()
    {
        //hacemos la instancia de la vista
        $this->views = new Views();
        $this->loadModel();
    }

    public function loadModel()
    {
        //HomeModel
        $model = get_class($this) . "Model";
        $routClass = "Models/" . $model . ".php"; //va a buscar el modelo
        //primero hacemos la validación
        if (file_exists($routClass)) {
            require_once $routClass;
            $this->model = new $model(); //creamos la instancia
        }
    }
}
