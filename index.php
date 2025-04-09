<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>In Sound</title>
  <!-- Enlace a Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <link rel="icon" href="img/logo.webp" type="image/webp">
  <link rel="manifest" href="./manifest.json">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .svg-wrapper {
      margin-top: 10px;
      position: relative;
      width: 150px;
      height: 40px;
      display: inline-block;
      border-radius: 3px;
    }

    #shape {
      stroke-width: 6px;
      fill: transparent;
      stroke: #009FFD;
      stroke-dasharray: 85 400;
      stroke-dashoffset: -220;
      transition: 1s all ease;
    }

    #text {
      margin-top: -30px;
      text-align: center;
    }

    #text a {
      color: black;
      text-decoration: none;
      font-weight: 100;
      font-size: 1.1em;
    }

    .svg-wrapper:hover #shape {
      stroke-dasharray: 50 0;
      stroke-width: 3px;
      stroke-dashoffset: 0;
      stroke: #06D6A0;
    }

    .spot {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
    }

    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }

    .card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 20px;
      margin: 20px;
      text-align: center;
      opacity: 0;
      transition: opacity 0.5s ease-out;
    }

    .card img {
      width: 100%;
      height: auto;
      border-radius: 10px 10px 0 0;
    }

    .card h3 {
      margin: 15px 0;
      font-size: 1.5em;
    }

    .card p {
      margin: 15px 0;
      font-size: 1em;
      text-align: left;
    }

    .btn-container {
      margin: 20px 0;
    }

    .btn {
      text-transform: uppercase;
      text-decoration: none;
      font-weight: 700;
      border: 0;
      position: relative;
      letter-spacing: 0.15em;
      margin: 0 auto;
      padding: 1rem 2.5rem;
      background: transparent;
      outline: none;
      font-size: 28px;
      color: black;
      transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.15s;
    }

    .btn::after,
    .btn::before {
      border: 0;
      content: "";
      position: absolute;
      height: 40%;
      width: 10%;
      transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
      z-index: -2;
      border-radius: 50%;
    }

    .btn::before {
      background-color: #c92918;
      top: -0.75rem;
      left: 0.5rem;
      animation: topAnimation 2s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.25s infinite alternate;
    }

    .btn::after {
      background-color: #e74c3c;
      top: 3rem;
      left: 13rem;
      animation: bottomAnimation 2s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.5s infinite alternate;
    }

    .btn:hover {
      color: white;
    }

    .btn:hover::before,
    .btn:hover::after {
      top: 0;
      height: 100%;
      width: 100%;
      border-radius: 0;
      animation: none;
    }

    .btn:hover::after {
      left: 0rem;
    }

    .btn:hover::before {
      top: 0.5rem;
      left: 0.35rem;
    }

    @keyframes topAnimation {
      from {
        transform: translate(0rem, 0);
      }
      to {
        transform: translate(0rem, 3.5rem);
      }
    }

    @keyframes bottomAnimation {
      from {
        transform: translate(-11.5rem, 0);
      }
      to {
        transform: translate(0rem, 0);
      }
    }

    @keyframes fade-in {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .fade-in {
      opacity: 1;
      animation: fade-in 1s ease-in-out;
    }

    .breadcrumbs {
      padding: 10px 0;
      list-style: none;
      display: flex;
      justify-content: center;
    }

    .breadcrumbs li {
      display: inline;
      font-size: 18px;
    }

    .breadcrumbs li+li:before {
      padding: 8px;
      color: black;
      content: "/\00a0";
    }

    .breadcrumbs a {
      color: black;
      text-decoration: none;
    }

    .breadcrumbs a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body class="flex flex-col min-h-screen">
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
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
    <a href="admin.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-user-shield"></i> Administrador
    </a>
<?php endif; ?>
      
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
      <a href="index.php" class="text-white bg-gray p-3 rounded-full">
        <i class="fa-solid fa-house"></i> Inicio</a>
      <a href="compras.php" class="text-white bg-gray p-3 rounded-full">
        <i class="fa-solid fa-book-open"></i> Servicios</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') : ?>
        <a href="admin.php" class="text-white bg-gray p-3 rounded-full">
          <i class="fa-solid fa-user-shield"></i> Administrador</a>
      <?php endif; ?>
    </div>
    <!-- Botón "Cerrar sesión" -->
    <a href="login.php" class="fixed bottom-4 text-white bg-gray p-4 rounded-full">
      <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
  </div>
  <!-- Fin de la navegacion -->

  <!-- Call to Action -->
  <section class="cta-section">
    <h1>Conoce nuestros servicios, te sorprenderás</h1>
    <a href="compras.php" class="cta-button">¡Descubre ahora!</a>
  </section>
  <!-- Botón Flotante para el Buzón -->
  <style>
    .cta-section {
      text-align: center;
      padding: 4rem 2rem;
      margin-top: 4rem;
      background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
      border-radius: 8px;
      box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
    }

    .cta-section h1 {
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: #333;
    }

    .cta-button {
      display: inline-block;
      background: #ff3b30;
      color: #fff;
      font-weight: 700;
      padding: 0.75rem 1.5rem;
      border-radius: 50px;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 1rem;
      letter-spacing: 1px;
    }

    .cta-button:hover {
      background: #e63946;
      transform: translateY(-3px);
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .float-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: linear-gradient(45deg, #007BFF, #0056b3);
      color: white;
      border: none;
      padding: 15px 25px;
      border-radius: 50%;
      box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
      cursor: pointer;
      font-size: 18px;
      font-weight: bold;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .float-button:hover {
      background: linear-gradient(45deg, #0056b3, #007BFF);
      box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.4);
      transform: translateY(-5px);
    }

    .float-button:focus {
      outline: none;
    }

    .float-button i {
      font-size: 20px;
    }
  </style>
  <button class="float-button" onclick="location.href='enviarbuzon.php'">Buzón</button>

  <main class="container mx-auto mt-8 pt-20">
    <section class="mb-8">
      <h2 class="text-3xl font-bold mb-4 text-center mt-10">Servicios</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mx-4">
        <div class="card">
          <img src="img/1/principal.webp" alt="img">
          <h3>ILUMINACIÓN</h3>
          <p>En las marcas Líderes en el mercado: HIGH END, ROBE, VARI LITE, Convencional : Par 64 Led’s , Fresnel y Lico con cortadoras, Robótica: Wash, Spot, Beem en las Marcas HIGH END, ROBE, VARI LITE, Seguidores : DTS 575 y 1200 de descarga</p>
          <div class="svg-wrapper">
            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
              <rect id="shape" height="40" width="150" />
              <div id="text">
                <a href="compras.php"><span class="spot"></span>Ver más</a>
              </div>
            </svg>
          </div>
        </div>
        <div class="card">
          <img src="img/2/principal.webp" alt="img">
          <h3>VIDEO</h3>
          <p>Pantallas de Led’s 6mm, 4mm y 2mm con cualquier medida y diseño, Pantallas de Proyeccion y Proyectores profesionales de 4,000 lúmenes a 18,000 lúmenes, Video Muros y Monitores 42”, 55”, 65”, 75” y 80”, Circuito Cerrado de 01 hasta 10 cámaras profesionales</p>
          <div class="svg-wrapper">
            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
              <rect id="shape" height="40" width="150" />
              <div id="text">
                <a href="compras.php"><span class="spot"></span>Ver más</a>
              </div>
            </svg>
          </div>
        </div>
        <div class="card">
          <img src="img/3/principal.webp" alt="img">
          <h3>ILUMINACIÓN ARQUITECTÓNICA</h3>
          <p>Iluminación para cualquier superficie, Instalaciones para interiores y exteriores, Proyección de Logotipos e Imágenes ( Diseños personalizados ), City Color, Flash Bar y Wash IP65</p>
          <div class="svg-wrapper">
            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
              <rect id="shape" height="40" width="150" />
              <div id="text">
                <a href="compras.php"><span class="spot"></span>Ver más</a>
              </div>
            </svg>
          </div>
        </div>
        <div class="card">
          <img src="img/4/principal.webp" alt="img">
          <h3>PISTAS</h3>
          <p>Marca TOP LINE con acabados en plastificado y charol en infinidad de colores, Estampadas con diseños personalizados, Vidrio, Acrílico Iluminadas, Duela, madera rustica, Manejamos cualquier medida y diseño</p>
          <div class="svg-wrapper">
            <svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
              <rect id="shape" height="40" width="150" />
              <div id="text">
                <a href="compras.php"><span class="spot"></span>Ver más</a>
              </div>
            </svg>
          </div>
        </div>
      </div>
    </section>

    <!-- Mapa del sitio -->
    <section class="container mx-auto my-8">
      <h2 class="text-3xl font-bold mb-4 text-center">Mapa del Sitio</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="space-y-8">
          <h3 class="text-2xl font-bold mb-2">Inicio</h3>
          <ul class="list-none space-y-2">
            <li><a class="btn" href="index.php">Página Principal</a></li>
          </ul>
        </div>
        <div class="space-y-8">
          <h3 class="text-2xl font-bold mb-2">Servicios</h3>
          <ul class="list-none space-y-2">
            <li><a class="btn" href="compras.php">Servicios</a></li>
            <li><a class="btn" href="compras.php">Iluminación</a></li>
            <li><a class="btn" href="compras.php">Video</a></li>
            <li><a class="btn" href="compras.php">Iluminación Arquitectónica</a></li>
          </ul>
        </div>
        <div class="space-y-8">
          <h3 class="text-2xl font-bold mb-2">Cuenta</h3>
          <ul class="list-none space-y-2">
            <li><a class="btn" href="login.php">Iniciar Sesión</a></li>
            <li><a class="btn" href="registro.php">Registrarse</a></li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Breadcrumbs -->
    <ul class="breadcrumbs">
      <li><a href="index.php">Inicio</a></li>
      <li>Servicios</li>
    </ul>
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

  <!-- Script para manejar el menú responsivo -->
  <script>
    const openNavButton = document.getElementById('openNav');
    const closeNavButton = document.getElementById('closeNav');
    const responsiveNav = document.getElementById('responsiveNav');
    const mainContent = document.querySelector('main');

    openNavButton.addEventListener('click', () => {
      responsiveNav.classList.remove('translate-x-full');
    });

    closeNavButton.addEventListener('click', () => {
      responsiveNav.classList.add('translate-x-full');
    });

    // Cerrar el menú al dar clic en un link
    const links = document.querySelectorAll('#responsiveNav a');
    links.forEach(link => {
      link.addEventListener('click', () => {
        responsiveNav.classList.add('translate-x-full');
      });
    });

    // Cerrar el menú al dar clic fuera del menú
    document.addEventListener('click', (event) => {
      if (!responsiveNav.contains(event.target) && !openNavButton.contains(event.target)) {
        responsiveNav.classList.add('translate-x-full');
      }
    });

    // Cerrar el menú deslizándose o tocando fuera del menú
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
  </script>

  <!-- Script para la animación de las tarjetas al hacer scroll -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const cards = document.querySelectorAll('.card');

      const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
      };

      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('fade-in');
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);

      cards.forEach(card => {
        observer.observe(card);
      });
    });
  </script>
</body>

</html>
