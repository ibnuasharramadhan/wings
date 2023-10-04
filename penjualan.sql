-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: penjualan
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `user` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('Smit','_sm1t_OK');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `product_code` varchar(18) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `price` decimal(6,0) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `discount` decimal(6,0) DEFAULT NULL,
  `dimension` varchar(50) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('GIV','Giv Biru',11000,'IDR',0,'13 cm x  10 cm','PCS','http://localhost/penjualan/assets/img/200619_giv_reguler___biru.png'),('SKUSKILLQD','So Klin Liquid',18000,'IDR',0,'13 cm x 10 cm','PCS','http://localhost/penjualan/assets/img/sk_liquid_red_16_AwtbGsVbM1.png'),('SKUSKILNP','So klin Pewangi\r',15000,'IDR',10,'13 cm x 10 cm','PCS','http://localhost/penjualan/assets/img/soklinpewangi.png');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_detail`
--

DROP TABLE IF EXISTS `trx_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trx_detail` (
  `id` int(11) NOT NULL,
  `document_code` varchar(6) DEFAULT NULL,
  `product_code` varchar(18) DEFAULT NULL,
  `document_number` varchar(10) DEFAULT NULL,
  `price` decimal(6,0) DEFAULT NULL,
  `qty` int(6) DEFAULT NULL,
  `unit` varchar(5) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trx_detail_FK` (`product_code`),
  KEY `trx_detail_FK_1` (`document_code`),
  CONSTRAINT `trx_detail_FK` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`),
  CONSTRAINT `trx_detail_FK_1` FOREIGN KEY (`document_code`) REFERENCES `trx_header` (`document_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_detail`
--

LOCK TABLES `trx_detail` WRITE;
/*!40000 ALTER TABLE `trx_detail` DISABLE KEYS */;
INSERT INTO `trx_detail` VALUES (1,'TRX-01','SKUSKILNP','001',15000,1,'PCS',15000,'IDR'),(2,'TRX-02','SKUSKILLQD','002',18000,1,'PCS',18000,'IDR'),(3,'TRX-03','GIV','003',11000,1,'PCS',11000,'IDR');
/*!40000 ALTER TABLE `trx_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trx_header`
--

DROP TABLE IF EXISTS `trx_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trx_header` (
  `document_code` varchar(6) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `document_number` varchar(10) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`document_code`),
  KEY `trx_header_FK` (`user`),
  CONSTRAINT `trx_header_FK` FOREIGN KEY (`user`) REFERENCES `login` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trx_header`
--

LOCK TABLES `trx_header` WRITE;
/*!40000 ALTER TABLE `trx_header` DISABLE KEYS */;
INSERT INTO `trx_header` VALUES ('TRX-01','Smit','001',1,'2000-05-20'),('TRX-02','Smit','002',1,'2000-05-20'),('TRX-03','Smit','003',1,'2000-05-20');
/*!40000 ALTER TABLE `trx_header` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'penjualan'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-04 12:05:54
