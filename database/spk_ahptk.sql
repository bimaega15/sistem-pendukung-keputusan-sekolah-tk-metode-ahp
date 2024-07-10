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

 Date: 10/07/2024 23:23:03
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
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `absensi` VALUES (15, 'sakit', 'kok ga bisa pula', 7, '2024-07-10 22:56:00');
INSERT INTO `absensi` VALUES (16, 'sakit', 'bisa apa bisa', 7, '2024-07-10 22:58:00');
INSERT INTO `absensi` VALUES (17, 'izin', 'coba check', 7, '2024-07-10 22:59:00');
INSERT INTO `absensi` VALUES (18, 'sakit', 'apa ini', 26, '2024-07-10 23:08:00');
INSERT INTO `absensi` VALUES (19, 'sakit', 'apa ini', 26, '2024-07-10 23:09:00');

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
INSERT INTO `hasil_akhir` VALUES (1, '{\"bobot_alternatif\":{\"7\":{\"6\":0.5669430465033137,\"7\":0.46581939799331107,\"8\":0.3326465201465201,\"12\":0.20238095238095238,\"13\":0.4813636363636364,\"14\":0.32512459529266247},\"8\":{\"6\":0.26709613251565234,\"7\":0.2771404682274248,\"8\":0.26453754578754574,\"12\":0.15238095238095237,\"13\":0.18670454545454546,\"14\":0.43724580741387464},\"10\":{\"6\":0.11219203280501855,\"7\":0.16107023411371238,\"8\":0.1278617216117216,\"12\":0.32976190476190476,\"13\":0.19795454545454544,\"14\":0.14841572992833496},\"28\":{\"6\":0.0537687881760153,\"7\":0.09596989966555183,\"8\":0.2749542124542125,\"12\":0.31547619047619047,\"13\":0.13397727272727275,\"14\":0.08921386736512787}},\"bobot_akhir\":{\"7\":{\"6\":0.16713962854428285,\"7\":0.13732751751611508,\"8\":0.059834153675155245,\"12\":0.022763250137396284,\"13\":0.03424836160447032,\"14\":0.01524316131949826},\"8\":{\"6\":0.07874220990912136,\"7\":0.08170336544351578,\"8\":0.04758318277470192,\"12\":0.017139388338745436,\"13\":0.013283771982092712,\"14\":0.020499859054601575},\"10\":{\"6\":0.03307516478826625,\"7\":0.04748487394870837,\"8\":0.022998881505556925,\"12\":0.0370907075768163,\"13\":0.0140841940309224,\"14\":0.006958332117606338},\"28\":{\"6\":0.015851495733906838,\"7\":0.028292742067238096,\"8\":0.04945686067712421,\"12\":0.035483889920058916,\"13\":0.009532298945153568,\"14\":0.004182708388944994}},\"hasil_bobot\":{\"7\":0.43655607279691805,\"8\":0.25895177750277876,\"10\":0.16169215396787656,\"28\":0.1427999957324266},\"ranking\":{\"7\":0.43655607279691805,\"8\":0.25895177750277876,\"10\":0.16169215396787656,\"28\":0.1427999957324266}}');

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
INSERT INTO `matriks_alternatif` VALUES (7, '{\"6\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"3\",\"10\":\"6\",\"28\":\"7\"},\"8\":{\"7\":\"0.3333333333333333\",\"8\":\"1\",\"10\":\"3\",\"28\":\"6\"},\"10\":{\"7\":\"0.16666666666666666\",\"8\":\"0.3333333333333333\",\"10\":\"1\",\"28\":\"3\"},\"28\":{\"7\":\"0.14285714285714285\",\"8\":\"0.16666666666666666\",\"10\":\"0.3333333333333333\",\"28\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"3\",\"10\":\"6\",\"28\":\"7\"},\"8\":{\"7\":\"1\\/3\",\"8\":\"1\",\"10\":\"3\",\"28\":\"6\"},\"10\":{\"7\":\"1\\/6\",\"8\":\"1\\/3\",\"10\":\"1\",\"28\":\"3\"},\"28\":{\"7\":\"1\\/7\",\"8\":\"1\\/6\",\"10\":\"1\\/3\",\"28\":\"1\"}},\"hasil_perhitungan\":{\"7\":1.6428571428571428,\"8\":4.5,\"10\":10.333333333333334,\"28\":17},\"normalisasi\":{\"7\":{\"7\":0.6086956521739131,\"8\":0.6666666666666666,\"10\":0.5806451612903225,\"28\":0.4117647058823529},\"8\":{\"7\":0.20289855072463767,\"8\":0.2222222222222222,\"10\":0.29032258064516125,\"28\":0.35294117647058826},\"10\":{\"7\":0.10144927536231883,\"8\":0.07407407407407407,\"10\":0.0967741935483871,\"28\":0.17647058823529413},\"28\":{\"7\":0.08695652173913043,\"8\":0.037037037037037035,\"10\":0.03225806451612903,\"28\":0.058823529411764705}},\"row_normalisasi\":{\"7\":2.267772186013255,\"8\":1.0683845300626094,\"10\":0.4487681312200742,\"28\":0.2150751527040612},\"jumlah_row_normalisasi\":3.9999999999999996,\"perhitungan_bobot_prioritas\":{\"7\":0.5669430465033137,\"8\":0.26709613251565234,\"10\":0.11219203280501855,\"28\":0.0537687881760153},\"jumlah_perhitungan_bobot_prioritas\":0.9999999999999999,\"eigen_max\":{\"7\":0.9314064335411583,\"8\":1.2019325963204355,\"10\":1.159317672318525,\"28\":0.91406939899226},\"jumlah_eigen_max\":4.206726101172379,\"ci\":0.06890870039079289,\"cr\":0.07656522265643655}}', 6);
INSERT INTO `matriks_alternatif` VALUES (8, '{\"7\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"10\":\"3\",\"28\":\"4\"},\"8\":{\"7\":\"0.5\",\"8\":\"1\",\"10\":\"2\",\"28\":\"3\"},\"10\":{\"7\":\"0.3333333333333333\",\"8\":\"0.5\",\"10\":\"1\",\"28\":\"2\"},\"28\":{\"7\":\"0.25\",\"8\":\"0.3333333333333333\",\"10\":\"0.5\",\"28\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"10\":\"3\",\"28\":\"4\"},\"8\":{\"7\":\"1\\/2\",\"8\":\"1\",\"10\":\"2\",\"28\":\"3\"},\"10\":{\"7\":\"1\\/3\",\"8\":\"1\\/2\",\"10\":\"1\",\"28\":\"2\"},\"28\":{\"7\":\"1\\/4\",\"8\":\"1\\/3\",\"10\":\"1\\/2\",\"28\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.083333333333333,\"8\":3.8333333333333335,\"10\":6.5,\"28\":10},\"normalisasi\":{\"7\":{\"7\":0.4800000000000001,\"8\":0.5217391304347826,\"10\":0.46153846153846156,\"28\":0.4},\"8\":{\"7\":0.24000000000000005,\"8\":0.2608695652173913,\"10\":0.3076923076923077,\"28\":0.3},\"10\":{\"7\":0.16,\"8\":0.13043478260869565,\"10\":0.15384615384615385,\"28\":0.2},\"28\":{\"7\":0.12000000000000002,\"8\":0.08695652173913043,\"10\":0.07692307692307693,\"28\":0.1}},\"row_normalisasi\":{\"7\":1.8632775919732443,\"8\":1.108561872909699,\"10\":0.6442809364548495,\"28\":0.38387959866220733},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.46581939799331107,\"8\":0.2771404682274248,\"10\":0.16107023411371238,\"28\":0.09596989966555183},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.9704570791527313,\"8\":1.062371794871795,\"10\":1.0469565217391306,\"28\":0.9596989966555183},\"jumlah_eigen_max\":4.039484392419175,\"ci\":0.013161464139725076,\"cr\":0.014623849044138973}}', 7);
INSERT INTO `matriks_alternatif` VALUES (9, '{\"8\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"10\":\"2\",\"28\":\"1\"},\"8\":{\"7\":\"0.5\",\"8\":\"1\",\"10\":\"3\",\"28\":\"1\"},\"10\":{\"7\":\"0.5\",\"8\":\"0.3333333333333333\",\"10\":\"1\",\"28\":\"0.5\"},\"28\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"2\",\"28\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"10\":\"2\",\"28\":\"1\"},\"8\":{\"7\":\"1\\/2\",\"8\":\"1\",\"10\":\"3\",\"28\":\"1\"},\"10\":{\"7\":\"1\\/2\",\"8\":\"1\\/3\",\"10\":\"1\",\"28\":\"1\\/2\"},\"28\":{\"7\":\"1\\/1\",\"8\":\"1\\/1\",\"10\":\"2\",\"28\":\"1\"}},\"hasil_perhitungan\":{\"7\":3,\"8\":4.333333333333334,\"10\":8,\"28\":3.5},\"normalisasi\":{\"7\":{\"7\":0.3333333333333333,\"8\":0.46153846153846145,\"10\":0.25,\"28\":0.2857142857142857},\"8\":{\"7\":0.16666666666666666,\"8\":0.23076923076923073,\"10\":0.375,\"28\":0.2857142857142857},\"10\":{\"7\":0.16666666666666666,\"8\":0.07692307692307691,\"10\":0.125,\"28\":0.14285714285714285},\"28\":{\"7\":0.3333333333333333,\"8\":0.23076923076923073,\"10\":0.25,\"28\":0.2857142857142857}},\"row_normalisasi\":{\"7\":1.3305860805860803,\"8\":1.058150183150183,\"10\":0.5114468864468864,\"28\":1.09981684981685},\"jumlah_row_normalisasi\":3.9999999999999996,\"perhitungan_bobot_prioritas\":{\"7\":0.3326465201465201,\"8\":0.26453754578754574,\"10\":0.1278617216117216,\"28\":0.2749542124542125},\"jumlah_perhitungan_bobot_prioritas\":0.9999999999999999,\"eigen_max\":{\"7\":0.9979395604395602,\"8\":1.1463293650793651,\"10\":1.0228937728937728,\"28\":0.9623397435897436},\"jumlah_eigen_max\":4.129502442002442,\"ci\":0.04316748066748074,\"cr\":0.04796386740831193}}', 8);
INSERT INTO `matriks_alternatif` VALUES (10, '{\"12\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"0.5\",\"28\":\"1\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"0.5\",\"28\":\"0.3333333333333333\"},\"10\":{\"7\":\"2\",\"8\":\"2\",\"10\":\"1\",\"28\":\"1\"},\"28\":{\"7\":\"1\",\"8\":\"3\",\"10\":\"1\",\"28\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"1\\/2\",\"28\":\"1\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"10\":\"1\\/2\",\"28\":\"1\\/3\"},\"10\":{\"7\":\"2\",\"8\":\"2\",\"10\":\"1\",\"28\":\"1\"},\"28\":{\"7\":\"1\\/1\",\"8\":\"3\",\"10\":\"1\\/1\",\"28\":\"1\"}},\"hasil_perhitungan\":{\"7\":5,\"8\":7,\"10\":3,\"28\":3.333333333333333},\"normalisasi\":{\"7\":{\"7\":0.2,\"8\":0.14285714285714285,\"10\":0.16666666666666666,\"28\":0.30000000000000004},\"8\":{\"7\":0.2,\"8\":0.14285714285714285,\"10\":0.16666666666666666,\"28\":0.1},\"10\":{\"7\":0.4,\"8\":0.2857142857142857,\"10\":0.3333333333333333,\"28\":0.30000000000000004},\"28\":{\"7\":0.2,\"8\":0.42857142857142855,\"10\":0.3333333333333333,\"28\":0.30000000000000004}},\"row_normalisasi\":{\"7\":0.8095238095238095,\"8\":0.6095238095238095,\"10\":1.319047619047619,\"28\":1.2619047619047619},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.20238095238095238,\"8\":0.15238095238095237,\"10\":0.32976190476190476,\"28\":0.31547619047619047},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":1.0119047619047619,\"8\":1.0666666666666667,\"10\":0.9892857142857143,\"28\":1.0515873015873014},\"jumlah_eigen_max\":4.119444444444444,\"ci\":0.039814814814814525,\"cr\":0.0442386831275717}}', 12);
INSERT INTO `matriks_alternatif` VALUES (11, '{\"13\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"10\":\"3\",\"28\":\"4\"},\"8\":{\"7\":\"0.5\",\"8\":\"1\",\"10\":\"1\",\"28\":\"1\"},\"10\":{\"7\":\"0.3333333333333333\",\"8\":\"1\",\"10\":\"1\",\"28\":\"2\"},\"28\":{\"7\":\"0.25\",\"8\":\"1\",\"10\":\"0.5\",\"28\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"2\",\"10\":\"3\",\"28\":\"4\"},\"8\":{\"7\":\"1\\/2\",\"8\":\"1\",\"10\":\"1\",\"28\":\"1\"},\"10\":{\"7\":\"1\\/3\",\"8\":\"1\\/1\",\"10\":\"1\",\"28\":\"2\"},\"28\":{\"7\":\"1\\/4\",\"8\":\"1\\/1\",\"10\":\"1\\/2\",\"28\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.083333333333333,\"8\":5,\"10\":5.5,\"28\":8},\"normalisasi\":{\"7\":{\"7\":0.4800000000000001,\"8\":0.4,\"10\":0.5454545454545454,\"28\":0.5},\"8\":{\"7\":0.24000000000000005,\"8\":0.2,\"10\":0.18181818181818182,\"28\":0.125},\"10\":{\"7\":0.16,\"8\":0.2,\"10\":0.18181818181818182,\"28\":0.25},\"28\":{\"7\":0.12000000000000002,\"8\":0.2,\"10\":0.09090909090909091,\"28\":0.125}},\"row_normalisasi\":{\"7\":1.9254545454545455,\"8\":0.7468181818181818,\"10\":0.7918181818181818,\"28\":0.535909090909091},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.4813636363636364,\"8\":0.18670454545454546,\"10\":0.19795454545454544,\"28\":0.13397727272727275},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":1.002840909090909,\"8\":0.9335227272727273,\"10\":1.0887499999999999,\"28\":1.071818181818182},\"jumlah_eigen_max\":4.096931818181818,\"ci\":0.032310606060605984,\"cr\":0.035900673400673315}}', 13);
INSERT INTO `matriks_alternatif` VALUES (12, '{\"14\":{\"matriks_perbandingan\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"2\",\"28\":\"3\"},\"8\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"4\",\"28\":\"5\"},\"10\":{\"7\":\"0.5\",\"8\":\"0.25\",\"10\":\"1\",\"28\":\"2\"},\"28\":{\"7\":\"0.3333333333333333\",\"8\":\"0.2\",\"10\":\"0.5\",\"28\":\"1\"}},\"matriks_perbandingan_original\":{\"7\":{\"7\":\"1\",\"8\":\"1\",\"10\":\"2\",\"28\":\"3\"},\"8\":{\"7\":\"1\\/1\",\"8\":\"1\",\"10\":\"4\",\"28\":\"5\"},\"10\":{\"7\":\"1\\/2\",\"8\":\"1\\/4\",\"10\":\"1\",\"28\":\"2\"},\"28\":{\"7\":\"1\\/3\",\"8\":\"1\\/5\",\"10\":\"1\\/2\",\"28\":\"1\"}},\"hasil_perhitungan\":{\"7\":2.8333333333333335,\"8\":2.45,\"10\":7.5,\"28\":11},\"normalisasi\":{\"7\":{\"7\":0.3529411764705882,\"8\":0.4081632653061224,\"10\":0.26666666666666666,\"28\":0.2727272727272727},\"8\":{\"7\":0.3529411764705882,\"8\":0.4081632653061224,\"10\":0.5333333333333333,\"28\":0.45454545454545453},\"10\":{\"7\":0.1764705882352941,\"8\":0.1020408163265306,\"10\":0.13333333333333333,\"28\":0.18181818181818182},\"28\":{\"7\":0.1176470588235294,\"8\":0.08163265306122448,\"10\":0.06666666666666667,\"28\":0.09090909090909091}},\"row_normalisasi\":{\"7\":1.3004983811706499,\"8\":1.7489832296554986,\"10\":0.5936629197133398,\"28\":0.3568554694605115},\"jumlah_row_normalisasi\":4,\"perhitungan_bobot_prioritas\":{\"7\":0.32512459529266247,\"8\":0.43724580741387464,\"10\":0.14841572992833496,\"28\":0.08921386736512787},\"jumlah_perhitungan_bobot_prioritas\":1,\"eigen_max\":{\"7\":0.9211863533292104,\"8\":1.071252228163993,\"10\":1.1131179744625121,\"28\":0.9813525410164066},\"jumlah_eigen_max\":4.086909096972121,\"ci\":0.028969698990707116,\"cr\":0.03218855443411902}}', 14);

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
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of nilai
-- ----------------------------
INSERT INTO `nilai` VALUES (6, '85.34', 'Keterangan bahasa indonesia', 7, 2);
INSERT INTO `nilai` VALUES (7, '80', 'Keterangan ga da obat', 7, 3);
INSERT INTO `nilai` VALUES (8, '80.53', 'Keterangan mata peelajaran ipa\r\n', 7, 5);
INSERT INTO `nilai` VALUES (9, '75.5', 'Keterangan ips\r\n', 7, 6);
INSERT INTO `nilai` VALUES (10, '95.23', 'Keterangan pelajaran matematika', 7, 4);
INSERT INTO `nilai` VALUES (12, '88.54', 'Keterangan IPA', 7, 5);
INSERT INTO `nilai` VALUES (13, '90.54', 'Keterngan IPA sudah siap kok', 7, 5);

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
  `is_alternatif` tinyint NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, 'guru123', '9310f83135f238b04af729fec041cca8', NULL, 'guru123@gmail.com', NULL, 0, NULL);
