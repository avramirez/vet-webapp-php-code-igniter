-- MySQL dump 10.13  Distrib 5.6.13, for osx10.7 (i386)
--
-- Host: localhost    Database: vet_app
-- ------------------------------------------------------
-- Server version	5.6.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `objectId` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_type` varchar(200) NOT NULL,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'ALLOPURINOL tablet 300mg, 100/box. Sold per tab.',4425,10,'Tablets and Capsules'),(2,'ALUMINUM HYDROXIDE MAGNESIUM HYDROXIDE tablet 200mg/100mg, 100/box.Sold per tab.',2998,10,'Tablets and Capsules');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `objectId` int(10) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,'Amputation of leg 1-10kga','Surgery',8000),(2,1,'Amputation of leg 11-20kg','Surgery',10000),(3,1,'Amputation of leg 20-30kg','Surgery',12000),(4,1,'Amputation of leg 35 and up','Surgery',15000);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `objectId` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  PRIMARY KEY (`objectId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'asd','ds','asd','ad','dsada'),(2,'sdsadsa','da39a3ee5e6b4b0d3255bfef95601890afd80709','ssss','sadsad','sda'),(3,'sdsadsa','da39a3ee5e6b4b0d3255bfef95601890afd80709','ssss','sadsad','sda'),(4,'sdsadsa','da39a3ee5e6b4b0d3255bfef95601890afd80709','ssss','sadsad','sda'),(5,'sdsadsa','f7c3bc1d808e04732adf679965ccc34ca7ae3441','ssss','sadsad','sda'),(6,'aj_chichi','7c4a8d09ca3762af61e59520943dc26494f8941b','Andrew','Ramirez','aj_chichi@yahoo.com'),(10,'avramirez','7c4a8d09ca3762af61e59520943dc26494f8941b','av','ramirez','avramirez@dynamicobjx.com'),(11,'testing','dc724af18fbdd4e59189f5fe768a5f8311527050','test','tis','testing@yahoo.com'),(12,'sad','a6c78cad8916fbc6e07cbcfd3c601d446798becd','sad','dsa','sda@yah.com'),(13,'sdasda','f2f26783d8d487ef785cbe74ba35843a33affbbb','asdas','asdasd','dasdsa@yahoo.com'),(14,'sadada','00ea1da4192a2030f9ae023de3b3143ed647bbab','asdasd','asdasd','asdas@yahoo.com'),(15,'asdasd','d5644e8105ad77c3c3324ba693e83d8fffd54950','asdasdsa','sadasd','dsadasd@yahoo.com'),(16,'asdasd','b3be08ea24c5c3d983d1fbabfc694a8b7301c939','asdasd','asdasd','sdsad@yahoo.com'),(17,'sadas','b263a7df8ed761390d22ac0864db693d109f9d1a','asdasd','sdasd','asdasd@yahoo.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_order`
--

DROP TABLE IF EXISTS `users_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_order` (
  `objectId` int(11) NOT NULL AUTO_INCREMENT,
  `productId` int(11) NOT NULL,
  `usersId` int(11) NOT NULL,
  `productAmount` int(11) NOT NULL,
  `totalPrice` float NOT NULL,
  PRIMARY KEY (`objectId`),
  KEY `productId` (`productId`),
  KEY `usersId` (`usersId`),
  CONSTRAINT `users_order_ibfk_2` FOREIGN KEY (`usersId`) REFERENCES `users` (`objectId`),
  CONSTRAINT `users_order_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `products` (`objectId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_order`
--

LOCK TABLES `users_order` WRITE;
/*!40000 ALTER TABLE `users_order` DISABLE KEYS */;
INSERT INTO `users_order` VALUES (1,1,10,4,40),(4,2,10,2,20);
/*!40000 ALTER TABLE `users_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_reservation`
--

DROP TABLE IF EXISTS `users_reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_reservation` (
  `objectId` int(10) NOT NULL AUTO_INCREMENT,
  `serviceId` int(10) NOT NULL,
  `userId` int(10) NOT NULL,
  `reserveDate` varchar(15) NOT NULL,
  `reserveTime` varchar(15) NOT NULL,
  PRIMARY KEY (`objectId`),
  KEY `serviceId` (`serviceId`),
  KEY `userId` (`userId`),
  CONSTRAINT `users_reservation_ibfk_1` FOREIGN KEY (`serviceId`) REFERENCES `services` (`objectId`),
  CONSTRAINT `users_reservation_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`objectId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_reservation`
--

LOCK TABLES `users_reservation` WRITE;
/*!40000 ALTER TABLE `users_reservation` DISABLE KEYS */;
INSERT INTO `users_reservation` VALUES (9,1,10,'11/07/2013','7:00 AM'),(10,3,10,'11/08/2013','8:00 PM');
/*!40000 ALTER TABLE `users_reservation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-11-25 11:41:08
