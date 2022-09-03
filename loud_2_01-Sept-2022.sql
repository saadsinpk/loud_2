-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2022 at 10:03 AM
-- Server version: 10.4.20-MariaDB-1:10.4.20+maria~buster-log
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `xxjvjrgupw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_06_085126_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 17),
(3, 'App\\Models\\User', 19),
(3, 'App\\Models\\User', 20),
(3, 'App\\Models\\User', 21),
(3, 'App\\Models\\User', 22),
(3, 'App\\Models\\User', 23),
(3, 'App\\Models\\User', 24),
(3, 'App\\Models\\User', 25),
(3, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 28),
(3, 'App\\Models\\User', 29),
(3, 'App\\Models\\User', 30),
(3, 'App\\Models\\User', 31);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'edit', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15'),
(2, 'delete', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15'),
(3, 'publish', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15'),
(4, 'unpublish', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 9, 'PersonalAccessToken', '6d05d665b5c4940a65d7f4c667abd69a7de49ac67ebc4e65523bd866f2fdf241', '[\"*\"]', NULL, '2022-07-08 09:58:36', '2022-07-08 09:58:36'),
(2, 'App\\Models\\User', 9, 'PersonalAccessToken', '272e604f6c214ef738981db9da0885d072a5b524f4ab0f67d53a4c1e400bb0dd', '[\"*\"]', NULL, '2022-07-08 09:59:15', '2022-07-08 09:59:15'),
(3, 'App\\Models\\User', 9, 'PersonalAccessToken', '3cacfa6835be1faa226437031aaeae0bff64003910a95a3d751ed453be753149', '[\"*\"]', NULL, '2022-07-08 09:59:25', '2022-07-08 09:59:25'),
(4, 'App\\Models\\User', 9, 'PersonalAccessToken', 'e59f297c1b445fe48954f2d07e500eea87fddcbd3f3f3edd253667e0539401c4', '[\"*\"]', NULL, '2022-07-08 10:00:03', '2022-07-08 10:00:03'),
(5, 'App\\Models\\User', 9, 'PersonalAccessToken', '0803b8f0ad1160c3e179cc01ebedf748c9677f953d1a4c1305f79f0c6d7daa45', '[\"*\"]', NULL, '2022-07-08 10:00:31', '2022-07-08 10:00:31'),
(6, 'App\\Models\\User', 9, 'PersonalAccessToken', '9cc3106b418ab47a71a4fb1194dd78f0622b1a31c0c95131002cd4cdebb95f9a', '[\"*\"]', NULL, '2022-07-08 10:00:42', '2022-07-08 10:00:42'),
(7, 'App\\Models\\User', 9, 'PersonalAccessToken', '7a62b2da63bfa8bcecc44e7699ca5df76b1e30160cbb41755cce1b54df98aa7b', '[\"*\"]', NULL, '2022-07-08 10:00:56', '2022-07-08 10:00:56'),
(8, 'App\\Models\\User', 9, 'PersonalAccessToken', 'e8e8fcc540b1eae843f299460f9aa6630c9aaf81e7b312de9006e248151f9d5b', '[\"*\"]', NULL, '2022-07-08 10:01:07', '2022-07-08 10:01:07'),
(9, 'App\\Models\\User', 9, 'PersonalAccessToken', '5210aebb2b4a2a3ff10566f21186575860bf9253bb098a1d8d30ac93f4062db9', '[\"*\"]', NULL, '2022-07-08 10:01:20', '2022-07-08 10:01:20'),
(10, 'App\\Models\\User', 9, 'PersonalAccessToken', 'e0a6b55d5a3eebb7464e08d03d85d9d5e876bb25ab44709d2ecf4cdf041271b4', '[\"*\"]', NULL, '2022-07-08 10:01:31', '2022-07-08 10:01:31'),
(11, 'App\\Models\\User', 9, 'PersonalAccessToken', 'f3f361751ac1e81feb61438eb7f241da5f3d23377be975c0938b421c860eec3e', '[\"*\"]', NULL, '2022-07-08 10:01:35', '2022-07-08 10:01:35'),
(12, 'App\\Models\\User', 9, 'PersonalAccessToken', 'e852f64cf084d8e3ce00d4e1bf1d98e55f5314b1bd80f5d470acc26111f9d94f', '[\"*\"]', NULL, '2022-07-08 10:04:39', '2022-07-08 10:04:39'),
(13, 'App\\Models\\User', 9, 'PersonalAccessToken', 'ad66ec3659bc390050190e348eca65ce6a1bad25735bc6cd1820ad550d2984e8', '[\"*\"]', NULL, '2022-07-08 10:04:54', '2022-07-08 10:04:54'),
(14, 'App\\Models\\User', 9, 'PersonalAccessToken', '91d0e2b162ef2966dd4e7aece33cd840b5172a5ae885cd57b207e1d13c30d117', '[\"*\"]', NULL, '2022-07-08 10:05:10', '2022-07-08 10:05:10'),
(15, 'App\\Models\\User', 10, 'PersonalAccessToken', '999be21059a07b45894ac13583eca03b09a8401bf678f6936aa57116e8751c57', '[\"*\"]', NULL, '2022-07-13 07:37:31', '2022-07-13 07:37:31'),
(16, 'App\\Models\\User', 1, 'PersonalAccessToken', '8899e599ccda2ff0fc7c33fa21281a2cce0bb9ee3ec44c5f474f092b648d40a6', '[\"*\"]', NULL, '2022-07-13 07:37:47', '2022-07-13 07:37:47'),
(17, 'App\\Models\\User', 1, 'PersonalAccessToken', '8964da39b17b50ac110b2678c50bf3086cefeb470449b1fc10aeb0d34134eefb', '[\"*\"]', NULL, '2022-07-13 07:37:59', '2022-07-13 07:37:59'),
(18, 'App\\Models\\User', 1, 'PersonalAccessToken', '57aa672bc010038ab245da69369c0d05ed3ab45cda98cecb00f3b6042a20e5f9', '[\"*\"]', NULL, '2022-07-13 07:38:29', '2022-07-13 07:38:29'),
(19, 'App\\Models\\User', 1, 'PersonalAccessToken', '2d636494d14e47735e2b97fc815ec2b2ef09e9e81617f0aa835314f69c96d722', '[\"*\"]', NULL, '2022-07-13 07:39:53', '2022-07-13 07:39:53'),
(20, 'App\\Models\\User', 10, 'PersonalAccessToken', 'fd8bf40d6555bd6954710e027d0e7e50994b8c32b0bae5a11830f0e28c3966f8', '[\"*\"]', NULL, '2022-07-13 07:40:02', '2022-07-13 07:40:02'),
(21, 'App\\Models\\User', 10, 'PersonalAccessToken', '69be008448648bfda29c0302ada6e7573ffd1b6bd65223391f6273e1c10da956', '[\"*\"]', NULL, '2022-07-13 07:40:48', '2022-07-13 07:40:48'),
(22, 'App\\Models\\User', 10, 'PersonalAccessToken', '38c1c279982868a00e20690771c8862551fdc1ead9ccada313d76b505fb670b3', '[\"*\"]', NULL, '2022-07-13 07:41:17', '2022-07-13 07:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'superAdmin', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15'),
(2, 'admin', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15'),
(3, 'user', 'web', '2022-07-06 08:57:15', '2022-07-06 08:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tc_oauth_access_tokens`
--

