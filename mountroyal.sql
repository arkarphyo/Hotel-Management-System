-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 07:17 PM
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
-- Database: `Mount Royal`
-- User: `bluebird_user`
-- Password:   `password`
--
DROP DATABASE IF EXISTS mountroyal;
CREATE DATABASE IF NOT EXISTS mountroyal;

DROP USER IF EXISTS'mountroyal'@'%';
CREATE USER IF NOT EXISTS 'mountroyal'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON bluebirdhotel.* TO 'mountroyal'@'%';
USE mountroyal;

-- --------------------------------------------------------

--
-- Table structure for table `checkn_info`
--

CREATE TABLE `checkn_info` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `fat_name` varchar(10) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` int(10) NOT NULL,
  `nrc_no` text NOT NULL,
  `work` varchar(255) NOT NULL,
  `in_date` date NOT NULL,
  `out_date` date NOT NULL,
  `address` text NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_login`
--

CREATE TABLE `emp_login` (
  `empid` int(100) NOT NULL,
  `Emp_Email` varchar(50) NOT NULL,
  `Emp_Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_login`
--

INSERT INTO `emp_login` (`empid`, `Emp_Email`, `Emp_Password`) VALUES
(1, 'Admin@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(30) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `RoomType` varchar(30) NOT NULL,
  `Bed` varchar(30) NOT NULL,
  `NoofRoom` int(30) NOT NULL,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `noofdays` int(30) NOT NULL,
  `roomtotal` double(8,2) NOT NULL,
  `bedtotal` double(8,2) NOT NULL,
  `meal` varchar(30) NOT NULL,
  `mealtotal` double(8,2) NOT NULL,
  `finaltotal` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `Name`, `Email`, `RoomType`, `Bed`, `NoofRoom`, `cin`, `cout`, `noofdays`, `roomtotal`, `bedtotal`, `meal`, `mealtotal`, `finaltotal`) VALUES
(41, 'Mg Mg', 'pankhaniyatushar9@gmail.com', 'Superior Room', 'Double', 1, '2022-11-09', '2022-11-10', 1, 3000.00, 60.00, 'Room only', 0.00, 3060.00);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(30) NOT NULL,
  `room_number` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `bedding` varchar(50) NOT NULL,
  `status` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_number`, `type`, `bedding`, `status`) VALUES
(51, 101, 'Guest House', 'Single', 0),
(52, 102, 'Guest House', 'Double', 0),
(53, 103, 'Single Room', 'Single', 0),
(54, 104, 'Family Room', 'Triple', 0),
(55, 201, 'Guest House', 'Triple', 0),
(57, 202, 'Normal', 'Double Bed', 0),
(58, 203, 'Normal', 'Duble Bed', 0),
(59, 204, 'Normal', 'Double Bed', 0),
(60, 205, 'Normal', 'Double', 0),
(61, 206, 'Normal', 'Double Bed', 0),
(62, 301, 'Family Room', 'Double Bed, Single Bed', 0),
(63, 302, 'Honeymoon Room', 'Double Bed', 0),
(64, 401, 'Normal', '2 Single Bed', 0),
(65, 402, 'Normal', 'Double Bed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roombook`
--

CREATE TABLE `roombook` (
  `id` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `National` varchar(50) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `RoomNos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`RoomNos`)),
  `RoomType` varchar(30) NOT NULL,
  `Bed` varchar(30) NOT NULL,
  `NoofRoom` varchar(30) NOT NULL,
  `Breakfast` tinyint(1) NOT NULL DEFAULT 0,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `nodays` int(50) NOT NULL,
  `stat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roombook`
--

INSERT INTO `roombook` (`id`, `Name`, `National`, `Phone`, `RoomNos`, `RoomType`, `Bed`, `NoofRoom`, `Breakfast`, `cin`, `cout`, `nodays`, `stat`) VALUES
(77, 'Aung Aung', 'Myanmar', '09750074567', '[\"103\"]', 'Romm Type', 'Bed Type', '1', 0, '2025-06-20', '2025-06-20', 0, 2),
(78, 'Aung Aung', 'Myanmar', '09750074567', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 0, '2025-06-20', '2025-06-24', 4, 2),
(79, 'Aung', 'Albania', '0934737434', '[\"104\",\"201\"]', 'Romm Type', 'Bed Type', '2', 0, '2025-06-20', '2025-06-23', 3, 2),
(80, 'Aung Aung', 'Myanmar', '09750074567', '[\"101\"]', 'Romm Type', 'Bed Type', '1', 0, '2025-06-21', '2025-06-23', 2, 2),
(81, 'Mg Mg', 'Albania', '0934737434', '[\"104\"]', 'Romm Type', 'Bed Type', '1', 0, '2025-06-21', '2025-06-23', 2, 2),
(82, 'Aung Aung', 'Myanmar', '09750074567', '[\"102\"]', 'Romm Type', 'Bed Type', '1', 0, '2025-06-10', '2025-06-27', 17, 2),
(83, 'Kyaw Kyaw', 'Myanmar', '0943234231', '[\"102\"]', 'Romm Type', 'Bed Type', '1', 0, '2025-06-22', '2025-06-23', 1, 2),
(84, 'Aung', 'Albania', '0943234231', '[\"102\"]', 'Romm Type', 'Bed Type', '1', 0, '2025-06-22', '2025-06-25', 3, 2),
(85, 'Naing Naing', 'Afghanistan', '0943234231', '[\"102\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-06-22', '2025-06-24', 2, 2),
(86, 'Aung', 'Afghanistan', '0934737434', '[\"201\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-06-22', '2025-06-24', 2, 2),
(87, 'Aung Aung', 'Afghanistan', '0943234231', '[\"103\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-06-22', '2025-06-24', 2, 2),
(88, 'Kyaw', 'Myanmar', '0943234231', '[\"101\",\"103\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-25', '2025-06-25', 0, 2),
(89, 'Mg Mg', 'Myanmar', '09750074567', '[\"104\",\"202\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-24', '2025-06-28', 4, 2),
(90, 'Arkar Phyo', 'Myanmar', '09750074567', '[\"101\",\"201\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-25', '2025-06-27', 2, 2),
(91, 'ဦးမင်းအောင်နိုင်ဦး', 'Myanmar', '09750074567', '[\"102\",\"103\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-25', '2025-07-04', 9, 2),
(92, 'KOAKRA', 'Myanmar', '09432342', '[\"102\",\"205\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-07-02', 4, 2),
(93, 'KOAKRA', 'Myanmar', '09432342', '[\"102\",\"103\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-07-03', 5, 2),
(94, 'KOAKRA', 'Myanmar', '09432342', '[\"102\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-06-28', '2025-07-10', 12, 2),
(95, 'KOAKRA', 'Myanmar', '09432342', '[\"102\",\"203\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-07-17', 19, 2),
(96, 'Aung Aung', 'Myanmar', '09750074567', '[\"102\",\"205\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(97, 'Aung Aung', 'Afghanistan', '09750074567', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(98, 'Kyaw', 'Albania', '0943234231', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(99, 'Kyaw', 'Albania', '0943234231', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(100, 'Mg Mg', 'Albania', '0943234231', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(101, 'Mg Mg', 'Albania', '0943234231', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(102, 'Kyaw', 'Afghanistan', '0934737434', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(103, 'Mg Mg', 'Myanmar', '234234234', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(104, 'Kyaw', 'Algeria', '0934737434', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(105, 'Kyaw', 'Albania', '0943234231', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 2),
(106, 'Naing Naing', 'Algeria', '09494885454', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 0),
(107, 'Kyaw', 'Albania', '09750074567', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 0),
(108, 'Aung Aun', 'American Samoa', '0943234231', '[\"101\",\"102\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 0),
(109, 'Aung Aung', 'Afghanistan', '09494885454', '[\"401\",\"402\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-06-28', '2025-06-30', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `UserID` int(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`UserID`, `Username`, `Email`, `Password`) VALUES
(1, 'Tushar Pankhaniya', 'tusharpankhaniya2202@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `work` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `work`) VALUES
(12, 'Mg Mg', 'Manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkn_info`
--
ALTER TABLE `checkn_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_login`
--
ALTER TABLE `emp_login`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roombook`
--
ALTER TABLE `roombook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkn_info`
--
ALTER TABLE `checkn_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_login`
--
ALTER TABLE `emp_login`
  MODIFY `empid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `roombook`
--
ALTER TABLE `roombook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `UserID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
