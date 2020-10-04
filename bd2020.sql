-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 03-06-2020 a las 01:43:08
-- Versión del servidor: 8.0.18
-- Versión de PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd2020`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente`
--

DROP TABLE IF EXISTS `agente`;
CREATE TABLE IF NOT EXISTS `agente` (
  `codagente` smallint(5) NOT NULL AUTO_INCREMENT,
  `congregacion` varchar(50) NOT NULL,
  `agente` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL DEFAULT '1',
  `incorporacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codagente`),
  KEY `usuario_id` (`usuario_id`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `agente`
--

INSERT INTO `agente` (`codagente`, `congregacion`, `agente`, `telefono`, `estatus`, `usuario_id`, `incorporacion`) VALUES
(43, 'Central', 'fernando ruiz', '79232189', 1, 40, '2020-03-27 15:51:35'),
(44, 'Milagro de la Paz', 'loca paola 6', '30309090', 0, 42, '2020-03-29 12:14:48'),
(45, 'Milagro de la Paz', 'fernando ruiz', '79232185', 0, 40, '2020-03-29 13:32:56'),
(46, 'Milagro de la Paz', 'nando', '1234', 0, 42, '2020-03-29 13:41:17'),
(47, 'Central', 'sads23', '123', 0, 42, '2020-03-29 13:42:35'),
(48, 'Central', 'fdf', '123', 0, 42, '2020-03-29 13:42:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corresponsal`
--

DROP TABLE IF EXISTS `corresponsal`;
CREATE TABLE IF NOT EXISTS `corresponsal` (
  `codcorresponsal` smallint(5) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(50) NOT NULL,
  `corresponsal` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL,
  `incorporacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codcorresponsal`),
  KEY `estatus` (`estatus`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `corresponsal`
--

INSERT INTO `corresponsal` (`codcorresponsal`, `distrito`, `corresponsal`, `telefono`, `estatus`, `usuario_id`, `incorporacion`) VALUES
(39, 'saCS', 'fdf', '123', 1, 40, '2020-03-29 15:17:43'),
(40, 'San Miguel I', 'nando pando', '12345678', 1, 40, '2020-03-29 20:33:44'),
(41, 'san miguel 3', 'KATY BEBE', '12345', 1, 43, '2020-03-29 21:44:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

DROP TABLE IF EXISTS `distrito`;
CREATE TABLE IF NOT EXISTS `distrito` (
  `coddistrito` smallint(5) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(50) NOT NULL,
  `zona` int(5) NOT NULL,
  `estatus` smallint(6) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL,
  `incorporacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`coddistrito`),
  KEY `estatus` (`estatus`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`coddistrito`, `distrito`, `zona`, `estatus`, `usuario_id`, `incorporacion`) VALUES
(56, 'saCS', 1, 1, 42, '2020-03-29 15:05:15'),
(57, 'San Miguel I', 1, 1, 42, '2020-03-29 20:32:10'),
(58, 'san miguel 3', 1, 1, 43, '2020-03-29 21:39:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

DROP TABLE IF EXISTS `estatus`;
CREATE TABLE IF NOT EXISTS `estatus` (
  `codestatus` smallint(5) NOT NULL AUTO_INCREMENT,
  `estatus` varchar(50) NOT NULL,
  PRIMARY KEY (`codestatus`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`codestatus`, `estatus`) VALUES
(0, 'inactivo'),
(1, 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

DROP TABLE IF EXISTS `familia`;
CREATE TABLE IF NOT EXISTS `familia` (
  `codfamilia` smallint(5) NOT NULL AUTO_INCREMENT,
  `familia` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `donativo` int(11) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL,
  `incorporacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codfamilia`),
  KEY `estatus` (`estatus`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`codfamilia`, `familia`, `telefono`, `donativo`, `estatus`, `usuario_id`, `incorporacion`) VALUES
(46, 'Lopez Lopez', '26430177', 500, 1, 41, '2020-03-29 18:36:53'),
(47, 'Umanzor', '2232324', 322, 1, 51, '2020-03-29 19:04:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iglesia`
--

DROP TABLE IF EXISTS `iglesia`;
CREATE TABLE IF NOT EXISTS `iglesia` (
  `codcongregacion` smallint(5) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(50) NOT NULL,
  `congregacion` varchar(50) NOT NULL,
  `membresia` smallint(5) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL,
  `incorporacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codcongregacion`),
  KEY `estatus` (`estatus`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `iglesia`
--

INSERT INTO `iglesia` (`codcongregacion`, `distrito`, `congregacion`, `membresia`, `estatus`, `usuario_id`, `incorporacion`) VALUES
(45, 'San Miguel I', 'Milagro de la Paz', 0, 1, 42, '2020-03-29 22:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembro`
--

DROP TABLE IF EXISTS `miembro`;
CREATE TABLE IF NOT EXISTS `miembro` (
  `codmiembro` smallint(5) NOT NULL AUTO_INCREMENT,
  `familia` varchar(50) NOT NULL,
  `miembro` varchar(50) CHARACTER SET utf8mb4  NOT NULL,
  `edad` int(50) NOT NULL,
  `nacimiento` date NOT NULL,
  `usuario_id` smallint(5) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `incorporacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codmiembro`),
  KEY `familia` (`usuario_id`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `miembro`
--

INSERT INTO `miembro` (`codmiembro`, `familia`, `miembro`, `edad`, `nacimiento`, `usuario_id`, `estatus`, `incorporacion`) VALUES
(36, '', 'fere', 12, '2020-03-11', 41, 0, '2020-03-18 14:55:11'),
(38, '', 'Salomon Bercian', 12, '3333-01-03', 41, 0, '2020-03-18 21:18:50'),
(44, 'retere', 'mola bukele', 29, '2020-03-09', 41, 0, '2015-03-18 21:50:12'),
(45, 'retere', 'Saloma Bercian', 21, '2019-03-11', 41, 0, '2020-03-18 22:09:58'),
(46, 'BERCIAN RUIZ', 'NANDO BERCIANa', 26, '2000-01-16', 40, 1, '2020-03-26 22:43:08'),
(47, 'lopez martinez', 'jose martinez', 56, '1995-01-05', 41, 0, '2020-03-28 07:38:25'),
(48, 'Lopez Lopez', 'Egar Lopez', 45, '1995-05-05', 41, 1, '2020-03-29 12:38:38'),
(49, 'Umanzor', 'jolata', 1234, '1995-12-03', 51, 1, '2020-03-29 13:12:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pastor`
--

DROP TABLE IF EXISTS `pastor`;
CREATE TABLE IF NOT EXISTS `pastor` (
  `codpastor` smallint(5) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(50) NOT NULL,
  `pastor` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL,
  `incorporacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codpastor`),
  KEY `pastor_ibfk_1` (`estatus`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `pastor`
--

INSERT INTO `pastor` (`codpastor`, `distrito`, `pastor`, `telefono`, `estatus`, `usuario_id`, `incorporacion`) VALUES
(27, 'San Miguel III', 'Pedro López', '76967442', 1, 40, '2020-03-27 11:08:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `codrol` smallint(5) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`codrol`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`codrol`, `rol`) VALUES
(1, 'administrador'),
(2, 'pastor'),
(3, 'corresponsal'),
(4, 'agente'),
(5, 'crack'),
(30, 'familia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjeta`
--

DROP TABLE IF EXISTS `tarjeta`;
CREATE TABLE IF NOT EXISTS `tarjeta` (
  `codtarjeta` smallint(5) NOT NULL AUTO_INCREMENT,
  `tarjeta` varchar(50) CHARACTER SET utf8mb4  NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb4  NOT NULL,
  `monto` int(50) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `usuario_id` smallint(5) NOT NULL,
  `apertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codtarjeta`),
  KEY `estatus` (`estatus`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `codusuario` smallint(5) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol` smallint(5) NOT NULL,
  `estatus` smallint(5) NOT NULL DEFAULT '1',
  `incorporacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`codusuario`),
  KEY `rol` (`rol`),
  KEY `estatus` (`estatus`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`, `incorporacion`) VALUES
(40, 'ingbercian', 'global@ingbercian.tech', 'global', '202cb962ac59075b964b07152d234b70', 5, 1, '2020-03-17 19:00:11'),
(41, 'agente', 'agente@ingbercian.tech', 'agente', '202cb962ac59075b964b07152d234b70', 4, 1, '2020-03-17 19:02:07'),
(42, 'corresponsal', 'corresponsal@ingbercian.tech', 'corresponsal', '202cb962ac59075b964b07152d234b70', 3, 1, '2020-03-17 19:05:38'),
(43, 'pastor', 'pastor@ingbercian.tech', 'pastor', '202cb962ac59075b964b07152d234b70', 2, 1, '2020-03-17 19:06:33'),
(44, 'familia', 'familia@ingbercian.tech', 'familia', '202cb962ac59075b964b07152d234b70', 30, 1, '2020-03-17 19:08:03'),
(45, 'administrador', 'administrador@ingbercian.tech', 'administrador', '202cb962ac59075b964b07152d234b70', 1, 1, '2020-03-17 19:09:00'),
(51, 'loca paola 6', 'killerspy503@gmailc.com', 'agente1', '202cb962ac59075b964b07152d234b70', 4, 1, '2020-03-29 13:03:34'),
(52, 'nando pando', 'ingbercian@gmail.com', 'rx', '202cb962ac59075b964b07152d234b70', 3, 0, '2020-03-29 20:49:34'),
(53, 'nando pando', 'vcxv@f.com', 'dc', '202cb962ac59075b964b07152d234b70', 3, 0, '2020-03-29 20:50:04'),
(54, 'KATY BEBE', 'gfdf@dc', 'katy', '202cb962ac59075b964b07152d234b70', 3, 1, '2020-03-29 22:01:15');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agente`
--
ALTER TABLE `agente`
  ADD CONSTRAINT `agente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agente_ibfk_2` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `corresponsal`
--
ALTER TABLE `corresponsal`
  ADD CONSTRAINT `corresponsal_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `corresponsal_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD CONSTRAINT `distrito_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distrito_ibfk_4` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `familia`
--
ALTER TABLE `familia`
  ADD CONSTRAINT `familia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `familia_ibfk_3` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `iglesia`
--
ALTER TABLE `iglesia`
  ADD CONSTRAINT `iglesia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iglesia_ibfk_3` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `miembro`
--
ALTER TABLE `miembro`
  ADD CONSTRAINT `miembro_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `miembro_ibfk_2` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pastor`
--
ALTER TABLE `pastor`
  ADD CONSTRAINT `pastor_ibfk_1` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pastor_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarjeta`
--
ALTER TABLE `tarjeta`
  ADD CONSTRAINT `tarjeta_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`codusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`codrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`estatus`) REFERENCES `estatus` (`codestatus`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
