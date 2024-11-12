<?php
session_start();

require_once 'LoggerObserver.php';

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registros";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

header('Content-Type: application/json');

if (!$conn) {
    registrarLog("Error de conexión a la base de datos.");
    echo json_encode(array('error' => "Error de conexión: " . mysqli_connect_error()));
    exit();
}

if (isset($_POST['txtusuario']) && isset($_POST['txtpassword'])) {
    $nombre = $_POST['txtusuario'];
    $pass = $_POST['txtpassword'];

    $nombre = mysqli_real_escape_string($conn, $nombre);
    $pass = mysqli_real_escape_string($conn, $pass);

    $stmt = mysqli_prepare($conn, "SELECT * FROM login WHERE usuario = ?");
    mysqli_stmt_bind_param($stmt, "s", $nombre);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($resultado);

    if ($user) {
        // Comprobar el número de intentos fallidos
        if ($user['failed_attempts'] >= 3) {
            registrarLog("Cuenta bloqueada para el usuario: $nombre debido a múltiples intentos fallidos.");
            echo json_encode(array('error' => "Su cuenta está bloqueada debido a múltiples intentos fallidos."));
            exit();
        }

        // Verificar contraseña
        if ($user['password'] === $pass) {
            registrarLog("Inicio de sesión exitoso para el usuario: $nombre.");

            // Restablecer intentos fallidos
            $stmt = mysqli_prepare($conn, "UPDATE login SET failed_attempts = 0 WHERE usuario = ?");
            mysqli_stmt_bind_param($stmt, "s", $nombre);
            mysqli_stmt_execute($stmt);

            $_SESSION['usuario'] = $nombre;
            $_SESSION['role'] = $user['role'];

            echo json_encode(array('success' => true, 'redirect' => 'http://localhost/in%20sound/index.php'));
            exit();
        } else {
            registrarLog("Intento fallido de inicio de sesión para el usuario: $nombre.");

            // Incrementar intentos fallidos
            $stmt = mysqli_prepare($conn, "UPDATE login SET failed_attempts = failed_attempts + 1 WHERE usuario = ?");
            mysqli_stmt_bind_param($stmt, "s", $nombre);
            mysqli_stmt_execute($stmt);

            // Obtener el número de intentos fallidos actualizados
            $stmt = mysqli_prepare($conn, "SELECT failed_attempts FROM login WHERE usuario = ?");
            mysqli_stmt_bind_param($stmt, "s", $nombre);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($resultado);

            echo json_encode(array('error' => 'Contraseña incorrecta', 'attempts' => $user['failed_attempts']));
            exit();
        }
    } else {
        registrarLog("Intento de inicio de sesión con usuario no encontrado: $nombre.");
        echo json_encode(array('error' => 'Usuario no encontrado'));
        exit();
    }
}

mysqli_close($conn);
?>

