<?php
//para colocar la cantidad de productos que tenemos en el carrito
$cantCarrito = 0;
if (isset($_SESSION['arrCarrito']) and count($_SESSION['arrCarrito']) > 0) {
    foreach ($_SESSION['arrCarrito'] as $product) {
        $cantCarrito += $product['cantidad'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $data['page_tag'] ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= media() ?> /tienda/images/icons/logo_flor.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/tienda/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media() ?>/css/style.css">
    <!--===============================================================================================-->
</head>

<body class="animsition">

    <!-- Metemos aquí el loading para que podamos aplicarlo en las vistas que queramos con simplemente activarlo -->
    <div id="divLoading">
        <div>
            <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
        </div>
    </div>

    <!-- Header -->
    <header>
        <!-- Header escritorio -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <!-- Validamos si existe la variable sesión login -->

                    <div class="left-top-bar">
                        <?php if (isset($_SESSION['login'])) { ?>
                            Bienvenido: <?= $_SESSION['userData']['nombre'] . " " . $_SESSION['userData']['apellidos'] ?>
                        <?php } ?>
                    </div>

                    <div class="right-top-bar flex-w h-full">

                        <?php if (isset($_SESSION['login'])) { ?>
                            <a href="<?= base_url() ?>/dashboard" class="flex-c-m trans-04 p-lr-25">
                                Mi cuenta
                            </a>
                        <?php } ?>
                        <?php if (isset($_SESSION['login'])) { ?>
                            <a href="<?= base_url() ?>/logout" class="flex-c-m trans-04 p-lr-25">
                                Salir
                            </a>
                        <?php } else { ?>
                            <a href="<?= base_url() ?>/login" class="flex-c-m trans-04 p-lr-25">
                                Iniciar Sesión
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo escritorio -->
                    <a href="<?= base_url(); ?>" class="logo">
                        <img src="<?= media() ?>/tienda/images/icons/logo.png" alt="hanako">
                    </a>

                    <!-- Menu escritorio -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="<?= base_url(); ?>">Inicio</a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>/tienda">Tienda</a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>/carrito">Carrito</a>
                            </li>

                            <li>
                                <a href="<?= base_url(); ?>/nosotros">Nosotros</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icono header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <!-- Dentro de la página del carrito no vamos a mostrar el icono asique hacemos una comprobación -->
                        <?php if ($data['page_name'] != "carrito") { ?>

                            <div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= $cantCarrito; ?>">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        <?php } ?>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header movil -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="<?= base_url(); ?>"><img src="<?= media() ?>/tienda/images/icons/logo.png" alt="hanako"></a>
            </div>

            <!-- Icono header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="cantCarrito icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <!-- Dentro de la página del carrito no vamos a mostrar el icono asique hacemos una comprobación -->
                <?php if ($data['page_name'] != "carrito") { ?>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= $cantCarrito; ?>">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                <?php } ?>
            </div>

            <!-- Botón ver menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu movil -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        <?php if (isset($_SESSION['login'])) { ?>
                            Bienvenido: <?= $_SESSION['userData']['nombre'] . " " . $_SESSION['userData']['apellidos'] ?>
                        <?php } ?>
                    </div>
                </li>

                <li>
                    <div class="right-top-bar flex-w h-full">

                        <?php if (isset($_SESSION['login'])) { ?>
                            <a href="<?= base_url() ?>/dashboard" class="flex-c-m trans-04 p-lr-25">
                                Mi cuenta
                            </a>
                        <?php } ?>
                        <?php if (isset($_SESSION['login'])) { ?>
                            <a href="<?= base_url() ?>/logout" class="flex-c-m trans-04 p-lr-25">
                                Salir
                            </a>
                        <?php } else { ?>
                            <a href="<?= base_url() ?>/login" class="flex-c-m trans-04 p-lr-25">
                                Iniciar Sesión
                            </a>
                        <?php } ?>
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="<?= base_url(); ?>">Inicio</a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>/tienda">Tienda</a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>/carrito">Carrito</a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>/nosotros">Nosotros</a>
                </li>

                <li>
                    <a href="<?= base_url(); ?>/contacto">Contacto</a>
                </li>
            </ul>
        </div>
    </header>

    <!-- Carrito MODAL -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Tu carrito
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div id="productosCarrito" class="header-cart-content flex-w js-pscroll">
                <?php getModal('modalCarrito', $data); ?>
            </div>
        </div>
    </div>