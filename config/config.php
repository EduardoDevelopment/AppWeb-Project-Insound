<?php
// Iniciar sesión en la página web
session_start();

// Incluir la librería de Google Client para PHP (autocargada por Composer)
require_once 'vendor/autoload.php';

// Crear objeto del cliente de Google API para hacer llamadas a la API de Google
$google_client = new Google_Client();

// Establecer el ID de Cliente OAuth 2.0
$google_client->setClientId('599516212363-0lohb4s7v65q3nr3acok13s637ao4hjf.apps.googleusercontent.com');

// Establecer la clave secreta del cliente OAuth 2.0
$google_client->setClientSecret('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');

// Establecer la URI de redirección OAuth 2.0 (debe coincidir con la configurada en la Consola de Google)
$google_client->setRedirectUri('http://localhost/in%20sound/login.php');

// Solicitar acceso a la dirección de correo electrónico y el perfil del usuario
$google_client->addScope('email');
$google_client->addScope('profile');
?>
