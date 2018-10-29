-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-10-2018 a las 10:31:53
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practica12`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) NOT NULL,
  `fecha_agregado` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiales`
--

DROP TABLE IF EXISTS `historiales`;
CREATE TABLE IF NOT EXISTS `historiales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `nota` varchar(300) DEFAULT NULL,
  `referencia` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_registro` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `producto` (`producto`,`usuario`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historiales`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_agregado` date NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `ruta_img` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `paterno` varchar(50) NOT NULL,
  `materno` varchar(100) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `fecha_registro` date NOT NULL,
  `ruta_img` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `paterno`, `materno`, `nombre_usuario`, `password`, `correo`, `fecha_registro`, `ruta_img`) VALUES
(1, 'Miguel', 'Perez', 'Sanchez', 'admin', 'admin', 'admin@gmail.com', '2018-10-27', '../media/default/default.png'),

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historiales`
--
ALTER TABLE `historiales`
  ADD CONSTRAINT `historiales_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `historiales_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
