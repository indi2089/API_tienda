<?php
require_once '../config.php';

// Obtener todas las ventas
function obtenerVentas() {
    $db = getDB();
    $sql = "SELECT * FROM ventas";
    $result = $db->query($sql);
    $ventas = [];
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
    $db->close();
    return json_encode($ventas);
}

// Agregar una nueva venta
function agregarVenta($data) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO ventas (usuario_id, total) VALUES (?, ?)");
    $stmt->bind_param("id", $data['usuario_id'], $data['total']);
    $stmt->execute();
    $stmt->close();
    $db->close();
    return json_encode(['id' => $db->insert_id]);
}

// Manejar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo obtenerVentas();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo agregarVenta($data);
}
?>