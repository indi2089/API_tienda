<?php
require_once '../config.php';

// Obtener todos los detalles de ventas
function obtenerDetalleVentas() {
    $db = getDB();
    $sql = "SELECT * FROM detalle_ventas";
    $result = $db->query($sql);
    $detalle_ventas = [];
    while ($row = $result->fetch_assoc()) {
        $detalle_ventas[] = $row;
    }
    $db->close();
    return json_encode($detalle_ventas);
}

// Agregar un nuevo detalle de venta
function agregarDetalleVenta($data) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO detalle_ventas (venta_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiid", $data['venta_id'], $data['producto_id'], $data['cantidad'], $data['precio']);
    $stmt->execute();
    $stmt->close();
    $db->close();
    return json_encode(['id' => $db->insert_id]);
}

// Manejar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo obtenerDetalleVentas();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo agregarDetalleVenta($data);
}
?>