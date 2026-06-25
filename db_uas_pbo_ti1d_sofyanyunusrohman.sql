/*
 Navicat Premium Dump SQL

 Source Server         : sems2
 Source Server Type    : MySQL
 Source Server Version : 80402 (8.4.2)
 Source Host           : localhost:3306
 Source Schema         : db_uas_pbo_ti1d_sofyanyunusrohman

 Target Server Type    : MySQL
 Target Server Version : 80402 (8.4.2)
 File Encoding         : 65001

 Date: 25/06/2026 15:07:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tabel_mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `tabel_mahasiswa`;
CREATE TABLE `tabel_mahasiswa`  (
  `id_mahasiswa` int NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nim` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `semester` tinyint NOT NULL,
  `tarif_ukt_nominal` int NOT NULL,
  `jenis_pembayaran` enum('Mandiri','Bidikmisi','Prestasi') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `golongan_ukt` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nama_wakil` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `dana_saku_subsidi` int NULL DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tabel_mahasiswa
-- ----------------------------
INSERT INTO `tabel_mahasiswa` VALUES (1, 'Andi Saputra', '2501001', 2, 5000000, 'Mandiri', 'Gol V', 'Budi Santoso', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (2, 'Siti Aminah', '2501002', 4, 6000000, 'Mandiri', 'Gol VI', 'Ahmad Dahlan', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (3, 'Reza Rahadian', '2501003', 2, 4500000, 'Mandiri', 'Gol IV', 'Sutrisno', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (4, 'Putri Marino', '2501004', 6, 7500000, 'Mandiri', 'Gol VII', 'Agus Supriyadi', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (5, 'Gilang Dirga', '2501005', 8, 3000000, 'Mandiri', 'Gol III', 'Slamet Riyadi', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (6, 'Anya Geraldine', '2501006', 4, 6000000, 'Mandiri', 'Gol VI', 'Handoko', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (7, 'Jefri Nichol', '2501007', 2, 5000000, 'Mandiri', 'Gol V', 'Bambang Pamungkas', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (8, 'Chelsea Islan', '2501008', 6, 8500000, 'Mandiri', 'Gol VIII', 'Rudi Haryanto', NULL, NULL, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (9, 'Iqbaal Ramadhan', '2501009', 2, 2400000, 'Bidikmisi', NULL, NULL, 'KIP-26-001', 950000, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (10, 'Vanesha Prescilla', '2501010', 4, 2400000, 'Bidikmisi', NULL, NULL, 'KIP-25-045', 950000, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (11, 'Adipati Dolken', '2501011', 2, 2400000, 'Bidikmisi', NULL, NULL, 'KIP-26-088', 950000, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (12, 'Maudy Ayunda', '2501012', 6, 2400000, 'Bidikmisi', NULL, NULL, 'KIP-24-112', 950000, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (13, 'Angga Yunanda', '2501013', 2, 2400000, 'Bidikmisi', NULL, NULL, 'KIP-26-201', 950000, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (14, 'Zara Adhisty', '2501014', 4, 2400000, 'Bidikmisi', NULL, NULL, 'KIP-25-099', 950000, NULL, NULL);
INSERT INTO `tabel_mahasiswa` VALUES (15, 'Nicholas Saputra', '2501015', 6, 4000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50);
INSERT INTO `tabel_mahasiswa` VALUES (16, 'Dian Sastrowardoyo', '2501016', 4, 4000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia', 3.25);
INSERT INTO `tabel_mahasiswa` VALUES (17, 'Lukman Sardi', '2501017', 8, 3500000, 'Prestasi', NULL, NULL, NULL, NULL, 'BCA Syariah', 3.30);
INSERT INTO `tabel_mahasiswa` VALUES (18, 'Tara Basro', '2501018', 2, 4500000, 'Prestasi', NULL, NULL, NULL, NULL, 'Pertamina', 3.00);
INSERT INTO `tabel_mahasiswa` VALUES (19, 'Chicco Jerikho', '2501019', 4, 5000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Kemenpora', 3.40);
INSERT INTO `tabel_mahasiswa` VALUES (20, 'Tatjana Saphira', '2501020', 6, 3000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Telkomsel', 3.50);

SET FOREIGN_KEY_CHECKS = 1;
