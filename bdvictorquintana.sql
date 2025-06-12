-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2025 a las 03:58:44
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
-- Base de datos: `bdvictorquintana`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticketsoporte`
--

CREATE TABLE `ticketsoporte` (
  `idticketsoporte` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Mensaje` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `foto_perfil` varchar(200) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `busquedas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `nombre`, `usuario`, `correo`, `foto_perfil`, `contraseña`, `busquedas`) VALUES
(1, '0', '0', '0', '', '0', 0),
(5, 'victor', 'victor', 'victor@gmail.com', 'uploads/perfil_5_1749693347.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ticketsoporte`
--
ALTER TABLE `ticketsoporte`
  ADD PRIMARY KEY (`idticketsoporte`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ticketsoporte`
--
ALTER TABLE `ticketsoporte`
  MODIFY `idticketsoporte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
