/*
Navicat MySQL Data Transfer

Source Server         : phpmyadmin
Source Server Version : 100116
Source Host           : localhost:3306
Source Database       : uji_aja

Target Server Type    : MYSQL
Target Server Version : 100116
File Encoding         : 65001

Date: 2017-08-28 09:37:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for set_ikut_ujian
-- ----------------------------
DROP TABLE IF EXISTS `set_ikut_ujian`;
CREATE TABLE `set_ikut_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ujian` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `jawaban` varchar(20) DEFAULT NULL,
  `kunci_jawaban` varchar(20) DEFAULT NULL,
  `jml_benar` int(11) DEFAULT NULL,
  `bobot_nilai` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for set_mapel_guru
-- ----------------------------
DROP TABLE IF EXISTS `set_mapel_guru`;
CREATE TABLE `set_mapel_guru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(10) DEFAULT NULL,
  `id_mapel` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=595 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for set_ujian
-- ----------------------------
DROP TABLE IF EXISTS `set_ujian`;
CREATE TABLE `set_ujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_guru` int(11) DEFAULT NULL,
  `id_mapel` int(11) DEFAULT NULL,
  `nama_ujian` varchar(255) DEFAULT NULL,
  `jumlah_soal` int(11) DEFAULT NULL,
  `jenis` enum('acak','urut') DEFAULT NULL,
  `token` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_guru
-- ----------------------------
DROP TABLE IF EXISTS `tb_guru`;
CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(70) DEFAULT NULL,
  `nama` varchar(70) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_mapel
-- ----------------------------
DROP TABLE IF EXISTS `tb_mapel`;
CREATE TABLE `tb_mapel` (
  `id_mapel` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_mapel`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_siswa
-- ----------------------------
DROP TABLE IF EXISTS `tb_siswa`;
CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `nis` varchar(70) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_soal
-- ----------------------------
DROP TABLE IF EXISTS `tb_soal`;
CREATE TABLE `tb_soal` (
  `id_soal` int(20) NOT NULL AUTO_INCREMENT,
  `id_guru` int(50) DEFAULT NULL,
  `id_mapel` int(50) DEFAULT NULL,
  `bobot` int(30) DEFAULT NULL,
  `soal` longtext,
  `opsi_a` longtext,
  `opsi_b` longtext,
  `opsi_c` longtext,
  `opsi_d` longtext,
  `jawaban` varchar(10) DEFAULT NULL,
  `jumlah_benar` int(5) DEFAULT NULL,
  `jumlah_salah` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_soal`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` enum('admin','siswa','guru') DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
