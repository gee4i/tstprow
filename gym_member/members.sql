-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2024 at 05:20 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `membership_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `max_reservations` int NOT NULL DEFAULT '5',
  `reservations_count` int DEFAULT '0',
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `password`, `membership_status`, `max_reservations`, `reservations_count`, `role`) VALUES
(1, 'Beros', 'Beros123', 'active', 5, 0, 'user'),
(2, 'Jeihan', 'Jeihan123', 'active', 5, 0, 'user'),
(3, 'Algi', 'Algi123', 'active', 5, 0, 'user'),
(4, 'Manda', 'Manda123', 'active', 5, 0, 'user'),
(5, 'Hasu', 'Hasu123', 'active', 5, 0, 'user'),
(6, 'Oyi', 'Oyi123', 'active', 10, 0, 'admin'),
(7, 'beruk', '$2y$10$CSXrGOlflEnQRmBSpibQv.s2VyqCxviuxy4IpEM/MuxDUA6odSdS6', 'active', 5, 0, 'user'),
(8, 'besto', '$2y$10$QkeEC6/nSdErRuFaJ/ilkOtmkDIE3Rf0J/BQObQ8Ub1AkSSiAJoNe', 'active', 5, 0, 'user'),
(9, 'andi', '$2y$10$SUp4Z0D389RRjagq3.OKBu/DeJMLFV0kMpQYDDuVSuaN1fqgApn6K', 'active', 5, 0, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
