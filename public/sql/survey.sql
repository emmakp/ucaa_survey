-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2024 at 12:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audiences`
--

CREATE TABLE `audiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validity` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audiences`
--

INSERT INTO `audiences` (`id`, `title`, `created_by`, `obfuscator`, `created_at`, `updated_at`, `validity`, `deleted_at`) VALUES
(1, 'Flight Attendants', 1, 'VcPFJVPpuZ', '2024-08-27 18:41:54', '2024-08-27 18:41:54', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `action`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'View List of Audit Trail', 1, '2024-08-27 18:41:38', '2024-08-27 18:41:38'),
(2, 'View List of Audiences', 1, '2024-08-27 18:41:41', '2024-08-27 18:41:41'),
(3, 'Created an audience', 1, '2024-08-27 18:41:54', '2024-08-27 18:41:54'),
(4, 'View List of Audiences', 1, '2024-08-27 18:41:54', '2024-08-27 18:41:54'),
(5, 'View List of Surveys', 1, '2024-08-27 18:41:55', '2024-08-27 18:41:55'),
(6, 'Created a Survey', 1, '2024-08-27 18:42:07', '2024-08-27 18:42:07'),
(7, 'View List of Surveys', 1, '2024-08-27 18:42:08', '2024-08-27 18:42:08'),
(8, 'View List of Surveys', 1, '2024-08-27 18:42:09', '2024-08-27 18:42:09'),
(9, 'Created an questionaire', 1, '2024-08-27 18:42:14', '2024-08-27 18:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

CREATE TABLE `controllers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DepartmentID` int(11) NOT NULL,
  `Gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TitleID` int(11) NOT NULL,
  `PhoneNumber` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_uploads`
--

CREATE TABLE `file_uploads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UID` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `functionary`
--

CREATE TABLE `functionary` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ControllerID` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_16_074913_createuserrolestable', 1),
(5, '2019_11_23_051922_create_titles_table', 1),
(6, '2019_12_20_065546_create_departments_table', 1),
(7, '2019_12_20_065629_create_employees_table', 1),
(8, '2021_11_23_065635_add_acrynom_to_titles_tables', 1),
(9, '2022_02_15_115436_create_audit_trail_table', 1),
(10, '2022_03_16_122125_create_file_uploads_table', 1),
(11, '2022_03_16_141855_create_controllers_table', 1),
(12, '2022_03_16_141959_create_functionary_table', 1),
(13, '2022_03_21_091107_create_user_role_functionaries_table', 1),
(14, '2022_04_05_121445_create_notifications_table', 1),
(15, '2024_07_28_152800_create_create_audiences_tables_table', 1),
(16, '2024_07_28_152810_create_create_surveys_tables_table', 1),
(17, '2024_07_28_152819_create_create_questionaires_tables_table', 1),
(18, '2024_07_28_152829_create_create_question_types_tables_table', 1),
(19, '2024_07_28_152838_create_create_questions_tables_table', 1),
(20, '2024_07_28_152848_create_create_answers_tables_table', 1),
(21, '2024_07_29_232923_add_obfuscator_to_questions_table', 1),
(22, '2024_07_29_233829_create_responses_table', 1),
(23, '2024_07_30_054152_create_options_table', 1),
(24, '2024_07_30_070108_add_validity_to_questions_table', 1),
(25, '2024_08_27_160200_update_answers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questionaires`
--

CREATE TABLE `questionaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `survey_id` bigint(20) UNSIGNED NOT NULL,
  `validity` tinyint(4) NOT NULL,
  `target_audience` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questionaires`
--

INSERT INTO `questionaires` (`id`, `obfuscator`, `survey_id`, `validity`, `target_audience`, `created_at`, `updated_at`) VALUES
(1, 'EgnPWtylEQ', 1, 1, 1, '2024-08-27 18:42:14', '2024-08-27 18:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `questionaire_id` bigint(20) UNSIGNED NOT NULL,
  `question_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) DEFAULT 0,
  `stars` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validity` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `questionaire_id`, `question_type`, `obfuscator`, `required`, `stars`, `max`, `created_at`, `updated_at`, `validity`) VALUES
(1, 'How would you rate the accessibility of the airport for pedestrians and travelers with luggage?', 1, 'number_rating', 'rAlppWb0e2', 1, NULL, 10, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1),
(2, 'Did you find the various check-in options(online. kiosk, counter) convenient?', 1, 'radio_button_experience', 'i9YvYkQn0s', 1, NULL, NULL, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1),
(3, 'How satisfied were you with the accessibility of facilities for passengers with disabilities?', 1, 'emoji_rating', 'OV2qdPGxJO', 1, NULL, NULL, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1),
(4, 'Were there any specific facilities or amenities you felt were lacking or could be improved?', 1, 'yes_no', 'rhEtzbKS2M', 1, NULL, NULL, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1),
(5, 'Please fill in your email so that we can get back to you (Optional)', 1, 'text', '5IsQlnGoWk', 0, NULL, NULL, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1),
(6, 'What is your gender', 1, 'radio_button_gender', 'bO113tmiWL', 1, NULL, NULL, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1),
(7, 'How would you rate the Ugandan Airport?', 1, 'star_rating', '9ef5VJftG9', 1, NULL, NULL, '2024-08-27 19:21:36', '2024-08-27 19:21:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

CREATE TABLE `question_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questionaire_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `title`, `status`, `obfuscator`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Flight Experience', 'pending', '9SsOfD3DWi', 1, '2024-08-27 18:42:07', '2024-08-27 18:42:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `titles`
--

CREATE TABLE `titles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TitleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Acrynom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `titles`
--

INSERT INTO `titles` (`id`, `TitleName`, `created_at`, `updated_at`, `Acrynom`) VALUES
(1, 'Mr.', '2024-08-27 18:41:26', '2024-08-27 18:41:26', 'N/A'),
(2, 'Mrs.', '2024-08-27 18:41:26', '2024-08-27 18:41:26', 'N/A'),
(3, 'Ms.', '2024-08-27 18:41:26', '2024-08-27 18:41:26', 'N/A'),
(4, 'Dr.', '2024-08-27 18:41:26', '2024-08-27 18:41:26', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `id` int(10) UNSIGNED NOT NULL,
  `RoleName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `RoleName`, `created_at`, `updated_at`) VALUES
(1, 'User', '2024-08-27 18:41:26', '2024-08-27 18:41:26'),
(2, 'Administrator', '2024-08-27 18:41:26', '2024-08-27 18:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SecondName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` int(11) NOT NULL,
  `PhoneNumber` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UserRole` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Obfuscator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` int(11) NOT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FirstName`, `SecondName`, `username`, `title`, `PhoneNumber`, `email`, `email_verified_at`, `password`, `UserRole`, `gender`, `Obfuscator`, `validity`, `deleted_at`, `deleted_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Sudo', 'admin', 2, NULL, 'admin@example.com', '2024-08-27 18:41:26', '$2y$10$DWTNHLn5Trbd3bcxjLHJO.I1uUACFovgHT9NOeZzZGKjn0uV3VBhC', 2, 'Female', '1xagt', 1, NULL, NULL, NULL, '2024-08-27 18:41:26', '2024-08-27 18:41:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_functionaries`
--

CREATE TABLE `user_role_functionaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Function` int(11) NOT NULL,
  `UserRoleID` int(11) NOT NULL,
  `ControllerID` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indexes for table `audiences`
--
ALTER TABLE `audiences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `audiences_obfuscator_unique` (`obfuscator`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controllers`
--
ALTER TABLE `controllers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_uploads`
--
ALTER TABLE `file_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `functionary`
--
ALTER TABLE `functionary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `questionaires`
--
ALTER TABLE `questionaires`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `questionaires_obfuscator_unique` (`obfuscator`),
  ADD KEY `questionaires_survey_id_foreign` (`survey_id`),
  ADD KEY `questionaires_target_audience_foreign` (`target_audience`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `questions_obfuscator_unique` (`obfuscator`),
  ADD KEY `questions_questionaire_id_foreign` (`questionaire_id`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `question_types_obfuscator_unique` (`obfuscator`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responses_questionaire_id_foreign` (`questionaire_id`),
  ADD KEY `responses_question_id_foreign` (`question_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surveys_obfuscator_unique` (`obfuscator`);

--
-- Indexes for table `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_obfuscator_unique` (`Obfuscator`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`PhoneNumber`);

--
-- Indexes for table `user_role_functionaries`
--
ALTER TABLE `user_role_functionaries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audiences`
--
ALTER TABLE `audiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `controllers`
--
ALTER TABLE `controllers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_uploads`
--
ALTER TABLE `file_uploads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `functionary`
--
ALTER TABLE `functionary`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questionaires`
--
ALTER TABLE `questionaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `titles`
--
ALTER TABLE `titles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role_functionaries`
--
ALTER TABLE `user_role_functionaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questionaires`
--
ALTER TABLE `questionaires`
  ADD CONSTRAINT `questionaires_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `questionaires_target_audience_foreign` FOREIGN KEY (`target_audience`) REFERENCES `audiences` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_questionaire_id_foreign` FOREIGN KEY (`questionaire_id`) REFERENCES `questionaires` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `responses_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `responses_questionaire_id_foreign` FOREIGN KEY (`questionaire_id`) REFERENCES `questionaires` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
