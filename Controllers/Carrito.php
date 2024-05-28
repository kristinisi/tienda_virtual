<?php
class Carrito extends Controllers
{
    // use TCategoria, TProducto, TTipoPago, TCliente;
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function carrito()
    {
        $data['page_tag'] = "HANAKO";
        $data['page_title'] = 'Carrito de compras';
        $data['page_name'] = "carrito";
        $this->views->getView($this, "carrito", $data);
    }

    public function procesarpago()
    {
        //evitar mostrar el procesar pago si no tenemos nada en el carrito
        if (empty($_SESSION['arrCarrito'])) {
            header("Location: " . base_url());
            die();
        }
        $data['page_tag'] = 'HANAKO';
        $data['page_title'] = 'Procesar Pago';
        $data['page_name'] = "procesarpago";

        $this->views->getView($this, "procesarpago", $data);
    }
}
