<div class="form__field">
    <label for="nombre" class="form__label">Nombre Servicio</label>
    <input 
        type="text" 
        id="nombre" 
        name="nombre" 
        class="form__input" 
        placeholder="Nombre del servicio" 
        value="<?php echo $servicio->nombre; ?>"
    />
</div>

<div class="form__field">
    <label for="nombre" class="form__label">Precio Servicio</label>
    <input 
        type="number" 
        id="precio" 
        name="precio" 
        class="form__input" 
        placeholder="Ej: 20" 
        value="<?php echo $servicio->precio; ?>"
    />
</div>