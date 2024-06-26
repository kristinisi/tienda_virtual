<?php
headerTienda($data); //la función está en el helper

$arrProducto = $data['producto'];
$arrProductos = $data['productos'];
$arrImages = $arrProducto['images'];
$rutacategoria = $arrProducto['categoriaid'] . "/" . $arrProducto['ruta_categoria'];
// dep($data);
?>
<br><br><br>
<hr>
<!-- Migas de pan -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="<?= base_url() ?>" class="stext-109 cl8 hov-cl1 trans-04">
            Inicio
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="<?= base_url() . '/tienda/categoria/' . $rutacategoria; ?>" class="stext-109 cl8 hov-cl1 trans-04">
            <?= $arrProducto['categoria'] ?>
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            <?= $arrProducto['nombre'] ?>
        </span>
    </div>
</div>


<!-- Detalle del producto -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
                            <?php
                            if (!empty($arrImages)) {
                                for ($i = 0; $i < count($arrImages); $i++) {

                            ?>
                                    <div class="item-slick3" data-thumb="<?= $arrImages[$i]['url_image']; ?>">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="<?= $arrImages[$i]['url_image']; ?>" alt="<?= $arrProducto['nombre']; ?>">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?= $arrImages[$i]['url_image']; ?>">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        <?= $arrProducto['nombre'] ?>
                    </h4>

                    <span class="mtext-106 cl2">
                        <?= formatMoney($arrProducto['precio']) . SMONEY  ?>
                    </span>

                    <p class="stext-102 cl3 p-t-23">
                        <?= $arrProducto['descripcion'] ?>
                    </p>

                    <div class="p-t-33">

                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10 own_stylye">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input id="cant-product" class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1" min="1">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                <!-- Se encripta el id, se recibe 3 parámetros: dato para encriptar(id), el método de encriptación y la llave(estos datos estan en config)-->
                                <button id="<?= openssl_encrypt($arrProducto['idproducto'], METHODENCRIPT, KEY) ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                    Agregar al carrito
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <h3>Productos relacionados</h3>
    </div>
</section>


<!--  Productos relacionados -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">

        <!-- Slider -->
        <div class="wrap-slick2">
            <div class="slick2">
                <?php
                if (!empty($arrProductos)) {
                    for ($i = 0; $i < count($arrProductos); $i++) {
                        $ruta = $arrProductos[$i]['ruta'];
                        if (count($arrProductos[$i]['images'])) {
                            $portada = $arrProductos[$i]['images'][0]['url_image'];
                        } else {
                            $portada = media() . '/images/uploads/no_producto.png';
                        }
                ?>
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="<?= $portada ?>" alt="IMG-PRODUCT">

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
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
footerTienda($data); //la función está en el helper
?>