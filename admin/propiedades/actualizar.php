<?php
require '../../includes/funciones.php';
$auth = estaAutenticado();

if(!$auth){
    header("Location:/bienesraices");
}

$idActualizar = $_GET["id"];
$idActualizar = filter_var($idActualizar, FILTER_VALIDATE_INT);

if (!$idActualizar) {
    header("Location:/bienesracies/admin");
}

require "../../includes/config/database.php";
$db = conectarDB();

$sqlActualizar = "SELECT * FROM propiedades WHERE idpropiedad = $idActualizar";
$resulActualizar = mysqli_query($db, $sqlActualizar);
$propiedad = mysqli_fetch_assoc($resulActualizar);

$sqlVendedores = "SELECT * FROM  vendedores";
$resulVendedores = mysqli_query($db, $sqlVendedores);

// Validación de formularios
// ARRAY con mensajes de error
$errores = [];

$titulo = $propiedad["titulo"];
$precio = $propiedad["precio"];
$descripcion = $propiedad["descripcion"];
$habitaciones = $propiedad["habitaciones"];
$wc = $propiedad["wc"];
$estacionamiento = $propiedad["estacionamiento"];
$vendedorId = $propiedad["vendedorId"];
$imagenPropiedad = $propiedad["imagen"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


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

    // Validar por tamaño (1Mb máximo)
    $medida = 1000 * 1000;
    if ($imagen["size"] > $medida) {
        $errores[] = "La imagen es muy pesada";
    }

    // Debemos revisar que el arreglo de errores esté vacío
    if (empty($errores)) {

        /** SUBIDA DE ARCHIVOS */
        // Crear carpeta en la raíz del proyecto
        $carpetaImagenes = "../../imagenes/";
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        $nombreImagen = "";

        if($imagen["name"]){
            // Si se sube una nueva imagen debemos borrar la anterior
            unlink($carpetaImagenes . $propiedad["imagen"]);
           
            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Subir la imagen
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad["imagen"];
        }
   
  

        $sql = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedorId = $vendedorId WHERE idpropiedad = $idActualizar";

        echo $sql; 
      


        $resultado = mysqli_query($db, $sql);

        if ($resultado) {
            header('Location: /bienesraices/admin/?resultado=2');
        } else {
            echo "Error al insertar";
        }
    }
}

incluirTemplate("header");
?>


<main class="contenedor seccion">
    <h1>Actualizar</h1>
    <a href=" /bienesraices/admin" class="boton-verde">Volver</a>
    <?php if (!empty($errores)) : ?>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach ?>
    <?php endif ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $propiedad["titulo"]; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $propiedad["precio"]; ?>">

            <label for="imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/bienesraices/imagenes/<?php echo $imagenPropiedad; ?>" alt="imagen propiedad" class="imagen-small">

            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion"><?php echo $propiedad["descripcion"]; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la propiedad</legend>
            <div class="info-propiedad">
                <div>
                    <label for="habitaciones">Habitaciones</label>
                    <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $propiedad["habitaciones"]; ?>">
                </div>
                <div>
                    <label for="wc">Baños</label>
                    <input type="number" id="wc" name="wc" placeholder="Ej. 3" min="1" max="9" value="<?php echo $propiedad["wc"]; ?>">
                </div>
                <div>
                    <label for="estacionamiento">Estacionamiento</label>
                    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej. 3" min="1" max="9" value="<?php echo $propiedad["estacionamiento"]; ?>">
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor" id="vendedor">
                <option value="" selected>--Seleccione vendedor--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resulVendedores)) : ?>
                    <option <?php echo $propiedad["vendedorId"] === $vendedor["idvendedor"] ? 'selected' : ''; ?> value="<?php echo $vendedor['idvendedor']; ?>">
                        <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido'] ?>
                    </option>
                <?php endwhile ?>
            </select>
        </fieldset>
        <input type="submit" value="Actualizar" class="boton-verde">
    </form>

</main>
<?php
incluirTemplate("footer");
?>