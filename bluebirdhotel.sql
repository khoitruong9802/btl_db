-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 03:23 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bluebirdhotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignroom`
--

CREATE TABLE `assignroom` (
  `order_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignroom`
--

INSERT INTO `assignroom` (`order_id`, `room_id`) VALUES
(5, 7),
(5, 8),
(5, 9),
(7, 10),
(7, 11),
(10, 1),
(10, 10),
(11, 1),
(11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `cmnd` char(12) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `cmnd`, `gender`, `address`, `country`) VALUES
(4, 'Khoi Truong', '523658975485', 0, 'Ben Tre', 'Viet Nam'),
(6, 'Xuan Loc', '565212354785', 0, 'Quang Binh', 'Viet Nam'),
(7, 'Nhat Quyen', '123123123123', 1, 'Dak Lak', 'America'),
(8, 'Anh Dung', '04023933201', 0, 'Hourse', 'Viet Nam'),
(9, 'Ny Khoi', '123135523413', 0, 'Ben Tre', 'Viet Nam');

-- --------------------------------------------------------

--
-- Table structure for table `customerphone`
--

CREATE TABLE `customerphone` (
  `customer_id` int(11) NOT NULL,
  `phone` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerphone`
--

INSERT INTO `customerphone` (`customer_id`, `phone`) VALUES
(4, '09156325478'),
(6, '09111112222');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `room_id` int(11) NOT NULL
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
(41, 'Tushar pankhaniya', 'pankhaniyatushar9@gmail.com', 'Single Room', 'Single', 1, '2022-11-09', '2022-11-10', 1, 1000.00, 10.00, 'Room only', 0.00, 1010.00);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `roomnumber` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `roomtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `status`, `roomnumber`, `floor`, `roomtype`) VALUES
(1, 1, 102, 1, 2),
(7, 1, 203, 2, 3),
(8, 1, 301, 3, 2),
(9, 1, 302, 3, 2),
(10, 1, 310, 3, 1),
(11, 1, 210, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roombook`
--

CREATE TABLE `roombook` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `RoomType` varchar(30) NOT NULL,
  `Bed` varchar(30) NOT NULL,
  `Meal` varchar(30) NOT NULL,
  `NoofRoom` varchar(30) NOT NULL,
  `cin` date NOT NULL,
  `cout` date NOT NULL,
  `nodays` int(50) NOT NULL,
  `stat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roombookinfo`
--

CREATE TABLE `roombookinfo` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `echeckinday` date DEFAULT NULL,
  `echeckoutday` date DEFAULT NULL,
  `bookday` date DEFAULT NULL,
  `numberofchildren` int(11) DEFAULT NULL,
  `numberofadult` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roombookinfo`
--

INSERT INTO `roombookinfo` (`id`, `status`, `echeckinday`, `echeckoutday`, `bookday`, `numberofchildren`, `numberofadult`, `customer_id`, `staff_id`) VALUES
(5, 1, '2023-12-08', '2023-12-18', '2023-12-06', 2, 4, 4, 1),
(7, 1, '2023-12-13', '2023-12-11', '2023-12-06', 3, 4, 4, 1),
(10, 1, '2023-12-08', '2023-12-09', '2023-12-08', 2, 1, 9, 1),
(11, 1, '2023-12-08', '2023-12-09', '2023-12-08', 2, 1, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomrentinfo`
--

