-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2021 at 11:34 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaccion`
--

CREATE TABLE `transaccion` (
  `id` int(11) NOT NULL,
  `cuenta_id` int(11) NOT NULL,
  `tipo_transaccion_id` int(11) NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaccion`
--

INSERT INTO `transaccion` (`id`, `cuenta_id`, `tipo_transaccion_id`, `monto`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1000.00', '2021-09-03 20:12:29', '2021-09-03 20:12:29'),
(4, 1, 2, '8100.00', '2021-09-03 21:38:55', '2021-09-03 21:38:55'),
(5, 1, 2, '800.00', '2021-09-03 21:39:30', '2021-09-03 21:39:30'),
(6, 1, 2, '9000.00', '2021-09-06 15:37:33', '2021-09-06 15:37:33'),
(7, 1, 2, '9000.00', '2021-09-06 15:37:54', '2021-09-06 15:37:54'),
(8, 1, 2, '9000.00', '2021-09-06 15:38:26', '2021-09-06 15:38:26'),
(9, 1, 1, '900.00', '2021-09-06 15:38:29', '2021-09-06 20:25:13'),
(10, 1, 2, '9000.00', '2021-09-06 15:38:33', '2021-09-06 15:38:33'),
(11, 3, 2, '107000.00', '2021-09-06 15:39:27', '2021-09-06 15:39:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaccion_cuenta1_idx` (`cuenta_id`),
  ADD KEY `fk_transaccion_tipo_transaccion1_idx` (`tipo_transaccion_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaccion`
--
ALTER TABLE `transaccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaccion`
--
ALTER TABLE `transaccion`
  ADD CONSTRAINT `fk_transaccion_cuenta` FOREIGN KEY (`cuenta_id`) REFERENCES `cuenta` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaccion_tipo_transaccion` FOREIGN KEY (`tipo_transaccion_id`) REFERENCES `tipo_transaccion` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
