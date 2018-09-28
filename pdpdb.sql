-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2018 a las 03:07:28
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pdpdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio_portal`
--

CREATE TABLE `anuncio_portal` (
  `idanuncio_portal` int(11) NOT NULL,
  `mensaje` varchar(1000) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_termino` datetime DEFAULT NULL,
  `eliminado` tinyint(4) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `anuncio_portal`
--

INSERT INTO `anuncio_portal` (`idanuncio_portal`, `mensaje`, `fecha_inicio`, `fecha_termino`, `eliminado`, `updated_at`) VALUES
(1, 'Estimados clientes, estamos presentando problemas en nuestra nueva versión. Le pedimos que ocupen su móvil o tablet para realizar sus transacciones a fin de tener mejor visualización.\r\nGracias!', '2018-08-13 00:48:00', '2018-08-18 23:59:00', 0, '2018-08-13 00:44:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `idBancos` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminado` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`idBancos`, `nombre`, `created_at`, `updated_at`, `eliminado`) VALUES
(1, 'BBVA', '2017-03-03 01:04:36', '2017-03-02 22:04:36', 0),
(2, 'BCI', '2017-03-03 01:04:52', '2017-03-02 22:04:52', 0),
(3, 'BICE', '2017-03-03 01:05:05', '2017-03-02 22:05:05', 0),
(4, 'Banco de Chile', '2017-03-03 01:05:50', '2017-03-02 22:05:50', 0),
(5, 'Consorcio', '2017-03-03 01:06:08', '2017-03-02 22:06:08', 0),
(6, 'Corpbanca', '2017-03-03 01:06:31', '2017-03-02 22:06:31', 0),
(7, 'Banco Estado', '2017-03-03 01:07:46', '2017-03-02 22:07:46', 0),
(8, 'Falabella', '2017-03-02 22:08:04', '2017-03-02 22:08:04', 0),
(9, 'Internacional', '2017-03-02 22:08:16', '2017-03-02 22:08:16', 0),
(10, 'Itaú', '2017-03-02 22:08:33', '2017-03-02 22:08:33', 0),
(11, 'Ripley', '2017-03-02 22:09:14', '2017-03-02 22:09:14', 0),
(12, 'Santander', '2017-03-02 22:09:28', '2017-03-02 22:09:28', 0),
(13, 'Scotiabank', '2017-03-02 22:09:38', '2017-03-02 22:09:38', 0),
(14, 'Security', '2017-03-02 22:09:52', '2017-03-02 22:09:52', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `idCobros` int(10) UNSIGNED NOT NULL,
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `rut_empresa` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(3) UNSIGNED DEFAULT '0',
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `monto` int(10) UNSIGNED DEFAULT NULL,
  `pagado` tinyint(4) DEFAULT '0',
  `nro_transaccion` varchar(100) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `idTipoPago` int(11) DEFAULT NULL,
  `idUsuarios_hijo` int(11) DEFAULT NULL,
  `url_adjunto` varchar(100) NOT NULL,
  `rut_traspaso` varchar(20) NOT NULL,
  `email_traspaso` varchar(70) NOT NULL,
  `idunico_pago` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cobros`
--

INSERT INTO `cobros` (`idCobros`, `idUsuarios`, `empresa`, `rut_empresa`, `created_at`, `updated_at`, `eliminado`, `descripcion`, `fecha_vencimiento`, `email`, `monto`, `pagado`, `nro_transaccion`, `fecha_pago`, `idTipoPago`, `idUsuarios_hijo`, `url_adjunto`, `rut_traspaso`, `email_traspaso`, `idunico_pago`) VALUES
(4, 62, 'Bernardita Labatut', '12041180-2', '2016-11-28 23:36:10', '2016-11-28 23:39:07', 1, 'Divida Prueba 28/11/2016 - 23:35h', '2016-11-30', 'pedropfcosta@outlook.com', 5400, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4583ce99ae4c75'),
(5, 62, 'Bernardita Labatut', '12041180-2', '2016-11-28 23:40:04', '2017-02-24 14:21:23', 0, 'Prueba Divida 2 - 28/Nov/2016 23:40h', '2016-11-30', 'pedrofernandescosta@outlook.com', 3000, 1, '', '2017-02-24', 3, NULL, '', '', '', 'coP5583cea842fb75'),
(6, 62, 'Cristian Melo', '7008456-2', '2016-12-01 15:14:15', '2017-04-04 11:39:36', 0, 'Café / Reunión - 1o Dic', '2016-12-02', 'cristian_melo@hotmail.com', 1000, 1, NULL, '2017-04-04', 1, NULL, '', '', '', 'coP658406877d53fa'),
(7, 62, 'Milton Volpato', '23797856-0', '2016-12-03 10:33:05', '2018-08-13 00:13:52', 0, 'Gastos Com/2016', '2016-12-15', 'milton.volpato@gmail.com', 80000, 1, NULL, '2018-08-13', 2, NULL, '', '', '', 'coP75842c991783dd'),
(8, 65, 'Cata', '15734240-1', '2016-12-17 12:22:52', '2017-02-10 12:22:38', 1, 'probando', '2016-12-24', 'szalony.bot@gmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP85855584c09618'),
(9, 69, 'Mediasoft', '76200296-5', '2016-12-20 19:46:16', '2017-01-26 15:17:40', 0, 'Cobro de prueba 1 hacia mediasoft', '2016-12-21', 'proyectos@mediasoft.cl', 2590, 1, NULL, '2017-01-26', NULL, NULL, '69-983030987588a3d44146791.61123310.pdf', '', '', 'coP95859b4b82421a'),
(10, 62, 'Juan Carlos Carbuccia', '14130938-2', '2017-01-17 16:29:26', '2017-01-17 16:29:26', 0, 'Prueba', '2017-01-20', 'sf_us@hotmail.com', 1500, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP10587e70965aca2'),
(11, 70, 'Catalina Jimenez', '16181604-3', '2017-01-19 13:20:17', '2017-01-19 13:20:17', 0, 'Esto es un cobro de prueba a catalina', '2017-01-20', 'kta.jimenez@gmail.com', 1000, 1, NULL, '2017-01-21', NULL, NULL, '', '', '', 'coP115880e741c19cd'),
(12, 69, 'Diego valladares', '17487145-0', '2017-01-23 22:49:12', '2017-01-26 12:37:58', 0, 'Deuda de prueba ', '2017-01-24', 'diego.valladares@outlook.com', 250, 1, '', '2017-01-26', 2, NULL, '', '', '', 'coP125886b2986bc56'),
(13, 69, 'Mediasoft', '76200296-5', '2017-01-26 13:22:31', '2017-01-26 13:22:31', 0, 'Prueba de cobro', '2017-01-27', 'proyectos@mediasoft.cl', 2000, 1, NULL, '2017-02-22', NULL, NULL, '', '', '', 'coP13588a22478c06e'),
(14, 70, 'Catalina Jimenez', '16181604-3', '2017-01-26 15:26:10', '2017-01-26 15:26:10', 0, 'cobro de prueba', '2017-01-27', 'kta.jimenez@gmail.com', 1000, 1, NULL, '2017-02-02', NULL, NULL, '', '', '', 'coP14588a3f42dc4f2'),
(15, 69, 'Pedro Fernandes', '22379633-8', '2017-01-26 17:17:44', '2017-01-26 17:17:44', 0, 'Pago tarjetas de presentación.', '2017-01-30', 'pedropfcosta@hotmail.com', 15000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP15588a5968cb7c9'),
(16, 64, 'DavidCuello', '11111111-1', '2017-01-31 17:14:23', '2017-01-31 17:14:23', 0, 'asdf', '2017-01-31', 'neotecsoft@gmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP165890f01f1af49'),
(17, 65, 'Catalina Jimenez', '16181604-3', '2017-02-01 21:05:40', '2017-02-01 21:05:40', 0, 'pruebas,', '2017-02-03', 'kta.jimenez@gmail.com', 1000, 1, NULL, '2017-02-03', NULL, NULL, '', '', '', 'coP17589277d448a08'),
(18, 69, 'Carlos ms', '15425558-3', '2017-02-03 17:03:47', '2017-02-03 17:03:47', 0, 'Cobro de prueba santander-banco estado', '2017-02-04', 'cmartinez@mediasoft.cl', 2500, 1, NULL, '2017-02-03', NULL, NULL, '', '', '', 'coP185894e223d2f7e'),
(19, 69, 'gonzalo', '18830429-k', '2017-02-03 17:50:30', '2017-02-22 15:34:38', 1, 'probando portal', '2017-02-05', 'gonzalomolina1994@gmail.com', 100, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP195894ed168f3cb'),
(20, 65, 'Catalina', '16181604-3', '2017-02-10 12:25:24', '2017-02-10 12:25:24', 0, 'Modificaciones Portal de Pago', '2017-02-13', 'cjimenez@mediasoft.cl', 35000, 1, NULL, '2017-02-10', NULL, NULL, '', '', '', 'coP20589ddb643f58e'),
(21, 69, 'Mediasoft', '76200296-5', '2017-02-10 12:37:31', '2017-02-10 12:37:31', 0, 'Para pago de prueba diego', '2017-02-11', 'proyectos@mediasoft.cl', 35000, 1, NULL, '2017-02-10', NULL, NULL, '', '', '', 'coP21589dde3b0656f'),
(22, 68, 'Pedro Fernandes', '22379633-8', '2017-02-13 15:32:00', '2017-02-13 15:32:00', 0, 'Pago de prueba 1', '2017-02-14', 'pedropfcosta@hotmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP2258a1fba0835ab'),
(23, 68, 'Pedro Fernandes', '22379633-8', '2017-02-13 15:32:29', '2017-02-13 15:32:29', 0, 'Pago de prueba 2', '2017-02-15', 'pedropfcosta@hotmail.com', 1500, 1, NULL, '2017-02-14', NULL, NULL, '', '', '', 'coP2358a1fbbd34cb0'),
(24, 69, 'Alejandra Salazar', '17271511-7', '2017-02-22 16:28:23', '2017-02-22 16:28:23', 0, 'Arriendo Oficina 1805 Enero', '2017-01-05', 'ma.salazarsanchez@gmail.com', 64000, 1, NULL, '2017-02-22', NULL, NULL, '', '', '', 'coP2458ade6571dcb0'),
(25, 62, 'Prueba Maca', '13234558-9', '2017-03-03 20:55:09', '2017-03-03 20:55:09', 0, 'Prueba Maca - Vencimiento 10/Mar/2017', '2017-03-10', 'pedropfcosta@gmail.com', 1010, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP2558ba025ded784'),
(26, 76, 'Pedro Fernandes', '22379633-8', '2017-03-04 15:36:05', '2017-03-04 15:36:05', 0, 'Almuerzo ICA', '2017-03-04', 'Pedropfcosta@hotmail.com', 11110, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP2658bb09153bf46'),
(27, 77, 'PEDRO PABLO FERNANDES', '22379633-8', '2017-03-07 13:07:43', '2017-03-07 13:07:43', 0, 'PAGO ICA', '2017-03-08', 'pedropfcosta@hotmail.com', 11000, 1, NULL, '2017-03-08', NULL, NULL, '', '', '', 'coP2758bedacfb4eed'),
(28, 78, 'Pedro Fernandes', '22379633-8', '2017-03-10 22:03:21', '2017-03-10 22:03:21', 0, 'Grana Brasil - $300.000', '2017-03-11', 'pedropfcosta@hotmail.com', 300000, 1, NULL, '2017-03-11', NULL, NULL, '', '', '', 'coP2858c34cd9a3896'),
(29, 78, 'Pedro Fernandes', '22379633-8', '2017-03-10 22:04:03', '2017-03-10 22:04:03', 0, 'Grana Casa / $200.000', '2017-03-11', 'pedropfcosta@hotmail.com', 200000, 1, NULL, '2017-03-11', NULL, NULL, '', '', '', 'coP2958c34d038bae2'),
(30, 80, 'Pedro Fernandes', '22379633-8', '2017-03-16 18:26:48', '2017-03-16 18:26:48', 0, 'Aporte Portal de Pagos', '2017-03-17', 'pedropfcosta@hotmail.com', 100000, 1, NULL, '2017-03-16', NULL, NULL, '', '', '', 'coP3058cb03186c63e'),
(31, 79, 'Pedro Fernandes', '22379633-8', '2017-03-16 18:59:14', '2017-03-16 18:59:14', 0, 'Despedida Juliana e Felipe', '2017-03-17', 'pedropfcosta@hotmail.com', 10000, 1, NULL, '2017-03-16', NULL, NULL, '', '', '', 'coP3158cb0ab2725b3'),
(32, 81, 'Pedro Fernandes', '22379633-8', '2017-03-17 16:38:25', '2017-03-17 16:38:25', 0, 'Estacionamiento CCU - Mitad de Marzo/2017', '2017-03-17', 'pfernandes@bbva.com', 42500, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP3258cc3b3143dba'),
(33, 80, 'Pedro Fernandes', '22379633-8', '2017-03-21 13:25:28', '2017-03-21 13:25:28', 0, 'Prueba Website (sin \"Portal de Pagos\") - $2.000', '2017-03-22', 'pedropfcosta@hotmail.com', 2000, 1, NULL, '2017-03-21', NULL, NULL, '', '', '', 'coP3358d153f8e0ca5'),
(34, 80, 'Pedro Fernandes', '22379633-8', '2017-03-21 13:26:08', '2017-03-21 13:26:08', 0, 'Prueba - Santander - Website (con \"Portal de Pagos\")', '2017-03-23', 'pedropfcosta@hotmail.com', 2100, 1, NULL, '2017-03-21', NULL, NULL, '', '', '', 'coP3458d15420b56d6'),
(35, 80, 'Pedro Fernandes', '22379633-8', '2017-03-21 13:26:45', '2017-03-21 13:26:45', 0, 'Prueba Santander - $2.200 - Aplicativo', '2017-03-23', 'pedropfcosta@hotmail.com', 2200, 1, NULL, '2017-03-21', NULL, NULL, '', '', '', 'coP3558d15445c4ee9'),
(36, 80, 'Pedro Fernandes', '22379633-8', '2017-03-21 13:48:01', '2017-03-21 13:48:01', 0, 'Prueba - BCI - Website (sin \"Portal de Pagos\") - Monto $1.002', '2017-03-23', 'pedropfcosta@hotmail.com', 1002, 1, NULL, '2017-03-21', NULL, NULL, '', '', '', 'coP3658d1594165172'),
(37, 80, 'Pedro Fernandes', '22379633-8', '2017-03-21 13:54:51', '2017-03-21 13:54:51', 0, 'Prueba - BCI - Website (con \"Portal de Pagos\") - Monto $1.102', '2017-03-24', 'pedropfcosta@hotmail.com', 1102, 1, NULL, '2017-03-22', NULL, NULL, '', '', '', 'coP3758d15adb3562a'),
(38, 80, 'Pedro Fernandes', '22379633-8', '2017-03-21 13:55:29', '2017-03-21 13:55:29', 0, 'Prueba BCI - APP Preferencial - $1.202', '2017-03-24', 'pedropfcosta@hotmail.com', 1202, 1, NULL, '2017-03-22', NULL, NULL, '', '', '', 'coP3858d15b01a5fdd'),
(39, 69, 'Carlos ms', '15425558-3', '2017-03-21 20:01:15', '2017-03-21 20:03:27', 1, 'Esto es una prueba nueva para ver el banco asociado', '2017-03-22', 'cmartinez@mediasoft.cl', 2300, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP3958d1b0bb52639'),
(40, 80, 'Pedro Fernandes', '22379633-8', '2017-03-22 12:21:07', '2017-03-22 12:21:07', 0, 'Prueba BBVA - Website - sin \"Portal de Pagos\" - $ 1.001', '2017-03-24', 'pedropfcosta@hotmail.com', 1001, 1, NULL, '2017-03-22', NULL, NULL, '', '', '', 'coP4058d29663ca90b'),
(41, 80, 'Pedro Fernandes', '22379633-8', '2017-03-22 12:22:15', '2017-03-22 12:22:15', 0, 'Prueba BBVA - Website (con \"Portal de Pagos\") - $1.101', '2017-03-24', 'pedropfcosta@hotmail.com', 1101, 1, NULL, '2017-04-11', NULL, NULL, '', '', '', 'coP4158d296a71d9fd'),
(42, 80, 'Pedro Fernandes', '22379633-8', '2017-03-22 12:23:47', '2017-03-22 12:23:47', 0, 'Prueba - BBVA - APP - Monto: $1.201', '2017-03-24', 'pedropfcosta@hotmail.com', 1201, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4258d29703d2557'),
(43, 62, 'Juan Carlos Carbuccia', '14130938-2', '2017-03-22 16:24:21', '2017-03-22 16:24:21', 0, 'Prueba Chile - Website (sin \"Portal de Pagos\") - $1.003', '2017-03-24', 'jckarbu@gmail.com', 1003, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4358d2cf6596202'),
(44, 62, 'Juan Carlos Carbuccia', '14130938-2', '2017-03-22 16:25:11', '2017-03-22 16:25:11', 0, 'Prueba Chile - Website (con \"Portal de Pagos\") - $1.103', '2017-03-24', 'jckarbu@gmail.com', 1103, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4458d2cf97bdc08'),
(45, 62, 'Juan Carlos Carbuccia', '14130938-2', '2017-03-22 16:25:45', '2017-03-22 16:25:45', 0, 'Prueba Chile - APP - $1.203', '2017-03-27', 'jckarbu@gmail.com', 1203, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4558d2cfb9c8639'),
(46, 62, 'Javier Rossi', '15095262-k', '2017-03-27 20:40:19', '2017-03-27 20:40:19', 0, 'Pruba Portal de Pagos', '2017-03-30', 'javier.rossi.urquijo@gmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4658d9a2e3f136c'),
(47, 80, 'Juan Carlos Carbuccia', '14130938-2', '2017-03-28 13:35:36', '2017-03-28 13:35:36', 0, 'Pruba - Banco Chile - Website - sin \"Portal de Pagos\" - $1.003', '2017-03-30', 'jckarbu@gmail.com', 1003, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4758da90d8a0abf'),
(48, 80, 'Juan Carlos Carbuccia', '14130938-2', '2017-03-28 13:36:07', '2017-03-28 13:36:07', 0, 'Pruba - Banco Chile - Website - con \"Portal de Pagos\" - $1.103', '2017-03-30', 'jckarbu@gmail.com', 1103, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4858da90f7d4d21'),
(49, 80, 'Juan Carlos Carbuccia', '14130938-2', '2017-03-28 13:36:47', '2017-03-28 13:36:47', 0, 'Pruba - Banco Chile - app - $1.203', '2017-03-31', 'jckarbu@gmail.com', 1203, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP4958da911fa4c54'),
(50, 65, 'Hola', '15734240-1', '2017-03-28 21:43:44', '2017-04-01 13:12:07', 0, 'qwdqwdqwd', '2017-03-31', 'diego.valladares@lipigas.cl', 11111, 1, NULL, '2017-04-01', 2, NULL, '', '', '', 'coP5058db03404c230'),
(51, 85, 'lcdj prueba', '79939910-5', '2017-06-21 19:05:39', '2017-07-03 10:45:14', 1, 'descripcion pago', '2017-06-23', 'joel@lacocinadejavier.cl', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP51594aedb33543f'),
(52, 62, 'Ricardo Iturra', '10199552-6', '2017-06-28 21:10:47', '2017-06-28 21:10:47', 0, 'Café Satarbucks 28/Junio', '2017-06-30', 'ricardoiturral@hotmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP5259544587e4301'),
(53, 75, 'Pedro Fernandes', '22379633-8', '2017-06-28 21:33:22', '2017-06-28 21:33:22', 0, 'Pago Starbucks 28/Junio/2017', '2017-06-30', 'pedropfcosta@hotmail.com', 2000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP5359544ad267730'),
(54, 88, 'Elena Prado', '7542847-2', '2017-07-06 18:39:35', '2017-07-06 18:39:35', 0, 'Mama', '2017-07-15', 'elenapradosalinas@gmail.com', 100, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP54595eae1773cd9'),
(55, 89, 'Prueba', '11111111-1', '2017-07-22 04:27:21', '2017-07-22 04:27:21', 0, '', '2018-07-13', 'Prueba@hotmail.com', 399, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP555972fe591539b'),
(56, 89, 'Prueba 2', '22222222-2', '2017-07-22 04:28:15', '2017-07-22 04:28:15', 0, '', '2018-07-15', 'victor.bogado.l@gmail.com', 399, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP565972fe8fe0ef8'),
(57, 62, 'Rafael Fuentes', '16024794-0', '2017-07-31 20:41:03', '2017-07-31 20:41:03', 0, 'Prueba Cobro', '2017-07-07', 'rfuentesc@r2da.com', 2000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP57597fc00f74690'),
(58, 62, 'Ricardo Iturra', '10199552-6', '2017-11-07 19:16:56', '2017-11-09 13:45:11', 1, 'Teste mensaje', '2017-11-11', 'ricardoiturrar@hotmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP585a0230d8b4cd8'),
(59, 62, 'Ricardo Iturra', '10199552-6', '2017-11-09 13:46:03', '2017-11-09 13:46:03', 0, 'Prueba Mensajes', '2017-11-13', 'ricardoiturral@hotmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP595a04864bb5ee9'),
(60, 95, 'aaa', '16871842-k', '2017-11-23 11:59:02', '2017-11-23 11:59:02', 0, 'pago agrilaser', '2017-11-23', 'chaverbeck@gmail.com', 500, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP605a16e236633ec'),
(61, 104, 'Paula Salgado', '11675426-6', '2018-05-28 22:31:45', '2018-06-05 14:52:05', 1, 'Pago segunda cuota por representación en causa de aumento de alimentos.', '2018-06-05', 'paula2010_2010@live.cl', 70000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP615b0cad8188437'),
(62, 104, 'Juan García', '8895702-4', '2018-05-28 22:36:20', '2018-06-21 15:18:33', 1, 'cuota 1/03 por representación de Juicio Laboral', '2018-06-11', 'garcia.alveal@gmail.com', 100000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP625b0cae94674a3'),
(63, 104, 'Ricardo Arellano', '16473191-k', '2018-05-28 22:38:46', '2018-06-04 01:05:12', 1, 'pago por sus servicios', '2018-05-29', 'RICARDO.ARELLANO.ARRIOLA@GMAIL.COM', 100, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP635b0caf2693420'),
(64, 108, 'camila', '17482566-1', '2018-06-25 17:59:33', '2018-06-25 17:59:33', 0, 'cobros', '2018-06-30', 'andres.vega.aalarcon@gmail.com', 20000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP645b3157b52678e'),
(65, 106, 'GERMAN TORRES', '14144822-6', '2018-07-03 18:25:52', '2018-07-03 18:25:52', 0, 'prueba', '2018-07-04', 'german@igedrecords.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP655b3be9e0a9882'),
(66, 62, 'Portal de Pagos', '76446707-8', '2018-08-13 00:18:57', '2018-08-13 00:18:57', 0, 'Prueba Pedro Cobrando Portal de Pagos el 13 Ago 2018 / 1.000.000 / Venc: 20/08/2018 / email: pfernandes@portaldepagos.cl', '2018-08-20', 'pfernandes@portaldepagos.cl', 1000000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP665b70f8a1e496b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `idConfiguracion` int(10) UNSIGNED NOT NULL,
  `nombre_configuracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_configuracion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`idConfiguracion`, `nombre_configuracion`, `valor_configuracion`, `created_at`, `updated_at`) VALUES
(1, 'comision', '0.0147', '2017-11-13 19:23:41', '2018-07-16 22:53:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_email_mensaje`
--

CREATE TABLE `contenido_email_mensaje` (
  `idcontenido_email_mensaje` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `texto` mediumtext NOT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contenido_email_mensaje`
--

INSERT INTO `contenido_email_mensaje` (`idcontenido_email_mensaje`, `titulo`, `texto`, `eliminado`, `updated_at`, `created_at`) VALUES
(1, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 0, '2016-02-17 21:55:20', NULL),
(2, 'Confirmar cobrador', ' te ha enviado un email confirmar...... bla bla bla....', 0, NULL, NULL),
(3, 'Registro de cuenta', 'te ha enviado un email para registrarte en portaldepago.cl testing', 0, '2016-02-12 20:50:05', NULL),
(4, 'Email bienvenida', '.', 0, NULL, NULL),
(5, 'Aviso - Cambio de tus datos en nuestros registros', '', 0, NULL, NULL),
(6, 'Aviso de nuevo cobro', '', 0, NULL, NULL),
(7, 'Nuevo archivo adjunto', '', 0, NULL, NULL),
(8, 'Vencimiento de deudas', '', 0, NULL, NULL),
(9, 'Vencimiento de deudas, 3 días', '', 0, NULL, NULL),
(10, 'Vencimiento de deudas, 7 días', '', 0, NULL, NULL),
(11, 'Vencimiento de deudas, 14 días', '', 0, NULL, NULL),
(12, 'Cobros por vencer, 1 día', '', 0, NULL, NULL),
(13, 'Cobros por vencer, 3 días', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_pago`
--

CREATE TABLE `datos_pago` (
  `iddatos_pago` int(11) NOT NULL,
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `banco` varchar(100) NOT NULL,
  `nro_cuenta` varchar(120) NOT NULL,
  `tipo_cuenta` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_pago`
--

INSERT INTO `datos_pago` (`iddatos_pago`, `idUsuarios`, `banco`, `nro_cuenta`, `tipo_cuenta`, `created_at`, `updated_at`) VALUES
(2, 62, 'Santander', '6609236', 'Cuenta Corriente', '2016-11-28 23:24:43', '2018-08-13 00:29:02'),
(3, 64, 'Santander', 'kuk879879', 'Cuenta Corriente', '2016-12-07 21:35:36', '2016-12-07 21:35:36'),
(4, 65, 'Santander', '0-000-66-43611-0', 'Cuenta Corriente', '2016-12-17 12:21:39', '2017-02-02 20:11:39'),
(5, 69, 'Banco Estado', '16181604', 'Cuenta Vista', '2016-12-20 19:45:30', '2017-04-12 19:09:52'),
(6, 70, 'Santander', '63416851', 'Cuenta Corriente', '2017-01-19 13:19:28', '2017-01-19 13:19:28'),
(7, 68, 'BCI', '76687767', 'Cuenta Corriente', '2017-02-13 15:30:49', '2017-02-13 15:30:49'),
(8, 76, 'Security', '125663701', 'Cuenta Corriente', '2017-03-04 14:55:47', '2017-03-04 14:55:47'),
(9, 77, 'BBVA', '14130938', 'Cuenta Corriente', '2017-03-07 13:04:44', '2017-03-07 13:04:55'),
(10, 78, 'Santander', '69180086', 'Cuenta Corriente', '2017-03-10 22:01:20', '2017-03-10 22:01:20'),
(11, 80, 'Santander', '70788845', 'Cuenta Corriente', '2017-03-16 18:26:05', '2017-03-16 18:26:05'),
(12, 79, 'Santander', '6454020', 'Cuenta Corriente', '2017-03-16 18:58:40', '2017-03-16 18:58:40'),
(13, 81, 'Santander', '66016730', 'Cuenta Corriente', '2017-03-17 16:37:46', '2017-03-17 16:37:46'),
(14, 85, 'Banco de Chile', '001731884207', 'Cuenta Corriente', '2017-06-21 19:04:33', '2017-06-21 19:04:33'),
(15, 75, 'BBVA', '22379633', 'Cuenta Corriente', '2017-06-28 21:32:43', '2017-06-28 21:32:43'),
(16, 88, 'Banco Estado', '171808014', 'Cuenta Vista', '2017-07-06 18:38:24', '2017-07-06 18:38:24'),
(17, 89, 'Banco de Chile', '00255876644', 'Cuenta Corriente', '2017-07-22 04:22:37', '2017-07-22 04:22:37'),
(18, 87, 'BCI', '76703053', 'Cuenta Corriente', '2017-07-26 21:12:19', '2017-07-26 21:12:19'),
(19, 94, 'Banco Estado', '366-7-016525-1', 'Chequera Electrónica', '2017-08-29 11:10:44', '2018-08-29 14:17:55'),
(20, 95, 'BCI', '76530612', 'Cuenta Corriente', '2017-11-23 11:56:06', '2017-11-23 11:56:47'),
(21, 99, 'BCI', '45504377', 'Cuenta Corriente', '2018-04-02 16:40:37', '2018-04-02 16:40:56'),
(22, 100, 'BCI', '45504377', 'Cuenta Corriente', '2018-04-02 17:14:55', '2018-04-02 17:14:55'),
(23, 103, 'Banco Estado', '18704285', 'Cuenta Vista', '2018-04-20 04:06:18', '2018-04-20 04:06:18'),
(24, 104, 'Banco Estado', '170333446', 'Cuenta Vista', '2018-05-28 22:27:12', '2018-05-28 22:27:12'),
(25, 107, 'BCI', '20050950', 'Cuenta Corriente', '2018-06-22 20:09:47', '2018-06-22 20:09:47'),
(26, 108, 'Banco Estado', '17386180', 'Cuenta Vista', '2018-06-25 17:56:48', '2018-06-25 17:56:48'),
(27, 63, 'BBVA', '12345667', 'Cuenta Corriente', '2018-06-26 13:31:50', '2018-06-26 13:31:50'),
(28, 106, 'Banco Estado', '35570874487', 'Chequera Electrónica', '2018-07-03 18:23:22', '2018-07-03 18:23:22'),
(29, 109, 'Banco Estado', '20.154.296-0', 'Cuenta Vista', '2018-07-15 18:53:29', '2018-07-15 18:53:29'),
(30, 112, 'BBVA', '16366159', 'Cuenta Corriente', '2018-07-31 13:26:54', '2018-07-31 13:26:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_envio_email`
--

CREATE TABLE `historial_envio_email` (
  `idhistorial_envio_email` int(11) NOT NULL,
  `mensaje` varchar(100) NOT NULL,
  `texto` mediumtext NOT NULL,
  `idUsuarios` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `para` varchar(100) NOT NULL,
  `tipo_email` int(11) NOT NULL,
  `de` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `historial_envio_email`
--

INSERT INTO `historial_envio_email` (`idhistorial_envio_email`, `mensaje`, `texto`, `idUsuarios`, `created_at`, `updated_at`, `para`, `tipo_email`, `de`) VALUES
(8, 'Email bienvenida', '...', 62, '2016-11-23 21:50:02', '2016-11-23 21:50:02', '-', 4, 0),
(9, 'Aviso de datos cambiado', '...', 62, '2016-11-28 23:13:12', '2016-11-28 23:13:12', '-', 5, 0),
(10, 'Email bienvenida', '...', 63, '2016-11-29 00:18:04', '2016-11-29 00:18:04', '-', 4, 0),
(11, 'Email bienvenida', '...', 64, '2016-12-01 23:33:44', '2016-12-01 23:33:44', '-', 4, 0),
(12, 'Email bienvenida', '...', 65, '2016-12-05 21:08:47', '2016-12-05 21:08:47', '-', 4, 0),
(13, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 65, '2016-12-05 21:10:34', '2016-12-05 21:10:34', '-', 1, 0),
(14, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 65, '2016-12-05 21:44:04', '2016-12-05 21:44:04', '-', 1, 0),
(15, 'Email bienvenida', '...', 66, '2016-12-07 16:24:43', '2016-12-07 16:24:43', '-', 4, 0),
(16, 'Email bienvenida', '...', 67, '2016-12-12 00:22:35', '2016-12-12 00:22:35', '-', 4, 0),
(17, 'Email bienvenida', '...', 68, '2016-12-20 19:30:46', '2016-12-20 19:30:46', '-', 4, 0),
(18, 'Email bienvenida', '...', 69, '2016-12-20 19:44:01', '2016-12-20 19:44:01', '-', 4, 0),
(19, 'Aviso de nuevo cobro', '...', 68, '2016-12-20 19:46:16', '2016-12-20 19:46:16', '-', 6, 69),
(20, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2017-01-14 00:48:49', '2017-01-14 00:48:49', '-', 1, 0),
(21, 'Email bienvenida', '...', 70, '2017-01-19 13:16:31', '2017-01-19 13:16:31', '-', 4, 0),
(22, 'Aviso de nuevo cobro', '...', 69, '2017-01-19 13:20:18', '2017-01-19 13:20:18', '-', 6, 70),
(23, 'Aviso de nuevo cobro', '...', 65, '2017-01-23 22:49:12', '2017-01-23 22:49:12', '-', 6, 69),
(24, 'Vencimiento de deudas', '', 65, '2017-01-25 21:33:13', '2017-01-25 21:33:13', '-', 8, 0),
(25, 'Vencimiento de deudas', '', 65, '2017-01-25 21:35:52', '2017-01-25 21:35:52', '-', 8, 0),
(26, 'Cobros por vencer, 1 día', '', 69, '2017-01-25 21:36:18', '2017-01-25 21:36:18', '-', 12, 0),
(27, 'Aviso de datos cambiado', '...', 65, '2017-01-25 21:43:41', '2017-01-25 21:43:41', '-', 5, 0),
(28, 'Aviso de datos cambiado', '...', 65, '2017-01-25 21:43:50', '2017-01-25 21:43:50', '-', 5, 0),
(29, 'Email bienvenida', '...', 71, '2017-01-26 12:42:21', '2017-01-26 12:42:21', '-', 4, 0),
(30, 'Email bienvenida', '...', 72, '2017-01-26 13:05:27', '2017-01-26 13:05:27', '-', 4, 0),
(31, 'Aviso de nuevo cobro', '...', 68, '2017-01-26 13:22:31', '2017-01-26 13:22:31', '-', 6, 69),
(32, 'Nuevo archivo adjunto', '...', 68, '2017-01-26 15:17:40', '2017-01-26 15:17:40', '-', 7, 69),
(33, 'Aviso de nuevo cobro', '...', 69, '2017-01-26 15:26:11', '2017-01-26 15:26:11', '-', 6, 70),
(34, 'Aviso de nuevo cobro', '...', 62, '2017-01-26 17:17:45', '2017-01-26 17:17:45', '-', 6, 69),
(35, 'Vencimiento de deudas', '', 68, '2017-01-28 21:00:08', '2017-01-28 21:00:08', '-', 8, 0),
(36, 'Vencimiento de deudas', '', 69, '2017-01-28 21:00:08', '2017-01-28 21:00:08', '-', 8, 0),
(37, 'Cobros por vencer, 1 día', '', 69, '2017-01-28 21:00:10', '2017-01-28 21:00:10', '-', 12, 0),
(38, 'Cobros por vencer, 1 día', '', 70, '2017-01-28 21:00:10', '2017-01-28 21:00:10', '-', 12, 0),
(39, 'Cobros por vencer, 3 días', '', 69, '2017-01-30 21:00:10', '2017-01-30 21:00:10', '-', 13, 0),
(40, 'Cobros por vencer, 3 días', '', 70, '2017-01-30 21:00:10', '2017-01-30 21:00:10', '-', 13, 0),
(41, 'Vencimiento de deudas, 3 días', '', 68, '2017-01-30 21:00:10', '2017-01-30 21:00:10', '-', 9, 0),
(42, 'Vencimiento de deudas, 3 días', '', 69, '2017-01-30 21:00:10', '2017-01-30 21:00:10', '-', 9, 0),
(43, 'Vencimiento de deudas', '', 62, '2017-01-31 21:00:07', '2017-01-31 21:00:07', '-', 8, 0),
(44, 'Cobros por vencer, 1 día', '', 69, '2017-01-31 21:00:07', '2017-01-31 21:00:07', '-', 12, 0),
(45, 'Aviso de datos cambiado', '...', 65, '2017-02-01 20:25:58', '2017-02-01 20:25:58', '-', 5, 0),
(46, 'Aviso de datos cambiado', '...', 65, '2017-02-01 20:29:14', '2017-02-01 20:29:14', '-', 5, 0),
(47, 'Cobros por vencer, 1 día', '', 64, '2017-02-01 21:00:08', '2017-02-01 21:00:08', '-', 12, 0),
(48, 'Aviso de nuevo cobro', '...', 69, '2017-02-01 21:05:40', '2017-02-01 21:05:40', '-', 6, 65),
(49, 'Aviso de datos cambiado', '...', 69, '2017-02-02 18:42:45', '2017-02-02 18:42:45', '-', 5, 0),
(50, 'Email bienvenida', '...', 73, '2017-02-02 19:48:53', '2017-02-02 19:48:53', '-', 4, 0),
(51, 'Vencimiento de deudas, 3 días', '', 62, '2017-02-02 21:00:09', '2017-02-02 21:00:09', '-', 9, 0),
(52, 'Cobros por vencer, 3 días', '', 69, '2017-02-02 21:00:09', '2017-02-02 21:00:09', '-', 13, 0),
(53, 'Aviso de nuevo cobro', '...', 70, '2017-02-03 17:03:48', '2017-02-03 17:03:48', '-', 6, 69),
(54, 'Cobros por vencer, 3 días', '', 64, '2017-02-03 21:00:10', '2017-02-03 21:00:10', '-', 13, 0),
(55, 'Vencimiento de deudas, 7 días', '', 68, '2017-02-03 21:00:10', '2017-02-03 21:00:10', '-', 10, 0),
(56, 'Vencimiento de deudas, 7 días', '', 69, '2017-02-03 21:00:10', '2017-02-03 21:00:10', '-', 10, 0),
(57, 'Vencimiento de deudas', '', 70, '2017-02-05 21:00:08', '2017-02-05 21:00:08', '-', 8, 0),
(58, 'Cobros por vencer, 1 día', '', 69, '2017-02-05 21:00:08', '2017-02-05 21:00:08', '-', 12, 0),
(59, 'Vencimiento de deudas, 7 días', '', 62, '2017-02-06 21:00:09', '2017-02-06 21:00:09', '-', 10, 0),
(60, 'Cobros por vencer, 1 día', '', 69, '2017-02-06 21:00:09', '2017-02-06 21:00:09', '-', 12, 0),
(61, 'Vencimiento de deudas, 3 días', '', 70, '2017-02-07 21:00:08', '2017-02-07 21:00:08', '-', 9, 0),
(62, 'Cobros por vencer, 3 días', '', 69, '2017-02-07 21:00:09', '2017-02-07 21:00:09', '-', 13, 0),
(63, 'Cobros por vencer, 3 días', '', 69, '2017-02-08 21:00:09', '2017-02-08 21:00:09', '-', 13, 0),
(64, 'Aviso de nuevo cobro', '...', 71, '2017-02-10 12:25:24', '2017-02-10 12:25:24', '-', 6, 65),
(65, 'Aviso de nuevo cobro', '...', 68, '2017-02-10 12:37:31', '2017-02-10 12:37:31', '-', 6, 69),
(66, 'Vencimiento de deudas, 14 días', '', 68, '2017-02-10 21:00:08', '2017-02-10 21:00:08', '-', 11, 0),
(67, 'Vencimiento de deudas, 14 días', '', 69, '2017-02-10 21:00:08', '2017-02-10 21:00:08', '-', 11, 0),
(68, 'Vencimiento de deudas, 7 días', '', 70, '2017-02-11 21:00:08', '2017-02-11 21:00:08', '-', 10, 0),
(69, 'Vencimiento de deudas', '', 68, '2017-02-12 21:00:08', '2017-02-12 21:00:08', '-', 8, 0),
(70, 'Cobros por vencer, 1 día', '', 69, '2017-02-12 21:00:08', '2017-02-12 21:00:08', '-', 12, 0),
(71, 'Aviso de nuevo cobro', '...', 62, '2017-02-13 15:32:00', '2017-02-13 15:32:00', '-', 6, 68),
(72, 'Aviso de nuevo cobro', '...', 62, '2017-02-13 15:32:29', '2017-02-13 15:32:29', '-', 6, 68),
(73, 'Vencimiento de deudas, 14 días', '', 62, '2017-02-13 21:00:09', '2017-02-13 21:00:09', '-', 11, 0),
(74, 'Vencimiento de deudas, 3 días', '', 68, '2017-02-14 21:00:09', '2017-02-14 21:00:09', '-', 9, 0),
(75, 'Cobros por vencer, 3 días', '', 69, '2017-02-14 21:00:09', '2017-02-14 21:00:09', '-', 13, 0),
(76, 'Vencimiento de deudas', '', 62, '2017-02-15 21:00:08', '2017-02-15 21:00:08', '-', 8, 0),
(77, 'Cobros por vencer, 1 día', '', 68, '2017-02-15 21:00:08', '2017-02-15 21:00:08', '-', 12, 0),
(78, 'Vencimiento de deudas', '', 62, '2017-02-16 21:00:08', '2017-02-16 21:00:08', '-', 8, 0),
(79, 'Cobros por vencer, 1 día', '', 68, '2017-02-16 21:00:09', '2017-02-16 21:00:09', '-', 12, 0),
(80, 'Vencimiento de deudas, 3 días', '', 62, '2017-02-17 21:00:08', '2017-02-17 21:00:08', '-', 9, 0),
(81, 'Cobros por vencer, 3 días', '', 68, '2017-02-17 21:00:09', '2017-02-17 21:00:09', '-', 13, 0),
(82, 'Vencimiento de deudas, 7 días', '', 68, '2017-02-18 21:00:10', '2017-02-18 21:00:10', '-', 10, 0),
(83, 'Vencimiento de deudas, 3 días', '', 62, '2017-02-18 21:00:10', '2017-02-18 21:00:10', '-', 9, 0),
(84, 'Vencimiento de deudas, 14 días', '', 70, '2017-02-18 21:00:10', '2017-02-18 21:00:10', '-', 11, 0),
(85, 'Cobros por vencer, 3 días', '', 68, '2017-02-18 21:00:10', '2017-02-18 21:00:10', '-', 13, 0),
(86, 'Vencimiento de deudas, 7 días', '', 62, '2017-02-21 21:00:09', '2017-02-21 21:00:09', '-', 10, 0),
(87, 'Email bienvenida', '...', 74, '2017-02-22 16:31:33', '2017-02-22 16:31:33', '-', 4, 0),
(88, 'Vencimiento de deudas, 14 días', '', 62, '2017-02-28 21:00:08', '2017-02-28 21:00:08', '-', 11, 0),
(89, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2017-03-01 13:11:50', '2017-03-01 13:11:50', '-', 1, 0),
(90, 'Email bienvenida', '...', 75, '2017-03-03 20:43:16', '2017-03-03 20:43:16', '-', 4, 0),
(91, 'Aviso de nuevo cobro', '...', 75, '2017-03-03 20:55:10', '2017-03-03 20:55:10', '-', 6, 62),
(92, 'Email bienvenida', '...', 76, '2017-03-04 14:51:07', '2017-03-04 14:51:07', '-', 4, 0),
(93, 'Aviso de nuevo cobro', '...', 62, '2017-03-04 15:36:05', '2017-03-04 15:36:05', '-', 6, 76),
(94, 'Vencimiento de deudas', '', 62, '2017-03-05 21:00:08', '2017-03-05 21:00:08', '-', 8, 0),
(95, 'Cobros por vencer, 1 día', '', 76, '2017-03-05 21:00:09', '2017-03-05 21:00:09', '-', 12, 0),
(96, 'Email bienvenida', '...', 77, '2017-03-07 12:49:50', '2017-03-07 12:49:50', '-', 4, 0),
(97, 'Aviso de nuevo cobro', '...', 62, '2017-03-07 13:07:43', '2017-03-07 13:07:43', '-', 6, 77),
(98, 'Cobros por vencer, 3 días', '', 76, '2017-03-07 21:00:08', '2017-03-07 21:00:08', '-', 13, 0),
(99, 'Vencimiento de deudas, 3 días', '', 62, '2017-03-07 21:00:08', '2017-03-07 21:00:08', '-', 9, 0),
(100, 'Email bienvenida', '...', 78, '2017-03-10 21:47:33', '2017-03-10 21:47:33', '-', 4, 0),
(101, 'Aviso de nuevo cobro', '...', 62, '2017-03-10 22:03:21', '2017-03-10 22:03:21', '-', 6, 78),
(102, 'Aviso de nuevo cobro', '...', 62, '2017-03-10 22:04:03', '2017-03-10 22:04:03', '-', 6, 78),
(103, 'Cobros por vencer, 1 día', '', 62, '2017-03-11 21:00:09', '2017-03-11 21:00:09', '-', 12, 0),
(104, 'Vencimiento de deudas, 7 días', '', 62, '2017-03-11 21:00:09', '2017-03-11 21:00:09', '-', 10, 0),
(105, 'Vencimiento de deudas', '', 75, '2017-03-11 21:00:09', '2017-03-11 21:00:09', '-', 8, 0),
(106, 'Cobros por vencer, 3 días', '', 62, '2017-03-13 21:00:09', '2017-03-13 21:00:09', '-', 13, 0),
(107, 'Vencimiento de deudas, 3 días', '', 75, '2017-03-13 21:00:09', '2017-03-13 21:00:09', '-', 9, 0),
(108, 'Email bienvenida', '...', 79, '2017-03-16 15:53:43', '2017-03-16 15:53:43', '-', 4, 0),
(109, 'Email bienvenida', '...', 80, '2017-03-16 18:22:32', '2017-03-16 18:22:32', '-', 4, 0),
(110, 'Aviso de nuevo cobro', '...', 62, '2017-03-16 18:26:48', '2017-03-16 18:26:48', '-', 6, 80),
(111, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2017-03-16 18:48:51', '2017-03-16 18:48:51', '-', 1, 0),
(112, 'Email bienvenida', '...', 79, '2017-03-16 18:53:09', '2017-03-16 18:53:09', '-', 4, 0),
(113, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 79, '2017-03-16 18:56:15', '2017-03-16 18:56:15', '-', 1, 0),
(114, 'Aviso de nuevo cobro', '...', 62, '2017-03-16 18:59:14', '2017-03-16 18:59:14', '-', 6, 79),
(115, 'Email bienvenida', '...', 81, '2017-03-17 16:36:00', '2017-03-17 16:36:00', '-', 4, 0),
(116, 'Aviso de nuevo cobro', '...', 81, '2017-03-17 16:38:25', '2017-03-17 16:38:25', '-', 6, 81),
(117, 'Vencimiento de deudas, 7 días', '', 75, '2017-03-17 21:00:08', '2017-03-17 21:00:08', '-', 10, 0),
(118, 'Vencimiento de deudas', '', 81, '2017-03-18 21:00:09', '2017-03-18 21:00:09', '-', 8, 0),
(119, 'Cobros por vencer, 1 día', '', 81, '2017-03-18 21:00:09', '2017-03-18 21:00:09', '-', 12, 0),
(120, 'Vencimiento de deudas, 14 días', '', 62, '2017-03-18 21:00:09', '2017-03-18 21:00:09', '-', 11, 0),
(121, 'Vencimiento de deudas, 3 días', '', 81, '2017-03-20 21:00:09', '2017-03-20 21:00:09', '-', 9, 0),
(122, 'Cobros por vencer, 3 días', '', 81, '2017-03-20 21:00:09', '2017-03-20 21:00:09', '-', 13, 0),
(123, 'Aviso de nuevo cobro', '...', 62, '2017-03-21 13:25:29', '2017-03-21 13:25:29', '-', 6, 80),
(124, 'Aviso de nuevo cobro', '...', 62, '2017-03-21 13:26:08', '2017-03-21 13:26:08', '-', 6, 80),
(125, 'Aviso de nuevo cobro', '...', 62, '2017-03-21 13:26:46', '2017-03-21 13:26:46', '-', 6, 80),
(126, 'Aviso de nuevo cobro', '...', 62, '2017-03-21 13:48:01', '2017-03-21 13:48:01', '-', 6, 80),
(127, 'Aviso de nuevo cobro', '...', 62, '2017-03-21 13:54:51', '2017-03-21 13:54:51', '-', 6, 80),
(128, 'Aviso de nuevo cobro', '...', 62, '2017-03-21 13:55:29', '2017-03-21 13:55:29', '-', 6, 80),
(129, 'Aviso de nuevo cobro', '...', 70, '2017-03-21 20:01:15', '2017-03-21 20:01:15', '-', 6, 69),
(130, 'Aviso de nuevo cobro', '...', 62, '2017-03-22 12:21:08', '2017-03-22 12:21:08', '-', 6, 80),
(131, 'Aviso de nuevo cobro', '...', 62, '2017-03-22 12:22:15', '2017-03-22 12:22:15', '-', 6, 80),
(132, 'Aviso de nuevo cobro', '...', 62, '2017-03-22 12:23:48', '2017-03-22 12:23:48', '-', 6, 80),
(133, 'Aviso de nuevo cobro', '...', 77, '2017-03-22 16:24:21', '2017-03-22 16:24:21', '-', 6, 62),
(134, 'Aviso de nuevo cobro', '...', 77, '2017-03-22 16:25:11', '2017-03-22 16:25:11', '-', 6, 62),
(135, 'Aviso de nuevo cobro', '...', 77, '2017-03-22 16:25:46', '2017-03-22 16:25:46', '-', 6, 62),
(136, 'Email bienvenida', '...', 65, '2017-03-23 21:49:48', '2017-03-23 21:49:48', '-', 4, 0),
(137, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 65, '2017-03-23 21:50:24', '2017-03-23 21:50:24', '-', 1, 0),
(138, 'Aviso de datos cambiado', '...', 65, '2017-03-23 21:50:30', '2017-03-23 21:50:30', '-', 5, 0),
(139, 'Vencimiento de deudas, 14 días', '', 75, '2017-03-24 21:00:18', '2017-03-24 21:00:18', '-', 11, 0),
(140, 'Vencimiento de deudas, 7 días', '', 81, '2017-03-24 21:00:19', '2017-03-24 21:00:19', '-', 10, 0),
(141, 'Vencimiento de deudas', '', 62, '2017-03-25 21:00:08', '2017-03-25 21:00:08', '-', 8, 0),
(142, 'Vencimiento de deudas', '', 77, '2017-03-25 21:00:08', '2017-03-25 21:00:08', '-', 8, 0),
(143, 'Cobros por vencer, 1 día', '', 62, '2017-03-25 21:00:09', '2017-03-25 21:00:09', '-', 12, 0),
(144, 'Cobros por vencer, 1 día', '', 80, '2017-03-25 21:00:09', '2017-03-25 21:00:09', '-', 12, 0),
(145, 'Email bienvenida', '...', 62, '2017-03-27 19:06:54', '2017-03-27 19:06:54', '-', 4, 0),
(146, 'Vencimiento de deudas, 3 días', '', 62, '2017-03-27 21:00:09', '2017-03-27 21:00:09', '-', 9, 0),
(147, 'Vencimiento de deudas, 3 días', '', 77, '2017-03-27 21:00:09', '2017-03-27 21:00:09', '-', 9, 0),
(148, 'Cobros por vencer, 3 días', '', 62, '2017-03-27 21:00:09', '2017-03-27 21:00:09', '-', 13, 0),
(149, 'Cobros por vencer, 3 días', '', 80, '2017-03-27 21:00:09', '2017-03-27 21:00:09', '-', 13, 0),
(150, 'Email bienvenida', '...', 82, '2017-03-27 21:57:29', '2017-03-27 21:57:29', '-', 4, 0),
(151, 'Aviso de nuevo cobro', '...', 77, '2017-03-28 13:35:36', '2017-03-28 13:35:36', '-', 6, 80),
(152, 'Aviso de nuevo cobro', '...', 77, '2017-03-28 13:36:08', '2017-03-28 13:36:08', '-', 6, 80),
(153, 'Aviso de nuevo cobro', '...', 77, '2017-03-28 13:36:47', '2017-03-28 13:36:47', '-', 6, 80),
(154, 'Vencimiento de deudas', '', 77, '2017-03-28 21:00:09', '2017-03-28 21:00:09', '-', 8, 0),
(155, 'Cobros por vencer, 1 día', '', 62, '2017-03-28 21:00:09', '2017-03-28 21:00:09', '-', 12, 0),
(156, 'Cobros por vencer, 3 días', '', 62, '2017-03-30 21:00:09', '2017-03-30 21:00:09', '-', 13, 0),
(157, 'Vencimiento de deudas, 3 días', '', 77, '2017-03-30 21:00:09', '2017-03-30 21:00:09', '-', 9, 0),
(158, 'Vencimiento de deudas, 14 días', '', 81, '2017-03-31 21:00:09', '2017-03-31 21:00:09', '-', 11, 0),
(159, 'Vencimiento de deudas', '', 82, '2017-03-31 21:00:09', '2017-03-31 21:00:09', '-', 8, 0),
(160, 'Vencimiento de deudas', '', 77, '2017-03-31 21:00:09', '2017-03-31 21:00:09', '-', 8, 0),
(161, 'Vencimiento de deudas, 7 días', '', 62, '2017-03-31 21:00:09', '2017-03-31 21:00:09', '-', 10, 0),
(162, 'Vencimiento de deudas, 7 días', '', 77, '2017-03-31 21:00:09', '2017-03-31 21:00:09', '-', 10, 0),
(163, 'Cobros por vencer, 1 día', '', 62, '2017-03-31 21:00:10', '2017-03-31 21:00:10', '-', 12, 0),
(164, 'Cobros por vencer, 1 día', '', 80, '2017-03-31 21:00:10', '2017-03-31 21:00:10', '-', 12, 0),
(165, 'Cobros por vencer, 1 día', '', 80, '2017-04-01 21:00:09', '2017-04-01 21:00:09', '-', 12, 0),
(166, 'Vencimiento de deudas', '', 77, '2017-04-01 21:00:09', '2017-04-01 21:00:09', '-', 8, 0),
(167, 'Vencimiento de deudas, 3 días', '', 82, '2017-04-02 21:00:10', '2017-04-02 21:00:10', '-', 9, 0),
(168, 'Vencimiento de deudas, 3 días', '', 77, '2017-04-02 21:00:10', '2017-04-02 21:00:10', '-', 9, 0),
(169, 'Cobros por vencer, 3 días', '', 62, '2017-04-02 21:00:10', '2017-04-02 21:00:10', '-', 13, 0),
(170, 'Cobros por vencer, 3 días', '', 80, '2017-04-02 21:00:10', '2017-04-02 21:00:10', '-', 13, 0),
(171, 'Vencimiento de deudas, 3 días', '', 77, '2017-04-03 21:00:08', '2017-04-03 21:00:08', '-', 9, 0),
(172, 'Vencimiento de deudas, 7 días', '', 77, '2017-04-03 21:00:09', '2017-04-03 21:00:09', '-', 10, 0),
(173, 'Cobros por vencer, 3 días', '', 80, '2017-04-03 21:00:09', '2017-04-03 21:00:09', '-', 13, 0),
(174, 'Aviso de datos cambiado', '...', 62, '2017-04-04 10:30:53', '2017-04-04 10:30:53', '-', 5, 0),
(175, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2017-04-04 10:35:31', '2017-04-04 10:35:31', '-', 1, 0),
(176, 'Email bienvenida', '...', 83, '2017-04-04 16:11:40', '2017-04-04 16:11:40', '-', 4, 0),
(177, 'Aviso de datos cambiado', '...', 62, '2017-04-05 13:27:28', '2017-04-05 13:27:28', '-', 5, 0),
(178, 'Email bienvenida', '...', 62, '2017-04-05 13:27:47', '2017-04-05 13:27:47', '-', 4, 0),
(179, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2017-04-05 13:35:37', '2017-04-05 13:35:37', '-', 1, 0),
(180, 'Vencimiento de deudas, 7 días', '', 82, '2017-04-06 21:00:09', '2017-04-06 21:00:09', '-', 10, 0),
(181, 'Vencimiento de deudas, 7 días', '', 77, '2017-04-06 21:00:09', '2017-04-06 21:00:09', '-', 10, 0),
(182, 'Vencimiento de deudas, 7 días', '', 77, '2017-04-07 21:00:09', '2017-04-07 21:00:09', '-', 10, 0),
(183, 'Vencimiento de deudas, 14 días', '', 62, '2017-04-07 21:00:10', '2017-04-07 21:00:10', '-', 11, 0),
(184, 'Vencimiento de deudas, 14 días', '', 77, '2017-04-07 21:00:10', '2017-04-07 21:00:10', '-', 11, 0),
(185, 'Vencimiento de deudas, 14 días', '', 77, '2017-04-10 21:00:08', '2017-04-10 21:00:08', '-', 11, 0),
(186, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-11 11:58:26', '2017-04-11 11:58:26', '-', 1, 0),
(187, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-11 18:42:18', '2017-04-11 18:42:18', '-', 1, 0),
(188, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 65, '2017-04-11 21:00:27', '2017-04-11 21:00:27', '-', 1, 0),
(189, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-11 21:19:31', '2017-04-11 21:19:31', '-', 1, 0),
(190, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:09:32', '2017-04-12 18:09:32', '-', 1, 0),
(191, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:11:14', '2017-04-12 18:11:14', '-', 1, 0),
(192, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:12:04', '2017-04-12 18:12:04', '-', 1, 0),
(193, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:13:35', '2017-04-12 18:13:35', '-', 1, 0),
(194, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:14:33', '2017-04-12 18:14:33', '-', 1, 0),
(195, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:15:49', '2017-04-12 18:15:49', '-', 1, 0),
(196, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:18:40', '2017-04-12 18:18:40', '-', 1, 0),
(197, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:19:18', '2017-04-12 18:19:18', '-', 1, 0),
(198, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:20:27', '2017-04-12 18:20:27', '-', 1, 0),
(199, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:21:59', '2017-04-12 18:21:59', '-', 1, 0),
(200, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:22:39', '2017-04-12 18:22:39', '-', 1, 0),
(201, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 69, '2017-04-12 18:23:43', '2017-04-12 18:23:43', '-', 1, 0),
(202, 'Aviso de datos cambiado', '...', 69, '2017-04-12 19:10:13', '2017-04-12 19:10:13', '-', 5, 0),
(203, 'Aviso de datos cambiado', '...', 69, '2017-04-12 19:11:35', '2017-04-12 19:11:35', '-', 5, 0),
(204, 'Aviso de datos cambiado', '...', 69, '2017-04-12 19:26:10', '2017-04-12 19:26:10', '-', 5, 0),
(205, 'Email bienvenida', '...', 69, '2017-04-12 19:26:31', '2017-04-12 19:26:31', '-', 4, 0),
(206, 'Email bienvenida', '...', 69, '2017-04-12 19:27:23', '2017-04-12 19:27:23', '-', 4, 0),
(207, 'Restablecer Contraseña, test 1', 'Se le ha enviado el siguiente email para restablecer su contraseña', 65, '2017-04-12 21:24:13', '2017-04-12 21:24:13', '-', 1, 0),
(208, 'Vencimiento de deudas, 14 días', '', 82, '2017-04-13 21:00:09', '2017-04-13 21:00:09', '-', 11, 0),
(209, 'Vencimiento de deudas, 14 días', '', 77, '2017-04-13 21:00:09', '2017-04-13 21:00:09', '-', 11, 0),
(210, 'Vencimiento de deudas, 14 días', '', 77, '2017-04-14 21:00:08', '2017-04-14 21:00:08', '-', 11, 0),
(211, 'Email bienvenida', '...', 84, '2017-04-17 10:33:27', '2017-04-17 10:33:27', '-', 4, 0),
(212, 'Aviso - Cambio de tus datos en nuestros registros', '...', 65, '2017-05-04 20:48:01', '2017-05-04 20:48:01', '-', 5, 0),
(213, 'Email bienvenida', '...', 85, '2017-06-21 18:58:57', '2017-06-21 18:58:57', '-', 4, 0),
(214, 'Email bienvenida', '...', 86, '2017-06-21 19:08:22', '2017-06-21 19:08:22', '-', 4, 0),
(215, 'Cobros por vencer, 1 día', '', 85, '2017-06-24 21:00:08', '2017-06-24 21:00:08', '-', 12, 0),
(216, 'Vencimiento de deudas', '', 86, '2017-06-24 21:00:08', '2017-06-24 21:00:08', '-', 8, 0),
(217, 'Cobros por vencer, 3 días', '', 85, '2017-06-26 21:00:08', '2017-06-26 21:00:08', '-', 13, 0),
(218, 'Vencimiento de deudas, 3 días', '', 86, '2017-06-26 21:00:08', '2017-06-26 21:00:08', '-', 9, 0),
(219, 'Aviso de nuevo cobro', '...', 62, '2017-06-28 21:33:22', '2017-06-28 21:33:22', '-', 6, 75),
(220, 'Vencimiento de deudas, 7 días', '', 86, '2017-06-30 21:00:08', '2017-06-30 21:00:08', '-', 10, 0),
(221, 'Cobros por vencer, 1 día', '', 62, '2017-07-01 21:00:09', '2017-07-01 21:00:09', '-', 12, 0),
(222, 'Cobros por vencer, 1 día', '', 75, '2017-07-01 21:00:09', '2017-07-01 21:00:09', '-', 12, 0),
(223, 'Vencimiento de deudas', '', 62, '2017-07-01 21:00:09', '2017-07-01 21:00:09', '-', 8, 0),
(224, 'Cobros por vencer, 1 día', '', 62, '2017-07-02 21:00:09', '2017-07-02 21:00:09', '-', 12, 0),
(225, 'Vencimiento de deudas, 3 días', '', 62, '2017-07-03 21:00:08', '2017-07-03 21:00:08', '-', 9, 0),
(226, 'Cobros por vencer, 3 días', '', 62, '2017-07-03 21:00:09', '2017-07-03 21:00:09', '-', 13, 0),
(227, 'Cobros por vencer, 3 días', '', 75, '2017-07-03 21:00:09', '2017-07-03 21:00:09', '-', 13, 0),
(228, 'Cobros por vencer, 3 días', '', 62, '2017-07-04 21:00:09', '2017-07-04 21:00:09', '-', 13, 0),
(229, 'Email bienvenida', '...', 87, '2017-07-05 13:54:18', '2017-07-05 13:54:18', '-', 4, 0),
(230, 'Email bienvenida', '...', 88, '2017-07-06 18:35:52', '2017-07-06 18:35:52', '-', 4, 0),
(231, 'Registro de cuenta', 'te ha enviado un email para registrarte en portaldepago.cl testing', 88, '2017-07-06 18:44:03', '2017-07-06 18:44:03', 'hernan.aranda.prado@hap.cl', 3, 0),
(232, 'Vencimiento de deudas, 7 días', '', 87, '2017-07-07 21:00:09', '2017-07-07 21:00:09', '-', 10, 0),
(233, 'Vencimiento de deudas, 7 días', '', 62, '2017-07-07 21:00:09', '2017-07-07 21:00:09', '-', 10, 0),
(234, 'Vencimiento de deudas, 7 días', '', 87, '2017-07-08 21:00:08', '2017-07-08 21:00:08', '-', 10, 0),
(235, 'Vencimiento de deudas, 14 días', '', 87, '2017-07-14 21:00:09', '2017-07-14 21:00:09', '-', 11, 0),
(236, 'Vencimiento de deudas, 14 días', '', 62, '2017-07-14 21:00:09', '2017-07-14 21:00:09', '-', 11, 0),
(237, 'Vencimiento de deudas, 14 días', '', 87, '2017-07-15 21:00:08', '2017-07-15 21:00:08', '-', 11, 0),
(238, 'Cobros por vencer, 1 día', '', 88, '2017-07-16 21:00:09', '2017-07-16 21:00:09', '-', 12, 0),
(239, 'Cobros por vencer, 3 días', '', 88, '2017-07-18 21:00:09', '2017-07-18 21:00:09', '-', 13, 0),
(240, 'Email bienvenida', '...', 89, '2017-07-22 04:20:07', '2017-07-22 04:20:07', '-', 4, 0),
(241, 'Aviso de nuevo cobro', '...', 89, '2017-07-22 04:28:16', '2017-07-22 04:28:16', '-', 6, 89),
(242, 'Email bienvenida', '...', 90, '2017-07-23 18:04:25', '2017-07-23 18:04:25', '-', 4, 0),
(243, 'Email bienvenida', '...', 91, '2017-07-24 17:39:48', '2017-07-24 17:39:48', '-', 4, 0),
(244, 'Registro de cuenta', 'te ha enviado un email para registrarte en portaldepago.cl testing', 87, '2017-07-26 21:18:14', '2017-07-26 21:18:14', 'mosoriosoffia@gmail.com', 3, 0),
(245, 'Email bienvenida', '...', 92, '2017-07-31 20:33:09', '2017-07-31 20:33:09', '-', 4, 0),
(246, 'Aviso de nuevo cobro', '...', 92, '2017-07-31 20:41:03', '2017-07-31 20:41:03', '-', 6, 62),
(247, 'Cobros por vencer, 1 día', '', 62, '2017-08-02 21:00:09', '2017-08-02 21:00:09', '-', 12, 0),
(248, 'Vencimiento de deudas', '', 87, '2017-08-02 21:00:09', '2017-08-02 21:00:09', '-', 8, 0),
(249, 'Email bienvenida', '...', 93, '2017-08-03 17:06:45', '2017-08-03 17:06:45', '-', 4, 0),
(250, 'Cobros por vencer, 3 días', '', 62, '2017-08-04 21:00:09', '2017-08-04 21:00:09', '-', 13, 0),
(251, 'Vencimiento de deudas, 3 días', '', 87, '2017-08-04 21:00:09', '2017-08-04 21:00:09', '-', 9, 0),
(252, 'Vencimiento de deudas, 7 días', '', 87, '2017-08-08 21:00:09', '2017-08-08 21:00:09', '-', 10, 0),
(253, 'Vencimiento de deudas, 14 días', '', 87, '2017-08-15 21:00:09', '2017-08-15 21:00:09', '-', 11, 0),
(254, 'Email bienvenida', '...', 94, '2017-08-29 11:07:21', '2017-08-29 11:07:21', '-', 4, 0),
(255, 'Aviso - Cambio de tus datos en nuestros registros', '...', 94, '2017-08-29 11:11:10', '2017-08-29 11:11:10', '-', 5, 0),
(256, 'Aviso de nuevo cobro', '...', 87, '2017-11-09 13:46:03', '2017-11-09 13:46:03', '-', 6, 62),
(257, 'Vencimiento de deudas', '', 87, '2017-11-14 21:00:09', '2017-11-14 21:00:09', '-', 8, 0),
(258, 'Cobros por vencer, 1 día', '', 62, '2017-11-14 21:00:09', '2017-11-14 21:00:09', '-', 12, 0),
(259, 'Vencimiento de deudas, 3 días', '', 87, '2017-11-16 21:00:09', '2017-11-16 21:00:09', '-', 9, 0),
(260, 'Cobros por vencer, 3 días', '', 62, '2017-11-16 21:00:09', '2017-11-16 21:00:09', '-', 13, 0),
(261, 'Vencimiento de deudas, 7 días', '', 87, '2017-11-20 21:00:08', '2017-11-20 21:00:08', '-', 10, 0),
(262, 'Email bienvenida', '...', 95, '2017-11-23 11:51:04', '2017-11-23 11:51:04', '-', 4, 0),
(263, 'Cobros por vencer, 1 día', '', 95, '2017-11-24 21:00:10', '2017-11-24 21:00:10', '-', 12, 0),
(264, 'Cobros por vencer, 3 días', '', 95, '2017-11-26 21:00:09', '2017-11-26 21:00:09', '-', 13, 0),
(265, 'Vencimiento de deudas, 14 días', '', 87, '2017-11-27 21:00:09', '2017-11-27 21:00:09', '-', 11, 0),
(266, 'Email bienvenida', '...', 96, '2018-01-18 01:31:13', '2018-01-18 01:31:13', '-', 4, 0),
(267, 'Email bienvenida', '...', 97, '2018-02-12 21:12:35', '2018-02-12 21:12:35', '-', 4, 0),
(268, 'Email bienvenida', '...', 98, '2018-03-13 00:15:19', '2018-03-13 00:15:19', '-', 4, 0),
(269, 'Email bienvenida', '...', 99, '2018-04-02 16:38:48', '2018-04-02 16:38:48', '-', 4, 0),
(270, 'Aviso - Cambio de tus datos en nuestros registros', '...', 99, '2018-04-02 17:07:47', '2018-04-02 17:07:47', '-', 5, 0),
(271, 'Email bienvenida', '...', 100, '2018-04-02 17:09:08', '2018-04-02 17:09:08', '-', 4, 0),
(272, 'Email bienvenida', '...', 101, '2018-04-12 19:22:14', '2018-04-12 19:22:14', '-', 4, 0),
(273, 'Email bienvenida', '...', 102, '2018-04-19 13:00:27', '2018-04-19 13:00:27', '-', 4, 0),
(274, 'Email bienvenida', '...', 103, '2018-04-20 04:04:50', '2018-04-20 04:04:50', '-', 4, 0),
(275, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2018-04-26 00:00:02', '2018-04-26 00:00:02', '-', 1, 0),
(276, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2018-05-13 15:49:18', '2018-05-13 15:49:18', '-', 1, 0),
(277, 'Email bienvenida', '...', 104, '2018-05-28 22:21:37', '2018-05-28 22:21:37', '-', 4, 0),
(278, 'Aviso - Cambio de tus datos en nuestros registros', '...', 104, '2018-05-28 22:26:26', '2018-05-28 22:26:26', '-', 5, 0),
(279, 'Cobros por vencer, 1 día', '', 104, '2018-05-30 21:00:11', '2018-05-30 21:00:11', '-', 12, 0),
(280, 'Email bienvenida', '...', 105, '2018-06-01 18:52:40', '2018-06-01 18:52:40', '-', 4, 0),
(281, 'Cobros por vencer, 3 días', '', 104, '2018-06-01 21:00:10', '2018-06-01 21:00:10', '-', 13, 0),
(282, 'Cobros por vencer, 1 día', '', 104, '2018-06-12 21:00:11', '2018-06-12 21:00:11', '-', 12, 0),
(283, 'Cobros por vencer, 3 días', '', 104, '2018-06-14 21:00:11', '2018-06-14 21:00:11', '-', 13, 0),
(284, 'Email bienvenida', '...', 106, '2018-06-18 16:54:33', '2018-06-18 16:54:33', '-', 4, 0),
(285, 'Email bienvenida', '...', 107, '2018-06-22 20:06:48', '2018-06-22 20:06:48', '-', 4, 0),
(286, 'Email bienvenida', '...', 108, '2018-06-25 17:55:36', '2018-06-25 17:55:36', '-', 4, 0),
(287, 'Cobros por vencer, 1 día', '', 108, '2018-07-01 21:00:10', '2018-07-01 21:00:10', '-', 12, 0),
(288, 'Aviso - Cambio de tus datos en nuestros registros', '...', 106, '2018-07-03 18:25:06', '2018-07-03 18:25:06', '-', 5, 0),
(289, 'Cobros por vencer, 3 días', '', 108, '2018-07-03 21:00:10', '2018-07-03 21:00:10', '-', 13, 0),
(290, 'Cobros por vencer, 1 día', '', 89, '2018-07-14 21:00:10', '2018-07-14 21:00:10', '-', 12, 0),
(291, 'Email bienvenida', '...', 109, '2018-07-15 18:50:46', '2018-07-15 18:50:46', '-', 4, 0),
(292, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2018-07-16 11:05:34', '2018-07-16 11:05:34', '-', 1, 0),
(293, 'Cobros por vencer, 1 día', '', 89, '2018-07-16 21:00:11', '2018-07-16 21:00:11', '-', 12, 0),
(294, 'Vencimiento de deudas', '', 89, '2018-07-16 21:00:11', '2018-07-16 21:00:11', '-', 8, 0),
(295, 'Cobros por vencer, 3 días', '', 89, '2018-07-16 21:00:12', '2018-07-16 21:00:12', '-', 13, 0),
(296, 'Cobros por vencer, 3 días', '', 89, '2018-07-18 21:00:11', '2018-07-18 21:00:11', '-', 13, 0),
(297, 'Vencimiento de deudas, 3 días', '', 89, '2018-07-18 21:00:11', '2018-07-18 21:00:11', '-', 9, 0),
(298, 'Email bienvenida', '...', 110, '2018-07-20 01:12:40', '2018-07-20 01:12:40', '-', 4, 0),
(299, 'Vencimiento de deudas, 7 días', '', 89, '2018-07-22 21:00:11', '2018-07-22 21:00:11', '-', 10, 0),
(300, 'Email bienvenida', '...', 111, '2018-07-26 14:23:38', '2018-07-26 14:23:38', '-', 4, 0),
(301, 'Vencimiento de deudas, 14 días', '', 89, '2018-07-29 21:00:10', '2018-07-29 21:00:10', '-', 11, 0),
(302, 'Email bienvenida', '...', 112, '2018-07-31 13:25:13', '2018-07-31 13:25:13', '-', 4, 0),
(303, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2018-07-31 20:35:28', '2018-07-31 20:35:28', '-', 1, 0),
(304, 'Email bienvenida', '...', 113, '2018-08-05 13:38:26', '2018-08-05 13:38:26', '-', 4, 0),
(305, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 113, '2018-08-05 14:04:57', '2018-08-05 14:04:57', '-', 1, 0),
(306, 'Aviso de nuevo cobro', '...', 80, '2018-08-13 00:18:58', '2018-08-13 00:18:58', '-', 6, 62),
(307, 'Aviso - Cambio de tus datos en nuestros registros', '...', 62, '2018-08-13 00:29:02', '2018-08-13 00:29:02', '-', 5, 0),
(308, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 94, '2018-08-29 14:10:46', '2018-08-29 14:10:46', '-', 1, 0),
(309, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 94, '2018-08-29 14:12:38', '2018-08-29 14:12:38', '-', 1, 0),
(310, 'Aviso - Cambio de tus datos en nuestros registros', '...', 94, '2018-08-29 14:17:55', '2018-08-29 14:17:55', '-', 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_portal`
--

CREATE TABLE `img_portal` (
  `idimg_portal` int(11) NOT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `path_imagen` varchar(200) DEFAULT NULL,
  `descripcion` varchar(250) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `img_portal`
--

INSERT INTO `img_portal` (`idimg_portal`, `titulo`, `path_imagen`, `descripcion`, `eliminado`, `updated_at`, `created_at`, `link`) VALUES
(1, 'Cartola Online [EDITADO]', 'img-demo1.jpg', 'descripción Cartola Online ', 0, '2016-02-29 14:50:23', '0000-00-00 00:00:00', ''),
(2, 'Herramientas Deudor y Cobrador ', 'img-demo2.jpg', 'Descripción herramientas deudr y cobrador', 0, '2016-02-28 18:49:43', '0000-00-00 00:00:00', ''),
(3, 'Evita Fraudes', 'img-demo3.jpg', 'descripción fraudes', 0, '2016-02-28 18:49:30', '0000-00-00 00:00:00', ''),
(4, 'Sistema de Informes [EDITADO]', '11-50256d3412ca3a604.29352921.jpg', 'descripción Sistema de Informes', 0, '2016-05-31 02:36:17', '0000-00-00 00:00:00', 'https://www.youtube.com/watch?v=tey3GI_le24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logaccesos`
--

CREATE TABLE `logaccesos` (
  `IDLogAcceso` int(10) UNSIGNED NOT NULL,
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `IP` varchar(46) NOT NULL COMMENT 'IPv4 IPv6',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `logaccesos`
--

INSERT INTO `logaccesos` (`IDLogAcceso`, `idUsuarios`, `IP`, `created_at`, `updated_at`) VALUES
(1, 62, '200.90.198.239', '2016-11-23 21:52:27', '2016-11-23 21:52:27'),
(2, 62, '200.28.104.82', '2016-11-28 23:07:38', '2016-11-28 23:07:38'),
(3, 62, '200.28.104.82', '2016-11-28 23:12:36', '2016-11-28 23:12:36'),
(4, 62, '200.28.104.82', '2016-11-28 23:30:58', '2016-11-28 23:30:58'),
(5, 62, '200.28.104.82', '2016-11-28 23:55:31', '2016-11-28 23:55:31'),
(6, 63, '200.28.104.82', '2016-11-29 00:25:48', '2016-11-29 00:25:48'),
(7, 62, '200.28.104.82', '2016-11-29 00:37:15', '2016-11-29 00:37:15'),
(8, 62, '200.28.104.82', '2016-11-29 00:48:53', '2016-11-29 00:48:53'),
(9, 62, '200.9.108.36', '2016-11-29 12:42:28', '2016-11-29 12:42:28'),
(10, 62, '200.9.111.36', '2016-11-29 13:21:05', '2016-11-29 13:21:05'),
(11, 63, '200.9.111.36', '2016-11-29 13:21:42', '2016-11-29 13:21:42'),
(12, 62, '200.9.111.36', '2016-11-29 13:39:50', '2016-11-29 13:39:50'),
(13, 62, '191.125.63.79', '2016-12-01 15:12:44', '2016-12-01 15:12:44'),
(14, 63, '191.125.63.79', '2016-12-01 15:22:22', '2016-12-01 15:22:22'),
(15, 63, '191.125.63.79', '2016-12-01 15:27:31', '2016-12-01 15:27:31'),
(16, 64, '190.208.245.201', '2016-12-01 23:34:36', '2016-12-01 23:34:36'),
(17, 62, '186.156.206.83', '2016-12-03 10:31:02', '2016-12-03 10:31:02'),
(18, 65, '201.214.76.241', '2016-12-05 21:16:47', '2016-12-05 21:16:47'),
(19, 65, '201.214.76.241', '2016-12-05 21:21:46', '2016-12-05 21:21:46'),
(20, 65, '201.214.76.241', '2016-12-05 21:30:17', '2016-12-05 21:30:17'),
(21, 65, '201.214.76.241', '2016-12-05 21:30:37', '2016-12-05 21:30:37'),
(22, 65, '201.214.76.241', '2016-12-05 21:31:19', '2016-12-05 21:31:19'),
(23, 65, '201.214.76.241', '2016-12-05 21:35:35', '2016-12-05 21:35:35'),
(24, 66, '191.115.246.60', '2016-12-07 16:26:00', '2016-12-07 16:26:00'),
(25, 66, '191.115.246.60', '2016-12-07 16:32:14', '2016-12-07 16:32:14'),
(26, 64, '190.208.245.201', '2016-12-07 20:46:11', '2016-12-07 20:46:11'),
(27, 64, '190.208.245.201', '2016-12-07 20:58:56', '2016-12-07 20:58:56'),
(28, 64, '190.208.245.201', '2016-12-07 21:07:18', '2016-12-07 21:07:18'),
(29, 62, '200.28.110.254', '2016-12-07 21:13:10', '2016-12-07 21:13:10'),
(30, 62, '200.28.110.254', '2016-12-07 21:24:35', '2016-12-07 21:24:35'),
(31, 62, '200.28.110.254', '2016-12-07 21:35:14', '2016-12-07 21:35:14'),
(32, 66, '191.115.61.105', '2016-12-08 17:50:26', '2016-12-08 17:50:26'),
(33, 67, '190.100.255.12', '2016-12-12 00:25:37', '2016-12-12 00:25:37'),
(34, 66, '191.115.95.173', '2016-12-12 16:06:55', '2016-12-12 16:06:55'),
(35, 64, '191.115.95.173', '2016-12-12 17:41:54', '2016-12-12 17:41:54'),
(36, 64, '190.8.79.154', '2016-12-12 19:27:35', '2016-12-12 19:27:35'),
(37, 64, '190.8.79.154', '2016-12-12 20:10:47', '2016-12-12 20:10:47'),
(38, 65, '201.214.76.241', '2016-12-17 12:16:27', '2016-12-17 12:16:27'),
(39, 65, '201.214.76.241', '2016-12-17 12:21:14', '2016-12-17 12:21:14'),
(40, 68, '190.20.254.229', '2016-12-20 19:34:25', '2016-12-20 19:34:25'),
(41, 68, '190.20.254.229', '2016-12-20 19:38:08', '2016-12-20 19:38:08'),
(42, 69, '190.20.254.229', '2016-12-20 19:45:00', '2016-12-20 19:45:00'),
(43, 65, '201.214.76.241', '2016-12-20 22:02:12', '2016-12-20 22:02:12'),
(44, 62, '200.9.111.36', '2016-12-21 12:22:41', '2016-12-21 12:22:41'),
(45, 62, '190.20.21.36', '2017-01-14 00:51:46', '2017-01-14 00:51:46'),
(46, 62, '190.20.21.36', '2017-01-14 02:20:27', '2017-01-14 02:20:27'),
(47, 62, '190.20.21.36', '2017-01-14 02:58:50', '2017-01-14 02:58:50'),
(48, 62, '190.20.108.205', '2017-01-15 22:57:42', '2017-01-15 22:57:42'),
(49, 62, '190.20.108.205', '2017-01-15 23:10:26', '2017-01-15 23:10:26'),
(50, 62, '190.20.108.205', '2017-01-15 23:14:13', '2017-01-15 23:14:13'),
(51, 69, '190.20.163.109', '2017-01-16 19:10:30', '2017-01-16 19:10:30'),
(52, 68, '190.20.163.109', '2017-01-16 19:11:22', '2017-01-16 19:11:22'),
(53, 62, '190.20.23.4', '2017-01-16 23:07:37', '2017-01-16 23:07:37'),
(54, 69, '186.9.134.47', '2017-01-17 10:31:35', '2017-01-17 10:31:35'),
(55, 62, '200.9.111.36', '2017-01-17 10:41:32', '2017-01-17 10:41:32'),
(56, 62, '200.9.108.36', '2017-01-17 16:28:05', '2017-01-17 16:28:05'),
(57, 70, '190.20.156.194', '2017-01-19 13:17:46', '2017-01-19 13:17:46'),
(58, 69, '190.20.156.194', '2017-01-19 13:22:51', '2017-01-19 13:22:51'),
(59, 70, '190.20.156.194', '2017-01-19 13:35:23', '2017-01-19 13:35:23'),
(60, 69, '190.20.156.194', '2017-01-19 13:37:39', '2017-01-19 13:37:39'),
(61, 69, '190.20.156.194', '2017-01-19 15:17:39', '2017-01-19 15:17:39'),
(62, 69, '190.20.156.194', '2017-01-19 15:18:42', '2017-01-19 15:18:42'),
(63, 69, '186.9.135.250', '2017-01-19 15:25:43', '2017-01-19 15:25:43'),
(64, 69, '201.214.76.241', '2017-01-19 22:41:09', '2017-01-19 22:41:09'),
(65, 69, '186.9.133.155', '2017-01-19 22:51:50', '2017-01-19 22:51:50'),
(66, 69, '186.9.133.155', '2017-01-19 22:56:52', '2017-01-19 22:56:52'),
(67, 69, '190.20.99.218', '2017-01-20 16:21:29', '2017-01-20 16:21:29'),
(68, 70, '190.20.99.218', '2017-01-20 16:25:35', '2017-01-20 16:25:35'),
(69, 69, '190.20.99.218', '2017-01-20 16:41:00', '2017-01-20 16:41:00'),
(70, 69, '190.20.99.218', '2017-01-20 17:14:43', '2017-01-20 17:14:43'),
(71, 69, '186.34.40.168', '2017-01-20 23:42:21', '2017-01-20 23:42:21'),
(72, 69, '186.34.40.168', '2017-01-20 23:53:19', '2017-01-20 23:53:19'),
(73, 70, '186.34.40.168', '2017-01-21 00:06:35', '2017-01-21 00:06:35'),
(74, 69, '190.20.93.246', '2017-01-23 15:27:27', '2017-01-23 15:27:27'),
(75, 70, '190.20.93.246', '2017-01-23 15:34:45', '2017-01-23 15:34:45'),
(76, 69, '190.20.93.246', '2017-01-23 16:57:04', '2017-01-23 16:57:04'),
(77, 69, '186.9.135.185', '2017-01-23 22:46:46', '2017-01-23 22:46:46'),
(78, 65, '201.214.76.241', '2017-01-25 21:43:32', '2017-01-25 21:43:32'),
(79, 65, '201.214.76.241', '2017-01-25 21:52:28', '2017-01-25 21:52:28'),
(80, 65, '201.214.76.241', '2017-01-25 21:53:39', '2017-01-25 21:53:39'),
(81, 69, '190.20.183.139', '2017-01-26 11:55:19', '2017-01-26 11:55:19'),
(82, 68, '190.20.183.139', '2017-01-26 12:10:30', '2017-01-26 12:10:30'),
(83, 68, '190.20.183.139', '2017-01-26 12:15:52', '2017-01-26 12:15:52'),
(84, 69, '190.20.183.139', '2017-01-26 12:17:55', '2017-01-26 12:17:55'),
(85, 70, '190.20.183.139', '2017-01-26 12:18:52', '2017-01-26 12:18:52'),
(86, 68, '190.20.183.139', '2017-01-26 12:24:36', '2017-01-26 12:24:36'),
(87, 69, '190.20.183.139', '2017-01-26 12:28:05', '2017-01-26 12:28:05'),
(88, 68, '190.20.183.139', '2017-01-26 12:36:26', '2017-01-26 12:36:26'),
(89, 69, '190.20.183.139', '2017-01-26 12:36:45', '2017-01-26 12:36:45'),
(90, 69, '190.20.183.139', '2017-01-26 13:21:54', '2017-01-26 13:21:54'),
(91, 68, '190.20.183.139', '2017-01-26 13:24:43', '2017-01-26 13:24:43'),
(92, 68, '190.20.183.139', '2017-01-26 15:15:56', '2017-01-26 15:15:56'),
(93, 69, '190.20.183.139', '2017-01-26 15:16:15', '2017-01-26 15:16:15'),
(94, 68, '190.20.183.139', '2017-01-26 15:22:21', '2017-01-26 15:22:21'),
(95, 70, '190.20.183.139', '2017-01-26 15:25:26', '2017-01-26 15:25:26'),
(96, 69, '190.20.183.139', '2017-01-26 15:52:07', '2017-01-26 15:52:07'),
(97, 69, '190.20.183.139', '2017-01-26 17:16:34', '2017-01-26 17:16:34'),
(98, 69, '190.20.183.139', '2017-01-26 17:38:04', '2017-01-26 17:38:04'),
(99, 62, '190.20.71.242', '2017-01-26 21:30:23', '2017-01-26 21:30:23'),
(100, 65, '201.214.76.241', '2017-01-29 18:06:26', '2017-01-29 18:06:26'),
(101, 64, '190.208.245.201', '2017-01-31 17:13:54', '2017-01-31 17:13:54'),
(102, 64, '190.208.245.201', '2017-01-31 18:13:30', '2017-01-31 18:13:30'),
(103, 62, '186.156.196.172', '2017-01-31 20:21:57', '2017-01-31 20:21:57'),
(104, 69, '186.34.40.168', '2017-02-01 16:30:06', '2017-02-01 16:30:06'),
(105, 70, '186.34.40.168', '2017-02-01 16:31:40', '2017-02-01 16:31:40'),
(106, 69, '186.34.40.168', '2017-02-01 16:33:24', '2017-02-01 16:33:24'),
(107, 65, '201.214.142.217', '2017-02-01 20:25:48', '2017-02-01 20:25:48'),
(108, 65, '201.214.142.217', '2017-02-01 20:51:41', '2017-02-01 20:51:41'),
(109, 65, '201.214.142.217', '2017-02-01 21:04:19', '2017-02-01 21:04:19'),
(110, 65, '201.214.142.217', '2017-02-01 21:23:46', '2017-02-01 21:23:46'),
(111, 69, '190.20.92.184', '2017-02-02 15:15:56', '2017-02-02 15:15:56'),
(112, 69, '190.20.92.184', '2017-02-02 15:28:50', '2017-02-02 15:28:50'),
(113, 70, '190.20.92.184', '2017-02-02 15:34:07', '2017-02-02 15:34:07'),
(114, 69, '190.20.92.184', '2017-02-02 15:34:45', '2017-02-02 15:34:45'),
(115, 69, '190.20.92.184', '2017-02-02 16:23:03', '2017-02-02 16:23:03'),
(116, 73, '181.42.9.41', '2017-02-02 19:51:27', '2017-02-02 19:51:27'),
(117, 65, '201.214.142.217', '2017-02-02 20:09:54', '2017-02-02 20:09:54'),
(118, 65, '201.214.142.217', '2017-02-02 20:24:15', '2017-02-02 20:24:15'),
(119, 69, '190.20.249.136', '2017-02-03 13:26:51', '2017-02-03 13:26:51'),
(120, 69, '190.20.249.136', '2017-02-03 13:32:57', '2017-02-03 13:32:57'),
(121, 69, '190.20.249.136', '2017-02-03 16:26:34', '2017-02-03 16:26:34'),
(122, 70, '191.114.245.113', '2017-02-03 16:30:39', '2017-02-03 16:30:39'),
(123, 69, '190.20.249.136', '2017-02-03 17:02:54', '2017-02-03 17:02:54'),
(124, 70, '190.20.249.136', '2017-02-03 17:04:08', '2017-02-03 17:04:08'),
(125, 70, '190.20.249.136', '2017-02-03 17:05:08', '2017-02-03 17:05:08'),
(126, 69, '190.20.249.136', '2017-02-03 17:14:43', '2017-02-03 17:14:43'),
(127, 70, '190.20.249.136', '2017-02-03 17:16:35', '2017-02-03 17:16:35'),
(128, 70, '190.20.249.136', '2017-02-03 17:17:50', '2017-02-03 17:17:50'),
(129, 69, '190.20.249.136', '2017-02-03 17:43:11', '2017-02-03 17:43:11'),
(130, 69, '190.20.249.136', '2017-02-03 17:49:38', '2017-02-03 17:49:38'),
(131, 69, '190.20.249.136', '2017-02-03 17:52:31', '2017-02-03 17:52:31'),
(132, 65, '201.214.142.217', '2017-02-10 12:22:11', '2017-02-10 12:22:11'),
(133, 69, '190.20.77.104', '2017-02-10 12:31:29', '2017-02-10 12:31:29'),
(134, 69, '190.20.77.104', '2017-02-10 12:36:55', '2017-02-10 12:36:55'),
(135, 68, '190.20.77.104', '2017-02-10 12:37:56', '2017-02-10 12:37:56'),
(136, 69, '190.20.77.104', '2017-02-10 12:42:33', '2017-02-10 12:42:33'),
(137, 65, '201.214.142.217', '2017-02-13 10:17:38', '2017-02-13 10:17:38'),
(138, 65, '201.214.142.217', '2017-02-13 10:19:17', '2017-02-13 10:19:17'),
(139, 68, '190.20.88.64', '2017-02-13 15:28:05', '2017-02-13 15:28:05'),
(140, 62, '200.9.108.36', '2017-02-14 17:36:08', '2017-02-14 17:36:08'),
(141, 62, '200.9.108.36', '2017-02-14 17:53:38', '2017-02-14 17:53:38'),
(142, 62, '200.9.108.36', '2017-02-14 17:59:13', '2017-02-14 17:59:13'),
(143, 62, '200.9.108.36', '2017-02-14 18:04:58', '2017-02-14 18:04:58'),
(144, 68, '190.20.250.85', '2017-02-14 18:08:52', '2017-02-14 18:08:52'),
(145, 68, '190.20.250.85', '2017-02-14 18:15:40', '2017-02-14 18:15:40'),
(146, 68, '190.20.250.85', '2017-02-14 18:40:13', '2017-02-14 18:40:13'),
(147, 62, '107.167.112.147', '2017-02-18 12:56:31', '2017-02-18 12:56:31'),
(148, 62, '186.156.141.210', '2017-02-20 14:24:17', '2017-02-20 14:24:17'),
(149, 69, '190.20.247.0', '2017-02-20 15:38:03', '2017-02-20 15:38:03'),
(150, 69, '190.20.247.0', '2017-02-20 16:24:03', '2017-02-20 16:24:03'),
(151, 68, '190.20.247.0', '2017-02-20 16:25:26', '2017-02-20 16:25:26'),
(152, 69, '190.20.247.0', '2017-02-20 16:30:55', '2017-02-20 16:30:55'),
(153, 62, '190.20.126.2', '2017-02-21 22:01:10', '2017-02-21 22:01:10'),
(154, 68, '186.79.96.93', '2017-02-21 23:04:18', '2017-02-21 23:04:18'),
(155, 68, '186.79.96.93', '2017-02-21 23:25:18', '2017-02-21 23:25:18'),
(156, 69, '186.79.96.93', '2017-02-21 23:28:45', '2017-02-21 23:28:45'),
(157, 69, '186.79.96.93', '2017-02-21 23:35:04', '2017-02-21 23:35:04'),
(158, 69, '190.20.91.204', '2017-02-22 15:08:09', '2017-02-22 15:08:09'),
(159, 68, '190.20.91.204', '2017-02-22 15:13:08', '2017-02-22 15:13:08'),
(160, 68, '190.20.91.204', '2017-02-22 15:27:38', '2017-02-22 15:27:38'),
(161, 68, '190.20.91.204', '2017-02-22 15:29:52', '2017-02-22 15:29:52'),
(162, 70, '190.20.91.204', '2017-02-22 15:31:15', '2017-02-22 15:31:15'),
(163, 69, '190.20.91.204', '2017-02-22 15:34:24', '2017-02-22 15:34:24'),
(164, 68, '190.20.91.204', '2017-02-22 15:35:28', '2017-02-22 15:35:28'),
(165, 68, '190.20.91.204', '2017-02-22 15:46:15', '2017-02-22 15:46:15'),
(166, 69, '190.20.91.204', '2017-02-22 16:26:54', '2017-02-22 16:26:54'),
(167, 74, '190.20.91.204', '2017-02-22 16:32:30', '2017-02-22 16:32:30'),
(168, 74, '190.20.91.204', '2017-02-22 18:35:39', '2017-02-22 18:35:39'),
(169, 69, '190.20.91.204', '2017-02-22 18:38:37', '2017-02-22 18:38:37'),
(170, 62, '131.0.54.116', '2017-02-24 14:19:33', '2017-02-24 14:19:33'),
(171, 62, '131.0.54.116', '2017-02-24 14:24:41', '2017-02-24 14:24:41'),
(172, 65, '200.68.8.142', '2017-02-24 14:54:56', '2017-02-24 14:54:56'),
(173, 62, '186.156.198.124', '2017-02-24 16:02:57', '2017-02-24 16:02:57'),
(174, 69, '186.156.198.124', '2017-02-24 16:03:31', '2017-02-24 16:03:31'),
(175, 62, '190.20.13.200', '2017-02-24 16:04:10', '2017-02-24 16:04:10'),
(176, 70, '190.20.13.200', '2017-02-24 16:09:34', '2017-02-24 16:09:34'),
(177, 69, '190.20.13.200', '2017-02-24 16:10:19', '2017-02-24 16:10:19'),
(178, 68, '190.20.13.200', '2017-02-24 16:17:27', '2017-02-24 16:17:27'),
(179, 62, '190.20.13.200', '2017-02-24 16:18:03', '2017-02-24 16:18:03'),
(180, 69, '190.20.13.200', '2017-02-24 16:23:53', '2017-02-24 16:23:53'),
(181, 68, '190.20.13.200', '2017-02-24 16:36:47', '2017-02-24 16:36:47'),
(182, 72, '190.20.13.200', '2017-02-24 16:37:20', '2017-02-24 16:37:20'),
(183, 69, '190.20.13.200', '2017-02-24 16:55:22', '2017-02-24 16:55:22'),
(184, 62, '107.167.112.147', '2017-02-24 19:14:06', '2017-02-24 19:14:06'),
(185, 62, '200.9.108.36', '2017-03-01 12:58:23', '2017-03-01 12:58:23'),
(186, 62, '186.156.198.77', '2017-03-01 13:20:07', '2017-03-01 13:20:07'),
(187, 62, '200.9.108.36', '2017-03-01 13:31:13', '2017-03-01 13:31:13'),
(188, 69, '131.0.54.116', '2017-03-01 13:44:47', '2017-03-01 13:44:47'),
(189, 69, '190.20.124.163', '2017-03-01 18:51:14', '2017-03-01 18:51:14'),
(190, 62, '190.20.124.163', '2017-03-01 18:58:21', '2017-03-01 18:58:21'),
(191, 69, '190.20.124.163', '2017-03-01 18:59:32', '2017-03-01 18:59:32'),
(192, 62, '190.20.124.163', '2017-03-01 19:06:39', '2017-03-01 19:06:39'),
(193, 62, '191.125.28.24', '2017-03-02 14:25:31', '2017-03-02 14:25:31'),
(194, 62, '191.125.28.24', '2017-03-02 14:25:57', '2017-03-02 14:25:57'),
(195, 62, '191.125.28.24', '2017-03-02 14:26:56', '2017-03-02 14:26:56'),
(196, 69, '190.20.104.32', '2017-03-02 21:43:30', '2017-03-02 21:43:30'),
(197, 69, '190.20.104.32', '2017-03-02 23:51:40', '2017-03-02 23:51:40'),
(198, 69, '190.20.104.32', '2017-03-02 23:59:31', '2017-03-02 23:59:31'),
(199, 69, '190.20.104.32', '2017-03-03 00:10:40', '2017-03-03 00:10:40'),
(200, 69, '190.20.104.32', '2017-03-03 00:27:25', '2017-03-03 00:27:25'),
(201, 69, '190.20.104.32', '2017-03-03 00:28:32', '2017-03-03 00:28:32'),
(202, 69, '190.20.104.32', '2017-03-03 00:31:35', '2017-03-03 00:31:35'),
(203, 69, '190.20.104.32', '2017-03-03 00:38:06', '2017-03-03 00:38:06'),
(204, 69, '190.20.104.32', '2017-03-03 00:41:08', '2017-03-03 00:41:08'),
(205, 62, '190.20.104.32', '2017-03-03 00:47:18', '2017-03-03 00:47:18'),
(206, 62, '131.0.54.116', '2017-03-03 14:53:48', '2017-03-03 14:53:48'),
(207, 75, '190.20.104.32', '2017-03-03 20:52:15', '2017-03-03 20:52:15'),
(208, 62, '190.20.104.32', '2017-03-03 20:54:05', '2017-03-03 20:54:05'),
(209, 76, '191.125.185.212', '2017-03-04 14:54:28', '2017-03-04 14:54:28'),
(210, 76, '191.125.185.212', '2017-03-04 15:33:30', '2017-03-04 15:33:30'),
(211, 76, '191.125.185.212', '2017-03-04 18:30:06', '2017-03-04 18:30:06'),
(212, 62, '190.20.25.72', '2017-03-04 20:58:07', '2017-03-04 20:58:07'),
(213, 62, '190.20.25.72', '2017-03-04 22:09:34', '2017-03-04 22:09:34'),
(214, 76, '191.125.177.20', '2017-03-05 11:28:07', '2017-03-05 11:28:07'),
(215, 76, '179.0.2.1', '2017-03-06 13:28:04', '2017-03-06 13:28:04'),
(216, 76, '179.0.2.1', '2017-03-06 13:28:17', '2017-03-06 13:28:17'),
(217, 76, '179.0.2.1', '2017-03-06 13:31:36', '2017-03-06 13:31:36'),
(218, 77, '191.119.51.91', '2017-03-07 13:01:14', '2017-03-07 13:01:14'),
(219, 77, '200.9.108.36', '2017-03-07 13:02:36', '2017-03-07 13:02:36'),
(220, 76, '179.0.2.1', '2017-03-08 09:49:11', '2017-03-08 09:49:11'),
(221, 62, '190.20.7.226', '2017-03-08 14:48:52', '2017-03-08 14:48:52'),
(222, 69, '190.20.49.120', '2017-03-08 18:02:26', '2017-03-08 18:02:26'),
(223, 69, '190.20.49.120', '2017-03-08 18:25:53', '2017-03-08 18:25:53'),
(224, 69, '190.20.49.120', '2017-03-08 18:41:18', '2017-03-08 18:41:18'),
(225, 77, '200.9.108.36', '2017-03-09 13:23:40', '2017-03-09 13:23:40'),
(226, 69, '190.20.245.107', '2017-03-09 15:36:14', '2017-03-09 15:36:14'),
(227, 77, '131.0.54.116', '2017-03-09 15:49:35', '2017-03-09 15:49:35'),
(228, 77, '131.0.54.116', '2017-03-09 15:50:01', '2017-03-09 15:50:01'),
(229, 69, '190.216.150.38', '2017-03-10 12:50:31', '2017-03-10 12:50:31'),
(230, 78, '190.20.100.188', '2017-03-10 21:59:52', '2017-03-10 21:59:52'),
(231, 62, '190.20.100.188', '2017-03-10 22:07:25', '2017-03-10 22:07:25'),
(232, 78, '190.20.100.188', '2017-03-10 22:13:14', '2017-03-10 22:13:14'),
(233, 62, '190.20.100.188', '2017-03-10 22:14:04', '2017-03-10 22:14:04'),
(234, 62, '190.20.100.188', '2017-03-10 22:16:44', '2017-03-10 22:16:44'),
(235, 62, '190.20.100.188', '2017-03-10 22:52:30', '2017-03-10 22:52:30'),
(236, 62, '186.156.207.98', '2017-03-12 13:44:13', '2017-03-12 13:44:13'),
(237, 65, '201.214.142.217', '2017-03-12 15:08:15', '2017-03-12 15:08:15'),
(238, 62, '186.156.193.145', '2017-03-16 12:49:06', '2017-03-16 12:49:06'),
(239, 62, '200.9.111.36', '2017-03-16 12:49:45', '2017-03-16 12:49:45'),
(240, 62, '200.9.111.36', '2017-03-16 13:08:28', '2017-03-16 13:08:28'),
(241, 62, '200.9.111.36', '2017-03-16 13:08:31', '2017-03-16 13:08:31'),
(242, 62, '200.9.108.36', '2017-03-16 13:35:03', '2017-03-16 13:35:03'),
(243, 69, '200.9.111.36', '2017-03-16 13:49:13', '2017-03-16 13:49:13'),
(244, 62, '200.9.111.36', '2017-03-16 15:09:23', '2017-03-16 15:09:23'),
(245, 69, '200.9.111.36', '2017-03-16 15:13:25', '2017-03-16 15:13:25'),
(246, 62, '200.9.111.36', '2017-03-16 15:15:45', '2017-03-16 15:15:45'),
(247, 69, '200.9.111.36', '2017-03-16 15:57:03', '2017-03-16 15:57:03'),
(248, 69, '200.9.111.36', '2017-03-16 15:57:25', '2017-03-16 15:57:25'),
(249, 80, '131.0.54.116', '2017-03-16 18:25:29', '2017-03-16 18:25:29'),
(250, 62, '131.0.54.116', '2017-03-16 18:29:43', '2017-03-16 18:29:43'),
(251, 62, '200.9.111.36', '2017-03-16 18:51:05', '2017-03-16 18:51:05'),
(252, 79, '200.9.111.36', '2017-03-16 18:58:03', '2017-03-16 18:58:03'),
(253, 62, '200.9.111.36', '2017-03-16 18:59:49', '2017-03-16 18:59:49'),
(254, 62, '200.9.111.36', '2017-03-16 19:08:48', '2017-03-16 19:08:48'),
(255, 69, '131.0.54.116', '2017-03-17 16:30:45', '2017-03-17 16:30:45'),
(256, 81, '131.0.54.116', '2017-03-17 16:37:02', '2017-03-17 16:37:02'),
(257, 62, '131.0.54.116', '2017-03-17 16:40:08', '2017-03-17 16:40:08'),
(258, 62, '200.9.111.36', '2017-03-17 16:47:01', '2017-03-17 16:47:01'),
(259, 62, '186.156.132.210', '2017-03-18 02:34:14', '2017-03-18 02:34:14'),
(260, 62, '186.156.132.210', '2017-03-18 02:35:07', '2017-03-18 02:35:07'),
(261, 69, '190.20.214.87', '2017-03-20 10:47:11', '2017-03-20 10:47:11'),
(262, 62, '131.0.54.116', '2017-03-20 10:54:03', '2017-03-20 10:54:03'),
(263, 62, '200.9.111.36', '2017-03-21 13:22:25', '2017-03-21 13:22:25'),
(264, 80, '200.9.111.36', '2017-03-21 13:23:16', '2017-03-21 13:23:16'),
(265, 62, '131.0.54.116', '2017-03-21 13:28:08', '2017-03-21 13:28:08'),
(266, 62, '186.156.132.74', '2017-03-21 13:35:18', '2017-03-21 13:35:18'),
(267, 62, '200.9.111.36', '2017-03-21 13:37:47', '2017-03-21 13:37:47'),
(268, 80, '200.9.111.36', '2017-03-21 13:43:51', '2017-03-21 13:43:51'),
(269, 62, '200.9.111.36', '2017-03-21 13:46:06', '2017-03-21 13:46:06'),
(270, 80, '200.9.111.36', '2017-03-21 13:46:36', '2017-03-21 13:46:36'),
(271, 62, '200.9.111.36', '2017-03-21 13:48:22', '2017-03-21 13:48:22'),
(272, 80, '200.9.111.36', '2017-03-21 13:53:13', '2017-03-21 13:53:13'),
(273, 62, '200.9.111.36', '2017-03-21 13:56:52', '2017-03-21 13:56:52'),
(274, 69, '190.20.100.223', '2017-03-21 19:57:14', '2017-03-21 19:57:14'),
(275, 70, '190.20.100.223', '2017-03-21 20:01:43', '2017-03-21 20:01:43'),
(276, 69, '190.20.100.223', '2017-03-21 20:11:02', '2017-03-21 20:11:02'),
(277, 69, '190.20.100.223', '2017-03-21 20:36:24', '2017-03-21 20:36:24'),
(278, 62, '131.0.54.116', '2017-03-22 11:59:02', '2017-03-22 11:59:02'),
(279, 62, '131.0.54.116', '2017-03-22 12:02:32', '2017-03-22 12:02:32'),
(280, 62, '131.0.54.116', '2017-03-22 12:17:03', '2017-03-22 12:17:03'),
(281, 80, '131.0.54.116', '2017-03-22 12:20:07', '2017-03-22 12:20:07'),
(282, 62, '131.0.54.116', '2017-03-22 12:26:03', '2017-03-22 12:26:03'),
(283, 62, '200.9.111.36', '2017-03-22 12:33:09', '2017-03-22 12:33:09'),
(284, 62, '131.0.54.116', '2017-03-22 13:01:16', '2017-03-22 13:01:16'),
(285, 62, '200.9.111.36', '2017-03-22 13:13:14', '2017-03-22 13:13:14'),
(286, 62, '200.9.111.36', '2017-03-22 16:01:53', '2017-03-22 16:01:53'),
(287, 62, '200.9.111.36', '2017-03-22 16:08:27', '2017-03-22 16:08:27'),
(288, 62, '200.9.111.36', '2017-03-22 16:11:04', '2017-03-22 16:11:04'),
(289, 62, '200.9.111.36', '2017-03-22 16:22:31', '2017-03-22 16:22:31'),
(290, 62, '200.9.108.36', '2017-03-23 11:44:44', '2017-03-23 11:44:44'),
(291, 65, '201.214.142.217', '2017-03-23 21:05:51', '2017-03-23 21:05:51'),
(292, 62, '200.9.108.36', '2017-03-27 16:49:33', '2017-03-27 16:49:33'),
(293, 62, '200.9.108.36', '2017-03-27 16:55:09', '2017-03-27 16:55:09'),
(294, 80, '200.9.108.36', '2017-03-27 16:58:59', '2017-03-27 16:58:59'),
(295, 62, '200.9.108.36', '2017-03-27 17:01:33', '2017-03-27 17:01:33'),
(296, 69, '190.20.43.197', '2017-03-27 18:12:37', '2017-03-27 18:12:37'),
(297, 69, '190.20.43.197', '2017-03-27 18:12:50', '2017-03-27 18:12:50'),
(298, 69, '190.20.43.197', '2017-03-27 18:18:56', '2017-03-27 18:18:56'),
(299, 69, '190.20.43.197', '2017-03-27 18:51:20', '2017-03-27 18:51:20'),
(300, 69, '190.20.43.197', '2017-03-27 19:06:25', '2017-03-27 19:06:25'),
(301, 62, '186.156.131.94', '2017-03-27 20:35:43', '2017-03-27 20:35:43'),
(302, 82, '190.44.157.40', '2017-03-27 21:59:21', '2017-03-27 21:59:21'),
(303, 80, '200.9.108.36', '2017-03-28 13:33:06', '2017-03-28 13:33:06'),
(304, 77, '200.9.108.36', '2017-03-28 13:37:57', '2017-03-28 13:37:57'),
(305, 77, '200.9.108.36', '2017-03-28 13:43:32', '2017-03-28 13:43:32'),
(306, 65, '201.214.142.217', '2017-03-28 21:38:09', '2017-03-28 21:38:09'),
(307, 65, '201.214.142.217', '2017-03-28 21:43:14', '2017-03-28 21:43:14'),
(308, 65, '201.214.142.217', '2017-03-28 21:51:31', '2017-03-28 21:51:31'),
(309, 82, '191.126.153.205', '2017-03-30 12:14:03', '2017-03-30 12:14:03'),
(310, 65, '201.214.142.217', '2017-03-30 18:54:46', '2017-03-30 18:54:46'),
(311, 69, '190.20.245.38', '2017-03-30 18:59:59', '2017-03-30 18:59:59'),
(312, 65, '201.214.142.217', '2017-03-30 20:50:23', '2017-03-30 20:50:23'),
(313, 65, '201.214.142.217', '2017-03-30 21:12:33', '2017-03-30 21:12:33'),
(314, 62, '190.20.241.68', '2017-03-30 21:18:06', '2017-03-30 21:18:06'),
(315, 62, '190.20.241.68', '2017-03-30 21:38:31', '2017-03-30 21:38:31'),
(316, 69, '190.20.245.38', '2017-03-31 10:45:57', '2017-03-31 10:45:57'),
(317, 82, '190.44.157.40', '2017-03-31 15:11:18', '2017-03-31 15:11:18'),
(318, 82, '190.44.157.40', '2017-03-31 15:33:14', '2017-03-31 15:33:14'),
(319, 65, '201.214.142.217', '2017-04-01 12:58:39', '2017-04-01 12:58:39'),
(320, 65, '201.214.142.217', '2017-04-02 11:42:07', '2017-04-02 11:42:07'),
(321, 62, '190.20.216.164', '2017-04-03 20:29:50', '2017-04-03 20:29:50'),
(322, 62, '190.20.216.164', '2017-04-03 20:30:42', '2017-04-03 20:30:42'),
(323, 62, '190.20.216.164', '2017-04-03 20:32:44', '2017-04-03 20:32:44'),
(324, 62, '200.9.111.36', '2017-04-04 10:17:53', '2017-04-04 10:17:53'),
(325, 62, '200.9.108.36', '2017-04-04 10:23:27', '2017-04-04 10:23:27'),
(326, 62, '200.9.111.36', '2017-04-04 11:37:32', '2017-04-04 11:37:32'),
(327, 62, '200.9.111.36', '2017-04-04 11:45:31', '2017-04-04 11:45:31'),
(328, 62, '200.9.108.36', '2017-04-04 12:00:43', '2017-04-04 12:00:43'),
(329, 69, '200.9.111.36', '2017-04-04 12:36:05', '2017-04-04 12:36:05'),
(330, 62, '200.9.111.36', '2017-04-04 19:10:58', '2017-04-04 19:10:58'),
(331, 62, '200.9.111.36', '2017-04-04 19:30:11', '2017-04-04 19:30:11'),
(332, 69, '200.9.111.36', '2017-04-05 13:26:04', '2017-04-05 13:26:04'),
(333, 62, '200.9.111.36', '2017-04-11 12:25:22', '2017-04-11 12:25:22'),
(334, 69, '190.20.185.12', '2017-04-11 12:32:55', '2017-04-11 12:32:55'),
(335, 69, '190.20.185.12', '2017-04-11 13:16:31', '2017-04-11 13:16:31'),
(336, 62, '200.9.111.36', '2017-04-11 15:31:40', '2017-04-11 15:31:40'),
(337, 69, '190.20.67.21', '2017-04-11 17:56:17', '2017-04-11 17:56:17'),
(338, 62, '191.126.185.211', '2017-04-11 19:50:27', '2017-04-11 19:50:27'),
(339, 69, '190.20.67.21', '2017-04-12 18:36:32', '2017-04-12 18:36:32'),
(340, 68, '190.20.67.21', '2017-04-12 18:38:30', '2017-04-12 18:38:30'),
(341, 62, '190.20.67.21', '2017-04-12 18:39:00', '2017-04-12 18:39:00'),
(342, 69, '190.20.67.21', '2017-04-12 19:09:39', '2017-04-12 19:09:39'),
(343, 69, '190.20.67.21', '2017-04-12 19:11:13', '2017-04-12 19:11:13'),
(344, 69, '190.20.67.21', '2017-04-12 19:20:53', '2017-04-12 19:20:53'),
(345, 69, '190.20.67.21', '2017-04-12 19:26:57', '2017-04-12 19:26:57'),
(346, 84, '196.23.154.84', '2017-04-17 10:35:20', '2017-04-17 10:35:20'),
(347, 62, '200.9.108.36', '2017-04-24 09:20:19', '2017-04-24 09:20:19'),
(348, 69, '190.20.15.108', '2017-04-28 19:57:15', '2017-04-28 19:57:15'),
(349, 65, '201.214.142.217', '2017-05-04 20:36:27', '2017-05-04 20:36:27'),
(350, 85, '190.20.66.157', '2017-06-21 19:03:02', '2017-06-21 19:03:02'),
(351, 86, '190.20.66.157', '2017-06-21 19:10:27', '2017-06-21 19:10:27'),
(352, 85, '190.20.66.157', '2017-06-21 19:12:34', '2017-06-21 19:12:34'),
(353, 80, '131.0.54.116', '2017-06-27 12:48:18', '2017-06-27 12:48:18'),
(354, 62, '131.0.54.116', '2017-06-27 12:51:04', '2017-06-27 12:51:04'),
(355, 62, '190.8.79.154', '2017-06-28 21:06:51', '2017-06-28 21:06:51'),
(356, 80, '190.8.79.154', '2017-06-28 21:30:48', '2017-06-28 21:30:48'),
(357, 75, '190.8.79.154', '2017-06-28 21:31:42', '2017-06-28 21:31:42'),
(358, 62, '190.8.79.154', '2017-06-28 21:34:14', '2017-06-28 21:34:14'),
(359, 62, '190.8.79.154', '2017-06-28 21:39:46', '2017-06-28 21:39:46'),
(360, 85, '190.20.237.83', '2017-07-03 10:45:00', '2017-07-03 10:45:00'),
(361, 87, '190.20.156.145', '2017-07-05 13:58:24', '2017-07-05 13:58:24'),
(362, 88, '200.54.98.20', '2017-07-06 18:37:09', '2017-07-06 18:37:09'),
(363, 88, '200.75.9.66', '2017-07-18 19:30:25', '2017-07-18 19:30:25'),
(364, 89, '190.20.56.50', '2017-07-22 04:21:34', '2017-07-22 04:21:34'),
(365, 89, '190.20.56.50', '2017-07-22 04:25:40', '2017-07-22 04:25:40'),
(366, 90, '190.100.41.217', '2017-07-23 18:05:41', '2017-07-23 18:05:41'),
(367, 87, '181.161.243.94', '2017-07-26 10:02:10', '2017-07-26 10:02:10'),
(368, 87, '181.161.243.94', '2017-07-26 20:43:03', '2017-07-26 20:43:03'),
(369, 87, '181.161.243.94', '2017-07-26 20:51:49', '2017-07-26 20:51:49'),
(370, 87, '181.161.243.94', '2017-07-26 21:00:48', '2017-07-26 21:00:48'),
(371, 87, '181.161.243.94', '2017-07-26 21:06:33', '2017-07-26 21:06:33'),
(372, 62, '107.167.108.183', '2017-07-26 21:07:51', '2017-07-26 21:07:51'),
(373, 87, '191.126.3.204', '2017-07-27 15:47:19', '2017-07-27 15:47:19'),
(374, 87, '191.126.3.204', '2017-07-27 16:03:54', '2017-07-27 16:03:54'),
(375, 87, '191.126.3.204', '2017-07-27 16:29:19', '2017-07-27 16:29:19'),
(376, 92, '190.8.79.154', '2017-07-31 20:36:44', '2017-07-31 20:36:44'),
(377, 62, '190.8.79.154', '2017-07-31 20:40:13', '2017-07-31 20:40:13'),
(378, 93, '152.231.80.106', '2017-08-03 17:09:24', '2017-08-03 17:09:24'),
(379, 87, '201.236.131.106', '2017-08-23 09:53:04', '2017-08-23 09:53:04'),
(380, 62, '200.54.54.155', '2017-08-25 14:11:22', '2017-08-25 14:11:22'),
(381, 62, '200.54.54.155', '2017-08-25 14:16:53', '2017-08-25 14:16:53'),
(382, 94, '152.174.101.181', '2017-08-29 11:08:32', '2017-08-29 11:08:32'),
(383, 94, '152.174.101.181', '2017-08-29 11:26:09', '2017-08-29 11:26:09'),
(384, 87, '181.161.51.95', '2017-08-30 20:01:55', '2017-08-30 20:01:55'),
(385, 94, '152.174.233.174', '2017-09-01 12:49:53', '2017-09-01 12:49:53'),
(386, 94, '152.174.234.237', '2017-09-04 10:00:10', '2017-09-04 10:00:10'),
(387, 62, '191.125.20.86', '2017-09-04 19:39:23', '2017-09-04 19:39:23'),
(388, 80, '191.125.20.86', '2017-09-04 20:19:28', '2017-09-04 20:19:28'),
(389, 87, '191.125.147.229', '2017-09-07 10:49:17', '2017-09-07 10:49:17'),
(390, 87, '191.125.147.229', '2017-09-07 11:00:28', '2017-09-07 11:00:28'),
(391, 87, '191.125.147.229', '2017-09-07 11:06:37', '2017-09-07 11:06:37'),
(392, 64, '200.119.236.26', '2017-09-29 13:13:43', '2017-09-29 13:13:43'),
(393, 87, '191.125.187.112', '2017-10-06 09:51:18', '2017-10-06 09:51:18'),
(394, 87, '191.125.187.112', '2017-10-06 10:03:56', '2017-10-06 10:03:56'),
(395, 87, '191.125.55.223', '2017-10-19 19:17:43', '2017-10-19 19:17:43'),
(396, 62, '186.37.108.12', '2017-10-19 19:46:12', '2017-10-19 19:46:12'),
(397, 94, '152.174.240.76', '2017-10-24 09:55:04', '2017-10-24 09:55:04'),
(398, 62, '191.125.42.176', '2017-11-07 19:15:07', '2017-11-07 19:15:07'),
(399, 62, '200.9.111.36', '2017-11-09 13:44:44', '2017-11-09 13:44:44'),
(400, 65, '186.156.17.160', '2017-11-19 18:03:58', '2017-11-19 18:03:58'),
(401, 95, '190.196.217.226', '2017-11-23 11:55:32', '2017-11-23 11:55:32'),
(402, 62, '200.9.111.36', '2017-11-24 15:25:27', '2017-11-24 15:25:27'),
(403, 80, '200.9.111.36', '2017-11-24 15:26:53', '2017-11-24 15:26:53'),
(404, 96, '186.9.4.104', '2018-01-18 01:33:23', '2018-01-18 01:33:23'),
(405, 87, '181.161.183.134', '2018-01-24 16:23:13', '2018-01-24 16:23:13'),
(406, 87, '201.238.232.29', '2018-02-21 14:09:07', '2018-02-21 14:09:07'),
(407, 87, '201.238.232.29', '2018-02-21 14:15:56', '2018-02-21 14:15:56'),
(408, 87, '201.238.232.29', '2018-02-21 14:21:51', '2018-02-21 14:21:51'),
(409, 87, '201.238.232.29', '2018-02-21 14:28:34', '2018-02-21 14:28:34'),
(410, 65, '186.156.17.160', '2018-02-25 15:03:47', '2018-02-25 15:03:47'),
(411, 98, '191.125.61.7', '2018-03-13 00:17:33', '2018-03-13 00:17:33'),
(412, 99, '181.161.28.131', '2018-04-02 16:39:40', '2018-04-02 16:39:40'),
(413, 99, '181.161.28.131', '2018-04-02 16:44:00', '2018-04-02 16:44:00'),
(414, 99, '181.161.28.131', '2018-04-02 17:07:24', '2018-04-02 17:07:24'),
(415, 100, '181.161.28.131', '2018-04-02 17:14:03', '2018-04-02 17:14:03'),
(416, 101, '201.186.213.154', '2018-04-12 19:24:18', '2018-04-12 19:24:18'),
(417, 103, '201.219.233.246', '2018-04-20 04:05:50', '2018-04-20 04:05:50'),
(418, 62, '190.215.82.112', '2018-05-13 15:48:51', '2018-05-13 15:48:51'),
(419, 80, '190.215.82.112', '2018-05-14 21:28:55', '2018-05-14 21:28:55'),
(420, 80, '190.215.82.112', '2018-05-14 21:34:53', '2018-05-14 21:34:53'),
(421, 104, '201.214.37.14', '2018-05-28 22:25:29', '2018-05-28 22:25:29'),
(422, 104, '201.214.37.14', '2018-05-31 11:35:50', '2018-05-31 11:35:50'),
(423, 104, '201.214.37.14', '2018-05-31 13:33:45', '2018-05-31 13:33:45'),
(424, 104, '201.214.37.14', '2018-05-31 14:17:05', '2018-05-31 14:17:05'),
(425, 104, '201.214.37.14', '2018-05-31 14:23:47', '2018-05-31 14:23:47'),
(426, 105, '201.219.233.97', '2018-06-01 18:53:40', '2018-06-01 18:53:40'),
(427, 104, '201.214.37.14', '2018-06-04 01:01:17', '2018-06-04 01:01:17'),
(428, 68, '186.10.135.178', '2018-06-04 20:09:54', '2018-06-04 20:09:54'),
(429, 104, '201.214.37.14', '2018-06-05 14:50:53', '2018-06-05 14:50:53'),
(430, 64, '200.119.236.113', '2018-06-06 19:59:13', '2018-06-06 19:59:13'),
(431, 104, '201.214.37.14', '2018-06-21 15:10:40', '2018-06-21 15:10:40'),
(432, 104, '201.214.37.14', '2018-06-21 22:05:54', '2018-06-21 22:05:54'),
(433, 107, '200.54.4.106', '2018-06-22 20:07:35', '2018-06-22 20:07:35'),
(434, 108, '186.20.72.122', '2018-06-25 17:56:24', '2018-06-25 17:56:24'),
(435, 80, '190.215.81.204', '2018-06-26 07:03:41', '2018-06-26 07:03:41'),
(436, 63, '181.208.123.77', '2018-06-26 13:30:54', '2018-06-26 13:30:54'),
(437, 106, '200.74.105.90', '2018-07-03 18:22:38', '2018-07-03 18:22:38'),
(438, 64, '186.9.52.149', '2018-07-10 10:23:07', '2018-07-10 10:23:07'),
(439, 109, '190.161.153.25', '2018-07-15 18:52:13', '2018-07-15 18:52:13'),
(440, 62, '190.215.81.204', '2018-07-16 13:30:31', '2018-07-16 13:30:31'),
(441, 62, '190.215.81.204', '2018-07-16 13:39:30', '2018-07-16 13:39:30'),
(442, 110, '190.161.85.63', '2018-07-20 01:15:33', '2018-07-20 01:15:33'),
(443, 75, '190.215.90.217', '2018-07-22 20:42:23', '2018-07-22 20:42:23'),
(444, 111, '191.125.167.5', '2018-07-26 14:25:49', '2018-07-26 14:25:49'),
(445, 112, '186.148.210.10', '2018-07-31 13:26:32', '2018-07-31 13:26:32'),
(446, 112, '186.148.210.10', '2018-07-31 13:29:22', '2018-07-31 13:29:22'),
(447, 75, '191.125.34.195', '2018-07-31 20:36:26', '2018-07-31 20:36:26'),
(448, 62, '107.167.108.171', '2018-07-31 22:44:45', '2018-07-31 22:44:45'),
(449, 113, '201.214.205.207', '2018-08-05 14:06:19', '2018-08-05 14:06:19'),
(450, 62, '190.215.86.22', '2018-08-13 00:03:57', '2018-08-13 00:03:57'),
(451, 62, '190.215.86.22', '2018-08-13 00:15:32', '2018-08-13 00:15:32'),
(452, 62, '190.215.86.22', '2018-08-13 00:19:18', '2018-08-13 00:19:18'),
(453, 62, '190.215.86.22', '2018-08-13 00:25:03', '2018-08-13 00:25:03'),
(454, 62, '190.215.86.22', '2018-08-13 00:27:52', '2018-08-13 00:27:52'),
(455, 62, '190.215.86.22', '2018-08-13 00:32:08', '2018-08-13 00:32:08'),
(456, 62, '190.215.86.22', '2018-08-13 00:32:33', '2018-08-13 00:32:33'),
(457, 62, '190.215.86.22', '2018-08-13 00:39:51', '2018-08-13 00:39:51'),
(458, 80, '190.215.86.22', '2018-08-13 00:40:12', '2018-08-13 00:40:12'),
(459, 62, '190.215.86.22', '2018-08-13 00:46:31', '2018-08-13 00:46:31'),
(460, 62, '190.215.86.22', '2018-08-13 00:47:31', '2018-08-13 00:47:31'),
(461, 80, '190.215.86.22', '2018-08-13 00:48:15', '2018-08-13 00:48:15'),
(462, 62, '190.215.86.22', '2018-08-13 00:50:47', '2018-08-13 00:50:47'),
(463, 62, '200.9.108.36', '2018-08-20 16:55:14', '2018-08-20 16:55:14'),
(464, 87, '190.215.110.10', '2018-08-24 08:47:45', '2018-08-24 08:47:45'),
(465, 87, '190.215.110.10', '2018-08-24 08:51:43', '2018-08-24 08:51:43'),
(466, 87, '191.126.171.230', '2018-08-24 10:23:56', '2018-08-24 10:23:56'),
(467, 87, '200.27.73.13', '2018-08-24 17:51:07', '2018-08-24 17:51:07'),
(468, 87, '191.126.145.66', '2018-08-26 00:15:46', '2018-08-26 00:15:46'),
(469, 94, '152.174.97.9', '2018-08-29 14:15:42', '2018-08-29 14:15:42'),
(470, 94, '152.174.97.9', '2018-08-29 14:36:34', '2018-08-29 14:36:34'),
(471, 62, '190.8.79.157', '2018-08-31 17:59:43', '2018-08-31 17:59:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominas`
--

CREATE TABLE `nominas` (
  `idnominas` int(10) UNSIGNED NOT NULL,
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_vencimiento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(3) UNSIGNED DEFAULT '0',
  `todo_pagado` int(11) DEFAULT '0',
  `idUsuarios_hijo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nominas`
--

INSERT INTO `nominas` (`idnominas`, `idUsuarios`, `empresa`, `descripcion`, `fecha_vencimiento`, `created_at`, `updated_at`, `eliminado`, `todo_pagado`, `idUsuarios_hijo`) VALUES
(1, 62, 'Prueba Gastos Comunes - Ricardo Iturra', NULL, '0000-00-00', '2017-06-28 21:16:34', '2017-06-28 21:16:34', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominasdetalle`
--

CREATE TABLE `nominasdetalle` (
  `idnominasdetalle` int(10) UNSIGNED NOT NULL,
  `idnominas` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `rut` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `monto` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(3) UNSIGNED DEFAULT '0',
  `fecha_vencimiento` date NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `idTipoPago` int(11) DEFAULT NULL,
  `monto_pago` int(11) DEFAULT NULL,
  `pagado` tinyint(4) DEFAULT '0',
  `nro_transaccion` varchar(100) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `url_adjunto` varchar(100) NOT NULL,
  `rut_traspaso` varchar(20) NOT NULL,
  `email_traspaso` varchar(70) NOT NULL,
  `idunico_pago` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nominasdetalle`
--

INSERT INTO `nominasdetalle` (`idnominasdetalle`, `idnominas`, `nombre`, `rut`, `email`, `monto`, `created_at`, `updated_at`, `eliminado`, `fecha_vencimiento`, `descripcion`, `idTipoPago`, `monto_pago`, `pagado`, `nro_transaccion`, `fecha_pago`, `url_adjunto`, `rut_traspaso`, `email_traspaso`, `idunico_pago`) VALUES
(1, 1, 'Ricardo Iturra', '10199552-6', 'ricardoiturral@hotmail.com', 2000, '2017-06-28 21:16:34', '2017-06-28 21:17:58', 0, '2017-07-01', 'Gastos comunes - Prueba - Julio', NULL, NULL, 0, NULL, NULL, '62-30699443759544736178614.40489566.pdf', '', '', 'noP1595446e2e5ecb'),
(2, 1, 'Ricardo Iturra', '10199552-6', 'ricardoiturral@hotmail.com', 3000, '2017-06-28 21:16:34', '2017-06-28 21:17:58', 0, '2017-08-01', 'Gastos comunes - Prueba - Agosto', NULL, NULL, 0, NULL, NULL, '62-30699443759544736178614.40489566.pdf', '', '', 'noP2595446e319f8e'),
(3, 1, 'Maricarmen Osorio', '10714498-6', 'maricarmen@macroconsulting.cl', 2000, '2017-06-28 21:16:35', '2017-06-28 21:24:51', 0, '2017-07-01', 'Gastos comunes - Prueba - Julio', 2, 2000, 1, '', '2017-06-28', '62-30699443759544736178614.40489566.pdf', '', '', 'noP3595446e33ea27'),
(4, 1, 'Maricarmen Osorio', '10714498-6', 'maricarmen@macroconsulting.cl', 3000, '2017-06-28 21:16:35', '2017-06-28 21:17:58', 0, '2017-08-01', 'Gastos comunes - Prueba - Agosto', NULL, NULL, 0, NULL, NULL, '62-30699443759544736178614.40489566.pdf', '', '', 'noP4595446e36ab89');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles_cobrado`
--

CREATE TABLE `perfiles_cobrado` (
  `idperfiles_cobrado` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles_cobrado`
--

INSERT INTO `perfiles_cobrado` (`idperfiles_cobrado`, `descripcion`) VALUES
(1, 'Consultivo'),
(2, 'Operativo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicidad`
--

CREATE TABLE `publicidad` (
  `idpublicidad` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `path_imagen` varchar(200) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_termino` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `publicidad`
--

INSERT INTO `publicidad` (`idpublicidad`, `titulo`, `path_imagen`, `descripcion`, `fecha_inicio`, `fecha_termino`, `eliminado`, `activo`, `updated_at`, `created_at`, `link`) VALUES
(1, 'banner interno', '65-9334650095893c135eda127.38644836.jpg', '....', '2017-02-02 00:00:00', '2017-03-01 00:00:00', 0, 1, '2017-02-02 20:33:12', '0000-00-00 00:00:00', ''),
(3, 'Probando 1', '11-2930656d338b5816a40.47835125.jpg', 'aaaaaaaaaaaaaaaaaaaa', '2017-02-02 00:00:00', '2017-07-13 00:00:00', 1, 1, '2017-03-03 00:38:29', '2016-02-28 00:08:46', ''),
(4, 'Sistema de Informes  dqwdqwdqwdq', '52-22491574ceb6330ad27.61735140.jpg', 'aaa', '2016-05-01 00:00:00', '2016-06-30 00:00:00', 1, 1, '2017-02-01 16:39:22', '2016-05-31 02:39:47', ''),
(5, 'Finciero', '69-23880171858b8e56dc12fb1.88397877.jpg', 'Tarjeta de Crédito Virtual', '2017-03-03 00:00:00', '2017-03-19 00:00:00', 0, 1, '2017-03-16 15:14:43', '2017-03-03 00:39:25', 'https://www.finciero.com/home');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `IDRegion` int(10) UNSIGNED NOT NULL,
  `region` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `regiones`
--

INSERT INTO `regiones` (`IDRegion`, `region`) VALUES
(1, 'Arica y Parinacota'),
(2, 'Tarapacá'),
(3, 'Antofagasta'),
(4, 'Atacama'),
(5, 'Coquimbo'),
(6, 'Valparaíso'),
(7, 'Metropolitana de Santiago'),
(8, 'O\'Higgins'),
(9, 'Maule'),
(10, 'Bío-Bío'),
(11, 'La Araucanía'),
(12, 'Los Ríos'),
(13, 'Los Lagos'),
(14, 'Aysén'),
(15, 'Magallanes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubros`
--

CREATE TABLE `rubros` (
  `idrubros` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rubros`
--

INSERT INTO `rubros` (`idrubros`, `nombre`, `eliminado`, `updated_at`, `created_at`) VALUES
(1, 'Persona Natural', 0, '2017-03-02 22:58:24', '0000-00-00 00:00:00'),
(2, 'Administración de Inmuebles', 0, '2017-03-02 23:14:42', '0000-00-00 00:00:00'),
(3, 'Agricultura, Pesca o Vinicultura', 0, '2017-03-02 23:18:11', '0000-00-00 00:00:00'),
(4, 'Bares y Restaurants', 0, '2017-03-02 23:15:23', '0000-00-00 00:00:00'),
(5, 'Comercio', 0, '2017-03-02 23:17:43', '0000-00-00 00:00:00'),
(6, 'Comunidades o Condominios', 0, '2017-03-02 23:17:31', '0000-00-00 00:00:00'),
(7, 'Concesionario de Luz, Gas o Agua', 0, '2017-03-02 23:18:32', '0000-00-00 00:00:00'),
(8, 'Construcción', 0, '2017-03-02 23:18:57', '0000-00-00 00:00:00'),
(9, 'e-commerce', 0, '2017-03-02 23:19:16', '0000-00-00 00:00:00'),
(10, 'Educación', 0, '2017-03-02 23:19:34', '0000-00-00 00:00:00'),
(11, 'Importación / Exportación', 0, '2017-03-02 23:19:56', '0000-00-00 00:00:00'),
(12, 'Inmobiliaria', 0, '2017-03-02 23:20:12', '0000-00-00 00:00:00'),
(13, 'Minería', 0, '2017-03-02 23:20:28', '0000-00-00 00:00:00'),
(14, 'Prestación de Servicios a Empresas', 0, '2017-03-02 23:20:47', '0000-00-00 00:00:00'),
(15, 'Prestación de Servicios a Personas', 0, '2017-03-02 23:21:05', '0000-00-00 00:00:00'),
(16, 'Servicios Financieros', 0, '2017-03-02 23:21:16', '2017-03-02 23:21:16'),
(17, 'Telecomunicaciones', 0, '2017-03-02 23:21:32', '2017-03-02 23:21:32'),
(18, 'Transporte', 0, '2017-03-02 23:21:48', '2017-03-02 23:21:48'),
(19, 'Turismo', 0, '2017-03-02 23:21:57', '2017-03-02 23:21:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cuenta`
--

CREATE TABLE `tipo_cuenta` (
  `idTipoCuenta` int(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_cuenta`
--

INSERT INTO `tipo_cuenta` (`idTipoCuenta`, `descripcion`, `eliminado`, `editable`, `created_at`, `updated_at`) VALUES
(1, 'Cuenta Corriente', 0, 0, '2017-04-02 15:59:12', '0000-00-00 00:00:00'),
(2, 'Cuenta Vista', 0, 0, '2017-04-02 15:58:49', '0000-00-00 00:00:00'),
(3, 'Chequera Electrónica', 0, 0, '2017-04-02 15:59:14', '2017-04-02 12:57:47'),
(4, 'Cuenta de Ahorro', 0, 0, '2017-04-02 15:59:08', '2017-04-02 12:57:42'),
(5, 'aaa', 1, 1, '2017-04-02 16:04:24', '2017-04-02 13:04:24'),
(6, 'Cuenta de Pruebas', 0, 1, '2017-04-02 13:04:39', '2017-04-02 13:04:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pagos`
--

CREATE TABLE `tipo_pagos` (
  `idTipoPago` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_pagos`
--

INSERT INTO `tipo_pagos` (`idTipoPago`, `descripcion`, `eliminado`, `editable`, `created_at`, `updated_at`) VALUES
(1, 'Transferencia bancaria', 0, 0, '2016-02-12 18:42:01', '0000-00-00 00:00:00'),
(2, 'Efectivo', 0, 0, '2016-02-12 18:42:01', '0000-00-00 00:00:00'),
(3, 'Cheque', 0, 0, '2016-02-12 18:42:01', '0000-00-00 00:00:00'),
(4, 'aaa', 1, 1, '2017-02-24 19:28:05', '2017-02-24 16:28:05'),
(5, 'aaasafasf', 1, 1, '2016-02-27 19:56:47', '2016-02-27 19:56:47'),
(6, 'wdqdqwdqw', 1, 1, '2016-02-27 19:56:50', '2016-02-27 19:56:50'),
(7, 'dfsfdsf', 1, 1, '2017-02-24 19:28:09', '2017-02-24 16:28:09'),
(8, 'Tarjeta de Crédito', 0, 1, '2017-03-02 22:00:14', '2017-03-02 22:00:14'),
(9, 'Tarjeta de Débito', 0, 1, '2017-03-02 22:00:39', '2017-03-02 22:00:39'),
(11, 'qwdqw', 1, 1, '2018-08-13 03:49:07', '2018-08-13 00:49:07'),
(12, 'qwdqwdqwdwqd', 1, 1, '2018-08-13 03:49:15', '2018-08-13 00:49:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `IDRegion` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passwordp` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `email_alternativo` varchar(70) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `nro_direccion` varchar(255) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `eliminado` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `rut` varchar(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idrubros` int(11) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `apellido` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '0',
  `comuna` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `IDRegion`, `remember_token`, `created_at`, `updated_at`, `passwordp`, `email`, `email_alternativo`, `direccion`, `nro_direccion`, `complemento`, `referencia`, `telefono`, `celular`, `eliminado`, `rut`, `nombre`, `idrubros`, `admin`, `apellido`, `razon_social`, `activo`, `comuna`) VALUES
(62, 7, 'rKFRZ9V1pyIYSk9qMeAW0Y96a9sRBN6HiCWsz8vgcNQKipGsxRN1HV939qKp', '2016-11-23 21:50:02', '2018-08-31 18:00:00', '$2y$10$heQbqv1h46pO7/ETFVFPx.xXkgeOhK4vjmqnBcVZu3iEOkgSqJeHi', 'pedropfcosta@hotmail.com', NULL, 'Av. La Plaza, 555, Casa 85', NULL, NULL, NULL, NULL, '979774570', 0, '22379633-8', 'Pedro Fernandes Costa', 2, 0, '', '', 1, 'Las Condes'),
(63, 1, 'DjKdeIDQQGSx6F6gcs17HDtiYVYQBFPr5zhnHDTmFjPgAIfWgQ77mp6Bctb2', '2016-11-29 00:18:04', '2018-06-26 13:36:56', '$2y$10$uKAVfw.m8LLOZL7HHir3dO8faFwHIHA6qdiGvKjNFzDnpfJXC2Q4.', 'pedrofernandescosta@outlook.com', NULL, 'Av. La Plaza, 555', NULL, NULL, NULL, NULL, '995334755', 0, '12041180-2', 'Bernardita Larrain', 1, 0, '', '', 1, 'Las Condes'),
(64, 7, 'wllzknVjPCkLpFUwhzmZ71Dc2Bf0lG4uMKOZcbtXeXiEG5irPwk4A2lVLahq', '2016-12-01 23:33:44', '2018-06-06 20:04:16', '$2y$10$1rsijRh5VLUDG4YDznytzulECUp9J.0AWgwN84tDEEYGBqoYuOvGG', 'david.cuello@r2da.com', NULL, 'Mi Casa', NULL, NULL, NULL, NULL, '997922049', 0, '25055034-0', 'Luciano Cuello', 15, 0, '', '', 1, 'Maipu'),
(65, 7, 'XKGGkbmgbAXX2O4NXwRuFz575lR5q97T3p6XunZ32sZrNTNzXqLkfE6vGyjp', '2016-12-05 21:08:47', '2018-02-25 15:04:03', '$2y$10$Ih0reZOGq6auoZ1..czZeujeroBueLSj5CPxb/8jzCGiIENa87YL6', 'diego.valladares@outlook.com', NULL, 'Pruebas dirección', NULL, NULL, NULL, NULL, '123456781', 0, '17487145-0', 'diegov1w', 1, 1, '', '', 1, 'Santiago'),
(66, 7, 'rzObpNpW5Zhz8mRz20qxV4lxxPlMYevicS1hMJy05TEYhQE8x9CPxg4qqg3h', '2016-12-07 16:24:42', '2016-12-07 16:32:59', '$2y$10$fAfT1HqbeG6uxdhlrhoCD.jCCVvKr4XrdlhsiPyL/UGXxqnotirlO', 'hola@and318.com', NULL, 'San Pablo 3610 dp 907 -A', NULL, NULL, NULL, NULL, '995941389', 0, '16738317-3', 'Andrés Saavedra', 15, 0, '', '', 1, 'Quinta NOrmal'),
(67, 7, NULL, '2016-12-12 00:22:34', '2016-12-12 00:24:28', '$2y$10$R7USUTMgzyE76HtW3OYBQebmQQ0QAYpXkvryTKnO.ccwKRGuIwms2', 'pvalenzuela@kaufmann.cl', NULL, 'lago rapel 3401', NULL, NULL, NULL, NULL, '993184865', 0, '12593794-2', 'Patricio Valenzuela Bertani', 9, 0, '', '', 1, 'pedroa cerda'),
(68, 7, 'vSBK1UVYM8oulvxmJf1fB256l7bXVB7obQouWvxOx5zeWYhvVjXnZKZb3Dxc', '2016-12-20 19:30:46', '2018-06-04 20:15:07', '$2y$10$FTK3O.jn7DBj77iE6Pb.VuzkHqkvAQLkgpVm20Mqa2Uxkji98zcV6', 'proyectos@mediasoft.cl', NULL, 'Guardia Vieja 181 oficina 506', NULL, NULL, NULL, NULL, '998273710', 0, '76200296-5', 'MS Ingeniería y Diseño', 15, 1, '', '', 1, 'providencia'),
(69, 7, 'OVtieVliCZh5swwDidIn3gdQjnbgSimcJkG3IMENciphWBBrjn8bcSo2rjFC', '2016-12-20 19:44:01', '2017-04-12 19:34:16', '$2y$10$YL6MqxtepSzjQ86Hr.88m.kFrO7VFMUhH5DTZ.w7bIGsMJgwQfmiy', 'kta.jimenez@gmail.com', NULL, 'pedro de valdivia 377', NULL, NULL, NULL, NULL, '987273710', 0, '16181604-3', 'Catalina Jimenez Eberl', 15, 1, '', '', 1, 'Providencia'),
(70, 7, 'sN0FJ8rEFOfEb6kjoVDmlVCGWxmFhlbHRS247xYt9OhnHvVGtdtfsP03yvdk', '2017-01-19 13:16:31', '2017-03-21 20:06:45', '$2y$10$aHvkISELCXmJ70fcGy.x.OH/hiCln2axWMzh1HblHBuQmh36jkvQS', 'cmartinez@mediasoft.cl', NULL, 'San isidro 337', NULL, NULL, NULL, NULL, '978999714', 0, '15425558-3', 'Carlos Martinez', 15, 0, '', '', 1, 'Santiago'),
(71, 7, NULL, '2017-01-26 12:42:21', '2017-03-27 17:36:38', '$2y$10$DSGLJ9Qbq2RNdnSsFyHty.ULHSOiE72y/esCZGfzFUadNsrEuKdGS', 'cjimenez@mediasoft.cl', NULL, 'nueva providencia 2353 ', NULL, NULL, NULL, NULL, '998273710', 0, '8970646-7', 'Catalina2 jimenez2', 2, 0, '', '', 1, 'providencia'),
(72, 7, 'vYZF8gZseTNHtF5oveXdbyVyA4Q0ufCafSP6fJvi71ZZWzrdSHKDIMpKbIxf', '2017-01-26 13:05:27', '2017-02-24 16:37:26', '$2y$10$/Zwf73pgyVSSnx1yMok5Y.Om.JJadEczME8NzDJSbWRDuXpTf4QeG', 'hivechile@gmail.com', NULL, 'nueva providencia 2353 ', NULL, NULL, NULL, NULL, '998273710', 0, '15337220-9', 'Catalina3 Jimenez3', 1, 0, '', '', 1, 'providencia'),
(73, 7, NULL, '2017-02-02 19:48:53', '2017-02-02 19:49:41', '$2y$10$QdT99HTsDN.QlBm2cRYODuzLY1tz3ij6amY4FMZlDB5YwPjDAWMNS', 'maringen1972@yahoo.com', NULL, 'galvez 2380', NULL, NULL, NULL, NULL, '978483923', 0, '11994257-8', 'maria angelica galdames olivares', 13, 0, '', '', 1, 'isla de maipo'),
(74, 10, 'eVQxVQitV1uv9MjpbzuyfszIjJOupvDYDoLBz1slfpyILHDaYITfRagKWzdJ', '2017-02-22 16:31:33', '2017-02-22 18:40:41', '$2y$10$Fg8j9rz8TZ7RyugH1ve3m.FP0n22Cb9.jzP38YK6cccDBETZYJJ7C', 'ma.salazarsanchez@gmail.com', NULL, 'mi casa', NULL, NULL, NULL, NULL, '982632790', 0, '17271511-7', 'Ale', 8, 0, '', '', 1, 'concepcion'),
(75, 7, 'YegFo200MVh4GCuptEJRaDONTWV2ukXYowVHrJuhkxts1DYufztHVyVDtLzJ', '2017-03-03 20:43:15', '2018-07-31 20:40:21', '$2y$10$8Y2FSipQqwAzcpbKBksekeUXfeJsMyysQ77hFXvBZ52O6gQszZj.y', 'pedropfcosta@gmail.com', NULL, 'Av. La Plaza, 555, Casa 85', NULL, NULL, NULL, NULL, '123456789', 0, '13234558-9', 'Prueba Maca', 1, 0, '', '', 1, 'Las Condes'),
(76, 7, 'XljJFoRk3gPoHdNvT1VRR8hFMXxBaIF4TfcOYWi14DITZhzrbQfm7oKkvmC6', '2017-03-04 14:51:07', '2017-03-04 17:01:07', '$2y$10$N5OU.csa6taw9/Xxfv4FXeMi04gGz6OqhPiamdXBWf8u4ZacE/G16', 'csaldiasg@fen.uchile.cl', NULL, 'Victor Rae 5858 depto 403', NULL, NULL, NULL, NULL, '998836767', 0, '12966181-k', 'Carlos Saldías', 1, 0, '', '', 1, 'Las condes'),
(77, 7, 'xeclWooNwX64WYZCMOOdmdNTyrHAY4CK4Ys1E5K0JfK6joYf148O6WWmI7c1', '2017-03-07 12:49:50', '2017-03-28 13:48:41', '$2y$10$tHauBaSprR6FsbfHJ.0PoeT2bF9ewUiS9AehNdP3O4gWp7E55cNqW', 'jckarbu@gmail.com', NULL, 'WARREN SMITH 107 DPTO 215', NULL, NULL, NULL, NULL, '975490736', 0, '14130938-2', 'JUAN CARLOS CARBUCCIA MAYORGA', 1, 0, '', '', 1, 'LAS CONDES'),
(78, 4, 'cMItrMPDNSzUHdfRRZN8EfFeLckm7jgl9hgLQpgdq4pSmDn3bC9oDZK4OjG5', '2017-03-10 21:47:33', '2017-04-04 16:57:20', '$2y$10$zFYvTiuy9cGomg.USfv4Met8/p82j7M9QNQBkiUKRMZ4jNs/Jj2W2', 'sf_us@hotmail.com', NULL, 'R. Oscar Valdetaro, 94 / apto 802', NULL, NULL, NULL, NULL, '', 1, '23844794-1', 'Frederico Fernando Skwara Cea', 1, 0, '', '', 1, 'Vitacura'),
(79, 7, 'Ij5TWmIA0r0PALdh9gqjC8PRYx5Jvq5aNBsN3r2vciaLfI7Gz4ph3s7ppJVW', '2017-03-16 15:53:43', '2017-03-17 16:36:43', '$2y$10$Ds9ptIX/tJ4f36XbQbQE0eXd7nHiWW8V3ICm.Zp625Ee6bMK89zBm', 'pfernandes@bbva.com', NULL, 'Torre Norte', NULL, NULL, NULL, '92751211', '92751211', 1, '22237533-9', 'Yutzzin Valencia', 1, 0, '', '', 1, 'Las Condes'),
(80, 7, 'beMyPVJweDmPyNehvwdw82afWi2BMCDkhebgRxA3w7lvvcQks97ITSlxTdKM', '2017-03-16 18:22:32', '2018-08-13 00:50:34', '$2y$10$JhSUJeumCjvaKnE6rse0Jeu0DBBMORQIOiCEbBhbWehIK9djKQ.IC', 'pfernandes@portaldepagos.cl', NULL, 'Av. Las Condes, 2100', NULL, NULL, NULL, NULL, '979774570', 0, '76446707-8', 'Portal de Pagos SPA', 1, 1, '', '', 1, 'Las Condes'),
(81, 7, 'DCN72Yt3ZJbhn7jXuIHNMPYXkiEOXCVFEwdZBlgys8Lszl4gWtqn9XB50FOn', '2017-03-17 16:36:00', '2017-03-17 16:38:40', '$2y$10$wVAGuyx961/OZUe2NbsAY.YeN5nRKbnPmRCWKEIncnuS1M0BITpbi', 'pfernandes@bbva.com', NULL, 'Av, Las Condes', NULL, NULL, NULL, NULL, '988887777', 0, '96801970-8', 'Republic Parkin System Chile S.A. ', 2, 0, '', '', 1, 'Las Condes'),
(82, 7, 'aNF8XZmPgcDAUT8qoXbjvBjh90kH2TqlhxfwuukkUbcGa6e57K95VoCwXjDa', '2017-03-27 21:57:29', '2017-03-31 15:16:20', '$2y$10$FU9HrbBTpCiyycIBKjqhvuB9Z/7mCdhkQAp3rXDlH8Ks7YaKofnqy', 'javier.rossi.urquijo@gmail.com', NULL, 'marcel duhaut', NULL, NULL, NULL, NULL, '993219045', 0, '15095262-k', 'javier rossi urquijo', 1, 0, '', '', 1, 'providencia'),
(83, 7, NULL, '2017-04-04 16:11:40', '2017-05-04 20:44:07', '$2y$10$OMcyBnsPHJ1QfZMwTX25l.cM2s1bki39YLRj3trSe/r.JRhn/tFJa', 'sf_us@hotmail.com', NULL, 'Av. Presidente Bustamante', NULL, NULL, NULL, NULL, '995577591', 0, '24963799-8', 'Elias - Prueba', 1, 0, '', '', 1, 'Santiago'),
(84, 9, NULL, '2017-04-17 10:33:27', '2017-04-17 10:34:47', '$2y$10$C.6dzNXEfFma75/kAFy7QO0UTWD.k5iljKOZ/FbtDMpVPlQbGkSYi', 'claudiocornejo69.cc@gmail.com', NULL, 'villa galilea 22 sur 18 pte b # 0274', NULL, NULL, NULL, NULL, '944450313', 0, '11372706-3', 'claudio sebastian cornejo rodriguez', 14, 0, '', '', 1, 'talca '),
(85, 7, 'xdzX2YjGXWx82ZaFM5i2kgxX5NZeU2KrtvClLRlwSg8LMjoN8ogOnwpkcQhC', '2017-06-21 18:58:57', '2017-06-21 19:13:04', '$2y$10$g5tSLuqWjjGs5hpuSNWSO.l21m662luDaIespVxom.DcZLNmG2VAy', 'joelmorera@gmail.com', NULL, 'Vitacura 7125', NULL, NULL, NULL, NULL, '', 0, '15446322-4', 'Joel', 1, 0, '', '', 1, 'Vitacura'),
(86, 7, 'jFtpJnX4N253CpnRPf41IKz61j6sBcriPcfzajlx1Gw5jJ1KMolouE7jTO7C', '2017-06-21 19:08:22', '2017-06-21 19:10:42', '$2y$10$6/YiZJioebG9ShhQA9z/4O.mD.ptZ/Xl5eQynaoSCoDk.BMBb9esG', 'joel@lacocinadejavier.cl', NULL, 'vitacura 7125', NULL, NULL, NULL, NULL, '', 0, '79939910-5', 'Joel prueba', 4, 0, '', '', 1, 'vitacura'),
(87, 7, 'qz5A9u28yuN1DXdxu99l1qfDRsuLPdqYGDIRUQm46mCOWijS21v8JnfGYQhG', '2017-07-05 13:54:17', '2018-08-24 17:58:31', '$2y$10$Z.Q4NBBrlkh8C7XHGwiamer5IbheiDkWCaPSyQYNCvA6DmNPtcu9.', 'ricardoiturral@hotmail.com', NULL, 'ramon laval 1465 casa a', NULL, NULL, NULL, NULL, '996790805', 0, '10199552-6', 'Ricardo Iturra Loyola', 1, 0, '', '', 1, 'La Reina'),
(88, 7, 'TxLTPxu9aW1oDzvMFmFAq8kFujtwham9PupXqs1vyMuDOyr2jjktXhwldAoG', '2017-07-06 18:35:52', '2017-07-18 19:30:59', '$2y$10$sraNLvnTjKxHmgm2P5tDNusw.dDwtnzhctGv5EXeHBYCjYjHfk/la', 'sadasx@gmail.com', NULL, 'fernando rioja 92', NULL, NULL, NULL, NULL, '988368202', 0, '17180801-4', 'hernan', 1, 0, '', '', 1, 'la cisterna'),
(89, 7, 'jDFQVxjIN1nV5y020yqLrFmjNkdDEmUhfjFjJUTCPxmjPy6RzTkZzy8uw0RI', '2017-07-22 04:20:06', '2017-07-22 04:33:47', '$2y$10$EQvxXEUbOA6Vg02NuYdTbu1L/FfbOWQgN5ZT8lzNsAWE.625EHHY.', 'victor.bogado.l@gmail.com', NULL, 'Esteban Dell\'orto 6539, 101', NULL, NULL, NULL, NULL, '863663456', 0, '16365556-K', 'Victor Bogado', 1, 0, '', '', 1, 'Las Condes'),
(90, 7, 'asH8infFOOCVc9imwvfJJUoZD9pjPmGABnMGSKWtI8qaVToODdZw8mJm9ROq', '2017-07-23 18:04:24', '2017-07-23 18:12:24', '$2y$10$qdbucXABPhIaGGMdyytZFuC5WDZf19HMGyP7zNEZprybFmbCpJOqK', 'ceciliagutierrez@edocere.com', NULL, 'Avda. Eliodoro Yañez 2831, dpto 1503', NULL, NULL, NULL, NULL, '975822558', 0, '76176784-4', 'Comercial edocere ltda', 14, 0, '', '', 1, 'Providencia'),
(91, 7, NULL, '2017-07-24 17:39:48', '2017-07-24 17:39:48', '$2y$10$NFWjTDO.EXP96j6036hSTOxdZF4hk/MkzI2TFypWLGub10jPUmTtm', 'fco.aller@gmail.com', NULL, 'Leo 9331', NULL, NULL, NULL, NULL, '984493519', 0, '12123719-9', 'Francisco Javier Aller COntreras', 1, 0, '', '', 0, 'Vitacura'),
(92, 7, 'HFu3i5OjzVXoIxfYi62KEYXDvYE8HFUCve8hPFupPeygnNDHFM61ZoCwXvDN', '2017-07-31 20:33:08', '2017-07-31 20:39:51', '$2y$10$zIg6DfSjtKl4Rk/w9YF.nO.isLxJde5gKyrjobhrTsvknqVAW5F3q', 'rfuentesc@r2da.com', NULL, 'Costanera Sur, 3456', NULL, NULL, NULL, NULL, '979774570', 0, '16024794-0', 'Rafael Fuentes', 2, 0, '', '', 1, 'Las Condes'),
(93, 7, NULL, '2017-08-03 17:06:45', '2017-08-03 17:08:08', '$2y$10$lErQlEBY6bQbv2Pk21wrXeC2RNG4mCB2womPQXBkYTtFNbxbmek8q', 'sebazamoranoj@gmail.com', NULL, 'Avenida el rosal 4110', NULL, NULL, NULL, NULL, '988972657', 0, '16663224-2', 'Sebastian Zamorano', 15, 0, '', '', 1, 'Maipu'),
(94, 7, '4zs47k83rp6sKpzagQ6wsKdBpePfEMW43FR9SpkJBiWYV2qId9C8YGilNjMr', '2017-08-29 11:07:20', '2018-08-29 14:43:06', '$2y$10$Ed5qqpUTsP1g0LhIU6rfl.vnqzsMf9NEAmuv0wZzIjfhcFSX.5com', 'companiaproducciones@gmail.com', NULL, 'cocharca 2464', NULL, NULL, NULL, NULL, '988203245', 0, '76742506-6', 'compañia producciones limitada', 15, 0, '', '', 1, 'maipu'),
(95, 7, NULL, '2017-11-23 11:51:03', '2017-11-23 11:52:58', '$2y$10$Cs5m4zXne9EhkCciAV0Jg.x/EzLQ2nhV7BfZA3RO037R8zPkKshOu', 'chaverbeck@birdchile.cl', NULL, 'El Manzano 377 Oficina 405', NULL, NULL, NULL, NULL, '998390702', 0, '76233918-8', 'Inversiones BirdChile SPA', 14, 0, '', '', 1, 'Recoleta'),
(96, 3, '4twbUmZrTeLzLjokupA91jksD9LOcBEXdtar8pq7aVrQY3NORrvowYWHg1hK', '2018-01-18 01:31:12', '2018-01-18 01:38:31', '$2y$10$fACDiqFVD9FjoTgO1LRHe.MTGeo9BSm5/q8JhIo0rUNHpMViTRvvu', 'nice_franjo@hotmail.com', NULL, 'Altamira # 739', NULL, NULL, NULL, NULL, '940152097', 0, '16524208-4', 'Jocelyn Marisel Briones Castillo', 14, 0, '', '', 1, 'TALTAL'),
(97, 7, NULL, '2018-02-12 21:12:35', '2018-02-12 21:12:35', '$2y$10$OzRJ.93sEnWZPk6n9CGgwuGxBdkHO5NdCkfHuPPGB2ykfyfGDQx7y', 'd.muozparra1@uandresbello.edu', NULL, 'Pedro León Ugalde 1939', NULL, NULL, NULL, NULL, '971474366', 0, '24658640-3', 'Dersy Cecilia  Muñoz Parra', 1, 0, '', '', 0, 'santiago'),
(98, 10, NULL, '2018-03-13 00:15:19', '2018-03-13 00:16:29', '$2y$10$tke7NRKOqhI99BYX7zB5Qe2GqRMYRLpjCCmLFDGss8B9tmAhpK6DG', 'mi.cachorrita16@gmail.com', NULL, 'Prat con carrera edificio sivic 2', NULL, NULL, NULL, NULL, '962821609', 0, '20234336-8', 'Francisco Javier Prieto Nannig', 10, 0, '', '', 1, 'concepcion'),
(99, 7, 'W2uOsism07Z3Z0MxyWEQALFZ9FeE9H7oUDipFhCDHckjcelfJ3cKsIcSsrCd', '2018-04-02 16:38:47', '2018-04-02 17:07:52', '$2y$10$WQZoyUc8KyqZ3mJCGTwlIe6Er1Z2hwirPHd39H7dNZ.2PsE5MwFrC', 'jozartt@gmail.com', NULL, 'santa julia 2108', NULL, NULL, NULL, NULL, '965107603', 0, '15333832-9', 'Jose Miguel arrieta', 1, 0, '', '', 1, 'macul '),
(100, 7, 'DV80aKUClVr4RnaFZ9SwXTMAOzN4PDifuMcpn5qx1HF0Clvs5XLlpWOjkc7b', '2018-04-02 17:09:07', '2018-04-02 17:21:58', '$2y$10$YnGvBOOhYt7yYhMJh0FVT.b2MD.Ls0y54NgQg6ftxGbvtk.ovmEJ.', 'cabru26@gmail.com', NULL, 'santa julia 2108', NULL, NULL, NULL, NULL, '965197603', 0, '14162397-4', 'caroline bruno miranda ', 1, 0, '', '', 1, 'macul '),
(101, 10, 'Ydo2SPXIdlj2CYTZk59rfaOm5Ps0cZv6QkIVZ4lPhpEITJdRfUluK34SxT0K', '2018-04-12 19:22:13', '2018-04-12 19:42:13', '$2y$10$n/la5jy5rZA.PsVmjosLEu79/ehWFcU/e9K0oxgbbA9G93bT0RNiy', 'amandaletelierduran@gmail.com', NULL, 'Avda. Don Bosco #1863', NULL, NULL, NULL, NULL, '974821329', 0, '17866894-3', 'Amanda Letelier', 1, 0, '', '', 1, 'Concepción'),
(102, 1, NULL, '2018-04-19 13:00:26', '2018-04-19 13:00:26', '$2y$10$I7JPwnExGEYHJlLJMiNud.TIt.r5jLU4e1OPUL7aTwPuA.ap5I8OO', 'cristian.leal@bluebyte.cl', NULL, 'los pollitos 1010', NULL, NULL, NULL, NULL, '992232323', 0, '9266697-2', 'Juan perez', 1, 0, '', '', 0, 'san berbardo'),
(103, 6, 'rLuvqbZWcRXBY97O8o7EwXjmJRwXxHaNM3QnCe47Gqkn32vZr5XtLrWIBQA0', '2018-04-20 04:04:50', '2018-04-20 04:11:22', '$2y$10$gOya3v8US2vXfQI4KqkEheSZA3t1z7yttWf5hIYrqd3Fhn02ynEg6', 'diego.gccb@gmail.com', NULL, 'Ulises poirier 289c', NULL, NULL, NULL, NULL, '973419693', 0, '18704285-2', 'Diego Ivan Garrido Cisternas', 18, 0, '', '', 1, 'Viña del Mar'),
(104, 9, 'igVu3P87mG8GABOXorGCyEAXXyb7kX0Ua251MuQHcUeFf7LW1Tee2JYFZDKW', '2018-05-28 22:21:37', '2018-06-05 14:57:09', '$2y$10$79kFDW31MC/GPIvR3igTCextbrgVlMfkAUrv/5X54pTQdS7Xz9Wcq', 'camilasoto@abogadatalca.cl', NULL, '1 1/2 poniente 26 sur n° 0820', NULL, NULL, NULL, NULL, '973662007', 0, '17033344-6', 'Camila Ester Soto Rodríguez', 1, 0, '', '', 1, 'Talca'),
(105, 5, 'pLk5mQ9lQbBicFfeh4vxQQW4nyum7lkyxkSYFKohC0cBCdoIQacAjeB5zz5K', '2018-06-01 18:52:40', '2018-06-01 18:58:57', '$2y$10$joZxQpzKbi9OroWNayN37eXQ9kZtEodKvw8tobAy0MVOFRxPYeYj2', 'johtrigo@bomberos.cl', NULL, 'los pimiento 138 villa santa rosa', NULL, NULL, NULL, NULL, '930087013', 0, '18260398-8', 'johany alexander hombre trigo vargas', 1, 0, '', '', 1, 'Salamanca'),
(106, 7, '1UA9I1OErZzvdLW9w7Nif0esPVCkrAG1jTU47HzhXIwov8sE7gQlrsONe7aG', '2018-06-18 16:54:32', '2018-07-03 18:36:38', '$2y$10$dyzAR6ragFQZJSrhxJ4r6e6hLV4uMu5yUA0Y7E9FRgq.5yqrnZm1a', 'contacto@igedrecords.com', NULL, 'CHILOE 3950', NULL, NULL, NULL, NULL, '994996853', 0, '76175321-5', 'INDUSTRIA GENERAL DISCOGRÁFICA LTDA', 15, 0, '', '', 1, 'SAN MIGUEL'),
(107, 6, 'BGYcbxYFeILGI0chcBRKh0XmuDmctUeotQ5MPOl3DbBOhbRXIXQjDqOrnPLZ', '2018-06-22 20:06:48', '2018-06-22 20:10:31', '$2y$10$aQz5B6HdA4NSeNRwglQIS.zYs/w1OnffGlPV.PwV6SJ1EcwYAQx3S', 'cvelezc86@gmail.com', NULL, 'Las Camelias 65', NULL, NULL, NULL, NULL, '982511977', 0, '76329657-1', 'Nutrandes Spa', 5, 0, '', '', 1, 'Los Andes'),
(108, 7, NULL, '2018-06-25 17:55:36', '2018-06-25 17:56:14', '$2y$10$XjqwloOmUJ9jPfhQeCynBOL.t4kMpajcbjM3/Jh47B3BJMQEMtEJe', 'andres.vega.alarcon@gmail.com', NULL, 'lago huechulafquen 4189, ', NULL, NULL, NULL, NULL, '950179353', 0, '17386180-k', 'andres vega', 1, 0, '', '', 1, 'puente alto'),
(109, 7, 'UhxsnmwiNhlBoyyx4zZLjwoctEjB9ijT3sLrtBBGajH8bnQajT3eK1yUmmKb', '2018-07-15 18:50:45', '2018-07-15 19:00:01', '$2y$10$KRX89ErjP3R.pE.nRmpYTeEvLENb1syImjyGYBSgdje5wRGyFaq36', '987a9ba555@emailna.life', NULL, 'direccion', NULL, NULL, NULL, NULL, '992929292', 0, '20154296-0', 'nombre completo', 1, 0, '', '', 1, 'vitacura'),
(110, 12, NULL, '2018-07-20 01:12:39', '2018-07-20 11:05:05', '$2y$10$7wHn.cc.JOYEuDozgCBxauj9/9RPEitQ12XG18RI7TFA5cXwLF4.6', 'mae.aguirre@gmail.com', NULL, 'Serrano 990', NULL, NULL, NULL, NULL, '985056627', 0, '8875744-0', 'Maria elena', 1, 0, '', '', 1, 'Valdivia'),
(111, 7, NULL, '2018-07-26 14:23:37', '2018-07-26 14:25:30', '$2y$10$g5Gb20SrDmQZy8dyN2y2B.X2blJURP/t1Ohlk0xh/FvzoF.J93WgO', 'cristopherasp18@gmail.com', NULL, 'Casma 620', NULL, NULL, NULL, NULL, '961233530', 0, '20191512-0', 'CRISTOPHER ANTONIO', 1, 0, '', '', 1, 'San Miguel'),
(112, 7, 'egnXRxziPUvQIyS4pJRRBju32tcexmUoS5kTNzRKHeTgHLqWsHpaCRnMcp0Q', '2018-07-31 13:25:12', '2018-07-31 13:32:57', '$2y$10$m6rZyrjRjhQeqp8sRqtTsOb2QL/95w3DQJ37akVKoC5Nmq9GULmdi', 'hola@esaonda.com', NULL, 'Dr. Manuel Barros Borgoño 71, of. 1105', NULL, NULL, NULL, NULL, '972548136', 0, '76760743-1', 'Esaonda SpA', 14, 0, '', '', 1, 'providencia'),
(113, 4, 'e2AMYTxRiMNhH82jT7gigQ0C8yd2p1r3urwQuwqySHpjTi7uprObfO3lBL2v', '2018-08-05 13:38:26', '2018-08-05 14:08:01', '$2y$10$auoRtiK3m.k3SAP3LNE9lOGxl1w6SkMyvdcWh77/HskleEhPC7Ona', 'viktorzamoras@gmail.com', NULL, 'Pedro de Valdivia 310', NULL, NULL, NULL, NULL, '989054333', 0, '12841433-9', 'victor zamora chanampa', 1, 0, '', '', 1, 'Copiapo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas_cobradores`
--

CREATE TABLE `vistas_cobradores` (
  `idVistaCobradores` int(11) NOT NULL,
  `idUsuariosMaestro` int(10) UNSIGNED NOT NULL,
  `idperfiles_cobrado` int(11) NOT NULL,
  `idUsuarios` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `confirmado` int(11) DEFAULT '0',
  `eliminado` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio_portal`
--
ALTER TABLE `anuncio_portal`
  ADD PRIMARY KEY (`idanuncio_portal`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`idBancos`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`idCobros`),
  ADD KEY `Cobros_FKIndex1` (`idUsuarios`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`idConfiguracion`),
  ADD UNIQUE KEY `configuracion_nombre_configuracion_unique` (`nombre_configuracion`);

--
-- Indices de la tabla `contenido_email_mensaje`
--
ALTER TABLE `contenido_email_mensaje`
  ADD PRIMARY KEY (`idcontenido_email_mensaje`);

--
-- Indices de la tabla `datos_pago`
--
ALTER TABLE `datos_pago`
  ADD PRIMARY KEY (`iddatos_pago`),
  ADD KEY `fk_datos_pago_usuarios1_idx` (`idUsuarios`);

--
-- Indices de la tabla `historial_envio_email`
--
ALTER TABLE `historial_envio_email`
  ADD PRIMARY KEY (`idhistorial_envio_email`),
  ADD KEY `fk_historial_envio_email_usuarios1_idx` (`idUsuarios`);

--
-- Indices de la tabla `img_portal`
--
ALTER TABLE `img_portal`
  ADD PRIMARY KEY (`idimg_portal`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logaccesos`
--
ALTER TABLE `logaccesos`
  ADD PRIMARY KEY (`IDLogAcceso`),
  ADD KEY `LogAccesos_FKIndex1` (`idUsuarios`);

--
-- Indices de la tabla `nominas`
--
ALTER TABLE `nominas`
  ADD PRIMARY KEY (`idnominas`),
  ADD KEY `nominas_FKIndex1` (`idUsuarios`);

--
-- Indices de la tabla `nominasdetalle`
--
ALTER TABLE `nominasdetalle`
  ADD PRIMARY KEY (`idnominasdetalle`),
  ADD KEY `nominasdetalle_FKIndex1` (`idnominas`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `perfiles_cobrado`
--
ALTER TABLE `perfiles_cobrado`
  ADD PRIMARY KEY (`idperfiles_cobrado`);

--
-- Indices de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  ADD PRIMARY KEY (`idpublicidad`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`IDRegion`);

--
-- Indices de la tabla `rubros`
--
ALTER TABLE `rubros`
  ADD PRIMARY KEY (`idrubros`);

--
-- Indices de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  ADD PRIMARY KEY (`idTipoCuenta`);

--
-- Indices de la tabla `tipo_pagos`
--
ALTER TABLE `tipo_pagos`
  ADD PRIMARY KEY (`idTipoPago`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`),
  ADD KEY `Usuarios_FKIndex1` (`IDRegion`);

--
-- Indices de la tabla `vistas_cobradores`
--
ALTER TABLE `vistas_cobradores`
  ADD PRIMARY KEY (`idVistaCobradores`),
  ADD KEY `fk_vistas_cobradores_usuarios1_idx` (`idUsuariosMaestro`),
  ADD KEY `fk_vistas_cobradores_perfiles_cobrado1_idx` (`idperfiles_cobrado`),
  ADD KEY `fk_vistas_cobradores_usuarios2_idx` (`idUsuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio_portal`
--
ALTER TABLE `anuncio_portal`
  MODIFY `idanuncio_portal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `idBancos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `idCobros` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `idConfiguracion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `contenido_email_mensaje`
--
ALTER TABLE `contenido_email_mensaje`
  MODIFY `idcontenido_email_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `datos_pago`
--
ALTER TABLE `datos_pago`
  MODIFY `iddatos_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `historial_envio_email`
--
ALTER TABLE `historial_envio_email`
  MODIFY `idhistorial_envio_email` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT de la tabla `img_portal`
--
ALTER TABLE `img_portal`
  MODIFY `idimg_portal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `logaccesos`
--
ALTER TABLE `logaccesos`
  MODIFY `IDLogAcceso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=472;

--
-- AUTO_INCREMENT de la tabla `nominas`
--
ALTER TABLE `nominas`
  MODIFY `idnominas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nominasdetalle`
--
ALTER TABLE `nominasdetalle`
  MODIFY `idnominasdetalle` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles_cobrado`
--
ALTER TABLE `perfiles_cobrado`
  MODIFY `idperfiles_cobrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicidad`
--
ALTER TABLE `publicidad`
  MODIFY `idpublicidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `regiones`
--
ALTER TABLE `regiones`
  MODIFY `IDRegion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `rubros`
--
ALTER TABLE `rubros`
  MODIFY `idrubros` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipo_cuenta`
--
ALTER TABLE `tipo_cuenta`
  MODIFY `idTipoCuenta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_pagos`
--
ALTER TABLE `tipo_pagos`
  MODIFY `idTipoPago` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `vistas_cobradores`
--
ALTER TABLE `vistas_cobradores`
  MODIFY `idVistaCobradores` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `cobros_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `datos_pago`
--
ALTER TABLE `datos_pago`
  ADD CONSTRAINT `fk_datos_pago_usuarios1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historial_envio_email`
--
ALTER TABLE `historial_envio_email`
  ADD CONSTRAINT `fk_historial_envio_email_usuarios1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `logaccesos`
--
ALTER TABLE `logaccesos`
  ADD CONSTRAINT `logaccesos_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nominas`
--
ALTER TABLE `nominas`
  ADD CONSTRAINT `nominas_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nominasdetalle`
--
ALTER TABLE `nominasdetalle`
  ADD CONSTRAINT `nominasdetalle_ibfk_1` FOREIGN KEY (`idnominas`) REFERENCES `nominas` (`idnominas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`IDRegion`) REFERENCES `regiones` (`IDRegion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vistas_cobradores`
--
ALTER TABLE `vistas_cobradores`
  ADD CONSTRAINT `fk_vistas_cobradores_perfiles_cobrado1` FOREIGN KEY (`idperfiles_cobrado`) REFERENCES `perfiles_cobrado` (`idperfiles_cobrado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vistas_cobradores_usuarios1` FOREIGN KEY (`idUsuariosMaestro`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vistas_cobradores_usuarios2` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
