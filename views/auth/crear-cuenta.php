<h1 class="page__title">Crear Cuenta</h1>
<p class="page__text">
    Rellena el siguiente formulario para crear una cuenta
</p>

<?php 
    // Incluir el archivo de alertas
    // DIR ruta completa del directorio actual
    include_once __DIR__ . '/../templates/alerts.php';
?>

<form class="form" method="POST" action="<?php echo BASE_URL; ?>/crear-cuenta">
    <div class="form__field">
        <label for="nombre" class="form__label">
            Nombre
        </label>
        <input type="text" 
            id="nombre"
            name="nombre"
            placeholder="Tu nombre"
            value="<?php echo s($usuario->nombre); ?>"
            class="form__input"
        />
    </div>

    <div class="form__field">
        <label for="apellido" class="form__label">
            Apellido
        </label>
        <input type="text" 
            id="apellido"
            name="apellido"
            placeholder="Tu apellido"
            value="<?php echo s($usuario->apellido); ?>"
            class="form__input"
        />
    </div>

    <div class="form__field">
        <label for="telefono" class="form__label">
            Teléfono
        </label>
        <input type="tel" 
            id="telefono"
            name="telefono"
            placeholder="Tu teléfono"
            value="<?php echo s($usuario->telefono); ?>"
            class="form__input"
        />
    </div>

    <div class="form__field">
        <label for="email" class="form__label">
            Correo electrónico
        </label>
        <input type="email" 
            id="email"
            name="email"
            placeholder="Tu correo"
            value="<?php echo s($usuario->email); ?>"
            class="form__input"
        />
    </div>

    <div class="form__field">
        <label for="password" class="form__label">
            Contraseña
        </label>
        <input type="password" 
            id="password"
            name="password"
            placeholder="Tu contraseña"
            value=""
            class="form__input"
        />
    </div>

    <input type="submit" class="form__button" value="Crear cuenta">
    
</form>

<div class="acciones">
    <a href="<?php echo BASE_URL; ?>/" class="acciones__link">¿Tienes una cuenta? Inicia Sesión</a>
    <a href="<?php echo BASE_URL; ?>/restablecer-contrasenia" class="acciones__link">¿Olvidaste tu contraseña?</a>
</div>