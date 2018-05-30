/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100130
 Source Host           : localhost:3306
 Source Schema         : smt4

 Target Server Type    : MySQL
 Target Server Version : 100130
 File Encoding         : 65001

 Date: 30/05/2018 21:04:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester_id` int(255) NULL DEFAULT NULL,
  `jurusan_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `isAdmin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------
INSERT INTO `mahasiswa` VALUES (1, 'rahmad', '121', 'rahmadumarta@gmail.com', '$2y$10$dWbo2ZHuAk6t372cLlSws.hGkib4GFASff8RpgMzBcktNTKSB2ryG', 4, 1, NULL, NULL, '0');
INSERT INTO `mahasiswa` VALUES (3, 'nakal', '131313', 'obih@bibih.com', '$2y$10$dWbo2ZHuAk6t372cLlSws.hGkib4GFASff8RpgMzBcktNTKSB2ryG', 5, 1, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2018_05_22_090633_users', 1);
INSERT INTO `migrations` VALUES (2, '2018_05_22_090716_jurusan', 1);
INSERT INTO `migrations` VALUES (3, '2018_05_22_090735_mahasiswa', 1);
INSERT INTO `migrations` VALUES (4, '2018_05_22_090749_nilai', 1);
INSERT INTO `migrations` VALUES (5, '2018_05_22_090802_pelajaran', 1);
INSERT INTO `migrations` VALUES (6, '2018_05_22_090816_semester', 1);

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tugas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `formatif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelajaran_id` int(11) NOT NULL,
  `mahasiswa_id` int(11) NOT NULL,
  `semester_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of nilai
-- ----------------------------
INSERT INTO `nilai` VALUES (1, '30', '44', '40', '100', 1, 1, 4, NULL, NULL);
INSERT INTO `nilai` VALUES (2, '100', '100', '100', '100', 3, 1, 1, '2018-05-30 07:12:57', '2018-05-30 07:12:57');
INSERT INTO `nilai` VALUES (3, '90', '98', '80', '70', 2, 1, 1, '2018-05-30 07:14:49', '2018-05-30 07:14:49');
INSERT INTO `nilai` VALUES (4, '90', '98', '80', '70', 1, 1, 1, '2018-05-30 07:14:56', '2018-05-30 07:14:56');
INSERT INTO `nilai` VALUES (5, '100', '100', '50', '80', 2, 1, 4, '2018-05-30 07:19:21', '2018-05-30 07:19:21');
INSERT INTO `nilai` VALUES (6, '100', '100', '100', '100', 3, 3, 4, '2018-05-30 14:00:14', '2018-05-30 14:00:14');

-- ----------------------------
-- Table structure for pelajaran
-- ----------------------------
DROP TABLE IF EXISTS `pelajaran`;
CREATE TABLE `pelajaran`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sks` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of pelajaran
-- ----------------------------
INSERT INTO `pelajaran` VALUES (1, 'Mekanisme Quantum', '4', NULL, NULL);
INSERT INTO `pelajaran` VALUES (2, 'Fisika Quantum', '4', NULL, NULL);
INSERT INTO `pelajaran` VALUES (3, 'Anstronomi', '4', NULL, NULL);

-- ----------------------------
-- Table structure for semester
-- ----------------------------
DROP TABLE IF EXISTS `semester`;
CREATE TABLE `semester`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of semester
-- ----------------------------
INSERT INTO `semester` VALUES (1, 'Semester 1', NULL, NULL);
INSERT INTO `semester` VALUES (2, 'Semester 2', NULL, NULL);
INSERT INTO `semester` VALUES (3, 'Semester 3', NULL, NULL);
INSERT INTO `semester` VALUES (4, 'Semester 4', NULL, NULL);
INSERT INTO `semester` VALUES (5, 'Semester 5', NULL, NULL);
INSERT INTO `semester` VALUES (6, 'Semester 6', NULL, NULL);
INSERT INTO `semester` VALUES (7, 'Semester 7', NULL, NULL);
INSERT INTO `semester` VALUES (8, 'Semester 8', NULL, NULL);
INSERT INTO `semester` VALUES (9, 'Semester 9', NULL, NULL);
INSERT INTO `semester` VALUES (10, 'Semester 10', NULL, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `isAdmin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'rahmad', 'rahmadumarta@gmail.com', '$2y$10$dWbo2ZHuAk6t372cLlSws.hGkib4GFASff8RpgMzBcktNTKSB2ryG', 'NT8cbsno08S5b0p3Dye2JhlDLsRrCkXhZJ7dKkqkMsGQ502eL7YeWy9bKJrZ', '2018-05-15 00:31:35', '2018-05-15 00:31:35', '0');
INSERT INTO `users` VALUES (3, 'obih', 'obih@o.o', '$2y$10$dWbo2ZHuAk6t372cLlSws.hGkib4GFASff8RpgMzBcktNTKSB2ryG', 'VP2EiRG8zNNyWKjUC54uBgk9wz4hWyyLsjCmvNeAYqtafIppWASWDkXV5KFI', '2018-05-15 00:31:35', '2018-05-15 00:31:35', '1');

SET FOREIGN_KEY_CHECKS = 1;
