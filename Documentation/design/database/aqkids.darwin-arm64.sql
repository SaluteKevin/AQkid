-- MySQL dump 10.13  Distrib 8.1.0, for macos13.3 (arm64)
--
-- Host: localhost    Database: aqkid
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint unsigned NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quota` int NOT NULL,
  `capacity` int NOT NULL,
  `min_age` int NOT NULL DEFAULT '0',
  `max_age` int NOT NULL,
  `duration` int NOT NULL DEFAULT '60',
  `opens_on` datetime NOT NULL,
  `opens_until` datetime NOT NULL,
  `starts_on` datetime NOT NULL,
  `status` enum('PENDING','OPEN','FULL','ACTIVE','ENDED','CANCELLED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `courses_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,2,'Tue 10am','A Tuesday course at 10:00',10,4,0,6,60,'2022-12-05 08:00:00','2023-01-03 10:00:00','2023-01-03 10:00:00','CANCELLED',7500.00,'2022-12-05 08:00:00','2023-01-03 10:00:00'),(2,2,'Wed 10am','A Wednesday course at 10:00',10,4,6,12,60,'2022-12-05 08:05:00','2023-01-04 10:00:00','2023-01-04 10:00:00','ENDED',7500.00,'2022-12-05 08:05:00','2023-03-08 11:00:00'),(3,3,'Fri 12pm','A Friday course at 12:00',10,4,12,24,60,'2023-10-27 12:00:00','2023-11-17 12:00:00','2023-12-01 12:00:00','OPEN',7500.00,'2023-10-20 12:00:00','2023-10-20 12:00:00'),(4,4,'Thu 12pm','A Thursday course at 12:00',10,4,12,24,60,'2023-10-19 12:00:00','2023-10-26 12:00:00','2023-11-30 12:00:00','FULL',7500.00,'2023-10-12 12:00:00','2023-10-12 12:00:00'),(5,2,'Tue 12pm','A Tuesday course at 12:00',10,4,12,24,60,'2023-10-17 12:00:00','2023-10-24 12:00:00','2023-10-24 12:00:00','ACTIVE',7500.00,'2023-10-10 12:00:00','2023-10-10 12:00:00');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollments`
--

DROP TABLE IF EXISTS `enrollments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `proof_of_payment_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('PENDING','SUCCESS','FAILED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enrollments_course_id_foreign` (`course_id`),
  KEY `enrollments_student_id_foreign` (`student_id`),
  CONSTRAINT `enrollments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `enrollments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollments`
--

LOCK TABLES `enrollments` WRITE;
/*!40000 ALTER TABLE `enrollments` DISABLE KEYS */;
INSERT INTO `enrollments` VALUES (1,2,7,'users/7/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2022-12-07 09:10:00','2022-12-08 09:00:00'),(2,2,8,'users/8/payments/hashed-slip-file-name.jpg','FAILED','Fake transaction slip','2022-12-07 08:10:00','2022-12-08 09:00:00'),(3,2,9,'users/9/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2022-12-07 10:05:00','2022-12-08 09:02:00'),(4,3,7,'users/7/payments/hashed-slip-file-name.jpg','PENDING',NULL,'2022-12-07 11:10:00','2022-12-08 09:00:00'),(5,3,9,'users/9/payments/hashed-slip-file-name.jpg','PENDING',NULL,'2022-12-07 11:10:00','2022-12-08 09:00:00'),(6,4,10,'users/10/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-19 12:00:00','2023-10-20 12:00:00'),(7,4,11,'users/11/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-19 12:00:00','2023-10-20 12:00:00'),(8,4,12,'users/12/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-19 12:00:00','2023-10-20 12:00:00'),(9,4,13,'users/13/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-19 12:00:00','2023-10-20 12:00:00'),(10,5,14,'users/14/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-17 12:00:00','2023-10-18 12:00:00'),(11,5,15,'users/15/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-17 12:00:00','2023-10-18 12:00:00'),(12,5,16,'users/16/payments/hashed-slip-file-name.jpg','SUCCESS',NULL,'2023-10-17 12:00:00','2023-10-18 12:00:00');
/*!40000 ALTER TABLE `enrollments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2023_09_11_143953_create_jobs_table',1),(5,'2023_09_11_144305_create_user_notis_table',1),(6,'2023_09_11_145138_create_password_reset_tokens_table',1),(7,'2023_10_10_151734_create_courses_table',1),(8,'2023_10_10_152140_create_enrollments_table',1),(9,'2023_10_10_152308_create_receipts_table',1),(10,'2023_10_10_152441_create_timeslots_table',1),(11,'2023_10_10_190346_create_teacher_attendances_table',1),(12,'2023_10_10_191033_create_student_attendances_table',1),(13,'2023_10_24_202311_create_user_requests_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `receipts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `enrollment_id` bigint unsigned NOT NULL,
  `payment_timestamp` timestamp NOT NULL,
  `receipt_timestamp` timestamp NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `subtotal` double(8,2) NOT NULL,
  `total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_enrollment_id_foreign` (`enrollment_id`),
  CONSTRAINT `receipts_enrollment_id_foreign` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts`
