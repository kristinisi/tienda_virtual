<?php
$catFooter = getCatFooter();
?>

<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CATEGORÍAS
                </h4>
                <?php if (count($catFooter) > 0) { ?>
                    <ul>
                        <?php foreach ($catFooter as $cat) { ?>
                            <li class="p-b-10">
                                <a href="<?= base_url() ?>/tienda/categoria/<?= $cat['idcategoria'] . "/" . $cat['ruta'] ?>" class="stext-107 cl7 hov-cl1 trans-04">
                                    <?= $cat['nombre'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php }
                0 ?>
            </div>

            <div class="col-sm-6 col-lg-4 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    CONTACTO
                </h4>

                <p class="stext-107 cl7 size-201">
                    <?= DIRECCION ?> <br>
                    Teléfono: <?= TELEMPRESA ?>
                    Email: <?= EMAIL_EMPRESA  ?>;
                </p>

                <!-- <div class="p-t-27">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                </div> -->
            </div>

            <div class="col-sm-6 col-lg-4 p-b-50">
                <div class="footer_redes">
                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <img src="<?= media() ?>/images/facebook.png" alt="facebook">
                    </a>

                    <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16 ">
                        <img src="<?= media() ?>/images/instagram.png" alt="instagram">
                    </a>

                </div>
                <!-- Map -->
                <!-- <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1550.713773137159!2d-3.9263003097974045!3d38.982737555892385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6bc33fe6bfa2fd%3A0xf5ba0f2365b0784a!2sPl.%20San%20Francisco%2C%201%2C%2013001%20Ciudad%20Real!5e0!3m2!1ses!2ses!4v1716635498395!5m2!1ses!2ses" width="400" height="300" style="border-radius:10px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div> -->
                <!-- <h4 class="stext-301 cl0 p-b-30">
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
                </form> -->
            </div>

        </div>

        <div class="row">

            <div class="map col-sm-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1550.713773137159!2d-3.9263003097974045!3d38.982737555892385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6bc33fe6bfa2fd%3A0xf5ba0f2365b0784a!2sPl.%20San%20Francisco%2C%201%2C%2013001%20Ciudad%20Real!5e0!3m2!1ses!2ses!4v1716635498395!5m2!1ses!2ses" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
<script src="<?= media(); ?>/js/fontawesome.js"></script>
<script src="<?= media() ?>/tienda/js/functions.js"></script>
<script src="<?= media() ?>/js/functions_admin.js"></script>
<script src="<?= media() ?>/js/functions_login.js"></script>

</body>

</html>