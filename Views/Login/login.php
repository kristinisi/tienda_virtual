<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Para responsive-->
    <meta name="author" content="Cristina Gutierrez">
    <meta name="theme-color" content="#f3b3b2">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
    <!-- Font-icon css-->
    <title><?= $data['page_tag']; ?></title>
</head>

<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <a href="<?= base_url(); ?>"><img class="logo_dashboard" src="<?= media(); ?>/images/floristeria2.png" alt=""></a>
        </div>
        <div class="login-box">
            <div id="divLoading">
                <div>
                    <img src="<?= media(); ?>/images/loading.svg" alt="Loading">
                </div>
            </div>
            <form class="login-form" name="formLogin" id="formLogin">
                <h3 class="login-head"><i class="fa-solid fa-user"></i> INICIAR SESIÓN</h3>
                <div class="form-group">
                    <label class="control-label">USUARIO</label>
                    <input id="txtEmail" name="txtEmail" class="form-control" type="text" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">CONTRASEÑA</label>
                    <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Contraseña">
                </div>
                <div id="alertLogin" class="text-center"></div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>INICIAR SESIÓN</button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>
    <!-- JavaScripts esenciales para que la aplicación funcione-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <!-- El plugin de JavaScript para mostrar la carga de la página en la parte superior-->
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

</body>

</html>