-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql-server
-- Tiempo de generación: 19-02-2023 a las 08:08:08
-- Versión del servidor: 8.0.19
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230217123006', '2023-02-19 08:00:20', 10377);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `ID` int NOT NULL,
  `NOMBRE` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STOCK` int NOT NULL,
  `ARMARIO` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_material`
--

CREATE TABLE `reserva_material` (
  `CANTIDAD` int NOT NULL,
  `FECHA_RESERVA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FECHA_DEVOLUCION` date NOT NULL,
  `ESTADO` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_USUARIO` int NOT NULL,
  `ID_MATERIAL` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_sala`
--

CREATE TABLE `reserva_sala` (
  `FECHA_RESERVA` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HORARIO` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ID_USUARIO` int NOT NULL,
  `NUMERO_SALA` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE `sala` (
  `NUMERO_SALA` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `total_reservas`
--

CREATE TABLE `total_reservas` (
  `NOMBRE` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TOTAL` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `ID` int NOT NULL,
  `NOMBRE_USUARIO` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CONTRASEÑA` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CORREO` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRIVILEGIO` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `reserva_material`
--
ALTER TABLE `reserva_material`
  ADD PRIMARY KEY (`ID_USUARIO`,`ID_MATERIAL`,`FECHA_RESERVA`),
  ADD KEY `IDX_14A2155AE116644` (`ID_USUARIO`),
  ADD KEY `IDX_14A2155A2397894B` (`ID_MATERIAL`);

--
-- Indices de la tabla `reserva_sala`
--
ALTER TABLE `reserva_sala`
  ADD PRIMARY KEY (`FECHA_RESERVA`,`ID_USUARIO`,`HORARIO`,`NUMERO_SALA`),
  ADD KEY `IDX_42E93517E116644` (`ID_USUARIO`),
  ADD KEY `IDX_42E93517FBD4C859` (`NUMERO_SALA`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`NUMERO_SALA`);

--
-- Indices de la tabla `total_reservas`
--
ALTER TABLE `total_reservas`
  ADD PRIMARY KEY (`NOMBRE`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `reserva_material`
--
ALTER TABLE `reserva_material`
  ADD CONSTRAINT `FK_14A2155A2397894B` FOREIGN KEY (`ID_MATERIAL`) REFERENCES `material` (`ID`),
  ADD CONSTRAINT `FK_14A2155AE116644` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID`);

--
-- Filtros para la tabla `reserva_sala`
--
ALTER TABLE `reserva_sala`
  ADD CONSTRAINT `FK_42E93517E116644` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID`),
  ADD CONSTRAINT `FK_42E93517FBD4C859` FOREIGN KEY (`NUMERO_SALA`) REFERENCES `sala` (`NUMERO_SALA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;
