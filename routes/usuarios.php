<?php
require_once '../config.php';

// Obtener todos los usuarios
function obtenerUsuarios() {
    $db = getDB();
    $sql = "SELECT * FROM usuarios";
    $result = $db->query($sql);
    $usuarios = [];
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    $db->close();
    return json_encode($usuarios);
}

// Agregar un nuevo usuario
function agregarUsuario($data) {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $data['nombre'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT));
    $stmt->execute();
    $stmt->close();
    $db->close();
    return json_encode(['id' => $db->insert_id]);
}

// Manejar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo obtenerUsuarios();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo agregarUsuario($data);
}
?>