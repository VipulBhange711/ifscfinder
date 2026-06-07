-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 08:30 AM
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
-- Database: `ifscdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Address`, `Email`, `ProfileImage`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 5689784592, 'H-911, Vihar Soraj Nagar New Delhi-110011', 'admin@gmail.com', '2b0b772324ad859311b72264d89b0ef61780750656.jpg', 'f925916e2754e5e03f75dd58a5733251', '2020-07-09 11:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `tblbank`
--

CREATE TABLE `tblbank` (
  `ID` int(10) NOT NULL,
  `BankName` varchar(200) DEFAULT NULL,
  `ShortName` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbank`
--

INSERT INTO `tblbank` (`ID`, `BankName`, `ShortName`, `CreationDate`) VALUES
(1, 'Punjab National Bank', 'PNB', '2021-09-18 08:41:32'),
(2, 'State Bank of India', 'SBI', '2021-09-18 08:47:01'),
(3, 'Bank of Baroda', 'BOB', '2021-09-18 08:47:22'),
(4, 'Canara Bank of India', 'CBI', '2021-09-18 08:47:58'),
(5, 'Bank of India', 'BOI', '2021-09-18 08:48:20'),
(7, 'ICICI', 'ICICI', '2021-09-21 17:04:38'),
(8, 'vipul bhange', '1234567890', '2026-06-06 13:21:29'),
(9, 'vipul bhange', '1234567890', '2026-06-06 13:22:07'),
(10, 'vipul bhange', '1234567890', '2026-06-06 13:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblbankdetail`
--

CREATE TABLE `tblbankdetail` (
  `ID` int(10) NOT NULL,
  `IFSCCode` varchar(200) DEFAULT NULL,
  `MICRCode` varchar(200) DEFAULT NULL,
  `BankName` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `StateID` int(5) DEFAULT NULL,
  `CityID` int(5) DEFAULT NULL,
  `Branch` varchar(200) DEFAULT NULL,
  `PhoneNumber` bigint(10) DEFAULT NULL,
  `BranchCode` varchar(200) DEFAULT NULL,
  `ZipCode` int(10) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbankdetail`
--

INSERT INTO `tblbankdetail` (`ID`, `IFSCCode`, `MICRCode`, `BankName`, `Address`, `StateID`, `CityID`, `Branch`, `PhoneNumber`, `BranchCode`, `ZipCode`, `CreationDate`) VALUES
(1, 'PUNB12456', 'PUNB12456', '1', 'hkjhrehrkh4t3a', 5, 2, 'kjhkjhkjhkj', 9789789798, 'hjkj900', 123456, '2021-09-19 05:39:55'),
(2, 'BARB0MERDEL', '250012007', '3', 'Vikash Plaza, Sri Ram Palace, Near Naveen Mandi, Delhi Road, Meerut, Uttar Pradesh- 250 002.', 5, 2, 'Delhi Road Br Meerut U P', 1800223344, 'MERDEL', 250, '2021-09-19 05:44:24'),
(3, 'BARB0MEEGAR', '250012009', '3', 'Bank Of Baroda, 75-1, Mangal Pandey, Nagar Garh Road, Meerut, Uttar Pradesh- 250002.', 5, 2, 'Garh Road Meerut Up', 0, 'MEEGAR', 250002, '2021-09-19 05:46:35'),
(4, 'BARB0DBMCTY', '250012013', '3', '449 Budhana Gate Opp Ismailgirls Degree College Meerut (up) Meerut Meerut Uttar Pradesh 250002', 5, 2, 'Meerut City', 1800223344, 'DBMCTY ', 250002, '2021-09-19 05:50:14'),
(5, 'SBIN000391', 'NA', '2', 'PB NO 6 Bhopal Bairagarh Bhopal MP 462031', 6, 3, '3 EME Centre bhopal', 1457896541, '000391', 462031, '2021-09-19 05:55:15'),
(6, 'ICICI000123', 'NA', '7', 'ABC Street', 13, 9, 'ICICI Bangalore', 1236547896, '8544', 500015, '2021-09-21 17:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblcity`
--

CREATE TABLE `tblcity` (
  `ID` int(10) NOT NULL,
  `StateID` int(10) DEFAULT NULL,
  `City` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcity`
--

INSERT INTO `tblcity` (`ID`, `StateID`, `City`, `CreationDate`) VALUES
(1, 0, 'Varanasi', '2021-09-17 06:35:47'),
(2, 5, 'Meerut', '2021-09-17 06:31:04'),
(3, 6, 'Bhopal', '2021-09-17 06:31:25'),
(4, 12, 'Patna', '2021-09-17 06:31:40'),
(6, 5, 'Varanasi', '2021-09-17 06:22:46'),
(7, 10, 'Amristsar', '2021-09-17 06:23:02'),
(9, 13, 'Bangalore', '2021-09-21 17:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `tblstate`
--

CREATE TABLE `tblstate` (
  `ID` int(10) NOT NULL,
  `State` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblstate`
--

INSERT INTO `tblstate` (`ID`, `State`, `CreationDate`) VALUES
(5, 'Uttar Pradesh', '2021-09-19 05:31:19'),
(6, 'Madya Pradesh', '2021-09-17 06:19:08'),
(7, 'Kerala', '2021-09-15 05:04:09'),
(8, 'Tamilnadu', '2021-09-15 05:04:19'),
(9, 'West Bangal', '2021-09-15 05:04:34'),
(10, 'Punjab', '2021-09-15 05:04:41'),
(11, 'Delhi', '2021-09-15 05:04:51'),
(12, 'Bihar', '2021-09-17 06:38:17'),
(13, 'Karnataka', '2021-09-21 17:05:01'),
(14, 'maharashtra ', '2026-06-06 13:27:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `UserType` int(5) DEFAULT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbank`
--
ALTER TABLE `tblbank`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbankdetail`
--
ALTER TABLE `tblbankdetail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcity`
--
ALTER TABLE `tblcity`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstate`
--
ALTER TABLE `tblstate`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbank`
--
ALTER TABLE `tblbank`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblbankdetail`
--
ALTER TABLE `tblbankdetail`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcity`
--
ALTER TABLE `tblcity`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblstate`
--
ALTER TABLE `tblstate`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
