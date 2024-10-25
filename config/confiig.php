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
?>
