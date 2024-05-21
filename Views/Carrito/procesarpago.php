<?php
headerTienda($data);
$subtotal = 0;
$total = 0;

foreach ($_SESSION['arrCarrito'] as $producto) {
    $subtotal += $producto['precio'] * $producto['cantidad']; //calculamos el total de un producto
}
$total = $subtotal + COSTOENVIO;
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
<br>


<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-l-25 m-r--38 m-lr-0-xl">
                <div>
                    <!-- Si existe la variable de sesión, mostramos la dirección de envío -->
                    <?php
                    if (isset($_SESSION['login'])) {
                    ?>
                        <form id="formPedido" class="needs-validation" novalidate>
                            <div>
                                <label for="tipopago">Dirección de envío</label>
                                <div class="bor8 bg0 m-b-12">
                                    <input id="txtDireccion" class="form-control stext-111 cl8 plh3 size-111 p-lr-15 " type="text" name="txtDireccion" placeholder="Dirección de envío" required>
                                </div>
                                <div class="bor8 bg0 m-b-22">
                                    <input id="txtCiudad" class="form-control stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="txtCiudad" placeholder="Ciudad / Estado" required>
                                </div>
                                <br><br>
                                <label>Datos de la tarjeta</label>
                                <div class=" bg0 m-b-12">
                                    <label for="tarjeta">Número de Tarjeta: </label>
                                    <input id="tarjeta" class="form-control " type="text" pattern="[0-9]{4}[ ][0-9]{4}[ ][0-9]{4}[ ][0-9]{4}" maxlength="19" minlength="19" placeholder="XXXX XXXX XXXX XXXX" required>
                                    <div class="invalid-feedback">El número de tarjeta debe de ser 16 número con un espacio entre medias cada 4 números.</div>
                                </div>
                                <div class="bg0 m-b-12">
                                    <label for="caducidad">Caducidad: </label>
                                    <input id="caducidad" class="form-control " type="text" pattern="(0[1-9]|1[0-2])\/(2[2-9]|[3-9][0-9])" maxlength="5" minlength="5" required placeholder="mm/yy">
                                    <div class="invalid-feedback">La caducidad debe ser mes/año</div>
                                </div>
                                <div class="bg0 m-b-12">
                                    <label for="seguridad">Código de seguridad/CVV2: </label>
                                    <input type="text" id="seguridad" class="form-control " pattern="[0-9]{3,4}" maxlength="3" minlength="3" required>
                                    <div class="invalid-feedback">El número de seguridad son 3 números</div>
                                </div>
                                <div class="bg0 m-b-12">
                                    <label for="titular">Titular de la Tarjeta: </label>
                                    <input type="text" id="titular" class="form-control " pattern="[A-Za-z]+(\s[A-Za-z]+)*" required>
                                    <div class="invalid-feedback">Debe introducir el titular de la tarjeta</div>
                                </div>
                            </div>

                            <!-- Sino mostramos el formulario para iniciar sesión -->
                        <?php } else { ?>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#login" role="tab" aria-controls="home" aria-selected="true">Iniciar Sesión</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#registro" role="tab" aria-controls="profile" aria-selected="false">Crear cuenta</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="home-tab">
                                    <br>
                                    <form id="formLogin" class=" needs-validation" novalidate>
                                        <div class="form-group">
                                            <label for="txtEmail">Usuario</label>
                                            <input type="email" class="form-control" id="txtEmail" name="txtEmail" required>
                                            <div class="invalid-feedback">
                                                Por favor, ingrese un correo válido.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtPassword">Contraseña</label>
                                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" required>
                                            <div class="invalid-feedback">
                                                Por favor, ingrese una contraseña válida.
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                    </form>

                                </div>
                                <div class="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                                    <br>
                                    <form id="formRegister" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col col-md-6 form-group">
                                                <label for="txtIdentificacion">Identificación</label>
                                                <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required>
                                            </div>
                                            <div class="col col-md-6 form-group">
                                                <label for="txtNombre">Nombre</label>
                                                <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col col-md-6 form-group">
                                                <label for="txtApellido">Apellidos</label>
                                                <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required>

                                            </div>
                                            <div class="col col-md-6 form-group">
                                                <label for="txtTelefono">Teléfono</label>
                                                <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required onkeypress="return controlTag(event);">

                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col col-md-6 form-group">
                                                <label for="txtEmailCliente">Email</label>
                                                <input type="email" class="form-control valid validEmail" id="txtEmailCliente" name="txtEmailCliente" required>

                                            </div>
                                            <div class="col col-md-6 form-group">
                                                <label for="txtPassword">Contraseña</label>
                                                <input type="password" class="form-control" id="txtPasswordCliente" name="txtPasswordCliente" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Regístrate</button>
                                </div>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                <h4 class="mtext-109 cl2 p-b-30">
                    Resumen
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
                            <?= formatMoney($total) . SMONEY ?>
                        </span>
                    </div>
                </div>
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                    <button type="submit" id="btnComprar" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer notBlock" data-toggle="modal" data-target="#modalTarjeta">
                        Pagar
                    </button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php
footerTienda($data);
?>