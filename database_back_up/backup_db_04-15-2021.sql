-- MariaDB dump 10.17  Distrib 10.4.10-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: clinic_db
-- ------------------------------------------------------
-- Server version	10.4.10-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `clinic_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `clinic_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `clinic_db`;

--
-- Table structure for table `tbl_access_category`
--

DROP TABLE IF EXISTS `tbl_access_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_access_category` (
  `record_id` int(100) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_access_category`
--

LOCK TABLES `tbl_access_category` WRITE;
/*!40000 ALTER TABLE `tbl_access_category` DISABLE KEYS */;
INSERT INTO `tbl_access_category` VALUES (1,'Sidebar','Side Bar',1),(2,'Navbar','Navigation Bar',1),(3,'Access Rights','Manage Access Rights',1);
/*!40000 ALTER TABLE `tbl_access_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_access_code`
--

DROP TABLE IF EXISTS `tbl_access_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_access_code` (
  `record_id` int(100) NOT NULL AUTO_INCREMENT,
  `category_id` int(100) NOT NULL,
  `access_code` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_access_code`
--

LOCK TABLES `tbl_access_code` WRITE;
/*!40000 ALTER TABLE `tbl_access_code` DISABLE KEYS */;
INSERT INTO `tbl_access_code` VALUES (1,1,'dashboard','Dashboard',1),(2,1,'transactions','Transactions',1),(3,1,'certification','Certification',1),(4,1,'reports','Reports',1),(5,1,'reprequest','Request Report',1),(6,1,'maintenance','Maintenance',1),(7,1,'roles','Access Roles',1),(8,1,'accounts','User Accounts',1),(9,1,'settings','Settings',1),(10,1,'galleries','Manage Galleries',1),(11,1,'services','Manage Services',1),(12,3,'viewmanageaccessrights','View Manage Access Rights',1);
/*!40000 ALTER TABLE `tbl_access_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_access_rights`
--

DROP TABLE IF EXISTS `tbl_access_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_access_rights` (
  `record_id` int(100) NOT NULL AUTO_INCREMENT,
  `role_id` int(100) NOT NULL,
  `access_code_id` int(100) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_access_rights`
--

LOCK TABLES `tbl_access_rights` WRITE;
/*!40000 ALTER TABLE `tbl_access_rights` DISABLE KEYS */;
INSERT INTO `tbl_access_rights` VALUES (1,1,1,1),(2,1,2,1),(3,1,3,1),(4,1,4,1),(5,1,5,1),(6,1,6,1),(7,1,7,1),(8,1,8,1),(9,1,9,1),(10,1,10,1),(11,1,11,1),(12,1,12,1);
/*!40000 ALTER TABLE `tbl_access_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_access_roles`
--

DROP TABLE IF EXISTS `tbl_access_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_access_roles` (
  `record_id` int(5) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_access_roles`
--

LOCK TABLES `tbl_access_roles` WRITE;
/*!40000 ALTER TABLE `tbl_access_roles` DISABLE KEYS */;
INSERT INTO `tbl_access_roles` VALUES (1,'Administrator','System Administrator',1);
/*!40000 ALTER TABLE `tbl_access_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_certification_request`
--

DROP TABLE IF EXISTS `tbl_certification_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_certification_request` (
  `record_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) NOT NULL,
  `extension` varchar(10) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact_number` varchar(13) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `pickup_date` date DEFAULT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_certification_request`
--

LOCK TABLES `tbl_certification_request` WRITE;
/*!40000 ALTER TABLE `tbl_certification_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_certification_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_findings`
--

DROP TABLE IF EXISTS `tbl_findings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_findings` (
  `record_id` int(10) NOT NULL AUTO_INCREMENT,
  `request_id` int(10) NOT NULL,
  `finding` varchar(500) NOT NULL,
  `added_by` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_findings`
--

LOCK TABLES `tbl_findings` WRITE;
/*!40000 ALTER TABLE `tbl_findings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_findings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_notes`
--

DROP TABLE IF EXISTS `tbl_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_notes` (
  `record_id` int(10) NOT NULL AUTO_INCREMENT,
  `request_id` int(10) NOT NULL,
  `note` varchar(500) NOT NULL,
  `added_by` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_notes`
--

LOCK TABLES `tbl_notes` WRITE;
/*!40000 ALTER TABLE `tbl_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sys_settings`
--

DROP TABLE IF EXISTS `tbl_sys_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sys_settings` (
  `record_id` int(10) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(50) NOT NULL,
  `setting_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sys_settings`
--

LOCK TABLES `tbl_sys_settings` WRITE;
/*!40000 ALTER TABLE `tbl_sys_settings` DISABLE KEYS */;
INSERT INTO `tbl_sys_settings` VALUES (1,'System Name','Sure Care Medical Clinic Online'),(2,'Title','Official Site of Sure Care Medical Clinic'),(3,'Business Name','Sure Care Medical Clinic & Pharmacy'),(4,'Business Address','Poblacion, Trinidad, Bohol'),(5,'E-mail Address','surecaremedicalclinic@yahoo.com'),(6,'Contact Number','(+63) 927 - 9851465'),(7,'Clinic Doctor','Dr. Elmer Boncales Nuez'),(8,'License Number','01252039'),(9,'PTR','5623239'),(10,'System Logo','public/image/apple-touch-icon.png');
/*!40000 ALTER TABLE `tbl_sys_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `record_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(1) DEFAULT NULL,
  `role_type` int(5) NOT NULL,
  `created_by` int(5) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` VALUES (1,'clark.villamor','e10adc3949ba59abbe56e057f20f883e','Clark Kevin','Valmoria','Villamor','',1,1,'2020-04-02 00:00:00',1,'2021-02-28 08:29:20',1),(2,'super.user','3b09ed529e66a3ebda836b1ffc1f6eab','Super','','User','',1,1,'2021-04-03 12:12:33',NULL,NULL,1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-15 10:26:32
