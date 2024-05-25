<?php
headerTienda($data);
?>

<!-- Lo que hacemos con el siguiente script es que cuando carguemos esta vista se va a cambiar el estilo del header -->
<script>
    document.querySelector('header').classList.add('header-v4');
</script>

<div class="container text-center">
    <main class="app-content">
        <div class="page-error tile">
            <h1><i class="fa fa-exclamation-circle"></i>Error 404: Página no encontrada</h1>
            <p>No se encuentra la página que ha solicitado.</p>
            <p><a class="btn btn-dark" href="javascript:window.history.back();">Volver</a></p>
        </div>
    </main>
</div>

<?php footerTienda($data); ?>