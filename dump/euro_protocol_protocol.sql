CREATE DATABASE  IF NOT EXISTS `euro_protocol` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `euro_protocol`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 192.168.59.110    Database: euro_protocol
-- ------------------------------------------------------
-- Server version	5.5.5-10.2.14-MariaDB

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
-- Table structure for table `protocol`
--

DROP TABLE IF EXISTS `protocol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `protocol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number_polis` int(11) NOT NULL,
  `id_statement` int(11) NOT NULL,
  `time_register` datetime NOT NULL DEFAULT current_timestamp(),
  `time_atuo_emer` datetime NOT NULL,
  `time_inspection` datetime DEFAULT NULL,
  `time_fact_inspection` datetime DEFAULT NULL,
  `time_insert_service_control` datetime DEFAULT NULL,
  `id_people_culprit` int(11) NOT NULL,
  `id_people_member` int(11) DEFAULT NULL,
  `hide` tinyint(1) DEFAULT NULL,
  `id_number_polis_member` int(11) NOT NULL,
  `time_send_service_control` datetime DEFAULT NULL,
  `notice` varchar(255) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`,`id_number_polis`),
  KEY `fk_id_people_culprit_idx` (`id_people_culprit`),
  KEY `fk_id_people_member_idx` (`id_people_member`),
  KEY `fk_id_number_polis_idx` (`id_number_polis`),
  KEY `fk_id_number_polis_member_idx` (`id_number_polis_member`),
  KEY `fk_id_statement_idx` (`id_statement`),
  CONSTRAINT `fk_id_number_polis` FOREIGN KEY (`id_number_polis`) REFERENCES `polis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_number_polis_member` FOREIGN KEY (`id_number_polis_member`) REFERENCES `polis` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_people_culprit` FOREIGN KEY (`id_people_culprit`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_people_member` FOREIGN KEY (`id_people_member`) REFERENCES `people` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_statement` FOREIGN KEY (`id_statement`) REFERENCES `statement` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `protocol`
--

LOCK TABLES `protocol` WRITE;
/*!40000 ALTER TABLE `protocol` DISABLE KEYS */;
INSERT INTO `protocol` VALUES (1,12,1,'2018-05-15 17:00:00','2018-05-16 00:00:00',NULL,NULL,NULL,1,2,NULL,13,NULL,NULL,NULL),(2,14,2,'2018-05-15 13:00:00','2018-05-16 00:00:00','2018-06-09 00:00:00',NULL,NULL,3,4,NULL,15,NULL,NULL,'adasdasdasd'),(3,16,3,'2018-05-15 14:00:00','2018-05-16 00:00:00','2018-06-16 12:12:00',NULL,NULL,5,6,NULL,17,NULL,NULL,'xzf123фывфыв'),(4,18,4,'2018-05-15 12:00:00','2018-05-16 00:00:00','2018-06-14 00:00:00',NULL,NULL,7,8,NULL,19,NULL,NULL,'dsfdfg13123'),(5,20,5,'2018-05-15 11:00:00','2018-05-16 00:00:00',NULL,NULL,NULL,9,2,NULL,21,NULL,NULL,NULL),(8,22,20,'2018-05-30 00:00:00','2018-05-30 11:43:06',NULL,NULL,NULL,10,11,NULL,23,'2018-05-30 00:00:00',NULL,NULL),(9,26,21,'2018-05-30 00:00:00','2018-05-30 14:16:12','2018-05-30 20:16:45',NULL,NULL,14,15,NULL,27,'2018-05-30 00:00:00',NULL,NULL),(10,28,22,'2018-06-04 00:00:00','2018-06-04 06:31:09','2018-06-23 12:30:00',NULL,NULL,16,17,NULL,29,'2018-06-04 00:00:00',NULL,'123asdasdфывфыв'),(11,30,23,'2018-06-04 00:00:00','2018-06-04 07:04:03','2018-06-08 12:00:00',NULL,NULL,18,19,NULL,31,'2018-02-01 00:00:00',NULL,'Человек-мудак.'),(12,32,24,'2018-06-04 00:00:00','2018-06-04 13:22:52',NULL,NULL,NULL,20,21,NULL,33,'2018-06-04 00:00:00',NULL,NULL),(13,34,25,'2018-06-04 00:00:00','2018-06-04 13:26:43','2018-06-16 13:22:00',NULL,NULL,22,23,NULL,35,'2018-06-04 00:00:00',NULL,'Так бывает');
/*!40000 ALTER TABLE `protocol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-04 21:14:43
