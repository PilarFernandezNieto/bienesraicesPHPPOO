<?php
require '../../includes/app.php';


use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$idActualizar = $_GET["id"];
$idActualizar = filter_var($idActualizar, FILTER_VALIDATE_INT);

if (!$idActualizar) {
    header("Location:/bienesracies/admin");
}
$propiedad = Propiedad::findById($idActualizar);
// Recogemos a los vendedores de la bbdd
$vendedores = Vendedor::findAll();

// ARRAY con mensajes de error
$errores = Propiedad::getErrores();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $args = $_POST["propiedad"];
    $propiedad->sincronizar($args);
    $errores = $propiedad->validar();


    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
        $imagen = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }


    // Debemos revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
            $imagen->save(CARPETA_IMAGENES . '/' . $nombreImagen);
        }
        $propiedad->guardar();

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

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

       
    </form>

</main>
<?php
incluirTemplate("footer");
?>