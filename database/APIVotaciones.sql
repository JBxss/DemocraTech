-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 14-09-2023 a las 04:19:28
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `APIVotaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_candidatos`
--

CREATE TABLE `tbl_candidatos` (
  `numero_candidato` int(11) NOT NULL,
  `nombre_candidato` varchar(255) NOT NULL,
  `apellido_candidato` varchar(255) NOT NULL,
  `tipo_candidato` varchar(255) NOT NULL,
  `genero_candidato` char(11) NOT NULL,
  `localidad_candidato` varchar(255) NOT NULL,
  `partido_candidato` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_candidatos`
--

INSERT INTO `tbl_candidatos` (`numero_candidato`, `nombre_candidato`, `apellido_candidato`, `tipo_candidato`, `genero_candidato`, `localidad_candidato`, `partido_candidato`) VALUES
(12345, 'Alex', 'Char', 'CC', 'Masculino', 'Barranquilla', 'Liberal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_votantes`
--

CREATE TABLE `tbl_votantes` (
  `numero_votante` int(11) NOT NULL,
  `nombre_votante` varchar(255) NOT NULL,
  `apellido_votante` varchar(255) NOT NULL,
  `tipo_votante` varchar(255) NOT NULL,
  `genero_votante` char(11) NOT NULL,
  `localidad_votante` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_votantes`
--

INSERT INTO `tbl_votantes` (`numero_votante`, `nombre_votante`, `apellido_votante`, `tipo_votante`, `genero_votante`, `localidad_votante`) VALUES
(35, 'Daniela', 'Herrera', 'CC', 'Femenino', 'Barranquilla'),
(123, 'Juan', 'Bossa', 'CC', 'Masculino', 'Barranquilla'),
(234, 'Jose', 'Alv', 'CE', 'Masculino', 'Santa Marta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_votos`
--

CREATE TABLE `tbl_votos` (
  `id_voto` int(11) NOT NULL,
  `numero_votante` int(11) NOT NULL,
  `numero_candidato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_votos`
--

INSERT INTO `tbl_votos` (`id_voto`, `numero_votante`, `numero_candidato`) VALUES
(2, 35, 12345),
(11, 123, 12345);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_candidatos`
--
ALTER TABLE `tbl_candidatos`
  ADD PRIMARY KEY (`numero_candidato`);

--
-- Indices de la tabla `tbl_votantes`
--
ALTER TABLE `tbl_votantes`
  ADD PRIMARY KEY (`numero_votante`);

--
-- Indices de la tabla `tbl_votos`
--
ALTER TABLE `tbl_votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `FK_CANDIDATO_VOTO` (`numero_candidato`),
  ADD KEY `FK_VOTANTE_VOTO` (`numero_votante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_votos`
--
ALTER TABLE `tbl_votos`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_votos`
--
ALTER TABLE `tbl_votos`
  ADD CONSTRAINT `FK_CANDIDATO_VOTO` FOREIGN KEY (`numero_candidato`) REFERENCES `tbl_candidatos` (`numero_candidato`),
  ADD CONSTRAINT `FK_VOTANTE_VOTO` FOREIGN KEY (`numero_votante`) REFERENCES `tbl_votantes` (`numero_votante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
