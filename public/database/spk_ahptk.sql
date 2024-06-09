/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : spk_ahptk

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 09/06/2024 16:17:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for absensi
-- ----------------------------
DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_absensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan_absensi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `users_id` int NOT NULL,
  `tanggal_absensi` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of absensi
-- ----------------------------
INSERT INTO `absensi` VALUES (3, 'sakit', 'Sakit Gigi', 7, '2024-05-25 11:42:00');
INSERT INTO `absensi` VALUES (4, 'izin', 'Izin menikah', 7, '2024-05-25 11:42:00');
INSERT INTO `absensi` VALUES (5, 'perjalanan dinas', 'Perjalanan membawamu', 7, '2024-05-25 18:00:00');
INSERT INTO `absensi` VALUES (6, 'keperluan agama', 'Mau taubat', 7, '2024-05-28 23:00:00');
INSERT INTO `absensi` VALUES (7, 'sakit', 'Keterangan izin sakit bos ku', 7, '2024-05-25 11:45:00');
INSERT INTO `absensi` VALUES (8, 'izin', 'Izin untuk holiday bosku', 7, '2024-05-25 11:46:00');
INSERT INTO `absensi` VALUES (9, 'libur resmi', 'Keterangan untuk libur resmi bosku', 7, '2024-05-25 11:46:00');
INSERT INTO `absensi` VALUES (10, 'libur resmi', 'Keterangan libur resmi', 7, '2024-05-25 11:46:00');
INSERT INTO `absensi` VALUES (11, 'tanpa keterangan', 'Keterangan tanpa keterangan 1x', 7, '2024-05-25 11:47:00');
INSERT INTO `absensi` VALUES (12, 'tanpa keterangan', 'Keterangan tanpa keterangan 2x', 7, '2024-05-25 11:47:00');
INSERT INTO `absensi` VALUES (13, 'tanpa keterangan', 'Keterangan tanpa keterangan 3x', 7, '2024-05-25 11:47:00');

