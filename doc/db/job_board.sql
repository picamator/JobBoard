-- MySQL dump 10.13  Distrib 5.7.13, for linux-glibc2.5 (x86_64)
--
-- Host: 0.0.0.0    Database: job_board
-- ------------------------------------------------------
-- Server version	5.7.16

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
-- Table structure for table `job_pool`
--

DROP TABLE IF EXISTS `job_pool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_pool` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publisher_id` int(10) unsigned NOT NULL,
  `job_status_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`publisher_id`,`job_status_id`),
  KEY `fk_job_pool_status_idx` (`job_status_id`),
  KEY `fk_job_pool_publisher_idx` (`publisher_id`),
  CONSTRAINT `fk_job_pool_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_job_pool_status` FOREIGN KEY (`job_status_id`) REFERENCES `job_status` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_pool`
--

LOCK TABLES `job_pool` WRITE;
/*!40000 ALTER TABLE `job_pool` DISABLE KEYS */;
INSERT INTO `job_pool` VALUES (1,1,2,'Test title','Test description','2016-11-15 01:49:40','2016-11-15 01:50:18');
/*!40000 ALTER TABLE `job_pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_published`
--

DROP TABLE IF EXISTS `job_published`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_published` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_pool_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`job_pool_id`),
  KEY `fk_job_published_job_pool_idx` (`job_pool_id`),
  CONSTRAINT `fk_job_published_job_pool` FOREIGN KEY (`job_pool_id`) REFERENCES `job_pool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_published`
--

LOCK TABLES `job_published` WRITE;
/*!40000 ALTER TABLE `job_published` DISABLE KEYS */;
INSERT INTO `job_published` VALUES (1,1,'Test title','Test description','test@test.com','2016-11-15 01:50:52');
/*!40000 ALTER TABLE `job_published` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_status`
--

DROP TABLE IF EXISTS `job_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_status`
--

LOCK TABLES `job_status` WRITE;
/*!40000 ALTER TABLE `job_status` DISABLE KEYS */;
INSERT INTO `job_status` VALUES (1,'published','Published','2016-11-15 01:47:01'),(2,'spam','Spam','2016-11-15 01:47:01'),(3,'forReview','For review','2016-11-15 01:47:01');
/*!40000 ALTER TABLE `job_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_token`
--

DROP TABLE IF EXISTS `job_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_pool_id` int(10) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`job_pool_id`),
  UNIQUE KEY `job_pool_id_UNIQUE` (`job_pool_id`),
  KEY `fk_job_token_job_pool_idx` (`job_pool_id`),
  CONSTRAINT `fk_job_token_job_pool` FOREIGN KEY (`job_pool_id`) REFERENCES `job_pool` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_token`
--

LOCK TABLES `job_token` WRITE;
/*!40000 ALTER TABLE `job_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `publisher_status_id` int(10) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`publisher_status_id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_publisher_publisher_status_idx` (`publisher_status_id`),
  CONSTRAINT `fk_publisher_publisher_status` FOREIGN KEY (`publisher_status_id`) REFERENCES `publisher_status` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` VALUES (1,3,'test@test.com','2016-11-15 01:49:01','2016-11-15 01:49:01');
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher_status`
--

DROP TABLE IF EXISTS `publisher_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher_status`
--

LOCK TABLES `publisher_status` WRITE;
/*!40000 ALTER TABLE `publisher_status` DISABLE KEYS */;
INSERT INTO `publisher_status` VALUES (3,'active','Active','2016-11-11 16:41:33'),(4,'inactive','Inactive','2016-11-11 16:41:33'),(5,'awaitingModeration','Awaiting moderation','2016-11-11 16:41:33');
/*!40000 ALTER TABLE `publisher_status` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-15  4:39:04
