<?php
session_start();
include('config/confiig.php'); 
if (isset($_SESSION['access_token'])) {
    session_destroy(); // Esto destruye toda la sesión, incluyendo el access_token de Google
    header("Location: login.php"); // Redirige al inicio para recargar la página y mostrar el botón
    exit();
}

$login_button = '';

if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="block w-full bg-red-500 text-white text-center py-2 px-4 rounded-md shadow-md hover:bg-red-600">
        <i class="fa fa-google"></i> Inicia sesión con Google
    </a>';
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="manifest" href="/manifest.json">
    <!-- Enlazamos los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/aa.css">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Lato:100,300,400");
        @import url("https://fonts.googleapis.com/css?family=Roboto:100");

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Lato', sans-serif;
        }

        .bg-cover {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/fondo.webp') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            margin-top: 50px; /* Ajusta según sea necesario */
        }

        .form-container h4 {
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-container-2 {
            position: relative;
            width: 100%;
            height: 50px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 1rem;
            overflow: hidden;
            border: 1px solid #000;
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            transition: 0.5s;
            letter-spacing: 1px;
        }

        .button-container-2 button {
            width: 101%;
            height: 100%;
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            font-size: 20px;
            letter-spacing: 1px;
            background: #000;
            -webkit-mask: url("https://raw.githubusercontent.com/robin-dela/css-mask-animation/master/img/urban-sprite.png");
            mask: url("https://raw.githubusercontent.com/robin-dela/css-mask-animation/master/img/urban-sprite.png");
            -webkit-mask-size: 3000% 100%;
            mask-size: 3000% 100%;
            border: none;
            color: #fff;
            cursor: pointer;
            -webkit-animation: ani2 0.7s steps(29) forwards;
            animation: ani2 0.7s steps(29) forwards;
        }

        .button-container-2 button:hover {
            -webkit-animation: ani 0.7s steps(29) forwards;
            animation: ani 0.7s steps(29) forwards;
        }

        @-webkit-keyframes ani {
            from {
                -webkit-mask-position: 0 0;
                mask-position: 0 0;
            }
            to {
                -webkit-mask-position: 100% 0;
                mask-position: 100% 0;
            }
        }

        @keyframes ani {
            from {
                -webkit-mask-position: 0 0;
                mask-position: 0 0;
            }
            to {
                -webkit-mask-position: 100% 0;
                mask-position: 100% 0;
            }
        }

        @-webkit-keyframes ani2 {
            from {
                -webkit-mask-position: 100% 0;
                mask-position: 100% 0;
            }
            to {
                -webkit-mask-position: 0 0;
                mask-position: 0 0;
            }
        }

        @keyframes ani2 {
            from {
                -webkit-mask-position: 100% 0;
                mask-position: 100% 0;
            }
            to {
                -webkit-mask-position: 0 0;
                mask-position: 0 0;
            }
        }

        footer {
            background-color: #000;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
            width: 100%;
            position: absolute;
            bottom: 0;
        }

        footer h4, footer p {
            margin: 0;
        }
    </style>
    <script>
        async function handleLogin(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                window.location.href = result.redirect;
            } else {
                const errorMessage = document.getElementById('error-message');
                errorMessage.innerText = result.error + (result.attempts ? ` Intentos fallidos: ${result.attempts}` : '');
                errorMessage.style.display = 'block';
            }
        }
    </script>
</head>

<body class="bg-cover">
    <!-- Contenedor principal -->
    <div class="flex-grow flex items-center justify-center">
        <!-- Modificamos el tamaño de la tarjeta del formulario -->
        <form id="login-form" action="config/logi.php" method="POST" class="form-container" onsubmit="handleLogin(event)">
            <h4 class="text-2xl font-bold mb-6 text-center border-b pb-4">Inicia Sesión</h4>
            <p id="error-message" class="text-red-500 text-center" style="display: none;"></p>
            <div class="space-y-4">
                <div class="form-group">
                    <label for="username" class="text-gray-700">Usuario</label>
                    <input type="text" name="txtusuario" autocomplete="off" required class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
                <div class="form-group">
                    <label for="password" class="text-gray-700">Contraseña</label>
                    <input type="password" name="txtpassword" autocomplete="off" required class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
                <div class="button-container-2">
                    <button type="submit" name="Hover">Ingresar</button>
                </div>
                <div class="text-center mt-4">
                    <a href="reset_password.html" class="text-gray-500 hover:text-black">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
            <p class="mt-4 text-center">¿No tienes cuenta? <a href="registro.php" class="text-gray-500 hover:text-black">¡Regístrate aquí!</a></p>
            <div class="mt-6">
                <!-- Botón de inicio de sesión con Google -->
                <?php if ($login_button != '') {
                    echo $login_button;
                } else {
                    echo '<p class="text-center text-green-500">Ya has iniciado sesión con Google. <a href="http://localhost//APPWEB-PROJECT-INSOUND/index.php" class="underline">Ir a inicio</a></p>';
                } ?>

            </div>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <h4 class="text-xl font-bold">Events In Sound</h4>
        <p>Asuncion 324, Aguascalientes</p>
        <p>Teléfono: 449 288 1786</p>
    </footer>
</body>

</html>
