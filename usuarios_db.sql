-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 12, 2021 at 03:36 PM
-- Server version: 10.6.3-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usuarios_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(3, 'Lacteos', 'Leche'),
(4, 'Carnes', 'Carner moradas'),
(5, 'Verduras', 'Verduras'),
(6, 'Licores', 'Licores de Sabor');

-- --------------------------------------------------------

--
-- Table structure for table `entradas`
--

CREATE TABLE `entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `entrada` date NOT NULL,
  `caducidad` date NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_prod`, `cantidad`, `entrada`, `caducidad`, `user`) VALUES
(1, 4, 10, '2021-08-11', '2021-08-12', 1),
(2, 2, 11, '2021-08-11', '2021-08-14', 1),
(3, 6, 5, '2021-08-11', '2021-09-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_prod` int(11) NOT NULL,
  `nombre_prod` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `estock_min` int(25) DEFAULT NULL,
  `unidad` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_prod`, `nombre_prod`, `area`, `descripcion`, `id_categoria`, `estock_min`, `unidad`, `existencia`) VALUES
(1, 'Lechuga', 'Cocina', 'Lechuga orejona', 1, 2, 'pz', 2),
(2, 'Plato', 'Piso', 'Plato para café', 2, 5, 'pz', 5),
(3, 'Queso', 'Cocina', 'Queso cheddar', 3, 1, 'pz', 5),
(5, 'Azucar', 'cocina', 'Azucar morena', 52, 10, 'kilos', 20),
(6, 'Whikey', 'barra', 'Botella de 750 ml', 27, 1, 'pz', 3),
(7, 'Arrachera', 'cocina', 'Arrachera para tacos', 4, 9, 'kilos', 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'cocina'),
(3, 'barra'),
(4, 'piso');

-- --------------------------------------------------------

--
-- Table structure for table `salidas`
--

CREATE TABLE `salidas` (
  `id_salida` int(11) NOT NULL,
  `id_prod` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `salida` date DEFAULT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salidas`
--

INSERT INTO `salidas` (`id_salida`, `id_prod`, `cantidad`, `salida`, `user`) VALUES
(1, 4, 20, '2021-08-20', 1),
(2, 2, 11, '2021-08-20', 2),
(3, 1, 102, '2021-09-01', 1),
(4, 30, 600, '2021-10-13', 2),
(5, 78, 66, '2021-06-02', 3),
(6, 8, 1, '2021-08-11', 1),
(7, 6, 1, '2021-08-11', 1),
(8, 6, 52, '2021-08-11', 1),
(9, 89, 100, '2021-08-12', 3),
(10, 64, 1000, '2021-08-13', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usuario`, `password`, `idRol`) VALUES
(1, 'Administrador', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(2, 'Cocina', '99281303f6eab9edf2ec9f7ffde1bbaa', 2),
(3, 'Barra', '97c1fad8d8d23747d6184693dffab860', 3),
(4, 'Piso', '309b1d8e870c6711d5731b0b26b695eb', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `id_prod` (`id_prod`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `id_prod` (`id_prod`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
