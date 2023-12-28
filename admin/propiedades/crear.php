<?php

require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header("Location:/bienesraices");
}

require "../../includes/config/database.php";
$db = conectarDB();
// Validación de formularios
// ARRAY con mensajes de error
$errores = [];
// Recogemos a los vendedores de la bbdd
$sqlVendedores = "SELECT * FROM  vendedores";
$resulVendedores = mysqli_query($db, $sqlVendedores);

// Validación de formularios
// ARRAY con mensajes de error
$errores = [];

$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = "";
$estacionamiento = "";
$vendedorId = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";



    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedorId = mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date('Y-m-d');

    // Asignar files a una variable
    $imagen = $_FILES["imagen"];

    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El número de wc es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El número de estacionamientos es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }
    if(!$imagen['name'] || $imagen["error"]){
        $errores[] = "La imagen es obligatoria";
    }

    // Validar por tamaño (1Mb máximo)
    $medida = 1000*1000;
    if($imagen["size"] > $medida){
        $errores[] = "La imagen es muy pesada";
    }


    // Debemos revisar que el arreglo de errores esté vacío
    if (empty($errores)) {

        /** SUBIDA DE ARCHIVOS */
        // Crear carpeta en la raíz del proyecto
        $carpetaImagenes = "../../imagenes/"; 
        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        // Generar un nombre único
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Subir la imagen
        move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen  );
       

        // Insertar en la base de datos
        $sql = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId ) VALUES ('$titulo' , '$precio', '$nombreImagen', '$descripcion', $habitaciones, $wc, $estacionamiento, '$creado', $vendedorId);";

        $resultado = mysqli_query($db, $sql);

        if ($resultado) {
            header('Location: /bienesraices/admin/?resultado=1');
        } else {
            echo "Error al insertar";
        }
    }
}

incluirTemplate("header");
?>


<main class="contenedor seccion">


    <h1>Crear</h1>
    <a href=" /bienesraices/admin" class="boton-verde">Volver</a>
    <?php if (!empty($errores)) : ?>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach ?>
    <?php endif ?>

    <form action="/bienesraices/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la propiedad</legend>
            <div class="info-propiedad">
                <div>
                    <label for="habitaciones">Habitaciones</label>
                    <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $habitaciones; ?>">
                </div>
                <div>
                    <label for="wc">Baños</label>
                    <input type="number" id="wc" name="wc" placeholder="Ej. 3" min="1" max="9" value="<?php echo $wc; ?>">
                </div>
                <div>
                    <label for="estacionamiento">Estacionamiento</label>
                    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor" id="vendedor">
                <option value="" selected>--Seleccione vendedor--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resulVendedores)) : ?>
                    <option <?php echo $vendedorId === $vendedor['idvendedor'] ? 'selected' : ''; ?> value="<?php echo $vendedor['idvendedor']; ?>">
                        <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido'] ?>
                    </option>
                <?php endwhile ?>
            </select>
        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>

</main>
<?php
incluirTemplate("footer");
?>