<h1 class="page__title">Crear Nueva Cita</h1>
<p class="page__text">Elige tus servicios y rellena tus datos</p>

<?php 
 include_once __DIR__ . '/../templates/nav-usuario.php';
?>

<!--Seccion para reservar la cita-->
<div class="app">

    <!--Tabs -->
    <nav class="tabs">
        <button class="active" type="button" data-paso="1">1. Servicios</button>
        <button type="button" data-paso="2">2. Información Cita</button>
        <button type="button" data-paso="3">3. Resumen</button>
    </nav>

    <!--Paso 1 Servicios-->
    <div class="seccion" id="paso-1">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div class="listado-servicios" id="servicios"></div>
    </div>

    <!--Paso 2 Datos-->
    <div class="seccion contenido-datos" id="paso-2">
        <h2>Tus datos y Cita</h2>
        <p class="text-center">Rellena tus datos y selecciona la fecha y hora de tu cita</p>

        <div class="alerta-container"></div>

        <form class="form" action="">
            <div class="form__field">
                <label for="nombre" class="form__label">Nombre</label>
                <input 
                    type="text" 
                    id="nombre" 
                    name="nombre" 
                    class="form__input" 
                    placeholder="Tu nombre"               
                    value="<?php echo $nombre; ?>"      
                    disabled
                />
            </div>
            <div class="form__field">
                <label for="fecha" class="form__label">Fecha</label>
                <input 
                    type="date" 
                    id="fecha" 
                    name="fecha" 
                    class="form__input" 
                    min=<?php echo date('Y-m-d'); ?>                  
                />
            </div> 
            <div class="form__field">
                <label for="hora" class="form__label">Hora</label>
                <input 
                    type="time" 
                    id="hora" 
                    name="hora" 
                    class="form__input"                    
                />
            </div>

            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form>
    </div>

    <!--Paso 3 Resumen-->
    <div class="seccion contenido-resumen" id="paso-3">
        <div class="alerta-container"></div>

        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <!--Paginacion-->
    <div class="paginacion">
        <button id="prev" class="button">
            &laquo; Anterior
        </button>

        <button id="next" class="button">
            Siguiente &raquo;
        </button> 
    </div>
</div>

<?php 
    // El script se agrega en una variable para luego ser impreso en el layout.php
    // Paso la constante BASE_URL para consultar la API 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            const BASE_URL = '" . BASE_URL . "';
        </script>
        <script src='" . BASE_URL . "/assets/js/app.js'></script>
    ";
?>