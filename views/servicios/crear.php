<h1 class="page__title">Nuevo Servicio</h1>
<p class="page__text">
    Rellena todos los campos para crear un nuevo servicio
</p>

<?php 
    include_once __DIR__ .'/../templates/nav-usuario.php';
    include_once __DIR__ .'/../templates/alerts.php';
?>

<!--Formulario -->
<form class="form" method="POST" action="<?php echo BASE_URL; ?>/servicios/crear">
    
    <?php 
        include_once __DIR__ . '/form.php';
    ?>

    <input type="submit" class="form__button" value="Crear Servicio">
</form>