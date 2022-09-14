-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(3,	'user',	'web',	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(5,	'Test 2',	'web',	'2022-09-06 08:33:23',	'2022-09-06 08:33:23'),
(6,	'New role',	'web',	'2022-09-07 08:50:26',	'2022-09-07 08:50:26'),
(7,	'Ward 1 Role',	'web',	'2022-09-08 14:22:35',	'2022-09-08 14:22:35');

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
(3,	'App\\Models\\User',	32),
(5,	'App\\Models\\User',	30),
(5,	'App\\Models\\User',	31),
(6,	'App\\Models\\User',	33),
(7,	'App\\Models\\User',	34),
(7,	'App\\Models\\User',	35),
(7,	'App\\Models\\User',	36);

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
(198,	'Manage YOWERE/SOSOKI',	'web',	NULL,	NULL),
(199,	'Manage ADIGBONGBO/AWE/ORIMARO',	'web',	NULL,	NULL),
(200,	'Manage ELEBUE/AGBONA/FATA',	'web',	NULL,	NULL),
(201,	'Manage ONIRE/ODEGIWA/ALAPA',	'web',	NULL,	NULL),
(202,	'Manage YOWERE 11/OKEWERU',	'web',	NULL,	NULL),
(203,	'Manage GAMBARI/AIYEKALE',	'web',	NULL,	NULL),
(204,	'Manage EFUE/BERIKODO',	'web',	NULL,	NULL),
(205,	'Manage OWODE/GBOGUN',	'web',	NULL,	NULL),
(206,	'Manage BALLAH/OTTE',	'web',	NULL,	NULL),
(207,	'Manage OGBONDOROKO/REKE',	'web',	NULL,	NULL),
(208,	'Manage AGO-OJA/OSHIN/SAPATI/LADUBA',	'web',	NULL,	NULL),
(209,	'Manage AFON',	'web',	NULL,	NULL),
(210,	'Manage ILA-OJA',	'web',	NULL,	NULL),
(211,	'Manage OGELE',	'web',	NULL,	NULL),
(212,	'Manage BUDO-EGBA',	'web',	NULL,	NULL),
(213,	'Manage OKESHO',	'web',	NULL,	NULL),
(214,	'Manage ODO-ODE/ABOTO',	'web',	NULL,	NULL),
(215,	'Manage BORIYA/SHIYA',	'web',	NULL,	NULL),
(216,	'Manage GURE/GWASORO',	'web',	NULL,	NULL),
(217,	'Manage GWEDEBERERU/BABANE',	'web',	NULL,	NULL),
(218,	'Manage GWANARA',	'web',	NULL,	NULL),
(219,	'Manage ILESHA',	'web',	NULL,	NULL),
(220,	'Manage KENU/TABERU',	'web',	NULL,	NULL),
(221,	'Manage KPAURA/YAKIRU',	'web',	NULL,	NULL),
(222,	'Manage KIYORU/BWEN',	'web',	NULL,	NULL),
(223,	'Manage OKUTA',	'web',	NULL,	NULL),
(224,	'Manage SHINAWU/TUNBUYAN',	'web',	NULL,	NULL),
(225,	'Manage YASHIKIRA',	'web',	NULL,	NULL),
(226,	'Manage LAFIAGI 1',	'web',	NULL,	NULL),
(227,	'Manage LAFIAGI 11',	'web',	NULL,	NULL),
(228,	'Manage LAFIAGI 111',	'web',	NULL,	NULL),
(229,	'Manage LAFIAGI 1V',	'web',	NULL,	NULL),
(230,	'Manage TSARAGI 1',	'web',	NULL,	NULL),
(231,	'Manage TSARAGI 11',	'web',	NULL,	NULL),
(232,	'Manage TSARAGI 111',	'web',	NULL,	NULL),
(233,	'Manage TSONGA 1',	'web',	NULL,	NULL),
(234,	'Manage TSONGA 11',	'web',	NULL,	NULL),
(235,	'Manage TSONGA 111',	'web',	NULL,	NULL),
(236,	'Manage ERUKU',	'web',	NULL,	NULL),
(237,	'Manage ISAPA',	'web',	NULL,	NULL),
(238,	'Manage KORO',	'web',	NULL,	NULL),
(239,	'Manage OBBO-AIYEGGUNLE 1',	'web',	NULL,	NULL),
(240,	'Manage OBBO-AIYEGGUNLE 11',	'web',	NULL,	NULL),
(241,	'Manage OBBO-ILE',	'web',	NULL,	NULL),
(242,	'Manage OSI 1',	'web',	NULL,	NULL),
(243,	'Manage OSI 11',	'web',	NULL,	NULL),
(244,	'Manage OPIN',	'web',	NULL,	NULL),
(245,	'Manage OKE-OPIN/ETAN',	'web',	NULL,	NULL),
(246,	'Manage OKE-ODE 1',	'web',	NULL,	NULL),
(247,	'Manage OKE-ODE 11',	'web',	NULL,	NULL),
(248,	'Manage OKE-ODE 111',	'web',	NULL,	NULL),
(249,	'Manage ORA',	'web',	NULL,	NULL),
(250,	'Manage ILE-IRE',	'web',	NULL,	NULL),
(251,	'Manage AGUNJIN',	'web',	NULL,	NULL),
(252,	'Manage ORO-AGO',	'web',	NULL,	NULL),
(253,	'Manage OMUPO',	'web',	NULL,	NULL),
(254,	'Manage SHARE 1',	'web',	NULL,	NULL),
(255,	'Manage SHARE 11',	'web',	NULL,	NULL),
(256,	'Manage SHARE 111',	'web',	NULL,	NULL),
(257,	'Manage SHARE 1V',	'web',	NULL,	NULL),
(258,	'Manage SHARE V',	'web',	NULL,	NULL),
(259,	'Manage IGBAJA 1',	'web',	NULL,	NULL),
(260,	'Manage IGBAJA 11',	'web',	NULL,	NULL),
(261,	'Manage IGBAJA 111',	'web',	NULL,	NULL),
(262,	'Manage IDOFIAN 1',	'web',	NULL,	NULL),
(263,	'Manage IDOFIAN 11',	'web',	NULL,	NULL),
(264,	'Manage AGBEYANGI/GBADAMU/OSIN',	'web',	NULL,	NULL),
(265,	'Manage GAMBARI 1',	'web',	NULL,	NULL),
(266,	'Manage BALOGUN GAMBARI 11',	'web',	NULL,	NULL),
(267,	'Manage IBAGUN',	'web',	NULL,	NULL),
(268,	'Manage APADO',	'web',	NULL,	NULL),
(269,	'Manage IPONRIN',	'web',	NULL,	NULL),
(270,	'Manage MAGAJI ARE 1',	'web',	NULL,	NULL),
(271,	'Manage MAGAJI ARE 11',	'web',	NULL,	NULL),
(272,	'Manage MARAFA/PEPELE',	'web',	NULL,	NULL),
(273,	'Manage MAYA/ILE-APA',	'web',	NULL,	NULL),
(274,	'Manage OKE OYI/OKE OSE/ALALUBOSA',	'web',	NULL,	NULL),
(275,	'Manage ZANGO',	'web',	NULL,	NULL),
(276,	'Manage AKANBI -1',	'web',	NULL,	NULL),
(277,	'Manage AKANBI -11',	'web',	NULL,	NULL),
(278,	'Manage AKANBI -111',	'web',	NULL,	NULL),
(279,	'Manage AKANBI -1V',	'web',	NULL,	NULL),
(280,	'Manage AKANBI -V',	'web',	NULL,	NULL),
(281,	'Manage BALOGUN-FULANI I',	'web',	NULL,	NULL),
(282,	'Manage BALOGUN-FULANI 11',	'web',	NULL,	NULL),
(283,	'Manage BALOGUN-FULANI 111',	'web',	NULL,	NULL),
(284,	'Manage OKAKA 1',	'web',	NULL,	NULL),
(285,	'Manage OKAKA 11',	'web',	NULL,	NULL),
(286,	'Manage OKE-OGUN',	'web',	NULL,	NULL),
(287,	'Manage ADEWOLE',	'web',	NULL,	NULL),
(288,	'Manage AJIKOBI',	'web',	NULL,	NULL),
(289,	'Manage BABOKO',	'web',	NULL,	NULL),
(290,	'Manage BADARI',	'web',	NULL,	NULL),
(291,	'Manage BALOGUN ALANAMU CENTRAL',	'web',	NULL,	NULL),
(292,	'Manage MAGAJI NGERI',	'web',	NULL,	NULL),
(293,	'Manage OLOJE',	'web',	NULL,	NULL),
(294,	'Manage OGIDI',	'web',	NULL,	NULL),
(295,	'Manage OJUEKUN/ZARUMI',	'web',	NULL,	NULL),
(296,	'Manage OKO-ERIN',	'web',	NULL,	NULL),
(297,	'Manage UBANDAWAKI',	'web',	NULL,	NULL),
(298,	'Manage WARRAH/EGBE JILA/OSHIN',	'web',	NULL,	NULL),
(299,	'Manage AJASE IPO 1',	'web',	NULL,	NULL),
(300,	'Manage AJASE IPO 11',	'web',	NULL,	NULL),
(301,	'Manage ARANDUN',	'web',	NULL,	NULL),
(302,	'Manage ESIE/IJAN',	'web',	NULL,	NULL),
(303,	'Manage IPETU/RORE/ARAN-ORIN',	'web',	NULL,	NULL),
(304,	'Manage OMU-ARAN 1 (ARAN)',	'web',	NULL,	NULL),
(305,	'Manage OMU-ARAN 11 (IHAYE)',	'web',	NULL,	NULL),
(306,	'Manage OMU-ARAN 111 (IFAJA)',	'web',	NULL,	NULL),
(307,	'Manage ORO 1',	'web',	NULL,	NULL),
(308,	'Manage ORO 11',	'web',	NULL,	NULL),
(309,	'Manage OKO',	'web',	NULL,	NULL),
(310,	'Manage ALLA',	'web',	NULL,	NULL),
(311,	'Manage EDIDI',	'web',	NULL,	NULL),
(312,	'Manage ISANLU 1',	'web',	NULL,	NULL),
(313,	'Manage ISANLU 11',	'web',	NULL,	NULL),
(314,	'Manage IJARA',	'web',	NULL,	NULL),
(315,	'Manage IWO',	'web',	NULL,	NULL),
(316,	'Manage OWU ISIN',	'web',	NULL,	NULL),
(317,	'Manage OKE ONIGBIN',	'web',	NULL,	NULL),
(318,	'Manage SABAJA/PAMO',	'web',	NULL,	NULL),
(319,	'Manage OKE ABA',	'web',	NULL,	NULL),
(320,	'Manage OLLA',	'web',	NULL,	NULL),
(321,	'Manage ADENA',	'web',	NULL,	NULL),
(322,	'Manage BANI',	'web',	NULL,	NULL),
(323,	'Manage GWANABE 1',	'web',	NULL,	NULL),
(324,	'Manage GWANABE 11',	'web',	NULL,	NULL),
(325,	'Manage GWARI A (GWARIA)',	'web',	NULL,	NULL),
(326,	'Manage KAIAMA 1',	'web',	NULL,	NULL),
(327,	'Manage KAIAMA 11',	'web',	NULL,	NULL),
(328,	'Manage KAIAMA 111',	'web',	NULL,	NULL),
(329,	'Manage KEMANJI',	'web',	NULL,	NULL),
(330,	'Manage WAJIBE',	'web',	NULL,	NULL),
(331,	'Manage JEBBA',	'web',	NULL,	NULL),
(332,	'Manage BODE-SAADU',	'web',	NULL,	NULL),
(333,	'Manage OKEMI',	'web',	NULL,	NULL),
(334,	'Manage LANWA',	'web',	NULL,	NULL),
(335,	'Manage EJIDONGARI',	'web',	NULL,	NULL),
(336,	'Manage OKUTALA',	'web',	NULL,	NULL),
(337,	'Manage BABADUDU',	'web',	NULL,	NULL),
(338,	'Manage OLORU',	'web',	NULL,	NULL),
(339,	'Manage PAKUNMO',	'web',	NULL,	NULL),
(340,	'Manage WOMI/AYAKI',	'web',	NULL,	NULL),
(341,	'Manage ABATI/ALARA',	'web',	NULL,	NULL),
(342,	'Manage SHAO',	'web',	NULL,	NULL),
(343,	'Manage LOGUN/JEHUNKUNNU',	'web',	NULL,	NULL),
(344,	'Manage MALETE/GBUGUDU',	'web',	NULL,	NULL),
(345,	'Manage AJANAKU',	'web',	NULL,	NULL),
(346,	'Manage MEGIDA',	'web',	NULL,	NULL),
(347,	'Manage AROBADI',	'web',	NULL,	NULL),
(348,	'Manage BALOGUN',	'web',	NULL,	NULL),
(349,	'Manage SHAWO SOUTH WEST',	'web',	NULL,	NULL),
(350,	'Manage SHAWO CENTRAL',	'web',	NULL,	NULL),
(351,	'Manage SHAWO SOUTH EAST',	'web',	NULL,	NULL),
(352,	'Manage ESSA - A',	'web',	NULL,	NULL),
(353,	'Manage ESSA - B',	'web',	NULL,	NULL),
(354,	'Manage ESSA - C',	'web',	NULL,	NULL),
(355,	'Manage OJOMU NORTH/NORTH WEST',	'web',	NULL,	NULL),
(356,	'Manage OJOMU  CENTRAL 1',	'web',	NULL,	NULL),
(357,	'Manage OJOMU  CENTRAL 11',	'web',	NULL,	NULL),
(358,	'Manage OJOMU  SOUTH EAST',	'web',	NULL,	NULL),
(359,	'Manage IGBOIDUN',	'web',	NULL,	NULL),
(360,	'Manage AIYEDUN',	'web',	NULL,	NULL),
(361,	'Manage EKAN',	'web',	NULL,	NULL),
(362,	'Manage IMOJI/ILALE/ERINMOPE',	'web',	NULL,	NULL),
(363,	'Manage ILOFFA',	'web',	NULL,	NULL),
(364,	'Manage IMODE/EGOSI',	'web',	NULL,	NULL),
(365,	'Manage IDOFIN IGBANA 1',	'web',	NULL,	NULL),
(366,	'Manage IDOFIN IGBANA 11',	'web',	NULL,	NULL),
(367,	'Manage IDOFIN /ODO-ASHE',	'web',	NULL,	NULL),
(368,	'Manage ODO-OWA 1',	'web',	NULL,	NULL),
(369,	'Manage ODO-OWA 11',	'web',	NULL,	NULL),
(370,	'Manage ERIN-ILE SOUTH',	'web',	NULL,	NULL),
(371,	'Manage ILEMONA',	'web',	NULL,	NULL),
(372,	'Manage IGBONA',	'web',	NULL,	NULL),
(373,	'Manage IRRA',	'web',	NULL,	NULL),
(374,	'Manage INAJA/AHOGBADA',	'web',	NULL,	NULL),
(375,	'Manage IKOTUN',	'web',	NULL,	NULL),
(376,	'Manage OJOKU',	'web',	NULL,	NULL),
(377,	'Manage IJAGBO',	'web',	NULL,	NULL),
(378,	'Manage IGOSUN',	'web',	NULL,	NULL),
(379,	'Manage IPEE',	'web',	NULL,	NULL),
(380,	'Manage ERIN-ILE NORTH',	'web',	NULL,	NULL),
(381,	'Manage PATIGI 1',	'web',	NULL,	NULL),
(382,	'Manage PATIGI 11',	'web',	NULL,	NULL),
(383,	'Manage PATIGI 111',	'web',	NULL,	NULL),
(384,	'Manage PATIGI 1V',	'web',	NULL,	NULL),
(385,	'Manage KPADA 1',	'web',	NULL,	NULL),
(386,	'Manage KPADA 11',	'web',	NULL,	NULL),
(387,	'Manage KPADA 111',	'web',	NULL,	NULL),
(388,	'Manage LADE 1',	'web',	NULL,	NULL),
(389,	'Manage LADE 11',	'web',	NULL,	NULL),
(390,	'Manage LADE 111',	'web',	NULL,	NULL);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(198,	3),
(198,	5),
(198,	7),
(199,	3),
(199,	5),
(199,	7),
(200,	2),
(201,	2),
(202,	1),
(202,	5),
(202,	6),
(203,	1),
(203,	6);

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
  `profile_picture` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `profile_picture`, `otp`, `otp_sent_on`, `verify_token`, `verify`, `provider`, `provider_id`, `firebase_token`, `created_at`, `updated_at`) VALUES
