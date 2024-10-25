-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 23:58:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `buzon`
--

CREATE TABLE `buzon` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `buzon`
--

INSERT INTO `buzon` (`id`, `nombre`, `email`, `mensaje`, `fecha`) VALUES
(1, 'José Eduardo', 'lalokeras677@gmail.com', 'Metan mas imagenes', '2024-08-01 20:22:24'),
(2, 'Lalo_EM_', 'cuentaprime90012@gmail.com', 'Que buena pagina', '2024-08-05 02:41:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`id`, `usuario`, `password`, `email`, `failed_attempts`, `reset_token`, `reset_token_expiry`, `role`) VALUES
(1, 'lalo', 'lalo', 'lalokeras677@gmail.com', 0, 'c1e81e799ab7706c5196f4fb2bb34ddbcbeb9ec984fe46f54a88811e298a5817f50bd2c352c297152ddb2e9b1da46424e4cd', '2024-08-08 07:55:50', 'user'),
(4, 'admin', 'admin', '', 0, NULL, NULL, 'admin'),
(12, 'profe', '123', 'profe@gmail.com', 0, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` text NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `descuento` tinyint(4) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `tipo`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'ILUMINACIÓN', '', '<h2 class=\"text-2xl font-bold my-2\">Marcas Líderes en el mercado:</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>HIGH END</li>\n    <li>ROBE</li>\n    <li>VARI LITE</li>\n</ul>\n\n<h2 class=\"text-2xl font-bold my-2\">Convencional:</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Par 64 Led’s</li>\n    <li>Fresnel</li>\n    <li>Lico con cortadoras</li>\n</ul>\n\n<h2 class=\"text-2xl font-bold my-2\">Robótica:</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Wash</li>\n    <li>Spot</li>\n    <li>Beem en las Marcas HIGH END, ROBE, VARI LITE</li>\n</ul>\n\n<h2 class=\"text-2xl font-bold my-2\">Seguidores:</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>DTS 575</li>\n    <li>1200 de descarga</li>\n</ul>\n', 28, 0, 1, 1),
(2, 'VIDEO', '', '<h2 class=\"text-2xl font-bold my-2\">Pantallas de Led’s</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>6mm</li>\n    <li>4mm</li>\n    <li>2mm con cualquier medida y diseño</li>\n</ul>\n\n<h2 class=\"text-2xl font-bold my-2\">Pantallas de Proyección y Proyectores</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Proyectores profesionales de 4,000 lúmenes a 18,000 lúmenes</li>\n</ul>\n\n<h2 class=\"text-2xl font-bold my-2\">Video Muros y Monitores</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>42”</li>\n    <li>55”</li>\n    <li>65”</li>\n    <li>75”</li>\n    <li>80”</li>\n</ul>\n\n<h2 class=\"text-2xl font-bold my-2\">Circuito Cerrado</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>De 01 hasta 10 cámaras profesionales</li>\n</ul>\n', 26, 0, 1, 1),
(3, 'ILUMINACIÓN ARQUITECTÓNICA', '', '<h2 class=\"text-2xl font-bold my-2\">Iluminación</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Para cualquier superficie</li>\n    <li>Instalaciones para interiores y exteriores</li>\n    <li>Proyección de Logotipos e Imágenes ( Diseños personalizados )</li>\n    <li>City Color, Flash Bar y Wash IP65</li>\n</ul>\n', 39, 0, 1, 1),
(4, 'PISTAS', '', '<h2 class=\"text-2xl font-bold my-2\">Marca TOP LINE</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Acabados en plastificado y charol en infinidad de colores</li>\n    <li>Estampadas con diseños personalizados</li>\n    <li>Vidrio, Acrílico Iluminadas, Duela, madera rústica</li>\n    <li>Manejamos cualquier medida y diseño</li>\n</ul>\n', 39, 0, 1, 1),
(5, 'ESCENARIOS', '', '<h2 class=\"text-2xl font-bold my-2\">Marca TOP LINE</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Alturas de 0.30 hasta 1.6m con faldón o talud</li>\n    <li>Acabados en plastificado, charol en infinidad de colores o estampados</li>\n    <li>Manejamos cualquier medida y diseño, contamos con barandal de seguridad</li>\n    <li>Vidrio y Acrílico Iluminados, Duela, Alfombrados, Madera rústica</li>\n</ul>\n', 39, 0, 1, 1),
(6, 'PASARELAS', '', '<h2 class=\"text-2xl font-bold my-2\">Marca TOP LINE</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Acabados en plastificado y charol en infinidad de colores</li>\n    <li>Estampadas con diseños personalizados</li>\n    <li>Vidrio, Acrílico Iluminadas, Duela, madera rústica</li>\n    <li>Manejamos cualquier medida y diseño</li>\n</ul>\n', 32, 0, 1, 1),
(7, 'DECORACION', '', '<h2 class=\"text-2xl font-bold my-2\">Centros de mesa y decoraciones</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Centros de mesa, arreglos florales</li>\n    <li>Fiestas Tema</li>\n    <li>Candiles, encortinados, mamparas</li>\n    <li>Mesas de novios</li>\n    <li>Cubrimos cualquier diseño que te imagines</li>\n</ul>\n', 32, 0, 1, 1),
(8, 'ESCENOGRAFIAS', '', '<h2 class=\"text-2xl font-bold my-2\">Escenografías y estructuras</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>En Lona impresa con calidad fotográfica</li>\n    <li>Escenografías Translucidas, Muros verdes</li>\n    <li>Contamos con todas las estructuras y accesorios para su instalación</li>\n    <li>Cubrimos cualquier diseño</li>\n</ul>\n', 42, 0, 1, 1),
(9, 'PLANTAS DE LUZ', '', '<h2 class=\"text-2xl font-bold my-2\">Generadores de energía</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>Profesionales de Gasolina y Diesel</li>\n    <li>Capacidad de 5kva hasta 200kva</li>\n    <li>Instalados en cajas acústicas</li>\n    <li>Incluyen centro de carga, cableado y todos los accesorios necesarios para su operación</li>\n</ul>\n', 42, 0, 1, 1),
(10, 'REFLECTORES ANTI-AEREOS', '', '<h2 class=\"text-2xl font-bold my-2\">Reflectores antiaéreos</h2>\n<ul class=\"list-disc ml-5 my-2\">\n    <li>De luz concentrada y luz difusa</li>\n    <li>De 4000w, 5000w y 8000w</li>\n    <li>Sistemas con o sin suministro de corriente eléctrica</li>\n    <li>Móviles o fijos</li>\n</ul>\n', 42, 0, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `buzon`
--
ALTER TABLE `buzon`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `buzon`
--
ALTER TABLE `buzon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
