-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-02-2025 a las 03:54:47
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `free_fire`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `armas`
--

CREATE TABLE `armas` (
  `id_arma` int NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `intentos` int DEFAULT '0',
  `nivel_requerido` int NOT NULL,
  `id_categoria` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `armas`
--

INSERT INTO `armas` (`id_arma`, `imagen`, `nombre`, `intentos`, `nivel_requerido`, `id_categoria`) VALUES
(1, 'xm8.png\r\n', 'XM8', 30, 2, 4),
(2, 'M14.png', 'M14', 22, 2, 4),
(3, 'AK.PNG', 'AK', 28, 2, 4),
(4, 'GLOCK18.PNG', 'GLOCK18', 20, 1, 2),
(5, 'MP5.PNG', 'MP5', 20, 1, 2),
(6, 'DESERT_EAGLE.PNG', 'DESERT EAGLE', 21, 1, 2),
(7, 'AWP.PNG', 'AWP', 15, 2, 3),
(8, 'ATP.PNG', 'ATP', 15, 2, 3),
(9, 'KAR98.PNG', 'KAR98', 15, 2, 3),
(10, 'PUÑO.png', 'PUÑO', 25, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `batalla`
--

CREATE TABLE `batalla` (
  `id_batalla` int NOT NULL,
  `id_sala` int NOT NULL,
  `id_ganador` int DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `puntos_daño` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `puntos_daño`) VALUES
(1, 'puño', 1),
(2, 'pistola', 2),
(3, 'francotirador', 20),
(4, 'ametralladora', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `daño_batalla`
--

CREATE TABLE `daño_batalla` (
  `id_daño_batalla` int NOT NULL,
  `id_batalla` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_arma` int DEFAULT NULL,
  `daño_causado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo'),
(3, 'disponible'),
(4, 'llena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_armas`
--

CREATE TABLE `inventario_armas` (
  `id_inventario` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_arma` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

CREATE TABLE `mapas` (
  `id_mapa` int NOT NULL,
  `foto_mapa` varchar(255) DEFAULT NULL,
  `mapa` varchar(100) NOT NULL,
  `nivel_requerido` int NOT NULL,
  `id_estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id_mapa`, `foto_mapa`, `mapa`, `nivel_requerido`, `id_estado`) VALUES
(1, 'Bermuda.png', 'Bermuda', 1, 1),
(2, 'Purgatorio.jpg\n', 'Purgatorio', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personajes`
--

CREATE TABLE `personajes` (
  `id_personaje` int NOT NULL,
  `foto_personaje` varchar(255) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `personajes`
--

INSERT INTO `personajes` (`id_personaje`, `foto_personaje`, `nombre`) VALUES
(1, 'orion.png', 'Orion'),
(2, 'sonia.png', 'Sonia'),
(3, 'hayato.png', 'Hayato'),
(4, 'moco.png', 'Moco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_ingreso`
--

CREATE TABLE `registro_ingreso` (
  `id_registro` int NOT NULL,
  `fecha_entrada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `registro_ingreso`
--

INSERT INTO `registro_ingreso` (`id_registro`, `fecha_entrada`, `id_usuario`) VALUES
(1, '2025-02-15 18:33:29', 1),
(2, '2025-02-15 18:34:03', 1),
(3, '2025-02-15 18:48:51', 2),
(4, '2025-02-15 18:49:47', 1),
(5, '2025-02-15 20:04:07', 1),
(6, '2025-02-15 20:08:03', 1),
(7, '2025-02-15 20:12:01', 1),
(8, '2025-02-15 20:12:37', 1),
(9, '2025-02-16 10:37:39', 1),
(10, '2025-02-16 10:38:37', 1),
(11, '2025-02-16 11:27:41', 1),
(12, '2025-02-16 11:29:07', 1),
(13, '2025-02-16 12:06:52', 1),
(14, '2025-02-16 12:33:29', 1),
(15, '2025-02-16 12:52:55', 2),
(16, '2025-02-16 14:34:31', 1),
(17, '2025-02-16 15:49:24', 1),
(18, '2025-02-16 16:14:03', 1),
(19, '2025-02-16 16:16:48', 1),
(20, '2025-02-17 12:25:18', 1),
(21, '2025-02-17 12:26:49', 1),
(22, '2025-02-17 12:52:39', 1),
(23, '2025-02-17 13:00:28', 1),
(24, '2025-02-17 13:22:09', 1),
(25, '2025-02-17 13:25:23', 1),
(26, '2025-02-17 22:01:09', 1),
(27, '2025-02-18 15:09:51', 1),
(28, '2025-02-18 15:51:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_usuario`
--

CREATE TABLE `reporte_usuario` (
  `id_reporte_usuario` int NOT NULL,
  `partidas_jugadas` int NOT NULL,
  `partidas_ganadas` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int NOT NULL,
  `rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Jugador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salas`
--

CREATE TABLE `salas` (
  `id_sala` int NOT NULL,
  `id_mapa` int NOT NULL,
  `cantidad_jugadores` int NOT NULL,
  `id_estado` int NOT NULL
) ;

--
-- Volcado de datos para la tabla `salas`
--

INSERT INTO `salas` (`id_sala`, `id_mapa`, `cantidad_jugadores`, `id_estado`) VALUES
(1, 1, 1, 3),
(2, 1, 0, 3),
(3, 1, 1, 3),
(4, 1, 2, 3),
(5, 2, 0, 3),
(6, 2, 0, 3),
(7, 2, 0, 3),
(8, 2, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_ingreso`
--

CREATE TABLE `solicitud_ingreso` (
  `id_solicitud` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `solicitud_ingreso`
--

INSERT INTO `solicitud_ingreso` (`id_solicitud`, `id_usuario`, `fecha_solicitud`) VALUES
(1, 2, '2025-02-15 23:47:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `vida` int DEFAULT NULL,
  `nivel` int DEFAULT NULL,
  `puntos` int DEFAULT NULL,
  `id_rol` int NOT NULL,
  `id_personaje` int DEFAULT NULL,
  `id_estado` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `username`, `password`, `correo`, `vida`, `nivel`, `puntos`, `id_rol`, `id_personaje`, `id_estado`) VALUES
(1, 'Alejopro90', '$2y$12$2SEeLb1/XUM6lWEVPGLj0.UMTPZOnSvdgAVfyMMWH8fmD0IveJg0S', 'alejoreyvm@hotmail.com', 100, 1, 0, 2, 3, 1),
(2, 'BrandonPro', '$2y$12$oGSS9YfPUzO/kh1r1aM33u.YtjZ/nvZCqAN5OQk.85hh8WM0UVFfG', 'brandon@villanueva.com', 100, 1, 0, 2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_sala`
--

CREATE TABLE `usuario_sala` (
  `id_registro_sala` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_sala` int NOT NULL,
  `fecha_ingreso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario_sala`
--

INSERT INTO `usuario_sala` (`id_registro_sala`, `id_usuario`, `id_sala`, `fecha_ingreso`) VALUES
(1, 1, 1, '2025-02-18 22:49:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `armas`
--
ALTER TABLE `armas`
  ADD PRIMARY KEY (`id_arma`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_estado` (`nivel_requerido`);

--
-- Indices de la tabla `batalla`
--
ALTER TABLE `batalla`
  ADD PRIMARY KEY (`id_batalla`),
  ADD KEY `id_sala` (`id_sala`),
  ADD KEY `id_ganador` (`id_ganador`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `daño_batalla`
--
ALTER TABLE `daño_batalla`
  ADD PRIMARY KEY (`id_daño_batalla`),
  ADD KEY `id_batalla` (`id_batalla`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_arma` (`id_arma`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `inventario_armas`
--
ALTER TABLE `inventario_armas`
  ADD PRIMARY KEY (`id_inventario`),
  ADD KEY `id_arma` (`id_arma`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`id_mapa`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `personajes`
--
ALTER TABLE `personajes`
  ADD PRIMARY KEY (`id_personaje`);

--
-- Indices de la tabla `registro_ingreso`
--
ALTER TABLE `registro_ingreso`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `reporte_usuario`
--
ALTER TABLE `reporte_usuario`
  ADD PRIMARY KEY (`id_reporte_usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `salas`
--
ALTER TABLE `salas`
  ADD PRIMARY KEY (`id_sala`),
  ADD KEY `id_mapa` (`id_mapa`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `solicitud_ingreso`
--
ALTER TABLE `solicitud_ingreso`
  ADD PRIMARY KEY (`id_solicitud`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_personaje` (`id_personaje`);

--
-- Indices de la tabla `usuario_sala`
--
ALTER TABLE `usuario_sala`
  ADD PRIMARY KEY (`id_registro_sala`),
  ADD UNIQUE KEY `unique_usuario_sala` (`id_usuario`),
  ADD KEY `id_sala` (`id_sala`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `armas`
--
ALTER TABLE `armas`
  MODIFY `id_arma` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `batalla`
--
ALTER TABLE `batalla`
  MODIFY `id_batalla` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `daño_batalla`
--
ALTER TABLE `daño_batalla`
  MODIFY `id_daño_batalla` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inventario_armas`
--
ALTER TABLE `inventario_armas`
  MODIFY `id_inventario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mapas`
--
ALTER TABLE `mapas`
  MODIFY `id_mapa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personajes`
--
ALTER TABLE `personajes`
  MODIFY `id_personaje` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro_ingreso`
--
ALTER TABLE `registro_ingreso`
  MODIFY `id_registro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `reporte_usuario`
--
ALTER TABLE `reporte_usuario`
  MODIFY `id_reporte_usuario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `salas`
--
ALTER TABLE `salas`
  MODIFY `id_sala` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_ingreso`
--
ALTER TABLE `solicitud_ingreso`
  MODIFY `id_solicitud` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario_sala`
--
ALTER TABLE `usuario_sala`
  MODIFY `id_registro_sala` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `armas`
--
ALTER TABLE `armas`
  ADD CONSTRAINT `armas_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

--
-- Filtros para la tabla `batalla`
--
ALTER TABLE `batalla`
  ADD CONSTRAINT `batalla_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id_sala`),
  ADD CONSTRAINT `batalla_ibfk_2` FOREIGN KEY (`id_ganador`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `daño_batalla`
--
ALTER TABLE `daño_batalla`
  ADD CONSTRAINT `daño_batalla_ibfk_1` FOREIGN KEY (`id_batalla`) REFERENCES `batalla` (`id_batalla`),
  ADD CONSTRAINT `daño_batalla_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `daño_batalla_ibfk_3` FOREIGN KEY (`id_arma`) REFERENCES `armas` (`id_arma`);

--
-- Filtros para la tabla `inventario_armas`
--
ALTER TABLE `inventario_armas`
  ADD CONSTRAINT `inventario_armas_ibfk_1` FOREIGN KEY (`id_arma`) REFERENCES `armas` (`id_arma`),
  ADD CONSTRAINT `inventario_armas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD CONSTRAINT `mapas_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `registro_ingreso`
--
ALTER TABLE `registro_ingreso`
  ADD CONSTRAINT `registro_ingreso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `salas_ibfk_1` FOREIGN KEY (`id_mapa`) REFERENCES `mapas` (`id_mapa`),
  ADD CONSTRAINT `salas_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `solicitud_ingreso`
--
ALTER TABLE `solicitud_ingreso`
  ADD CONSTRAINT `solicitud_ingreso_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_personaje`) REFERENCES `personajes` (`id_personaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_sala`
--
ALTER TABLE `usuario_sala`
  ADD CONSTRAINT `usuario_sala_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_sala_ibfk_3` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id_sala`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
