-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2016 a las 18:31:19
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `fecha_nac` date NOT NULL,
  `tipo` int(1) NOT NULL,
  `activo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombre`, `apellidos`, `email`, `pw`, `sexo`, `fecha_nac`, `tipo`, `activo`) VALUES
(1, 'admin', 'admin', 'admin@correo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'H', '1991-01-30', 3, 1),
(4, 'alejandro', 'lopez', 'ale@correo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '1990-05-12', 1, 1),
(5, 'pepe', 'perez', 'pepe@correo.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '', '1981-12-30', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuario_tarea`
--

CREATE TABLE `tb_usuario_tarea` (
  `id_usuario_tarea` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tarea` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `mareli` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_usuario_tarea`
--

INSERT INTO `tb_usuario_tarea` (`id_usuario_tarea`, `id_usuario`, `tarea`, `descripcion`, `estado`, `mareli`) VALUES
(1, 1, 'disenar', 'agregar estilo a la pagina', 'pendiente', 1),
(2, 1, 'limpiar formulario', 'creacion de metodos para la validacion del formulario', 'iniciada', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tb_usuario_tarea`
--
ALTER TABLE `tb_usuario_tarea`
  ADD PRIMARY KEY (`id_usuario_tarea`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tb_usuario_tarea`
--
ALTER TABLE `tb_usuario_tarea`
  MODIFY `id_usuario_tarea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
