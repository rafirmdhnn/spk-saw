-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 06:54 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_diagnosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatifs`
--

CREATE TABLE `alternatifs` (
  `id` int(10) UNSIGNED NOT NULL,
  `alternatif_kode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternatif_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatifs`
--

INSERT INTO `alternatifs` (`id`, `alternatif_kode`, `alternatif_nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A1', 'Subjective', '2021-08-10 16:18:54', '2021-08-10 16:18:54', NULL),
(2, 'A2', 'Neurophysiology', '2021-08-10 16:18:54', '2021-08-10 16:18:54', NULL),
(3, 'A3', 'Autonomic', '2021-08-10 16:18:54', '2021-08-10 16:18:54', NULL),
(4, 'A4', 'Panic related', '2021-08-10 16:18:54', '2021-08-10 16:18:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alternatif_nilais`
--

CREATE TABLE `alternatif_nilais` (
  `id` int(10) UNSIGNED NOT NULL,
  `alternatif_id` int(10) UNSIGNED DEFAULT NULL,
  `kriteria_id` int(10) UNSIGNED DEFAULT NULL,
  `nilai_kriteria_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `kriterias`
--

CREATE TABLE `kriterias` (
  `id` int(10) UNSIGNED NOT NULL,
  `alternatif_id` int(10) UNSIGNED DEFAULT NULL,
  `kriteria_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria_atribut` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria_bobot` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriterias`
--

INSERT INTO `kriterias` (`id`, `alternatif_id`, `kriteria_nama`, `kriteria_atribut`, `kriteria_bobot`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Kibas-kibas atau kesemutan', 'benefit', 3.5, '2021-08-10 16:27:02', '2021-08-10 16:42:09', NULL),
(2, 1, 'Perasaan panas', 'benefit', 3.5, '2021-08-10 16:27:20', '2021-08-10 16:42:12', NULL),
(3, 1, 'Lemas atau goyah pada kaki', 'benefit', 3.5, '2021-08-10 16:27:33', '2021-08-10 16:42:15', NULL),
(4, 1, 'Sulit untuk rileks', 'benefit', 3.5, '2021-08-10 16:27:44', '2021-08-10 16:42:18', NULL),
(5, 1, 'Takut sesuatu yang buruk akan terjadi', 'benefit', 3.5, '2021-08-10 16:27:54', '2021-08-10 16:42:20', NULL),
(6, 1, 'Pusing atau kepala terasa berat', 'benefit', 3.5, '2021-08-10 16:28:04', '2021-08-10 16:42:23', NULL),
(7, 2, 'Jantung berdebar-debar kencang ', 'benefit', 3, '2021-08-10 16:28:41', '2021-08-10 16:42:50', NULL),
(8, 2, 'Goyah atau tidak tahan berdiri', 'benefit', 3, '2021-08-10 16:28:50', '2021-08-10 16:42:53', NULL),
(9, 2, 'Merasa ketakutan', 'benefit', 3, '2021-08-10 16:29:05', '2021-08-10 16:42:55', NULL),
(10, 2, 'Merasa gugup', 'benefit', 3, '2021-08-10 16:29:16', '2021-08-10 16:42:58', NULL),
(11, 2, 'Perasaan tercekik atau tersedak', 'benefit', 3, '2021-08-10 16:29:25', '2021-08-10 16:43:01', NULL),
(12, 2, 'Tangan gemetaran', 'benefit', 3, '2021-08-10 16:29:35', '2021-08-10 16:43:04', NULL),
(13, 2, 'Badan gemetar atau goyah', 'benefit', 3, '2021-08-10 16:29:47', '2021-08-10 16:43:07', NULL),
(14, 3, 'Takut hilang kendali', 'benefit', 5.25, '2021-08-10 16:30:14', '2021-08-10 16:43:16', NULL),
(15, 3, 'Kesulitan bernafas', 'benefit', 5.25, '2021-08-10 16:30:24', '2021-08-10 16:43:19', NULL),
(16, 3, 'Takut akan sekarat (kematian)', 'benefit', 5.25, '2021-08-10 16:30:38', '2021-08-10 16:43:21', NULL),
(17, 3, 'Ciut mental ', 'benefit', 5.25, '2021-08-10 16:30:46', '2021-08-10 16:43:25', NULL),
(18, 4, 'Pencernaan atau perut terganggu', 'benefit', 5.25, '2021-08-10 16:30:55', '2021-08-10 16:43:29', NULL),
(19, 4, 'Pingsan atau perasaan mau pingsan', 'benefit', 5.25, '2021-08-10 16:31:05', '2021-08-10 16:43:32', NULL),
(20, 4, 'Wajah merona memerah', 'benefit', 5.25, '2021-08-10 16:31:14', '2021-08-10 16:43:34', NULL),
(21, 4, 'Keringat panas atau dingin', 'benefit', 5.25, '2021-08-10 16:31:23', '2021-08-10 16:43:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_nilais`
--

CREATE TABLE `kriteria_nilais` (
  `id` int(10) UNSIGNED NOT NULL,
  `kriteria_id` int(10) UNSIGNED DEFAULT NULL,
  `kn_keterangan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kn_nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kriteria_nilais`
--

INSERT INTO `kriteria_nilais` (`id`, `kriteria_id`, `kn_keterangan`, `kn_nilai`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Tidak sama sekali.', 0, '2021-08-10 16:46:59', '2021-08-10 16:49:38', NULL),
(2, 1, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:49:25', '2021-08-10 09:49:25', NULL),
(3, 1, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:49:53', '2021-08-10 09:49:53', NULL),
(4, 1, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:50:02', '2021-08-10 09:50:02', NULL),
(5, 2, 'Tidak sama sekali.', 0, '2021-08-10 09:50:20', '2021-08-10 09:50:20', NULL),
(6, 2, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:50:52', '2021-08-10 16:51:37', NULL),
(7, 2, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:51:02', '2021-08-10 09:51:02', NULL),
(8, 2, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:51:11', '2021-08-10 16:51:40', NULL),
(9, 3, 'Tidak sama sekali.', 0, '2021-08-10 09:51:57', '2021-08-10 09:51:57', NULL),
(10, 3, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:52:11', '2021-08-10 09:52:11', NULL),
(11, 3, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:52:20', '2021-08-10 09:52:20', NULL),
(12, 3, 'Sedang: kadang - kadang saya tidak nyaman', 3, '2021-08-10 09:52:29', '2021-08-10 09:52:29', NULL),
(13, 4, 'Tidak sama sekali.', 0, '2021-08-10 09:53:00', '2021-08-10 09:53:00', NULL),
(14, 4, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:53:14', '2021-08-10 09:53:14', NULL),
(15, 4, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:53:26', '2021-08-10 09:53:26', NULL),
(16, 4, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:53:34', '2021-08-10 09:53:34', NULL),
(17, 5, 'Tidak sama sekali.', 0, '2021-08-10 09:54:22', '2021-08-10 09:54:22', NULL),
(18, 5, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:54:34', '2021-08-10 09:54:34', NULL),
(19, 5, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:54:45', '2021-08-10 09:54:45', NULL),
(20, 5, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:54:56', '2021-08-10 09:54:56', NULL),
(21, 6, 'Tidak sama sekali', 0, '2021-08-10 09:55:19', '2021-08-10 09:55:19', NULL),
(22, 6, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:55:31', '2021-08-10 09:55:31', NULL),
(23, 6, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:55:39', '2021-08-10 09:55:39', NULL),
(24, 6, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:55:49', '2021-08-10 09:55:49', NULL),
(25, 7, '0', 0, '2021-08-10 09:56:01', '2021-08-10 09:56:01', NULL),
(26, 7, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:56:10', '2021-08-10 09:56:10', NULL),
(27, 7, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:56:19', '2021-08-10 09:56:19', NULL),
(28, 7, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:56:29', '2021-08-10 09:56:29', NULL),
(29, 8, 'Tidak sama sekali.', 0, '2021-08-10 09:56:42', '2021-08-10 09:56:42', NULL),
(30, 8, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:56:54', '2021-08-10 09:56:54', NULL),
(31, 8, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:57:03', '2021-08-10 09:57:03', NULL),
(32, 8, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:57:11', '2021-08-10 09:57:11', NULL),
(33, 9, 'Tidak sama sekali.', 0, '2021-08-10 09:57:22', '2021-08-10 09:57:22', NULL),
(34, 9, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:57:31', '2021-08-10 09:57:31', NULL),
(35, 9, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:57:40', '2021-08-10 09:57:40', NULL),
(36, 9, 'Sedang: kadang - kadang saya tidak nyaman', 3, '2021-08-10 09:58:09', '2021-08-10 09:58:09', NULL),
(37, 10, 'Tidak sama sekali.', 0, '2021-08-10 09:58:19', '2021-08-10 09:58:19', NULL),
(38, 10, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:58:29', '2021-08-10 09:58:29', NULL),
(39, 10, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:58:39', '2021-08-10 09:58:39', NULL),
(40, 10, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:58:48', '2021-08-10 09:58:48', NULL),
(41, 11, 'Tidak sama sekali.', 0, '2021-08-10 09:59:16', '2021-08-10 09:59:16', NULL),
(42, 11, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 09:59:25', '2021-08-10 09:59:25', NULL),
(43, 11, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 09:59:33', '2021-08-10 09:59:33', NULL),
(44, 11, 'Berat: banyak menganggu saya', 3, '2021-08-10 09:59:41', '2021-08-10 09:59:41', NULL),
(45, 12, 'Tidak sama sekali.', 0, '2021-08-10 10:00:00', '2021-08-10 10:00:00', NULL),
(46, 12, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:00:09', '2021-08-10 10:00:09', NULL),
(47, 12, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:00:21', '2021-08-10 10:00:21', NULL),
(48, 12, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:00:31', '2021-08-10 10:00:31', NULL),
(49, 13, 'Tidak sama sekali.', 0, '2021-08-10 10:01:11', '2021-08-10 10:01:11', NULL),
(50, 13, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:01:19', '2021-08-10 10:01:19', NULL),
(51, 13, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:01:26', '2021-08-10 10:01:26', NULL),
(52, 13, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:01:34', '2021-08-10 10:01:34', NULL),
(53, 14, 'Tidak sama sekali.', 0, '2021-08-10 10:01:50', '2021-08-10 10:01:50', NULL),
(54, 14, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:01:58', '2021-08-10 10:01:58', NULL),
(55, 14, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:02:09', '2021-08-10 10:02:09', NULL),
(56, 14, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:02:17', '2021-08-10 10:02:17', NULL),
(57, 15, 'Tidak sama sekali.', 0, '2021-08-10 10:02:41', '2021-08-10 10:02:41', NULL),
(58, 15, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:02:56', '2021-08-10 10:02:56', NULL),
(59, 15, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:03:04', '2021-08-10 10:03:04', NULL),
(60, 15, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:03:12', '2021-08-10 10:03:12', NULL),
(61, 16, 'Tidak sama sekali.', 0, '2021-08-10 10:03:36', '2021-08-10 10:03:36', NULL),
(62, 16, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:03:44', '2021-08-10 10:03:44', NULL),
(63, 16, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:03:52', '2021-08-10 10:03:52', NULL),
(64, 16, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:04:00', '2021-08-10 10:04:00', NULL),
(65, 17, 'Tidak sama sekali.', 0, '2021-08-10 10:04:10', '2021-08-10 10:04:10', NULL),
(66, 17, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:04:19', '2021-08-10 10:04:19', NULL),
(67, 17, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:04:28', '2021-08-10 10:04:28', NULL),
(68, 17, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:04:37', '2021-08-10 10:04:37', NULL),
(69, 18, 'Tidak sama sekali.', 0, '2021-08-10 10:04:48', '2021-08-10 10:04:48', NULL),
(70, 18, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:04:57', '2021-08-10 10:04:57', NULL),
(71, 18, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:05:07', '2021-08-10 10:05:07', NULL),
(72, 18, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:05:16', '2021-08-10 10:05:16', NULL),
(73, 19, 'Tidak sama sekali.', 0, '2021-08-10 10:06:14', '2021-08-10 10:06:14', NULL),
(74, 19, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:06:24', '2021-08-10 10:06:24', NULL),
(75, 19, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:06:34', '2021-08-10 10:06:34', NULL),
(76, 19, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:06:43', '2021-08-10 10:06:43', NULL),
(77, 20, 'Tidak sama sekali.', 0, '2021-08-10 10:06:55', '2021-08-10 10:06:55', NULL),
(78, 20, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:07:04', '2021-08-10 10:07:04', NULL),
(79, 20, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:07:14', '2021-08-10 10:07:14', NULL),
(80, 20, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:07:23', '2021-08-10 10:07:23', NULL),
(81, 21, 'Tidak sama sekali.', 0, '2021-08-10 10:07:40', '2021-08-10 10:07:40', NULL),
(82, 21, 'Ringan tetapi tidak banyak menganggu saya', 1, '2021-08-10 10:07:50', '2021-08-10 10:07:50', NULL),
(83, 21, 'Sedang: kadang - kadang saya tidak nyaman', 2, '2021-08-10 10:08:05', '2021-08-10 10:08:05', NULL),
(84, 21, 'Berat: banyak menganggu saya', 3, '2021-08-10 10:08:12', '2021-08-10 10:08:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_02_154219_create_kriterias_table', 1),
(5, '2021_05_02_154459_create_kriteria_nilais_table', 1),
(6, '2021_05_02_170637_remove_foreign_nilai_kriteria_id_to_alternatif_nilai_table', 1),
(7, '2021_06_25_083004_add_is_role_to_users_table', 1),
(8, '2021_06_30_110450_add_user_id_to_kriterias_table', 1),
(9, '2021_06_30_205341_add_user_id_to_kriteria_nilais_table', 1),
(10, '2021_07_12_051955_add_field_to_alternatifs_table', 1),
(11, '2021_07_21_041858_drop_user_id_to_kriteria_nilais_table', 1),
(12, '2021_07_21_042126_drop_user_id_to_kriterias_table', 1),
(13, '2021_08_10_161449_remove_field_alternatifs_table', 2),
(14, '2021_08_10_161651_add_kode_to_alternatifs_table', 3),
(15, '2021_08_10_163616_change_data_type_kriteria_nilai_to_kriterias_table', 4),
(18, '2021_08_10_163945_add_alternatif_id_to_alternatifs_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_role` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `is_role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', NULL, '$2y$10$xa7i8HbrckennHosP1R6WOQWAa2veigQu1jpQzYuAQ8KEorD2Lvhi', NULL, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatifs`
--
ALTER TABLE `alternatifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alternatif_nilais`
--
ALTER TABLE `alternatif_nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternatif_nilais_alternatif_id_foreign` (`alternatif_id`),
  ADD KEY `alternatif_nilais_kriteria_id_foreign` (`kriteria_id`),
  ADD KEY `alternatif_nilais_nilai_kriteria_id_foreign` (`nilai_kriteria_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriterias_alternatif_id_foreign` (`alternatif_id`);

--
-- Indexes for table `kriteria_nilais`
--
ALTER TABLE `kriteria_nilais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_nilais_kriteria_id_foreign` (`kriteria_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- AUTO_INCREMENT for table `alternatifs`
--
ALTER TABLE `alternatifs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alternatif_nilais`
--
ALTER TABLE `alternatif_nilais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kriteria_nilais`
--
ALTER TABLE `kriteria_nilais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatif_nilais`
--
ALTER TABLE `alternatif_nilais`
  ADD CONSTRAINT `alternatif_nilais_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alternatif_nilais_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kriterias`
--
ALTER TABLE `kriterias`
  ADD CONSTRAINT `kriterias_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kriteria_nilais`
--
ALTER TABLE `kriteria_nilais`
  ADD CONSTRAINT `kriteria_nilais_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
