/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `failed_jobs`;
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

DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `categories` json DEFAULT NULL,
  `animalTypes` json DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '#',
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT './img/latest-placeholder.png',
  `price` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `goods2`;
CREATE TABLE `goods2` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `locations`;
CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
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

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `goods` (`id`, `title`, `categories`, `animalTypes`, `link`, `img`, `price`) VALUES
(1, 'Корм для коровы', '[0, 1]', '[\"all\", \"cattle\"]', '#', './img/latest-placeholder.png', 1000),
(2, 'Корм для свиньи', '[0, 3]', '[\"all\", \"pig\"]', '#', './img/latest-placeholder.png', 500),
(3, 'Профилактика для Лошади', '[0, 1]', '[\"all\", \"horse\"]', '#', './img/latest-placeholder.png', 1500),
(4, 'БВМК для птиц', '[0, 6]', '[\"all\", \"bird\"]', '#', './img/latest-placeholder.png', 400),
(5, 'Соль для коровы', '[0, 3]', '[\"all\", \"cattle\"]', '#', './img/latest-placeholder.png', 200),
(6, 'ЗЦМ для коровы', '[0, 4]', '[\"all\", \"cattle\"]', '#', './img/latest-placeholder.png', 700),
(7, 'Премиксы для свиней', '[0, 5]', '[\"all\", \"pig\"]', '#', './img/latest-placeholder.png', 300),
(8, 'Комбикорм для лошадей', '[0, 7]', '[\"all\", \"horse\"]', '#', './img/latest-placeholder.png', NULL),
(9, 'Трикальцийфосфат для кур', '[0, 8]', '[\"all\", \"bird\"]', '#', './img/latest-placeholder.png', NULL),
(10, 'сода', '[0, 9]', '[\"all\", \"cattle\", \"pig\", \"horse\", \"bird\"]', '#', './img/latest-placeholder.png', NULL),
(11, 'мел для лошадей', '[0, 10]', '[\"all\", \"horse\"]', '#', './img/latest-placeholder.png', NULL),
(12, 'Ракушка для птиц', '[0, 2]', '[\"all\", \"bird\"]', '#', './img/latest-placeholder.png', NULL);

INSERT INTO `locations` (`id`, `location`, `addres`, `name`, `tel`, `created_at`, `updated_at`) VALUES
(1, 'п. Залесный', 'ул.Аксу, 2В', '', '+7(960)040-49-64', NULL, NULL),
(2, 'г. Нижнекамск', 'ул.Центральная, 89. База «Ваше хозяйство»', '', '+7(958)627-02-09', NULL, NULL),
(3, 'г. Альметьевск', 'ул.Ленина, 124. Магазин «Садовник»', '', '+7(919)686-74-30', '2025-12-09 16:45:47', '2025-12-09 16:45:47'),
(4, 'г. Арск', NULL, 'ИП Хабибрахманова Л.И.', '+7(927)403-60-22', '2025-12-09 16:47:30', '2025-12-09 16:47:30'),
(5, 'Апастовский район', 'пос. ж/д станции Каратун, ул.Гагарина, 21', 'ИП Сиразеев Н.М.', '+7(917)231-65-42', '2025-12-09 16:48:27', '2025-12-09 16:48:27'),
(6, 'г. Болгар', 'ул.Вертынской, 64а', 'ИП Федоров Е.М.', '+7(937)775-08-29', '2025-12-09 16:49:20', '2025-12-09 16:49:20'),
(7, 'Муслюмовский район', 'с. Семяково', 'КФХ Садыкова Р.Х.', '+7(987)424-08-22', '2025-12-09 16:50:32', '2025-12-09 16:50:32'),
(8, 'Вятские поляны', 'Кировская обл. ул.Ленина, 333', 'ООО «Ветком»', '8(8333)46-02-44', '2025-12-09 16:51:25', '2025-12-09 16:51:25'),
(9, 'г.Зеленодольск', 'ул.Октябрьская д.1', 'ИП Шишина М.Н.', '+7(962)555-48-98', '2025-12-09 16:52:07', '2025-12-09 16:52:07'),
(10, 'пгт. Богатые Сабы', 'ул. Заводская, д. 19а', NULL, '+7(917)266-34-64', '2025-12-09 16:52:47', '2025-12-09 16:52:47');
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_12_05_131214_create_goods_table', 2),
(6, '2025_12_09_130905_create_locations_table', 3);





/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;