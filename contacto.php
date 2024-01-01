<?php
require 'includes/app.php';
incluirTemplate("header");
?>
<main class="contenedor">
    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>
    <h2>Rellene el formulario de contacto</h2>
    <form action="" class="formulario">

        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre">

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Tu E-mail">

            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono">

            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o compra</label>
            <select name="opciones" id="opciones">
                <option value="" disable selected> -- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" id="presupuesto" name="presupuesto" placeholder="Precio o Presupuesto">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>¿Cómo desea ser contactado?</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contactar-telefono" name="contacto">

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contactar-email" name="contacto">
            </div>
            <p>Si eligió teléfono, indique fecha y hora para ser contactado</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha">

            <label for="hora">Hora</label>
            <input type="time" id="hora" name="hora" min="09:00" max="18:00">
        </fieldset>

        <input type="submit" name="" value="Enviar" class="boton-verde">

    </form>
</main>
<?php
incluirTemplate("footer");
?>