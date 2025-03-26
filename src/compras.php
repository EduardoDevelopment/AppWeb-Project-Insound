<!-- Conexion a Base de Datos -->
<?php

require 'config/config.php';
require 'config/database.php';
require 'config/compraas.php';
// Quitar productos de carrito, solo pruebas - - -
//session_destroy();

?>

<!-- Pagina -->

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Título -->
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>

  <title>IN SOUND</title>
  <style>
    @import url("https://fonts.googleapis.com/css?family=Lato:100,300,400");
    @import url("https://fonts.googleapis.com/css?family=Roboto:100");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .header {
      text-align: center;
      font-family: 'Roboto', sans-serif;
      font-size: 34px;
      margin-top: 12vh;
    }

    .footer {
      text-align: center;
      font-family: 'Lato', sans-serif;
      font-weight: 300;
      font-size: 20px;
      margin-top: 15vh;
    }

    .button-container-1 {
      position: relative;
      width: 100px;
      height: 50px;
      margin-left: auto;
      margin-right: auto;
      margin-top: 6vh;
      overflow: hidden;
      border: 1px solid;
      font-family: 'Lato', sans-serif;
      font-weight: 300;
      font-size: 20px;
      transition: 0.5s;
      letter-spacing: 1px;
    }
    .button-container-1 button {
      width: 101%;
      height: 100%;
      font-family: 'Lato', sans-serif;
      font-weight: 300;
      font-size: 20px;
      letter-spacing: 1px;
      background: #000;
      -webkit-mask: url("https://raw.githubusercontent.com/robin-dela/css-mask-animation/master/img/nature-sprite.png");
      mask: url("https://raw.githubusercontent.com/robin-dela/css-mask-animation/master/img/nature-sprite.png");
      -webkit-mask-size: 2300% 100%;
      mask-size: 2300% 100%;
      border: none;
      color: #fff;
      cursor: pointer;
      -webkit-animation: ani2 0.7s steps(22) forwards;
      animation: ani2 0.7s steps(22) forwards;
    }
    .button-container-1 button:hover {
      -webkit-animation: ani 0.7s steps(22) forwards;
      animation: ani 0.7s steps(22) forwards;
    }

    .mas {
      position: absolute;
      color: #000;
      text-align: center;
      width: 101%;
      font-family: 'Lato', sans-serif;
      font-weight: 300;
      position: absolute;
      font-size: 20px;
      margin-top: 12px;
      overflow: hidden;
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

    .main-text {
      font-size: 1.25rem; /* text-lg */
      line-height: 1.75rem; /* leading-relaxed */
      color: #4B5563; /* text-gray-700 */
      margin: 2rem auto;
      max-width: 80%;
    }

    .main-heading {
      font-size: 1.875rem; /* text-3xl */
      line-height: 2.25rem;
      font-weight: 700; /* font-bold */
      color: #1F2937; /* text-gray-900 */
      margin-top: 2rem;
    }

    /* Fade animation */
    .fade {
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    .fade.show {
      opacity: 1;
    }
  </style>
</head>

<body class="flex flex-col min-h-screen bg-gray-100">
<main>
<header>
  <!-- Navegación web -->
  <nav class="bg-black p-4 flex justify-between items-center fixed top-0 left-0 w-full z-50">
    <div class="text-white font-bold text-lg ml-9">
      <i class="fa-solid fa-headphones"></i> IN SOUND 
    </div>
    <div class="hidden md:flex">
      <a href="index.php"
        class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-house"></i> Inicio</a>
      <a href="compras.php"
        class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
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
  <div id="responsiveNav"
    class="fixed top-0 right-0 h-full w-2/3 bg-black p-4 transform translate-x-full md:hidden transition-transform duration-300 ease-in-out">
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
        <a href="/APPWEB-PROJECT-INSOUND/Laravel/insound/resources/views/welcome.blade.php" class="text-white bg-gray p-3 rounded-full">
        <i class="fa-solid fa-record-vinyl"></i>Paquetes</a>
      
    </div>
    <!-- Botón "Cerrar sesión" -->
    <a href="login.php" class="fixed bottom-4 text-black bg-white p-4 rounded-full">
      <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
  </div>
  <!-- Fin de la navegación -->
  
  <div class="main-text text-center mt-24 xl:mt-36">
    <p>
    Somos una empresa profesional de producciones integrales de audio video e iluminación para eventos sociales y masivos con más de 25 años de experiencia en el ramo. 
    Cubrimos toda la República Mexicana.
    Contamos con una extensa variedad de servicios y equipo de vanguardia, así como personal altamente calificado. Constantemente estamos en proceso de renovación logrando ofrecer a nuestros clientes lo último en tecnología y calidad.
    Tenemos empresas hermanas en Guadalajara Jal., Monterrey Nuevo León, y Ciudad de México, por lo cual garantizamos la cobertura de cualquier evento.
    IN SOUND es una marca Registrada.
    </p>
    <h1 class="main-heading text-center">- SERVICIOS -</h1>
  </div>
  
  <div class="flex flex-wrap xl:mx-40 mt-10 pt-20"> <!-- Añadido pt-20 aquí para dar margen superior -->
  <!-- Bucle foreach para iterar sobre los resultados de la consulta de productos -->
  <?php foreach ($resultado as $row) { ?>
    <!-- Contenedor de cada producto -->
    <div class="w-full sm:w-full md:w-1/2 px-4 mb-4">
      <div class="bg-white rounded-lg shadow-md p-4 mx-auto flex">
        <?php
        // Se obtiene la imagen principal del producto a partir del ID
        $id = $row['id'];
        $imagen = "img/" . $id . "/principal.webp";

        // Si la imagen no existe, se usa una imagen por defecto
        if (!file_exists($imagen)) {
          $imagen = "img/No-image-found.webp";
        }
        ?>
        <!-- Imagen del producto -->
        <img class="object-cover rounded-lg w-1/3 fade" src="<?php echo $imagen; ?>" alt="img_">
        <div class="w-2/3 ml-4">
          <div class="mt-4">
            <!-- Nombre del producto -->
            <h5 class="text-lg font-semibold te">
              <?php echo $row['nombre'] ?>
            </h5>
          </div>
          <div class="mt-4 flex justify-between items-center">
            <div class="button-container-1">
              <span class="mas">Ver más</span>
              <!-- Botón para ver más detalles del producto -->
              <button id='work' type="button" name="Hover" onclick="location.href='detalles.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN) ?>'">Ver más</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?> <!-- Fin del bucle foreach y del contenedor de cada producto -->
</div>

<footer class="bg-black text-white py-4 text-center">
<div class="mb-4 md:mb-0">
                <h4 class="text-xl font-bold">Events In Sound</h4>
                <p class="mt-2">Asuncion 324, Aguascalientes</p>
                <p>Teléfono: 449 288 1786</p>
            </div>
  </footer>

    <!--  -->
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

// Fade-in effect for images
window.addEventListener('load', () => {
  const images = document.querySelectorAll('.fade');
  images.forEach((img, index) => {
    setTimeout(() => {
      img.classList.add('show');
    }, index * 300); // Delay each image for a staggered effect
  });
});
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
  </main>
  <script src="app.js"></script>
  </body>

</html>
