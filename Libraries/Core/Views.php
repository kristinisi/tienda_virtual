<?php
class Views
{

    //la función recibe el controlador y la vista que se va a mostrar
    function getView($controller, $view, $data = "") //ponemos el data vacío para que no haya error en caso de que no tengamos
    {
        $controller = get_class($controller);
        //hacemos la validación para home
        if ($controller == "Home") {
            $view = "Views/" . "/" . $view . ".php";
        } else {
            $view = "Views/" . $controller . "/" . $view . ".php";
        }

        require_once($view);
    }
}
