<?php
require_once '../config.php';

// Obtener todas las categorías
function obtenerCategorias() {
    $db = getDB();
    $sql = "SELECT * FROM categorias";
    $result = $db->query($sql);
    $categorias = [];
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
    $db->close();
    return json_encode($categorias);
}

// Agregar una nueva categoría
function agregarCategoria($data) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO categorias (nombre) VALUES (?)");
    $stmt->bind_param("s", $data['nombre']);
    $stmt->execute();
    $stmt->close();
    $db->close();
    return json_encode(['id' => $db->insert_id]);
}

// Manejar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo obtenerCategorias();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo agregarCategoria($data);
}
?>