-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2020 a las 23:35:22
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gaby_fit`
--
CREATE DATABASE IF NOT EXISTS `gaby_fit` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `gaby_fit`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_actualizar` (IN `pa_id_cliente` INT, IN `pa_nombre` VARCHAR(50), IN `pa_apellido` VARCHAR(50), IN `pa_id_suscripcion` INT, IN `pa_id_genero` INT)  BEGIN
update clientes set id_cliente=pa_id_cliente,
nombre = pa_nombre,
apellido = pa_apellido,
id_suscripcion = pa_id_suscripcion,
id_genero=pa_id_genero
WHERE
id_cliente=pa_id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_consultar` ()  BEGIN
select c.id_cliente, c.nombre, c.apellido, s.nombre_suscripcion, g.nombre_genero from clientes c
inner join suscripcion s ON s.id_suscripcion=c.id_suscripcion
inner join genero g ON g.id_genero=c.id_genero;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_consultarporid` (IN `pa_id_cliente` INT)  NO SQL
BEGIN
select * from clientes where id_cliente = pa_id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_eliminar` (IN `pa_id_cliente` INT)  BEGIN
delete from clientes where id_cliente= pa_id_cliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_insertar` (IN `pa_nombre` VARCHAR(50), IN `pa_apellido` VARCHAR(50), IN `pa_id_suscripcion` INT, IN `pa_id_genero` INT)  NO SQL
BEGIN
insert into clientes (nombre, apellido, id_suscripcion, id_genero) VALUES (pa_nombre, pa_apellido, pa_id_suscripcion, pa_id_genero);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_suscripcion` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `apellido`, `id_suscripcion`, `id_genero`) VALUES
(1, 'Humberto', 'Henriquez', 1, 1),
(2, 'Wilfredo', 'Benitez', 2, 1),
(3, 'Isidro', 'Colocho3', 1, 1),
(4, 'Pedro', 'Mendoza', 1, 1),
(5, 'Rocio', 'Miranda', 1, 2);

--
-- Disparadores `clientes`
--
DELIMITER $$
CREATE TRIGGER `actualizar` AFTER UPDATE ON `clientes` FOR EACH ROW BEGIN
insert into
trigger_cliente (id_cliente, nombre, nombre_viejo, apellido, apellido_viejo, id_suscripcion, id_suscripcion_viejo, id_genero, id_genero_viejo, usuario, fecha_hora, accion)
VALUES
(new.id_cliente, new.nombre, old.nombre, new.apellido, old.apellido, new.id_suscripcion, old.id_suscripcion, new.id_genero, old.id_genero, USER(), NOW(), 'Actualizar');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `eliminar` AFTER DELETE ON `clientes` FOR EACH ROW BEGIN
insert into trigger_cliente (id_cliente, nombre_viejo, apellido_viejo, id_suscripcion_viejo, id_genero_viejo, usuario, fecha_hora, accion)
VALUES
(old.id_cliente, old.nombre, old.apellido, old.id_suscripcion, old.id_genero, USER(), NOW(), 'Eliminar');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertar` AFTER INSERT ON `clientes` FOR EACH ROW BEGIN
insert into trigger_cliente
(id_cliente, nombre, apellido, id_suscripcion, id_genero, usuario, fecha_hora, accion) VALUES
(new.id_cliente, new.nombre, new.apellido, new.id_suscripcion, new.id_genero, USER(), NOW(), 'Insertar');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `id_genero` int(11) NOT NULL,
  `nombre_genero` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `genero`
--

INSERT INTO `genero` (`id_genero`, `nombre_genero`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'LGBTI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripcion`
--

CREATE TABLE `suscripcion` (
  `id_suscripcion` int(11) NOT NULL,
  `nombre_suscripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `suscripcion`
--

INSERT INTO `suscripcion` (`id_suscripcion`, `nombre_suscripcion`) VALUES
(1, 'Completa'),
(2, 'Parcial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trigger_cliente`
--

CREATE TABLE `trigger_cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_viejo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_viejo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_suscripcion` int(11) NOT NULL,
  `id_suscripcion_viejo` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_genero_viejo` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_hora` int(11) NOT NULL,
  `accion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `trigger_cliente`
--

INSERT INTO `trigger_cliente` (`id_cliente`, `nombre`, `nombre_viejo`, `apellido`, `apellido_viejo`, `id_suscripcion`, `id_suscripcion_viejo`, `id_genero`, `id_genero_viejo`, `usuario`, `fecha_hora`, `accion`) VALUES
(1, 'Humberto', '', 'Henriquez', '', 1, 0, 1, 0, 'root@localhost', 2147483647, 'Insertar'),
(2, 'Wilfredo', '', 'Benitez', '', 2, 0, 1, 0, 'root@localhost', 2147483647, 'Insertar'),
(3, 'Isidro', '', 'Colocho', '', 1, 0, 1, 0, 'root@localhost', 2147483647, 'Insertar'),
(3, 'Isidro', 'Isidro', 'Colocho2', 'Colocho', 1, 1, 1, 1, 'root@localhost', 2147483647, 'Actualizar'),
(3, 'Isidro', 'Isidro', 'Colocho3', 'Colocho2', 1, 1, 1, 1, 'root@localhost', 2147483647, 'Actualizar'),
(4, 'Pedro', '', 'Mendoza', '', 1, 0, 1, 0, 'root@localhost', 2147483647, 'Insertar'),
(5, 'Rocio', '', 'Miranda', '', 1, 0, 2, 0, 'root@localhost', 2147483647, 'Insertar'),
(9, 'Vanessa', '', 'Brenes', '', 1, 0, 2, 0, 'root@localhost', 2147483647, 'Insertar'),
(10, 'gfdgd', '', 'gfgf', '', 1, 0, 2, 0, 'root@localhost', 2147483647, 'Insertar'),
(10, '', 'gfdgd', '', 'gfgf', 0, 1, 0, 2, 'root@localhost', 2147483647, 'Eliminar'),
(9, 'Vanessa3', 'Vanessa', 'Brenes', 'Brenes', 1, 1, 2, 2, 'root@localhost', 2147483647, 'Actualizar'),
(1, 'Humberto', 'Humberto', 'Henriquez', 'Henriquez', 1, 1, 1, 1, 'root@localhost', 2147483647, 'Actualizar'),
(9, '', 'Vanessa3', '', 'Brenes', 0, 1, 0, 2, 'root@localhost', 2147483647, 'Eliminar');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `clientes_genero` (`id_genero`),
  ADD KEY `clientes_suscripcion` (`id_suscripcion`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  ADD PRIMARY KEY (`id_suscripcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `suscripcion`
--
ALTER TABLE `suscripcion`
  MODIFY `id_suscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_genero` FOREIGN KEY (`id_genero`) REFERENCES `genero` (`id_genero`),
  ADD CONSTRAINT `clientes_suscripcion` FOREIGN KEY (`id_suscripcion`) REFERENCES `suscripcion` (`id_suscripcion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
