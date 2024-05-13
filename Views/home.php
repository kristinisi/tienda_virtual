    <?php
    headerTienda($data); //la función está en el helper
    getModal('modalCarrito', $data); //enviamos la funcinón del modal del carrito

    $arrSlider = $data['slider'];
    $arrBanner = $data['banner'];
    $arrProductos = $data['productos'];
    ?>

    <!-- Slider CATEGORÍAS-->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">

                <?php
                for ($i = 0; $i < count($arrSlider); $i++) {
                    $ruta = $arrSlider[$i]['ruta']; //guardamos en una variable la ruta de la categoria
                ?>

                    <div class="item-slick1" style="background-image: url(<?= $arrSlider[$i]['portada'] ?>);">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        <?= $arrSlider[$i]['descripcion'] ?>
                                    </span>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        <?= $arrSlider[$i]['nombre'] ?>
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                    <a href=" <?= base_url() . "/tienda/categoria/" . $arrSlider[$i]['idcategoria'] . "/" . $ruta ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Ver productos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </section>


    <!-- Banner CATEGORÍAS -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <?php
                for ($i = 0; $i < count($arrBanner); $i++) {
                    $ruta = $arrBanner[$i]['ruta']; //guardamos en una variable la ruta de la categoria
                ?>
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <div class="block1 wrap-pic-w">
                            <img src="<?= $arrBanner[$i]['portada'] ?>" alt="<?= $arrBanner[$i]['nombre'] ?>">

                            <a href="<?= base_url() . "/tienda/categoria/" . $arrBanner[$i]['idcategoria'] . "/" . $ruta ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        <?= $arrBanner[$i]['nombre'] ?>
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Ver productos
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>


    <!-- PRODUCTOS -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Productos nuevos
                </h3>
            </div>

            <hr>

            <div class="row isotope-grid">
                <?php
                for ($i = 0; $i < count($arrProductos); $i++) {
                    $ruta = $arrProductos[$i]['ruta']; //obtenemos la ruta del producto
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

                                <a href="<?= base_url() . "/tienda/producto/" . $arrProductos[$i]['idproducto'] . "/" . $ruta; ?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Ver producto
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="<?= base_url() . "/tienda/producto/" . $arrProductos[$i]['idproducto'] . "/" . $ruta; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?= $arrProductos[$i]['nombre'] ?>
                                    </a>

                                    <span class="stext-105 cl3">
                                        <?= formatMoney($arrProductos[$i]['precio']) . SMONEY  ?>
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04" src="<?= media() ?>/tienda/images/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l" src="<?= media() ?>/tienda/images/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </section>

    <?php
    footerTienda($data); //la función está en el helper
    ?>