<?php
session_start();
include 'config/database.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $db = new Database();
    $conn = $db->conectar();

    $query = $conn->prepare("UPDATE login SET usuario = ?, email = ?, role = ? WHERE id = ?");
    $query->execute([$usuario, $email, $role, $id]);

    header('Location: admin.php');
    exit();
}
?>
