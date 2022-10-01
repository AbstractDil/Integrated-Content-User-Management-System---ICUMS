-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2022 at 10:07 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `combined`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `Date_Time` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `uid` varchar(12) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `activity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `Date_Time`, `name`, `email`, `password`, `uid`, `ip`, `role`, `activity`) VALUES
(8, '2022-09-28 22:32:22 PM', 'Sagar', 'sagar2016nandy@gmail.com', '$2y$10$BTVm8Xfa24e/Me5XyZDBYeKTW6oW9ZoRWGywwI0iJi/zs8VkJv8LG', 'MCU202294269', '::1', 1, 1),
(9, '2022-09-28 22:36:14 PM', 'Sagar Nandy', 'nandysagar@yahoo.com', '$2y$10$gVVvHaf9jNOurBIl4RbJmeto3hL7e3PCesp0TD9EvAJ0FLznxPRve', 'MCU202252469', '::1', 2, 0),
(10, '2022-09-28 22:51:35 PM', 'Sagar555', 'mathhub.sagar@gmail.com', '$2y$10$gflBLXeGa25xgFtjoArPsOwM1T54fNS.VYG6l5VJE8/wiSiNz7KwG', 'MCU202283517', '::1', 0, 0),
(12, '2022-09-30 13:00:15 PM', 'Dipangshu DP', 'm03710576@gmail.com', '$2y$10$lTaa.Hc/3VQvGAoq6LfIvO5iP82uKgC4U9Izoy2qCC4Vtq7naaSyO', 'MCU202223758', '192.168.0.103', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
