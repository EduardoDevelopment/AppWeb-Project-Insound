<?php
session_start();
include 'config/database.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];

    $db = new Database();
    $conn = $db->conectar();

    $stmt = $conn->prepare("DELETE FROM login WHERE id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: admin.php');
    exit();
}
?>
