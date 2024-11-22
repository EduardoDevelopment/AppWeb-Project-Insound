<?php 
session_start();
include('confiig.php');

// Función para registrar logs
function registrarLog($mensaje) {
    $logfile = 'logs.txt'; // Archivo de log
    $timestamp = date("Y-m-d H:i:s");
    file_put_contents($logfile, "[$timestamp] - $mensaje\n", FILE_APPEND);
}

// Configuración del botón de login
$login_button = '';

// Verifica si el usuario no ha iniciado sesión con Google
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="block w-full bg-red-500 text-white text-center py-2 px-4 rounded-md shadow-md hover:bg-red-600">
        <i class="fa fa-google"></i> Inicia sesión con Google
    </a>';
}

// Verifica si es una autenticación con Google
if (isset($_GET["code"])) {
    // Obtiene el token de acceso con el código de autenticación de Google
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        // Obtiene los datos del usuario de Google
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();

        // Obtener los datos básicos del usuario de Google
        $google_email = $data['email'] ?? '';
        $google_first_name = $data['given_name'] ?? '';
        $google_last_name = $data['family_name'] ?? '';

        // Verifica si el usuario ya existe en la base de datos
        $stmt = $conn->prepare("SELECT * FROM login WHERE usuario = ? AND email = ?");
        $stmt->bind_param("ss", $google_email, $google_email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $user = $resultado->fetch_assoc();

        if ($user) {
            // Si el usuario ya existe, inicia sesión
            registrarLog("Inicio de sesión exitoso con Google para el usuario: $google_email.");
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['role'] = $user['role'];

            // Redirigir al inicio después de iniciar sesión
            header('Location: http://localhost/in%20sound/index.php');
            exit();
        } else {
            // Si el usuario no existe, registrarlo
            $role = 'user'; // Rol por defecto
            $default_password = ''; // Contraseña vacía para usuarios de Google

            $stmt = $conn->prepare("INSERT INTO login (usuario, password, email, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $google_email, $default_password, $google_email, $role);

            if ($stmt->execute()) {
                registrarLog("Nuevo usuario registrado con Google: $google_email.");
                $_SESSION['usuario'] = $google_email;
                $_SESSION['role'] = $role;

                // Redirigir al inicio después de registrar
                header('Location: http://localhost/in%20sound/index.php');
                exit();
            } else {
                registrarLog("Error al registrar el usuario: " . $conn->error);
                die("Error al registrar el usuario: " . $conn->error);
            }
        }
    }
}

// Autenticación manual (con usuario y contraseña)
if (isset($_POST['txtusuario']) && isset($_POST['txtpassword'])) {
    $nombre = mysqli_real_escape_string($conn, $_POST['txtusuario']);
    $pass = mysqli_real_escape_string($conn, $_POST['txtpassword']);

    // Verificar si el usuario existe en la base de datos
    $stmt = $conn->prepare("SELECT * FROM login WHERE usuario = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $user = $resultado->fetch_assoc();

    if ($user) {
        // Verifica si el usuario ha alcanzado el límite de intentos fallidos
        if ($user['failed_attempts'] >= 3) {
            registrarLog("Cuenta bloqueada para el usuario: $nombre debido a múltiples intentos fallidos.");
            echo json_encode(array('error' => "Su cuenta está bloqueada debido a múltiples intentos fallidos."));
            exit();
        }

        // Verifica si la contraseña es correcta
        if ($user['password'] === $pass) {
            registrarLog("Inicio de sesión exitoso para el usuario: $nombre.");

            // Restablece los intentos fallidos
            $stmt = $conn->prepare("UPDATE login SET failed_attempts = 0 WHERE usuario = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();

            $_SESSION['usuario'] = $nombre;
            $_SESSION['role'] = $user['role'];

            echo json_encode(array('success' => true, 'redirect' => 'http://localhost/in%20sound/index.php'));
            exit();
        } else {
            registrarLog("Intento fallido de inicio de sesión para el usuario: $nombre.");
            
            // Incrementa los intentos fallidos
            $stmt = $conn->prepare("UPDATE login SET failed_attempts = failed_attempts + 1 WHERE usuario = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();

            $stmt = $conn->prepare("SELECT failed_attempts FROM login WHERE usuario = ?");
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $user = $resultado->fetch_assoc();

            echo json_encode(array('error' => 'Contraseña incorrecta', 'attempts' => $user['failed_attempts']));
            exit();
        }
    } else {
        registrarLog("Intento de inicio de sesión con usuario no encontrado: $nombre.");
        echo json_encode(array('error' => 'Usuario no encontrado'));
        exit();
    }
}

// Muestra el botón para iniciar sesión con Google si no está autenticado
if (!isset($_SESSION['access_token'])) {
    echo $login_button;
}

mysqli_close($conn);
?>

