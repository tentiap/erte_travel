-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 22, 2022 at 05:42 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_27Feb`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_pemesan` char(16) NOT NULL,
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_seat` char(2) NOT NULL,
  `id_feeder` char(16) DEFAULT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `detail_asal` varchar(191) NOT NULL,
  `detail_tujuan` varchar(191) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `status` char(1) NOT NULL,
  `biaya_tambahan` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_pemesan`, `jadwal`, `plat_mobil`, `id_seat`, `id_feeder`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`, `created_at`, `updated_at`) VALUES
('0000000000000000', '2022-03-23 12:00:00', 'BA2222LA', '3', '1000000000000000', 'Hagi', 'Laki-laki', 'Pasar Atas', 'Pasar Raya', '08126766442', '1', NULL, '2022-03-21 01:39:02', '2022-03-21 02:40:11'),
('0000000000000000', '2022-03-23 12:00:00', 'BA2222LA', '4', '1000000000000000', 'Yona', 'Perempuan', 'Pasar Atas', 'Pasar Raya', '08126766442', '1', NULL, '2022-03-21 01:39:02', '2022-03-21 02:40:11'),
('1000000000000000', '2022-03-22 22:00:00', 'BA2222LA', '2', NULL, 'Acha', 'Perempuan', 'Tangah Jua', 'Gerbang UNAND', '081270321011', '1', NULL, '2022-03-22 02:44:27', '2022-03-22 02:44:42'),
('1000000000000000', '2022-03-22 22:00:00', 'BA2222LA', '3', NULL, 'Dila', 'Perempuan', 'Tangah Sawah', 'Gerbang UNAND', '081278675656', '1', NULL, '2022-03-22 02:51:35', '2022-03-22 02:51:35'),
('1000000000000000', '2022-03-22 22:00:00', 'BA2222LA', '4', NULL, 'Salma', 'Perempuan', 'Tangah Sawah', 'Gerbang UNAND', '081278675656', '1', NULL, '2022-03-22 02:51:35', '2022-03-22 02:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `feeder`
--

CREATE TABLE `feeder` (
  `id_feeder` char(16) NOT NULL,
  `id_kota` char(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(60) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feeder`
--

