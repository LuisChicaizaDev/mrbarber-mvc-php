<h1 class="page__title">Panel de Administración</h1>
<p class="page__text">
    Desde este panel podrás administrar las citas de tus clientes
</p>

<?php

use Model\Cita;

 include_once __DIR__ . '/../templates/nav-usuario.php';
?>

<div class="busqueda">
    <h3>Buscar citas</h3>
    <form class="form">
        <div class="form__field">
            <label for="fecha" class="form__label">
                Fecha
            </label>
            <input type="date" 
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>" 
                class="form__input"
            />
        </div>
    </form>
</div>

<?php 
    if(count($citas) === 0) {
?>
    <div class="sin-citas">
        <h3>No tienes citas para el día de hoy</h3>
    </div>
<?php
    }
?>

<div id="citas-admin">

    <ul class="lista-citas">
        <?php
            $idCita = 0;
            foreach($citas as $index => $cita) {

                // Para evitar que se muestras las citas con el mismo id varias veces
                if($idCita !== $cita->id) {

                    $total = 0; // Sumar el precio total de los servicios
        ?>
            <li>
               <p>
                    ID: <span> <?php echo $cita->id; ?> </span>
               </p>
               <p>
                    Hora: <span> <?php echo $cita->hora; ?> </span>
               </p>
               <p>
                    Cliente: <span> <?php echo $cita->cliente; ?> </span>
               </p>
               <p>
                    Correo: <span> <?php echo $cita->email; ?> </span>
               </p>
               <p>
                    Teléfono: <span> <?php echo $cita->telefono; ?> </span>
               </p>

               <h3>Servicios</h3>

                <?php
                    $idCita = $cita->id;
                } // cierre if 

                    // Precio total servicios
                    $total += $cita->precio;
                ?>

                <p class="servicio">
                    <?php echo $cita->servicio . ": " . $cita->precio . " €"; ?>
                </p>

            <?php 
                // Vamos a tener el registro acutal y el siguiente registro del resultado de la columna de la bbdd
                $actual = $cita->id; // El id que se encuentra
                $siguiente = $citas[$index + 1]-> id ?? 0; // Retorna el siguiente id y cuando esté en el últim0o elemento del array me devuelve 0

                if (isLast($actual, $siguiente)) {
            ?>
                    <p class="total">Total: <span><?php echo $total; ?> €</span></p>

                    <!--Opcion para eliminar la cita, el action hacia el endopoint eliminar-->
                    <form method="POST" action="<?php echo BASE_URL; ?>/api/eliminar">
                        <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                        <input type="submit" class="button" value="Eliminar">
                    </form>
            <?php
                } //cierre if precio

            } // cierre foreach
        ?>  
    </ul>

</div>

<?php 
    // para que cargue solo este script en esta vista
    $script = "<script src='assets/js/buscador.js'></script>";
?>