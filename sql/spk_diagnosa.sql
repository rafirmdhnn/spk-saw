/*
Navicat MySQL Data Transfer

Source Server         : XAMPP
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : spk_diagnosa_new

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2022-05-20 22:31:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for alternatif_nilais
-- ----------------------------
DROP TABLE IF EXISTS `alternatif_nilais`;
CREATE TABLE `alternatif_nilais` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`alternatif_id`  int(10) UNSIGNED NULL DEFAULT NULL ,
`kriteria_id`  int(10) UNSIGNED NULL DEFAULT NULL ,
`nilai_kriteria_id`  int(10) UNSIGNED NULL DEFAULT NULL ,
`created_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`updated_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`deleted_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
INDEX `alternatif_nilais_alternatif_id_foreign` (`alternatif_id`) USING BTREE ,
INDEX `alternatif_nilais_kriteria_id_foreign` (`kriteria_id`) USING BTREE ,
INDEX `alternatif_nilais_nilai_kriteria_id_foreign` (`nilai_kriteria_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of alternatif_nilais
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for alternatifs
-- ----------------------------
DROP TABLE IF EXISTS `alternatifs`;
CREATE TABLE `alternatifs` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`alternatif_kode`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`alternatif_nama`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`created_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`updated_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`deleted_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=5

;

-- ----------------------------
-- Records of alternatifs
-- ----------------------------
BEGIN;
INSERT INTO `alternatifs` VALUES ('1', 'A1', 'Subjective', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null), ('2', 'A2', 'Neurophysiology', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null), ('3', 'A3', 'Autonomic', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null), ('4', 'A4', 'Panic related', '2021-08-10 23:18:54', '2021-08-10 23:18:54', null);
COMMIT;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
`id`  bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
`connection`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`queue`  text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`payload`  longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`exception`  longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`failed_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for kriteria_nilais
-- ----------------------------
DROP TABLE IF EXISTS `kriteria_nilais`;
CREATE TABLE `kriteria_nilais` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`kriteria_id`  int(10) UNSIGNED NULL DEFAULT NULL ,
`kn_keterangan`  varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`kn_nilai`  int(11) NULL DEFAULT NULL ,
`created_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`updated_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`deleted_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
INDEX `kriteria_nilais_kriteria_id_foreign` (`kriteria_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=85

;

-- ----------------------------
-- Records of kriteria_nilais
-- ----------------------------
BEGIN;
INSERT INTO `kriteria_nilais` VALUES ('1', '1', 'Tidak sama sekali.', '0', '2021-08-10 23:46:59', '2021-08-10 23:49:38', null), ('2', '1', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:49:25', '2021-08-10 16:49:25', null), ('3', '1', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:49:53', '2021-08-10 16:49:53', null), ('4', '1', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:50:02', '2021-08-10 16:50:02', null), ('5', '2', 'Tidak sama sekali.', '0', '2021-08-10 16:50:20', '2021-08-10 16:50:20', null), ('6', '2', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:50:52', '2021-08-10 23:51:37', null), ('7', '2', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:51:02', '2021-08-10 16:51:02', null), ('8', '2', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:51:11', '2021-08-10 23:51:40', null), ('9', '3', 'Tidak sama sekali.', '0', '2021-08-10 16:51:57', '2021-08-10 16:51:57', null), ('10', '3', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:52:11', '2021-08-10 16:52:11', null), ('11', '3', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:52:20', '2021-08-10 16:52:20', null), ('12', '3', 'Sedang: kadang - kadang saya tidak nyaman', '3', '2021-08-10 16:52:29', '2021-08-10 16:52:29', null), ('13', '4', 'Tidak sama sekali.', '0', '2021-08-10 16:53:00', '2021-08-10 16:53:00', null), ('14', '4', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:53:14', '2021-08-10 16:53:14', null), ('15', '4', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:53:26', '2021-08-10 16:53:26', null), ('16', '4', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:53:34', '2021-08-10 16:53:34', null), ('17', '5', 'Tidak sama sekali.', '0', '2021-08-10 16:54:22', '2021-08-10 16:54:22', null), ('18', '5', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:54:34', '2021-08-10 16:54:34', null), ('19', '5', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:54:45', '2021-08-10 16:54:45', null), ('20', '5', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:54:56', '2021-08-10 16:54:56', null), ('21', '6', 'Tidak sama sekali', '0', '2021-08-10 16:55:19', '2021-08-10 16:55:19', null), ('22', '6', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:55:31', '2021-08-10 16:55:31', null), ('23', '6', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:55:39', '2021-08-10 16:55:39', null), ('24', '6', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:55:49', '2021-08-10 16:55:49', null), ('25', '7', '0', '0', '2021-08-10 16:56:01', '2021-08-10 16:56:01', null), ('26', '7', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:56:10', '2021-08-10 16:56:10', null), ('27', '7', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:56:19', '2021-08-10 16:56:19', null), ('28', '7', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:56:29', '2021-08-10 16:56:29', null), ('29', '8', 'Tidak sama sekali.', '0', '2021-08-10 16:56:42', '2021-08-10 16:56:42', null), ('30', '8', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:56:54', '2021-08-10 16:56:54', null), ('31', '8', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:57:03', '2021-08-10 16:57:03', null), ('32', '8', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:57:11', '2021-08-10 16:57:11', null), ('33', '9', 'Tidak sama sekali.', '0', '2021-08-10 16:57:22', '2021-08-10 16:57:22', null), ('34', '9', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:57:31', '2021-08-10 16:57:31', null), ('35', '9', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:57:40', '2021-08-10 16:57:40', null), ('36', '9', 'Sedang: kadang - kadang saya tidak nyaman', '3', '2021-08-10 16:58:09', '2021-08-10 16:58:09', null), ('37', '10', 'Tidak sama sekali.', '0', '2021-08-10 16:58:19', '2021-08-10 16:58:19', null), ('38', '10', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:58:29', '2021-08-10 16:58:29', null), ('39', '10', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:58:39', '2021-08-10 16:58:39', null), ('40', '10', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:58:48', '2021-08-10 16:58:48', null), ('41', '11', 'Tidak sama sekali.', '0', '2021-08-10 16:59:16', '2021-08-10 16:59:16', null), ('42', '11', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 16:59:25', '2021-08-10 16:59:25', null), ('43', '11', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 16:59:33', '2021-08-10 16:59:33', null), ('44', '11', 'Berat: banyak menganggu saya', '3', '2021-08-10 16:59:41', '2021-08-10 16:59:41', null), ('45', '12', 'Tidak sama sekali.', '0', '2021-08-10 17:00:00', '2021-08-10 17:00:00', null), ('46', '12', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:00:09', '2021-08-10 17:00:09', null), ('47', '12', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:00:21', '2021-08-10 17:00:21', null), ('48', '12', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:00:31', '2021-08-10 17:00:31', null), ('49', '13', 'Tidak sama sekali.', '0', '2021-08-10 17:01:11', '2021-08-10 17:01:11', null), ('50', '13', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:01:19', '2021-08-10 17:01:19', null), ('51', '13', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:01:26', '2021-08-10 17:01:26', null), ('52', '13', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:01:34', '2021-08-10 17:01:34', null), ('53', '14', 'Tidak sama sekali.', '0', '2021-08-10 17:01:50', '2021-08-10 17:01:50', null), ('54', '14', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:01:58', '2021-08-10 17:01:58', null), ('55', '14', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:02:09', '2021-08-10 17:02:09', null), ('56', '14', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:02:17', '2021-08-10 17:02:17', null), ('57', '15', 'Tidak sama sekali.', '0', '2021-08-10 17:02:41', '2021-08-10 17:02:41', null), ('58', '15', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:02:56', '2021-08-10 17:02:56', null), ('59', '15', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:03:04', '2021-08-10 17:03:04', null), ('60', '15', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:03:12', '2021-08-10 17:03:12', null), ('61', '16', 'Tidak sama sekali.', '0', '2021-08-10 17:03:36', '2021-08-10 17:03:36', null), ('62', '16', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:03:44', '2021-08-10 17:03:44', null), ('63', '16', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:03:52', '2021-08-10 17:03:52', null), ('64', '16', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:04:00', '2021-08-10 17:04:00', null), ('65', '17', 'Tidak sama sekali.', '0', '2021-08-10 17:04:10', '2021-08-10 17:04:10', null), ('66', '17', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:04:19', '2021-08-10 17:04:19', null), ('67', '17', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:04:28', '2021-08-10 17:04:28', null), ('68', '17', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:04:37', '2021-08-10 17:04:37', null), ('69', '18', 'Tidak sama sekali.', '0', '2021-08-10 17:04:48', '2021-08-10 17:04:48', null), ('70', '18', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:04:57', '2021-08-10 17:04:57', null), ('71', '18', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:05:07', '2021-08-10 17:05:07', null), ('72', '18', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:05:16', '2021-08-10 17:05:16', null), ('73', '19', 'Tidak sama sekali.', '0', '2021-08-10 17:06:14', '2021-08-10 17:06:14', null), ('74', '19', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:06:24', '2021-08-10 17:06:24', null), ('75', '19', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:06:34', '2021-08-10 17:06:34', null), ('76', '19', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:06:43', '2021-08-10 17:06:43', null), ('77', '20', 'Tidak sama sekali.', '0', '2021-08-10 17:06:55', '2021-08-10 17:06:55', null), ('78', '20', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:07:04', '2021-08-10 17:07:04', null), ('79', '20', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:07:14', '2021-08-10 17:07:14', null), ('80', '20', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:07:23', '2021-08-10 17:07:23', null), ('81', '21', 'Tidak sama sekali.', '0', '2021-08-10 17:07:40', '2021-08-10 17:07:40', null), ('82', '21', 'Ringan tetapi tidak banyak menganggu saya', '1', '2021-08-10 17:07:50', '2021-08-10 17:07:50', null), ('83', '21', 'Sedang: kadang - kadang saya tidak nyaman', '2', '2021-08-10 17:08:05', '2021-08-10 17:08:05', null), ('84', '21', 'Berat: banyak menganggu saya', '3', '2021-08-10 17:08:12', '2021-08-10 17:08:12', null);
COMMIT;

-- ----------------------------
-- Table structure for kriterias
-- ----------------------------
DROP TABLE IF EXISTS `kriterias`;
CREATE TABLE `kriterias` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`alternatif_id`  int(10) UNSIGNED NULL DEFAULT NULL ,
`kriteria_nama`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`kriteria_atribut`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`kriteria_bobot`  double NULL DEFAULT NULL ,
`created_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
`updated_at`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
`deleted_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
INDEX `kriterias_alternatif_id_foreign` (`alternatif_id`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=22

;

-- ----------------------------
-- Records of kriterias
-- ----------------------------
BEGIN;
INSERT INTO `kriterias` VALUES ('1', '1', 'Kibas-kibas atau kesemutan', 'benefit', '3.5', '2021-08-10 23:27:02', '2021-08-10 23:42:09', null), ('2', '1', 'Perasaan panas', 'benefit', '3.5', '2021-08-10 23:27:20', '2021-08-10 23:42:12', null), ('3', '1', 'Lemas atau goyah pada kaki', 'benefit', '3.5', '2021-08-10 23:27:33', '2021-08-10 23:42:15', null), ('4', '1', 'Sulit untuk rileks', 'benefit', '3.5', '2021-08-10 23:27:44', '2021-08-10 23:42:18', null), ('5', '1', 'Takut sesuatu yang buruk akan terjadi', 'benefit', '3.5', '2021-08-10 23:27:54', '2021-08-10 23:42:20', null), ('6', '1', 'Pusing atau kepala terasa berat', 'benefit', '3.5', '2021-08-10 23:28:04', '2021-08-10 23:42:23', null), ('7', '2', 'Jantung berdebar-debar kencang ', 'benefit', '3', '2021-08-10 23:28:41', '2021-08-10 23:42:50', null), ('8', '2', 'Goyah atau tidak tahan berdiri', 'benefit', '3', '2021-08-10 23:28:50', '2021-08-10 23:42:53', null), ('9', '2', 'Merasa ketakutan', 'benefit', '3', '2021-08-10 23:29:05', '2021-08-10 23:42:55', null), ('10', '2', 'Merasa gugup', 'benefit', '3', '2021-08-10 23:29:16', '2021-08-10 23:42:58', null), ('11', '2', 'Perasaan tercekik atau tersedak', 'benefit', '3', '2021-08-10 23:29:25', '2021-08-10 23:43:01', null), ('12', '2', 'Tangan gemetaran', 'benefit', '3', '2021-08-10 23:29:35', '2021-08-10 23:43:04', null), ('13', '2', 'Badan gemetar atau goyah', 'benefit', '3', '2021-08-10 23:29:47', '2021-08-10 23:43:07', null), ('14', '3', 'Takut hilang kendali', 'benefit', '5.25', '2021-08-10 23:30:14', '2021-08-10 23:43:16', null), ('15', '3', 'Kesulitan bernafas', 'benefit', '5.25', '2021-08-10 23:30:24', '2021-08-10 23:43:19', null), ('16', '3', 'Takut akan sekarat (kematian)', 'benefit', '5.25', '2021-08-10 23:30:38', '2021-08-10 23:43:21', null), ('17', '3', 'Ciut mental ', 'benefit', '5.25', '2021-08-10 23:30:46', '2021-08-10 23:43:25', null), ('18', '4', 'Pencernaan atau perut terganggu', 'benefit', '5.25', '2021-08-10 23:30:55', '2021-08-10 23:43:29', null), ('19', '4', 'Pingsan atau perasaan mau pingsan', 'benefit', '5.25', '2021-08-10 23:31:05', '2021-08-10 23:43:32', null), ('20', '4', 'Wajah merona memerah', 'benefit', '5.25', '2021-08-10 23:31:14', '2021-08-10 23:43:34', null), ('21', '4', 'Keringat panas atau dingin', 'benefit', '5.25', '2021-08-10 23:31:23', '2021-08-10 23:43:39', null);
COMMIT;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
`id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`migration`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`batch`  int(11) NOT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=19

;

-- ----------------------------
-- Records of migrations
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1'), ('2', '2014_10_12_100000_create_password_resets_table', '1'), ('3', '2019_08_19_000000_create_failed_jobs_table', '1'), ('4', '2021_05_02_154219_create_kriterias_table', '1'), ('5', '2021_05_02_154459_create_kriteria_nilais_table', '1'), ('6', '2021_05_02_170637_remove_foreign_nilai_kriteria_id_to_alternatif_nilai_table', '1'), ('7', '2021_06_25_083004_add_is_role_to_users_table', '1'), ('8', '2021_06_30_110450_add_user_id_to_kriterias_table', '1'), ('9', '2021_06_30_205341_add_user_id_to_kriteria_nilais_table', '1'), ('10', '2021_07_12_051955_add_field_to_alternatifs_table', '1'), ('11', '2021_07_21_041858_drop_user_id_to_kriteria_nilais_table', '1'), ('12', '2021_07_21_042126_drop_user_id_to_kriterias_table', '1'), ('13', '2021_08_10_161449_remove_field_alternatifs_table', '2'), ('14', '2021_08_10_161651_add_kode_to_alternatifs_table', '3'), ('15', '2021_08_10_163616_change_data_type_kriteria_nilai_to_kriterias_table', '4'), ('18', '2021_08_10_163945_add_alternatif_id_to_alternatifs_table', '5');
COMMIT;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
`email`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`token`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
INDEX `password_resets_email_index` (`email`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci

;

-- ----------------------------
-- Records of password_resets
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
`id`  bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`email`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`email_verified_at`  timestamp NULL DEFAULT NULL ,
`password`  varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL ,
`remember_token`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,
`is_role`  tinyint(4) NULL DEFAULT NULL ,
`created_at`  timestamp NULL DEFAULT NULL ,
`updated_at`  timestamp NULL DEFAULT NULL ,
PRIMARY KEY (`id`),
UNIQUE INDEX `users_email_unique` (`email`) USING BTREE 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_unicode_ci
AUTO_INCREMENT=2

;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'Administrator', 'admin@gmail.com', null, '$2y$10$xa7i8HbrckennHosP1R6WOQWAa2veigQu1jpQzYuAQ8KEorD2Lvhi', null, '1', null, null);
COMMIT;

-- ----------------------------
-- Auto increment value for alternatif_nilais
-- ----------------------------
ALTER TABLE `alternatif_nilais` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for alternatifs
-- ----------------------------
ALTER TABLE `alternatifs` AUTO_INCREMENT=5;

-- ----------------------------
-- Auto increment value for failed_jobs
-- ----------------------------
ALTER TABLE `failed_jobs` AUTO_INCREMENT=1;

-- ----------------------------
-- Auto increment value for kriteria_nilais
-- ----------------------------
ALTER TABLE `kriteria_nilais` AUTO_INCREMENT=85;

-- ----------------------------
-- Auto increment value for kriterias
-- ----------------------------
ALTER TABLE `kriterias` AUTO_INCREMENT=22;

-- ----------------------------
-- Auto increment value for migrations
-- ----------------------------
ALTER TABLE `migrations` AUTO_INCREMENT=19;

-- ----------------------------
-- Auto increment value for users
-- ----------------------------
ALTER TABLE `users` AUTO_INCREMENT=2;
SET FOREIGN_KEY_CHECKS=1;
