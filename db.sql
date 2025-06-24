-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2025 a las 02:17:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mesh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `post_id` int(9) NOT NULL,
  `owner` varchar(32) NOT NULL,
  `text` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`post_id`, `owner`, `text`, `fecha`) VALUES
(1, 'pepe', 'Hello World', '2025-06-23 21:10:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liked_posts`
--

CREATE TABLE `liked_posts` (
  `post_id` int(9) NOT NULL,
  `username` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `liked_posts`
--

INSERT INTO `liked_posts` (`post_id`, `username`) VALUES
(0, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(9) NOT NULL,
  `title` varchar(32) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `edited` int(1) NOT NULL DEFAULT 0,
  `comments_cant` int(4) NOT NULL DEFAULT 0,
  `likes` int(5) NOT NULL DEFAULT 0,
  `owner` varchar(32) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `edited`, `comments_cant`, `likes`, `owner`, `fecha`) VALUES
(1, 'Primer Post', 'Hola mundo!', 0, 1, 1, 'juance', '2025-06-23 21:09:18'),
(2, 'Post 2', 'awdbawyudvaw', 0, 0, 0, 'pepe', '2025-06-23 21:10:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `username` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password_hash` varchar(32) NOT NULL,
  `session_md5` varchar(32) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`username`, `email`, `password_hash`, `session_md5`, `last_login`) VALUES
('juance', 'elpapu@gmail.com', '202cb962ac59075b964b07152d234b70', '4648452287452bc202cbd43ec0a79b2d', '0000-00-00 00:00:00'),
('pepe', 'pepe@gmail.com', '202cb962ac59075b964b07152d234b70', 'e3411296c70debfd91b8409757d937f2', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
