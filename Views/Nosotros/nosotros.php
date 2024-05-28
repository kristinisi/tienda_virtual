<?php
headerTienda($data);
$banner = media() . "/tienda/images/girasoles2.jpg";
?>
<!-- Lo que hacemos con el siguiente script es que cuando carguemos esta vista se va a cambiar el estilo del header -->
<script>
    document.querySelector('header').classList.add('header-v4');
</script>
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?= $banner ?>');">
    <h2 class="ltext-105 cl0 txt-center">
        About
    </h2>
</section>

<!-- Contenido -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        ¡Gracias por ser parte de nuestra historia!
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        Nuestra historia comenzó hace más de 20 años en el corazón de Ciudad Real, cuando Ana y Carlos, una pareja apasionada por la naturaleza y el arte floral, decidieron convertir su sueño en realidad. Inspirados por la belleza y la delicadeza de las flores, abrieron las puertas de Hanako, una floristería dedicada a traer un toque de color y alegría a la vida de nuestros clientes. </p>

                    <p class="stext-113 cl6 p-b-26">
                        Desde sus humildes comienzos, Hanako se ha destacado por su compromiso con la calidad y el servicio personalizado. Cada arreglo floral que creamos es una obra de arte única, diseñada con amor y dedicación. Nuestra misión es hacer que cada ocasión sea especial, ya sea una boda, un cumpleaños, un aniversario o simplemente un día cualquiera que merece ser celebrado con flores frescas y hermosas. </p>

                    <p class="stext-113 cl6 p-b-26">
                        En Hanako, creemos en la importancia de apoyar a los productores locales y en la sostenibilidad, por lo que seleccionamos cuidadosamente nuestras flores de los mejores cultivos de la región. Esta atención al detalle y nuestra pasión por lo que hacemos nos han convertido en una de las floristerías más queridas de Ciudad Real.
                    </p>

                    <p class="stext-113 cl6 p-b-26">
                        Te invitamos a visitarnos y descubrir la magia de Hanako. Estamos aquí para ayudarte a expresar tus sentimientos a través del lenguaje de las flores. </p>
                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1 ">
                    <div class="hov-img0">
                        <img src="<?= media() ?>/tienda/images/about-01.png" alt="IMG">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Te ayudamos en todo lo que necesites.
                    </h3>

                    <p class="stext-113 cl6 p-b-26">
                        Nuestro equipo de floristas profesionales está siempre dispuesto a asesorarte y ayudarte a elegir las flores perfectas para cada ocasión. Ofrecemos servicios de entrega a domicilio en Ciudad Real y alrededores, garantizando que tus flores lleguen frescas y a tiempo. </p>

                    <div class="bor16 p-l-29 p-b-9 m-t-22">
                        <p class="stext-114 cl6 p-r-40 p-b-11">
                            "Donde florecen las flores, también lo hace la esperanza." </p>

                        <span class="stext-111 cl8">
                            - Lady Bird Johnson
                        </span>
                    </div>
                </div>
            </div>

            <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                <div class="how-bor2">
                    <div class="hov-img0">
                        <img src="<?= media() ?>/tienda/images/about-02.png" alt="IMG">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php footerTienda($data); ?>