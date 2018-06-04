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
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `state_car_number` varchar(32) NOT NULL,
  `id_company` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_auto_idx` (`id_auto`),
  KEY `fk_id_company_idx` (`id_company`),
  CONSTRAINT `fk_id_auto` FOREIGN KEY (`id_auto`) REFERENCES `auto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,'Василий Петров Валерьевич',4,'pd231pp',1),(2,'Василий Петров Валерьевич',2,'pd232ss',2),(3,'Василий Петров Валерьевич',3,'pd21p',3),(4,'Василий Петров Валерьевич',6,'pd123az',4),(5,'Василий Петров Валерьевич',14,'pd231as',1),(6,'Василий Петров Валерьевич',12,'s23fg5',2),(7,'Василий Петров Валерьевич',1,'hy563d',3),(8,'Василий Петров Валерьевич',5,'nh32f',4),(9,'Василий Петров Валерьевич',8,'hg3453d',3),(10,'Василевский Вася Васичкин',16,'kf453k',1),(11,'Петрушев Петр Петрович',17,'sd123a',5),(12,'Иванов Иван Иванович',11,'а232ыу123',1),(13,'Щеглов Антон Захарович',2,'в213ао124',6),(14,'Горбачев Артем Эдуардович',18,'ро1231ро',1),(15,'Ахмадиев Дмитрий Тахирович',4,'ло13123ло',2),(16,'Горбачев Артем Эдуардович',4,'asd123123a',1),(17,'Матвеев Владимир Игоревич',16,'asd1312asd',3),(18,'Петрушев Петр Петрович',2,'e123ыв124',1),(19,'Иванов Иван Иванович',19,'к321ок24',7),(20,'Пушкин Александр Александрович',20,'asd123123a',1),(21,'Матвеев Владимир Игоревич',4,'ds123as',1),(22,'Горбачева Анастасия Павловна',11,'as1231sda',1),(23,'Горбачев Артем Эдуардович',17,'as1231sa',3);
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
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