INSERT INTO `users` VALUES (5, 'walimurid123', 'bf08271815f553100de1092e319662a0', NULL, 'walimurid123@gmail.com', NULL, 0, NULL);
INSERT INTO `users` VALUES (6, 'admin123', '0192023a7bbd73250516f069df18b500', '912d5f255277454f0b5e94284f4c2dbd', 'admin123@gmail.com', '1714755421', 0, NULL);
INSERT INTO `users` VALUES (7, 'siswa123', '3afa0d81296a4f17d477ec823261b1ec', NULL, 'siswa123@gmail.com', NULL, 0, 1);
INSERT INTO `users` VALUES (8, 'siswa124', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa124@gmail.com', NULL, 0, 1);
INSERT INTO `users` VALUES (9, 'siswa125', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa125@gmail.com', NULL, 0, 0);
INSERT INTO `users` VALUES (10, 'siswa126', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa126@gmail.com', NULL, 0, 1);
INSERT INTO `users` VALUES (11, 'gurutesting123', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'gurutesting123@gmail.com', NULL, 0, NULL);
INSERT INTO `users` VALUES (21, 'guru124', '33dbd004d18bf8203aee1803c0f828dd', NULL, 'guru124@gmail.com', NULL, 0, NULL);
INSERT INTO `users` VALUES (22, 'walimurid124', '68ced70d428b256a6336d231b493d0f1', NULL, 'walimurid124@gmail.com', NULL, 0, NULL);
INSERT INTO `users` VALUES (23, 'admin124', 'd325ffe191a600f562fb59ae52ccbc75', NULL, 'admin124@gmail.com', NULL, 0, NULL);
INSERT INTO `users` VALUES (25, 'siswadaftar123', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswadaftar123@gmail.com', NULL, 0, 0);
INSERT INTO `users` VALUES (26, 'siswa124', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa124@gmail.com', NULL, 0, 0);
INSERT INTO `users` VALUES (27, 'siswa125', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'siswa125@gmail.com', NULL, 0, 0);
INSERT INTO `users` VALUES (28, 'admin124', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 'admin124@gmail.com', NULL, 0, 1);
INSERT INTO `users` VALUES (31, 'orangtua123', 'eb2fb1d26ccd3501787d5d1d3e778f6f', NULL, 'orangtua123@gmail.com', NULL, 7, NULL);

SET FOREIGN_KEY_CHECKS = 1;
