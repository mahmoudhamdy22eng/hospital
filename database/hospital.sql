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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_pat`
--

LOCK TABLES `doc_pat` WRITE;
/*!40000 ALTER TABLE `doc_pat` DISABLE KEYS */;
INSERT INTO `doc_pat` VALUES (1,16,1,NULL),(2,16,2,NULL),(3,15,2,NULL),(4,14,1,NULL),(5,13,1,NULL),(6,13,2,NULL);
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
  PRIMARY KEY (`doctor_id`),
  KEY `dep_no_idx` (`doctor_dep_no`),
  KEY `user_no_idx` (`doctor_user_no`),
  CONSTRAINT `dep_no` FOREIGN KEY (`doctor_dep_no`) REFERENCES `department` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_no` FOREIGN KEY (`doctor_user_no`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctor`
--

LOCK TABLES `doctor` WRITE;
/*!40000 ALTER TABLE `doctor` DISABLE KEYS */;
INSERT INTO `doctor` VALUES (13,'Mahmoud ahmed','files/123124124.jpg','05514968948',2,2,'20:39','23:34',15),(14,'Mahmoud ahmed','files/login.jpg','01065468948',1,1,'09:10','21:10',16),(15,'Mahmoud ahmed','files/5089.jpg','01018768948',1,2,'14:23','14:24',24),(16,'moa ahmed','files/login.jpg','01018768922',3,1,'14:23','21:10',34);
/*!40000 ALTER TABLE `doctor` ENABLE KEYS */;
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
  PRIMARY KEY (`patient_id`),
  KEY `de_no_idx` (`patient_dep_no`),
  KEY `us_no_idx` (`patient_user_no`),
  CONSTRAINT `de_no` FOREIGN KEY (`patient_dep_no`) REFERENCES `department` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `us_no` FOREIGN KEY (`patient_user_no`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'man ahmed','files/login.jpg','01064468948',2,2,35),(2,'madd','files/login.jpg','01064466565',3,1,37);
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
  `user_pass` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `u_type_no` int(11) DEFAULT NULL,
  `u_dep_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `u_type_idx` (`u_type_no`),
  KEY `u_dep_no_idx` (`u_dep_no`),
  CONSTRAINT `u_dep_no` FOREIGN KEY (`u_dep_no`) REFERENCES `department` (`department_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `u_type` FOREIGN KEY (`u_type_no`) REFERENCES `user_type` (`user_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,'mahmoudaaa','Mm1234567*',1,1),(16,'mahmfdsss','Mm1234567*',1,3),(24,'mahmoudasas','Mm1234567*',1,1),(34,'mao','Mm1234567*',1,3),(35,'man','Mm234567*',2,2),(36,'mahmoud','Mm1234567*',3,NULL),(37,'madd','Mm234567*',2,3);
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

-- Dump completed on 2024-06-22 23:33:38
