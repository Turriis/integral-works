-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Servidor: db5007124918.hosting-data.io
-- Tiempo de generación: 01-04-2022 a las 20:21:33
-- Versión del servidor: 5.7.36-log
-- Versión de PHP: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbs5873766`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients_tb`
--

CREATE TABLE `clients_tb` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(600) NOT NULL,
  `client_lastname` varchar(600) NOT NULL,
  `client_enterprise` varchar(600) NOT NULL,
  `client_email` varchar(600) NOT NULL,
  `client_password` varchar(600) NOT NULL,
  `client_phone` varchar(600) NOT NULL,
  `client_address` text NOT NULL,
  `client_rfc` varchar(600) NOT NULL,
  `client_credit_days` int(11) NOT NULL,
  `client_image` varchar(600) NOT NULL,
  `client_is_enterprise` int(11) NOT NULL DEFAULT '0' COMMENT '¿Es empresa?',
  `client_contact_name` varchar(600) NOT NULL,
  `client_contact_phone` varchar(600) NOT NULL,
  `client_disabled` tinyint(2) NOT NULL DEFAULT '0',
  `client_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `client_user_create` smallint(4) NOT NULL,
  `client_update` date NOT NULL,
  `client_user_update` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clients_tb`
--

INSERT INTO `clients_tb` (`client_id`, `client_name`, `client_lastname`, `client_enterprise`, `client_email`, `client_password`, `client_phone`, `client_address`, `client_rfc`, `client_credit_days`, `client_image`, `client_is_enterprise`, `client_contact_name`, `client_contact_phone`, `client_disabled`, `client_created`, `client_user_create`, `client_update`, `client_user_update`) VALUES
(9, 'Oscar', 'Sosa', '', 'irving+1@cencerro.com.mx', 'c9ba5b6a49799b56ca680913600f8c41', '6141234567', 'Periferico de la juevntud 145', 'FSA63BDG6DVBDN', 0, 'Screenshot_1.png', 0, '', '', 0, '2022-02-22 16:05:01', 9, '2022-03-15', 9),
(10, '', '', 'Alsuper', 'irving+2@cencerro.com.mx', 'd41d8cd98f00b204e9800998ecf8427e', '6141234567', 'Calle Nopal 564', 'FSAHYS8YF', 0, '', 1, '', '', 0, '2022-02-22 19:57:45', 9, '0000-00-00', 0),
(15, '', '', 'Soriana', 'irving@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '6141234567', 'Calle Roble 2001', 'FSA63BDG6DVBD', 5, 'Textura-brokenmetal-final.jpg', 1, 'Rafita el junis', '6141234569', 0, '2022-03-15 15:46:52', 9, '2022-03-16', 9),
(16, '', '', 'Ferreteria de prueba', 'irving+5@cencerro.com.mx', '81dc9bdb52d04dc20036dbd8313ed055', '6141234567', 'Calle de las margaritas 312', 'FSA63BDG6DVBD', 10, 'corvette.jpg', 1, 'Rosa', '6141234568', 0, '2022-03-18 17:58:47', 9, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencies_tb`
--

CREATE TABLE `dependencies_tb` (
  `dependency_id` int(11) NOT NULL,
  `dependency_name` varchar(600) NOT NULL,
  `dependency_address` text NOT NULL,
  `dependency_disabled` tinyint(2) NOT NULL DEFAULT '0',
  `dependency_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dependency_user_created` smallint(4) NOT NULL,
  `dependency_update` date NOT NULL,
  `dependency_user_update` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dependencies_tb`
--

INSERT INTO `dependencies_tb` (`dependency_id`, `dependency_name`, `dependency_address`, `dependency_disabled`, `dependency_created`, `dependency_user_created`, `dependency_update`, `dependency_user_update`) VALUES
(1, 'Saucito', 'Avenida de la juventud Saucito', 1, '2022-03-16 15:54:48', 0, '0000-00-00', 0),
(3, 'Jardines del Sol', 'Calle del pequine 815', 0, '2022-03-14 16:55:56', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privileges_tb`
--

CREATE TABLE `privileges_tb` (
  `privilege_id` int(11) NOT NULL,
  `privilege_name` varchar(255) NOT NULL,
  `privilege_description` text NOT NULL,
  `privilege_level` int(11) NOT NULL,
  `privilege_disabled` tinyint(2) NOT NULL DEFAULT '0',
  `privilege_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privileges_tb`
--

INSERT INTO `privileges_tb` (`privilege_id`, `privilege_name`, `privilege_description`, `privilege_level`, `privilege_disabled`, `privilege_created`) VALUES
(1, 'Superadmin', '', 1, 0, '2022-01-27 16:59:12'),
(2, 'Admin', '', 2, 0, '2022-01-27 16:59:30'),
(3, 'Recursos Humanos', '', 3, 0, '2022-02-14 20:10:20'),
(4, 'Nomina', '', 3, 0, '2022-02-14 20:10:33'),
(5, 'Administración', '', 3, 0, '2022-02-14 20:10:57'),
(6, 'Contadora', '', 3, 0, '2022-02-14 20:11:10'),
(7, 'Supervisor', '', 4, 0, '2022-02-14 20:11:26'),
(8, 'Reclutador', '', 4, 0, '2022-02-14 20:11:40'),
(9, 'Empleado', '', 5, 0, '2022-02-14 20:12:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_tb`
--

CREATE TABLE `users_tb` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(600) NOT NULL,
  `user_password` varchar(600) NOT NULL,
  `user_image` varchar(600) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_date_entry` date NOT NULL,
  `user_vacations_days` int(11) NOT NULL,
  `user_privileges` smallint(4) NOT NULL,
  `user_disabled` tinyint(2) NOT NULL DEFAULT '0',
  `user_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_user_created` smallint(4) NOT NULL,
  `user_update` date NOT NULL,
  `user_user_update` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_tb`
--

INSERT INTO `users_tb` (`user_id`, `user_name`, `user_lastname`, `user_email`, `user_password`, `user_image`, `user_birthday`, `user_date_entry`, `user_vacations_days`, `user_privileges`, `user_disabled`, `user_created`, `user_user_created`, `user_update`, `user_user_update`) VALUES
(9, 'Irving', 'Carrillo', 'irving@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '1994-03-22', '2021-03-10', 15, 1, 0, '2022-01-31 16:10:18', 0, '0000-00-00', 0),
(15, 'Jose', 'Perez', 'irving2@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 2, 0, '2022-02-17 17:56:29', 0, '0000-00-00', 0),
(16, 'Karla', 'González', 'irving3@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 3, 0, '2022-02-17 17:57:48', 0, '0000-00-00', 0),
(17, 'Perla', 'Montalvo', 'irving4@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 4, 0, '2022-02-17 19:56:25', 0, '0000-00-00', 0),
(18, 'Andres', 'Gutierrez', 'irving5@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 5, 0, '2022-02-17 20:12:53', 0, '0000-00-00', 0),
(19, 'Sarahi', 'Licon', 'irving6@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 6, 0, '2022-02-17 20:13:20', 0, '0000-00-00', 0),
(20, 'Ernesto', 'Chavira', 'irving7@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 7, 0, '2022-02-17 20:14:56', 0, '0000-00-00', 0),
(21, 'Jose', 'Dosamantes', 'irving8@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 8, 0, '2022-02-17 20:15:57', 0, '0000-00-00', 0),
(22, 'Ruben', 'Hernandez', 'irving9@cencerro.com.mx', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 9, 0, '2022-02-17 20:18:01', 0, '0000-00-00', 0),
(23, 'Omar', 'Garfio', 'garfio@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '0000-00-00', '0000-00-00', 0, 1, 0, '2022-02-18 18:45:55', 0, '0000-00-00', 0),
(24, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 4, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(25, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 2, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(26, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 7, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(27, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 3, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(28, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 2, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(29, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 9, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(30, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 5, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(31, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 8, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(32, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 2, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(33, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 5, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(34, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 3, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(35, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 1, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(36, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 4, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(37, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 5, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(38, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 6, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(39, 'Enrique4', 'Perez', 'enrique4@cencerro.com', '827ccb0eea8a706c4c34a16891f84e7b', '838px-Spotify_logo_vertical_black.jpeg', '0000-00-00', '0000-00-00', 0, 0, 0, '2022-02-22 16:03:14', 0, '0000-00-00', 0),
(40, 'prueba', 'perez', 'pruebafinal@prueba.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ka.jpg', '0000-00-00', '0000-00-00', 0, 7, 1, '2022-03-18 17:49:55', 0, '0000-00-00', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients_tb`
--
ALTER TABLE `clients_tb`
  ADD PRIMARY KEY (`client_id`);

--
-- Indices de la tabla `dependencies_tb`
--
ALTER TABLE `dependencies_tb`
  ADD PRIMARY KEY (`dependency_id`);

--
-- Indices de la tabla `privileges_tb`
--
ALTER TABLE `privileges_tb`
  ADD PRIMARY KEY (`privilege_id`);

--
-- Indices de la tabla `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients_tb`
--
ALTER TABLE `clients_tb`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `dependencies_tb`
--
ALTER TABLE `dependencies_tb`
  MODIFY `dependency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `privileges_tb`
--
ALTER TABLE `privileges_tb`
  MODIFY `privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
