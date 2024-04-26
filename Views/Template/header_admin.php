<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual HANAKO">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Para la compatibilidad del navegador Edge -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Vista responsive y evitar que hagamos zoom -->
    <meta name="author" content="Cristina Gutierrez">
    <meta name="theme-color" content="#f3b3b2">
    <title><?= $data['page_tag'] ?></title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?= base_url(); ?>/dashboard">HANAKO</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fa-solid fa-bars"></i></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li class="dropdown">
                <a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa-regular fa-user"></i></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/opciones"><i class="bi bi-gear me-2 fs-5"></i> Configuración</a></li>
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/perfil"><i class="bi bi-person me-2 fs-5"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="<?= base_url(); ?>/logout"><i class="bi bi-box-arrow-right me-2 fs-5"></i> Salir</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <!-- Incluimos el nav después del header -->
    <!-- <?php require_once("nav_admin.php") ?> -->