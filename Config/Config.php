<?php

// define("BASE_URL", "http://localhost/tienda_virtual/");
const BASE_URL = "http://localhost/tienda_virtual";

//Zona horaria
date_default_timezone_set("Europe/Madrid");

//Datos de conexión a Base de datos
const DB_HOST = "localhost";
const DB_NAME = "db_tiendavirtual";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_CHARSET = "utf8";

//Delimitadores decimal y millar Ej. 24,1989.00
const SPD = ",";
const SPM = ".";

//Simbolo de la moneda
const SMONEY = "€";

//constante para las categorias del slider
const CAT_SLIDER = "1,2,3";

//constante para las categorias del banner
const CAT_BANNER = "1,2,3";

//Datos para Encriptar / Desencriptar
const KEY = 'cristina';
const METHODENCRIPT = "AES-128-ECB";

//constante para el precio de envio
const COSTOENVIO = 5;
