<?php
require_once("Models/TCategoria.php"); //para poder usar los métodos de TCategoria
require_once("Models/TProducto.php"); //para poder usar los métodos de TProducto
require_once("Models/TCliente.php"); //para poder usar los métodos de TCliente
require_once("Models/TPedido.php"); //para poder usar los métodos de TPedido
require_once("Models/LoginModel.php"); //para poder usar los métodos de LoginModel
class Tienda extends Controllers
{
    //para hacer uso de los trait debemos colocar:
    use TCategoria, TProducto, TCliente, TPedido;
    public $login;
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->login = new LoginModel();
    }

    //fución para la vista de la tienda
    public function tienda($parems)
    {
        //invocamos la vista para la página principal
        $data['page_tag'] = "HANAKO";
        $data['page_title'] = "Tienda virtual";
        $data['page_name'] = "tienda";
        $data['productos'] = $this->getProductosT();

        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "tienda", $data);
    }

    //fucnión para la vista de los productos de la categoría
    public function categoria($params)
    {
        if (empty($params)) {
            header("Location:" . base_url()); //si no se han encontrado elementos redireccionamos a la página principal
        } else {

            $arrParams = explode(",", $params); //convertimos a un array los parametros
            $idCategoria = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoCategoria = $this->getProductosCategoriaT($idCategoria, $ruta);

            $data['page_tag'] = "HANAKO | " . $infoCategoria['categoria'];
            $data['page_title'] = $infoCategoria['categoria'];
            $data['page_name'] = "categoria";
            $data['productos'] = $infoCategoria['productos'];
            $this->views->getView($this, "categoria", $data);
        }
    }

    //función para la vista del detalle del producto
    public function producto($params)
    {
        if (empty($params)) {
            header("Location:" . base_url()); //si no se han encontrado elementos redireccionamos a la página principal
        } else {

            $arrParams = explode(",", $params); //convertimos a un array los parametros
            $idProducto = intval($arrParams[0]);
            $ruta = strClean($arrParams[1]);
            $infoProducto = $this->getProductoT($idProducto, $ruta);

            if (empty($infoProducto)) {
                header("Location:" . base_url());
            }


            $data['page_tag'] = "HANAKO | " . $infoProducto['nombre'];
            $data['page_title'] = $infoProducto['nombre'];
            $data['page_name'] = "producto";
            $data['producto'] =  $infoProducto; //ya tenemos los datos del producto
            $data['productos'] = $this->getProductosRandomT($infoProducto['categoriaid'], 4, "r"); //obtenemos los productos de la categoria(para mostrarlos como sugerencia) y necesitamos 4, y la r significa que vamos a sacar los productos de forma aleatoria
            $this->views->getView($this, "producto", $data);
        }
    }

    //función para añadir al carrito
    public function addCarrito()
    {
        if ($_POST) {
            // unset($_SESSION['arrCarrito']);
            $arrCarrito = array(); //array para agregar cosas al carrito
            $cantCarrito = 0; // la cantidad del carrito va a ser 0 por defecto
            $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY); //Desencriptamos el id
            $cantidad = $_POST['cant']; //guardamos en una variable la cantidad del producto

            if (is_numeric($idproducto) and is_numeric($cantidad)) {
                //si se cumple la condición los datos del producto
                $arrInfoProducto = $this->getProductoIDT($idproducto); //extraemos el producto por medio del ID
                if (!empty($arrInfoProducto)) { //si no está vaciio recuperamos los datos
                    $arrProducto = array(
                        'idproducto' => $idproducto,
                        'producto' => $arrInfoProducto['nombre'],
                        'cantidad' => $cantidad,
                        'precio' => $arrInfoProducto['precio'],
                        'imagen' => $arrInfoProducto['images'][0]['url_image']
                    );
                    //comprobamos si tenemos una variable de sesión iniciada
                    if (isset($_SESSION['arrCarrito'])) {
                        //si existe, va a vereficar si el prodcuto que estamos enviando ya existe
                        $on = true; //para agregar al carrito 
                        $arrCarrito = $_SESSION['arrCarrito'];

                        //recorremos el array
                        for ($i = 0; $i < count($arrCarrito); $i++) {
                            if ($arrCarrito[$i]['idproducto'] == $idproducto) { //si el producto ya se encuentra en el carrito
                                $arrCarrito[$i]['cantidad'] += $cantidad; //actualizamos la cantidad del producto
                                $on = false; //para no agregar al carrito y solo actualizar la cantidad
                            }
                        }
                        if ($on) {
                            array_push($arrCarrito, $arrProducto); //si es on agregamos al carrito el producto
                        }
                        $_SESSION['arrCarrito'] = $arrCarrito;
                    } else {
                        array_push($arrCarrito, $arrProducto); //agregamos el elemento al array
                        $_SESSION['arrCarrito'] = $arrCarrito; //creamos la variable de sesión con el primer producto
                    }

                    //ATENCION! PARA MOSTRAR PRODUCTOS EN EL MODAL
                    // recorremos del array del carrito que sacará cada producto
                    foreach ($_SESSION['arrCarrito'] as $pro) {
                        //se va a mostrar la cantidad en el icono del carrito
                        $cantCarrito += $pro['cantidad']; //se va sumando la cantidad de productos para sacar el total
                    }
                    $htmlCarrito = "";
                    //extraemos el archivo - primero recibe la ruta del archivo y luego los datos(función en el helper)
                    //archivo modal del carrito
                    $htmlCarrito = getFile('Template/Modals/modalCarrito', $_SESSION['arrCarrito']);
                    $arrResponse = array(
                        "status" => true,
                        "msg" => '¡Se agrego al carrito!',
                        "cantCarrito" => $cantCarrito,
                        "htmlCarrito" => $htmlCarrito
                    );
                } else {
                    $arrResponse = array("status" => false, "msg" => 'Producto no existente.');
                }
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); //convertimos a formato json el array
        }
        die();
    }

    public function delCarrito()
    {
        if ($_POST) {
            $arrCarrito = array(); //array de los elementos del carrito
            $cantCarrito = 0;
            $subtotal = 0;
            $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY); //desencriptamos el id
            $option = $_POST['option'];
            if (is_numeric($idproducto) and ($option == 1 or $option == 2)) {
                $arrCarrito = $_SESSION['arrCarrito'];
                for ($i = 0; $i < count($arrCarrito); $i++) {
                    //si el producto coincide con el id lo eliminamos del array
                    if ($arrCarrito[$i]['idproducto'] == $idproducto) {
                        unset($arrCarrito[$i]);
                    }
                }
                sort($arrCarrito); //ordenamos el array
                $_SESSION['arrCarrito'] = $arrCarrito;
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $cantCarrito += $pro['cantidad'];
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }

                $htmlCarrito = "";
                if ($option == 1) {
                    $htmlCarrito = getFile('Template/Modals/modalCarrito', $_SESSION['arrCarrito']);
                }
                $arrResponse = array(
                    "status" => true,
                    "msg" => '¡Producto eliminado!',
                    "cantCarrito" => $cantCarrito,
                    "htmlCarrito" => $htmlCarrito,
                    "subTotal" => formatMoney($subtotal) . SMONEY,
                    "total" => formatMoney($subtotal + COSTOENVIO) . SMONEY
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); //devolvemos la informacion al archivo de funciones
        }
        die();
    }

    public function updCarrito()
    {
        if ($_POST) {
            $arrCarrito = array(); //donde vamos a tener todos los productos del carrito
            $totalProducto = 0; //producto
            $subtotal = 0; //del producto
            $total = 0; //general
            $idproducto = openssl_decrypt($_POST['id'], METHODENCRIPT, KEY); //desencriptamos el id del producto para poder trabajar con el 
            $cantidad = intval($_POST['cantidad']);

            if (is_numeric($idproducto) and $cantidad > 0) {
                $arrCarrito = $_SESSION['arrCarrito'];
                //recorremos el array
                for ($i = 0; $i < count($arrCarrito); $i++) {
                    if ($arrCarrito[$i]['idproducto'] == $idproducto) {
                        $arrCarrito[$i]['cantidad'] = $cantidad;
                        $totalProducto = $arrCarrito[$i]['precio'] * $cantidad; //sacamos el total de ese producto
                        break;
                    }
                }
                $_SESSION['arrCarrito'] = $arrCarrito; //igualamos la sesion al array que ya tiene los datos actualizados
                //sacamos el subtotal (que será el total de todos los produtctos)    
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $subtotal += $pro['cantidad'] * $pro['precio'];
                }
                $arrResponse = array(
                    "status" => true,
                    "msg" => '¡Producto actualizado!',
                    "totalProducto" => formatMoney($totalProducto) . SMONEY,
                    "subTotal" => formatMoney($subtotal) . SMONEY,
                    "total" => formatMoney($subtotal + COSTOENVIO) . SMONEY
                );
            } else {
                $arrResponse = array("status" => false, "msg" => 'Dato incorrecto.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //Función para el registro de un cliente desde la vista tienda
    public function registro()
    {
        error_reporting(0);
        if ($_POST) {
            // dep($_POST);
            if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmailCliente']) || empty($_POST['txtPasswordCliente'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            } else {
                $strIdentificacion = strClean($_POST['txtIdentificacion']);
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strApellido = ucwords(strClean($_POST['txtApellido']));
                $intTelefono = intval(strClean($_POST['txtTelefono']));
                $strEmail = strtolower(strClean($_POST['txtEmailCliente']));
                $strPassword = $_POST['txtPasswordCliente'];
                $intTipoId = 2; //colocamos 2 porque el rol del tipo usuario es el 2
                $request_user = "";

                //encriptamos la constraseña
                $strPasswordEncript = hash("SHA256", $strPassword);
                //vmos a enviar al trait cliente los datos para hacer la inserción
                $request_user = $this->insertCliente(
                    $strIdentificacion,
                    $strNombre,
                    $strApellido,
                    $intTelefono,
                    $strEmail,
                    $strPasswordEncript,
                    $intTipoId
                );

                // echo $request_user;

                //verificamos si el usuario se guardo correctamente en la base de datos
                if ($request_user == 'exist') {
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! el email ya existe, ingrese otro.');
                } else if ($request_user > 0) {
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    $_SESSION['idUser'] = $request_user;
                    $_SESSION['login'] = true;
                    $this->login->sessionLogin($request_user); //enviamos como parámetro el id del cliente y crear la variable de sesión  

                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            // dep($arrResponse);
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
    //Función para el registro de de un pedido
    public function registroPedido()
    {
        error_reporting(0);
        if ($_POST) {
            $subtotal = 0;
            //sacamos el subtotal (que será el total de todos los produtctos)    
            foreach ($_SESSION['arrCarrito'] as $pro) {
                $subtotal += $pro['cantidad'] * $pro['precio'];
            }
            $total = $subtotal + COSTOENVIO;

            $intIdUsuario = intval($_SESSION['idUser']);
            $strMonto = $total;
            $strDireccion = strClean($_POST['txtDireccion'] . " " . $_POST['txtCiudad']);

            $request = $this->insertPedido(
                $intIdUsuario,
                $strMonto,
                $strDireccion
            );

            //verificamos si el usuario se guardo correctamente en la base de datos
            if ($request > 0) {
                //hacemos el detalle del pedido
                foreach ($_SESSION['arrCarrito'] as $pro) {
                    $productoId = $pro['idproducto'];
                    $precio = $pro['precio'];
                    $cantidad = $pro['cantidad'];

                    $this->insertDetPedido(
                        $request,
                        $productoId,
                        $precio,
                        $cantidad
                    );
                }

                $arrResponse = array('status' => true, 'msg' => 'Pedido hecho correctamente.');
                unset($_SESSION['arrCarrito']); //eliminamos el carrito
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible hacer el pedido.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
