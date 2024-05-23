<?php headerAdmin($data) ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa-solid fa-gauge"></i></i> <?= $data['page_title'] ?></h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa-solid fa-house"></i></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard"></a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body"><img class="logo_dashboard" src="<?= media(); ?>/images/floristeria2.png" alt=""></div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url() ?>/usuarios" class="linkw">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                            <h4>Usuarios</h4>
                            <p><b><?= $data['usuarios'] ?></b></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url() ?>/categorias" class="linkw">
                    <div class="widget-small info coloured-icon"><i class="icon fa-solid fa-layer-group fa-3x"></i>
                        <div class="info">
                            <h4>Categorías</h4>
                            <p><b><?= $data['categorias'] ?></b></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url() ?>/productos" class="linkw">
                    <div class="widget-small warning coloured-icon"><i class="icon fa fa fa-archive fa-3x"></i>
                        <div class="info">
                            <h4>Productos</h4>
                            <p><b><?= $data['productos'] ?></b></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
            <div class="col-md-6 col-lg-3">
                <a href="<?= base_url() ?>/pedidos" class="linkw">
                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-shopping-cart fa-3x"></i>
                        <div class="info">
                            <h4>Pedidos</h4>
                            <p><b><?= $data['pedidos'] ?></b></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</main>
<?php footerAdmin($data) ?>