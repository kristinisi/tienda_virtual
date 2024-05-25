<?php
class PedidosModel extends Mysql
{

    private $intIdPedido;

    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
    }

    public function selectPedidos($idpersona = null)
    {
        //validamos si el idpersona viene vacío o no para saber que datos debemos obtener si todos o solo los de la persona
        $where = "";
        if ($idpersona != null) {
            $where = " WHERE personaid = " . $idpersona;
        }
        $sql = "SELECT idpedido, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha, monto 
                FROM pedido $where";

        $request = $this->select_all($sql);
        return $request;
    }

    public function selectPedido(int $idpedido, $idpersona = NULL)
    {
        $busqueda = "";
        if ($idpersona != NULL) {
            $busqueda = " AND personaid =" . $idpersona;
        }
        $request = array();
        $sql = "SELECT idpedido,
                        personaid,
                        DATE_FORMAT(fecha, '%d/%m/%Y') as fecha,
                        monto,
                        direccion_envio
                FROM pedido WHERE idpedido =  $idpedido " . $busqueda;
        $requestPedido = $this->select($sql);

        //sacamos los datos de la persona que ha hecho ese pedido
        if (!empty($requestPedido)) {
            $idpersona = $requestPedido['personaid'];
            $sql_cliente = "SELECT idpersona,
                                    nombre,
                                    apellidos,
                                    telefono,
                                    email_user
                            FROM persona WHERE idpersona = $idpersona ";
            $requestcliente = $this->select($sql_cliente);

            //sacamos los datos de los productos de ese pedido
            $sql_detalle = "SELECT p.idproducto,
                                        p.nombre as producto,
                                        d.precio,
                                        d.cantidad
                                FROM detalle_pedido d
                                INNER JOIN producto p
                                ON d.productoid = p.idproducto
                                WHERE d.pedidoid = $idpedido";
            $requestProductos = $this->select_all($sql_detalle);
            $request = array(
                'cliente' => $requestcliente,
                'orden' => $requestPedido,
                'detalle' => $requestProductos
            );
        }
        return $request;
    }

    //método que elimina un producto de la base de datos
    public function deletePedido(int $idpedido)
    {
        $this->intIdPedido = $idpedido;
        $sql = "DELETE FROM pedido WHERE idpedido = $this->intIdPedido ";
        $request = $this->delete($sql);
        return $request;
    }
}
