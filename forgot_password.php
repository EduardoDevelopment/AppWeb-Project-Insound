<?php
session_start();
include 'config/confiig.php';

header('Content-Type: application/json'); // Asegúrate de que la salida sea JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => 'Correo electrónico no válido.']);
        exit();
    }

    if (!$conn) {
        echo json_encode(['success' => false, 'error' => 'Error en la conexión a la base de datos: ' . mysqli_connect_error()]);
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM login WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        echo json_encode(['success' => false, 'error' => 'Error en la consulta SQL: ' . $conn->error]);
        exit();
    }

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $conn->prepare("UPDATE login SET reset_token = ?, reset_token_expiry = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expiry, $email);
        if ($stmt->execute() === TRUE) {
            echo json_encode(['success' => true, 'data' => ['token' => $token, 'username' => $user['usuario']]]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al generar el token de restablecimiento: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No se encontró una cuenta con ese correo electrónico.']);
    }
    $stmt->close();
    $conn->close();
    exit();
} else {
    echo json_encode(['success' => false, 'error' => 'Método de solicitud no permitido.']);
    exit();
}
?>
