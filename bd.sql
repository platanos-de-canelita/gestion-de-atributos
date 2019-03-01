CREATE DATABASE  IF NOT EXISTS `certificacion_industrial` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `certificacion_industrial`;
-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: certificacion_industrial
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `administrador` (
  `id_admin_pk` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `pass` text NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Ap_P` varchar(50) NOT NULL,
  `Ap_M` varchar(50) DEFAULT NULL,
  `id_depto_fk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_admin_pk`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `fk_depto` (`id_depto_fk`),
  CONSTRAINT `fk_depto` FOREIGN KEY (`id_depto_fk`) REFERENCES `departamento` (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `alumno` (
  `Num_Control` varchar(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ap_P` varchar(100) NOT NULL,
  `Ap_M` varchar(100) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Num_Control`),
  KEY `fk_alum_carrera` (`id_carrera`),
  CONSTRAINT `fk_alum_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atributo`
--

DROP TABLE IF EXISTS `atributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `atributo` (
  `id_atributo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `Admin_id` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_atributo_pk`),
  KEY `fk_at_admin` (`Admin_id`),
  KEY `fk_carrera_at` (`id_carrera`),
  CONSTRAINT `fk_at_admin` FOREIGN KEY (`Admin_id`) REFERENCES `administrador` (`id_admin_pk`),
  CONSTRAINT `fk_carrera_at` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atributo`
--

LOCK TABLES `atributo` WRITE;
/*!40000 ALTER TABLE `atributo` DISABLE KEYS */;
/*!40000 ALTER TABLE `atributo` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `atributo_trigger_insert` BEFORE INSERT ON `atributo` FOR EACH ROW begin

	insert into atributo_log values(null, NEW.Nombre, null, New.Descripcion,
    null, NEW.Admin_id, null, new.id_carrera, null, 
    new.id_atributo_pk, now(), current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `atributo_trigger_update` BEFORE UPDATE ON `atributo` FOR EACH ROW begin

	insert into atributo_log values(OLD.Nombre, NEW.Nombre, OLD.Descripcion, New.Descripcion,
    OLD.Admin_id, NEW.Admin_id, OLD.id_carrera, new.id_carrera, old.id_atributo_pk, 
    new.id_atributo_pk, now(), current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `atributo_trigger_delete` BEFORE DELETE ON `atributo` FOR EACH ROW begin

	insert into atributo_log values(OLD.Nombre, null, OLD.Descripcion, null,
    OLD.Admin_id, null, OLD.id_carrera, null, old.id_atributo_pk, 
    null, now(), current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `atributo_log`
--

DROP TABLE IF EXISTS `atributo_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `atributo_log` (
  `Nombre_ant` text,
  `Nombre_nvo` text,
  `Descripcion_ant` text,
  `Descripcion_nvo` text,
  `Admin_id_ant` int(11) DEFAULT NULL,
  `Admin_id_nvo` int(11) DEFAULT NULL,
  `id_carrera_ant` int(11) DEFAULT NULL,
  `id_carrera_nvo` int(11) DEFAULT NULL,
  `id_atributo_ant` int(11) DEFAULT NULL,
  `id_atributo_nvo` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `usuario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atributo_log`
--

LOCK TABLES `atributo_log` WRITE;
/*!40000 ALTER TABLE `atributo_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `atributo_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `id_depto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_carrera`),
  KEY `fk_carr_dep` (`id_depto`),
  CONSTRAINT `fk_carr_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterio_ev`
--

DROP TABLE IF EXISTS `criterio_ev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `criterio_ev` (
  `id_criterio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `ponderacion` int(11) NOT NULL,
  `id_atributo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_criterio`),
  KEY `fk_at_criterio` (`id_atributo`),
  CONSTRAINT `fk_at_criterio` FOREIGN KEY (`id_atributo`) REFERENCES `atributo` (`id_atributo_pk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterio_ev`
--

LOCK TABLES `criterio_ev` WRITE;
/*!40000 ALTER TABLE `criterio_ev` DISABLE KEYS */;
/*!40000 ALTER TABLE `criterio_ev` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `criterio_trigger_insert` BEFORE INSERT ON `criterio_ev` FOR EACH ROW begin

	insert into criterio_ev_log values(null, new.id_criterio, null, new.Nombre,
     null, new.Descripcion, null, new.ponderacion, null, new.id_atributo, now(), 
     current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `criterio_trigger_update` BEFORE UPDATE ON `criterio_ev` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_criterio, new.id_criterio, old.Nombre, new.Nombre,
     old.Descripcion, new.Descripcion, old.ponderacion, new.ponderacion, old.id_atributo, new.id_atributo, now(), 
     current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `criterio_trigger_delete` BEFORE DELETE ON `criterio_ev` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_criterio, null, old.Nombre, null,
     old.Descripcion, null, old.ponderacion, null, old.id_atributo, null, now(), 
     current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `criterio_ev_log`
--

DROP TABLE IF EXISTS `criterio_ev_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `criterio_ev_log` (
  `id_criterio_ant` int(11) DEFAULT NULL,
  `id_criterio_nvo` int(11) DEFAULT NULL,
  `Nombre_ant` text,
  `Nombre_nvo` text,
  `Descripcion_ant` text,
  `Descripcion_nvo` text,
  `Ponderacion_ant` int(11) DEFAULT NULL,
  `ponderacion_nvo` int(11) DEFAULT NULL,
  `id_atributo_ant` int(11) DEFAULT NULL,
  `id_atributo_nvo` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `usuario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterio_ev_log`
--

LOCK TABLES `criterio_ev_log` WRITE;
/*!40000 ALTER TABLE `criterio_ev_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `criterio_ev_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `departamento` (
  `id_depto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Logo` text,
  PRIMARY KEY (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `especialidad` (
  `id_esp` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `id_depto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_esp`),
  KEY `fk_esp_dep` (`id_depto`),
  CONSTRAINT `fk_esp_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidad`
--

LOCK TABLES `especialidad` WRITE;
/*!40000 ALTER TABLE `especialidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `espelegida`
--

DROP TABLE IF EXISTS `espelegida`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `espelegida` (
  `Num_Control` varchar(10) NOT NULL,
  `id_esp` int(11) DEFAULT NULL,
  KEY `fk_esp_elegida` (`Num_Control`),
  KEY `fk_esp_elegida_esp` (`id_esp`),
  CONSTRAINT `fk_esp_elegida` FOREIGN KEY (`Num_Control`) REFERENCES `alumno` (`num_control`),
  CONSTRAINT `fk_esp_elegida_esp` FOREIGN KEY (`id_esp`) REFERENCES `especialidad` (`id_esp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `espelegida`
--

LOCK TABLES `espelegida` WRITE;
/*!40000 ALTER TABLE `espelegida` DISABLE KEYS */;
/*!40000 ALTER TABLE `espelegida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ind_gpal`
--

DROP TABLE IF EXISTS `ind_gpal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ind_gpal` (
  `id_criterio` int(11) DEFAULT NULL,
  `P_Ind` int(11) NOT NULL,
  `P_Gpal` int(11) NOT NULL,
  KEY `fk_ct_eval` (`id_criterio`),
  CONSTRAINT `fk_ct_eval` FOREIGN KEY (`id_criterio`) REFERENCES `criterio_ev` (`id_criterio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ind_gpal`
--

LOCK TABLES `ind_gpal` WRITE;
/*!40000 ALTER TABLE `ind_gpal` DISABLE KEYS */;
/*!40000 ALTER TABLE `ind_gpal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Status` enum('Habilitada','Deshabilitada') DEFAULT NULL,
  `Semestre` enum('1','2','3','4','5','6','7','8','9') DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `fk_mat_carr` (`id_carrera`),
  CONSTRAINT `fk_mat_carr` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias_cursando`
--

DROP TABLE IF EXISTS `materias_cursando`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `materias_cursando` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `Num_Control` varchar(10) DEFAULT NULL,
  `RFC_prof` varchar(13) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mat`),
  KEY `fk_mat_cur_alum` (`id_materia`),
  KEY `fk_prof_cur_alum` (`RFC_prof`),
  KEY `fk_alum_cur` (`Num_Control`),
  CONSTRAINT `fk_alum_cur` FOREIGN KEY (`Num_Control`) REFERENCES `alumno` (`num_control`),
  CONSTRAINT `fk_mat_cur_alum` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `fk_prof_cur_alum` FOREIGN KEY (`RFC_prof`) REFERENCES `profesor` (`rfc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_cursando`
--

LOCK TABLES `materias_cursando` WRITE;
/*!40000 ALTER TABLE `materias_cursando` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias_cursando` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `materia_cursando_trigger_insert` BEFORE INSERT ON `materias_cursando` FOR EACH ROW begin

	insert into criterio_ev_log values(null, new.id_mat, null, new.Num_Control,
     null, new.RFC_prof, null, new.id_materia, now(), 
     current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `materia_cursando_trigger_update` BEFORE UPDATE ON `materias_cursando` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_mat, new.id_mat, old.Num_Control, new.Num_Control,
     old.RFC_prof, new.RFC_prof, old.id_materia, new.id_materia, now(), 
     current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `materia_cursando_trigger_delete` BEFORE DELETE ON `materias_cursando` FOR EACH ROW begin

	insert into criterio_ev_log values(old.id_mat, null, old.Num_Control, null,
     old.RFC_prof, null, old.id_materia, null, now(), 
     current_user());
    
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `materias_cursando_log`
--

DROP TABLE IF EXISTS `materias_cursando_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `materias_cursando_log` (
  `id_mat_ant` int(11) DEFAULT NULL,
  `id_mat_nvo` int(11) DEFAULT NULL,
  `Num_Control_ant` varchar(10) DEFAULT NULL,
  `Num_Control_nvo` varchar(10) DEFAULT NULL,
  `RFC_ant` varchar(13) DEFAULT NULL,
  `RFC_nvo` varchar(13) DEFAULT NULL,
  `id_materia_ant` int(11) DEFAULT NULL,
  `id_materia_nvo` int(11) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `usuario` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_cursando_log`
--

LOCK TABLES `materias_cursando_log` WRITE;
/*!40000 ALTER TABLE `materias_cursando_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias_cursando_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesor`
--

DROP TABLE IF EXISTS `profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `profesor` (
  `RFC` varchar(13) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Ap_P` varchar(100) NOT NULL,
  `Ap_M` varchar(100) DEFAULT NULL,
  `Usuario` varchar(250) NOT NULL,
  `pass` text NOT NULL,
  `id_depto` int(11) DEFAULT NULL,
  PRIMARY KEY (`RFC`),
  UNIQUE KEY `Usuario` (`Usuario`),
  KEY `fk_prof_dep` (`id_depto`),
  CONSTRAINT `fk_prof_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesor`
--

LOCK TABLES `profesor` WRITE;
/*!40000 ALTER TABLE `profesor` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-01 10:25:21
