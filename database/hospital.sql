CREATE DATABASE  IF NOT EXISTS `hospital` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `hospital`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: hospital
-- ------------------------------------------------------
-- Server version	5.7.22-log

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
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'surgery‬‬'),(2,'operations'),(3,'psychology'),(4,'emergency');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_pat`
--

DROP TABLE IF EXISTS `doc_pat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_pat` (
  `doc_pat_id` int(11) NOT NULL AUTO_INCREMENT,
  `rel_doctor` int(11) DEFAULT NULL,
  `rel_patient` int(11) DEFAULT NULL,
  `dp_u_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`doc_pat_id`),
  KEY `rel_doc_idx` (`rel_doctor`),
  KEY `rel_pat_idx` (`rel_patient`),
  KEY `user_no_idx` (`dp_u_no`),
  CONSTRAINT `rel_doc` FOREIGN KEY (`rel_doctor`) REFERENCES `doctor` (`doctor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `rel_pat` FOREIGN KEY (`rel_patient`) REFERENCES `patient` (`patient_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_pat`
--

LOCK TABLES `doc_pat` WRITE;
/*!40000 ALTER TABLE `doc_pat` DISABLE KEYS */;
INSERT INTO `doc_pat` VALUES (1,16,1,NULL),(2,16,2,NULL),(3,15,2,NULL),(4,14,1,NULL),(5,13,1,NULL),(6,13,2,NULL),(7,14,16,NULL),(8,14,16,NULL),(9,13,NULL,NULL);
/*!40000 ALTER TABLE `doc_pat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `doctor_img` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `doctor_phone` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `doctor_dep_no` int(11) DEFAULT NULL,
  `doctor_gender` int(11) DEFAULT NULL COMMENT '1 = male,\n2 = female',
  `doc_schedule_start` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `doc_schedule_end` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `doctor_user_no` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0' COMMENT '1 true,\n0 false',
  PRIMARY KEY (`doctor_id`),
  KEY `dep_no_idx` (`doctor_dep_no`),
  KEY `user_no_idx` (`doctor_user_no`),
  CONSTRAINT `dep_no` FOREIGN KEY (`doctor_dep_no`) REFERENCES `department` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_no` FOREIGN KEY (`doctor_user_no`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (13,'Mahmoud ahmed','files/123124124.jpg','05514968948',2,2,'20:39','23:34',15,0),(14,'Mahmoud a','files/login.jpg','01065468948',1,1,'09:10','21:10',16,0),(15,'Mahmoud ahmed','files/5089.jpg','01018768948',1,2,'14:23','14:24',24,0),(16,'moa ahmed','files/health.jpg','01018768922',3,1,'14:23','21:10',34,0),(17,'ahmed hamdy','files/login.jpg','01014968789',1,1,'12:51','00:51',67,0),(18,'ahmed ali','files/login.jpg','01014968457',4,1,'00:59','12:53',68,0),(19,'mary adel','files/login.jpg','01014961235',4,1,'00:00','00:59',69,0),(20,'sandy nadi','files/health.jpg','01014547948',3,2,'06:55','12:55',70,0),(21,'khalid jamal','files/login.jpg','01014968564',3,1,'12:56','00:02',71,0),(22,'mahmoud hamdy','files/5073.jpg','04234968948',4,1,'00:00','12:57',72,0);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_content` text COLLATE utf8_bin,
  `msg_pat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'welcome',18),(2,'come tomorrow',2),(4,'hey',19);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `patient_img` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `patient_phone` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `patient_dep_no` int(11) DEFAULT NULL,
  `patient_gender` int(11) DEFAULT NULL COMMENT '1 = male,\n2 = female',
  `patient_user_no` int(11) DEFAULT NULL,
  `patient_doc_no` int(11) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT '0' COMMENT '1 true,\n0 false',
  PRIMARY KEY (`patient_id`),
  KEY `p_dep_no_idx` (`patient_dep_no`),
  KEY `p_user_no_idx` (`patient_user_no`),
  KEY `p_doctor_no_idx` (`patient_doc_no`),
  CONSTRAINT `p_dep_no` FOREIGN KEY (`patient_dep_no`) REFERENCES `department` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `p_doctor_no` FOREIGN KEY (`patient_doc_no`) REFERENCES `doctor` (`doctor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `p_user_no` FOREIGN KEY (`patient_user_no`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'man fadi','files/login.jpg','01064468948',2,2,35,15,0),(2,'madd','files/login.jpg','01064466183',NULL,1,37,NULL,0),(3,'Mahmoud ahmed','files/123124124.jpg','01222968948',2,1,53,13,0),(16,'Mahmoud ahmed','files/health.jpg','01014968955',1,1,64,14,0),(18,'madd2','files/health.jpg','01014968911',3,2,65,16,0),(19,'Maho ahmed','files/login.jpg','01014968987',3,2,66,16,0),(20,'hany ali','files/wallhaven-700116.jpg','01014968423',1,1,73,17,0),(21,'ramy isac','files/abstract.jpg','01014965566',1,1,74,17,0),(22,'hady sleem','files/backgro848.jpg','01065468948',3,1,75,21,0),(23,'sally adly','files/jon-flobrant.jpg','01014421248',4,2,76,22,0);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `user_pass` text COLLATE utf8_bin,
  `u_type_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `u_type_idx` (`u_type_no`),
  CONSTRAINT `u_type` FOREIGN KEY (`u_type_no`) REFERENCES `user_type` (`user_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,'mahmoudaaa','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',1),(16,'mahmfdsss','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',1),(24,'mahmoudasas','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',1),(34,'mao','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',1),(35,'man','Mm234567*',2),(36,'mahmoud','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',3),(37,'madd','Mm234567*',2),(53,'mahnnnn','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',NULL),(54,'mahrrrrr','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',1),(64,'mahyyy','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',2),(65,'madd2','$2y$10$vhfYtzsMAoUr.kiFwiggkePhDyPJrhF0x4mxH3aPM2wlyZKxaKB8W',2),(66,'maho','Mm1234567*',2),(67,'ahmedhamdy','Mm1234567*',1),(68,'ahmedali','Mm1234567*',1),(69,'maryadel','Mm1234567*',1),(70,'sandynady','Mm1234567*',1),(71,'khalidjamal','Mm1234567*',1),(72,'mahmoudhamdy','Mm1234567*',1),(73,'hanyali','$10$yaB7Wp2YaTSwKv6iUweXfOD/cCti2jDMxgqZJo4srFEXRLqmJWCK.',2),(74,'ramyisac','Mm1234567*',2),(75,'hadysleem','$2y$10$yaB7Wp2YaTSwKv6iUweXfOD/cCti2jDMxgqZJo4srFEXRLqmJWCK.',2),(76,'sallyadly','$2y$10$wDGCMIt6uqPiCY7XIHBNB.Vk0VN4G2XEoxmVEIobLe6SIrWHn3gmu',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'doctor'),(2,'patient'),(3,'admin');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'hospital'
--

--
-- Dumping routines for database 'hospital'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-25  3:11:43
