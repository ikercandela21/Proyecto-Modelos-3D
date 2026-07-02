-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2025 a las 17:08:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `modeladosinfinity`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_usuario`, `id_modelo`) VALUES
(1, 1, 12),
(2, 1, 13),
(3, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelados`
--

CREATE TABLE `modelados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(1200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `contenido` varchar(100) NOT NULL,
  `precio` double NOT NULL,
  `likes` int(11) NOT NULL,
  `num_descargas` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modelados`
--

INSERT INTO `modelados` (`id`, `nombre`, `descripcion`, `imagen`, `contenido`, `precio`, `likes`, `num_descargas`, `tipo`) VALUES
(1, 'Sofa', 'dfghjk', '../img/Sofa.png', 'ewddq12', 0, 11, 23, ''),
(10, 'Sofa', 'dfghjk', '../img/Sofa.png', 'ewddq12', 0, 11, 23, ''),
(11, 'Mario', 'Grandioso personaje de los años 80 el cual hizo historia', '../img/mario.jpg', 'oiqwueoiqwyeoqwiyeqwoei', 0, 110, 230, ''),
(12, 'tron', 'asdfkjansdkjfanksdjfnaksjdfn', '../img/tron.jpeg', 'sdakjsdkajsndkajsd', 0, 12, 40, 'modelo'),
(13, 'Modelo 13', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque fugit tempore labore facere culpa? Assumenda\r\nexercitationem laboriosam iste sequi rem eveniet dicta, consectetur autem non accusantium corrupti vel tempore\r\nobcaecati.Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque fugit tempore labore facere culpa? Assumenda\r\nexercitationem laboriosam iste sequi rem eveniet dicta, consectetur autem non accusantium corrupti vel tempore\r\nobcaecati.Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque fugit tempore labore facere culpa? Assumenda\r\nexercitationem laboriosam iste sequi rem eveniet dicta, consectetur autem non accusantium corrupti vel tempore\r\nobcaecati.', '../img/IMG_9017.jpg', 'ghasdkfhjasbgd', 0, 24, 12, 'modelo'),
(14, 'tierra', 'esto es una textura de que simula la tierra', '/img/tierra', 'https://drive.google.com/file/d/12Nm0jX1i8zLV6H99JR4R3zBB2uqWB6EO/view?usp=sharing', 0, 0, 0, 'texturas'),
(15, 'Percha', '', 'img/percha.png', 'https://drive.google.com/file/d/16IjBuMjMMCAqh9SJ1niWqzR6dNpN96KG/view?usp=sharing', 0, 7, 25, 'impresion3D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `contraseña`) VALUES
(1, 'Admin', 'admin@admin.com', '1234'),
(2, 'iker', 'iker@gmail.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modelados`
--
ALTER TABLE `modelados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modelados`
--
ALTER TABLE `modelados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
