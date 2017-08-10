-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-08-2017 a las 20:11:13
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `techocars`
--
CREATE DATABASE IF NOT EXISTS `techocars` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `techocars`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anio`
--

CREATE TABLE IF NOT EXISTS `anio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ANIO` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ANIO` (`ANIO`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anio`
--

INSERT INTO `anio` (`id`, `ANIO`) VALUES
(1, '1940'),
(2, '1950'),
(3, '1960'),
(4, '1970'),
(5, '1980'),
(6, '1990'),
(7, '2000'),
(8, '2010'),
(9, '2017');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `color` (`color`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id`, `color`) VALUES
(4, 'Amarillo'),
(1, 'Azul'),
(6, 'Morado'),
(3, 'Negro'),
(5, 'Rojo'),
(2, 'Verde');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fabrica`
--

CREATE TABLE IF NOT EXISTS `fabrica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fabrica`
--

INSERT INTO `fabrica` (`id`, `nombre`) VALUES
(1, 'Chevrolet'),
(4, 'Ducati'),
(7, 'ferrari'),
(2, 'Ford'),
(6, 'Harley-Davidson'),
(3, 'Honda'),
(5, 'Yamaha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelo`
--

CREATE TABLE IF NOT EXISTS `modelo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modelo`
--

INSERT INTO `modelo` (`id`, `nombre`) VALUES
(4, 'Burgman'),
(6, 'Dyna-super'),
(2, 'Fusion'),
(3, 'Maverick'),
(1, 'Monza'),
(5, 'Tenere');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motor`
--

CREATE TABLE IF NOT EXISTS `motor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motor` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `motor` (`motor`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `motor`
--

INSERT INTO `motor` (`id`, `motor`) VALUES
(1, '1.0'),
(2, '1.4'),
(6, '1200'),
(4, '150'),
(3, '2.0'),
(5, '660');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `tipo`) VALUES
(1, 'Carro'),
(2, 'Moto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fabrica` int(11) NOT NULL,
  `modelo` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `motor` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `kilometraje` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fabrica` (`fabrica`),
  KEY `modelo` (`modelo`),
  KEY `anio` (`anio`),
  KEY `color` (`color`),
  KEY `motor` (`motor`),
  KEY `tipo` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id`, `fabrica`, `modelo`, `anio`, `color`, `motor`, `tipo`, `kilometraje`) VALUES
(1, 1, 3, 1, 1, 2, 1, '100000km'),
(2, 4, 4, 9, 5, 6, 2, '0km'),
(3, 6, 6, 3, 3, 5, 2, '200000km'),
(4, 3, 1, 6, 5, 3, 1, '150000km'),
(5, 2, 2, 8, 4, 2, 1, '0km'),
(6, 5, 5, 5, 6, 6, 2, '150000km');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `vehiculo_ibfk_1` FOREIGN KEY (`fabrica`) REFERENCES `fabrica` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_2` FOREIGN KEY (`modelo`) REFERENCES `modelo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_3` FOREIGN KEY (`anio`) REFERENCES `anio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_4` FOREIGN KEY (`color`) REFERENCES `color` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_5` FOREIGN KEY (`motor`) REFERENCES `motor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_ibfk_6` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
