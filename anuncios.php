<?php
require "includes/config/database.php";
$db = conectarDB();

require 'includes/funciones.php';
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