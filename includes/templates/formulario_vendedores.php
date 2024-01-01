        <fieldset>

            <legend>Información General</legend>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre" value="<?php echo sanitizar($vendedor->nombre) ?>">
            <label for="apellido">Apellido</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido" value="<?php echo sanitizar($vendedor->apellido); ?>">
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono" value="<?php echo sanitizar($vendedor->telefono); ?>">

        </fieldset>

        <?php if (!$vendedor->id) : ?>
            <input type="submit" value="Enviar" class="boton-verde">
        <?php else : ?>
            <input type="submit" value="Actualizar" class="boton-verde">

        <?php endif; ?>