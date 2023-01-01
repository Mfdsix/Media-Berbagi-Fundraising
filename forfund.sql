-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: forfund.asia
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
INSERT INTO `banks` VALUES (1,'BCA','Forfund','12345678','014','uploads/bank/zXZMhouGTTzkFk51YLJgO3r2Rv4KtKV2weGgPuCd.png',1,'2021-09-27 06:22:03','2021-09-27 06:22:03');
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
INSERT INTO `blog_categories` VALUES (2,NULL,'alam2','2021-12-01 09:47:40','2021-12-01 09:47:40');
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,1,'Admin Forfund','Dampak Buruk Junk Food u/Tubuh','<p style=\"color: rgb(54, 54, 54); font-family: Inter;\"><span style=\"font-weight: bolder;\">ARTIKEL TERBARU</span></p><p style=\"color: rgb(54, 54, 54); font-family: Inter;\"><span style=\"font-weight: bolder;\">Dampak Buruk Junk Food u/Tubuh</span><br></p><p style=\"color: rgb(54, 54, 54); font-family: Inter;\">Junk Food memliki kandungan lemak jahat yang tinggi. Hal ini juga membuat kolestrol di dalam tubuh meningkat. Lemak jahat yang menumpuk di dalam tubuh akan sangat mempengaruhi kerja jantung. Selain itu, lemak juga bisa menumpuk di dalam pembuluh darah menyebabkan penyumbatan.</p>','uploads/blog/cuM4Wpq2CeucXq2PX2epTiAIckewksUZ2vw2gHp5.jpg','2021-09-23 02:13:10','2021-12-01 09:54:20','dampak-buruk-junk-food-u-tubuh',0,2),(2,1,'Admin Forfund','Manfaat Madu Bagi Kesehatan','<hr class=\"my-4\" style=\"color: rgb(33, 37, 41); font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, &quot;Noto Sans&quot;, &quot;Liberation Sans&quot;, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;, &quot;Noto Color Emoji&quot;; font-size: 16px;\"><div class=\"article-content\" style=\"font-family: Inter; line-height: 21px; color: rgb(54, 54, 54);\"><p><span style=\"font-family: Inter;\"><span style=\"font-weight: bolder;\">ARTIKEL TERBARU</span></span></p><p><font color=\"#363636\" face=\"Inter\"><span style=\"font-weight: bolder;\">Manfaat Madu Bagi Kesehatan</span></font><br></p><p><span style=\"font-family: Inter;\">Manfaat pertama madu, yaitu bisa meningkatkan kekebalan tubuh. Hal ini karena kandungan zat fitronutrien. Zat ini bisa meningkatkan sel imun dalam tubuh. Selain itu, ada juga zat antibakteri dan antijamur yang bisa mengatasi infeksi yang disebabkan oleh kuman, bakteri, atau penyakit.</span></p></div>','uploads/blog/1o6vNNsqwo13Szoa0boCKyycO94uL8IEj7vHPuBk.jpg','2021-09-23 02:13:34','2021-11-28 11:56:41','manfaat-madu-bagi-kesehatan',0,NULL),(3,1,'Admin Forfund','Lebih menenal mata uang Bitcoin','<div class=\"article-content\" style=\"font-family: Inter; line-height: 21px; color: rgb(54, 54, 54);\"><p><span style=\"font-weight: bolder;\">ARTIKEL TERBARU</span></p><p><span style=\"font-weight: bolder;\">Lebih menenal mata uang Bitcoin</span></p><p><span style=\"font-family: Inter;\">Bitcoin adalah sebuah mata uang baru atau uang elektronik yang diciptakan pada 2009 lalu oleh seseorang yang menggunakan nama samaran Satoshi Nakamoto, seperti dilansir dari Investopedia.com. Bitcoin utamanya digunakan dalam transaksi di internet tanpa menggunakan perantara alias tidak menggunakan jasa bank.</span><span style=\"font-weight: bolder;\"><br></span></p></div>','uploads/blog/SO7c518p55AvJXMR5vVuLdyKhGFwRMSuyXwx6N47.jpg','2021-09-23 02:14:04','2021-11-28 11:56:41','lebih-menenal-mata-uang-bitcoin',0,NULL),(4,1,'Admin Forfund','Varian Zebra Cross di Bandung','<p style=\"color: rgb(54, 54, 54); font-family: Inter;\"><span style=\"font-weight: bolder;\">ARTIKEL TERBARU</span></p><p style=\"color: rgb(54, 54, 54); font-family: Inter;\"><span style=\"font-weight: bolder;\">Varian Zebra Cross di Bandung</span></p><p style=\"color: rgb(54, 54, 54); font-family: Inter;\">Zebra Cross yang biasanya hanya dibuat garis garis, kali ini kalangan muda di Bandung Jawa Barat, memunculkan ide kreatif dengan mendesign Zebra Cross menjadi unik dan menarik, seperti menyerupai lebah dll.</p>','uploads/blog/4sj6itEFpGbpzPvUf7uMsJ890apd4Kyqb01NycEy.jpg','2021-09-23 02:17:20','2021-11-29 14:23:05','varian-zebra-cross-di-bandung',1,NULL),(5,1,'Admin Forfund','judul 12345 ajsahshghjsg asasas as','<p>ASAHSG ASF HSF HJhas gHA FHAGS FAHGS FAGH SFHA FSHAFSHASGA</p>',NULL,'2021-12-01 09:54:09','2021-12-25 08:42:59','judul-12345',2,2);
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `docs`
--

LOCK TABLES `docs` WRITE;
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `donaturs`
--

