<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CATEGORÍAS
                </h4>

                <ul>
                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Women
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Men
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Shoes
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            Watches
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CONTACTO
                </h4>

                <p class="stext-107 cl7 size-201">
                    Plaza San Francisco, Local 1 <br>
                    Teléfono: 9268878563
                </p>

                <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                </div>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            SUSCRÍBETE
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <!-- DERECHOS DE AUTOR PARA LA PLANTILLA -->
            <p class="stext-107 cl6 txt-center">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <!-- Copyright &copy;<script>
                    document.write(new Date().getFullYear());
                </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
                HANAKO | Floristería <a href="https://colorlib.com" target="_blank">Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

            </p>
        </div>
    </div>
</footer>


<!-- ICONO QUE NOS LLEVA A LA PARTE SUPERIOR -->
<div class="btn-back-to-top" id="myBtn">
    <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
    </span>
</div>

<!-- Creamos la variable base_url de tipo constante -->
<script>
    const base_url = '<?= base_url(); ?>'; //ruta raiz
    const smoney = '<?= SMONEY; ?>'; // valor de la moneda
</script>


<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/bootstrap/js/popper.js"></script>
<script src="<?= media() ?>/tienda/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/daterangepicker/moment.min.js"></script>
<script src="<?= media() ?>/tienda/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/slick/slick.min.js"></script>
<script src="<?= media() ?>/tienda/js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/js/main.js"></script>
<!--===============================================================================================-->
<script src="<?= media() ?>/tienda/js/functions.js"></script>
<script src="<?= media() ?>/js/functions_admin.js"></script>
<script src="<?= media() ?>/js/functions_login.js"></script>

</body>

</html>