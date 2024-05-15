<?php
headerTienda($data);
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
        <span class="stext-109 cl4">
            <?= $data['page_title'] ?>
        </span>
    </div>
</div>
<?php
$subtotal = 0;
$total = 0;
//si no existen lo productos no se mostrará el carrito
if (isset($_SESSION['arrCarrito']) and count($_SESSION['arrCarrito']) > 0) {
?>
    <!-- Carrito -->
    <form class="bg0 p-t-75 p-b-85" method="post" action="<?= base_url() ?>/carrito/procesarpago">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table id="tblCarrito" class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Producto</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Precio</th>
                                    <th class="column-4">Cantidad</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                <?php
                                // Recorremos el array de productos
                                foreach ($_SESSION['arrCarrito'] as $producto) {
                                    $totalProducto = $producto['precio'] * $producto['cantidad']; //calculamos el total de un producto
                                    $subtotal += $totalProducto; //calculamos el subtotal que es la suma de los totales de todos los productos
                                    $idProducto = openssl_encrypt($producto['idproducto'], METHODENCRIPT, KEY); //encriptamos el id del producto 

                                ?>
                                    <!-- Le ponemos como clase el id del producto -->
                                    <tr class="table_row <?= $idProducto ?>">
                                        <td class="column-1">
                                            <!-- Para el borrado colocamos el id del producto la opción 2 que indica que lo borramos desde la vista carrito y no desde el modal y el evento onclick -->
                                            <div class="how-itemcart1" idpr="<?= $idProducto ?>" op="2" onclick="fntdelItem(this)">
                                                <img src="<?= $producto['imagen'] ?>" alt="<?= $producto['producto'] ?>">
                                            </div>
                                        </td>
                                        <td class="column-2"><?= $producto['producto'] ?></td>
                                        <td class="column-3"><?= formatMoney($producto['precio']) . SMONEY ?></td>
                                        <td class="column-4">
                                            <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                <!-- Le colocamos el id del producto para controlar la actualización de la cantidad -->
                                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" idpr="<?= $idProducto ?>">
                                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                                </div>

                                                <!-- Le colocamos el id del producto para actualizar la cantidad -->
                                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?= $producto['cantidad'] ?>" idpr="<?= $idProducto ?>">

                                                <!-- Le colocamos el id del producto para controlar la actualización de la cantidad -->
                                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" idpr="<?= $idProducto ?>">
                                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="column-5"><?= formatMoney($totalProducto) . SMONEY ?></td>
                                    </tr>
                                <?php } ?>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Totales
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                <span id="subTotalCompra" class="mtext-110 cl2">
                                    <?= formatMoney($subtotal) . SMONEY ?>
                                </span>
                            </div>

                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Envío:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    <?= formatMoney(COSTOENVIO) . SMONEY ?>
                                </span>
                            </div>
                        </div>
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">
                                    Total:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span id="totalCompra" class="mtext-110 cl2">
                                    <?= formatMoney($subtotal + COSTOENVIO) . SMONEY ?>
                                </span>
                            </div>
                        </div>
                        <button type="submit" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Procesar pago
                        </button>
                        <!-- <a href="<?= base_url() ?>/carrito/procesarpago" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Procesar pago
                        </a> -->
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php } else { ?>
    <br>
    <div class="container">
        <p>No hay producto en el carrito <a href="<?= base_url() ?>/tienda"> Ver productos</a></p>
    </div>
    <br>
<?php
}
footerTienda($data);
?>