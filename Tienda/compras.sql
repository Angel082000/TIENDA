-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2022 a las 17:57:04
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `compras`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (IN `n_cantidad` INT, IN `n_precio` DECIMAL(10,2), IN `codigo` INT)  BEGIN
DECLARE nueva_existencia int;
DECLARE nuevo_total decimal(10,2);
DECLARE nuevo_precio decimal(10,2);

DECLARE cant_actual int;
DECLARE pre_actual decimal(10,2);

DECLARE actual_existencia int;
DECLARE actual_precio decimal(10,2);

SELECT precio, existencia INTO actual_precio, actual_existencia FROM producto WHERE codproducto = codigo;

SET nueva_existencia = actual_existencia + n_cantidad;
SET nuevo_total = n_precio;
SET nuevo_precio = nuevo_total;

UPDATE producto SET existencia = nueva_existencia, precio = nuevo_precio WHERE codproducto = codigo;

SELECT nueva_existencia, nuevo_precio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_temp` (`codigo` INT, `cantidad` INT, `token_user` VARCHAR(50))  BEGIN
DECLARE precio_actual decimal(10,2);
SELECT precio INTO precio_actual FROM producto WHERE codproducto = codigo;
INSERT INTO detalle_temp(token_user, codproducto, cantidad, precio_venta) VALUES (token_user, codigo, cantidad, precio_actual);
SELECT tmp.correlativo, tmp.codproducto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp INNER JOIN producto p ON tmp.codproducto = p.codproducto WHERE tmp.token_user = token_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `data` ()  BEGIN
DECLARE usuarios int;
DECLARE clientes int;
DECLARE proveedores int;
DECLARE productos int;
DECLARE ventas int;
SELECT COUNT(*) INTO usuarios FROM usuario;
SELECT COUNT(*) INTO clientes FROM cliente;
SELECT COUNT(*) INTO proveedores FROM proveedor;
SELECT COUNT(*) INTO productos FROM producto;
SELECT COUNT(*) INTO ventas FROM factura WHERE fecha > CURDATE();

SELECT usuarios, clientes, proveedores, productos, ventas;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` VARCHAR(50))  BEGIN
DELETE FROM detalle_temp WHERE correlativo = id_detalle;
SELECT tmp.correlativo, tmp.codproducto, p.descripcion, tmp.cantidad, tmp.precio_venta FROM detalle_temp tmp INNER JOIN producto p ON tmp.codproducto = p.codproducto WHERE tmp.token_user = token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (IN `cod_usuario` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))  BEGIN
DECLARE factura INT;
DECLARE registros INT;
DECLARE total DECIMAL(10,2);
DECLARE nueva_existencia int;
DECLARE existencia_actual int;

DECLARE tmp_cod_producto int;
DECLARE tmp_cant_producto int;
DECLARE a int;
SET a = 1;

CREATE TEMPORARY TABLE tbl_tmp_tokenuser(
	id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cod_prod BIGINT,
    cant_prod int);
SET registros = (SELECT COUNT(*) FROM detalle_temp WHERE token_user = token);
IF registros > 0 THEN
INSERT INTO tbl_tmp_tokenuser(cod_prod, cant_prod) SELECT codproducto, cantidad FROM detalle_temp WHERE token_user = token;
INSERT INTO factura (usuario,codcliente) VALUES (cod_usuario, cod_cliente);
SET factura = LAST_INSERT_ID();

INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) AS nofactura, codproducto, cantidad,precio_venta FROM detalle_temp WHERE token_user = token;
WHILE a <= registros DO
	SELECT cod_prod, cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
    SELECT existencia INTO existencia_actual FROM producto WHERE codproducto = tmp_cod_producto;
    SET nueva_existencia = existencia_actual - tmp_cant_producto;
    UPDATE producto SET existencia = nueva_existencia WHERE codproducto = tmp_cod_producto;
    SET a=a+1;
