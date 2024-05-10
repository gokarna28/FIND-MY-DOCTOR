-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 03:53 PM
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
-- Database: `findmydoctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_image`, `admin_name`, `admin_email`, `admin_password`, `role`) VALUES
(7, 'doctor/ivan-bandura-Kj2tYAl4HZg-unsplash.jpg', 'Gokarna Chaudhary', 'bca22061002_gokarna@achsnepal.edu.np', '$2y$10$OJ3nRcpb/m2Hikov9mKpAuKNmhaccFYoOxihwshSEuTYzUupJvl0.', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_age` int(255) NOT NULL,
  `patient_gender` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'booked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctor_id`, `user_id`, `date`, `time`, `patient_name`, `patient_age`, `patient_gender`, `status`) VALUES
(49, 16, 24, '2024/Apr/23 Tuesday', '7:25 PM', 'bishesh limbu', 23, 'Male', 'completed'),
(51, 16, 22, '2024/Apr/27 Saturday', '11:00 AM', 'ram', 25, 'Male', 'completed'),
(59, 16, 22, '2024/Apr/27 Saturday', '10:00 AM', 'goku', 22, 'Male', 'booked'),
(61, 16, 25, '2024/May/07 Tuesday', '11:00 AM', 'bimal chaudhary', 23, 'Male', 'booked'),
(62, 16, 22, '2024/May/07 Tuesday', '11:30 AM', 'sachin', 22, 'Male', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_image` varchar(255) NOT NULL,
  `did` int(11) NOT NULL,
  `nmc` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_email` varchar(255) NOT NULL,
  `doctor_password` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `clinic` varchar(255) NOT NULL,
  `clinic_address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_image`, `did`, `nmc`, `doctor_name`, `doctor_email`, `doctor_password`, `speciality`, `degree`, `clinic`, `clinic_address`, `status`) VALUES
('doctor/gi.png', 16, '12354', 'Gokarna Chaudhary', 'bca22061002_gokarna@achsnepal.edu.np', '$2y$10$u919VNITBSZoprYoGQaFsuraRaRmZtVRqJjn2GCX43oQO9rcHuS9S', 'Physicians', 'MBBS, MD', 'buddha medical hall', 'Kalanki, Dhungeadda, Kathmandu', 'approved'),
('doctor/_John Peter Russell - Vincent van Gogh_ Poster for Sale by Impressionist Masters.jpg', 20, '45578', 'Bishesh Limbu', 'gokarnachy28@gmail.com', '$2y$10$46LYeHxmzenAVNIFLtfks.o78H4UDltsbknoQiqpKHn40TqgxjXeq', 'Psychiatrists', 'PHD', 'bishesh farma', 'Thankot, chandragiri', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL,
  `slot1` varchar(255) DEFAULT NULL,
  `slot2` varchar(255) DEFAULT NULL,
  `slot3` varchar(255) DEFAULT NULL,
  `slot4` varchar(255) DEFAULT NULL,
  `slot5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `doctor_id`, `date`, `slot1`, `slot2`, `slot3`, `slot4`, `slot5`) VALUES
(20, 16, '2024/Apr/23 Tuesday', '7:25 PM', NULL, NULL, NULL, NULL),
(22, 16, '2024/Apr/16 Tuesday', '10:00 AM', '10:30 AM', '11:00 AM', '11:45 AM', '12:30 PM'),
(24, 16, '2024/Apr/17 Wednesday', '8:02 PM', '9:02 PM', '10:02 PM', '11:02 PM', NULL),
(29, 16, '2024/Apr/27 Saturday', '10:00 AM', '10:20 AM', '11:00 AM', '11:30 AM', '12:00 PM'),
(30, 16, '2024/May/07 Tuesday', '10:30 AM', '11:00 AM', '11:30 AM', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `user_image`, `user_name`, `user_email`, `user_password`, `role`) VALUES
(22, 'user/chain.jpg', 'gokarna chaudhary', 'bca22061002_gokarna@achsnepal.edu.np', '$2y$10$ZtUOihopAm1vqstFFdEZeubSLP7aLTMiGf/uZU68XSmMc.dISjIxW', 'user'),
(24, NULL, 'Bishesh', 'bca22061024_bishesh@achsnepal.edu.np', '$2y$10$mdFuhCCTrsrG2jmCp/g38eTZ467Ix3Wta7dzcU5vqHvoAKr5u1c7y', 'user'),
(25, 'user/d52c20168309342e63ede131b9af329e.jpg', 'Bimal Kumar Chaudhary', 'bimalchy2645@gmail.com', '$2y$10$RTpGHd5rByEOK8ekeaiC8O.XlmYmGhKZzGsRKp3IqSo0bMhPAzL.K', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorid_fk` (`doctor_id`),
  ADD KEY `userid_fk` (`user_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_foreignKey` (`doctor_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `doctorid_fk` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`did`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userid_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `doctor_foreignKey` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