-- ----------------------------
-- Table structure for hasil_akhir
-- ----------------------------
DROP TABLE IF EXISTS `hasil_akhir`;
CREATE TABLE `hasil_akhir`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `hasil_akhir` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hasil_akhir
-- ----------------------------
INSERT INTO `hasil_akhir` VALUES (1, '{\"bobot_alternatif\":{\"7\":{\"6\":0.3452205882352941,\"7\":0.3555154522896459,\"8\":0.4373792270531401,\"12\":0.2661401098901099,\"13\":0.3873376623376623,\"14\":0.23967760180995473},\"8\":{\"6\":0.3452205882352941,\"7\":0.3939769907511843,\"8\":0.28118961352657,\"12\":0.3238324175824176,\"13\":0.2748376623376623,\"14\":0.35986990950226244},\"9\":{\"6\":0.21011029411764703,\"7\":0.1616286938867584,\"8\":0.156219806763285,\"12\":0.3238324175824176,\"13\":0.19813311688311688,\"14\":0.2580599547511312},\"10\":{\"6\":0.09944852941176469,\"7\":0.08887886307241147,\"8\":0.12521135265700484,\"12\":0.08619505494505494,\"13\":0.13969155844155845,\"14\":0.14239253393665158}},\"bobot_akhir\":{\"7\":{\"6\":0.1017739634331129,\"7\":0.10480897685213397,\"8\":0.0786727480999683,\"12\":0.02993470394199455,\"13\":0.027558542691307895,\"14\":0.011237059274986387},\"8\":{\"6\":0.1017739634331129,\"7\":0.11614776527427155,\"8\":0.05057844146451779,\"12\":0.03642377524813015,\"13\":0.01955432220301101,\"14\":0.0168721627462185},\"9\":{\"6\":0.06194230042814059,\"7\":0.047649512636138314,\"8\":0.028099737585892307,\"12\":0.03642377524813015,\"13\":0.014096899142808587,\"14\":0.01209889862941012},\"10\":{\"6\":0.0293182716812109,\"7\":0.026202244213033493,\"8\":0.022522151482159917,\"12\":0.009694981534762106,\"13\":0.009938862525511504,\"14\":0.00667594023003616}},\"hasil_bobot\":{\"7\":0.353985994293504,\"8\":0.34135043036926194,\"9\":0.20031112367052006,\"10\":0.10435245166671407},\"ranking\":{\"7\":0.353985994293504,\"8\":0.34135043036926194,\"9\":0.20031112367052006,\"10\":0.10435245166671407}}');

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `users_id` int NOT NULL,
  `tingkat_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (4, 'Kelas B', 4, 'X');
INSERT INTO `kelas` VALUES (6, 'Kelas C', 4, 'IX');
INSERT INTO `kelas` VALUES (7, 'Kelas Suka suka', 21, 'XII');

-- ----------------------------
-- Table structure for kelas_siswa
-- ----------------------------
DROP TABLE IF EXISTS `kelas_siswa`;
CREATE TABLE `kelas_siswa`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `kelas_id` int NOT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kelas_id`(`kelas_id` ASC) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  CONSTRAINT `kelas_siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kelas_siswa_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 106 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelas_siswa
-- ----------------------------
INSERT INTO `kelas_siswa` VALUES (87, 4, 7);
INSERT INTO `kelas_siswa` VALUES (92, 4, 26);
INSERT INTO `kelas_siswa` VALUES (93, 4, 27);
INSERT INTO `kelas_siswa` VALUES (94, 4, 28);
INSERT INTO `kelas_siswa` VALUES (95, 6, 25);
INSERT INTO `kelas_siswa` VALUES (96, 6, 26);
INSERT INTO `kelas_siswa` VALUES (97, 6, 27);
INSERT INTO `kelas_siswa` VALUES (98, 7, 7);
INSERT INTO `kelas_siswa` VALUES (99, 7, 8);
INSERT INTO `kelas_siswa` VALUES (100, 7, 9);
INSERT INTO `kelas_siswa` VALUES (101, 7, 10);
INSERT INTO `kelas_siswa` VALUES (102, 7, 25);
INSERT INTO `kelas_siswa` VALUES (103, 7, 26);
INSERT INTO `kelas_siswa` VALUES (104, 7, 27);
INSERT INTO `kelas_siswa` VALUES (105, 7, 28);

-- ----------------------------
-- Table structure for kriteria
-- ----------------------------
DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_kriteria` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan_kriteria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kriteria
-- ----------------------------
INSERT INTO `kriteria` VALUES (6, 'Kriteria 1', 'K001', 'Keterangan kriteria 1\r\n');
INSERT INTO `kriteria` VALUES (7, 'Kriteria 2', 'K002', 'Keterangan kriteria 2');
INSERT INTO `kriteria` VALUES (8, 'Kriteria 3', 'K003', 'Keterangan kriteria 3');
INSERT INTO `kriteria` VALUES (12, 'Kriteria 4', 'K004', 'Keterangan kriteria 4');
INSERT INTO `kriteria` VALUES (13, 'Kriteria 5', 'K005', 'Keterangan kriteria 5');
INSERT INTO `kriteria` VALUES (14, 'Kriteria 6', 'K006', 'Keterangan kriteria 6');

-- ----------------------------
-- Table structure for matapelajaran
-- ----------------------------
DROP TABLE IF EXISTS `matapelajaran`;
CREATE TABLE `matapelajaran`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_matapelajaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of matapelajaran
-- ----------------------------
INSERT INTO `matapelajaran` VALUES (2, 'Bahasa Indonesia');
INSERT INTO `matapelajaran` VALUES (3, 'Bahasa Inggris');
INSERT INTO `matapelajaran` VALUES (4, 'Matematika');
INSERT INTO `matapelajaran` VALUES (5, 'IPA');
INSERT INTO `matapelajaran` VALUES (6, 'IPS');

-- ----------------------------
-- Table structure for matriks_alternatif
-- ----------------------------
DROP TABLE IF EXISTS `matriks_alternatif`;
CREATE TABLE `matriks_alternatif`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ahp_alternatif` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `kriteria_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `kriteria_id`(`kriteria_id` ASC) USING BTREE,
  CONSTRAINT `matriks_alternatif_ibfk_1` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of matriks_alternatif
