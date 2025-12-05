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
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audittrail`
--

LOCK TABLES `audittrail` WRITE;
/*!40000 ALTER TABLE `audittrail` DISABLE KEYS */;
INSERT INTO `audittrail` VALUES (1,15,'Added Female as Category.','2023-12-19 15:13:35'),(2,15,'Added Male as Category.','2023-12-19 15:13:51'),(3,15,'Added DapperGlow to Product list.','2023-12-19 15:18:40'),(4,15,'Added UrbanWhisk to Product list.','2023-12-19 15:19:08'),(5,15,'Added GentleBreeze to Product list.','2023-12-19 15:19:37'),(6,15,'Added MysticEmbrace to Product list.','2023-12-19 15:20:08'),(7,15,'Added NobleAura to Product list.','2023-12-19 15:20:28'),(8,15,'Added AzureSerenade to Product list.','2023-12-19 15:20:48'),(9,15,'Added VibrantElegance to Product list.','2023-12-19 15:22:09'),(10,15,'Added RuggedCharm to Product list.','2023-12-19 15:22:32'),(11,15,'Added VelvetWhisper to Product list.','2023-12-19 15:22:52'),(12,15,'Added SolarSpell to Product list.','2023-12-19 15:23:16'),(13,15,'Added Enchanted Petals to Product list.','2023-12-19 15:23:48'),(14,15,'Added Whispering Moonlight to Product list.','2023-12-19 15:24:09'),(15,15,'Added Sugared Serenity to Product list.','2023-12-19 15:24:37'),(16,15,'Added Lullaby Lagoon to Product list.','2023-12-19 15:24:59'),(17,15,'Added Celestial Blush to Product list.','2023-12-19 15:25:23'),(18,15,'Added Gossamer Whispers to Product list.','2023-12-19 15:25:52'),(19,15,'Added Velvet Aurora to Product list.','2023-12-19 15:26:16'),(20,15,'Added Cotton Candy Clouds to Product list.','2023-12-19 15:26:44'),(21,15,'Added Mystic Rosewood to Product list.','2023-12-19 15:27:07'),(22,15,'Added Sun-kissed Serenade to Product list.','2023-12-19 15:35:23'),(23,15,'Added DapperGlow to Product list.','2023-12-19 15:42:05'),(24,15,'Added UrbanWhisk to Product list.','2023-12-19 15:42:28'),(25,15,'Added GentleBreeze to Product list.','2023-12-19 15:42:52'),(26,15,'Added MysticEmbrace to Product list.','2023-12-19 15:43:17'),(27,15,'Added NobleAura to Product list.','2023-12-19 15:43:40'),(28,15,'Added AzureSerenade to Product list.','2023-12-19 15:44:01'),(29,15,'Added VibrantElegance to Product list.','2023-12-19 15:44:26'),(30,15,'Added RuggedCharm to Product list.','2023-12-19 15:45:03'),(31,15,'Added VelvetWhisper to Product list.','2023-12-19 15:45:27'),(32,15,'Added SolarSpell to Product list.','2023-12-19 15:45:45'),(33,15,'Added Enchanted Petals to Product list.','2023-12-19 15:46:22'),(34,15,'Added Whispering Moonlight to Product list.','2023-12-19 15:46:42'),(35,15,'Added Sugared Serenity to Product list.','2023-12-19 15:47:09'),(36,15,'Added Lullaby Lagoon to Product list.','2023-12-19 15:47:30'),(37,15,'Added Celestial Blush to Product list.','2023-12-19 15:47:47'),(38,15,'Added Gossamer Whispers to Product list.','2023-12-19 15:48:09'),(39,15,'Added Velvet Aurora to Product list.','2023-12-19 15:48:57'),(40,15,'Added Cotton Candy Clouds to Product list.','2023-12-19 15:49:26'),(41,15,'Added Mystic Rosewood to Product list.','2023-12-19 15:49:54'),(42,15,'Added Sun-kissed Serenade to Product list.','2023-12-19 15:50:23'),(43,15,'Added Lenie as customer.','2023-12-19 15:51:05'),(44,15,'Added Edwin as customer.','2023-12-19 15:51:36'),(45,15,'Added Razel Ann Puto as customer.','2023-12-19 15:52:27'),(46,15,'Added Aileen Almoden as customer.','2023-12-19 15:53:16'),(47,15,'Added Hazel ann as customer.','2023-12-19 15:55:14'),(48,15,'Edited Information of Customer ID: 5','2023-12-19 15:55:25'),(49,15,'Added Samantha lagado as customer.','2023-12-19 15:58:13'),(50,15,'Added Mark Tolentino as customer.','2023-12-19 15:59:20'),(51,15,'Added Razel Ann Puto as Admin','2023-12-19 16:03:41'),(52,15,'Deleted user with user ID 15 ','2023-12-19 16:03:59'),(53,15,'Edited information of User ID: 16','2023-12-19 16:06:58'),(54,15,'Updated own profile information.','2023-12-19 16:07:22'),(55,NULL,'Logout','2023-12-19 16:16:55'),(56,16,'Logged in','2023-12-19 16:17:05'),(57,16,'Updated own profile information.','2023-12-19 16:17:19'),(58,NULL,'Added Sale for ID: 14 Lullaby Lagoon','2023-12-19 16:40:51'),(59,NULL,'Logout','2023-12-19 16:41:54'),(60,15,'Logged in','2023-12-19 16:42:02'),(61,15,'Updated own profile information.','2023-12-19 16:42:42'),(62,NULL,'Logout','2023-12-19 16:43:51'),(63,15,'Logged in','2023-12-19 16:43:59'),(64,15,'Updated own profile information.','2023-12-19 16:44:31'),(65,15,'Updated own profile information.','2023-12-19 16:47:16'),(66,15,'Updated own profile information.','2023-12-19 16:48:01'),(67,15,'Updated own profile information.','2023-12-19 16:50:31'),(68,NULL,'Logout','2023-12-19 16:51:34'),(69,15,'Logged in','2023-12-19 16:51:44'),(70,15,'Updated own profile information.','2023-12-19 16:54:03'),(71,15,'Updated own profile information.','2023-12-19 16:54:18'),(72,NULL,'Logout','2023-12-19 16:54:30'),(73,15,'Logged in','2023-12-19 16:54:40'),(74,15,'Updated own profile information.','2023-12-19 16:54:54'),(75,15,'Updated own profile information.','2023-12-19 16:55:08'),(76,NULL,'Logout','2023-12-19 16:55:31'),(77,15,'Logged in','2023-12-19 16:55:38'),(78,15,'Updated own profile information.','2023-12-19 16:57:23'),(79,NULL,'Logout','2023-12-19 17:08:30'),(80,15,'Logged in','2023-12-19 17:09:11'),(81,15,'Updated own profile information.','2023-12-19 17:09:20'),(82,15,'Updated own profile information.','2023-12-19 17:09:46'),(83,15,'Updated own profile information.','2023-12-19 17:10:27'),(84,15,'Updated own profile information.','2023-12-19 17:10:29'),(85,15,'Updated own profile information.','2023-12-19 17:10:39'),(86,15,'Added Sale for ID: 13 Sugared Serenity','2023-12-19 17:14:32'),(87,15,'Added Sale for ID: 19 Mystic Rosewood','2023-12-19 17:21:46'),(88,15,'Logout','2023-12-19 17:26:07'),(89,16,'Logged in','2023-12-19 17:26:24'),(90,16,'Added Sale for ID: 20 Sun-kissed Serenade','2023-12-19 17:27:27'),(91,16,'Added Sale for ID: 12 Whispering Moonlight','2023-12-19 17:27:48'),(92,16,'Updated own profile information.','2023-12-19 17:28:34'),(93,16,'Logout','2023-12-19 17:28:42'),(94,15,'Logged in','2023-12-19 17:28:49'),(95,15,'Updated own profile information.','2023-12-19 17:31:58'),(96,15,'Edited Sale ID: 2','2023-12-19 17:51:44'),(97,15,'Edited Sale ID: 2','2023-12-19 17:53:01'),(98,15,'Logout','2023-12-19 17:53:51'),(99,16,'Logged in','2023-12-19 17:54:06'),(100,16,'Logout','2023-12-19 17:54:26'),(101,15,'Logged in','2023-12-19 17:54:33'),(102,15,'Logout','2023-12-19 17:54:40'),(103,15,'Logged in','2023-12-19 18:43:20'),(104,15,'Logout','2023-12-19 18:44:45'),(105,15,'Logged in','2023-12-19 22:27:44'),(106,15,'Added Sale for ID: 1 DapperGlow','2023-12-19 22:28:13'),(107,15,'Logged in','2023-12-20 08:30:04'),(108,15,'Edited Sale ID: 2','2023-12-20 08:32:02'),(109,15,'Logout','2023-12-20 08:32:40'),(110,16,'Logged in','2023-12-20 08:32:48'),(111,16,'Logout','2023-12-20 08:40:32'),(112,15,'Logged in','2023-12-20 08:55:05'),(113,15,'Added Lenie Para as Employee','2023-12-20 08:55:36'),(114,15,'Logout','2023-12-20 08:56:09'),(115,17,'Logged in','2023-12-20 08:56:15'),(116,17,'Logout','2023-12-20 08:56:21'),(117,15,'Logged in','2023-12-20 09:10:12'),(118,15,'Logout','2023-12-20 09:11:45'),(119,15,'Logged in','2023-12-20 09:14:23'),(120,15,'Logout','2023-12-20 09:16:38'),(121,16,'Logged in','2023-12-20 09:17:05'),(122,16,'Logout','2023-12-20 09:18:55'),(123,15,'Logged in','2023-12-20 09:19:33'),(124,15,'Logout','2023-12-20 09:20:16'),(125,16,'Logged in','2023-12-20 09:22:09'),(126,16,'Logout','2023-12-20 09:27:21'),(127,15,'Logged in','2023-12-20 09:27:30'),(128,15,'Logout','2023-12-20 09:27:38'),(129,16,'Logged in','2023-12-20 09:27:52'),(130,16,'Added Andrie as customer.','2023-12-20 09:34:38'),(131,16,'Added Sale for ID: 19 Mystic Rosewood','2023-12-20 09:35:02'),(132,16,'Logout','2023-12-20 09:37:00'),(133,15,'Logged in','2023-12-20 09:37:06'),(134,15,'Logout','2023-12-20 09:44:35'),(135,16,'Logged in','2023-12-20 10:00:04'),(136,16,'Deleted sale with sale ID 7 ','2023-12-20 10:00:24'),(137,16,'Logout','2023-12-20 10:00:54'),(138,15,'Logged in','2023-12-20 10:09:16'),(139,15,'Added Sale for ID: 7 VibrantElegance','2023-12-20 10:11:03'),(140,15,'Logout','2023-12-20 10:12:43'),(141,16,'Logged in','2023-12-20 10:12:52'),(142,16,'Logout','2023-12-20 10:13:54'),(143,15,'Logged in','2023-12-25 21:46:38'),(144,15,'Logout','2023-12-25 22:09:31'),(145,16,'Logged in','2023-12-25 22:09:38'),(146,16,'Logout','2023-12-25 22:27:02'),(147,15,'Logged in','2023-12-25 22:27:07'),(148,15,'Logout','2023-12-26 01:30:05'),(149,15,'Logged in','2023-12-27 08:43:59'),(150,15,'Logout','2023-12-27 16:15:35'),(151,16,'Logged in','2023-12-27 16:15:45'),(152,16,'Logout','2023-12-27 16:17:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Female','2023-12-19 15:13:35','2023-12-19 15:13:35'),(2,'Male','2023-12-19 15:13:51','2023-12-19 15:13:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Lenie','09978653452','leniepara@gmail.com','San jose, tacloban','2023-12-19 15:51:05','2023-12-19 15:51:05'),(2,'Edwin','09978547516','quintana@gmail.com','Maribi Tanauan leyte','2023-12-19 15:51:36','2023-12-19 15:51:36'),(3,'Razel Ann Puto','09976534251','puto@gmail.com','Sata fe','2023-12-19 15:52:27','2023-12-19 15:52:27'),(4,'Aileen Almoden','09978653651','almoden@gmail.com','Pastrana Leyte','2023-12-19 15:53:16','2023-12-19 15:53:16'),(5,'Hazel ann','09987365411','hazel@gmail.com','Tacloban','2023-12-19 15:55:14','2023-12-19 15:55:25'),(6,'Samantha lagado','09876543421','lagado@gmail.com','Dagami','2023-12-19 15:58:13','2023-12-19 15:58:13'),(7,'Mark Tolentino','09975435261','mark@gmail.com','Palo','2023-12-19 15:59:20','2023-12-19 15:59:20'),(8,'Andrie','09978635427','andrie@gmail.com','tacloban','2023-12-20 09:34:38','2023-12-20 09:34:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'DapperGlow','Refined, Timeless, Masculine, Alluring, Sophisticated',2,99,199.00,'2023-12-19 15:42:05','2023-12-19 22:28:13'),(2,'UrbanWhisk','Modern, Energizing, Confident, Urbane, Magnetic',2,100,99.00,'2023-12-19 15:42:28','2023-12-19 15:42:28'),(3,'GentleBreeze','Calming, Elegant, Subtle, Fresh, Approachable',2,100,100.00,'2023-12-19 15:42:52','2023-12-19 15:42:52'),(4,'MysticEmbrace','Enigmatic, Mysterious, Sensual, Invigorating, Unique',2,200,199.00,'2023-12-19 15:43:17','2023-12-19 15:43:17'),(5,'NobleAura','Regal, Commanding, Classic, Refined, Distinctive',2,100,299.00,'2023-12-19 15:43:40','2023-12-19 15:43:40'),(6,'AzureSerenade','Fresh, Crisp, Blue, Invigorating, Serene',2,100,99.00,'2023-12-19 15:44:01','2023-12-19 15:44:01'),(7,'VibrantElegance','Lively, Polished, Vibrant, Captivating, Elegant',2,299,350.00,'2023-12-19 15:44:26','2023-12-20 10:11:03'),(8,'RuggedCharm','Bold, Earthy, Daring, Charismatic, Unconventional',2,100,350.00,'2023-12-19 15:45:03','2023-12-19 15:45:03'),(9,'VelvetWhisper','Smooth, Luxurious, Subdued, Timeless, Romantic',2,500,350.00,'2023-12-19 15:45:27','2023-12-19 15:45:27'),(10,'SolarSpell','Radiant, Spellbinding, Solar, Dynamic, Enchanting',2,100,99.00,'2023-12-19 15:45:45','2023-12-19 15:45:45'),(11,'Enchanted Petals','Playful floral bloom, captivating essence',1,50,200.00,'2023-12-19 15:46:22','2023-12-19 15:46:22'),(12,'Whispering Moonlight','Mysterious, tranquil, vanilla-infused moonlight',1,99,199.00,'2023-12-19 15:46:42','2023-12-19 17:27:48'),(13,'Sugared Serenity','Sweet serenity, lavender indulgence',1,199,250.00,'2023-12-19 15:47:09','2023-12-20 08:32:02'),(14,'Lullaby Lagoon','Serene lagoon whispers, aquatic calm',1,49,100.00,'2023-12-19 15:47:30','2023-12-20 08:32:02'),(15,'Celestial Blush','Ethereal florals, citrus grace',1,60,199.00,'2023-12-19 15:47:47','2023-12-19 15:47:47'),(16,'Gossamer Whispers','Gentle breeze, citrus whispers',1,150,200.00,'2023-12-19 15:48:09','2023-12-19 15:48:09'),(17,'Velvet Aurora','Luxurious vanilla, exotic allure',1,100,300.00,'2023-12-19 15:48:57','2023-12-19 15:48:57'),(18,'Cotton Candy Clouds','Whimsical sweetness, marshmallow delight',1,90,120.00,'2023-12-19 15:49:26','2023-12-19 15:49:26'),(19,'Mystic Rosewood','Captivating roses, dark mystique',1,229,450.00,'2023-12-19 15:49:54','2023-12-20 10:00:24'),(20,'Sun-kissed Serenade','Radiant garden joy, citrus-infused warmth',1,99,250.00,'2023-12-19 15:50:23','2023-12-19 17:27:27');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (2,13,7,15,1,250.00,'2023-12-19 17:14:32','2023-12-20 08:32:02'),(3,19,6,15,1,450.00,'2023-12-19 17:21:46','2023-12-19 17:21:46'),(4,20,5,16,1,250.00,'2023-12-19 17:27:27','2023-12-19 17:27:27'),(5,12,7,16,1,199.00,'2023-12-19 17:27:48','2023-12-19 17:27:48'),(6,1,3,15,1,199.00,'2023-12-19 22:28:13','2023-12-19 22:28:13'),(8,7,4,15,1,350.00,'2023-12-20 10:11:03','2023-12-20 10:11:03');
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,'Hiro','Edwino','Quintano','$2y$10$Ha/uCl.nypLbCuJalX02ouiFU5n80KGZCtIL3mldXPfwtTdKoTPCK','Admin',1,'1697724697984.jpg','2023-12-16 17:54:24','2023-12-19 17:31:58'),(16,'razz','Razel Ann','Puto','$2y$10$jlPgfxYMBWwsPDSUWWiqAeGuqYS7X7x7/4hkbBfpZp1jDd8fJb8BW','Employee',1,'Neutral Fishbone Diagram Template.png','2023-12-19 16:03:41','2023-12-19 17:28:34'),(17,'lpara293','Lenie','Para','$2y$10$cLlkQlqN5WbKH9qwS3Zn6.esaH.CEaLiT.ROrbj.uyB92vmkYBG/C','Employee',1,'default_img.jpg','2023-12-20 08:55:36','2023-12-20 08:55:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_all_sales`
--

