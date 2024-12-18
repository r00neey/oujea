-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2024 at 06:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `weba`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(200) NOT NULL,
  `prijmeni` varchar(200) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefon` int(9) NOT NULL,
  `pracovna` varchar(50) NOT NULL,
  `popisek` varchar(50) NOT NULL,
  `heslo` varchar(100) NOT NULL,
  `admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `jmeno`, `prijmeni`, `email`, `telefon`, `pracovna`, `popisek`, `heslo`, `admin`) VALUES
(26, 'pokus-formx', 'pokus-form', 'pokus-form@gmail.com', 123456789, '5002', 'ahoj', '$2y$10$RdS47Lfcn/7y8bXlNy0hQ.T08Yvv878a2I7R2DHAhKQ3R6YN9MtEK', 0),
(27, 'pokus-form2', 'pokus-form2', 'dsadsa@gmail.com', 123453252, '5002', 'fest-popisek', '$2y$10$/w1MYICvhPUdyTaz5JRamuFzo460iSTgtKsWc9uEo4Ug.OeYgOGFO', 0),
(29, 'dsadnjsa', 'daknfoa', 'dsadsa@gmail.com', 123456789, '5002', '', '$2y$10$xCJfRXKtnQ8FsOZnssrRFutQHsBX/sr8PXl5fcIzAJPcMqLCKpKqi', 0),
(30, 'idjaidj', 'dkodqo', 'dsadsa@gmail.com', 123456789, '', '', '$2y$10$zlrnoiYY/6xCLE1XXs8XheblswgKb0.yVv.ak1T7lR/V.c3cSn916', 0),
(31, 'dasdsadas', 'dsadasda', 'dsadsa@gmail.com', 123421512, '5002', '', '$2y$10$N2wBohPGBDPNTSzKdVzkCeHpMPO2OC1xxJRxt3MC3Ae05CPW1.Liq', 0),
(32, 'cau', 'cau', 'kdmqk@gmail.com', 123456789, '5.002', '', '$2y$10$BYmpn/ykxbKIfvyD2dkZv.Js.jsBL9JGRas1Frh5GrD98/WUk7VBe', 0),
(33, 'cau2', 'cau2', 'dsadsa@gmail.com', 123456789, '5.002', '', '$2y$10$n63wF4m5ggscMvkTtvzytOEH9epxotv4WGflP4XD2tZtbHvtdAJrC', 0),
(34, 'cau3', 'cau3', 'cau3@gmail.com', 123456789, '5002', '', '$2y$10$nkwCC1uFNCD/was5k94zvePCRm3mIW6/6feHgGNMcP5ERHUOkS1j.', 0),
(35, 'cau6', 'cau6', 'dsadsa@gmail.com', 123456789, '5002', 'popisek', '$2y$10$IYYP/7RiBbpeWvW.y7jibeqm4WLHid0Qr9Kr7/m1kKkwlWjzlpN.K', 0),
(36, 'cau', 'cau', 'kifa@gmail.com', 123456789, '5002', '', '$2y$10$RKgTtc2ZKPPCXbJ1z6MoTeiPhfesl6Hq9agAgdkUTNH0Pcd.TeiX.', 0),
(37, 'testovaci_ucet', 'ahoj', 'pivo@parek.cz', 123456789, '5002', 'popisek pro testovaci ucet', '$2y$10$nPAkZx1RO6znd98UOby.9.KsE7oEiKGvBE3cC50xqWxJ9frVVCkNm', 0),
(38, 'admin', 'admin', 'admin@centrum.cz', 123456789, '5002', 'adminsky ucet', '$2y$10$WoJ9bzJ4wbnVQODfWfevReGNXguDYQM.HIeKUDZmvgIBcCrAFvi82', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
