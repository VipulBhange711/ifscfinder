-- IFSC Finder Pro - Database Structure
-- Version 2.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `ProfileImage` varchar(255) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin` (Default password: admin)
--

INSERT INTO `tbladmin` (`AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`) VALUES
('Admin User', 'admin', 9999999999, 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3');

--
-- Table structure for table `tblbank`
--

CREATE TABLE `tblbank` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `BankName` varchar(200) DEFAULT NULL,
  `ShortName` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `tblstate`
--

CREATE TABLE `tblstate` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `State` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `tblcity`
--

CREATE TABLE `tblcity` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `StateID` int(10) DEFAULT NULL,
  `City` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `tblbankdetail`
--

CREATE TABLE `tblbankdetail` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
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
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

COMMIT;
