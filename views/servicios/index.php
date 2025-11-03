<h1 class="page__title">Servicios</h1>
<p class="page__text">
    Aquí podrás gestionar tus servicios
</p>

<?php 
    include_once __DIR__ .'/../templates/nav-usuario.php';
?>

<!--Alert de exito acciones -->
<?php if (!empty($mensaje_exito)) : ?>
    <div class="alerta exito" role="alert">
        <?php echo $mensaje_exito; ?>
    </div>
<?php endif; ?>

<ul class="servicios">
    <?php 
        // Recorremos el array
        foreach ($servicios as $servicio) {
    ?>

        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span><?php echo $servicio->precio; ?> €</span></p>

            <!--Acciones-->
            <div class="acciones">
                <a class="button button-actualizar" href="<?php echo BASE_URL; ?>/servicios/actualizar?id=<?php echo $servicio->id; ?>">
                    Actualizar
                </a>

                <form method="POST" action="<?php echo BASE_URL; ?>/servicios/eliminar">
                    <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">

                    <input type="submit" value="Eliminar" class="button button-eliminar">
                </form>
            </div>
        </li>
    <?php
        }
    ?>
</ul>