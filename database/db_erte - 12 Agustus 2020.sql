-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2020 at 08:05 AM
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
-- Database: `db_erte`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_trip` varchar(5) NOT NULL,
  `id_seat` varchar(2) NOT NULL,
  `id_pesanan` varchar(5) NOT NULL,
  `id_users_feeder` varchar(5) DEFAULT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `detail_asal` varchar(191) NOT NULL,
  `detail_tujuan` varchar(191) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `biaya_tambahan` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_trip`, `id_seat`, `id_pesanan`, `id_users_feeder`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`, `created_at`, `updated_at`) VALUES
('T3', '1', 'P1', NULL, 'Satu_edit', 1, 'Alamat Satu Edit', 'Alamat Satu Edit', '081212121212', 5, NULL, '2020-06-25 05:27:27', '2020-08-11 03:32:27'),
('T3', '6', 'P1', NULL, 'Dua_Edit', 1, 'Alamat Dua Edit', 'Tujuan Dua Edit', NULL, 5, NULL, '2020-06-25 05:27:27', '2020-08-11 03:32:27'),
('T4', '1', 'P2', 'F1', 'Satu', 1, 'a', 'a', '08127676545', 1, '15000', '2020-07-04 03:39:47', '2020-07-10 00:16:50'),
('T4', '2', 'P2', 'F1', 'Dua', 2, 'd', 'w', NULL, 1, NULL, '2020-07-04 03:39:47', '2020-07-10 00:16:50'),
('T4', '3', 'P2', 'F1', 'Tiga', 1, 'e', 'e', NULL, 1, NULL, '2020-07-04 03:39:47', '2020-07-11 11:37:46'),
('T4', '4', 'P3', NULL, 'Penumpang 4', 2, 'Asalasal', 'hj', '073927489', 1, NULL, '2020-07-11 11:43:55', '2020-07-29 00:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `feeder`
--

CREATE TABLE `feeder` (
  `id_users` varchar(5) NOT NULL,
  `id_kota` varchar(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeder`
--

