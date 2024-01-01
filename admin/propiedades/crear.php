<?php

require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$propiedad = new Propiedad();
$vendedores = Vendedor::findAll();

$errores = Propiedad::getErrores();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = new Propiedad($_POST["propiedad"]);

    // Generar un nombre único para la imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";


    if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {

        $imagen = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores = $propiedad->validar();

    // Si no hay errores
    if (empty($errores)) {

        //  Crear carpeta en la raíz del proyecto
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }
          
        $imagen->save(CARPETA_IMAGENES . '/' . $nombreImagen);
      $propiedad->guardar();


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
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        
    </form>

</main>
<?php
incluirTemplate("footer");
?>