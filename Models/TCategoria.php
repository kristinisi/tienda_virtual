<!-- TRAIT CATEGORIA -->
<?php
require_once("Libraries/Core/Mysql.php"); //archivo que hace el crud en nuestra bbdd
trait TCategoria
{
    private $con;

    public function getCategoriasT(string $categorias) //son las categorias que se van a mostrar en el slider
    {
        $this->con = new Mysql(); //creamos el objeto mysql

        $sql = "SELECT idcategoria, nombre, descripcion, portada FROM categoria WHERE idcategoria IN ($categorias)"; //extraer varias categorias
        $request = $this->con->select_all($sql);
        if (count($request) > 0) {
            for ($i = 0; $i < count($request); $i++) {
                $request[$i]['portada'] = BASE_URL . "/Assets/images/uploads/" . $request[$i]["portada"];
            }
        }
        return $request;
    }
}
?>