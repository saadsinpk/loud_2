-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text DEFAULT NULL,
  `password` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `comment`, `parent_id`, `created_at`, `updated_at`) VALUES
(1,	'1',	0,	'test',	0,	'2022-07-07 08:03:46',	'0000-00-00 00:00:00'),
(2,	'1',	0,	NULL,	0,	'2022-07-07 08:03:46',	'0000-00-00 00:00:00'),
(3,	'27',	10,	'test',	0,	'2022-07-14 07:32:55',	'2022-07-14 07:32:55'),
(4,	'27',	10,	'test',	0,	'2022-07-14 07:33:04',	'2022-07-14 07:33:04'),
(5,	'3',	26,	'That podcast was lit yesterday. I wanna attend again.',	3,	'2022-08-06 11:00:17',	'2022-08-06 11:00:17'),
(6,	'3',	26,	'That podcast was lit yesterday. I wanna attend again.',	3,	'2022-08-06 11:22:00',	'2022-08-06 11:22:00'),
(7,	'37',	26,	'hello',	37,	'2022-08-06 11:24:23',	'2022-08-06 11:24:23'),
(8,	'37',	26,	'test',	37,	'2022-08-06 11:27:20',	'2022-08-06 11:27:20'),
(9,	'37',	26,	'hoya',	37,	'2022-08-06 11:27:30',	'2022-08-06 11:27:30'),
(10,	'35',	26,	'hila',	35,	'2022-08-06 11:34:45',	'2022-08-06 11:34:45'),
(11,	'3',	26,	'That podcast was lit yesterday. I wanna attend again.',	3,	'2022-08-07 05:34:25',	'2022-08-07 05:34:25'),
(12,	'3',	26,	'That podcast was lit yesterday. I wanna attend again.',	3,	'2022-08-07 05:34:32',	'2022-08-07 05:34:32'),
(13,	'38',	26,	'hola',	38,	'2022-08-20 13:33:28',	'2022-08-20 13:33:28'),
(14,	'38',	26,	'terren',	38,	'2022-08-20 13:35:48',	'2022-08-20 13:35:48');