-- ----------------------------
INSERT INTO `matriks_alternatif` VALUES (7, '{\"6\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"9\":{\"7\":\"0.5\",\"8\":\"0.5\",\"9\":\"1\",\"10\":\"3\"},\"10\":{\"7\":\"0.3333333333333333\",\"8\":\"0.3333333333333333\",\"9\":\"0.3333333333333333\",\"10\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"9\":{\"7\":\"1\\/2\",\"8\":\"1\\/2\",\"9\":\"1\",\"10\":\"3\"},\"10\":{\"7\":\"1\\/3\",\"8\":\"1\\/3\",\"9\":\"1\\/3\",\"10\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.8333333333333335,\"8\":2.8333333333333335,\"9\":5.333333333333333,\"10\":10},\"normalisasi\":{\"7\":{\"7\":0.3529411764705882,\"8\":0.3529411764705882,\"9\":0.375,\"10\":0.3},\"8\":{\"7\":0.3529411764705882,\"8\":0.3529411764705882,\"9\":0.375,\"10\":0.3},\"9\":{\"7\":0.1764705882352941,\"8\":0.1764705882352941,\"9\":0.1875,\"10\":0.3},\"10\":{\"7\":0.1176470588235294,\"8\":0.1176470588235294,\"9\":0.0625,\"10\":0.1}},\"row_normalisasi\":{\"7\":1.3808823529411764,\"8\":1.3808823529411764,\"9\":0.8404411764705881,\"10\":0.39779411764705874},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.3452205882352941,\"8\":0.3452205882352941,\"9\":0.21011029411764703,\"10\":0.09944852941176469},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.978125,\"8\":0.978125,\"9\":1.1205882352941174,\"10\":0.9944852941176469},\"jumlah_eigen_max\":4.071323529411765,\"ci\":0.023774509803921557,\"cr\":0.026416122004357286}}', 6);
INSERT INTO `matriks_alternatif` VALUES (8, '{\"7\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"4\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"3\",\"10\":\"4\"},\"9\":{\"7\":\"0.5\",\"8\":\"0.3333333333333333\",\"9\":\"1\",\"10\":\"2\"},\"10\":{\"7\":\"0.25\",\"8\":\"0.25\",\"9\":\"0.5\",\"10\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"4\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"9\":\"3\",\"10\":\"4\"},\"9\":{\"7\":\"1\\/2\",\"8\":\"1\\/3\",\"9\":\"1\",\"10\":\"2\"},\"10\":{\"7\":\"1\\/4\",\"8\":\"1\\/4\",\"9\":\"1\\/2\",\"10\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.75,\"8\":2.5833333333333335,\"9\":6.5,\"10\":11},\"normalisasi\":{\"7\":{\"7\":0.36363636363636365,\"8\":0.3870967741935484,\"9\":0.3076923076923077,\"10\":0.36363636363636365},\"8\":{\"7\":0.36363636363636365,\"8\":0.3870967741935484,\"9\":0.46153846153846156,\"10\":0.36363636363636365},\"9\":{\"7\":0.18181818181818182,\"8\":0.12903225806451613,\"9\":0.15384615384615385,\"10\":0.18181818181818182},\"10\":{\"7\":0.09090909090909091,\"8\":0.0967741935483871,\"9\":0.07692307692307693,\"10\":0.09090909090909091}},\"row_normalisasi\":{\"7\":1.4220618091585835,\"8\":1.5759079630047372,\"9\":0.6465147755470336,\"10\":0.3555154522896459},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.3555154522896459,\"8\":0.3939769907511843,\"9\":0.1616286938867584,\"10\":0.08887886307241147},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.9776674937965262,\"8\":1.0177738927738929,\"9\":1.0505865102639296,\"10\":0.9776674937965262},\"jumlah_eigen_max\":4.023695390630875,\"ci\":0.007898463543625075,\"cr\":0.008776070604027861}}', 7);
INSERT INTO `matriks_alternatif` VALUES (9, '{\"8\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"9\":\"4\",\"10\":\"2\"},\"8\":{\"7\":\"0.5\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"9\":{\"7\":\"0.25\",\"8\":\"0.5\",\"9\":\"1\",\"10\":\"2\"},\"10\":{\"7\":\"0.5\",\"8\":\"0.3333333333333333\",\"9\":\"0.5\",\"10\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"9\":\"4\",\"10\":\"2\"},\"8\":{\"7\":\"1\\/2\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"9\":{\"7\":\"1\\/4\",\"8\":\"1\\/2\",\"9\":\"1\",\"10\":\"2\"},\"10\":{\"7\":\"1\\/2\",\"8\":\"1\\/3\",\"9\":\"1\\/2\",\"10\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.25,\"8\":3.8333333333333335,\"9\":7.5,\"10\":8},\"normalisasi\":{\"7\":{\"7\":0.4444444444444444,\"8\":0.5217391304347826,\"9\":0.5333333333333333,\"10\":0.25},\"8\":{\"7\":0.2222222222222222,\"8\":0.2608695652173913,\"9\":0.26666666666666666,\"10\":0.375},\"9\":{\"7\":0.1111111111111111,\"8\":0.13043478260869565,\"9\":0.13333333333333333,\"10\":0.25},\"10\":{\"7\":0.2222222222222222,\"8\":0.08695652173913043,\"9\":0.06666666666666667,\"10\":0.125}},\"row_normalisasi\":{\"7\":1.7495169082125603,\"8\":1.12475845410628,\"9\":0.62487922705314,\"10\":0.5008454106280193},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.4373792270531401,\"8\":0.28118961352657,\"9\":0.156219806763285,\"10\":0.12521135265700484},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.9841032608695652,\"8\":1.0778935185185183,\"9\":1.1716485507246375,\"10\":1.0016908212560387},\"jumlah_eigen_max\":4.2353361513687595,\"ci\":0.0784453837895865,\"cr\":0.087161537543985}}', 8);
INSERT INTO `matriks_alternatif` VALUES (10, '{\"12\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"2\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"5\"},\"9\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"5\"},\"10\":{\"7\":\"0.5\",\"8\":\"0.2\",\"9\":\"0.2\",\"10\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"2\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"5\"},\"9\":{\"7\":\"1\\/1\",\"8\":\"1\\/1\",\"9\":\"1\",\"10\":\"5\"},\"10\":{\"7\":\"1\\/2\",\"8\":\"1\\/5\",\"9\":\"1\\/5\",\"10\":\"1\"}},\"hasil_perhitungan\":{\"7\":3.5,\"8\":3.2,\"9\":3.2,\"10\":13},\"normalisasi\":{\"7\":{\"7\":0.2857142857142857,\"8\":0.3125,\"9\":0.3125,\"10\":0.15384615384615385},\"8\":{\"7\":0.2857142857142857,\"8\":0.3125,\"9\":0.3125,\"10\":0.38461538461538464},\"9\":{\"7\":0.2857142857142857,\"8\":0.3125,\"9\":0.3125,\"10\":0.38461538461538464},\"10\":{\"7\":0.14285714285714285,\"8\":0.0625,\"9\":0.0625,\"10\":0.07692307692307693}},\"row_normalisasi\":{\"7\":1.0645604395604396,\"8\":1.2953296703296704,\"9\":1.2953296703296704,\"10\":0.3447802197802198},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.2661401098901099,\"8\":0.3238324175824176,\"9\":0.3238324175824176,\"10\":0.08619505494505494},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.9314903846153846,\"8\":1.0362637362637364,\"9\":1.0362637362637364,\"10\":1.1205357142857142},\"jumlah_eigen_max\":4.124553571428572,\"ci\":0.04151785714285724,\"cr\":0.04613095238095249}}', 12);
INSERT INTO `matriks_alternatif` VALUES (11, '{\"13\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"4\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"2\"},\"9\":{\"7\":\"0.5\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\"},\"10\":{\"7\":\"0.25\",\"8\":\"0.5\",\"9\":\"1\",\"10\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"4\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"2\"},\"9\":{\"7\":\"1\\/2\",\"8\":\"1\\/1\",\"9\":\"1\",\"10\":\"1\"},\"10\":{\"7\":\"1\\/4\",\"8\":\"1\\/2\",\"9\":\"1\\/1\",\"10\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.75,\"8\":3.5,\"9\":5,\"10\":8},\"normalisasi\":{\"7\":{\"7\":0.36363636363636365,\"8\":0.2857142857142857,\"9\":0.4,\"10\":0.5},\"8\":{\"7\":0.36363636363636365,\"8\":0.2857142857142857,\"9\":0.2,\"10\":0.25},\"9\":{\"7\":0.18181818181818182,\"8\":0.2857142857142857,\"9\":0.2,\"10\":0.125},\"10\":{\"7\":0.09090909090909091,\"8\":0.14285714285714285,\"9\":0.2,\"10\":0.125}},\"row_normalisasi\":{\"7\":1.5493506493506493,\"8\":1.0993506493506493,\"9\":0.7925324675324675,\"10\":0.5587662337662338},\"jumlah_row_normalisasi\":3.9999999999999996,\"perhitungan_bobot_prioritas\":{\"7\":0.3873376623376623,\"8\":0.2748376623376623,\"9\":0.19813311688311688,\"10\":0.13969155844155845},\"jumlah_perhitungan_bobot_prioritas\":0.9999999999999999,\"eigen_max\":{\"7\":1.0651785714285713,\"8\":0.9619318181818182,\"9\":0.9906655844155844,\"10\":1.1175324675324676},\"jumlah_eigen_max\":4.135308441558442,\"ci\":0.04510281385281386,\"cr\":0.05011423761423762}}', 13);
INSERT INTO `matriks_alternatif` VALUES (12, '{\"14\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"9\":{\"7\":\"1\",\"8\":\"0.5\",\"9\":\"1\",\"10\":\"3\"},\"10\":{\"7\":\"1\",\"8\":\"0.3333333333333333\",\"9\":\"0.3333333333333333\",\"10\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"9\":\"1\",\"10\":\"1\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"9\":\"2\",\"10\":\"3\"},\"9\":{\"7\":\"1\\/1\",\"8\":\"1\\/2\",\"9\":\"1\",\"10\":\"3\"},\"10\":{\"7\":\"1\\/1\",\"8\":\"1\\/3\",\"9\":\"1\\/3\",\"10\":\"1\"}},\"hasil_perhitungan\":{\"7\":4,\"8\":2.8333333333333335,\"9\":4.333333333333333,\"10\":8},\"normalisasi\":{\"7\":{\"7\":0.25,\"8\":0.3529411764705882,\"9\":0.23076923076923078,\"10\":0.125},\"8\":{\"7\":0.25,\"8\":0.3529411764705882,\"9\":0.46153846153846156,\"10\":0.375},\"9\":{\"7\":0.25,\"8\":0.1764705882352941,\"9\":0.23076923076923078,\"10\":0.375},\"10\":{\"7\":0.25,\"8\":0.1176470588235294,\"9\":0.07692307692307693,\"10\":0.125}},\"row_normalisasi\":{\"7\":0.9587104072398189,\"8\":1.4394796380090498,\"9\":1.0322398190045248,\"10\":0.5695701357466063},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.23967760180995473,\"8\":0.35986990950226244,\"9\":0.2580599547511312,\"10\":0.14239253393665158},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.9587104072398189,\"8\":1.0196314102564104,\"9\":1.1182598039215683,\"10\":1.1391402714932126},\"jumlah_eigen_max\":4.23574189291101,\"ci\":0.07858063097033667,\"cr\":0.08731181218926297}}', 14);

