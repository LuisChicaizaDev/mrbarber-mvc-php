<h1 class="page__title">Actualizar Servicio</h1>
<p class="page__text">
    Modifica los datos del servicio
</p>

<?php 
    include_once __DIR__ .'/../templates/nav-usuario.php';
    include_once __DIR__ .'/../templates/alerts.php';
?>

<!--Formulario el action irá a la misma página para resperar el id del query string-->
<form class="form" method="POST" action="">
    
    <?php 
        include_once __DIR__ . '/form.php';
    ?>

    <input type="submit" class="form__button" value="Actualizar Servicio">
</form>