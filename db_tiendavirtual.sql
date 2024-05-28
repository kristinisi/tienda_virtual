-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 17:07:35
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tiendavirtual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `portada` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(4, 'Ramos de novia', 'Elige el ramo de novia perfecto para tu gran día.', 'img_5db2aaa12e77bbe1d59b75074318b193.jpg', '2024-05-25 17:44:20', 'ramos-de-novia', 1),
(5, 'Ramos de rosas', 'Una gran variedad de rosas para elegir y no equivocarse.', 'img_3c7883c7fcc326256df03a368591f9e7.jpg', '2024-05-25 17:45:46', 'ramos-de-rosas', 1),
(6, 'Ramos de flores', 'Llena de color tus estancias con unas bonitas flores.', 'img_4c0a4f8a51fd5782327812df302744eb.jpg', '2024-05-25 17:47:26', 'ramos-de-flores', 1),
(7, 'Centros florales', 'Elige el centro floral que más de adapte a tu evento.', 'img_b4c2bd90d50e6e31c3126a594dfe8242.jpg', '2024-05-25 17:48:37', 'centros-florales', 1),
(8, 'Flores de condolencia', 'Te acompañamos en el último adiós.', 'img_077f40ce0a0235afc74df2b9446bf34c.jpg', '2024-05-25 17:49:58', 'flores-de-condolencia', 1),
(9, 'Plantas', 'Tenemos gran variedad de plantas para ti.', 'img_81f20859e9a0f8df2ea5772d4f1995ba.jpg', '2024-05-25 17:51:07', 'plantas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` bigint(20) NOT NULL,
  `pedidoid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`) VALUES
