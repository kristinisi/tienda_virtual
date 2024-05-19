<?php
require_once("Libraries/Core/Mysql.php");
trait TPedido
{
    private $con;
    private $intIdUsuario;
    private $strMonto;
    private $strDireccionEnvio;
    private $intPedidoId;
    private $intProductoId;
    private $strPecio;
    private $intCantidad;

    public function insertPedido(int $idusuario, string $monto, string $direccion)
    {
        $this->con = new Mysql();
        $this->intIdUsuario = $idusuario;
        $this->strMonto = $monto;
        $this->strDireccionEnvio = $direccion;

        $return = 0;

        $query_insert  = "INSERT INTO pedido(personaid,monto,direccion_envio) 
							  VALUES(?,?,?)";
        $arrData = array(
            $this->intIdUsuario,
            $this->strMonto,
            $this->strDireccionEnvio
        );
        $request_insert = $this->con->insert($query_insert, $arrData);
        $return = $request_insert;

        return $return;
    }

    public function insertDetPedido(int $pedido, int $producto, string $precio, int $cantidad)
    {
        $this->con = new Mysql();
        $this->intPedidoId = $pedido;
        $this->intProductoId = $producto;
        $this->strPecio = $precio;
        $this->intCantidad = $cantidad;

        $return = 0;

        $query_insert  = "INSERT INTO detalle_pedido(pedidoid,productoid,precio,cantidad) 
							  VALUES(?,?,?,?)";
        $arrData = array(
            $this->intPedidoId,
            $this->intProductoId,
            $this->strPecio,
            $this->intCantidad

        );
        $request_insert = $this->con->insert($query_insert, $arrData);
        $return = $request_insert;

        return $return;
    }
}
