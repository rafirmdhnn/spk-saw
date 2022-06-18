/*
Navicat MySQL Data Transfer

Source Server         : Laragon
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : spk_diagnosa_new

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2022-06-18 17:19:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alternatifs
-- ----------------------------
DROP TABLE IF EXISTS `alternatifs`;
CREATE TABLE `alternatifs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alternatif_kode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternatif_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of alternatifs
-- ----------------------------
INSERT INTO `alternatifs` VALUES ('1', 'A1', 'Subjective', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null);
INSERT INTO `alternatifs` VALUES ('2', 'A2', 'Neurophysiology', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null);
INSERT INTO `alternatifs` VALUES ('3', 'A3', 'Autonomic', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null);
INSERT INTO `alternatifs` VALUES ('4', 'A4', 'Panic related', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null);

-- ----------------------------
-- Table structure for alternatif_nilais
-- ----------------------------
DROP TABLE IF EXISTS `alternatif_nilais`;
CREATE TABLE `alternatif_nilais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `kriteria_id` int(10) unsigned DEFAULT NULL,
  `nilai_kriteria_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alternatif_nilais_kriteria_id_foreign` (`kriteria_id`),
  KEY `alternatif_nilais_nilai_kriteria_id_foreign` (`nilai_kriteria_id`),
  KEY `alternatif_nilais_user_id_foreign` (`user_id`),
  CONSTRAINT `alternatif_nilais_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alternatif_nilais_nilai_kriteria_id_foreign` FOREIGN KEY (`nilai_kriteria_id`) REFERENCES `kriteria_nilais` (`id`) ON DELETE CASCADE,
  CONSTRAINT `alternatif_nilais_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of alternatif_nilais
-- ----------------------------
INSERT INTO `alternatif_nilais` VALUES ('1', '2', '1', '1', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('2', '2', '2', '6', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('3', '2', '3', '11', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('4', '2', '4', '15', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('5', '2', '5', '18', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('6', '2', '6', '21', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('7', '2', '7', '26', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('8', '2', '8', '30', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('9', '2', '9', '34', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('10', '2', '10', '39', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('11', '2', '11', '43', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('12', '2', '12', '46', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('13', '2', '13', '50', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('14', '2', '14', '53', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('15', '2', '15', '57', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('16', '2', '16', '62', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('17', '2', '17', '66', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('18', '2', '18', '72', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('19', '2', '19', '73', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('20', '2', '20', '78', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('21', '2', '21', '82', '2022-06-18 15:02:22', '2022-06-18 15:02:22', null);
INSERT INTO `alternatif_nilais` VALUES ('22', '3', '1', '1', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('23', '3', '2', '5', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('24', '3', '3', '9', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('25', '3', '4', '13', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('26', '3', '5', '17', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('27', '3', '6', '21', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('28', '3', '7', '28', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('29', '3', '8', '29', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('30', '3', '9', '33', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('31', '3', '10', '37', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('32', '3', '11', '43', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('33', '3', '12', '45', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('34', '3', '13', '49', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('35', '3', '14', '53', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('36', '3', '15', '58', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('37', '3', '16', '64', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('38', '3', '17', '65', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('39', '3', '18', '69', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('40', '3', '19', '73', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('41', '3', '20', '77', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);
INSERT INTO `alternatif_nilais` VALUES ('42', '3', '21', '81', '2022-06-18 17:14:25', '2022-06-18 17:14:25', null);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for kriterias
-- ----------------------------
DROP TABLE IF EXISTS `kriterias`;
CREATE TABLE `kriterias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alternatif_id` int(10) unsigned DEFAULT NULL,
  `kriteria_nama` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria_atribut` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kriteria_bobot` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kriterias_alternatif_id_foreign` (`alternatif_id`),
  CONSTRAINT `kriterias_alternatif_id_foreign` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kriterias
-- ----------------------------
INSERT INTO `kriterias` VALUES ('1', '2', 'Kibas-kibas atau kesemutan', 'benefit', '3', '2021-08-10 23:27:02', '2022-06-18 14:50:08', null);
INSERT INTO `kriterias` VALUES ('2', '3', 'Perasaan panas', 'benefit', '5.25', '2021-08-10 23:27:20', '2022-06-18 14:50:24', null);
INSERT INTO `kriterias` VALUES ('3', '2', 'Lemas atau goyah pada kaki', 'benefit', '3', '2021-08-10 23:27:33', '2022-06-18 14:51:32', null);
INSERT INTO `kriterias` VALUES ('4', '1', 'Sulit untuk rileks', 'benefit', '3.5', '2021-08-10 23:27:44', '2021-08-10 23:42:18', null);
INSERT INTO `kriterias` VALUES ('5', '1', 'Takut sesuatu yang buruk akan terjadi', 'benefit', '3.5', '2021-08-10 23:27:54', '2021-08-10 23:42:20', null);
INSERT INTO `kriterias` VALUES ('6', '2', 'Pusing atau kepala terasa berat', 'benefit', '3', '2021-08-10 23:28:04', '2022-06-18 14:52:18', null);
INSERT INTO `kriterias` VALUES ('7', '4', 'Jantung berdebar-debar kencang ', 'benefit', '5.25', '2021-08-10 23:28:41', '2022-06-18 14:52:48', null);
INSERT INTO `kriterias` VALUES ('8', '2', 'Goyah atau tidak tahan berdiri', 'benefit', '3', '2021-08-10 23:28:50', '2021-08-10 23:42:53', null);
INSERT INTO `kriterias` VALUES ('9', '1', 'Merasa ketakutan', 'benefit', '3.5', '2021-08-10 23:29:05', '2022-06-18 14:53:23', null);
INSERT INTO `kriterias` VALUES ('10', '1', 'Merasa gugup', 'benefit', '3.5', '2021-08-10 23:29:16', '2022-06-18 14:53:43', null);
INSERT INTO `kriterias` VALUES ('11', '4', 'Perasaan tercekik atau tersedak', 'benefit', '5.25', '2021-08-10 23:29:25', '2022-06-18 14:53:51', null);
INSERT INTO `kriterias` VALUES ('12', '2', 'Tangan gemetaran', 'benefit', '3', '2021-08-10 23:29:35', '2021-08-10 23:43:04', null);
INSERT INTO `kriterias` VALUES ('13', '2', 'Badan gemetar atau goyah', 'benefit', '3', '2021-08-10 23:29:47', '2021-08-10 23:43:07', null);
INSERT INTO `kriterias` VALUES ('14', '1', 'Takut hilang kendali', 'benefit', '3.5', '2021-08-10 23:30:14', '2022-06-18 14:54:26', null);
INSERT INTO `kriterias` VALUES ('15', '4', 'Kesulitan bernafas', 'benefit', '5.25', '2021-08-10 23:30:24', '2022-06-18 14:54:37', null);
INSERT INTO `kriterias` VALUES ('16', '4', 'Takut akan sekarat (kematian)', 'benefit', '5.25', '2021-08-10 23:30:38', '2022-06-18 14:54:48', null);
INSERT INTO `kriterias` VALUES ('17', '1', 'Ciut mental ', 'benefit', '3.5', '2021-08-10 23:30:46', '2022-06-18 14:55:06', null);
INSERT INTO `kriterias` VALUES ('18', '3', 'Pencernaan atau perut terganggu', 'benefit', '5.25', '2021-08-10 23:30:55', '2022-06-18 14:55:16', null);
INSERT INTO `kriterias` VALUES ('19', '2', 'Pingsan atau perasaan mau pingsan', 'benefit', '3', '2021-08-10 23:31:05', '2022-06-18 14:55:30', null);
INSERT INTO `kriterias` VALUES ('20', '3', 'Wajah merona memerah', 'benefit', '5.25', '2021-08-10 23:31:14', '2022-06-18 14:55:37', null);
INSERT INTO `kriterias` VALUES ('21', '3', 'Keringat panas atau dingin', 'benefit', '5.25', '2021-08-10 23:31:23', '2022-06-18 14:55:45', null);

-- ----------------------------
-- Table structure for kriteria_nilais
-- ----------------------------
DROP TABLE IF EXISTS `kriteria_nilais`;
CREATE TABLE `kriteria_nilais` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kriteria_id` int(10) unsigned DEFAULT NULL,
  `kn_keterangan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kn_nilai` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kriteria_nilais_kriteria_id_foreign` (`kriteria_id`),
  CONSTRAINT `kriteria_nilais_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of kriteria_nilais
-- ----------------------------
INSERT INTO `kriteria_nilais` VALUES ('1', '1', 'Tidak sama sekali.', '0', '2021-08-10 23:46:59', '2021-08-10 23:49:38', null);
INSERT INTO `kriteria_nilais` VALUES ('2', '1', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:49:25', '2021-08-10 16:49:25', null);
INSERT INTO `kriteria_nilais` VALUES ('3', '1', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:49:53', '2021-08-10 16:49:53', null);
INSERT INTO `kriteria_nilais` VALUES ('4', '1', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:50:02', '2021-08-10 16:50:02', null);
INSERT INTO `kriteria_nilais` VALUES ('5', '2', 'Tidak sama sekali.', '0', '2021-08-10 16:50:20', '2021-08-10 16:50:20', null);
INSERT INTO `kriteria_nilais` VALUES ('6', '2', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:50:52', '2021-08-10 23:51:37', null);
INSERT INTO `kriteria_nilais` VALUES ('7', '2', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:51:02', '2021-08-10 16:51:02', null);
INSERT INTO `kriteria_nilais` VALUES ('8', '2', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:51:11', '2021-08-10 23:51:40', null);
INSERT INTO `kriteria_nilais` VALUES ('9', '3', 'Tidak sama sekali.', '0', '2021-08-10 16:51:57', '2021-08-10 16:51:57', null);
INSERT INTO `kriteria_nilais` VALUES ('10', '3', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:52:11', '2021-08-10 16:52:11', null);
INSERT INTO `kriteria_nilais` VALUES ('11', '3', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:52:20', '2021-08-10 16:52:20', null);
INSERT INTO `kriteria_nilais` VALUES ('12', '3', 'Sedang: kadang - kadang saya tidak nyaman', '3', '2021-08-10 16:52:29', '2021-08-10 16:52:29', null);
INSERT INTO `kriteria_nilais` VALUES ('13', '4', 'Tidak sama sekali.', '0', '2021-08-10 16:53:00', '2021-08-10 16:53:00', null);
INSERT INTO `kriteria_nilais` VALUES ('14', '4', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:53:14', '2021-08-10 16:53:14', null);
INSERT INTO `kriteria_nilais` VALUES ('15', '4', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:53:26', '2021-08-10 16:53:26', null);
INSERT INTO `kriteria_nilais` VALUES ('16', '4', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:53:34', '2021-08-10 16:53:34', null);
INSERT INTO `kriteria_nilais` VALUES ('17', '5', 'Tidak sama sekali.', '0', '2021-08-10 16:54:22', '2021-08-10 16:54:22', null);
INSERT INTO `kriteria_nilais` VALUES ('18', '5', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:54:34', '2021-08-10 16:54:34', null);
INSERT INTO `kriteria_nilais` VALUES ('19', '5', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:54:45', '2021-08-10 16:54:45', null);
INSERT INTO `kriteria_nilais` VALUES ('20', '5', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:54:56', '2021-08-10 16:54:56', null);
INSERT INTO `kriteria_nilais` VALUES ('21', '6', 'Tidak sama sekali', '0', '2021-08-10 16:55:19', '2021-08-10 16:55:19', null);
INSERT INTO `kriteria_nilais` VALUES ('22', '6', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:55:31', '2021-08-10 16:55:31', null);
INSERT INTO `kriteria_nilais` VALUES ('23', '6', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:55:39', '2021-08-10 16:55:39', null);
INSERT INTO `kriteria_nilais` VALUES ('24', '6', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:55:49', '2021-08-10 16:55:49', null);
INSERT INTO `kriteria_nilais` VALUES ('25', '7', 'Tidak sama sekali.', '0', '2021-08-10 16:56:01', '2022-06-18 15:01:20', null);
INSERT INTO `kriteria_nilais` VALUES ('26', '7', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:56:10', '2021-08-10 16:56:10', null);
INSERT INTO `kriteria_nilais` VALUES ('27', '7', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:56:19', '2021-08-10 16:56:19', null);
INSERT INTO `kriteria_nilais` VALUES ('28', '7', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:56:29', '2021-08-10 16:56:29', null);
INSERT INTO `kriteria_nilais` VALUES ('29', '8', 'Tidak sama sekali.', '0', '2021-08-10 16:56:42', '2021-08-10 16:56:42', null);
INSERT INTO `kriteria_nilais` VALUES ('30', '8', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:56:54', '2021-08-10 16:56:54', null);
INSERT INTO `kriteria_nilais` VALUES ('31', '8', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:57:03', '2021-08-10 16:57:03', null);
INSERT INTO `kriteria_nilais` VALUES ('32', '8', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:57:11', '2021-08-10 16:57:11', null);
INSERT INTO `kriteria_nilais` VALUES ('33', '9', 'Tidak sama sekali.', '0', '2021-08-10 16:57:22', '2021-08-10 16:57:22', null);
INSERT INTO `kriteria_nilais` VALUES ('34', '9', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:57:31', '2021-08-10 16:57:31', null);
INSERT INTO `kriteria_nilais` VALUES ('35', '9', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:57:40', '2021-08-10 16:57:40', null);
INSERT INTO `kriteria_nilais` VALUES ('36', '9', 'Sedang: kadang - kadang saya tidak nyaman', '3', '2021-08-10 16:58:09', '2021-08-10 16:58:09', null);
INSERT INTO `kriteria_nilais` VALUES ('37', '10', 'Tidak sama sekali.', '0', '2021-08-10 16:58:19', '2021-08-10 16:58:19', null);
INSERT INTO `kriteria_nilais` VALUES ('38', '10', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:58:29', '2021-08-10 16:58:29', null);
INSERT INTO `kriteria_nilais` VALUES ('39', '10', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:58:39', '2021-08-10 16:58:39', null);
INSERT INTO `kriteria_nilais` VALUES ('40', '10', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:58:48', '2021-08-10 16:58:48', null);
INSERT INTO `kriteria_nilais` VALUES ('41', '11', 'Tidak sama sekali.', '0', '2021-08-10 16:59:16', '2021-08-10 16:59:16', null);
INSERT INTO `kriteria_nilais` VALUES ('42', '11', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:59:25', '2021-08-10 16:59:25', null);
INSERT INTO `kriteria_nilais` VALUES ('43', '11', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:59:33', '2021-08-10 16:59:33', null);
INSERT INTO `kriteria_nilais` VALUES ('44', '11', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:59:41', '2021-08-10 16:59:41', null);
INSERT INTO `kriteria_nilais` VALUES ('45', '12', 'Tidak sama sekali.', '0', '2021-08-10 17:00:00', '2021-08-10 17:00:00', null);
INSERT INTO `kriteria_nilais` VALUES ('46', '12', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:00:09', '2021-08-10 17:00:09', null);
INSERT INTO `kriteria_nilais` VALUES ('47', '12', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:00:21', '2021-08-10 17:00:21', null);
INSERT INTO `kriteria_nilais` VALUES ('48', '12', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:00:31', '2021-08-10 17:00:31', null);
INSERT INTO `kriteria_nilais` VALUES ('49', '13', 'Tidak sama sekali.', '0', '2021-08-10 17:01:11', '2021-08-10 17:01:11', null);
INSERT INTO `kriteria_nilais` VALUES ('50', '13', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:01:19', '2021-08-10 17:01:19', null);
INSERT INTO `kriteria_nilais` VALUES ('51', '13', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:01:26', '2021-08-10 17:01:26', null);
INSERT INTO `kriteria_nilais` VALUES ('52', '13', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:01:34', '2021-08-10 17:01:34', null);
INSERT INTO `kriteria_nilais` VALUES ('53', '14', 'Tidak sama sekali.', '0', '2021-08-10 17:01:50', '2021-08-10 17:01:50', null);
INSERT INTO `kriteria_nilais` VALUES ('54', '14', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:01:58', '2021-08-10 17:01:58', null);
INSERT INTO `kriteria_nilais` VALUES ('55', '14', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:02:09', '2021-08-10 17:02:09', null);
INSERT INTO `kriteria_nilais` VALUES ('56', '14', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:02:17', '2021-08-10 17:02:17', null);
INSERT INTO `kriteria_nilais` VALUES ('57', '15', 'Tidak sama sekali.', '0', '2021-08-10 17:02:41', '2021-08-10 17:02:41', null);
INSERT INTO `kriteria_nilais` VALUES ('58', '15', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:02:56', '2021-08-10 17:02:56', null);
INSERT INTO `kriteria_nilais` VALUES ('59', '15', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:03:04', '2021-08-10 17:03:04', null);
INSERT INTO `kriteria_nilais` VALUES ('60', '15', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:03:12', '2021-08-10 17:03:12', null);
INSERT INTO `kriteria_nilais` VALUES ('61', '16', 'Tidak sama sekali.', '0', '2021-08-10 17:03:36', '2021-08-10 17:03:36', null);
INSERT INTO `kriteria_nilais` VALUES ('62', '16', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:03:44', '2021-08-10 17:03:44', null);
INSERT INTO `kriteria_nilais` VALUES ('63', '16', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:03:52', '2021-08-10 17:03:52', null);
INSERT INTO `kriteria_nilais` VALUES ('64', '16', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:04:00', '2021-08-10 17:04:00', null);
INSERT INTO `kriteria_nilais` VALUES ('65', '17', 'Tidak sama sekali.', '0', '2021-08-10 17:04:10', '2021-08-10 17:04:10', null);
INSERT INTO `kriteria_nilais` VALUES ('66', '17', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:04:19', '2021-08-10 17:04:19', null);
INSERT INTO `kriteria_nilais` VALUES ('67', '17', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:04:28', '2021-08-10 17:04:28', null);
INSERT INTO `kriteria_nilais` VALUES ('68', '17', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:04:37', '2021-08-10 17:04:37', null);
INSERT INTO `kriteria_nilais` VALUES ('69', '18', 'Tidak sama sekali.', '0', '2021-08-10 17:04:48', '2021-08-10 17:04:48', null);
INSERT INTO `kriteria_nilais` VALUES ('70', '18', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:04:57', '2021-08-10 17:04:57', null);
INSERT INTO `kriteria_nilais` VALUES ('71', '18', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:05:07', '2021-08-10 17:05:07', null);
INSERT INTO `kriteria_nilais` VALUES ('72', '18', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:05:16', '2021-08-10 17:05:16', null);
INSERT INTO `kriteria_nilais` VALUES ('73', '19', 'Tidak sama sekali.', '0', '2021-08-10 17:06:14', '2021-08-10 17:06:14', null);
INSERT INTO `kriteria_nilais` VALUES ('74', '19', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:06:24', '2021-08-10 17:06:24', null);
INSERT INTO `kriteria_nilais` VALUES ('75', '19', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:06:34', '2021-08-10 17:06:34', null);
INSERT INTO `kriteria_nilais` VALUES ('76', '19', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:06:43', '2021-08-10 17:06:43', null);
INSERT INTO `kriteria_nilais` VALUES ('77', '20', 'Tidak sama sekali.', '0', '2021-08-10 17:06:55', '2021-08-10 17:06:55', null);
INSERT INTO `kriteria_nilais` VALUES ('78', '20', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:07:04', '2021-08-10 17:07:04', null);
INSERT INTO `kriteria_nilais` VALUES ('79', '20', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:07:14', '2021-08-10 17:07:14', null);
INSERT INTO `kriteria_nilais` VALUES ('80', '20', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:07:23', '2021-08-10 17:07:23', null);
INSERT INTO `kriteria_nilais` VALUES ('81', '21', 'Tidak sama sekali.', '0', '2021-08-10 17:07:40', '2021-08-10 17:07:40', null);
INSERT INTO `kriteria_nilais` VALUES ('82', '21', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:07:50', '2021-08-10 17:07:50', null);
INSERT INTO `kriteria_nilais` VALUES ('83', '21', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:08:05', '2021-08-10 17:08:05', null);
INSERT INTO `kriteria_nilais` VALUES ('84', '21', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:08:12', '2021-08-10 17:08:12', null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('4', '2021_05_02_154219_create_kriterias_table', '1');
INSERT INTO `migrations` VALUES ('5', '2021_05_02_154459_create_kriteria_nilais_table', '1');
INSERT INTO `migrations` VALUES ('6', '2021_05_02_170637_remove_foreign_nilai_kriteria_id_to_alternatif_nilai_table', '1');
INSERT INTO `migrations` VALUES ('7', '2021_06_25_083004_add_is_role_to_users_table', '1');
INSERT INTO `migrations` VALUES ('8', '2021_06_30_110450_add_user_id_to_kriterias_table', '1');
INSERT INTO `migrations` VALUES ('9', '2021_06_30_205341_add_user_id_to_kriteria_nilais_table', '1');
INSERT INTO `migrations` VALUES ('10', '2021_07_12_051955_add_field_to_alternatifs_table', '1');
INSERT INTO `migrations` VALUES ('11', '2021_07_21_041858_drop_user_id_to_kriteria_nilais_table', '1');
INSERT INTO `migrations` VALUES ('12', '2021_07_21_042126_drop_user_id_to_kriterias_table', '1');
INSERT INTO `migrations` VALUES ('13', '2021_08_10_161449_remove_field_alternatifs_table', '2');
INSERT INTO `migrations` VALUES ('14', '2021_08_10_161651_add_kode_to_alternatifs_table', '3');
INSERT INTO `migrations` VALUES ('15', '2021_08_10_163616_change_data_type_kriteria_nilai_to_kriterias_table', '4');
INSERT INTO `migrations` VALUES ('18', '2021_08_10_163945_add_alternatif_id_to_alternatifs_table', '5');
INSERT INTO `migrations` VALUES ('19', '2021_08_15_215621_rename_field_to_users_table', '6');
INSERT INTO `migrations` VALUES ('20', '2021_08_15_215934_drop_alternatif_id_to_alternatif_nilais_table', '6');
INSERT INTO `migrations` VALUES ('21', '2021_11_22_160016_alter_table_alternatif_nilais_foreign_key', '6');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `umur` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Administrator', 'admin@gmail.com', null, '$2y$10$xa7i8HbrckennHosP1R6WOQWAa2veigQu1jpQzYuAQ8KEorD2Lvhi', null, '1', null, null);
INSERT INTO `users` VALUES ('2', 'John', 'johndo@test.com', null, '', null, '24', '2022-06-18 08:02:22', '2022-06-18 08:02:22');
INSERT INTO `users` VALUES ('3', 'He', 'he@mail.com', null, '', null, '25', '2022-06-18 10:14:25', '2022-06-18 10:14:25');
SET FOREIGN_KEY_CHECKS=1;
