-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2018 a las 00:16:18
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panel_roldan`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(1) NOT NULL,
  `Prefix` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `From` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `To` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `InvoiceAuthorization` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `StartDate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EndDate` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SoftwareID` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ClTec` varchar(38) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Pin` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `Prefix`, `From`, `To`, `InvoiceAuthorization`, `StartDate`, `EndDate`, `SoftwareID`, `ClTec`, `Pin`) VALUES
(0, 'PRUEf', '980000000', '985000000', '9000000105596663', '2018-02-14', '2028-02-14', 'ff8d5e3f-6746-40cb-9621-d52903f7d8b7', 'dd85db55545bd6566f36b0fd3be9fd8555c36e', '3L3m3nt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `factura_numero` int(15) NOT NULL,
  `tercero_numero` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `tercero_nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `factura_fecha` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `dian_r` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_r` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `id_empresa` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`correo`, `clave`, `id_empresa`) VALUES
('a@a.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`factura_numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
