<div class="nav-usuario">
    <h2 class="nav-usuario__nombre">
        Hola, <?php echo $nombre ?? ''; ?> 👋🏼
    </h2>

    <a class="nav-usuario__cerrar-sesion" href="<?php echo BASE_URL; ?>/logout">
        <svg
        xmlns="http://www.w3.org/2000/svg"
        width="32"
        height="32"
        viewBox="0 0 24 24"
        fill="none"
        stroke="#ffffff"
        stroke-width="1"
        stroke-linecap="round"
        stroke-linejoin="round"
        >
        <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
        <path d="M9 12h12l-3 -3" />
        <path d="M18 15l3 -3" />
        </svg>

        Cerrar sesión
    </a>
</div>

<?php 
    if(isset($_SESSION['admin'])) {
?>
    <div class="nav-usuario__servicios">
        <a href="<?php echo BASE_URL; ?>/admin" class="button">
            Ver citas
        </a>
        <a href="<?php echo BASE_URL; ?>/servicios" class="button">
            Ver servicios
        </a>
        <a href="<?php echo BASE_URL; ?>/servicios/crear" class="button">
            Nuevo servicio
        </a>
    </div>
<?php
    }
?>