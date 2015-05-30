-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2015 a las 21:18:26
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bestnid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Ropa y Accesorios'),
(2, 'Animales'),
(3, 'Antiguedades'),
(4, 'Alimentos'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `contenido`, `id_producto`, `id_usuario`) VALUES
(1, 'Hola que buenos guantes!', 1, 1),
(7, 'QUIERO ESTA LLAMA YA!', 2, 1),
(9, 'No lo encontraba por ningun lado ', 6, 1),
(10, 'Excelente Celular!\r\nSaludos', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `titulo`, `foto`, `descripcion`, `estado`, `fecha_ini`, `fecha_fin`, `id_categoria`, `id_usuario`) VALUES
(1, 'Guantes de Acero', 'https://www.3tres3.com/3tres3_common/tienda/img/guante-malla-acero-inox_1137_1.jpg', 'Guante de malla de acero inox. tejido, anticorte, marca *manulatex* de industria francesa\r\n', 1, '2015-05-20', '2015-06-20', 1, 1),
(2, 'Llama', 'https://pbs.twimg.com/profile_images/269279233/llama270977_smiling_llama_400x400.jpg', 'Llama adulta oriunda de Tilcara. Es mansita\r\n', 0, '2015-05-13', '2015-06-13', 2, 1),
(3, 'Espejo', 'http://41.media.tumblr.com/ad056adadfeeced7f24f918a843a0f60/tumblr_nbsf4rGZFE1tlipbuo1_1280.jpg', 'Espejo sin marco. Medidas: 0.8m x 1.2m', 0, '2015-05-27', '2015-06-27', 3, 1),
(4, 'Kriptonita', 'http://41.media.tumblr.com/8e08757ed8fd1c3368e29dc127140ef1/tumblr_nbsewqvU231tlipbuo1_1280.jpg', '200 gramos de Kriptonita', 0, '2015-05-25', '2015-06-25', 5, 1),
(5, 'Aceite y Vinagre', 'http://40.media.tumblr.com/f92d39b2c62cf2bc5398797db35ce37d/tumblr_nbsejfmSt21tlipbuo1_400.jpg', '200ml de aceite y 300ml de vinagre. No incluye fascos', 0, '2015-05-16', '2015-06-16', 4, 1),
(6, 'Nexus 4', 'http://www.theinquirer.net/IMG/537/240537/lg-google-nexus-4.jpg', 'El LG Nexus 4 desarrollado junto con Google. Posee un procesador quad-core Snapdragon S4 Pro a 1.5GHz, pantalla WXGA True HD IPS Plus de 4.7 pulgadas, 2GB de RAM, cámara trasera de 8 megapixels, cámara frontal de 1.3 megapixels y batería de 2100mAh. Además, posee soporte NFC, y carga inalámbrica, aunque no es LTE sino que está limitado a HSPA+.', 1, '2015-05-28', '2015-06-28', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `user` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `pass` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tarjeta_credito` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `documento`, `user`, `pass`, `email`, `tarjeta_credito`) VALUES
(1, 'Nicolas', 'Banegas', 38706949, 'banegasn', '1144', 'nicobanegas.sc@gmail.com', 123456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE IF NOT EXISTS `venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `monto` double NOT NULL,
  `motivo` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
