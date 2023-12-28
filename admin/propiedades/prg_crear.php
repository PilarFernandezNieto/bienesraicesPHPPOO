<?php
require "../../includes/config/database.php";
$db = conectarDB();


// Validación de formularios
// ARRAY con mensajes de error
$errores = [];
// Recogemos a los vendedores de la bbdd
$sqlVendedores = "SELECT * FROM  vendedores";
$resulVendedores = mysqli_query($db, $sqlVendedores);

// Validación de formularios
// ARRAY con mensajes de error
$errores = [];

$titulo = "";
$precio = "";
$descripcion = "";
$habitaciones = "";
$wc = "";
$estacionamiento = "";
$vendedorId = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";


    $titulo = $_POST["titulo"];
    $precio = $_POST["precio"];
    $descripcion = $_POST["descripcion"];
    $habitaciones = $_POST["habitaciones"];
    $wc = $_POST["wc"];
    $estacionamiento = $_POST["estacionamiento"];
    $vendedorId = $_POST["vendedor"];

    if (!$titulo) {
        $errores[] = "Debes añadir un título";
    }
    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El número de wc es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El número de estacionamientos es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }


    // Debemos revisar que el arreglo de errores esté vacío
    if (empty($errores)) {

        // Insertar en la base de datos
        $sql = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ('$titulo' , '$precio', '$descripcion', $habitaciones, $wc, $estacionamiento, $vendedorId);";

        //$resultado = mysqli_query($db, $sql);

        if ($resultado) {
            echo "Insertado correctamente";
        } else {
            header('Location:http://localhost/bienesraices/admin/propiedades/crear.php');
           
        }
    } 
}
