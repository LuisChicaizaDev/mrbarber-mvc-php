<h1 class="page__title">Login</h1>
<p class="page__text">Inicia sesión con tus datos</p>

<?php
    // Incluir el archivo de alertas
    include_once __DIR__ . '/../templates/alerts.php';
?>

<!--Formulario -->
<form class="form" method="POST" action="<?php echo BASE_URL; ?>/">
    <div class="form__field">
        <label for="email" class="form__label">Correo electrónico</label>
        <input 
            type="email" 
            id="email" 
            name="email" 
            class="form__input" 
            placeholder="Tu correo" 
            value="<?php echo s($auth->email); ?>"
            
        />
    </div>
    <div class="form__field">
        <label for="password" class="form__label">Contraseña</label>
        <input 
            type="password" 
            id="password" 
            name="password" 
            class="form__input" 
            placeholder="Tu contraseña" 
            
        />
    </div>
    <input type="submit" class="form__button" value="Iniciar Sesión">
</form>

<div class="acciones">
    <a href="<?php echo BASE_URL; ?>/crear-cuenta" class="acciones__link">¿No tienes una cuenta? Crear una</a>
    <a href="<?php echo BASE_URL; ?>/restablecer-contrasenia" class="acciones__link">¿Olvidaste tu contraseña?</a>
</div>

<!-- Usuario Demo-->
<div class="user-demo">
    <p class="user-demo__text">
        Correo: <span>usuario@demo.com</span>
    </p>

    <p class="user-demo__text">
        Contraseña: <span>userdemo</span>
    </p>
</div>