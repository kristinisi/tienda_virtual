<?php

class Roles extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function roles($parems)
    {
        //invocamos la vista para la página principal
        $data['page_id'] = 3;
        $data['page_tag'] = "Roles Usuario HANAKO";
        $data['page_title'] = "Roles Usuario HANAKO";
        $data['page_name'] = "rol_usuario";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "roles", $data);
    }

    //Creamos el método para listar los roles
    public function getRoles()
    {
        $arrData = $this->model->selectRoles();

        //Recorremos el array sustituyendo los números  por los elementos de boostrap 
        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }
            // El atributo rl: accedemos al item id del rol en cada posición
            $arrData[$i]['options'] = '<div class="text-center">
            <button class="btn btn-info btn-sm btnPermisosRol" rl="' . $arrData[$i]['idrol'] . '" title="Permisos"><i class="fa-solid fa-key"></i></i></button>
            <button class="btn btn-primary btn-sm btnEditRol" rl="' . $arrData[$i]['idrol'] . '" title="Editar"><i class="fa-solid fa-pencil"></i></button>
            <button class="btn btn-danger btn-sm btnDelRol" rl="' . $arrData[$i]['idrol'] . '" title="Eliminar"><i class="fa-solid fa-x"></i></button>
                                        </div>';
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE); //pasamos el array a formato JSON
        die(); //el die() finaliza el proceso
    }

    //función qu saca los roles para un selet
    public function getSelectRoles()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectRoles();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['idrol'] . '">' . $arrData[$i]['nombrerol'] . '</option>';
            }
        }
        echo $htmlOptions; //retorna la variable
        die();
    }

    //Creamos el método para listar un rol
    public function getRol(int $idrol)
    {
        $intIdrol = intval(strClean($idrol)); //convertimos y limpiamos la variable

        if ($intIdrol > 0) { //si el id es válido
            $arrData = $this->model->selectRol($intIdrol);
            if (empty($arrData)) { //si está vacía la variable
                $arrResponse = array("status" => false, "msg" => "Datos no encontrados");
            } else {
                $arrResponse = array("status" => true, "data" => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE); //pasamos el array a formato JSON
        }
        die(); //el die() finaliza el proceso
    }

    //Enviar los datos a mysql mediante ajax
    public function setRol()
    {
        // nos creamos las variables para poder almacenar los datos que estamos recibiendo
        $intIdRol = intval($_POST['idRol']); //Convertimos en entero el id
        $strRol = strclean($_POST['txtNombre']);
        $strDescripcion = strclean($_POST['txtDescripcion']); // Cambiado textDescripcion a txtDescripcion
        $intStatus = intval($_POST['listStatus']); // Cambiado intStatus a listStatus

        if ($intIdRol == 0) {
            //crear
            $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
            $option = 1;
        } else {
            //actualizar
            $request_rol = $this->model->updateRol($intIdRol, $strRol, $strDescripcion, $intStatus);
            $option = 2;
        }

        // Validamos los datos
        if ($request_rol > 0) {
            if ($option == 1) {
                $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.'); // armamos un array con el elemento status que va a retornar un mensaje
            } else {
                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
            }
        } else if ($request_rol == 'exist') {
            $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
        }
        // retornamos el array en formato JSON
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die(); // cerramos el proceso
    }

    public function delRol()
    {
        if ($_POST) {
            $intIdrol = intval($_POST['idrol']);
            $requestDelete = $this->model->deleteRol($intIdrol);
            if ($requestDelete == "ok") {
                $arrResponse = array("status" => true, "msg" => "Se ha eliminado el Rol");
            } else if ($requestDelete == "exist") {
                $arrResponse = array("status" => true, "msg" => "No es posible eliminar un Rol asociado a usuarios.");
            } else {
                $arrResponse = array("status" => true, "msg" => "Error al eliminar el Rol.");
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
