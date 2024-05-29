<?php

// define("BASE_URL", "http://localhost/tienda_virtual/");
// const BASE_URL = "http://localhost/tienda_virtual";
const BASE_URL = "https://hanakoo.000webhostapp.com/";

//Zona horaria
date_default_timezone_set("Europe/Madrid");

//Datos de conexión a Base de datos
const DB_HOST = "localhost";
// const DB_NAME = "db_tiendavirtual";
const DB_NAME = "id22095824_tienda_virtual";
// const DB_USER = "root";
const DB_USER = "id22095824_kristinisi";
// const DB_PASSWORD = "";
const DB_PASSWORD = "Kristinisi11@";
const DB_CHARSET = "utf8";

//Datos de la empresa
const NOMBRE_EMPRESA = "HANAKO";
const DIRECCION = "Plaza San Francisco, Local 1";
const TELEMPRESA = "9268878563";
const EMAIL_EMPRESA = "hanako@info.com";

//Delimitadores decimal y millar Ej. 24,1989.00
const SPD = ",";
const SPM = ".";

//Simbolo de la moneda
const SMONEY = "€";

//constante para las categorias del slider
const CAT_SLIDER = "4,5,6";

//constante para las categorias del banner
const CAT_BANNER = "4,5,6,7,8,9";

//constante para las categorias del footer
// const CAT_FOOTER = "1,2,3,4,5,6";

//Datos para Encriptar / Desencriptar
const KEY = 'cristina';
const METHODENCRIPT = "AES-128-ECB";

//constante para el precio de envio
const COSTOENVIO = 5;

//constantes para módulos
const MDASHBOARD = 1;
const MUSUARIOS = 2;
const MPRODUCTOS = 4;
const MPEDIDOS = 5;
const MCATEGORIAS = 6;


//constantes para roles
const RADMINISTRADOR = 1;
const RCLIENTE = 2;


//Constante para mostrar el limite de productos a mostrar por página
const CANTPORHOME = 4;
const PROPORPAGINA = 8;
