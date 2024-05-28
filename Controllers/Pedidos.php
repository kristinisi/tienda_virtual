<?php
class Pedidos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        if (empty($_SESSION['login'])) {
            header('Location: ' . base_url() . '/login');
            die();
        }
        getPermisos(MPEDIDOS); //5 Een MPEDIDOS(archivo config) porque el módulo pedidos tiene ese número
    }

    public function Pedidos()
    {
        //Si no tiene permiso de lectura se redirecciona a la página ppal
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        $data['page_tag'] = "Pedidos";
        $data['page_title'] = "PEDIDOS HANAKO";
        $data['page_name'] = "pedidos";
        $data['page_functions_js'] = "functions_pedidos.js";
        $this->views->getView($this, "pedidos", $data);
    }

    //Método que extrae todos los pedidos
    public function getPedidos()
    {
        if ($_SESSION['permisosMod']['r']) { //comprobamos si el usuario tiene permiso de lectura

            //necesitamos el id de la persona y el tol en caso de que sea el cliente para que solo se muestre sus pedidos y no todos
            $idpersona = "";
            if ($_SESSION['userData']['idrol'] == RCLIENTE) { //lo compara con el id del rol cliente
                $idpersona = $_SESSION['userData']['idpersona']; //guardamos el id de la persona
            }
            $arrData = $this->model->selectPedidos($idpersona); //hacemos la consulta
            // dep($arrData);
            //vamos a recorrer todo el array
            for ($i = 0; $i < count($arrData); $i++) {
                $btnView = '';
                $btnEdit = '';
                $btnDelete = '';

                //Damos formato al monto 
                $arrData[$i]['monto'] = formatMoney($arrData[$i]['monto']) . SMONEY;

                if ($_SESSION['permisosMod']['r']) { //comprobamos permisos de lectura
                    $btnView .= ' <a title="Ver Detalle" href="' . base_url() . '/pedidos/orden/' . $arrData[$i]['idpedido'] . '" target="_blanck" class="btn btn-info btn-sm"> <i class="far fa-eye"></i> </a>';
                }
                if ($_SESSION['permisosMod']['d']) { //comprobamos permisos de borrado
                    $btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelPedido(' . $arrData[$i]['idpedido'] . ')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
                }
                //ponemos los botones necesarios segun los permisos
                $arrData[$i]['options'] = '<div class="text-center">' . $btnView . ' ' . $btnEdit . ' ' . $btnDelete . '</div>';
            }
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE); //retornamos el resultado en formato json el array
        }
        die();
    }

    public function orden(int $idpedido)
    {
        if (empty($_SESSION['permisosMod']['r'])) {
            header("Location:" . base_url() . '/dashboard');
        }
        //sacamos el id de la persona si es un cliente
        $idpersona = "";
        if ($_SESSION['userData']['idrol'] == RCLIENTE) {
            $idpersona = $_SESSION['userData']['idpersona'];
        }

        $data['page_tag'] = "Pedido";
        $data['page_title'] = "PEDIDO HANAKO";
        $data['page_name'] = "pedido";
        $data['arrPedido'] = $this->model->selectPedido($idpedido, $idpersona);
        $this->views->getView($this, "orden", $data);
    }

    //método para eliminar un pedido
    public function delPedido()
    {
        if ($_POST) {
            if ($_SESSION['permisosMod']['d']) { //comprobamos si el usuario tiene permiso para eliminar 
                $intIdPedido = intval($_POST['idPedido']);
                $requestDelete = $this->model->deletePedido($intIdPedido); //llamamos al modelo para que haga la consulta
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
