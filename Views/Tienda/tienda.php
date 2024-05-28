<?php
headerTienda($data); //la función está en el helper

$arrProductos = $data['productos'];
?>
<br><br><br>
<hr>
<!-- Productos  -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <h3><?= $data['page_title'] ?></h3>
            </div>
        </div>

        <div class="row isotope-grid">
            <?php
            if (count($arrProductos) > 0) {
                for ($i = 0; $i < count($arrProductos); $i++) {
                    $ruta = $arrProductos[$i]['ruta'];
                    if (count($arrProductos[$i]['images'])) {
                        $portada = $arrProductos[$i]['images'][0]['url_image'];
                    } else {
                        $portada = media() . '/images/uploads/no_producto.png';
                    }
            ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="<?= $portada ?>" alt="<?= $arrProductos[$i]['nombre'] ?>">

                                <a href="<?= base_url() . "/tienda/producto/" . $arrProductos[$i]['idproducto'] . "/" . $ruta ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Ver producto
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="<?= base_url() . "/tienda/producto/" . $arrProductos[$i]['idproducto'] . "/" . $ruta ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?= $arrProductos[$i]['nombre'] ?>
                                    </a>

                                    <span class="stext-105 cl3">
                                        <?= formatMoney($arrProductos[$i]['precio']) . SMONEY  ?>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <p>No hay productos para mostrar</p><a href="<?= base_url() ?>/tienda">Ver productos</a>
            <?php
            }
            ?>
        </div>

        <!-- Paginación -->
        <?php
        if (count($data['productos']) > 0) {
            $prevPagina = $data['pagina'] - 1;
            $nextPagina = $data['pagina'] + 1;
        ?>
            <div class="flex-c-m flex-w w-full p-t-45">
                <?php if ($data['pagina'] > 1) { ?>
                    <a href="<?= base_url() ?>/tienda/page/<?= $prevPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        <i class="fa-solid fa-arrow-left"></i> &nbsp; Anterior
                    </a>
                <?php } ?>
                &nbsp;&nbsp;
                <?php if ($data['pagina'] != $data['total_paginas']) { ?>
                    <a href="<?= base_url() ?>/tienda/page/<?= $nextPagina ?>" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Siguiente &nbsp; <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php } ?>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
footerTienda($data); //la función está en el helper
?>