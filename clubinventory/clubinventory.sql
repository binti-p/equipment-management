-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2021 at 11:57 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clubinventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reference_name` varchar(225) NOT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `emailid` varchar(225) DEFAULT NULL,
  `club` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `password`, `reference_name`, `mobile_no`, `emailid`, `club`) VALUES
(1, '1234', 'bee', '5678', 'a@b', 'none'),
(2, 'pa55word', 'Photography and Moviemaking Club Admin', '+917645399599', 'pmcadmin@iitmandi.ac.in', 'PMC'),
(3, 'pa55word2', 'Designauts, Design Club', '+917042370732', 'designauts@iitmandi.ac.in', 'Designauts'),
(4, 'pa55word3', 'Music Society', '+917742383616', 'musicsociety@iitmandi.ac.in', 'Music Club');

-- --------------------------------------------------------

--
-- Table structure for table `club_equipment`
--

CREATE TABLE `club_equipment` (
  `ID` int(255) NOT NULL,
  `equipment_name` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `image_path` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_equipment`
--

INSERT INTO `club_equipment` (`ID`, `equipment_name`, `specification`, `image_path`) VALUES
(1, 'Zooom Lens', 'Sony SELP18105G E Mount APS-C 18-105 mm F4.0 Zoom G Lens', 'https://images-na.ssl-images-amazon.com/images/I/618sVwjGxZL._SL1200_.jpg'),
(2, 'tri', 'E-Image EI-7010A 5.5ft Tripod Stand Kit with Hydraulic Fluid Head', 'https://images-na.ssl-images-amazon.com/images/I/61ZWViktS7L._SL1500_.jpg'),
(3, 'Mirrorless Camera', 'Sony Alpha ILCE-7C Compact Full Frame Camera (4K, Flip Screen, Light Weight, Real time Tracking, Content Creation)', 'https://images-na.ssl-images-amazon.com/images/I/81AcTLXirzL._SL1500_.jpg'),
(4, 'Electric Guitar', 'Juârez ST38 Electric Guitar Kit/Set, Right Handed, Red Sunburst RDS, With Case/Bag & Picks', 'https://images-na.ssl-images-amazon.com/images/I/710CTI9jGhL._SL1500_.jpg'),
(5, 'DSLR', 'Nikon D5600', 'https://images-na.ssl-images-amazon.com/images/I/41bmrRyXWmL.jpg'),
(6, 'Drumstick', 'thin, light, sturdy, 12 inch long', 'https://images-na.ssl-images-amazon.com/images/I/51wrKa7o4LL._SX466_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `issueID` int(255) NOT NULL,
  `equipmentID` int(255) NOT NULL,
  `issuerID` int(255) NOT NULL,
  `date_of_issue` date NOT NULL,
  `issue_period` int(11) NOT NULL DEFAULT 1,
  `returnstatus` int(1) NOT NULL DEFAULT 0,
  `date_of_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`issueID`, `equipmentID`, `issuerID`, `date_of_issue`, `issue_period`, `returnstatus`, `date_of_return`) VALUES
(1, 1, 2, '2021-07-18', 2, 1, '2021-07-21'),
(2, 7, 4, '2021-07-27', 1, 0, NULL),
(3, 7, 4, '2021-07-27', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestID` int(255) NOT NULL,
  `equipmentID` int(255) NOT NULL,
  `userID` int(255) NOT NULL,
  `request_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0,
  `date_of_borrow` date DEFAULT NULL,
  `IssuePeriod` int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requestID`, `equipmentID`, `userID`, `request_time`, `status`, `date_of_borrow`, `IssuePeriod`) VALUES
(1, 7, 4, '2021-07-24 20:20:04', 1, '2021-07-27', 1),
(2, 3, 4, '2021-07-24 20:39:54', 0, '2021-09-24', 3);

--
-- Triggers `request`
--
DELIMITER $$
CREATE TRIGGER `approval2` AFTER UPDATE ON `request` FOR EACH ROW BEGIN
if NEW.status=1 then 
INSERT into issues(equipmentID,issuerID,date_of_issue,issue_period,returnstatus,date_of_return) values(new.equipmentid,new.userid,new.date_of_borrow,new.IssuePeriod,0,NULL);
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(255) NOT NULL,
  `rno` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `emailid` varchar(225) NOT NULL,
  `corestatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `rno`, `password`, `fname`, `mobile_no`, `emailid`, `corestatus`) VALUES
(1, 'b19046', 'abc123', 'Muskan', '7042370732', 'b19046@students.iitmandi.ac.in', 1),
(2, 'b19232', 'muskanisthebest', 'Aditee', '884468504', 'b19232@students.iitmandi.ac.in', 1),
(3, 'b1', 'b123', 'bee', '9876', 'a@b', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `club_equipment`
--
ALTER TABLE `club_equipment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`issueID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`requestID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `club_equipment`
--
ALTER TABLE `club_equipment`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `issueID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;