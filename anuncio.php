<?php

require "includes/config/database.php";
$db = conectarDB();

require 'includes/funciones.php';
incluirTemplate("header");

$id = $_GET["id"];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: /bienesraices");
}

$query = "SELECT * FROM propiedades WHERE idpropiedad = $id";
$resultado = mysqli_query($db, $query);

if($resultado->num_rows == 0){
    header("location:/bienesraices");
}

echo "<pre>";
var_dump($resultado->num_rows);
echo "</pre>";

$propiedad = mysqli_fetch_assoc($resultado);


?>
<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad["titulo"]; ?></h1>
    <img src="imagenes/<?php echo $propiedad["imagen"]; ?>" alt="imagen de la propiedad" loading="lazy">
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad["precio"]; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                <p><?php echo $propiedad["wc"]; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                <p><?php echo $propiedad["habitaciones"]; ?></p>
            </li>
            <li>
                <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                <p><?php echo $propiedad["estacionamiento"]; ?></p>
            </li>
        </ul>
        <p>
            <?php echo $propiedad["descripcion"]; ?>
        </p>
    </div>
</main>
<?php

mysqli_close($db);
incluirTemplate("footer");
?>