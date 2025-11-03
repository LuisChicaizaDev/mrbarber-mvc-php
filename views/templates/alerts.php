<?php
    // Iteramos sobre el tipo de alerta error o exito
    foreach ($alertas as $key => $alerta):
        // Iteramos sobre cada uno de los mensajes
        foreach ($alerta as $mensaje):
?>
   <div class="alerta-container">
        <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
        </div>
   </div>
<?php
        endforeach; 
    endforeach;
    
?>