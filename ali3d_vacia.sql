-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2024 a las 06:03:11
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ali3d`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id_caracteristica` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `valor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_papel`
--

CREATE TABLE `categorias_papel` (
  `id_cat_papel` int(11) NOT NULL,
  `nombre_cat_papel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_sticker`
--

CREATE TABLE `categorias_sticker` (
  `id_cat_sticker` int(11) NOT NULL,
  `nombre_cat_sticker` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combinaciones_producto`
--

CREATE TABLE `combinaciones_producto` (
  `id_combinacion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `combinacion_unica` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(30) DEFAULT NULL,
  `correo_usuario` varchar(30) DEFAULT NULL,
  `celular` varchar(30) NOT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `entrega` text DEFAULT NULL,
  `metodo_pago` varchar(30) NOT NULL,
  `productos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(4) DEFAULT NULL,
  `id_subcategoria` int(4) NOT NULL,
  `popular` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen2` text NOT NULL,
  `imagen3` text NOT NULL,
  `imagen4` text NOT NULL,
  `is_3d` int(1) NOT NULL,
  `precio_ant` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_stock`
--

CREATE TABLE `reservas_stock` (
  `id_reserva` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `combinacion_unica` varchar(255) DEFAULT NULL,
  `cantidad_reservada` int(11) NOT NULL,
  `hora_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre_subcategoria` varchar(50) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias_papel`
--

CREATE TABLE `subcategorias_papel` (
  `id_subcat_papel` int(11) NOT NULL,
  `nombre_subcat_papel` varchar(50) NOT NULL,
  `id_cat_papel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias_sticker`
--

CREATE TABLE `subcategorias_sticker` (
  `id_subcat_sticker` int(11) NOT NULL,
  `nombre_subcat_sticker` varchar(50) NOT NULL,
  `id_cat_sticker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(255) DEFAULT NULL,
  `correo_usuario` varchar(255) DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `total` decimal(8,2) DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `entrega` text NOT NULL,
  `productos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id_caracteristica`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categorias_papel`
--
ALTER TABLE `categorias_papel`
  ADD PRIMARY KEY (`id_cat_papel`);

--
-- Indices de la tabla `categorias_sticker`
--
ALTER TABLE `categorias_sticker`
  ADD PRIMARY KEY (`id_cat_sticker`);

--
-- Indices de la tabla `combinaciones_producto`
--
ALTER TABLE `combinaciones_producto`
  ADD PRIMARY KEY (`id_combinacion`),
  ADD KEY `producto_id` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas_stock`
--
ALTER TABLE `reservas_stock`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id_subcategoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `subcategorias_papel`
--
ALTER TABLE `subcategorias_papel`
  ADD PRIMARY KEY (`id_subcat_papel`);

--
-- Indices de la tabla `subcategorias_sticker`
--
ALTER TABLE `subcategorias_sticker`
  ADD PRIMARY KEY (`id_subcat_sticker`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id_caracteristica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `categorias_papel`
--
ALTER TABLE `categorias_papel`
  MODIFY `id_cat_papel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias_sticker`
--
ALTER TABLE `categorias_sticker`
  MODIFY `id_cat_sticker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `combinaciones_producto`
--
ALTER TABLE `combinaciones_producto`
  MODIFY `id_combinacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `reservas_stock`
--
ALTER TABLE `reservas_stock`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias_papel`
--
ALTER TABLE `subcategorias_papel`
  MODIFY `id_subcat_papel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subcategorias_sticker`
--
ALTER TABLE `subcategorias_sticker`
  MODIFY `id_subcat_sticker` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `combinaciones_producto`
--
ALTER TABLE `combinaciones_producto`
  ADD CONSTRAINT `combinaciones_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `reservas_stock`
--
ALTER TABLE `reservas_stock`
  ADD CONSTRAINT `reservas_stock_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD CONSTRAINT `subcategorias_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
