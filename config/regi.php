<?php
// Configuración de la conexión a la base de datos
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registros";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verifica si hay algún error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $usuario = $_POST["txtusuario"];
    $email = $_POST["txtemail"];
    $password = $_POST["txtpassword"];
    $confirmpassword = $_POST["txtconfirmpassword"];

    // Verifica si las contraseñas coinciden
    if ($password !== $confirmpassword) {
        echo "Las contraseñas no coinciden";
    } else {
        // Ejecuta la consulta SQL para insertar los datos
        $sql = "INSERT INTO login (usuario, email, password) VALUES ('$usuario', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            // Redirige a la página de login.php
            header("Location: ../login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>
