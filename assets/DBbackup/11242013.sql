-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2013 at 02:36 AM
-- Server version: 5.5.22
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vet_app`
--
CREATE DATABASE IF NOT EXISTS `vet_app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vet_app`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `objectId` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_type` varchar(200) NOT NULL,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`objectId`, `product_name`, `product_quantity`, `product_price`, `product_type`) VALUES
(1, 'ALLOPURINOL tablet 300mg, 100/box. Sold per tab.', 5000, 10, 'Tablets and Capsules'),
(2, 'ALUMINUM HYDROXIDE MAGNESIUM HYDROXIDE tablet 200mg/100mg, 100/box.Sold per tab.', 3000, 10, 'Tablets and Capsules');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `objectId` int(10) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`objectId`, `active`, `service_name`, `group`, `price`) VALUES
(1, 1, 'Amputation of leg 1-10kga', 'Surgery', 8000),
(2, 1, 'Amputation of leg 11-20kg', 'Surgery', 10000),
(3, 1, 'Amputation of leg 20-30kg', 'Surgery', 12000),
(4, 1, 'Amputation of leg 35 and up', 'Surgery', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `objectId` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`objectId`, `username`, `password`, `first_name`, `last_name`, `email`) VALUES
(1, 'asd', 'ds', 'asd', 'ad', 'dsada'),
(2, 'sdsadsa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'ssss', 'sadsad', 'sda'),
(3, 'sdsadsa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'ssss', 'sadsad', 'sda'),
(4, 'sdsadsa', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 'ssss', 'sadsad', 'sda'),
(5, 'sdsadsa', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'ssss', 'sadsad', 'sda'),
(6, 'aj_chichi', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Andrew', 'Ramirez', 'aj_chichi@yahoo.com'),
(7, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', ''),
(8, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', ''),
(9, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '', ''),
(10, 'avramirez', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'av', 'ramirez', 'avramirez@dynamicobjx.com'),
(11, 'testing', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'test', 'tis', 'testing@yahoo.com'),
(12, 'sad', 'a6c78cad8916fbc6e07cbcfd3c601d446798becd', 'sad', 'dsa', 'sda@yah.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_reservation`
--

CREATE TABLE IF NOT EXISTS `users_reservation` (
  `objectId` int(10) NOT NULL AUTO_INCREMENT,
  `serviceId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `reserveDate` varchar(15) NOT NULL,
  `reserveTime` varchar(15) NOT NULL,
  PRIMARY KEY (`objectId`),
  KEY `serviceId` (`serviceId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_reservation`
--

INSERT INTO `users_reservation` (`objectId`, `serviceId`, `userId`, `reserveDate`, `reserveTime`) VALUES
(5, 1, 10, '11/06/2013', '8:00 AM'),
(6, 2, 10, '11/21/2013', '9:00 AM');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_reservation`
--
ALTER TABLE `users_reservation`
  ADD CONSTRAINT `users_reservation_ibfk_1` FOREIGN KEY (`serviceId`) REFERENCES `services` (`objectId`),
  ADD CONSTRAINT `users_reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`objectId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
