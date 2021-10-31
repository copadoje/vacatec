-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-10-2021 a las 20:38:00
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `vacatec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corrales`
--

CREATE TABLE `corrales` (
  `id` int(11) NOT NULL,
  `prom_edad` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `num_vacas` int(11) DEFAULT NULL,
  `num_machos` int(11) DEFAULT NULL,
  `num_hembras` int(11) DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `corrales`
--

INSERT INTO `corrales` (`id`, `prom_edad`, `status`, `fecha_inicio`, `num_vacas`, `num_machos`, `num_hembras`, `fecha_fin`) VALUES
(1, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corrales_exis`
--

CREATE TABLE `corrales_exis` (
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `corrales_exis`
--

INSERT INTO `corrales_exis` (`cantidad`) VALUES
(10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(30) NOT NULL,
  `username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nombre`, `apellido`, `correo`, `password`, `nivel`) VALUES
(1, 'copadoje', 'Jorge', 'Copado', 'copadoemmanuel@gmail.com', 'Password2021', 1),
(2, 'copadoemmanuel', 'Jorge  ', 'Copado', 'copadoj@gmail.com', '3f5c62798e34136d650f7343cdc2b08c', 1),
(3, 'copadoemmanuel2', 'Jorge  ', 'Copado', 'copadoj@gmail.com', '3f5c62798e34136d650f7343cdc2b08c', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `corrales`
--
ALTER TABLE `corrales`
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
-- AUTO_INCREMENT de la tabla `corrales`
--
ALTER TABLE `corrales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
