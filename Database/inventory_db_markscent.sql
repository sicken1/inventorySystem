-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: inventory_db_markscent
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audittrail`
--

DROP TABLE IF EXISTS `audittrail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audittrail` (
  `AuditID` int NOT NULL AUTO_INCREMENT,
  `UserID` int DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `ActionDate` datetime DEFAULT NULL,
  PRIMARY KEY (`AuditID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `audittrail_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audittrail`
--

LOCK TABLES `audittrail` WRITE;
/*!40000 ALTER TABLE `audittrail` DISABLE KEYS */;
INSERT INTO `audittrail` VALUES (1,4,'Edited Sale ID: 38','2023-12-14 11:41:41'),(2,4,'Added unibars evsu as Admin','2023-12-14 11:57:48'),(3,4,'Logged in','2023-12-14 15:04:59'),(4,4,'Added Sale for ID: 8 Bench','2023-12-14 15:05:40'),(5,4,'Edited Sale ID: 39','2023-12-14 15:06:02'),(6,4,'Logged in','2023-12-15 13:56:58'),(7,4,'Logged in','2023-12-15 14:02:41'),(8,4,'Logged in','2023-12-16 13:54:25'),(9,4,'Added Sale for ID: 5 Rosey','2023-12-16 15:00:33'),(10,4,'Added mahal as customer.','2023-12-16 15:02:42'),(11,4,'Added aileen almonds as customer.','2023-12-16 15:03:08'),(12,4,'Added hb as customer.','2023-12-16 15:03:38'),(13,4,'Added Minda Luzon as Admin','2023-12-16 17:54:24'),(14,4,'Logged in','2023-12-16 18:41:10'),(15,4,'Logged in','2023-12-16 18:41:38'),(16,4,'Edited Sale ID: 1','2023-12-16 18:51:56'),(17,4,'Edited Sale ID: 3','2023-12-16 18:52:42'),(18,4,'Edited Sale ID: 3','2023-12-16 18:53:03'),(19,4,'Edited Sale ID: 3','2023-12-16 18:55:33'),(20,4,'Edited Sale ID: 3','2023-12-16 19:01:20'),(21,4,'Edited Sale ID: 3','2023-12-16 19:01:28'),(22,4,'Edited Sale ID: 4','2023-12-16 19:06:31'),(23,4,'Edited Sale ID: 3','2023-12-16 19:06:42'),(24,4,'Edited Sale ID: 4','2023-12-16 19:07:05'),(25,4,'Edited Sale ID: 4','2023-12-16 19:07:31'),(26,4,'Edited Sale ID: 6','2023-12-16 19:24:40'),(27,4,'Edited Sale ID: 3','2023-12-16 19:32:01'),(28,4,'Edited Sale ID: 1','2023-12-16 19:36:02'),(29,4,'Edited Sale ID: 4','2023-12-16 19:36:08'),(30,4,'Edited Sale ID: 4','2023-12-16 19:36:12'),(31,4,'Edited Sale ID: 4','2023-12-16 19:36:17'),(32,4,'Edited Sale ID: 3','2023-12-16 19:41:25'),(33,4,'Edited Sale ID: 3','2023-12-16 19:45:53'),(34,4,'Edited Sale ID: 3','2023-12-16 19:45:58'),(35,4,'Edited Sale ID: 1','2023-12-16 19:47:44'),(36,4,'Edited Sale ID: 1','2023-12-16 19:47:58'),(37,4,'Edited Sale ID: 1','2023-12-16 19:48:05'),(38,4,'Edited Sale ID: 1','2023-12-16 19:48:13'),(39,4,'Edited Sale ID: 1','2023-12-16 19:48:22'),(40,4,'Edited Sale ID: 3','2023-12-16 19:52:09'),(41,4,'Edited Sale ID: 1','2023-12-16 19:59:05'),(42,4,'Edited Sale ID: 4','2023-12-16 20:01:12'),(43,4,'Edited Sale ID: 4','2023-12-16 20:01:30'),(44,4,'Edited Sale ID: 4','2023-12-16 20:01:41'),(45,4,'Edited Sale ID: 4','2023-12-16 20:04:55'),(46,4,'Edited Sale ID: 1','2023-12-16 20:06:03'),(47,13,'Logged in','2023-12-16 22:35:54'),(48,NULL,'Updated own profile information.','2023-12-16 22:52:03'),(49,15,'Logged in','2023-12-16 23:04:31'),(50,15,'Updated own profile information.','2023-12-16 23:05:08'),(51,15,'Logout','2023-12-16 23:20:18'),(52,15,'Logged in','2023-12-16 23:20:47'),(53,15,'Updated own profile information.','2023-12-16 23:21:03'),(54,15,'Logout','2023-12-16 23:21:08'),(55,15,'Logged in','2023-12-16 23:21:17'),(56,15,'Edited Sale ID: 1','2023-12-16 23:21:59'),(57,15,'Logout','2023-12-16 23:36:05'),(58,12,'Logged in','2023-12-16 23:36:13'),(59,12,'Logout','2023-12-16 23:57:10'),(60,11,'Logged in','2023-12-16 23:58:16'),(61,11,'Logged in','2023-12-16 23:59:44'),(62,11,'Logged in','2023-12-17 00:08:01'),(63,11,'Updated own profile information.','2023-12-17 00:09:15'),(64,11,'Logout','2023-12-17 00:21:19'),(65,11,'Logged in','2023-12-17 00:21:31'),(66,11,'Logout','2023-12-17 00:56:52'),(67,11,'Logged in','2023-12-17 00:57:13'),(68,11,'Logout','2023-12-17 01:01:34'),(69,11,'Logged in','2023-12-17 01:01:51'),(70,11,'Logout','2023-12-17 01:03:14'),(71,11,'Logged in','2023-12-17 01:03:22'),(72,11,'Logout','2023-12-17 01:34:58'),(73,11,'Logged in','2023-12-17 01:44:29'),(74,11,'Edited Sale ID: 1','2023-12-17 01:44:45'),(75,11,'Edited Sale ID: 3','2023-12-17 01:56:12'),(76,11,'Edited Sale ID: 6','2023-12-17 01:56:25'),(77,11,'Edited Sale ID: 6','2023-12-17 01:56:48'),(78,11,'Edited Sale ID: 6','2023-12-17 01:57:01'),(79,11,'Edited Sale ID: 6','2023-12-17 01:57:33'),(80,11,'Edited Sale ID: 6','2023-12-17 01:57:57'),(81,11,'Edited Sale ID: 6','2023-12-17 01:59:14'),(82,11,'Edited Sale ID: 6','2023-12-17 01:59:24'),(83,11,'Edited Sale ID: 6','2023-12-17 02:00:06'),(84,11,'Edited Sale ID: 6','2023-12-17 02:00:16'),(85,11,'Edited Sale ID: 4','2023-12-17 02:04:27'),(86,11,'Edited Sale ID: 4','2023-12-17 02:04:45'),(87,11,'Logout','2023-12-17 02:05:06');
/*!40000 ALTER TABLE `audittrail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `CategoryID` int NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) DEFAULT NULL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'hi','2023-12-09 18:42:56','2023-12-14 09:23:44'),(2,'h','2023-12-09 18:52:13','2023-12-09 18:52:13'),(3,'v','2023-12-09 18:57:38','2023-12-09 18:57:38'),(4,'yellow','2023-12-09 19:04:58','2023-12-09 19:04:58'),(5,'2','2023-12-09 19:12:20','2023-12-09 19:12:20'),(6,'blue','2023-12-09 19:41:58','2023-12-09 19:41:58'),(7,'demo1','2023-12-10 12:05:35','2023-12-10 12:05:35'),(8,'girl','2023-12-12 13:06:15','2023-12-12 13:06:15'),(9,'boy','2023-12-12 13:11:13','2023-12-12 13:11:13');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `CustomerID` int NOT NULL AUTO_INCREMENT,
  `CustomerName` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'jhonney puto','09978547517','puto1@gmail.com','Sta. FE huron','2023-12-08 18:49:59','2023-12-08 19:33:07'),(2,'rzel puto','12345678910','puto@gmail.com','sta fe','2023-12-08 23:43:52','2023-12-08 23:43:52'),(3,'aileen','12345678910','puto@gmail.com','pastrana','2023-12-08 23:45:41','2023-12-08 23:45:41'),(5,'edwin quintana','12345679810','a@gmail.com','Maribi tanauan Leyte','2023-12-09 12:19:01','2023-12-09 12:19:01'),(6,'aileen almonds','12345678910','puto@gmail.com','pastrana','2023-12-09 12:19:35','2023-12-09 12:19:35'),(7,'Jet','12345678910','jet@gmail.com','biliran','2023-12-12 13:09:50','2023-12-12 13:09:50'),(8,'edwin quintana','11111111111','edwin.quintana6470@gmail.com','Maribi tanauan Leyte','2023-12-12 13:12:36','2023-12-12 13:12:36'),(9,'aileen almonds','12345675434','dwienboo@gmail.com','biliran','2023-12-13 15:25:23','2023-12-13 15:25:23'),(10,'mahal','12345671234','ni2@gmail.com','maribi','2023-12-16 15:02:42','2023-12-16 15:02:42'),(11,'aileen almonds','23432123432','primvan111@gmail.com','j','2023-12-16 15:03:08','2023-12-16 15:03:08'),(12,'hb','11100000000','0@gmail.com','hbher','2023-12-16 15:03:38','2023-12-16 15:03:38');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `ProductID` int NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(255) DEFAULT NULL,
  `Description` text,
  `CategoryID` int DEFAULT NULL,
  `StockQuantity` int DEFAULT NULL,
  `UnitPrice` decimal(10,2) DEFAULT NULL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ProductID`),
  KEY `CategoryID` (`CategoryID`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Rosey','amoy Rose',7,8002,150.00,'2023-12-10 11:00:57','2023-12-16 19:47:44'),(2,'Santan','amoy santan',3,23,100.00,'2023-12-10 11:04:25','2023-12-17 01:57:33'),(3,'Rosey','amoy Rosey',3,7998,150.00,'2023-12-10 15:33:38','2023-12-14 15:06:02'),(4,'Rosey','amoy Rosey',1,8000,150.00,'2023-12-10 15:34:27','2023-12-10 15:34:27'),(5,'Rosey','amoy Rosey',1,7977,150.00,'2023-12-10 15:34:41','2023-12-16 15:00:33'),(6,'Rosey','amoy Rosey',6,8000,150.00,'2023-12-10 15:35:23','2023-12-10 15:35:23'),(7,'Rosey','amoy Rosey',1,800,150.00,'2023-12-10 15:36:27','2023-12-10 15:36:27'),(8,'Bench','Male scent',9,29,199.00,'2023-12-12 15:22:17','2023-12-17 02:04:57');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `SaleID` int NOT NULL AUTO_INCREMENT,
  `ProductID` int DEFAULT NULL,
  `CustomerID` int DEFAULT NULL,
  `UserID` int DEFAULT NULL,
  `QuantitySold` int DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`SaleID`),
  KEY `ProductID` (`ProductID`),
  KEY `CustomerID` (`CustomerID`),
  KEY `UserID` (`UserID`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`),
  CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,2,12,11,50,5000.00,'2023-12-10 17:41:19','2023-12-17 01:44:45'),(3,2,7,11,35,3500.00,'2023-12-12 16:20:40','2023-12-17 01:56:11'),(4,8,7,11,19,3781.00,'2023-12-12 16:34:38','2023-12-17 02:04:45'),(5,2,6,4,3,300.00,'2023-12-13 12:01:48','2023-12-13 12:01:48'),(6,8,5,11,20,3980.00,'2023-12-13 15:22:19','2023-12-17 02:00:16'),(7,2,6,4,6000,600000.00,'2023-12-13 15:25:55','2023-12-13 17:39:06'),(8,2,9,4,23,2300.00,'2023-12-13 15:35:31','2023-12-13 15:35:31'),(9,8,7,4,500,99500.00,'2023-12-13 16:04:57','2023-12-13 16:04:57'),(10,8,9,4,6,1194.00,'2023-12-13 16:06:09','2023-12-13 17:36:49'),(11,8,6,4,6,1194.00,'2023-12-13 16:06:50','2023-12-13 16:06:50'),(12,6,3,4,1,150.00,'2023-12-13 17:04:11','2023-12-13 17:04:11'),(13,8,2,4,4,796.00,'2023-12-13 21:47:18','2023-12-13 21:47:18'),(14,8,2,4,4,796.00,'2023-12-13 21:48:08','2023-12-13 21:48:08'),(16,8,2,4,4,796.00,'2023-12-13 21:49:49','2023-12-13 21:49:49'),(19,8,3,4,2,398.00,'2023-12-13 21:53:10','2023-12-13 21:53:10'),(24,2,6,4,4,400.00,'2023-12-13 22:48:13','2023-12-13 22:48:13'),(25,2,6,4,4,400.00,'2023-12-13 22:49:03','2023-12-13 22:49:03'),(27,2,2,4,4,400.00,'2023-12-13 22:50:38','2023-12-13 22:50:38'),(28,2,2,4,4,400.00,'2023-12-13 23:00:30','2023-12-13 23:00:30'),(29,2,2,4,4,400.00,'2023-12-13 23:01:20','2023-12-13 23:01:20'),(30,1,9,4,1,150.00,'2023-12-13 23:09:39','2023-12-14 08:58:04'),(31,2,1,4,4,400.00,'2023-12-13 23:51:07','2023-12-13 23:51:07'),(32,2,3,4,5,500.00,'2023-12-14 00:05:28','2023-12-14 00:05:28'),(33,2,3,4,5,500.00,'2023-12-14 00:06:18','2023-12-14 00:06:18'),(34,2,9,4,5,500.00,'2023-12-14 00:08:50','2023-12-14 00:08:50'),(35,6,9,4,1,150.00,'2023-12-14 01:23:33','2023-12-14 01:23:33'),(36,2,9,4,4,400.00,'2023-12-14 01:29:13','2023-12-14 01:29:13'),(37,2,6,4,2,200.00,'2023-12-14 09:46:10','2023-12-14 09:46:10'),(38,8,9,4,1,199.00,'2023-12-14 11:40:08','2023-12-14 11:41:41'),(39,3,8,4,2,300.00,'2023-12-14 15:05:40','2023-12-14 15:06:02'),(40,5,9,4,23,3450.00,'2023-12-16 15:00:33','2023-12-16 15:00:33');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserType` varchar(50) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT '1',
  `ProfilePicture` text,
  `DateCreated` datetime DEFAULT CURRENT_TIMESTAMP,
  `DateUpdated` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'john_doe','Johnney','died',NULL,'Admin',1,'profile_picture_url','2023-12-08 14:44:00','2023-12-16 18:51:14'),(3,'eputo113','edo','puto','$2y$10$.h2F/rlpBk5uRvmhrtN5K.SMISy79AaE03wGZLkmviGtwOcgXNqSu','Admin',0,NULL,'2023-12-08 16:21:29','2023-12-16 18:34:10'),(4,'hiro','Hira','Alaws','$2y$10$.5JjVQgi73sbb/Q3CU49VeY.qpvR7U27F7uS.7A6lv4ioTDOeK6o.','Admin',1,'default_img.jpg','2023-12-08 18:45:36','2023-12-16 21:57:19'),(5,'aalaw205','alone','Alaw','$2y$10$xnFO9pg52/cxnoS39jpUJemhZmLDu5/EGbcgk1.C4sPM4g3VdV3Ia','Admin',1,NULL,'2023-12-10 15:34:01','2023-12-10 15:34:01'),(6,'lpara754','Lenie Para','Para','$2y$10$W77aBQJbZIR7JlKkOnKtBe/jsNOsDe8oql2D1RAjJETN7FyWbkHVm','Admin',1,NULL,'2023-12-10 18:49:11','2023-12-10 18:49:11'),(7,'palmoden857','Para','almoden','$2y$10$dcJ7UQI23g4/hodrEzd1beN7xGga2P.tJHGDQb8G3xwC4YU5Omrr.','Admin',1,NULL,'2023-12-12 10:01:02','2023-12-12 10:01:02'),(8,'mme269','me','me','$2y$10$lSjJCqLiFL.AR3RMUXdn4eKL5dgt0/q3XmPYhOoGqqSAn1Rsl.DyC','Admin',1,NULL,'2023-12-12 10:07:22','2023-12-12 10:07:22'),(9,'eputo214','edo','puto','$2y$10$Qq1G3HP.A/2eUPcc9oEgWOT6DO3bTsNQ7jsFKuz9gWkbIvQInBN1.','Admin',1,NULL,'2023-12-12 10:09:39','2023-12-12 10:09:39'),(10,'demo11979','demo11','emo11','$2y$10$pAvE8fDr1vcSx9bipUNkPe9.UmA7g31rR0Jv3E8z8iVDJN/CBf8lS','Admin',1,NULL,'2023-12-12 10:21:42','2023-12-12 10:21:42'),(11,'mmalana725','Marco','Malana','$2y$10$72muM96UFWL7QhJKoVhhT.09Z7bG.BIOiKSMm34A5SXAcfE2AJ3GG','Employee',1,'totoro.jpg','2023-12-12 10:22:55','2023-12-17 00:09:15'),(12,'hann314','hazel','Ann','$2y$10$2QsyVgPhLFxtGckOSw2DWODpIv8Py999iMpId1VbbC0lkx8iIZ7lG','Employee',1,'default_img.jpg','2023-12-14 11:21:43','2023-12-16 23:35:03'),(13,'ddemo3','demo3','demo3','$2y$10$WaOKeuWbEFSmX6p05XHwCu7fx5j0lipmxXp8qpUAh4QUi8fDE/f7C','Admin',1,'default_img.jpg','2023-12-14 11:28:31','2023-12-16 22:52:03'),(14,'uevsu583','unibars','evsu','$2y$10$LLB2CTAWu1eKUf/7AePvQuCDBOnOJhVMrnmwuzMWO2DpDZE4HHfei','Admin',1,NULL,'2023-12-14 11:57:48','2023-12-14 11:57:48'),(15,'mluzon469','Minds','Luzona','$2y$10$Ha/uCl.nypLbCuJalX02ouiFU5n80KGZCtIL3mldXPfwtTdKoTPCK','Admin',1,'1697724697984.jpg','2023-12-16 17:54:24','2023-12-16 23:21:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-17 11:28:03