DROP TABLE IF EXISTS `comment_report`;
CREATE TABLE `comment_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `access` text DEFAULT NULL,
  `media` text DEFAULT NULL,
  `invite_peoples` text DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `groups` (`id`, `user_id`, `name`, `description`, `access`, `media`, `invite_peoples`, `view_count`, `created_at`, `updated_at`) VALUES
(4,	6,	'Old',	'Desc',	'PRIVATE',	'post-1657723704.jpg',	NULL,	0,	'2022-07-14 08:06:02',	'2022-07-13 14:48:24'),
(5,	10,	'New G2',	'New G Desc',	'PUBLIC',	'post-1657785672.jpg',	NULL,	0,	'2022-07-14 08:01:27',	'2022-07-14 08:01:27'),
(6,	26,	'Test path',	'Test path',	'PUBLIC',	'uploads/postImages/post-514101658911793.jpg',	NULL,	0,	'2022-07-27 08:49:53',	'2022-07-27 08:49:53'),
(7,	26,	'News',	'Nesssss',	'PUBLIC',	'uploads/postImages/post-4187241659725933.png',	NULL,	0,	'2022-08-05 18:58:53',	'2022-08-05 18:58:53');

DROP TABLE IF EXISTS `group_members`;
CREATE TABLE `group_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` text DEFAULT NULL,
  `member_id` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `group_members` (`id`, `group_id`, `member_id`, `created_at`, `updated_at`) VALUES
(1,	'5',	'6',	'2022-08-16 13:40:50',	'2022-08-16 13:40:50'),
(2,	'5',	'10',	'2022-08-16 13:44:58',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `like_comment`;
CREATE TABLE `like_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `like_comment` (`id`, `post_id`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(5,	'29',	10,	'DISLIKE',	'2022-07-14 09:37:13',	'2022-07-14 09:37:13'),
(6,	'29',	6,	'DISLIKE',	'2022-07-14 09:37:20',	'2022-07-14 09:37:20'),
(8,	'29',	17,	'LIKE',	'2022-07-14 11:45:42',	'2022-07-14 11:45:42'),
(100001,	'27',	7,	'DISLIKE',	'2022-07-14 12:28:10',	'2022-07-14 12:28:10'),
(100003,	'36',	26,	'LIKE',	'2022-08-06 11:10:09',	'2022-08-06 11:10:09'),
(100004,	'35',	26,	'LIKE',	'2022-08-06 11:10:54',	'2022-08-06 11:10:54'),
(100005,	'34',	26,	'LIKE',	'2022-08-06 11:11:51',	'2022-08-06 11:11:51'),
(100011,	'37',	26,	'DISLIKE',	'2022-08-06 12:04:25',	'2022-08-06 12:04:25');

DROP TABLE IF EXISTS `live`;
CREATE TABLE `live` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `media` text DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `live` (`id`, `user_id`, `title`, `description`, `media`, `view_count`, `created_at`, `updated_at`) VALUES
(8,	7,	'asdww',	'asdww',	'post-1657724202.jpg',	0,	'2022-07-13 14:56:42',	'2022-07-13 14:56:42'),
(9,	26,	'w',	'w',	'uploads/postImages/post-8975461658912416.jpg',	0,	'2022-07-27 09:00:16',	'2022-07-27 09:00:16');

DROP TABLE IF EXISTS `meeting`;
CREATE TABLE `meeting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ended` text NOT NULL,
  `streamid` text NOT NULL,
  `streamtitle` text NOT NULL,
  `hostimage` text DEFAULT NULL,
  `hostname` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `meeting` (`id`, `ended`, `streamid`, `streamtitle`, `hostimage`, `hostname`, `created_at`, `updated_at`) VALUES
(1,	'1',	'12',	'title',	NULL,	'23',	'2022-08-17 11:58:19',	'2022-08-17 11:58:19'),
(2,	'2',	'123',	'Test',	'uploads/postImages/post-2402521660751971.jpg',	'Host',	'2022-08-17 15:59:31',	'2022-08-17 15:59:31'),
(3,	'1',	'1',	'1',	NULL,	'1',	'2022-08-17 16:40:37',	'2022-08-17 16:40:37');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2022_07_06_085126_create_permission_tables',	2);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1,	'App\\Models\\User',	1),
(1,	'App\\Models\\User',	5),
(3,	'App\\Models\\User',	6),
(3,	'App\\Models\\User',	7),
(3,	'App\\Models\\User',	8),
(3,	'App\\Models\\User',	9),
(3,	'App\\Models\\User',	10),
(3,	'App\\Models\\User',	11),
(3,	'App\\Models\\User',	13),
(3,	'App\\Models\\User',	17),
(3,	'App\\Models\\User',	19),
(3,	'App\\Models\\User',	20),
(3,	'App\\Models\\User',	21),
(3,	'App\\Models\\User',	22),
(3,	'App\\Models\\User',	23),
(3,	'App\\Models\\User',	24),
(3,	'App\\Models\\User',	25),
(3,	'App\\Models\\User',	26),
(3,	'App\\Models\\User',	27),
(3,	'App\\Models\\User',	28),
(3,	'App\\Models\\User',	29),
(3,	'App\\Models\\User',	30),
(3,	'App\\Models\\User',	31);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'edit',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(2,	'delete',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(3,	'publish',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(4,	'unpublish',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1,	'App\\Models\\User',	9,	'PersonalAccessToken',	'6d05d665b5c4940a65d7f4c667abd69a7de49ac67ebc4e65523bd866f2fdf241',	'[\"*\"]',	NULL,	'2022-07-08 09:58:36',	'2022-07-08 09:58:36'),
(2,	'App\\Models\\User',	9,	'PersonalAccessToken',	'272e604f6c214ef738981db9da0885d072a5b524f4ab0f67d53a4c1e400bb0dd',	'[\"*\"]',	NULL,	'2022-07-08 09:59:15',	'2022-07-08 09:59:15'),
(3,	'App\\Models\\User',	9,	'PersonalAccessToken',	'3cacfa6835be1faa226437031aaeae0bff64003910a95a3d751ed453be753149',	'[\"*\"]',	NULL,	'2022-07-08 09:59:25',	'2022-07-08 09:59:25'),
(4,	'App\\Models\\User',	9,	'PersonalAccessToken',	'e59f297c1b445fe48954f2d07e500eea87fddcbd3f3f3edd253667e0539401c4',	'[\"*\"]',	NULL,	'2022-07-08 10:00:03',	'2022-07-08 10:00:03'),
(5,	'App\\Models\\User',	9,	'PersonalAccessToken',	'0803b8f0ad1160c3e179cc01ebedf748c9677f953d1a4c1305f79f0c6d7daa45',	'[\"*\"]',	NULL,	'2022-07-08 10:00:31',	'2022-07-08 10:00:31'),
(6,	'App\\Models\\User',	9,	'PersonalAccessToken',	'9cc3106b418ab47a71a4fb1194dd78f0622b1a31c0c95131002cd4cdebb95f9a',	'[\"*\"]',	NULL,	'2022-07-08 10:00:42',	'2022-07-08 10:00:42'),
(7,	'App\\Models\\User',	9,	'PersonalAccessToken',	'7a62b2da63bfa8bcecc44e7699ca5df76b1e30160cbb41755cce1b54df98aa7b',	'[\"*\"]',	NULL,	'2022-07-08 10:00:56',	'2022-07-08 10:00:56'),
(8,	'App\\Models\\User',	9,	'PersonalAccessToken',	'e8e8fcc540b1eae843f299460f9aa6630c9aaf81e7b312de9006e248151f9d5b',	'[\"*\"]',	NULL,	'2022-07-08 10:01:07',	'2022-07-08 10:01:07'),
(9,	'App\\Models\\User',	9,	'PersonalAccessToken',	'5210aebb2b4a2a3ff10566f21186575860bf9253bb098a1d8d30ac93f4062db9',	'[\"*\"]',	NULL,	'2022-07-08 10:01:20',	'2022-07-08 10:01:20'),
(10,	'App\\Models\\User',	9,	'PersonalAccessToken',	'e0a6b55d5a3eebb7464e08d03d85d9d5e876bb25ab44709d2ecf4cdf041271b4',	'[\"*\"]',	NULL,	'2022-07-08 10:01:31',	'2022-07-08 10:01:31'),
(11,	'App\\Models\\User',	9,	'PersonalAccessToken',	'f3f361751ac1e81feb61438eb7f241da5f3d23377be975c0938b421c860eec3e',	'[\"*\"]',	NULL,	'2022-07-08 10:01:35',	'2022-07-08 10:01:35'),
(12,	'App\\Models\\User',	9,	'PersonalAccessToken',	'e852f64cf084d8e3ce00d4e1bf1d98e55f5314b1bd80f5d470acc26111f9d94f',	'[\"*\"]',	NULL,	'2022-07-08 10:04:39',	'2022-07-08 10:04:39'),
(13,	'App\\Models\\User',	9,	'PersonalAccessToken',	'ad66ec3659bc390050190e348eca65ce6a1bad25735bc6cd1820ad550d2984e8',	'[\"*\"]',	NULL,	'2022-07-08 10:04:54',	'2022-07-08 10:04:54'),
(14,	'App\\Models\\User',	9,	'PersonalAccessToken',	'91d0e2b162ef2966dd4e7aece33cd840b5172a5ae885cd57b207e1d13c30d117',	'[\"*\"]',	NULL,	'2022-07-08 10:05:10',	'2022-07-08 10:05:10'),
(15,	'App\\Models\\User',	10,	'PersonalAccessToken',	'999be21059a07b45894ac13583eca03b09a8401bf678f6936aa57116e8751c57',	'[\"*\"]',	NULL,	'2022-07-13 07:37:31',	'2022-07-13 07:37:31'),
(16,	'App\\Models\\User',	1,	'PersonalAccessToken',	'8899e599ccda2ff0fc7c33fa21281a2cce0bb9ee3ec44c5f474f092b648d40a6',	'[\"*\"]',	NULL,	'2022-07-13 07:37:47',	'2022-07-13 07:37:47'),
(17,	'App\\Models\\User',	1,	'PersonalAccessToken',	'8964da39b17b50ac110b2678c50bf3086cefeb470449b1fc10aeb0d34134eefb',	'[\"*\"]',	NULL,	'2022-07-13 07:37:59',	'2022-07-13 07:37:59'),
(18,	'App\\Models\\User',	1,	'PersonalAccessToken',	'57aa672bc010038ab245da69369c0d05ed3ab45cda98cecb00f3b6042a20e5f9',	'[\"*\"]',	NULL,	'2022-07-13 07:38:29',	'2022-07-13 07:38:29'),
(19,	'App\\Models\\User',	1,	'PersonalAccessToken',	'2d636494d14e47735e2b97fc815ec2b2ef09e9e81617f0aa835314f69c96d722',	'[\"*\"]',	NULL,	'2022-07-13 07:39:53',	'2022-07-13 07:39:53'),
(20,	'App\\Models\\User',	10,	'PersonalAccessToken',	'fd8bf40d6555bd6954710e027d0e7e50994b8c32b0bae5a11830f0e28c3966f8',	'[\"*\"]',	NULL,	'2022-07-13 07:40:02',	'2022-07-13 07:40:02'),
(21,	'App\\Models\\User',	10,	'PersonalAccessToken',	'69be008448648bfda29c0302ada6e7573ffd1b6bd65223391f6273e1c10da956',	'[\"*\"]',	NULL,	'2022-07-13 07:40:48',	'2022-07-13 07:40:48'),
(22,	'App\\Models\\User',	10,	'PersonalAccessToken',	'38c1c279982868a00e20690771c8862551fdc1ead9ccada313d76b505fb670b3',	'[\"*\"]',	NULL,	'2022-07-13 07:41:17',	'2022-07-13 07:41:17');

DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `ends_in` text DEFAULT NULL,
  `is_people_share` text DEFAULT NULL,
  `hide_creator_detail` text DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `polls` (`id`, `user_id`, `question`, `ends_in`, `is_people_share`, `hide_creator_detail`, `view_count`, `created_at`, `updated_at`) VALUES
(13,	7,	'Jami',	NULL,	'1',	NULL,	0,	'2022-07-13 10:25:43',	'2022-07-13 10:25:43'),
(15,	10,	'Hi',	NULL,	'1',	NULL,	0,	'2022-07-13 10:43:36',	'2022-07-13 10:43:36'),
(16,	1,	'test',	NULL,	NULL,	NULL,	0,	'2022-07-14 08:41:54',	'0000-00-00 00:00:00'),
(17,	10,	'1',	'1',	'1',	'1',	0,	'2022-07-14 10:13:15',	'2022-07-14 10:13:15'),
(18,	10,	'1',	'1',	'1',	'1',	0,	'2022-07-14 10:20:18',	'2022-07-14 10:20:18'),
(19,	10,	'1',	'1',	'1',	'1',	0,	'2022-07-14 10:20:40',	'2022-07-14 10:20:40'),
(20,	10,	'1',	'1',	'1',	'1',	9,	'2022-07-20 07:54:42',	'2022-07-20 07:54:42'),
(21,	26,	'What is your favourite meal?',	'1',	'0',	'1',	0,	'2022-08-06 09:51:20',	'2022-08-06 09:51:20'),
(22,	26,	'What is your favourite meal?',	'1',	'0',	'1',	0,	'2022-08-06 09:51:31',	'2022-08-06 09:51:31'),
(23,	26,	'hello',	'24',	'0',	'0',	0,	'2022-08-06 09:52:28',	'2022-08-06 09:52:28'),
(24,	7,	'testt',	'10',	'1',	'1',	0,	'2022-08-15 14:21:25',	'2022-08-15 14:21:25'),
(25,	7,	'testt',	'10',	'1',	'1',	0,	'2022-08-15 14:21:57',	'2022-08-15 14:21:57'),
(26,	7,	'testt',	'10',	'1',	'1',	0,	'2022-08-15 14:22:49',	'2022-08-15 14:22:49'),
(27,	7,	'testt',	'10',	'1',	'1',	0,	'2022-08-15 14:24:21',	'2022-08-15 14:24:21'),
(28,	7,	'testt',	'10',	'1',	'1',	0,	'2022-08-15 14:33:39',	'2022-08-15 14:33:39');

DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `poll_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `poll_options` (`id`, `name`, `poll_id`, `created_at`, `updated_at`) VALUES
(1,	'Testing porcess',	0,	'2022-07-07 09:10:49',	'2022-07-07 09:10:49'),
(2,	'Test is test',	0,	'2022-07-07 09:10:49',	'2022-07-07 09:10:49'),
(3,	'nothing',	0,	'2022-07-07 09:10:49',	'2022-07-07 09:10:49'),
(4,	'poll option 1',	0,	'2022-07-07 09:13:39',	'2022-07-07 09:13:39'),
(5,	'poll option 2',	0,	'2022-07-07 09:13:39',	'2022-07-07 09:13:39'),
(8,	'list opt 1',	6,	'2022-07-07 10:16:22',	'2022-07-07 10:16:22'),
(9,	'List opt 2',	6,	'2022-07-07 10:16:22',	'2022-07-07 10:16:22'),
(12,	'55hello',	8,	'2022-07-08 06:21:14',	'2022-07-08 06:21:14'),
(13,	NULL,	11,	'2022-07-08 11:54:16',	'2022-07-08 11:54:16'),
(15,	'9898',	12,	'2022-07-13 07:53:48',	'2022-07-13 07:53:48'),
(17,	'99',	13,	'2022-07-13 10:25:43',	'2022-07-13 10:25:43'),
(21,	NULL,	15,	'2022-07-13 10:43:36',	'2022-07-13 10:43:36'),
(22,	'Pizza',	20,	'2022-07-14 10:22:25',	'2022-07-14 10:22:25'),
(23,	'Roast Goat',	20,	'2022-07-14 10:22:25',	'2022-07-14 10:22:25'),
(24,	'Pizza',	21,	'2022-08-06 09:51:20',	'2022-08-06 09:51:20'),
(25,	'Roast Goat',	21,	'2022-08-06 09:51:20',	'2022-08-06 09:51:20'),
(26,	'Meat Pie',	21,	'2022-08-06 09:51:20',	'2022-08-06 09:51:20'),
(27,	'Pizza',	22,	'2022-08-06 09:51:31',	'2022-08-06 09:51:31'),
(28,	'Roast Goat',	22,	'2022-08-06 09:51:31',	'2022-08-06 09:51:31'),
(29,	'Meat Pie',	22,	'2022-08-06 09:51:31',	'2022-08-06 09:51:31'),
(30,	'tedt',	23,	'2022-08-06 09:52:28',	'2022-08-06 09:52:28'),
(31,	'hello',	23,	'2022-08-06 09:52:28',	'2022-08-06 09:52:28'),
(32,	'option 1',	26,	'2022-08-15 14:22:49',	'2022-08-15 14:22:49'),
(33,	'option 2',	26,	'2022-08-15 14:22:49',	'2022-08-15 14:22:49');

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `media` text DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `posts` (`id`, `user_id`, `group_id`, `title`, `description`, `media`, `view_count`, `created_at`, `updated_at`) VALUES
(25,	10,	4,	'Image And User',	'Tilte',	'post-1657720652.jpg',	0,	'2022-07-14 08:23:14',	'2022-07-13 13:57:42'),
(26,	10,	4,	'Test',	'Image and user',	'post-1657721293.png',	0,	'2022-07-14 11:54:27',	'2022-07-13 14:08:13'),
(27,	6,	4,	'44',	'44',	'post-1657722911.jpg',	0,	'2022-07-14 08:23:09',	'2022-07-13 14:35:11'),
(28,	10,	4,	'Saad1230@sadsad',	'test',	'123',	0,	'2022-07-14 08:23:06',	'2022-07-14 07:21:50'),
(29,	9,	4,	'With Group22',	'With Group22',	'post-1657787018.jpg',	0,	'2022-07-14 08:23:57',	'2022-07-14 08:23:57'),
(30,	11,	5,	'asd',	'ads',	'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',	1,	'2022-07-26 10:03:03',	'2022-07-26 10:03:03'),
(31,	10,	5,	'test',	'test description',	'testttt.png',	0,	'2022-07-27 09:16:58',	'2022-07-26 10:04:45'),
(32,	26,	4,	'w',	'w',	'uploads/postImages/post-260311658912441.png',	0,	'2022-07-27 09:18:51',	'2022-07-27 09:00:41'),
(33,	26,	3,	'test iOS last uploada',	'This is my test loud9ja test file upload',	'',	0,	'2022-08-05 20:12:04',	'2022-08-05 20:12:04'),
(34,	26,	4,	'test iOS last uploada',	'This is my test loud9ja test file upload',	'',	0,	'2022-08-05 20:13:07',	'2022-08-05 20:13:07'),
(35,	26,	4,	'Testing',	'test',	'uploads/postImages/post-4793101659780026.png',	0,	'2022-08-06 10:00:26',	'2022-08-06 10:00:26'),
(36,	26,	4,	'News',	'Test 101',	'uploads/postImages/post-2395641659782298.png',	0,	'2022-08-06 10:38:18',	'2022-08-06 10:38:18'),
(37,	26,	7,	'News',	'Hello',	'uploads/postImages/post-5326881659782400.png',	0,	'2022-08-06 10:40:00',	'2022-08-06 10:40:00'),
(38,	26,	5,	'New G2',	'Hola',	'uploads/postImages/post-7451751661002368.png',	0,	'2022-08-20 13:32:48',	'2022-08-20 13:32:48');

DROP TABLE IF EXISTS `report`;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` text DEFAULT NULL,
  `lga` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `is_anonymous` text DEFAULT NULL,
  `media` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `report` (`id`, `state`, `lga`, `user_id`, `category`, `title`, `is_anonymous`, `media`, `message`, `view_count`, `created_at`, `updated_at`) VALUES
(3,	NULL,	NULL,	6,	'New Category',	'New Title',	'Yes',	'post-1657722223.jpg',	NULL,	0,	'2022-07-13 14:23:43',	'2022-07-13 14:23:43'),
(9,	'NA',	'LGA',	26,	'MEDICAL',	'Blood Needed',	NULL,	'',	NULL,	0,	'2022-07-31 10:38:36',	'2022-07-31 10:38:36'),
(10,	'NA',	'LGA',	26,	'MEDICAL',	'Blood Needed',	NULL,	'uploads/postImages/post-7131401659263996.png',	'Blood is going to help people',	0,	'2022-07-31 10:39:56',	'2022-07-31 10:39:56'),
(11,	'Rivers',	'Ahoada East',	26,	'Public',	'test',	NULL,	'uploads/postImages/post-7325321659266208.png',	'yytfdd',	0,	'2022-07-31 11:16:48',	'2022-07-31 11:16:48'),
(12,	'Adamawa',	'Ganye',	26,	'Public',	'Need ambulance',	NULL,	'uploads/postImages/post-7585221659266766.png',	'An ambulance needed. Their is an accident',	0,	'2022-07-31 11:26:06',	'2022-07-31 11:26:06'),
(13,	'Adamawa',	'Demsa',	26,	'Public',	'test',	NULL,	'uploads/postImages/post-8204311659675619.png',	'ttttt',	0,	'2022-08-05 05:00:19',	'2022-08-05 05:00:19'),
(14,	'Akwa Ibom',	'Eastern Obolo',	26,	'Public',	'test',	NULL,	'uploads/postImages/post-9303961659785917.png',	'test',	0,	'2022-08-06 11:38:37',	'2022-08-06 11:38:37');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'superAdmin',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(2,	'admin',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(3,	'user',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1,	1),
(2,	1),
(3,	1),
(4,	1);

DROP TABLE IF EXISTS `tc_oauth_access_tokens`;
CREATE TABLE `tc_oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tc_oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tc_oauth_auth_codes`;
CREATE TABLE `tc_oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tc_oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tc_oauth_clients`;
CREATE TABLE `tc_oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tc_oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tc_oauth_personal_access_clients`;
CREATE TABLE `tc_oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `tc_oauth_refresh_tokens`;
CREATE TABLE `tc_oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tc_oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `gender`, `platform`, `age`, `profile_picture`, `country`, `city`, `state`, `lga`, `otp`, `otp_sent_on`, `verify_token`, `verify`, `provider`, `provider_id`, `firebase_token`, `created_at`, `updated_at`) VALUES
(1,	'Super',	'admin@mail.com',	'2022-07-06 08:57:15',	'$2a$12$rIXYcvv0wSSk5QOcXQb9Z.QtjY6TGp49yKWGaCzNSHu9C2I5Uq8qa',	'8l4dPHPOio1yPRTSop88rlkqPP3uPmVD0SkbeuAybfm8bxlMqQ0dqyhMjmZ0',	'',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	'',	'',	'',	'',	NULL,	NULL,	NULL,	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(5,	'mail name',	'mailname@mail.com',	NULL,	'$2y$10$XiRI6AyQl1MnS./YSx5./uF9TL1L6iT3Zxg3hNPq9T1.7NS5MGrf6',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-06 10:56:05',	'2022-07-06 10:56:05'),
(6,	'New User',	'new_user@mail.com',	NULL,	'$2y$10$huliER4Lb8kQCdqhqVIK/eblbG6rjlCHh5F3ioUWLNo8M8Ox09Qx6',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-06 11:17:46',	'2022-07-06 11:17:46'),
(7,	'Name goes here',	'mail@mail.com',	NULL,	'$2a$12$rIXYcvv0wSSk5QOcXQb9Z.QtjY6TGp49yKWGaCzNSHu9C2I5Uq8qa',	NULL,	'male',	'newew use aa asd',	'30',	'Test',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-06 11:24:02',	'2022-08-10 06:11:28'),
(8,	'Muhammad Saad',	'saad@mail.com',	NULL,	'$2y$10$g7GB0lWomTg1zhZFfsaGjOndMqsGXF9.bO9Y7X7aqryvpHfOEaawi',	NULL,	'male',	'LOUD',	'20',	'/home/master/old/Pictures/nyumba.jpg',	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-07 08:20:48',	'2022-07-07 08:20:48'),
(9,	'Muhammad Saad',	'saad@sidtechno.com',	NULL,	'$2y$10$W094GGfEr58m6kTeP1zxF.B8eSDFhynBlNkTPr0t/k6ox8.cldjca',	NULL,	'male',	'Muhammad Saad',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-08 09:52:20',	'2022-07-08 09:53:23'),
(10,	'Muhammad',	'saad@mail2.com',	NULL,	'$2y$10$qEoSJ4A.Sd4QX3Aq0ddwCuflLfK5RW07q7s4GUNyfhfpmxSxiaeBq',	NULL,	'male',	'Muhammad',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-08 09:57:25',	'2022-07-13 07:37:07'),
(11,	'Muhamamd Saad...',	'mail1test@mail.com',	NULL,	'$2y$10$5KnuyobTr9vd9nJYbm/Jc.fcImAhYJQ81wipfnPsvy/Lu97AjaS6O',	NULL,	'male',	'test',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-14 10:51:43',	'2022-07-14 10:51:43'),
(17,	'Muhamamd Saad...',	'saad_sinpk@yahoo.com',	NULL,	'$2y$10$YirOATA9wtwbsWUKMtQxZe7tep9tUoBr8jprlvhIkDtIhDf.HNA6i',	NULL,	'male',	'test',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-14 11:12:50',	'2022-07-14 11:12:50'),
(18,	'Muhmamd',	'mail@mail2.com',	NULL,	'$2y$10$EJqsniN5t/vNo0KhjaEdzePjGQJsFrRKib.RVrRrkLf78017UMyC2',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:27:48',	'2022-07-18 13:27:48'),
(19,	'Muhmamd',	'mail@mail4.com',	NULL,	'$2y$10$KkdPQxA6xkqZ33/tlujb0OfqgGnZL39PYarJxIoEvYmsDfWfV3If2',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:34:09',	'2022-07-18 13:34:09'),
(20,	'Muhmamd',	'mail@mail5.com',	NULL,	'$2y$10$uOFzI3x6lZmQ3wzUHq9gHObnJ7r5EZ7EJjjhyOg7.AdWFB1b2ADTC',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:42:21',	'2022-07-18 13:42:21'),
(21,	'Muhmamd',	'mail@mail6.com',	NULL,	'$2y$10$phPIDmgq6vKTUU3n1vtw.e2U/eYZ4mClfG1FvbF9HaFJKFcjsABTK',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:48:00',	'2022-07-18 13:48:00'),
(22,	'Muhmamd',	'mail@mail7.com',	NULL,	'$2y$10$VXyk9bxKQ.l6KjWnK0i54./pLwdEi9Flqcu.cTdwh.hBSCOFHyxgu',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:48:54',	'2022-07-18 13:48:54'),
(23,	'Muhmamd',	'mail@mail8.com',	NULL,	'$2y$10$9tAwt98Yas7JA/mW8bCn8.Jo3O5Bbo4BLyTCbL0jZwDqFBKOsTL.S',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:49:41',	'2022-07-18 13:49:41'),
(24,	'Muhmamd',	'mail@mail9.com',	NULL,	'$2y$10$ayGcbCOt/k2lbD6jYI7r2e9Hgz8eVN8/TNl3ASSz1iJAjTEpVKeWu',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:50:42',	'2022-07-18 13:50:42'),
(25,	'Muhmamd',	'mail@mail10.com',	NULL,	'$2y$10$YfZVxQTAB0w0mXRvDHqIn.Kp65HqRIpfHnsV8wxuNa7LBGsx51PF6',	NULL,	'male',	'ps',	'20',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'facebook',	'1234',	NULL,	'2022-07-18 13:57:03',	'2022-07-18 13:57:03'),
(26,	'Ann Akude',	'akudrre@gmail.com',	NULL,	'$2y$10$RsYJ9y84sJTruga5LQGEMeBJQ8DeexNRxcz7c9tYep7M/NqjzFmoW',	NULL,	'FEMALE',	'LOUD',	'25',	NULL,	NULL,	NULL,	NULL,	'null',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'123',	'2022-07-21 18:07:33',	'2022-08-20 13:26:31'),
(27,	'Codepro',	'paulodhiambo962@gmail.com',	NULL,	'$2y$10$z/6wNooGDjMxDdGMeeStdOFFXlUmrkaKNxmFqGntPxSzWMlX.dOj.',	NULL,	'MALE',	'LOUD',	'21',	NULL,	NULL,	NULL,	NULL,	'null',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-20 15:16:48',	'2022-08-20 15:17:30'),
(28,	'Jackson',	'jackson@gmail.com',	NULL,	'jackson@123',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-22 08:55:35',	'2022-08-22 09:40:37'),
(29,	'Kristen Hampton',	'kristenhampton.81372@gmail.com',	NULL,	'$2y$10$m6i3aSpy9585s33QP6d72.IMAC4yBytqbcG/DUD4sEYhRgLIlX29i',	NULL,	'MALE',	'LOUD',	'21',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-25 14:00:38',	'2022-08-25 14:00:38'),
(30,	'Kirti Chavda',	'kirti301290@gmail.com',	NULL,	'$2y$10$RX//GsRDe3ssqjlztrd6ceIukBmQXXNQW7ySDnsOkSInwj0aHIPB2',	NULL,	'MALE',	'LOUD',	'21',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-25 17:17:43',	'2022-08-25 17:17:43'),
(31,	'Muhammad Saad',	'saad.sid0@gmail.com',	NULL,	'$2y$10$Rvb3N/mUONr7nwmuuKUlluDxnCH8LDgjJQg0c1wz5STthCqkYBshy',	NULL,	'MALE',	'LOUD',	'21',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-29 04:57:08',	'2022-08-29 04:57:08');

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `poll_id` text DEFAULT NULL,
  `poll_option_id` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `vote` (`id`, `user_id`, `poll_id`, `poll_option_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'13',	'17',	'2022-07-14 08:35:42',	'0000-00-00 00:00:00'),
(2,	8,	'13',	'17',	'2022-07-14 08:35:44',	'0000-00-00 00:00:00'),
(3,	10,	'20',	'22',	'2022-07-14 10:31:13',	'2022-07-14 10:31:13');

-- 2022-08-30 09:10:48
