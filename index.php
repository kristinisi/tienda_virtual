<?php

//Primer archivo que se ejecuta cuando cargamos el proyecto

require_once("Config/Config.php");
require_once("Helpers/Helpers.php");

$url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
$arrUrl = explode("/", $url); //se captura toda la cardena del url pero lo separa con /
$controller = $arrUrl[0]; //el controlador va a ser la posicion 0 del array
$method = $arrUrl[0];
$params = "";

if (!empty($arrUrl[1])) {

    if ($arrUrl[1] != "") {
        $method = $arrUrl[1];
    }
}

if (!empty($arrUrl[2])) {
    if ($arrUrl[2] != "") {
        for ($i = 2; $i < count($arrUrl); $i++) {
            $params .= $arrUrl[$i] . ",";
        }
        $params = trim($params, ',');
    }
}

require_once("Libraries/Core/Autoload.php");
require_once("Libraries/Core/Load.php");
