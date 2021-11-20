-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2021 a las 23:13:54
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
-- Estructura de tabla para la tabla `control_pastura`
--

CREATE TABLE `control_pastura` (
  `id` int(200) NOT NULL,
  `corral` int(11) NOT NULL,
  `formula` int(11) NOT NULL,
  `num_animales` int(11) NOT NULL,
  `dias_animal` int(11) NOT NULL,
  `kg_ofrecidos` float NOT NULL,
  `kg_acumulados` float NOT NULL,
  `consumo_animal` float NOT NULL,
  `consumo_promedio` float NOT NULL,
  `costo_kg` float NOT NULL,
  `costo_total` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `control_pastura`
--

INSERT INTO `control_pastura` (`id`, `corral`, `formula`, `num_animales`, `dias_animal`, `kg_ofrecidos`, `kg_acumulados`, `consumo_animal`, `consumo_promedio`, `costo_kg`, `costo_total`, `fecha`) VALUES
(1, 1, 0, 3, 3, 50, 50, 16.6667, 16.6667, 4.6, 230, '2021-11-20'),
(2, 1, 1, 3, 6, 50, 100, 16.6667, 16.6667, 4.6, 230, '2021-11-20'),
(3, 1, 1, 4, 10, 70, 170, 17.5, 17, 4.6, 322, '2021-11-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corrales`
--

CREATE TABLE `corrales` (
  `id` int(11) NOT NULL,
  `prom_edad` float DEFAULT NULL,
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
(1, 11, 1, '2021-11-08', 4, 3, 1, NULL),
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
  `id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `corrales_exis`
--

INSERT INTO `corrales_exis` (`id`, `cantidad`) VALUES
(1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulas`
--

CREATE TABLE `formulas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `maiz` float NOT NULL,
  `soya` float NOT NULL,
  `silo` float NOT NULL,
  `rastrojo` float NOT NULL,
  `algodon` float NOT NULL,
  `ddg` float NOT NULL,
  `avena` float NOT NULL,
  `melaza` float NOT NULL,
  `costo` float NOT NULL,
  `existencia` float DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `formulas`
--

INSERT INTO `formulas` (`id`, `nombre`, `maiz`, `soya`, `silo`, `rastrojo`, `algodon`, `ddg`, `avena`, `melaza`, `costo`, `existencia`, `status`) VALUES
(1, 'gt1', 10, 20, 40, 0, 1.9, 8.1, 10, 10, 4.6, 380, 1),
(2, 'gt2', 40, 2, 40, 0, 5, 3, 10, 0, 4.6, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `insumo` varchar(100) NOT NULL,
  `precio` float NOT NULL,
  `existencia` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `insumo`, `precio`, `existencia`, `total`) VALUES
(1, 'MAIZ', 4.8, 199946, 959741),
(2, 'SOYA', 9.8, 10890, 106722),
(3, 'SILO', 1, 199780, 199780),
(4, 'RASTROJO PICADO', 1.8, 10000, 18000),
(5, 'SEMILLA DE ALGODON', 6.7, 22989.5, 154030),
(6, 'DDG', 7, 44955.5, 314688),
(7, 'AVENA', 3.5, 7945, 27807.5),
(8, 'MELAZA', 3, 29945, 89835);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `costo` float NOT NULL,
  `cantidad` int(11) NOT NULL,
  `arete` varchar(100) NOT NULL,
  `corral` int(11) NOT NULL,
  `total` float NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `producto`, `nombre`, `costo`, `cantidad`, `arete`, `corral`, `total`, `fecha`) VALUES
(1, 1, 'CLOSTRI-10', 48, 2, '12341', 1, 96, '2021-11-15'),
(2, 2, 'SINGLE SHOT', 112, 2, '12341', 1, 224, '2021-11-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `keygen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacas`
--

CREATE TABLE `vacas` (
  `id` int(100) NOT NULL,
  `arete` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` int(5) NOT NULL,
  `peso_ini` float NOT NULL,
  `fecha_compra` date NOT NULL,
  `edad` int(20) NOT NULL,
  `numero_corral` int(10) NOT NULL,
  `gasto` float DEFAULT NULL,
  `status` int(5) NOT NULL,
  `procedencia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `costo_inicial` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `vacas`
--

INSERT INTO `vacas` (`id`, `arete`, `sexo`, `peso_ini`, `fecha_compra`, `edad`, `numero_corral`, `gasto`, `status`, `procedencia`, `fecha_registro`, `fecha_finalizacion`, `costo_inicial`) VALUES
(1, '12341', 1, 210.3, '2021-07-01', 11, 1, 381.167, 1, 'Cocula', '2021-11-08', NULL, 12000),
(2, '12342', 2, 210.3, '2021-07-01', 15, 1, 157.167, 1, 'Cocula', '2021-11-08', NULL, 13000),
(3, '12343', 1, 210.3, '2021-07-01', 9, 1, 157.167, 1, 'Granja', '2021-11-08', NULL, 0),
(4, '12344', 1, 230.3, '2021-07-01', 9, 1, 80.5, 1, 'Granja', '2021-11-20', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacunas`
--

CREATE TABLE `vacunas` (
  `id` int(11) NOT NULL,
  `vacuna` varchar(100) NOT NULL,
  `presentacion` int(11) NOT NULL,
  `costo` float NOT NULL,
  `existencia` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacunas`
--

INSERT INTO `vacunas` (`id`, `vacuna`, `presentacion`, `costo`, `existencia`, `total`) VALUES
(1, 'CLOSTRI-10', 10, 48, 18, 864),
(2, 'SINGLE SHOT', 10, 112, 18, 2016),
(3, 'PROTECTOR-5', 10, 356.88, 20, 7137.6),
(4, 'REVALOR G', 20, 27.8, 40, 1112),
(5, 'MAXIBEEF', 20, 780, 40, 31200),
(6, 'MASTER L5', 25, 1316.5, 50, 65825),
(7, 'INMUNOIDI DB', 4, 205, 8, 1640);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `control_pastura`
--
ALTER TABLE `control_pastura`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corrales`
--
ALTER TABLE `corrales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corrales_exis`
--
ALTER TABLE `corrales_exis`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formulas`
--
ALTER TABLE `formulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacas`
--
ALTER TABLE `vacas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `control_pastura`
--
ALTER TABLE `control_pastura`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `corrales`
--
ALTER TABLE `corrales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `corrales_exis`
--
ALTER TABLE `corrales_exis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `formulas`
--
ALTER TABLE `formulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vacas`
--
ALTER TABLE `vacas`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vacunas`
--
ALTER TABLE `vacunas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
