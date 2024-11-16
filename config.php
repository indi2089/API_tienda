<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Cambia esto si tienes un usuario diferente
define('DB_PASS', ''); // Cambia esto si tienes una contraseña
define('DB_NAME', 'api_tienda');

function getDB() {
    $dbConnection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($dbConnection->connect_error) {
        die("Connection failed: " . $dbConnection->connect_error);
    }
    return $dbConnection;
}
?>