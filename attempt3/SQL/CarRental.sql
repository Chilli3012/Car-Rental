-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 11:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `id` int(5) NOT NULL,
  `model` text NOT NULL,
  `num` text NOT NULL,
  `capacity` int(3) NOT NULL,
  `rent` int(6) NOT NULL,
  `available` date NOT NULL DEFAULT current_timestamp(),
  `booked` tinyint(1) NOT NULL DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 1,
  `startdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `model`, `num`, `capacity`, `rent`, `available`, `booked`, `duration`, `startdate`) VALUES
(1, 'VXI', 'DL2CAA2001', 4, 2000, '2024-02-24', 0, 1, '2024-02-26'),
(2, 'LXI', 'BR7K1H2002', 6, 5000, '2024-02-24', 0, 1, '2024-02-27'),
(3, 'LXI', 'BR7K1H2003', 4, 2500, '2024-02-24', 0, 1, '2024-02-26'),
(4, 'ABC', 'DL2CAA2008', 5, 2800, '2024-02-24', 0, 1, '2024-02-14'),
(5, 'BGT', 'HR2KAA9008', 4, 3400, '2024-02-26', 0, 1, '2024-02-26'),
(6, 'OKL', 'HR2OAY9002', 6, 3900, '2024-02-24', 0, 1, '2024-02-26'),
(7, 'TRW', 'BR7K1H2006', 5, 5600, '2024-02-24', 0, 1, '2024-02-27'),
(8, 'VXI', 'DL2CAA2001', 4, 2000, '2024-02-24', 0, 1, '2024-02-29'),
(9, 'BMW q1', 'BR7K1H9003', 5, 4300, '2024-02-26', 0, 1, '2024-02-29'),
(10, 'WER', 'HR8IAA9074', 6, 5000, '2024-02-26', 1, 9, '2024-02-27'),
(11, 'Audi R8', 'DL2MSD0007', 5, 9000, '2024-02-27', 0, 1, '2024-02-27'),
(12, 'Audi R6', 'BR9I1H2603', 7, 4800, '2024-02-27', 0, 1, '2024-02-29'),
(13, 'Duster w1', 'HG2KAA3508', 7, 3786, '2024-02-27', 0, 1, '2024-02-29'),
(14, 'PXI', 'BR7K1H2902', 5, 4500, '2024-02-27', 0, 1, '2024-02-29'),
(15, 'POP', 'TM3RYY3045', 6, 5000, '2024-02-29', 0, 1, '2024-02-29'),
(16, 'Mercedes M1', 'TM3RYY3049', 5, 7000, '2024-02-29', 0, 1, '2024-02-29');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `rental_start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `user_id`, `car_id`, `rental_start_date`) VALUES
(3, 16, 4, '2024-02-20'),
(5, 16, 8, '2023-12-12'),
(7, 16, 6, '2023-11-25'),
(8, 15, 9, '2024-02-07'),
(10, 15, 10, '2024-01-22'),
(12, 15, 7, '2024-02-17'),
(14, 15, 5, '2024-02-04'),
(15, 12, 1, '2023-12-30'),
(17, 12, 2, '2024-02-24'),
(19, 12, 3, '2023-10-22'),
(20, 5, 4, '2024-02-07'),
(22, 5, 10, '2024-01-29'),
(23, 14, 6, '2024-02-05'),
(25, 14, 3, '2024-01-20'),
(27, 14, 7, '2024-02-11'),
(28, 13, 2, '2024-02-10'),
(30, 13, 8, '2023-12-20'),
(32, 13, 9, '2023-10-23'),
(34, 13, 1, '2023-12-18'),
(35, 5, 7, '2024-02-25'),
(36, 5, 9, '2024-01-24'),
(37, 13, 6, '2024-01-21'),
(38, 17, 7, '2024-02-13'),
(39, 17, 2, '2024-02-17'),
(41, 5, 4, '2024-02-14'),
(42, 5, 14, '2024-02-13'),
(44, 18, 10, '2024-02-29'),
(45, 18, 9, '2024-02-29'),
(46, 18, 9, '2024-02-27'),
(47, 18, 8, '2024-02-29'),
(48, 18, 13, '2024-02-29'),
(49, 17, 12, '2024-02-25');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `name` text NOT NULL,
  `emid` int(5) NOT NULL DEFAULT -1,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `emid`, `email`, `password`) VALUES
(1, 'Anurag', 1, 'anurag@anurag.com', '123'),
(2, 'Balram', 2, 'b@b.com', '123'),
(3, 'Palak', 3, 'palak@palak.com', '1234'),
(4, 'Seema', 4, 's@s.com', '345'),
(5, 'KC', -1, 'kc@kc.com', '111'),
(12, 'Piyush', -1, 'ph@ph.com', '123'),
(13, 'Dilraj', -1, 'dilraj@dilraj.com', '123'),
(14, 'Remo', -1, 'tt@tt.com', '456'),
(15, 'Maneet', -1, 'man@man.com', '987'),
(16, 'Lakshay', -1, 'lak@lak.com', '123'),
(17, 'Harshit', -1, 'hr@hr.com', '222'),
(18, 'Sudama', -1, 'su@dama.com', '123'),
(19, 'Chilli', -1, 'ch@illi.com', '123'),
(20, 'Krishna', 5, 'kris@na.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