END WHILE;
SET total = (SELECT SUM(cantidad * precio_venta) FROM detalle_temp WHERE token_user = token);
UPDATE factura SET totalfactura = total WHERE nofactura = factura;
DELETE FROM detalle_temp WHERE token_user = token;
TRUNCATE TABLE tbl_tmp_tokenuser;
SELECT * FROM factura WHERE nofactura = factura;
ELSE
SELECT 0;
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(15) NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `nombre`, `telefono`, `direccion`) VALUES
(2, 'Maria', 98147582, 'lerma'),
(3, 'Luis', 2147483647, 'Colosio'),
(4, 'Gerardo', 981120085, 'Ermita'),
(5, 'Dani', 981181818, 'San Francisco'),
(6, 'Lidia Can', 98180003, 'Centro'),
(7, 'Marta Torres', 2147483647, 'Mirardor'),
(8, 'Berta', 981000002, 'Minas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `igv` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `dni`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`, `igv`) VALUES
(1, 2580, 'VENTAS CAMPECHE', 'Vender productos campechanos', 925491523, 'venatasCamp@gmail.com', 'Mexico - Campeche', '1.18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` bigint(20) NOT NULL,
  `nofactura` bigint(20) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`correlativo`, `nofactura`, `codproducto`, `cantidad`, `precio_venta`) VALUES
(22, 10, 1, 1, '1560.00'),
(23, 11, 2, 1, '2500.00'),
(24, 11, 1, 1, '1560.00'),
(25, 11, 1, 1, '1560.00'),
(26, 12, 10, 5, '50.00'),
(27, 13, 10, 2, '50.00'),
(28, 13, 8, 1, '85.00'),
(30, 14, 2, 1, '2500.00'),
(31, 15, 10, 2, '50.00'),
(32, 15, 6, 1, '800.00'),
(33, 15, 7, 1, '1500.00'),
(34, 15, 1, 1, '1560.00'),
(38, 16, 2, 2, '2500.00'),
(39, 16, 9, 1, '85.00'),
(41, 17, 8, 1, '85.00'),
(42, 17, 1, 2, '1560.00'),
(44, 18, 2, 1, '2500.00'),
(45, 18, 6, 3, '800.00'),
(46, 18, 11, 2, '80.00'),
(47, 19, 7, 8, '1500.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `correlativo` int(11) NOT NULL,
  `token_user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_temp`
--

INSERT INTO `detalle_temp` (`correlativo`, `token_user`, `codproducto`, `cantidad`, `precio_venta`) VALUES
(38, '1679091c5a880faf6fb5e6087eb1b2dc', 2, 1, '2500.00'),
(39, '1679091c5a880faf6fb5e6087eb1b2dc', 6, 1, '800.00'),
(40, 'e4da3b7fbbce2345d7772b0674a318d5', 6, 1, '800.00'),
(41, 'e4da3b7fbbce2345d7772b0674a318d5', 9, 2, '85.00'),
(59, 'c81e728d9d4c2f636f067f89cc14862c', 9, 10, '85.00'),
(60, 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 6, 2, '800.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `codproducto`, `fecha`, `cantidad`, `precio`, `usuario_id`) VALUES
(1, 6, '2021-11-09 00:02:44', 50, '800.00', 1),
(2, 8, '2022-05-11 01:46:26', 50, '85.00', 1),
(3, 7, '2022-05-11 01:46:48', 60, '1500.00', 1),
(4, 9, '2022-05-11 01:47:01', 10, '85.00', 1),
(5, 9, '2022-05-12 23:52:31', 5, '85.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario` int(11) NOT NULL,
  `codcliente` int(11) NOT NULL,
  `totalfactura` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nofactura`, `fecha`, `usuario`, `codcliente`, `totalfactura`, `estado`) VALUES
(10, '2022-05-11 00:41:36', 3, 3, '1560.00', 1),
(11, '2022-05-11 01:41:49', 6, 6, '5620.00', 1),
(12, '2022-05-11 01:57:35', 2, 2, '250.00', 1),
(13, '2022-05-12 01:59:57', 7, 7, '185.00', 1),
(14, '2022-05-12 02:00:49', 7, 7, '2500.00', 1),
(15, '2022-05-12 22:36:43', 7, 7, '3960.00', 1),
(16, '2022-05-12 23:41:15', 8, 8, '5085.00', 1),
(17, '2022-05-12 23:46:26', 3, 3, '3205.00', 1),
(18, '2022-05-12 23:54:47', 8, 8, '5060.00', 1),
(19, '2022-05-13 01:19:14', 4, 4, '12000.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `proveedor` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `existencia` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `descripcion`, `proveedor`, `precio`, `existencia`, `usuario_id`) VALUES
(1, 'Hamaca king size', 1, '1560.00', 39, 2),
(2, 'Hamaca pequeña', 1, '2500.00', 70, 1),
(6, 'Portaretrato con conchitas', 1, '800.00', 44, 1),
(7, 'Sillas hamaca', 3, '1500.00', 52, 1),
(8, 'Macetas de barro', 3, '85.00', 47, 6),
(9, 'Platos de marmol', 3, '85.00', 17, 1),
(10, 'Huipil rosado', 3, '50.00', 41, 1),
(11, 'Miel de litro', 3, '80.00', 58, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codproveedor` int(11) NOT NULL,
  `proveedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `contacto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codproveedor`, `proveedor`, `contacto`, `telefono`, `direccion`, `usuario_id`) VALUES
(1, 'Artesanías Calkini', '965432143', 9645132, 'Calkiní', 2),
(3, 'Casa Kobén', '25804', 9865412, 'San francisco Kobén', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `telefono`, `direccion`) VALUES
(1, 'Jose Angel Gonzales', 'jose@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '9811515', 'Campeche'),
(2, 'Maria', 'ma@gmai.com', 'maria', '263bce650e68ab4e23f28263760b9fa5', 2, '98147582', 'lerma'),
(3, 'Luis', 'Luis@gmail.com', 'Luis', '502ff82f7f1f8218dd41201fe4353687', 2, '9816666968', 'Colosio'),
(4, 'Gerardo', 'ge@gmail.com', 'gera', '01b3ebf87868b70121dc42784c97038a', 2, '981120085', 'Ermita'),
(5, 'Dani', 'Dani@gmail.com', 'dani', '55b7e8b895d047537e672250dd781555', 2, '981181818', 'San Francisco'),
(6, 'Lidia Can', 'Lidia@gmail.com', 'lidia', 'f1bdab4e69b9c13a4b82c4b8645cc0b1', 2, '98180003', 'Centro'),
(7, 'Marta Torres', 'marta@gmail.com', 'marta', 'a763a66f984948ca463b081bf0f0e6d0', 2, '9811526300', 'Mirardor'),
(8, 'Berta', 'berta@gmail.com', 'berta', '43d75035f949d7bad66383b46374d2e2', 2, '981000002', 'Minas');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`correlativo`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codproveedor`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `codproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
