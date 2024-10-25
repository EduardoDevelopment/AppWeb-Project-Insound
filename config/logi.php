<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registros";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(array('error' => "Error de conexión: " . mysqli_connect_error()));
    exit();
}

// Comprobar si las claves del array $_POST están definidas
if (isset($_POST['txtusuario']) && isset($_POST['txtpassword'])) {
    $nombre = $_POST['txtusuario'];
    $pass = $_POST['txtpassword'];

    // Validar y filtrar las entradas de usuario
    $nombre = mysqli_real_escape_string($conn, $nombre);
    $pass = mysqli_real_escape_string($conn, $pass);

    // Utilizar declaraciones preparadas para evitar la inyección de SQL
    $stmt = mysqli_prepare($conn, "SELECT * FROM login WHERE usuario = ?");
    mysqli_stmt_bind_param($stmt, "s", $nombre);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($resultado);

    if ($user) {
        // Comprobar el número de intentos fallidos
        if ($user['failed_attempts'] >= 3) {
            echo json_encode(array('error' => "Su cuenta está bloqueada debido a múltiples intentos fallidos."));
            exit();
        }

        // Verificar contraseña
        if ($user['password'] === $pass) {
            // Restablecer intentos fallidos
            $stmt = mysqli_prepare($conn, "UPDATE login SET failed_attempts = 0 WHERE usuario = ?");
            mysqli_stmt_bind_param($stmt, "s", $nombre);
            mysqli_stmt_execute($stmt);

            // Crear una variable de sesión para almacenar el nombre de usuario y rol
            $_SESSION['usuario'] = $nombre;
            $_SESSION['role'] = $user['role'];

            // Respuesta de éxito con redirección
            echo json_encode(array('success' => true, 'redirect' => 'http://localhost/in%20sound/index.php'));
            exit();
        } else {
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

            // Respuesta de error con intentos fallidos
            echo json_encode(array('error' => 'Contraseña incorrecta', 'attempts' => $user['failed_attempts']));
            exit();
        }
    } else {
        // Respuesta de error usuario no encontrado
        echo json_encode(array('error' => 'Usuario no encontrado'));
        exit();
    }
}

mysqli_close($conn);
?>
