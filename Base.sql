-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: dbsistemaesmeralda
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
  `Pant_Id` int(11) NOT NULL,
  `Pant_Descripcion` varchar(60) NOT NULL,
  `Pant_UsuarioCreacion` int(11) DEFAULT NULL,
  `Pant_FechaCreacion` datetime DEFAULT NULL,
  `Pant_UsuarioModificacion` int(11) DEFAULT NULL,
  `Pant_FechaModificacion` datetime DEFAULT NULL,
  `Pant_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Pant_Id`),
  KEY `tbPantallas_tbUsuarios_UsuarioCreacion` (`Pant_UsuarioCreacion`),
  KEY `tbPantallas_tbUsuarios_UsuarioModificacion` (`Pant_UsuarioModificacion`),
  CONSTRAINT `tbPantallas_tbUsuarios_Pant_UsuarioCreacion` FOREIGN KEY (`Pant_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbPantallas_tbUsuarios_Pant_UsuarioModificacion` FOREIGN KEY (`Pant_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbPantallas_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Pant_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbPantallas_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Pant_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbpantallas`
--

LOCK TABLES `acce_tbpantallas` WRITE;
/*!40000 ALTER TABLE `acce_tbpantallas` DISABLE KEYS */;
INSERT INTO `acce_tbpantallas` VALUES (1,'Usuarios',NULL,NULL,NULL,NULL,1),(2,'Roles',NULL,NULL,NULL,NULL,1),(3,'Cargos',NULL,NULL,NULL,NULL,1),(4,'Categorias',NULL,NULL,NULL,NULL,1),(5,'Clientes',NULL,NULL,NULL,NULL,1),(6,'Departamentos',NULL,NULL,NULL,NULL,1),(7,'Estados Civiles',NULL,NULL,NULL,NULL,1),(9,'Marcas',NULL,NULL,NULL,NULL,1),(10,'Materiales',NULL,NULL,NULL,NULL,1),(12,'Municipios',NULL,NULL,NULL,NULL,1),(13,'Proveedores',NULL,NULL,NULL,NULL,1),(14,'Sucursales',NULL,NULL,NULL,NULL,1),(15,'Facturas',NULL,NULL,NULL,NULL,1),(16,'Joyas',NULL,NULL,NULL,NULL,1),(17,'Maquillajes',NULL,NULL,NULL,NULL,1),(18,'Facturas de Compra',NULL,NULL,NULL,NULL,1),(19,'Reportes',NULL,NULL,NULL,NULL,1),(20,'Control de stock',NULL,NULL,NULL,NULL,1),(21,'Ventas por empleado',NULL,NULL,NULL,NULL,1),(22,'Ventas por mes',NULL,NULL,NULL,NULL,1),(23,'Productos vendidos',NULL,NULL,NULL,NULL,1),(24,'Ventas Anuales',NULL,NULL,NULL,NULL,1),(25,'Ventas mayoristas',NULL,NULL,NULL,NULL,1),(26,'Mesuales',NULL,NULL,NULL,NULL,1),(27,'Anuales',NULL,NULL,NULL,NULL,1),(28,'Empleados',NULL,NULL,NULL,NULL,1),(29,'Sucursales',NULL,NULL,NULL,NULL,1),(30,'Reporte de caja',NULL,NULL,NULL,NULL,1),(31,'Transferencias',NULL,NULL,NULL,NULL,1),(32,'Ventas por pago',NULL,NULL,NULL,NULL,1),(33,'Abrir Caja',NULL,NULL,NULL,NULL,1),(34,'Cerrar caja',NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `acce_tbpantallas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acce_tbpantallasporroles`
--

DROP TABLE IF EXISTS `acce_tbpantallasporroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbpantallasporroles` (
  `Paxr_Id` int(11) NOT NULL,
  `Role_Id` int(11) DEFAULT NULL,
  `Pant_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Paxr_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbpantallasporroles`
--

LOCK TABLES `acce_tbpantallasporroles` WRITE;
/*!40000 ALTER TABLE `acce_tbpantallasporroles` DISABLE KEYS */;
INSERT INTO `acce_tbpantallasporroles` VALUES (46,9,3),(47,9,4),(48,9,5),(49,9,6),(50,9,7),(51,9,8),(52,9,9),(53,9,10),(54,9,11),(55,9,12),(56,9,13),(65,0,2),(66,0,13),(67,0,17),(68,0,6),(69,0,9),(94,10,1),(95,10,2),(96,10,5),(97,10,8),(98,10,13),(99,10,17),(100,6,1),(101,6,2),(102,6,15),(103,6,17),(104,2,6),(105,2,5),(110,7,1),(111,7,15),(112,7,17),(113,7,3),(114,7,4),(115,7,5),(116,7,6),(117,7,7),(118,7,8),(119,7,9),(120,7,10),(121,7,11),(122,7,12),(123,7,13),(124,11,3),(125,11,4),(126,11,5),(127,11,6),(128,11,7),(129,11,8),(130,11,9),(131,11,10),(132,11,11),(133,11,12),(134,11,13),(142,12,3),(143,12,5),(144,12,6),(145,12,15),(146,12,17),(147,12,1),(148,12,2),(149,12,4),(150,12,7),(151,12,8),(152,12,9),(153,12,10),(154,12,11),(155,12,12),(156,12,13),(511,1,1),(512,1,2),(513,1,16),(514,1,15),(515,1,17),(516,1,18),(517,1,20),(518,1,21),(519,1,22),(520,1,23),(521,1,24),(522,1,25),(523,1,26),(524,1,27),(525,22,28),(526,22,3),(527,22,4),(528,22,5),(529,22,6),(530,22,7),(531,22,9),(532,22,10),(533,22,12),(534,22,13),(535,23,28),(536,23,3),(537,23,4),(538,23,5),(539,23,6),(540,23,7),(541,23,9),(542,23,10),(543,23,12),(544,23,13),(545,23,16),(546,23,15),(547,23,17),(548,23,18),(549,23,20),(550,23,21),(551,23,22),(552,23,23),(553,23,24),(554,23,25),(555,23,26),(556,23,27),(607,18,16),(608,18,15),(609,18,17),(610,18,18),(670,27,1),(671,27,2),(672,27,28),(673,27,14),(674,27,3),(675,27,4),(676,27,5),(677,27,6),(678,27,7),(679,27,9),(680,27,10),(681,27,12),(682,27,13),(683,27,16),(684,27,31),(685,27,15),(686,27,17),(687,27,18),(688,27,20),(689,27,21),(690,27,22),(691,27,23),(692,27,24),(693,27,25),(694,27,26),(695,27,27),(696,27,30),(1100,28,1),(1101,28,2),(1102,28,28),(1103,28,14),(1104,28,3),(1105,28,4),(1106,28,5),(1107,28,6),(1108,28,7),(1109,28,9),(1110,28,10),(1111,28,12),(1112,28,13),(1113,28,16),(1114,28,31),(1115,28,15),(1116,28,17),(1117,28,18),(1118,28,30),(1119,28,32),(1120,28,20),(1121,28,21),(1122,28,22),(1123,28,23),(1124,28,24),(1125,28,25),(1126,28,26),(1127,28,27),(1128,28,33),(1129,28,34),(1130,30,18),(1131,30,15),(1132,30,16),(1133,31,1),(1134,31,28),(1135,31,2),(1136,31,14),(1137,31,3),(1138,31,4),(1139,31,5),(1140,31,6),(1141,31,7),(1142,31,9),(1143,31,10),(1144,31,12),(1145,31,13),(1146,31,16),(1147,31,31),(1148,31,15),(1149,31,17),(1150,31,18),(1151,31,26),(1152,31,27),(1153,31,30),(1154,31,32),(1155,31,20),(1156,31,21),(1157,31,22),(1158,31,23),(1159,31,24),(1160,31,25),(1161,31,33),(1162,31,34);
/*!40000 ALTER TABLE `acce_tbpantallasporroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acce_tbroles`
--

DROP TABLE IF EXISTS `acce_tbroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbroles` (
  `Role_Id` int(11) NOT NULL,
  `Role_Rol` varchar(60) NOT NULL,
  `Role_UsuarioCreacion` int(11) DEFAULT NULL,
  `Role_FechaCreacion` datetime DEFAULT NULL,
  `Role_UsuarioModificacion` int(11) DEFAULT NULL,
  `Role_FechaModificacion` datetime DEFAULT NULL,
  `Role_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Role_Id`),
  KEY `tbRoles_tbUsuarios_UsuarioCreacion` (`Role_UsuarioCreacion`),
  KEY `tbRoles_tbUsuarios_UsuarioModificacion` (`Role_UsuarioModificacion`),
  CONSTRAINT `tbRoles_tbUsuarios_Role_UsuarioCreacion` FOREIGN KEY (`Role_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbRoles_tbUsuarios_Role_UsuarioModificacion` FOREIGN KEY (`Role_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbRoles_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Role_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbRoles_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Role_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbroles`
--

LOCK TABLES `acce_tbroles` WRITE;
/*!40000 ALTER TABLE `acce_tbroles` DISABLE KEYS */;
INSERT INTO `acce_tbroles` VALUES (1,'Administrador',1,'2024-12-12 00:00:00',1,'2024-05-15 11:09:03',1),(2,'gerente2',1,'2024-12-12 00:00:00',1,'2024-05-07 01:10:31',1),(5,'afafafafsd',1,'2024-05-06 21:29:18',NULL,NULL,1),(6,'Admiiin',1,'2024-05-06 22:05:53',1,'2024-05-07 01:07:35',1),(7,'Supervisor',1,'2024-05-06 22:15:14',1,'2024-05-07 08:49:44',1),(9,'PRUEBA',1,'2024-05-06 23:42:44',NULL,NULL,1),(10,'Administra',1,'2024-05-07 00:25:10',1,'2024-05-07 01:07:22',1),(11,'Mindy',1,'2024-05-07 09:32:24',NULL,NULL,1),(12,'MindyF',1,'2024-05-07 09:32:41',1,'2024-05-07 09:28:06',1),(18,'Prueba',1,'2024-05-15 22:05:01',11,'2024-05-15 23:01:07',1),(19,'Prueba',1,'2024-05-15 22:05:01',NULL,NULL,1),(20,'Pruebaa',2,'2024-05-15 22:14:57',NULL,NULL,1),(21,'PruebaasdAD',2,'2024-05-15 22:19:18',NULL,NULL,1),(22,'PruebaasdAD',2,'2024-05-15 22:20:38',NULL,NULL,1),(23,'PruebaasdAD',2,'2024-05-15 22:20:45',NULL,NULL,1),(27,'PROBANDO',2,'2024-05-15 22:42:37',11,'2024-05-17 14:42:10',1),(28,'Cajera',11,'2024-05-21 13:32:09',2,'2024-05-22 08:07:08',1),(30,'ultimo momento',10,'2024-05-22 13:59:13',NULL,NULL,1),(31,'coso',2,'2024-05-22 16:48:58',NULL,NULL,1);
/*!40000 ALTER TABLE `acce_tbroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acce_tbusuarios`
--

DROP TABLE IF EXISTS `acce_tbusuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acce_tbusuarios` (
  `Usua_Id` int(11) NOT NULL,
  `Usua_Usuario` longtext NOT NULL,
  `Usua_Contraseña` longtext NOT NULL,
  `Usua_Administrador` tinyint(1) NOT NULL,
  `Empl_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL,
  `Usua_UsuarioCreacion` int(11) DEFAULT NULL,
  `Usua_FechaCreacion` datetime DEFAULT NULL,
  `Usua_UsuarioModificacion` int(11) DEFAULT NULL,
  `Usua_FechaModificacion` datetime DEFAULT NULL,
  `Usua_Estado` tinyint(1) DEFAULT 1,
  `Usua_Codigo` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`Usua_Id`),
  KEY `FK_tbUsuarios_tbEmpleados` (`Empl_Id`),
  KEY `FK_tbUsuarios_tbRoles` (`Role_Id`),
  KEY `FK_tbUsuarios_tbUsuarios_Creacion` (`Usua_UsuarioCreacion`),
  KEY `FK_tbUsuarios_tbUsuarios_Modificacion` (`Usua_UsuarioModificacion`),
  CONSTRAINT `FK_tbUsuarios_tbEmpleados` FOREIGN KEY (`Empl_Id`) REFERENCES `gral_tbempleados` (`Empl_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tbUsuarios_tbRoles` FOREIGN KEY (`Role_Id`) REFERENCES `acce_tbroles` (`Role_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tbUsuarios_tbUsuarios_Creacion` FOREIGN KEY (`Usua_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tbUsuarios_tbUsuarios_Modificacion` FOREIGN KEY (`Usua_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acce_tbusuarios`
--

LOCK TABLES `acce_tbusuarios` WRITE;
/*!40000 ALTER TABLE `acce_tbusuarios` DISABLE KEYS */;
INSERT INTO `acce_tbusuarios` VALUES (1,'Admin','Admin',0,3,1,1,'2024-12-12 00:00:00',1,NULL,NULL,NULL),(2,'Fabiola','149A860CDD79D7714004FD2CF699B0F555879FE4AFD99D99831D356354F8A26C2FD34B84EF786335AA22A8638E643D932C538F50DC39A728AB63A3C15C92E282',1,3,28,1,'2024-12-12 00:00:00',10,'2024-05-25 23:43:47',1,NULL),(3,'Eduardo','B270BB57A88B48434307D8B245C2734AA333DB584670E8C3D11A92A7CE33AD99EAE71EB2EFDD50ADEBB7CA0EBCFFF7CE4765FD37C6106348ED7A97D8774E3984',0,3,1,1,'2024-12-12 00:00:00',1,NULL,1,NULL),(4,'Minesit','B270BB57A88B48434307D8B245C2734AA333DB584670E8C3D11A92A7CE33AD99EAE71EB2EFDD50ADEBB7CA0EBCFFF7CE4765FD37C6106348ED7A97D8774E3984',0,3,1,1,'2024-12-12 00:00:00',1,'2024-05-06 08:05:54',0,NULL),(5,'Insertarxd','75B1D1075E53DC7C92C9154FC27E05CCAC18E3C3DE87134920B2E1B2AFA7FBDF1159F0AA930CD2EB0EB731539B29EA2EC41120D76C22B3693857852C4762CCB1',0,3,1,1,'2024-12-12 00:00:00',1,'2024-05-03 17:56:21',0,NULL),(6,'SKKFAK','243C061F8DD9AF59B57858D135C0001C6B4267286D6FE663A9008B2399817A20254E57F67ED359FA9334E8CDB8929E890B852DF3676ADFB7B39769FF8FC4F7DD',0,3,1,1,'2024-12-12 00:00:00',1,NULL,0,NULL),(7,'XDDD','3AE98A5E177162E6E20976C971ABECF7660D1F86FF85EEE53D93810BDE9A239256274C00D0C185D8DE13F2B4A337E30209C5F998AA72444A7332BAF99406518E',1,3,2,1,'2024-05-03 17:34:03',NULL,NULL,0,NULL),(8,'juanito','3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2',1,3,1,1,'2024-07-05 00:00:00',NULL,NULL,1,NULL),(9,'Esdra','B662FBCD16CF13F937E44C42232523BB9EB6C5B93462DF000755715CC1783F52C38E1E75E78C94D9695EDB2D8A9661DF38C3056ABADAD57385ECC73388E492C8',0,5,28,1,'2024-05-07 14:09:34',11,'2024-05-21 13:32:22',1,NULL),(10,'123','3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2',1,7,1,1,'2024-05-08 14:59:11',NULL,'2024-05-22 13:25:30',1,NULL),(11,'Mine25','F2D9BD628918BB9CB7CC92FB3FF5663F23F60366DAC0DCD313D63BC599969EFBD34A4DC483AA7A5DE21142E881CD88A99CBF4A6D975601E3C7DF3AB4F37BE440',1,5,27,1,'2024-05-15 23:00:34',11,'2024-05-21 08:54:55',0,'314913'),(12,'Jezer','F91666E52D7896162EEABC6D2DF0F95ABAC67752FCCA462CF1669FB9227C8E1C338D98ACF1FB403E9B1BCED2D4EC7F00C809C7ED4237EC784317FE05B4C5A466',0,3,28,1,'2024-05-21 15:08:39',NULL,NULL,1,NULL),(13,'juancho123','D404559F602EAB6FD602AC7680DACBFAADD13630335E951F097AF3900E9DE176B6DB28512F2E000B9D04FBA5133E8B1C6E8DF59DB3A8AB9D60BE4B97CC9E81DB',0,5,6,1,'2024-05-21 21:55:20',10,'2024-05-21 21:55:45',0,NULL),(14,'juancho','3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2',0,7,30,1,'2024-05-22 13:59:30',NULL,NULL,0,NULL),(15,'Jason','3C9909AFEC25354D551DAE21590BB26E38D53F2173B8D3DC3EEE4C047E7AB1C1EB8B85103E3BE7BA613B31BB5C9C36214DC9F14A42FD7A2FDB84856BCA5C44C2',1,14,31,1,'2024-05-22 16:49:27',NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `acce_tbusuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dbo_table_1`
--

DROP TABLE IF EXISTS `dbo_table_1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dbo_table_1` (
  `Id` char(10) NOT NULL,
  `nombe` char(10) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dbo_table_1`
--

LOCK TABLES `dbo_table_1` WRITE;
/*!40000 ALTER TABLE `dbo_table_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `dbo_table_1` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbcargos`
--

DROP TABLE IF EXISTS `gral_tbcargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbcargos` (
  `Carg_Id` int(11) NOT NULL,
  `Carg_Cargo` varchar(60) NOT NULL,
  `Carg_UsuarioCreacion` int(11) NOT NULL,
  `Carg_FechaCreacion` datetime NOT NULL,
  `Carg_UsuarioModificacion` int(11) DEFAULT NULL,
  `Carg_FechaModificacion` datetime DEFAULT NULL,
  `Carg_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Carg_Id`),
  KEY `tbCargos_tbUsuarios_UsuarioCreacion` (`Carg_UsuarioCreacion`),
  KEY `tbCargos_tbUsuarios_UsuarioModificacion` (`Carg_UsuarioModificacion`),
  CONSTRAINT `tbCargos_tbUsuarios_Carg_UsuarioCreacion` FOREIGN KEY (`Carg_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbCargos_tbUsuarios_Carg_UsuarioModificacion` FOREIGN KEY (`Carg_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbCargos_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Carg_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbCargos_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Carg_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbcargos`
--

LOCK TABLES `gral_tbcargos` WRITE;
/*!40000 ALTER TABLE `gral_tbcargos` DISABLE KEYS */;
INSERT INTO `gral_tbcargos` VALUES (1,'Mesero',1,'2024-12-12 00:00:00',NULL,NULL,1),(2,'Cajera',1,'2024-04-30 20:08:47',NULL,NULL,1),(3,'porfa',1,'2024-05-03 15:56:39',1,'2024-05-03 16:23:55',0),(4,'pruebita',1,'2024-05-03 23:52:01',1,'2024-05-04 00:40:51',1),(5,'PredicaX',11,'2024-05-15 23:23:13',11,'2024-05-15 23:23:45',0),(6,'cacaasasass',10,'2024-05-21 21:59:34',10,'2024-05-21 21:59:37',0);
/*!40000 ALTER TABLE `gral_tbcargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbcategorias`
--

DROP TABLE IF EXISTS `gral_tbcategorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbcategorias` (
  `Cate_Id` int(11) NOT NULL,
  `Cate_Categoria` varchar(60) DEFAULT NULL,
  `Cate_UsuarioCreacion` int(11) DEFAULT NULL,
  `Cate_FechaCreacion` datetime DEFAULT NULL,
  `Cate_UsuarioModificacion` int(11) DEFAULT NULL,
  `Cate_FechaModificacion` datetime DEFAULT NULL,
  `Cate_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Cate_Id`),
  KEY `tbCategorias_tbUsuarios_Cate_UsuarioCreacion` (`Cate_UsuarioCreacion`),
  KEY `tbCategorias_tbUsuarios_Cate_UsuarioModificacion` (`Cate_UsuarioModificacion`),
  CONSTRAINT `tbCategorias_tbUsuarios_Cate_UsuarioCreacion` FOREIGN KEY (`Cate_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbCategorias_tbUsuarios_Cate_UsuarioModificacion` FOREIGN KEY (`Cate_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbcategorias`
--

LOCK TABLES `gral_tbcategorias` WRITE;
/*!40000 ALTER TABLE `gral_tbcategorias` DISABLE KEYS */;
INSERT INTO `gral_tbcategorias` VALUES (1,'Oro',1,'2024-04-30 17:38:56',NULL,NULL,1),(2,'agagagag',1,'2024-05-04 17:38:56',NULL,NULL,1),(3,'Plata',1,'2024-05-04 17:38:56',NULL,NULL,1),(4,'pruebaaa',1,'2024-05-04 17:38:56',NULL,NULL,1),(5,'dfagahaha',1,'2024-05-06 10:43:56',NULL,NULL,1),(6,'sfagaagvc',1,'2024-05-06 10:44:37',1,'2024-05-06 10:46:01',0),(7,'CategoriaPros',11,'2024-05-15 23:43:49',11,'2024-05-15 23:43:53',0),(8,'.',10,'2024-05-16 00:00:00',NULL,NULL,0),(9,'cacaasas',10,'2024-05-21 21:58:07',10,'2024-05-21 21:58:13',0);
/*!40000 ALTER TABLE `gral_tbcategorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbclientes`
--

DROP TABLE IF EXISTS `gral_tbclientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbclientes` (
  `Clie_Id` int(11) NOT NULL,
  `Clie_Nombre` varchar(60) NOT NULL,
  `Clie_Apellido` varchar(60) NOT NULL,
  `Clie_FechaNac` datetime NOT NULL,
  `Clie_Sexo` char(1) NOT NULL,
  `Muni_Codigo` varchar(4) NOT NULL,
  `Esta_Id` int(11) NOT NULL,
  `Clie_UsuarioCreacion` int(11) DEFAULT NULL,
  `Clie_FechaCreacion` datetime DEFAULT NULL,
  `Clie_UsuarioModificacion` int(11) DEFAULT NULL,
  `Clie_FechaModificacion` datetime DEFAULT NULL,
  `Clie_Estado` tinyint(1) DEFAULT 1,
  `Clie_DNI` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`Clie_Id`),
  KEY `tbClientes_tbEstadosCiviles_Esta_Id` (`Esta_Id`),
  KEY `tbClientes_tbMunicipios_Muni_Codigo` (`Muni_Codigo`),
  KEY `tbClientes_tbUsuarios_UsuarioCreacion` (`Clie_UsuarioCreacion`),
  KEY `tbClientes_tbUsuarios_UsuarioModificacion` (`Clie_UsuarioModificacion`),
  CONSTRAINT `tbClientes_tbEstadosCiviles_Esta_Id` FOREIGN KEY (`Esta_Id`) REFERENCES `gral_tbestadosciviles` (`Esta_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbClientes_tbMunicipios_Muni_Codigo` FOREIGN KEY (`Muni_Codigo`) REFERENCES `gral_tbmunicipios` (`Muni_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbClientes_tbUsuarios_Clie_UsuarioCreacion` FOREIGN KEY (`Clie_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbClientes_tbUsuarios_Clie_UsuarioModificacion` FOREIGN KEY (`Clie_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbClientes_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Clie_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbClientes_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Clie_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbclientes`
--

LOCK TABLES `gral_tbclientes` WRITE;
/*!40000 ALTER TABLE `gral_tbclientes` DISABLE KEYS */;
INSERT INTO `gral_tbclientes` VALUES (1,'Consumidor','Final','2024-04-30 21:44:50','F','0320',1,1,'2024-04-30 15:45:17',NULL,NULL,1,'0000000000000'),(2,'Eduardo','Varela','2024-05-14 20:28:00','F','0501',3,1,'2024-05-04 20:29:01',1,NULL,1,'0611200500732'),(3,'Mindy','Campos','2024-05-05 14:47:00','M','0501',3,1,'2024-05-05 14:47:46',NULL,NULL,1,'0711200500732'),(4,'sxd','SDFAF','2024-05-10 10:05:00','M','8645',1,1,'2024-05-07 10:05:27',1,NULL,1,'1414141414141'),(5,'MONICA','CHACON','2024-01-10 20:13:00','M','0202',1,1,'2024-05-15 20:13:42',NULL,NULL,1,'08081'),(6,'KAFKAAASDA','XD','2024-05-07 23:55:00','M','0501',1,1,'2024-05-15 23:55:55',11,'2024-05-15 23:59:16',0,'1414141415151'),(7,'fasadasda','asdadfsafas','2024-05-31 21:58:00','F','1453',3,1,'2024-05-21 21:58:57',10,'2024-05-21 21:59:19',0,'1231231212333'),(8,'fasadasda','qwe','2024-05-06 22:18:00','M','0202',1,1,'2024-05-21 22:19:02',NULL,NULL,1,'111'),(9,'fasadasda','qwe','2024-05-14 22:22:00','M','0201',3,1,'2024-05-21 22:22:33',NULL,NULL,1,'1233333333333');
/*!40000 ALTER TABLE `gral_tbclientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbdepartamentos`
--

DROP TABLE IF EXISTS `gral_tbdepartamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbdepartamentos` (
  `Depa_Codigo` varchar(2) NOT NULL,
  `Depa_Departamento` varchar(60) NOT NULL,
  `Depa_UsuarioCreacion` int(11) NOT NULL,
  `Depa_FechaCreacion` datetime NOT NULL,
  `Depa_UsuarioModificacion` int(11) DEFAULT NULL,
  `Depa_FechaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`Depa_Codigo`),
  KEY `tbUsuarios_tbUsuarios_Depa_UsuarioCreacion` (`Depa_UsuarioCreacion`),
  KEY `tbUsuarios_tbUsuarios_Depa_UsuarioModificacion` (`Depa_UsuarioModificacion`),
  CONSTRAINT `tbDepartamentos_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Depa_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbDepartamentos_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Depa_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbUsuarios_tbUsuarios_Depa_UsuarioCreacion` FOREIGN KEY (`Depa_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbUsuarios_tbUsuarios_Depa_UsuarioModificacion` FOREIGN KEY (`Depa_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbdepartamentos`
--

LOCK TABLES `gral_tbdepartamentos` WRITE;
/*!40000 ALTER TABLE `gral_tbdepartamentos` DISABLE KEYS */;
INSERT INTO `gral_tbdepartamentos` VALUES ('01','Atlántida',1,'2024-04-21 00:00:00',NULL,NULL),('02','Colón',1,'2024-04-21 00:00:00',NULL,NULL),('03','Comayagua',1,'2024-04-21 00:00:00',NULL,NULL),('05','Cortés',1,'2024-04-21 00:00:00',NULL,NULL),('06','Choluteca',1,'2024-04-21 00:00:00',NULL,NULL),('07','El Paraíso',1,'2024-04-21 00:00:00',NULL,NULL),('08','Francisco Morazán',1,'2024-04-21 00:00:00',NULL,NULL),('09','Gracias a Dios',1,'2024-04-21 00:00:00',NULL,NULL),('10','Intibucaaas',1,'2024-04-21 00:00:00',1,'2024-05-06 08:13:53'),('11','Islas de la Bahía',1,'2024-04-21 00:00:00',NULL,NULL),('12','La Paz',1,'2024-04-21 00:00:00',NULL,NULL),('13','Lempira',1,'2024-04-21 00:00:00',NULL,NULL),('14','Ocotepeque',1,'2024-04-21 00:00:00',NULL,NULL),('15','Olancho',1,'2024-04-21 00:00:00',NULL,NULL),('16','Santa Bárbara',1,'2024-04-21 00:00:00',NULL,NULL),('17','Valle',1,'2024-04-21 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `gral_tbdepartamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbempleados`
--

DROP TABLE IF EXISTS `gral_tbempleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbempleados` (
  `Empl_Id` int(11) NOT NULL,
  `Empl_Nombre` varchar(30) NOT NULL,
  `Empl_Apellido` varchar(30) NOT NULL,
  `Empl_Sexo` char(1) NOT NULL,
  `Empl_FechaNac` datetime NOT NULL,
  `Muni_Codigo` varchar(4) NOT NULL,
  `Esta_Id` int(11) NOT NULL,
  `Carg_Id` int(11) NOT NULL,
  `Empl_UsuarioCreacion` int(11) DEFAULT NULL,
  `Empl_FechaCreacion` datetime DEFAULT NULL,
  `Empl_UsuarioModificacion` int(11) DEFAULT NULL,
  `Empl_FechaModificacion` datetime DEFAULT NULL,
  `Empl_Estado` tinyint(1) DEFAULT 1,
  `Empl_Correo` longtext DEFAULT NULL,
  `Empl_DNI` varchar(13) DEFAULT NULL,
  `Sucu_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Empl_Id`),
  KEY `tbEmpleados_tbCargos_carg_Id` (`Carg_Id`),
  KEY `tbEmpleados_tbEstadosCiviles_Esta_Id` (`Esta_Id`),
  KEY `tbEmpleados_tbMunicipios_Muni_Codigo` (`Muni_Codigo`),
  KEY `tbEmpleados_tbUsuarios_UsuarioCreacion` (`Empl_UsuarioCreacion`),
  KEY `tbEmpleados_tbUsuarios_UsuarioModificacion` (`Empl_UsuarioModificacion`),
  CONSTRAINT `tbEmpleados_tbCargos_carg_Id` FOREIGN KEY (`Carg_Id`) REFERENCES `gral_tbcargos` (`Carg_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEmpleados_tbEstadosCiviles_Esta_Id` FOREIGN KEY (`Esta_Id`) REFERENCES `gral_tbestadosciviles` (`Esta_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEmpleados_tbMunicipios_Muni_Codigo` FOREIGN KEY (`Muni_Codigo`) REFERENCES `gral_tbmunicipios` (`Muni_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEmpleados_tbUsuarios_Prov_UsuarioCreacion` FOREIGN KEY (`Empl_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEmpleados_tbUsuarios_Prov_UsuarioModificacion` FOREIGN KEY (`Empl_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEmpleados_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Empl_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEmpleados_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Empl_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbempleados`
--

LOCK TABLES `gral_tbempleados` WRITE;
/*!40000 ALTER TABLE `gral_tbempleados` DISABLE KEYS */;
INSERT INTO `gral_tbempleados` VALUES (3,'Eduardo','Varela','M','2024-12-12 00:00:00','0501',1,1,1,'2024-12-12 00:00:00',2,'2024-05-17 21:14:35',1,'hd1videoscalidad@gmail.com','0611200500732',3),(4,'Fav','campos','f','2001-07-12 00:00:00','0320',1,1,1,'2024-05-04 23:11:20',1,'2024-05-04 00:00:00',0,'eduardo.jafet.varela.salinas@gmail.com','0511200500732',3),(5,'Esdra','Cerna','F','2024-05-29 23:56:00','0501',5,2,1,'2024-05-04 23:58:51',2,'2024-05-25 02:09:35',1,'esdracerna@gmail.com','0711200500732',3),(6,'dfagagagag','afaGAGAG','M','2024-05-01 10:24:00','0501',3,1,1,'2024-05-07 10:24:26',1,'2024-05-07 10:27:28',0,'SDFAF','6666666666666',3),(7,'Manuel','.','M','2005-08-15 09:30:00','0294',1,2,1,'2024-05-08 14:57:08',NULL,NULL,1,'jahir.lara99@gmail.com','0501200511',3),(13,'KAFKAAASDATFGGFGF','XD','M','2024-05-12 00:32:00','0294',3,2,11,'2024-05-16 00:32:38',11,'2024-05-16 00:32:49',0,'jahir.lara99@gmail.com','1414131313131',3),(14,'dFfFfFffg','SAFA','M','2024-05-04 21:25:00','0320',1,1,11,'2024-05-16 21:25:31',11,'2024-05-16 21:28:19',1,'Eduardo','3134344444',4),(15,'casssssasda','casdfggasd','M','2024-05-01 22:00:00','1453',3,4,10,'2024-05-21 22:01:15',10,'2024-05-21 22:02:02',0,'jasdujh123haahahahahahahaha@@@gmail.com','1899999999999',4),(16,'asdasdasd','asdasdasd','F','2024-05-10 22:52:00','0294',1,1,10,'2024-05-21 22:53:05',10,'2024-05-21 22:53:16',1,'asdfasdf','11111111111',4);
/*!40000 ALTER TABLE `gral_tbempleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbestadosciviles`
--

DROP TABLE IF EXISTS `gral_tbestadosciviles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbestadosciviles` (
  `Esta_Id` int(11) NOT NULL,
  `Esta_EstadoCivil` varchar(60) NOT NULL,
  `Esta_UsuarioCreacion` int(11) DEFAULT NULL,
  `Esta_FechaCreacion` datetime DEFAULT NULL,
  `Esta_UsuarioModificacion` int(11) DEFAULT NULL,
  `Esta_FechaModificacion` datetime DEFAULT NULL,
  `Esta_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Esta_Id`),
  KEY `tbEstadosCiviles_tbUsuarios_UsuarioCreacion` (`Esta_UsuarioCreacion`),
  KEY `tbEstadosCiviles_tbUsuarios_UsuarioModificacion` (`Esta_UsuarioModificacion`),
  CONSTRAINT `tbEstadosCiviles_tbUsuarios_Esta_UsuarioCreacion` FOREIGN KEY (`Esta_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEstadosCiviles_tbUsuarios_Esta_UsuarioModificacion` FOREIGN KEY (`Esta_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEstadosCiviles_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Esta_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbEstadosCiviles_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Esta_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbestadosciviles`
--

LOCK TABLES `gral_tbestadosciviles` WRITE;
/*!40000 ALTER TABLE `gral_tbestadosciviles` DISABLE KEYS */;
INSERT INTO `gral_tbestadosciviles` VALUES (1,'Soltero',1,'2024-12-12 00:00:00',1,'2024-05-19 20:06:10',1),(3,'pruebaaaaasi',1,'2024-05-04 00:00:00',1,'2024-05-04 00:36:12',1),(4,'pruebaaaaa',1,'2024-05-04 00:00:00',NULL,NULL,0),(5,'Casado',1,'2024-05-04 00:36:40',NULL,NULL,1),(6,'afagagag',1,'2024-05-06 10:48:54',1,'2024-05-06 10:48:57',0),(7,'CASADOOOSS',11,'2024-05-16 00:46:31',11,'2024-05-16 00:46:34',0),(8,'cacaasasasa',10,'2024-05-21 21:58:25',10,'2024-05-21 21:58:28',0),(9,'jhgfds',15,'2024-05-22 16:52:04',NULL,NULL,1);
/*!40000 ALTER TABLE `gral_tbestadosciviles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbimpuestos`
--

DROP TABLE IF EXISTS `gral_tbimpuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbimpuestos` (
  `Impu_Id` int(11) NOT NULL,
  `Impu_Impuesto` bigint(20) DEFAULT NULL,
  `Impu_UsuarioCreacion` int(11) DEFAULT NULL,
  `Impu_FechaCreacion` datetime DEFAULT NULL,
  `Impu_UsuarioModificacion` int(11) DEFAULT NULL,
  `Impu_FechaModificacion` datetime DEFAULT NULL,
  `Impu_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Impu_Id`),
  KEY `tbImpuestos_tbUsuarios_UsuarioCreacion` (`Impu_UsuarioCreacion`),
  KEY `tbImpuestos_tbUsuarios_UsuarioModificacion` (`Impu_UsuarioModificacion`),
  CONSTRAINT `tbImpuestos_tbUsuarios_Impu_UsuarioCreacion` FOREIGN KEY (`Impu_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbImpuestos_tbUsuarios_Impu_UsuarioModificacion` FOREIGN KEY (`Impu_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbImpuestos_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Impu_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbImpuestos_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Impu_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbimpuestos`
--

LOCK TABLES `gral_tbimpuestos` WRITE;
/*!40000 ALTER TABLE `gral_tbimpuestos` DISABLE KEYS */;
INSERT INTO `gral_tbimpuestos` VALUES (1,15,1,'2024-12-12 00:00:00',NULL,NULL,1),(2,18,1,'2024-12-12 00:00:00',NULL,NULL,0),(3,NULL,1,'2024-04-30 14:58:31',NULL,NULL,0),(4,NULL,1,'2024-04-30 15:13:55',NULL,NULL,0),(5,20,1,'2024-04-30 15:16:36',NULL,NULL,0),(6,38,1,NULL,1,'2024-05-04 01:17:47',0),(7,90,1,NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `gral_tbimpuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbmarcas`
--

DROP TABLE IF EXISTS `gral_tbmarcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbmarcas` (
  `Marc_Id` int(11) NOT NULL,
  `Marc_Marca` varchar(60) NOT NULL,
  `Marc_UsuarioCreacion` int(11) DEFAULT NULL,
  `Marc_FechaCreacion` datetime DEFAULT NULL,
  `Marc_UsuarioModificacion` int(11) DEFAULT NULL,
  `Marc_FechaModificacion` datetime DEFAULT NULL,
  `Marc_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Marc_Id`),
  KEY `tbMarcas_tbUsuarios_Marc_UsuarioCreacion` (`Marc_UsuarioCreacion`),
  KEY `tbMarcas_tbUsuarios_Marc_UsuarioModificacion` (`Marc_UsuarioModificacion`),
  CONSTRAINT `tbMarcas_tbUsuarios_Marc_UsuarioCreacion` FOREIGN KEY (`Marc_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMarcas_tbUsuarios_Marc_UsuarioModificacion` FOREIGN KEY (`Marc_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbmarcas`
--

LOCK TABLES `gral_tbmarcas` WRITE;
/*!40000 ALTER TABLE `gral_tbmarcas` DISABLE KEYS */;
INSERT INTO `gral_tbmarcas` VALUES (3,'Rare Beutiful',1,'2024-04-30 20:20:41',NULL,NULL,1),(4,'pruebaaaddd',1,NULL,1,'2024-05-04 13:05:52',0),(5,'tyityy',1,NULL,NULL,NULL,1),(6,'pruebaaa',1,NULL,NULL,NULL,0),(7,'rafagagagagfagag',1,'2024-05-16 00:52:13',11,'2024-05-16 00:52:16',0),(8,'generica',10,'2024-05-16 00:00:00',NULL,NULL,0),(9,'cacacasasasas',10,'2024-05-21 21:59:47',10,'2024-05-21 21:59:51',0),(10,'reciprocro',10,'2024-05-22 12:27:51',15,'2024-05-22 16:52:17',1);
/*!40000 ALTER TABLE `gral_tbmarcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbmateriales`
--

DROP TABLE IF EXISTS `gral_tbmateriales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbmateriales` (
  `Mate_Id` int(11) NOT NULL,
  `Mate_Material` varchar(60) NOT NULL,
  `Mate_UsuarioCreacion` int(11) DEFAULT NULL,
  `Mate_FechaCreacion` datetime DEFAULT NULL,
  `Mate_UsuarioModificacion` int(11) DEFAULT NULL,
  `Mate_FechaModificacion` datetime DEFAULT NULL,
  `Mate_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Mate_Id`),
  KEY `tbMateriales_tbUsuarios_Marc_UsuarioCreacion` (`Mate_UsuarioCreacion`),
  KEY `tbMateriales_tbUsuarios_Marc_UsuarioModificacion` (`Mate_UsuarioModificacion`),
  CONSTRAINT `tbMateriales_tbUsuarios_Marc_UsuarioCreacion` FOREIGN KEY (`Mate_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMateriales_tbUsuarios_Marc_UsuarioModificacion` FOREIGN KEY (`Mate_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbmateriales`
--

LOCK TABLES `gral_tbmateriales` WRITE;
/*!40000 ALTER TABLE `gral_tbmateriales` DISABLE KEYS */;
INSERT INTO `gral_tbmateriales` VALUES (1,'Oro',1,'2024-04-30 20:29:53',NULL,NULL,1),(2,'pruebaaaa',1,NULL,1,'2024-05-04 14:33:25',0),(3,'Plata',1,NULL,NULL,NULL,1),(4,'Acero',1,NULL,NULL,NULL,1),(5,'Hierrooss',11,'2024-05-16 01:09:49',11,'2024-05-16 01:11:00',0),(6,'.',10,'2024-05-16 00:00:00',NULL,NULL,0),(7,'cacacasasasas',10,'2024-05-21 22:00:06',10,'2024-05-21 22:00:10',0),(8,'fff',15,'2024-05-22 16:52:23',15,'2024-05-22 16:52:28',1);
/*!40000 ALTER TABLE `gral_tbmateriales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbmetodospago`
--

DROP TABLE IF EXISTS `gral_tbmetodospago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbmetodospago` (
  `Mepa_Id` int(11) NOT NULL,
  `Mepa_Metodo` varchar(60) NOT NULL,
  `Mepa_UsuarioCreacion` int(11) DEFAULT NULL,
  `Mepa_FechaCreacion` datetime DEFAULT NULL,
  `Mepa_UsuarioModificacion` int(11) DEFAULT NULL,
  `Mepa_FechaModificacion` datetime DEFAULT NULL,
  `Mepa_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Mepa_Id`),
  KEY `tbMetodosPago_tbUsuarios_UsuarioCreacion` (`Mepa_UsuarioCreacion`),
  KEY `tbMetodosPago_tbUsuarios_UsuarioModificacion` (`Mepa_UsuarioModificacion`),
  CONSTRAINT `tbMetodosPago_tbUsuarios_Mepa_UsuarioCreacion` FOREIGN KEY (`Mepa_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMetodosPago_tbUsuarios_Mepa_UsuarioModificacion` FOREIGN KEY (`Mepa_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMetodosPago_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Mepa_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMetodosPago_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Mepa_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbmetodospago`
--

LOCK TABLES `gral_tbmetodospago` WRITE;
/*!40000 ALTER TABLE `gral_tbmetodospago` DISABLE KEYS */;
INSERT INTO `gral_tbmetodospago` VALUES (1,'Efectivo',1,'2024-12-12 00:00:00',NULL,NULL,1),(4,'Tarjeta de Credito',1,'2024-12-12 00:00:00',NULL,NULL,1),(7,'Pago en linea',1,'2024-12-12 00:00:00',NULL,NULL,1);
/*!40000 ALTER TABLE `gral_tbmetodospago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbmunicipios`
--

DROP TABLE IF EXISTS `gral_tbmunicipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbmunicipios` (
  `Muni_Codigo` varchar(4) NOT NULL,
  `Muni_Municipio` varchar(60) NOT NULL,
  `Depa_Codigo` varchar(2) NOT NULL,
  `Muni_UsuarioCreacion` int(11) DEFAULT NULL,
  `Muni_FechaCreacion` datetime DEFAULT NULL,
  `Muni_UsuarioModificacion` int(11) DEFAULT NULL,
  `Muni_FechaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`Muni_Codigo`),
  KEY `tbDepartamentos_tbMunicipios_Depa_Codigo` (`Depa_Codigo`),
  KEY `tbUsuarios_tbUsuarios_Muni_UsuarioCreacion` (`Muni_UsuarioCreacion`),
  KEY `tbUsuarios_tbUsuarios_Muni_UsuarioModificacion` (`Muni_UsuarioModificacion`),
  CONSTRAINT `tbDepartamentos_tbMunicipios_Depa_Codigo` FOREIGN KEY (`Depa_Codigo`) REFERENCES `gral_tbdepartamentos` (`Depa_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMunicipios_tbUsuarios_UsuarioCreacion` FOREIGN KEY (`Muni_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMunicipios_tbUsuarios_UsuarioModificacion` FOREIGN KEY (`Muni_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbUsuarios_tbUsuarios_Muni_UsuarioCreacion` FOREIGN KEY (`Muni_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbUsuarios_tbUsuarios_Muni_UsuarioModificacion` FOREIGN KEY (`Muni_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbmunicipios`
--

LOCK TABLES `gral_tbmunicipios` WRITE;
/*!40000 ALTER TABLE `gral_tbmunicipios` DISABLE KEYS */;
INSERT INTO `gral_tbmunicipios` VALUES ('0201','Santa Rosa','10',1,'2024-05-02 09:29:21',1,'2024-05-02 21:09:45'),('0202','Funciona','08',1,'2024-05-02 09:31:22',NULL,NULL),('0294','Probando','09',1,'2024-05-02 09:31:37',1,'2024-05-02 20:28:13'),('0320','Las Lajas','03',1,'2024-04-30 00:10:51',1,'2024-04-30 22:04:54'),('0452','Villanuevaaa','16',1,'2024-05-02 16:49:14',NULL,NULL),('0501','San Pedro Sula','01',1,'2024-12-12 00:00:00',NULL,NULL),('1453','afatgaghaghaha','02',11,'2024-05-16 01:17:28',NULL,NULL),('1551','zfgag','08',1,'2024-05-06 08:17:36',NULL,NULL),('1553','Probandoss','02',11,'2024-05-16 01:16:54',NULL,NULL),('8645','fdagaggagagag','05',1,'2024-05-06 08:16:55',1,'2024-05-16 01:17:34');
/*!40000 ALTER TABLE `gral_tbmunicipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbproductosporsucurales`
--

DROP TABLE IF EXISTS `gral_tbproductosporsucurales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbproductosporsucurales` (
  `Prxs_Id` int(11) NOT NULL,
  `Prxs_Dif` tinyint(1) DEFAULT NULL,
  `Prod_Id` int(11) DEFAULT NULL,
  `Prsx_Stock` int(11) DEFAULT NULL,
  `Sucu_Id` int(11) DEFAULT NULL,
  `Pren_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Prxs_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbproductosporsucurales`
--

LOCK TABLES `gral_tbproductosporsucurales` WRITE;
/*!40000 ALTER TABLE `gral_tbproductosporsucurales` DISABLE KEYS */;
INSERT INTO `gral_tbproductosporsucurales` VALUES (1,1,13,0,3,1),(2,1,14,38,3,1),(3,1,30,0,3,1),(4,1,16,52,3,1),(5,0,10,1,3,1),(6,0,87,20,3,1),(31,1,16,0,4,NULL),(32,1,14,68,4,NULL),(33,1,30,31,4,NULL),(34,1,13,0,4,NULL),(35,0,87,49,4,NULL),(36,0,10,3,4,NULL),(37,1,81,984,4,NULL),(38,1,82,74,4,NULL),(39,0,97,28,4,NULL),(40,1,74,3,3,NULL),(41,0,98,492,3,NULL),(42,0,99,123,3,NULL),(43,1,74,12,4,NULL),(44,1,83,0,4,NULL),(45,0,100,12,4,NULL),(46,1,84,984,4,NULL),(47,1,74,120,7,NULL),(48,1,59,72,4,NULL),(49,1,78,0,4,NULL),(50,0,101,0,4,NULL),(51,1,31,12,4,NULL),(52,1,64,12,4,NULL),(53,0,102,123,NULL,NULL),(54,1,85,24,7,NULL),(55,1,85,246,4,NULL),(56,0,103,738,4,NULL),(57,1,75,123,7,NULL),(58,1,86,0,3,NULL);
/*!40000 ALTER TABLE `gral_tbproductosporsucurales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbproveedores`
--

DROP TABLE IF EXISTS `gral_tbproveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbproveedores` (
  `Prov_Id` int(11) NOT NULL,
  `Prov_Proveedor` varchar(60) NOT NULL,
  `Prov_Telefono` varchar(8) NOT NULL,
  `Muni_Codigo` varchar(4) NOT NULL,
  `Prov_UsuarioCreacion` int(11) NOT NULL,
  `Prov_FechaCreacion` datetime NOT NULL,
  `Prov_UsuarioModificacion` int(11) DEFAULT NULL,
  `Prov_FechaModificacion` datetime DEFAULT NULL,
  `Prov_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Prov_Id`),
  KEY `tbProveedores_tbMunicipios_Muni_Codigo` (`Muni_Codigo`),
  KEY `tbProveedores_tbUsuarios_Prov_UsuarioCreacion` (`Prov_UsuarioCreacion`),
  KEY `tbProveedores_tbUsuarios_Prov_UsuarioModificacion` (`Prov_UsuarioModificacion`),
  CONSTRAINT `tbProveedores_tbMunicipios_Muni_Codigo` FOREIGN KEY (`Muni_Codigo`) REFERENCES `gral_tbmunicipios` (`Muni_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbProveedores_tbUsuarios_Prov_UsuarioCreacion` FOREIGN KEY (`Prov_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbProveedores_tbUsuarios_Prov_UsuarioModificacion` FOREIGN KEY (`Prov_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbproveedores`
--

LOCK TABLES `gral_tbproveedores` WRITE;
/*!40000 ALTER TABLE `gral_tbproveedores` DISABLE KEYS */;
INSERT INTO `gral_tbproveedores` VALUES (1,'Proveedore1','55501222','0320',1,'2024-05-01 09:29:31',NULL,NULL,0),(2,'Compras','562465','0501',1,'2024-05-03 23:32:58',1,'2024-05-04 00:30:24',0),(3,'Compra','14142312','0320',1,'2024-05-04 00:47:36',NULL,NULL,1),(4,'Compra','14142312','0501',1,'2024-05-04 00:48:31',NULL,NULL,0),(5,'afafa','1213231','0501',1,'2024-05-04 00:50:28',NULL,NULL,0),(6,'Comprasasfa','1131313','0501',1,'2024-05-04 00:52:11',NULL,NULL,0),(7,'Motomundo','14142312','0501',1,'2024-05-04 00:55:26',NULL,NULL,1),(8,'fasgagag','4141212','0501',1,'2024-05-04 00:56:17',NULL,NULL,0),(9,'rasgfagag','13414151','0501',1,'2024-05-04 01:00:35',NULL,NULL,0),(10,'FerreMax','13411412','0501',1,'2024-05-04 01:01:35',NULL,NULL,1),(11,'A todo dar','14151251','0501',1,'2024-05-04 01:02:12',15,'2024-05-22 16:52:34',1),(12,'dfagagag','14141514','0501',11,'2024-05-16 01:23:57',11,'2024-05-16 01:24:02',0),(13,'cacacasasasasas','12123128','0294',10,'2024-05-21 22:00:26',10,'2024-05-21 22:00:36',0);
/*!40000 ALTER TABLE `gral_tbproveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gral_tbsucursales`
--

DROP TABLE IF EXISTS `gral_tbsucursales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gral_tbsucursales` (
  `Sucu_Id` int(11) NOT NULL,
  `Sucu_Nombre` varchar(60) DEFAULT NULL,
  `Muni_Codigo` varchar(4) DEFAULT NULL,
  `Sucu_UsuarioCreacion` int(11) DEFAULT NULL,
  `Sucu_FechaCreacion` datetime DEFAULT NULL,
  `Sucu_UsuarioModificacion` int(11) DEFAULT NULL,
  `Sucu_FechaModificacion` datetime DEFAULT NULL,
  `Sucu_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Sucu_Id`),
  KEY `tbSucursales_tbMunicipios_Muni_Codigo` (`Muni_Codigo`),
  KEY `tbSucursales_tbUsuarios_Prov_UsuarioCreacion` (`Sucu_UsuarioCreacion`),
  KEY `tbSucursales_tbUsuarios_Prov_UsuarioModificacion` (`Sucu_UsuarioModificacion`),
  CONSTRAINT `tbSucursales_tbMunicipios_Muni_Codigo` FOREIGN KEY (`Muni_Codigo`) REFERENCES `gral_tbmunicipios` (`Muni_Codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbSucursales_tbUsuarios_Prov_UsuarioCreacion` FOREIGN KEY (`Sucu_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbSucursales_tbUsuarios_Prov_UsuarioModificacion` FOREIGN KEY (`Sucu_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gral_tbsucursales`
--

LOCK TABLES `gral_tbsucursales` WRITE;
/*!40000 ALTER TABLE `gral_tbsucursales` DISABLE KEYS */;
INSERT INTO `gral_tbsucursales` VALUES (3,'Oficial','0320',1,'2024-05-01 04:06:38',NULL,NULL,1),(4,'El Calan','0320',2,NULL,10,'2024-05-21 21:15:10',1),(5,'xde','0501',11,'2024-05-16 21:07:45',11,'2024-05-16 21:07:57',0),(6,'merengue','0294',10,'2024-05-21 22:02:21',10,'2024-05-21 22:02:34',0),(7,'coyons','0201',10,'2024-05-22 12:32:05',NULL,NULL,1),(8,'g','0320',15,'2024-05-22 16:54:29',NULL,NULL,1);
/*!40000 ALTER TABLE `gral_tbsucursales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbcajas`
--

DROP TABLE IF EXISTS `vent_tbcajas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbcajas` (
  `caja_Id` int(11) NOT NULL,
  `caja_UsuarioApertura` int(11) DEFAULT NULL,
  `caja_FechaApertura` datetime DEFAULT NULL,
  `caja_UsuarioCierre` int(11) DEFAULT NULL,
  `caja_FechaCierre` datetime DEFAULT NULL,
  `caja_MontoInicial` decimal(9,2) DEFAULT NULL,
  `caja_MontoFinal` decimal(9,2) DEFAULT 0.00,
  `caja_MontoSistema` decimal(9,2) DEFAULT 0.00,
  `Sucu_Id` int(11) DEFAULT NULL,
  `caja_Observacion` longtext DEFAULT NULL,
  `caja_Finalizado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`caja_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbcajas`
--

LOCK TABLES `vent_tbcajas` WRITE;
/*!40000 ALTER TABLE `vent_tbcajas` DISABLE KEYS */;
INSERT INTO `vent_tbcajas` VALUES (1,2,'2024-05-19 12:00:00',2,'2024-05-20 09:33:20',200.00,3000.00,104078.45,3,'S',NULL),(3,11,'2024-05-20 08:04:20',11,NULL,66680.00,70000.00,7935.00,4,'SIU',NULL),(6,2,'2024-05-20 10:10:03',2,NULL,2420.00,6560.00,2990.00,3,'afa',NULL),(9,2,'2024-05-21 15:26:16',2,'2024-05-22 12:04:45',3000.00,3300.00,8638.80,3,'afaag',0),(15,2,'2024-05-22 16:42:34',2,'2024-05-24 17:27:27',300.00,3300.00,12190.00,3,'agag',0),(16,2,'2024-05-24 23:59:12',2,'2024-05-25 00:33:16',3000.00,303000.00,4485.00,3,'Siu',0),(17,9,'2024-05-25 02:10:51',9,'2024-05-25 02:10:51',3340.00,5000.00,11040.00,3,'sfa',1),(18,9,'2024-05-27 11:14:59',9,'2024-05-27 11:14:59',30.00,1300.00,1495.00,3,'SIU',1);
/*!40000 ALTER TABLE `vent_tbcajas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbfactura`
--

DROP TABLE IF EXISTS `vent_tbfactura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbfactura` (
  `Fact_Id` int(11) NOT NULL,
  `Clie_Id` int(11) NOT NULL,
  `Empl_Id` int(11) NOT NULL,
  `Mepa_Id` int(11) NOT NULL,
  `Fact_UsuarioCreacion` int(11) DEFAULT NULL,
  `Fact_FechaCreacion` datetime DEFAULT NULL,
  `Fact_UsuarioModificacion` int(11) DEFAULT NULL,
  `Fact_FechaModificacion` datetime DEFAULT NULL,
  `Fact_Estado` tinyint(1) DEFAULT 1,
  `Fact_Finalizado` tinyint(1) DEFAULT 1,
  `Fact_FechaFinalizado` datetime DEFAULT NULL,
  `Sucu_Id` int(11) DEFAULT NULL,
  `Fact_Cambio` decimal(8,2) DEFAULT 0.00,
  `Fact_Pago` decimal(8,2) DEFAULT 0.00,
  PRIMARY KEY (`Fact_Id`),
  KEY `tbFactura_tbClientes_Clie_Id` (`Clie_Id`),
  KEY `tbFactura_tbEmpleados_Empl_Id` (`Empl_Id`),
  KEY `tbFactura_tbMetodosPago_Mepa_Id` (`Mepa_Id`),
  KEY `tbFactura_tbUsuarios_Fact_UsuarioCreacion` (`Fact_UsuarioCreacion`),
  KEY `tbFactura_tbUsuarios_Fact_UsuarioModificacion` (`Fact_UsuarioModificacion`),
  CONSTRAINT `tbFactura_tbClientes_Clie_Id` FOREIGN KEY (`Clie_Id`) REFERENCES `gral_tbclientes` (`Clie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbFactura_tbEmpleados_Empl_Id` FOREIGN KEY (`Empl_Id`) REFERENCES `gral_tbempleados` (`Empl_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbFactura_tbMetodosPago_Mepa_Id` FOREIGN KEY (`Mepa_Id`) REFERENCES `gral_tbmetodospago` (`Mepa_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbFactura_tbUsuarios_Fact_UsuarioCreacion` FOREIGN KEY (`Fact_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbFactura_tbUsuarios_Fact_UsuarioModificacion` FOREIGN KEY (`Fact_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbfactura`
--

LOCK TABLES `vent_tbfactura` WRITE;
/*!40000 ALTER TABLE `vent_tbfactura` DISABLE KEYS */;
INSERT INTO `vent_tbfactura` VALUES (203,1,5,1,11,'2024-05-21 12:38:47',11,'2024-05-21 12:39:09',1,0,'2024-05-21 12:39:09',4,230.00,2300.00),(204,1,5,1,11,'2024-05-21 12:39:27',NULL,NULL,1,1,NULL,4,0.00,0.00),(205,3,5,4,11,'2024-05-21 12:39:41',2,'2024-05-22 15:41:33',1,1,NULL,3,0.00,0.00),(206,1,5,7,11,'2024-05-21 12:39:54',11,'2024-05-21 12:41:24',1,0,'2024-05-21 12:41:24',4,0.00,0.00),(207,1,5,1,11,'2024-05-21 13:03:19',15,'2024-05-22 16:55:58',1,1,NULL,4,0.00,0.00),(208,1,5,1,11,'2024-05-21 13:05:50',2,'2024-05-22 15:41:37',1,1,NULL,3,0.00,0.00),(209,1,5,1,11,'2024-05-21 13:12:53',NULL,NULL,1,1,NULL,4,0.00,0.00),(210,1,5,1,11,'2024-05-21 13:16:58',NULL,NULL,1,1,NULL,4,0.00,0.00),(211,1,5,1,11,'2024-05-21 13:27:48',2,'2024-05-22 15:41:36',1,1,NULL,3,0.00,0.00),(212,1,5,1,11,'2024-05-21 13:36:47',11,'2024-05-21 13:37:46',1,0,'2024-05-21 13:37:46',4,5.00,1500.00),(213,1,5,1,11,'2024-05-21 13:38:47',11,'2024-05-21 13:39:01',1,0,'2024-05-21 13:39:01',4,55.00,1550.00),(214,1,3,1,2,'2024-05-21 14:30:03',2,'2024-05-21 14:30:07',1,1,NULL,3,0.00,0.00),(215,1,3,1,2,'2024-05-21 14:35:10',2,'2024-05-21 14:35:14',1,1,NULL,3,0.00,0.00),(216,1,3,1,2,'2024-05-21 14:36:19',2,'2024-05-21 14:36:25',1,1,NULL,3,0.00,0.00),(217,1,3,1,2,'2024-05-21 14:47:04',NULL,NULL,1,1,NULL,3,0.00,0.00),(218,1,3,1,2,'2024-05-21 14:47:50',NULL,NULL,1,1,NULL,3,0.00,0.00),(219,1,3,1,2,'2024-05-21 14:50:52',11,'2024-05-22 01:01:12',1,0,'2024-05-22 01:01:12',4,505.00,2000.00),(220,1,3,1,2,'2024-05-21 15:58:29',2,'2024-05-21 15:58:35',1,0,'2024-05-21 15:58:35',3,2.20,16.00),(221,1,3,1,2,'2024-05-21 16:27:05',2,'2024-05-21 16:27:15',1,0,'2024-05-21 16:27:15',3,105.00,1600.00),(222,1,3,1,2,'2024-05-21 16:27:34',2,'2024-05-21 16:27:40',1,0,'2024-05-21 16:27:40',3,105.00,1600.00),(223,1,5,4,11,'2024-05-22 00:52:26',11,'2024-05-22 00:52:28',1,0,'2024-05-22 00:52:28',4,0.00,0.00),(224,1,3,1,2,'2024-05-22 15:38:55',2,'2024-05-22 15:38:59',1,1,NULL,3,0.00,0.00),(225,1,3,1,2,'2024-05-22 15:40:44',2,'2024-05-22 15:40:48',1,1,NULL,3,0.00,0.00),(226,1,5,1,11,'2024-05-22 15:48:45',NULL,NULL,1,1,NULL,4,0.00,0.00),(227,1,3,1,2,'2024-05-22 16:43:37',NULL,NULL,1,1,NULL,3,0.00,0.00),(228,1,3,1,2,'2024-05-22 16:46:04',2,'2024-05-22 16:46:22',1,0,'2024-05-22 16:46:22',3,80800.00,90000.00),(229,1,3,1,2,'2024-05-24 17:26:45',2,'2024-05-24 17:26:54',1,0,'2024-05-24 17:26:54',3,1124.00,4114.00),(230,9,3,1,2,'2024-05-24 23:59:25',2,'2024-05-24 23:59:35',1,0,'2024-05-24 23:59:35',3,505.00,2000.00),(231,1,3,1,2,'2024-05-25 00:03:36',2,'2024-05-25 00:03:40',1,0,'2024-05-25 00:03:40',3,1425.00,2000.00),(232,1,3,1,2,'2024-05-25 01:45:02',NULL,NULL,1,1,NULL,3,0.00,0.00),(233,1,3,1,2,'2024-05-25 01:46:06',2,'2024-05-25 01:46:12',1,0,'2024-05-25 01:46:12',3,505.00,2000.00),(234,1,3,1,2,'2024-05-25 01:53:37',2,'2024-05-25 01:53:44',1,0,'2024-05-25 01:53:44',3,505.00,2000.00),(235,1,3,1,2,'2024-05-25 01:55:12',2,'2024-05-25 01:55:14',1,1,NULL,3,0.00,0.00),(236,1,3,1,2,'2024-05-25 01:56:12',2,'2024-05-25 01:56:16',1,0,'2024-05-25 01:56:16',3,10960.00,12455.00),(237,1,3,1,2,'2024-05-25 01:56:29',2,'2024-05-25 01:56:34',1,0,'2024-05-25 01:56:34',3,13071.00,14566.00),(238,1,3,1,2,'2024-05-25 01:57:56',2,'2024-05-25 01:57:59',1,1,NULL,3,0.00,0.00),(239,1,3,1,2,'2024-05-25 01:58:30',2,'2024-05-25 01:58:37',1,0,'2024-05-25 01:58:37',3,18505.00,20000.00),(240,1,3,1,2,'2024-05-25 01:59:48',2,'2024-05-25 01:59:55',1,1,NULL,3,0.00,0.00),(241,1,3,1,2,'2024-05-25 02:01:04',2,'2024-05-25 02:01:05',1,1,NULL,3,0.00,0.00),(242,1,3,1,2,'2024-05-25 02:01:15',NULL,NULL,1,1,NULL,3,0.00,0.00),(243,1,3,1,2,'2024-05-25 02:07:14',2,'2024-05-25 02:07:18',1,0,'2024-05-25 02:07:18',3,505.00,2000.00),(244,1,3,1,2,'2024-05-25 02:07:44',2,'2024-05-25 02:07:50',1,0,'2024-05-25 02:07:50',3,2505.00,4000.00),(245,1,5,1,9,'2024-05-27 08:58:03',9,'2024-05-27 08:58:07',1,1,NULL,3,0.00,0.00),(246,1,5,1,9,'2024-05-27 08:58:27',9,'2024-05-27 08:58:35',1,0,'2024-05-27 08:58:35',3,505.00,2000.00);
/*!40000 ALTER TABLE `vent_tbfactura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbfacturacompradetalle`
--

DROP TABLE IF EXISTS `vent_tbfacturacompradetalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbfacturacompradetalle` (
  `FaCD_Id` int(11) NOT NULL,
  `FaCE_Id` int(11) DEFAULT NULL,
  `FaCD_Dif` tinyint(1) DEFAULT NULL,
  `Prod_Id` int(11) DEFAULT NULL,
  `FaCD_Cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`FaCD_Id`),
  KEY `FK_FacturaencabezadoCompra_FaCE_Id` (`FaCE_Id`),
  CONSTRAINT `FK_FacturaencabezadoCompra_FaCE_Id` FOREIGN KEY (`FaCE_Id`) REFERENCES `vent_tbfacturacompraencabezado` (`FaCE_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbfacturacompradetalle`
--

LOCK TABLES `vent_tbfacturacompradetalle` WRITE;
/*!40000 ALTER TABLE `vent_tbfacturacompradetalle` DISABLE KEYS */;
INSERT INTO `vent_tbfacturacompradetalle` VALUES (1,4,1,13,20),(2,4,1,13,20),(3,4,1,13,20),(4,4,1,13,20),(5,4,1,16,20),(6,3,1,13,20),(7,3,1,13,20),(9,3,1,13,20),(10,3,0,10,20),(12,3,0,10,40),(13,5,0,20,80),(14,5,0,13,80),(16,10,1,29,40),(17,10,1,29,40),(18,16,1,34,10),(19,24,1,36,123),(20,25,1,37,123),(21,26,1,36,123),(23,28,1,16,11),(24,29,1,16,11),(25,30,1,34,12),(28,33,1,39,23),(29,34,1,36,1),(30,35,1,41,12),(32,37,1,39,2),(33,37,1,39,2),(34,37,1,42,300),(35,38,1,36,12),(36,39,1,37,123),(38,41,1,39,1),(40,43,1,34,12),(42,45,1,43,23),(43,45,1,43,23),(44,45,1,43,23),(46,52,1,43,123),(47,4,1,37,123),(48,4,1,16,123),(51,9,0,16,123),(58,9,1,16,1),(59,9,1,16,22),(60,54,1,45,12),(61,54,1,45,12),(62,54,1,45,12),(63,54,1,45,12),(64,54,1,45,12),(65,54,1,45,12),(66,54,1,36,98),(67,54,1,36,98),(68,54,1,36,20000),(69,55,0,26,12),(70,55,1,37,12),(71,55,0,26,12123),(72,55,0,13,12123),(73,55,1,46,12123),(74,55,1,43,12123),(75,55,0,16,12123),(76,55,0,26,12123),(77,55,0,26,12123),(78,55,0,16,12123),(79,57,0,17,123),(80,57,0,10,123),(81,57,1,32,123),(82,57,1,33,123),(83,57,1,47,123),(84,57,0,17,123),(85,79,1,32,1),(86,79,0,10,1),(87,79,0,87,20),(88,80,1,34,12),(89,81,0,89,12),(90,81,0,89,3),(91,81,0,89,3),(92,82,0,87,100),(93,83,0,13,6),(94,93,0,13,2),(95,94,1,39,12),(96,94,1,39,12),(97,95,1,37,12),(98,96,1,31,12),(99,96,1,59,12),(100,1,1,64,12),(101,1,1,64,90),(102,2,1,65,90),(103,2,1,65,90),(104,5,1,66,90),(105,5,1,67,30),(106,10,1,67,30),(107,1,1,46,30),(108,10,1,68,30),(109,10,1,69,30),(110,10,1,69,30),(111,10,0,92,30),(112,10,0,92,30),(113,10,0,93,30),(114,1,0,94,30),(115,1,0,94,40),(116,2,0,95,40),(117,96,1,70,12),(118,96,1,70,10),(119,97,1,71,1),(120,97,1,71,1),(122,98,1,72,10),(124,98,1,37,10),(125,99,1,73,123),(126,99,1,74,123),(127,99,1,39,123),(128,99,1,39,123),(129,100,1,37,1),(130,101,1,37,123),(131,101,1,75,123),(132,102,1,76,1),(133,103,1,77,12),(134,103,1,77,12),(135,103,1,77,12),(136,103,1,77,12),(137,103,1,77,12),(138,104,1,78,1),(140,106,1,81,123),(141,106,1,81,123),(142,106,1,81,123),(143,106,1,81,123),(144,106,1,81,123),(145,106,1,81,123),(146,106,1,81,123),(147,106,1,81,123),(148,107,1,82,2),(149,107,0,97,2),(150,107,0,97,2),(151,108,1,74,123),(152,108,0,98,123),(153,108,0,98,123),(154,108,0,98,123),(155,108,0,98,123),(156,108,0,99,123),(157,109,1,74,12),(159,109,0,100,12),(176,112,1,59,12),(177,112,1,59,12),(178,112,1,59,12),(179,112,1,59,12),(180,112,1,59,12),(181,112,1,59,12),(188,112,1,31,12),(194,113,1,64,12),(195,58,0,102,123),(196,114,1,82,12),(197,114,1,82,12),(198,114,1,82,12),(199,114,1,82,12),(200,114,1,82,12),(201,114,1,82,12),(202,115,1,85,12),(203,115,1,85,12),(204,116,1,85,123),(205,116,1,85,123),(206,116,0,103,123),(207,116,0,103,123),(208,116,0,103,123),(209,116,0,103,123),(210,116,0,103,123),(211,116,0,103,123),(212,117,1,75,123),(213,118,1,86,20);
/*!40000 ALTER TABLE `vent_tbfacturacompradetalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbfacturacompraencabezado`
--

DROP TABLE IF EXISTS `vent_tbfacturacompraencabezado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbfacturacompraencabezado` (
  `FaCE_Id` int(11) NOT NULL,
  `Prov_Id` int(11) DEFAULT NULL,
  `Mepa_Id` int(11) DEFAULT NULL,
  `FaCE_fechafinalizacion` datetime DEFAULT NULL,
  `FeCE_UsuarioCreacion` int(11) DEFAULT NULL,
  `FaCE_FechaCreacion` datetime DEFAULT NULL,
  `FaCE_UsuarioModificacion` int(11) DEFAULT NULL,
  `FaCE_FechaModificacion` datetime DEFAULT NULL,
  `FaCE_Etado` tinyint(1) DEFAULT 1,
  `FaCE_Finalizada` tinyint(1) DEFAULT NULL,
  `Sucu_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`FaCE_Id`),
  KEY `FK_FacCompraSucu_Id` (`Sucu_Id`),
  KEY `FK_MedotoPagoFacCompra_Mepa_Id` (`Mepa_Id`),
  KEY `FK_ProveedorFacCompra_Prov_Id` (`Prov_Id`),
  KEY `FK_UsuarioCreacion` (`FeCE_UsuarioCreacion`),
  KEY `FK_UsuarioModificacion` (`FaCE_UsuarioModificacion`),
  CONSTRAINT `FK_FacCompraSucu_Id` FOREIGN KEY (`Sucu_Id`) REFERENCES `gral_tbsucursales` (`Sucu_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_MedotoPagoFacCompra_Mepa_Id` FOREIGN KEY (`Mepa_Id`) REFERENCES `gral_tbmetodospago` (`Mepa_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_ProveedorFacCompra_Prov_Id` FOREIGN KEY (`Prov_Id`) REFERENCES `gral_tbproveedores` (`Prov_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_UsuarioCreacion` FOREIGN KEY (`FeCE_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_UsuarioModificacion` FOREIGN KEY (`FaCE_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbfacturacompraencabezado`
--

LOCK TABLES `vent_tbfacturacompraencabezado` WRITE;
/*!40000 ALTER TABLE `vent_tbfacturacompraencabezado` DISABLE KEYS */;
INSERT INTO `vent_tbfacturacompraencabezado` VALUES (1,10,1,'2024-05-12 23:45:56',1,NULL,NULL,NULL,1,1,NULL),(2,1,4,'2024-05-12 23:46:26',10,'2024-05-08 00:00:00',NULL,NULL,1,1,NULL),(3,10,4,NULL,10,'2024-05-08 00:00:00',NULL,NULL,0,0,NULL),(4,10,4,'2024-05-12 23:58:57',10,'2024-05-08 00:00:00',NULL,NULL,1,1,NULL),(5,5,7,'2024-05-09 19:24:31',10,'2024-05-08 00:00:00',10,'2024-05-09 14:25:34',1,1,NULL),(6,10,4,NULL,2,'2024-05-15 17:32:06',NULL,NULL,1,0,NULL),(7,10,4,NULL,10,'2024-05-08 00:00:00',NULL,NULL,1,0,NULL),(8,10,4,NULL,2,'2024-05-15 17:32:58',NULL,NULL,1,0,NULL),(9,10,4,'2024-05-15 17:39:15',2,'2024-05-15 17:39:15',NULL,NULL,1,1,NULL),(10,5,7,'2024-05-09 19:26:37',10,'2024-05-08 00:00:00',10,'2024-05-09 14:27:29',0,1,NULL),(11,10,4,'2024-05-15 17:38:13',2,'2024-05-15 17:38:13',NULL,NULL,1,1,NULL),(12,10,1,'2024-05-15 17:36:31',2,'2024-05-15 17:34:05',NULL,NULL,1,1,NULL),(13,10,4,NULL,10,'2024-05-08 00:00:00',NULL,NULL,1,0,NULL),(14,3,7,NULL,10,'2024-05-09 13:47:37',1,'2024-05-09 14:11:41',1,1,NULL),(15,3,7,'2024-05-09 18:57:45',10,'2024-05-09 13:58:09',NULL,NULL,1,0,NULL),(16,10,7,NULL,1,'2024-05-11 18:17:47',NULL,NULL,1,0,NULL),(17,7,7,NULL,1,'2024-05-12 03:59:56',NULL,NULL,1,0,NULL),(18,7,7,NULL,1,'2024-05-12 04:00:37',NULL,NULL,1,0,NULL),(19,7,7,NULL,1,'2024-05-12 04:07:21',NULL,NULL,1,0,NULL),(20,7,7,NULL,1,'2024-05-12 04:09:06',NULL,NULL,1,0,NULL),(21,7,7,NULL,1,'2024-05-12 04:09:30',NULL,NULL,1,0,NULL),(22,7,7,NULL,1,'2024-05-12 04:10:40',NULL,NULL,1,0,NULL),(23,7,7,NULL,1,'2024-05-12 04:13:07',NULL,NULL,1,0,NULL),(24,7,7,NULL,1,'2024-05-12 04:15:15',NULL,NULL,1,0,NULL),(25,10,7,NULL,1,'2024-05-12 04:19:33',NULL,NULL,1,0,NULL),(26,7,7,NULL,1,'2024-05-12 03:28:53',NULL,NULL,1,0,NULL),(27,7,7,NULL,1,'2024-05-12 15:56:06',NULL,NULL,1,0,NULL),(28,10,7,NULL,1,'2024-05-12 16:01:28',NULL,NULL,1,0,NULL),(29,10,7,NULL,1,'2024-05-12 16:01:31',NULL,NULL,1,0,NULL),(30,10,7,NULL,1,'2024-05-12 16:10:41',NULL,NULL,1,0,NULL),(31,10,7,NULL,1,'2024-05-12 16:11:02',NULL,NULL,1,0,NULL),(32,7,7,NULL,1,'2024-05-12 16:12:23',NULL,NULL,1,0,NULL),(33,7,7,NULL,1,'2024-05-12 16:13:33',NULL,NULL,1,0,NULL),(34,7,7,NULL,1,'2024-05-12 16:21:18',NULL,NULL,1,0,NULL),(35,7,7,NULL,1,'2024-05-12 16:25:47',NULL,NULL,1,0,NULL),(36,7,7,NULL,1,'2024-05-12 16:33:09',NULL,NULL,1,0,NULL),(37,7,7,NULL,1,'2024-05-12 16:39:59',NULL,NULL,1,0,NULL),(38,7,7,NULL,1,'2024-05-12 16:51:55',NULL,NULL,1,0,NULL),(39,10,7,NULL,1,'2024-05-12 16:56:30',NULL,NULL,1,0,NULL),(40,10,7,NULL,1,'2024-05-12 17:18:28',NULL,NULL,1,0,NULL),(41,7,7,NULL,1,'2024-05-12 17:26:07',NULL,NULL,1,0,NULL),(42,11,7,NULL,1,'2024-05-12 17:40:42',NULL,NULL,1,0,NULL),(43,10,7,NULL,1,'2024-05-12 18:03:09',NULL,NULL,1,0,NULL),(44,10,7,NULL,1,'2024-05-12 20:15:05',NULL,NULL,1,0,NULL),(45,10,1,NULL,1,'2024-05-12 20:37:41',NULL,NULL,1,0,NULL),(52,10,7,NULL,1,'2024-05-12 21:06:49',NULL,NULL,1,0,NULL),(53,11,7,'2024-05-12 23:59:08',1,'2024-05-12 22:35:36',NULL,NULL,1,1,NULL),(54,7,7,NULL,1,'2024-05-13 11:43:27',NULL,NULL,1,0,NULL),(55,10,7,NULL,1,'2024-05-13 12:02:33',NULL,NULL,1,0,NULL),(56,11,7,NULL,1,'2024-05-13 12:30:50',NULL,NULL,1,0,NULL),(57,11,7,NULL,1,'2024-05-13 12:31:02',NULL,NULL,1,0,NULL),(58,11,1,NULL,14,'2024-05-22 14:04:53',NULL,NULL,1,0,4),(59,11,1,NULL,1,'2024-05-13 12:35:03',NULL,NULL,1,0,NULL),(60,11,1,NULL,1,'2024-05-13 12:35:03',NULL,NULL,1,0,NULL),(61,11,1,NULL,1,'2024-05-13 12:35:06',NULL,NULL,1,0,NULL),(62,11,1,NULL,1,'2024-05-13 12:35:06',NULL,NULL,1,0,NULL),(63,11,1,NULL,1,'2024-05-13 12:35:06',NULL,NULL,1,0,NULL),(64,11,1,NULL,1,'2024-05-13 12:35:17',NULL,NULL,1,0,NULL),(65,11,1,NULL,1,'2024-05-13 12:35:18',NULL,NULL,1,0,NULL),(66,11,1,NULL,1,'2024-05-13 12:35:18',NULL,NULL,1,0,NULL),(67,11,1,NULL,1,'2024-05-13 12:35:18',NULL,NULL,1,0,NULL),(68,11,1,NULL,1,'2024-05-13 12:35:19',NULL,NULL,1,0,NULL),(69,11,1,NULL,1,'2024-05-13 12:35:19',NULL,NULL,1,0,NULL),(70,11,1,NULL,1,'2024-05-13 12:35:19',NULL,NULL,1,0,NULL),(71,11,1,NULL,1,'2024-05-13 12:35:19',NULL,NULL,1,0,NULL),(72,11,1,NULL,1,'2024-05-13 12:35:22',NULL,NULL,1,0,NULL),(73,11,1,NULL,1,'2024-05-13 12:36:14',NULL,NULL,1,0,NULL),(74,11,1,NULL,1,'2024-05-13 12:36:18',NULL,NULL,1,0,NULL),(75,11,1,NULL,1,'2024-05-13 12:36:18',NULL,NULL,1,0,NULL),(76,11,1,NULL,1,'2024-05-13 12:36:18',NULL,NULL,1,0,NULL),(77,11,1,NULL,1,'2024-05-13 12:36:53',NULL,NULL,1,0,NULL),(78,11,1,NULL,1,'2024-05-13 12:37:49',NULL,NULL,1,0,NULL),(79,11,7,'2024-05-13 12:43:10',1,'2024-05-13 12:38:34',NULL,NULL,1,1,NULL),(80,10,1,NULL,1,'2024-05-13 12:46:47',NULL,NULL,1,0,NULL),(81,10,7,NULL,1,'2024-05-13 13:15:16',NULL,NULL,1,0,NULL),(82,11,7,NULL,1,'2024-05-13 13:17:14',NULL,NULL,1,0,NULL),(83,10,7,NULL,1,'2024-05-15 03:12:26',NULL,NULL,1,0,NULL),(84,10,4,NULL,1,'2024-05-15 16:58:55',NULL,NULL,1,0,NULL),(85,10,4,NULL,1,'2024-05-15 16:58:58',NULL,NULL,1,0,NULL),(86,10,4,NULL,1,'2024-05-15 17:00:02',NULL,NULL,1,0,NULL),(87,10,7,NULL,1,'2024-05-15 17:00:56',NULL,NULL,1,0,NULL),(88,10,4,NULL,1,'2024-05-15 17:01:20',NULL,NULL,1,0,NULL),(89,10,4,NULL,1,'2024-05-15 17:02:33',NULL,NULL,1,0,NULL),(90,10,4,NULL,1,'2024-05-15 17:02:45',NULL,NULL,1,0,NULL),(91,10,4,NULL,1,'2024-05-15 17:02:49',NULL,NULL,1,0,NULL),(92,10,4,NULL,1,'2024-05-15 17:03:38',NULL,NULL,1,0,NULL),(93,10,7,NULL,2,'2024-05-15 17:42:33',NULL,NULL,1,0,NULL),(94,7,4,NULL,10,'2024-05-16 14:44:42',NULL,NULL,1,0,NULL),(95,10,7,NULL,10,'2024-05-16 15:10:55',NULL,NULL,1,0,NULL),(96,11,7,NULL,10,'2024-05-16 15:11:14',NULL,NULL,1,0,NULL),(97,10,7,NULL,10,'2024-05-17 00:57:11',NULL,NULL,1,0,4),(98,10,7,'2024-05-17 17:15:33',10,'2024-05-17 17:15:33',NULL,NULL,1,1,4),(99,7,7,NULL,10,'2024-05-17 17:16:34',NULL,NULL,1,0,4),(100,10,7,NULL,10,'2024-05-17 17:32:39',NULL,NULL,1,0,4),(101,10,7,NULL,10,'2024-05-17 17:35:57',NULL,NULL,1,0,4),(102,10,7,'2024-05-17 17:41:41',10,'2024-05-17 17:41:41',NULL,NULL,1,1,4),(103,3,7,NULL,10,'2024-05-17 17:42:12',NULL,NULL,1,0,3),(104,11,7,'2024-05-17 17:43:56',10,'2024-05-17 17:43:56',NULL,NULL,1,1,4),(105,10,7,NULL,10,'2024-05-17 19:10:28',NULL,NULL,1,0,4),(106,10,7,'2024-05-21 22:04:56',10,'2024-05-21 22:04:56',NULL,NULL,1,1,4),(107,7,7,NULL,10,'2024-05-22 00:25:46',NULL,NULL,1,0,4),(108,7,7,NULL,10,'2024-05-22 00:32:42',NULL,NULL,1,0,3),(109,7,7,NULL,10,'2024-05-22 00:37:45',NULL,NULL,1,0,4),(110,7,7,NULL,10,'2024-05-22 01:01:21',NULL,NULL,1,0,4),(111,10,7,NULL,10,'2024-05-22 01:11:31',NULL,NULL,1,0,4),(112,11,7,NULL,10,'2024-05-22 13:07:03',NULL,NULL,1,0,4),(113,10,7,NULL,14,'2024-05-22 14:00:14',NULL,NULL,1,0,4),(114,7,7,NULL,14,'2024-05-22 14:21:06',NULL,NULL,1,0,4),(115,7,7,NULL,14,'2024-05-22 14:22:18',NULL,NULL,1,0,7),(116,7,7,NULL,14,'2024-05-22 13:36:24',NULL,NULL,1,0,4),(117,10,7,'2024-05-22 13:38:08',14,'2024-05-22 13:38:07',NULL,NULL,1,1,7),(118,7,7,NULL,2,'2024-05-22 16:45:51',NULL,NULL,1,0,3);
/*!40000 ALTER TABLE `vent_tbfacturacompraencabezado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbfacturadetalles`
--

DROP TABLE IF EXISTS `vent_tbfacturadetalles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbfacturadetalles` (
  `FaxD_Id` int(11) NOT NULL,
  `FaxD_Dif` tinyint(1) DEFAULT NULL,
  `Prod_Id` int(11) DEFAULT NULL,
  `FaxD_Cantidad` int(11) DEFAULT NULL,
  `Fact_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`FaxD_Id`),
  KEY `tbFacturaDetalles_tbFactura_Fact_Id` (`Fact_Id`),
  CONSTRAINT `tbFacturaDetalles_tbFactura_Fact_Id` FOREIGN KEY (`Fact_Id`) REFERENCES `vent_tbfactura` (`Fact_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbfacturadetalles`
--

LOCK TABLES `vent_tbfacturadetalles` WRITE;
/*!40000 ALTER TABLE `vent_tbfacturadetalles` DISABLE KEYS */;
INSERT INTO `vent_tbfacturadetalles` VALUES (1931,1,16,1,203),(1932,0,10,1,203),(1933,0,10,1,204),(1934,0,10,3,205),(1935,0,10,1,206),(1936,1,14,1,207),(1937,1,16,1,208),(1938,1,14,1,209),(1939,1,16,1,210),(1940,1,14,1,211),(1941,1,16,1,212),(1942,1,14,1,213),(1943,1,14,1,214),(1944,1,14,1,215),(1945,1,14,1,216),(1946,1,14,1,217),(1947,1,14,1,218),(1948,1,14,1,219),(1949,1,14,6,220),(1950,1,14,1,221),(1951,1,14,1,222),(1952,1,16,1,223),(1953,1,14,1,224),(1954,1,14,1,225),(1955,1,14,1,226),(1956,1,16,14,227),(1957,1,86,20,228),(1958,1,16,1,229),(1959,1,16,1,229),(1960,1,16,1,230),(1961,0,10,1,231),(1962,1,16,1,232),(1963,1,16,1,233),(1964,1,16,1,234),(1965,1,16,1,235),(1966,1,16,1,236),(1967,1,16,1,237),(1968,1,16,1,238),(1969,1,16,1,239),(1970,1,16,1,240),(1971,1,16,1,241),(1972,1,16,1,242),(1973,1,16,1,243),(1974,1,16,1,244),(1975,1,16,1,245),(1976,1,16,1,246);
/*!40000 ALTER TABLE `vent_tbfacturadetalles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbjoyas`
--

DROP TABLE IF EXISTS `vent_tbjoyas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbjoyas` (
  `Joya_Id` int(11) NOT NULL,
  `Joya_Nombre` varchar(60) NOT NULL,
  `Joya_PrecioCompra` decimal(8,2) NOT NULL,
  `Joya_PrecioVenta` decimal(8,2) NOT NULL,
  `Joya_PrecioMayor` decimal(8,2) NOT NULL,
  `Joya_Imagen` longtext NOT NULL,
  `Prov_Id` int(11) NOT NULL,
  `Mate_Id` int(11) NOT NULL,
  `Cate_Id` int(11) NOT NULL,
  `Joya_UsuarioCreacion` int(11) DEFAULT NULL,
  `Joya_FechaCreacion` datetime DEFAULT NULL,
  `Joya_UsuarioModificacion` int(11) DEFAULT NULL,
  `Joya_FechaModificacion` datetime DEFAULT NULL,
  `Joya_Estado` tinyint(1) DEFAULT 1,
  `Joya_Stock` int(11) DEFAULT 0,
  PRIMARY KEY (`Joya_Id`),
  KEY `tbJoyas_tbCategorias_Cate_Id` (`Cate_Id`),
  KEY `tbJoyas_tbMateriales_Mate_Id` (`Mate_Id`),
  KEY `tbJoyas_tbProveedores_Prov_Id` (`Prov_Id`),
  KEY `tbJoyas_tbUsuarios_Joya_UsuarioCreacion` (`Joya_UsuarioCreacion`),
  KEY `tbJoyas_tbUsuarios_Joya_UsuarioModificacion` (`Joya_UsuarioModificacion`),
  CONSTRAINT `tbJoyas_tbCategorias_Cate_Id` FOREIGN KEY (`Cate_Id`) REFERENCES `gral_tbcategorias` (`Cate_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbJoyas_tbMateriales_Mate_Id` FOREIGN KEY (`Mate_Id`) REFERENCES `gral_tbmateriales` (`Mate_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbJoyas_tbProveedores_Prov_Id` FOREIGN KEY (`Prov_Id`) REFERENCES `gral_tbproveedores` (`Prov_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbJoyas_tbUsuarios_Joya_UsuarioCreacion` FOREIGN KEY (`Joya_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbJoyas_tbUsuarios_Joya_UsuarioModificacion` FOREIGN KEY (`Joya_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbjoyas`
--

LOCK TABLES `vent_tbjoyas` WRITE;
/*!40000 ALTER TABLE `vent_tbjoyas` DISABLE KEYS */;
INSERT INTO `vent_tbjoyas` VALUES (13,'Cadena Mariposa',133.00,600.00,400.00,'1716311882234-841085119-cadena-mariposa.jpg',11,1,1,1,'2024-05-06 18:59:58',11,'2024-05-21 11:18:04',1,50),(14,'Pulsera Pandora',133.00,1300.00,2.00,'1715044355785-239617251-Fondo.png',11,1,1,1,'2024-05-06 19:12:38',11,'2024-05-17 15:56:10',1,231),(16,'Pulsera Pandora',133.00,1300.00,2.00,'1715044355785-239617251-Fondo.png',10,1,1,1,'2024-05-09 00:00:00',2,'2024-05-17 16:33:29',1,185),(20,'Cadena Mariposa',133.00,600.00,400.00,'1716311901244-790015228-cadena-mariposa.jpg',10,1,1,10,'2024-05-08 00:00:00',11,'2024-05-21 11:18:22',1,0),(29,'Pulsera Pandora',133.00,1300.00,2.00,'1715044355785-239617251-Fondo.png',5,1,1,10,'2024-05-08 00:00:00',NULL,NULL,1,0),(30,'rubi',123.00,123.00,5.00,'1716312301246-442763263-rubies.png',11,1,3,1,'2024-05-11 01:02:01',11,'2024-05-21 11:25:02',1,25),(31,'Mim',123.00,123.00,123.00,'1715411016443-7751913-GBiK61ebcAA_Awn.jpg',11,1,1,1,'2024-05-11 01:04:01',NULL,NULL,1,44),(32,'esmeralda',13.00,12390.00,1235.00,'1715482877343-923319358-42e896a87a63ffe9a927aca1e6d6b309.png',11,1,3,1,'2024-05-11 21:01:18',NULL,NULL,1,148),(33,'Waos',123.00,123.00,123.00,'1715489267689-465376419-eiden_png.png',11,1,3,1,'2024-05-11 22:47:49',NULL,NULL,1,147),(34,'esmeralda',1234.00,12390.00,1235.00,'1715482877343-923319358-42e896a87a63ffe9a927aca1e6d6b309.png',10,1,3,1,'2024-05-11 18:17:47',NULL,NULL,1,169),(36,'esmeralda',123.00,12390.00,1235.00,'1715482877343-923319358-42e896a87a63ffe9a927aca1e6d6b309.png',7,1,3,1,'2024-05-12 04:15:15',NULL,NULL,1,20455),(37,'Mim',123.00,123.00,123.00,'1715411016443-7751913-GBiK61ebcAA_Awn.jpg',10,1,1,1,'2024-05-12 04:19:33',NULL,NULL,1,539),(38,'Cadena Mariposa',123.00,600.00,400.00,'1716311912429-392921924-cadena-mariposa.jpg',7,1,1,1,'2024-05-12 15:56:06',11,'2024-05-21 11:18:34',1,0),(39,'Mim',123.00,123.00,123.00,'1715411016443-7751913-GBiK61ebcAA_Awn.jpg',7,1,1,1,'2024-05-12 16:12:23',NULL,NULL,1,333),(41,'rubi',123.00,123.00,5.00,'1716312334578-181427330-rubies.png',7,1,3,1,'2024-05-12 16:25:47',11,'2024-05-21 11:25:35',1,0),(42,'Pulsera Pandora',12355.00,1300.00,2.00,'1715044355785-239617251-Fondo.png',7,1,1,1,'2024-05-12 16:39:59',NULL,NULL,1,300),(43,'Waos',12.00,123.00,123.00,'1715489267689-465376419-eiden_png.png',10,1,3,1,'2024-05-12 20:37:41',NULL,NULL,1,12461),(44,'Playa',200.00,123.00,123.00,'1715610357340-165568077-Tree.png',3,3,2,1,'2024-05-13 08:27:01',NULL,NULL,1,1),(45,'vanguardia',125.00,400.00,390.00,'1715622092040-327448421-OIP.jpg',7,3,4,1,'2024-05-13 11:41:39',NULL,NULL,1,73),(46,'rubi',209.00,123.00,5.00,'1716312324766-818734647-rubies.png',10,1,3,1,'2024-05-13 12:02:33',11,'2024-05-21 11:25:25',1,30),(47,'vanguardia',123.00,400.00,390.00,'1715622092040-327448421-OIP.jpg',11,3,4,1,'2024-05-13 12:31:02',NULL,NULL,1,123),(48,'JoyaOros',300.00,200.00,400.00,'1715845418180-997742320-anillos de aniversario joyas preciosas anillo.jpg',7,3,1,1,'2024-05-16 01:43:44',1,'2024-05-16 01:44:07',1,20),(49,'JoyaOrossssss',300.00,123.00,123.00,'1715848359396-449902548-anillos de aniversario joyas preciosas anillo.jpg',3,1,1,1,'2024-05-16 02:32:41',1,'2024-05-16 02:32:48',1,20),(50,'DiamanteEES',144.00,414.00,4141.00,'1715848580639-195405431-anillos de aniversario joyas preciosas anillo.jpg',10,3,1,11,'2024-05-16 02:36:23',11,'2024-05-16 02:36:32',0,23),(64,'juaquin',33.00,34.00,32.00,'NA',10,6,8,1,NULL,NULL,NULL,1,114),(65,'juaquin',209.00,34.00,32.00,'NA',1,6,8,10,'2024-05-08 00:00:00',NULL,NULL,1,180),(66,'juaquin',209.00,34.00,32.00,'NA',5,6,8,10,'2024-05-08 00:00:00',NULL,NULL,1,90),(68,'rubi',10.00,123.00,5.00,'1716312311707-161212215-rubies.png',5,1,3,10,'2024-05-08 00:00:00',11,'2024-05-21 11:25:12',1,30),(69,'Pruebaqwer',209.00,123.00,500.00,'NA',5,6,8,10,'2024-05-08 00:00:00',NULL,NULL,1,60),(70,'Hemertino',132.00,123.00,123.00,'NA',11,6,8,10,'2024-05-16 15:11:14',NULL,NULL,1,22),(71,'JoyaOrossssss',123.00,123.00,123.00,'1715848359396-449902548-anillos de aniversario joyas preciosas anillo.jpg',10,1,1,10,'2024-05-17 00:51:03',NULL,NULL,1,2),(72,'Juana de arco',129.00,140.00,110.00,'NA',10,6,8,10,'2024-05-17 17:04:49',NULL,NULL,1,10),(73,'Playa',123.00,123.00,123.00,'1715610357340-165568077-Tree.png',7,3,2,10,'2024-05-17 17:16:34',NULL,NULL,1,123),(74,'mairan',12.00,12.00,12.00,'NA',7,6,8,10,'2024-05-17 17:16:34',10,'2024-05-22 00:37:13',1,258),(75,'123',123.00,123.00,123.00,'NA',10,6,8,10,'2024-05-17 17:33:31',NULL,NULL,1,246),(76,'cuack',1.00,1.00,1.00,'NA',10,6,8,10,'2024-05-17 17:39:32',NULL,NULL,1,1),(77,'nada',12.00,12.00,1.00,'NA',3,6,8,10,'2024-05-17 17:42:05',NULL,NULL,1,60),(78,'de todo',123.00,123.00,123.00,'NA',11,6,8,10,'2024-05-17 17:43:54',NULL,NULL,1,1),(79,'sis',123.00,123.00,123.00,'NA',10,6,8,10,'2024-05-17 19:10:05',10,'2024-05-22 00:34:55',1,0),(80,'cacaasasdasdadsasdasdasd',123.00,123.00,123.00,'1716350596372-228209001-ventasmayoristas.png',3,4,2,10,'2024-05-21 22:03:04',10,'2024-05-21 22:03:21',0,123),(81,'ca',123.00,123.00,123.00,'NA',10,6,8,10,'2024-05-21 22:04:50',10,'2024-05-22 00:34:10',1,984),(82,'jose',12.00,12.00,12.00,'NA',7,6,8,10,'2024-05-22 00:25:46',NULL,NULL,1,74),(83,'eminem',12.00,123.00,123.00,'NA',7,6,8,10,'2024-05-22 00:37:45',NULL,NULL,1,0),(84,'eminem',123.00,123.00,123.00,'NA',10,6,8,10,'2024-05-22 01:11:31',NULL,NULL,1,984),(85,'Hemertino',123.00,123.00,123.00,'NA',7,6,8,14,'2024-05-22 14:22:17',NULL,NULL,1,270),(86,'Coca Cola',300.00,200.00,400.00,'NA',7,6,8,2,'2024-05-22 16:45:51',NULL,NULL,1,20),(87,'f',3.00,3.00,3.00,'1716414904635-54651593-favicon.ico',10,8,5,15,'2024-05-22 16:55:05',NULL,NULL,1,3);
/*!40000 ALTER TABLE `vent_tbjoyas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbmaquillajes`
--

DROP TABLE IF EXISTS `vent_tbmaquillajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbmaquillajes` (
  `Maqu_Id` int(11) NOT NULL,
  `Maqu_Nombre` varchar(60) NOT NULL,
  `Maqu_PrecioCompra` decimal(8,2) NOT NULL,
  `Maqu_PrecioVenta` decimal(8,2) NOT NULL,
  `Maqu_PrecioMayor` decimal(8,2) NOT NULL,
  `Maqu_Imagen` longtext NOT NULL,
  `Prov_Id` int(11) NOT NULL,
  `Marc_Id` int(11) NOT NULL,
  `Maqu_UsuarioCreacion` int(11) DEFAULT NULL,
  `Maqu_FechaCreacion` datetime DEFAULT NULL,
  `Maqu_UsuarioModificacion` int(11) DEFAULT NULL,
  `Maqu_FechaModificacion` datetime DEFAULT NULL,
  `Maqu_Estado` tinyint(1) DEFAULT 1,
  `Maqu_Stock` int(11) DEFAULT 0,
  PRIMARY KEY (`Maqu_Id`),
  KEY `tbMaquillajes_tbMarcas_Marc_Id` (`Marc_Id`),
  KEY `tbMaquillajes_tbProveedores_Prov_Id` (`Prov_Id`),
  KEY `tbMaquillajes_tbUsuarios_Maqu_UsuarioCreacion` (`Maqu_UsuarioCreacion`),
  KEY `tbMaquillajes_tbUsuarios_Maqu_UsuarioModificacion` (`Maqu_UsuarioModificacion`),
  CONSTRAINT `tbMaquillajes_tbMarcas_Marc_Id` FOREIGN KEY (`Marc_Id`) REFERENCES `gral_tbmarcas` (`Marc_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMaquillajes_tbProveedores_Prov_Id` FOREIGN KEY (`Prov_Id`) REFERENCES `gral_tbproveedores` (`Prov_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMaquillajes_tbUsuarios_Maqu_UsuarioCreacion` FOREIGN KEY (`Maqu_UsuarioCreacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tbMaquillajes_tbUsuarios_Maqu_UsuarioModificacion` FOREIGN KEY (`Maqu_UsuarioModificacion`) REFERENCES `acce_tbusuarios` (`Usua_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbmaquillajes`
--

LOCK TABLES `vent_tbmaquillajes` WRITE;
/*!40000 ALTER TABLE `vent_tbmaquillajes` DISABLE KEYS */;
INSERT INTO `vent_tbmaquillajes` VALUES (10,'Labial',13.00,500.00,200.00,'1716312208597-375026973-_101911569_1.jpg',11,3,1,'2024-05-06 20:17:11',11,'2024-05-21 11:23:29',1,62),(13,'Labial',300.00,500.00,200.00,'1716312218605-794084538-_101911569_1.jpg',10,3,10,'2024-05-08 00:00:00',11,'2024-05-21 11:23:39',1,12402),(15,'Labial',123.00,500.00,200.00,'1716312230363-156236208-_101911569_1.jpg',5,3,10,'2024-05-08 00:00:00',11,'2024-05-21 11:23:51',1,2),(16,'Prueba',12.00,12.00,12.00,'1715291952416-770720104-OIP.jpg',10,3,1,'2024-05-09 15:59:45',1,'2024-05-10 01:15:16',1,24217),(17,'Base',123.00,123.00,123.00,'',11,3,1,'2024-05-11 01:57:38',NULL,NULL,1,246),(21,'Imagen',300.00,500.00,300.00,'1715610266801-516526787-sfaf.png',3,3,1,'2024-05-13 08:24:34',NULL,NULL,1,2),(26,'Pruebaqweqwe',12.00,12.00,12.00,'',10,3,1,'2024-05-13 11:37:30',NULL,NULL,1,36392),(27,'Pruebaqwer',12.00,121.00,500.00,'',7,3,1,'2024-05-13 11:41:08',NULL,NULL,1,11),(63,'Proveedor',300.00,2000.00,2500.00,'1715625251008-625557267-1.png',7,5,1,'2024-05-13 12:34:12',NULL,NULL,1,0),(87,'Proveedor',900.00,2000.00,2500.00,'1715625251008-625557267-1.png',11,5,1,'2024-05-13 12:38:34',NULL,NULL,1,50),(88,'Hermenegildo',300.00,350.00,320.00,'',10,3,1,'2024-05-13 12:47:29',NULL,NULL,1,12),(89,'Proveedor',600.00,2000.00,2500.00,'1715625251008-625557267-1.png',10,5,1,'2024-05-13 13:15:16',NULL,NULL,1,18),(90,'Escarcha',300.00,400.00,600.00,'1715845516163-669051681-anillos de aniversario joyas preciosas anillo.jpg',7,3,1,'2024-05-16 01:44:59',1,'2024-05-16 01:45:59',1,40),(91,'Escarchass',300.00,400.00,600.00,'1715845668053-346831259-R.jfif',3,3,11,'2024-05-16 01:47:29',11,'2024-05-16 01:47:57',1,40),(92,'Pruebaqwer',209.00,121.00,500.00,'',5,3,10,'2024-05-08 00:00:00',NULL,NULL,1,60),(93,'Manicomio',209.00,123.00,123.00,'NA',5,8,10,'2024-05-08 00:00:00',NULL,NULL,1,30),(94,'Manicomio',209.00,123.00,123.00,'NA',10,8,1,NULL,NULL,NULL,1,70),(95,'Manicomio',209.00,123.00,123.00,'NA',1,8,10,'2024-05-08 00:00:00',NULL,NULL,1,40),(96,'cacacasdasd',121233.00,112323.00,112323.00,'1716350657975-864093136-png-clipart-profile-icon-simple-user-icon-icons-logos-emojis-users-thumbnail.png',7,5,10,'2024-05-21 22:03:52',10,'2024-05-21 22:04:19',0,123123),(97,'Man',12.00,12.00,12.00,'NA',7,8,10,'2024-05-22 00:25:46',NULL,NULL,1,28),(98,'Manicomio',123.00,123.00,123.00,'NA',7,8,10,'2024-05-22 00:32:42',NULL,NULL,1,492),(99,'esternocleidomastoideo',123.00,123.00,123.00,'NA',7,8,10,'2024-05-22 00:32:42',NULL,NULL,1,123),(100,'mariana',12.00,123.00,123.00,'NA',7,8,10,'2024-05-22 00:37:45',NULL,NULL,1,12),(101,'mariana',123.00,123.00,123.00,'NA',11,8,10,'2024-05-22 12:55:04',NULL,NULL,1,0),(102,'Man',123.00,12.00,12.00,'NA',11,8,1,'2024-05-13 12:35:00',NULL,NULL,1,123),(103,'jose',123.00,123.00,123.00,'NA',7,8,14,'2024-05-22 14:27:19',NULL,NULL,1,738);
/*!40000 ALTER TABLE `vent_tbmaquillajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbpreciosbitacora`
--

DROP TABLE IF EXISTS `vent_tbpreciosbitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbpreciosbitacora` (
  `Prec_Id` int(11) NOT NULL,
  `Prec_Nombre` varchar(60) DEFAULT NULL,
  `Prec_PrecioCompra` decimal(8,2) DEFAULT NULL,
  `Prec_PrecioVenta` decimal(8,2) DEFAULT NULL,
  `Prec_PrecioMayor` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`Prec_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbpreciosbitacora`
--

LOCK TABLES `vent_tbpreciosbitacora` WRITE;
/*!40000 ALTER TABLE `vent_tbpreciosbitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `vent_tbpreciosbitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vent_tbproductosporsucursalesencabezados`
--

DROP TABLE IF EXISTS `vent_tbproductosporsucursalesencabezados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vent_tbproductosporsucursalesencabezados` (
  `Pren_Id` int(11) NOT NULL,
  `Sucu_Id` int(11) DEFAULT NULL,
  `Pren_UsuarioCreacion` int(11) DEFAULT NULL,
  `Pren_FechaCreacion` datetime DEFAULT NULL,
  `Pren_UsuarioModificacion` int(11) DEFAULT NULL,
  `Pren_FechaModificacion` datetime DEFAULT NULL,
  `Pren_Finalizado` tinyint(1) DEFAULT 1,
  `Pren_Estado` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`Pren_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vent_tbproductosporsucursalesencabezados`
--

LOCK TABLES `vent_tbproductosporsucursalesencabezados` WRITE;
/*!40000 ALTER TABLE `vent_tbproductosporsucursalesencabezados` DISABLE KEYS */;
INSERT INTO `vent_tbproductosporsucursalesencabezados` VALUES (1,3,1,'2024-12-12 00:00:00',NULL,NULL,1,1);
/*!40000 ALTER TABLE `vent_tbproductosporsucursalesencabezados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dbsistemaesmeralda'
--
/*!50003 DROP PROCEDURE IF EXISTS `SP_Factura_Listar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Factura_Listar`()
BEGIN
    SELECT 
        F.Fact_Id,
        C.Clie_Nombre,
        E.Empl_Nombre,
        M.Mepa_Metodo,
        F.Fact_Finalizado 
    FROM vent_tbFactura F
    LEFT JOIN gral_tbClientes C ON C.Clie_Id = F.Clie_Id
    LEFT JOIN gral_tbEmpleados E ON E.Empl_Id = F.Empl_Id
    LEFT JOIN gral_tbMetodosPago M ON M.Mepa_Id = F.Mepa_Id;
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

-- Dump completed on 2024-06-12 22:01:54
