-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2022 at 10:08 PM
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
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `nid` int(11) NOT NULL,
  `Date_Time` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `edit_date` varchar(100) NOT NULL,
  `fees` varchar(255) NOT NULL,
  `application_link` varchar(255) NOT NULL,
  `notification_link` varchar(255) NOT NULL,
  `other` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`nid`, `Date_Time`, `title`, `start_date`, `end_date`, `edit_date`, `fees`, `application_link`, `notification_link`, `other`) VALUES
(15, '2022-09-30 22:22:14 PM', 'SBI RECRUITMENT OF PROBATIONARY OFFICERS 2022', '2022-09-22', '2022-10-12', '2022-10-12', 'Rs. 750/- for General, OBC and EWS candidates and Rs. Nil for SC/ST/PwBD/ESM/DESM', 'https://ibpsonline.ibps.in/sbiposep22/', 'https://www.sbi.co.in/documents/77530/25386736/220922-Revised_detailed+Advt.+English+PO+22-23_21.09.2022_final.pdf/d2a2b4af-c2e9-2184-a004-cc117623bbfa?t=1663835686570', ''),
(16, '2022-09-30 23:05:12 PM', 'SBI RECRUITMENT OF JUNIOR ASSOCIATES 2022', '2022-09-12', '2022-09-27', '2022-09-27', 'Rs. 750/- for General, OBC and EWS candidates and Rs. Nil for SC/ST/PwBD/ESM/DESM', 'https://ibpsonline.ibps.in/sbijajul22/', 'https://ibpsonline.ibps.in/sbijajul22/', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`nid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `nid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
