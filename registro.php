<?php
require 'config/database.php'; // Importa el archivo de configuración de la base de datos

// Función para procesar el formulario de registro
function processRegistration()
{
    global $connection; // Asegúrate de tener acceso a la conexión de la base de datos

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Obtener los datos del formulario
        $usuario = $_POST["txtusuario"];
        $email = $_POST["txtemail"];
        $password = $_POST["txtpassword"];
        $confirmPassword = $_POST["txtconfirmpassword"];

        // Verificar si las contraseñas coinciden
        if ($password === $confirmPassword) {
            // Verificar si el correo ya está registrado
            $stmt = $connection->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // El correo ya está registrado, mostrar un mensaje de error
                $error_message = "El correo electrónico ya está registrado";
            } else {
                // El correo no está registrado, proceder con la inserción
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $connection->prepare("INSERT INTO usuarios (usuario, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $usuario, $email, $hashedPassword);
                if ($stmt->execute()) {
                    // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de éxito
                    header("Location: login.php");
                    exit;
                } else {
                    $error_message = "Error al registrar el usuario. Inténtalo de nuevo.";
                }
            }

            $stmt->close();
        } else {
            // Las contraseñas no coinciden, mostrar un mensaje de error
            $error_message = "Las contraseñas no coinciden";
        }
    }
}

// Llamamos a la función para procesar el formulario de registro
processRegistration();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <!-- Enlazamos los estilos de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
</head>

<body class="bg-cover min-h-screen flex flex-col">

    <!-- Contenedor principal -->
    <div class="flex-grow flex items-center justify-center">
        <form action="config/regi.php" method="POST" class="form-container">
            <h4 class="text-2xl font-bold mb-6 text-center border-b pb-4">Registrarse</h4>
            <?php if (isset($error_message)): ?>
                <p class="text-red-500 text-center">
                    <?php echo $error_message; ?>
                </p>
            <?php endif; ?>

            <!-- Mostramos los campos de nombre de usuario y correo electrónico -->
            <div class="space-y-4">
                <div class="form-group">
                    <label for="username" class="text-gray-700">Nombre de usuario</label>
                    <input type="text" name="txtusuario" autocomplete="off" required
                        class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
                <div class="form-group">
                    <label for="email" class="text-gray-700">Correo electrónico</label>
                    <input type="email" name="txtemail" autocomplete="off" required
                        class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
            </div>

            <!-- Mostramos los campos de contraseña y confirmar contraseña -->
            <div class="space-y-4 mt-6">
                <div class="form-group">
                    <label for="password" class="text-gray-700">Contraseña</label>
                    <input type="password" name="txtpassword" autocomplete="off" required
                        class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="text-gray-700">Confirmar contraseña</label>
                    <input type="password" name="txtconfirmpassword" autocomplete="off" required
                        class="block w-full border rounded-md shadow-sm py-2 px-3 mt-1">
                </div>
            </div>

            <!-- Botón con animación -->
            <div class="button-container-2 mt-6">
                <button type="submit">Registrarse</button>
            </div>
            <p class="mt-4 text-center">¿Ya tienes una cuenta? <a href="login.php"
                    class="text-blue-500 hover:text-red-600">¡Inicia sesión aquí!</a></p>
        </form>
    </div>

    <!-- Footer -->
   
</body>

</html>
