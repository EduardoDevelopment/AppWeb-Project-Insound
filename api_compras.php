<?php
require 'config/config.php';
require 'config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Permite solicitudes desde cualquier origen (para evitar CORS)
header('Access-Control-Allow-Methods: GET'); // Solo permite solicitudes GET
header('Access-Control-Allow-Headers: Content-Type');

$conexion = new mysqli("localhost", "root", "", "registros");

// Verifica si la conexión es exitosa
if ($conexion->connect_error) {
    echo json_encode(["error" => "Error de conexión: " . $conexion->connect_error]);
    exit;
}

$query = "SELECT id, nombre FROM productos";
$resultado = $conexion->query($query);

$productos = [];
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila;
    }
    echo json_encode($productos);
} else {
    echo json_encode(["error" => "Error en la consulta: " . $conexion->error]);
}

$conexion->close();
?>
