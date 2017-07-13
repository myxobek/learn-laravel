-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: learn_laravel
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=667 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (661,'2014_10_12_000000_create_users_table',1),(662,'2014_10_12_100000_create_password_resets_table',1),(663,'2017_07_11_162233_create_products_table',1),(664,'2017_07_11_164121_create_vouchers_table',1),(665,'2017_07_11_171716_adds_api_token_to_users_table',1),(666,'2017_07_12_165329_create_product_vouchers_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_vouchers`
--

DROP TABLE IF EXISTS `product_vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_vouchers_product_id_voucher_id_unique` (`product_id`,`voucher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_vouchers`
--

LOCK TABLES `product_vouchers` WRITE;
/*!40000 ALTER TABLE `product_vouchers` DISABLE KEYS */;
INSERT INTO `product_vouchers` VALUES (1,40,4,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(2,7,3,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(3,8,8,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(4,37,1,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(5,50,5,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(6,34,7,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(7,30,7,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(8,9,7,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(9,1,10,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(10,20,5,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(11,13,3,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(12,42,6,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(13,4,7,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(14,50,3,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(15,30,10,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(16,24,10,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(17,13,4,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(18,19,1,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(19,24,9,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(20,11,2,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(21,24,8,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(22,38,10,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(23,50,7,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(24,6,5,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(25,37,8,'2017-07-12 23:38:32','2017-07-12 23:38:32');
/*!40000 ALTER TABLE `product_vouchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'crooks.felicity@trantow.com',682.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(2,'dwaters@harber.info',334.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(3,'rebekah99@yahoo.com',646.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(4,'ohara.clyde@upton.net',945.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(5,'vandervort.jo@zboncak.com',503.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(6,'jarret.runolfsdottir@zboncak.net',168.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(7,'llehner@hotmail.com',492.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(8,'nhegmann@yahoo.com',652.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(9,'rodriguez.monserrate@krajcik.com',155.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(10,'rosenbaum.lenore@ruecker.com',267.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(11,'macejkovic.durward@gmail.com',749.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(12,'hunter.kuhlman@yahoo.com',486.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(13,'konopelski.taryn@kiehn.com',561.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(14,'corine19@klein.com',661.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(15,'wiegand.mia@bartell.com',213.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(16,'lgraham@kunde.com',836.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(17,'josie.kulas@hotmail.com',910.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(18,'zoe.gleason@yahoo.com',113.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(19,'adrien19@collier.com',446.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(20,'milan.schowalter@hickle.com',217.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(21,'jeanne64@gmail.com',47.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(22,'riley.bergnaum@yahoo.com',82.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(23,'camryn53@pfeffer.org',716.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(24,'bechtelar.meagan@hotmail.com',246.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(25,'ofranecki@jenkins.com',880.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(26,'darren.conroy@yahoo.com',624.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(27,'champlin.maryam@yahoo.com',451.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(28,'haag.nadia@yahoo.com',214.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(29,'kfisher@gottlieb.org',561.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(30,'alice81@hoeger.biz',135.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(31,'hodkiewicz.lexi@hintz.net',697.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(32,'anjali.stiedemann@hotmail.com',712.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(33,'mquigley@ernser.biz',494.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(34,'mitchell.tom@gmail.com',997.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(35,'gislason.elfrieda@hotmail.com',956.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(36,'micah.breitenberg@hotmail.com',121.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(37,'hlittle@hotmail.com',138.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(38,'wisozk.lavon@yahoo.com',897.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(39,'lnitzsche@hotmail.com',705.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(40,'pbatz@mertz.org',298.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(41,'beichmann@yahoo.com',634.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(42,'metz.rossie@gmail.com',947.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(43,'cordia.nikolaus@hotmail.com',397.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(44,'talia.bayer@mante.org',636.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(45,'coreilly@hotmail.com',830.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(46,'wilderman.jessy@franecki.com',548.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(47,'irice@yahoo.com',78.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(48,'orion.rogahn@gmail.com',583.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(49,'elouise.walker@romaguera.com',789.00,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(50,'armstrong.sierra@will.com',142.00,'2017-07-12 23:38:32','2017-07-12 23:38:32');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin@test.com','$2y$10$WrVtbMXDlHevSiKFzEdFkOgo04gPfIfq6MbpLyVce/T4eFjrQyMSa',NULL,'2017-07-12 23:38:32','2017-07-12 23:38:36','F33ZspNa3HuXkgvQOKo5RW81UV0PsLVLmkcNN8MGFEKaVWoiAuNT4FhPCY6Z');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vouchers`
--

DROP TABLE IF EXISTS `vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_from` datetime NOT NULL,
  `date_till` datetime NOT NULL,
  `discount` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vouchers`
--

LOCK TABLES `vouchers` WRITE;
/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;
INSERT INTO `vouchers` VALUES (1,'2017-07-11 04:19:03','2017-07-12 23:48:45',14,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(2,'2017-07-11 10:56:38','2017-07-14 02:01:00',41,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(3,'2017-07-11 12:01:34','2017-07-13 07:12:23',38,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(4,'2017-07-11 05:41:57','2017-07-12 15:19:14',75,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(5,'2017-07-11 17:37:21','2017-07-12 16:32:28',69,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(6,'2017-07-11 14:49:39','2017-07-12 06:21:24',64,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(7,'2017-07-11 13:45:47','2017-07-12 17:26:38',19,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(8,'2017-07-11 20:25:54','2017-07-13 17:01:39',27,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(9,'2017-07-11 09:07:56','2017-07-13 11:03:10',38,'2017-07-12 23:38:32','2017-07-12 23:38:32'),(10,'2017-07-11 22:49:58','2017-07-12 20:04:29',64,'2017-07-12 23:38:32','2017-07-12 23:38:32');
/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-13  5:46:47
