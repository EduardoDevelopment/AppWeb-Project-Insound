<?php
// Configuración de la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registros";

/*$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>*/

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inicia sesión si aún no se ha iniciado
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

// Crear una instancia del cliente de Google
$google_client = new Google_Client();

// Configurar el OAuth 2.0 Client ID
$google_client->setClientId('599516212363-0lohb4s7v65q3nr3acok13s637ao4hjf.apps.googleusercontent.com');

// Configurar el OAuth 2.0 Client Secret
$google_client->setClientSecret('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');

// Configurar el OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/in%20sound/config/logi.php');

// Solicitar acceso al correo electrónico y perfil
$google_client->addScope('email');
$google_client->addScope('profile');
?>

