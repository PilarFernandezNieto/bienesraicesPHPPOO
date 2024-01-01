<?php
require 'includes/app.php';
$db = conectarDB();
incluirTemplate("header");
?>
<main class="contenedor seccion">
    <h3>Casas y Depas en Venta</h3>
    <?php
    $limite = 10;
    include "includes/templates/anuncios.php"
    ?>

</main>
<?php
incluirTemplate("footer");
?>