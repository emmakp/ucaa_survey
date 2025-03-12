-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: survey
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.23.04.1

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
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_submission_id` bigint unsigned DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  KEY `answers_survey_submission_id_foreign` (`survey_submission_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `answers_survey_submission_id_foreign` FOREIGN KEY (`survey_submission_id`) REFERENCES `survey_submissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audience_survey`
--

DROP TABLE IF EXISTS `audience_survey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audience_survey` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_id` bigint unsigned NOT NULL,
  `audience_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `audience_survey_survey_id_audience_id_unique` (`survey_id`,`audience_id`),
  KEY `audience_survey_audience_id_foreign` (`audience_id`),
  CONSTRAINT `audience_survey_audience_id_foreign` FOREIGN KEY (`audience_id`) REFERENCES `audiences` (`id`) ON DELETE CASCADE,
  CONSTRAINT `audience_survey_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audience_survey`
--

LOCK TABLES `audience_survey` WRITE;
/*!40000 ALTER TABLE `audience_survey` DISABLE KEYS */;
INSERT INTO `audience_survey` VALUES (1,1,1,'2025-03-09 19:54:00','2025-03-09 19:54:00'),(2,1,2,'2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `audience_survey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audiences`
--

DROP TABLE IF EXISTS `audiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validity` tinyint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `audiences_obfuscator_unique` (`obfuscator`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audiences`
--

LOCK TABLES `audiences` WRITE;
/*!40000 ALTER TABLE `audiences` DISABLE KEYS */;
INSERT INTO `audiences` VALUES (1,'Passenger','Passenger',1,'FgVvH3mufM','2025-03-09 19:54:00','2025-03-09 19:54:00',1,NULL),(2,'Staff','Staff',1,'m4QCOG10P1','2025-03-09 19:54:00','2025-03-09 19:54:00',1,NULL);
/*!40000 ALTER TABLE `audiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_trail` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `function` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (1,NULL,NULL,'Logout',1,'2025-03-09 19:54:04','2025-03-09 19:54:04'),(2,NULL,NULL,'Login',1,'2025-03-09 19:54:11','2025-03-09 19:54:11'),(3,'HomeController','index','View List of Audit Trail',1,'2025-03-09 19:54:11','2025-03-09 19:54:11'),(4,'AuditTrailController','index','View List of Audit Trail',1,'2025-03-09 19:54:15','2025-03-09 19:54:15'),(5,'AuditTrailController','index','View List of Audit Trail',1,'2025-03-09 19:54:17','2025-03-09 19:54:17'),(6,'AuditTrailController','index','View List of Audit Trail',1,'2025-03-09 19:54:17','2025-03-09 19:54:17'),(7,'AuditTrailController','index','View List of Audit Trail',1,'2025-03-09 19:54:18','2025-03-09 19:54:18'),(8,'AuditTrailController','index','View List of Audit Trail',1,'2025-03-09 19:54:18','2025-03-09 19:54:18');
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controllers`
--

DROP TABLE IF EXISTS `controllers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controllers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controllers`
--

LOCK TABLES `controllers` WRITE;
/*!40000 ALTER TABLE `controllers` DISABLE KEYS */;
/*!40000 ALTER TABLE `controllers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Security',1,'Handles security screening and safety','2025-03-09 19:54:00','2025-03-09 19:54:00'),(2,'Operations',1,'Manages check-in, boarding, and baggage','2025-03-09 19:54:00','2025-03-09 19:54:00'),(3,'Customs and Immigrations',1,'Oversees immigration and customs processes','2025-03-09 19:54:00','2025-03-09 19:54:00'),(4,'Strategic Planning',1,'Focuses on transportation and airport strategy','2025-03-09 19:54:00','2025-03-09 19:54:00'),(5,'Information Desk',1,'Provides customer support and emergency response','2025-03-09 19:54:00','2025-03-09 19:54:00'),(6,'General',1,'Covers overall airport experience','2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DepartmentID` int NOT NULL,
  `Gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TitleID` int NOT NULL,
  `PhoneNumber` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file_uploads`
--

DROP TABLE IF EXISTS `file_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `file_uploads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file_uploads`
--

LOCK TABLES `file_uploads` WRITE;
/*!40000 ALTER TABLE `file_uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `file_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `functionary`
--

DROP TABLE IF EXISTS `functionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `functionary` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ControllerID` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `functionary`
--

LOCK TABLES `functionary` WRITE;
/*!40000 ALTER TABLE `functionary` DISABLE KEYS */;
/*!40000 ALTER TABLE `functionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jurisdictions`
--

DROP TABLE IF EXISTS `jurisdictions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jurisdictions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jurisdictions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jurisdictions`
--

LOCK TABLES `jurisdictions` WRITE;
/*!40000 ALTER TABLE `jurisdictions` DISABLE KEYS */;
INSERT INTO `jurisdictions` VALUES (1,'Passenger',1,'2025-03-09 19:54:00','2025-03-09 19:54:00'),(2,'Staff',1,'2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `jurisdictions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_09_16_074913_createuserrolestable',1),(5,'2019_11_23_051922_create_titles_table',1),(6,'2019_12_20_065546_create_departments_table',1),(7,'2019_12_20_065629_create_employees_table',1),(8,'2021_11_23_065635_add_acrynom_to_titles_tables',1),(9,'2022_02_15_115436_create_audit_trail_table',1),(10,'2022_03_16_122125_create_file_uploads_table',1),(11,'2022_03_16_141855_create_controllers_table',1),(12,'2022_03_16_141959_create_functionary_table',1),(13,'2022_03_21_091107_create_user_role_functionaries_table',1),(14,'2022_04_05_121445_create_notifications_table',1),(15,'2024_07_28_152800_create_create_audiences_tables_table',1),(16,'2024_07_28_152810_create_create_surveys_tables_table',1),(17,'2024_07_28_152819_create_create_questionaires_tables_table',1),(18,'2024_07_28_152829_create_create_question_types_tables_table',1),(19,'2024_07_28_152838_create_create_questions_tables_table',1),(20,'2024_07_28_152848_create_create_answers_tables_table',1),(21,'2024_07_29_232923_add_obfuscator_to_questions_table',1),(22,'2024_07_29_233829_create_responses_table',1),(23,'2024_07_30_054152_create_options_table',1),(24,'2024_07_30_070108_add_validity_to_questions_table',1),(25,'2024_08_27_160200_update_answers_table',1),(26,'2025_02_27_130804_add_name_to_audiences_table',1),(27,'2025_02_27_135513_update_questions_table_add_survey_id_and_audience_type',1),(28,'2025_02_28_154445_add_department_to_questions_table',1),(29,'2025_03_01_075853_add_published_to_surveys_table',1),(30,'2025_03_01_103239_add_function_to_audit_trail_table',1),(31,'2025_03_01_112811_create_survey_submissions_table',1),(32,'2025_03_01_112921_add_survey_submission_id_to_answers_table',1),(33,'2025_03_04_103912_create_jurisdictions_table',1),(34,'2025_03_04_114252_add_is_active_to_departments_table',1),(35,'2025_03_04_142115_add_audience_id_to_surveys_table',1),(36,'2025_03_04_150451_create_audience_survey_pivot_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `options_question_id_foreign` (`question_id`),
  CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `question_types`
--

DROP TABLE IF EXISTS `question_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `question_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `question_types_obfuscator_unique` (`obfuscator`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_types`
--

LOCK TABLES `question_types` WRITE;
/*!40000 ALTER TABLE `question_types` DISABLE KEYS */;
INSERT INTO `question_types` VALUES (1,'Rating','mRvwvFmVRI','2025-03-09 19:54:00','2025-03-09 19:54:00'),(2,'Boolean','Yn4GvJgs7y','2025-03-09 19:54:00','2025-03-09 19:54:00'),(3,'Text','yHhMfia7Dy','2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `question_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionaires`
--

DROP TABLE IF EXISTS `questionaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questionaires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `survey_id` bigint unsigned NOT NULL,
  `validity` tinyint NOT NULL,
  `target_audience` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `questionaires_obfuscator_unique` (`obfuscator`),
  KEY `questionaires_survey_id_foreign` (`survey_id`),
  KEY `questionaires_target_audience_foreign` (`target_audience`),
  CONSTRAINT `questionaires_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `questionaires_target_audience_foreign` FOREIGN KEY (`target_audience`) REFERENCES `audiences` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionaires`
--

LOCK TABLES `questionaires` WRITE;
/*!40000 ALTER TABLE `questionaires` DISABLE KEYS */;
INSERT INTO `questionaires` VALUES (1,'initial-survey-passenger',1,1,1,'2025-03-09 19:54:00','2025-03-09 19:54:00'),(2,'initial-survey-staff',1,1,2,'2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `questionaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_id` bigint unsigned DEFAULT NULL,
  `audience_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `questionaire_id` bigint unsigned NOT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) DEFAULT '0',
  `stars` int DEFAULT NULL,
  `max` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validity` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `questions_obfuscator_unique` (`obfuscator`),
  KEY `questions_questionaire_id_foreign` (`questionaire_id`),
  KEY `questions_survey_id_foreign` (`survey_id`),
  CONSTRAINT `questions_questionaire_id_foreign` FOREIGN KEY (`questionaire_id`) REFERENCES `questionaires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `questions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'passenger','Security','How would you rate the efficiency and speed of the check-in process?',1,'1',1,'xbgqdbRdnS',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(2,1,'passenger','Security','Were airline and airport staff helpful and professional during check-in?',1,'2',1,'W4kzlz1WXI',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(3,1,'passenger','Security','Did you clearly understand security screening procedures before reaching the checkpoint?',1,'2',1,'a4jRN6YLrX',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(4,1,'passenger','Security','How would you rate the professionalism and courtesy of security personnel?',1,'1',1,'GUb84WtYFv',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(5,1,'passenger','Security','Did you experience any delays, confusion, or inconvenience during security screening?',1,'3',0,'Ug9FDmUj1h',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(6,1,'passenger','Security','Was the baggage screening process well-organized and efficient?',1,'2',1,'4NfgHyd3gj',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(7,1,'staff','Security','Are there enough counters and personnel to handle peak hours efficiently?',2,'2',1,'nzZmRYnbln',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(8,1,'staff','Security','Do you have the necessary tools and training to assist passengers smoothly?',2,'2',1,'Nk9EXjoU1S',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(9,1,'staff','Security','What challenges do you face in ensuring a smooth check-in process?',2,'3',0,'sAzJxpCdez',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(10,1,'staff','Security','Are security screening procedures clear, effective, and manageable?',2,'2',1,'kXajNEepcA',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(11,1,'staff','Security','What improvements could be made to reduce delays at security checkpoints?',2,'3',0,'8aI93u5U1Z',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(12,1,'staff','Security','Are there any security threats or operational challenges that need urgent attention?',2,'3',0,'GtXxDJtyWH',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(13,1,'passenger','Operations','How would you rate the cleanliness of the terminal, including restrooms?',1,'1',1,'1e4ps92VDW',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(14,1,'passenger','Operations','Were waiting areas comfortable, with adequate seating and facilities?',1,'2',1,'QbqcBXBj22',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(15,1,'passenger','Operations','How satisfied are you with the availability of charging ports and Wi-Fi connectivity?',1,'1',1,'Jsea7P90ee',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(16,1,'passenger','Operations','Were food, beverage, and retail options adequate in terms of quality and variety?',1,'1',1,'QJxGndcUCy',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(17,1,'passenger','Operations','Was signage clear and easy to follow throughout the airport?',1,'2',1,'UmNLe1KRng',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(18,1,'passenger','Operations','Were special assistance services (for disabled, elderly, or families with children) easy to access?',1,'2',1,'wmSL4sdjH2',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(19,1,'staff','Operations','Are there adequate facilities for staff rest areas and refreshment?',2,'2',1,'FNd7vX6Q3z',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(20,1,'staff','Operations','What operational challenges do you face in managing passenger facilities?',2,'3',0,'cSyUp9YQRS',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(21,1,'staff','Operations','Are maintenance teams responding quickly to facility issues?',2,'2',1,'OrnTtZKukf',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(22,1,'staff','Operations','Is signage effective in reducing passenger confusion and congestion?',2,'2',1,'p7cpXjLWPs',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(23,1,'staff','Operations','What improvements could be made to the overall passenger experience in the terminal?',2,'3',0,'t8pisiP0xj',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(24,1,'staff','Operations','Do you receive frequent passenger complaints about specific terminal services?',2,'3',0,'t1Ou0sGN0f',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(25,1,'passenger','Operations','Was the boarding process well-organized and clearly communicated?',1,'2',1,'2NmRfCUGBZ',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(26,1,'passenger','Operations','Did you experience any delays, confusion, or issues during boarding?',1,'3',0,'AJlSTEObY0',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(27,1,'passenger','Operations','How would you rate the efficiency of baggage claim and delivery?',1,'1',1,'reQ5oYxQ12',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(28,1,'passenger','Operations','Did your baggage arrive in good condition without damage or loss?',1,'2',1,'h4FrKddYmo',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(29,1,'passenger','Operations','Were lost or delayed baggage issues handled professionally and efficiently?',1,'2',1,'FSzZkDdb2e',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(30,1,'passenger','Operations','Was there enough overhead bin space for your carry-on luggage?',1,'2',1,'abIERyagoF',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(31,1,'staff','Operations','Are there challenges in coordinating with airlines for smooth boarding?',2,'3',0,'xTdkXIKjEW',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(32,1,'staff','Operations','Do you have the necessary equipment and manpower to handle baggage effectively?',2,'2',1,'r0visD8m9r',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(33,1,'staff','Operations','What are the common causes of baggage delays or mishandling?',2,'3',0,'ngcyWl8nDN',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(34,1,'staff','Operations','Are lost baggage reporting and resolution systems working efficiently?',2,'2',1,'v2AARBTAsf',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(35,1,'staff','Operations','Do boarding gates have sufficient space and resources to handle peak traffic?',2,'2',1,'Es2A5nUI3e',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(36,1,'staff','Operations','How can the boarding process be improved for both staff and passengers?',2,'3',0,'DM5j7aZJK0',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(37,1,'passenger','Customs and Immigrations','Was the immigration process quick and efficient?',1,'2',1,'GlskiiQwnd',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(38,1,'passenger','Customs and Immigrations','Were immigration officers professional and courteous?',1,'1',1,'D5y3HQITnh',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(39,1,'passenger','Customs and Immigrations','Were customs procedures clear, with proper guidance for passengers?',1,'2',1,'V6ypdp8z8e',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(40,1,'passenger','Customs and Immigrations','Were there any unnecessary delays or difficulties in passport control?',1,'3',0,'2BxZNaS0J2',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(41,1,'passenger','Customs and Immigrations','Did you feel safe and well-treated during the entire immigration process?',1,'2',1,'H39Mgw59Hy',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(42,1,'passenger','Customs and Immigrations','Were customs checks fair, transparent, and conducted with minimal inconvenience?',1,'2',1,'Is35CwT7kE',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(43,1,'staff','Customs and Immigrations','Are immigration and customs facilities sufficient to handle passenger volumes?',2,'2',1,'GCOkpBixri',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(44,1,'staff','Customs and Immigrations','Are there enough personnel at passport control and customs to prevent delays?',2,'2',1,'Ob7JUkHJq2',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(45,1,'staff','Customs and Immigrations','What challenges do you face in processing passengers quickly and efficiently?',2,'3',0,'i5ULCrO4k8',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(46,1,'staff','Customs and Immigrations','Do passengers frequently face confusion over immigration/customs procedures?',2,'2',1,'1NYeHtd6G7',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(47,1,'staff','Customs and Immigrations','Are there any improvements needed in coordination with airlines and border control?',2,'3',0,'iZhB0BhSlX',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(48,1,'staff','Customs and Immigrations','What security or fraud concerns need to be addressed?',2,'3',0,'uBLOEmQRDs',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(49,1,'passenger','Strategic Planning','Was it easy to find transportation options from the airport (taxis, buses, shuttles)?',1,'2',1,'rjtvPBsboW',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(50,1,'passenger','Strategic Planning','How convenient and accessible were airport parking areas?',1,'1',1,'IpfLGqZ8YF',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(51,1,'passenger','Strategic Planning','Was the signage for transportation and parking clear and easy to follow?',1,'2',1,'GBqZxsl17H',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(52,1,'passenger','Strategic Planning','Did you face any difficulties with accessibility (for disabled passengers, heavy luggage, etc.)?',1,'3',0,'1SHERstk31',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(53,1,'passenger','Strategic Planning','Were taxi services, ride-sharing, and public transport reliable and fairly priced?',1,'1',1,'9aRbfKSB3s',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(54,1,'passenger','Strategic Planning','Were there any delays or difficulties in reaching or leaving the airport?',1,'3',0,'V1wfvYHuJz',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(55,1,'staff','Strategic Planning','Are there challenges in managing transportation and passenger flow outside the terminal?',2,'3',0,'rc9QWC0RqY',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(56,1,'staff','Strategic Planning','Are there enough parking spaces and clear traffic control measures?',2,'2',1,'0cTNJwkaV3',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(57,1,'staff','Strategic Planning','What improvements could be made to the airport’s accessibility and mobility options?',2,'3',0,'27nI8Cbj5E',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(58,1,'staff','Strategic Planning','Do you receive frequent passenger complaints about transport services?',2,'2',1,'7aOSdOkb9k',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(59,1,'staff','Strategic Planning','How effective is the coordination with external transport service providers?',2,'1',1,'kN9qQnHk7C',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(60,1,'staff','Strategic Planning','Are there any infrastructure gaps in airport accessibility?',2,'3',0,'cP4cNwHD6L',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(61,1,'passenger','Information Desk','Were customer service counters easily accessible, with helpful and responsive staff?',1,'2',1,'ilcyozwONw',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(62,1,'passenger','Information Desk','How satisfied were you with the handling of lost items, flight inquiries, or special requests?',1,'1',1,'tOopZ6znyq',0,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00',1),(63,1,'passenger','Information Desk','Did the airport provide clear and timely updates on flight delays or changes?',1,'2',1,'VbHaxycZeP',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(64,1,'passenger','Information Desk','Were medical assistance or emergency response teams readily available?',1,'2',1,'KeVTZ084Tz',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(65,1,'passenger','Information Desk','Did you feel safe in case of an emergency (fire, security threat, medical issue)?',1,'2',1,'5c71EBn3MI',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(66,1,'passenger','Information Desk','Were airport announcements and digital screens clear and informative?',1,'1',1,'msGKURfS9w',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(67,1,'staff','Information Desk','Do you receive adequate training in customer service and crisis management?',2,'2',1,'34V3SZZq7w',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(68,1,'staff','Information Desk','Are emergency response plans and procedures clear and well-communicated?',2,'2',1,'wA1PwYC4CH',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(69,1,'staff','Information Desk','Are there enough personnel to handle passenger inquiries and complaints?',2,'2',1,'ZbSQfWFkTf',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(70,1,'staff','Information Desk','What challenges do you face in responding to emergency situations?',2,'3',0,'xqBu7qJOZP',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(71,1,'staff','Information Desk','How can passenger communication and assistance be improved?',2,'3',0,'hFVIeniAII',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(72,1,'staff','Information Desk','Are there any recurring issues in lost-and-found or passenger support?',2,'3',0,'uy0SftWCoS',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(73,1,'passenger','Strategic Planning','Was the flight information (departure times, gate changes) clearly communicated?',1,'2',1,'IXKerquuKf',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(74,1,'passenger','Strategic Planning','Were airline staff and airport personnel helpful in resolving any issues?',1,'2',1,'3QRdPWC9hB',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(75,1,'passenger','Strategic Planning','How smoothly was the overall boarding and flight departure process?',1,'1',1,'IXZiE7lV5S',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(76,1,'passenger','Strategic Planning','Did you experience any flight delays, and were they communicated effectively?',1,'3',0,'5HK40mpEyZ',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(77,1,'passenger','Strategic Planning','Was there a comfortable waiting experience before boarding?',1,'2',1,'hOnR03BagV',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(78,1,'passenger','Strategic Planning','Were there sufficient updates on baggage and flight status after arrival?',1,'2',1,'98v07Amyt6',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(79,1,'staff','Strategic Planning','Is communication between airport and airline staff efficient?',2,'2',1,'dnNxXZon2Q',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(80,1,'staff','Strategic Planning','Are there any bottlenecks in coordinating departures and arrivals?',2,'3',0,'YpXYnQsXoU',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(81,1,'staff','Strategic Planning','Do passengers frequently miss flights due to airport inefficiencies?',2,'2',1,'6f1reYVn5t',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(82,1,'staff','Strategic Planning','Are there sufficient airline counters and personnel for check-ins?',2,'2',1,'hcxNt2GAzU',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(83,1,'staff','Strategic Planning','What are the biggest challenges in handling flight delays?',2,'3',0,'VNFxFwTGuG',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(84,1,'staff','Strategic Planning','How can coordination between airlines and airport operations be improved?',2,'3',0,'4mfksOBMwW',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(85,1,'passenger','General','How would you rate your overall experience at the airport?',1,'1',1,'4W9buOiSZ8',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(86,1,'passenger','General','What were the best aspects of your experience?',1,'3',0,'rJlDqT7y3r',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(87,1,'passenger','General','What areas do you think need improvement?',1,'3',0,'BTRfyUKedF',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(88,1,'passenger','General','Would you recommend this airport to other travelers?',1,'2',1,'JpmRbM4s3z',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(89,1,'passenger','General','Were there any specific incidents or staff members that stood out positively or negatively?',1,'3',0,'InBxS0pXjI',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(90,1,'passenger','General','Do you have any suggestions for making the airport experience better?',1,'3',0,'YhDifpKxZ2',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(91,1,'staff','General','How would you rate your overall working experience at the airport?',2,'1',1,'JEtlHYYoRM',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(92,1,'staff','General','What are the biggest operational challenges you face?',2,'3',0,'FJaEGEhJFF',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(93,1,'staff','General','Do you feel valued and supported as an airport staff member?',2,'2',1,'FfdvEZqVe2',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(94,1,'staff','General','Are there enough staff to handle peak passenger volumes?',2,'2',1,'JRyM2D2AxY',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(95,1,'staff','General','What improvements would make your job easier and more efficient?',2,'3',0,'fZJqTNKsAR',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1),(96,1,'staff','General','Do you have any suggestions for improving airport operations?',2,'3',0,'hyGeEZQ1mT',0,NULL,NULL,'2025-03-09 19:54:01','2025-03-09 19:54:01',1);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `responses`
--

DROP TABLE IF EXISTS `responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `responses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `questionaire_id` bigint unsigned NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responses_questionaire_id_foreign` (`questionaire_id`),
  KEY `responses_question_id_foreign` (`question_id`),
  CONSTRAINT `responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `responses_questionaire_id_foreign` FOREIGN KEY (`questionaire_id`) REFERENCES `questionaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `responses`
--

LOCK TABLES `responses` WRITE;
/*!40000 ALTER TABLE `responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `survey_submissions`
--

DROP TABLE IF EXISTS `survey_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `survey_submissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `survey_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `survey_submissions_survey_id_foreign` (`survey_id`),
  KEY `survey_submissions_user_id_foreign` (`user_id`),
  CONSTRAINT `survey_submissions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  CONSTRAINT `survey_submissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `survey_submissions`
--

LOCK TABLES `survey_submissions` WRITE;
/*!40000 ALTER TABLE `survey_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `survey_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surveys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `surveys_obfuscator_unique` (`obfuscator`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'Default Survey (for both passengers and staff)','active',1,'i8w4KSOaBW',1,'2025-03-09 19:54:00','2025-03-09 19:54:00',NULL);
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titles`
--

DROP TABLE IF EXISTS `titles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `titles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `TitleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Acrynom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titles`
--

LOCK TABLES `titles` WRITE;
/*!40000 ALTER TABLE `titles` DISABLE KEYS */;
INSERT INTO `titles` VALUES (1,'Mr.','2025-03-09 19:54:00','2025-03-09 19:54:00','MR'),(2,'Mrs.','2025-03-09 19:54:00','2025-03-09 19:54:00','MRS'),(3,'Ms.','2025-03-09 19:54:00','2025-03-09 19:54:00','MS'),(4,'Dr.','2025-03-09 19:54:00','2025-03-09 19:54:00','DR');
/*!40000 ALTER TABLE `titles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_functionaries`
--

DROP TABLE IF EXISTS `user_role_functionaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_role_functionaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Function` int NOT NULL,
  `UserRoleID` int NOT NULL,
  `ControllerID` int NOT NULL,
  `Status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_functionaries`
--

LOCK TABLES `user_role_functionaries` WRITE;
/*!40000 ALTER TABLE `user_role_functionaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role_functionaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userroles`
--

DROP TABLE IF EXISTS `userroles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userroles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `RoleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userroles`
--

LOCK TABLES `userroles` WRITE;
/*!40000 ALTER TABLE `userroles` DISABLE KEYS */;
INSERT INTO `userroles` VALUES (1,'User','2025-03-09 19:54:00','2025-03-09 19:54:00'),(2,'Administrator','2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `userroles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SecondName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` int NOT NULL,
  `PhoneNumber` bigint DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserRole` int NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` int NOT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_obfuscator_unique` (`Obfuscator`),
  UNIQUE KEY `users_phonenumber_unique` (`PhoneNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','Sudo','admin',2,NULL,'admin@example.com','2025-03-09 19:54:00','$2y$10$4Z.hP3eq.LYMdBrAaA6qcey11Wckl9AAYOLJDH6RypPfhrxggBfvu',2,'Female','7NIqqkJxfY',1,NULL,NULL,NULL,'2025-03-09 19:54:00','2025-03-09 19:54:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-09 11:56:43
