<?php

class Categorias extends Controllers
{
    public function __construct()
    {

        parent::__construct();
        //estamos inicializando la sesión para validar si ya existe una variable sesión login para que nos muestre la vista
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login'); //si eel login está vacío nos lleva a la vista login
        }
        getPermisos(6); //es un 6 porque se refiere al id del módulo categoría
    }

    public function Categorias($parems)
    {
        //comprueba si tiene permisos de lectura el modelo sino te redirecciona al dashboard
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url() . "/dashboard");
        }
        //invocamos la vista para la página principal
        $data['page_tag'] = "Categorías HANAKO";
        $data['page_title'] = "Categorías HANAKO";
        $data['page_name'] = "categorias";
        $data['page_functions_js'] = "functions_categorias.js";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "categorias", $data);
    }


    //método para guardar una categoría
    public function setCategoria()
    {
        if ($_POST) { //Validamos que los datos no vayan vacíos
            if (empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {

                //guardamos los datos en las variables
                $intIdcategoria = intval($_POST['idCategoria']);
                $strCategoria =  strClean($_POST['txtNombre']);
                $strDescipcion = strClean($_POST['txtDescripcion']);
                $intStatus = intval($_POST['listStatus']);

                $ruta = strtolower(clear_cadena($strCategoria)); //limpiar el nombre por si lleva tildes, función del helper
                $ruta = str_replace(" ", "-", $ruta); //reemplazamos los espacios por guiones

                //almacenamos los datos de la imagen en variables
                $foto            = $_FILES['foto']; //array general de la foto
                $nombre_foto     = $foto['name'];
                $type              = $foto['type'];
                $url_temp        = $foto['tmp_name'];
                $imgPortada     = 'flor_categoria.png'; //correcponde al nombre de la imagen
                $request_cateria = "";
                if ($nombre_foto != '') { //si el nombre de la foto está vacio 
                    //md5 es para poder encriptar con la función date una fecha y tener un nombre aleatorio para que no se repita
                    $imgPortada = 'img_' . md5(date('d-m-Y H:m:s')) . '.jpg';
                }

                //si el id es 0 quiere decir que estamos creando una nueva categoría
                if ($intIdcategoria == 0) {
                    //Crear
                    if ($_SESSION['permisosMod']['w']) {
                        $request_cateria = $this->model->inserCategoria($strCategoria, $strDescipcion, $imgPortada, $ruta, $intStatus);
                        $option = 1;  //para el mensaje de guardar o actualizar
                    }
                } else {
                    //Actualizar
                    if ($_SESSION['permisosMod']['u']) {
                        if ($nombre_foto == '') { //si el nombre de la foto es vacío, esque no estamos enviando foto
                            //si tiene una foto diferente a la de por defecto y remove es 0 NO ESTAMOS ACTUALIZANDO LA FOTO
                            if ($_POST['foto_actual'] != 'flor_categoria.png' && $_POST['foto_remove'] == 0) {
                                //toma la foto actual para asignarlo a la variable y no cambiar el nombre de la foto
                                $imgPortada = $_POST['foto_actual'];
                            }
                        }
                        $request_cateria = $this->model->updateCategoria($intIdcategoria, $strCategoria, $strDescipcion, $imgPortada, $ruta, $intStatus);
                        $option = 2;
                    }
                }
                if ($request_cateria > 0) { //si la consulta se ha hecho con exito, validamos las opciones para saber si es una nueva inserción o una actualización
                    if ($option == 1) {
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                        //si enviamos una foto
                        if ($nombre_foto != '') {
                            //cargamos la imagen(función alojada en helpers)
                            uploadImage($foto, $imgPortada); //debe retornar el movimiento de la imagen a la carpeta
                        }
                    } else {
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                        if ($nombre_foto != '') {
                            uploadImage($foto, $imgPortada);
                        }

                        //si no enviamos una imagen, eliminamos la imagen actial, si la foto actual es diferente a la imagen por defecto 
                        //o cuando el nombre de la imagen es diferente a vacio(enviamos foto) y la foto actual es diferete al valor por defecto
                        //lo que estamos haciendo es un cambio de imagen lo cual eliminamos la foto actual
                        if (($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'portada_categoria.png')
                            || ($nombre_foto != '' && $_POST['foto_actual'] != 'portada_categoria.png')
                        ) {
                            deleteFile($_POST['foto_actual']); //funcion de eliminmar la foto por su nombre en un directorio (LA FUNCIÓN ESTÁ EN HELPERS)
                        }
                    }
                } else if ($request_cateria == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! La categoría ya existe.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para extraer los clientes de la base de datos y mostrarlos en la datatable
    public function getCategorias()
    {
        if ($_SESSION['permisosMod']['r']) {
            $arrData = $this->model->selectCategorias();
            for ($i = 0; $i < count($arrData); $i++) { //recorremos los elementos del array
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';


                //necesitamos saber el status para cambiarlo a formato de texto
                if ($arrData[$i]['status'] == 1) {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                //validamos si el usuario tiene permisos de lectura
                if ($_SESSION['permisosMod']['r']) {
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idcategoria'] . ')" title="Ver categoría"><i class="far fa-eye"></i></button>';
                }
                //validamos si el usuario tiene permisos de actualización
                if ($_SESSION['permisosMod']['u']) {
                    $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(' . $arrData[$i]['idcategoria'] . ')" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';
                }
                //validamos si el usuario tiene permisos de borrado
                if ($_SESSION['permisosMod']['d']) {
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idcategoria'] . ')" title="Eliminar categoría"><i class="far fa-trash-alt"></i></button>';
                }
                //colocamos los botones
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    //método para extraer una categoría 
    public function getCategoria($idcategoria)
    {
        if ($_SESSION['permisosMod']['r']) { //comprobamos si el usuario tiene permisos de lectura
            $intIdcategoria = intval($idcategoria);
            if ($intIdcategoria > 0) {
                $arrData = $this->model->selectCategoria($intIdcategoria);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    //recuperamos la imagen poniendo la ruta donde está ubicada
                    $arrData['url_portada'] = media() . '/images/uploads/' . $arrData['portada'];
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    //método para eliminar una categoria
    public function delCategoria()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) { //comprobamos si el usuario tiene permiso de borrado
                $intIdcategoria = intval($_POST['idCategoria']);
                $requestDelete = $this->model->deleteCategoria($intIdcategoria); //llamos al controlador para que haga la consulta
                if ($requestDelete == 'ok') {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
                } else if ($requestDelete == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    //función que saca las categorías para el select productos
    public function getSelectCategorias()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectCategorias();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) { //recorremos el array
                if ($arrData[$i]['status'] == 1) { //solo nos va a mostrar las categorías activas
                    $htmlOptions .= '<option value="' . $arrData[$i]['idcategoria'] . '">' . $arrData[$i]['nombre'] . '</option>';
                }
            }
        }
        echo $htmlOptions; //devolvemos el resultado
        die();
    }
}
