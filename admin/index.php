<?php
require '../includes/app.php';
estaAutenticado();

use App\Propiedad;
use App\Vendedor;

//Implementar un método para obtener todas las propiedades (Active Record)
$propiedades = Propiedad::findAll();
$vendedores = Vendedor::findAll();

// Muestra mensaje condicional
$resultado = $_GET["resultado"] ?? null;

// Incluye templates
incluirTemplate("header");
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>
    <?php
    $mensaje = mostrarNotificacion(intval($resultado));
    if ($mensaje) : ?>

        <p class="alerta exito"><?php echo sanitizar($mensaje); ?></p>

    <?php endif; ?>


    <a href="/bienesraices/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>
    <a href="/bienesraices/admin/vendedores/listado.php" class="boton-amarillo">Listado Vendedores</a>
    <h3>Propiedades</h3>
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
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td>
                        <img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla">
                    </td>
                    <td><?php echo $propiedad->precio; ?></td>
                    <td class="acciones">
                        <form action="propiedades/borrar.php" method="POST">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                        </form>

                        <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>
<?php
incluirTemplate("footer");
?>