--

LOCK TABLES `receipts` WRITE;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
INSERT INTO `receipts` VALUES (1,1,'2022-12-07 09:10:00','2022-12-08 09:00:00','Course fee',7500.00,7500.00,7500.00,'2022-12-08 09:00:00','2022-12-08 09:00:00'),(2,3,'2022-12-07 10:05:00','2022-12-08 09:02:00','Course fee',7500.00,7500.00,7500.00,'2022-12-08 09:02:00','2022-12-08 09:02:00'),(3,6,'2023-10-19 12:00:00','2023-10-20 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-20 12:00:00','2023-10-20 12:00:00'),(4,7,'2023-10-19 12:00:00','2023-10-20 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-20 12:00:00','2023-10-20 12:00:00'),(5,8,'2023-10-19 12:00:00','2023-10-20 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-20 12:00:00','2023-10-20 12:00:00'),(6,9,'2023-10-19 12:00:00','2023-10-20 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-20 12:00:00','2023-10-20 12:00:00'),(7,10,'2023-10-17 12:00:00','2023-10-18 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-18 12:00:00','2023-10-18 12:00:00'),(8,11,'2023-10-17 12:00:00','2023-10-18 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-18 12:00:00','2023-10-18 12:00:00'),(9,12,'2023-10-17 12:00:00','2023-10-18 12:00:00','Course fee',7500.00,7500.00,7500.00,'2023-10-18 12:00:00','2023-10-18 12:00:00');
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_attendances`
--

DROP TABLE IF EXISTS `student_attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_attendances` (
  `timeslot_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  `has_attended` enum('TRUE','FALSE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FALSE',
  KEY `student_attendances_timeslot_id_foreign` (`timeslot_id`),
  KEY `student_attendances_student_id_foreign` (`student_id`),
  CONSTRAINT `student_attendances_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  CONSTRAINT `student_attendances_timeslot_id_foreign` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_attendances`
--

LOCK TABLES `student_attendances` WRITE;
/*!40000 ALTER TABLE `student_attendances` DISABLE KEYS */;
INSERT INTO `student_attendances` VALUES (1,7,'TRUE'),(1,9,'TRUE'),(2,7,'TRUE'),(2,9,'TRUE'),(3,7,'TRUE'),(3,9,'TRUE'),(4,7,'TRUE'),(4,9,'TRUE'),(5,7,'TRUE'),(5,9,'TRUE'),(6,7,'TRUE'),(6,9,'TRUE'),(7,7,'TRUE'),(7,9,'TRUE'),(8,7,'TRUE'),(8,9,'TRUE'),(9,7,'TRUE'),(9,9,'TRUE'),(10,7,'FALSE'),(10,9,'TRUE'),(11,7,'TRUE'),(22,10,'TRUE'),(22,11,'TRUE'),(22,12,'TRUE'),(22,13,'TRUE'),(23,10,'TRUE'),(23,11,'TRUE'),(23,12,'TRUE'),(23,13,'TRUE'),(24,10,'TRUE'),(24,11,'TRUE'),(24,12,'TRUE'),(24,13,'TRUE'),(25,10,'TRUE'),(25,11,'TRUE'),(25,12,'TRUE'),(25,13,'TRUE'),(26,10,'TRUE'),(26,11,'TRUE'),(26,12,'TRUE'),(26,13,'TRUE'),(27,10,'TRUE'),(27,11,'TRUE'),(27,12,'TRUE'),(27,13,'TRUE'),(28,10,'TRUE'),(28,11,'TRUE'),(28,12,'TRUE'),(28,13,'TRUE'),(29,10,'TRUE'),(29,11,'TRUE'),(29,12,'TRUE'),(29,13,'TRUE'),(30,10,'TRUE'),(30,11,'TRUE'),(30,12,'TRUE'),(30,13,'TRUE'),(31,10,'TRUE'),(31,11,'TRUE'),(31,12,'TRUE'),(31,13,'TRUE'),(32,14,'TRUE'),(32,15,'TRUE'),(32,16,'TRUE'),(33,14,'TRUE'),(33,15,'TRUE'),(33,16,'TRUE'),(34,14,'TRUE'),(34,15,'TRUE'),(34,16,'TRUE'),(35,14,'TRUE'),(35,15,'TRUE'),(35,16,'TRUE'),(36,14,'TRUE'),(36,15,'TRUE'),(36,16,'TRUE'),(37,14,'TRUE'),(37,15,'TRUE'),(37,16,'TRUE'),(38,14,'TRUE'),(38,15,'TRUE'),(38,16,'TRUE'),(39,14,'TRUE'),(39,15,'TRUE'),(39,16,'TRUE'),(40,14,'TRUE'),(40,15,'TRUE'),(40,16,'TRUE'),(41,14,'TRUE'),(41,15,'TRUE'),(41,16,'TRUE');
/*!40000 ALTER TABLE `student_attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teacher_attendances`
--

DROP TABLE IF EXISTS `teacher_attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teacher_attendances` (
  `timeslot_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  KEY `teacher_attendances_timeslot_id_foreign` (`timeslot_id`),
  KEY `teacher_attendances_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `teacher_attendances_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  CONSTRAINT `teacher_attendances_timeslot_id_foreign` FOREIGN KEY (`timeslot_id`) REFERENCES `timeslots` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teacher_attendances`
--

LOCK TABLES `teacher_attendances` WRITE;
/*!40000 ALTER TABLE `teacher_attendances` DISABLE KEYS */;
INSERT INTO `teacher_attendances` VALUES (1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,3),(13,3),(14,3),(15,3),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(22,4),(23,4),(24,4),(25,4),(26,4),(27,4),(28,4),(29,4),(30,4),(31,4),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2);
/*!40000 ALTER TABLE `teacher_attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timeslots`
--

DROP TABLE IF EXISTS `timeslots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timeslots` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `datetime` datetime NOT NULL,
  `type` enum('REGULAR','MAKEUP','UNDEFINED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `timeslots_course_id_foreign` (`course_id`),
  CONSTRAINT `timeslots_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timeslots`
--

LOCK TABLES `timeslots` WRITE;
/*!40000 ALTER TABLE `timeslots` DISABLE KEYS */;
INSERT INTO `timeslots` VALUES (1,2,'2023-01-04 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(2,2,'2023-01-11 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(3,2,'2023-01-18 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(4,2,'2023-01-25 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(5,2,'2023-02-01 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(6,2,'2023-02-08 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(7,2,'2023-02-15 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(8,2,'2023-02-22 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(9,2,'2023-03-01 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(10,2,'2023-03-08 10:00:00','REGULAR','2022-12-05 08:05:00','2022-12-05 08:05:00',NULL),(11,2,'2023-03-15 10:00:00','MAKEUP','2023-03-01 10:00:00','2023-03-01 10:00:00',NULL),(12,3,'2023-12-01 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(13,3,'2023-12-08 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(14,3,'2023-12-15 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(15,3,'2023-12-22 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(16,3,'2023-12-29 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(17,3,'2024-01-05 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(18,3,'2024-01-12 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(19,3,'2024-01-19 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(20,3,'2024-01-26 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(21,3,'2024-02-02 12:00:00','REGULAR','2023-10-20 12:00:00','2023-10-20 12:00:00',NULL),(22,4,'2023-11-30 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(23,4,'2023-12-07 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(24,4,'2023-12-14 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(25,4,'2023-12-21 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(26,4,'2023-12-28 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(27,4,'2024-01-04 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(28,4,'2024-01-11 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(29,4,'2024-01-18 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(30,4,'2024-01-25 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(31,4,'2024-02-01 12:00:00','REGULAR','2023-10-12 12:00:00','2023-10-12 12:00:00',NULL),(32,5,'2023-10-24 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(33,5,'2023-10-31 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(34,5,'2023-11-07 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(35,5,'2023-11-14 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(36,5,'2023-11-21 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(37,5,'2023-11-28 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(38,5,'2023-12-05 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(39,5,'2023-12-12 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(40,5,'2023-12-19 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL),(41,5,'2023-12-26 12:00:00','REGULAR','2023-10-10 12:00:00','2023-10-10 12:00:00',NULL);
/*!40000 ALTER TABLE `timeslots` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notis`
--

DROP TABLE IF EXISTS `user_notis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_notis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('log','noti') COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notis`
--

LOCK TABLES `user_notis` WRITE;
/*!40000 ALTER TABLE `user_notis` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_requests`
--

DROP TABLE IF EXISTS `user_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `originator_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned DEFAULT NULL COMMENT 'This is nullable since this is a generic user request table',
  `type` enum('REFUND','GENERAL') COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PENDING','APPROVED','REJECTED','OTHER') COLLATE utf8mb4_unicode_ci NOT NULL,
  `review_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_requests_originator_id_foreign` (`originator_id`),
  KEY `user_requests_course_id_foreign` (`course_id`),
  CONSTRAINT `user_requests_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `user_requests_originator_id_foreign` FOREIGN KEY (`originator_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_requests`
--

LOCK TABLES `user_requests` WRITE;
/*!40000 ALTER TABLE `user_requests` DISABLE KEYS */;
INSERT INTO `user_requests` VALUES (1,17,2,'REFUND','Request for Refund','Submitted late','PENDING',NULL,'2023-10-29 04:47:49','2023-10-29 04:47:49'),(2,18,2,'REFUND','Request for Refund','Submitted late','APPROVED',NULL,'2023-10-29 04:47:49','2023-10-29 04:47:49'),(3,19,2,'REFUND','Request for Refund','Submitted late','REJECTED','Fake transaction slip','2023-10-29 04:47:49','2023-10-29 04:47:49');
/*!40000 ALTER TABLE `user_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Authentication factor',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('STAFF','TEACHER','STUDENT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `phone_number` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image_path` varchar(260) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Authentication factor',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'_s','$2y$10$/2UmU5OEYTaH9tzgwJ8MR.WEIOAOXYSU2CrLTv89cLYb.g/v53uqi','STAFF','Only',NULL,'Staff','1998-09-22','0988765432','users/1/profile_image.jpg',NULL,NULL,NULL,'2022-11-28 08:00:00','2022-11-28 08:00:00'),(2,'_t1','$2y$10$2s4CBoU4d9xBR0SL0zX8kOFTM7iv0RWclRC79hphDJOb9CKSeY7A2','TEACHER','First',NULL,'Teacher','2000-01-01','0987654321','users/2/profile_image.jpg',NULL,NULL,NULL,'2022-11-29 08:00:00','2022-11-29 08:00:00'),(3,'_t2','$2y$10$aPvx2C1d.vtlVVcUDCAjPuWHStK3bcKP3Ia7wlwPtCMcowU4lPaMa','TEACHER','Second',NULL,'Teacher','2001-01-01','0897654321','users/3/profile_image.jpg',NULL,NULL,NULL,'2022-11-29 09:00:00','2022-11-29 09:00:00'),(4,'_t3','$2y$10$NSBO7j9pIboiBRcTZilnzO2EO/YbkLNZwqonebzUCU3kXZmoCpsHu','TEACHER','Third',NULL,'Teacher','2000-01-01','0987654321','users/4/profile_image.jpg',NULL,NULL,NULL,'2022-11-29 08:00:00','2022-11-29 08:00:00'),(5,'_t4','$2y$10$zF.CCQcSYeVNC/fqmT3eZeewIJLrr44IxAc0SiGJY9mWHcfQujFDe','TEACHER','Fourth',NULL,'Teacher','2001-01-01','0897654321','users/5/profile_image.jpg',NULL,NULL,NULL,'2022-11-29 09:00:00','2022-11-29 09:00:00'),(6,'_t5','$2y$10$tAbh16.YKhPF.z5C.fGmmOdVvJEukHuPgtWO8C.n68dUqj.w4J33G','TEACHER','Fifth',NULL,'Teacher','2001-01-01','0897654321','users/6/profile_image.jpg',NULL,NULL,NULL,'2022-11-29 09:00:00','2022-11-29 09:00:00'),(7,'std1','$2y$10$YczNxRl/PGAw4KnUDtzfl.KrnSpFLig2cEPtu9TIETEUSQUA7UVXK','STUDENT','First',NULL,'Student','2014-05-01','0123456789','users/7/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:00:00','2022-12-07 09:00:00'),(8,'std2','$2y$10$cn.IsxJB/m07GQt3KUgtLOXFJhdT//YwcUMD1eusIx9E.5Y1vYtae','STUDENT','Second',NULL,'Student','2014-08-21','0123457689','users/8/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:40:00','2022-12-07 09:40:00'),(9,'std3','$2y$10$qjcgK6bt6to3fWD5UnSh1e4JZpSDSuQIM4OFfplyP1Z3RPuow1n8e','STUDENT','Third',NULL,'Student','1997-01-16','0123457698','users/9/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(10,'std4','$2y$10$CHzok/ru9o4UmSKQfjNCUe5/VT58JEghMF4hTOy5dKC8KM2njs2p.','STUDENT','Fourth',NULL,'Student','1997-01-16','0123457698','users/10/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(11,'std5','$2y$10$fs3npzz09lNqR7CSa6obcekyklIZDJxFJCuQ/4Byb/Py.2oEgbNMa','STUDENT','Fifth',NULL,'Student','1997-01-16','0123457698','users/11/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(12,'std6','$2y$10$DfkZaf5BbguNWgrLM3uA9.n5RAJXz0bWonl7jsujRgXA6aQ0QbeMy','STUDENT','Sixth',NULL,'Student','1997-01-16','0123457698','users/12/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(13,'std7','$2y$10$l.fYY0bX.ne6ac5Y6SeHrOmm2Q0z8Obkduc00ROWMpH/N5YcXLIA2','STUDENT','Seventh',NULL,'Student','1997-01-16','0123457698','users/13/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(14,'std8','$2y$10$XwTpP.XNehAhlsjieRxXv.SLx.S3.0zj0.QX962KLahpez/V3jvDW','STUDENT','Eighth',NULL,'Student','1997-01-16','0123457698','users/14/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(15,'std9','$2y$10$ZA/PE7xSFHPHFMmaPzO13eSawqb8vL0jL0bseqqtpEhVKY98pOBc2','STUDENT','Ninth',NULL,'Student','1997-01-16','0123457698','users/15/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(16,'std10','$2y$10$E6bvYxxbgmd4aV0o9.3uPObqDeRSEBqhixxlsA7TIgzAEgTT7MbKW','STUDENT','Tenth',NULL,'Student','1997-01-16','0123457698','users/16/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(17,'ef_std1','$2y$10$ohbA1u0/H.P4mtJqPDJuiuSkDO7g7urSZbaMC4FGAH/DDLsufYWtu','STUDENT','First','Fail Enroll','Student','1996-01-16','0123457698','users/17/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(18,'ef_std2','$2y$10$2mxpKR/sB9F58hus.Ucp2uyy5dMbVEf3wFMHWl4eYHs4vUvh6p/rm','STUDENT','Second','Fail Enroll','Student','1996-01-16','0123457698','users/18/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(19,'ef_std3','$2y$10$JxgrexMceGErz5oqkdXJZu0.kvVHkxP7XLywkwo7q5aMtCWj8PxaW','STUDENT','Third','Fail Enroll','Student','1996-01-16','0123457698','users/19/profile_image.jpg',NULL,NULL,NULL,'2022-12-07 09:55:00','2022-12-07 09:55:00'),(20,'Mikali99008','$2y$10$Zm8fu3hlol3ZG7oVSUd.Le4QToPIcozHgUEoDVVULqMyT2rY1ctji','STUDENT','Mikali',NULL,'Hetian','2020-10-17','0878133545','users/20/profile_image.jpg',NULL,NULL,NULL,'2022-10-17 09:55:00','2022-10-17 09:55:00');
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

-- Dump completed on 2023-10-29  4:51:24
