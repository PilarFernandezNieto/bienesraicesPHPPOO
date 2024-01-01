<?php


define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', realpath(__DIR__ . '../../imagenes/'));
//define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/bienesraices/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/" . $nombre . ".php";
}

function estaAutenticado() {
    session_start();
    if (!$_SESSION["login"]) {
        header("Location:/bienesraices");
    }
}

function mivardump($item, $exit = true): void {
    echo "<pre>";
    var_dump($item);
    echo "</pre";
    if ($exit) {
        exit;
    }
}

// Escapar / Sanitiizar el HTML
function sanitizar($html): string {
    $sanitizado = htmlspecialchars($html ?? '');
    return $sanitizado;
}
function validarTipoContenido($tipo) {
    $tipos = ["vendedor", "propiedad"];
    return in_array($tipo, $tipos);
}

// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = "";
    switch ($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
