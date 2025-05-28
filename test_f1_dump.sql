/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 8.0.42-0ubuntu0.20.04.1 : Database - test_f1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test_f1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `test_f1`;

/*Table structure for table `cargasCsv` */

DROP TABLE IF EXISTS `cargasCsv`;

CREATE TABLE `cargasCsv` (
  `IdCarga` int unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `NombreReal` varchar(50) DEFAULT NULL,
  `Opcion` varchar(16) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IdCarga`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `cargasCsv` */

insert  into `cargasCsv`(`IdCarga`,`Nombre`,`NombreReal`,`Opcion`,`created_at`) values (1,'WJ97djauAztTbXDH.csv','registros.csv','borrar','2025-05-28 06:52:17'),(2,'HurLAQkEv6xBUqDz.csv','registros.csv','combinar','2025-05-28 07:47:57');

/*Table structure for table `registros` */

DROP TABLE IF EXISTS `registros`;

CREATE TABLE `registros` (
  `IdRegistro` int unsigned NOT NULL AUTO_INCREMENT,
  `IdMask` varchar(16) DEFAULT NULL,
  `IdInFile` int unsigned NOT NULL DEFAULT '0',
  `Nombre` varchar(50) DEFAULT NULL,
  `Descripcion` text,
  `Origin` enum('form','file') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`IdRegistro`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Data for the table `registros` */

insert  into `registros`(`IdRegistro`,`IdMask`,`IdInFile`,`Nombre`,`Descripcion`,`Origin`,`created_at`,`updated_at`) values (2,'40b9fa1644bdcbcb',44,'nombre 44','descripcion 44','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(4,'a64840d43e74504d',45,'nombre 45','descripcion 45','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(5,'6e6af0440b8a2b00',5,'nombre 5','descripcion 5 edit','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(6,'0592ddad5fdff96e',6,'nombre 6','descripcion 6 edit','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(7,'f616237413ef7c4f',7,'nombre 7','descripcion 7 edit','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(8,'922098c25612cb21',8,'nombre 8','descripcion 8 edit','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(9,'1f479e738feefe9b',9,'nombre 9','descripcion 9 edit','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(10,'7c4ee5d42bde51a8',100,'nombre 100','descripcion 100','file','2025-05-28 11:52:17','2025-05-28 07:47:57'),(11,'4747cd9f525160c5',54,'prueba','prueba me','form','2025-05-28 07:28:59','2025-05-28 12:28:59'),(12,'833f2457d5c8a97f',439,'juan','tecnico edit','form','2025-05-28 07:43:01','2025-05-28 07:43:18'),(14,'8d7d902ab5909a27',1,'nombre 1','descripcion 1 edit','file','2025-05-28 12:47:57','2025-05-28 12:47:57'),(15,'371b8d75e4e94963',3,'nombre 3','descripcion 3 edit','file','2025-05-28 12:47:57','2025-05-28 12:47:57');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
