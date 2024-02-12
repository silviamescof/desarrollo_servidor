<?php
$host = 'localhost'; // Cambia esto al nombre de tu servidor de base de datos
$dbname = 'vehiculosbd'; // Cambia esto al nombre de tu base de datos
$username = 'root'; // Cambia esto al nombre de usuario de tu base de datos
$password = ''; // Cambia esto a tu contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configurar PDO para mostrar errores de MySQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

