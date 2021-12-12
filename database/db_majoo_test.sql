DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `datefield` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES ('2021-11-01'),('2021-11-02'),('2021-11-03'),('2021-11-04'),('2021-11-05'),('2021-11-06'),('2021-11-07'),('2021-11-08'),('2021-11-09'),('2021-11-10'),('2021-11-11'),('2021-11-12'),('2021-11-13'),('2021-11-14'),('2021-11-15'),('2021-11-16'),('2021-11-17');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar_outlet`
--

DROP TABLE IF EXISTS `calendar_outlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar_outlet` (
  `datefield` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar_outlet`
--

LOCK TABLES `calendar_outlet` WRITE;
/*!40000 ALTER TABLE `calendar_outlet` DISABLE KEYS */;
INSERT INTO `calendar_outlet` VALUES ('2021-11-01'),('2021-11-02'),('2021-11-03'),('2021-11-04'),('2021-11-05'),('2021-11-06'),('2021-11-07'),('2021-11-08'),('2021-11-09');
/*!40000 ALTER TABLE `calendar_outlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchants`
--

DROP TABLE IF EXISTS `merchants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchants` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(40) NOT NULL,
  `merchant_name` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchants`
--

LOCK TABLES `merchants` WRITE;
/*!40000 ALTER TABLE `merchants` DISABLE KEYS */;
INSERT INTO `merchants` VALUES (1,1,'merchant 1','2021-12-10 00:23:11',1,'2021-12-10 00:23:11',1),(2,2,'Merchant 2','2021-12-10 00:23:11',2,'2021-12-10 00:23:11',2);
/*!40000 ALTER TABLE `merchants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outlets`
--

DROP TABLE IF EXISTS `outlets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outlets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `merchant_id` bigint(20) NOT NULL,
  `outlet_name` varchar(40) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `merchant_id` (`merchant_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outlets`
--

LOCK TABLES `outlets` WRITE;
/*!40000 ALTER TABLE `outlets` DISABLE KEYS */;
INSERT INTO `outlets` VALUES (1,1,'Outlet 1','2021-12-10 00:23:12',1,'2021-12-10 00:23:12',1),(2,2,'Outlet 1','2021-12-10 00:23:12',2,'2021-12-10 00:23:12',2),(3,1,'Outlet 2','2021-12-10 00:23:12',1,'2021-12-10 00:23:12',1);
/*!40000 ALTER TABLE `outlets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `merchant_id` bigint(20) NOT NULL,
  `outlet_id` bigint(20) NOT NULL,
  `bill_total` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`),
  KEY `outlet_id` (`outlet_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,1,1,2000,'2021-11-01 05:30:04',1,'2021-11-01 05:30:04',1),(2,1,1,2500,'2021-11-01 10:20:14',1,'2021-11-01 10:20:14',1),(3,1,1,4000,'2021-11-02 05:30:04',1,'2021-11-02 05:30:04',1),(4,1,1,1000,'2021-11-04 05:30:04',1,'2021-11-04 05:30:04',1),(5,1,1,7000,'2021-11-05 09:59:30',1,'2021-11-05 09:59:30',1),(6,1,3,2000,'2021-11-02 11:30:04',1,'2021-11-02 11:30:04',1),(7,1,3,2500,'2021-11-03 10:20:14',1,'2021-11-03 10:20:14',1),(8,1,3,4000,'2021-11-04 05:30:04',1,'2021-11-04 05:30:04',1),(9,1,3,1000,'2021-11-04 05:31:04',1,'2021-11-04 05:31:04',1),(10,1,3,7000,'2021-11-05 09:59:30',1,'2021-11-05 09:59:30',1),(11,2,2,2000,'2021-11-01 11:30:04',2,'2021-11-01 11:30:04',2),(12,2,2,2500,'2021-11-02 10:20:14',2,'2021-11-02 10:20:14',2),(13,2,2,4000,'2021-11-03 05:30:04',2,'2021-11-03 05:30:04',2),(14,2,2,1000,'2021-11-04 05:31:04',2,'2021-11-04 05:31:04',2),(15,2,2,7000,'2021-11-05 09:59:30',2,'2021-11-05 09:59:30',2),(16,2,2,2000,'2021-11-05 11:30:04',2,'2021-11-05 11:30:04',2),(17,2,2,2500,'2021-11-06 10:20:14',2,'2021-11-06 10:20:14',2),(18,2,2,4000,'2021-11-07 05:30:04',2,'2021-11-07 05:30:04',2),(19,2,2,1000,'2021-11-08 05:31:04',2,'2021-11-08 05:31:04',2),(20,2,2,7000,'2021-11-09 09:59:30',2,'2021-11-09 09:59:30',2),(21,2,2,1000,'2021-11-10 05:31:04',2,'2021-11-10 05:31:04',2),(22,2,2,7000,'2021-11-11 09:59:30',2,'2021-11-11 09:59:30',2);
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` bigint(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin 1','admin1','$2y$10$b/C3.ppDuRZmsn8L4UUVF.b.Lg4A3h4hPspOz54YviByzjG0MuVDK','2021-12-10 00:23:11',1,'2021-12-10 00:23:11',1),(2,'Admin 2','admin2','$2y$10$b/C3.ppDuRZmsn8L4UUVF.b.Lg4A3h4hPspOz54YviByzjG0MuVDK','2021-12-10 00:23:11',2,'2021-12-10 00:23:11',2),(15,'test admin5','admin5','$2y$10$b/C3.ppDuRZmsn8L4UUVF.b.Lg4A3h4hPspOz54YviByzjG0MuVDK','2021-12-10 17:00:10',0,'2021-12-10 17:00:10',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;