<?php

class Permisos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPermisosRol(int $idrol)
    {
        $rolid = intval($idrol);
        if ($rolid > 0) {
            $arrModulos = $this->model->selectModulos();
            $arrPermisosRol = $this->model->selectPermisosRol($rolid);
            $arrPermisos = array("r" => 0, "w" => 0, "u" => 0, "d" => 0);
            $arrPermisoRol = array("idrol" => $rolid);

            //si no tiene permisos el rol
            if (empty($arrPermisosRol)) {
                for ($i = 0; $i < count($arrModulos); $i++) {
                    //a cada modulo se le añaden unos permisos por defecto a 0
                    $arrModulos[$i]["permisos"] = $arrPermisos;
                }
            } else {
                //si ya tiene permisos el rol
                for ($i = 0; $i < count($arrModulos); $i++) {
                    //le asignamos como valor al array lo que va a tener en la posición de cada uno de los permisos modulo
                    $arrPermisos = array(
                        "r" => $arrPermisosRol[$i]["r"],
                        "w" => $arrPermisosRol[$i]["w"],
                        "u" => $arrPermisosRol[$i]["u"],
                        "d" => $arrPermisosRol[$i]["d"],
                    );

                    //si coinciden los ids tanto como el de modulo como el de los permisos
                    if ($arrModulos[$i]["idmodulo"] == $arrPermisosRol[$i]["moduloid"]) {
                        $arrModulos[$i]["permisos"] = $arrPermisos; //le damos los valores del array permisos
                    }
                }
            }
            $arrPermisoRol["modulos"] = $arrModulos; //introducimos los modulos al array
            $html = getModal("modalPermisos", $arrPermisoRol); //llamamos al modal roles con el array y lo guardamos en la variable html
            // dep($arrPermisoRol);
        }
        die();
    }

    //Funcion que moodifica los permisos
    public function setPermisos()
    {
        if ($_POST) { //validamos si estamos enviando la información a través del método post
            $intIdrol = intval($_POST['idrol']); //obtenemos el id
            $modulos = $_POST['modulos']; //obtenemos los modulos

            $this->model->deletePermisos($intIdrol); //borramos los permisos del rol primero
            foreach ($modulos as $modulo) { //recorremos todos loselementos del array
                $idModulo = $modulo['idmodulo'];
                $r = empty($modulo['r']) ? 0 : 1;
                $w = empty($modulo['w']) ? 0 : 1;
                $u = empty($modulo['u']) ? 0 : 1;
                $d = empty($modulo['d']) ? 0 : 1;
                $requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d); //enviamos los parametros necesarios a la funcion para insertar permisos
            }
            if ($requestPermiso > 0) {
                $arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'No es posible asignar los permisos.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
