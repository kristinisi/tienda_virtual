<?php

class Usuarios extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Usuarios($parems)
    {
        //invocamos la vista para la página principal
        $data['page_tag'] = "Usuarios HANAKO";
        $data['page_title'] = "Usuarios HANAKO";
        $data['page_name'] = "usuarios";
        //hacemos el llamado a la vista que queremos mostrar mandandole como parámetro el array 
        $this->views->getView($this, "usuarios", $data);
    }

    //método que invocamos desde function_js
    public function setUsuario()
    {
        if ($_POST) {
            //si no existe algún valor...
            if (empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus'])) {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.'); //retornamos el array en caso de que falte algún campo
            } else {
                //creamos las variables de los datos que estamos recibiendo
                // $idUsuario = intval($_POST['idUsuario']);
                $strIdentificacion = strClean($_POST['txtIdentificacion']);
                //usamos ucwords para poner las letras en mayúsculas de cada palabra
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strApellido = ucwords(strClean($_POST['txtApellido']));
                $intTelefono = strClean($_POST['txtTelefono']);
                //strtolower convierte todas las letras en minúsculas
                $strEmail = strtolower(strClean($_POST['txtEmail']));
                $intTipoId = intval(strClean($_POST['listRolid']));
                $intStatus = intval(strClean($_POST['listStatus']));

                //con el hash SHA256 encriptamos la contraseña
                //se debe guardar con 64 caracteres(pero de damos más en la bbdd varchar por si acaso)
                $strPassword =  hash("SHA256", $_POST['txtPassword']);
                $request_user = $this->model->insertUsuario(
                    $strIdentificacion,
                    $strNombre,
                    $strApellido,
                    $intTelefono,
                    $strEmail,
                    $strPassword,
                    $intTipoId,
                    $intStatus
                );

                //si la variable es mayor a 0 quiere decir que si se ingresó el registro
                if ($request_user > 0) {
                    $arrResponse = array("status" => true, "msg" => 'Datos guardados correctamente.'); //retornamos el array en caso de que falte algún campo

                } else if ($request_user == "exist") {
                    $arrResponse = array("status" => false, "msg" => 'El email o identificación ya existe, ingrese otro.'); //retornamos el array en caso de que falte algún campo

                } else {
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.'); //retornamos el array en caso de que falte algún campo
                }
            }
            //retornamos la fución en formato json para function_usuarios.js 
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    //Invocamos al método del controlador para obtener los usuarios y llevarlos a la página
    public function getUsuarios()
    {
        $arrData = $this->model->selectUsuarios(); //invocamos al método del modelo
        //recorremos el array de datos
        for ($i = 0; $i < count($arrData); $i++) {

            //si status de i es 1 sustituimos el 1 por el espan deseado sino por el otro de inactivo
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            //Le agregamos el elemento options donde tenemos los botones para modificar y eliminar los usuarios
            $arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-info btn-sm btnViewUsuario" us="' . $arrData[$i]['idpersona'] . '" title="Ver usuario"><i class="fa-solid fa-eye"></i></i></button>
				<button class="btn btn-primary  btn-sm btnEditUsuario" us="' . $arrData[$i]['idpersona'] . '" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelUsuario" us="' . $arrData[$i]['idpersona'] . '" title="Eliminar usuario"><i class="far fa-trash-alt"></i></button>
				</div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE); //devolvemos la información en formato json
        die();
    }

    //Métododo paraextraer los datos de un usuario
    public function getUsuario(int $idpersona)
    {

        $idusuario = intval($idpersona);
        if ($idusuario > 0) {
            $arrData = $this->model->selectUsuario($idusuario);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
