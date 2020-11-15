-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: exchanger
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `currencies` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  `rate` double NOT NULL,
  `last_updated` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'USD',1,1605363617),(2,'AED',3.672,1605363617),(3,'ARS',79.562,1605363617),(4,'AUD',1.3782,1605363617),(5,'BGN',1.6548,1605363617),(6,'BRL',5.4577,1605363617),(7,'BSD',1,1605363617),(8,'CAD',1.3135,1605363617),(9,'CHF',0.9138,1605363617),(10,'CLP',759.3717,1605363617),(11,'CNY',6.6085,1605363617),(12,'COP',3606.8095,1605363617),(13,'CZK',22.4059,1605363617),(14,'DKK',6.302,1605363617),(15,'DOP',57.9075,1605363617),(16,'EGP',15.601,1605363617),(17,'EUR',0.8458,1605363617),(18,'FJD',2.1039,1605363617),(19,'GBP',0.7591,1605363617),(20,'GTQ',7.7661,1605363617),(21,'HKD',7.7533,1605363617),(22,'HRK',6.4069,1605363617),(23,'HUF',300.7998,1605363617),(24,'IDR',14337.9995,1605363617),(25,'ILS',3.3674,1605363617),(26,'INR',74.6146,1605363617),(27,'ISK',136.98,1605363617),(28,'JPY',104.8514,1605363617),(29,'KRW',1110.8943,1605363617),(30,'KZT',427.9266,1605363617),(31,'MVR',15.42,1605363617),(32,'MXN',20.483,1605363617),(33,'MYR',4.1241,1605363617),(34,'NOK',9.1482,1605363617),(35,'NZD',1.4623,1605363617),(36,'PAB',1,1605363617),(37,'PEN',3.6401,1605363617),(38,'PHP',48.256,1605363617),(39,'PKR',157.4699,1605363617),(40,'PLN',3.7997,1605363617),(41,'PYG',6885.7273,1605363617),(42,'RON',4.1204,1605363617),(43,'RUB',77.4055,1605363617),(44,'SAR',3.7505,1605363617),(45,'SEK',8.6735,1605363617),(46,'SGD',1.3484,1605363617),(47,'THB',30.1771,1605363617),(48,'TRY',7.6768,1605363617),(49,'TWD',28.5016,1605363617),(50,'UAH',28.0668,1605363617),(51,'UYU',42.7202,1605363617),(52,'ZAR',15.5664,1605363617);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favourites`
--

DROP TABLE IF EXISTS `favourites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favourites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `first_currency_id` smallint NOT NULL,
  `second_currency_id` smallint NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user` (`user_id`),
  KEY `FK_first_currency` (`first_currency_id`),
  KEY `FK_second_currency` (`second_currency_id`),
  CONSTRAINT `FK_first_currency` FOREIGN KEY (`first_currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `FK_second_currency` FOREIGN KEY (`second_currency_id`) REFERENCES `currencies` (`id`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favourites`
--

LOCK TABLES `favourites` WRITE;
/*!40000 ALTER TABLE `favourites` DISABLE KEYS */;
INSERT INTO `favourites` VALUES (1,3,2,5,'2020-11-14 08:06:09'),(2,3,1,26,'2020-11-14 08:06:46'),(3,2,1,2,'2020-11-14 05:14:13'),(4,2,1,2,'2020-11-14 05:14:28'),(5,2,1,2,'2020-11-14 05:16:13'),(6,2,1,2,'2020-11-14 05:16:18'),(7,2,1,2,'2020-11-14 05:17:57'),(8,2,3,11,'2020-11-14 05:19:34'),(9,8,1,26,'2020-11-14 08:41:41'),(10,8,17,26,'2020-11-14 08:41:58');
/*!40000 ALTER TABLE `favourites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(60) NOT NULL,
  `auto_pass` tinyint(1) NOT NULL DEFAULT '1',
  `age_proof` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `pass1` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'uchil','uchil@uchil.com','shravan','uchil','1234567890','qwertyuio',1,'123.png','2020-11-09 13:42:39','2020-11-09 13:42:39',NULL,NULL),(2,'shravan','uchil@uchil.com','shravan','uchil','1234567890','qwertyuio',1,'123.png','2020-11-09 13:43:15','2020-11-09 13:43:15',NULL,NULL),(3,'shravan','shravanuchil@gmail.com','shravan','uchil',NULL,'25e65e9fa22767c47baf9a338f21bef1a58f4979',1,'shravan/1604946444_fec8b11a56e5557e91e1.jpg',NULL,NULL,'U2VsAy#H','1984-11-28'),(4,'rakshitha','shravanuchil@gmail.com','shravan','uchil',NULL,'f49c02a05d92bb17d104a4e1f11ef60fa7bde4f0',1,'rakshitha/1605361607_3fafae6ac081f3b94dae.jpg',NULL,NULL,'R%LT7I#h','2013-10-13'),(5,'shravan','shravanuchil@gmail.com','shravan','uchil',NULL,'23c9051264966438ea3e4fa12659d7b9f72775ef',1,'shravan/1605363366_d5ee0e475a2b7bfea159.jpg',NULL,NULL,'k#Pdqgim','2016-10-12'),(6,'shravan','shravanuchil@gmail.com','shravan','uchil',NULL,'630f747c45131a4d208d1868a70ddc9bb6b45e0d',1,'shravan/1605363437_e408bf35613f3e9a176b.jpg',NULL,NULL,'HVdXamfF','2016-10-12'),(7,'shravan','shravanuchil@gmail.com','shravan','uchil',NULL,'fe4011cdc7fe87e727d5a2d517e4ab051a32779d',1,'shravan/1605363484_797703a1186dcefc9590.jpg',NULL,NULL,'ivCadk2u','2018-09-12'),(8,'shravan','shravanuchil@gmail.com','shravan','uchil',NULL,'e1465b066264feefab56d75da3c40ccd232b5e8f',1,'shravan/1605363551_c30d78a251d77b4db13a.jpg',NULL,NULL,'NCZ%EA0s','2018-09-12');
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

-- Dump completed on 2020-11-15  5:59:46
