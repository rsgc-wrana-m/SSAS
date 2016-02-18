-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: 209.236.71.62    Database: mrgogor3_SSAS
-- ------------------------------------------------------
-- Server version	5.6.28

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
-- Table structure for table `acceptedmission`
--
USE mrgogor3_SSAS;

DROP TABLE IF EXISTS `acceptedmission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acceptedmission` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_acceptedmission_mission1_idx` (`mission_id`),
  KEY `fk_acceptedmission_student1_idx` (`student_id`),
  CONSTRAINT `fk_acceptedmission_mission1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_acceptedmission_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acceptedmission`
--

LOCK TABLES `acceptedmission` WRITE;
/*!40000 ALTER TABLE `acceptedmission` DISABLE KEYS */;
/*!40000 ALTER TABLE `acceptedmission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chainmission`
--

DROP TABLE IF EXISTS `chainmission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chainmission` (
  `id` int(11) NOT NULL,
  `chain_id` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chainmission`
--

LOCK TABLES `chainmission` WRITE;
/*!40000 ALTER TABLE `chainmission` DISABLE KEYS */;
/*!40000 ALTER TABLE `chainmission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `class` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (0,'eng4u'),(1,'ems3o');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failedmission`
--

DROP TABLE IF EXISTS `failedmission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failedmission` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_failedmission_mission1_idx` (`mission_id`),
  KEY `fk_failedmission_student1_idx` (`student_id`),
  CONSTRAINT `fk_failedmission_mission1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_failedmission_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failedmission`
--

LOCK TABLES `failedmission` WRITE;
/*!40000 ALTER TABLE `failedmission` DISABLE KEYS */;
/*!40000 ALTER TABLE `failedmission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission`
--

DROP TABLE IF EXISTS `mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `missiontype_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` longtext NOT NULL,
  `rubric` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mission_missiontypes_idx` (`missiontype_id`),
  CONSTRAINT `fk_mission_missiontypes` FOREIGN KEY (`missiontype_id`) REFERENCES `missiontype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission`
--

LOCK TABLES `mission` WRITE;
/*!40000 ALTER TABLE `mission` DISABLE KEYS */;
/*!40000 ALTER TABLE `mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missiontype`
--

DROP TABLE IF EXISTS `missiontype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `missiontype` (
  `id` int(11) NOT NULL,
  `mtype` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missiontype`
--

LOCK TABLES `missiontype` WRITE;
/*!40000 ALTER TABLE `missiontype` DISABLE KEYS */;
/*!40000 ALTER TABLE `missiontype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rejectedmission`
--

DROP TABLE IF EXISTS `rejectedmission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rejectedmission` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rejectedmission_mission1_idx` (`mission_id`),
  KEY `fk_rejectedmission_student1_idx` (`student_id`),
  CONSTRAINT `fk_rejectedmission_mission1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_rejectedmission_student1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rejectedmission`
--

LOCK TABLES `rejectedmission` WRITE;
/*!40000 ALTER TABLE `rejectedmission` DISABLE KEYS */;
/*!40000 ALTER TABLE `rejectedmission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'nramsubick@rsgc.on.ca','Nick','Ram','$2y$10$efq/zSWcH3ATr94PF4HflO8oIUaUorCUFcASjhoUnUMN8MYR3VMEi'),(2,'12345','abc','def','$2y$10$0.wisE0EVV0gxN.lY9eP..PJQLgzRRFhavtASXIw8Io83F2vPR0aC'),(3,'sbowlby@rsgc.on.ca','Scott','Bowlby','$2y$10$HU6nXI4.GphO1QBW67ftEuiL3x.gvTD9YLo1mXWRbrPQCzFabmq42'),(4,'quinnhartwig@gmail.com','Quinn','Hartwig','$2y$10$LMUQC2kAWgsNBKp5G2N9V.rRESTpQb5XEHcDIXko4HG5QthXApz.6'),(5,'rgordon@rsgc.on.ca','Russell','Gordon','$2y$10$OyInLTASsmr8LvqL2MRlc.sEjaJIzUd13GLhyHnN1.lds4Z9/nFfu'),(6,'sbowlby@gmail.com','Scotty','Bowlby','$2y$10$JVx32kxy7dV.TSu0oa54muao0HW5EVnaGBPwViN3Lgvw1lwxMq8LG'),(7,'dbowen@rsgc.on.ca','Doug','Bowen','$2y$10$xYdbbNdR7ezAHKyyWB6tguV5J2tB7OlhBxycg4.bo80HA.uKtMaSS'),(8,'mwrana@gmail.com','Michael','Wrana','$2y$10$Dait4Uzeq3phz6swF38v/OfqnGYKFK0aBwwX767A9BqZ3RUZKdMaK'),(9,'wranamichael@gmail.com','M','W','$2y$10$EXhvRvyzOCdIRhoXHD8APOa105GgmAB3lGQ1hnEmnmJubbevwMiOG'),(10,'jser@rsgc.on.ca','Jon','Ser','$2y$10$Ov8HQPKYovKnguHR8p.MJuv7JJHYdaEWQs9dBfm8yIGAcwDaFSxNm');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher`
--

LOCK TABLES `teacher` WRITE;
/*!40000 ALTER TABLE `teacher` DISABLE KEYS */;
/*!40000 ALTER TABLE `teacher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-02 16:40:48
