<?php
require '../../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
   header("Location:/bienesraices");
}

require "../../includes/config/database.php";
$db = conectarDB();
$idBorrar = $_GET["id"];
$idBorrar = filter_var($idBorrar, FILTER_VALIDATE_INT);

// Eliminar la imagen
$sql = "SELECT imagen FROM propiedades WHERE idpropiedad = $idBorrar";
$resultado = mysqli_query($db, $sql);
$propiedad = mysqli_fetch_assoc($resultado);
unlink("../../imagenes/" . $propiedad["imagen"]);



// Eliminar la propiedad
$sql = "DELETE FROM propiedades WHERE idpropiedad = $idBorrar";

$resultadoBorrar = mysqli_query($db, $sql);
if ($resultadoBorrar) {
   header("location: /bienesraices/admin?resultado=3");
}

