<h1 class="page__title">Recuperar Contraseña</h1>  
<p class="page__text">
    Ingresa tu nueva contraseña para recuperar el acceso a tu cuenta
</p> 

<?php 
    include_once __DIR__ . '/../templates/alerts.php';
?>

<?php if($error) return; ?>

<!-- NO tiene action para no perder la referencia del token en la url-->
<form class="form" method="POST">

    <div class="form__field">
        <label for="password" class="form__label">
            Nueva Contraseña
        </label>
        <input type="password" 
            id="password"
            name="password"
            placeholder="Tu contraseña"
            value=""
            class="form__input"
        />
    </div>

    <input type="submit" class="form__button" value="Guardar contraseña">
    
</form>


<div class="acciones">
    <a href="<?php echo BASE_URL; ?>/" class="acciones__link">¿Tienes una cuenta? Inicia Sesión</a>
    <a href="<?php echo BASE_URL; ?>/crear-cuenta" class="acciones__link">¿No tienes una cuenta? Crear una</a>
</div>