<?php
//Retornar la url del proyecto
function base_url()
{
    return BASE_URL;
}

//Retorna la URL Assets
function media()
{
    return BASE_URL . "/Assets";
}

//Retorna la URL del header del admin
function headerAdmin($data = "")
{
    $view_header = "./Views/Template/header_admin.php";
    require_once($view_header);
}

//Retorna la URL del footer del admin
function footerAdmin($data = "")
{
    $view_footer = "./Views/Template/footer_admin.php";
    require_once($view_footer);
}

//Retorna la URL del header del tienda
function headerTienda($data = "")
{
    $view_header = "./Views/Template/header_tienda.php";
    require_once($view_header);
}

//Retorna la URL del footer del tienda
function footerTienda($data = "")
{
    $view_footer = "./Views/Template/footer_tienda.php";
    require_once($view_footer);
}

//Muestra información formateada (para ver mejor los arrays)
function dep($data)
{
    $format = print_r("<pre>");
    $format .= print_r($data);
    $format .= print_r("</pre>");
    return $format;
}

//Retorna la URL del modal pasado por parámetro
function getModal(string $nameModal, $data)
{
    $view_modal = "./Views/Template/Modals/{$nameModal}.php";
    require_once($view_modal);
}

//obtener un archivo
function getFile(string $url, $data)
{
    ob_start(); //significa que vamos a almacenar en buffer el archivo de la linea de abajo para poder utilizarlo
    require_once("Views/{$url}.php"); //requerimos el modal del carrito
    $file = ob_get_clean(); //esta función lo que hace es levantar el archivo para tenerlo en buffer y así poder utilizar variables que se envían como parámetro($data) y luego lo limpia
    return $file; //retorna el archivo
}

function getPermisos(int $idmodulo)
{
    require_once("Models/PermisosModel.php"); //requerimos el model permisos
    $objPermisos = new PermisosModel();
    $idrol = $_SESSION['userData']['idrol']; //obtenemos el id del rol con el cual estamos logueados
    $arrPermisos = $objPermisos->permisosModulo($idrol);
    $permisos = ''; //aqui almacenamos todos los modulos del rol
    $permisosMod = ''; //vamos a almacenar todos los permisos del modulo donde nos encontramos
    if (count($arrPermisos) > 0) { //si el array tiene registros
        $permisos = $arrPermisos;
        //si existe en la posicion del array lo que hemos enviado como parámetro introduce los datos sino lo deja vacio
        $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo] : "";
    }
    //Creamos las variables de sesión donde colocamos los arrays
    $_SESSION['permisos'] = $permisos;
    $_SESSION['permisosMod'] = $permisosMod;
}

//Método que se conecta con LogingModel para poder acceder a la información de una persona a través de un id
function sessionUser(int $idpersona)
{
    require_once("Models/LoginModel.php"); //Requerimos el archivo LoginModel para poder crearnos un nuevo objeto de login
    $objLogin = new LoginModel(); //al tener creado el objeto pordemos usar todos los métodos del archivo
    $request = $objLogin->sessionLogin($idpersona); //hacemos entramos a la sesión con el id de la persona que estamos recibiendo
    return $request; //retornamos la información de la persona
}

//Método que recibe el array con los datos de la foto y el nombre de la imagen 
//guardamos la imagen en la carpeta
function uploadImage(array $data, string $name)
{
    $url_temp = $data['tmp_name']; //accedemos a la ruta temporal 
    $destino    = 'Assets/images/uploads/' . $name; //ruta donde vamos a colocar la imagen con el nombre
    $move = move_uploaded_file($url_temp, $destino); //reccibe la ruta temporal y la ruta destino para mover la imagen
    return $move;
}

//eliminamos la imagen del directorio donde se encuentra por su nombre como parámetro
function deleteFile(string $name)
{
    unlink('Assets/images/uploads/' . $name);
}

//Elimina exceso de espacios entre palabras - evita las inyecciones sql en nuestros formularios
function strClean($strCadena)
{
    $string = preg_replace(['/\s+/', '/^\s|\s$/'], [' ', ''], $strCadena); //limpia el exceso de espacios entre palabras
    $string = trim($string); //Elimina espacios en blanco al inicio y al final
    $string = stripslashes($string); //Elimina las  \ invertidas
    $string = str_ireplace("<script>", "", $string);
    $string = str_ireplace("</script>", "", $string);
    $string = str_ireplace("<script src>", "", $string);
    $string = str_ireplace("<script type=>", "", $string);
    $string = str_ireplace("SELECT * FROM", "", $string);
    $string = str_ireplace("DELETE FROM", "", $string);
    $string = str_ireplace("INSERT INTO", "", $string);
    $string = str_ireplace("SELECT COUNT(*) FROM", "", $string);
    $string = str_ireplace("DROP TABLE", "", $string);
    $string = str_ireplace("OR '1'='1", "", $string);
    $string = str_ireplace('OR "1"="1"', "", $string);
    $string = str_ireplace('OR ´1´=´1´', "", $string);
    $string = str_ireplace("is NULL; --", "", $string);
    $string = str_ireplace("LIKE '", "", $string);
    $string = str_ireplace('LIKE "', "", $string);
    $string = str_ireplace("LIKE ´", "", $string);
    $string = str_ireplace("OR 'a'='a", "", $string);
    $string = str_ireplace('OR "a"="a', "", $string);
    $string = str_ireplace("OR ´a´=´a", "", $string);
    $string = str_ireplace("--", "", $string);
    $string = str_ireplace("^", "", $string);
    $string = str_ireplace("[", "", $string);
    $string = str_ireplace("]", "", $string);
    $string = str_ireplace("==", "", $string);
    return $string;
}

//función para quitar las tildes
function clear_cadena(string $cadena)
{
    //Reemplazamos la A y a
    $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena
    );

    //Reemplazamos la I y i
    $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena
    );

    //Reemplazamos la O y o
    $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena
    );

    //Reemplazamos la U y u
    $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena
    );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
        array('Ñ', 'ñ', 'Ç', 'ç', ',', '.', ';', ':'),
        array('N', 'n', 'C', 'c', '', '', '', ''),
        $cadena
    );
    return $cadena;
}

//Genera una cotraseña de 10 caracteres
function passGenerator($length = 10)
{
    // $pass = "";
    // $longitudPass = $length;
    // $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxy1234567890";
    // $longitudCadena = strlen($cadena);

    // for ($i = 1; $i <= $longitudPass; $i++) {
    //     $pos = rand(0, $longitudCadena - 1);
    //     $pass .= substr($cadena, $pos, 1);
    // }
    $pass = "123456";
    return $pass;
}

//Formato para valores monenarios
function formatMoney($cantidad)
{
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}

function getCatFooter()
{
    require_once("Models/CategoriasModel.php");
    $objCategoria = new CategoriasModel();
    $request = $objCategoria->getCategoriasFooter();
    return $request;
}
