-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2020 at 04:26 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `id_users_feeder` varchar(5) DEFAULT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` int(1) NOT NULL,
  `detail_asal` varchar(254) NOT NULL,
  `detail_tujuan` varchar(254) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `status` int(1) NOT NULL,
  `biaya_tambahan` decimal(10,0) DEFAULT NULL,
  `id_pesanan` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_trip`, `id_seat`, `id_users_feeder`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`, `id_pesanan`, `created_at`, `updated_at`) VALUES
('T1', 'S1', NULL, 'Penumpang Satu Trip Satu', 1, 'Detail Asal', 'Detail Tujuan', NULL, 1, NULL, '1', NULL, NULL),
('T1', 'S2', NULL, 'Penumpang Satu', 1, 'Detail Asal', 'Detail Tujuan', NULL, 1, NULL, '1', NULL, NULL);

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
('F1', 'K1', 'feeder1', 'feeder1@g.c', 'feeder1', 'Feeder Satu', '08786765467', 1, '2020-03-17 22:10:45', '2020-03-17 22:10:45'),
('F2', 'K2', 'feeder2', 'feeder2@g.c', 'feeder2', 'Feeder Dua', '082286219618', 1, '2020-03-17 22:11:13', '2020-03-17 22:11:13');

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
('admin', 'K1', 'admin', 'admin@g.c', '$2y$10$pgIDX0tPMuCX8.FqHF5BI.VzjYI8GrrkIX4hnygA7l8rSWJuojo/6', 'Admin', '089', 2, '2020-03-17 18:56:19', '2020-03-17 21:44:03'),
('O1', 'K1', 'operator1', 'operator1@g.c', '$2y$10$LNSQzY4XkwRtl4cy0sjHv.9eyu6KgSGJ7IbwudZHp2Y7zB1b9Qhqu', 'Operator Satu', '0863933893', 2, '2020-03-17 21:16:25', '2020-03-17 21:16:25'),
('O2', 'K1', 'operator2', 'operator2@g.c', '$2y$10$SbkdKumgrBT6GSfOMRAaCeBvoFIXGeiTrRUxwIRBJ1xXCZF04rt9W', 'Operator Dua', '089767875676', 1, '2020-03-17 21:17:01', '2020-03-17 21:43:42');

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
('U1', 'pemesan1', 'pemesan1@g.c', 'pemesan1', 'Pemesan Satu', '08975899', 1, 'Jurusan Fisika', '2020-03-17 22:18:18', '2020-03-17 22:18:18'),
('U2', 'pemesan2', 'pemesan2@g.c', 'pemesan2', 'Pemesan Dua', '7498349348', 1, 'Jurusan Teknik Mesin', '2020-03-17 22:18:52', '2020-03-17 22:18:52');

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
('1', 'T1', 'U1', '2020-04-01 13:42:14', 'admin', NULL, NULL, NULL);

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
('S1', 'Sebelah Sopir', '2020-03-09 23:40:24', '2020-03-09 23:40:24'),
('S2', 'Baris Dua', '2020-03-09 23:40:43', '2020-03-09 23:40:43'),
('S3', 'Baris Tiga', '2020-03-09 23:40:57', '2020-03-09 23:40:57');

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
('S1', 'BA6789OP', 'Suzuki Swift', 'sopir1', 'sopir1@g.c', 'sopir1', 'Sopir Satu', '08987646865', 1, '2020-03-17 21:56:12', '2020-03-17 21:56:12'),
('S2', 'Ba6786GH', 'Xenia', 'sopir2', 'sopir2@g.c', 'sopir2', 'Sopir Dua', '07394733', 1, '2020-03-17 21:56:51', '2020-03-17 21:56:51');

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
('T1', 'admin', 'S1', 'K3', 'K1', '2020-03-18 13:47:00', '2020-03-17 23:47:31', '2020-03-31 23:42:38'),
('T2', 'admin', 'S1', 'K2', 'K3', '2020-04-01 09:00:00', '2020-03-26 10:12:36', '2020-03-31 19:23:37'),
('T3', 'admin', 'S2', 'K1', 'K2', '2020-04-01 09:00:00', '2020-03-28 19:17:56', '2020-03-28 19:32:54'),
('T4', 'admin', NULL, 'K3', 'K2', '2020-04-05 16:00:00', '2020-04-03 02:32:12', '2020-04-03 02:32:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_trip`,`id_seat`),
  ADD KEY `seat_detail_pesanan_fk` (`id_seat`),
  ADD KEY `feeder_detail_pesanan_fk` (`id_users_feeder`),
  ADD KEY `pesanan_detail_pesanan_fk` (`id_pesanan`,`id_trip`);

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
  ADD KEY `pemesan_pesanan_fk` (`id_users_pemesan`),
  ADD KEY `operator_pesanan_fk` (`id_users_operator`);

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
  ADD CONSTRAINT `feeder_detail_pesanan_fk` FOREIGN KEY (`id_users_feeder`) REFERENCES `feeder` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pesanan_detail_pesanan_fk` FOREIGN KEY (`id_pesanan`,`id_trip`) REFERENCES `pesanan` (`id_pesanan`, `id_trip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seat_detail_pesanan_fk` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `operator_pesanan_fk` FOREIGN KEY (`id_users_operator`) REFERENCES `operator` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pemesan_pesanan_fk` FOREIGN KEY (`id_users_pemesan`) REFERENCES `pemesan` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `trip_pesanan_fk` FOREIGN KEY (`id_trip`) REFERENCES `trip` (`id_trip`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
