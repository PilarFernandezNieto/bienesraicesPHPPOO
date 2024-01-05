<fieldset>

    <legend>Información General</legend>
    <label for="titulo">Título</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Título Propiedad" value="<?php echo sanitizar($propiedad->titulo) ?>">
    <label for="precio">Precio</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if ($propiedad->imagen) : ?>
        <img src="../../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small" name="imagen_actualizar">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
</fieldset>
<fieldset>
    <legend>Información de la propiedad</legend>
    <div class="info-propiedad">
        <div>
            <label for="habitaciones">Habitaciones</label>
            <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej. 3" min="1" max="9" value="<?php echo sanitizar($propiedad->habitaciones); ?>">
        </div>
        <div>
            <label for="wc">Baños</label>
            <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej. 3" min="1" max="9" value="<?php echo sanitizar($propiedad->wc); ?>">
        </div>
        <div>
            <label for="estacionamiento">Estacionamiento</label>
            <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej. 3" min="1" max="9" value="<?php echo sanitizar($propiedad->estacionamiento); ?>">
        </div>
    </div>
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorId] id=" vendedor">
    <option value="" selected>--Seleccione vendedor--</option>
        <?php foreach ($vendedores as $vendedor) : ?>
            <option 
            <?php echo $propiedad->vendedorId === $vendedor->id ? "selected" : ""; ?>
             value="<?php echo sanitizar($vendedor->id); ?>"><?php echo sanitizar($vendedor->nombre). " " . sanitizar($vendedor->apellido); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>

<?php if (!$propiedad->id) : ?>
    <input type="submit" value="Enviar" class="boton-verde">
<?php else : ?>
    <input type="submit" value="Actualizar" class="boton-verde">

<?php endif; ?>