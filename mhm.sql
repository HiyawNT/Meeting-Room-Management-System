-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2023 at 05:55 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mhm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com'),
(2, 'ad', '$2y$12$qPljAbMFqY7ZVE7CFucBeuCMoEIw.gVOxmr7Apj9yE.SZOBbSTUHu', 'ad@gmail.com'),
(3, 'h', '$2y$12$U25VgyfYsYvsPnKi3r2nQ.fyHYUhfg.I3Ojx2JEMFRUcz02XdTzdu', 'h@gmail.com'),
(4, 'Hiyaw', '$2y$12$HsV8vw5Yjegyyg02vwiArOy8SEU4unYmTbetOI0bgf9vK3bHmIMFO', 'hiyawnfourever@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `approval_history`
--

DROP TABLE IF EXISTS `approval_history`;
CREATE TABLE IF NOT EXISTS `approval_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `approval_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `capacity`, `status`, `description`) VALUES
(2, 'Meeting Hall 1', 31, 'unavailable', 'Meeting Room 1st Floor'),
(3, 'Meeting Hall 2', 20, 'unavailable', 'Meeting room 2st Floor '),
(4, 'Meeting Hall 3', 18, 'unavailable', 'Meeting room 3st Floor '),
(6, 'Meeting Hall 5', 5, 'unavailable', 'Meeting room 5st Floor '),
(7, 'Meeting Hall 6', 15, 'available', 'Meeting room 6st Floor '),
(13, 'Meeting Hall 10', 32, 'available', '3 Floor, Left Wing'),
(15, 'Meeting Hall 11', 34, 'available', '2nd Floor Right Wing');

-- --------------------------------------------------------

--
-- Table structure for table `room_reservation`
--

DROP TABLE IF EXISTS `room_reservation`;
CREATE TABLE IF NOT EXISTS `room_reservation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` int NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_reservation`
--

INSERT INTO `room_reservation` (`id`, `room_id`, `start_date`, `end_date`, `duration`, `start_time`, `end_time`, `user_id`, `reason`, `status`) VALUES
(27, 4, '2023-05-26', '0000-00-00', 0, '00:20:23', '00:20:23', '2', 'meeting for Inventory team', 'rejected'),
(45, 2, '2023-05-10', '2023-05-13', 3, '17:11:00', '18:11:00', '6', 'Meeting for the HR team', 'approved'),
(46, 3, '2023-05-11', '2023-05-12', 1, '16:52:00', '19:52:00', '6', 'meeting for Inventory team', 'pending'),
(47, 2, '2023-05-24', '2023-05-25', 1, '02:01:00', '19:05:00', '6', 'Meeting for labratory team', 'pending'),
(48, 6, '2023-05-18', '2023-05-19', 1, '00:45:00', '10:45:00', '6', 'From Logged', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `department` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `department`) VALUES
(2, 'yonas', '$2y$12$sawleNuRPQbQhkSqHEbsbu/meXEoi6uJESh6GgSRkRv.gBWD2MImW', 'admin@gmail.com', 'labratory'),
(3, 'office', '$2y$12$rEtd0C9c4OKs5xgCgiHcG.EQGsM8xlVp/Gp6ajkYdMelfmC0RS3ta', 'b@gmail.com', 'finance'),
(4, 'sami', '$2y$12$sSpHsyR7O7tLK.Q88bfT0O9RkpnICIZDnz2lKIJlVVlmuSMij7UOe', 'sam@gmail.com', 'human resource'),
(5, 'james', '$2y$12$qp072byN3NoQbrEwCCjcKugR0HkHE8h9ucdTZCusk8qk.Ixmy4Mqm', 'tade@gmail.com', 'human resource'),
(6, 'abdul', '$2y$12$2doSjjC7zNuuqJfuUc7uSO.Inxef1swroousaEtxwlyoa87WUVfrC', 'abdul@gmail.com', 'labratory');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approval_history`
--
ALTER TABLE `approval_history`
  ADD CONSTRAINT `approval_history_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `room_reservation` (`id`),
  ADD CONSTRAINT `approval_history_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Constraints for table `room_reservation`
--
ALTER TABLE `room_reservation`
  ADD CONSTRAINT `room_reservation_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
