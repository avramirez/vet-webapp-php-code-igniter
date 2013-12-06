-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2013 at 11:53 AM
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
(2, 'ALUMINUM HYDROXIDE MAGNESIUM HYDROXIDE tablet 200mg/100mg, 100/box.Sold per tab.', 2997, 10, 'Tablets and Capsules');

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
  `user_level` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`objectId`, `username`, `password`, `first_name`, `last_name`, `email`, `user_level`, `createdAt`) VALUES
(22, 'test', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'test', 'test', 'test@test.com', 1, '2013-12-05 17:11:09'),
(23, 'superadmin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'superadmin', 'superadmin', 'superadmin@admin.com', 2, '2013-12-05 17:14:09'),
(24, 'adminuser', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'adminuser', 'adminuser', 'adminuser@admin.com', 3, '2013-12-05 17:16:10'),
(25, 'adminreserve', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'adminreserve', 'adminreserve', 'adminreserve@yahoo.com', 4, '2013-12-05 19:17:16'),
(26, 'test2', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'test2', 'test2', 'test2@test.com', 1, '2013-12-06 01:17:29');

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
  `orderDate` datetime NOT NULL,
  PRIMARY KEY (`objectId`),
  KEY `productId` (`productId`),
  KEY `usersId` (`usersId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `users_order`
--

INSERT INTO `users_order` (`objectId`, `productId`, `usersId`, `productAmount`, `totalPrice`, `orderDate`) VALUES
(8, 1, 26, 5001, 50010, '2013-12-06 02:29:38'),
(9, 1, 26, 5001, 50010, '2013-12-06 02:29:40'),
(10, 1, 26, 5001, 50010, '2013-12-06 02:34:49'),
(11, 1, 26, 5001, 50010, '2013-12-06 02:35:52'),
(12, 1, 26, 5001, 50010, '2013-12-06 02:35:53'),
(13, 1, 26, 5001, 50010, '2013-12-06 02:35:53'),
(14, 1, 26, 5001, 50010, '2013-12-06 02:35:54'),
(15, 1, 26, 5001, 50010, '2013-12-06 02:35:54'),
(16, 1, 26, 5001, 50010, '2013-12-06 02:35:54'),
(17, 1, 26, 5001, 50010, '2013-12-06 02:35:54'),
(18, 1, 26, 5001, 50010, '2013-12-06 02:36:21'),
(19, 1, 26, 5001, 50010, '2013-12-06 02:36:22'),
(20, 1, 26, 5001, 50010, '2013-12-06 02:36:22'),
(21, 1, 26, 5001, 50010, '2013-12-06 02:36:22'),
(22, 1, 26, 5001, 50010, '2013-12-06 02:36:22'),
(23, 1, 26, 5001, 50010, '2013-12-06 02:36:23'),
(24, 1, 26, 5001, 50010, '2013-12-06 02:36:23'),
(25, 1, 26, 5001, 50010, '2013-12-06 02:36:23'),
(26, 1, 26, 5001, 50010, '2013-12-06 02:36:23'),
(27, 1, 26, 5001, 50010, '2013-12-06 02:37:20');

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
  `reserveDateTime` datetime NOT NULL,
  `confirmed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`objectId`),
  KEY `serviceId` (`serviceId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `users_reservation`
--

INSERT INTO `users_reservation` (`objectId`, `serviceId`, `userId`, `reserveDate`, `reserveTime`, `reserveDateTime`, `confirmed`) VALUES
(24, 1, 22, '12/18/2013', '2:00 PM', '2013-12-18 14:00:00', 0),
(25, 1, 26, '12/19/2013', '12:00 PM', '2013-12-19 12:00:00', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_order`
--
ALTER TABLE `users_order`
  ADD CONSTRAINT `users_order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`objectId`),
  ADD CONSTRAINT `users_order_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`objectId`);

--
-- Constraints for table `users_reservation`
--
ALTER TABLE `users_reservation`
  ADD CONSTRAINT `users_reservation_ibfk_1` FOREIGN KEY (`serviceId`) REFERENCES `services` (`objectId`),
  ADD CONSTRAINT `users_reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`objectId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