-- ----------------------------
-- Table structure for matriks_kriteria
-- ----------------------------
DROP TABLE IF EXISTS `matriks_kriteria`;
CREATE TABLE `matriks_kriteria`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ahp_kriteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of matriks_kriteria
-- ----------------------------
INSERT INTO `matriks_kriteria` VALUES (3, '{\"matriks_perbandingan\":{\"6\":{\"6\":\"1\",\"7\":\"1\",\"8\":\"2\",\"12\":\"3\",\"13\":\"4\",\"14\":\"5\"},\"7\":{\"6\":\"1\",\"7\":\"1\",\"8\":\"2\",\"12\":\"3\",\"13\":\"4\",\"14\":\"5\"},\"8\":{\"6\":\"0.5\",\"7\":\"0.5\",\"8\":\"1\",\"12\":\"2\",\"13\":\"3\",\"14\":\"4\"},\"12\":{\"6\":\"0.3333333333333333\",\"7\":\"0.3333333333333333\",\"8\":\"0.5\",\"12\":\"1\",\"13\":\"2\",\"14\":\"3\"},\"13\":{\"6\":\"0.25\",\"7\":\"0.25\",\"8\":\"0.3333333333333333\",\"12\":\"0.5\",\"13\":\"1\",\"14\":\"2\"},\"14\":{\"6\":\"0.2\",\"7\":\"0.2\",\"8\":\"0.25\",\"12\":\"0.3333333333333333\",\"13\":\"0.5\",\"14\":\"1\"}},\"matriks_perbandingan_original\":{\"6\":{\"6\":\"1\",\"7\":\"1\",\"8\":\"2\",\"12\":\"3\",\"13\":\"4\",\"14\":\"5\"},\"7\":{\"6\":\"1\\/1\",\"7\":\"1\",\"8\":\"2\",\"12\":\"3\",\"13\":\"4\",\"14\":\"5\"},\"8\":{\"6\":\"1\\/2\",\"7\":\"1\\/2\",\"8\":\"1\",\"12\":\"2\",\"13\":\"3\",\"14\":\"4\"},\"12\":{\"6\":\"1\\/3\",\"7\":\"1\\/3\",\"8\":\"1\\/2\",\"12\":\"1\",\"13\":\"2\",\"14\":\"3\"},\"13\":{\"6\":\"1\\/4\",\"7\":\"1\\/4\",\"8\":\"1\\/3\",\"12\":\"1\\/2\",\"13\":\"1\",\"14\":\"2\"},\"14\":{\"6\":\"1\\/5\",\"7\":\"1\\/5\",\"8\":\"1\\/4\",\"12\":\"1\\/3\",\"13\":\"1\\/2\",\"14\":\"1\"}},\"hasil_perhitungan\":{\"6\":3.2833333333333337,\"7\":3.2833333333333337,\"8\":6.083333333333333,\"12\":9.833333333333334,\"13\":14.5,\"14\":20},\"normalisasi\":{\"6\":{\"6\":0.3045685279187817,\"7\":0.3045685279187817,\"8\":0.32876712328767127,\"12\":0.30508474576271183,\"13\":0.27586206896551724,\"14\":0.25},\"7\":{\"6\":0.3045685279187817,\"7\":0.3045685279187817,\"8\":0.32876712328767127,\"12\":0.30508474576271183,\"13\":0.27586206896551724,\"14\":0.25},\"8\":{\"6\":0.15228426395939085,\"7\":0.15228426395939085,\"8\":0.16438356164383564,\"12\":0.20338983050847456,\"13\":0.20689655172413793,\"14\":0.2},\"12\":{\"6\":0.1015228426395939,\"7\":0.1015228426395939,\"8\":0.08219178082191782,\"12\":0.10169491525423728,\"13\":0.13793103448275862,\"14\":0.15},\"13\":{\"6\":0.07614213197969542,\"7\":0.07614213197969542,\"8\":0.0547945205479452,\"12\":0.05084745762711864,\"13\":0.06896551724137931,\"14\":0.1},\"14\":{\"6\":0.06091370558375634,\"7\":0.06091370558375634,\"8\":0.04109589041095891,\"12\":0.033898305084745756,\"13\":0.034482758620689655,\"14\":0.05}},\"row_normalisasi\":{\"6\":1.768850993853464,\"7\":1.768850993853464,\"8\":1.07923847179523,\"12\":0.6748634158381016,\"13\":0.426891759375834,\"14\":0.281304365283907},\"jumlah_row_normalisasi\":6,\"perhitungan_bobot_prioritas\":{\"6\":0.2948084989755773,\"7\":0.2948084989755773,\"8\":0.17987307863253832,\"12\":0.11247723597301694,\"13\":0.071148626562639,\"14\":0.04688406088065117},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"6\":0.9679545716364789,\"7\":0.9679545716364789,\"8\":1.094227895014608,\"12\":1.1060261537346667,\"13\":1.0316550851582655,\"14\":0.9376812176130234},\"jumlah_eigen_max\":6.105499494793521,\"ci\":0.021099898958704167,\"cr\":0.01701604754734207}');