(1,	'Super',	'admin@mail.com',	'2022-07-06 08:57:15',	'$2a$12$rIXYcvv0wSSk5QOcXQb9Z.QtjY6TGp49yKWGaCzNSHu9C2I5Uq8qa',	'UMbX9GoZLldhY1Fn3dFlSdqNxlNeIbLWdyJ71mUU1TBKEwmrGc51kh31WaD8',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	'2022-07-06 08:57:15',	'2022-07-06 08:57:15'),
(5,	'mail name',	'mailname@mail.com',	NULL,	'$2y$10$XiRI6AyQl1MnS./YSx5./uF9TL1L6iT3Zxg3hNPq9T1.7NS5MGrf6',	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-06 10:56:05',	'2022-07-06 10:56:05'),
(6,	'New User',	'new_user@mail.com',	NULL,	'$2y$10$huliER4Lb8kQCdqhqVIK/eblbG6rjlCHh5F3ioUWLNo8M8Ox09Qx6',	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-06 11:17:46',	'2022-07-06 11:17:46'),
(9,	'Muhammad Saad',	'saad@sidtechno.com',	NULL,	'$2y$10$W094GGfEr58m6kTeP1zxF.B8eSDFhynBlNkTPr0t/k6ox8.cldjca',	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-08 09:52:20',	'2022-07-08 09:53:23'),
(10,	'Muhammad',	'saad@mail2.com',	NULL,	'$2y$10$qEoSJ4A.Sd4QX3Aq0ddwCuflLfK5RW07q7s4GUNyfhfpmxSxiaeBq',	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-08 09:57:25',	'2022-07-13 07:37:07'),
(11,	'Muhamamd Saad...',	'mail1test@mail.com',	NULL,	'$2y$10$5KnuyobTr9vd9nJYbm/Jc.fcImAhYJQ81wipfnPsvy/Lu97AjaS6O',	NULL,	NULL,	NULL,	'',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-14 10:51:43',	'2022-07-14 10:51:43'),
(17,	'Muhamamd Saad...',	'saad_sinpk@yahoo.com',	NULL,	'$2y$10$TjH3xZw9FGNK.zUkf9go0OjgcRJwh/vOGGBPk6eiwwZbyJ7OQon6K',	NULL,	NULL,	'5230',	'2022-09-08 12:05:13',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-14 11:12:50',	'2022-09-08 14:01:10'),
(18,	'Muhmamd',	'mail@mail2.com',	NULL,	'$2y$10$EJqsniN5t/vNo0KhjaEdzePjGQJsFrRKib.RVrRrkLf78017UMyC2',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:27:48',	'2022-07-18 13:27:48'),
(19,	'Muhmamd',	'mail@mail4.com',	NULL,	'$2y$10$KkdPQxA6xkqZ33/tlujb0OfqgGnZL39PYarJxIoEvYmsDfWfV3If2',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:34:09',	'2022-07-18 13:34:09'),
(20,	'Muhmamd',	'mail@mail5.com',	NULL,	'$2y$10$uOFzI3x6lZmQ3wzUHq9gHObnJ7r5EZ7EJjjhyOg7.AdWFB1b2ADTC',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:42:21',	'2022-07-18 13:42:21'),
(21,	'Muhmamd',	'mail@mail6.com',	NULL,	'$2y$10$phPIDmgq6vKTUU3n1vtw.e2U/eYZ4mClfG1FvbF9HaFJKFcjsABTK',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:48:00',	'2022-07-18 13:48:00'),
(22,	'Muhmamd',	'mail@mail7.com',	NULL,	'$2y$10$VXyk9bxKQ.l6KjWnK0i54./pLwdEi9Flqcu.cTdwh.hBSCOFHyxgu',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:48:54',	'2022-07-18 13:48:54'),
(23,	'Muhmamd',	'mail@mail8.com',	NULL,	'$2y$10$9tAwt98Yas7JA/mW8bCn8.Jo3O5Bbo4BLyTCbL0jZwDqFBKOsTL.S',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:49:41',	'2022-07-18 13:49:41'),
(24,	'Muhmamd',	'mail@mail9.com',	NULL,	'$2y$10$ayGcbCOt/k2lbD6jYI7r2e9Hgz8eVN8/TNl3ASSz1iJAjTEpVKeWu',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-07-18 13:50:42',	'2022-07-18 13:50:42'),
(25,	'Muhmamd',	'mail@mail10.com',	NULL,	'$2y$10$YfZVxQTAB0w0mXRvDHqIn.Kp65HqRIpfHnsV8wxuNa7LBGsx51PF6',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'facebook',	'1234',	NULL,	'2022-07-18 13:57:03',	'2022-07-18 13:57:03'),
(26,	'Ann Akude',	'akudrre@gmail.com',	NULL,	'$2y$10$RsYJ9y84sJTruga5LQGEMeBJQ8DeexNRxcz7c9tYep7M/NqjzFmoW',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'123',	'2022-07-21 18:07:33',	'2022-08-20 13:26:31'),
(27,	'Codepro',	'paulodhiambo962@gmail.com',	NULL,	'$2y$10$z/6wNooGDjMxDdGMeeStdOFFXlUmrkaKNxmFqGntPxSzWMlX.dOj.',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-20 15:16:48',	'2022-08-20 15:17:30'),
(28,	'Jackson',	'jackson@gmail.com',	NULL,	'jackson@123',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-22 08:55:35',	'2022-08-22 09:40:37'),
(29,	'Kristen Hampton',	'kristenhampton.81372@gmail.com',	NULL,	'$2y$10$m6i3aSpy9585s33QP6d72.IMAC4yBytqbcG/DUD4sEYhRgLIlX29i',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-25 14:00:38',	'2022-08-25 14:00:38'),
(30,	'Kirti Chavda',	'kirti301290@gmail.com',	NULL,	'$2y$10$tMaOAv5eLiWeBJjVVgOjxOt1AJCDDYEiLdVlGWrp7gEgK43EJjQ1W',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-25 17:17:43',	'2022-09-06 14:02:21'),
(31,	'Muhammad Saad',	'saad.sid0@gmail.com',	NULL,	'$2y$10$Om95Anu/aN/GA1GHArFtQuigEbV1erIX5FOH.bGHlHdk9bLNoMpd6',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-08-29 04:57:08',	'2022-09-06 13:30:41'),
(32,	'Muhammad Saad',	'new_user44@mail.com',	NULL,	'$2y$10$FsYxNpcr0jGWmrSNKeUcm.k8fK4Ykad1Mqu5mSPvnXkSLDtcpPLZy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-09-07 09:51:31',	'2022-09-07 09:51:31'),
(33,	'Muhammad Saad',	'New_test_user344@mail.com',	NULL,	'$2y$10$OTMf.HJymgPFmWjTWBLw1.IZvnLHMAjJIImPbq/ucY/lb8fpY8/0.',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-09-07 09:53:25',	'2022-09-07 09:53:25'),
(34,	'Test',	'test@mail.com',	NULL,	'$2y$10$TEwF3ZuE/3bAJClkcuEVCeQ7CwtqaImkWDy695NCqVrie49..rxQC',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-09-08 14:25:20',	'2022-09-08 14:25:20'),
(35,	'Ward Role 2',	'ward_role_2@mail.com',	NULL,	'$2y$10$ckXKTtk0d4mSHbnWl6F9iunoaM7LUPl24ZEaw.CHn1w3dlXG9LTIy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-09-08 14:26:14',	'2022-09-08 14:26:14'),
(36,	'Giddy Naya',	'ogbonnagideon5@gmail.com',	NULL,	'$2y$10$TR6VQc.ONToyPu5rM1uI/.kljDUaF5Q90SU6y5z1wYw3uKoLT0mmC',	NULL,	NULL,	'7121',	'2022-09-08 02:29:35',	NULL,	NULL,	NULL,	NULL,	NULL,	'2022-09-08 14:27:17',	'2022-09-08 15:25:02');

-- 2022-09-09 09:24:02
