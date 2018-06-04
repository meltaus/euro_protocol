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
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_protocol` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`id_protocol`),
  KEY `fk_id_protocol_photo_idx` (`id_protocol`),
  KEY `fk_id_type_document_idx` (`id_type`),
  CONSTRAINT `fk_id_type_document` FOREIGN KEY (`id_type`) REFERENCES `type_document` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (5,4,'berserk_guts_black_swordsman_28992018-06-04.jpg',2),(6,4,'art_pustynya_chelovek_vrata2018-06-04.jpg',2),(7,4,'art_krepost_fentazi2018-06-04.jpg',2),(8,4,'art_mari_milkuro_cat_devushka_76242018-06-04.jpg',2),(9,4,'art_adai_ikue_zimnii_les_sumerki_sneg2018-06-04.jpg',2),(10,9,'planeta_gorod_ogni_art_fantastika2018-06-04.jpg',2),(11,9,'art_mari_milkuro_cat_devushka_76242018-06-04.jpg',2),(12,9,'art_pustynya_chelovek_vrata2018-06-04.jpg',2),(13,9,'art_krepost_fentazi2018-06-04.jpg',2),(14,9,'art_adai_ikue_zimnii_les_sumerki_sneg2018-06-04.jpg',2),(15,9,'ÑÑÑÑÐºÐ¸Ð¹ ÑÐµÐºÑÑ2018-06-04.jpg',2),(16,9,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(17,9,'2018-06-04.jpg',2),(18,9,'planetary_small_sun_reactor_shar_tma2018-06-04.jpg',2),(19,9,'ÑÑÑÑÐºÐ¸Ð¹ ÑÐµÐºÑÑ2018-06-04.jpg',2),(20,9,'space_station_luna_kosmos2018-06-04.jpg',2),(21,9,'towers_elf_warrior_weapons_spears_lights_flying_vehicles_roc2018-06-04.jpg',2),(22,9,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(23,9,'ÑÑÑÑÐºÐ¸Ð¹ ÑÐµÐºÑÑ2018-06-04.jpg',2),(24,9,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(25,9,'towers_elf_warrior_weapons_spears_lights_flying_vehicles_roc2018-06-04.jpg',2),(26,9,'ÑÑÑÑÐºÐ¸Ð¹ ÑÐµÐºÑÑ2018-06-04.jpg',2),(27,2,'ÑÑÑÑÐºÐ¸Ð¹ ÑÐµÐºÑÑ2018-06-04.jpg',2),(28,2,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(29,2,'русский текст2018-06-04.jpg',2),(30,2,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(31,3,'русский текст2018-06-04.jpg',2),(32,3,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(33,10,'ГОДОВОЙ ОТЧЕТ 2016г (пояснительная записка)2018-06-04.pdf',1),(34,10,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(35,10,'русский текст2018-06-04.jpg',2),(36,11,'Счет № Tr000251727 от 17 мая 20182018-06-04.pdf',1),(37,11,'cmd12018-06-04.jpg',2),(38,11,'mtr12018-06-04.jpg',2),(39,12,'ГОДОВОЙ ОТЧЕТ 2016г2018-06-04.pdf',1),(40,13,'Почта00012018-06-04.pdf',1),(41,13,'y_y_devushka_kity_kosmos_fentezi2018-06-04.jpg',2),(42,13,'русский текст2018-06-04.jpg',2);
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-04 21:14:44
