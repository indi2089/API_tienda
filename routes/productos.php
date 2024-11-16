<?php
require_once '../config.php';

// Obtener todos los productos
function obtenerProductos() {
    $db = getDB();
    $sql = "SELECT * FROM productos";
    $result = $db->query($sql);
    $productos = [];
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
    $db->close();
    return json_encode($productos);
}

// Agregar un nuevo producto
function agregarProducto($data) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO productos (nombre, descripcion, precio, categoria_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $data['nombre'], $data['descripcion'], $data['precio'], $data['categoria_id']);
    $stmt->execute();
    $stmt->close();
    $db->close();
    return json_encode(['id' => $db->insert_id]);
}

// Manejar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo obtenerProductos();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo agregarProducto($data);
}
?>