(5, 7, 'pro_bb827f320a966e4539b786f8c2fadd39.jpg'),
(6, 8, 'pro_5b32fa19aa960a06b0c4925509874bea.jpg'),
(7, 9, 'pro_537a91170a9d278e89c90e347d20d108.jpg'),
(8, 10, 'pro_729c565945cbecb18ea7e067d447e76e.jpg'),
(9, 11, 'pro_aaeb5a8fd91dcb28a3491c3b71a066fe.jpg'),
(10, 12, 'pro_9d3fb81875545813513aadfd22b1dcfb.jpg'),
(11, 14, 'pro_577dacc1fce33aed9540901ab244a850.jpg'),
(12, 13, 'pro_2414a1bfeb15e5da1d7d5facb519d17d.jpg'),
(13, 8, 'pro_4659a4b66d770b9948b5f628018c1797.jpg'),
(14, 11, 'pro_3fd05dbf28cd1bdb7fd9d403625eae69.jpg'),
(15, 15, 'pro_630b43d1aece755698309754d05e72e6.jpg'),
(16, 15, 'pro_277bc52bea002c4747f9244667ac5df1.jpg'),
(17, 16, 'pro_61f8876c2c4cf46f917d416290ce16ae.jpg'),
(18, 17, 'pro_e91c48b4d66f1a261850accd308d480a.jpg'),
(19, 17, 'pro_25ad0bfb82284272cfdb82cd566580d5.jpg'),
(20, 18, 'pro_26d94d6e13d014cb42a666a3d7028582.jpg'),
(21, 19, 'pro_630b43d1aece755698309754d05e72e6.jpg'),
(22, 19, 'pro_a62b2ef846517824ac46748ab5ea8ee8.jpg'),
(23, 20, 'pro_ccb6209090d3d4be8359dafb703277ca.jpg'),
(24, 21, 'pro_be34cd98e291246df15d45fa7b808162.jpg'),
(25, 21, 'pro_c74fadef8570f2f96c1f5363c09d012a.jpg'),
(26, 22, 'pro_ea202c7adef412bdd383755dcc6fc84e.jpg'),
(27, 22, 'pro_25ad0bfb82284272cfdb82cd566580d5.jpg'),
(28, 23, 'pro_77fa014c695d86e1c54fbeddb58f4a00.jpg'),
(29, 24, 'pro_b5fbe4e67b646721670551faa00bc501.jpg'),
(30, 25, 'pro_eb43ecdf6a1ce2483c0f385ed6f1e69a.jpg'),
(31, 25, 'pro_a320403d594a3bb5988ad18ac706413b.jpg'),
(32, 26, 'pro_eb88c6d31bf61e3c029733a9581c0a0b.jpg'),
(35, 28, 'pro_95f6e65ec10c9e61c0a983475a21106f.jpg'),
(36, 29, 'pro_821d1ae2363a269a7bb35c951baa5a62.jpg'),
(37, 30, 'pro_a320403d594a3bb5988ad18ac706413b.jpg'),
(38, 30, 'pro_897b57284a2f681adc2bc4ecc2fc9db7.jpg'),
(39, 31, 'pro_e4e8a734bdb1b7ac877289833bf0313c.jpg'),
(40, 31, 'pro_94dbf5c5d0b72be90a86108aab85e6f7.jpg'),
(41, 32, 'pro_c9d750afdd3a433f0cf6310b4d31b120.jpg'),
(42, 32, 'pro_c9d750afdd3a433f0cf6310b4d31b120.jpg'),
(43, 32, 'pro_d88c9a26486c1edb023e1ccffca0ce7b.jpg'),
(44, 33, 'pro_e9c258643dc424f74a7ccc0576168d13.jpg'),
(45, 33, 'pro_0b05fff21724c10481bd668123fe7cbb.jpg'),
(46, 34, 'pro_7007857ad3c0738ce2142b9edfa69885.jpg'),
(47, 34, 'pro_2cc1bb18cc769f33315eed63392236c1.jpg'),
(50, 27, 'pro_a3482c2c9ebb8242783eb6c0e9eb4b67.jpg'),
(51, 27, 'pro_dd50ac7d1a86aa49b385e66db09889cb.jpg'),
(52, 35, 'pro_a3482c2c9ebb8242783eb6c0e9eb4b67.jpg'),
(53, 35, 'pro_f58d4172d233e243fab36ed1bf69c44e.jpg'),
(54, 36, 'pro_b4f8210ad7f03d12f80ac23cb601e918.jpg'),
(55, 36, 'pro_b4f8210ad7f03d12f80ac23cb601e918.jpg'),
(56, 36, 'pro_409d20e697fe236e4c093e05db6eeb2f.jpg'),
(57, 37, 'pro_a53b1736c7678fc49d9e102bafb23cf5.jpg'),
(58, 37, 'pro_8c60f2731244c240979e22088702390c.jpg'),
(59, 38, 'pro_07e2c961cb365615fe48b4dc3597aac6.jpg'),
(60, 38, 'pro_6e9a34e87af600fe2776ff9bb839dfe6.jpg'),
(61, 39, 'pro_147b239a221b628b5cb08bbe35187b63.jpg'),
(62, 40, 'pro_05d740bb1176457a0deae11a595b1a57.jpg'),
(63, 40, 'pro_5f78238ddb999195e170c1b07e8bb679.jpg'),
(64, 41, 'pro_e1318a9c54823f81704a47da064bfa97.jpg'),
(65, 42, 'pro_468c054a78b5b6abeab1a22bdec4d00f.jpg'),
(66, 42, 'pro_6af8ecec74835405e5e83bcd94265600.jpg'),
(67, 43, 'pro_a68c60a36e8f414fc1cdf009ad6d6c39.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del sistema', 1),
(4, 'Productos', 'Todos los productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Categorías', 'Categorías Productos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` bigint(20) NOT NULL,
  `personaid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `monto` decimal(11,2) NOT NULL,
  `direccion_envio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `personaid`, `fecha`, `monto`, `direccion_envio`) VALUES
