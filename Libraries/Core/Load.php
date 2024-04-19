<?php
$controllerFile = "Controllers/" . $controller . ".php"; //Para poder convertir la primera letra en matúscula para el case sensitive de los servidores
if (file_exists($controllerFile)) {
    //en caso de que exista el controlador, lo requerimos
    require_once($controllerFile);
    $controller = new $controller(); //hacemos la instancia

    //en caso de que exista el metodo, lo requerimos
    if (method_exists($controller, $method)) {
        $controller->{$method}($params);
    } else {
        require_once("Controllers/Error.php");
    }
} else {
    require_once("Controllers/Error.php");
}
