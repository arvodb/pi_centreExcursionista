-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mariadb-server
-- Tiempo de generación: 15-02-2023 a las 14:08:50
-- Versión del servidor: 10.10.3-MariaDB-1:10.10.3+maria~ubu2204
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoIntegrado`
--

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`ID`, `NOMBRE_USUARIO`, `CONTRASEÑA`, `CORREO`, `PRIVILEGIO`) VALUES
(1, 'eeriic20', 'Hola1234', 'ericquintero2002@gmail.com', 'Administrador'),
(2, 'arvo', 'Adios1234', 'arvo@gmail.com', 'Administrador'),
(3, 'andreset', 'Buenas1234', 'andres@gmail.com', 'Administrador'),
(4, 'hector', 'Good1234', 'hector@gmail.com', 'Administrador'),
(5, 'alejandro', 'Tardes1234', 'alejandro@gmail.com', 'Administrador'),
(6, 'juanjet1244', 'Juanjo1234', 'juanjet1244', 'Usuario'),
(7, 'pepet', 'Pepe1234', 'pepet@gmail.com', 'Usuario'),
(8, 'Paco', 'Paco1234', 'paquito@gmail.com', 'Usuario'),
(9, 'Juan', 'Juan1234', 'juanet@gmail.com', 'Usuario');
COMMIT;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`NUMERO_SALA`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);
COMMIT;

--
-- Volcado de datos para la tabla `reservaSala`
--

INSERT INTO `reserva_sala` (`NUMERO_SALA`, `FECHA_RESERVA`, `HORARIO`, `ID_USUARIO`) VALUES
(2, '2023-02-25', 'Mañana', 8),
(4, '2023-02-20', 'Tarde', 7),
(1, '2023-03-09', 'Mañana', 6),
(6, '2023-02-15', 'Mañana', 9),
(3, '2024-02-25', 'Tarde', 4);
COMMIT;

--
-- Volcado de datos para la tabla `total_reservados`
--

INSERT INTO `total_reservas` (`NOMBRE`, `TOTAL`) VALUES
('Cuerda', 0),
('Pico', 0),
('Caso', 0),
('Mosqueton', 0),
('Arnes', 0),
('Asegurador', 0);
COMMIT;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`ID`, `NOMBRE`, `STOCK`, `ARMARIO`) VALUES
(1, 'Cuerda', 65, 1),
(2, 'Pico', 12, 5),
(3, 'Caso', 23, 2),
(4, 'Mosqueton', 345, 1),
(5, 'Arnes', 45, 5),
(6, 'Asegurador', 123, 2);
COMMIT;

--
-- Volcado de datos para la tabla `reserva_material`
--

INSERT INTO `reserva_material` (`CANTIDAD`, `FECHA_RESERVA`, `FECHA_DEVOLUCION`, `ESTADO`, `ID_USUARIO`, `ID_MATERIAL`) VALUES
(45, '2023-02-19', '2023-02-26', 'Reservado', 2, 1),
(232, '2023/02/15', '2023-02-17', 'Reservado', 2, 6),
(345, '2023/02/12', '2023-02-15', 'Reservado', 4, 5),
(4, '2023-02-05', '2023-02-09', 'Reservado', 7, 1),
(4, '2023-02-19', '2023-02-22', 'Reservado', 7, 1),
(4, '2023-02-19', '2023-02-22', 'Reservado', 7, 2),
(4, '2023-02-19', '2023-02-22', 'Reservado', 7, 3),
(8, '2023-02-19', '2023-02-22', 'Reservado', 7, 4),
(4, '2023-02-19', '2023-02-22', 'Reservado', 7, 5),
(4, '2023-02-19', '2023-02-22', 'Reservado', 7, 6),
(65, '2023/02/12', '2023-02-15', 'Reservado', 8, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
