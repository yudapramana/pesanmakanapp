/*
 Navicat Premium Data Transfer

 Source Server         : Database-Local
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_pesan_makanan

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 23/07/2024 10:33:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_bayar
-- ----------------------------
DROP TABLE IF EXISTS `tb_bayar`;
CREATE TABLE `tb_bayar`  (
  `id_bayar` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NULL DEFAULT NULL,
  `total_pesanan` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `uang_bayar` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kembalian` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_member` int NULL DEFAULT NULL,
  `kd_diskon` int NULL DEFAULT NULL,
  `tgl_bayar` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_bayar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_bayar
-- ----------------------------
INSERT INTO `tb_bayar` VALUES (1, 1, '112430', '150000', '37570', 2, 20, '2024-07-17 09:01:59');

-- ----------------------------
-- Table structure for tb_detail_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tb_detail_transaksi`;
CREATE TABLE `tb_detail_transaksi`  (
  `id_detail_transaksi` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int NOT NULL,
  `id_makanan` int NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  `total_belanja` int NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail_transaksi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_detail_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for tb_diskon
-- ----------------------------
DROP TABLE IF EXISTS `tb_diskon`;
CREATE TABLE `tb_diskon`  (
  `id_diskon` int NOT NULL AUTO_INCREMENT,
  `kd_diskon` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diskon` int NULL DEFAULT NULL,
  `tgl_create_diskon` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_diskon`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_diskon
-- ----------------------------
INSERT INTO `tb_diskon` VALUES (2, 'nSlCk3J4', 5, '2024-07-12');
INSERT INTO `tb_diskon` VALUES (3, 'gWDifS5T', 10, '2024-07-12');
INSERT INTO `tb_diskon` VALUES (4, '3AYpfhgj', 15, '2024-07-12');
INSERT INTO `tb_diskon` VALUES (5, 'uJYp9sNl', 20, '2024-07-12');
INSERT INTO `tb_diskon` VALUES (6, 'iUgfYyik', 25, '2024-07-12');
INSERT INTO `tb_diskon` VALUES (7, 'w9hfFmqN', 30, '2024-07-12');
INSERT INTO `tb_diskon` VALUES (8, 'TANPA DISKON', 0, '2024-07-15');

-- ----------------------------
-- Table structure for tb_keranjang
-- ----------------------------
DROP TABLE IF EXISTS `tb_keranjang`;
CREATE TABLE `tb_keranjang`  (
  `id_keranjang` int NOT NULL AUTO_INCREMENT,
  `id_makanan` int NULL DEFAULT NULL,
  `id_pelanggan` int NULL DEFAULT NULL,
  `jumlah` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_keranjang
-- ----------------------------

-- ----------------------------
-- Table structure for tb_level
-- ----------------------------
DROP TABLE IF EXISTS `tb_level`;
CREATE TABLE `tb_level`  (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `nm_level` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_level
-- ----------------------------
INSERT INTO `tb_level` VALUES (1, 'KASIR');
INSERT INTO `tb_level` VALUES (2, 'WAITER');
INSERT INTO `tb_level` VALUES (3, 'PEMILIK');
INSERT INTO `tb_level` VALUES (4, 'KOKI');

-- ----------------------------
-- Table structure for tb_member
-- ----------------------------
DROP TABLE IF EXISTS `tb_member`;
CREATE TABLE `tb_member`  (
  `id_member` int NOT NULL AUTO_INCREMENT,
  `nm_member` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jk_member` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_create_member` date NULL DEFAULT NULL,
  `kd_member` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_member`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_member
-- ----------------------------

-- ----------------------------
-- Table structure for tb_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan`  (
  `id_pelanggan` int NOT NULL AUTO_INCREMENT,
  `foto_wajah` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pelanggan
-- ----------------------------
INSERT INTO `tb_pelanggan` VALUES (1, 'uploaded_image_6683638f0c57a.png');
INSERT INTO `tb_pelanggan` VALUES (2, 'uploaded_image_668771875067f.png');
INSERT INTO `tb_pelanggan` VALUES (3, 'uploaded_image_6690f22c531d0.png');
INSERT INTO `tb_pelanggan` VALUES (4, 'uploaded_image_6694db9f21923.png');
INSERT INTO `tb_pelanggan` VALUES (5, 'uploaded_image_669725932a603.png');

-- ----------------------------
-- Table structure for tb_produk_makanan
-- ----------------------------
DROP TABLE IF EXISTS `tb_produk_makanan`;
CREATE TABLE `tb_produk_makanan`  (
  `id_makanan` int NOT NULL AUTO_INCREMENT,
  `nm_makanan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` int NULL DEFAULT NULL,
  `ket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `best_seller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stok` int NULL DEFAULT NULL,
  `gambar_produk` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `upload_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_makanan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_produk_makanan
-- ----------------------------
INSERT INTO `tb_produk_makanan` VALUES (2, 'RENDANG', 25000, 'RENDANG ASLI MASAKAN PADANG', 'aktif', 14, 'Produk-RENDANG-njyWk74mbX.jpeg', '2024-06-26');
INSERT INTO `tb_produk_makanan` VALUES (3, 'RENDANG LOKAN', 18000, 'RENDANG LOKAN ASLI', 'aktif', 46, 'Produk-RENDANG_LOKAN-zZr4u01WcS.jpeg', '2024-06-26');
INSERT INTO `tb_produk_makanan` VALUES (4, 'asdas', 23423, 'asdasd', NULL, 4, 'Produk-asdas-tw7Mjc9iZq.png', '2024-07-05');

-- ----------------------------
-- Table structure for tb_transaksi
-- ----------------------------
DROP TABLE IF EXISTS `tb_transaksi`;
CREATE TABLE `tb_transaksi`  (
  `id_trx` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int NULL DEFAULT NULL,
  `jumlah_pesanan` int NULL DEFAULT NULL,
  `tgl_trx` datetime NULL DEFAULT NULL,
  `total_harga` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_trx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_transaksi
-- ----------------------------

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_at` date NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (2, 'SUPERADMIN', 'superadmin', '200820e3227815ed1756a6b531e7e0d2', 'SUPERADMIN', '2024-06-26');
INSERT INTO `tb_user` VALUES (3, 'KASIR', 'kasir', '200820e3227815ed1756a6b531e7e0d2', 'KASIR', '2024-06-27');
INSERT INTO `tb_user` VALUES (4, 'WAITER', 'waiter', '200820e3227815ed1756a6b531e7e0d2', 'WAITER', '2024-06-28');
INSERT INTO `tb_user` VALUES (5, 'PEMILIK', 'pemilik', '200820e3227815ed1756a6b531e7e0d2', 'PEMILIK', '2024-06-28');
INSERT INTO `tb_user` VALUES (6, 'KOKI', 'koki', '200820e3227815ed1756a6b531e7e0d2', 'KOKI', '2024-06-28');

SET FOREIGN_KEY_CHECKS = 1;
