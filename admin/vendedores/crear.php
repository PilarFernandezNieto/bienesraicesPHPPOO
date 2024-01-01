<?php

require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor();

$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $vendedor = new Vendedor($_POST["vendedor"]);
    $errores = $vendedor->validar();

    // Si no hay errores
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate("header");
?>


<main class="contenedor seccion">
    <h1>Registrar Vendedor/a</h1>
    <a href=" /bienesraices/admin" class="boton-verde">Volver</a>
    <?php if (!empty($errores)) : ?>
        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error ?>
            </div>

        <?php endforeach ?>
    <?php endif ?>

    <form action="/bienesraices/admin/vendedores/crear.php" class="formulario" method="POST">
        <?php include '../../includes/templates/formulario_vendedores.php'; ?>


    </form>

</main>
<?php
incluirTemplate("footer");
?>