<?php

require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();

$idActualizar = $_GET["id"];
$idActualizar = filter_var($idActualizar, FILTER_VALIDATE_INT);

if (!$idActualizar) {
    header("Location:/bienesracies/admin");
}
$vendedor = Vendedor::findById($idActualizar);


$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $args = $_POST["vendedor"];

    // Sincronizar con el objeto en memoria
    $vendedor->sincronizar($args);
    $errores = $vendedor->validar();
   

    // Debemos revisar que el arreglo de errores esté vacío
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate("header");
?>


<main class="contenedor seccion">
    <h1>Actualizar Vendedor/a</h1>
    <a href=" /bienesraices/admin" class="boton-verde">Volver</a>
    <?php if (!empty($errores)) : ?>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach ?>
    <?php endif ?>

    <form  class="formulario" method="POST">

        <?php include '../../includes/templates/formulario_vendedores.php'; ?>


    </form>

</main>
<?php
incluirTemplate("footer");
?>