CREATE TABLE `roomrentinfo` (
  `id` int(11) NOT NULL,
  `checkinday` date NOT NULL,
  `numberofchildren` int(11) NOT NULL,
  `numberofadult` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomrentinfo`
--

INSERT INTO `roomrentinfo` (`id`, `checkinday`, `numberofchildren`, `numberofadult`, `book_id`, `staff_id`) VALUES
(1, '2023-12-07', 2, 2, 5, 1),
(3, '2023-12-05', 2, 5, 7, 1),
(4, '2023-12-09', 2, 1, 5, 1),
(5, '2023-12-09', 2, 1, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`id`, `name`, `price`, `detail`) VALUES
(1, 'Normal', 50000, 'Phòng có điều hòa mát lắm'),
(2, 'Vip', 80000, 'Phòng có view biển'),
(3, 'Super Vip', 100000, 'Phòng dát vàng'),
(5, 'Ultra Vip', 10000000, 'Tầng 81 của tòa nhà');

-- --------------------------------------------------------

--
-- Table structure for table `roomtypereq`
--

CREATE TABLE `roomtypereq` (
  `roomtypeid` int(11) NOT NULL,
  `roombookid` int(11) NOT NULL,
  `numberofroom` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cost` int(11) NOT NULL,
  `unit` char(20) NOT NULL,
  `detail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `cost`, `unit`, `detail`) VALUES
(7, 'Swimming', 50000, 'Ticket', 'Vé hồ bơi'),
(8, 'Badminton', 50000, 'Hour', 'Thuê sân đánh cầu'),
(9, 'Massage', 100000, 'Hour', 'Massage dưỡng sinh thoải mái tâm hồn'),
(10, 'Karaoke', 100000, 'Hour', 'Cái nôi của những ca sĩ');

-- --------------------------------------------------------

--
-- Table structure for table `serviceuse`
--

CREATE TABLE `serviceuse` (
  `serviceuse_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `numberofservice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceuse`
--

INSERT INTO `serviceuse` (`serviceuse_id`, `service_id`, `numberofservice`) VALUES
(1, 8, 5),
(2, 9, 2),
(4, 7, 2),
(5, 8, 1),
(7, 7, 1),
(8, 7, 1),
(9, 7, 1),
(10, 7, 1),
(11, 7, 2),
(12, 7, 1),
(13, 8, 1),
(15, 7, 2),
(16, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `serviceuseinfo`
--

CREATE TABLE `serviceuseinfo` (
  `id` int(11) NOT NULL,
  `useday` date NOT NULL,
  `rent_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serviceuseinfo`
--

INSERT INTO `serviceuseinfo` (`id`, `useday`, `rent_id`, `staff_id`, `payment_status`) VALUES
(1, '2023-12-08', 1, 1, 0),
(2, '2023-12-08', 1, 1, 0),
(3, '2023-12-08', 1, 1, 0),
(4, '2023-12-08', 1, 1, 0),
(5, '2023-12-08', 1, 1, 0),
(6, '2023-12-08', 1, 1, 0),
(7, '2023-12-08', 3, 1, 0),
(8, '2023-12-08', 3, 1, 0),
(9, '2023-12-08', 3, 1, 1),
(10, '2023-12-08', 3, 1, 1),
(11, '2023-12-08', 3, 1, 0),
(12, '2023-12-08', 1, 1, 0),
(13, '2023-12-08', 1, 1, 1),
(14, '2023-12-08', 3, 1, 0),
(15, '2023-12-08', 1, 1, 1),
(16, '2023-12-08', 1, 1, 1);

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
(1, 'Tushar Pankhaniya', 'tusharpankhaniya2202@gmail.com', '123'),
(7, 'khoi', 'khoi@gmail.com', '1234');

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
(1, 'Tushar pankhaniya', 'Manager'),
(6, 'mohan', 'Helper'),
(12, 'Khoi', 'cleaner'),
(13, 'Xan Lo', 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `staffinfo`
--

CREATE TABLE `staffinfo` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `CMND` char(12) NOT NULL,
  `phone` char(11) NOT NULL,
  `supervise_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignroom`
--
ALTER TABLE `assignroom`
  ADD PRIMARY KEY (`order_id`,`room_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerphone`
--
ALTER TABLE `customerphone`
  ADD PRIMARY KEY (`customer_id`,`phone`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_login`
--
ALTER TABLE `emp_login`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomtype` (`roomtype`);

--
-- Indexes for table `roombook`
--
ALTER TABLE `roombook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roombookinfo`
--
ALTER TABLE `roombookinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `roomrentinfo`
--
ALTER TABLE `roomrentinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtypereq`
--
ALTER TABLE `roomtypereq`
  ADD PRIMARY KEY (`roomtypeid`,`roombookid`),
  ADD KEY `roombookid` (`roombookid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceuse`
--
ALTER TABLE `serviceuse`
  ADD PRIMARY KEY (`serviceuse_id`,`service_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `serviceuseinfo`
--
ALTER TABLE `serviceuseinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roomrentinfo` (`rent_id`);

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
-- Indexes for table `staffinfo`
--
ALTER TABLE `staffinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emp_login`
--
ALTER TABLE `emp_login`
  MODIFY `empid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roombook`
--
ALTER TABLE `roombook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roombookinfo`
--
ALTER TABLE `roombookinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roomrentinfo`
--
ALTER TABLE `roomrentinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `serviceuseinfo`
--
ALTER TABLE `serviceuseinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `UserID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `staffinfo`
--
ALTER TABLE `staffinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignroom`
--
ALTER TABLE `assignroom`
  ADD CONSTRAINT `assignroom_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `roombookinfo` (`id`),
  ADD CONSTRAINT `assignroom_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);

--
-- Constraints for table `customerphone`
--
ALTER TABLE `customerphone`
  ADD CONSTRAINT `customerphone_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`roomtype`) REFERENCES `roomtype` (`id`);

--
-- Constraints for table `roombookinfo`
--
ALTER TABLE `roombookinfo`
  ADD CONSTRAINT `roombookinfo_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `roomtypereq`
--
ALTER TABLE `roomtypereq`
  ADD CONSTRAINT `roomtypereq_ibfk_1` FOREIGN KEY (`roomtypeid`) REFERENCES `roomtype` (`id`),
  ADD CONSTRAINT `roomtypereq_ibfk_2` FOREIGN KEY (`roombookid`) REFERENCES `roombook` (`id`);

--
-- Constraints for table `serviceuse`
--
ALTER TABLE `serviceuse`
  ADD CONSTRAINT `serviceuse_ibfk_1` FOREIGN KEY (`serviceuse_id`) REFERENCES `serviceuseinfo` (`id`),
  ADD CONSTRAINT `serviceuse_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `serviceuseinfo`
--
ALTER TABLE `serviceuseinfo`
  ADD CONSTRAINT `fk_roomrentinfo` FOREIGN KEY (`rent_id`) REFERENCES `roomrentinfo` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