INSERT INTO `feeder` (`id_users`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('F1', 'K2', 'feeder1', 'feeder1@g.c', '$2y$10$G1efJ5EZyKDf5Z8gK2f6qun3IQzeVvPh/C5YdILHecmfT./qPo5Y.', 'Feeder Satu', '99', 1, '2020-06-21 00:18:08', '2020-06-21 00:18:08'),
('F2', 'K1', 'feeder2', 'feeder2@g.c', '$2y$10$25S2RGS9DJQgHRoUTIKWf.1awFCzwkfa/SVyjGZMK7m59Uzoy3R3C', 'Feeder Dua', '989', 1, '2020-06-30 02:47:00', '2020-06-30 02:47:00'),
('F3', 'K3', 'feeder3', 'feeder3@g.c', '$2y$10$/noiAd7qkjHEDmfknc5wJ.jxD6VasNaajVgSTdPVaaHy91QgH4FvS', 'Feeder Tiga', '89', 1, '2020-07-04 03:28:12', '2020-07-04 03:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` varchar(2) NOT NULL,
  `nama_kota` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `created_at`, `updated_at`) VALUES
('K1', 'Bukittinggi', NULL, NULL),
('K2', 'Padang', NULL, NULL),
('K3', 'Payakumbuh', '2020-03-04 07:14:36', '2020-03-04 07:14:36');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_users` varchar(5) NOT NULL,
  `id_kota` varchar(2) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_users`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('admin', 'K1', 'admin', 'admin@g.c', '$2y$10$pgIDX0tPMuCX8.FqHF5BI.VzjYI8GrrkIX4hnygA7l8rSWJuojo/6', 'Admin', '08976', 2, '2020-03-17 18:56:19', '2020-06-21 00:23:52'),
('O1', 'K1', 'operator1', 'operator1@g.c', '$2y$10$8AkaKioXdGrDFUcPdVaYi.GHHqh1C3nGmhqI3Cigkqk8q8m7i3Opy', 'Operator Satu', '84948', 2, '2020-06-21 00:09:40', '2020-08-03 07:48:35'),
('O2', 'K2', 'operator2', 'operator2@g.c', '$2y$10$SdvHws44sXI5iTLlBHX4x.YyP2XhOVF2elNZLM8EMm2T278XBrpYm', 'Operator Dua', '398', 1, '2020-06-21 00:14:08', '2020-08-03 07:48:46'),
('O3', 'K3', 'operator3', 'operator3@g.c', '$2y$10$FgtsecWBsCiVIvOCIjvGP.rfwMQQJ/rr3rMNu7gPBM4M2bzq6jk5m', 'Operator Tiga', '03794949', 1, '2020-08-03 07:49:16', '2020-08-03 07:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_users` varchar(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `alamat` varchar(254) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_users`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
('admin', 'admin', 'admin@g.c', '$2y$10$pgIDX0tPMuCX8.FqHF5BI.VzjYI8GrrkIX4hnygA7l8rSWJuojo/6', 'Admin', '08976', 1, 'Alamat Admin', NULL, NULL),
('O1', 'operator1', 'operator1@g.c', '$2y$10$8AkaKioXdGrDFUcPdVaYi.GHHqh1C3nGmhqI3Cigkqk8q8m7i3Opy', 'Operator Satu', '84948', 2, 'Alamat Operator', NULL, NULL),
('U1', 'pemesan1', 'pemesan1@g.c', '$2y$10$LUDvi214m5GpBPsyBr06xeQ1RmsVR0rSyQ66db5BWVdcd9415BW1O', 'Pemesan Satu', '087867564545', 2, 'LDKOM', '2020-07-10 05:52:51', '2020-07-10 05:52:51'),
('U2', 'pemesan2', 'pemesan2@g.c', '$2y$10$Bl.UWDwKhIfYzPkEdbcmiO6n.dqRrBOsOp8v8tCln0LBqVvFwY4i6', 'Pemesan Dua', '089745376589', 1, 'LDKOM', '2020-07-10 05:53:39', '2020-07-10 05:53:39'),
('U3', 'pemesan3', 'pemesan3@g.c', '$2y$10$MGOFi8YJjvfzDJVYcY8IuuggFuv1uHdMJxWImW3QN25SQdeV1xvNu', 'Pemesan Tiga', '098778900987', 2, 'Alamat Pemesan Tiga', '2020-07-11 11:39:41', '2020-07-11 11:39:41');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(5) NOT NULL,
  `id_trip` varchar(5) NOT NULL,
  `id_users_pemesan` varchar(5) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `id_users_operator` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_trip`, `id_users_pemesan`, `tanggal_pesan`, `id_users_operator`, `created_at`, `updated_at`, `deleted_at`) VALUES
('P1', 'T3', 'admin', '2020-06-25 12:27:27', 'admin', '2020-06-25 05:27:27', '2020-08-11 03:32:27', NULL),
('P2', 'T4', 'admin', '2020-07-04 10:39:47', 'admin', '2020-07-04 03:39:47', '2020-07-04 03:39:47', NULL),
('P3', 'T4', 'U3', '2020-07-11 18:43:55', 'admin', '2020-07-11 11:43:55', '2020-07-11 11:43:55', NULL),
('P4', 'T3', 'U1', '2020-08-12 12:27:37', 'O1', '2020-08-12 05:27:38', '2020-08-12 05:27:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_kota_asal` varchar(2) NOT NULL,
  `id_kota_tujuan` varchar(2) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_kota_asal`, `id_kota_tujuan`, `harga`, `created_at`, `updated_at`) VALUES
('K1', 'K2', '60000', '2020-03-26 10:08:38', '2020-03-26 10:08:38'),
('K1', 'K3', '40000', '2020-03-10 18:35:44', '2020-03-10 18:35:44'),
('K2', 'K1', '60000', '2020-03-04 13:32:10', '2020-03-10 00:30:26'),
('K2', 'K3', '70000', '2020-03-10 00:30:45', '2020-03-10 00:30:45'),
('K3', 'K1', '40000', '2020-03-26 10:09:17', '2020-03-26 10:09:17'),
('K3', 'K2', '70000', '2020-03-10 00:31:28', '2020-03-10 00:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` varchar(2) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id_seat`, `keterangan`, `created_at`, `updated_at`) VALUES
('1', 'Sebelah Sopir', '2020-03-09 23:40:24', '2020-05-01 08:25:26'),
('2', 'Baris Dua', '2020-03-09 23:40:43', '2020-05-01 08:25:36'),
('3', 'Baris Tiga', '2020-03-09 23:40:57', '2020-05-01 08:25:48'),
('4', 'Empat', '2020-04-22 00:46:25', '2020-05-01 08:25:58'),
('5', 'Lima', '2020-04-22 00:46:35', '2020-05-01 08:26:11'),
('6', 'Enam', '2020-04-22 00:46:46', '2020-05-01 08:26:21'),
('7', 'Tujuh', '2020-05-01 08:35:30', '2020-05-01 08:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `id_users` varchar(5) NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `merek_mobil` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id_users`, `plat_mobil`, `merek_mobil`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('S1', 'BA6709IP', 'Suzuki APV', 'sopir1', 'sopir1@g.c', '$2y$10$NdfSvo3szJJeETt3I5.w/eclNMTG3uo/oY/ExTfWHnGU8AFh/Yiya', 'Sopir Satu', '07855', 1, '2020-06-21 00:20:16', '2020-06-21 00:20:16'),
('S2', 'BA7777BA', 'Xenia', 'sopir2', 'sopir2@g.c', '$2y$10$3iIYyU9rvjwWPdzfO83.pOYm.N3WsJpDd4fL2yOEeRw8R3F6tlp9W', 'Sopir Dua', '06928282', 1, '2020-08-05 02:58:58', '2020-08-05 02:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id_trip` varchar(5) NOT NULL,
  `id_users_operator` varchar(5) NOT NULL,
  `id_users_sopir` varchar(5) DEFAULT NULL,
  `id_kota_asal` varchar(2) NOT NULL,
  `id_kota_tujuan` varchar(2) NOT NULL,
  `jadwal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id_trip`, `id_users_operator`, `id_users_sopir`, `id_kota_asal`, `id_kota_tujuan`, `jadwal`, `created_at`, `updated_at`) VALUES
('T1', 'admin', NULL, 'K1', 'K2', '2020-08-12 12:18:00', '2020-06-25 05:18:29', '2020-08-12 02:27:57'),
('T2', 'O1', 'S2', 'K1', 'K3', '2020-08-07 12:18:00', '2020-06-25 05:18:48', '2020-08-07 12:38:16'),
('T3', 'admin', 'S1', 'K1', 'K2', '2020-08-12 12:18:00', '2020-06-25 05:19:09', '2020-08-12 02:27:44'),
('T4', 'admin', NULL, 'K2', 'K1', '2020-08-20 07:39:00', '2020-06-30 00:39:55', '2020-07-27 05:22:44'),
('T5', 'admin', 'S1', 'K1', 'K2', '2020-08-20 09:30:00', '2020-07-12 02:30:41', '2020-07-27 05:23:00'),
('T6', 'admin', NULL, 'K1', 'K2', '2020-08-20 10:57:00', '2020-08-03 03:57:28', '2020-08-11 10:59:36'),
('T7', 'admin', NULL, 'K2', 'K1', '2020-08-03 18:31:00', '2020-08-03 07:31:50', '2020-08-03 07:31:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_trip`,`id_seat`),
  ADD KEY `feeder_detail_pesanan_fk` (`id_users_feeder`),
  ADD KEY `pesanan_detail_pesanan_fk` (`id_pesanan`,`id_trip`),
  ADD KEY `seat_detail_pesanan_fk` (`id_seat`);

--
-- Indexes for table `feeder`
--
ALTER TABLE `feeder`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kontak` (`kontak`),
  ADD KEY `kota_feeder_fk` (`id_kota`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kontak` (`kontak`),
  ADD KEY `kota_operator_fk` (`id_kota`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kontak` (`kontak`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`,`id_trip`),
  ADD UNIQUE KEY `pesanan_idx` (`id_trip`,`id_users_pemesan`) USING BTREE,
  ADD KEY `operator_pesanan_fk` (`id_users_operator`),
  ADD KEY `pemesan_pesanan_fk` (`id_users_pemesan`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_kota_asal`,`id_kota_tujuan`),
  ADD UNIQUE KEY `id_kota_asal` (`id_kota_asal`,`id_kota_tujuan`),
  ADD KEY `kota_rute_fk` (`id_kota_asal`),
  ADD KEY `kota_rute_fk1` (`id_kota_tujuan`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id_seat`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kontak` (`kontak`),
  ADD UNIQUE KEY `plat_mobil` (`plat_mobil`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id_trip`),
  ADD UNIQUE KEY `trip_idx` (`jadwal`,`id_users_sopir`),
  ADD KEY `operator_trip_fk` (`id_users_operator`),
  ADD KEY `rute_trip_fk` (`id_kota_asal`,`id_kota_tujuan`),
  ADD KEY `sopir_trip_fk` (`id_users_sopir`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `feeder_detail_pesanan_fk` FOREIGN KEY (`id_users_feeder`) REFERENCES `feeder` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_detail_pesanan_fk` FOREIGN KEY (`id_pesanan`,`id_trip`) REFERENCES `pesanan` (`id_pesanan`, `id_trip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_detail_pesanan_fk` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feeder`
--
ALTER TABLE `feeder`
  ADD CONSTRAINT `kota_feeder_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `kota_operator_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `operator_pesanan_fk` FOREIGN KEY (`id_users_operator`) REFERENCES `operator` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemesan_pesanan_fk` FOREIGN KEY (`id_users_pemesan`) REFERENCES `pemesan` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trip_pesanan_fk` FOREIGN KEY (`id_trip`) REFERENCES `trip` (`id_trip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `kota_rute_fk` FOREIGN KEY (`id_kota_asal`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kota_rute_fk1` FOREIGN KEY (`id_kota_tujuan`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `operator_trip_fk` FOREIGN KEY (`id_users_operator`) REFERENCES `operator` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rute_trip_fk` FOREIGN KEY (`id_kota_asal`,`id_kota_tujuan`) REFERENCES `rute` (`id_kota_asal`, `id_kota_tujuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sopir_trip_fk` FOREIGN KEY (`id_users_sopir`) REFERENCES `sopir` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
