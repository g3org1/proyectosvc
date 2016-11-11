-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2016 a las 13:28:08
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_scv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clinica`
--

CREATE TABLE `clinica` (
  `rut_clinica` varchar(10) NOT NULL,
  `nombre_clinica` varchar(50) DEFAULT NULL,
  `direccion_clinica` varchar(100) DEFAULT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  `telefono_clinica` int(15) DEFAULT NULL,
  `correo` varchar(20) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `puntaje` int(1) DEFAULT NULL,
  `detalle_clinica` varchar(200) DEFAULT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clinica`
--

INSERT INTO `clinica` (`rut_clinica`, `nombre_clinica`, `direccion_clinica`, `latitud`, `longitud`, `telefono_clinica`, `correo`, `link`, `puntaje`, `detalle_clinica`, `password`) VALUES
('16873933-8', 'Illantu Med', 'Freire 512,Concepcion,8', -36.8263, -73.053, 9876567, 'illantu@creado.com', 'www.facebook.com', 0, '', '1q2w3e'),
('17339108-0', 'CASA', 'Andalien 13,Concepcion,8', -36.807, -73.0299, 123456, 'asdf@qwerftg.com', 'www.ucsc.cl', 0, '', '123abc'),
('6245778-3', 'Hospital Regional Concepcion', 'San Martin 1436,Concepcion,8', -36.8242, -73.0388, 1254431243, 'asdf@qwerftg.com', 'www.hospitalregional.cl', 0, '', 'qwe123'),
('9384133-6', 'Hospital Clinico del Sur', 'Cardenio Avello 36,Concepcion,8', -36.8141, -73.0319, 1234565, 'adsfg@asdf.com', 'www.hospitalclinicodelsur.cl', 0, '', 'ewq123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichamedica`
--

CREATE TABLE `fichamedica` (
  `id_ficha` int(10) NOT NULL,
  `alergia` varchar(15) DEFAULT NULL,
  `grupo_sanguineo` varchar(15) DEFAULT NULL,
  `detalle` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

CREATE TABLE `hora` (
  `id` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `evento` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `rut_paciente` varchar(10) NOT NULL,
  `nombre_paciente` varchar(20) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  `direccion_paciente` varchar(30) DEFAULT NULL,
  `telefono_paciente` int(15) DEFAULT NULL,
  `correo_paciente` varchar(20) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`rut_paciente`, `nombre_paciente`, `fecha_nac`, `sexo`, `direccion_paciente`, `telefono_paciente`, `correo_paciente`, `foto`) VALUES
('22603349-1', 'Jorge Gallardo', '0011-11-11', 'varon', 'a-Coelemu', 123456, 'asdf@qwerftg.com', 'fotos/43A.jpg'),
('22603350-5', 'Paulo Gallardo', '0045-03-12', 'varon', 'Freire 512-Concepcion', 1234567, 'asdf@qwerftg.com', 'fotos/1970458_10203486428270167_699911687_n.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poseer`
--

CREATE TABLE `poseer` (
  `rut_clinica` varchar(10) NOT NULL,
  `rut_paciente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suministra`
--

CREATE TABLE `suministra` (
  `rut_clinica` varchar(10) NOT NULL,
  `id_vacuna` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacuna`
--

CREATE TABLE `vacuna` (
  `id_vacuna` int(10) NOT NULL,
  `tipo_vacuna` varchar(15) DEFAULT NULL,
  `fecha_vacuna` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clinica`
--
ALTER TABLE `clinica`
  ADD PRIMARY KEY (`rut_clinica`);

--
-- Indices de la tabla `fichamedica`
--
ALTER TABLE `fichamedica`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `hora`
--
ALTER TABLE `hora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`rut_paciente`);

--
-- Indices de la tabla `poseer`
--
ALTER TABLE `poseer`
  ADD PRIMARY KEY (`rut_clinica`,`rut_paciente`);

--
-- Indices de la tabla `suministra`
--
ALTER TABLE `suministra`
  ADD PRIMARY KEY (`rut_clinica`,`id_vacuna`);

--
-- Indices de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  ADD PRIMARY KEY (`id_vacuna`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hora`
--
ALTER TABLE `hora`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21948;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