DROP TABLE IF EXISTS `vw_all_sales`;
/*!50001 DROP VIEW IF EXISTS `vw_all_sales`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_all_sales` AS SELECT 
 1 AS `SaleID`,
 1 AS `ProductID`,
 1 AS `CustomerID`,
 1 AS `UserID`,
 1 AS `QuantitySold`,
 1 AS `TotalAmount`,
 1 AS `DateCreated`,
 1 AS `DateUpdated`,
 1 AS `ProductName`,
 1 AS `CustomerName`,
 1 AS `UserName`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_logs`
--

DROP TABLE IF EXISTS `vw_user_logs`;
/*!50001 DROP VIEW IF EXISTS `vw_user_logs`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_logs` AS SELECT 
 1 AS `AuditID`,
 1 AS `UserID`,
 1 AS `Action`,
 1 AS `ActionDate`,
 1 AS `UserName`,
 1 AS `UserType`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_sales`
--

DROP TABLE IF EXISTS `vw_user_sales`;
/*!50001 DROP VIEW IF EXISTS `vw_user_sales`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_sales` AS SELECT 
 1 AS `SaleID`,
 1 AS `ProductID`,
 1 AS `CustomerID`,
 1 AS `UserID`,
 1 AS `QuantitySold`,
 1 AS `TotalAmount`,
 1 AS `DateCreated`,
 1 AS `DateUpdated`,
 1 AS `ProductName`,
 1 AS `CustomerName`,
 1 AS `UserName`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `vw_all_sales`
--

/*!50001 DROP VIEW IF EXISTS `vw_all_sales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_all_sales` AS select `s`.`SaleID` AS `SaleID`,`s`.`ProductID` AS `ProductID`,`s`.`CustomerID` AS `CustomerID`,`s`.`UserID` AS `UserID`,`s`.`QuantitySold` AS `QuantitySold`,`s`.`TotalAmount` AS `TotalAmount`,`s`.`DateCreated` AS `DateCreated`,`s`.`DateUpdated` AS `DateUpdated`,`p`.`ProductName` AS `ProductName`,`c`.`CustomerName` AS `CustomerName`,`u`.`UserName` AS `UserName` from (((`sales` `s` join `customers` `c` on((`s`.`CustomerID` = `c`.`CustomerID`))) join `users` `u` on((`s`.`UserID` = `u`.`UserID`))) join `products` `p` on((`s`.`ProductID` = `p`.`ProductID`))) order by `s`.`SaleID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_logs`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_logs`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_logs` AS select `a`.`AuditID` AS `AuditID`,`a`.`UserID` AS `UserID`,`a`.`Action` AS `Action`,`a`.`ActionDate` AS `ActionDate`,`u`.`UserName` AS `UserName`,`u`.`UserType` AS `UserType` from (`audittrail` `a` join `users` `u` on((`a`.`UserID` = `u`.`UserID`))) order by `a`.`AuditID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_sales`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_sales`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_sales` AS select `s`.`SaleID` AS `SaleID`,`s`.`ProductID` AS `ProductID`,`s`.`CustomerID` AS `CustomerID`,`s`.`UserID` AS `UserID`,`s`.`QuantitySold` AS `QuantitySold`,`s`.`TotalAmount` AS `TotalAmount`,`s`.`DateCreated` AS `DateCreated`,`s`.`DateUpdated` AS `DateUpdated`,`p`.`ProductName` AS `ProductName`,`c`.`CustomerName` AS `CustomerName`,`u`.`UserName` AS `UserName` from (((`sales` `s` join `customers` `c` on((`s`.`CustomerID` = `c`.`CustomerID`))) join `users` `u` on((`s`.`UserID` = `u`.`UserID`))) join `products` `p` on((`s`.`ProductID` = `p`.`ProductID`))) order by `s`.`SaleID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-27 16:19:59
