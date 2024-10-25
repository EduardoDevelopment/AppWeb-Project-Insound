<?php
session_start();
include 'config/database.php';

// Verificar si el usuario tiene el rol de administrador
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $db = new Database();
    $conn = $db->conectar();

    $query = $conn->prepare("INSERT INTO login (usuario, email, password, role) VALUES (?, ?, ?, ?)");
    $query->execute([$usuario, $email, $password, $role]);

    header('Location: admin.php');
    exit();
}
?>
