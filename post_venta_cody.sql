-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 11-10-2021 a las 20:36:49
-- Versión del servidor: 5.7.34-log
-- Versión de PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `post_venta_cody`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` int(11) NOT NULL,
  `numero_caja` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `folio` int(4) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cajas`
--

INSERT INTO `cajas` (`id`, `numero_caja`, `name`, `folio`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1', 'Caja general', 1, 1, '2021-09-23 21:46:48', NULL),
(2, '2', 'Caja secundaria', 1, 1, '2021-09-23 21:47:43', NULL),
(3, '3', 'Caja chica', 1, 1, '2021-09-24 14:00:26', '2021-09-24 14:00:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'bebidas', 1, '2021-10-06 22:22:32', '2021-10-06 22:22:32'),
(2, 'medicina', 1, '2021-10-06 22:22:42', '2021-10-06 22:22:42'),
(3, 'frutas', 1, '2021-10-06 22:22:50', '2021-10-06 22:22:50'),
(4, 'concervas', 1, '2021-10-06 22:22:58', '2021-10-06 22:22:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `name`, `direccion`, `telefono`, `email`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Publico General', 'Huanta', '-----', 'tienda@tienda.com', 1, '2021-10-01 21:34:59', '2021-09-23 19:43:58'),
(2, 'maria', 'huanta', '777888444', 'maria@maria.com', 1, '2021-09-23 19:45:05', '2021-09-23 19:45:05'),
(3, 'carlos tucno', 'huanta-lury', '555666444', 'c@c.coom', 1, '2021-10-01 22:40:29', '2021-10-01 22:40:29'),
(4, 'Juana rosario quispe', 'peru jr sucre', '777888999', 'b@b.com', 1, '2021-10-01 22:41:00', '2021-10-01 22:41:00'),
(5, 'Esmeralda tinoco suarez', 'calle n123', '111555444', 'z@z.com', 1, '2021-10-01 22:42:06', '2021-10-01 22:42:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `folio` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `folio`, `total`, `id_usuario`, `estado`, `created_at`) VALUES
(1, '615e2387816ab', '169.00', 1, 1, '2021-10-06 22:32:17'),
(2, '615e2567dd536', '35.00', 1, 1, '2021-10-06 22:39:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rfc` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `leyenda` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `name`, `rfc`, `telefono`, `email`, `direccion`, `leyenda`, `logo`) VALUES
(7, 'Multiventas Jesus', 'xxxxxassdasda', '9995555666', 'carlitostucno@gmail.com', 'Asoc Wari Accopampa Mz G Lt', 'gracias por su compra', '1633566062_776e3f860eba9816bd45.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id`, `id_compra`, `id_producto`, `nombre`, `cantidad`, `precio`, `created_at`) VALUES
(1, 1, 1, 'coca cola litro', 10, '3.50', '2021-10-06 22:32:17'),
(2, 1, 2, 'fanta litro', 10, '3.60', '2021-10-06 22:32:17'),
(3, 1, 3, 'paracetamol', 10, '1.80', '2021-10-06 22:32:17'),
(4, 1, 4, 'piña', 10, '5.00', '2021-10-06 22:32:17'),
(5, 1, 5, 'Papaya', 10, '3.00', '2021-10-06 22:32:17'),
(6, 2, 1, 'coca cola litro', 10, '3.50', '2021-10-06 22:39:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta`
--

INSERT INTO `detalle_venta` (`id`, `id_venta`, `id_producto`, `name`, `cantidad`, `precio`, `created_at`) VALUES
(1, 1, 2, 'fanta litro', 4, '4.00', '2021-10-06 23:33:58'),
(2, 2, 1, 'coca cola litro', 2, '5.00', '2021-10-06 23:45:09'),
(3, 2, 5, 'Papaya', 3, '5.00', '2021-10-06 23:45:09'),
(4, 3, 1, 'coca cola litro', 1, '5.00', '2021-10-06 23:50:54'),
(5, 3, 4, 'piña', 1, '6.00', '2021-10-06 23:50:54'),
(6, 3, 5, 'Papaya', 1, '5.00', '2021-10-06 23:50:54'),
(7, 3, 3, 'paracetamol', 1, '2.00', '2021-10-06 23:50:54'),
(8, 4, 1, 'coca cola litro', 1, '5.00', '2021-10-07 00:09:51'),
(9, 4, 4, 'piña', 1, '6.00', '2021-10-07 00:09:51'),
(10, 4, 3, 'paracetamol', 1, '2.00', '2021-10-07 00:09:51'),
(11, 4, 5, 'Papaya', 1, '5.00', '2021-10-07 00:09:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `evento` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `detalles` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `id_usuario`, `evento`, `created_at`, `ip`, `detalles`) VALUES
(1, 1, 'inicio de session', '2021-10-06 13:54:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71'),
(2, 1, 'inicio de session', '2021-10-06 13:56:44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71'),
(3, 1, 'Cerrar de session', '2021-10-06 13:59:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71'),
(4, 1, 'inicio de session', '2021-10-06 14:00:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71'),
(5, 1, 'inicio de session', '2021-10-06 16:57:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71'),
(6, 1, 'inicio de session', '2021-10-06 18:08:56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:92.0) Gecko/20100101 Firefox/92.0'),
(7, 1, 'inicio de session', '2021-10-11 15:29:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.71');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_venta` decimal(10,2) NOT NULL,
  `existencias` int(11) NOT NULL DEFAULT '0',
  `stock_minimo` int(11) NOT NULL DEFAULT '0',
  `inventariable` tinyint(4) NOT NULL,
  `unidadId` smallint(6) NOT NULL,
  `categoriaId` smallint(6) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `name`, `precio_compra`, `precio_venta`, `existencias`, `stock_minimo`, `inventariable`, `unidadId`, `categoriaId`, `estado`, `created_at`, `updated_at`) VALUES
(1, '123465789', 'coca cola litro', '3.50', '5.00', 20, 4, 1, 2, 1, 1, '2021-10-07 00:19:23', '2021-10-07 00:19:23'),
(2, '465123798', 'fanta litro', '3.60', '4.00', 4, 4, 1, 2, 1, 1, '2021-10-07 00:19:26', '2021-10-07 00:19:26'),
(3, '79845613', 'paracetamol', '1.80', '2.00', 10, 10, 1, 4, 2, 1, '2021-10-07 00:18:31', '2021-10-07 00:18:31'),
(4, '147852369', 'piña', '5.00', '6.00', 10, 3, 1, 4, 3, 1, '2021-10-07 00:18:31', '2021-10-07 00:18:31'),
(5, '465132789', 'Papaya', '3.00', '5.00', 10, 5, 1, 4, 3, 1, '2021-10-07 00:19:23', '2021-10-07 00:19:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2021-09-24 13:44:29', '2021-09-24 13:44:29'),
(2, 'Cajero', 1, '2021-09-24 13:43:20', '2021-09-24 13:43:20'),
(3, 'Vendedor', 1, '2021-09-24 13:43:07', '2021-09-24 13:43:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporal_compras`
--

CREATE TABLE `temporal_compras` (
  `id` int(11) NOT NULL,
  `folio` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id` smallint(6) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `short_name` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(3) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id`, `name`, `short_name`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Metros', 'm', 1, '2021-10-06 22:21:41', '2021-10-06 22:21:41'),
(2, 'litros', 'l', 1, '2021-10-06 22:21:48', '2021-10-06 22:21:48'),
(3, 'cajas', 'cj', 1, '2021-10-06 22:21:55', '2021-10-06 22:21:55'),
(4, 'Unidades', 'u', 1, '2021-10-06 22:22:04', '2021-10-06 22:22:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `name`, `id_caja`, `id_rol`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$h.//YvDEKEO9PG/s/eswVeln/tLO/rNl0y90szoDKfSrn4.yYqd0m', 'carlos tucno', 2, 1, 1, '2021-09-24 11:58:16', '2021-09-24 11:58:16'),
(2, 'caja', '$2y$10$luyfDfbcErxLfs3A/wy7jODbSvtSxhnejoGGaYmHxsEIr1NJLXgUG', 'cajero', 2, 1, 1, '2021-09-24 01:52:27', '2021-09-24 01:52:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `folio` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_usuario` int(11) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `forma_pago` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `folio`, `total`, `created_at`, `id_usuario`, `id_caja`, `id_cliente`, `forma_pago`, `estado`) VALUES
(1, '615e3229ed4ea', '16.00', '2021-10-07 00:19:26', 1, 2, 1, '001', 0),
(2, '615e34bb98c45', '25.00', '2021-10-07 00:19:23', 1, 2, 1, '001', 0),
(3, '615e35f10407d', '13.30', '2021-10-07 00:18:31', 1, 2, 1, '001', 0),
(4, '615e3a7d908cf', '18.00', '2021-10-07 00:11:39', 1, 2, 1, '001', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compras_usuario` (`id_usuario`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_compra` (`id_compra`),
  ADD KEY `fk_detalle_producto` (`id_producto`);

--
-- Indices de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prod_uni` (`unidadId`),
  ADD KEY `fk_prod_cat` (`categoriaId`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temporal_compras`
--
ALTER TABLE `temporal_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_caja` (`id_caja`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `temporal_compras`
--
ALTER TABLE `temporal_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_compras_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `fk_detalle_compra` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id`),
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_prod_cat` FOREIGN KEY (`categoriaId`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_prod_uni` FOREIGN KEY (`unidadId`) REFERENCES `unidades` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_caja` FOREIGN KEY (`id_caja`) REFERENCES `cajas` (`id`),
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
