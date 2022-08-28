/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `basis_pengetahuan` (
  `id_pengetahuan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_penyakit` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `mb` double(11,1) NOT NULL,
  `md` double(11,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengetahuan`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `gejala` (
  `id_gejala` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_gejala` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_gejala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `hasil` (
  `id_hasil` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `penyakit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gejala` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_hasil`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `kondisi` (
  `id_kondisi` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kondisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kondisi`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `penyakit` (
  `id_penyakit` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_penyakit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_penyakit` text COLLATE utf8mb4_unicode_ci,
  `saran_penyakit` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_penyakit` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id_penyakit`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `post` (
  `id_post` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_post` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_post` text COLLATE utf8mb4_unicode_ci,
  `saran_post` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `basis_pengetahuan` (`id_pengetahuan`, `id_penyakit`, `id_gejala`, `mb`, `md`, `created_at`, `updated_at`) VALUES
(5, 1, 3, 1.0, 0.0, '2022-08-14 17:50:54', '2022-08-14 17:50:54');
INSERT INTO `basis_pengetahuan` (`id_pengetahuan`, `id_penyakit`, `id_gejala`, `mb`, `md`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 1.0, 0.0, '2022-08-14 17:51:14', '2022-08-14 17:51:14');
INSERT INTO `basis_pengetahuan` (`id_pengetahuan`, `id_penyakit`, `id_gejala`, `mb`, `md`, `created_at`, `updated_at`) VALUES
(7, 1, 4, 1.0, 0.0, '2022-08-14 17:51:39', '2022-08-14 17:51:39');
INSERT INTO `basis_pengetahuan` (`id_pengetahuan`, `id_penyakit`, `id_gejala`, `mb`, `md`, `created_at`, `updated_at`) VALUES
(8, 1, 5, 1.0, 0.0, '2022-08-14 17:52:41', '2022-08-14 17:52:41'),
(9, 1, 6, 1.0, 0.0, '2022-08-14 17:53:23', '2022-08-14 17:53:23'),
(10, 1, 7, 1.0, 0.0, '2022-08-14 17:53:28', '2022-08-14 17:53:28'),
(11, 1, 8, 1.0, 0.0, '2022-08-14 17:53:37', '2022-08-14 17:53:37'),
(12, 1, 9, 1.0, 0.0, '2022-08-14 17:54:07', '2022-08-14 17:54:07'),
(13, 3, 2, 1.0, 0.0, '2022-08-14 17:54:49', '2022-08-14 17:54:49'),
(14, 3, 4, 1.0, 0.0, '2022-08-14 17:55:09', '2022-08-14 17:55:09'),
(15, 3, 5, 1.0, 0.0, '2022-08-14 17:55:14', '2022-08-14 17:55:14'),
(16, 3, 10, 1.0, 0.0, '2022-08-14 17:55:48', '2022-08-14 17:55:48'),
(17, 3, 11, 1.0, 0.0, '2022-08-14 17:55:55', '2022-08-14 17:55:55'),
(18, 3, 12, 1.0, 0.0, '2022-08-14 17:56:01', '2022-08-14 17:56:01'),
(19, 4, 4, 1.0, 0.0, '2022-08-14 17:56:32', '2022-08-14 17:56:32'),
(20, 4, 13, 1.0, 0.0, '2022-08-14 17:56:55', '2022-08-14 17:56:55'),
(21, 4, 14, 1.0, 0.0, '2022-08-14 17:57:01', '2022-08-14 17:57:01'),
(22, 4, 15, 1.0, 0.0, '2022-08-14 17:57:05', '2022-08-14 17:57:05'),
(23, 4, 16, 1.0, 0.0, '2022-08-14 17:57:12', '2022-08-14 17:57:12'),
(24, 4, 17, 1.0, 0.0, '2022-08-14 17:57:16', '2022-08-14 17:57:16'),
(25, 4, 18, 1.0, 0.0, '2022-08-14 17:57:22', '2022-08-14 17:57:22'),
(26, 4, 19, 1.0, 0.0, '2022-08-14 17:57:26', '2022-08-14 17:57:26'),
(27, 4, 20, 1.0, 0.0, '2022-08-14 17:57:32', '2022-08-14 17:57:32'),
(28, 4, 21, 1.0, 0.0, '2022-08-14 17:57:36', '2022-08-14 17:57:36'),
(29, 4, 22, 1.0, 0.0, '2022-08-14 17:57:42', '2022-08-14 17:57:42'),
(30, 5, 4, 1.0, 0.0, '2022-08-14 17:58:07', '2022-08-14 17:58:07'),
(31, 5, 5, 1.0, 0.0, '2022-08-14 17:58:13', '2022-08-14 17:58:13'),
(32, 5, 15, 1.0, 0.0, '2022-08-14 17:58:26', '2022-08-14 17:58:26'),
(33, 5, 23, 1.0, 0.0, '2022-08-14 17:58:49', '2022-08-14 17:58:49'),
(34, 5, 24, 1.0, 0.0, '2022-08-14 17:58:53', '2022-08-14 17:58:53'),
(35, 5, 25, 1.0, 0.0, '2022-08-14 17:58:57', '2022-08-14 17:58:57');



INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`, `created_at`, `updated_at`) VALUES
(2, 'G571', 'Sesak nafas (hipertensi & jantung)', '2022-08-14 04:59:25', '2022-08-14 04:59:25');
INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`, `created_at`, `updated_at`) VALUES
(3, 'G388', 'Nyeri dada tiba tiba', '2022-08-14 05:37:22', '2022-08-14 05:43:31');
INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`, `created_at`, `updated_at`) VALUES
(4, 'G329', 'Cepat lelah dan lemas (hipertensi &diabetes & jantung & stroke)', '2022-08-14 08:32:03', '2022-08-14 08:32:03');
INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`, `created_at`, `updated_at`) VALUES
(5, 'G506', 'Nyeri kepala/pusing (hipertensi & jantung& stroke)', '2022-08-14 08:32:14', '2022-08-14 08:32:14'),
(6, 'G619', 'Bengkak di sekitar sendi & kaki', '2022-08-14 08:32:23', '2022-08-14 08:32:23'),
(7, 'G564', 'Mual dan muntah', '2022-08-14 08:32:33', '2022-08-14 08:32:33'),
(8, 'G193', 'Keringat dingin berlebihan', '2022-08-14 08:32:42', '2022-08-14 08:32:42'),
(9, 'G736', 'Seluruh tubuh terasa terbakar', '2022-08-14 08:32:47', '2022-08-14 08:32:47'),
(10, 'G833', 'Sering buang air kecil (hipertensi & diabetes)', '2022-08-14 08:32:54', '2022-08-14 08:32:54'),
(11, 'G277', 'Jantung berdetak lebih cepat', '2022-08-14 08:33:00', '2022-08-14 08:33:00'),
(12, 'G835', 'Mimisan', '2022-08-14 08:33:08', '2022-08-14 08:33:08'),
(13, 'G397', 'Berat badan turun', '2022-08-14 08:33:13', '2022-08-14 08:33:13'),
(14, 'G389', 'Nafsu makan meningkat', '2022-08-14 08:33:54', '2022-08-14 08:33:54'),
(15, 'G971', 'Gangguan penglihatan (diabetes & stroke)', '2022-08-14 08:34:04', '2022-08-14 08:34:04'),
(16, 'G385', 'Kesemutan/mati rasa', '2022-08-14 08:34:11', '2022-08-14 08:34:11'),
(17, 'G600', 'Infeksi jamur', '2022-08-14 08:34:17', '2022-08-14 08:34:17'),
(18, 'G720', 'Luka sulit sembuh', '2022-08-14 08:34:30', '2022-08-14 08:34:30'),
(19, 'G305', 'Timbul penyakit kulit', '2022-08-14 08:34:38', '2022-08-14 08:34:38'),
(20, 'G763', 'Infeksi saluran kemih', '2022-08-14 08:35:20', '2022-08-14 08:35:20'),
(21, 'G615', 'Mudah haus', '2022-08-14 08:35:25', '2022-08-14 08:35:25'),
(22, 'G374', 'Infeksi gusi', '2022-08-14 08:35:29', '2022-08-14 08:35:29'),
(23, 'G311', 'Sulit berbicara', '2022-08-14 08:35:33', '2022-08-14 08:35:33'),
(24, 'G312', 'Sulit berjalan/ataxia', '2022-08-14 08:35:38', '2022-08-14 08:35:38'),
(25, 'G912', 'Hilang kesadaran/ingatan dengan tiba-tiba', '2022-08-14 08:35:43', '2022-08-14 08:35:43');

INSERT INTO `hasil` (`id_hasil`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`, `created_at`, `updated_at`) VALUES
(1, '2022-08-14 18:38:38', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 18:38:38', '2022-08-14 18:38:38');
INSERT INTO `hasil` (`id_hasil`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`, `created_at`, `updated_at`) VALUES
(2, '2022-08-14 18:40:37', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 18:40:37', '2022-08-14 18:40:37');
INSERT INTO `hasil` (`id_hasil`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`, `created_at`, `updated_at`) VALUES
(3, '2022-08-14 18:42:58', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 18:42:58', '2022-08-14 18:42:58');
INSERT INTO `hasil` (`id_hasil`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`, `created_at`, `updated_at`) VALUES
(4, '2022-08-14 19:00:21', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 5, '1.0000', '2022-08-14 19:00:21', '2022-08-14 19:00:21'),
(5, '2022-08-14 19:00:47', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 3, '1.0000', '2022-08-14 19:00:47', '2022-08-14 19:00:47'),
(6, '2022-08-14 19:01:03', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 19:01:03', '2022-08-14 19:01:03'),
(7, '2022-08-14 19:01:14', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 19:01:14', '2022-08-14 19:01:14'),
(8, '2022-08-14 19:02:08', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 19:02:08', '2022-08-14 19:02:08'),
(9, '2022-08-14 19:02:31', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 1, '1.0000', '2022-08-14 19:02:31', '2022-08-14 19:02:31'),
(10, '2022-08-14 19:02:53', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"7\";i:3;s:1:\"2\";i:4;s:1:\"1\";i:5;s:1:\"4\";i:6;s:1:\"4\";}', 4, '1.0000', '2022-08-14 19:02:53', '2022-08-14 19:02:53'),
(11, '2022-08-26 15:18:09', 'a:4:{i:1;s:6:\"0.6000\";i:3;s:6:\"0.6000\";i:4;s:6:\"0.6000\";i:5;s:6:\"0.6000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"8\";}', 1, '0.6000', '2022-08-26 15:18:09', '2022-08-26 15:18:09'),
(12, '2022-08-26 15:18:45', 'a:4:{i:1;s:6:\"0.6000\";i:3;s:6:\"0.6000\";i:4;s:6:\"0.6000\";i:5;s:6:\"0.6000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"3\";i:5;s:1:\"3\";i:6;s:1:\"8\";}', 1, '0.6000', '2022-08-26 15:18:45', '2022-08-26 15:18:45'),
(13, '2022-08-26 15:59:29', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 15:59:29', '2022-08-26 15:59:29'),
(14, '2022-08-26 16:00:18', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:00:18', '2022-08-26 16:00:18'),
(15, '2022-08-26 16:00:34', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:00:34', '2022-08-26 16:00:34'),
(16, '2022-08-26 16:01:16', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:01:16', '2022-08-26 16:01:16'),
(17, '2022-08-26 16:02:01', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:02:01', '2022-08-26 16:02:01'),
(18, '2022-08-26 16:02:42', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:02:42', '2022-08-26 16:02:42'),
(19, '2022-08-26 16:08:01', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:08:01', '2022-08-26 16:08:01'),
(20, '2022-08-26 16:08:12', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:08:12', '2022-08-26 16:08:12'),
(21, '2022-08-26 16:10:03', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:10:03', '2022-08-26 16:10:03'),
(22, '2022-08-26 16:10:21', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:5:{i:2;s:1:\"4\";i:3;s:1:\"4\";i:4;s:1:\"2\";i:5;s:1:\"4\";i:6;s:1:\"7\";}', 1, '0.8000', '2022-08-26 16:10:22', '2022-08-26 16:10:22'),
(23, '2022-08-27 15:45:54', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:3:{i:2;s:1:\"1\";i:5;s:1:\"2\";i:10;s:1:\"3\";}', 1, '0.8000', '2022-08-27 15:45:54', '2022-08-27 15:45:54'),
(24, '2022-08-27 15:47:15', 'a:4:{i:1;s:6:\"0.8000\";i:3;s:6:\"0.8000\";i:4;s:6:\"0.8000\";i:5;s:6:\"0.8000\";}', 'a:3:{i:2;s:1:\"1\";i:5;s:1:\"2\";i:10;s:1:\"3\";}', 1, '0.8000', '2022-08-27 15:47:15', '2022-08-27 15:47:15'),
(25, '2022-08-28 14:38:04', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:3:{i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";}', 1, '1.0000', '2022-08-28 14:38:04', '2022-08-28 14:38:04'),
(26, '2022-08-28 14:44:18', 'a:3:{i:3;s:6:\"1.0000\";i:1;s:6:\"0.8000\";i:5;s:6:\"0.7500\";}', 'a:11:{i:2;s:1:\"1\";i:3;s:1:\"2\";i:4;s:1:\"5\";i:5;s:1:\"2\";i:6;s:1:\"1\";i:7;s:1:\"3\";i:8;s:1:\"4\";i:9;s:1:\"2\";i:10;s:1:\"2\";i:11;s:1:\"1\";i:12;s:1:\"5\";}', 3, '1.0000', '2022-08-28 14:44:18', '2022-08-28 14:44:18'),
(27, '2022-08-28 14:55:09', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:4:{i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"4\";}', 1, '1.0000', '2022-08-28 14:55:09', '2022-08-28 14:55:09'),
(28, '2022-08-28 14:55:41', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:4:{i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"4\";}', 1, '1.0000', '2022-08-28 14:55:41', '2022-08-28 14:55:41'),
(29, '2022-08-28 14:56:39', 'a:4:{i:1;s:6:\"1.0000\";i:3;s:6:\"1.0000\";i:4;s:6:\"1.0000\";i:5;s:6:\"1.0000\";}', 'a:5:{i:2;s:1:\"1\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:5;s:1:\"2\";i:6;s:1:\"1\";}', 1, '1.0000', '2022-08-28 14:56:39', '2022-08-28 14:56:39');

INSERT INTO `kondisi` (`id_kondisi`, `kondisi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Pasti ya', '-', NULL, NULL);
INSERT INTO `kondisi` (`id_kondisi`, `kondisi`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 'Hampir pasti ya', '-', NULL, NULL);
INSERT INTO `kondisi` (`id_kondisi`, `kondisi`, `keterangan`, `created_at`, `updated_at`) VALUES
(3, 'Kemungkinan besar ya', '-', NULL, NULL);
INSERT INTO `kondisi` (`id_kondisi`, `kondisi`, `keterangan`, `created_at`, `updated_at`) VALUES
(4, 'Mungkin ya', '-', NULL, NULL),
(5, 'Tidak tahu', '-', NULL, NULL),
(6, 'Mungkin tidak', '-', NULL, NULL),
(7, 'Kemungkinan besar tidak', '-', NULL, NULL),
(8, 'Hampir pasti tidak', '-', NULL, NULL),
(9, 'Pasti tidak', '-', NULL, NULL);

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_13_113633_create_basis_pengetahuans_table', 1),
(6, '2022_08_13_114748_create_gejalas_table', 1),
(7, '2022_08_13_114833_create_hasils_table', 1),
(8, '2022_08_13_114912_create_kondisis_table', 1),
(9, '2022_08_14_054534_create_penyakits_table', 2),
(10, '2022_08_28_111841_create_posts_table', 3);



INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `detail_penyakit`, `saran_penyakit`, `created_at`, `updated_at`, `image_penyakit`) VALUES
(1, 'Jantung Koroner', 'Penyakit jantung koroner', 'Obati secepat mungkin', '2022-08-14 08:09:08', '2022-08-14 08:19:29', '1661594906.jpg');
INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `detail_penyakit`, `saran_penyakit`, `created_at`, `updated_at`, `image_penyakit`) VALUES
(3, 'Hipertensi', 'Hipertensi', 'Obati', '2022-08-14 08:24:51', '2022-08-14 08:24:51', 'ad');
INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `detail_penyakit`, `saran_penyakit`, `created_at`, `updated_at`, `image_penyakit`) VALUES
(4, 'Diabetes', 'Diabetes', 'Obati', '2022-08-14 08:25:02', '2022-08-14 08:25:02', 'a');
INSERT INTO `penyakit` (`id_penyakit`, `nama_penyakit`, `detail_penyakit`, `saran_penyakit`, `created_at`, `updated_at`, `image_penyakit`) VALUES
(5, 'Stroke', NULL, NULL, '2022-08-14 08:25:17', '2022-08-28 15:18:16', '1661674696.jpg');





INSERT INTO `user` (`id`, `nama`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$891hdUppZm9IbtVaTj/WL.YCa4rcgV3joKLOEF/Fglr4FPnGP1hmK', NULL, '2022-08-13 15:03:33', NULL);



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;