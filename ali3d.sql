-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2024 a las 06:30:21
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`id_caracteristica`, `id_producto`, `nombre`, `valor`) VALUES
(48, 34, 'Talla', 'Grande (50x50)'),
(49, 34, 'Talla', 'Mediano (30x30)'),
(50, 34, 'Talla', 'Chico (20x20)'),
(51, 48, 'Talla', 'Grande (50x50)'),
(52, 48, 'Talla', 'Mediano (30x30)'),
(53, 48, 'Talla', 'Chico (20x20)'),
(54, 48, 'Color', 'Pintado'),
(55, 48, 'Color', 'Sin pintar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`) VALUES
(14, 'Futbol'),
(15, 'Infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_papel`
--

CREATE TABLE `categorias_papel` (
  `id_cat_papel` int(11) NOT NULL,
  `nombre_cat_papel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_papel`
--

INSERT INTO `categorias_papel` (`id_cat_papel`, `nombre_cat_papel`) VALUES
(10001, 'prueba id cat papel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combinaciones_producto`
--

CREATE TABLE `combinaciones_producto` (
  `id_combinacion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `combinacion_unica` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `combinaciones_producto`
--

INSERT INTO `combinaciones_producto` (`id_combinacion`, `id_producto`, `combinacion_unica`, `stock`) VALUES
(12, 48, 'Grande (50x50) - Pintado', 53),
(13, 48, 'Mediano (30x30) - Pintado', 10),
(14, 48, 'Chico (20x20) - Pintado', 50);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `nombre_usuario`, `correo_usuario`, `celular`, `fecha_pedido`, `total`, `entrega`, `metodo_pago`, `productos`) VALUES
(25, 2, 'agustin', 'admin@admin.com', '2964405759', '2024-01-01 18:07:54', 10000.00, '{\"Entrega\":\"Retiro por el local\",\"Nombre\":\"Agustin Ackerman\",\"DNI\":\"41402558\"}', 'efectivo', '[{\"producto\":\"Figura de Hulk\",\"caracteristicas\":{\"Talla\":\"Grande (50x50)\",\"Color\":\"Pintado\"},\"cantidad\":\"2\",\"id_producto\":\"48_Grande (50x50)_Pintado\"}]');

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
  `stock` int(4) NOT NULL,
  `popular` int(11) NOT NULL DEFAULT 0,
  `imagen` varchar(255) DEFAULT NULL,
  `imagen2` text NOT NULL,
  `imagen3` text NOT NULL,
  `imagen4` text NOT NULL,
  `is_3d` int(1) NOT NULL,
  `precio_ant` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `id_categoria`, `id_subcategoria`, `stock`, `popular`, `imagen`, `imagen2`, `imagen3`, `imagen4`, `is_3d`, `precio_ant`) VALUES
(33, 'Boca Juniors', 'Escudo Boca Juniors', 600.00, 14, 21, 0, 0, '/Viroco/img/productos/Boca.jpg', '', '', '', 2, 550.00),
(34, 'Mate de Boca', 'Mate de Boca en 3D', 1500.99, 14, 21, 50, 0, '/Viroco/img/productos/mate boca.jpg', '', '', '', 1, 2000.50),
(35, 'River Plate', 'Escudo de River Plate', 598.95, 14, 22, 100, 0, '/Viroco/img/productos/riber escudo.jpg', '', '', '', 2, 0.00),
(36, 'Escudo de River', 'Escudo de River en 3D', 600.00, 14, 22, 50, 0, '/Viroco/img/productos/riber.png', '', '', '', 1, 650.00),
(37, 'Hulk', 'Sticker de Hulk', 299.48, 15, 24, 100, 0, '/Viroco/img/productos/hulk2.jpg', '', '', '', 2, 0.00),
(38, 'Hello Kitty', 'Sticker de Hello Kitty', 359.37, 15, 26, 50, 0, '/Viroco/img/productos/kitty.jpg', '', '', '', 2, 0.00),
(39, 'Peppa Pig', 'Sticker de Peppa Pig', 179.69, 15, 26, 50, 0, '/Viroco/img/productos/pepa.jpg', '', '', '', 2, 0.00),
(40, 'Messi', 'Sticker de Messi ', 598.95, 14, 23, 500, 0, '/Viroco/img/productos/messi 2.jpg', '/Viroco/img/productos/messi.jpg', '', '', 2, 0.00),
(41, 'Homero Simpson', 'Sticker de Homer Simpson', 598.95, 15, 26, 20, 0, '/Viroco/img/productos/homero.jpg', '', '', '', 2, 0.00),
(42, 'Marvel', 'Sticker de Marvel', 119.79, 15, 24, 20, 0, '/Viroco/img/productos/marvel.jpg', '', '', '', 2, 0.00),
(43, 'Capitan America ', 'Stiker de Capitan America', 179.69, 15, 24, 50, 0, '/Viroco/img/productos/capitan america.jpg', '', '', '', 2, 0.00),
(44, 'Copa del mundo', 'Copa del mundo Argentina', 4791.60, 14, 23, 100, 0, '/Viroco/img/productos/copa del mundo.jpg', '', '', '', 3, 0.00),
(45, 'Hello kitty ', 'Hello Kitty ', 3593.70, 15, 26, 10, 0, '/Viroco/img/productos/kitty.jpg', '', '', '', 1, 0.00),
(46, 'Llavero Hello Kitty', 'Llavero de Hello Kitty ', 1197.90, 15, 26, 60, 0, '/Viroco/img/productos/kitty llavero.webp', '', '', '', 1, 0.00),
(47, 'Llavero de Argentina', 'Llavero de Argentina', 1197.90, 14, 23, 50, 0, '/Viroco/img/productos/Argentina.png', '', '', '', 1, 0.00),
(48, 'Figura de Hulk', 'Figura de Hulk en 3D', 5989.50, 15, 24, 113, 3, '/Viroco/img/productos/hulk.jpg', '', '', '', 1, 0.00),
(49, 'prueba papel', 'prueba papel', 147489.05, 10001, 10000, 0, 0, '/ali3d/img/productos/foto_producto.png', '', '', '', 3, 0.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas_stock`
--

INSERT INTO `reservas_stock` (`id_reserva`, `id_producto`, `combinacion_unica`, `cantidad_reservada`, `hora_reserva`) VALUES
(10, 48, 'Grande (50x50) - Pintado', 1, '2024-01-01 21:04:26'),
(11, 48, 'Mediano (30x30) - Pintado', 2, '2024-01-01 21:05:30'),
(12, 48, 'Grande (50x50) - Pintado', 2, '2024-01-01 21:07:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id_subcategoria` int(11) NOT NULL,
  `nombre_subcategoria` varchar(50) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `nombre_subcategoria`, `id_categoria`) VALUES
(21, 'Boca Juniors', 14),
(22, 'River Plate', 14),
(23, 'Argetina', 14),
(24, 'Marvel', 15),
(25, 'Los Simpsons', 15),
(26, 'Niños', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias_papel`
--

CREATE TABLE `subcategorias_papel` (
  `id_subcat_papel` int(11) NOT NULL,
  `nombre_subcat_papel` varchar(50) NOT NULL,
  `id_cat_papel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subcategorias_papel`
--

INSERT INTO `subcategorias_papel` (`id_subcat_papel`, `nombre_subcat_papel`, `id_cat_papel`) VALUES
(10000, 'prueba sid subcat papel', 10001);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `correo`, `password`, `is_admin`) VALUES
(2, 'agustin', 'admin@admin.com', '$2y$10$r6SxrsSmTXQz6XEA70BZfe2zlBg7a16Dvhh3nI7BU1jhqGE1uD/lO', 1),
(3, 'tutuca', 'agus@hotmail.com', '$2y$10$t1FZ9D8iRYThqtaJzhzN8.xM8FSfyLm3KJiX8QZ36n1IXFsr8XZp6', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_usuario`, `nombre_usuario`, `correo_usuario`, `fecha_venta`, `total`, `estado`, `entrega`, `productos`) VALUES
(20, 2, 'agustin', 'admin@admin.com', '2024-01-01 18:06:59', 5000.00, 'Aprobado', '{\"Entrega\":\"Retiro por el local\",\"Nombre\":\"Agustin Ackerman\",\"DNI\":\"41402558\"}', '[{\"producto\":\"Figura de Hulk\",\"caracteristicas\":{\"Talla\":\"Grande (50x50)\",\"Color\":\"Pintado\"},\"cantidad\":\"1\",\"id_producto\":\"48_Grande (50x50)_Pintado\"}]'),
(21, 2, 'agustin', 'admin@admin.com', '2024-01-01 18:07:07', 10000.00, 'Rechazado', '{\"Entrega\":\"Envio a domicilio\",\"Nombre\":\"Agustin Ackerman\",\"Telefono\":\"2964405759\",\"Ciudad\":\"Rio Grande\",\"Calle\":\"Ohiggins\",\"Altura\":\"946\",\"Depto\":\"\",\"Codigo Postal\":\"9420\"}', '[{\"producto\":\"Figura de Hulk\",\"caracteristicas\":{\"Talla\":\"Mediano (30x30)\",\"Color\":\"Pintado\"},\"cantidad\":\"2\",\"id_producto\":\"48_Mediano (30x30)_Pintado\"}]');

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
  MODIFY `id_caracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categorias_papel`
--
ALTER TABLE `categorias_papel`
  MODIFY `id_cat_papel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;

--
-- AUTO_INCREMENT de la tabla `combinaciones_producto`
--
ALTER TABLE `combinaciones_producto`
  MODIFY `id_combinacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `reservas_stock`
--
ALTER TABLE `reservas_stock`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `subcategorias_papel`
--
ALTER TABLE `subcategorias_papel`
  MODIFY `id_subcat_papel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
