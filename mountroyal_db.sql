-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2025 at 04:26 PM
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
-- Database: `mountroyal`
--

-- --------------------------------------------------------

--
-- Table structure for table `bedtype`
--

CREATE TABLE `bedtype` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bedtype`
--

INSERT INTO `bedtype` (`id`, `name`, `price`, `created_at`) VALUES
(1, 'Double', 10000, '2025-07-20 02:32:03'),
(2, 'Single', 10000, '2025-07-20 02:32:14'),
(3, 'Extra', 7000, '2025-07-20 02:32:20'),
(4, 'Triple', 15000, '2025-07-20 02:32:24');

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`id`, `name`) VALUES
(1, 'Booking'),
(2, 'Confirmed'),
(3, 'Staying');

-- --------------------------------------------------------

--
-- Table structure for table `checkn_info`
--

CREATE TABLE `checkn_info` (
  `id` int(11) NOT NULL,
  `booking_id` int(100) NOT NULL,
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

--
-- Dumping data for table `checkn_info`
--

INSERT INTO `checkn_info` (`id`, `booking_id`, `name`, `fat_name`, `age`, `gender`, `nrc_no`, `work`, `in_date`, `out_date`, `address`, `remark`) VALUES
(10, 123, 'U Kg Kg', 'U Mya', 32, 0, '12/AHSANA(N)225233', 'Trader', '2025-07-19', '2025-07-26', 'NO(32), Shw Own See ', 'Guest'),
(11, 125, 'U Mg Mg', 'U Kaung', 43, 0, '12/43234(N_sdfsdf', 'Trader', '2025-07-20', '2025-07-23', 'NO(32)jdfiuerer', '34efsdf');

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

-- --------------------------------------------------------

--
-- Table structure for table `payment_info`
--

CREATE TABLE `payment_info` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `service_fee_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `payment_type` int(11) NOT NULL,
  `prepayment_required_amount` int(11) NOT NULL DEFAULT 0,
  `paid_amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_info`
--

INSERT INTO `payment_info` (`id`, `booking_id`, `room_id`, `service_fee_id`, `total_amount`, `payment_type`, `prepayment_required_amount`, `paid_amount`) VALUES
(1, 123, 51, 0, 50000, 1, 0, 0),
(2, 123, 73, 0, 50000, 1, 0, 0),
(3, 125, 54, 0, 50000, 1, 0, 0),
(4, 125, 70, 0, 50000, 1, 0, 0),
(5, 126, 75, 0, 220000, 1, 110000, 0),
(7, 127, 63, 0, 220000, 1, 110000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`id`, `name`, `code`, `description`) VALUES
(1, 'Cash', '00001', 'ငွေသားဖြင့် ပေးချခြင်း'),
(2, 'K-Pay (KBZ-PAY)', '00002', 'K-Pay Account သို့ ငွေပေးချေခြင်း။'),
(3, 'AYA Pay (AYA Pay Wallet)', '00003', 'AYA Pay (Wallet) ဖြင့် ပေးချခြင်း'),
(4, 'AYA Pay (Merchant)', '00004', 'AYA PAY (Merchant) သို့ ငွေပေးချေခြင်း။');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(30) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_number` int(11) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `bedding` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 0,
  `capacity` int(11) NOT NULL,
  `extra_bed` int(11) NOT NULL DEFAULT 0,
  `status` int(3) NOT NULL DEFAULT 0,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `booking_id`, `room_number`, `type`, `bedding`, `duration`, `capacity`, `extra_bed`, `status`, `price`) VALUES
(51, 123, 101, '1', '1', 0, 0, 3, 0, 50000),
(52, 0, 102, '3', '1', 0, 0, 1, 0, 50000),
(53, 124, 103, '2', '1', 0, 0, 0, 0, 50000),
(54, 125, 104, '4', '1', 0, 0, 0, 0, 50000),
(63, 127, 302, '3', '1', 2, 0, 2, 0, 50000),
(66, 0, 301, '1', '1', 0, 2, 0, 0, 50000),
(69, 0, 401, '1', '1', 0, 2, 0, 0, 50000),
(70, 125, 201, '2', '1', 0, 2, 0, 0, 50000),
(71, 0, 202, '3', '1', 0, 0, 0, 0, 50000),
(72, 0, 203, '2', '1', 0, 0, 0, 0, 50000),
(73, 123, 204, '2', '1', 0, 0, 0, 0, 50000),
(74, 0, 402, '2', '1', 0, 0, 0, 0, 50000),
(75, 126, 403, '3', '2', 0, 2, 2, 0, 50000);

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
(123, 'U Arkar Phyo', 'Mya', '9750074567', '[\"101\",\"204\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-07-19', '2025-07-26', 7, 0),
(124, 'U Zaw Zaw', 'Myanmar', '967643211', '[\"103\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-07-19', '2025-07-21', 2, 0),
(125, 'U Mg Mg', 'Myanmar', '09750074567', '[\"104\",\"201\"]', 'Romm Type', 'Bed Type', '2', 1, '2025-07-20', '2025-07-23', 3, 0),
(126, 'U Kyaw Kyaw', 'Myanmar', '9750074567', '[\"403\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-07-20', '2025-07-22', 2, 0),
(127, 'U Myo Hla', 'Myanmar', '0978543221', '[\"302\"]', 'Romm Type', 'Bed Type', '1', 1, '2025-07-20', '2025-07-22', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`id`, `name`, `created`) VALUES
(1, 'Superior Ro', '2025-07-09 05:30:47'),
(2, 'Deluxe Room', '2025-07-09 05:30:47'),
(3, 'Guest House', '2025-07-09 05:30:58'),
(4, 'Single Room', '2025-07-09 05:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `service_fee`
--

CREATE TABLE `service_fee` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `service_type` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0
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
-- Indexes for table `bedtype`
--
ALTER TABLE `bedtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
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
-- Indexes for table `service_fee`
--
ALTER TABLE `service_fee`
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
-- AUTO_INCREMENT for table `bedtype`
--
ALTER TABLE `bedtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkn_info`
--
ALTER TABLE `checkn_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- AUTO_INCREMENT for table `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `roombook`
--
ALTER TABLE `roombook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_fee`
--
ALTER TABLE `service_fee`
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
