<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enviar Buzón</title>
  <!-- Enlace a Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <link rel="icon" href="img/logo.webp" type="image/webp">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    footer {
      background-color: #000;
      color: #fff;
      padding: 1rem;
      text-align: center;
    }
  </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-900">
  <!-- Navegacion web -->
  <nav class="bg-black p-4 flex justify-between items-center fixed top-0 left-0 w-full z-50">
    <div class="text-white font-bold text-lg ml-5">
      <img src="img/logo.webp" style="height: 60px; width: 60px;"> IN SOUND
    </div>
    <div class="hidden md:flex">
      <a href="index.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-house"></i> Inicio</a>
      <a href="compras.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-book-open"></i> Servicios</a>
        <a href="/APPWEB-PROJECT-INSOUND/Laravel/insound/resources/views/welcome.blade.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-record-vinyl"></i>Paquetes</a>
      <a href="login.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-door-open"></i></a>
    </div>
    <!-- Botón para el modo responsivo -->
    <div class="md:hidden flex space-x-4">
      <button id="openNav" class="text-white text-2xl">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </nav>

  <!-- Menú desplegable para el modo responsivo -->
  <div id="responsiveNav" class="fixed top-0 right-0 h-full w-2/3 bg-black p-4 transform translate-x-full md:hidden transition-transform duration-300 ease-in-out z-50">
    <div class="flex justify-between items-center mb-4">
      <div class="text-white font-bold text-lg">
        <i class="fa-solid fa-magnifying-glass"></i> Menú
      </div>
      <button id="closeNav" class="text-white text-3xl">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>
    <div class="flex flex-col space-y-4 text-lg">
      <a href="index.php" class="text-white bg-gray-800 p-3 rounded-full">
        <i class="fa-solid fa-house"></i> Inicio</a>
      <a href="compras.php" class="text-white bg-gray-800 p-3 rounded-full">
        <i class="fa-solid fa-book-open"></i> Servicios</a>
        <a href="/APPWEB-PROJECT-INSOUND/Laravel/insound/resources/views/welcome.blade.php" class="text-white bg-gray-800 p-3 rounded-full">
        <i class="fa-solid fa-record-vinyl"></i>Paquetes</a>
    </div>
    <!-- Botón "Cerrar sesión" -->
    <a href="login.php" class="fixed bottom-4 text-white bg-gray-800 p-4 rounded-full">
      <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
  </div>

  <main class="container mx-auto mt-16 pt-20">
    <section class="mb-8">
      <h2 class="text-3xl font-bold mb-4 text-center text-gray-900">Enviar Buzón</h2>
      <form id="buzonForm" action="process_enviarbuzon.php" method="POST" class="bg-white p-6 rounded-lg shadow-md mx-auto max-w-md">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 mb-2">Nombre:</label>
          <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 mb-2">Email:</label>
          <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
          <label for="message" class="block text-gray-700 mb-2">Mensaje:</label>
          <textarea id="message" name="message" class="w-full px-3 py-2 border rounded-lg" rows="5" required></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
          Enviar
        </button>
      </form>
    </section>
  </main>
  <footer class="bg-black text-white py-4 text-center">
    <p class="mb-2">Asuncion 324, Aguascalientes, Aguascalientes</p>
    <p class="mb-2">Teléfono: 449 288 1786</p>
    <div class="flex justify-center space-x-4 mb-2">
      <a href="https://www.facebook.com/lalo.palacio.macias2140/" class="text-white"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="https://x.com/Lalo_EM_" class="text-white"><i class="fa-brands fa-twitter"></i></a>
      <a href="https://www.instagram.com/lalo_em_/" class="text-white"><i class="fa-brands fa-instagram"></i></a>
    </div>
    <p class="mt-2">&copy; 2024 Events In Sound. Todos los derechos reservados.</p>
  </footer>

  <!-- Script para manejar el menú responsivo y el formulario -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('buzonForm');

      // Solicitar permisos para notificaciones
      if (Notification.permission === 'default') {
        Notification.requestPermission();
      }

      form.addEventListener('submit', async function (event) {
        event.preventDefault();
        const formData = new FormData(form);
        
        try {
          const response = await fetch(form.action, {
            method: 'POST',
            body: formData
          });
          if (response.ok) {
            new Notification('Éxito', {
              body: '¡Mensaje enviado con éxito!',
              icon: 'img/logo.webp'
            });
            form.reset();
          } else {
            new Notification('Error', {
              body: 'Hubo un problema al enviar el mensaje.',
              icon: 'img/logo.webp'
            });
          }
        } catch (error) {
          console.error('Error al enviar el mensaje:', error);
          new Notification('Error', {
            body: 'Hubo un error al enviar el mensaje. Por favor, intente nuevamente.',
            icon: 'img/logo.webp'
          });
        }
      });

      const openNavButton = document.getElementById('openNav');
      const closeNavButton = document.getElementById('closeNav');
      const responsiveNav = document.getElementById('responsiveNav');

      openNavButton.addEventListener('click', () => {
        responsiveNav.classList.remove('translate-x-full');
      });

      closeNavButton.addEventListener('click', () => {
        responsiveNav.classList.add('translate-x-full');
      });

      const links = document.querySelectorAll('#responsiveNav a');
      links.forEach(link => {
        link.addEventListener('click', () => {
          responsiveNav.classList.add('translate-x-full');
        });
      });

      document.addEventListener('click', (event) => {
        if (!responsiveNav.contains(event.target) && !openNavButton.contains(event.target)) {
          responsiveNav.classList.add('translate-x-full');
        }
      });

      let startX = 0;
      let dist = 0;

      document.addEventListener('touchstart', (event) => {
        const touch = event.touches[0];
        startX = touch.clientX;
      });

      document.addEventListener('touchmove', (event) => {
        const touch = event.touches[0];
        dist = touch.clientX - startX;
      });

      document.addEventListener('touchend', () => {
        if (dist > 50) {
          responsiveNav.classList.add('translate-x-full');
        }
      });
    });
  </script>
</body>

</html>
