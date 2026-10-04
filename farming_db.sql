-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2026 at 12:59 AM
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
-- Database: `farming_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `crops_detailsuser`
--

CREATE TABLE `crops_detailsuser` (
  `crop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `crop_name` varchar(100) NOT NULL,
  `planting_date` date NOT NULL,
  `harvesting_date` date NOT NULL,
  `notes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops_detailsuser`
--

INSERT INTO `crops_detailsuser` (`crop_id`, `user_id`, `crop_name`, `planting_date`, `harvesting_date`, `notes`) VALUES
(2, 4, 'maize', '2025-12-08', '2025-12-30', 'harvesting maze'),
(3, 4, 'beans', '2025-12-31', '2025-12-30', 'beand'),
(4, 4, 'avocado', '2025-12-09', '2025-12-29', 'i love avocado'),
(5, 6, 'potato', '2025-12-07', '2026-12-20', 'potatos'),
(6, 7, 'maize', '2025-12-05', '2025-12-18', 'helo'),
(7, 6, 'avocado', '2025-12-16', '2026-01-08', 'best avocado'),
(8, 6, 'sossi', '2025-12-25', '2026-01-24', 'i eat sossi'),
(10, 11, 'bean', '2025-12-18', '2025-12-12', 'beans are good'),
(12, 11, 'mangoes', '2026-01-14', '2026-03-20', 'good harvest'),
(13, 11, 'tomato', '2026-02-07', '2026-05-29', 'i love them'),
(14, 11, 'bananas', '2026-01-14', '2026-07-24', 'i love bananas'),
(15, 11, 'apple', '2026-01-02', '2026-05-15', 'they are healthy'),
(16, 11, 'Peanuts', '2026-01-02', '2026-04-30', 'juicy'),
(18, 12, 'lemon', '2026-01-02', '2026-08-28', 'they are the kienyeji medicines'),
(19, 12, 'cabbage', '2026-01-02', '2026-09-02', 'cabbages are good'),
(21, 11, 'millet', '2026-01-05', '2026-05-05', 'we eat millet at our place'),
(22, 8, 'maize', '2026-01-05', '2026-04-27', 'i love maize'),
(25, 12, 'avo', '2026-02-03', '2026-02-27', 'i love avo'),
(26, 18, 'maize', '2026-10-20', '2026-10-31', 'grow faster'),
(27, 4, 'tomato', '2026-10-22', '2026-11-12', 'tomatoes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(2, 'rodgers', 'rodgers', 'murithirodgers24@students.seku.ac.ke'),
(3, 'rodgers', '$2y$10$nnn1w0ORyDLNCxmd/bfyYuCpJ36QRyMjiTyKFmiPloQrxA2nP9Nyu', 'rm@gmail.com'),
(4, 'sam', '$2y$10$24tudZ5XPknqXcvxYieyN.DFbE5ihe7RTLJJDa7f/tdc7/0dYvGQq', 'sam@gmail.com'),
(5, 'evans', '$2y$10$bTmsPlyzSjYidRKkavwC4eXmMjvdNlJLuxC0Z/k/1gswJyM4FiFWS', 'sm@uiuiu'),
(6, 'murithi', '$2y$10$zYsaV0R9YHtPaUi0xdNkIu5T3r4PgITj6gCQLVPeAM6jHe324bB2m', 'rm@gmail.com'),
(7, 'grace', '$2y$10$au4hjOIPbSCYgbv3jEVle.liVhBYFojeDcZn98JqNZWk8w0A.Aaxi', 'g@123'),
(8, 'paul', '$2y$10$5ATvamiQpiivRrWcuV5a0.LPM0I/Jf32KoHOqhvx4z91fk37E5w2m', 'p@gmail.com'),
(9, 'evans', '$2y$10$5H8wLNwsSQ6dOtYmU7hsf.bxNiYPxvUE0BNmZ6PyXu3NnQD.F0j9O', 'ev@gmail.com'),
(10, 'evans', '$2y$10$UeWx8/vBtFO71rwRoAU0MOLqBiSkTiZtB4rCcS21NpKnzA3Bffpv6', 'ev@gmail.com'),
(11, 'emanuel', '$2y$10$SAEa6a/lMxd/H1tNvs54buuzmtmAjsr6cHI6KYjeE.ArWsx.fFzGK', 'em@gmail.com'),
(12, 'precious', '$2y$10$B.wKN6ChPLZTm39qDlrh7.Zjg/gMsv3VqZL1SGHl9IGcn1.8PMT5.', 'p@gmail.com'),
(13, 'Dorcas', '$2y$10$xn.ZZRKHo6uwOI9QuV0nP.uIXn4v1yeQFNsmhwSRBK0K5WwZJWDXe', 'd@gnail.com'),
(14, 'syloo', '$2y$10$Dcm.isor87/re9lcP5KnSO.WEmq.LUMP0Q3ASG2Jr/3eCVLTiseiC', 's@gmail.com'),
(15, 'ken', '$2y$10$hh0pNCE/s8PMcTYCnu2J4ulhM.eAXLOmgCrqClYaQ1TOnAtVa7kg.', 'ken@1233'),
(16, 'precious', '$2y$10$xe7HkLj2.cpHSsOX1XMM4OlEy932pO0BbjbuXQ0Ia/34i9cm91Ac2', 'pk@gmail.com'),
(17, 'christine', '$2y$10$JGbP9Rc8W.cVuP2Qgb/6/uDStd/Svbj4p2k89flvGFD2GHXdoWy.G', 'c@gmail.com'),
(18, 'evens', '$2y$10$8PPU./yOxCgr47nDPlPdZOtuTIljM.d2jgSct22TkXnrOtXV2OmS2', 'murithirodgers928@gmail.com'),
(19, 'sam', '$2y$10$Rd3TM3JdbzG7Briwv1IlD.Xun28vfFT33RSg7D5..evq.Wagyt3om', 'sam@1234.gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops_detailsuser`
--
ALTER TABLE `crops_detailsuser`
  ADD PRIMARY KEY (`crop_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crops_detailsuser`
--
ALTER TABLE `crops_detailsuser`
  MODIFY `crop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crops_detailsuser`
--
ALTER TABLE `crops_detailsuser`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
