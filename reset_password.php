<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
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
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        footer h4, footer p {
            margin: 0;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .modal-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .modal-header .close {
            font-size: 1.5rem;
            font-weight: 600;
            cursor: pointer;
        }

        .modal-body {
            font-size: 1rem;
            color: #333;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }

        .modal-footer button {
            background-color: #3182ce;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .modal-footer button:hover {
            background-color: #2b6cb0;
        }
    </style>
</head>

<body>
    <div class="bg-cover">
        <div class="form-container">
            <h4 class="text-2xl font-bold mb-6 text-center">Restablecer Contraseña</h4>
            <form id="reset-form" action="procesar_reset.php" method="POST">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password" id="new_password" name="new_password" autocomplete="off" required>
                </div>
                <div class="button-container-2">
                    <button type="submit">Restablecer</button>
                </div>
            </form>
        </div>
        <footer>
            <h4 class="text-xl font-bold">Events In Sound</h4>
            <p>Asuncion 324, Aguascalientes</p>
            <p>Teléfono: 449 288 1786</p>
        </footer>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Advertencia</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <p id="modal-message"></p>
            </div>
            <div class="modal-footer">
                <button class="close">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('reset-form').addEventListener('submit', async function (event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            const modal = document.getElementById('myModal');
            const modalMessage = document.getElementById('modal-message');
            if (result.success) {
                modalMessage.textContent = result.message;
            } else {
                modalMessage.textContent = ' ' + result.message;
            }
            modal.style.display = "block";
        });

        document.querySelectorAll('.close').forEach(function(element) {
            element.addEventListener('click', function () {
                const modal = document.getElementById('myModal');
                modal.style.display = "none";
            });
        });

        window.addEventListener('click', function (event) {
            const modal = document.getElementById('myModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    </script>
</body>

</html>
