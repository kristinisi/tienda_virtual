<script>
    const base_url = "<?= base_url(); ?>";
</script>

<!-- JavaScripts esenciales para que la aplicación funcione-->
<script src="<?= media(); ?>/js/jquery-3.7.0.min.js"></script>
<script src="<?= media(); ?>/js/popper.min.js"></script>
<script src="<?= media(); ?>/js/bootstrap.min.js"></script>
<script src="<?= media(); ?>/js/main.js"></script>
<script src="<?= media(); ?>/js/fontawesome.js"></script>
<!-- El plugin de JavaScript para mostrar la carga de la página en la parte superior-->
<script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>

<!-- Data table plugin-->
<script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?= media(); ?>/js/plugins/bootstrap-select.min.js"></script>

<!-- Llamado a las funciones js -->
<script src="<?= media(); ?>/js/functions_admin.js"></script>
<script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>

</body>

</html>