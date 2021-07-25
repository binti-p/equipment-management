-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2021 at 12:46 PM
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
  `ID` varchar(10) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `reference_name` varchar(225) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `emailid` varchar(225) DEFAULT NULL,
  `club` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `password`, `reference_name`, `mobile_no`, `emailid`, `club`) VALUES
('', '1234', 'bee', '5678', 'a@b', 'none'),
('c1000', 'pa55word', 'Photography and Moviemaking Club Admin', '+917645399599', 'pmcadmin@iitmandi.ac.in', 'PMC'),
('c1001', 'pa55word2', 'Designauts, Design Club', '+917042370732', 'designauts@iitmandi.ac.in', 'Designauts'),
('c1002', 'pa55word3', 'Music Society', '+917742383616', 'musicsociety@iitmandi.ac.in', 'Music Club');

-- --------------------------------------------------------

--
-- Table structure for table `club_equipment`
--

CREATE TABLE `club_equipment` (
  `ID` int(10) NOT NULL,
  `equipment_name` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `image_path` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `club_equipment`
--

INSERT INTO `club_equipment` (`ID`, `equipment_name`, `specification`, `image_path`) VALUES
(1, 'Tripod', 'E-Image EI-7010A 5.5ft Tripod Stand Kit with Hydraulic Fluid Head', 'https://images-na.ssl-images-amazon.com/images/I/61ZWViktS7L._SL1500_.jpg'),
(2, 'DSLR', 'Nikon D5600', 'https://images-na.ssl-images-amazon.com/images/I/41bmrRyXWmL.jpg'),
(3, 'Mirrorless Camera', 'Sony Alpha ILCE-7C Compact Full Frame Camera (4K, Flip Screen, Light Weight, Real time Tracking, Content Creation)', 'https://images-na.ssl-images-amazon.com/images/I/81AcTLXirzL._SL1500_.jpg'),
(4, 'Zooom Lens', 'Sony SELP18105G E Mount APS-C 18-105 mm F4.0 Zoom G Lens', 'https://images-na.ssl-images-amazon.com/images/I/618sVwjGxZL._SL1200_.jpg'),
(5, 'Electric Guitar', 'Juârez ST38 Electric Guitar Kit/Set, Right Handed, Red Sunburst RDS, With Case/Bag & Picks', 'https://images-na.ssl-images-amazon.com/images/I/710CTI9jGhL._SL1500_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `issueID` int(11) NOT NULL,
  `equipmentID` varchar(10) DEFAULT NULL,
  `issuerID` varchar(10) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `issue_period` int(11) DEFAULT NULL,
  `returnstatus` binary(1) DEFAULT NULL,
  `date_of_return` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`issueID`, `equipmentID`, `issuerID`, `date_of_issue`, `issue_period`, `returnstatus`, `date_of_return`) VALUES
(8, '1', 'b19232', '2021-07-18', 2, 0x31, '2021-07-21'),
(9, '1', 'b19232', '2021-07-18', 2, 0x31, '2021-07-21'),
(10, '2', 'b19232', '2021-07-18', 4, 0x30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestID` int(11) NOT NULL,
  `equipmentID` varchar(10) DEFAULT NULL,
  `userID` varchar(10) DEFAULT NULL,
  `request_time` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `date_of_borrow` date DEFAULT NULL,
  `IssuePeriod` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requestID`, `equipmentID`, `userID`, `request_time`, `status`, `date_of_borrow`, `IssuePeriod`) VALUES
(1, '1', 'b19232', '2021-07-18 05:00:00', 1, '2021-07-18', 2),
(2, '2', 'b19232', '2021-07-18 05:00:00', 0, '2021-07-18', 4),
(3, '3', 'b19046', '2021-07-14 22:59:34', 2, '2021-07-21', 1);

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
  `ID` int(10) NOT NULL,
  `rno` varchar(10) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `emailid` varchar(225) DEFAULT NULL,
  `corestatus` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `rno`, `password`, `fname`, `mobile_no`, `emailid`, `corestatus`) VALUES
(1, 'b19046', 'abc123', 'Muskan', '7042370732', 'b19046@students.iitmandi.ac.in', 0),
(2, 'b19232', 'muskanisthebest', 'Aditee', '884468504', 'b19232@students.iitmandi.ac.in', 1);

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
-- AUTO_INCREMENT for table `club_equipment`
--
ALTER TABLE `club_equipment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `issueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
