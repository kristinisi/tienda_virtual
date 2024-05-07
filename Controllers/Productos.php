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
}
