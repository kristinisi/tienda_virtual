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

//Genera un token (lo vamos usar para reestablecer contraseñas)
function token()
{
    $r1 = bin2hex(random_bytes(10));
    $r2 = bin2hex(random_bytes(10));
    $r3 = bin2hex(random_bytes(10));
    $r4 = bin2hex(random_bytes(10));
    $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
    return $token;
}

//Formato para valores monenarios
function formatMoney($cantidad)
{
    $cantidad = number_format($cantidad, 2, SPD, SPM);
    return $cantidad;
}
