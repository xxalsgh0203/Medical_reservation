-- MySQL dump 10.13  Distrib 5.7.37, for Linux (x86_64)
--
-- Host: localhost    Database: mysql
-- ------------------------------------------------------
-- Server version	5.7.36-google-log

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
-- Current Database: `medical_clinic`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `medical_clinic` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `medical_clinic`;

--
-- Table structure for table `ADMIN`
--

DROP TABLE IF EXISTS `ADMIN`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ADMIN` (
  `Admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `Office_id` int(11) DEFAULT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone_number` char(10) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Appointment_Approval` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Admin_id`),
  UNIQUE KEY `Phone_number` (`Phone_number`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Office_id` (`Office_id`),
  CONSTRAINT `ADMIN_ibfk_1` FOREIGN KEY (`Office_id`) REFERENCES `OFFICE` (`Office_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ADMIN`
--

LOCK TABLES `ADMIN` WRITE;
/*!40000 ALTER TABLE `ADMIN` DISABLE KEYS */;
INSERT INTO `ADMIN` VALUES (1,1,'Alice','Password','3053024627','alice@yahoo.com',NULL),(2,1,'Bob','Password','4169462054','bob@ygoogle.com',NULL),(3,1,'Charlie','Password','4984514871','charlie@uh.edu',NULL),(4,2,'Admin','Password','8481610612','admin@medical.com',NULL),(5,2,'Marianne','Password','3404540459','Marianne@yahoo.com',NULL),(6,3,'Lindsey','Password','4221010530','Lindsey@ygoogle.com',NULL),(7,3,'Tiffany','Password','2344703282','Tiffany@uh.edu',NULL),(8,3,'Bridget','Password','1554544861','Bridget@medical.com',NULL);
/*!40000 ALTER TABLE `ADMIN` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `APPOINTMENT`
--

DROP TABLE IF EXISTS `APPOINTMENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `APPOINTMENT` (
  `Appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `Patient_id` int(11) DEFAULT NULL,
  `Doctor_id` int(11) NOT NULL,
  `Office_id` int(11) NOT NULL,
  `Appointment_status_id` int(11) NOT NULL DEFAULT '0',
  `Appointment_status` varchar(12) NOT NULL,
  `Date` date NOT NULL,
  `Slotted_time` time NOT NULL,
  `Specialist_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`Appointment_id`),
  KEY `Patient_id` (`Patient_id`),
  KEY `Doctor_id` (`Doctor_id`),
  KEY `Office_id` (`Office_id`),
  CONSTRAINT `APPOINTMENT_ibfk_1` FOREIGN KEY (`Patient_id`) REFERENCES `PATIENT` (`Patient_id`) ON DELETE CASCADE,
  CONSTRAINT `APPOINTMENT_ibfk_2` FOREIGN KEY (`Doctor_id`) REFERENCES `DOCTOR` (`Doctor_id`) ON DELETE CASCADE,
  CONSTRAINT `APPOINTMENT_ibfk_3` FOREIGN KEY (`Office_id`) REFERENCES `OFFICE` (`Office_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `APPOINTMENT`
--

LOCK TABLES `APPOINTMENT` WRITE;
/*!40000 ALTER TABLE `APPOINTMENT` DISABLE KEYS */;
INSERT INTO `APPOINTMENT` VALUES (1,1,1,1,0,'pending','2022-04-20','09:00:00',0),(2,1,5,2,0,'approved','2022-04-21','15:00:00',0),(3,2,3,1,0,'pending','2022-04-21','07:00:00',0),(4,2,4,2,0,'canceled','2022-04-22','01:00:00',0),(5,2,5,1,0,'approved','2022-04-22','03:00:00',0),(6,3,1,1,0,'rejected','2022-04-22','02:30:00',0),(7,4,2,1,0,'canceled','2022-04-23','16:00:00',0),(8,4,5,1,0,'approved','2022-04-25','11:00:00',0),(9,5,5,2,0,'pending','2022-04-20','02:00:00',0),(10,5,1,1,0,'approved','2022-04-25','12:00:00',0),(11,5,2,1,0,'Pending','2022-04-29','09:00:00',0);
/*!40000 ALTER TABLE `APPOINTMENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DOCTOR`
--

DROP TABLE IF EXISTS `DOCTOR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DOCTOR` (
  `Doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `Office_id` int(11) DEFAULT NULL,
  `Speciality` varchar(30) DEFAULT NULL,
  `Name` varchar(20) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone_number` char(10) DEFAULT NULL,
  PRIMARY KEY (`Doctor_id`),
  UNIQUE KEY `Phone_number` (`Phone_number`),
  KEY `Office_id` (`Office_id`),
  CONSTRAINT `DOCTOR_ibfk_1` FOREIGN KEY (`Office_id`) REFERENCES `OFFICE` (`Office_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DOCTOR`
--

LOCK TABLES `DOCTOR` WRITE;
/*!40000 ALTER TABLE `DOCTOR` DISABLE KEYS */;
INSERT INTO `DOCTOR` VALUES (1,1,NULL,'Greg','Password','708931280'),(2,1,NULL,'Doctor','Password','9834553805'),(3,2,NULL,'Samual','Password','8737868610'),(4,1,'Anesthesiology','Lucy','Password','6167134561'),(5,1,'Anesthesiology','Faye','Password','5182329656'),(6,1,'Anesthesiology','Jesus','Password','5334299670'),(7,2,'Anesthesiology','Darrin','Password','2669082899'),(8,2,'Anesthesiology','Debra','Password','1720352865'),(9,2,'Anesthesiology','Geraldine','Password','97366468'),(10,2,'Anesthesiology','Cody','Password','3390998394'),(11,3,'Anesthesiology','Carolyn','Password','6032973490'),(12,1,'Eye Doctor','Nettie','Password','2603591341'),(13,2,'Eye Doctor','Ian','Password','4469566959'),(14,3,'Eye Doctor','Malcolm','Password','4659913080'),(15,2,'Orthodontist','Kanet','Password','2935098364'),(16,2,'Orthodontist','Lynne','Password','1795469519'),(17,1,'Dermatologist','Raymond','Password','5009979186'),(18,2,'Dermatologist','Taylor','Password','1719474661'),(19,2,'Gynecologist','Jodi','Password','4935152982'),(20,2,'Cardiologist','Garret','Password','2601269476'),(21,1,'Oncology','Randolph','Password','5317207202'),(22,2,'Oncology','Elbert','Password','724180264'),(23,2,'Oncology','Preston','Password','1066260096'),(24,3,'Oncology','Lynn','Password','2589763169'),(25,1,'Gastroenterologist','Claudia','Password','1832256952');
/*!40000 ALTER TABLE `DOCTOR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OFFICE`
--

DROP TABLE IF EXISTS `OFFICE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OFFICE` (
  `Office_id` int(11) NOT NULL AUTO_INCREMENT,
  `Address` varchar(30) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `State` varchar(15) DEFAULT NULL,
  `Phone_number` char(10) DEFAULT NULL,
  `Open_time` time NOT NULL,
  `Close_time` time NOT NULL,
  PRIMARY KEY (`Office_id`),
  UNIQUE KEY `Phone_number` (`Phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OFFICE`
--

LOCK TABLES `OFFICE` WRITE;
/*!40000 ALTER TABLE `OFFICE` DISABLE KEYS */;
INSERT INTO `OFFICE` VALUES (1,'123 Main st.','Houston','Texas','3867295732','09:00:00','17:00:00'),(2,'456 UH st.','Houston','Texas','1025968745','09:00:00','17:00:00'),(3,'423 UH Avenue.','Austin','Texas','4658972048','09:00:00','17:00:00');
/*!40000 ALTER TABLE `OFFICE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PATIENT`
--

DROP TABLE IF EXISTS `PATIENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PATIENT` (
  `Patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `Primary_physician_id` int(11) DEFAULT NULL,
  `Specialist_approved` tinyint(1) DEFAULT NULL,
  `Specialist_check` varchar(8) NOT NULL DEFAULT 'NA',
  `Name` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Phone_number` char(10) NOT NULL,
  `Email` varchar(254) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Medical_allergy` tinyint(1) NOT NULL DEFAULT '0',
  `Medical_Al_Description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Patient_id`),
  UNIQUE KEY `Phone_number` (`Phone_number`),
  UNIQUE KEY `Email` (`Email`),
  KEY `Primary_physician_id` (`Primary_physician_id`),
  CONSTRAINT `PATIENT_ibfk_1` FOREIGN KEY (`Primary_physician_id`) REFERENCES `DOCTOR` (`Doctor_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PATIENT`
--

LOCK TABLES `PATIENT` WRITE;
/*!40000 ALTER TABLE `PATIENT` DISABLE KEYS */;
INSERT INTO `PATIENT` VALUES (1,1,0,'NA','Wade','password','2222222222','Wade@gmail.com',5,1,NULL),(2,2,0,'NA','Loren','password','3333333333','Loren@yahoo.com',10,1,NULL),(3,3,0,'NA','Elsa','password','4444444444','Elsa@hotmail.com',20,0,NULL),(4,4,0,'NA','Richard','password','5555555555','Richard@yahoo.com',50,1,NULL),(5,5,0,'NA','Patient','Password','6666666666','Patient@medical.com',100,0,NULL),(6,1,0,'NA','Andy','password','9999999999','Andy@gmail.com',36,1,NULL);
/*!40000 ALTER TABLE `PATIENT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRESCRIPTION`
--

DROP TABLE IF EXISTS `PRESCRIPTION`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRESCRIPTION` (
  `Patient_id` int(11) NOT NULL,
  `Medication` varchar(64) NOT NULL,
  `Test` varchar(64) DEFAULT NULL,
  `Prescription_date` date NOT NULL,
  PRIMARY KEY (`Patient_id`,`Medication`,`Prescription_date`),
  CONSTRAINT `PRESCRIPTION_ibfk_1` FOREIGN KEY (`Patient_id`) REFERENCES `PATIENT` (`Patient_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRESCRIPTION`
--

LOCK TABLES `PRESCRIPTION` WRITE;
/*!40000 ALTER TABLE `PRESCRIPTION` DISABLE KEYS */;
INSERT INTO `PRESCRIPTION` VALUES (2,'Medication string','Test string','2020-01-01'),(2,'Medication string','Test string','2020-01-02'),(2,'Medication string','Test string','2020-01-03'),(2,'Medication string','Test string','2020-01-04'),(2,'Medication string','Test string','2020-01-05');
/*!40000 ALTER TABLE `PRESCRIPTION` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `WORK_INFO`
--

DROP TABLE IF EXISTS `WORK_INFO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `WORK_INFO` (
  `Doctor_id` int(11) NOT NULL,
  `Office_id` int(11) NOT NULL,
  `Weekday` varchar(10) NOT NULL,
  `Start_time` time NOT NULL,
  `End_time` time NOT NULL,
  PRIMARY KEY (`Doctor_id`,`Weekday`),
  CONSTRAINT `WORK_INFO_ibfk_1` FOREIGN KEY (`Doctor_id`) REFERENCES `DOCTOR` (`Doctor_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `WORK_INFO`
--

LOCK TABLES `WORK_INFO` WRITE;
/*!40000 ALTER TABLE `WORK_INFO` DISABLE KEYS */;
INSERT INTO `WORK_INFO` VALUES (5,2,'Friday','09:00:00','15:00:00'),(5,1,'Monday','09:00:00','15:00:00'),(5,2,'Thursday','07:00:00','12:00:00'),(5,1,'Tuesday','10:00:00','14:00:00'),(5,1,'Wednesday','12:00:00','18:00:00');
/*!40000 ALTER TABLE `WORK_INFO` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-25  3:02:23
