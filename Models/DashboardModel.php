<?php

class DashboardModel extends Mysql
{
    public function __construct()
    {
        //cargamos el método constructor de la clase padre
        parent::__construct();
    }

    public function cantUsuarios()
    {
        $sql = "SELECT COUNT(*) as total FROM persona WHERE status != 0";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }

    public function cantCategorias()
    {
        $sql = "SELECT COUNT(*) as total FROM categoria WHERE status != 0";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }

    public function cantProductos()
    {
        $sql = "SELECT COUNT(*) as total FROM producto WHERE status != 0 ";
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }

    public function cantPedidos()
    {
        //Hacemos la comprobación de que si es un cliente el que setá en el dashboard se muestre solo sus pedidos
        $rolid = $_SESSION['userData']['idrol'];
        $idUser = $_SESSION['userData']['idpersona'];
        $where = "";
        if ($rolid == RCLIENTE) {
            $where = " WHERE personaid = " . $idUser;
        }

        $sql = "SELECT COUNT(*) as total FROM pedido " . $where;
        $request = $this->select($sql);
        $total = $request['total'];
        return $total;
    }
}
