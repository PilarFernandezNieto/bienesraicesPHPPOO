<?php
require '../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth) {
    header("Location:/bienesraices");
}


require "../includes/config/database.php";
$db = conectarDB();

// Escribir la consulta
$sql = "SELECT * FROM propiedades";

// Consultar la bbdd
$resultadoConsulta = mysqli_query($db, $sql);


// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

// Incluye templates

incluirTemplate("header");
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito"> Anuncio creado correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito"> Anuncio actualizado correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito"> Anuncio eliminado correctamente</p>
    <?php endif ?>


    <a href="/bienesraices/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!--Mostrar los resultados aquí -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad["idpropiedad"]; ?></td>
                    <td><?php echo $propiedad["titulo"]; ?></td>
                    <td>
                        <img src="../imagenes/<?php echo $propiedad["imagen"]; ?>" class="imagen-tabla">
                    </td>
                    <td><?php echo $propiedad["precio"]; ?></td>
                    <td class="acciones">
                        <a href="propiedades/borrar.php?id=<?php echo $propiedad['idpropiedad']; ?>" class="boton-rojo-block">Eliminar</a>
                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad['idpropiedad']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile ?>
        </tbody>
    </table>
</main>
<?php
mysqli_close($db);
incluirTemplate("footer");
?>