 <?php
    require '../../includes/app.php';
    estaAutenticado();

    use App\Vendedor;

    $vendedores = Vendedor::findAll();

    $resultado = $_GET["resultado"] ?? null;
    incluirTemplate("header");
    ?>
 <main class="contenedor seccion">
     <?php
        $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje) : ?>
        <p class="alerta exito"><?php echo sanitizar($mensaje); ?></p>
        
        <?php endif;?>


     <h3>Vendedores</h3>
     <a href="/bienesraices/admin/vendedores/crear.php" class="boton-verde">Nuevo Vendedor</a>
     <table class="propiedades">
         <thead>
             <tr>
                 <th>ID</th>
                 <th>Nombre</th>
                 <th>Teléfono</th>
                 <th>Acciones</th>
             </tr>
         </thead>
         <tbody> <!--Mostrar los resultados aquí -->
             <?php foreach ($vendedores as $vendedor) : ?>
                 <tr>
                     <td><?php echo $vendedor->id; ?></td>
                     <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>

                     <td><?php echo $vendedor->telefono; ?></td>
                     <td class="acciones">
                         <form action="/bienesraices/admin/vendedores/borrar.php" method="POST">
                             <input type="hidden" name="tipo" value="vendedor">
                             <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                             <input type="submit" class="boton-rojo-block w-100" value="Eliminar">
                         </form>
                         <a href="/bienesraices/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                     </td>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </main>
 <?php
    incluirTemplate("footer");
    ?>