-- ----------------------------
-- Table structure for nilai
-- ----------------------------
DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `value_nilai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan_nilai` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `users_id` int NOT NULL,
  `matapelajaran_id` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  INDEX `matapelajaran_id`(`matapelajaran_id` ASC) USING BTREE,
  CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`matapelajaran_id`) REFERENCES `matapelajaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nilai
-- ----------------------------
INSERT INTO `nilai` VALUES (6, '85.34', 'Keterangan bahasa indonesia', 7, 2);
INSERT INTO `nilai` VALUES (7, '80', 'Keterangan ga da obat', 7, 3);
INSERT INTO `nilai` VALUES (8, '80.53', 'Keterangan mata peelajaran ipa\r\n', 7, 5);
INSERT INTO `nilai` VALUES (9, '75.5', 'Keterangan ips\r\n', 7, 6);
INSERT INTO `nilai` VALUES (10, '95.23', 'Keterangan pelajaran matematika', 7, 4);
INSERT INTO `nilai` VALUES (11, '86.45', 'Keterangan IPS', 7, 6);
INSERT INTO `nilai` VALUES (12, '88.54', 'Keterangan IPA', 7, 5);
INSERT INTO `nilai` VALUES (13, '90.54', 'Keterngan IPA', 7, 5);
INSERT INTO `nilai` VALUES (14, '99.54', 'Keterangan bahasa indonesia\r\n', 7, 2);
INSERT INTO `nilai` VALUES (15, '98.4', 'Keterangan bahasa inggris', 7, 3);

-- ----------------------------
-- Table structure for pengaturan
-- ----------------------------
DROP TABLE IF EXISTS `pengaturan`;
CREATE TABLE `pengaturan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pengaturan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pembuat_pengaturan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gambar_pengaturan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nokontak_pengaturan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_pengaturan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengaturan
-- ----------------------------
INSERT INTO `pengaturan` VALUES (1, 'create bima', 'uke aplikasi', '2024-04-18-15-21-dev-hospita_2024-04-26_17-56-02_662bce92e4be3.png', '0328972389', 'alamat uke testing');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_profile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jeniskelamin_profile` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomorhp_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `users_id` int NULL DEFAULT NULL,
  `kode_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES (4, 'guru123 nama', 'guru123 alamat', 'P', '8293478', 4, NULL);
