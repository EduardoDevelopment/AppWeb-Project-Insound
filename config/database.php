<?php

class Database
{
    private $hostname = "localhost"; // Dirección del servidor de la base de datos
    private $database = "registros"; // Nombre de la base de datos a la que se conecta
    private $username = "root"; // Nombre de usuario para acceder a la base de datos
    private $password = ""; // Contraseña para acceder a la base de datos
    private $charset = "utf8"; // Tipo de codificación de caracteres

    function conectar() // Función para establecer la conexión con la base de datos
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset; // Cadena de conexión con la base de datos
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Configuración de opciones para mostrar errores en caso de fallos en la conexión
                PDO::ATTR_EMULATE_PREPARES => false // Configuración de opciones para desactivar la emulación de consultas preparadas y mejorar la seguridad
            ];
            $pdo = new PDO($conexion, $this->username, $this->password, $options); // Creación de una instancia de la clase PDO para realizar la conexión con la base de datos
            return $pdo; // Retorno de la conexión
        } catch (PDOException $e) { // Captura de excepciones en caso de fallos en la conexión
            echo 'Error de conexion: ' . $e->getMessage(); // Mensaje de error en caso de fallo
            exit; // Finalización del script
        }
    }
}
?>
