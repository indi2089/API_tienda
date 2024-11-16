<?php
header("Content-Type: application/json");

$requestUri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$resource = $requestUri[1] ?? '';

switch ($resource) {
    case 'categorias':
        require 'routes/categorias.php';
        break;
    case 'productos':
        require 'routes/productos.php';
        break;
    case 'usuarios':
        require 'routes/usuarios.php';
        break;
    case 'ventas':
        require 'routes/ventas.php';
        break;
    case 'detalle_ventas':
        require 'routes/detalle_ventas.php';
        break;
    default:
        echo json_encode(['mensaje' => 'Recurso no encontrado']);
        break;
}
?>