INSERT INTO `profile` VALUES (5, 'walimurid123 nama', 'alamat walimurid123', 'L', '90238478', 5, NULL);
INSERT INTO `profile` VALUES (6, 'admin123', 'alamat admin123', 'P', '329072389', 6, NULL);
INSERT INTO `profile` VALUES (7, 'Siswa 123', 'alamat siswa 123', 'L', '89837289732', 7, 'A001');
INSERT INTO `profile` VALUES (8, 'siswa124', 'alamat siswa124', 'L', '83293729827', 8, 'A002');
INSERT INTO `profile` VALUES (9, 'siswa125', 'alamat siswa125', 'L', '982379237', 9, 'A003');
INSERT INTO `profile` VALUES (10, 'siswa126', 'alamat siswa126', 'L', '923898329', 10, 'A004');
INSERT INTO `profile` VALUES (14, 'guru124', 'alamat guru124', 'L', '83982379', 21, NULL);
INSERT INTO `profile` VALUES (15, 'walimurid124', 'alamat walimurid124', 'L', '823923798', 22, NULL);
INSERT INTO `profile` VALUES (16, 'admin124', 'alamat admin124', 'L', '8923723897', 23, NULL);
INSERT INTO `profile` VALUES (18, 'Siswadaftar123', 'alamat siswa daftar 123', 'L', '039287329827', 25, 'A005');
INSERT INTO `profile` VALUES (19, 'siswa124', 'alamat siswa124', 'L', '0948678', 26, 'A006');
INSERT INTO `profile` VALUES (20, 'Siswa125', 'alamat siswa125', 'L', '2389723897', 27, 'A007');
INSERT INTO `profile` VALUES (21, 'Admin 124', 'ALAMAT admin 124', 'L', '098572398732', 28, 'A008');
INSERT INTO `profile` VALUES (23, 'Orang Tua 123', 'alamat orang tua 123', 'L', '0938748927', 31, NULL);

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `roles_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  INDEX `roles_id`(`roles_id` ASC) USING BTREE,
  CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (4, 4, 2);
INSERT INTO `role_user` VALUES (5, 5, 6);
INSERT INTO `role_user` VALUES (6, 6, 1);
INSERT INTO `role_user` VALUES (7, 7, 3);
INSERT INTO `role_user` VALUES (8, 8, 3);
INSERT INTO `role_user` VALUES (9, 9, 3);
INSERT INTO `role_user` VALUES (10, 10, 3);
INSERT INTO `role_user` VALUES (14, 21, 2);
INSERT INTO `role_user` VALUES (15, 22, 6);
INSERT INTO `role_user` VALUES (16, 23, 1);
INSERT INTO `role_user` VALUES (18, 25, 3);
INSERT INTO `role_user` VALUES (19, 26, 3);
INSERT INTO `role_user` VALUES (20, 27, 3);
INSERT INTO `role_user` VALUES (21, 28, 3);
INSERT INTO `role_user` VALUES (23, 31, 7);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_roles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin');
INSERT INTO `roles` VALUES (2, 'Guru');
INSERT INTO `roles` VALUES (3, 'Siswa');
INSERT INTO `roles` VALUES (4, 'Developer');
INSERT INTO `roles` VALUES (6, 'Wali Murid');
INSERT INTO `roles` VALUES (7, 'Orang Tua');

-- ----------------------------
-- Table structure for status_perkembangan
-- ----------------------------
DROP TABLE IF EXISTS `status_perkembangan`;
CREATE TABLE `status_perkembangan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_sperkembangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_sperkembangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `users_id`(`users_id` ASC) USING BTREE,
  CONSTRAINT `status_perkembangan_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status_perkembangan
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `username_users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password_users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email_users` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token_expiration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `users_id_siswa` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, 'guru123', '9310f83135f238b04af729fec041cca8', NULL, 'guru123@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (5, 'walimurid123', 'bf08271815f553100de1092e319662a0', NULL, 'walimurid123@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (6, 'admin123', '0192023a7bbd73250516f069df18b500', '912d5f255277454f0b5e94284f4c2dbd', 'admin123@gmail.com', '1714755421', 0);
INSERT INTO `users` VALUES (7, 'siswa123', '3afa0d81296a4f17d477ec823261b1ec', NULL, 'siswa123@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (8, 'siswa124', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa124@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (9, 'siswa125', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa125@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (10, 'siswa126', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa126@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (11, 'gurutesting123', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'gurutesting123@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (21, 'guru124', '33dbd004d18bf8203aee1803c0f828dd', NULL, 'guru124@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (22, 'walimurid124', '68ced70d428b256a6336d231b493d0f1', NULL, 'walimurid124@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (23, 'admin124', 'd325ffe191a600f562fb59ae52ccbc75', NULL, 'admin124@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (25, 'siswadaftar123', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswadaftar123@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (26, 'siswa124', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa124@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (27, 'siswa125', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa125@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (28, 'admin124', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'admin124@gmail.com', NULL, 0);
INSERT INTO `users` VALUES (31, 'orangtua123', 'eb2fb1d26ccd3501787d5d1d3e778f6f', NULL, 'orangtua123@gmail.com', NULL, 7);

SET FOREIGN_KEY_CHECKS = 1;
