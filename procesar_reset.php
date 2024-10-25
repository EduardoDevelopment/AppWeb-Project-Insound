<?php
// procesar_reset.php

// Configuración de la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registros";

header('Content-Type: application/json; charset=utf-8');

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que se recibieron los datos necesarios
    if (isset($_POST['email']) && isset($_POST['new_password'])) {
        // Obtener el correo electrónico y la nueva contraseña del formulario
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];

        // Conectar a la base de datos
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        $conn->set_charset("utf8"); // Asegurar que la conexión utilice UTF-8

        // Verificar la conexión
        if ($conn->connect_error) {
            die(json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error], JSON_UNESCAPED_UNICODE));
        }

        // Verificar si el correo electrónico está registrado
        $stmt = $conn->prepare("SELECT id FROM login WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Actualizar la contraseña en la base de datos
            $stmt->close();
            $stmt = $conn->prepare("UPDATE login SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $new_password, $email);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Contraseña actualizada correctamente'], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error actualizando la contraseña: ' . $stmt->error], JSON_UNESCAPED_UNICODE);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Correo no válido'], JSON_UNESCAPED_UNICODE);
        }

        // Cerrar la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Faltan datos en el formulario'], JSON_UNESCAPED_UNICODE);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido'], JSON_UNESCAPED_UNICODE);
}
?>