LOCK TABLES `donaturs` WRITE;
/*!40000 ALTER TABLE `donaturs` DISABLE KEYS */;
/*!40000 ALTER TABLE `donaturs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `fundings`
--

LOCK TABLES `fundings` WRITE;
/*!40000 ALTER TABLE `fundings` DISABLE KEYS */;
INSERT INTO `fundings` VALUES (1,1,3,50000,'BCA','paid','2021-12-25 09:59:15','2021-09-28 02:18:49','2021-09-28 02:18:49',NULL,NULL,'Gilang',NULL,NULL,110,0,50111,'0','bank',NULL,NULL,0,'1','zakat',NULL,NULL,NULL),(2,2,NULL,50000,'BCA','paid','2021-12-02 03:17:42','2021-09-28 03:59:06','2021-09-28 03:59:06',NULL,NULL,'Nurman','Tetss@gmail.com',NULL,121,0,50122,'0','bank','082636373737',NULL,0,'1','wakaf',NULL,NULL,NULL),(3,1,NULL,10000,'BCA','paid','2021-12-02 03:17:42','2021-09-29 06:36:54','2021-09-29 06:36:54',NULL,NULL,'Nurman','Tetss@gmail.com',NULL,178,0,10179,'0','bank','082636373737',NULL,0,'1','zakat',NULL,NULL,NULL),(4,3,NULL,50000,'BCA','paid','2021-12-02 03:17:42','2021-09-30 08:02:22','2021-09-30 08:59:49','uploads/payment_proof/A3Fu3HvdRvqzwETTnPzc5hZiMwxVf1pQcaM4kVjG.jpg',NULL,'Siddiq','messidiq27@gmail.com',NULL,327,1,50328,'0','bank','0881812891892',NULL,0,'1','donation',NULL,NULL,NULL),(5,3,NULL,50000,'BCA','paid','2021-12-02 03:17:42','2021-09-30 11:37:25','2021-09-30 11:37:25',NULL,NULL,'Nurman','Tetss@gmail.com',NULL,362,0,50363,'0','bank','082636373737',NULL,0,'1','donation',NULL,NULL,NULL),(6,2,8,50000,'BCA','paid','2021-10-01 09:56:45','2021-10-01 09:54:24','2021-10-01 09:56:45',NULL,NULL,'rafiqsiregar','rafiqsiregar@gmail.com',NULL,395,1,50396,'0','bank',NULL,NULL,0,'1','wakaf',NULL,NULL,NULL),(7,1,8,150000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 09:58:52','2021-10-01 09:58:52',NULL,NULL,'rafiqsiregar','rafiqsiregar@gmail.com',NULL,401,0,150402,'0','bank',NULL,NULL,0,'1','zakat',NULL,NULL,NULL),(8,1,7,50000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 14:30:16','2021-10-01 14:30:16',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,1,50000,'0','bank','085802968281',NULL,0,'1','zakat',NULL,NULL,NULL),(9,3,7,150000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 15:04:56','2021-10-01 15:04:56',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,0,150000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(10,3,7,150000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 15:05:23','2021-10-01 15:05:23',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,0,150000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(11,3,7,150000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 15:05:32','2021-10-01 15:05:32',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,0,150000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(12,3,7,150000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 15:11:13','2021-10-01 15:11:13',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,1,150000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(13,3,7,100000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 15:12:26','2021-10-01 15:12:26',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,0,100000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(14,3,7,50000,'BCA','paid','2021-12-02 03:17:42','2021-10-01 15:13:28','2021-10-01 15:13:28',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,0,50000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(15,1,5,50000,'bank','paid','2021-12-02 03:17:42','2021-10-04 12:38:40','2021-10-04 12:38:40',NULL,NULL,'myname','myname@gmail.com',NULL,0,1,50000,'0','bank','085802968281',NULL,0,'2','zakat',NULL,NULL,NULL),(16,1,5,50000,'bank','paid','2021-12-02 03:17:42','2021-10-04 12:49:01','2021-10-04 12:49:01',NULL,NULL,'myname','myname@gmail.com',NULL,0,1,50000,'0','bank','085802968281',NULL,0,'2','zakat',NULL,NULL,NULL),(17,1,5,50000,'bank','paid','2021-12-02 03:17:42','2021-10-04 12:50:16','2021-10-04 12:50:16',NULL,NULL,'myname','myname@gmail.com',NULL,0,1,50000,'0','bank','085802968281',NULL,0,'2','zakat',NULL,NULL,NULL),(18,1,5,50000,'bank','paid','2021-12-02 03:17:42','2021-10-04 12:50:16','2021-10-04 12:50:16',NULL,NULL,'myname','myname@gmail.com',NULL,0,1,50000,'0','bank','085802968281',NULL,0,'2','zakat',NULL,NULL,NULL),(19,2,NULL,50000,'BCA','paid','2021-12-02 03:17:42','2021-10-05 09:27:13','2021-10-05 09:27:13',NULL,NULL,'Yosan','yonas@gmail.com',NULL,451,1,50452,'0','bank','1281871232',NULL,0,'1','wakaf',NULL,NULL,NULL),(20,1,1,10000,'BCA','paid','2021-12-02 03:17:42','2021-10-05 12:52:05','2021-10-05 12:52:05',NULL,NULL,'admin','admin@gmail.com',NULL,460,0,10461,'0','bank',NULL,NULL,0,'1','zakat',NULL,NULL,NULL),(21,3,7,100000,'BCA','paid','2021-12-02 03:17:42','2021-10-05 17:33:03','2021-10-05 17:33:03',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,0,100000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','donation',NULL,NULL,NULL),(22,1,1,10000,'BCA','paid','2021-10-06 08:22:05','2021-10-06 08:20:13','2021-10-06 08:22:05',NULL,NULL,'admin','admin@gmail.com',NULL,486,0,10487,'0','bank','081395733034',NULL,0,'1','zakat',NULL,NULL,NULL),(23,1,NULL,10000,'BCA','paid','2021-12-02 03:17:42','2021-10-06 15:01:57','2021-10-06 15:01:57',NULL,NULL,'Nurman','rismamuzdalifah.fidkom@gmail.com',NULL,561,0,10562,'0','bank','082374647478483',NULL,0,'1','zakat',NULL,NULL,NULL),(24,2,NULL,50000,'BCA','paid','2021-12-02 03:17:42','2021-10-07 06:37:56','2021-10-07 06:37:56',NULL,NULL,'test','digytabusiness@gmail.com',NULL,624,0,50625,'0','bank','08111049456',NULL,0,'1','wakaf',NULL,NULL,NULL),(25,2,5,50000,'OVO','paid','2021-10-21 09:36:37','2021-10-21 09:18:45','2021-10-21 09:36:37',NULL,NULL,'yudono','yudonoputro@gmail.com',NULL,1,0,50000,'0','emoney',NULL,'3422281200000356',0,'812','wakaf',NULL,NULL,NULL),(26,2,NULL,50000,'BNI Virtual Account','paid','2021-12-02 03:17:42','2021-10-21 09:47:33','2021-10-21 09:47:33',NULL,NULL,'Nurman','isdbnfuibsd@gmail.com',NULL,4,0,50000,'0','virtualaccount','0812889122','3422280100000018',0,'801','wakaf',NULL,NULL,NULL),(27,2,NULL,50000,'OVO','paid','2021-12-02 03:17:42','2021-10-21 09:48:38','2021-10-21 09:48:38',NULL,NULL,'Muhammad Shiddiq','892iosadbbu@gmail.com',NULL,6,0,50000,'0','emoney','92387489234','3422281200000364',0,'812','wakaf',NULL,NULL,NULL),(28,2,NULL,50000,'Danamon VA','paid','2021-12-02 03:17:42','2021-10-21 09:49:07','2021-10-21 09:49:07',NULL,NULL,'Muhammasdoh','mawdfion@gmail.com',NULL,7,0,50000,'0','virtualaccount','9023902394','3422270800000018',0,'708','wakaf',NULL,NULL,NULL),(29,2,NULL,50000,'BNI Virtual Account','paid','2021-12-02 03:17:42','2021-10-22 12:03:17','2021-10-22 12:03:17',NULL,NULL,'muhamamd nurman','digytabusiness@gmail.com',NULL,13,0,50000,'0','virtualaccount','08111049456','3422280100000034',0,'801','wakaf',NULL,NULL,NULL),(30,3,NULL,100000,'BRI Virtual Account','paid','2021-12-02 03:17:42','2021-10-25 01:28:23','2021-10-25 01:28:23',NULL,NULL,'miichel','yodnfdjfhdf@gmail.com',NULL,20,0,100000,'0','virtualaccount',NULL,'3422280000000034',0,'800','donation',NULL,NULL,NULL),(31,3,NULL,150000,'Mandiri Virtual Account','paid','2021-12-02 03:17:42','2021-10-25 01:41:23','2021-10-25 01:41:23',NULL,NULL,'miichel','yodnfdjfhdf@gmail.com',NULL,22,0,150000,'0','virtualaccount',NULL,'3422280200000018',0,'802','donation',NULL,NULL,NULL),(32,2,NULL,100000,'BRI Virtual Account','paid','2021-12-02 03:17:42','2021-10-25 02:25:11','2021-10-25 02:25:11',NULL,NULL,'miichel','yodnfdjfhdf@gmail.com',NULL,24,1,100000,'0','virtualaccount',NULL,'3422280000000059',0,'800','wakaf',NULL,NULL,NULL),(33,3,NULL,200000,'OVO','paid','2021-12-02 03:17:42','2021-10-26 03:35:34','2021-10-26 03:35:34',NULL,NULL,',jjgjhj','jfdifjdf@gmail.com',NULL,43,0,200000,'0','emoney',NULL,'3422281200000489',0,'812','donation',NULL,NULL,NULL),(34,7,5,50000,'LinkAja','paid','2021-12-02 03:17:42','2021-10-27 08:54:56','2021-10-27 08:54:56',NULL,NULL,'yudono','yudonoputro@gmail.com',NULL,89,0,50000,'0','emoney',NULL,'3422230200000034',0,'302','zakat',NULL,NULL,NULL),(35,7,5,150000,'OVO','paid','2021-10-28 07:13:34','2021-10-27 08:56:26','2021-10-28 07:13:34',NULL,NULL,'yudono','yudonoputro@gmail.com',NULL,90,0,150000,'0','emoney',NULL,'3422281200000505',0,'812','zakat',NULL,NULL,NULL),(36,2,5,100000,'OVO','paid','2021-10-27 10:11:08','2021-10-27 10:10:56','2021-10-27 10:11:08',NULL,NULL,'yudono','yudonoputro@gmail.com',NULL,98,0,100000,'0','emoney',NULL,'3422281200000513',0,'812','wakaf',NULL,NULL,NULL),(37,3,9,100000,'BRI Virtual Account','pending','2021-10-31 06:55:21','2021-10-28 06:55:23','2021-10-28 06:55:23',NULL,NULL,'Abdun','fm.syahrul@gmail.com',NULL,109,1,100000,'0','virtualaccount',NULL,'3422280000000083',0,'800','donation',NULL,NULL,NULL),(38,7,5,150000,'OVO','paid','2021-10-28 06:56:33','2021-10-28 06:55:54','2021-10-28 06:56:33',NULL,NULL,'yudono','yudonoputro@gmail.com',NULL,111,0,150000,'0','emoney',NULL,'3422281200000521',0,'812','zakat',NULL,NULL,NULL),(39,7,9,10000,'Mandiri Virtual Account','pending','2021-10-31 07:00:53','2021-10-28 07:00:55','2021-10-28 07:00:55',NULL,NULL,'Abdun','fm.syahrul@gmail.com',NULL,112,0,10000,'0','virtualaccount',NULL,'3422280200000026',0,'802','zakat',NULL,NULL,NULL),(40,2,5,50000,'OVO','pending','2021-10-31 08:19:49','2021-10-28 08:19:52','2021-10-28 08:19:52',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,116,1,50000,'0','emoney','08871861652','3422281200000539',0,'812','wakaf',NULL,NULL,NULL),(41,7,NULL,150000,'BCA','pending','2021-10-31 08:35:03','2021-10-28 08:35:03','2021-10-28 08:35:03',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,125,0,150124,'0','bank','08871861652',NULL,0,'1','zakat',NULL,NULL,NULL),(42,2,NULL,50000,'BCA','pending','2021-10-31 08:58:43','2021-10-28 08:58:43','2021-10-28 08:58:43',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,132,0,50131,'0','bank','08871861652',NULL,0,'1','wakaf',NULL,NULL,NULL),(43,2,NULL,50000,'OVO','paid','2021-10-28 09:23:40','2021-10-28 09:00:15','2021-10-28 09:23:40',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,133,0,50000,'0','emoney','08871861652','3422281200000547',0,'812','wakaf',NULL,NULL,NULL),(44,2,NULL,50000,'OVO','paid','2021-10-29 04:17:32','2021-10-28 09:28:19','2021-10-29 04:17:32',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,135,0,50000,'0','emoney','08871861652','3422281200000554',0,'812','wakaf',NULL,NULL,NULL),(45,8,NULL,150000,'OVO','pending','2021-10-31 09:33:22','2021-10-28 09:33:29','2021-10-28 09:33:29',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,137,0,150000,'0','emoney','08871861652','3422281200000562',0,'812','zakat',NULL,NULL,NULL),(46,7,NULL,150000,'OVO','pending','2021-10-31 14:45:23','2021-10-28 14:45:26','2021-10-28 14:45:26',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,140,0,150000,'0','emoney','08871861652','3422281200000570',0,'812','zakat',NULL,NULL,NULL),(47,7,NULL,150000,'OVO','pending','2021-10-31 14:56:36','2021-10-28 14:56:39','2021-10-28 14:56:39',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,142,0,150000,'0','emoney','08871861652','3422281200000588',0,'812','zakat',NULL,NULL,NULL),(48,8,NULL,10000,'OVO','pending','2021-10-31 15:13:22','2021-10-28 15:13:25','2021-10-28 15:13:25',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,144,0,10000,'0','emoney','08871861652','3422281200000596',0,'812','zakat',NULL,NULL,NULL),(49,8,NULL,100000,'BNI Virtual Account','pending','2021-10-31 15:18:50','2021-10-28 15:18:52','2021-10-28 15:18:52',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,145,0,100000,'0','virtualaccount','08871861652','3422280100000075',0,'801','zakat',NULL,NULL,NULL),(50,8,NULL,100000,'BRI Virtual Account','pending','2021-10-31 15:19:59','2021-10-28 15:20:01','2021-10-28 15:20:01',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,146,0,100000,'0','virtualaccount','08871861652','3422280000000091',0,'800','zakat',NULL,NULL,NULL),(51,8,NULL,10000,'BRI Virtual Account','pending','2021-10-31 15:22:51','2021-10-28 15:22:54','2021-10-28 15:22:54',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,147,0,10000,'0','virtualaccount','08871861652','3422280000000109',0,'800','zakat',NULL,NULL,NULL),(52,8,NULL,100000,'OVO','pending','2021-10-31 15:31:13','2021-10-28 15:31:14','2021-10-28 15:31:14',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,148,0,100000,'0','emoney','08871861652','3422281207417744',0,'812','zakat',NULL,NULL,NULL),(53,8,NULL,100000,'BRI Virtual Account','pending','2021-10-31 15:32:03','2021-10-28 15:32:04','2021-10-28 15:32:04',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,149,0,100000,'0','virtualaccount','08871861652','3422280012456945',0,'800','zakat',NULL,NULL,NULL),(54,7,NULL,50000,'OVO','paid','2021-10-29 04:25:04','2021-10-29 03:58:33','2021-10-29 04:25:04',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,165,0,50000,'0','emoney','08871861652','3422281291379217',0,'812','zakat',NULL,NULL,NULL),(55,8,NULL,150000,'OVO','pending','2021-11-01 04:16:52','2021-10-29 04:16:53','2021-10-29 04:16:53',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,169,0,15000000,'0','emoney','08871861652','3422281201374658',0,'812','zakat',NULL,NULL,NULL),(56,8,NULL,100000,'BRI Virtual Account','paid','2021-10-29 04:30:23','2021-10-29 04:26:38','2021-10-29 04:30:23',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,172,0,10000000,'0','virtualaccount','08871861652','3422280059842969',0,'800','zakat',NULL,NULL,NULL),(57,8,NULL,150000,'OVO','pending','2021-11-01 04:28:59','2021-10-29 04:29:00','2021-10-29 04:29:00',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,173,0,15000000,'0','emoney','08871861652','3422281273984860',0,'812','zakat',NULL,NULL,NULL),(58,8,NULL,150000,'OVO','paid','2021-10-29 05:35:09','2021-10-29 04:32:37','2021-10-29 05:35:09',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,174,0,15000000,'0','emoney','08871861652','3422281219568111',0,'812','zakat',NULL,NULL,NULL),(59,8,NULL,150000,'BRI Virtual Account','paid','2021-10-29 05:39:58','2021-10-29 05:36:20','2021-10-29 05:39:58',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,178,0,15000000,'0','virtualaccount','08871861652','3422280078054222',0,'800','zakat',NULL,NULL,NULL),(60,2,NULL,100000,'OVO','pending','2021-11-01 06:12:49','2021-10-29 06:12:50','2021-10-29 06:12:50',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,180,0,10000000,'0','emoney','08871861652','3422281297053243',0,'812','wakaf',NULL,NULL,NULL),(61,8,NULL,10000,'BNI Virtual Account','pending','2021-11-01 06:17:54','2021-10-29 06:17:55','2021-10-29 06:17:55',NULL,NULL,'boy','boy@gmail.com',NULL,182,1,1000000,'0','virtualaccount','3213123123','3422280127566744',0,'801','zakat',NULL,NULL,NULL),(62,8,NULL,10000,'Mandiri Virtual Account','paid','2021-10-29 06:20:05','2021-10-29 06:19:25','2021-10-29 06:20:05',NULL,NULL,'tester','boy@gmail.com',NULL,183,0,1000000,'0','virtualaccount','332131231','3422280283649895',0,'802','zakat',NULL,NULL,NULL),(63,2,NULL,100000,'Mandiri Virtual Account','pending','2021-11-01 06:21:57','2021-10-29 06:21:58','2021-10-29 06:21:58',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,185,0,10000000,'0','virtualaccount','08871861652','3422280251854296',0,'802','wakaf',NULL,NULL,NULL),(64,8,NULL,150000,'BRI Virtual Account','paid','2021-10-29 06:25:43','2021-10-29 06:22:24','2021-10-29 06:25:43',NULL,NULL,'boy','boy@gmail.com',NULL,186,0,15000000,'0','virtualaccount','43424242','3422280054467657',0,'800','zakat',NULL,NULL,NULL),(65,8,NULL,100000,'Mandiri Virtual Account','paid','2021-10-29 06:25:43','2021-10-29 06:25:15','2021-10-29 06:25:43',NULL,NULL,'boy','boy@gmail.com',NULL,187,0,10000000,'0','virtualaccount','432432424','3422280271548148',0,'802','zakat',NULL,NULL,NULL),(66,2,NULL,100000,'BRI Virtual Account','pending','2021-11-01 06:27:56','2021-10-29 06:27:56','2021-10-29 06:27:56',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,189,1,10000000,'0','virtualaccount','08871861652','3422280087661569',0,'800','wakaf',NULL,NULL,NULL),(67,8,NULL,150000,'Mandiri Virtual Account','paid','2021-10-29 06:31:28','2021-10-29 06:30:35','2021-10-29 06:31:28',NULL,NULL,'Trsaja','tes@gmail.com',NULL,192,0,15000000,'0','virtualaccount','5566445667','3422280203571660',0,'802','zakat',NULL,NULL,NULL),(68,2,NULL,50000,'Permata','pending','2021-11-01 06:30:49','2021-10-29 06:30:49','2021-10-29 06:30:49',NULL,NULL,'Gilang Aryadi M','gilangaryadimahardika@gmail.com',NULL,193,0,5000000,'0','virtualaccount',NULL,'3422240290496961',0,'402','wakaf',NULL,NULL,NULL),(69,2,1,50000,'Mandiri Virtual Account','paid','2021-10-29 06:34:31','2021-10-29 06:33:25','2021-10-29 06:34:31',NULL,NULL,'admin','admin@gmail.com',NULL,197,0,5000000,'0','virtualaccount',NULL,'3422280220521522',0,'802','wakaf',NULL,NULL,NULL),(70,8,NULL,150000,'Mandiri Virtual Account','paid','2021-10-29 06:34:42','2021-10-29 06:34:21','2021-10-29 06:34:42',NULL,NULL,'Terbaru','tester@gmail.com',NULL,199,0,15000000,'0','virtualaccount','4556654677','3422280292610213',0,'802','zakat',NULL,NULL,NULL),(71,7,1,150000,'Mandiri Virtual Account','paid','2021-10-29 06:37:50','2021-10-29 06:37:27','2021-10-29 06:37:50',NULL,NULL,'admin','admin@gmail.com',NULL,202,0,15000000,'0','virtualaccount','008188818','3422280244748814',0,'802','zakat',NULL,NULL,NULL),(72,2,NULL,50000,'BRI Virtual Account','pending','2021-11-01 10:24:11','2021-10-29 10:24:12','2021-10-29 10:24:12',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,208,0,5000000,'0','virtualaccount','08871861652','3422280005234045',0,'800','wakaf',NULL,NULL,NULL),(73,2,NULL,50000,'OVO','pending','2021-11-01 10:24:32','2021-10-29 10:24:34','2021-10-29 10:24:34',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,209,0,5000000,'0','emoney','08871861652','3422281207387256',0,'812','wakaf',NULL,NULL,NULL),(74,2,NULL,50000,'BNI Virtual Account','pending','2021-11-03 04:39:12','2021-10-31 04:39:13','2021-10-31 04:39:13',NULL,NULL,'Test','Nurjg@jug.con',NULL,214,0,5000000,'0','virtualaccount','082374647478483','3422280115372343',0,'801','wakaf',NULL,NULL,NULL),(75,2,NULL,50000,'OVO','pending','2021-11-03 04:39:56','2021-10-31 04:39:56','2021-10-31 04:39:56',NULL,NULL,'Nurman','rismamuzdalifah.fidkom@gmail.com',NULL,215,0,5000000,'0','emoney',NULL,'3422281219676924',0,'812','wakaf',NULL,NULL,NULL),(76,2,NULL,100000,'BCA','pending','2021-11-06 10:17:12','2021-11-03 10:17:12','2021-11-03 10:17:12',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,241,0,10000000,'0','bank','08871861652',NULL,0,'1','wakaf',NULL,NULL,NULL),(77,2,NULL,50000,'BCA','pending','2021-11-06 10:32:01','2021-11-03 10:32:01','2021-11-03 10:32:01',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,243,0,50244,'0','bank','08871861652',NULL,0,'1','wakaf',NULL,NULL,NULL),(78,2,NULL,50000,'BCA','pending','2021-11-06 10:41:32','2021-11-03 10:41:32','2021-11-03 10:41:32',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,245,0,50123,'0','bank','08871861652',NULL,0,'1','wakaf',NULL,NULL,NULL),(79,2,NULL,50000,'BCA','pending','2021-11-06 10:50:50','2021-11-03 10:50:50','2021-11-03 10:50:50',NULL,NULL,'Yudono Putro utomo','yudonoputro@gmail.com',NULL,247,0,50247,'0','bank','08871861652',NULL,0,'1','wakaf',NULL,NULL,NULL),(80,2,7,10000,'BCA','pending','2021-11-19 18:22:41','2021-11-16 18:22:41','2021-11-16 18:22:41',NULL,NULL,'arbyazra','arbyuyeach@gmail.com',NULL,0,1,10000,'0','bank','arbyuyeach@gmail.com',NULL,0,'1','wakaf',NULL,NULL,NULL),(81,2,NULL,50000,'BNI Virtual Account','pending','2021-11-28 03:11:42','2021-11-25 03:11:43','2021-11-25 03:11:43',NULL,NULL,'Gilang','gilangaryadimahardika@gmail.com',NULL,391,0,50000,'0','virtualaccount',NULL,'3422280190289825',0,'801','wakaf',NULL,NULL,NULL),(82,2,NULL,50000,'BCA','pending','2021-11-28 03:12:37','2021-11-25 03:12:37','2021-11-25 03:12:37',NULL,NULL,'Gilang','gilangaryadimahardika@gmail.com',NULL,392,0,50392,'0','bank',NULL,NULL,0,'1','wakaf',NULL,NULL,NULL),(83,2,1,50000,'LinkAja','pending','2021-11-28 14:11:20','2021-11-25 14:11:21','2021-11-25 14:11:21',NULL,NULL,'admin','admin@gmail.com',NULL,402,0,50000,'0','emoney',NULL,'3422230248140821',0,'302','wakaf',NULL,NULL,NULL),(84,2,1,50000,'OVO','paid','2021-11-25 14:13:19','2021-11-25 14:13:05','2021-11-25 14:13:19',NULL,NULL,'admin','admin@gmail.com',NULL,404,0,50000,'0','emoney',NULL,'3422281295854472',0,'812','wakaf',NULL,NULL,NULL),(85,2,NULL,50000,'BNI Virtual Account','paid','2021-12-02 03:17:55','2021-11-28 11:57:32','2021-11-28 11:57:32',NULL,NULL,'Mahfudz rifan','mfdsix.1nd0@gmail.com',NULL,444,0,50000,'0','virtualaccount',NULL,'3422280165277652',0,'801','wakaf',NULL,NULL,'68d30a9594728bc39aa24be94b319d21'),(86,2,NULL,50000,'BNI Virtual Account','paid','2021-12-02 03:17:55','2021-11-28 12:23:54','2021-11-28 12:23:54',NULL,NULL,'Test','Nurman@gmail.com',NULL,454,0,50000,'0','virtualaccount',NULL,'3422280122343543',0,'801','wakaf',NULL,NULL,'3ef815416f775098fe977004015c6193'),(87,2,NULL,50000,'BCA','pending','2021-12-05 15:07:28','2021-12-02 15:07:28','2021-12-02 15:07:28',NULL,NULL,'mahfudz','mfdsix.1nd0@gmail.com',NULL,533,0,50533,'0','bank','08734526',NULL,0,'1','wakaf',NULL,NULL,NULL),(88,2,NULL,50000,'BCA','pending','2021-12-05 15:10:07','2021-12-02 15:10:07','2021-12-02 15:10:07',NULL,NULL,'Mahfudz Ainur','mfdsix.1nd0@gmail.com',NULL,534,0,50534,'0','bank','087672323',NULL,0,'1','wakaf',NULL,NULL,NULL),(89,2,11,50000,'BCA','pending','2021-12-05 15:14:32','2021-12-02 15:14:32','2021-12-02 15:14:32',NULL,NULL,'mahfudz','mfdsix.1nd0@gmail.com',NULL,537,0,50537,'0','bank',NULL,NULL,0,'1','wakaf',NULL,2,NULL),(90,2,11,50000,'BCA','pending','2021-12-05 15:15:26','2021-12-02 15:15:26','2021-12-02 15:15:26',NULL,NULL,'mahfudz','mfdsix.1nd0@gmail.com',NULL,538,0,50538,'0','bank',NULL,NULL,0,'1','wakaf',NULL,2,NULL),(91,3,NULL,10000,'BCA','pending','2021-12-06 04:11:25','2021-12-03 04:11:25','2021-12-03 04:11:25',NULL,NULL,'rifan','rifan@gmail.com',NULL,544,0,10544,'0','bank',NULL,NULL,0,'1','donation',NULL,NULL,NULL),(92,0,NULL,100000,'BNI Virtual Account','pending','2021-12-28 10:04:26','2021-12-25 10:04:26','2021-12-25 10:04:26',NULL,NULL,'mahfud',NULL,NULL,0,0,100000,'0','virtualaccount','0847532323','3422280166616568',0,'801','sedekah',NULL,NULL,'54229abfcfa5649e7003b83dd4755294');
/*!40000 ALTER TABLE `fundings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `fundraiser_transactions`
--

LOCK TABLES `fundraiser_transactions` WRITE;
/*!40000 ALTER TABLE `fundraiser_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraiser_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `fundraisers`
--

LOCK TABLES `fundraisers` WRITE;
/*!40000 ALTER TABLE `fundraisers` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraisers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `inboxes`
--

LOCK TABLES `inboxes` WRITE;
/*!40000 ALTER TABLE `inboxes` DISABLE KEYS */;
INSERT INTO `inboxes` VALUES (1,8,'Update Baru','<p>halo dsdds sdsad ada sdas dasda sdasdasdasdadad</p>',2,1,0,'2021-11-30 04:40:17',NULL),(2,5,'Update Baru','<p>halo dsdds sdsad ada sdas dasda sdasdasdasdadad</p>',2,1,0,'2021-11-30 04:40:17',NULL),(3,1,'Update Baru','<p>halo dsdds sdsad ada sdas dasda sdasdasdasdadad</p>',2,1,0,'2021-11-30 04:40:17',NULL);
/*!40000 ALTER TABLE `inboxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notifs`
--

LOCK TABLES `notifs` WRITE;
/*!40000 ALTER TABLE `notifs` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (2,NULL,'uploads/partner/K9h0mrTyvymo3pfPTCrKroeIf6G1PpEaZzsYyWQK.jpg','2021-12-25 08:26:56','2021-12-25 08:26:56');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('gilangaryadimahardika@gmail.com','3sgGeL27YFcch6CdeTETb','2021-09-27 08:38:47'),('arbyuyeach@gmail.com','z9idR57oa1SIaDUMDwTnS','2021-10-07 09:18:19');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `personal_settings`
--

LOCK TABLES `personal_settings` WRITE;
/*!40000 ALTER TABLE `personal_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'uploads/product/JBBwCpmUwVYRZSswAbZULbMUmNbNss3xC317fzyZ.jpg','VISVAL - Weistbag - Hitam','200000','<span style=\"color: rgba(0, 0, 0, 0.8); font-family: Roboto, &quot;Helvetica Neue&quot;, Helvetica, Arial, 文泉驛正黑, &quot;WenQuanYi Zen Hei&quot;, &quot;Hiragino Sans GB&quot;, &quot;儷黑 Pro&quot;, &quot;LiHei Pro&quot;, &quot;Heiti TC&quot;, 微軟正黑體, &quot;Microsoft JhengHei UI&quot;, &quot;Microsoft JhengHei&quot;, sans-serif; white-space: pre-wrap;\">VISVAL Wistbag dengan bahan terbaik, serat halus dan dengan design teknologi terbaik, sehingga membuat Anda terlihat semakin keren\r\n<br></span>','https://wa.me/081395458242',NULL,'2021-09-23 02:54:17','2021-09-23 02:54:17'),(2,'uploads/product/gVIoJtlyCwbn5Vp967nQw4x1eRq4VMoTUK8IDSic.jpg','Sepatu Cibaduyut','106500','<p>Sepatu mantap untuk Anda&nbsp;</p>','https://wa.me/081395733034','{\"Warna\":[\"Abu\",\"Hitam\",\"Coklat\"]}','2021-10-06 04:38:14','2021-10-06 04:38:14'),(3,'uploads/product/eA8WEqdkDGd7QnBF56MbIHbG3jWv5WlHUBUnRcgL.jpg','Kaos Cotton Combed 24\'s','100000','Kaos Cotton Combed 24\'s Premium','https://wa.me/08139373892',NULL,'2021-10-06 12:22:13','2021-10-06 12:22:13'),(4,'uploads/product/j2A8FL5ALMCGf5CkUtmke0zroNu3kZ8ioItCQsFE.jpg','Mobil Roda 3 Handal','100000','<p>Mobil roda 3 handal, hemat bensin, dan terpercaya di segala medan</p>','https://wa.me/08139373892','{\"Warna\":[\"Merah\",\"Putih\",\"\"]}','2021-10-06 12:25:52','2021-10-06 12:25:52');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `project_categories`
--

LOCK TABLES `project_categories` WRITE;
/*!40000 ALTER TABLE `project_categories` DISABLE KEYS */;
INSERT INTO `project_categories` VALUES (1,'uploads/category/RT4aveSGQGWYlHgGRK4SHn8scTrwJuewrXAMcSkz.png','Zakat','<div style=\"color: rgb(54, 54, 54); font-family: Inter;\">Sesungguhnya orang-orang yang beriman, mengerjakan amal saleh, mendirikan shalat dan menunaikan zakat, mereka mendapat pahala di sisi Tuhannya. Tidak ada kekhawatiran terhadap mereka dan tidak (pula) mereka bersedih hati.</div><div style=\"color: rgb(54, 54, 54); font-family: Inter;\"><font color=\"#0000ff\">Q.S Al- Baqarah ayat : 277</font></div>','2021-09-23 02:10:52','2021-12-25 08:37:09',3,0,'uploads/category/XnJ4jdDVj6g3dUDx811kgIofkyxphM7e8kTdhEcf.jpg'),(2,'uploads/category/1nzl1lY5Uiwd8XXb2AzKb4ewGKnv2DrDXgYTb08P.png','Wakaf','<div style=\"color: rgb(54, 54, 54); font-family: Inter;\">Apabila manusia meninggal dunia, maka terputus amalnya kecuali tiga perkara : shadaqah jariyah, atau ilmu yang bermanfaat, atau anak shalih yang mendoakannya.</div><div style=\"color: rgb(54, 54, 54); font-family: Inter;\"><font color=\"#0000ff\">HR Muslim 3084</font></div>','2021-09-23 02:11:10','2021-11-30 04:32:28',1,0,NULL),(3,'uploads/category/IfImCGoyBdYyOH5yUyqghWlIjCxkW39HClXUxliB.png','Infaq','<div style=\"color: rgb(54, 54, 54); font-family: Inter;\">“Jagalah diri kalian dari neraka meskipun hanya dengan sedekah setengah biji kurma. Barangsiapa yang tak mendapatkannya, maka ucapkanlah perkataan yang baik.”<font color=\"#0000ff\">&nbsp;</font></div><div style=\"color: rgb(54, 54, 54); font-family: Inter;\"><font color=\"#0000ff\">(HR. Bukhari no. 1413, 3595 dan Muslim no. 1016)</font></div>','2021-09-23 02:11:29','2021-11-30 04:32:28',2,0,NULL);
/*!40000 ALTER TABLE `project_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (2,'Bangun Masjid Al-Ikhlas, Selang, Wonosari','<p><span style=\"color: rgb(80, 80, 80); font-family: &quot;IBM Plex&quot;, Arial, sans-serif; font-size: 15px;\">Masjid ini digunakan untuk shalat wajib dan sunnah, masjid ini digunakan pula untuk kajian dan Hafalan Al-Qur\'an, bahkan Ustadz Muhammad Abduh Tuasikal akan memberikan kajian rutin di masjid ini.&nbsp;</span><br></p>','uploads/project/851b7u2gSJD8ZCo28r5GY9HZywIjbvY1YPdVl5UR.jpg',NULL,NULL,2,1,1,1,'2021-09-23 02:21:43','2021-12-25 16:17:31','Bangun-Masjid-Al-Ikhlas-Selang-Wonosari.','wakaf',1000000,'10000',1,'Wakaf Sekarang',8,4,0),(3,'Donasi Buka Akses Jalan di Pelosok Gunung Kidul','<p>Program ini merupakan tahap dua setelah sebelumya disalurkan pada tahap pertama untuk pembukaan jalan excavator<br></p>','uploads/project/iHb8Hp0k1nRQRmQZ8tz9uchcENySMUHO4pxAdp7H.jpg',NULL,NULL,3,1,1,1,'2021-09-23 02:23:26','2021-12-08 14:46:32','Donasi-Buka-Akses-Jalan-di-Pelosok-Gunung-Kidul.','donation',0,NULL,3,'Donasi Sekarang',10,0,0),(7,'Sapi untuk negeri tercinta','<p>Sapi untuk negeri tercinta</p>','uploads/project/vXpXUApJeG1QiisxIvLgOPQUegveeMFfntIWBjMd.jpg',NULL,NULL,1,1,1,1,'2021-10-18 07:52:56','2021-12-08 14:47:13','Sapi-untuk-negeri-tercinta','zakat',0,NULL,2,'Tunaikan Zakat Sekarang',5,0,0);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `projects_favourite`
--

LOCK TABLES `projects_favourite` WRITE;
/*!40000 ALTER TABLE `projects_favourite` DISABLE KEYS */;
INSERT INTO `projects_favourite` VALUES (1,6,1,'2021-09-30 09:45:04','2021-09-30 09:45:04'),(2,3,2,'2021-10-25 03:58:21','2021-10-25 03:58:21'),(6,1,3,'2021-10-27 07:08:28','2021-10-27 07:08:28'),(13,5,2,'2021-11-25 14:02:06','2021-11-25 14:02:06'),(14,5,3,'2021-11-25 14:02:20','2021-11-25 14:02:20'),(15,10,2,'2021-11-28 12:25:56','2021-11-28 12:25:56');
/*!40000 ALTER TABLE `projects_favourite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `qurban_checkouts`
--

LOCK TABLES `qurban_checkouts` WRITE;
/*!40000 ALTER TABLE `qurban_checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurban_checkouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `qurban_details`
--

LOCK TABLES `qurban_details` WRITE;
/*!40000 ALTER TABLE `qurban_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurban_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `qurban_payments`
--

LOCK TABLES `qurban_payments` WRITE;
/*!40000 ALTER TABLE `qurban_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurban_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `qurbans`
--

LOCK TABLES `qurbans` WRITE;
/*!40000 ALTER TABLE `qurbans` DISABLE KEYS */;
INSERT INTO `qurbans` VALUES (1,'Kambing',NULL,NULL,NULL,1200000,NULL,'uploads/project/qurban/dlVTx5oylfZF5WpLoDolPcYyU7J4Pohe8I1CFcgM.jpg','2021-09-23 02:31:19','2021-09-23 02:31:19',NULL),(2,'Sapi',NULL,NULL,NULL,25000000,NULL,'uploads/project/qurban/BJMMb8sTJRPXN6kLSlOWOfr0nz6oslgb9wH1Ghk0.jpg','2021-09-23 02:46:58','2021-09-23 02:46:58',NULL);
/*!40000 ALTER TABLE `qurbans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `referrals`
--

LOCK TABLES `referrals` WRITE;
/*!40000 ALTER TABLE `referrals` DISABLE KEYS */;
INSERT INTO `referrals` VALUES (1,10,NULL,2,'Contoh a','Nurman',1000000,0,0,1,'2021-11-28 12:26:38','2021-11-28 12:26:38'),(2,11,NULL,2,'Bagun Masjid Yok, Donasi Sekarang','BangMasJid',1000000,0,0,1,'2021-12-02 15:13:54','2021-12-02 15:13:54');
/*!40000 ALTER TABLE `referrals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (2,'uploads/slider/0b7HTAqKpkJsaBqOfU8Qfj725K4SdKeuKtgRDUh7.png','https://demo.forfund.asia/','2021-09-23 02:09:49','2021-09-23 02:09:49','top'),(3,'uploads/slider/9CWV5RJm94YpXBCQhDpprqJ4EktDUhP8wPLXwWmz.png','https://demo.forfund.asia/','2021-10-06 09:17:30','2021-10-06 09:17:30','top'),(4,'uploads/slider/cFWXmEpEaxVzCWCejrbnXCJba8cDBcKboM3aKnEs.png','https://demo.forfund.asia/','2021-10-06 09:17:41','2021-10-06 09:17:41','top');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `topups`
--

LOCK TABLES `topups` WRITE;
/*!40000 ALTER TABLE `topups` DISABLE KEYS */;
INSERT INTO `topups` VALUES (1,3,10000,94,10094,'bank','1','BCA',NULL,'2021-09-27 16:24:06',NULL,'2021-10-04 16:24:06',1,'2021-09-27 09:24:06','2021-09-27 09:24:06',NULL),(2,3,10000,290,10290,'bank','1','BCA',NULL,'2021-09-29 20:29:37',NULL,'2021-10-06 20:29:37',1,'2021-09-29 13:29:37','2021-09-29 13:29:37',NULL);
/*!40000 ALTER TABLE `topups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `uniqe_codes`
--

LOCK TABLES `uniqe_codes` WRITE;
/*!40000 ALTER TABLE `uniqe_codes` DISABLE KEYS */;
INSERT INTO `uniqe_codes` VALUES (1,681,'2021-09-22 11:06:58','2021-12-25 16:32:41');
/*!40000 ALTER TABLE `uniqe_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `updates`
--

LOCK TABLES `updates` WRITE;
/*!40000 ALTER TABLE `updates` DISABLE KEYS */;
INSERT INTO `updates` VALUES (1,2,0,'<p>halo dsdds sdsad ada sdas dasda sdasdasdasdadad</p>',0,'2021-11-30 04:40:17','2021-11-30 04:40:17',1,NULL);
/*!40000 ALTER TABLE `updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES  (2,'wkwkwkw','arbyazra@gmail.com',NULL,'$2y$10$SmSBsxbbUnkaL4YW9Jdfn.2LCEXgNTh9W2I5a6bfXwLJjz20RhTmm','user',NULL,NULL,'2021-09-22 13:27:27','2021-12-05 07:43:35',0,'arbyazra@gmail.com',NULL,0),(3,'Gilang','gilangaryadimahardika@gmail.com',NULL,'$2y$10$YpwQAyvzMq/6S0pmPns/rOKhz0Cs6NwxASM7JvAXymexe86ynRYQ6','user',NULL,NULL,'2021-09-23 01:59:46','2021-09-29 13:35:59',0,NULL,'[{\"1\":{}}]',0),(4,'myname','mymail@gmail.com',NULL,'$2y$10$7txYKSo8IhfiHStZLzG5NOJkrTZ.qlD.2b/jVyq.O98/q4xn91Wpq','user',NULL,NULL,'2021-09-30 08:01:11','2021-09-30 08:01:11',0,'mymail@gmail.com',NULL,0),(5,'yudono','yudonoputro@gmail.com',NULL,'$2y$10$EaMp2.CPgzCW2lnSRSe.heb05L8KFegV5CfTwQtBZWS7lbvksDeqa','user',NULL,NULL,'2021-09-30 08:01:41','2021-11-25 14:05:08',0,'yudonoputro@gmail.com','[{\"1\":{}}]',0),(6,'Muhammad Shiddiq','messidiq27@gmail.com',NULL,'$2y$10$oA0HOOApf33Lm/jLh6QBgO9PM76lMdnzlqStRFXE3P1RuHaZ41gWC','user',NULL,NULL,'2021-09-30 09:31:40','2021-09-30 09:31:40',0,NULL,NULL,0),(7,'arbyazra','arbyuyeach@gmail.com',NULL,'$2y$10$KsntFbInkObvRQvBOdH6u.hTAIUSCurIy5.4gsxsjCzd1a8suqVKa','user','uploads/users/w4CcvH2XIMMr5mkzP0rFlwI4n2aC26ig4xL3bQjR.jpg',NULL,'2021-10-01 05:01:36','2021-10-05 19:02:57',0,'arbyuyeach@gmail.com',NULL,0),(8,'rafiqsiregar','rafiqsiregar@gmail.com',NULL,'$2y$10$HIiVNBk7ddK.EJZFFtfQo.GP9mlymSBd3NOH4tdDFS6hoxDg0Pqc6','user',NULL,NULL,'2021-10-01 09:51:48','2021-10-01 09:51:48',0,NULL,NULL,0),(9,'Abdun','fm.syahrul@gmail.com',NULL,'$2y$10$V7SJtJYBUWOQmfnxCtwmKef4LlAi7i.rGpFUsCv/P52/ee5NGNe3G','user',NULL,NULL,'2021-10-28 06:54:29','2021-10-28 06:54:29',0,NULL,NULL,0),(10,'Nurman','nurman@gmail.com',NULL,'$2y$10$a6YiEvdK1a.bca0p4hZTt.4Hu7/FgHIeLP92oNPznDNRSmxni4zWG','user',NULL,NULL,'2021-11-28 12:24:59','2021-11-28 12:24:59',0,NULL,NULL,0),(11,'mahfudz','mfdsix.1nd0@gmail.com',NULL,'$2y$10$nsXDYkEIT75p.KvcgF341.38jdzLTZN2J4BHfq.mDJz1lW8oHIUXm','user',NULL,NULL,'2021-12-02 15:10:42','2021-12-02 15:10:42',0,NULL,NULL,0),(12,'admin2','admin2@outlook.com',NULL,'$2y$10$Opoz6HddHD/802QrSR6t1uHArTKC1/buAjBmOvbXmE65cEG4nJC/2','admin',NULL,NULL,'2021-12-05 07:35:51','2021-12-05 07:41:44',0,NULL,NULL,0),(13,'user3','user3@gmail.com',NULL,'$2y$10$9WRFGgCNOnfdnnbk1qlZXeCUc2RRZMJIZVSjPWaK6hhd8xMPLnAka','admin',NULL,NULL,'2021-12-05 07:36:45','2021-12-05 07:36:45',0,NULL,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `withdrawals`
--

LOCK TABLES `withdrawals` WRITE;
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `zakats`
--

LOCK TABLES `zakats` WRITE;
/*!40000 ALTER TABLE `zakats` DISABLE KEYS */;
/*!40000 ALTER TABLE `zakats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-26  0:02:49


LOCK TABLES `fundraisers` WRITE;
/*!40000 ALTER TABLE `fundraisers` DISABLE KEYS */;
INSERT INTO `fundraisers` VALUES (1,11,'Mahfudz Berbagi',NULL,'personal','mfdsix.1nd0@gmail.com','0847536735','PIC2','Jawa Tengah',NULL,'Nn2kLnN',0,0,0,0,0,'2021-12-26 05:54:19','2021-12-26 06:18:36',1);
/*!40000 ALTER TABLE `fundraisers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;