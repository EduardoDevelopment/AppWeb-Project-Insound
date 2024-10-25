<?php
session_start();

if(isset($_SESSION['usuario'])) {
    // Si existe la sesión del usuario, la destruimos
    session_destroy();
    // También podemos eliminar todas las variables de sesión con session_unset()
    session_unset();
    echo "Sesión cerrada exitosamente.";
} else {
    echo "No hay sesión iniciada.";
}
?>
