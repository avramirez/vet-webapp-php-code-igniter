-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2013 at 05:23 PM
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
(1, 'ALLOPURINOL tablet 300mg, 100/box. Sold per tab.', 4384, 10, 'Tablets and Capsules'),
(2, 'ALUMINUM HYDROXIDE MAGNESIUM HYDROXIDE tablet 200mg/100mg, 100/box.Sold per tab.', 2998, 10, 'Tablets and Capsules');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

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
(10, 'avramirez', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'av', 'ramirez', 'avramirez@dynamicobjx.com'),
(11, 'testing', 'dc724af18fbdd4e59189f5fe768a5f8311527050', 'test', 'tis', 'testing@yahoo.com'),
(12, 'sad', 'a6c78cad8916fbc6e07cbcfd3c601d446798becd', 'sad', 'dsa', 'sda@yah.com'),
(13, 'sdasda', 'f2f26783d8d487ef785cbe74ba35843a33affbbb', 'asdas', 'asdasd', 'dasdsa@yahoo.com'),
(14, 'sadada', '00ea1da4192a2030f9ae023de3b3143ed647bbab', 'asdasd', 'asdasd', 'asdas@yahoo.com'),
(15, 'asdasd', 'd5644e8105ad77c3c3324ba693e83d8fffd54950', 'asdasdsa', 'sadasd', 'dsadasd@yahoo.com'),
(16, 'asdasd', 'b3be08ea24c5c3d983d1fbabfc694a8b7301c939', 'asdasd', 'asdasd', 'sdsad@yahoo.com'),
(17, 'sadas', 'b263a7df8ed761390d22ac0864db693d109f9d1a', 'asdasd', 'sdasd', 'asdasd@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `users_order`
--

CREATE TABLE IF NOT EXISTS `users_order` (
  `objectId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `productAmount` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  PRIMARY KEY (`objectId`),
  KEY `productId` (`productId`),
  KEY `usersId` (`usersId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users_order`
--

INSERT INTO `users_order` (`objectId`, `productId`, `usersId`, `productAmount`, `totalPrice`) VALUES
(1, 1, 10, 1, 10),
(2, 1, 10, 5, 50),
(3, 1, 10, 10, 100),
(4, 2, 10, 1, 10),
(5, 2, 10, 1, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users_reservation`
--

INSERT INTO `users_reservation` (`objectId`, `serviceId`, `userId`, `reserveDate`, `reserveTime`) VALUES
(9, 1, 10, '11/07/2013', '7:00 AM'),
(10, 3, 10, '11/08/2013', '8:00 PM');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_order`
--
ALTER TABLE `users_order`
  ADD CONSTRAINT `users_order_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`objectId`),
  ADD CONSTRAINT `users_order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`objectId`);

--
-- Constraints for table `users_reservation`
--
ALTER TABLE `users_reservation`
  ADD CONSTRAINT `users_reservation_ibfk_1` FOREIGN KEY (`serviceId`) REFERENCES `services` (`objectId`),
  ADD CONSTRAINT `users_reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`objectId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