(13, 5, '2024-05-23 10:18:40', 21.00, 'Calle Santo 10 Ciudad Real');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(57, 1, 1, 1, 1, 1, 1),
(58, 1, 2, 1, 1, 1, 1),
(60, 1, 4, 1, 1, 1, 1),
(61, 1, 5, 1, 1, 1, 1),
(62, 1, 6, 1, 1, 1, 1),
(63, 2, 1, 0, 0, 0, 0),
(64, 2, 2, 0, 0, 0, 0),
(66, 2, 4, 0, 0, 0, 0),
(67, 2, 5, 1, 0, 0, 0),
(68, 2, 6, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password` varchar(75) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombre`, `apellidos`, `telefono`, `email_user`, `password`, `rolid`, `datecreated`, `status`) VALUES
(1, '01234567Q', 'Carlos', 'Pérez López', '666336699', 'carlos@info.com', '1b80baf386b56e458bfec43b3f9de7ba70daa6b871a760a15a83849cb6751cb4', 1, '2024-04-26 11:05:32', 1),
(5, '03568978L', 'Lucia', 'Calvo Mateo', '666666666', 'lucia@info.com', '8805aa026a889a25133b5ed226ad1a9361fb31e1eeec0fde7aa87de5c6e5b33f', 1, '2024-04-27 11:59:28', 1),
(6, '00000000L', 'Cristina', 'Gutiérrez Estévez', '666332211', 'cristina@info.com', 'c2e22c84a8225e85ef7a9704a74741d48ec713c1e69d855b21b9063a1364b453', 2, '2024-05-16 16:00:49', 1),
(7, '05789632A', 'Adrian', 'Sanchez Lopez', '698741236', 'adrian@info.com', '96e8c6f9fbad34387e13044d38e0ffb5831ace2850adf1f78b559a305b57da94', 2, '2024-05-17 20:18:08', 1),
(8, '01256369L', 'Maria', 'Vallez Perez', '698552233', 'maria@info.com', '2249a090f11321a195804ff56a7d1feebcde039f707e7d999a29c2dbeb91fb0e', 2, '2024-05-18 10:35:23', 1),
(9, '05896541F', 'Nuria', 'García García', '654441122', 'nuria@info.com', 'ddca68671aa45f38061ed69e5b423997ad62b10d8e252e5a6d3b333d94949149', 2, '2024-05-18 10:37:43', 1),
(10, '05214455A', 'Lara', 'Ruiz', '658996655', 'lara@info.com', 'c694f07ada946304dc2f3177939ab825faab5c45e3f69e9d4c95c55689293bdb', 2, '2024-05-18 11:14:33', 1),
(11, '05724488L', 'Alba', 'Flores', '632558741', 'alba@info.com', '8d17e27633f33f7c8ebb7d3519d3681add2a2a95d881afb6cbbbc1a0582a6b8c', 2, '2024-05-18 11:20:28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `categoriaid` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `categoriaid`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `datecreated`, `ruta`, `status`) VALUES
(7, 4, 'Ramo Cristina', 'Ramo de novia sencillo compuesto de paniculata y lavanda. Todos los ramos son personalizables.', 100.00, 100, '', '2024-05-27 16:57:07', 'ramo-cristina', 1),
(8, 4, 'Ramo Isabel', 'Ramo primaveral con paniculata, romero y un par de destacados girasoles. Todos los ramos son personalizables.', 120.00, 100, '', '2024-05-27 17:15:38', 'ramo-isabel', 1),
(9, 4, 'Ramo Lucía', 'Ramo de novia con diferentes flores en tonos rosas y olivo. Todos los ramos son personalizables', 160.00, 100, '', '2024-05-27 17:19:01', 'ramo-lucia', 1),
(10, 4, 'Ramo María', 'Ramo de novia de tamaño pequeño en tonos rosas con pampas minúsculas y eucalipto redondo. Todos los ramos son personalizables.', 130.00, 100, '', '2024-05-27 17:21:10', 'ramo-maria', 1),
(11, 4, 'Ramo Nuria', 'Ramo de novia en tonos azules con distinto tipo de paniculata de colores, hojas de eucalipto y rosas blancas. Todos los ramos son personalizables.', 150.00, 100, '', '2024-05-27 17:23:53', 'ramo-nuria', 1),
(12, 4, 'Ramo Paula', 'Ramo de novia con rosas blancas, hojas de eucalipto y margaritas azules. Todos los ramos son personalizables.', 140.00, 100, '', '2024-05-27 17:25:32', 'ramo-paula', 1),
(13, 4, 'Ramo Rosa', 'Ramo de novia mediano con hojas de eucalipto y flores de distintos tono de color nude. Todos los ramos son personalizables.', 160.00, 100, '', '2024-05-27 17:35:27', 'ramo-rosa', 1),
(14, 4, 'Ramo Rosario', 'Ramo de novia silvestre con diferente estilos de hojas, margarita y manzanilla. Todos los ramos son personalizables.', 150.00, 100, '', '2024-05-27 17:37:55', 'ramo-rosario', 1),
(15, 5, 'Lovely White', 'Ramo de rosas blancas.', 70.00, 100, '', '2024-05-27 18:06:31', 'lovely-white', 1),
(16, 5, 'Lovely Red', 'Ramo de rosas rojas.', 70.00, 100, '', '2024-05-27 18:07:24', 'lovely-red', 1),
(17, 5, 'Lovely Pink', 'Ramo de rosas rosas.', 70.00, 100, '', '2024-05-27 18:08:21', 'lovely-pink', 1),
(18, 5, 'Lovely Yellow', 'Ramo de rosas amarillas.', 70.00, 100, '', '2024-05-27 18:10:06', 'lovely-yellow', 1),
(19, 6, 'Campanillas', 'Ramo de flores campanilla.', 45.00, 100, '', '2024-05-27 18:42:30', 'campanillas', 1),
(20, 6, 'Claveles', 'Ramo de claveles. Disponemos de varios colores.', 37.00, 100, '', '2024-05-27 18:43:29', 'claveles', 1),
(21, 6, 'Girasoles', 'Ramo de girasoles.', 42.00, 100, '', '2024-05-27 18:45:09', 'girasoles', 1),
(22, 6, 'Silvestres', 'Ramo de flores silvestres.', 50.00, 100, '', '2024-05-27 18:47:02', 'silvestres', 1),
(23, 6, 'Tulipanes', 'Ramo de tulipanes.', 45.00, 100, '', '2024-05-27 18:47:44', 'tulipanes', 1),
(24, 6, 'Calas', 'Ramo de la calas.', 55.00, 100, '', '2024-05-27 18:48:28', 'calas', 1),
(25, 7, 'Jarrones de centro', 'Para cualquier tipo de evento. Los centros florales son personalizables.', 215.00, 100, '', '2024-05-28 12:46:24', 'jarrones-de-centro', 1),
(26, 7, 'Centros de rosas', 'Centro floral de rosas blancas. Todos los centros son personalizables.', 190.00, 100, '', '2024-05-28 12:47:58', 'centros-de-rosas', 1),
(27, 7, 'Cesta de flores silvestres', 'Cesta compuesta de flores silvestres multicolor. Todas las cesta florales son personalizables.', 185.00, 100, '', '2024-05-28 12:49:47', 'cesta-de-flores-silvestres', 1),
(28, 7, 'Cesta de paniculata', 'Cesta de paniculata de diversos colores. Todas las cestas florales son personalizables.', 110.00, 100, '', '2024-05-28 12:51:55', 'cesta-de-paniculata', 1),
(29, 7, 'Cesta de tulipanes', 'Cesta de tamaño grande con tulipanes. Todas las cestas florales son personalizables.', 155.00, 100, '', '2024-05-28 12:53:27', 'cesta-de-tulipanes', 1),
(30, 8, 'Centro floral.', 'Centro floral de condolencia con varias flores en tonos blancos.', 160.00, 100, '', '2024-05-28 12:55:43', 'centro-floral', 1),
(31, 8, 'Corona de flores', 'Corona de condolencias con flores en tonos blancos.', 190.00, 100, '', '2024-05-28 12:57:00', 'corona-de-flores', 1),
(32, 9, 'Orquídeas', 'Orquídeas de diferentes colores, el regalo perfecto para dar.', 40.00, 100, '', '2024-05-28 13:23:38', 'orquideas', 1),
(33, 9, 'Costillas de Adán', 'La Monstera deliciosa es también conocida como \"Costilla de Adán\" por las distintivas aperturas en sus hojas.', 90.00, 100, '', '2024-05-28 13:45:16', 'costillas-de-adan', 1),
(34, 9, 'Dracenas o Dracaenas', 'La Dracaena marginata también se le conoce como \'\'Dragón rojo de Madagascar\'\' y es una planta muy resistente a plagas, enfermedades y condiciones ambientales.', 45.00, 100, '', '2024-05-28 13:46:43', 'dracenas-o-dracaenas', 1),
(35, 9, 'Euforbia Eritrea', 'Euphorbia Eritrea también conocida como \"Corona de leche\" Con origen en África, este árbol suculento es de lo más resistente y fácil de cuidar.', 59.00, 100, '', '2024-05-28 13:47:44', 'euforbia-eritrea', 1),
(36, 9, 'Limonero', 'Citrus x limón, también conocido como Limonero tiene su origen en Asia desde hace más de dos mil años.', 81.00, 100, '', '2024-05-28 13:56:16', 'limonero', 1),
(37, 9, 'Ficus Elastica', 'El Ficus Elastica, comúnmente conocido como árbol de goma o higuera de hoja grande, es una planta de interior apreciada por sus grandes hojas brillantes y su aspecto majestuoso.', 89.00, 100, '', '2024-05-28 14:00:33', 'ficus-elastica', 1),
(38, 9, 'Bonsái 10 años Pistacia lentiscus', 'Bonsái 10 años Pistacia lentiscus, con origen mediterraneo es un curioso bonsái capaz de atraer todas las miradas.', 99.00, 100, '', '2024-05-28 16:26:06', 'bonsai-10-anos-pistacia-lentiscus', 1),
(39, 9, 'Planta china del dinero', 'También conocida como Pilea Peperomioides o simplemente Planta del Dinero.', 37.00, 100, '', '2024-05-28 16:27:38', 'planta-china-del-dinero', 1),
(40, 9, 'Calathea Triostar', 'Bonsái 10 años Pistacia lentiscus, con origen mediterraneo es un curioso bonsái capaz de atraer todas las miradas.', 38.00, 100, '', '2024-05-28 16:28:45', 'calathea-triostar', 1),
(41, 9, 'Eucaliptus', 'Originario de Australia, el Eucalipto es una planta excepcional que aporta frescura aromática con su fragancia única y propiedades beneficiosas.', 54.00, 100, '', '2024-05-28 16:29:45', 'eucaliptus', 1),
(42, 9, 'Hiedra', 'Hedera helix también conocida como \"Hiedra común\" es la elección preferida por las personas que se inician en el mundo de las plantas por su absoluta resistencia y capacidad de adaptación.', 33.00, 100, '', '2024-05-28 16:32:06', 'hiedra', 1),
(43, 9, 'Árbol de Olivo', 'Olea europaea o Árbol de Olivo.', 67.00, 100, '', '2024-05-28 16:33:10', 'arbol-de-olivo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Persona administradora de la página', 1),
(2, 'Cliente', 'Persona que solo tiene acceso como comprador', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`),
  ADD KEY `productoid` (`productoid`) USING BTREE;

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `personaid` (`personaid`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
