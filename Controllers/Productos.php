<?php
class Productos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start(); //inicializamos la sesión
        if (empty($_SESSION['login'])) { //si la sesión no contiene nada nos redirige al login
            header('Location: ' . base_url() . '/login');
        }
        getPermisos(4); //ponemos el 4 porque es el id del módulo de productos
    }

    public function Productos()
    {
        if (empty($_SESSION['permisosMod']['r'])) { //vemos si el usuario tiene permiso de lectura
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag'] = "Productos";
        $data['page_title'] = "Productos HANAKO";
        $data['page_name'] = "productos";
        $data['page_functions_js'] = "functions_productos.js";
        $this->views->getView($this, "productos", $data);
    }

    //método que devuelve los productos para la datatable
    public function getProductos()
    {
        if ($_SESSION['permisosMod']['r']) { //comprobamos si el usuario tiene permiso de lectura
            $arrData = $this->model->selectProductos(); //hacemos la consulta
            //vamos a recorrer todo el array
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                //convertimos el status en texto con color
                if ($arrData[$i]['status'] == 1) {
                    $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
                } else {
                    $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
                }

                //DAMOS FORMATO AL PRECIO CON EL MÉTODO DEL HELPER Y LE COLOCAMOS LA CONSTANTE DEL CONFIG (€)
                $arrData[$i]['precio'] = formatMoney($arrData[$i]['precio']) . ' ' . SMONEY;

                if ($_SESSION['permisosMod']['r']) { //comprobamos permisos de lectura
                    $btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo(' . $arrData[$i]['idproducto'] . ')" title="Ver producto"><i class="far fa-eye"></i></button>';
                }
                if ($_SESSION['permisosMod']['u']) { //comprobamos permiso de actualización
                    $btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(' . $arrData[$i]['idproducto'] . ')" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>';
                }
                if ($_SESSION['permisosMod']['d']) { //comprobamos permisos de borrado
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo(' . $arrData[$i]['idproducto'] . ')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
                }
                //ponemos los botones necesarios segun los permisos
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE); //retornamos el resultado en formato json el array
        }
        die();
    }

    public function setProducto()
    {
        if ($_POST) {
            //validamos que los datos no vayan vacíos
            if (empty($_POST['txtNombre']) || empty($_POST['listCategoria']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {

                //guardamos los datos en las variables
                $idProducto = intval($_POST['idProducto']); //si no tiene ningún valo será 0
                $strNombre = strClean($_POST['txtNombre']);
                $strDescripcion = strClean($_POST['txtDescripcion']);
                $intCategoriaId = intval($_POST['listCategoria']);
                $strPrecio = strClean($_POST['txtPrecio']);
                $intStock = intval($_POST['txtStock']);
                $intStatus = intval($_POST['listStatus']);
                $request_producto = "";

                //si el idproducto es 0, significa que debemos crear el producto
                if ($idProducto == 0) {
                    $option = 1;
                    if ($_SESSION['permisosMod']['w']) { //comprobamos los permisos de usuario de escritura
                        $request_producto = $this->model->insertProducto( //vamos aal modelo a insertar el producto
                            $strNombre,
                            $strDescripcion,
                            $intCategoriaId,
                            $strPrecio,
                            $intStock,
                            $intStatus
                        );
                    }
                } else {
                    //actualizamos el producto
                    $option = 2;
                    if ($_SESSION['permisosMod']['u']) {
                        $request_producto = $this->model->updateProducto(
                            $idProducto,
                            $strNombre,
                            $strDescripcion,
                            $intCategoriaId,
                            $strPrecio,
                            $intStock,
                            $intStatus
                        );
                    }
                }
                if ($request_producto > 0) { //quiere decir que si se actualizó o se insertó
                    if ($option == 1) {
                        $arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
                    } else {
                        $arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
                    }
                } else if ($request_producto == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');
                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //función que muestra los datos de un producto
    public function getProducto($idproducto)
    {
        if ($_SESSION['permisosMod']['r']) {
            $idproducto = intval($idproducto);
            if ($idproducto > 0) {
                $arrData = $this->model->selectProducto($idproducto);
                if (empty($arrData)) {
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                } else {
                    $arrImg = $this->model->selectImages($idproducto);
                    if (count($arrImg) > 0) {
                        for ($i = 0; $i < count($arrImg); $i++) {
                            $arrImg[$i]['url_image'] = media() . '/images/uploads/' . $arrImg[$i]['img'];
                        }
                    }
                    $arrData['images'] = $arrImg;
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }

    //función para subir una imagen al servidor
    public function setImage()
    {
        // dep($_POST);
        // dep($_FILES);
        if ($_POST) {
            if (empty($_POST['idproducto'])) {
                $arrResponse = array('status' => false, 'msg' => 'Error de dato.');
            } else {
                $idProducto = intval($_POST['idproducto']);
                $foto      = $_FILES['foto'];
                $imgNombre = 'pro_' . md5(date('d-m-Y H:m:s')) . '.jpg';
                $request_image = $this->model->insertImage($idProducto, $imgNombre);
                if ($request_image) { //si nos retorna que se ha almacenado la foto
                    $uploadImage = uploadImage($foto, $imgNombre); //llamamos a la funcion del helper para subir la imagen a la carpeta del servidor
                    $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error de carga.');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //función para eliminar una imagen del servidor
    public function delFile()
    {
        if ($_POST) {
            if (empty($_POST['idproducto']) || empty($_POST['file'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                //Eliminar de la DB
                $idProducto = intval($_POST['idproducto']);
                $imgNombre  = strClean($_POST['file']);
                $request_image = $this->model->deleteImage($idProducto, $imgNombre);

                if ($request_image) {
                    $deleteFile =  deleteFile($imgNombre); //función del helper que elimina una imagen de la carpeta del servidor
                    $arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
                }
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //método para eliminar un producto
    public function delProducto()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) { //comprobamos si el usuario tiene permiso para eliminar 
                $intIdproducto = intval($_POST['idProducto']);
                $requestDelete = $this->model->deleteProducto($intIdproducto); //llamamos al modelo para que haga la consulta
                if ($requestDelete) {
                    $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
                } else {
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
