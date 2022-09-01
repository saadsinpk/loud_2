-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2022 at 04:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=active , 0=inactive',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Garden branch', 1, NULL, '2022-08-16 16:58:58', '2022-08-16 16:58:58'),
(2, 'Kharadar Branch', 1, NULL, '2022-08-16 16:59:03', '2022-08-16 16:59:03');

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
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `PM_id` int(11) DEFAULT NULL,
  `lead_asign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_number` bigint(20) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `branch_id`, `PM_id`, `lead_asign`, `serial_number`, `customer_name`, `customer_number`, `notes`, `mp3`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, 115222, 'Ali', '03042285665', 'd45288dd35a351f4f23e0fb0e51d45dc.txt', '4e53ec05c785921afb38282147b91450.mp3', '1', NULL, '2022-08-17 19:15:54', '2022-08-17 19:15:54'),
(3, NULL, NULL, NULL, 352448, 'Ali3', '03042285665', '895d8cc136cccef48bb35ce978cceccf.txt', 'b46ed06efec5092fb86669baa5ac5277.mp3', '1', NULL, '2022-08-17 19:18:06', '2022-08-18 14:38:31'),
(4, 2, 13, '6', NULL, 'asjad', '03042285665', 'd3c2f5347cad6937b9b1f38fac5e46eb.txt', 'b6d39e14c8f8ab2052c5a612cc4e121f.mp3', '1', NULL, '2022-08-18 19:11:18', '2022-08-19 16:10:28'),
(5, 2, 14, '4', NULL, 'shahrukh', '030421556456', 'e50153f271a18381e028846fa4a9db5c.txt', '120244c61e5b8e6d8a8a7003dda8b035.mp3', '1', NULL, '2022-08-18 19:41:41', '2022-08-19 18:13:51'),
(7, 2, 13, '4', NULL, 'Zubair', '4154456465', '235c9ec6c035871e09ae5e2d924ea05b.txt', 'de17b4c19cfcbb596e66907aec6a9f51.mp3', '1', NULL, '2022-08-18 22:43:54', '2022-08-19 16:10:09'),
(8, 2, 13, '5', NULL, 'Sami', '03156456456', 'd5bf82d82840955a5646c8a28ee0de21.txt', '7751768903630dee2e4de8bc9fea48dd.mp3', '1', NULL, '2022-08-18 22:47:37', '2022-08-19 16:10:19'),
(9, 2, 13, '5', NULL, 'Sameer', '031465445545', '04164778bae7f18f8f2547070ca6b53e.txt', '940f5e620c1754d93b7b7bfac99d1700.mp3', '1', NULL, '2022-08-18 22:53:45', '2022-08-19 14:14:48'),
(10, NULL, 14, '4', NULL, 'Ali Jabbar', '63545645645', '663c24bea5c0a57b745a2f6dfc773ea8.txt', 'b78ffd795facf87a11544ae501f5acf6.mp3', '1', NULL, '2022-08-19 19:20:19', '2022-08-19 19:20:19'),
(11, NULL, 14, '4', NULL, 'Sabir', '031564156', 'b2d800a645397731ac112a6d6bc1f356.txt', 'a2e0ebdd602022cc8577e8b80082336c.mp3', '1', NULL, '2022-08-19 20:12:04', '2022-08-19 20:12:04'),
(12, NULL, 13, '6', NULL, 'Ahmed', '15032151321566', '3c628bec89c3c7e232ea4e02fe5880fb.txt', '0c6381a616050428971c0ca5d30a9113.mp3', '1', NULL, '2022-08-19 20:14:42', '2022-08-19 20:14:42');

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
(30, '2014_10_12_000000_create_users_table', 1),
(31, '2014_10_12_100000_create_password_resets_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(34, '2022_08_15_080222_create_permission_tables', 1),
(35, '2022_08_16_071035_create_branches_table', 2),
(37, '2022_08_17_085615_create_leads_table', 3);

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
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(3, 'App\\Models\\User', 12),
(3, 'App\\Models\\User', 13),
(3, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 17),
(4, 'App\\Models\\User', 20),
(4, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 21),
(6, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 15),
(6, 'App\\Models\\User', 18),
(6, 'App\\Models\\User', 22);

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
(1, 'role-list', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(2, 'role-create', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(3, 'role-edit', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(4, 'role-delete', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(5, 'permission-list', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(6, 'permission-create', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(7, 'permission-edit', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36'),
(8, 'permission-delete', 'web', '2022-08-15 20:17:36', '2022-08-15 20:17:36');

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

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `guard_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'CEO', 'head', 'web', NULL, '2022-08-15 20:17:32', '2022-08-15 20:27:05'),
(3, 'P.M', 'office p.m', 'web', NULL, '2022-08-15 20:29:19', '2022-08-15 20:29:19'),
(4, 'Senior Agent', 'agent', 'web', NULL, '2022-08-15 21:28:21', '2022-08-15 21:28:21'),
(5, 'Team lead', 'lead', 'web', NULL, '2022-08-15 21:28:37', '2022-08-15 21:28:37'),
(6, 'Agent', 'agent', 'web', NULL, '2022-08-15 21:28:49', '2022-08-16 21:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `PM_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `PM_id`, `branch_id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'CEO', 'ceo@gmail.com', NULL, '$2y$10$yWxDdFs2mOh1MF7CVkff.OJfagYxGDxCG0pOof/U6Od1uKdLa4mAe', NULL, '2022-08-15 20:17:32', '2022-08-15 20:17:32'),
(13, NULL, 2, 'Ali', 'ali@gmail.com', NULL, '$2y$10$pJrR.e70ljIiqFyT/3uHQ.njE3DTijRkTb6rV2ZiJdUWKfQa0GPgS', NULL, '2022-08-16 20:42:28', '2022-08-16 20:42:28'),
(14, NULL, 1, 'Junaid', 'junaid@gmail.com', NULL, '$2y$10$MlwTAeOIO0Ob0DTvhEzI4uGai5TsmdRXyt65m0ucBcUSFdJ9Hhh02', NULL, '2022-08-16 21:12:17', '2022-08-16 21:12:17'),
(15, NULL, NULL, 'Agent', 'agent@gmail.com', NULL, '$2y$10$yy/V.Ko0SvsBEBNIuPfnHuF7LkyGma0hPZgKbmx7GWodrKXUWFDge', NULL, '2022-08-17 14:19:56', '2022-08-17 14:19:56'),
(16, NULL, NULL, 'Usama', 'usama@gmail.com', NULL, '$2y$10$2ZLbwvJ.EC5uyJAKcPeI2OsuIpPro3ub19PdpCDEhYhs3e7TfpyLi', NULL, '2022-08-17 14:23:49', '2022-08-17 14:23:49'),
(17, NULL, NULL, 'Haseeb', 'haseeb@gmail.com', NULL, '$2y$10$9YOwG0Rewnt4Ky7dd7s0geRRD27UHRDR5dhtb57KJtzY2rReIOLNe', NULL, '2022-08-17 14:24:36', '2022-08-17 14:24:36'),
(18, 13, NULL, 'Asghar', 'asghar@gmail.com', NULL, '$2y$10$Vjb5rEIlPi/yRlXUIPBfN.gj0C2M4/5b1p9diHzX4FZ5euOxRp4Ui', NULL, '2022-08-18 17:21:35', '2022-08-18 23:00:25'),
(19, 13, NULL, 'Naveed', 'naveed@gmail.com', NULL, '$2y$10$7KMcNDfi2gZ8RnCEMopb9uG7HjDy3Ac7n78Dz1oNstBfFNE.iHJl6', NULL, '2022-08-18 17:23:56', '2022-08-18 17:23:56'),
(20, 13, NULL, 'Hussain', 'hussain@gmail.com', NULL, '$2y$10$rqw/FSduYlyXFn2fp/L0JeyCNw037tgG1UBcwLl4GThe4qB72JpLC', NULL, '2022-08-18 17:24:44', '2022-08-18 17:24:44'),
(21, 14, NULL, 'Sameer', 'sameer@gmail.com', NULL, '$2y$10$7lpI3Qqwcis4iJZnO41iCe1n6Ody1XHUSqxnphMKTDSrKrA2jAZ72', NULL, '2022-08-18 17:29:27', '2022-08-19 18:08:11'),
(22, 14, NULL, 'Uzair', 'uzair@gmail.com', NULL, '$2y$10$NCPSpgJUBzDsBG1NGa/ueOKKdjQz/GmV5T0I8OHIiKS8e6LpN2a/i', NULL, '2022-08-19 18:06:54', '2022-08-19 18:06:54'),
(23, 14, NULL, 'Jabbar', 'jabbar@gmail.com', NULL, '$2y$10$9nDYCjAnHrGuaJZbPitcZO3hqxEtx52Co9CoYVX7uh4P.6jjguGOe', NULL, '2022-08-19 18:08:48', '2022-08-19 18:08:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
