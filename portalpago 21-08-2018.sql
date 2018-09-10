-- --------------------------------------------------------
-- Host:                         52.23.215.174
-- Versión del servidor:         5.7.15-0ubuntu0.16.04.1 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para pdpdb
CREATE DATABASE IF NOT EXISTS `pdpdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pdpdb`;

-- Volcando estructura para tabla pdpdb.anuncio_portal
CREATE TABLE IF NOT EXISTS `anuncio_portal` (
  `idanuncio_portal` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(1000) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_termino` datetime DEFAULT NULL,
  `eliminado` tinyint(4) DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idanuncio_portal`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.anuncio_portal: ~0 rows (aproximadamente)
DELETE FROM `anuncio_portal`;
/*!40000 ALTER TABLE `anuncio_portal` DISABLE KEYS */;
INSERT INTO `anuncio_portal` (`idanuncio_portal`, `mensaje`, `fecha_inicio`, `fecha_termino`, `eliminado`, `updated_at`) VALUES
	(1, 'PROBANDO MENSAJE DE INCIDENCIA\r\n22/07/2018 18:00\r\n23/07/2018 19:00', '2018-07-22 18:00:00', '2018-07-23 19:00:00', 0, '2018-07-22 18:50:47');
/*!40000 ALTER TABLE `anuncio_portal` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.bancos
CREATE TABLE IF NOT EXISTS `bancos` (
  `idBancos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eliminado` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`idBancos`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.bancos: ~14 rows (aproximadamente)
DELETE FROM `bancos`;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.cobros
CREATE TABLE IF NOT EXISTS `cobros` (
  `idCobros` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(10) unsigned NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `rut_empresa` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(3) unsigned DEFAULT '0',
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `monto` int(10) unsigned DEFAULT NULL,
  `pagado` tinyint(4) DEFAULT '0',
  `nro_transaccion` varchar(100) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `idTipoPago` int(11) DEFAULT NULL,
  `idUsuarios_hijo` int(11) DEFAULT NULL,
  `url_adjunto` varchar(100) NOT NULL,
  `rut_traspaso` varchar(20) NOT NULL,
  `email_traspaso` varchar(70) NOT NULL,
  `idunico_pago` varchar(250) NOT NULL,
  PRIMARY KEY (`idCobros`),
  KEY `Cobros_FKIndex1` (`idUsuarios`),
  CONSTRAINT `cobros_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.cobros: ~19 rows (aproximadamente)
DELETE FROM `cobros`;
/*!40000 ALTER TABLE `cobros` DISABLE KEYS */;
INSERT INTO `cobros` (`idCobros`, `idUsuarios`, `empresa`, `rut_empresa`, `created_at`, `updated_at`, `eliminado`, `descripcion`, `fecha_vencimiento`, `email`, `monto`, `pagado`, `nro_transaccion`, `fecha_pago`, `idTipoPago`, `idUsuarios_hijo`, `url_adjunto`, `rut_traspaso`, `email_traspaso`, `idunico_pago`) VALUES
	(1, 62, 'Pedro Fernanded', '22379633-8', '2018-07-22 18:58:28', '2018-07-22 19:01:36', 1, '12.041.180-2 cobrando 22.379.633-8 valor 220.718 venc 29/07/2018', '2018-07-29', 'pedropfcosta@hotmail.com', 220718, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP15b54fe04cbc1c'),
	(2, 63, 'Pedro Fernandes Costa', '22379633-8', '2018-07-22 19:07:08', '2018-07-22 19:07:08', 0, '12.041.180-2 / Bernardita cobrando $220.728 a Pedro 22.379.633-8 / Venc 30 Jul 2018', '2018-07-30', 'pedropfcosta@hotmail.com', 220718, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP25b55000c49cf4'),
	(3, 62, 'Prueba Maca', '13234558-9', '2018-07-22 19:12:09', '2018-07-22 19:12:09', 0, 'Prova Pedro 22.379.633-8 cobrando Macarena/ Rut 13.234.558-9 / Monto $ 1.000.000 / Venc 31 Jul 2018 / con anexo', '2018-07-31', 'pedropfcosta@gmail.com', 1000000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP35b55013990112'),
	(4, 75, 'Portal de Pagos', '76446707-8', '2018-07-22 19:20:00', '2018-07-22 19:20:53', 0, 'Maca / 13.234.558-9 / cobrando Portal de Pagos / RUT 76.446.707-8 / Monto $10.000.000 / Venc 30 ene 19', '2019-01-30', 'pfernandes@portaldepagos.cl', 10000000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP45b5503106ea83'),
	(5, 80, 'Bernardita Labatut', '12041180-2', '2018-07-22 19:44:34', '2018-07-22 19:44:34', 0, 'Cobro Portal de Pagos a Bernardita 12.041.180-2 / $ 1.500 / Venc 13 09 2018', '2018-09-13', 'pedrofernandescosta@outlook.com', 1500, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP55b5508d2cc22f'),
	(6, 75, 'Portal de Pagos SPA', '76446707-8', '2018-07-22 20:50:27', '2018-07-22 20:50:27', 0, 'Maca cobra Portal de Pagos / RUT: 76.446.707-8 / Monto: $ 1.501 / Venc: 28/07/18', '2018-07-28', 'pfernandes@portaldepagos.cl', 1501, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP65b551843c8962'),
	(7, 75, 'Pedro Fernandes Costa', '22379633-8', '2018-07-22 20:53:12', '2018-07-22 20:53:12', 0, 'Maca cobra Pedro Fernandes Costa / RUT: 22.379.633-8 / Monto: $ 1.601 / Venc: 27/07/18', '2018-07-27', 'pedropfcosta@hotmail.com', 1601, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP75b5518e8ed72a'),
	(8, 75, 'Bernardita Labatut', '12.041.180-2', '2018-07-22 20:54:49', '2018-07-23 21:29:20', 1, 'Maca cobrando Bernardita / RUT 12.041.180-2 / Monto: $ 1.701 / Venc.: 31/07/18', '2018-07-31', 'pedropfcosta@gmail.com', 1701, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP85b5519494f869'),
	(9, 62, 'Portal de Pagos', '76446707-8', '2018-07-22 21:06:03', '2018-07-22 21:06:03', 0, 'PFC cobra Portal de Pagos - RUT 76.446.707-8 / Monto: $ 1.502 / Venc.: 28/7/18 / con comprobante: caballo loco.pdf', '2018-07-28', 'pfernandes@portaldepagos.cl', 1502, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP95b551beb355f7'),
	(10, 62, 'Bernadita Labatur', '12041180-2', '2018-07-22 21:07:17', '2018-07-22 21:07:18', 0, 'PFC cobrando Bernardita Labatut / RUT 12.041.180-2 / Monto: $ 1.702 / Venc.: 31/07/18', '2018-07-31', 'pedrofernandescosta@outlook.com', 1702, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP105b551c361336b'),
	(11, 62, 'Macarena Recabarren', '13234558-9', '2018-07-22 21:08:33', '2018-07-22 21:08:33', 0, 'PFC cobrando Macarena Recabarren / RUT 13.234.558-9 / Monto: $1.602 / Venc.: 27/7/18', '2018-07-27', 'pedropfcosta@gmail.com', 1602, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP115b551c81309fb'),
	(12, 63, 'Macarena Recabarren', '13234558-9', '2018-07-22 21:19:43', '2018-07-22 21:19:44', 0, 'Bernardita Larrain cobrando Macarena Recabarren / RUT 13.234.558-9 / Monto: $1.603 / Venc.: 27/07/18', '2018-07-27', 'pedropfcosta@gmail.com', 1603, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP125b551f2029ddc'),
	(13, 63, 'Pedro Fernandes', '22379633-8', '2018-07-22 21:20:53', '2018-07-22 21:20:53', 0, 'Bernardita Larrain cobrando a Pedro Fernandes / RUT 22.379.633-8 / Monto: $ 1.804 / Venc.: 30/07/18', '2018-07-30', 'pedropfcosta@hotmail.com', 1804, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP135b551f65e0f78'),
	(14, 63, 'Portal de Pagos SPA', '76446707-8', '2018-07-22 21:22:06', '2018-07-23 23:19:49', 0, 'Bernardita Larrain cobrando a Portal de Pagos / RUT: 76.446.707-8 / Monto: $1.503 / Venc.: 28/07/2018', '2018-07-28', 'pfernandes@portaldepagos.cl', 1503, 1, NULL, '2018-07-23', 1, NULL, '', '', '', 'coP145b551faeb465c'),
	(15, 80, 'Macarena Recabarren', '13234558-9', '2018-07-23 21:13:36', '2018-07-23 22:43:15', 0, 'Portal de Pagos cobrando Macarena / RUT 13.234.558-9 / $1.604 / Venc: 27/07/18', '2018-07-27', 'pedropfcosta@gmail.com', 1604, 1, NULL, '2018-07-23', 2, NULL, '', '', '', 'coP155b566f3047f25'),
	(16, 75, 'Bernardita Labatut', '12041180-2', '2018-07-23 21:31:37', '2018-07-23 21:31:37', 0, 'Maca cobrando Bernardita Labatut / RUT 12.041.180-2 / $ 1.701 / Venc.: 31/07/18', '2018-07-31', 'pedrofernandescosta@outlook.com', 1701, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP165b5673699d4e1'),
	(17, 62, 'Bernardita Labatut', '12041180-2', '2018-07-23 21:38:32', '2018-07-23 21:38:32', 0, 'PFC cobrando Bernardita Labatut / 12.041.180-2 / Valor $2.702 / Venc.: 31/08/18 con comprobante', '2018-08-31', 'pedrofernandescosta@outlook.com', 2702, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP175b5675083449a'),
	(18, 80, 'Jose Fernandez', '25600719-3', '2018-08-01 18:37:22', '2018-08-01 18:37:22', 0, 'Cobro Jose Prueba', '2018-08-03', 'arccoiiriis1@gmail.com', 1000, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP185b622812bdc14'),
	(19, 80, 'jose fernandez', '13234558-9', '2018-08-10 16:26:40', '2018-08-10 16:26:40', 0, 'prueba', '2018-08-26', 'pedropfcosta@gmail.com', 1212, 0, NULL, NULL, NULL, NULL, '', '', '', 'coP195b6de6f0a6550');
/*!40000 ALTER TABLE `cobros` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.configuracion
CREATE TABLE IF NOT EXISTS `configuracion` (
  `idConfiguracion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_configuracion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_configuracion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idConfiguracion`),
  UNIQUE KEY `configuracion_nombre_configuracion_unique` (`nombre_configuracion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla pdpdb.configuracion: ~1 rows (aproximadamente)
DELETE FROM `configuracion`;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` (`idConfiguracion`, `nombre_configuracion`, `valor_configuracion`, `created_at`, `updated_at`) VALUES
	(1, 'comision', '0.0147', '2017-11-13 15:23:41', '2018-07-16 18:53:11');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.contenido_email_mensaje
CREATE TABLE IF NOT EXISTS `contenido_email_mensaje` (
  `idcontenido_email_mensaje` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `texto` mediumtext NOT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcontenido_email_mensaje`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.contenido_email_mensaje: ~13 rows (aproximadamente)
DELETE FROM `contenido_email_mensaje`;
/*!40000 ALTER TABLE `contenido_email_mensaje` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `contenido_email_mensaje` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.datos_pago
CREATE TABLE IF NOT EXISTS `datos_pago` (
  `iddatos_pago` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(10) unsigned NOT NULL,
  `banco` varchar(100) NOT NULL,
  `nro_cuenta` varchar(120) NOT NULL,
  `tipo_cuenta` varchar(120) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`iddatos_pago`),
  KEY `fk_datos_pago_usuarios1_idx` (`idUsuarios`),
  CONSTRAINT `fk_datos_pago_usuarios1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.datos_pago: ~15 rows (aproximadamente)
DELETE FROM `datos_pago`;
/*!40000 ALTER TABLE `datos_pago` DISABLE KEYS */;
INSERT INTO `datos_pago` (`iddatos_pago`, `idUsuarios`, `banco`, `nro_cuenta`, `tipo_cuenta`, `created_at`, `updated_at`) VALUES
	(2, 62, 'BBVA', '22379633', 'Cuenta Corriente', '2016-11-28 23:24:43', '2018-08-13 01:06:57'),
	(3, 64, 'Santander', 'kuk879879', 'Cuenta Corriente', '2016-12-07 21:35:36', '2018-07-04 12:57:53'),
	(4, 65, 'Santander', '0-000-66-43611-0', 'Cuenta Corriente', '2016-12-17 12:21:39', '2017-02-02 20:11:39'),
	(5, 69, 'Banco Estado', '16181604', 'Cuenta Vista', '2016-12-20 19:45:30', '2017-04-12 19:09:52'),
	(6, 70, 'Santander', '63416851', 'Cuenta Corriente', '2017-01-19 13:19:28', '2017-01-19 13:19:28'),
	(7, 68, 'BCI', '76687767', 'Cuenta Corriente', '2017-02-13 15:30:49', '2017-02-13 15:30:49'),
	(8, 76, 'Security', '125663701', 'Cuenta Corriente', '2017-03-04 14:55:47', '2017-03-04 14:55:47'),
	(9, 77, 'BBVA', '14130938', 'Cuenta Corriente', '2017-03-07 13:04:44', '2017-03-07 13:04:55'),
	(11, 80, 'BBVA', '22379633', 'Cuenta Corriente', '2017-03-16 18:26:05', '2018-07-16 11:20:39'),
	(12, 79, 'Santander', '6454020', 'Cuenta Corriente', '2017-03-16 18:58:40', '2017-03-16 18:58:40'),
	(13, 81, 'Santander', '66016730', 'Cuenta Corriente', '2017-03-17 16:37:46', '2017-03-17 16:37:46'),
	(15, 75, 'BBVA', '22379633', 'Cuenta Corriente', '2017-06-28 21:32:43', '2018-07-12 23:33:49'),
	(16, 88, 'Banco Estado', '171808014', 'Cuenta Vista', '2017-07-06 18:38:24', '2017-07-06 18:38:24'),
	(18, 87, 'BCI', '76703053', 'Cuenta Corriente', '2017-07-26 21:12:19', '2017-07-26 21:12:19'),
	(25, 63, 'BBVA', '22379633', 'Cuenta Corriente', '2018-07-22 19:04:39', '2018-07-22 19:04:39');
/*!40000 ALTER TABLE `datos_pago` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.historial_envio_email
CREATE TABLE IF NOT EXISTS `historial_envio_email` (
  `idhistorial_envio_email` int(11) NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(100) NOT NULL,
  `texto` mediumtext NOT NULL,
  `idUsuarios` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `para` varchar(100) NOT NULL,
  `tipo_email` int(11) NOT NULL,
  `de` int(11) NOT NULL,
  PRIMARY KEY (`idhistorial_envio_email`),
  KEY `fk_historial_envio_email_usuarios1_idx` (`idUsuarios`),
  CONSTRAINT `fk_historial_envio_email_usuarios1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.historial_envio_email: ~85 rows (aproximadamente)
DELETE FROM `historial_envio_email`;
/*!40000 ALTER TABLE `historial_envio_email` DISABLE KEYS */;
INSERT INTO `historial_envio_email` (`idhistorial_envio_email`, `mensaje`, `texto`, `idUsuarios`, `created_at`, `updated_at`, `para`, `tipo_email`, `de`) VALUES
	(1, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 18:58:29', '2018-07-22 18:58:29', '-', 6, 62),
	(2, 'Aviso - Cambio de tus datos en nuestros registros', '...', 63, '2018-07-22 19:04:38', '2018-07-22 19:04:38', '-', 5, 0),
	(3, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:07:09', '2018-07-22 19:07:09', '-', 6, 63),
	(4, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:12:10', '2018-07-22 19:12:10', '-', 6, 62),
	(5, 'Aviso de nuevo cobro', '...', 80, '2018-07-22 19:20:01', '2018-07-22 19:20:01', '-', 6, 75),
	(6, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:21', '2018-07-22 19:38:21', '-', 6, 80),
	(7, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:22', '2018-07-22 19:38:22', '-', 6, 80),
	(8, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:23', '2018-07-22 19:38:23', '-', 6, 80),
	(9, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:24', '2018-07-22 19:38:24', '-', 6, 80),
	(10, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:24', '2018-07-22 19:38:24', '-', 6, 80),
	(11, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:25', '2018-07-22 19:38:25', '-', 6, 80),
	(12, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:25', '2018-07-22 19:38:25', '-', 6, 80),
	(13, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:26', '2018-07-22 19:38:26', '-', 6, 80),
	(14, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:27', '2018-07-22 19:38:27', '-', 6, 80),
	(15, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:28', '2018-07-22 19:38:28', '-', 6, 80),
	(16, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 19:38:28', '2018-07-22 19:38:28', '-', 6, 80),
	(17, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:29', '2018-07-22 19:38:29', '-', 6, 80),
	(18, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:30', '2018-07-22 19:38:30', '-', 6, 80),
	(19, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:30', '2018-07-22 19:38:30', '-', 6, 80),
	(20, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:31', '2018-07-22 19:38:31', '-', 6, 80),
	(21, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:32', '2018-07-22 19:38:32', '-', 6, 80),
	(22, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:32', '2018-07-22 19:38:32', '-', 6, 80),
	(23, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:33', '2018-07-22 19:38:33', '-', 6, 80),
	(24, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:34', '2018-07-22 19:38:34', '-', 6, 80),
	(25, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:35', '2018-07-22 19:38:35', '-', 6, 80),
	(26, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:36', '2018-07-22 19:38:36', '-', 6, 80),
	(27, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:37', '2018-07-22 19:38:37', '-', 6, 80),
	(28, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 19:38:38', '2018-07-22 19:38:38', '-', 6, 80),
	(29, 'Aviso de nuevo cobro', '...', 63, '2018-07-22 19:44:35', '2018-07-22 19:44:35', '-', 6, 80),
	(30, 'Aviso - Cambio de tus datos en nuestros registros', '...', 62, '2018-07-22 19:57:48', '2018-07-22 19:57:48', '-', 5, 0),
	(31, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:31', '2018-07-22 20:08:31', '-', 6, 80),
	(32, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:32', '2018-07-22 20:08:32', '-', 6, 80),
	(33, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:32', '2018-07-22 20:08:32', '-', 6, 80),
	(34, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:33', '2018-07-22 20:08:33', '-', 6, 80),
	(35, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:34', '2018-07-22 20:08:34', '-', 6, 80),
	(36, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:35', '2018-07-22 20:08:35', '-', 6, 80),
	(37, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:36', '2018-07-22 20:08:36', '-', 6, 80),
	(38, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:37', '2018-07-22 20:08:37', '-', 6, 80),
	(39, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:37', '2018-07-22 20:08:37', '-', 6, 80),
	(40, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:38', '2018-07-22 20:08:38', '-', 6, 80),
	(41, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:08:39', '2018-07-22 20:08:39', '-', 6, 80),
	(42, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:40', '2018-07-22 20:08:40', '-', 6, 80),
	(43, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:41', '2018-07-22 20:08:41', '-', 6, 80),
	(44, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:42', '2018-07-22 20:08:42', '-', 6, 80),
	(45, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:43', '2018-07-22 20:08:43', '-', 6, 80),
	(46, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:44', '2018-07-22 20:08:44', '-', 6, 80),
	(47, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:44', '2018-07-22 20:08:44', '-', 6, 80),
	(48, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:45', '2018-07-22 20:08:45', '-', 6, 80),
	(49, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:46', '2018-07-22 20:08:46', '-', 6, 80),
	(50, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:47', '2018-07-22 20:08:47', '-', 6, 80),
	(51, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:48', '2018-07-22 20:08:48', '-', 6, 80),
	(52, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:49', '2018-07-22 20:08:49', '-', 6, 80),
	(53, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:08:50', '2018-07-22 20:08:50', '-', 6, 80),
	(54, 'Aviso de nuevo cobro', '...', 80, '2018-07-22 20:50:28', '2018-07-22 20:50:28', '-', 6, 75),
	(55, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 20:53:13', '2018-07-22 20:53:13', '-', 6, 75),
	(56, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 20:54:50', '2018-07-22 20:54:50', '-', 6, 75),
	(57, 'Aviso de nuevo cobro', '...', 80, '2018-07-22 21:06:03', '2018-07-22 21:06:03', '-', 6, 62),
	(58, 'Aviso de nuevo cobro', '...', 63, '2018-07-22 21:07:18', '2018-07-22 21:07:18', '-', 6, 62),
	(59, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 21:08:33', '2018-07-22 21:08:33', '-', 6, 62),
	(60, 'Aviso de nuevo cobro', '...', 75, '2018-07-22 21:19:45', '2018-07-22 21:19:45', '-', 6, 63),
	(61, 'Aviso de nuevo cobro', '...', 62, '2018-07-22 21:20:54', '2018-07-22 21:20:54', '-', 6, 63),
	(62, 'Aviso de nuevo cobro', '...', 80, '2018-07-22 21:22:07', '2018-07-22 21:22:07', '-', 6, 63),
	(63, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:13:37', '2018-07-23 21:13:37', '-', 6, 80),
	(64, 'Aviso de nuevo cobro', '...', 63, '2018-07-23 21:31:38', '2018-07-23 21:31:38', '-', 6, 75),
	(65, 'Aviso de nuevo cobro', '...', 63, '2018-07-23 21:38:32', '2018-07-23 21:38:32', '-', 6, 62),
	(66, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:32', '2018-07-23 21:56:32', '-', 6, 80),
	(67, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:33', '2018-07-23 21:56:33', '-', 6, 80),
	(68, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:33', '2018-07-23 21:56:33', '-', 6, 80),
	(69, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:34', '2018-07-23 21:56:34', '-', 6, 80),
	(70, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:35', '2018-07-23 21:56:35', '-', 6, 80),
	(71, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:36', '2018-07-23 21:56:36', '-', 6, 80),
	(72, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:37', '2018-07-23 21:56:37', '-', 6, 80),
	(73, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:38', '2018-07-23 21:56:38', '-', 6, 80),
	(74, 'Aviso de nuevo cobro', '...', 62, '2018-07-23 21:56:39', '2018-07-23 21:56:39', '-', 6, 80),
	(75, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:40', '2018-07-23 21:56:40', '-', 6, 80),
	(76, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:40', '2018-07-23 21:56:40', '-', 6, 80),
	(77, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:41', '2018-07-23 21:56:41', '-', 6, 80),
	(78, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:42', '2018-07-23 21:56:42', '-', 6, 80),
	(79, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:43', '2018-07-23 21:56:43', '-', 6, 80),
	(80, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:44', '2018-07-23 21:56:44', '-', 6, 80),
	(81, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:45', '2018-07-23 21:56:45', '-', 6, 80),
	(82, 'Aviso de nuevo cobro', '...', 75, '2018-07-23 21:56:46', '2018-07-23 21:56:46', '-', 6, 80),
	(83, 'Aviso de nuevo cobro', '...', 75, '2018-08-10 16:26:41', '2018-08-10 16:26:41', '-', 6, 80),
	(84, 'Aviso - Cambio de tus datos en nuestros registros', '...', 62, '2018-08-13 01:06:56', '2018-08-13 01:06:56', '-', 5, 0),
	(85, 'Solicitud de Nueva Clave', 'Se le ha enviado el siguiente email para restablecer su contraseña', 62, '2018-08-13 01:07:40', '2018-08-13 01:07:40', '-', 1, 0);
/*!40000 ALTER TABLE `historial_envio_email` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.img_portal
CREATE TABLE IF NOT EXISTS `img_portal` (
  `idimg_portal` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `path_imagen` varchar(200) DEFAULT NULL,
  `descripcion` varchar(250) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link` varchar(500) NOT NULL,
  PRIMARY KEY (`idimg_portal`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.img_portal: ~4 rows (aproximadamente)
DELETE FROM `img_portal`;
/*!40000 ALTER TABLE `img_portal` DISABLE KEYS */;
INSERT INTO `img_portal` (`idimg_portal`, `titulo`, `path_imagen`, `descripcion`, `eliminado`, `updated_at`, `created_at`, `link`) VALUES
	(1, 'Cartola Online [EDITADO]', 'img-demo1.jpg', 'descripción Cartola Online ', 0, '2016-02-29 14:50:23', '0000-00-00 00:00:00', ''),
	(2, 'Herramientas Deudor y Cobrador ', 'img-demo2.jpg', 'Descripción herramientas deudr y cobrador', 0, '2016-02-28 18:49:43', '0000-00-00 00:00:00', ''),
	(3, 'Evita Fraudes', 'img-demo3.jpg', 'descripción fraudes', 0, '2016-02-28 18:49:30', '0000-00-00 00:00:00', ''),
	(4, 'Sistema de Informes [EDITADO]', '11-50256d3412ca3a604.29352921.jpg', 'descripción Sistema de Informes', 0, '2016-05-31 02:36:17', '0000-00-00 00:00:00', 'https://www.youtube.com/watch?v=tey3GI_le24');
/*!40000 ALTER TABLE `img_portal` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla pdpdb.jobs: ~5 rows (aproximadamente)
DELETE FROM `jobs`;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved`, `reserved_at`, `available_at`, `created_at`) VALUES
	(246, 'default', '{"job":"mailer@handleQueuedMessage","data":{"view":"emails.email_aviso_nuevo_cobro","data":{"to":"pfernandes@portaldepagos.cl","empresa":"Pedro Fernandes Costa","nombre":"Pedro Fernandes Costa","titulo":"Aviso de nuevo cobro - Pedro Fernandes Costa","fecha_vencimiento":"28\\/07\\/2018","deudor":"Portal de Pagos","archivo":"\\/public\\/images\\/voucher\\/9_voucher_individual.pdf","cobro_id":9,"registrado":true,"rut":"NzY0NDY3MDctOA=="},"callback":"C:32:\\"SuperClosure\\\\SerializableClosure\\":801:{a:5:{s:4:\\"code\\";s:245:\\"function ($message) use($data) {\\n    $message->from(\'noreply@portaldepagos.cl\', $data[\'titulo\']);\\n    $message->to($data[\'to\'])->subject(\'Portal de pagos\');\\n    if (!empty($data[\'archivo\'])) {\\n        $message->attach($data[\'archivo\']);\\n    }\\n};\\";s:7:\\"context\\";a:1:{s:4:\\"data\\";a:10:{s:2:\\"to\\";s:27:\\"pfernandes@portaldepagos.cl\\";s:7:\\"empresa\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"nombre\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"titulo\\";s:44:\\"Aviso de nuevo cobro - Pedro Fernandes Costa\\";s:17:\\"fecha_vencimiento\\";s:10:\\"28\\/07\\/2018\\";s:6:\\"deudor\\";s:15:\\"Portal de Pagos\\";s:7:\\"archivo\\";s:47:\\"\\/public\\/images\\/voucher\\/9_voucher_individual.pdf\\";s:8:\\"cobro_id\\";i:9;s:10:\\"registrado\\";b:1;s:3:\\"rut\\";s:16:\\"NzY0NDY3MDctOA==\\";}}s:7:\\"binding\\";N;s:5:\\"scope\\";s:20:\\"App\\\\Extras\\\\SendEmail\\";s:8:\\"isStatic\\";b:1;}}"}}', 12, 0, NULL, 1534128981, 1534128981),
	(247, 'default', '{"job":"mailer@handleQueuedMessage","data":{"view":"emails.email_aviso_nuevo_cobro","data":{"to":"pedrofernandescosta@outlook.com","empresa":"Pedro Fernandes Costa","nombre":"Pedro Fernandes Costa","titulo":"Aviso de nuevo cobro - Pedro Fernandes Costa","fecha_vencimiento":"31\\/08\\/2018","deudor":"Bernardita Labatut","archivo":"\\/public\\/images\\/voucher\\/17_voucher_individual.pdf","cobro_id":17,"registrado":true,"rut":"MTIwNDExODAtMg=="},"callback":"C:32:\\"SuperClosure\\\\SerializableClosure\\":810:{a:5:{s:4:\\"code\\";s:245:\\"function ($message) use($data) {\\n    $message->from(\'noreply@portaldepagos.cl\', $data[\'titulo\']);\\n    $message->to($data[\'to\'])->subject(\'Portal de pagos\');\\n    if (!empty($data[\'archivo\'])) {\\n        $message->attach($data[\'archivo\']);\\n    }\\n};\\";s:7:\\"context\\";a:1:{s:4:\\"data\\";a:10:{s:2:\\"to\\";s:31:\\"pedrofernandescosta@outlook.com\\";s:7:\\"empresa\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"nombre\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"titulo\\";s:44:\\"Aviso de nuevo cobro - Pedro Fernandes Costa\\";s:17:\\"fecha_vencimiento\\";s:10:\\"31\\/08\\/2018\\";s:6:\\"deudor\\";s:18:\\"Bernardita Labatut\\";s:7:\\"archivo\\";s:48:\\"\\/public\\/images\\/voucher\\/17_voucher_individual.pdf\\";s:8:\\"cobro_id\\";i:17;s:10:\\"registrado\\";b:1;s:3:\\"rut\\";s:16:\\"MTIwNDExODAtMg==\\";}}s:7:\\"binding\\";N;s:5:\\"scope\\";s:20:\\"App\\\\Extras\\\\SendEmail\\";s:8:\\"isStatic\\";b:1;}}"}}', 12, 0, NULL, 1534132223, 1534132223),
	(248, 'default', '{"job":"mailer@handleQueuedMessage","data":{"view":"emails.email_aviso_nuevo_cobro","data":{"to":"pedropfcosta@gmail.com","empresa":"Pedro Fernandes Costa","nombre":"Pedro Fernandes Costa","titulo":"Aviso de nuevo cobro - Pedro Fernandes Costa","fecha_vencimiento":"31\\/07\\/2018","deudor":"Prueba Maca","archivo":"\\/public\\/images\\/voucher\\/3_voucher_individual.pdf","cobro_id":3,"registrado":true,"rut":"MTMyMzQ1NTgtOQ=="},"callback":"C:32:\\"SuperClosure\\\\SerializableClosure\\":792:{a:5:{s:4:\\"code\\";s:245:\\"function ($message) use($data) {\\n    $message->from(\'noreply@portaldepagos.cl\', $data[\'titulo\']);\\n    $message->to($data[\'to\'])->subject(\'Portal de pagos\');\\n    if (!empty($data[\'archivo\'])) {\\n        $message->attach($data[\'archivo\']);\\n    }\\n};\\";s:7:\\"context\\";a:1:{s:4:\\"data\\";a:10:{s:2:\\"to\\";s:22:\\"pedropfcosta@gmail.com\\";s:7:\\"empresa\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"nombre\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"titulo\\";s:44:\\"Aviso de nuevo cobro - Pedro Fernandes Costa\\";s:17:\\"fecha_vencimiento\\";s:10:\\"31\\/07\\/2018\\";s:6:\\"deudor\\";s:11:\\"Prueba Maca\\";s:7:\\"archivo\\";s:47:\\"\\/public\\/images\\/voucher\\/3_voucher_individual.pdf\\";s:8:\\"cobro_id\\";i:3;s:10:\\"registrado\\";b:1;s:3:\\"rut\\";s:16:\\"MTMyMzQ1NTgtOQ==\\";}}s:7:\\"binding\\";N;s:5:\\"scope\\";s:20:\\"App\\\\Extras\\\\SendEmail\\";s:8:\\"isStatic\\";b:1;}}"}}', 13, 0, NULL, 1534132352, 1534132352),
	(249, 'default', '{"job":"mailer@handleQueuedMessage","data":{"view":"emails.email_datos_cambiado","data":{"to":"pedropfcosta@hotmail.com","nombre":"Pedro Fernandes Costa","titulo":"Aviso - Cambio de tus datos en nuestros registros"},"callback":"C:32:\\"SuperClosure\\\\SerializableClosure\\":450:{a:5:{s:4:\\"code\\";s:159:\\"function ($message) use($data) {\\n    $message->from(\'noreply@portaldepagos.cl\', $data[\'titulo\']);\\n    $message->to($data[\'to\'])->subject(\'Portal de pagos\');\\n};\\";s:7:\\"context\\";a:1:{s:4:\\"data\\";a:3:{s:2:\\"to\\";s:24:\\"pedropfcosta@hotmail.com\\";s:6:\\"nombre\\";s:21:\\"Pedro Fernandes Costa\\";s:6:\\"titulo\\";s:49:\\"Aviso - Cambio de tus datos en nuestros registros\\";}}s:7:\\"binding\\";N;s:5:\\"scope\\";s:20:\\"App\\\\Extras\\\\SendEmail\\";s:8:\\"isStatic\\";b:1;}}"}}', 0, 0, NULL, 1534133216, 1534133216),
	(250, 'default', '{"job":"mailer@handleQueuedMessage","data":{"view":"emails.password","data":{"to":"pedropfcosta@hotmail.com","expira":"eyJpdiI6Im5LTDd3YVkxQ0lhY3BIQU5yZlFWZnc9PSIsInZhbHVlIjoidWhSdUNyaThWTEhFeHJrQk9WOGZVXC9nYlNyMDlMR3N1UGRYb2FwXC9sdU93PSIsIm1hYyI6ImM2OTdjOWJmODBjMTFhM2MyNGY4MzNhNjc1OWYzNGIzZGJjMWE0NDE0YzQ4M2QyMDgzOGFkZWYyY2M0YTE1YmUifQ==","email":"eyJpdiI6IlBcL1lWTHV3SDg4NmgxclVuMGRTaWdnPT0iLCJ2YWx1ZSI6ImpIaHd6WExrK0pYNmMxcTNXaDE2OGx2TkdLVDAwUG5YWCtNN3ZnSWxTWk9QV3BEOEhuUXN1azVDMjlxY1NaaisiLCJtYWMiOiIxMGRlNGEzOTdkNDJjM2Q1Nzg3NzFjZmI5MmUwOGMzOTdlOTIyZmI3ZTI4NmE0MDhmZTZhMGEyMDcwNDdlMDJjIn0=","mensaje":"Se le ha enviado el siguiente email para restablecer su contrase\\u00f1a","titulo":"Solicitud de Nueva Clave"},"callback":"C:32:\\"SuperClosure\\\\SerializableClosure\\":979:{a:5:{s:4:\\"code\\";s:159:\\"function ($message) use($data) {\\n    $message->from(\'noreply@portaldepagos.cl\', $data[\'titulo\']);\\n    $message->to($data[\'to\'])->subject(\'Portal de pagos\');\\n};\\";s:7:\\"context\\";a:1:{s:4:\\"data\\";a:5:{s:2:\\"to\\";s:24:\\"pedropfcosta@hotmail.com\\";s:6:\\"expira\\";s:220:\\"eyJpdiI6Im5LTDd3YVkxQ0lhY3BIQU5yZlFWZnc9PSIsInZhbHVlIjoidWhSdUNyaThWTEhFeHJrQk9WOGZVXC9nYlNyMDlMR3N1UGRYb2FwXC9sdU93PSIsIm1hYyI6ImM2OTdjOWJmODBjMTFhM2MyNGY4MzNhNjc1OWYzNGIzZGJjMWE0NDE0YzQ4M2QyMDgzOGFkZWYyY2M0YTE1YmUifQ==\\";s:5:\\"email\\";s:244:\\"eyJpdiI6IlBcL1lWTHV3SDg4NmgxclVuMGRTaWdnPT0iLCJ2YWx1ZSI6ImpIaHd6WExrK0pYNmMxcTNXaDE2OGx2TkdLVDAwUG5YWCtNN3ZnSWxTWk9QV3BEOEhuUXN1azVDMjlxY1NaaisiLCJtYWMiOiIxMGRlNGEzOTdkNDJjM2Q1Nzg3NzFjZmI5MmUwOGMzOTdlOTIyZmI3ZTI4NmE0MDhmZTZhMGEyMDcwNDdlMDJjIn0=\\";s:7:\\"mensaje\\";s:67:\\"Se le ha enviado el siguiente email para restablecer su contrase\\u00f1a\\";s:6:\\"titulo\\";s:24:\\"Solicitud de Nueva Clave\\";}}s:7:\\"binding\\";N;s:5:\\"scope\\";s:20:\\"App\\\\Extras\\\\SendEmail\\";s:8:\\"isStatic\\";b:1;}}"}}', 0, 0, NULL, 1534133260, 1534133260);
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.logaccesos
CREATE TABLE IF NOT EXISTS `logaccesos` (
  `IDLogAcceso` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(10) unsigned NOT NULL,
  `IP` varchar(46) NOT NULL COMMENT 'IPv4 IPv6',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`IDLogAcceso`),
  KEY `LogAccesos_FKIndex1` (`idUsuarios`),
  CONSTRAINT `logaccesos_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.logaccesos: ~95 rows (aproximadamente)
DELETE FROM `logaccesos`;
/*!40000 ALTER TABLE `logaccesos` DISABLE KEYS */;
INSERT INTO `logaccesos` (`IDLogAcceso`, `idUsuarios`, `IP`, `created_at`, `updated_at`) VALUES
	(1, 80, '190.215.90.217', '2018-07-22 18:41:59', '2018-07-22 18:41:59'),
	(2, 75, '190.215.90.217', '2018-07-22 18:43:45', '2018-07-22 18:43:45'),
	(3, 62, '190.215.90.217', '2018-07-22 18:44:39', '2018-07-22 18:44:39'),
	(4, 62, '190.215.90.217', '2018-07-22 18:45:36', '2018-07-22 18:45:36'),
	(5, 80, '190.215.90.217', '2018-07-22 18:46:34', '2018-07-22 18:46:34'),
	(6, 63, '190.215.90.217', '2018-07-22 18:52:08', '2018-07-22 18:52:08'),
	(7, 63, '190.215.90.217', '2018-07-22 18:53:04', '2018-07-22 18:53:04'),
	(8, 62, '190.215.90.217', '2018-07-22 18:54:14', '2018-07-22 18:54:14'),
	(9, 62, '190.215.90.217', '2018-07-22 19:01:03', '2018-07-22 19:01:03'),
	(10, 63, '190.215.90.217', '2018-07-22 19:03:26', '2018-07-22 19:03:26'),
	(11, 62, '190.215.90.217', '2018-07-22 19:09:31', '2018-07-22 19:09:31'),
	(12, 75, '190.215.90.217', '2018-07-22 19:15:14', '2018-07-22 19:15:14'),
	(13, 62, '190.215.90.217', '2018-07-22 19:19:04', '2018-07-22 19:19:04'),
	(14, 62, '190.215.90.217', '2018-07-22 19:24:33', '2018-07-22 19:24:33'),
	(15, 63, '190.215.90.217', '2018-07-22 19:28:57', '2018-07-22 19:28:57'),
	(16, 75, '190.215.90.217', '2018-07-22 19:29:30', '2018-07-22 19:29:30'),
	(17, 80, '190.215.90.217', '2018-07-22 19:31:40', '2018-07-22 19:31:40'),
	(18, 62, '190.215.90.217', '2018-07-22 19:33:23', '2018-07-22 19:33:23'),
	(19, 80, '190.215.90.217', '2018-07-22 19:36:56', '2018-07-22 19:36:56'),
	(20, 75, '190.215.90.217', '2018-07-22 19:47:32', '2018-07-22 19:47:32'),
	(21, 63, '190.215.90.217', '2018-07-22 19:48:08', '2018-07-22 19:48:08'),
	(22, 62, '190.215.90.217', '2018-07-22 19:54:49', '2018-07-22 19:54:49'),
	(23, 75, '190.215.90.217', '2018-07-22 19:59:45', '2018-07-22 19:59:45'),
	(24, 80, '190.215.90.217', '2018-07-22 20:07:42', '2018-07-22 20:07:42'),
	(25, 62, '190.215.90.217', '2018-07-22 20:15:24', '2018-07-22 20:15:24'),
	(26, 75, '190.215.90.217', '2018-07-22 20:18:37', '2018-07-22 20:18:37'),
	(27, 75, '190.215.90.217', '2018-07-22 20:48:42', '2018-07-22 20:48:42'),
	(28, 62, '190.215.90.217', '2018-07-22 21:00:28', '2018-07-22 21:00:28'),
	(29, 63, '190.215.90.217', '2018-07-22 21:16:38', '2018-07-22 21:16:38'),
	(30, 80, '190.215.90.217', '2018-07-22 21:22:58', '2018-07-22 21:22:58'),
	(31, 62, '190.215.90.217', '2018-07-22 21:50:17', '2018-07-22 21:50:17'),
	(32, 80, '190.215.90.217', '2018-07-23 20:57:16', '2018-07-23 20:57:16'),
	(33, 62, '190.215.90.217', '2018-07-23 20:58:21', '2018-07-23 20:58:21'),
	(34, 75, '190.215.90.217', '2018-07-23 21:00:57', '2018-07-23 21:00:57'),
	(35, 80, '190.215.90.217', '2018-07-23 21:04:22', '2018-07-23 21:04:22'),
	(36, 75, '190.215.90.217', '2018-07-23 21:14:25', '2018-07-23 21:14:25'),
	(37, 62, '190.215.90.217', '2018-07-23 21:15:06', '2018-07-23 21:15:06'),
	(38, 75, '190.215.90.217', '2018-07-23 21:16:23', '2018-07-23 21:16:23'),
	(39, 63, '190.215.90.217', '2018-07-23 21:17:24', '2018-07-23 21:17:24'),
	(40, 75, '190.215.90.217', '2018-07-23 21:20:32', '2018-07-23 21:20:32'),
	(41, 63, '190.215.90.217', '2018-07-23 21:23:51', '2018-07-23 21:23:51'),
	(42, 75, '190.215.90.217', '2018-07-23 21:28:46', '2018-07-23 21:28:46'),
	(43, 63, '190.215.90.217', '2018-07-23 21:34:27', '2018-07-23 21:34:27'),
	(44, 62, '190.215.90.217', '2018-07-23 21:35:29', '2018-07-23 21:35:29'),
	(45, 62, '190.215.90.217', '2018-07-23 21:39:30', '2018-07-23 21:39:30'),
	(46, 63, '190.215.90.217', '2018-07-23 21:42:12', '2018-07-23 21:42:12'),
	(47, 80, '190.215.90.217', '2018-07-23 21:52:09', '2018-07-23 21:52:09'),
	(48, 62, '190.215.90.217', '2018-07-23 22:07:29', '2018-07-23 22:07:29'),
	(49, 63, '190.215.90.217', '2018-07-23 22:10:02', '2018-07-23 22:10:02'),
	(50, 75, '190.215.90.217', '2018-07-23 22:12:24', '2018-07-23 22:12:24'),
	(51, 75, '190.215.90.217', '2018-07-23 22:22:17', '2018-07-23 22:22:17'),
	(52, 80, '190.215.90.217', '2018-07-23 22:30:28', '2018-07-23 22:30:28'),
	(53, 75, '190.215.90.217', '2018-07-23 22:48:28', '2018-07-23 22:48:28'),
	(54, 62, '190.215.90.217', '2018-07-23 23:06:14', '2018-07-23 23:06:14'),
	(55, 63, '190.215.90.217', '2018-07-23 23:13:56', '2018-07-23 23:13:56'),
	(56, 80, '190.215.90.217', '2018-07-23 23:24:16', '2018-07-23 23:24:16'),
	(57, 63, '190.215.90.217', '2018-07-23 23:40:44', '2018-07-23 23:40:44'),
	(58, 80, '190.215.90.217', '2018-07-23 23:47:53', '2018-07-23 23:47:53'),
	(59, 80, '190.215.90.217', '2018-07-23 23:57:43', '2018-07-23 23:57:43'),
	(60, 62, '200.9.111.36', '2018-07-24 20:23:57', '2018-07-24 20:23:57'),
	(61, 80, '200.9.111.36', '2018-07-24 20:24:43', '2018-07-24 20:24:43'),
	(62, 80, '191.126.163.85', '2018-07-26 12:50:17', '2018-07-26 12:50:17'),
	(63, 80, '200.9.111.36', '2018-07-27 16:04:02', '2018-07-27 16:04:02'),
	(64, 62, '200.9.111.36', '2018-07-27 16:05:50', '2018-07-27 16:05:50'),
	(65, 62, '200.119.236.113', '2018-07-31 17:12:53', '2018-07-31 17:12:53'),
	(66, 62, '200.119.236.113', '2018-07-31 17:25:03', '2018-07-31 17:25:03'),
	(67, 80, '127.0.0.1', '2018-07-31 17:34:26', '2018-07-31 17:34:26'),
	(68, 62, '127.0.0.1', '2018-07-31 17:49:10', '2018-07-31 17:49:10'),
	(69, 80, '127.0.0.1', '2018-07-31 17:56:39', '2018-07-31 17:56:39'),
	(70, 62, '200.9.111.36', '2018-07-31 18:38:07', '2018-07-31 18:38:07'),
	(71, 80, '200.9.111.36', '2018-07-31 18:39:10', '2018-07-31 18:39:10'),
	(72, 75, '200.9.111.36', '2018-07-31 18:40:32', '2018-07-31 18:40:32'),
	(73, 63, '200.9.111.36', '2018-07-31 18:41:48', '2018-07-31 18:41:48'),
	(74, 80, '191.125.34.195', '2018-07-31 20:05:18', '2018-07-31 20:05:18'),
	(75, 80, '191.125.34.195', '2018-07-31 20:22:54', '2018-07-31 20:22:54'),
	(76, 80, '190.196.22.234', '2018-08-01 18:20:18', '2018-08-01 18:20:18'),
	(77, 80, '190.196.22.234', '2018-08-01 18:55:49', '2018-08-01 18:55:49'),
	(78, 80, '181.208.108.170', '2018-08-10 11:36:19', '2018-08-10 11:36:19'),
	(79, 80, '181.208.108.170', '2018-08-10 11:43:41', '2018-08-10 11:43:41'),
	(80, 80, '181.208.108.170', '2018-08-10 12:19:24', '2018-08-10 12:19:24'),
	(81, 80, '181.208.108.170', '2018-08-10 12:34:40', '2018-08-10 12:34:40'),
	(82, 80, '181.208.108.170', '2018-08-10 12:34:45', '2018-08-10 12:34:45'),
	(83, 80, '181.208.108.170', '2018-08-10 12:41:09', '2018-08-10 12:41:09'),
	(84, 80, '181.208.108.170', '2018-08-10 13:01:47', '2018-08-10 13:01:47'),
	(85, 80, '181.208.108.170', '2018-08-10 13:13:48', '2018-08-10 13:13:48'),
	(86, 80, '181.208.108.170', '2018-08-10 13:20:07', '2018-08-10 13:20:07'),
	(87, 80, '181.208.108.170', '2018-08-10 13:25:59', '2018-08-10 13:25:59'),
	(88, 80, '181.208.108.170', '2018-08-10 13:43:32', '2018-08-10 13:43:32'),
	(89, 80, '181.208.108.170', '2018-08-10 16:22:49', '2018-08-10 16:22:49'),
	(90, 80, '181.208.108.170', '2018-08-10 16:33:33', '2018-08-10 16:33:33'),
	(91, 80, '181.208.108.170', '2018-08-10 16:52:37', '2018-08-10 16:52:37'),
	(92, 80, '181.208.108.170', '2018-08-10 17:17:32', '2018-08-10 17:17:32'),
	(93, 62, '190.215.86.22', '2018-08-13 01:00:27', '2018-08-13 01:00:27'),
	(94, 62, '190.215.86.22', '2018-08-13 01:05:19', '2018-08-13 01:05:19'),
	(95, 62, '186.9.12.215', '2018-08-13 17:10:55', '2018-08-13 17:10:55');
/*!40000 ALTER TABLE `logaccesos` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla pdpdb.migrations: ~3 rows (aproximadamente)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`, `batch`) VALUES
	('2014_10_12_000000_create_users_table', 1),
	('2014_10_12_100000_create_password_resets_table', 1),
	('2016_04_20_213756_create_jobs_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.nominas
CREATE TABLE IF NOT EXISTS `nominas` (
  `idnominas` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idUsuarios` int(10) unsigned NOT NULL,
  `empresa` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha_vencimiento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(3) unsigned DEFAULT '0',
  `todo_pagado` int(11) DEFAULT '0',
  `idUsuarios_hijo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idnominas`),
  KEY `nominas_FKIndex1` (`idUsuarios`),
  CONSTRAINT `nominas_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.nominas: ~3 rows (aproximadamente)
DELETE FROM `nominas`;
/*!40000 ALTER TABLE `nominas` DISABLE KEYS */;
INSERT INTO `nominas` (`idnominas`, `idUsuarios`, `empresa`, `descripcion`, `fecha_vencimiento`, `created_at`, `updated_at`, `eliminado`, `todo_pagado`, `idUsuarios_hijo`) VALUES
	(14, 80, 'Prueba 22 Jul 2018 - 18_34h', NULL, '0000-00-00', '2018-07-22 19:38:21', '2018-07-23 21:10:06', 1, 0, NULL),
	(15, 80, 'Prueba 22 Jul 2018 - 19_05h', NULL, '0000-00-00', '2018-07-22 20:08:30', '2018-07-23 21:06:03', 1, 0, NULL),
	(16, 80, 'Prueba 23 Jul 2018 - 20_52h', NULL, '0000-00-00', '2018-07-23 21:56:31', '2018-07-23 21:56:31', 0, 0, NULL);
/*!40000 ALTER TABLE `nominas` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.nominasdetalle
CREATE TABLE IF NOT EXISTS `nominasdetalle` (
  `idnominasdetalle` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idnominas` int(10) unsigned NOT NULL,
  `nombre` varchar(70) DEFAULT NULL,
  `rut` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `monto` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(3) unsigned DEFAULT '0',
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
  `idunico_pago` varchar(200) NOT NULL,
  PRIMARY KEY (`idnominasdetalle`),
  KEY `nominasdetalle_FKIndex1` (`idnominas`),
  CONSTRAINT `nominasdetalle_ibfk_1` FOREIGN KEY (`idnominas`) REFERENCES `nominas` (`idnominas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.nominasdetalle: ~36 rows (aproximadamente)
DELETE FROM `nominasdetalle`;
/*!40000 ALTER TABLE `nominasdetalle` DISABLE KEYS */;
INSERT INTO `nominasdetalle` (`idnominasdetalle`, `idnominas`, `nombre`, `rut`, `email`, `monto`, `created_at`, `updated_at`, `eliminado`, `fecha_vencimiento`, `descripcion`, `idTipoPago`, `monto_pago`, `pagado`, `nro_transaccion`, `fecha_pago`, `url_adjunto`, `rut_traspaso`, `email_traspaso`, `idunico_pago`) VALUES
	(1, 14, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 230718, '2018-07-22 19:38:21', '2018-07-23 21:10:06', 1, '2018-07-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 22379633-8 / Monto:230718 / Fecha de Vencimiento: 23/7/2018 /pedropfcosta@hotmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP15b55075e04b05'),
	(2, 14, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 230818, '2018-07-22 19:38:22', '2018-07-23 21:10:06', 1, '2018-08-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 22379633-8 / Monto:230818 / Fecha de Vencimiento: 23/8/2018 /pedropfcosta@hotmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP25b55075f56df7'),
	(3, 14, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 230918, '2018-07-22 19:38:23', '2018-07-23 21:10:06', 1, '2018-09-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 22379633-8 / Monto:230918 / Fecha de Vencimiento: 23/9/2018 /pedropfcosta@hotmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP35b550760acc20'),
	(4, 14, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 231018, '2018-07-22 19:38:24', '2018-07-23 21:10:06', 1, '2018-10-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 22379633-8 / Monto:231018 / Fecha de Vencimiento: 23/10/2018 /pedropfcosta@hotmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP45b550762146af'),
	(5, 14, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 231118, '2018-07-22 19:38:26', '2018-07-23 21:10:06', 1, '2018-11-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 22379633-8 / Monto:231118 / Fecha de Vencimiento: 23/11/2018 /pedropfcosta@hotmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP55b5507636d674'),
	(6, 14, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 231218, '2018-07-22 19:38:27', '2018-07-23 21:10:06', 1, '2018-12-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 22379633-8 / Monto:231218 / Fecha de Vencimiento: 23/12/2018 /pedropfcosta@hotmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP65b550764cc96b'),
	(7, 14, 'Pedro Fernandes', '13234558-9', 'pedropfcosta@gmail.com', 2307182, '2018-07-22 19:38:28', '2018-07-23 21:10:06', 1, '2018-07-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 13234558-9 / Monto:2307182 / Fecha de Vencimiento: 23/7/2018 /pedropfcosta@gmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP75b55076632bed'),
	(8, 14, 'Pedro Fernandes', '13234558-9', 'pedropfcosta@gmail.com', 2308182, '2018-07-22 19:38:30', '2018-07-23 21:10:06', 1, '2018-08-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 13234558-9 / Monto:2308182 / Fecha de Vencimiento: 23/8/2018 /pedropfcosta@gmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP85b55076799cba'),
	(9, 14, 'Pedro Fernandes', '13234558-9', 'pedropfcosta@gmail.com', 2309182, '2018-07-22 19:38:31', '2018-07-23 21:10:06', 1, '2018-09-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 13234558-9 / Monto:2309182 / Fecha de Vencimiento: 23/9/2018 /pedropfcosta@gmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP95b55076919e74'),
	(10, 14, 'Pedro Fernandes', '13234558-9', 'pedropfcosta@gmail.com', 2310182, '2018-07-22 19:38:33', '2018-07-23 21:10:06', 1, '2018-10-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 13234558-9 / Monto:2310182 / Fecha de Vencimiento: 23/10/2018 /pedropfcosta@gmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP105b55076ac971c'),
	(11, 14, 'Pedro Fernandes', '13234558-9', 'pedropfcosta@gmail.com', 2311182, '2018-07-22 19:38:35', '2018-07-23 21:10:06', 1, '2018-11-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 13234558-9 / Monto:2311182 / Fecha de Vencimiento: 23/11/2018 /pedropfcosta@gmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP115b55076c8e9d1'),
	(12, 14, 'Pedro Fernandes', '13234558-9', 'pedropfcosta@gmail.com', 2312182, '2018-07-22 19:38:36', '2018-07-23 21:10:06', 1, '2018-12-23', 'Pruba Portal de Pagos Cobrando Pedro Fernandes/ RUT 13234558-9 / Monto:2312182 / Fecha de Vencimiento: 23/12/2018 /pedropfcosta@gmail.com', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP125b55076e5dcb3'),
	(13, 15, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1001, '2018-07-22 20:08:30', '2018-07-23 21:06:03', 1, '2018-07-23', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1001 / Fecha de Vencimiento: 23/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP135b550e6f821a9'),
	(14, 15, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1002, '2018-07-22 20:08:31', '2018-07-23 21:06:03', 1, '2018-07-24', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1002 / Fecha de Vencimiento: 24/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP145b550e70e960b'),
	(15, 15, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1003, '2018-07-22 20:08:33', '2018-07-23 21:06:03', 1, '2018-07-25', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1003 / Fecha de Vencimiento: 25/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP155b550e729ff90'),
	(16, 15, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1004, '2018-07-22 20:08:34', '2018-07-23 21:06:03', 1, '2018-07-26', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1004 / Fecha de Vencimiento: 26/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP165b550e745aff9'),
	(17, 15, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1005, '2018-07-22 20:08:36', '2018-07-23 21:06:03', 1, '2018-07-28', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1005 / Fecha de Vencimiento: 28/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP175b550e7616361'),
	(18, 15, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1006, '2018-07-22 20:08:38', '2018-07-23 21:06:03', 1, '2018-07-29', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1006 / Fecha de Vencimiento: 29/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP185b550e77cf761'),
	(19, 15, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2001, '2018-07-22 20:08:40', '2018-07-23 21:06:03', 1, '2018-07-23', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2001 / Fecha de Vencimiento: 23/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP195b550e798adbb'),
	(20, 15, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2002, '2018-07-22 20:08:41', '2018-07-23 21:06:03', 1, '2018-07-24', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2002 / Fecha de Vencimiento: 24/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP205b550e7b47441'),
	(21, 15, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2003, '2018-07-22 20:08:43', '2018-07-23 21:06:03', 1, '2018-07-25', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2003 / Fecha de Vencimiento: 25/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP215b550e7d02cc1'),
	(22, 15, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2004, '2018-07-22 20:08:45', '2018-07-23 21:06:03', 1, '2018-07-26', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2004 / Fecha de Vencimiento: 26/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP225b550e7ec4e30'),
	(23, 15, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2005, '2018-07-22 20:08:46', '2018-07-23 21:06:03', 1, '2018-07-28', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2005 / Fecha de Vencimiento: 28/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP235b550e8080002'),
	(24, 15, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2006, '2018-07-22 20:08:48', '2018-07-23 21:06:03', 1, '2018-07-29', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2006 / Fecha de Vencimiento: 29/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP245b550e8244e6f'),
	(25, 16, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1001, '2018-07-23 21:56:31', '2018-07-23 22:39:46', 0, '2018-07-23', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1001 / Fecha de Vencimiento: 23/7/2018', 8, 1001, 1, '', '2018-07-23', '', '', '', 'noP255b56794036332'),
	(26, 16, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1002, '2018-07-23 21:56:32', '2018-07-23 21:56:33', 0, '2018-07-24', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1002 / Fecha de Vencimiento: 24/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP265b567941e5f45'),
	(27, 16, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1003, '2018-07-23 21:56:34', '2018-07-23 21:56:35', 0, '2018-07-25', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1003 / Fecha de Vencimiento: 25/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP275b567943b6587'),
	(28, 16, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1004, '2018-07-23 21:56:35', '2018-07-23 21:56:37', 0, '2018-07-26', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1004 / Fecha de Vencimiento: 26/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP285b5679457bbd4'),
	(29, 16, 'Pedro Fernandes', '22379633-8', 'pedropfcosta@hotmail.com', 1005, '2018-07-23 21:56:37', '2018-07-23 21:56:39', 0, '2018-07-28', 'Pruba Portal de Pagos cobrando Pedro Fernandes / RUT 22379633-8 / Monto: 1005 / Fecha de Vencimiento: 28/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP295b56794737415'),
	(30, 16, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2001, '2018-07-23 21:56:39', '2018-08-01 18:35:42', 0, '2018-07-23', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2001 / Fecha de Vencimiento: 23/7/2018', 9, 2001, 1, '', '2018-08-01', '', '', '', 'noP305b567948f1e1e'),
	(31, 16, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2002, '2018-07-23 21:56:41', '2018-07-23 22:40:29', 0, '2018-07-24', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2002 / Fecha de Vencimiento: 24/7/2018', 9, 2002, 1, '', '2018-07-22', '', '', '', 'noP315b56794ab6ce4'),
	(32, 16, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2003, '2018-07-23 21:56:42', '2018-07-31 20:33:38', 0, '2018-07-25', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2003 / Fecha de Vencimiento: 25/7/2018', 3, 2003, 1, '', '2018-07-31', '', '', '', 'noP325b56794c72afd'),
	(33, 16, 'Macarena Recabarren', '13234558-9', 'pedropfcosta@gmail.com', 2004, '2018-07-23 21:56:44', '2018-08-01 19:01:48', 0, '2018-07-26', 'Pruba Portal de Pagos cobrando Macarena Recabarren / RUT 13234558-9 / Monto: 2004 / Fecha de Vencimiento: 26/7/2018', 2, 2004, 1, '', '2018-08-01', '', '', '', 'noP335b56794e42b25'),
	(34, 16, 'Bernardita Labatut', '12041180-2', 'sf_us@hotmail.com', 3001, '2018-07-23 21:56:46', '2018-07-23 21:56:47', 0, '2018-07-23', 'Pruba Portal de Pagos cobrando Bernardita Labatut / RUT 12041180-2 / Monto: 3001 / Fecha de Vencimiento: 23/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP345b56794fa1f80'),
	(35, 16, 'Bernardita Labatut', '12041180-2', 'sf_us@hotmail.com', 3002, '2018-07-23 21:56:47', '2018-07-23 21:56:49', 0, '2018-07-24', 'Pruba Portal de Pagos cobrando Bernardita Labatut / RUT 12041180-2 / Monto: 3002 / Fecha de Vencimiento: 24/7/2018', NULL, NULL, 0, NULL, NULL, '', '', '', 'noP355b5679510d271'),
	(36, 16, 'Bernardita Labatut', '12041180-2', 'sf_us@hotmail.com', 3003, '2018-07-23 21:56:49', '2018-07-23 22:41:05', 0, '2018-07-25', 'Pruba Portal de Pagos cobrando Bernardita Labatut / RUT 12041180-2 / Monto: 3003 / Fecha de Vencimiento: 25/7/2018', 3, 3003, 1, '', '2018-07-21', '', '', '', 'noP365b5679528157d');
/*!40000 ALTER TABLE `nominasdetalle` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla pdpdb.password_resets: ~0 rows (aproximadamente)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.perfiles_cobrado
CREATE TABLE IF NOT EXISTS `perfiles_cobrado` (
  `idperfiles_cobrado` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idperfiles_cobrado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.perfiles_cobrado: ~2 rows (aproximadamente)
DELETE FROM `perfiles_cobrado`;
/*!40000 ALTER TABLE `perfiles_cobrado` DISABLE KEYS */;
INSERT INTO `perfiles_cobrado` (`idperfiles_cobrado`, `descripcion`) VALUES
	(1, 'Consultivo'),
	(2, 'Operativo');
/*!40000 ALTER TABLE `perfiles_cobrado` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.publicidad
CREATE TABLE IF NOT EXISTS `publicidad` (
  `idpublicidad` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `path_imagen` varchar(200) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_termino` datetime NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link` varchar(500) NOT NULL,
  PRIMARY KEY (`idpublicidad`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.publicidad: ~4 rows (aproximadamente)
DELETE FROM `publicidad`;
/*!40000 ALTER TABLE `publicidad` DISABLE KEYS */;
INSERT INTO `publicidad` (`idpublicidad`, `titulo`, `path_imagen`, `descripcion`, `fecha_inicio`, `fecha_termino`, `eliminado`, `activo`, `updated_at`, `created_at`, `link`) VALUES
	(1, 'banner interno', '65-9334650095893c135eda127.38644836.jpg', '....', '2017-02-02 00:00:00', '2017-03-01 00:00:00', 0, 1, '2017-02-02 20:33:12', '0000-00-00 00:00:00', ''),
	(3, 'Probando 1', '11-2930656d338b5816a40.47835125.jpg', 'aaaaaaaaaaaaaaaaaaaa', '2017-02-02 00:00:00', '2017-07-13 00:00:00', 1, 1, '2017-03-03 00:38:29', '2016-02-28 00:08:46', ''),
	(4, 'Sistema de Informes  dqwdqwdqwdq', '52-22491574ceb6330ad27.61735140.jpg', 'aaa', '2016-05-01 00:00:00', '2016-06-30 00:00:00', 1, 1, '2017-02-01 16:39:22', '2016-05-31 02:39:47', ''),
	(5, 'Finciero', '69-23880171858b8e56dc12fb1.88397877.jpg', 'Tarjeta de Crédito Virtual', '2018-07-16 00:00:00', '2018-07-17 00:00:00', 0, 1, '2018-07-16 13:26:04', '2017-03-03 00:39:25', 'WWW.FINCIERO.COM');
/*!40000 ALTER TABLE `publicidad` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.regiones
CREATE TABLE IF NOT EXISTS `regiones` (
  `IDRegion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `region` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`IDRegion`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.regiones: ~15 rows (aproximadamente)
DELETE FROM `regiones`;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.rubros
CREATE TABLE IF NOT EXISTS `rubros` (
  `idrubros` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idrubros`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.rubros: ~20 rows (aproximadamente)
DELETE FROM `rubros`;
/*!40000 ALTER TABLE `rubros` DISABLE KEYS */;
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
	(19, 'Turismo', 0, '2017-03-02 23:21:57', '2017-03-02 23:21:57'),
	(20, 'Otros', 0, '2018-01-28 01:52:35', '2018-01-28 01:52:35');
/*!40000 ALTER TABLE `rubros` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.tipo_cuenta
CREATE TABLE IF NOT EXISTS `tipo_cuenta` (
  `idTipoCuenta` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `editable` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idTipoCuenta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.tipo_cuenta: ~4 rows (aproximadamente)
DELETE FROM `tipo_cuenta`;
/*!40000 ALTER TABLE `tipo_cuenta` DISABLE KEYS */;
INSERT INTO `tipo_cuenta` (`idTipoCuenta`, `descripcion`, `eliminado`, `editable`, `created_at`, `updated_at`) VALUES
	(1, 'Cuenta Corriente', 0, 0, '2017-04-02 15:59:12', '0000-00-00 00:00:00'),
	(2, 'Cuenta Vista', 0, 0, '2017-04-02 15:58:49', '0000-00-00 00:00:00'),
	(3, 'Chequera Electrónica', 0, 0, '2017-04-02 15:59:14', '2017-04-02 12:57:47'),
	(4, 'Cuenta de Ahorro', 0, 0, '2017-04-02 15:59:08', '2017-04-02 12:57:42');
/*!40000 ALTER TABLE `tipo_cuenta` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.tipo_pagos
CREATE TABLE IF NOT EXISTS `tipo_pagos` (
  `idTipoPago` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `editable` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idTipoPago`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.tipo_pagos: ~5 rows (aproximadamente)
DELETE FROM `tipo_pagos`;
/*!40000 ALTER TABLE `tipo_pagos` DISABLE KEYS */;
INSERT INTO `tipo_pagos` (`idTipoPago`, `descripcion`, `eliminado`, `editable`, `created_at`, `updated_at`) VALUES
	(1, 'Transferencia bancaria', 0, 0, '2016-02-12 18:42:01', '0000-00-00 00:00:00'),
	(2, 'Efectivo', 0, 0, '2016-02-12 18:42:01', '0000-00-00 00:00:00'),
	(3, 'Cheque', 0, 0, '2016-02-12 18:42:01', '0000-00-00 00:00:00'),
	(8, 'Tarjeta de Crédito', 0, 1, '2017-03-02 22:00:14', '2017-03-02 22:00:14'),
	(9, 'Tarjeta de Débito', 0, 1, '2017-03-02 22:00:39', '2017-03-02 22:00:39');
/*!40000 ALTER TABLE `tipo_pagos` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla pdpdb.users: ~0 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IDRegion` int(10) unsigned NOT NULL,
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
  `eliminado` smallint(5) unsigned NOT NULL DEFAULT '0',
  `rut` varchar(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `idrubros` int(11) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  `apellido` varchar(50) NOT NULL,
  `razon_social` varchar(50) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT '0',
  `comuna` varchar(50) NOT NULL,
  PRIMARY KEY (`idUsuarios`),
  KEY `Usuarios_FKIndex1` (`IDRegion`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.usuarios: ~18 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`idUsuarios`, `IDRegion`, `remember_token`, `created_at`, `updated_at`, `passwordp`, `email`, `email_alternativo`, `direccion`, `nro_direccion`, `complemento`, `referencia`, `telefono`, `celular`, `eliminado`, `rut`, `nombre`, `idrubros`, `admin`, `apellido`, `razon_social`, `activo`, `comuna`) VALUES
	(62, 7, 'SNg8YCAtJV4QBaLTZmF4nlxUOXf8Lr2bAoPBjbdTTZMbdyQX5L4u3MpCAx9G', '2016-11-23 21:50:02', '2018-08-13 17:14:33', '$2y$10$NXt42PSA7tatZC5esdfMTuymHHbYn6x0mLO9ZEaBKvV9agpS1uyca', 'pedropfcosta@hotmail.com', NULL, 'Av. Costanera Sur 2710', NULL, NULL, NULL, NULL, '979774579', 0, '22379633-8', 'Pedro Fernandes Costa', 2, 0, '', '', 1, 'Las Condes'),
	(63, 1, 'wJPLh3cwuXBrMdXvou1HJKa8WVF145hQpk0aiTpqun141y2ltr4O3lAfqMq3', '2016-11-29 00:18:04', '2018-07-31 18:42:26', '$2y$10$uKAVfw.m8LLOZL7HHir3dO8faFwHIHA6qdiGvKjNFzDnpfJXC2Q4.', 'pedrofernandescosta@outlook.com', NULL, 'Av. La Plaza, 555', NULL, NULL, NULL, NULL, '995334755', 0, '12041180-2', 'Bernardita Larrain', 1, 0, '', '', 1, 'Las Condes'),
	(64, 7, 'q9u8RiNklczlygNgViHqbUTezAvHxwIoLK0SROPtDGwVQXWZ8HKzrhNw3Vh1', '2016-12-01 23:33:44', '2018-07-10 10:39:18', '$2y$10$1rsijRh5VLUDG4YDznytzulECUp9J.0AWgwN84tDEEYGBqoYuOvGG', 'david.cuello@r2da.com', NULL, 'Mi Casa', NULL, NULL, NULL, NULL, '997922049', 0, '25055034-0', 'Luciano Cuello', 15, 0, '', '', 1, 'Maipu'),
	(65, 7, 'HnUETUJPl1Ms01LgLpsafqXpw0vYS1BaQh0J4mu5OfPH3pTCaGFWpEMLlxYX', '2016-12-05 21:08:47', '2017-05-04 20:51:04', '$2y$10$Ih0reZOGq6auoZ1..czZeujeroBueLSj5CPxb/8jzCGiIENa87YL6', 'diego.valladares@outlook.com', NULL, 'Pruebas dirección', NULL, NULL, NULL, NULL, '123456781', 0, '17487145-0', 'diegov1w', 1, 1, '', '', 1, 'Santiago'),
	(68, 7, 'Fc9a9TO4PQj7vbiVkfMtHl4J8DNj1xSRgdDobkFxhcYCDcZSyhllRpiQeysD', '2016-12-20 19:30:46', '2018-06-04 20:18:21', '$2y$10$FTK3O.jn7DBj77iE6Pb.VuzkHqkvAQLkgpVm20Mqa2Uxkji98zcV6', 'proyectos@mediasoft.cl', NULL, 'Guardia Vieja 181 oficina 506', NULL, NULL, NULL, NULL, '998273710', 0, '76200296-5', 'MS Ingeniería y Diseño', 15, 1, '', '', 1, 'providencia'),
	(69, 7, 'OVtieVliCZh5swwDidIn3gdQjnbgSimcJkG3IMENciphWBBrjn8bcSo2rjFC', '2016-12-20 19:44:01', '2017-04-12 19:34:16', '$2y$10$YL6MqxtepSzjQ86Hr.88m.kFrO7VFMUhH5DTZ.w7bIGsMJgwQfmiy', 'kta.jimenez@gmail.com', NULL, 'pedro de valdivia 377', NULL, NULL, NULL, NULL, '987273710', 0, '16181604-3', 'Catalina Jimenez Eberl', 15, 1, '', '', 1, 'Providencia'),
	(70, 7, 'sN0FJ8rEFOfEb6kjoVDmlVCGWxmFhlbHRS247xYt9OhnHvVGtdtfsP03yvdk', '2017-01-19 13:16:31', '2017-03-21 20:06:45', '$2y$10$aHvkISELCXmJ70fcGy.x.OH/hiCln2axWMzh1HblHBuQmh36jkvQS', 'cmartinez@mediasoft.cl', NULL, 'San isidro 337', NULL, NULL, NULL, NULL, '978999714', 0, '15425558-3', 'Carlos Martinez', 15, 0, '', '', 1, 'Santiago'),
	(71, 7, NULL, '2017-01-26 12:42:21', '2017-03-27 17:36:38', '$2y$10$DSGLJ9Qbq2RNdnSsFyHty.ULHSOiE72y/esCZGfzFUadNsrEuKdGS', 'cjimenez@mediasoft.cl', NULL, 'nueva providencia 2353 ', NULL, NULL, NULL, NULL, '998273710', 0, '8970646-7', 'Catalina2 jimenez2', 2, 0, '', '', 1, 'providencia'),
	(72, 7, 'vYZF8gZseTNHtF5oveXdbyVyA4Q0ufCafSP6fJvi71ZZWzrdSHKDIMpKbIxf', '2017-01-26 13:05:27', '2017-02-24 16:37:26', '$2y$10$/Zwf73pgyVSSnx1yMok5Y.Om.JJadEczME8NzDJSbWRDuXpTf4QeG', 'hivechile@gmail.com', NULL, 'nueva providencia 2353 ', NULL, NULL, NULL, NULL, '998273710', 0, '15337220-9', 'Catalina3 Jimenez3', 1, 0, '', '', 1, 'providencia'),
	(75, 7, 'tJibiGPJNFh6BMuN1DGCHvtl0Pm4NpgLYwXviGYIn1zzm403fD6OLmSLoydL', '2017-03-03 20:43:15', '2018-07-31 18:41:22', '$2y$10$8Y2FSipQqwAzcpbKBksekeUXfeJsMyysQ77hFXvBZ52O6gQszZj.y', 'pedropfcosta@gmail.com', NULL, 'Av. La Plaza, 555, Casa 85', NULL, NULL, NULL, NULL, '123456790', 0, '13234558-9', 'Prueba Maca', 1, 0, '', '', 1, 'Las Condes'),
	(76, 7, 'XljJFoRk3gPoHdNvT1VRR8hFMXxBaIF4TfcOYWi14DITZhzrbQfm7oKkvmC6', '2017-03-04 14:51:07', '2017-03-04 17:01:07', '$2y$10$N5OU.csa6taw9/Xxfv4FXeMi04gGz6OqhPiamdXBWf8u4ZacE/G16', 'csaldiasg@fen.uchile.cl', NULL, 'Victor Rae 5858 depto 403', NULL, NULL, NULL, NULL, '998836767', 0, '12966181-k', 'Carlos Saldías', 1, 0, '', '', 1, 'Las condes'),
	(77, 7, 'xeclWooNwX64WYZCMOOdmdNTyrHAY4CK4Ys1E5K0JfK6joYf148O6WWmI7c1', '2017-03-07 12:49:50', '2017-03-28 13:48:41', '$2y$10$tHauBaSprR6FsbfHJ.0PoeT2bF9ewUiS9AehNdP3O4gWp7E55cNqW', 'jckarbu@gmail.com', NULL, 'WARREN SMITH 107 DPTO 215', NULL, NULL, NULL, NULL, '975490736', 0, '14130938-2', 'JUAN CARLOS CARBUCCIA MAYORGA', 1, 0, '', '', 1, 'LAS CONDES'),
	(79, 7, 'Ij5TWmIA0r0PALdh9gqjC8PRYx5Jvq5aNBsN3r2vciaLfI7Gz4ph3s7ppJVW', '2017-03-16 15:53:43', '2017-03-17 16:36:43', '$2y$10$Ds9ptIX/tJ4f36XbQbQE0eXd7nHiWW8V3ICm.Zp625Ee6bMK89zBm', 'pfernandes@bbva.com', NULL, 'Torre Norte', NULL, NULL, NULL, '92751211', '92751211', 1, '22237533-9', 'Yutzzin Valencia', 1, 0, '', '', 1, 'Las Condes'),
	(80, 7, 'h7YKVe1oQqtBr6N5wFoCfhAaiNb6PqEz6j5sudKVEm5YswF82XTQ9fxrRswW', '2017-03-16 18:22:32', '2018-08-10 17:23:35', '$2y$10$/a7kuVgINXmkhWOeck35COY1ACHXn2LGaVTwTX4DHVCK88k/uzEVi', 'pfernandes@portaldepagos.cl', NULL, 'Av. Las Condes, 2100', NULL, NULL, NULL, NULL, '95577591', 0, '76446707-8', 'Portal de Pagos SPA', 1, 1, '', '', 1, 'Las Condes'),
	(81, 7, 'DCN72Yt3ZJbhn7jXuIHNMPYXkiEOXCVFEwdZBlgys8Lszl4gWtqn9XB50FOn', '2017-03-17 16:36:00', '2017-03-17 16:38:40', '$2y$10$wVAGuyx961/OZUe2NbsAY.YeN5nRKbnPmRCWKEIncnuS1M0BITpbi', 'pfernandes@bbva.com', NULL, 'Av, Las Condes', NULL, NULL, NULL, NULL, '988887777', 0, '96801970-8', 'Republic Parkin System Chile S.A. ', 2, 0, '', '', 1, 'Las Condes'),
	(87, 7, 'oRmmI6nsuwKB9h4mC6j87anLGGLmA4M36sxDqUAyNkT339i0xTpg9sLiFc6K', '2017-07-05 13:54:17', '2017-10-06 10:10:46', '$2y$10$FtIxtLJULoWGU0pHj1jF.OAbmDBtdzau6mQepsCvdeMx8IANfcegq', 'ricardoiturral@hotmail.com', NULL, 'ramon laval 1465 casa a', NULL, NULL, NULL, NULL, '996790805', 0, '10199552-6', 'Ricardo Iturra Loyola', 1, 0, '', '', 1, 'La Reina'),
	(88, 7, 'TxLTPxu9aW1oDzvMFmFAq8kFujtwham9PupXqs1vyMuDOyr2jjktXhwldAoG', '2017-07-06 18:35:52', '2017-07-18 19:30:59', '$2y$10$sraNLvnTjKxHmgm2P5tDNusw.dDwtnzhctGv5EXeHBYCjYjHfk/la', 'sadasx@gmail.com', NULL, 'fernando rioja 92', NULL, NULL, NULL, NULL, '988368202', 0, '17180801-4', 'hernan', 1, 0, '', '', 1, 'la cisterna'),
	(92, 7, 'HFu3i5OjzVXoIxfYi62KEYXDvYE8HFUCve8hPFupPeygnNDHFM61ZoCwXvDN', '2017-07-31 20:33:08', '2017-07-31 20:39:51', '$2y$10$zIg6DfSjtKl4Rk/w9YF.nO.isLxJde5gKyrjobhrTsvknqVAW5F3q', 'rfuentesc@r2da.com', NULL, 'Costanera Sur, 3456', NULL, NULL, NULL, NULL, '979774570', 0, '16024794-0', 'Rafael Fuentes', 2, 0, '', '', 1, 'Las Condes');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla pdpdb.vistas_cobradores
CREATE TABLE IF NOT EXISTS `vistas_cobradores` (
  `idVistaCobradores` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuariosMaestro` int(10) unsigned NOT NULL,
  `idperfiles_cobrado` int(11) NOT NULL,
  `idUsuarios` int(10) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `confirmado` int(11) DEFAULT '0',
  `eliminado` int(11) DEFAULT '0',
  PRIMARY KEY (`idVistaCobradores`),
  KEY `fk_vistas_cobradores_usuarios1_idx` (`idUsuariosMaestro`),
  KEY `fk_vistas_cobradores_perfiles_cobrado1_idx` (`idperfiles_cobrado`),
  KEY `fk_vistas_cobradores_usuarios2_idx` (`idUsuarios`),
  CONSTRAINT `fk_vistas_cobradores_perfiles_cobrado1` FOREIGN KEY (`idperfiles_cobrado`) REFERENCES `perfiles_cobrado` (`idperfiles_cobrado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vistas_cobradores_usuarios1` FOREIGN KEY (`idUsuariosMaestro`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_vistas_cobradores_usuarios2` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla pdpdb.vistas_cobradores: ~0 rows (aproximadamente)
DELETE FROM `vistas_cobradores`;
/*!40000 ALTER TABLE `vistas_cobradores` DISABLE KEYS */;
/*!40000 ALTER TABLE `vistas_cobradores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