CREATE TABLE `tc_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_oauth_auth_codes`
--

CREATE TABLE `tc_oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_oauth_clients`
--

CREATE TABLE `tc_oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_oauth_personal_access_clients`
--

CREATE TABLE `tc_oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tc_oauth_refresh_tokens`
--

CREATE TABLE `tc_oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lga` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_sent_on` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `gender`, `platform`, `age`, `profile_picture`, `country`, `city`, `state`, `lga`, `otp`, `otp_sent_on`, `verify_token`, `verify`, `provider`, `provider_id`, `firebase_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'admin@mail.com', '2022-07-06 08:57:15', '$2a$12$rIXYcvv0wSSk5QOcXQb9Z.QtjY6TGp49yKWGaCzNSHu9C2I5Uq8qa', '8l4dPHPOio1yPRTSop88rlkqPP3uPmVD0SkbeuAybfm8bxlMqQ0dqyhMjmZ0', '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', NULL, NULL, NULL, '2022-07-06 08:57:15', '2022-07-06 08:57:15'),
(5, 'mail name', 'mailname@mail.com', NULL, '$2y$10$XiRI6AyQl1MnS./YSx5./uF9TL1L6iT3Zxg3hNPq9T1.7NS5MGrf6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-06 10:56:05', '2022-07-06 10:56:05'),
(6, 'New User', 'new_user@mail.com', NULL, '$2y$10$huliER4Lb8kQCdqhqVIK/eblbG6rjlCHh5F3ioUWLNo8M8Ox09Qx6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-06 11:17:46', '2022-07-06 11:17:46'),
(7, 'Name goes here', 'mail@mail.com', NULL, '$2a$12$rIXYcvv0wSSk5QOcXQb9Z.QtjY6TGp49yKWGaCzNSHu9C2I5Uq8qa', NULL, 'male', 'newew use aa asd', '30', 'Test', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-06 11:24:02', '2022-08-10 06:11:28'),
(8, 'Muhammad Saad', 'saad@mail.com', NULL, '$2y$10$g7GB0lWomTg1zhZFfsaGjOndMqsGXF9.bO9Y7X7aqryvpHfOEaawi', NULL, 'male', 'LOUD', '20', '/home/master/old/Pictures/nyumba.jpg', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-07 08:20:48', '2022-07-07 08:20:48'),
(9, 'Muhammad Saad', 'saad@sidtechno.com', NULL, '$2y$10$W094GGfEr58m6kTeP1zxF.B8eSDFhynBlNkTPr0t/k6ox8.cldjca', NULL, 'male', 'Muhammad Saad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-08 09:52:20', '2022-07-08 09:53:23'),
(10, 'Muhammad', 'saad@mail2.com', NULL, '$2y$10$qEoSJ4A.Sd4QX3Aq0ddwCuflLfK5RW07q7s4GUNyfhfpmxSxiaeBq', NULL, 'male', 'Muhammad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-08 09:57:25', '2022-07-13 07:37:07'),
(11, 'Muhamamd Saad...', 'mail1test@mail.com', NULL, '$2y$10$5KnuyobTr9vd9nJYbm/Jc.fcImAhYJQ81wipfnPsvy/Lu97AjaS6O', NULL, 'male', 'test', '20', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-14 10:51:43', '2022-07-14 10:51:43'),
(17, 'Muhamamd Saad...', 'saad_sinpk@yahoo.com', NULL, '$2y$10$YirOATA9wtwbsWUKMtQxZe7tep9tUoBr8jprlvhIkDtIhDf.HNA6i', NULL, 'male', 'test', '20', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2022-07-14 11:12:50', '2022-07-14 11:12:50'),
(18, 'Muhmamd', 'mail@mail2.com', NULL, '$2y$10$EJqsniN5t/vNo0KhjaEdzePjGQJsFrRKib.RVrRrkLf78017UMyC2', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:27:48', '2022-07-18 13:27:48'),
(19, 'Muhmamd', 'mail@mail4.com', NULL, '$2y$10$KkdPQxA6xkqZ33/tlujb0OfqgGnZL39PYarJxIoEvYmsDfWfV3If2', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:34:09', '2022-07-18 13:34:09'),
(20, 'Muhmamd', 'mail@mail5.com', NULL, '$2y$10$uOFzI3x6lZmQ3wzUHq9gHObnJ7r5EZ7EJjjhyOg7.AdWFB1b2ADTC', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:42:21', '2022-07-18 13:42:21'),
(21, 'Muhmamd', 'mail@mail6.com', NULL, '$2y$10$phPIDmgq6vKTUU3n1vtw.e2U/eYZ4mClfG1FvbF9HaFJKFcjsABTK', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:48:00', '2022-07-18 13:48:00'),
(22, 'Muhmamd', 'mail@mail7.com', NULL, '$2y$10$VXyk9bxKQ.l6KjWnK0i54./pLwdEi9Flqcu.cTdwh.hBSCOFHyxgu', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:48:54', '2022-07-18 13:48:54'),
(23, 'Muhmamd', 'mail@mail8.com', NULL, '$2y$10$9tAwt98Yas7JA/mW8bCn8.Jo3O5Bbo4BLyTCbL0jZwDqFBKOsTL.S', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:49:41', '2022-07-18 13:49:41'),
(24, 'Muhmamd', 'mail@mail9.com', NULL, '$2y$10$ayGcbCOt/k2lbD6jYI7r2e9Hgz8eVN8/TNl3ASSz1iJAjTEpVKeWu', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-18 13:50:42', '2022-07-18 13:50:42'),
(25, 'Muhmamd', 'mail@mail10.com', NULL, '$2y$10$YfZVxQTAB0w0mXRvDHqIn.Kp65HqRIpfHnsV8wxuNa7LBGsx51PF6', NULL, 'male', 'ps', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'facebook', '1234', NULL, '2022-07-18 13:57:03', '2022-07-18 13:57:03'),
(26, 'Ann Akude', 'akudrre@gmail.com', NULL, '$2y$10$RsYJ9y84sJTruga5LQGEMeBJQ8DeexNRxcz7c9tYep7M/NqjzFmoW', NULL, 'FEMALE', 'LOUD', '25', NULL, NULL, NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, '123', '2022-07-21 18:07:33', '2022-08-20 13:26:31'),
(27, 'Codepro', 'paulodhiambo962@gmail.com', NULL, '$2y$10$z/6wNooGDjMxDdGMeeStdOFFXlUmrkaKNxmFqGntPxSzWMlX.dOj.', NULL, 'MALE', 'LOUD', '21', NULL, NULL, NULL, NULL, 'null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-20 15:16:48', '2022-08-20 15:17:30'),
(28, 'Jackson', 'jackson@gmail.com', NULL, 'jackson@123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-22 08:55:35', '2022-08-22 09:40:37'),
(29, 'Kristen Hampton', 'kristenhampton.81372@gmail.com', NULL, '$2y$10$m6i3aSpy9585s33QP6d72.IMAC4yBytqbcG/DUD4sEYhRgLIlX29i', NULL, 'MALE', 'LOUD', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-25 14:00:38', '2022-08-25 14:00:38'),
(30, 'Kirti Chavda', 'kirti301290@gmail.com', NULL, '$2y$10$RX//GsRDe3ssqjlztrd6ceIukBmQXXNQW7ySDnsOkSInwj0aHIPB2', NULL, 'MALE', 'LOUD', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-25 17:17:43', '2022-08-25 17:17:43'),
(31, 'Muhammad Saad', 'saad.sid0@gmail.com', NULL, '$2y$10$Rvb3N/mUONr7nwmuuKUlluDxnCH8LDgjJQg0c1wz5STthCqkYBshy', NULL, 'MALE', 'LOUD', '21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-08-29 04:57:08', '2022-08-29 04:57:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tc_oauth_access_tokens`
--
ALTER TABLE `tc_oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tc_oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `tc_oauth_auth_codes`
--
ALTER TABLE `tc_oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tc_oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `tc_oauth_clients`
--
ALTER TABLE `tc_oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tc_oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `tc_oauth_personal_access_clients`
--
ALTER TABLE `tc_oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_oauth_refresh_tokens`
--
ALTER TABLE `tc_oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tc_oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tc_oauth_clients`
--
ALTER TABLE `tc_oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tc_oauth_personal_access_clients`
--
ALTER TABLE `tc_oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;
