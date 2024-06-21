CREATE DATABASE  IF NOT EXISTS `dbgruporac` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `dbgruporac`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: dbgruporac
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `acce_tbpantallas`
--

DROP TABLE IF EXISTS `acce_tbpantallas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbpantallas` (
  `Ptl_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ptl_Descripcion` varchar(100) DEFAULT NULL,
  `Ptl_Identificador` varchar(100) DEFAULT NULL,
  `Ptl_Creacion` int(11) DEFAULT NULL,
  `Ptl_FechaCreacion` date DEFAULT NULL,
  `Ptl_Modifica` int(11) DEFAULT NULL,
  `Ptl_FechaModificacion` date DEFAULT NULL,
  `Ptl_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Ptl_Id`),
  KEY `FK_Ptl_Creacion` (`Ptl_Creacion`),
  KEY `FK_Ptl_Modifica` (`Ptl_Modifica`),
  CONSTRAINT `FK_Ptl_Creacion` FOREIGN KEY (`Ptl_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_Ptl_Modifica` FOREIGN KEY (`Ptl_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbpantallas`
--

LOCK TABLES `acce_tbpantallas` WRITE;
/*!40000 ALTER TABLE `acce_tbpantallas` DISABLE KEYS */;
INSERT INTO `acce_tbpantallas` VALUES (1,'Usuarios','usuario',1,'0000-00-00',NULL,NULL,_binary ''),(2,'Roles','roles',1,NULL,NULL,NULL,_binary ''),(3,'Dashboards','dashboardsInicio',1,NULL,NULL,NULL,_binary ''),(4,'Compras','comprareporte',1,NULL,NULL,NULL,_binary ''),(5,'Empleados por Ventas','empleadoreporte',1,NULL,NULL,NULL,_binary ''),(6,'Vehiculos por Rangos','vehiculoreporte',1,NULL,NULL,NULL,_binary ''),(7,'Empleados','empleados',1,NULL,NULL,NULL,_binary ''),(8,'Clientes','cliente',1,NULL,NULL,NULL,_binary ''),(9,'Modelos','inventario',1,NULL,NULL,NULL,_binary ''),(10,'Ventas Vehiculos','factura',1,NULL,NULL,NULL,_binary ''),(11,'Compras Vehiculos','compravehiculo',1,NULL,NULL,NULL,_binary ''),(12,'Apartados','apartado',1,NULL,NULL,NULL,_binary '');
/*!40000 ALTER TABLE `acce_tbpantallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acce_tbpantallas_porroles`
--

DROP TABLE IF EXISTS `acce_tbpantallas_porroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbpantallas_porroles` (
  `PaR_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ptl_Id` int(11) DEFAULT NULL,
  `Rol_Id` int(11) DEFAULT NULL,
  `PaR_Creacion` int(11) DEFAULT NULL,
  `PaR_FechaCreacion` datetime DEFAULT NULL,
  `PaR_Modifica` int(11) DEFAULT NULL,
  `PaR_FechaModificacion` datetime DEFAULT NULL,
  `PaR_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`PaR_Id`),
  KEY `FK_PaR_Creacion` (`PaR_Creacion`),
  KEY `FK_PaR_Modifica` (`PaR_Modifica`),
  KEY `FK_tbPantallas_PorRoles_tbPantallas` (`Ptl_Id`),
  KEY `FK_tbPantallas_PorRoles_tbRoles` (`Rol_Id`),
  CONSTRAINT `FK_PaR_Creacion` FOREIGN KEY (`PaR_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_PaR_Modifica` FOREIGN KEY (`PaR_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbPantallas_PorRoles_Roles` FOREIGN KEY (`Rol_Id`) REFERENCES `acce_tbroles` (`Rol_Id`),
  CONSTRAINT `FK_tbPantallas_PorRoles_pantallas` FOREIGN KEY (`Ptl_Id`) REFERENCES `acce_tbpantallas` (`Ptl_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbpantallas_porroles`
--

LOCK TABLES `acce_tbpantallas_porroles` WRITE;
/*!40000 ALTER TABLE `acce_tbpantallas_porroles` DISABLE KEYS */;
INSERT INTO `acce_tbpantallas_porroles` VALUES (1,1,1,1,'0000-00-00 00:00:00',NULL,NULL,_binary ''),(19,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(21,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(22,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(28,8,28,NULL,NULL,NULL,NULL,NULL),(29,11,28,NULL,NULL,NULL,NULL,NULL),(30,7,28,NULL,NULL,NULL,NULL,NULL),(31,8,29,NULL,NULL,NULL,NULL,NULL),(32,4,29,NULL,NULL,NULL,NULL,NULL),(33,8,30,NULL,NULL,NULL,NULL,NULL),(34,11,30,NULL,NULL,NULL,NULL,NULL),(35,8,31,NULL,NULL,NULL,NULL,NULL),(36,11,31,NULL,NULL,NULL,NULL,NULL),(37,8,32,NULL,NULL,NULL,NULL,NULL),(38,4,32,NULL,NULL,NULL,NULL,NULL),(39,8,33,NULL,NULL,NULL,NULL,NULL),(40,11,33,NULL,NULL,NULL,NULL,NULL),(41,8,34,NULL,NULL,NULL,NULL,NULL),(42,11,34,NULL,NULL,NULL,NULL,NULL),(43,8,35,NULL,NULL,NULL,NULL,NULL),(44,8,36,NULL,NULL,NULL,NULL,NULL),(45,4,36,NULL,NULL,NULL,NULL,NULL),(46,8,37,NULL,NULL,NULL,NULL,NULL),(47,4,37,NULL,NULL,NULL,NULL,NULL),(48,3,37,NULL,NULL,NULL,NULL,NULL),(49,5,37,NULL,NULL,NULL,NULL,NULL),(50,1,38,NULL,NULL,NULL,NULL,NULL),(51,3,38,NULL,NULL,NULL,NULL,NULL),(52,1,39,NULL,NULL,NULL,NULL,NULL),(53,3,39,NULL,NULL,NULL,NULL,NULL),(54,8,40,NULL,NULL,NULL,NULL,NULL),(55,2,40,NULL,NULL,NULL,NULL,NULL),(56,8,41,NULL,NULL,NULL,NULL,NULL),(57,2,42,NULL,NULL,NULL,NULL,NULL),(58,8,43,NULL,NULL,NULL,NULL,NULL),(59,11,43,NULL,NULL,NULL,NULL,NULL),(60,9,43,NULL,NULL,NULL,NULL,NULL),(61,3,43,NULL,NULL,NULL,NULL,NULL),(62,7,43,NULL,NULL,NULL,NULL,NULL),(63,9,43,NULL,NULL,NULL,NULL,NULL),(64,9,43,NULL,NULL,NULL,NULL,NULL),(65,1,43,NULL,NULL,NULL,NULL,NULL),(104,6,45,NULL,NULL,NULL,NULL,NULL),(105,7,45,NULL,NULL,NULL,NULL,NULL),(106,8,45,NULL,NULL,NULL,NULL,NULL),(107,9,45,NULL,NULL,NULL,NULL,NULL),(108,10,45,NULL,NULL,NULL,NULL,NULL),(109,11,45,NULL,NULL,NULL,NULL,NULL),(110,2,45,NULL,NULL,NULL,NULL,NULL),(111,8,44,NULL,NULL,NULL,NULL,NULL),(112,11,44,NULL,NULL,NULL,NULL,NULL),(113,2,44,NULL,NULL,NULL,NULL,NULL),(114,1,44,NULL,NULL,NULL,NULL,NULL),(115,9,44,NULL,NULL,NULL,NULL,NULL),(146,8,47,NULL,NULL,NULL,NULL,NULL),(147,11,47,NULL,NULL,NULL,NULL,NULL),(148,4,48,NULL,NULL,NULL,NULL,NULL),(149,11,48,NULL,NULL,NULL,NULL,NULL),(150,7,48,NULL,NULL,NULL,NULL,NULL),(151,9,48,NULL,NULL,NULL,NULL,NULL),(152,1,49,NULL,NULL,NULL,NULL,NULL),(153,6,50,NULL,NULL,NULL,NULL,NULL),(154,10,51,NULL,NULL,NULL,NULL,NULL),(155,3,10,NULL,NULL,NULL,NULL,NULL),(156,5,10,NULL,NULL,NULL,NULL,NULL),(166,8,6,NULL,NULL,NULL,NULL,NULL),(178,12,46,NULL,NULL,NULL,NULL,NULL),(179,4,46,NULL,NULL,NULL,NULL,NULL),(180,3,46,NULL,NULL,NULL,NULL,NULL),(181,7,46,NULL,NULL,NULL,NULL,NULL),(182,9,46,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `acce_tbpantallas_porroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acce_tbroles`
--

DROP TABLE IF EXISTS `acce_tbroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbroles` (
  `Rol_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Rol_Descripcion` varchar(50) DEFAULT NULL,
  `Rol_Creacion` int(11) DEFAULT NULL,
  `Rol_FechaCreacion` datetime DEFAULT NULL,
  `Rol_Modifica` int(11) DEFAULT NULL,
  `Rol_FechaModificacion` datetime DEFAULT NULL,
  `Rol_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Rol_Id`),
  KEY `FK_Rol_Creacion` (`Rol_Creacion`),
  KEY `FK_Rol_Modifica` (`Rol_Modifica`),
  CONSTRAINT `FK_Rol_Creacion` FOREIGN KEY (`Rol_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_Rol_Modifica` FOREIGN KEY (`Rol_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbroles`
--

LOCK TABLES `acce_tbroles` WRITE;
/*!40000 ALTER TABLE `acce_tbroles` DISABLE KEYS */;
INSERT INTO `acce_tbroles` VALUES (1,'Administrador',1,'0000-00-00 00:00:00',NULL,NULL,_binary ''),(2,'Dashboards',1,'2024-06-18 00:00:00',NULL,NULL,_binary '\0'),(3,'hola',1,'2024-06-19 03:57:26',NULL,NULL,NULL),(4,'que',1,'2024-06-19 03:57:38',NULL,NULL,NULL),(5,'lola',1,'2024-06-19 03:59:57',NULL,NULL,_binary '\0'),(6,'pepe',1,'2024-06-19 04:04:52',NULL,NULL,_binary ''),(7,'lema',1,'2024-06-19 04:06:34',NULL,NULL,_binary '\0'),(8,'sopa',1,'2024-06-19 04:30:29',NULL,NULL,_binary '\0'),(9,'sopa',1,'2024-06-19 04:40:29',NULL,NULL,_binary '\0'),(10,'tamal',1,'2024-06-19 04:40:58',NULL,NULL,_binary ''),(11,'ll',1,'2024-06-19 04:42:23',NULL,NULL,_binary '\0'),(12,'yordin',1,'2024-06-19 04:44:38',NULL,NULL,_binary '\0'),(13,'casa',1,'2024-06-19 04:54:23',NULL,NULL,_binary '\0'),(14,'pepela',1,'2024-06-19 04:55:44',NULL,NULL,_binary '\0'),(15,'sopita',1,'2024-06-19 05:09:33',NULL,NULL,_binary '\0'),(16,'Prueba123',1,'2024-06-19 05:16:20',NULL,NULL,_binary '\0'),(17,'Prueba123',1,'2024-06-19 05:16:37',NULL,NULL,_binary '\0'),(18,'camino',1,'2024-06-19 05:23:39',NULL,NULL,_binary ''),(19,'loca',1,'2024-06-19 05:24:28',NULL,NULL,_binary '\0'),(20,'Prueba444',1,'2024-06-19 05:36:24',NULL,NULL,_binary '\0'),(21,'Prueba444',1,'2024-06-19 05:40:06',NULL,NULL,_binary '\0'),(22,'camalion',1,'2024-06-19 05:40:40',NULL,NULL,_binary '\0'),(23,'seda',1,'2024-06-19 05:41:59',NULL,NULL,_binary '\0'),(24,'yoooo',1,'2024-06-19 05:42:39',NULL,NULL,_binary '\0'),(25,'negro',1,'2024-06-19 05:51:21',NULL,NULL,NULL),(26,'Prueba12388',1,'2024-06-19 05:54:55',NULL,NULL,NULL),(27,'roro',1,'2024-06-19 05:57:20',NULL,NULL,_binary '\0'),(28,'tomate',1,'2024-06-19 06:09:28',NULL,NULL,_binary '\0'),(29,'gg',1,'2024-06-19 06:42:31',NULL,NULL,_binary '\0'),(30,'pp',1,'2024-06-19 06:50:55',NULL,NULL,_binary '\0'),(31,'jaja',1,'2024-06-19 07:06:11',NULL,NULL,_binary ''),(32,'looooo',1,'2024-06-19 07:14:54',NULL,NULL,_binary '\0'),(33,'pepepepe',1,'2024-06-19 07:21:51',NULL,NULL,_binary '\0'),(34,'mama',1,'2024-06-19 08:04:45',NULL,NULL,_binary '\0'),(35,'lopez',1,'2024-06-19 08:18:22',NULL,NULL,_binary '\0'),(36,'carla',1,'2024-06-19 08:24:08',NULL,NULL,_binary '\0'),(37,'carla',1,'2024-06-19 08:24:21',NULL,NULL,_binary '\0'),(38,'Administrador',1,'2024-06-19 08:26:12',NULL,NULL,_binary '\0'),(39,'Administrador',1,'2024-06-19 08:26:26',NULL,NULL,_binary '\0'),(40,'lopez',1,'2024-06-19 08:27:09',NULL,NULL,_binary '\0'),(41,'aaaaaaaaa',1,'2024-06-19 08:44:49',NULL,NULL,_binary '\0'),(42,'camara',1,'2024-06-19 08:54:17',NULL,NULL,_binary ''),(43,'Prueba',1,'2024-06-19 08:58:21',NULL,NULL,_binary ''),(44,'sua',1,'2024-06-19 09:07:26',NULL,NULL,_binary ''),(45,'Fisica',1,'2024-06-19 09:10:20',NULL,NULL,_binary ''),(46,'matematica',1,'2024-06-19 15:19:21',NULL,NULL,_binary ''),(47,'hpppp',1,'2024-06-19 15:29:27',NULL,NULL,_binary '\0'),(48,'Scoop',1,'2024-06-19 16:56:42',NULL,NULL,_binary ''),(49,'Scoop2',1,'2024-06-19 16:57:35',NULL,NULL,_binary '\0'),(50,'Scoop3',1,'2024-06-19 16:58:14',NULL,NULL,_binary '\0'),(51,'Scopp43',1,'2024-06-19 17:00:32',NULL,NULL,_binary '\0');
/*!40000 ALTER TABLE `acce_tbroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acce_tbusuarios`
--

DROP TABLE IF EXISTS `acce_tbusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbusuarios` (
  `Usu_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Empl_Id` int(11) NOT NULL,
  `Usu_Usua` varchar(50) DEFAULT NULL,
  `Usu_Contra` text DEFAULT NULL,
  `Usu_Admin` bit(1) DEFAULT NULL,
  `Usu_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Usu_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Usu_Fecha_Creacion` date DEFAULT NULL,
  `Usu_Fecha_Modifica` date DEFAULT NULL,
  `Usu_Estado` int(11) DEFAULT NULL,
  `Rol_Id` int(11) DEFAULT NULL,
  `Usu_Codigo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Usu_ID`),
  KEY `FK_tbUsuarios_tbEmpleados_Emp_ID` (`Empl_Id`),
  KEY `FK_tbEstadosCiviles_tbUsuarios_Usu_Fecha_Creacion` (`Usu_Usu_ID_Cre`),
  KEY `FK_tbEstadosCiviles_tbUsuarios_Usu_Usu_ID_Modi` (`Usu_Usu_ID_Modi`),
  KEY `fk_Rol_Id` (`Rol_Id`),
  CONSTRAINT `FK_tbEstadosCiviles_tbUsuarios_Usu_Fecha_Creacion` FOREIGN KEY (`Usu_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbEstadosCiviles_tbUsuarios_Usu_Usu_ID_Modi` FOREIGN KEY (`Usu_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbUsuarios_tbEmpleados_Empl_Id` FOREIGN KEY (`Empl_Id`) REFERENCES `gral_tbempleados` (`Empl_Id`),
  CONSTRAINT `fk_Rol_Id` FOREIGN KEY (`Rol_Id`) REFERENCES `acce_tbpantallas_porroles` (`Rol_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbusuarios`
--

LOCK TABLES `acce_tbusuarios` WRITE;
/*!40000 ALTER TABLE `acce_tbusuarios` DISABLE KEYS */;
INSERT INTO `acce_tbusuarios` VALUES (1,1,'admin','8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a8',_binary '',1,74,'2024-06-14','2024-06-21',1,6,NULL),(2,8,'Douglas','8525266d59b36b8ccab2268f89c3890ba2325b5af6b07fa18e1d3fa7eda63bdcb0e80007fbffb9fb540b286162678c1aced8a5f9a43a8170372fd305f4cf508b',_binary '\0',1,2,'2024-06-14','2024-06-21',1,46,'839390'),(3,3,'pmartinez','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e99',_binary '\0',1,NULL,'2024-06-14',NULL,1,1,NULL),(4,4,'lhernandez','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e99',_binary '\0',1,NULL,'2024-06-14',NULL,1,1,NULL),(5,5,'jrodriguez','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e99',_binary '\0',1,NULL,'2024-06-14',NULL,1,1,NULL),(7,1,'Yordin','Yordin',_binary '',1,NULL,'2024-06-15',NULL,1,1,NULL),(36,6,'Prueba','cbfcf25be01a9627f2349f2c8da94d1e22d563cbee33d5eaa4378f7441b954ca938fc1cce0c36bc327c13da4a7e767bba10c40386b83c9ee1823c1d4e15ab5dc',_binary '',1,1,'2024-06-15','0000-00-00',1,6,'932308'),(37,6,'Omar','9671f2697888c4114253470954a3332d2b13b3b89548ded2b99b066df2858c2c35dbcbeaf136c3e873d13b19fda50e3c0ff248eb74419d4fbf1acd949ca16ef0',_binary '\0',36,36,'2024-06-16','2024-06-16',1,1,NULL),(38,6,'Kaka','a3712f42b52c36c678dc7e6312ebdae844c4985b4dfdb70c21dbbc8d4834304c959179b577f2712286ff9a21d9c38b7b9531a4747f872ce3673e21ad6427ed5d',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(39,6,'rrr','3e181257ea477ec94c71d9e9acef7d5810855f64deb03e6ab3c163c1a3a04c9bd9ae4c2b24ad1f31bf22d68283c393be80dea0a0cab2d2dafa9ac47a5ebb8f83',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(40,1,'papa','a608b2efd86c36044af56dd8ed20cdfef21fc76b30840b844cfd2333b025f35fb134747afbf065f5b9eb8cae73cb1760540aa5bbf95458afeb9a0e6d77c29728',_binary '\0',1,36,'0000-00-00','2024-06-17',0,1,NULL),(41,1,'papapapa','15e36944fbfcb96938768aaab2e678417632af0c405576ab7fffbb214a4069afbe475d24c1498ac7cc5f8f606dce6c264b7f490425b06045c88b4eb70fdf3c52',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(42,1,'cmamama','37754dbb07e967b269a9c917668fd5d13ba409156a6db69e32bf399b458df484e5e841cc9e69d6e908554dbcd14ebcd0f3a50f524f4c66ff997645a3cb57fe41',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(43,1,'papapapapap','15e36944fbfcb96938768aaab2e678417632af0c405576ab7fffbb214a4069afbe475d24c1498ac7cc5f8f606dce6c264b7f490425b06045c88b4eb70fdf3c52',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(44,1,'pepe','974f3036f39834082e23f4d70f1feba9d4805b3ee2cedb50b6f1f49f72dd83616c2155f9ff6e08a1cefbf9e6ba2f4aaa45233c8c066a65e002924abfa51590c4',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(45,1,'lll','cda12a652c7ec0beb2617220b4f8a58b2c26687f90365bd962559d4a474b03bacc70f5fc6ce8bac936ca75e7af7f9f01ee3005e66323d232d4a5b5027ccc1bb3',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(46,1,'laalala','5de85b3bfca67759817023968c454864b1c74c27f26ca02d2ef5b21d1bae52db42e6b5c96a42a6cd7f20c2ef0b7fe70c3ea48c8d53edb2b7621ec031360dd389',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(47,1,'ñaña','06ec658f2376dd77de522afa7f6fc1c8bddc8d3997013afc922dcb3201b989d80c35ef53e96f43f4a26270a9dc52cee82179930f8ad3be55652ae6101809fec4',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(48,1,'hhhh','079f526482ff783b467d6a9eec5cc9ab74bc4af20be4795007e7d5f2ba64ac0e8888e2533fe468944d05f7dcd67d474f7da968f785c48c9f18e125926a125cd9',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(49,1,'que','4ce9792f2871988864761ef032ce09646333c81667d5d3360a82d7c47411c0b46846437ac5e304880fb5d7510d0af3d7af5a666a1f0459df1e04d1a8683bbe13',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(50,1,'jjjj','127be42cecee8c5f7148bc15b1a6440e90957c0de52a7fbe5c8d5278dcf90787f1671900906bf50497af9fe45f768a5c30ac923b3d054e937433e234acbee9ad',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(51,1,'qqqqqwqwqw','2e9706d057fd8398ad667b1e1d536cdb66a68e95244e6f94c9374b38c35689f54b54e0496f668f7f935dc8fc738edf2ca410ce6116549b0cad7a7562460a094e',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(52,1,'camalion','4d0113a3109bd43edde70598827ad9d89cd26781bbf2b354bbf92f06629103a1a791e3c4fcff86f6a2edf5e8de11adc68d571fe51f9e087a32efce9af41034a7',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(53,1,'hghghg','5555e5cd29c6270831f967899d092fb71ae29007cfc4aa0930c5a10b4c2072b82061f54d4483f37d355d7379cd99000be7672e1f136179b81b37c5ca1aafe3d1',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(54,1,'jkjk','297e4e5eef2d2d8b59a4a2d3e59b704ba28db3f66afc5a984c1b25aa45a94227c339ac93ab55317292bebd6d34192579d8253a6b8c1f92f331d800f1f5415a7c',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(55,1,'eeeee','eea5f7b4e77c0871124ea8e2a81429d1c46b695c186801c5d2f68d32037037089ba80e8c5c0121d48a601e4cf99d74e649808ddcba29000a221a52c954321005',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(56,1,'ttt','0602611a56f977501462561aacb2f3d57af108c43f5983bc73f26de2129c30fa3aa12da49cd144e800b9a0c378e60c2ec858475aed4579067985ea1bed2f3fb1',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(57,1,'lal','fa41c007c6ae0dca69660ce2619ffe3be3c8993f5406f0e47bcfc6ea16b0c213e03960fe65ad0619069ccee3516875fcd4c74ad69dd923ff0ecbc0cb447c1212',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(59,1,'ererere','306997d68fa69d82da2a383dc343a0eed61afe83f35085736ef84baf36a1881acc3318a125ca4636eb114b3098f705bd53942f662b67edd860d9e2c1d9028aa0',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(60,1,'qqqqq','b54a69aa96ef940496e2b141ac027d56c5a4586544dfbb766fe55459160b097a8aaaa3b2bfa8b734b66f290c8d91526f046e07780abac805b0197cdb16240677',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(61,1,'pepino','1e055d249efc8f9381537a966433b628b8f54cd85e129386d0c5186a8d54a0c079381800d236ae2f26cbb125d7ecdc859761a9a7cb142fd608f8212764574e04',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(62,6,'ssdsds','4fb956067e9135a79e1c19e28eb8bd1988366779da085bbffc276f88e11722dcd74b7c9dd21489aea4a99013de6412990515bf080882ee9ce732af43c13b6d60',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(63,1,'kkkkk','68e85763cd02cc5b906e7f08ac8945366c221191fe209eb078d905fbd03e753b910709ff4563b1e10d8d06b02233b3a6e62011869bb9bed8034cc1904e62f5aa',_binary '\0',1,NULL,'0000-00-00',NULL,1,1,NULL),(64,1,'nene','22cb60f98ef5f277eed8ddae9fa87a84a299637cbc0716d3c6e586424026ad7d1df5edb3c847c0d0ff22e4076edf63f45aa140efaec1c003744f6f5196032a33',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(65,1,'pene','e766940daced1eb1bb07377d5fbb2ee0df7eb6294cbdeb5a25494c0d095cdd22ccb9977f11a4901549d8ed847ef10bb225f68e03214357a458c565500b17a671',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(66,1,'popo','1061f6c258a71e6d44fa19e069e6e5fb62e3c824f3fe5eb5733a72da726cd46c8466ba9451338ea2c1d28db64cc673484eb71084438c08f52e2254d77dc05d33',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(67,1,'rick','53814a380c9d51ab76c08599a01239d994118b6b8cbd6abf1d7783ad2764fbe1be28f85e89ad00517422a798822d13757a618ec8e7965571c4afbd33c62221f0',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(68,1,'don','ae855c22b459fcc3382a98373187cb09cd55b03439087b3f909ce0343ad7c5ca05fdc599cc790e4f7cf7f93145c9cb7cc476fa74b1f1951849949780713b3d86',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(69,1,'lol','3dd28c5a23f780659d83dd99981e2dcb82bd4c4bdc8d97a7da50ae84c7a7229a6dc0ae8ae4748640a4cc07ccc2d55dbdc023a99b3ef72bc6ce49e30b84253dae',_binary '',36,NULL,'2024-06-16',NULL,1,1,NULL),(70,1,'lola','c5b283f34d8cc083279d8694846d4089151d6b21c7d77eaad5f90eb10a156231f85f544d1d617004c18e42158677ffe4845cb43db6a40290202dae1a079a4616',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(71,1,'Tomate','74d0d387f02d78c73274bd9c6896f15e632832111627591c6a8b0650fa913b6e93efea818393052da2e743e48d277c4f2e4bc55bf3b3c630e0207084c10188f8',_binary '',36,NULL,'2024-06-16',NULL,0,1,NULL),(72,1,'lalalma','93b13b257f732ba8cd51cfc1ee63683d9c9e430943ee49bd5a5a71dcc94cf2e72c6578270fb7641f3e6c077fa5bfca8629382d0e02dbf9c380ec023fed7e5a35',_binary '',36,36,'2024-06-16','2024-06-17',0,1,NULL),(73,1,'lllaaaa','7a9b2a35095dcdfedfdf0ef810310b409e38c92c20cbd51088ea5e4bc4873bdacfeb29f14b7f2ed033d87fad00036da83d5c597a7e7429bc70cec378db4de6a6',_binary '\0',36,NULL,'2024-06-16',NULL,0,1,NULL),(74,1,'Superman','6d16e989de5314f3eff5e0c4a24c2bf0fd7f8fe395e713ac839b325a10c4ed1191d1c972c49471efcaa197275b652464fc19007ea5f3542b798c6295b38a2b31',_binary '',36,74,'2024-06-17','2024-06-17',1,1,NULL),(75,6,'Caminar','90381be3f450a68549bf0bdfb4ea73a8224e3aa78b8cd92e5978127d70ad70fd0e6b8fdec0a7663419a4ef46ce7428b8bc954c716af9279957da6e18401476af',_binary '\0',74,74,'2024-06-17','2024-06-17',0,1,NULL),(76,2,'ECERNA','3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2',_binary '\0',36,NULL,'2024-06-19',NULL,1,10,NULL),(77,7,'Fernado','3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2',_binary '',36,NULL,'2024-06-19','2024-06-19',1,1,'982342');
/*!40000 ALTER TABLE `acce_tbusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error_logs`
--

DROP TABLE IF EXISTS `error_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `error_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `error_code` int(11) DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error_logs`
--

LOCK TABLES `error_logs` WRITE;
/*!40000 ALTER TABLE `error_logs` DISABLE KEYS */;
INSERT INTO `error_logs` VALUES (1,1452,'Cannot add or update a child row: a foreign key constraint fails (`dbgruporac`.`acce_tbusuarios`, CONSTRAINT `fk_Rol_Id` FOREIGN KEY (`Rol_Id`) REFERENCES `acce_tbpantallas_porroles` (`Rol_Id`))','2024-06-16 05:44:15'),(2,1452,'Cannot add or update a child row: a foreign key constraint fails (`dbgruporac`.`acce_tbusuarios`, CONSTRAINT `fk_Rol_Id` FOREIGN KEY (`Rol_Id`) REFERENCES `acce_tbpantallas_porroles` (`Rol_Id`))','2024-06-16 17:59:08');
/*!40000 ALTER TABLE `error_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbcargos`
--

DROP TABLE IF EXISTS `gral_tbcargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbcargos` (
  `Crg_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Crg_Descripcion` varchar(60) DEFAULT NULL,
  `Crg_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Crg_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Crg_Fecha_Creacion` date DEFAULT NULL,
  `Crg_Fecha_Modifica` date DEFAULT NULL,
  `Crg_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Crg_ID`),
  KEY `FK_tbCargos_tbUsuarios_Crg_Usu_ID_Cre` (`Crg_Usu_ID_Cre`),
  KEY `FK_tbCargos_tbUsuarios_Crg_Usu_ID_Modi` (`Crg_Usu_ID_Modi`),
  CONSTRAINT `FK_tbCargos_tbUsuarios_Crg_Usu_ID_Cre` FOREIGN KEY (`Crg_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbCargos_tbUsuarios_Crg_Usu_ID_Modi` FOREIGN KEY (`Crg_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbcargos`
--

LOCK TABLES `gral_tbcargos` WRITE;
/*!40000 ALTER TABLE `gral_tbcargos` DISABLE KEYS */;
INSERT INTO `gral_tbcargos` VALUES (1,'Gerente de Ventas',NULL,NULL,'2024-06-14',NULL,_binary ''),(2,'Analista Financiero',NULL,NULL,'2024-06-14',NULL,_binary ''),(3,'Cajero',NULL,NULL,'2024-06-14',NULL,_binary ''),(4,'Jefe de Recursos Humanos',NULL,NULL,'2024-06-14',NULL,_binary ''),(5,'Vendedor',NULL,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbcargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbcategorias`
--

DROP TABLE IF EXISTS `gral_tbcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbcategorias` (
  `Cat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_Descripcion` varchar(60) NOT NULL,
  `Cat_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Cat_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Cat_Fecha_Creacion` date DEFAULT NULL,
  `Cat_Fecha_Modifica` date DEFAULT NULL,
  `Cat_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Cat_ID`),
  KEY `FK_tbCategorias_tbUsuarios_Cat_Usu_ID_Cre` (`Cat_Usu_ID_Cre`),
  KEY `FK_tbCategorias_tbUsuarios_Cat_Usu_ID_Modi` (`Cat_Usu_ID_Modi`),
  CONSTRAINT `FK_tbCategorias_tbUsuarios_Cat_Usu_ID_Cre` FOREIGN KEY (`Cat_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbCategorias_tbUsuarios_Cat_Usu_ID_Modi` FOREIGN KEY (`Cat_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbcategorias`
--

LOCK TABLES `gral_tbcategorias` WRITE;
/*!40000 ALTER TABLE `gral_tbcategorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `gral_tbcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbciudades`
--

DROP TABLE IF EXISTS `gral_tbciudades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbciudades` (
  `Ciu_ID` varchar(4) NOT NULL,
  `Ciu_Descripcion` varchar(60) NOT NULL,
  `Dep_ID` varchar(2) NOT NULL,
  `Ciu_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Ciu_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Ciu_Fecha_Creacion` date DEFAULT NULL,
  `Ciu_Fecha_Modifica` date DEFAULT NULL,
  `Ciu_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Ciu_ID`),
  KEY `FK_tbCiudades_tbDepartamentos_Dep_ID` (`Dep_ID`),
  KEY `FK_tbCiudades_tbUsuarios_Ciu_Usu_ID_Cre` (`Ciu_Usu_ID_Cre`),
  KEY `FK_tbCiudades_tbUsuarios_Ciu_Usu_ID_Modi` (`Ciu_Usu_ID_Modi`),
  CONSTRAINT `FK_tbCiudades_tbDepartamentos_Dep_ID` FOREIGN KEY (`Dep_ID`) REFERENCES `gral_tbdepartamentos` (`Dep_ID`),
  CONSTRAINT `FK_tbCiudades_tbUsuarios_Ciu_Usu_ID_Cre` FOREIGN KEY (`Ciu_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbCiudades_tbUsuarios_Ciu_Usu_ID_Modi` FOREIGN KEY (`Ciu_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbciudades`
--

LOCK TABLES `gral_tbciudades` WRITE;
/*!40000 ALTER TABLE `gral_tbciudades` DISABLE KEYS */;
INSERT INTO `gral_tbciudades` VALUES ('0301','Comayagua','03',NULL,NULL,'2024-06-14',NULL,_binary ''),('0302','Siguatepeque','03',NULL,NULL,'2024-06-14',NULL,_binary ''),('0303','La Libertad','03',NULL,NULL,'2024-06-14',NULL,_binary ''),('0304','Taulabé','03',NULL,NULL,'2024-06-14',NULL,_binary ''),('0305','San José de Comayagua','03',NULL,NULL,'2024-06-14',NULL,_binary ''),('0320','Las Lajas','03',NULL,NULL,'2024-06-14',NULL,_binary ''),('0501','San Pedro Sula','05',NULL,NULL,'2024-06-14',NULL,_binary ''),('0502','Puerto Cortés','05',NULL,NULL,'2024-06-14',NULL,_binary ''),('0503','Choloma','05',NULL,NULL,'2024-06-14',NULL,_binary ''),('0504','La Lima','05',NULL,NULL,'2024-06-14',NULL,_binary ''),('0505','Villanueva','05',NULL,NULL,'2024-06-14',NULL,_binary ''),('0801','Tegucigalpa','08',NULL,NULL,'2024-06-14',NULL,_binary ''),('0802','Comayagüela','08',NULL,NULL,'2024-06-14',NULL,_binary ''),('0803','Talanga','08',NULL,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbciudades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbclientes`
--

DROP TABLE IF EXISTS `gral_tbclientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbclientes` (
  `Cli_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cli_Nombre` varchar(100) DEFAULT NULL,
  `Cli_Apellido` varchar(60) DEFAULT NULL,
  `Cli_FechaNac` datetime DEFAULT NULL,
  `Cli_Sexo` char(1) DEFAULT NULL,
  `Cli_DNI` varchar(13) DEFAULT NULL,
  `Ciu_Id` varchar(4) DEFAULT NULL,
  `Est_ID` int(11) DEFAULT NULL,
  `Cli_Direccion` varchar(100) DEFAULT NULL,
  `Cli_Creacion` int(11) DEFAULT NULL,
  `Cli_Modifica` int(11) DEFAULT NULL,
  `Cli_Fecha_Creacion` date DEFAULT NULL,
  `Cli_Fecha_Modifica` date DEFAULT NULL,
  `Cli_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Cli_Id`),
  KEY `FK_Com_Creacion` (`Cli_Creacion`),
  KEY `FK_Com_Modifica` (`Cli_Modifica`),
  KEY `FK_EstadosCiviles` (`Est_ID`),
  CONSTRAINT `FK_Com_Creacion` FOREIGN KEY (`Cli_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_Com_Modifica` FOREIGN KEY (`Cli_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_EstadosCiviles` FOREIGN KEY (`Est_ID`) REFERENCES `gral_tbestadosciviles` (`Est_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbclientes`
--

LOCK TABLES `gral_tbclientes` WRITE;
/*!40000 ALTER TABLE `gral_tbclientes` DISABLE KEYS */;
INSERT INTO `gral_tbclientes` VALUES (1,'Carlos','Mejía','1985-02-15 00:00:00','M','0501198501234','0501',1,'Col. La Reforma, San Pedro Sula',NULL,NULL,'2024-06-14',NULL,_binary ''),(2,'Ana','García','1990-06-25 00:00:00','F','0502199002345','0502',2,'Barrio El Centro, Puerto Cortés',NULL,NULL,'2024-06-14',NULL,_binary ''),(3,'Pedro','Martínez','1988-11-12 00:00:00','M','0502198803456','0320',1,'Residencial Los Arcos, Comayagua',NULL,NULL,'2024-06-14',NULL,_binary ''),(4,'Laura','Hernández','1975-03-08 00:00:00','F','0801197504567','0801',2,'Col. Kennedy, Tegucigalpa',NULL,NULL,'2024-06-14',NULL,_binary ''),(5,'Jorge','Rodríguez','1982-09-30 00:00:00','M','0802198205678','0802',3,'Col. Florencia, Comayagüela',NULL,NULL,'2024-06-14',NULL,_binary ''),(6,'Yordin','Sanchez','2024-06-12 00:00:00','M','0601200102969','0501',1,'Altia',36,NULL,'2024-06-19',NULL,_binary ''),(7,'Fernando','Moreno','2024-06-12 00:00:00','M','0501200511139','0501',2,'aaaaa',36,NULL,'2024-06-20',NULL,_binary ''),(8,'Fernandoaaa','aaaaa','2024-06-12 00:00:00','M','0501200511121','0501',1,'aaaaa',36,NULL,'2024-06-20',NULL,_binary ''),(9,'Fernandoaaaasasas','asasasas','2024-06-12 00:00:00','M','060120010296','0501',1,'dsdsd',36,NULL,'2024-06-20',NULL,_binary ''),(10,'Maria','Lopez','2024-06-12 00:00:00','F','060120010297','0501',2,'xd',36,NULL,'2024-06-21',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbclientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbdepartamentos`
--

DROP TABLE IF EXISTS `gral_tbdepartamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbdepartamentos` (
  `Dep_ID` varchar(2) NOT NULL,
  `Dep_Descripcion` varchar(60) NOT NULL,
  `Dep_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Dep_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Dep_Fecha_Creacion` date DEFAULT NULL,
  `Dep_Fecha_Modifica` date DEFAULT NULL,
  `Dep_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Dep_ID`),
  KEY `FK_tbDepartamentos_tbUsuarios_Dep_Usu_ID_Cre` (`Dep_Usu_ID_Cre`),
  KEY `FK_tbDepartamentos_tbUsuarios_Dep_Usu_ID_Modi` (`Dep_Usu_ID_Modi`),
  CONSTRAINT `FK_tbDepartamentos_tbUsuarios_Dep_Usu_ID_Cre` FOREIGN KEY (`Dep_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbDepartamentos_tbUsuarios_Dep_Usu_ID_Modi` FOREIGN KEY (`Dep_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbdepartamentos`
--

LOCK TABLES `gral_tbdepartamentos` WRITE;
/*!40000 ALTER TABLE `gral_tbdepartamentos` DISABLE KEYS */;
INSERT INTO `gral_tbdepartamentos` VALUES ('01','Atlántida',NULL,NULL,'2024-06-14',NULL,_binary ''),('02','Colón',NULL,NULL,'2024-06-14',NULL,_binary ''),('03','Comayagua',NULL,NULL,'2024-06-14',NULL,_binary ''),('04','Copán',NULL,NULL,'2024-06-14',NULL,_binary ''),('05','Cortés',NULL,NULL,'2024-06-14',NULL,_binary ''),('06','Choluteca',NULL,NULL,'2024-06-14',NULL,_binary ''),('07','El Paraíso',NULL,NULL,'2024-06-14',NULL,_binary ''),('08','Francisco Morazán',NULL,NULL,'2024-06-14',NULL,_binary ''),('09','Gracias a Dios',NULL,NULL,'2024-06-14',NULL,_binary ''),('10','Intibucá',NULL,NULL,'2024-06-14',NULL,_binary ''),('11','Islas de la Bahía',NULL,NULL,'2024-06-14',NULL,_binary ''),('12','La Paz',NULL,NULL,'2024-06-14',NULL,_binary ''),('13','Lempira',NULL,NULL,'2024-06-14',NULL,_binary ''),('14','Ocotepeque',NULL,NULL,'2024-06-14',NULL,_binary ''),('15','Olancho',NULL,NULL,'2024-06-14',NULL,_binary ''),('16','Santa Bárbara',NULL,NULL,'2024-06-14',NULL,_binary ''),('17','Valle',NULL,NULL,'2024-06-14',NULL,_binary ''),('18','Yoro',NULL,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbdepartamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbempleados`
--

DROP TABLE IF EXISTS `gral_tbempleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbempleados` (
  `Empl_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Empl_Nombre` varchar(30) NOT NULL,
  `Empl_Apellido` varchar(30) NOT NULL,
  `Empl_Sexo` char(1) NOT NULL,
  `Empl_FechaNac` datetime NOT NULL,
  `Ciu_Id` varchar(4) NOT NULL,
  `Est_ID` int(11) NOT NULL,
  `Sed_ID` int(11) DEFAULT NULL,
  `Carg_Id` int(11) NOT NULL,
  `Empl_UsuarioCreacion` int(11) DEFAULT NULL,
  `Empl_FechaCreacion` datetime DEFAULT NULL,
  `Empl_UsuarioModificacion` int(11) DEFAULT NULL,
  `Empl_FechaModificacion` datetime DEFAULT NULL,
  `Empl_Estado` bit(1) DEFAULT NULL,
  `Empl_DNI` varchar(13) DEFAULT NULL,
  `Empl_Correo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Empl_Id`),
  KEY `FK_tbEmpleados_Vent_tbSedes` (`Sed_ID`),
  KEY `FK_tbEmpleados_tbCargos` (`Carg_Id`),
  KEY `FK_tbEmpleados_tbEstadosCiviles` (`Est_ID`),
  KEY `FK_tbEmpleados_tbUsuarios_Creacion` (`Empl_UsuarioCreacion`),
  KEY `FK_tbEmpleados_tbUsuarios_Modificacion` (`Empl_UsuarioModificacion`),
  CONSTRAINT `FK_tbEmpleados_Vent_tbSedes` FOREIGN KEY (`Sed_ID`) REFERENCES `vent_tbsedes` (`Sed_ID`),
  CONSTRAINT `FK_tbEmpleados_tbCargos` FOREIGN KEY (`Carg_Id`) REFERENCES `gral_tbcargos` (`Crg_ID`),
  CONSTRAINT `FK_tbEmpleados_tbEstadosCiviles` FOREIGN KEY (`Est_ID`) REFERENCES `gral_tbestadosciviles` (`Est_ID`),
  CONSTRAINT `FK_tbEmpleados_tbUsuarios_Creacion` FOREIGN KEY (`Empl_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbEmpleados_tbUsuarios_Modificacion` FOREIGN KEY (`Empl_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbempleados`
--

LOCK TABLES `gral_tbempleados` WRITE;
/*!40000 ALTER TABLE `gral_tbempleados` DISABLE KEYS */;
INSERT INTO `gral_tbempleados` VALUES (1,'Mindy','Campos','M','1985-02-15 00:00:00','0320',1,1,1,NULL,'2024-06-14 00:00:00',NULL,NULL,_binary '','0801198501234',NULL),(2,'Ana','García','F','1990-06-25 00:00:00','0502',2,2,2,NULL,'2024-06-14 00:00:00',NULL,NULL,_binary '','0801199002345',NULL),(3,'Pedro','Martínez','M','1988-11-12 00:00:00','0301',1,3,3,NULL,'2024-06-14 00:00:00',NULL,NULL,_binary '','0801198803456',NULL),(4,'Laura','Hernández','F','1975-03-08 00:00:00','0801',2,4,4,NULL,'2024-06-14 00:00:00',NULL,NULL,_binary '','0801197504567',NULL),(5,'Jorge','Rodríguez','M','1982-09-30 00:00:00','0802',3,5,5,NULL,'2024-06-14 00:00:00',NULL,NULL,_binary '','0801198205678',NULL),(6,'Yordin','Sanchez','M','0000-00-00 00:00:00','0301',1,NULL,1,1,'2024-06-16 00:00:00',NULL,NULL,_binary '','0601200102969','yordin32sanchez@gmail.com'),(7,'Fernando','Moreno','M','2023-12-07 00:00:00','0501',1,2,1,36,'2024-06-19 00:00:00',NULL,NULL,_binary '','0501200511129','fernanmc15@gmail.com'),(8,'Douglas','Sanchez','M','2006-10-23 00:00:00','0501',1,2,1,36,'2024-06-20 00:00:00',NULL,NULL,_binary '','0601200600996','douglasanchez322@gmail.com');
/*!40000 ALTER TABLE `gral_tbempleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbestadosciviles`
--

DROP TABLE IF EXISTS `gral_tbestadosciviles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbestadosciviles` (
  `Est_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Est_Descripcion` varchar(50) NOT NULL,
  `Est_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Est_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Est_Fecha_Creacion` date DEFAULT NULL,
  `Est_Fecha_Modifica` date DEFAULT NULL,
  `Est_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Est_ID`),
  KEY `FK_tbEstadosCiviles_tbUsuarios_Est_Usu_ID_Cre` (`Est_Usu_ID_Cre`),
  KEY `FK_tbEstadosCiviles_tbUsuarios_Est_Usu_ID_Modi` (`Est_Usu_ID_Modi`),
  CONSTRAINT `FK_tbEstadosCiviles_tbUsuarios_Est_Usu_ID_Cre` FOREIGN KEY (`Est_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbEstadosCiviles_tbUsuarios_Est_Usu_ID_Modi` FOREIGN KEY (`Est_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbestadosciviles`
--

LOCK TABLES `gral_tbestadosciviles` WRITE;
/*!40000 ALTER TABLE `gral_tbestadosciviles` DISABLE KEYS */;
INSERT INTO `gral_tbestadosciviles` VALUES (1,'Soltero',NULL,NULL,'2024-06-14',NULL,_binary ''),(2,'Casado',NULL,NULL,'2024-06-14',NULL,_binary ''),(3,'Divorciado',NULL,NULL,'2024-06-14',NULL,_binary ''),(4,'Viudo',NULL,NULL,'2024-06-14',NULL,_binary ''),(5,'Unión Libre',NULL,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbestadosciviles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbmarcas`
--

DROP TABLE IF EXISTS `gral_tbmarcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbmarcas` (
  `Mar_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mar_Descripcion` varchar(150) DEFAULT NULL,
  `Mar_Creacion` int(11) DEFAULT NULL,
  `Mar_Modifica` int(11) DEFAULT NULL,
  `Mar_Fecha_Creacion` date DEFAULT NULL,
  `Mar_Fecha_Modifica` date DEFAULT NULL,
  `Mar_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Mar_Id`),
  KEY `FK_Mar_Creacion` (`Mar_Creacion`),
  KEY `FK_Mar_Modifica` (`Mar_Modifica`),
  CONSTRAINT `FK_Mar_Creacion` FOREIGN KEY (`Mar_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_Mar_Modifica` FOREIGN KEY (`Mar_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbmarcas`
--

LOCK TABLES `gral_tbmarcas` WRITE;
/*!40000 ALTER TABLE `gral_tbmarcas` DISABLE KEYS */;
INSERT INTO `gral_tbmarcas` VALUES (1,'Toyota',1,NULL,'2024-06-14',NULL,_binary ''),(2,'Honda',1,NULL,'2024-06-14',NULL,_binary ''),(3,'Ford',1,NULL,'2024-06-14',NULL,_binary ''),(4,'Chevrolet',1,NULL,'2024-06-14',NULL,_binary ''),(5,'Nissan',1,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbmarcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbmodelos`
--

DROP TABLE IF EXISTS `gral_tbmodelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbmodelos` (
  `Mod_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Mod_Descripcion` varchar(100) DEFAULT NULL,
  `Mod_Año` date DEFAULT NULL,
  `Mar_Id` int(11) DEFAULT NULL,
  `Mod_Creacion` int(11) DEFAULT NULL,
  `Mod_Modifica` int(11) DEFAULT NULL,
  `Mod_Fecha_Creacion` date DEFAULT NULL,
  `Mod_Fecha_Modifica` date DEFAULT NULL,
  `Mod_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Mod_Id`),
  KEY `FK_Mod_Creacion` (`Mod_Creacion`),
  KEY `FK_Mod_Modifica` (`Mod_Modifica`),
  KEY `FK_tbModelos_tbMarcas_Mar_Id` (`Mar_Id`),
  CONSTRAINT `FK_Mod_Creacion` FOREIGN KEY (`Mod_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_Mod_Modifica` FOREIGN KEY (`Mod_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbModelos_tbMarcas_Mar_Id` FOREIGN KEY (`Mar_Id`) REFERENCES `gral_tbmarcas` (`Mar_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbmodelos`
--

LOCK TABLES `gral_tbmodelos` WRITE;
/*!40000 ALTER TABLE `gral_tbmodelos` DISABLE KEYS */;
INSERT INTO `gral_tbmodelos` VALUES (1,'Corolla','2023-01-01',1,1,NULL,'2024-06-14',NULL,_binary ''),(2,'Civic','2022-01-01',2,1,NULL,'2024-06-14',NULL,_binary ''),(3,'Mustang','2021-01-01',3,1,NULL,'2024-06-14',NULL,_binary ''),(4,'Cruze','2020-01-01',4,1,NULL,'2024-06-14',NULL,_binary ''),(5,'Altima','2024-01-01',5,1,NULL,'2024-06-14',NULL,_binary ''),(6,'Corolla','2023-01-01',1,1,NULL,'2024-06-14',NULL,_binary ''),(7,'Civic','2022-01-01',2,1,NULL,'2024-06-14',NULL,_binary ''),(8,'Mustang','2021-01-01',3,1,NULL,'2024-06-14',NULL,_binary ''),(9,'Cruze','2020-01-01',4,1,NULL,'2024-06-14',NULL,_binary ''),(10,'Altima','2024-01-01',5,1,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `gral_tbmodelos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_values`
--

DROP TABLE IF EXISTS `log_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Usu_Usua` varchar(30) DEFAULT NULL,
  `Usu_Admin` bit(1) DEFAULT NULL,
  `log_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_values`
--

LOCK TABLES `log_values` WRITE;
/*!40000 ALTER TABLE `log_values` DISABLE KEYS */;
INSERT INTO `log_values` VALUES (1,'lola',_binary '','2024-06-16 19:09:40'),(2,'lola',_binary '','2024-06-16 19:14:44'),(3,'lola',_binary '','2024-06-16 19:14:44'),(4,'lola',_binary '','2024-06-16 19:14:45'),(5,'lola',_binary '','2024-06-16 19:14:45'),(6,'lola',_binary '','2024-06-16 19:14:45'),(7,'lola',_binary '','2024-06-16 19:14:47'),(8,'Tomate',_binary '','2024-06-16 19:15:03'),(9,'Tomate',_binary '\0','2024-06-16 19:47:13'),(10,'lalalma',_binary '\0','2024-06-16 19:47:42'),(11,'lalalma',_binary '\0','2024-06-16 20:06:35'),(12,'lalalma',_binary '\0','2024-06-16 20:06:59'),(13,'lalalma',_binary '\0','2024-06-16 20:07:26'),(14,'lllaaaa',_binary '\0','2024-06-16 20:09:42'),(15,'lllaaaa',_binary '\0','2024-06-16 20:10:13'),(16,'lllaaaa',_binary '\0','2024-06-16 20:32:45'),(17,'lllaaaa',_binary '\0','2024-06-16 20:35:31'),(18,'lllaaaa',_binary '\0','2024-06-16 20:35:56'),(19,'lllaaaa',_binary '\0','2024-06-16 20:36:14'),(20,'lllaaaa',_binary '\0','2024-06-16 20:36:38'),(21,'lllaaaa',_binary '\0','2024-06-16 20:37:11'),(22,'lllaaaa',_binary '\0','2024-06-16 20:37:40'),(23,'lllaaaa',_binary '\0','2024-06-16 20:38:28'),(24,'lllaaaa',_binary '\0','2024-06-16 20:39:18'),(25,'lllaaaa',_binary '\0','2024-06-16 20:39:33'),(26,'lllaaaa',_binary '\0','2024-06-16 20:42:11'),(27,'lllaaaa',_binary '\0','2024-06-16 20:42:55'),(28,'lllaaaa',_binary '\0','2024-06-16 20:43:07'),(29,'Superman',_binary '\0','2024-06-16 23:51:53'),(30,'Caminar',_binary '','2024-06-17 00:50:40'),(31,'ECERNA',_binary '\0','2024-06-19 15:51:31'),(32,'Fernado',_binary '','2024-06-19 16:44:48');
/*!40000 ALTER TABLE `log_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbapartados`
--

DROP TABLE IF EXISTS `vent_tbapartados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbapartados` (
  `Apa_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Apa_Fecha` datetime DEFAULT NULL,
  `Mpg_ID` int(11) DEFAULT NULL,
  `Cli_Id` int(11) DEFAULT NULL,
  `Apa_Monto` decimal(19,4) DEFAULT NULL,
  `Apa_Fecha_Caducacion` datetime DEFAULT NULL,
  `Apa_Creacion` int(11) DEFAULT NULL,
  `Apa_Modifica` int(11) DEFAULT NULL,
  `Apa_Fecha_Creacion` datetime DEFAULT NULL,
  `Apa_Fecha_Modifica` datetime DEFAULT NULL,
  `Apa_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Apa_Id`),
  KEY `FK_tbApartados_tbClientes_Cli_Id` (`Cli_Id`),
  KEY `FK_tbApartados_tbMetodosPago_Mpg_ID` (`Mpg_ID`),
  KEY `FK_tbApartados_tbUsuarios_Com_Creacion` (`Apa_Creacion`),
  KEY `FK_tbApartados_tbUsuarios_Com_Modifica` (`Apa_Modifica`),
  CONSTRAINT `FK_tbApartados_tbClientes_Cli_Id` FOREIGN KEY (`Cli_Id`) REFERENCES `gral_tbclientes` (`Cli_Id`),
  CONSTRAINT `FK_tbApartados_tbMetodosPago_Mpg_ID` FOREIGN KEY (`Mpg_ID`) REFERENCES `vent_tbmetodospago` (`Mpg_ID`),
  CONSTRAINT `FK_tbApartados_tbUsuarios_Com_Creacion` FOREIGN KEY (`Apa_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbApartados_tbUsuarios_Com_Modifica` FOREIGN KEY (`Apa_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbapartados`
--

LOCK TABLES `vent_tbapartados` WRITE;
/*!40000 ALTER TABLE `vent_tbapartados` DISABLE KEYS */;
INSERT INTO `vent_tbapartados` VALUES (1,'2024-06-16 00:00:00',1,1,1500.0000,'2024-06-20 00:00:00',1,NULL,'2024-06-20 00:00:00',NULL,_binary ''),(23,'0000-00-00 00:00:00',1,1,500.0000,'0000-00-00 00:00:00',1,NULL,'2024-06-21 08:43:10',NULL,_binary ''),(25,'2024-06-21 00:00:00',2,1,5000.0000,'2024-07-06 00:00:00',36,NULL,'2024-06-21 08:47:37',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbapartados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbapartadosdetalles`
--

DROP TABLE IF EXISTS `vent_tbapartadosdetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbapartadosdetalles` (
  `Adt_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Adt_Cantidad` int(11) DEFAULT NULL,
  `Adt_PrecioCompra` decimal(19,4) DEFAULT NULL,
  `Apa_Id` int(11) DEFAULT NULL,
  `Veh_Placa` varchar(7) DEFAULT NULL,
  `Imp_ID` int(11) DEFAULT NULL,
  `Adt_Creacion` int(11) DEFAULT NULL,
  `Adt_Modifica` int(11) DEFAULT NULL,
  `Adt_Fecha_Creacion` datetime DEFAULT NULL,
  `Adt_Fecha_Modifica` datetime DEFAULT NULL,
  `Adt_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Adt_Id`),
  KEY `FK_tbApartadosdetalles_tbApartados_Apa_Id` (`Apa_Id`),
  KEY `FK_tbApartadosdetalles_tbImpuestos_Imp_ID` (`Imp_ID`),
  KEY `FK_tbApartadosdetalles_tbVehiculos_Veh_Placa` (`Veh_Placa`),
  KEY `FK_tbApartadosdetalles_tbUsuarios_Com_Creacion` (`Adt_Creacion`),
  KEY `FK_tbApartadosdetalles_tbUsuarios_Com_Modifica` (`Adt_Modifica`),
  CONSTRAINT `FK_tbApartadosdetalles_tbApartados_Apa_Id` FOREIGN KEY (`Apa_Id`) REFERENCES `vent_tbapartados` (`Apa_Id`),
  CONSTRAINT `FK_tbApartadosdetalles_tbImpuestos_Imp_ID` FOREIGN KEY (`Imp_ID`) REFERENCES `vent_tbimpuestos` (`Imp_ID`),
  CONSTRAINT `FK_tbApartadosdetalles_tbUsuarios_Com_Creacion` FOREIGN KEY (`Adt_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbApartadosdetalles_tbUsuarios_Com_Modifica` FOREIGN KEY (`Adt_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbApartadosdetalles_tbVehiculos_Veh_Placa` FOREIGN KEY (`Veh_Placa`) REFERENCES `vent_tbvehiculos` (`Veh_Placa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbapartadosdetalles`
--

LOCK TABLES `vent_tbapartadosdetalles` WRITE;
/*!40000 ALTER TABLE `vent_tbapartadosdetalles` DISABLE KEYS */;
INSERT INTO `vent_tbapartadosdetalles` VALUES (11,1,1500.0000,23,'HND0123',NULL,1,NULL,'2024-06-21 08:43:10',NULL,_binary ''),(12,1,1500.0000,25,'HND0123',NULL,36,NULL,'2024-06-21 08:47:37',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbapartadosdetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbbitacoraventasdetalle`
--

DROP TABLE IF EXISTS `vent_tbbitacoraventasdetalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbbitacoraventasdetalle` (
  `Vdt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vnt_ID` int(11) NOT NULL,
  `Vdt_Cant` int(11) DEFAULT NULL,
  `Vdt_Precio` decimal(19,4) DEFAULT NULL,
  `Prd_ID` int(11) NOT NULL,
  `Vdt_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Vdt_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Vdt_Fecha_Creacion` date DEFAULT NULL,
  `Vdt_Fecha_Modifica` date DEFAULT NULL,
  `Vdt_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Vdt_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbbitacoraventasdetalle`
--

LOCK TABLES `vent_tbbitacoraventasdetalle` WRITE;
/*!40000 ALTER TABLE `vent_tbbitacoraventasdetalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `vent_tbbitacoraventasdetalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbcategorias`
--

DROP TABLE IF EXISTS `vent_tbcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbcategorias` (
  `Cat_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_Descripcion` varchar(60) NOT NULL,
  `Cat_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Cat_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Cat_Fecha_Creacion` date DEFAULT NULL,
  `Cat_Fecha_Modifica` date DEFAULT NULL,
  `Cat_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Cat_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbcategorias`
--

LOCK TABLES `vent_tbcategorias` WRITE;
/*!40000 ALTER TABLE `vent_tbcategorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `vent_tbcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbcompras`
--

DROP TABLE IF EXISTS `vent_tbcompras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbcompras` (
  `Com_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Com_Fecha` datetime DEFAULT NULL,
  `Mpg_ID` int(11) DEFAULT NULL,
  `Cli_Id` int(11) DEFAULT NULL,
  `Com_Creacion` int(11) DEFAULT NULL,
  `Com_Modifica` int(11) DEFAULT NULL,
  `Com_Fecha_Creacion` datetime DEFAULT NULL,
  `Com_Fecha_Modifica` datetime DEFAULT NULL,
  `Com_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Com_Id`),
  KEY `FK_tbCompras_tbClientes_Cli_Id` (`Cli_Id`),
  KEY `FK_tbCompras_tbMetodosPago_Mpg_ID` (`Mpg_ID`),
  KEY `FK_tbCompras_tbUsuarios_Com_Creacion` (`Com_Creacion`),
  KEY `FK_tbCompras_tbUsuarios_Com_Modifica` (`Com_Modifica`),
  CONSTRAINT `FK_tbCompras_tbClientes_Cli_Id` FOREIGN KEY (`Cli_Id`) REFERENCES `gral_tbclientes` (`Cli_Id`),
  CONSTRAINT `FK_tbCompras_tbMetodosPago_Mpg_ID` FOREIGN KEY (`Mpg_ID`) REFERENCES `vent_tbmetodospago` (`Mpg_ID`),
  CONSTRAINT `FK_tbCompras_tbUsuarios_Com_Creacion` FOREIGN KEY (`Com_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbCompras_tbUsuarios_Com_Modifica` FOREIGN KEY (`Com_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbcompras`
--

LOCK TABLES `vent_tbcompras` WRITE;
/*!40000 ALTER TABLE `vent_tbcompras` DISABLE KEYS */;
INSERT INTO `vent_tbcompras` VALUES (1,'2024-06-16 00:00:00',1,1,1,NULL,'2024-06-15 08:00:00',NULL,_binary ''),(2,'2024-06-16 00:00:00',2,1,1,NULL,'2024-06-15 08:10:00',NULL,_binary ''),(3,'2024-06-16 00:00:00',1,1,1,NULL,'2024-06-16 10:20:00',NULL,_binary ''),(4,'2024-06-21 00:00:00',1,7,36,NULL,'2024-06-20 00:00:00',NULL,_binary ''),(5,'2024-06-21 00:00:00',1,8,36,NULL,'2024-06-20 00:00:00',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbcompras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbcomprasdetalles`
--

DROP TABLE IF EXISTS `vent_tbcomprasdetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbcomprasdetalles` (
  `Cdt_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cdt_Cantidad` int(11) DEFAULT NULL,
  `Cdt_PrecioCompra` decimal(19,4) DEFAULT NULL,
  `Com_Id` int(11) DEFAULT NULL,
  `Veh_Placa` varchar(7) DEFAULT NULL,
  `Imp_ID` int(11) DEFAULT NULL,
  `Cdt_Creacion` int(11) DEFAULT NULL,
  `Cdt_Modifica` int(11) DEFAULT NULL,
  `Cdt_Fecha_Creacion` datetime DEFAULT NULL,
  `Cdt_Fecha_Modifica` datetime DEFAULT NULL,
  `Cdt_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Cdt_Id`),
  KEY `FK_tbComprasDetalles_tbCompras_Com_Id` (`Com_Id`),
  KEY `FK_tbComprasDetalles_tbImpuestos_Imp_ID` (`Imp_ID`),
  KEY `FK_tbComprasDetalles_tbVehiculos_Veh_Placa` (`Veh_Placa`),
  KEY `FK_tbComprasDetalles_tbUsuarios_Com_Creacion` (`Cdt_Creacion`),
  KEY `FK_tbComprasDetalles_tbUsuarios_Com_Modifica` (`Cdt_Modifica`),
  CONSTRAINT `FK_tbComprasDetalles_tbCompras_Com_Id` FOREIGN KEY (`Com_Id`) REFERENCES `vent_tbcompras` (`Com_Id`),
  CONSTRAINT `FK_tbComprasDetalles_tbImpuestos_Imp_ID` FOREIGN KEY (`Imp_ID`) REFERENCES `vent_tbimpuestos` (`Imp_ID`),
  CONSTRAINT `FK_tbComprasDetalles_tbUsuarios_Com_Creacion` FOREIGN KEY (`Cdt_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbComprasDetalles_tbUsuarios_Com_Modifica` FOREIGN KEY (`Cdt_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbComprasDetalles_tbVehiculos_Veh_Placa` FOREIGN KEY (`Veh_Placa`) REFERENCES `vent_tbvehiculos` (`Veh_Placa`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbcomprasdetalles`
--

LOCK TABLES `vent_tbcomprasdetalles` WRITE;
/*!40000 ALTER TABLE `vent_tbcomprasdetalles` DISABLE KEYS */;
INSERT INTO `vent_tbcomprasdetalles` VALUES (6,10,150.0000,1,'HND3456',1,1,NULL,'2024-06-15 08:00:00',NULL,_binary ''),(7,5,75.0000,2,'HND3456',1,1,NULL,'2024-06-15 08:10:00',NULL,_binary ''),(8,7,105.0000,3,'HND0123',1,1,NULL,'2024-06-15 08:20:00',NULL,_binary ''),(9,12,180.0000,2,'HND0123',1,1,NULL,'2024-06-15 08:30:00',NULL,_binary ''),(10,9,135.0000,2,'HND0123',1,1,NULL,'2024-06-15 08:40:00',NULL,_binary ''),(11,NULL,2333434.0000,4,'SDFDFDF',1,36,NULL,'2024-06-20 00:00:00',NULL,_binary ''),(12,NULL,3434343.0000,5,'SSDSS',1,36,NULL,'2024-06-20 00:00:00',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbcomprasdetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbdescuentos`
--

DROP TABLE IF EXISTS `vent_tbdescuentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbdescuentos` (
  `Des_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Des_Cantidad` decimal(19,4) NOT NULL,
  `Des_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Des_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Des_Fecha_Creacion` date DEFAULT NULL,
  `Des_Fecha_Modifica` date DEFAULT NULL,
  `Des_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Des_ID`),
  KEY `FK_tbDescuentos_tbUsuarios_Des_Usu_ID_Cre` (`Des_Usu_ID_Cre`),
  KEY `FK_tbDescuentos_tbUsuarios_Des_Usu_ID_Modi` (`Des_Usu_ID_Modi`),
  CONSTRAINT `FK_tbDescuentos_tbUsuarios_Des_Usu_ID_Cre` FOREIGN KEY (`Des_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbDescuentos_tbUsuarios_Des_Usu_ID_Modi` FOREIGN KEY (`Des_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbdescuentos`
--

LOCK TABLES `vent_tbdescuentos` WRITE;
/*!40000 ALTER TABLE `vent_tbdescuentos` DISABLE KEYS */;
INSERT INTO `vent_tbdescuentos` VALUES (1,10.0000,1,NULL,'2024-06-14',NULL,_binary ''),(2,15.5000,1,NULL,'2024-06-14',NULL,_binary ''),(3,5.0000,1,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbdescuentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbimpuestos`
--

DROP TABLE IF EXISTS `vent_tbimpuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbimpuestos` (
  `Imp_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Imp_ISV` float DEFAULT NULL,
  `Imp_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Imp_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Imp_Fecha_Creacion` date DEFAULT NULL,
  `Imp_Fecha_Modifica` date DEFAULT NULL,
  `Imp_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Imp_ID`),
  KEY `FK_tbCargos_tbImpuestos_Imp_Usu_ID_Cre` (`Imp_Usu_ID_Cre`),
  KEY `FK_tbCargos_tbImpuestos_Imp_Usu_ID_Modi` (`Imp_Usu_ID_Modi`),
  CONSTRAINT `FK_tbCargos_tbImpuestos_Imp_Usu_ID_Cre` FOREIGN KEY (`Imp_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbCargos_tbImpuestos_Imp_Usu_ID_Modi` FOREIGN KEY (`Imp_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbimpuestos`
--

LOCK TABLES `vent_tbimpuestos` WRITE;
/*!40000 ALTER TABLE `vent_tbimpuestos` DISABLE KEYS */;
INSERT INTO `vent_tbimpuestos` VALUES (1,0.15,2,NULL,'2024-06-15',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbimpuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbmetodospago`
--

DROP TABLE IF EXISTS `vent_tbmetodospago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbmetodospago` (
  `Mpg_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Mpg_Descripcion` varchar(50) NOT NULL,
  `Mpg_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Mpg_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Mpg_Fecha_Creacion` date DEFAULT NULL,
  `Mpg_Fecha_Modifica` date DEFAULT NULL,
  `Mpg_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Mpg_ID`),
  KEY `FK_tbMetodosPago_tbUsuarios_Mpg_Usu_ID_Cre` (`Mpg_Usu_ID_Cre`),
  KEY `FK_tbMetodosPago_tbUsuarios_Mpg_Usu_ID_Modi` (`Mpg_Usu_ID_Modi`),
  CONSTRAINT `FK_tbMetodosPago_tbUsuarios_Mpg_Usu_ID_Cre` FOREIGN KEY (`Mpg_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbMetodosPago_tbUsuarios_Mpg_Usu_ID_Modi` FOREIGN KEY (`Mpg_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbmetodospago`
--

LOCK TABLES `vent_tbmetodospago` WRITE;
/*!40000 ALTER TABLE `vent_tbmetodospago` DISABLE KEYS */;
INSERT INTO `vent_tbmetodospago` VALUES (1,'Tarjeta de Crédito',1,NULL,'2024-06-14',NULL,_binary ''),(2,'Transferencia Bancaria',1,NULL,'2024-06-14',NULL,_binary ''),(3,'Efectivo',1,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbmetodospago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbproductos`
--

DROP TABLE IF EXISTS `vent_tbproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbproductos` (
  `Prd_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Prd_Descripcion` varchar(60) DEFAULT NULL,
  `Prd_PrecioCompra` decimal(19,4) DEFAULT NULL,
  `Prd_Precioventa` decimal(19,4) DEFAULT NULL,
  `Cat_ID` int(11) DEFAULT NULL,
  `Prd_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Prd_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Prd_Fecha_Creacion` date DEFAULT NULL,
  `Prd_Fecha_Modifica` date DEFAULT NULL,
  `Prd_Estado` bit(1) DEFAULT NULL,
  `Prd_Stock` int(11) DEFAULT NULL,
  `Prd_DescripcionProducto` text DEFAULT NULL,
  PRIMARY KEY (`Prd_ID`),
  KEY `FK_tbProductos_tbCategorias_Cat_ID` (`Cat_ID`),
  KEY `FK_tbProductos_tbUsuarios_Prd_Usu_ID_Cre` (`Prd_Usu_ID_Cre`),
  KEY `FK_tbProductos_tbUsuarios_Prd_Usu_ID_Modi` (`Prd_Usu_ID_Modi`),
  CONSTRAINT `FK_tbProductos_tbCategorias_Cat_ID` FOREIGN KEY (`Cat_ID`) REFERENCES `vent_tbcategorias` (`Cat_ID`),
  CONSTRAINT `FK_tbProductos_tbUsuarios_Prd_Usu_ID_Cre` FOREIGN KEY (`Prd_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbProductos_tbUsuarios_Prd_Usu_ID_Modi` FOREIGN KEY (`Prd_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbproductos`
--

LOCK TABLES `vent_tbproductos` WRITE;
/*!40000 ALTER TABLE `vent_tbproductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `vent_tbproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbsedes`
--

DROP TABLE IF EXISTS `vent_tbsedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbsedes` (
  `Sed_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Sed_Descripcion` varchar(50) NOT NULL,
  `Ciu_ID` varchar(4) DEFAULT NULL,
  `Sed_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Sed_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Sed_Fecha_Creacion` date DEFAULT NULL,
  `Sed_Fecha_Modifica` date DEFAULT NULL,
  `Sed_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Sed_ID`),
  KEY `FK_tbSedes_tbCiudades_Ciu_ID` (`Ciu_ID`),
  KEY `FK_tbSedes_tbUsuarios_Sed_Usu_ID_Cre` (`Sed_Usu_ID_Cre`),
  KEY `FK_tbSedes_tbUsuarios_Sed_Usu_ID_Modi` (`Sed_Usu_ID_Modi`),
  CONSTRAINT `FK_tbSedes_tbCiudades_Ciu_ID` FOREIGN KEY (`Ciu_ID`) REFERENCES `gral_tbciudades` (`Ciu_ID`),
  CONSTRAINT `FK_tbSedes_tbUsuarios_Sed_Usu_ID_Cre` FOREIGN KEY (`Sed_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbSedes_tbUsuarios_Sed_Usu_ID_Modi` FOREIGN KEY (`Sed_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbsedes`
--

LOCK TABLES `vent_tbsedes` WRITE;
/*!40000 ALTER TABLE `vent_tbsedes` DISABLE KEYS */;
INSERT INTO `vent_tbsedes` VALUES (1,'Sede Central Tegucigalpa','0801',NULL,NULL,'2024-06-14',NULL,_binary ''),(2,'Sede San Pedro Sula','0501',NULL,NULL,'2024-06-14',NULL,_binary ''),(3,'Sede La Comayagua','0320',NULL,NULL,'2024-06-14',NULL,_binary ''),(4,'Sede central','0301',NULL,NULL,'2024-06-14',NULL,_binary ''),(5,'Sede Talanga','0803',NULL,NULL,'2024-06-14',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbsedes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbvehiculos`
--

DROP TABLE IF EXISTS `vent_tbvehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbvehiculos` (
  `Veh_Placa` varchar(7) NOT NULL,
  `Veh_Color` varchar(50) DEFAULT NULL,
  `Veh_Imagen` text DEFAULT NULL,
  `Veh_Stock` int(11) DEFAULT NULL,
  `Veh_Precio` decimal(19,4) DEFAULT NULL,
  `Mod_Id` int(11) DEFAULT NULL,
  `Veh_Creacion` int(11) DEFAULT NULL,
  `Veh_Modifica` int(11) DEFAULT NULL,
  `Veh_Fecha_Creacion` datetime DEFAULT NULL,
  `Veh_Fecha_Modifica` datetime DEFAULT NULL,
  `Veh_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Veh_Placa`),
  KEY `FK_tbVehiculos_tbModelos_Mod_Id` (`Mod_Id`),
  KEY `FK_tbVehiculos_tbUsuarios_Veh_Creacion` (`Veh_Creacion`),
  KEY `FK_tbVehiculos_tbUsuarios_Veh_Modifica` (`Veh_Modifica`),
  CONSTRAINT `FK_tbVehiculos_tbModelos_Mod_Id` FOREIGN KEY (`Mod_Id`) REFERENCES `gral_tbmodelos` (`Mod_Id`),
  CONSTRAINT `FK_tbVehiculos_tbUsuarios_Veh_Creacion` FOREIGN KEY (`Veh_Creacion`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbVehiculos_tbUsuarios_Veh_Modifica` FOREIGN KEY (`Veh_Modifica`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbvehiculos`
--

LOCK TABLES `vent_tbvehiculos` WRITE;
/*!40000 ALTER TABLE `vent_tbvehiculos` DISABLE KEYS */;
INSERT INTO `vent_tbvehiculos` VALUES ('HND0123','Gris','https://example.com/images/vehiculos/altima_gris.jpg',6,27000.0000,5,1,NULL,'2024-06-14 00:00:00',NULL,_binary '\0'),('HND1234','Rojo','https://example.com/images/vehiculos/corolla_rojo.jpg',10,22000.0000,1,1,NULL,'2024-06-14 00:00:00',NULL,_binary ''),('HND3456','Negro','https://example.com/images/vehiculos/mustang_negro.jpg',3,35000.0000,3,1,NULL,'2024-06-14 00:00:00',NULL,_binary ''),('HND5678','Azul','https://example.com/images/vehiculos/civic_azul.jpg',5,18000.0000,2,1,NULL,'2024-06-14 00:00:00',NULL,_binary ''),('HND7890','Blanco','https://example.com/images/vehiculos/cruze_blanco.jpg',8,25000.0000,4,1,NULL,'2024-06-14 00:00:00',NULL,_binary ''),('SDFDFDF','DFDFDFD','lupa.png',NULL,2333434.0000,2,36,NULL,'2024-06-20 00:00:00',NULL,_binary ''),('SSDSS','SDSDSD','2023_06_21_finale-21713356.png',NULL,3434343.0000,7,36,NULL,'2024-06-20 00:00:00',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbvehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbventas`
--

DROP TABLE IF EXISTS `vent_tbventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbventas` (
  `Vnt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vnt_Fecha` datetime DEFAULT NULL,
  `Emp_ID` int(11) DEFAULT NULL,
  `Mpg_ID` int(11) DEFAULT NULL,
  `Sed_ID` int(11) DEFAULT NULL,
  `Des_ID` int(11) DEFAULT NULL,
  `Cli_ID` int(11) DEFAULT NULL,
  `Vnt_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Vnt_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Vnt_Fecha_Creacion` datetime DEFAULT NULL,
  `Vnt_Fecha_Modifica` datetime DEFAULT NULL,
  `Vnt_Estado` bit(1) DEFAULT NULL,
  `Imp_ID` int(15) DEFAULT NULL,
  PRIMARY KEY (`Vnt_ID`),
  KEY `FK_tbVentas_tbClientes_Cli_ID` (`Cli_ID`),
  KEY `FK_tbVentas_tbDescuentos_Des_ID` (`Des_ID`),
  KEY `FK_tbVentas_tbEmpleados_Emp_ID` (`Emp_ID`),
  KEY `FK_tbVentas_tbMetodosPago_Mpg_ID` (`Mpg_ID`),
  KEY `FK_tbVentas_tbSedes_Sed_ID` (`Sed_ID`),
  KEY `FK_tbVentas_tbUsuarios_Vnt_Usu_ID_Cre` (`Vnt_Usu_ID_Cre`),
  KEY `FK_tbVentas_tbUsuarios_Vnt_Usu_ID_Modi` (`Vnt_Usu_ID_Modi`),
  KEY `FK_tbVentas_tbImpuestos_Imp_ID` (`Imp_ID`),
  CONSTRAINT `FK_tbVentas_tbClientes_Cli_ID` FOREIGN KEY (`Cli_ID`) REFERENCES `gral_tbclientes` (`Cli_Id`),
  CONSTRAINT `FK_tbVentas_tbDescuentos_Des_ID` FOREIGN KEY (`Des_ID`) REFERENCES `vent_tbdescuentos` (`Des_ID`),
  CONSTRAINT `FK_tbVentas_tbEmpleados_Emp_ID` FOREIGN KEY (`Emp_ID`) REFERENCES `gral_tbempleados` (`Empl_Id`),
  CONSTRAINT `FK_tbVentas_tbImpuestos_Imp_ID` FOREIGN KEY (`Imp_ID`) REFERENCES `vent_tbimpuestos` (`Imp_ID`),
  CONSTRAINT `FK_tbVentas_tbMetodosPago_Mpg_ID` FOREIGN KEY (`Mpg_ID`) REFERENCES `vent_tbmetodospago` (`Mpg_ID`),
  CONSTRAINT `FK_tbVentas_tbSedes_Sed_ID` FOREIGN KEY (`Sed_ID`) REFERENCES `vent_tbsedes` (`Sed_ID`),
  CONSTRAINT `FK_tbVentas_tbUsuarios_Vnt_Usu_ID_Cre` FOREIGN KEY (`Vnt_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbVentas_tbUsuarios_Vnt_Usu_ID_Modi` FOREIGN KEY (`Vnt_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbventas`
--

LOCK TABLES `vent_tbventas` WRITE;
/*!40000 ALTER TABLE `vent_tbventas` DISABLE KEYS */;
INSERT INTO `vent_tbventas` VALUES (1,'2024-06-16 00:00:00',1,1,1,1,1,1,NULL,'2024-06-15 08:00:00',NULL,_binary '',1),(2,'2024-06-16 00:00:00',2,2,1,1,3,1,NULL,'2024-06-15 08:10:00',NULL,_binary '',1),(3,'2024-06-16 00:00:00',1,1,2,2,3,1,NULL,'2024-06-16 10:20:00',NULL,_binary '',1);
/*!40000 ALTER TABLE `vent_tbventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbventasdetalles`
--

DROP TABLE IF EXISTS `vent_tbventasdetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbventasdetalles` (
  `Vdt_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vnt_ID` int(11) DEFAULT NULL,
  `Vdt_PrecioVenta` decimal(19,4) DEFAULT NULL,
  `Veh_Placa` varchar(7) DEFAULT NULL,
  `Vdt_Usu_ID_Cre` int(11) DEFAULT NULL,
  `Vdt_Usu_ID_Modi` int(11) DEFAULT NULL,
  `Vdt_Fecha_Creacion` datetime DEFAULT NULL,
  `Vdt_Fecha_Modifica` datetime DEFAULT NULL,
  `Vdt_Estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Vdt_ID`),
  KEY `FK_tbVentasDetalles_tbUsuarios_Vnt_Usu_ID_Cre` (`Vdt_Usu_ID_Cre`),
  KEY `FK_tbVentasDetalles_tbUsuarios_Vnt_Usu_ID_Modi` (`Vdt_Usu_ID_Modi`),
  KEY `FK_tbVentasDetalles_tbVehiculos_Veh_Placa` (`Veh_Placa`),
  KEY `FK_tbVentasDetalles_tbVentas_Vnt_ID` (`Vnt_ID`),
  CONSTRAINT `FK_tbVentasDetalles_tbUsuarios_Vnt_Usu_ID_Cre` FOREIGN KEY (`Vdt_Usu_ID_Cre`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbVentasDetalles_tbUsuarios_Vnt_Usu_ID_Modi` FOREIGN KEY (`Vdt_Usu_ID_Modi`) REFERENCES `acce_tbusuarios` (`Usu_ID`),
  CONSTRAINT `FK_tbVentasDetalles_tbVehiculos_Veh_Placa` FOREIGN KEY (`Veh_Placa`) REFERENCES `vent_tbvehiculos` (`Veh_Placa`),
  CONSTRAINT `FK_tbVentasDetalles_tbVentas_Vnt_ID` FOREIGN KEY (`Vnt_ID`) REFERENCES `vent_tbventas` (`Vnt_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbventasdetalles`
--

LOCK TABLES `vent_tbventasdetalles` WRITE;
/*!40000 ALTER TABLE `vent_tbventasdetalles` DISABLE KEYS */;
INSERT INTO `vent_tbventasdetalles` VALUES (11,2,150.0000,'HND3456',1,NULL,'2024-06-15 08:00:00',NULL,_binary ''),(12,3,75.0000,'HND3456',1,NULL,'2024-06-15 08:10:00',NULL,_binary ''),(13,1,105.0000,'HND0123',1,NULL,'2024-06-15 08:20:00',NULL,_binary ''),(14,1,180.0000,'HND0123',1,NULL,'2024-06-15 08:30:00',NULL,_binary ''),(15,1,135.0000,'HND0123',1,NULL,'2024-06-15 08:40:00',NULL,_binary '');
/*!40000 ALTER TABLE `vent_tbventasdetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'dbgruporac'
--

--
-- Dumping routines for database 'dbgruporac'
--
/*!50003 DROP PROCEDURE IF EXISTS `acce_SP_Usuarios_InicioSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `acce_SP_Usuarios_InicioSesion`(
    IN p_Usuario VARCHAR(100),
    IN p_Contra VARCHAR(255)
)
BEGIN
    SELECT 
        usu.Usu_ID,
        usu.Usu_Usua,
        usu.Usu_Contra,
        CONCAT(emp.Empl_Nombre, ' ', emp.Empl_Apellido) AS Usu_Nombrecompleto,
        CASE WHEN usu.Usu_Admin = 0 THEN 'Usuario' ELSE 'Admin' END AS Admin,
        emp.Empl_Id,
        p.Ptl_Identificador,
        usu.Rol_Id,
        usu.Usu_Admin
    FROM 
        acce_tbusuarios AS usu
        LEFT JOIN gral_tbempleados AS emp ON usu.Empl_Id = emp.Empl_Id
        LEFT JOIN acce_tbpantallas_porroles AS r ON r.Rol_Id = usu.Rol_Id
        LEFT JOIN acce_tbpantallas AS p ON p.Ptl_Id = r.Ptl_Id
    WHERE 
        usu.Usu_Usua = p_Usuario 
        AND usu.Usu_Contra = SHA2(p_Contra, 512);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_AgregarCodigoVerificacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_AgregarCodigoVerificacion`(
    IN p_Usu_Codigo VARCHAR(255),
    IN p_Usu_Id INT
)
BEGIN
    UPDATE acce_tbusuarios
    SET Usu_Codigo = p_Usu_Codigo
    WHERE Usu_ID = p_Usu_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Apartado_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Apartado_Insertar`(
    IN p_Fecha DATETIME,
    IN p_MetodoPago INT,
    IN p_Cliente INT,
    IN p_Monto DECIMAL(19,4),
    IN p_FechaCaducacion DATETIME,
    IN p_Creacion INT,
    IN p_Veh_Placa VARCHAR(7),
    IN p_Cantidad INT,
    IN p_PrecioCompra DECIMAL(19,4)
)
BEGIN
    DECLARE v_Apa_Id INT;

    -- Insertar en la tabla vent_tbapartados
    INSERT INTO vent_tbapartados (Apa_Fecha, Mpg_ID, Cli_Id, Apa_Monto, Apa_Fecha_Caducacion, Apa_Creacion, Apa_Fecha_Creacion, Apa_Estado)
    VALUES (p_Fecha, p_MetodoPago, p_Cliente, p_Monto, p_FechaCaducacion, p_Creacion, NOW(), 1);
    
    -- Obtener el ID del apartado recién creado
    SET v_Apa_Id = LAST_INSERT_ID();
    
    -- Insertar en la tabla vent_tbapartadosdetalles
    INSERT INTO vent_tbapartadosdetalles (Adt_Cantidad, Adt_PrecioCompra, Apa_Id, Veh_Placa, Adt_Creacion, Adt_Fecha_Creacion, Adt_Estado)
    VALUES (p_Cantidad, p_PrecioCompra, v_Apa_Id, p_Veh_Placa, p_Creacion, NOW(), 1);
    
    -- Actualizar el estado del vehículo a reservado (0)
    UPDATE vent_tbvehiculos
    SET Veh_Estado = 0
    WHERE Veh_Placa = p_Veh_Placa;

    SELECT v_Apa_Id AS Result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Apartado_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Apartado_Listar`()
BEGIN
    SELECT  a.Apa_Id,
			a.Apa_Fecha,
            a.Apa_Monto,
            a.Apa_Fecha_Caducacion,
			mpg.Mpg_Descripcion,
           CONCAT(cli.Cli_Nombre, ' ', cli.Cli_Apellido) AS Cli_Nombre
    FROM vent_tbapartados a
    LEFT JOIN
    vent_tbmetodospago mpg ON a.Mpg_ID = mpg.Mpg_ID 
    LEFT JOIN
    gral_tbclientes cli ON a.Cli_Id = cli.Cli_Id
    WHERE Apa_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cargo_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cargo_Listar`()
BEGIN
    SELECT * FROM Gral_tbCargos WHERE Crg_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ciudades_Ddl` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ciudades_Ddl`(IN Dep_ID VARCHAR(2))
BEGIN
    SELECT * FROM gral_tbciudades c
    WHERE c.Dep_ID = Dep_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ciudad_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ciudad_Listar`()
BEGIN
    SELECT * FROM Gral_tbCiudades WHERE Ciu_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Clientes_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Clientes_Cantidad`()
BEGIN
SELECT count(Cli_Id) cantidadClientes FROM dbgruporac.gral_tbclientes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cliente_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cliente_Actualizar`(
    IN p_Cli_Id INT,
    IN p_Cli_Nombre VARCHAR(100),
    IN p_Cli_Apellido VARCHAR(60),
    IN p_Cli_FechaNac DATETIME,
    IN p_Cli_Sexo CHAR(1),
    IN p_Cli_DNI VARCHAR(13),
    IN p_Ciu_Id VARCHAR(4),
    IN p_Est_ID INT,
    IN p_Cli_Direccion VARCHAR(100),
    IN p_Cli_Modifica INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result;
    END;

    START TRANSACTION;
    
    UPDATE Gral_tbClientes
    SET Cli_Nombre = p_Cli_Nombre,
        Cli_Apellido = p_Cli_Apellido,
        Cli_FechaNac = p_Cli_FechaNac,
        Cli_Sexo = p_Cli_Sexo,
        Cli_DNI = p_Cli_DNI,
        Ciu_Id = p_Ciu_Id,
        Est_ID = p_Est_ID,
        Cli_Direccion = p_Cli_Direccion,
        Cli_Modifica = p_Cli_Modifica,
        Cli_Fecha_Modifica = CURDATE()
    WHERE Cli_Id = p_Cli_Id;

    COMMIT;
    SELECT 1 AS Result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cliente_BuscarPorDNI` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cliente_BuscarPorDNI`(
    IN p_Cli_DNI VARCHAR(13)
)
BEGIN
    SELECT CONCAT(Cli_Nombre, ' ', Cli_Apellido) AS Cli_Nombre
    FROM gral_tbclientes
    WHERE Cli_DNI = p_Cli_DNI;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cliente_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cliente_Detalle`(IN p_Cli_Id INT)
BEGIN
    SELECT 
        c.Cli_Id,
        c.Cli_Nombre,
        c.Cli_Apellido,
        c.Cli_FechaNac,
       CASE c.Cli_Sexo WHEN 'F' THEN 'Femenino' ELSE 'Masculino' END AS Cli_Sexo,
        c.Cli_DNI,
        c.Cli_Direccion,
        c.Cli_Creacion,
        c.Cli_Fecha_Creacion,
        c.Cli_Fecha_Modifica,
        c.Cli_Modifica,
        c.Cli_Estado,
        c.Ciu_Id,
        c.Est_ID,
        ciu.Ciu_Descripcion,
        est.Est_Descripcion,
        dep.Dep_ID,
        dep.Dep_Descripcion,
        usuCre.Usu_Usua AS Creacion,
        usuModi.Usu_Usua AS Modifica
    FROM 
        gral_tbclientes c
    LEFT JOIN 
	gral_tbciudades ciu ON c.Ciu_Id = ciu.Ciu_Id
    LEFT JOIN 
      gral_tbestadosciviles  est ON c.Est_ID = est.Est_ID
	LEFT JOIN
     acce_tbusuarios usuCre ON c.Cli_Creacion = usuCre.Usu_ID
     LEFT JOIN 
     acce_tbusuarios usuModi ON c.Cli_Modifica = usuModi.Usu_ID
	LEFT JOIN
    gral_tbdepartamentos dep ON ciu.Dep_ID = dep.Dep_ID
    WHERE 
        c.Cli_Id = p_Cli_Id AND 
        c.Cli_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cliente_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cliente_Eliminar`(IN p_Cli_Id INT)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result;
    END;

    START TRANSACTION;
    
    UPDATE Gral_tbClientes
    SET Cli_Estado = 0
    WHERE Cli_Id = p_Cli_Id;

    COMMIT;
    SELECT 1 AS Result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cliente_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cliente_Insertar`(
    IN p_Cli_Nombre VARCHAR(100),
    IN p_Cli_Apellido VARCHAR(60),
    IN p_Cli_FechaNac DATETIME,
    IN p_Cli_Sexo CHAR(1),
    IN p_Cli_DNI VARCHAR(13),
    IN p_Ciu_Id VARCHAR(4),
    IN p_Est_ID INT,
    IN p_Cli_Direccion VARCHAR(100),
    IN p_Cli_Creacion INT,
    OUT p_Cli_ID INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result, NULL AS Cli_ID;
    END;

    START TRANSACTION;
    
    INSERT INTO Gral_tbClientes (Cli_Nombre, Cli_Apellido, Cli_FechaNac, Cli_Sexo, Cli_DNI, Ciu_Id, Est_ID, Cli_Direccion, Cli_Creacion, Cli_Fecha_Creacion, Cli_Estado)
    VALUES (p_Cli_Nombre, p_Cli_Apellido, p_Cli_FechaNac, p_Cli_Sexo, p_Cli_DNI, p_Ciu_Id, p_Est_ID, p_Cli_Direccion, p_Cli_Creacion, CURDATE(), 1);

    SET p_Cli_ID = LAST_INSERT_ID();
    COMMIT;
    SELECT 1 AS Result, p_Cli_ID AS Cli_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Cliente_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Cliente_Listar`()
BEGIN
    SELECT c.Cli_Id,
			c.Cli_DNI,
			CONCAT(c.Cli_Nombre, ' ', c.Cli_Apellido) AS Cli_Nombre,
            CASE c.Cli_Sexo WHEN 'F' THEN 'Femenino' ELSE 'Masculino' END AS Cli_Sexo,
            c.Cli_FechaNac,
            ciu.Ciu_Descripcion,
            esciv.Est_Descripcion
    FROM gral_tbclientes c 
    LEFT JOIN
    gral_tbestadosciviles esciv ON c.Est_ID = esciv.Est_ID
    LEFT JOIN
    gral_tbciudades ciu ON c.Ciu_Id = ciu.Ciu_Id
    WHERE Cli_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ComprasCantidad_FiltroFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ComprasCantidad_FiltroFecha`(IN fecha_inicio DATE, IN fecha_fin DATE)
BEGIN
    SELECT 
        MONTH(Cdt_Fecha_Creacion) AS Mes, 
        YEAR(Cdt_Fecha_Creacion) AS Anio, 
        COUNT(*) AS CantidadCompras
    FROM 
        vent_tbcomprasdetalles
    WHERE 
        Cdt_Fecha_Creacion BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        Anio, Mes
    ORDER BY 
        Anio, Mes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ComprasClientesCantidad_FiltroFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ComprasClientesCantidad_FiltroFecha`(IN fecha_inicio DATE, IN fecha_fin DATE)
BEGIN
    SELECT 
        CONCAT(cli_nombre, ' ', cli_Apellido) AS cli_nombre, 
        Cdt_Fecha_Creacion, 
        COUNT(CD.Cdt_Id) AS cantidadCompras
    FROM 
        dbgruporac.vent_tbcompras COMP 
    INNER JOIN 
        vent_tbcomprasdetalles CD ON CD.Com_ID = COMP.Com_ID
    INNER JOIN 
        gral_tbclientes CLI ON CLI.Cli_ID = COMP.Cli_ID
    WHERE 
        CD.Cdt_Fecha_Creacion BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        cli_nombre
    ORDER BY 
        cantidadCompras DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ComprasClientes_Mes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ComprasClientes_Mes`()
BEGIN
    SELECT 
        CONCAT(cli_nombre, ' ', cli_Apellido) AS cli_nombre, 
        Cdt_Fecha_Creacion, 
        COUNT(CD.Cdt_Id) AS cantidadCompras
    FROM 
        dbgruporac.vent_tbcompras COMP 
    INNER JOIN 
        vent_tbcomprasdetalles CD ON CD.Com_ID = COMP.Com_ID
    INNER JOIN 
        gral_tbclientes CLI ON CLI.Cli_ID = COMP.Cli_ID
    WHERE 
        MONTH(CD.Cdt_Fecha_Creacion) = MONTH(CURDATE()) 
        AND YEAR(CD.Cdt_Fecha_Creacion) = YEAR(CURDATE())
    GROUP BY 
        cli_nombre
    ORDER BY 
        cantidadCompras DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ComprasDetalles_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ComprasDetalles_Eliminar`(
    IN p_Cdt_Id INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result;
    END;

    START TRANSACTION;
    
    DELETE FROM vent_tbcomprasdetalles
    WHERE Cdt_Id = p_Cdt_Id;
	COMMIT;
    SELECT 1 AS Resultado;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ComprasDetalles_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ComprasDetalles_Insertar`(
    IN p_Cdt_PrecioCompra VARCHAR(100),
    IN p_Com_ID INT,
    IN p_Veh_Placa VARCHAR(7),
    IN p_Imp_ID INT,
    IN p_Cdt_Creacion INT
)
BEGIN
     DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result;
    END;

    START TRANSACTION;
    
    INSERT INTO vent_tbcomprasdetalles (Cdt_PrecioCompra, Com_Id, Veh_Placa, Imp_ID, Cdt_Creacion, Cdt_Fecha_Creacion, Cdt_Estado)
    VALUES (p_Cdt_PrecioCompra, p_Com_ID, p_Veh_Placa, p_Imp_ID, p_Cdt_Creacion, CURDATE(), 1);

    COMMIT;
    SELECT 1 AS Result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ComprasDetalle_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ComprasDetalle_Listar`(IN p_Com_Id INT)
BEGIN
    SELECT 
		cdt.Cdt_Id,
        veh.Veh_Placa,
        veh.Veh_Color,
        model.Mod_Descripcion,
        YEAR(model.Mod_Año) AS Mod_Año, -- Utilizamos la función YEAR para extraer solo el año
        marc.Mar_Descripcion,
        cdt.Cdt_PrecioCompra,
        imp.Imp_ISV
    FROM 
        vent_tbcompras com
    LEFT JOIN 
        vent_tbcomprasdetalles cdt ON com.Com_Id = cdt.Com_Id
    LEFT JOIN 
        vent_tbvehiculos veh ON cdt.Veh_Placa = veh.Veh_Placa
    LEFT JOIN
        gral_tbmodelos model ON veh.Mod_Id = model.Mod_Id
    LEFT JOIN 
        gral_tbmarcas marc ON model.Mar_Id = marc.Mar_Id
    LEFT JOIN
        vent_tbimpuestos imp ON cdt.Imp_ID = imp.Imp_ID
    WHERE 
        com.Com_Id = p_Com_Id AND 
        com.Com_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ComprasMes_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ComprasMes_Cantidad`()
BEGIN
    SELECT 
        MONTH(Cdt_Fecha_Creacion) AS Mes, 
        YEAR(Cdt_Fecha_Creacion) AS Anio, 
        COUNT(*) AS CantidadCompras
    FROM 
        vent_tbcomprasdetalles
    GROUP BY 
        Anio, Mes
    ORDER BY 
        Anio, Mes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_ComprasPorFecha_Reporte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_ComprasPorFecha_Reporte`(IN startDate DATE, IN endDate DATE)
BEGIN
    SELECT COMP.Com_ID, Com_Fecha, COMP.Cli_ID, concat(cli_nombre, ' ', cli_Apellido) cli_nombre, 
        Cdt_Cantidad, FORMAT(Cdt_PrecioCompra, 2) Cdt_PrecioCompra, FORMAT((Cdt_Cantidad * Cdt_PrecioCompra), 2) subtotal,
        FORMAT((Cdt_Cantidad * Cdt_PrecioCompra) - ((Cdt_Cantidad * Cdt_PrecioCompra) * Imp_ISV), 2) total
    FROM dbgruporac.vent_tbcompras COMP 
    INNER JOIN vent_tbcomprasdetalles CD ON CD.Com_Id = COMP.Com_Id
    INNER JOIN gral_tbclientes CLI ON CLI.cli_ID = COMP.cli_ID
    INNER JOIN vent_tbimpuestos IMP on IMP.Imp_ID = CD.Imp_ID
    WHERE Com_Fecha BETWEEN startDate AND endDate;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Compras_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Compras_Actualizar`(
    IN p_Com_ID INT,
    IN p_Com_Fecha DATETIME,
    IN p_Mpg_ID INT,
    IN p_Cli_Id INT,
    IN p_Com_Modifica INT
)
BEGIN
    UPDATE Vent_tbCompras
    SET 
        Com_Fecha = p_Com_Fecha,
        Mpg_ID = p_Mpg_ID,
        Cli_Id = p_Cli_Id,
        Com_Modifica = p_Com_Modifica,
        Com_Fecha_Modifica = CURDATE()
    WHERE 
        Com_ID = p_Com_ID AND Com_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Compras_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Compras_Cantidad`()
BEGIN
SELECT count(Cdt_ID) cantidadCompras FROM dbgruporac.vent_tbcomprasdetalles;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Compras_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Compras_Detalle`(
    IN p_Com_ID INT
)
BEGIN
    SELECT c.Com_Id,
			c.Com_Fecha,
			c.Mpg_ID,
            mpg.Mpg_Descripcion,
            c.Cli_Id,
            cli.Cli_DNI,
			cli.Cli_Nombre,
            cli.Cli_Apellido,
			c.Com_Fecha_Creacion,
			c.Com_Fecha_Modifica,
            usuCre.Usu_Usua AS Creacion,
			usuModi.Usu_Usua AS Modifica
    FROM Vent_tbCompras c
    LEFT JOIN 
    vent_tbmetodospago mpg ON c.Mpg_ID = mpg.Mpg_ID
    LEFT JOIN
    gral_tbclientes cli ON c.Cli_Id = cli.Cli_Id
    	LEFT JOIN
     acce_tbusuarios usuCre ON c.Com_Creacion = usuCre.Usu_ID
     LEFT JOIN 
     acce_tbusuarios usuModi ON c.Com_Modifica = usuModi.Usu_ID
    WHERE Com_ID = p_Com_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Compras_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Compras_Eliminar`(
    IN p_Com_ID INT,
    IN p_Com_Modifica INT
)
BEGIN
    UPDATE Vent_tbCompras
    SET 
        Com_Estado = 0,
        Com_Modifica = p_Com_Modifica,
        Com_Fecha_Modifica = CURDATE()
    WHERE 
        Com_ID = p_Com_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Compras_Finalizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Compras_Finalizar`(
    IN p_Com_Id INT
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result;
    END;

    START TRANSACTION;
    
     UPDATE Vent_tbCompras
	 SET 
        Com_Estado = 0
    WHERE 
        Com_Id = p_Com_Id;
	COMMIT;
    SELECT 1 AS Resultado;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Compras_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Compras_Insertar`(
    IN p_Com_Fecha DATETIME,
    IN p_Mpg_ID INT,
    IN p_Cli_Id INT,
    IN p_Com_Creacion INT,
    OUT p_Com_ID INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result,NULL AS Com_ID;
    END;

    START TRANSACTION;
    
    INSERT INTO vent_tbcompras (Com_Fecha, Mpg_ID, Cli_Id, Com_Creacion, Com_Fecha_Creacion, Com_Estado)
    VALUES (p_Com_Fecha, p_Mpg_ID, p_Cli_Id, p_Com_Creacion, CURDATE(), 1);

    SET p_Com_ID = LAST_INSERT_ID();

    COMMIT;
    SELECT 1 AS Result,p_Com_ID AS Com_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Compras_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Compras_Listar`()
BEGIN
    SELECT  c.Com_Id,
			c.Com_Fecha,
			mpg.Mpg_Descripcion,
           CONCAT(cli.Cli_Nombre, ' ', cli.Cli_Apellido) AS Cli_Nombre,
           c.Com_Estado
    FROM vent_tbcompras c
    LEFT JOIN
    vent_tbmetodospago mpg ON c.Mpg_ID = mpg.Mpg_ID 
    LEFT JOIN
    gral_tbclientes cli ON c.Cli_Id = cli.Cli_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Departamentos_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Departamentos_Listar`()
BEGIN
    SELECT * FROM gral_tbdepartamentos;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Empleados_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Empleados_Cantidad`()
BEGIN
SELECT count(Empl_Id) cantidadEmpleados FROM dbgruporac.gral_tbempleados;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Empleados_Top5` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Empleados_Top5`()
BEGIN
SELECT concat(empl_nombre, ' ', empl_Apellido) emp_nombre, FORMAT(SUM(VD.vdt_PrecioVenta),2) AS totalVendido
FROM dbgruporac.vent_tbventas VENT 
INNER JOIN vent_tbventasdetalles VD ON VD.Vnt_ID = VENT.Vnt_ID
INNER JOIN gral_tbempleados EMP ON EMP.Empl_ID = VENT.Emp_ID
GROUP BY emp_nombre
ORDER BY totalVendido DESC
LIMIT 5;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Empleado_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Empleado_Actualizar`(
    IN p_Empl_Id INT,
    IN p_Empl_Nombre VARCHAR(30),
    IN p_Empl_Apellido VARCHAR(30),
    IN p_Empl_Sexo CHAR(1),
    IN p_Empl_FechaNac DATETIME,
    IN p_Ciu_Id VARCHAR(4),
    IN p_Est_ID INT,
    IN p_Carg_Id INT,
	IN P_Sed_ID INT,
    IN P_Empl_Correo NVARCHAR(255),
    IN p_Empl_UsuarioModificacion INT,
    IN p_Empl_DNI VARCHAR(13)
)
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 0 AS Resultado;
    END;

    UPDATE Gral_tbEmpleados
    SET Empl_Nombre = p_Empl_Nombre,
        Empl_Apellido = p_Empl_Apellido,
        Empl_Sexo = p_Empl_Sexo,
        Empl_FechaNac = p_Empl_FechaNac,
        Ciu_Id = p_Ciu_Id,
        Est_ID = p_Est_ID,
        Carg_Id = p_Carg_Id,
         Sed_ID=P_Sed_ID, 
         Empl_Correo=P_Empl_Correo,
        Empl_UsuarioModificacion = p_Empl_UsuarioModificacion,
        Empl_FechaModificacion = CURDATE(),
        Empl_DNI = p_Empl_DNI
    WHERE Empl_Id = p_Empl_Id;

    -- Verificamos si la actualización fue exitosa.
    IF ROW_COUNT() > 0 THEN
        SELECT 1 AS Resultado;
    ELSE
        SELECT 0 AS Resultado;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Empleado_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Empleado_Detalle`(IN p_Empl_Id INT)
BEGIN
    SELECT 
        c.Empl_Id,
        c.Empl_Nombre,
        c.Empl_Apellido,
        c.Empl_FechaNac,
       CASE c.Empl_Sexo WHEN 'F' THEN 'Femenino' ELSE 'Masculino' END AS Empl_Sexo,
        c.Empl_DNI,
        c.Empl_Correo,
        c.Empl_UsuarioCreacion AS Empl_Creacion,
        c. Empl_FechaCreacion AS Empl_Fecha_Creacion,
        c.Empl_FechaModificacion AS Empl_Fecha_Modifica,
        c.Empl_UsuarioModificacion AS Empl_Modifica,
        c.Empl_Estado,
        c.Ciu_Id,
        c.Est_ID,
        ciu.Ciu_Descripcion,
        
        est.Est_Descripcion,
            c.Sed_ID,
        s.Sed_Descripcion AS Sed_Descripcion,
        ca.Crg_ID,
        ca.Crg_Descripcion AS Crg_Descripcion,
        dep.Dep_ID,
        dep.Dep_Descripcion,
        usuCre.Usu_Usua AS Creacion,
        usuModi.Usu_Usua AS Modifica
    FROM 
        gral_tbempleados c
    LEFT JOIN 
	gral_tbciudades ciu ON c.Ciu_Id = ciu.Ciu_Id
    LEFT JOIN 
      gral_tbestadosciviles  est ON c.Est_ID = est.Est_ID
         LEFT JOIN 
       vent_tbsedes  s ON c.Sed_ID = s.Sed_ID
    LEFT JOIN 
        Gral_tbCargos ca ON c.Carg_Id = ca.Crg_ID
	LEFT JOIN
     acce_tbusuarios usuCre ON c.Empl_UsuarioCreacion = usuCre.Usu_ID
     LEFT JOIN 
     acce_tbusuarios usuModi ON c.Empl_UsuarioModificacion = usuModi.Usu_ID
	LEFT JOIN
    gral_tbdepartamentos dep ON ciu.Dep_ID = dep.Dep_ID
    WHERE 
        c.Empl_Id = p_Empl_Id AND 
        c.Empl_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Empleado_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Empleado_Eliminar`(
    IN p_Empl_Id INT
)
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 0 AS Resultado;
    END;

    UPDATE Gral_tbEmpleados
    SET Empl_Estado = 0
    WHERE Empl_Id = p_Empl_Id;

    IF ROW_COUNT() > 0 THEN
        SELECT 1 AS Resultado;
    ELSE
        SELECT 0 AS Resultado;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Empleado_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Empleado_Insertar`(
    IN p_Empl_Nombre VARCHAR(30),
    IN p_Empl_Apellido VARCHAR(30),
    IN p_Empl_Sexo CHAR(1),
    IN p_Empl_FechaNac DATETIME,
    IN p_Ciu_Id VARCHAR(4),
    IN p_Est_ID INT,
    IN p_Carg_Id INT,
    IN P_Sed_ID INT,
    IN P_Empl_Correo NVARCHAR(255),
    IN p_Empl_UsuarioCreacion INT,
    IN p_Empl_DNI VARCHAR(13)
)
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 0 AS Resultado;
    END;

    INSERT INTO Gral_tbEmpleados (
        Empl_Nombre, Empl_Apellido, Empl_Sexo, Empl_FechaNac, Ciu_Id, Est_ID, Carg_Id, Sed_ID, Empl_Correo, Empl_UsuarioCreacion, Empl_FechaCreacion, Empl_Estado, Empl_DNI
    )
    VALUES (
        p_Empl_Nombre, p_Empl_Apellido, p_Empl_Sexo, p_Empl_FechaNac, p_Ciu_Id, p_Est_ID, p_Carg_Id, P_Sed_ID, P_Empl_Correo, p_Empl_UsuarioCreacion, CURDATE(), 1, p_Empl_DNI
    );

    IF ROW_COUNT() > 0 THEN
        SELECT 1 AS Resultado;
    ELSE
        SELECT 0 AS Resultado;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Empleado_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Empleado_Listar`()
BEGIN
    SELECT 
        e.Empl_Id,
        e.Empl_Nombre,
        e.Empl_Apellido,
        CASE 
            WHEN e.Empl_Sexo = 'M' THEN 'Masculino'
            WHEN e.Empl_Sexo = 'F' THEN 'Femenino'
        END AS Empl_Sexo,
        e.Empl_FechaNac,
        e.Ciu_Id,
        e.Empl_Correo,
        c.Ciu_Descripcion AS Ciu_Descripcion,
        e.Est_ID,
        es.Est_Descripcion AS Est_Descripcion,
        e.Sed_ID,
        s.Sed_Descripcion AS Sed_Descripcion,
        ca.Crg_ID,
        ca.Crg_Descripcion AS Crg_Descripcion,
        e.Empl_DNI,
        e.Empl_UsuarioCreacion,
        uCrea.Usu_Usua AS UsuarioCreacion,
        e.Empl_UsuarioModificacion,
        uModi.Usu_Usua AS UsuarioModificacion,
        e.Empl_FechaCreacion,
        e.Empl_FechaModificacion
    FROM 
        Gral_tbEmpleados e
    LEFT JOIN 
        Gral_tbCiudades c ON e.Ciu_Id = c.Ciu_ID
    LEFT JOIN 
        Gral_tbEstadosCiviles es ON e.Est_ID = es.Est_ID
    LEFT JOIN 
       vent_tbsedes  s ON e.Sed_ID = s.Sed_ID
    LEFT JOIN 
        Gral_tbCargos ca ON e.Carg_Id = ca.Crg_ID
    LEFT JOIN 
        Acce_tbUsuarios uCrea ON e.Empl_UsuarioCreacion = uCrea.Usu_ID
    LEFT JOIN 
        Acce_tbUsuarios uModi ON e.Empl_UsuarioModificacion = uModi.Usu_ID
    WHERE 
        e.Empl_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Empleado_Listar_2` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Empleado_Listar_2`()
BEGIN
    SELECT * FROM gral_tbempleados where Empl_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_EstadoCivil_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_EstadoCivil_Listar`()
BEGIN
    SELECT * FROM Gral_tbEstadosCiviles WHERE Est_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Listar_Ventas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Listar_Ventas`()
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        -- Si ocurre una excepción, mostramos un mensaje de error.
        SELECT 'Error al listar las ventas' AS ErrorMensaje;
    END;

    SELECT 
        v.Vnt_ID,
        v.Vnt_Fecha,
        CONCAT(c.Cli_Nombre, ' ', c.Cli_Apellido) AS Cliente,
        mp.Mpg_Descripcion AS Metodo_Pago
    FROM 
        dbgruporac.vent_tbventas v
    JOIN 
        dbgruporac.gral_tbclientes c ON v.Cli_ID = c.Cli_Id
    JOIN 
        dbgruporac.vent_tbmetodospago mp ON v.Mpg_ID = mp.Mpg_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Marcas_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Marcas_Cantidad`()
BEGIN
SELECT count(Mar_Id) cantidadMarcas FROM dbgruporac.gral_tbmarcas;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Marca_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Marca_Listar`()
BEGIN
    SELECT * FROM Gral_tbMarcas WHERE Mar_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_MetodoPago_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_MetodoPago_Listar`()
BEGIN
    SELECT * FROM vent_tbmetodospago WHERE Mpg_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_MetodosPago_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_MetodosPago_Listar`()
BEGIN
    SELECT * FROM vent_tbmetodospago WHERE Mpg_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Modelos_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Modelos_Cantidad`()
BEGIN
SELECT count(Mod_Id) cantidadModelos FROM dbgruporac.gral_tbmodelos;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Modelos_Ddl` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modelos_Ddl`(IN Mar_Id INT)
BEGIN
    SELECT * FROM gral_tbmodelos m
    WHERE m.Mar_Id = Mar_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Modelo_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modelo_Actualizar`(
    IN p_Mod_Id INT,
    IN p_Mod_Descripcion VARCHAR(100),
    IN p_Mod_Año DATE,
    IN p_Mar_Id INT,
    IN p_Mod_Modifica INT
)
BEGIN
    UPDATE Gral_tbModelos
    SET Mod_Descripcion = p_Mod_Descripcion,
        Mod_Año = p_Mod_Año,
        Mar_Id = p_Mar_Id,
        Mod_Modifica = p_Mod_Modifica,
        Mod_Fecha_Modifica = CURDATE()
    WHERE Mod_Id = p_Mod_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Modelo_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modelo_Detalle`(IN p_Mod_Id INT)
BEGIN
    SELECT * FROM Gral_tbModelos WHERE Mod_Id = p_Mod_Id AND Mod_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Modelo_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modelo_Eliminar`(IN p_Mod_Id INT)
BEGIN
    UPDATE Gral_tbModelos
    SET Mod_Estado = 0
    WHERE Mod_Id = p_Mod_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Modelo_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modelo_Insertar`(
    IN p_Mod_Descripcion VARCHAR(100),
    IN p_Mod_Año DATE,
    IN p_Mar_Id INT,
    IN p_Mod_Creacion INT
)
BEGIN
    INSERT INTO Gral_tbModelos (Mod_Descripcion, Mod_Año, Mar_Id, Mod_Creacion, Mod_Fecha_Creacion, Mod_Estado)
    VALUES (p_Mod_Descripcion, p_Mod_Año, p_Mar_Id, p_Mod_Creacion, CURDATE(), 1);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Modelo_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Modelo_Listar`()
BEGIN
    SELECT * FROM Gral_tbModelos WHERE Mod_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_MostrarCodigoVerificacion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_MostrarCodigoVerificacion`(
    IN p_codigo VARCHAR(255)
)
BEGIN
    SELECT * FROM acce_tbusuarios
    WHERE Usu_Codigo = p_codigo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasDisponibles_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasDisponibles_Listar`(IN p_Rol_Id INT)
BEGIN
    SELECT Ptl_Id, Ptl_Descripcion
    FROM acce_tbpantallas
    WHERE Ptl_Id NOT IN (
        SELECT Ptl_Id
        FROM acce_tbpantallas_porroles
        WHERE Rol_Id = p_Rol_Id
    );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRoles_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRoles_Actualizar`(
    IN p_PaR_Id INT,
    IN p_Ptl_Id INT,
    IN p_Rol_Id INT,
    IN p_PaR_Modifica INT
)
BEGIN
    UPDATE Acce_tbPantallas_PorRoles
    SET Ptl_Id = p_Ptl_Id,
        Rol_Id = p_Rol_Id,
        PaR_Modifica = p_PaR_Modifica,
        PaR_FechaModificacion = CURDATE()
    WHERE PaR_Id = p_PaR_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRoles_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRoles_Detalle`(IN p_PaR_Id INT)
BEGIN
    SELECT * FROM Acce_tbPantallas_PorRoles WHERE PaR_Id = p_PaR_Id AND PaR_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRoles_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRoles_Eliminar`(IN rol_id INT, IN ptl_id INT)
BEGIN
    DELETE FROM acce_tbpantallas_porroles
    WHERE Rol_Id = rol_id AND Ptl_Id = ptl_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRoles_EliminarPorRol` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRoles_EliminarPorRol`(
    IN p_Rol_Id INT
)
BEGIN
    DELETE FROM acce_tbpantallas_porroles 
    WHERE Rol_Id = p_Rol_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRoles_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRoles_Insertar`(
IN rol_id INT, 
IN ptl_id INT
)
BEGIN
    INSERT INTO acce_tbpantallas_porroles (Rol_Id, Ptl_Id)
    VALUES (rol_id, ptl_id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRoles_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRoles_Listar`(IN rolId INT)
BEGIN
    SELECT p.Ptl_Id, p.Ptl_Descripcion 
    FROM acce_tbpantallas_porroles pr
    JOIN acce_tbpantallas p ON pr.Ptl_Id = p.Ptl_Id
    WHERE pr.Rol_Id = rolId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_PantallasPorRol_buscar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_PantallasPorRol_buscar`(In Rol_Id INT)
BEGIN
    SELECT 
        PaR_Id,
        Ptl_Id,
        paro.Rol_Id,
        Rol_Descripcion,
		'SI' AS Agregado 
    FROM 
         acce_tbpantallas_porroles AS paro
        JOIN acce_tbroles AS r on paro.Rol_Id = r.Rol_Id
    WHERE
        paro.Rol_Id = @Rol_Id ;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Pantallas_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Pantallas_Listar`()
BEGIN
    SELECT Ptl_Id, Ptl_Descripcion, Ptl_Creacion, Ptl_FechaCreacion, Ptl_Modifica, Ptl_FechaModificacion, Ptl_Estado
    FROM acce_tbpantallas
    WHERE Ptl_Estado = 1
    ORDER BY Ptl_Descripcion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Rol_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Rol_Actualizar`(
    IN p_Rol_Id INT,
    IN p_Rol_Descripcion VARCHAR(255)
)
BEGIN
    UPDATE acce_tbroles 
    SET Rol_Descripcion = p_Rol_Descripcion
    WHERE Rol_Id = p_Rol_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Rol_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Rol_Detalle`(IN p_Rol_ID INT)
BEGIN
    SELECT * FROM Acce_tbRoles WHERE Rol_ID = p_Rol_ID AND Rol_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Rol_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Rol_Eliminar`(IN p_Rol_ID INT)
BEGIN
    UPDATE Acce_tbRoles
    SET Rol_Estado = 0
    WHERE Rol_ID = p_Rol_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Rol_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Rol_Insertar`(
	IN rol_descripcion VARCHAR(50), 
    IN rol_creacion INT, 
    IN rol_fecha_creacion DATETIME, 
    OUT rol_id INT
)
BEGIN
    INSERT INTO acce_tbroles (Rol_Descripcion, Rol_Creacion, Rol_FechaCreacion, Rol_Estado)
    VALUES (rol_descripcion, rol_creacion, rol_fecha_creacion,1);
    
    SET rol_id = LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Rol_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Rol_Listar`()
BEGIN
    SELECT * FROM Acce_tbRoles WHERE Rol_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Sedes_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Sedes_Cantidad`()
BEGIN
SELECT count(Sed_Id) cantidadSedes FROM dbgruporac.vent_tbsedes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Sedes_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Sedes_Listar`()
BEGIN
    SELECT * FROM Vent_tbSedes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Usuarios_Detalles` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Usuarios_Detalles`(IN Usua_Id INT)
BEGIN
    SELECT 
        u.Usu_ID,
        u.Usu_Usua,
        u.Usu_Contra,
        u.Usu_Admin,
        CASE WHEN u.Usu_Admin = 1 THEN 'Admin' ELSE 'Empleado' END AS Admin,
        e.Empl_Id,
        CONCAT(e.Empl_Nombre, ' ', e.Empl_Apellido) AS Nombre_Completo_2,
        r.Rol_Descripcion,
        r.Rol_Id,
        u_cre.Usu_Usua AS Usuario_Creador,
        u_modi.Usu_Usua AS Usuario_Modificador,
        u.Usu_Fecha_Creacion,
        u.Usu_Fecha_Modifica
    FROM acce_tbusuarios u
    INNER JOIN acce_tbroles r ON r.Rol_Id = u.Rol_Id
    INNER JOIN gral_tbempleados e ON e.Empl_Id = u.Empl_Id
    LEFT JOIN acce_tbusuarios u_cre ON u_cre.Usu_ID = u.Usu_Usu_ID_Cre
    LEFT JOIN acce_tbusuarios u_modi ON u_modi.Usu_ID = u.Usu_Usu_ID_Modi
    WHERE u.Usu_ID = Usua_Id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Usuarios_EnviarCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Usuarios_EnviarCorreo`(
    IN p_UsuarioCorreo VARCHAR(50)
)
BEGIN
    SELECT 
        U.Usu_Id,
        U.Usu_Usua AS Usua_Usuario,
        E.Empl_Correo AS correo
    FROM acce_tbusuarios U
    LEFT JOIN gral_tbempleados E ON U.Empl_Id = E.Empl_Id
    WHERE U.Usu_Usua = p_UsuarioCorreo OR E.Empl_Correo = p_UsuarioCorreo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Usuarios_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Usuarios_Insertar`(
    IN p_Usu_Usua VARCHAR(30),
    IN p_Usu_Contra TEXT,
    IN p_Usu_Admin BOOLEAN,
    IN p_Rol_Id INT,
    IN p_Empl_Id INT,
    IN p_Usu_UsuCre INT,
    IN p_Usu_FechaCreacion DATE
)
BEGIN
    DECLARE estadoActual INT DEFAULT NULL;
    DECLARE exit_code INT DEFAULT 0;
    DECLARE exit_msg TEXT DEFAULT '';

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Capturar información del error
        GET DIAGNOSTICS CONDITION 1
            exit_code = MYSQL_ERRNO,
            exit_msg = MESSAGE_TEXT;
        
        -- Guardar el mensaje de error en la tabla error_logs
        INSERT INTO error_logs (error_code, error_message)
        VALUES (exit_code, exit_msg);
        
        -- Devolver 0 en caso de error
        SELECT 0 AS Result;
    END;

    -- Registro de valores recibidos
    INSERT INTO log_values (Usu_Usua, Usu_Admin) VALUES (p_Usu_Usua, p_Usu_Admin);

    -- Paso 1: Busca el estado actual del usuario
    SELECT Usu_Estado INTO estadoActual FROM acce_tbusuarios WHERE Usu_Usua = p_Usu_Usua;

    -- Paso 2: Verifica el estado actual
    IF estadoActual IS NOT NULL THEN
        IF estadoActual = 0 THEN
            -- Paso 3: Actualiza el estado del usuario
            UPDATE acce_tbusuarios
            SET Usu_Estado = 1
            WHERE Usu_Usua = p_Usu_Usua;

            -- Devuelve 1 para indicar éxito en la actualización
            SELECT 1 AS Result;
        ELSE
            -- Si el estado es 1, no hacer nada, sólo devolver 0
            SELECT 0 AS Result; -- No es necesario actualizar
        END IF;
    ELSE
        -- Paso 4: Inserta un nuevo usuario con estado 1 por defecto
        INSERT INTO acce_tbusuarios (
            Usu_Usua,
            Usu_Contra,
            Usu_Admin,
            Rol_Id,
            Empl_Id,
            Usu_Usu_ID_Cre,
            Usu_Fecha_Creacion,
            Usu_Estado
        )
        VALUES (
            p_Usu_Usua,
            SHA2(p_Usu_Contra, 512),
            p_Usu_Admin,
            p_Rol_Id,
            p_Empl_Id,
            p_Usu_UsuCre,
            p_Usu_FechaCreacion,
            1
        );

        -- Devuelve 1 para indicar éxito en la inserción
        SELECT 1 AS Result;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Usuarios_Mostrar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Usuarios_Mostrar`()
BEGIN
    SELECT 
        u.Usu_ID, 
        u.Usu_Usua,
        u.Usu_Admin,
        CASE 
            WHEN u.Usu_Admin = 0 THEN 'NO' 
            ELSE 'SI' 
        END AS Admin,
        r.Rol_Descripcion,
        emp.Empl_Id,
        CONCAT(emp.Empl_Nombre, ' ', emp.Empl_Apellido) AS Empl_Nombre_Completo
    FROM acce_tbusuarios u
    LEFT JOIN acce_tbroles r ON u.Rol_Id = r.Rol_Id
    LEFT JOIN gral_tbempleados emp ON u.Empl_Id = emp.Empl_Id
    WHERE u.Usu_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Usuario_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuario_Actualizar`(
    IN p_Usu_ID INT,
    IN p_Usu_Usua VARCHAR(50),
    IN p_Usu_Admin BOOLEAN,
    IN p_Rol_Id INT, -- Agregamos el parámetro para Rol_Id
    IN p_Empl_Id INT,
    IN p_Usu_Usu_ID_Modi INT,
    IN p_Usu_Fecha_Modifica DATE
)
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejo de errores: devuelve 0 en caso de error
        SELECT 0;
    END;
    UPDATE acce_tbusuarios
    SET 
        Usu_Usua = p_Usu_Usua,
        Usu_Admin = p_Usu_Admin,
        Rol_Id = p_Rol_Id, -- Actualizamos el Rol_Id
        Empl_Id = p_Empl_Id,
        Usu_Usu_ID_Modi = p_Usu_Usu_ID_Modi,
        Usu_Fecha_Modifica = p_Usu_Fecha_Modifica
    WHERE Usu_ID = p_Usu_ID;
        -- Devolución exitosa
    SELECT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Usuario_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuario_Eliminar`(IN p_Usu_ID INT)
BEGIN
    UPDATE Acce_tbUsuarios
    SET Usu_Estado = 0
    WHERE Usu_ID = p_Usu_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Usuario_Reestablecer` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Usuario_Reestablecer`(
    IN p_usua_Codigo VARCHAR(255),  -- Cambio a Usua_Codigo en lugar de usua_id
    IN p_usua_Contraseña TEXT,
    IN p_usua_FechaModificacion DATE
)
BEGIN
    DECLARE exit handler for sqlexception
    BEGIN
        -- Imprime el mensaje de error
        GET DIAGNOSTICS CONDITION 1 
            @p1 = RETURNED_SQLSTATE, 
            @p2 = MESSAGE_TEXT;
        SELECT @p1 AS 'SQLSTATE', @p2 AS 'MESSAGE';
        SELECT 0;  -- Indica fallo
        ROLLBACK;
    END;

    -- Desactivar modo de actualización segura
    SET SQL_SAFE_UPDATES = 0;

    START TRANSACTION;

    -- Imprimir valores de entrada
    SELECT 'Valores de entrada:', p_usua_Codigo, p_usua_Contraseña, p_usua_FechaModificacion;

    -- Verificar existencia del código de usuario
    IF (SELECT COUNT(*) FROM acce_tbusuarios WHERE Usu_Codigo = p_usua_Codigo) = 0 THEN
        SELECT 'El código de usuario no existe' AS 'ERROR';
        ROLLBACK;
        SELECT 0;  -- Indica fallo
    ELSE
        UPDATE acce_tbusuarios
        SET Usu_Contra = SHA2(p_usua_Contraseña, 512),
            Usu_Fecha_Modifica = p_usua_FechaModificacion
        WHERE Usu_Codigo = p_usua_Codigo;

        IF ROW_COUNT() = 0 THEN
            SELECT 'No rows updated' AS 'INFO';
            ROLLBACK;
            SELECT 0;  -- Indica fallo
        ELSE
            COMMIT;
            SELECT 1;  -- Indica éxito
        END IF;
    END IF;

    -- Reactivar modo de actualización segura
    SET SQL_SAFE_UPDATES = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VehiculosPorModelos_Reporte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VehiculosPorModelos_Reporte`(
    IN Mod_Descripcion VARCHAR(100), 
    IN fecha_inicio DATE, 
    IN fecha_fin DATE
)
BEGIN
    SELECT 
        Veh_Placa, 
        Veh_Color, 
        Veh_Stock, 
        FORMAT((Veh_Precio), 2) Veh_Precio, 
        VE.Mod_Id, 
        CASE 
            WHEN Mod_Descripcion = 'Mostrar todo' THEN MO.Mod_Descripcion
            ELSE Mod_Descripcion
        END AS Mod_Descripcion,
        Mar_Descripcion
    FROM 
        dbgruporac.vent_tbvehiculos VE 
        INNER JOIN gral_tbmodelos MO ON MO.Mod_Id = VE.Mod_Id
        INNER JOIN gral_tbmarcas MA ON MA.Mar_Id = MO.Mar_Id
    WHERE 
        (MO.Mod_Descripcion = Mod_Descripcion OR Mod_Descripcion = 'Mostrar todo')
        AND Veh_Fecha_Creacion BETWEEN fecha_inicio AND fecha_fin;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Vehiculos_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Vehiculos_Cantidad`()
BEGIN
SELECT count(Veh_Placa) cantidadVehiculos FROM dbgruporac.vent_tbvehiculos;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Vehiculos_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Vehiculos_Detalle`(IN p_Veh_Placa VARCHAR(7))
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 'Error al listar los vehículos con detalles' AS ErrorMensaje;
    END;

    SELECT 
        v.Veh_Placa,
        v.Veh_Color,
        m.Mod_Descripcion AS Modelo,
        YEAR(m.Mod_Año) AS Año,
        r.Mar_Descripcion AS Marca,
        v.Veh_Precio AS Precio
    FROM 
        dbgruporac.vent_tbvehiculos v
    JOIN 
        dbgruporac.gral_tbmodelos m ON v.Mod_Id = m.Mod_Id
    JOIN 
        dbgruporac.gral_tbmarcas r ON m.Mar_Id = r.Mar_Id
    WHERE 
        v.Veh_Placa = p_Veh_Placa;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Vehiculos_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Vehiculos_Insertar`(
    IN v_Veh_Placa VARCHAR(10),
    IN v_Veh_Color VARCHAR(60),
    IN v_Veh_Imagen VARCHAR(300),
    IN v_Veh_Precio VARCHAR(100),
    IN v_Mod_Id INT,
    IN v_Veh_Creacion INT
)
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        -- Manejar errores
        ROLLBACK;
        SELECT 0 AS Result;
    END;

    START TRANSACTION;

    
    INSERT INTO vent_tbvehiculos (Veh_Placa, Veh_Color, Veh_Imagen, Veh_Precio, Mod_Id, Veh_Creacion, Veh_Fecha_Creacion, Veh_Estado)
    VALUES (v_Veh_Placa, v_Veh_Color, v_Veh_Imagen, v_Veh_Precio, v_Mod_Id, v_Veh_Creacion, CURDATE(), 1);
    

    COMMIT;
    SELECT 1 AS Result;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Vehiculos_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Vehiculos_Listar`()
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 'Error al listar los vehículos con detalles' AS ErrorMensaje;
    END;

    SELECT 
        v.Veh_Placa,
        v.Veh_Color,
        m.Mod_Descripcion AS Modelo,
        YEAR(m.Mod_Año) AS Año,
        r.Mar_Descripcion AS Marca,
        v.Veh_Precio AS Precio
    FROM 
        dbgruporac.vent_tbvehiculos v
    JOIN 
        dbgruporac.gral_tbmodelos m ON v.Mod_Id = m.Mod_Id
    JOIN 
        dbgruporac.gral_tbmarcas r ON m.Mar_Id = r.Mar_Id
    WHERE 
        v.Veh_Estado = 1;  
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Vehiculos_Top5` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Vehiculos_Top5`()
BEGIN
SELECT MA.Mar_Descripcion, COUNT(VD.Veh_Placa) AS cantidadVendida
FROM dbgruporac.vent_tbventas VENT 
INNER JOIN vent_tbventasdetalles VD ON VD.Vnt_ID = VENT.Vnt_ID
INNER JOIN vent_tbvehiculos VEH ON VEH.Veh_Placa = VD.Veh_Placa
INNER JOIN dbgruporac.gral_tbmodelos MO ON MO.Mod_Id = VEH.Mod_Id
INNER JOIN dbgruporac.gral_tbmarcas MA ON MA.Mar_Id = MO.Mar_Id
GROUP BY MA.Mar_Descripcion
ORDER BY cantidadVendida DESC
LIMIT 5;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VentasCantidad_FiltroFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VentasCantidad_FiltroFecha`(IN fecha_inicio DATE, IN fecha_fin DATE)
BEGIN
    SELECT 
        MONTH(Vdt_Fecha_Creacion) AS Mes, 
        YEAR(Vdt_Fecha_Creacion) AS Anio, 
        COUNT(*) AS CantidadVentas
    FROM 
        vent_tbventasdetalles
    WHERE 
        Vdt_Fecha_Creacion BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        Anio, Mes
    ORDER BY 
        Anio, Mes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_VentasDetalles_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_VentasDetalles_Eliminar`(
    IN p_Vnt_ID INT,
    IN p_Sed_ID INT,
    IN p_Prod_Nombre VARCHAR(255)
)
BEGIN
    DECLARE v_Prod_ID INT;
    DECLARE v_Vdt_Cantidad INT;
    DECLARE v_Vdt_Dif INT;
    DECLARE done INT DEFAULT FALSE;
    DECLARE cursor_ventas CURSOR FOR
        SELECT vd.Prod_ID, vd.Vdt_Cantidad, vd.Vdt_Dif
        FROM Vent_tbVentasDetalles vd
        JOIN Gral_tbProductos p ON p.Prod_ID = vd.Prod_ID
        WHERE vd.Vnt_ID = p_Vnt_ID AND p.Prd_Nombre = p_Prod_Nombre;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cursor_ventas;

    FETCH cursor_ventas INTO v_Prod_ID, v_Vdt_Cantidad, v_Vdt_Dif;

    WHILE NOT done DO
        UPDATE Gral_tbProductos
        SET Prd_Stock = Prd_Stock + v_Vdt_Cantidad
        WHERE Prod_ID = v_Prod_ID
          AND Sed_ID = p_Sed_ID
          AND Prd_Dif = v_Vdt_Dif;

        FETCH cursor_ventas INTO v_Prod_ID, v_Vdt_Cantidad, v_Vdt_Dif;
    END WHILE;

    CLOSE cursor_ventas;

    DELETE FROM Vent_tbVentasDetalles
    WHERE Vnt_ID = p_Vnt_ID
      AND Prod_ID IN (SELECT Prod_ID FROM Gral_tbProductos WHERE Prd_Nombre = p_Prod_Nombre);

    SELECT 1 AS Resultado;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_VentasDetalles_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_VentasDetalles_Insertar`(
    IN p_Vdt_Dif INT,
    IN p_Prod_Nombre VARCHAR(255),
    IN p_Vdt_Cantidad INT,
    IN p_Vnt_ID INT,
    IN p_Sed_ID INT,
    OUT p_StockFinal INT
)
BEGIN
    DECLARE v_CantidadRestante INT DEFAULT p_Vdt_Cantidad;
    DECLARE v_TotalStock INT;
    DECLARE v_Prod_ID INT;
    DECLARE v_stockActual INT;
    DECLARE v_cantidadAtransferir INT;
    DECLARE done INT DEFAULT FALSE;
    DECLARE stock_cursor CURSOR FOR
        SELECT Prod_ID, Prd_Stock
        FROM Gral_tbProductos
        WHERE Sed_ID = p_Sed_ID
          AND Prd_Dif = p_Vdt_Dif
          AND Prd_Nombre = p_Prod_Nombre
        ORDER BY Prd_Stock DESC;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    SELECT SUM(Prd_Stock)
    INTO v_TotalStock
    FROM Gral_tbProductos
    WHERE Sed_ID = p_Sed_ID
      AND Prd_Dif = p_Vdt_Dif
      AND Prd_Nombre = p_Prod_Nombre;

    IF v_TotalStock IS NULL OR v_TotalStock < p_Vdt_Cantidad THEN
        SET p_StockFinal = IFNULL(v_TotalStock, 0);
        SELECT 0 AS Resultado;
    ELSE
        OPEN stock_cursor;

        FETCH stock_cursor INTO v_Prod_ID, v_stockActual;

        WHILE v_CantidadRestante > 0 AND NOT done DO
            IF v_stockActual IS NOT NULL THEN
                SET v_cantidadAtransferir = CASE 
                    WHEN v_stockActual > v_CantidadRestante THEN v_CantidadRestante
                    ELSE v_stockActual
                END;

                UPDATE Gral_tbProductos
                SET Prd_Stock = Prd_Stock - v_cantidadAtransferir
                WHERE Prod_ID = v_Prod_ID
                  AND Sed_ID = p_Sed_ID
                  AND Prd_Dif = p_Vdt_Dif;

                INSERT INTO Vent_tbVentasDetalles (Vdt_Dif, Prod_ID, Vdt_Cantidad, Vnt_ID)
                VALUES (p_Vdt_Dif, v_Prod_ID, v_cantidadAtransferir, p_Vnt_ID);

                SET v_CantidadRestante = v_CantidadRestante - v_cantidadAtransferir;
            END IF;

            FETCH stock_cursor INTO v_Prod_ID, v_stockActual;
        END WHILE;

        CLOSE stock_cursor;

        SET p_StockFinal = 0;
        SELECT 1 AS Resultado;
    END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_VentasDetalle_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_VentasDetalle_Listar`(
    IN p_Vnt_ID INT
)
BEGIN
    SELECT 
        vd.Vdt_ID,
        vd.Veh_Placa,
        veh.Veh_Color,
        model.Mod_Descripcion,
        YEAR(model.Mod_Año) AS Mod_Año,
        marc.Mar_Descripcion,
        vd.Vdt_PrecioVenta
    FROM 
        vent_tbventasdetalles vd
    LEFT JOIN 
        vent_tbvehiculos veh ON vd.Veh_Placa = veh.Veh_Placa
    LEFT JOIN
        gral_tbmodelos model ON veh.Mod_Id = model.Mod_Id
    LEFT JOIN 
        gral_tbmarcas marc ON model.Mar_Id = marc.Mar_Id
    WHERE 
        vd.Vnt_ID = p_Vnt_ID AND 
        vd.Vdt_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VentasEmpleadosCantidad_FiltroFecha` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VentasEmpleadosCantidad_FiltroFecha`(IN fecha_inicio DATE, IN fecha_fin DATE)
BEGIN
    SELECT 
        CONCAT(empl_nombre, ' ', empl_Apellido) AS emp_nombre, 
        Vdt_Fecha_Creacion, 
        COUNT(VD.vdt_Id) AS cantidadVentas
    FROM 
        dbgruporac.vent_tbventas VENT 
    INNER JOIN 
        vent_tbventasdetalles VD ON VD.Vnt_ID = VENT.Vnt_ID
    INNER JOIN 
        gral_tbempleados EMP ON EMP.Empl_ID = VENT.Emp_ID
    WHERE 
        VD.Vdt_Fecha_Creacion BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        emp_nombre
    ORDER BY 
        cantidadVentas DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VentasEmpleados_Mes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VentasEmpleados_Mes`()
BEGIN
    SELECT 
        CONCAT(empl_nombre, ' ', empl_Apellido) AS emp_nombre, 
        Vdt_Fecha_Creacion, 
        COUNT(VD.vdt_Id) AS cantidadVentas
    FROM 
        dbgruporac.vent_tbventas VENT 
    INNER JOIN 
        vent_tbventasdetalles VD ON VD.Vnt_ID = VENT.Vnt_ID
    INNER JOIN 
        gral_tbempleados EMP ON EMP.Empl_ID = VENT.Emp_ID
    WHERE 
        MONTH(VD.Vdt_Fecha_Creacion) = MONTH(CURDATE()) 
        AND YEAR(VD.Vdt_Fecha_Creacion) = YEAR(CURDATE())
    GROUP BY 
        emp_nombre
    ORDER BY 
        cantidadVentas DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VentasMes_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VentasMes_Cantidad`()
BEGIN
    SELECT 
        MONTH(Vdt_Fecha_Creacion) AS Mes, 
        YEAR(Vdt_Fecha_Creacion) AS Anio, 
        COUNT(*) AS CantidadVentas
    FROM 
        vent_tbventasdetalles
    GROUP BY 
        Anio, Mes
    ORDER BY 
        Anio, Mes;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VentasPorCiudad_Reporte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VentasPorCiudad_Reporte`(
    IN Ciu_Descripcion VARCHAR(100), 
    IN fecha_inicio DATE, 
    IN fecha_fin DATE
)
BEGIN
    SELECT 
        VENT.Vnt_ID, 
        Vnt_Fecha, 
        VENT.Emp_ID, 
        CONCAT(empl_nombre, ' ', empl_Apellido) emp_nombre,
        Sed_Descripcion, 
        CASE 
            WHEN Ciu_Descripcion = 'Mostrar todo' THEN CIU.Ciu_Descripcion
            ELSE Ciu_Descripcion
        END AS Ciu_Descripcion,
        CONCAT(cli_nombre, ' ', cli_Apellido) cli_nombre, 
        FORMAT(Vdt_PrecioVenta, 2) Vdt_PrecioVenta, 
        FORMAT((Vdt_PrecioVenta), 2) subtotal,
        FORMAT((Vdt_PrecioVenta * Imp_ISV), 2) total
    FROM 
        dbgruporac.vent_tbventas VENT 
        INNER JOIN vent_tbventasdetalles VD ON VD.Vnt_ID = VENT.Vnt_ID
        INNER JOIN gral_tbempleados EMP ON EMP.empl_ID = VENT.Emp_ID
        INNER JOIN gral_tbclientes CLI ON CLI.cli_ID = VENT.cli_ID
        INNER JOIN vent_tbsedes SED ON SED.Sed_ID = VENT.Sed_ID
        INNER JOIN gral_tbciudades CIU ON CIU.Ciu_ID = SED.Ciu_ID
        INNER JOIN vent_tbimpuestos IMP ON IMP.Imp_ID = VENT.Imp_ID
    WHERE 
        (CIU.Ciu_Descripcion = Ciu_Descripcion OR Ciu_Descripcion = 'Mostrar todo')
        AND Vdt_Fecha_Creacion BETWEEN fecha_inicio AND fecha_fin;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_VentasPorEmpleado_Reporte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_VentasPorEmpleado_Reporte`(
    IN empl_DNI VARCHAR(100), 
    IN fecha_inicio DATE, 
    IN fecha_fin DATE
)
BEGIN
    SELECT 
        VENT.Vnt_ID, 
        Vnt_Fecha, 
        VENT.Emp_ID, 
        CONCAT(empl_nombre, ' ', empl_Apellido) emp_nombre, 
        empl_DNI,
        Sed_Descripcion, 
        Ciu_Descripcion, 
        CONCAT(cli_nombre, ' ', cli_Apellido) cli_nombre,
        FORMAT((Vdt_PrecioVenta), 2) subtotal,
        FORMAT((Vdt_PrecioVenta) - (Vdt_PrecioVenta * Imp_ISV), 2) total
    FROM 
        dbgruporac.vent_tbventas VENT 
        INNER JOIN vent_tbventasdetalles VD ON VD.Vnt_ID = VENT.Vnt_ID
        INNER JOIN gral_tbempleados EMP ON EMP.empl_ID = VENT.Emp_ID
        INNER JOIN gral_tbclientes CLI ON CLI.cli_ID = VENT.cli_ID
        INNER JOIN vent_tbsedes SED ON SED.Sed_ID = VENT.Sed_ID
        INNER JOIN gral_tbciudades CIU ON CIU.Ciu_ID = SED.Ciu_ID
        INNER JOIN vent_tbimpuestos IMP ON IMP.Imp_ID = VENT.Imp_ID
    WHERE 
        (EMPL.Empl_DNI = empl_DNI OR empl_DNI = 'Mostrar todo')
        AND Vnt_Fecha BETWEEN fecha_inicio AND fecha_fin;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ventas_Actualizar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ventas_Actualizar`(
    IN p_Vnt_ID INT,
    IN p_Vnt_Fecha DATETIME,
    IN p_Emp_ID INT,
    IN p_Mpg_ID INT,
    IN p_Sed_ID INT,
    IN p_Des_ID INT,
    IN p_Cli_ID INT,
    IN p_Vnt_Usu_ID_Modi INT
)
BEGIN
    UPDATE Vent_tbVentas
    SET 
        Vnt_Fecha = p_Vnt_Fecha,
        Emp_ID = p_Emp_ID,
        Mpg_ID = p_Mpg_ID,
        Sed_ID = p_Sed_ID,
        Des_ID = p_Des_ID,
        Cli_ID = p_Cli_ID,
        Vnt_Usu_ID_Modi = p_Vnt_Usu_ID_Modi,
        Vnt_Fecha_Modifica = CURDATE()
    WHERE 
        Vnt_ID = p_Vnt_ID AND Vnt_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `SP_Ventas_Cantidad` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Ventas_Cantidad`()
BEGIN
SELECT count(Vdt_ID) cantidadVentas FROM dbgruporac.vent_tbventasdetalles;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ventas_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ventas_Detalle`(
    IN p_Vnt_ID INT
)
BEGIN
    SELECT * FROM Vent_tbVentas WHERE Vnt_ID = p_Vnt_ID AND Vnt_Estado = 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ventas_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ventas_Eliminar`(
    IN p_Vnt_ID INT,
    IN p_Vnt_Usu_ID_Modi INT
)
BEGIN
    UPDATE Vent_tbVentas
    SET 
        Vnt_Estado = 0,
        Vnt_Usu_ID_Modi = p_Vnt_Usu_ID_Modi,
        Vnt_Fecha_Modifica = CURDATE()
    WHERE 
        Vnt_ID = p_Vnt_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ventas_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ventas_Insertar`(
    IN p_Vnt_Fecha DATETIME,
    IN p_Emp_ID INT,
    IN p_Mpg_ID INT,
    IN p_Sed_ID INT,
    IN p_Des_ID INT,
    IN p_Cli_ID INT,
    IN p_Imp_ID INT,
    IN p_Vnt_Usu_ID_Cre INT,
    OUT p_Vnt_ID INT  
)
BEGIN
    INSERT INTO Vent_tbVentas (
        Vnt_Fecha, 
        Emp_ID, 
        Mpg_ID, 
        Sed_ID, 
        Des_ID, 
        Cli_ID, 
        Imp_ID,
        Vnt_Usu_ID_Cre, 
        Vnt_Fecha_Creacion, 
        Vnt_Estado
    )
    VALUES (
        p_Vnt_Fecha, 
        p_Emp_ID, 
        p_Mpg_ID, 
        p_Sed_ID, 
        p_Des_ID, 
        p_Cli_ID,
        1,
        p_Vnt_Usu_ID_Cre, 
        CURDATE(), 
        1
    );

    SET p_Vnt_ID = LAST_INSERT_ID();
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Ventas_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Ventas_Listar`()
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        -- Si ocurre una excepción, mostramos un mensaje de error.
        SELECT 'Error al listar las ventas' AS ErrorMensaje;
    END;

    -- Ejecutamos la consulta para listar las ventas con los detalles requeridos.
    SELECT 
        v.Vnt_ID,
        v.Vnt_Fecha,
        CONCAT(c.Cli_Nombre, ' ', c.Cli_Apellido) AS Cliente,
        mp.Mpg_Descripcion AS Metodo_Pago,
        s.Sed_Descripcion AS Sede
    FROM 
        dbgruporac.vent_tbventas v
    JOIN 
        dbgruporac.gral_tbclientes c ON v.Cli_ID = c.Cli_Id
    JOIN 
        dbgruporac.vent_tbmetodospago mp ON v.Mpg_ID = mp.Mpg_ID
    JOIN 
        dbgruporac.vent_tbsedes s ON v.Sed_ID = s.Sed_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Venta_Detalle` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Venta_Detalle`(
    IN p_Vnt_ID INT
)
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 0;
    END;

    SELECT 
        vd.Veh_Placa,
        v.Veh_Color,
        m.Mod_Descripcion AS Modelo,
        r.Mar_Descripcion AS Marca,
        YEAR(m.Mod_Año) AS Año,
        vd.Vdt_PrecioVenta AS Precio
    FROM 
        dbgruporac.vent_tbventasdetalles vd
    JOIN 
        dbgruporac.vent_tbvehiculos v ON vd.Veh_Placa = v.Veh_Placa
    JOIN 
        dbgruporac.gral_tbmodelos m ON v.Mod_Id = m.Mod_Id
    JOIN 
        dbgruporac.gral_tbmarcas r ON m.Mar_Id = r.Mar_Id
    WHERE 
        vd.Vnt_ID = p_Vnt_ID;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Venta_Detalle_Eliminar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Venta_Detalle_Eliminar`(
    IN p_Vdt_ID INT
)
BEGIN
    DECLARE v_Veh_Placa VARCHAR(7);
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 1;
        ROLLBACK;
    END;

    START TRANSACTION;

    SELECT Veh_Placa INTO v_Veh_Placa
    FROM vent_tbventasdetalles
    WHERE Vdt_ID = p_Vdt_ID
    FOR UPDATE;

    IF v_Veh_Placa IS NOT NULL THEN
        DELETE FROM vent_tbventasdetalles
        WHERE Vdt_ID = p_Vdt_ID;

        UPDATE vent_tbvehiculos
        SET Veh_Estado = 1
        WHERE Veh_Placa = v_Veh_Placa;
        
        COMMIT;

        SELECT 1;
    ELSE
        ROLLBACK;
        SELECT 0;
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_Venta_Detalle_Insertar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Venta_Detalle_Insertar`(
    IN p_Vnt_ID INT,
    IN p_Vdt_PrecioVenta DECIMAL(19,4),
    IN p_Veh_Placa VARCHAR(7),
    IN p_Vdt_Usu_ID_Cre INT
)
BEGIN
    DECLARE exit handler for SQLEXCEPTION
    BEGIN
        SELECT 0;
        ROLLBACK;
    END;

    START TRANSACTION;

  
    INSERT INTO `vent_tbventasdetalles` (
        Vnt_ID,
        Vdt_PrecioVenta,
        Veh_Placa,
        Vdt_Usu_ID_Cre,
        Vdt_Fecha_Creacion,
        Vdt_Estado
    ) VALUES (
        p_Vnt_ID,
        p_Vdt_PrecioVenta,
        p_Veh_Placa,
        p_Vdt_Usu_ID_Cre,
        NOW(),
        1  
    );

    UPDATE `vent_tbvehiculos`
    SET `Veh_Estado` = 0
    WHERE `Veh_Placa` = p_Veh_Placa;

    COMMIT;

    SELECT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-21 10:59:28