INSERT INTO `feeder` (`id_feeder`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('1000000000000000', 'K1', 'feeder1', 'feeder1@gmail.com', '$2a$12$6UPcc0bbRnBhJECjzGOCsukRw9jjWZylD1PDYrSw5tXIyeRYS1mtS', 'Feeder Satu', '081234345656', 'Laki-laki', '2022-03-20 13:12:19', '2022-03-20 13:12:19'),
('2000000000000000', 'K2', 'feeder2', 'feeder2@gmail.com', '$2a$12$tX2DyU3fPn40fVSJHFMHPO4//6S51dywSdEFMPL35ADmdetFpa4D2', 'Feeder Dua', '08127878676765', 'Laki-laki', '2022-03-20 13:12:19', '2022-03-20 13:12:19'),
('3000000000000000', 'K3', 'feeder3', 'feeder3@gmail.com', '$2a$12$voM6mvZMhIO/jIOOEb7zyew/fBdZz23hdDhqp796tk48AMUXVdogW', 'Feeder Tiga', '089878786565', 'Laki-laki', '2022-03-20 13:12:19', '2022-03-20 13:12:19'),
('4000000000000000', 'K1', 'feeder4', 'feeder4@gmail.com', '$2y$10$0y8Wy6pzbmHNkDwPojGXzO1y6HHiS1CclzEVpksXJ9Ffbk0QEfTRy', 'Feeder Empat', '089876564322', 'Laki-laki', '2022-03-20 13:12:19', '2022-03-20 13:12:19'),
('5000000000000000', 'K2', 'feeder5', 'feeder5@gmail.com', '$2y$10$Iqv.uHqoHsTzINslbvMRWOZQnL.z7HDLhpeDUn.6s2/JHhiXkGkyS', 'Feeder Lima', '087690909090', 'Laki-laki', '2022-03-20 13:12:19', '2022-03-20 13:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` char(2) NOT NULL,
  `nama_kota` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `created_at`, `updated_at`) VALUES
('K1', 'Bukittinggi', '2022-03-18 15:09:57', '2022-03-18 15:09:57'),
('K2', 'Padang', '2022-03-18 15:09:57', '2022-03-18 15:09:57'),
('K3', 'Pekanbaru', '2022-03-18 15:09:57', '2022-03-18 15:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `plat_mobil` varchar(8) NOT NULL,
  `merek_mobil` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`plat_mobil`, `merek_mobil`, `created_at`, `updated_at`) VALUES
('BA1111LA', 'Suzuki APV', '2022-03-08 14:31:01', '2022-03-08 14:31:01'),
('BA2222LA', 'Suzuki APV', '2022-03-08 14:31:01', '2022-03-08 14:31:01'),
('BA3333LB', 'Suzuki APV', '2022-03-20 22:34:59', '2022-03-20 22:54:50'),
('BA4444QA', 'Suzuki APV', '2022-03-20 23:39:37', '2022-03-20 23:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_pemesan` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(60) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `alamat` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
('0000000000000000', 'admin', 'admin@gmail.com', '$2y$10$K.qAsCc2GzV8/rCKKb4voe6iuT0VnF1/2ACYBbnvtXuSvOuuhKkXe', 'Admin', '08126766442', 'Laki-laki', 'Kantor', '2022-03-20 13:17:23', '2022-03-20 13:17:23'),
('1000000000000000', 'pengurus1', 'pengurus1@gmail.com', '$2y$10$HJ41vacmpDlGwuVICZqSMe7dmTvfqMhTn57UD.NNO2ybEjjAlgmjS', 'Pengurus Satu', '08976765454', 'Perempuan', 'Alamat Kantor', '2022-03-20 13:17:23', '2022-03-20 13:17:23'),
('1111111111111111', 'pemesan1', 'pemesan1@gmail.com', '$2a$12$ar1/DXJuMjxUCidx.osXlOCWobpCO2Px0Ub9AatMvNRkyABECQIpe', 'Pemesan Satu', '0812676749098', 'Laki-laki', 'Alamat Pemesan Satu', '2022-03-20 13:17:23', '2022-03-20 13:17:23'),
('137501500989', 'verdina', 'verdina@gmail.com', '$2y$10$Is6w5PRi8YKaiKJqZhdap.dBqNHIR4D5.xhv3q/duVjIejoFRg.py', 'Verdina A', '082267653434', 'Perempuan', 'Belakang Balok', '2022-03-21 02:44:13', '2022-03-22 02:31:39'),
('2000000000000000', 'pengurus2', 'pengurus2@gmail.com', '$2y$10$stO77euwZOAjk5gMpbtKRuv3gWRLv5ibN3a6wXT523RVbwaPYLMsO', 'Pengurus Dua', '089878786767', 'Laki-laki', 'Alamat Pengurus Dua', '2022-03-20 13:17:23', '2022-03-20 13:17:23'),
('2222222222222222', 'pemesan2', 'pemesan2@gmail.com', '$2a$12$qkELQaNx5jlq9rYdiJmSQ.1R8SSWlNUZ.HmdzlegEQO2xZTtOePAe', 'Pemesan Dua', '087867655434', 'Perempuan', 'Alamat Pemesan 2', '2022-03-20 13:17:23', '2022-03-20 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` char(16) NOT NULL,
  `id_kota` char(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(60) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('1000000000000000', 'K1', 'pengurus1', 'pengurus1@gmail.com', '$2a$12$NNG7pkjxwbGyLLV8ptvqZ.kIQzBm8j6Sffhha8SenpzbExx7SHS96', 'Pengurus Satu', '081209090807', 'Perempuan', '2022-03-19 12:12:04', '2022-03-19 12:12:04'),
('2000000000000000', 'K2', 'pengurus2', 'pengurus2@gmail.com', '$2a$12$QOjuLpUZvpshF9Ql.ZXQy.EStz/gszhnT5SOqCgUMaEKz4NatsONe', 'Pengurus Dua', '081278785643', 'Perempuan', '2022-03-20 07:38:56', '2022-03-20 07:38:56'),
('3000000000000000', 'K3', 'pengurus3', 'pengurus3@gmail.com', '$2a$12$.uF/iG9ZKc5laJtLd09C..J1EIHqltGUaFcEOKIeyNey6oaVwHJhu', 'Pengurus Tiga', '081289030303', 'Perempuan', '2022-03-20 07:38:56', '2022-03-20 07:38:56'),
('admin', 'K1', 'admin', 'admin@gmail.com', '$2a$12$hqd3gqRRnyNg2fdUWzmLMOWp52VnPRfkD7pwWdXKBwLHIqkqXZdO.', 'Admin', '081200000000', 'Perempuan', '2022-03-19 12:12:04', '2022-03-19 12:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pemesan` char(16) NOT NULL,
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_pengurus` char(16) DEFAULT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pemesan`, `jadwal`, `plat_mobil`, `id_pengurus`, `tanggal_pesan`, `created_at`, `updated_at`) VALUES
('0000000000000000', '2022-03-23 12:00:00', 'BA2222LA', 'admin', '2022-03-21 01:39:02', '2022-03-21 01:39:02', '2022-03-21 01:39:02'),
('1000000000000000', '2022-03-22 22:00:00', 'BA2222LA', 'admin', '2022-03-22 02:44:27', '2022-03-22 02:44:27', '2022-03-22 02:44:27'),
('137501500989', '2022-03-22 22:00:00', 'BA2222LA', NULL, '2022-03-22 02:32:03', '2022-03-22 02:32:03', '2022-03-22 02:32:03');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_kota_asal` char(2) NOT NULL,
  `id_kota_tujuan` char(2) NOT NULL,
  `tarif` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_kota_asal`, `id_kota_tujuan`, `tarif`, `created_at`, `updated_at`) VALUES
('K1', 'K2', 50000, '2022-03-20 13:05:42', '2022-03-20 13:05:42'),
('K1', 'K3', 100000, '2022-03-20 13:05:42', '2022-03-20 13:05:42'),
('K2', 'K1', 50000, '2022-03-20 13:05:42', '2022-03-20 13:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` char(2) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id_seat`, `keterangan`, `created_at`, `updated_at`) VALUES
('1', 'Sebelah Sopir', '2022-03-20 14:00:27', '2022-03-20 14:00:27'),
('2', 'Baris Dua', '2022-03-20 14:00:27', '2022-03-20 14:00:27'),
('3', 'Baris Tiga', '2022-03-20 14:00:27', '2022-03-20 14:00:27'),
('4', 'Baris Empat', '2022-03-20 14:00:27', '2022-03-20 14:00:27'),
('5', 'Baris Lima', '2022-03-20 14:00:27', '2022-03-20 14:00:27'),
('6', 'Baris Enam', '2022-03-20 14:00:27', '2022-03-20 14:00:27'),
('7', 'Baris Tujuh', '2022-03-20 14:00:27', '2022-03-20 14:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `plat_mobil` varchar(8) NOT NULL,
  `id_sopir` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(60) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`plat_mobil`, `id_sopir`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('BA1111LA', '1375015009090001', 'sopir1', 'sopir1@gmail.com', '$2a$12$b/Y2VdNvLgaBFnzBedGZYO8UVbsTjaWAhHi/CPImW6LwtfBdBYOHG', 'Sopir Satu', '081234564545', 'Laki-laki', '2022-03-08 14:32:29', '2022-03-08 14:32:29'),
('BA2222LA', '12234567889', 'sopir2', 'sopir2@gmail.com', '$2a$12$hrQKQzi.d3G7L8G3hkY/QO5Khp8PoV2HWrpShPh2uNoma3Z0pOBQK', 'Sopir Dua', '089745675656', 'Laki-laki', '2022-03-16 02:07:04', '2022-03-16 02:07:04'),
('BA3333LB', '3333333333333333', 'sopir3', 'sopir3@gmail.com', '$2y$10$rbABYyy/eBeConNFvGT1heLfAdze3IT7nG5gbD0BLYcs9jyB3Q0oK', 'Sopir Tiga', '080707676766', 'Laki-laki', '2022-03-20 23:54:06', '2022-03-20 23:54:06'),
('BA4444QA', '4444444444444444', 'sopir4', 'sopir4@gmail.com', '$2y$10$PZ6zbLcjmR9fvDSV6proQ.zXrkX91v2xADzlLLs54IWdRq1yotUVS', 'Sopir Empat', '081289764580', 'Laki-laki', '2022-03-20 23:40:18', '2022-03-20 23:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_kota_asal` char(2) NOT NULL,
  `id_kota_tujuan` char(2) NOT NULL,
  `tarif_trip` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`jadwal`, `plat_mobil`, `id_kota_asal`, `id_kota_tujuan`, `tarif_trip`, `created_at`, `updated_at`) VALUES
('2022-03-22 22:00:00', 'BA2222LA', 'K1', 'K2', 50000, '2022-03-20 14:43:38', '2022-03-22 10:31:33'),
('2022-03-22 22:00:00', 'BA3333LB', 'K2', 'K1', 50000, '2022-03-20 23:59:42', '2022-03-22 10:31:19'),
('2022-03-23 12:00:00', 'BA2222LA', 'K1', 'K2', 50000, '2022-03-20 23:59:10', '2022-03-21 13:59:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_pemesan`,`jadwal`,`plat_mobil`,`id_seat`) USING BTREE,
  ADD UNIQUE KEY `jadwal` (`jadwal`,`plat_mobil`,`id_seat`),
  ADD KEY `feeder_detail_pesanan_fk` (`id_feeder`),
  ADD KEY `pesanan_detail_pesanan_fk` (`id_pemesan`,`jadwal`,`plat_mobil`),
  ADD KEY `seat_detail_pesanan_fk` (`id_seat`) USING BTREE;

--
-- Indexes for table `feeder`
--
ALTER TABLE `feeder`
  ADD PRIMARY KEY (`id_feeder`),
  ADD UNIQUE KEY `feeder_idx` (`email`),
  ADD UNIQUE KEY `feeder_idx1` (`kontak`),
  ADD KEY `kota_feeder_fk` (`id_kota`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `mobil`
--
ALTER TABLE `mobil`
  ADD PRIMARY KEY (`plat_mobil`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kontak` (`kontak`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD UNIQUE KEY `pengurus_idx` (`email`),
  ADD UNIQUE KEY `pengurus_idx1` (`kontak`),
  ADD KEY `kota_pengurus_fk` (`id_kota`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pemesan`,`jadwal`,`plat_mobil`),
  ADD KEY `pengurus_pesanan_fk` (`id_pengurus`),
  ADD KEY `trip_pesanan_fk` (`jadwal`,`plat_mobil`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_kota_asal`,`id_kota_tujuan`),
  ADD KEY `kota_rute_fk1` (`id_kota_tujuan`),
  ADD KEY `kota_rute_fk` (`id_kota_asal`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id_seat`) USING BTREE;

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`plat_mobil`) USING BTREE,
  ADD UNIQUE KEY `sopir_idx` (`email`),
  ADD UNIQUE KEY `sopir_idx1` (`kontak`),
  ADD UNIQUE KEY `id_sopir` (`id_sopir`),
  ADD KEY `mobil_sopir_fk` (`plat_mobil`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`jadwal`,`plat_mobil`),
  ADD KEY `rute_trip_fk` (`id_kota_tujuan`,`id_kota_asal`),
  ADD KEY `mobil_trip_fk` (`plat_mobil`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `feeder_detail_pesanan_fk` FOREIGN KEY (`id_feeder`) REFERENCES `feeder` (`id_feeder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_detail_pesanan_fk` FOREIGN KEY (`id_pemesan`,`jadwal`,`plat_mobil`) REFERENCES `pesanan` (`id_pemesan`, `jadwal`, `plat_mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_detail_pesanan_fk` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feeder`
--
ALTER TABLE `feeder`
  ADD CONSTRAINT `kota_feeder_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `kota_pengurus_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pemesan_pesanan_fk` FOREIGN KEY (`id_pemesan`) REFERENCES `pemesan` (`id_pemesan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengurus_pesanan_fk` FOREIGN KEY (`id_pengurus`) REFERENCES `pengurus` (`id_pengurus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_pesanan_fk` FOREIGN KEY (`jadwal`,`plat_mobil`) REFERENCES `trip` (`jadwal`, `plat_mobil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `kota_rute_fk` FOREIGN KEY (`id_kota_asal`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kota_rute_fk1` FOREIGN KEY (`id_kota_tujuan`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sopir`
--
ALTER TABLE `sopir`
  ADD CONSTRAINT `mobil_sopir_fk` FOREIGN KEY (`plat_mobil`) REFERENCES `mobil` (`plat_mobil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `mobil_trip_fk` FOREIGN KEY (`plat_mobil`) REFERENCES `mobil` (`plat_mobil`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rute_trip_fk` FOREIGN KEY (`id_kota_tujuan`,`id_kota_asal`) REFERENCES `rute` (`id_kota_tujuan`, `id_kota_asal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
