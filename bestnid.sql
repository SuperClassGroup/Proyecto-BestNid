-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2015 a las 08:01:19
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
  `nombre` varchar(45) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Ropa y Accesorios'),
(2, 'Animales'),
(3, 'Antiguedades'),
(4, 'Alimentos'),
(5, 'Otros'),
(6, 'Tecnologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `contenido`, `respuesta`, `id_producto`, `id_usuario`) VALUES
(1, 'Hola que buenos guantes!', '', 1, 1),
(7, 'QUIERO ESTA LLAMA YA!', '', 2, 1),
(9, 'No lo encontraba por ningun lado ', '', 6, 1),
(10, 'Excelente Celular!\r\nSaludos', '', 6, 1),
(11, 'Como que no incluye frascos?', 'No, vienen en bolsitas de plastico', 5, 1),
(12, 'Hola lo quiero!', 'Podes darle a "Comprar" si es que lo queres!', 5, 1),
(13, 'Que bueno!', '', 5, 1),
(14, 'Es un espejo? Es un cuadro nada mas eso! ', '', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `estado` smallint(6) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_user_ganador` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `titulo`, `foto`, `descripcion`, `estado`, `fecha_ini`, `fecha_fin`, `id_categoria`, `id_usuario`, `id_user_ganador`) VALUES
(1, 'Guantes de Acero', 'fotos/1.jpg', 'Guante de malla de acero inox. tejido, anticorte, marca *manulatex* de industria francesa\r\n', 1, '2015-05-20', '2015-06-20', 1, 1, 0),
(2, 'Llama', 'fotos/2.jpg', 'Llama adulta oriunda de Tilcara. Es mansita\r\n', 2, '2015-05-13', '2015-06-13', 2, 1, 3),
(3, 'Espejo', 'fotos/20150623124958.jpg', 'Marco sin espejo. Medidas: 0.8m x 1.2m', 2, '2015-05-27', '2015-06-27', 3, 1, 0),
(4, 'Kriptonita', 'fotos/20150623125704.jpg', '200 gramos de Kriptonita Pura', 2, '2015-05-25', '2015-06-25', 5, 1, 0),
(5, 'Aceite y Vinagre', 'fotos/6.jpg', '200ml de aceite y 300ml de vinagre. No incluye fascos', 1, '2015-05-16', '2015-06-16', 4, 1, 2),
(6, 'Nexus 4', 'fotos/5.jpg', 'El LG Nexus 4 desarrollado junto con Google. Posee un procesador quad-core Snapdragon S4 Pro a 1.5GHz, pantalla WXGA True HD IPS Plus de 4.7 pulgadas, 2GB de RAM, camara trasera de 8 megapixels, camara frontal de 1.3 megapixels y bateria de 2100mAh. Ademas, posee soporte NFC, y carga inalambrica, aunque no es LTE sino que esta limitado a HSPA+.', 2, '2015-05-28', '2015-06-28', 6, 1, 0),
(7, 'Hamburguesa', 'fotos/20150623035755.jpg', 'Una rica y deliciosa Hamburguesa con la mejor carne Argentina', 0, '2015-06-22', '2015-07-22', 4, 1, 0),
(8, 'Zapatillas Nike Air Futurun 2 ', 'fotos/20150623041930.jpg', 'Zapatillas Nike Perfectas para ir a correr un dia de mucho frio', 2, '2015-06-22', '2015-07-17', 1, 4, 0),
(9, 'Boxer Atigrado', 'fotos/20150623093829.jpg', 'Perros fieles si los hay los boxers, este cachorro tiene 4 meses.', 0, '2015-06-23', '2015-07-23', 2, 3, 0),
(10, 'Tocadiscos', 'fotos/20150715052631.jpg', 'Los tocadiscos son aparatos que extraen y amplifican la música contenida en un disco de vinilo. Una aguja recorre la pista grabada en el soporte reproduciendo la vibración inscrita en el. La señal es posteriormente amplificada.', 0, '2015-07-15', '2015-08-04', 3, 5, 0),
(11, 'Impresora 3D - MakerBot Replicator 2', 'fotos/20150715053435.jpg', 'La Replicator 2X es un modelo clásico de Makerbot Industries. Es un impresora particularmente estable especializada en la impresión de ABS que integra un doble cabezal.\r\nAdemás puede trabajar con filamento soluble de tipo HIPS, con Ninjaflex, Semiflex, XT o Nylon.', 0, '2015-07-15', '2015-08-14', 6, 3, 0),
(12, 'Bajo - Sterling By Musicman Sub Series Ray 4', 'fotos/20150715053741.jpg', 'La familia de instrumentos Sub Series introduce un nuevo nivel de calidad con características y un valor para el músico intermedio o principiante. Parte de la estimada familia de instrumentos Music Man & Sterling By Music Man familia, cree que todos los músicos deben tener a instrumentos que se sienten como un instrumento profesional', 0, '2015-07-15', '2015-08-09', 5, 4, 0),
(13, 'Sony Play Station 4 500GB ', 'fotos/20150715054015.jpg', 'Este PlayStation 4 tiene para ti experiencias más grandes y emocionantes a las que estás acostumbrado. Cuenta con un impresionante rendimiento gráfico que te brindará juegos mucho más realistas. Puedes jugar con una mayor precisión gracias a su altavoz y sensores de movimiento integrados. Tiene 500 Gb de memoria de disco duro, Bluetooth y WiFi, por lo que podrás jugar en línea con tus amigos, compartir tus trofeos, ver películas, y mucho más. ', 0, '2015-07-15', '2015-08-14', 6, 3, 0),
(14, 'Buzo Montagne de mujer Osaka', 'fotos/20150715054305.jpg', 'TELA: Ultra Term 265grs./m2. Tejido bicolor con interior frizado, bondeado por ultrasonido y buena repelencia al agua. Poliéster 100%.\r\n\r\n \r\n\r\nDESCRIPCIÓN:\r\n• Capucha fija con 2 puntos de ajuste.\r\n• Costuras stretch.\r\n• Manga ranglan.\r\n• Bolsillos laterales con cierres.\r\n• Medio cierre desplazado.', 0, '2015-07-15', '2015-08-14', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `apellido` varchar(45) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `user` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tarjeta_credito` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `token` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `documento`, `user`, `pass`, `email`, `tarjeta_credito`, `admin`, `deleted`, `token`) VALUES
(1, 'Nicolas', 'Banegas', 38706949, 'banegasn', '1144', 'nicobanegas.sc@gmail.com', 123456789, 0, 0, '7815696ecbf1c96e6894b779456d330e'),
(3, 'Fermin', 'Minetto', 1234, 'minettof', '1144', 'ferminmi@yahoo.com', 123123123, 1, 0, '912ec803b2ce49e4a541068d495ab570'),
(4, 'Leandro', 'Mariperisena', 1234, 'mariperisenal', '1144', 'leandro.mariperisena@gmail.com', 1234, 0, 0, '22ca8686bfa31a2ae5f55a7f60009e14'),
(5, 'Juan', 'Perez', 1234, 'perezj', '1144', 'perezjuan@hotmail.com', 1234, 0, 0, '8f69d6aae16078588fee866dd3fdc1fc');

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
  `canceled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `id_usuario`, `id_producto`, `monto`, `motivo`, `canceled`) VALUES
(1, 1, 8, 10, 'Las quiero porque tengo que empezar a correr', 0),
(11, 1, 9, 1564.25, 'Es un hermoso perro', 0),
(12, 3, 2, 100, 'Me gusta cuando las llamas me escupen en la cara', 0),
(14, 3, 7, 150, 'Me encantan, son mi debilidad.', 0),
(15, 4, 2, 1500, 'Mi hijo de 7 años la quiere', 0),
(16, 4, 6, 2000, 'Necesito un celu porque me lo robaron.', 0),
(17, 3, 6, 1500, 'Lo quiero para mandarle mensajitos a mi hermano que vive lejos', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
