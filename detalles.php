<?php

require 'config/database.php';
require 'config/config.php';
require 'config/details.php';

// Obtener el ID del producto desde la URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 1; // ID por defecto si no se especifica

// Obtener todas las imágenes de la carpeta correspondiente al ID del producto
$carpeta = "img/$id";
$imagenes = glob("$carpeta/*.webp");

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/7e99496f14.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/a.css">
  <!-- Título -->
  <title>InSound</title>
</head>

<body class="flex flex-col min-h-screen">
  <!-- Navegación web -->
  <nav class="bg-black p-4 flex justify-between items-center fixed top-0 left-0 w-full z-50">
    <div class="text-white font-bold text-lg ml-5">
      <i class="fa-solid fa-headphones"></i> InSound
    </div>
    <div class="hidden md:flex">
      <a href="index.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-house"></i> Inicio</a>
      <a href="compras.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-book-open"></i> Servicios</a>
      <a href="login.php" class="text-white mx-2 p-2 hover:bg-white hover:text-black rounded-full duration-200 ease-in-out">
        <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
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
    </div>
    <!-- Botón "Cerrar sesión" -->
    <a href="login.php" class="fixed bottom-4 text-white bg-gray p-4 rounded-full">
      <i class="fa-solid fa-door-open"></i> Cerrar sesión</a>
  </div>
  <!-- Fin de la navegación -->

  <main class="flex-grow container mx-auto mt-40 xl:mt-30 mx-8 shadow-2xl xl:my-40 my-20">
    <div class="flex flex-wrap">
      <!-- Imagen del producto -->
      <div class="w-full md:w-1/2 order-1 md:order-1 my-10">
        <?php if (!empty($imagenes)) : ?>
          <img src="<?php echo $imagenes[0]; ?>" class="block mx-auto max-w-sm md:max-w-full responsive-img">
        <?php else : ?>
          <p class="text-center">No hay imágenes disponibles para este producto.</p>
        <?php endif; ?>
      </div>
      <!-- Información del producto -->
      <div class="w-full md:w-1/2 order-2 md:order-2 px-4 md:px-0">
        <h2 class="text-3xl font-bold">
          <?php echo $nombre; ?>
        </h2>
        <h6 class="font-semibold my-2">Tipo:
          <?php echo $tipo; ?>
        </h6>
        <p class="text-lg my-2">
          <?php echo $descripcion ?>
        </p>
      </div>
    </div>
  </main>

  <footer class="bg-black text-white py-4 text-center">
    <p class="mb-2">Asuncion 324, Aguascalientes, Aguascalientes</p>
    <p class="mb-2">Teléfono: 449 288 1786</p>
    <p class="mt-2">&copy; 2024 InSound. Todos los derechos reservados.</p>
  </footer>

  <!-- Script para manejar el menú responsivo -->
  <script src="js/menu.js"></script>
</body>

</html>
