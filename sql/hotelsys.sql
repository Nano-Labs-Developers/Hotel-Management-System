-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2022 at 05:10 AM
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
-- Database: `hotelsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_ID` int(11) NOT NULL,
  `client_FName` varchar(30) NOT NULL,
  `client_LName` varchar(30) NOT NULL,
  `client_Email` varchar(100) NOT NULL,
  `client_Address` varchar(100) NOT NULL,
  `client_Contact` varchar(20) NOT NULL,
  `client_Timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_ID` int(111) NOT NULL,
  `hotel_Name` varchar(100) NOT NULL,
  `hotel_Code` varchar(30) NOT NULL,
  `hotel_Address` varchar(100) NOT NULL,
  `hotel_Contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `income_bar`
--

CREATE TABLE `income_bar` (
  `ib_ID` int(11) NOT NULL,
  `ib_BarID` int(11) NOT NULL,
  `DateTine` datetime NOT NULL DEFAULT current_timestamp(),
  `ib_Item` varchar(30) NOT NULL,
  `ib_Name` varchar(50) NOT NULL,
  `ib_quantity` int(10) NOT NULL,
  `ib_income` double NOT NULL,
  `ib_updater` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inq_ID` int(11) NOT NULL,
  `client_ID` int(11) NOT NULL,
  `rt_ID` int(11) NOT NULL,
  `rec_ID` int(11) NOT NULL,
  `inq_AC` tinyint(1) NOT NULL,
  `inq_Status` int(5) NOT NULL,
  `inq_checkIn` datetime NOT NULL,
  `inq_checkOut` datetime NOT NULL,
  `inq_adults` int(10) NOT NULL,
  `inq_childs` int(10) NOT NULL,
  `inq_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_reservation`
--

CREATE TABLE `payment_reservation` (
  `pr_ID` int(11) NOT NULL,
  `res_ID` int(11) NOT NULL,
  `pr_ResPayment` double NOT NULL,
  `pr_HotelPayment` double NOT NULL,
  `pr_TotalPayment` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `res_ID` int(11) NOT NULL,
  `inq_ID` int(11) NOT NULL,
  `hotel_Code` varchar(30) NOT NULL,
  `room_Number` int(11) NOT NULL,
  `res_CheckIN` datetime NOT NULL,
  `res_CheckOUT` datetime NOT NULL,
  `res_Adults` int(2) NOT NULL,
  `res_Childs` int(2) NOT NULL,
  `res_ManagerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_ID` int(11) NOT NULL,
  `role_Name` varchar(30) NOT NULL,
  `role_Secret` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_ID`, `role_Name`, `role_Secret`) VALUES
(2, 'admin', 'c56eaf051e59063eac323a11a52ff50d73ad7435'),
(3, 'reception', '8f69f7bef0f6592cbddb3de0eb707efca94c9100'),
(4, 'reservation', '1b1c9df50fb107e510b219734d95099ec467ff2f'),
(5, 'account', 'efc6880119dd022043c5fa395d33598c66ec79ff'),
(6, 'hr', '7894eecc71d998d2eedd5522816a25b282752eec'),
(7, 'bar', 'be882d21e7a861094e65f6c509360b0cca9eadc0'),
(8, 'management', 'b44dee55ec976b5792aa82b5df830587818648b2');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_ID` int(11) NOT NULL,
  `hotel_Code` varchar(30) NOT NULL,
  `rt_ID` int(11) NOT NULL COMMENT 'room type id',
  `room_Number` int(11) NOT NULL,
  `room_AC` int(11) NOT NULL,
  `room_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `rt_ID` int(11) NOT NULL,
  `rt_Type` int(30) NOT NULL,
  `rt_Notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `user_FName` varchar(30) NOT NULL,
  `user_LName` varchar(30) NOT NULL,
  `user_Email` varchar(100) NOT NULL,
  `user_Username` varchar(16) NOT NULL,
  `user_Password` varchar(100) NOT NULL,
  `user_Logged` datetime NOT NULL DEFAULT current_timestamp(),
  `user_AccStatus` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_FName`, `user_LName`, `user_Email`, `user_Username`, `user_Password`, `user_Logged`, `user_AccStatus`) VALUES
(1, 'Pasan', 'kalhara', 'pp@gmail.com', 'admin', '$2y$10$i5CiRbQN4H/QFq4oGiPvP.OTThpP2GQFECdh7xYzDWls/ZfmZRss.', '2022-01-06 17:13:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_ID` int(11) NOT NULL,
  `role_ID` int(11) NOT NULL,
  `Notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_ID`, `role_ID`, `Notes`) VALUES
(1, 2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_ID`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_ID`),
  ADD UNIQUE KEY `hotel_Code` (`hotel_Code`);

--
-- Indexes for table `income_bar`
--
ALTER TABLE `income_bar`
  ADD PRIMARY KEY (`ib_ID`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inq_ID`),
  ADD KEY `Client Constraints` (`client_ID`),
  ADD KEY `Room Type Constraints` (`rt_ID`);

--
-- Indexes for table `payment_reservation`
--
ALTER TABLE `payment_reservation`
  ADD PRIMARY KEY (`pr_ID`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`res_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_ID`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_ID`),
  ADD KEY `Hotel Constraint` (`hotel_Code`),
  ADD KEY `Room type Constraint` (`rt_ID`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`rt_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `User Constraints` (`user_ID`),
  ADD KEY `Role Constraints` (`role_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_ID` int(111) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `income_bar`
--
ALTER TABLE `income_bar`
  MODIFY `ib_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inq_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_reservation`
--
ALTER TABLE `payment_reservation`
  MODIFY `pr_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `res_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `rt_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `Client Constraints` FOREIGN KEY (`client_ID`) REFERENCES `client` (`client_ID`),
  ADD CONSTRAINT `Room Type Constraints` FOREIGN KEY (`rt_ID`) REFERENCES `room_type` (`rt_ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `Hotel Constraint` FOREIGN KEY (`hotel_Code`) REFERENCES `hotel` (`hotel_Code`),
  ADD CONSTRAINT `Room type Constraint` FOREIGN KEY (`rt_ID`) REFERENCES `room_type` (`rt_ID`);

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `Role Constraints` FOREIGN KEY (`role_ID`) REFERENCES `role` (`role_ID`),
  ADD CONSTRAINT `User Constraints` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
