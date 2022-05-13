-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 11:25 PM
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
-- Database: `cc fraud detection`
--

-- --------------------------------------------------------

--
-- Table structure for table `cardholder`
--

DROP TABLE IF EXISTS `cardholder`;
CREATE TABLE `cardholder` (
  `SSN` varchar(14) CHARACTER SET utf8 NOT NULL,
  `firstName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lastName` varchar(50) CHARACTER SET utf8 NOT NULL,
  `phoneNo` varchar(20) CHARACTER SET armscii8 NOT NULL,
  `monthlyIncome` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cardholder`
--

INSERT INTO `cardholder` (`SSN`, `firstName`, `lastName`, `phoneNo`, `monthlyIncome`, `country`, `city`, `email`, `password`) VALUES
('302030002754', 'Aseel', 'Nirjawy', '0102415776', 40000, 'Egypt', 'Cairo', 'noodles@gmail.com', 'brb123'),
('302030088576', 'Hossam', 'Shamardan', '01211211789', 15, 'Egypt', 'Menofia', 'basha.simsim@gmail.com', 'abc123');

-- --------------------------------------------------------

--
-- Table structure for table `creditcards`
--

DROP TABLE IF EXISTS `creditcards`;
CREATE TABLE `creditcards` (
  `SSN` varchar(14) CHARACTER SET utf8 NOT NULL,
  `CCN` varchar(19) NOT NULL DEFAULT '0000000000000000',
  `Balance` int(11) NOT NULL,
  `nameOnCard` varchar(50) NOT NULL,
  `expDate` date NOT NULL,
  `CCV` varchar(4) NOT NULL,
  `maxDaily` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creditcards`
--

INSERT INTO `creditcards` (`SSN`, `CCN`, `Balance`, `nameOnCard`, `expDate`, `CCV`, `maxDaily`) VALUES
('302030002754', '4007702835532454', 100000, 'ASEEL NAJRAWY', '2026-05-20', '939', 20000),
('302030088576', '4263982640269299', 2500, 'HOSSAM SHAMARDAN', '2023-09-05', '753', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `ID` int(11) NOT NULL,
  `CCN` varchar(19) NOT NULL,
  `Name` varchar(120) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `reason` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `ID` int(11) NOT NULL,
  `CCN` varchar(19) NOT NULL,
  `date` datetime NOT NULL,
  `total` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `website` varchar(2048) NOT NULL,
  `description` tinytext NOT NULL,
  `type` tinytext NOT NULL,
  `country` tinytext NOT NULL,
  `city` tinytext NOT NULL,
  `phoneNo` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1: went through\r\n0: didn''t go through'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`ID`, `CCN`, `date`, `total`, `quantity`, `website`, `description`, `type`, `country`, `city`, `phoneNo`, `status`) VALUES
(8, '4007702835532454', '2022-05-13 00:00:00', 500, 5, 'https://shorturl.ae/yABtt', 'This item is fuck', 'Payment', '50th youssef sabry street, 7th district', 'ZFHDXF', '1272026038', 1),
(9, '4263982640269299', '2022-05-13 00:00:00', 500, 5, 'https://shorturl.ae/yABtt', 'This item is fuck', 'Payment', '50th youssef sabry street, 7th district', 'SRGDFG', '1272026038', 1),
(10, '4007702835532454', '2022-05-13 00:00:00', 500, 5, 'https://shorturl.ae/yABtt', 'This item is fuck', 'Payment', '50th youssef sabry street, 7th district', 'dgdfgdfg', '1272026038', 1),
(11, '4007702835532454', '2022-05-13 00:00:00', 500, 5, 'https://shorturl.ae/yABtt', 'This item is fuck', 'Payment', '50th youssef sabry street, 7th district', 'fasfdsf', '1272026038', 1),
(12, '4007702835532454', '2022-05-13 00:00:00', 500, 5, 'https://shorturl.ae/yABtt', 'This item is fuck', 'Payment', '50th youssef sabry street, 7th district', 'gdfzgvdfgv', '1272026038', 1),
(13, '4007702835532454', '2022-05-13 00:00:00', 500, 5, 'https://shorturl.ae/yABtt', 'This item is fuck', 'Payment', '50th youssef sabry street, 7th district', 'fdsfvds', '1272026038', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cardholder`
--
ALTER TABLE `cardholder`
  ADD PRIMARY KEY (`SSN`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD PRIMARY KEY (`CCN`),
  ADD KEY `cardholderSSN` (`SSN`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD KEY `IdConst` (`ID`),
  ADD KEY `CCNConst` (`CCN`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CCN` (`CCN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD CONSTRAINT `ssnConstraint` FOREIGN KEY (`SSN`) REFERENCES `cardholder` (`SSN`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `CCNConst` FOREIGN KEY (`CCN`) REFERENCES `transaction` (`CCN`) ON DELETE CASCADE,
  ADD CONSTRAINT `IdConst` FOREIGN KEY (`ID`) REFERENCES `transaction` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `ccn_issuer_const` FOREIGN KEY (`CCN`) REFERENCES `creditcards` (`CCN`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
