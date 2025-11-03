<h1 class="page__title">Restablecer Contraseña</h1>  
<p class="page__text">
    Restablece tu contraseña introduciendo tu correo electrónico para acceder a tu cuenta
</p> 

<?php 
    include_once __DIR__ . '/../templates/alerts.php';
?>

<form class="form" method="POST" action="<?php echo BASE_URL; ?>/restablecer-contrasenia">

    <div class="form__field">
        <label for="email" class="form__label">
            Correo electrónico
        </label>
        <input type="email" 
            id="email"
            name="email"
            placeholder="Tu correo"
            value=""
            class="form__input"
        />
    </div>

    <input type="submit" class="form__button" value="Restablecer contraseña">
    
</form>

<div class="acciones">
    <a href="<?php echo BASE_URL; ?>/" class="acciones__link">¿Tienes una cuenta? Inicia Sesión</a>
    <a href="<?php echo BASE_URL; ?>/crear-cuenta" class="acciones__link">¿No tienes una cuenta? Crear una</a>
</div>