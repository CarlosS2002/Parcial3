<?php
// index.php - Front Controller

require_once __DIR__ . '/config/database.php';

// Inicia sesión solo una vez (no lo repitas en los controladores)
session_start([
    'cookie_httponly' => true,
    'cookie_secure' => false // true si usas HTTPS
]);

// Lee la ruta amigable (?route=modulo/accion/param)
$route = $_GET['route'] ?? 'producto/listar';

$modulo = 'producto';
$accion = 'listar';
$param = null;

if ($route) {
    $partes = explode('/', trim($route, '/'));
    if (isset($partes[0]) && $partes[0] !== '') $modulo = strtolower($partes[0]);
    if (isset($partes[1]) && $partes[1] !== '') $accion = strtolower($partes[1]);
    if (isset($partes[2]) && $partes[2] !== '') $param = $partes[2];
}

// Carga el controlador
$claseControlador = ucfirst($modulo) . 'Controller';
$archivoControlador = __DIR__ . '/controllers/' . $claseControlador . '.php';

if (!file_exists($archivoControlador)) {
    http_response_code(404);
    echo "Controlador '$claseControlador' no encontrado.";
    exit;
}

require_once $archivoControlador;

if (!class_exists($claseControlador)) {
    http_response_code(500);
    echo "Clase '$claseControlador' no existe.";
    exit;
}

$controlador = new $claseControlador();

// Ejecuta la acción, con parámetro si existe
if (!method_exists($controlador, $accion)) {
    http_response_code(404);
    echo "Acción '$accion' no encontrada en el controlador '$claseControlador'.";
    exit;
}

if ($param !== null) {
    $controlador->$accion($param);
} else {
    $controlador->$accion();
}
?>
