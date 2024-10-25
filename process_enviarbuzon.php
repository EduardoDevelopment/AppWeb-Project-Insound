<?php
require 'config/database.php'; // Incluir el archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $mensaje = $_POST['message'];

    // Conectar a la base de datos
    $db = new Database();
    $pdo = $db->conectar();

    // Insertar los datos en la tabla
    $sql = "INSERT INTO buzon (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mensaje', $mensaje);

    if ($stmt->execute()) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Hubo un error al enviar el mensaje.";
    }
}
?>
