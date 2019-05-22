-- MySQL dump 10.16  Distrib 10.1.37-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: atributos
-- ------------------------------------------------------
-- Server version	10.1.37-MariaDB

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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'canelita','canelita','asd','Sistemas','1',1),(2,'aaaa','aaaa','aaaa','aaa','aaaa',1);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `Num_Control` varchar(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Ap_P` varchar(100) NOT NULL,
  `Ap_M` varchar(100) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`Num_Control`),
  KEY `fk_alum_carrera` (`id_carrera`),
  CONSTRAINT `fk_alum_carrera` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES ('15120315','Jorge','Oviedo','Aguilar',1,1,1),('15120318','Jorge','Oviedo','Aguilar',1,1,1),('15120615','Jorge','Oviedo','Aguilar',1,1,1),('15120715','Jorge','Oviedo','Aguilar',1,1,1);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asig_evaluacion`
--

DROP TABLE IF EXISTS `asig_evaluacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asig_evaluacion` (
  `id_evaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evaluacion`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asig_evaluacion`
--

LOCK TABLES `asig_evaluacion` WRITE;
/*!40000 ALTER TABLE `asig_evaluacion` DISABLE KEYS */;
INSERT INTO `asig_evaluacion` VALUES (2,'Individual',2,7,3),(4,'Grupal',2,-1,3),(5,'Individual',2,7,3),(6,'Individual',2,7,3),(8,'Grupal',2,-1,2),(9,'Individual',2,-1,2),(10,'Grupal',2,-1,2),(11,'Grupal',1,-1,1);
/*!40000 ALTER TABLE `asig_evaluacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atributo`
--

DROP TABLE IF EXISTS `atributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `atributo` (
  `id_atributo_pk` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_atributo_pk`),
  KEY `fk_carrera_at` (`id_carrera`),
  CONSTRAINT `fk_carrera_at` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atributo`
--

LOCK TABLES `atributo` WRITE;
/*!40000 ALTER TABLE `atributo` DISABLE KEYS */;
INSERT INTO `atributo` VALUES (2,'Atributo abc','Este es el atributo ',1,0),(3,'Aprendizaje visual','Aprendizaje por medio de imagenes sss',1,0),(4,'Atributo 3','Atributo 3',2,1),(5,'AT 2','asjdjkasdnkj',1,1),(6,'AT 6','ASMJ,DNAJKSND',1,1),(7,'AT 9','AJNSDJKANS',1,1),(8,'AT 1','asnjcdkaujsn',2,1),(9,'asndkjans','asdnasdjkn',4,1);
/*!40000 ALTER TABLE `atributo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `atributo_log`
--

DROP TABLE IF EXISTS `atributo_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atributo_log`
--

LOCK TABLES `atributo_log` WRITE;
/*!40000 ALTER TABLE `atributo_log` DISABLE KEYS */;
INSERT INTO `atributo_log` VALUES (NULL,'Atributo a',NULL,'Este es el atributo a',NULL,1,NULL,1,NULL,0,'2019-03-04 22:54:02','root@localhost'),('Atributo a','Atributo c','Este es el atributo a','Atributo modificado',1,1,1,1,1,1,'2019-03-04 23:03:51','root@localhost'),('Atributo c',NULL,'Atributo modificado',NULL,1,NULL,1,NULL,1,NULL,'2019-03-04 23:08:10','root@localhost'),(NULL,'Atributo a',NULL,'Este es el atributo a',NULL,1,NULL,1,NULL,0,'2019-03-04 23:17:40','root@localhost'),(NULL,'Aprendizaje visual',NULL,'Aprendizaje por medio de imagenes',NULL,1,NULL,1,NULL,NULL,'2019-03-12 06:17:41','root@localhost'),(NULL,'Atributo 3',NULL,'Atributo 3',NULL,1,NULL,2,NULL,NULL,'2019-04-04 05:56:43','root@localhost');
/*!40000 ALTER TABLE `atributo_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calificaciones` (
  `id_cal` int(11) NOT NULL AUTO_INCREMENT,
  `id_criterio` int(11) NOT NULL,
  `numControl` varchar(8) NOT NULL,
  `calificacion` int(11) NOT NULL,
  PRIMARY KEY (`id_cal`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calificaciones`
--

LOCK TABLES `calificaciones` WRITE;
/*!40000 ALTER TABLE `calificaciones` DISABLE KEYS */;
INSERT INTO `calificaciones` VALUES (1,2,'15120318',100),(2,3,'15120318',100),(3,4,'15120318',100),(4,5,'15120318',70),(5,2,'15120315',80),(6,3,'15120315',60),(7,4,'15120315',90),(8,5,'15120315',70),(9,2,'15120318',90),(10,2,'15120318',80),(11,3,'15120318',80),(12,4,'15120318',90),(13,5,'15120318',90),(14,18,'15120315',70),(15,18,'15120318',90),(16,18,'15120318',60),(17,18,'15120318',80),(18,18,'15120318',100),(19,18,'15120318',100),(20,18,'15120318',100),(21,18,'15120318',100),(22,18,'15120318',100),(23,18,'15120318',100),(24,18,'15120318',100),(25,18,'15120318',100),(26,18,'15120318',100),(27,18,'15120318',100),(28,18,'15120318',100),(29,18,'15120318',100),(30,18,'15120318',100);
/*!40000 ALTER TABLE `calificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `id_carrera` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `id_depto` int(11) DEFAULT NULL,
  `Estado` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_carrera`),
  KEY `fk_carr_dep` (`id_depto`),
  CONSTRAINT `fk_carr_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` VALUES (1,'Sistemas',1,1),(2,'Industrial',1,1),(3,'AdministraciÃ³n',1,1),(4,'IGE',1,1);
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterio_ev`
--

DROP TABLE IF EXISTS `criterio_ev`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `criterio_ev` (
  `id_criterio` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `Descripcion` text NOT NULL,
  `id_atributo` int(11) DEFAULT NULL,
  `Estado` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_criterio`),
  KEY `fk_at_criterio` (`id_atributo`),
  CONSTRAINT `fk_at_criterio` FOREIGN KEY (`id_atributo`) REFERENCES `atributo` (`id_atributo_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterio_ev`
--

LOCK TABLES `criterio_ev` WRITE;
/*!40000 ALTER TABLE `criterio_ev` DISABLE KEYS */;
INSERT INTO `criterio_ev` VALUES (2,'Trabajo en equipo','123456789123456',2,0),(3,'Atributo industrial r','Segundo atributo',3,1),(4,'Atributo industrial','Tercer atributo',4,1),(5,'Atributo industrial','Segundo atributo',2,1),(16,'L','ASHJBJHASD',2,1),(17,'L','ASHJBJHASD',2,1),(18,'nsadkjnasd','asdasdasd',9,1);
/*!40000 ALTER TABLE `criterio_ev` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterio_ev_log`
--

DROP TABLE IF EXISTS `criterio_ev_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterio_ev_log`
--

LOCK TABLES `criterio_ev_log` WRITE;
/*!40000 ALTER TABLE `criterio_ev_log` DISABLE KEYS */;
INSERT INTO `criterio_ev_log` VALUES (NULL,0,NULL,'Criterio a',NULL,'Este es el criterio a',NULL,100,NULL,2,'2019-03-04 23:34:10','root@localhost'),(2,2,'Criterio a','Criterio modificado','Este es el criterio a','Este es el criterio a',100,70,2,2,'2019-03-04 23:40:31','root@localhost'),(NULL,NULL,NULL,'Atributo industrial',NULL,'Segundo atributo',NULL,80,NULL,3,'2019-04-04 05:49:23','root@localhost'),(NULL,NULL,NULL,'Atributo industrial',NULL,'Tercer atributo',NULL,90,NULL,4,'2019-04-04 05:57:40','root@localhost'),(NULL,NULL,NULL,'Atributo industrial',NULL,'Segundo atributo',NULL,80,NULL,2,'2019-04-04 06:10:46','root@localhost');
/*!40000 ALTER TABLE `criterio_ev_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamento`
--

DROP TABLE IF EXISTS `departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamento` (
  `id_depto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(200) NOT NULL,
  `Logo` text,
  `Estado` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_depto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamento`
--

LOCK TABLES `departamento` WRITE;
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` VALUES (1,'Industrial','escudo.png',0),(2,'Industrial 2','escudo.png',1),(3,'AdministraciÃ³n','escudo.png',1),(4,'AdministraciÃ³n 2','escudo.png',1),(5,'AdministraciÃ³n 2','logos.png',1),(6,'Sistemas','logos.png',0),(7,'Sistemas','logos.png',0),(8,'Sistemas','logos.png',0),(9,'Sistemas','logos.png',1),(10,'Mecanica','logos.png',1);
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidad`
--

DROP TABLE IF EXISTS `especialidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidad` (
  `id_esp` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `id_depto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_esp`),
  KEY `fk_esp_dep` (`id_depto`),
  CONSTRAINT `fk_esp_dep` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
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
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `espelegida` (
  `Num_Control` varchar(10) NOT NULL,
  `id_esp` int(11) DEFAULT NULL,
  KEY `fk_esp_elegida` (`Num_Control`),
  KEY `fk_esp_elegida_esp` (`id_esp`),
  CONSTRAINT `fk_esp_elegida` FOREIGN KEY (`Num_Control`) REFERENCES `alumno` (`Num_Control`),
  CONSTRAINT `fk_esp_elegida_esp` FOREIGN KEY (`id_esp`) REFERENCES `especialidad` (`id_esp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `espelegida`
--

LOCK TABLES `espelegida` WRITE;
/*!40000 ALTER TABLE `espelegida` DISABLE KEYS */;
/*!40000 ALTER TABLE `espelegida` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_alumno`
--

DROP TABLE IF EXISTS `grupo_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_alumno` (
  `Id_grupo` int(11) NOT NULL,
  `Id_alumno` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_alumno`
--

LOCK TABLES `grupo_alumno` WRITE;
/*!40000 ALTER TABLE `grupo_alumno` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo_trabajo`
--

DROP TABLE IF EXISTS `grupo_trabajo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo_trabajo` (
  `Id_grupo` int(11) NOT NULL,
  `Nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Id_carrera` int(11) NOT NULL,
  `Id_materia` int(11) NOT NULL,
  `Id_profesor` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo_trabajo`
--

LOCK TABLES `grupo_trabajo` WRITE;
/*!40000 ALTER TABLE `grupo_trabajo` DISABLE KEYS */;
INSERT INTO `grupo_trabajo` VALUES (1,'aa',1,1,1,1),(2,'aa',1,1,1,1),(3,'aa',1,1,1,1),(4,'aa',1,1,1,1),(5,'aa',1,1,1,1),(6,'platanitos',1,1,1,1),(7,'aaaaaaaaaaaaaaaaaaaaaaaaaaa',1,1,1,1),(8,'yo',1,1,1,1);
/*!40000 ALTER TABLE `grupo_trabajo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ind_gpal`
--

DROP TABLE IF EXISTS `ind_gpal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ind_gpal` (
  `id_criterio` int(11) DEFAULT NULL,
  `P_Ind` int(11) NOT NULL,
  `P_Gpal` int(11) NOT NULL,
  `tipo` enum('Individual','grupal','individual/grupal') DEFAULT NULL,
  KEY `fk_ct_eval` (`id_criterio`),
  CONSTRAINT `fk_ct_eval` FOREIGN KEY (`id_criterio`) REFERENCES `criterio_ev` (`id_criterio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ind_gpal`
--

LOCK TABLES `ind_gpal` WRITE;
/*!40000 ALTER TABLE `ind_gpal` DISABLE KEYS */;
INSERT INTO `ind_gpal` VALUES (2,100,0,'Individual'),(3,100,0,'Individual'),(4,0,100,'grupal'),(5,0,100,'grupal'),(16,60,40,'individual/grupal'),(17,100,0,'Individual'),(18,50,50,'individual/grupal');
/*!40000 ALTER TABLE `ind_gpal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` text NOT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `semestre` enum('1','2','3','4','5','6','7','8','9') DEFAULT '1',
  PRIMARY KEY (`id_materia`),
  KEY `fk_mat_carr` (`id_carrera`),
  CONSTRAINT `fk_mat_carr` FOREIGN KEY (`id_carrera`) REFERENCES `carrera` (`id_carrera`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES (1,'MatemÃ¡ticas',1,0,'4'),(2,'Fisica',2,1,'1'),(3,'Quimica',2,1,'5');
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_atributos`
--

DROP TABLE IF EXISTS `materia_atributos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_atributos` (
  `Id_materia` int(11) NOT NULL,
  `Id_atributo` int(11) NOT NULL,
  `Id_carrera` int(11) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_atributos`
--

LOCK TABLES `materia_atributos` WRITE;
/*!40000 ALTER TABLE `materia_atributos` DISABLE KEYS */;
INSERT INTO `materia_atributos` VALUES (1,5,1,0),(1,6,1,0),(1,6,2,1),(1,7,1,1),(2,4,2,1),(2,8,2,1),(3,5,1,1),(3,7,1,1),(4,7,1,1),(2,4,2,1);
/*!40000 ALTER TABLE `materia_atributos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias_cursando`
--

DROP TABLE IF EXISTS `materias_cursando`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias_cursando` (
  `id_mat` int(11) NOT NULL AUTO_INCREMENT,
  `Num_Control` varchar(10) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL,
  `id_prof` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mat`),
  KEY `fk_mat_cur_alum` (`id_materia`),
  KEY `fk_alum_cur` (`Num_Control`),
  KEY `fk_prof_mat_cur` (`id_prof`),
  CONSTRAINT `fk_alum_cur` FOREIGN KEY (`Num_Control`) REFERENCES `alumno` (`Num_Control`),
  CONSTRAINT `fk_mat_cur_alum` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id_materia`),
  CONSTRAINT `fk_prof_mat_cur` FOREIGN KEY (`id_prof`) REFERENCES `profesores` (`idprofesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_cursando`
--

LOCK TABLES `materias_cursando` WRITE;
/*!40000 ALTER TABLE `materias_cursando` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias_cursando` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias_cursando_log`
--

DROP TABLE IF EXISTS `materias_cursando_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_cursando_log`
--

LOCK TABLES `materias_cursando_log` WRITE;
/*!40000 ALTER TABLE `materias_cursando_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias_cursando_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias_profesor`
--

DROP TABLE IF EXISTS `materias_profesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materias_profesor` (
  `id_mp` int(11) NOT NULL AUTO_INCREMENT,
  `id_materia` int(11) DEFAULT NULL,
  `idprofesor` int(11) DEFAULT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mp`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_profesor`
--

LOCK TABLES `materias_profesor` WRITE;
/*!40000 ALTER TABLE `materias_profesor` DISABLE KEYS */;
INSERT INTO `materias_profesor` VALUES (1,1,4,2),(2,1,5,2),(3,1,7,2),(4,3,7,2);
/*!40000 ALTER TABLE `materias_profesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesores`
--

DROP TABLE IF EXISTS `profesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesores` (
  `idprofesor` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `pass` text NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  `e_mail` varchar(100) NOT NULL,
  PRIMARY KEY (`idprofesor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesores`
--

LOCK TABLES `profesores` WRITE;
/*!40000 ALTER TABLE `profesores` DISABLE KEYS */;
INSERT INTO `profesores` VALUES (1,'jorge','123456','Jorge Luis Oviedo',1,'jorge@h.com'),(2,'Mau','123456','Mauricio Ricardo Melchor',1,'Mau@h.com'),(3,'Migue','123456','Miguel Angel',0,'Migue@h.com'),(4,'Dani','123456','Luis Daniel',1,'Dani@h.com'),(5,'Nathaly','123456','Nathaly',0,'Nathaly@h.com'),(6,'Monserrat Rodriguez Lopez','monse','Monserrat Rodriguez Lopez',1,'monse@outlook.com'),(7,'Carmen','123456','Carmen Salinas',1,'carmen@gmail.com');
/*!40000 ALTER TABLE `profesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `responsable` (
  `id_responsable` int(11) NOT NULL AUTO_INCREMENT,
  `id_profesor` int(11) DEFAULT NULL,
  `pass` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `id_depto` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_responsable`),
  KEY `fk_responsable` (`id_profesor`),
  KEY `fk_depto_responsable` (`id_depto`),
  CONSTRAINT `fk_depto_responsable` FOREIGN KEY (`id_depto`) REFERENCES `departamento` (`id_depto`),
  CONSTRAINT `fk_responsable` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`idprofesor`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responsable`
--

LOCK TABLES `responsable` WRITE;
/*!40000 ALTER TABLE `responsable` DISABLE KEYS */;
INSERT INTO `responsable` VALUES (1,2,'MauS','mauA',1,1),(2,1,'Jorge','jorge',1,1),(3,6,'Monse','monse',1,1),(4,4,'Monse','monse',1,0);
/*!40000 ALTER TABLE `responsable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-15 20:44:23
