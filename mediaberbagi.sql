-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: mediaberbagi
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `direct_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_categories`
--

LOCK TABLES `blog_categories` WRITE;
/*!40000 ALTER TABLE `blog_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `category` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `APP_NAME` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_MAILER` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_HOST` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_PORT` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_USERNAME` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_PASSWORD` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_ENCRYPTION` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_FROM_ADDRESS` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_FROM_NAME` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MB_HOST` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MB_ACCESS_KEY` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RUANGWA_TOKEN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES (1,'MediaBerbagi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'MediaBerbagi',NULL,NULL,NULL,'2023-04-07 07:35:52','2023-04-07 07:35:52');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docs`
--

DROP TABLE IF EXISTS `docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docs`
--

LOCK TABLES `docs` WRITE;
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donaturs`
--

DROP TABLE IF EXISTS `donaturs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `donaturs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `is_verified` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donaturs`
--

LOCK TABLES `donaturs` WRITE;
/*!40000 ALTER TABLE `donaturs` DISABLE KEYS */;
/*!40000 ALTER TABLE `donaturs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundings`
--

DROP TABLE IF EXISTS `fundings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fundings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `nominal` double NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_reason` text COLLATE utf8mb4_unicode_ci,
  `donature_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donature_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_message` text COLLATE utf8mb4_unicode_ci,
  `unique_code` int DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `total` double NOT NULL DEFAULT '0',
  `additional_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donature_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `payment_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fund_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'donation',
  `wish_message` text COLLATE utf8mb4_unicode_ci,
  `referral_id` int DEFAULT NULL,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputer_id` int DEFAULT NULL,
  `inputer_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `pay_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jeniskelamin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `typeprogram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundings`
--

LOCK TABLES `fundings` WRITE;
/*!40000 ALTER TABLE `fundings` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraiser_transactions`
--

DROP TABLE IF EXISTS `fundraiser_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fundraiser_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'commission',
  `amount` int NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reference_id` int DEFAULT NULL,
  `fundraiser_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraiser_transactions`
--

LOCK TABLES `fundraiser_transactions` WRITE;
/*!40000 ALTER TABLE `fundraiser_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraiser_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fundraisers`
--

DROP TABLE IF EXISTS `fundraisers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fundraisers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_in_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commissions` int NOT NULL DEFAULT '0',
  `collected` int NOT NULL DEFAULT '0',
  `clicks` int NOT NULL DEFAULT '0',
  `transaction` int NOT NULL DEFAULT '0',
  `success_transaction` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '1',
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fundraisers`
--

LOCK TABLES `fundraisers` WRITE;
/*!40000 ALTER TABLE `fundraisers` DISABLE KEYS */;
/*!40000 ALTER TABLE `fundraisers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inboxes`
--

DROP TABLE IF EXISTS `inboxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inboxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int NOT NULL,
  `target_id` int NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inboxes`
--

LOCK TABLES `inboxes` WRITE;
/*!40000 ALTER TABLE `inboxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `inboxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instant_programs`
--

DROP TABLE IF EXISTS `instant_programs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `instant_programs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `custom_nominal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operational` int NOT NULL DEFAULT '0',
  `commision` int NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_featured` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label_button` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instant_programs`
--

LOCK TABLES `instant_programs` WRITE;
/*!40000 ALTER TABLE `instant_programs` DISABLE KEYS */;
INSERT INTO `instant_programs` VALUES (1,'sedekah',1,NULL,NULL,NULL,0,0,NULL,'','',''),(2,'wakaf',1,NULL,NULL,NULL,0,0,NULL,'','',''),(3,'zakat',1,NULL,NULL,NULL,0,0,NULL,'','','');
/*!40000 ALTER TABLE `instant_programs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kwitansis`
--

DROP TABLE IF EXISTS `kwitansis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kwitansis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kwitansis`
--

LOCK TABLES `kwitansis` WRITE;
/*!40000 ALTER TABLE `kwitansis` DISABLE KEYS */;
/*!40000 ALTER TABLE `kwitansis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2020_06_07_074849_create_donaturs_table',1),(4,'2020_06_07_075059_create_project_categories_table',1),(5,'2020_06_07_075537_create_projects_table',1),(6,'2020_06_07_075749_create_updates_table',1),(7,'2020_06_07_080644_create_fundings_table',1),(8,'2020_06_07_081639_create_sliders_table',1),(9,'2020_07_07_210337_create_fundraisers_table',1),(10,'2020_07_07_223555_create_withdrawals_table',1),(11,'2020_07_07_224110_create_inboxes_table',1),(12,'2020_07_26_132958_add_payment_proof_to_fundings_table',1),(13,'2020_08_04_215521_add_is_confirmed_to_fundraisers_table',1),(14,'2020_08_11_161602_create_banks_table',1),(15,'2020_09_13_235629_add_tripay_to_funding_table',1),(16,'2020_10_04_235123_create_notifs_table',1),(17,'2020_10_25_095321_add_slug_to_projects_table',1),(18,'2020_10_25_103027_create_docs_table',1),(19,'2020_12_03_085243_add_is_admin_to_fundings_table',1),(20,'2020_12_03_092936_create_settings_table',1),(21,'2020_12_03_095404_add_payment_code_to_fundings_table',1),(22,'2021_01_19_193840_add_user_id_to_updates_table',1),(23,'2021_01_24_232358_create_topups_table',1),(24,'2021_01_24_232517_add_saldo_to_users_table',1),(25,'2021_01_31_190512_create_activities_table',1),(26,'2021_02_01_105112_add_type_to_projects_table',1),(27,'2021_02_03_230355_add_wakaf_price_to_projects_table',1),(28,'2021_02_04_093522_add_fund_type_to_fundings_table',1),(29,'2021_02_04_093930_add_wakaf_to_projects_table',1),(30,'2021_02_07_230111_add_wish_message_to_fundings_table',1),(31,'2021_02_08_135016_create_zakats_table',1),(32,'2021_02_25_123716_add_position_to_sliders_table',1),(33,'2021_02_25_124921_create_blogs_table',1),(34,'2021_03_01_212038_add_phone_to_users_table',1),(35,'2021_03_11_151358_add_order_number_to_projects_table',1),(36,'2021_03_29_221425_add_button_label_to_projects_table',1),(37,'2021_03_30_120200_add_order_to_project_categories_table',1),(38,'2021_08_11_003752_create_products_table',1),(39,'2021_08_12_121640_create_product_variants_table',1),(40,'2021_08_12_121721_create_product_images_table',1),(41,'2021_08_12_160458_create_carts_table',1),(42,'2021_08_13_105231_create_qurban_checkouts_table',1),(43,'2021_08_13_105530_create_qurban_details_table',1),(44,'2021_08_13_110626_create_qurban_payments_table',1),(45,'2021_08_13_142335_create_qurbans_table',1),(46,'2021_08_15_044349_add_cart_to_users_table',1),(47,'2021_08_16_090106_add_grand_price_to_qurbans_table',1),(48,'2021_08_16_115946_create_projects_favourite_table',1),(49,'2021_08_16_125030_create_personal_settings_table',1),(50,'2021_09_15_151441_add_path_proof_to_topups_table',1),(51,'2021_09_20_111210_add_path_proof_to_qurban_payments_table',1),(52,'2021_09_20_114559_add_variable_to_settings_table',1),(53,'2021_09_20_135304_add_qurban_detail_id_to_qurban_details_table',1),(54,'2021_09_20_145018_add_user_id_to_qurban_details_table',1),(55,'2021_09_20_153052_create_uniqe_codes_table',1),(56,'2021_09_20_162338_add_unique_code_to_qurban_payments_table',1),(57,'2021_10_01_140113_add_risalah_status_to_project_categories_table',1),(58,'2021_11_26_110623_create_referrals_table',1),(59,'2021_11_26_111327_add_referral_id_to_fundings_table',1),(60,'2021_11_26_172406_add_slug_to_blogs_table',1),(61,'2021_11_26_214743_add_views_to_blogs_table',1),(62,'2021_11_28_144923_add_bill_no_to_fundings_table',1),(63,'2021_11_29_104806_add_operational_percentage_to_projects_table',1),(64,'2021_12_01_163800_create_blog_categories_table',1),(65,'2021_12_01_164814_add_category_to_blogs_table',1),(66,'2021_12_01_210257_add_notification_settings_data',1),(67,'2021_12_02_161357_add_title_to_updates_table',1),(68,'2021_12_25_150611_create_partners_table',1),(69,'2021_12_25_153119_add_image_to_project_categories_table',1),(70,'2021_12_25_155349_add_statisctic_to_projects_table',1),(71,'2021_12_25_170644_add_is_fundraiser_to_users_table',1),(72,'2021_12_25_232443_create_fundraiser_transactions_table',1),(73,'2021_12_26_192036_add_account_type_to_projects_table',1),(74,'2021_12_26_201041_add_account_type_to_withdrawals_table',1),(75,'2021_12_26_213354_add_inputer_to_fundings_table',1),(76,'2021_12_26_230756_create_storage_usages_table',1),(77,'2021_12_27_115329_create_instant_programs_table',1),(78,'2021_12_28_094130_add_withdrawal_type_to_withdrawals_table',1),(79,'2021_12_28_100653_add_reference_id_to_updates_table',1),(80,'2022_01_01_114733_add_receiver_to_withdrawal_tables',1),(81,'2022_01_01_115851_add_project_type_to_withdrawals_table',1),(82,'2022_01_01_120528_add_soft_delete_to_projects_table',1),(83,'2022_01_10_215532_add_google_analytics_to_setting_table',1),(84,'2022_01_12_231641_add_font_to_settings_table',1),(85,'2022_02_03_110718_create_configs_table',1),(86,'2022_02_03_142043_create_payment_credentials_table',1),(87,'2022_02_03_143405_add_payment_gateway_vendor_to_settings_table',1),(88,'2022_02_05_084430_add_tripay_to_fundings_table',1),(89,'2022_02_17_132711_add_path_icon_to_setting_table',1),(90,'2022_02_21_145937_add_facebook_pixel_to_setting_table',1),(91,'2022_02_25_140526_add_direct_link_to_activities_table',1),(92,'2022_03_02_160016_create_themes_table',1),(93,'2022_03_22_105955_add_reward_to_projects_table',1),(94,'2022_03_22_132358_add_reward_to_instant_program_table',1),(95,'2022_03_24_164339_add_operational_to_instant_programs_table',1),(96,'2022_03_25_164213_add_city_to_fundraisers_table',1),(97,'2022_03_26_165557_create_kwitansis_table',1),(98,'2022_04_01_143247_add_title_to_instant_programs_table',1),(99,'2022_07_12_144412_add_beasiswa_to_funding_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifs`
--

DROP TABLE IF EXISTS `notifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sended` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifs`
--

LOCK TABLES `notifs` WRITE;
/*!40000 ALTER TABLE `notifs` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `partner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_credentials`
--

DROP TABLE IF EXISTS `payment_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_credentials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'faspay',
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_credentials`
--

LOCK TABLES `payment_credentials` WRITE;
/*!40000 ALTER TABLE `payment_credentials` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_settings`
--

DROP TABLE IF EXISTS `personal_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `contact_whatsapp` int NOT NULL DEFAULT '0',
  `is_anonymous` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_settings`
--

LOCK TABLES `personal_settings` WRITE;
/*!40000 ALTER TABLE `personal_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `path` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_categories`
--

DROP TABLE IF EXISTS `project_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `risalah` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_number` int NOT NULL DEFAULT '0',
  `risalah_status` tinyint(1) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_categories`
--

LOCK TABLES `project_categories` WRITE;
/*!40000 ALTER TABLE `project_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_featured` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_target` double DEFAULT NULL,
  `date_target` date DEFAULT NULL,
  `category_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `is_fixed` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'donation',
  `wakaf_price` double NOT NULL DEFAULT '0',
  `wakaf_unit` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int NOT NULL DEFAULT '0',
  `button_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operational_percentage` int NOT NULL DEFAULT '0',
  `views` int NOT NULL DEFAULT '0',
  `donations` int NOT NULL DEFAULT '0',
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `fundraiser_reward` double(8,2) DEFAULT NULL,
  `is_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_nominal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects_favourite`
--

DROP TABLE IF EXISTS `projects_favourite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects_favourite` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects_favourite`
--

LOCK TABLES `projects_favourite` WRITE;
/*!40000 ALTER TABLE `projects_favourite` DISABLE KEYS */;
/*!40000 ALTER TABLE `projects_favourite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qurban_checkouts`
--

DROP TABLE IF EXISTS `qurban_checkouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qurban_checkouts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `grand_price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qurban_checkouts`
--

LOCK TABLES `qurban_checkouts` WRITE;
/*!40000 ALTER TABLE `qurban_checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurban_checkouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qurban_details`
--

DROP TABLE IF EXISTS `qurban_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qurban_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `qurban_id` int NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qurban_payment_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qurban_details`
--

LOCK TABLES `qurban_details` WRITE;
/*!40000 ALTER TABLE `qurban_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurban_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qurban_payments`
--

DROP TABLE IF EXISTS `qurban_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qurban_payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `qurban_id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `donatur_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donatur_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donatur_whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_whatsapp` tinyint(1) NOT NULL DEFAULT '0',
  `nominal` double NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qurban_payments`
--

LOCK TABLES `qurban_payments` WRITE;
/*!40000 ALTER TABLE `qurban_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurban_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qurbans`
--

DROP TABLE IF EXISTS `qurbans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qurbans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa` int DEFAULT NULL,
  `price` int NOT NULL,
  `atas_nama` int DEFAULT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grand_price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qurbans`
--

LOCK TABLES `qurbans` WRITE;
/*!40000 ALTER TABLE `qurbans` DISABLE KEYS */;
/*!40000 ALTER TABLE `qurbans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `referrals`
--

DROP TABLE IF EXISTS `referrals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `referrals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `donature_id` int DEFAULT NULL,
  `project_id` int NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int NOT NULL,
  `collected` int NOT NULL DEFAULT '0',
  `referred` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `referrals`
--

LOCK TABLES `referrals` WRITE;
/*!40000 ALTER TABLE `referrals` DISABLE KEYS */;
/*!40000 ALTER TABLE `referrals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `danger` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_primary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_secondary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_analytics` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font` text COLLATE utf8mb4_unicode_ci,
  `payment_gateway_vendor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_pixel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'donation_reminder','Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nTerima kasih telah berniat untuk investasi akhirat di <<app_name>>.\n\nKami hanya ingin mengingatkan niat baik Bapak/Ibu untuk berinvestasi akhirat di <<app_name>>\nPahala besar dan keberkahan sudah menunggu segera tunaikan niat baik Anda\n\nIni Nomor Transaksinya : <<invoice_number>>\nDonasi untuk program: <<campaign_name>>\nTinggal selangkah lagi pahala Anda langsung mengalir in syaa Allah.\n\nSilahkan transfer sejumlah <<donation_amount>>\n(Pastikan nominal transfernya sama persis, agar bisa kami konfirmasi dengan tepat)\n\nPembayaran dengan: <<payment_method>>\nLakukan sebelum <<time_limit>>\n\nSemoga niat baik kita semua, dimudahkan oleh Allah.\n\nSilahkan simpan kontak ini sebagai Admin Amal <<app_name>> untuk mendapatkan info terkait program lainnya.\n\nTerima kasih.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'donation_thanks','Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nAlhamdulillah investasi akhirat Anda sebesar <<donation_amount>> telah kami terima\n\nKami berdoa semoga membalasnya dengan pahala yang besar dan tidak putus putus nya. Menambahkan keberkahan pada harta yang tersisa dan memberikan kebahagiaan bagi Anda dan keluarga. Serta Allah mudahkan semua urusan Anda.\nAmin Ya Robbal Alamin\n\nTerima kasih.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'gold_price','830000','2023-04-07 07:35:52','2023-04-07 07:35:52',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'silver_price','12000','2023-04-07 07:35:52','2023-04-07 07:35:52',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `path_slider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'top',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storage_usages`
--

DROP TABLE IF EXISTS `storage_usages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storage_usages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `disk_usage` double NOT NULL DEFAULT '0',
  `database_usage` double NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storage_usages`
--

LOCK TABLES `storage_usages` WRITE;
/*!40000 ALTER TABLE `storage_usages` DISABLE KEYS */;
INSERT INTO `storage_usages` VALUES (1,309056150,28718648,'2023-04-07 07:35:52','2023-04-07 07:35:52'),(2,209553582,30743060,'2023-04-06 07:35:52','2023-04-07 07:35:52'),(3,224935862,18098222,'2023-04-05 07:35:52','2023-04-07 07:35:52'),(4,212613428,26684744,'2023-04-04 07:35:52','2023-04-07 07:35:52'),(5,260933908,52785030,'2023-04-03 07:35:52','2023-04-07 07:35:52'),(6,245842256,37032168,'2023-04-02 07:35:52','2023-04-07 07:35:52'),(7,240330130,58036136,'2023-04-01 07:35:52','2023-04-07 07:35:52'),(8,226513465,29910845,'2023-03-31 07:35:52','2023-04-07 07:35:52'),(9,237274840,37447370,'2023-03-30 07:35:52','2023-04-07 07:35:52'),(10,246293674,70894856,'2023-03-29 07:35:52','2023-04-07 07:35:52');
/*!40000 ALTER TABLE `storage_usages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `compatible` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `script` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topups`
--

DROP TABLE IF EXISTS `topups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `topups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `nominal` double NOT NULL,
  `extra_cost` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `req_at` datetime NOT NULL,
  `pay_at` datetime DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topups`
--

LOCK TABLES `topups` WRITE;
/*!40000 ALTER TABLE `topups` DISABLE KEYS */;
/*!40000 ALTER TABLE `topups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uniqe_codes`
--

DROP TABLE IF EXISTS `uniqe_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uniqe_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uniqe_codes`
--

LOCK TABLES `uniqe_codes` WRITE;
/*!40000 ALTER TABLE `uniqe_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `uniqe_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `updates`
--

DROP TABLE IF EXISTS `updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `updates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint DEFAULT NULL,
  `nominal` double NOT NULL DEFAULT '0',
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_type` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `updates`
--

LOCK TABLES `updates` WRITE;
/*!40000 ALTER TABLE `updates` DISABLE KEYS */;
/*!40000 ALTER TABLE `updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `path_foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `saldo` double NOT NULL DEFAULT '0',
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart` json DEFAULT NULL,
  `is_fundraiser` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@gmail.com',NULL,'$2y$10$ayHpm/ck0EZVOabYgbTCpOC8TgdW.MpyWq.IfwNAtXrCaXUuDXyS6','admin',NULL,NULL,'2023-04-07 07:35:52','2023-04-07 07:35:52',0,NULL,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `withdrawals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `approver_id` int DEFAULT NULL,
  `project_id` int NOT NULL,
  `nominal` double NOT NULL,
  `use_plan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_date` timestamp NOT NULL,
  `approve_date` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `reject_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `withdrawal_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'distribution',
  `receiver` int NOT NULL DEFAULT '0',
  `receiver_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `withdrawals`
--

LOCK TABLES `withdrawals` WRITE;
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zakats`
--

DROP TABLE IF EXISTS `zakats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zakats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'harta',
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `funding_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zakats`
--

LOCK TABLES `zakats` WRITE;
/*!40000 ALTER TABLE `zakats` DISABLE KEYS */;
/*!40000 ALTER TABLE `zakats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mediaberbagi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-07 14:37:03
