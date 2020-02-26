-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2020 at 08:45 AM
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
-- Database: `erte_travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_trip` varchar(5) NOT NULL,
  `id_seat` varchar(2) NOT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `detail_asal` varchar(254) NOT NULL,
  `detail_tujuan` varchar(254) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `biaya_tambahan` decimal(10,0) DEFAULT NULL,
  `username_feeder` varchar(15) DEFAULT NULL,
  `id_pesanan` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_trip`, `id_seat`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`, `username_feeder`, `id_pesanan`, `created_at`, `updated_at`) VALUES
('T0001', 'S1', 'Penumpang Satu Trip Satu', 1, 'Detail Asal 1-1', 'Detail Tujuan 1-1', NULL, 1, '0', NULL, '1', NULL, NULL),
('T0001', 'S2', 'Penumpang Satu Trip Satu', 1, 'Detail Asal', 'Detail Tujuan', NULL, 1, NULL, NULL, '1', NULL, NULL),
('T0001', 'S3', 'Tiga', 2, 'a', 'a', NULL, 1, NULL, NULL, '1', NULL, NULL),
('T0001', 'S4', 'Q', 2, '1', '1', NULL, 1, NULL, NULL, '2', NULL, NULL),
('T0002', 'S1', 'a', 1, '1', '1', NULL, 1, NULL, NULL, '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feeder`
--

CREATE TABLE `feeder` (
  `username` varchar(15) NOT NULL,
  `id_kota` varchar(2) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeder`
--

INSERT INTO `feeder` (`username`, `id_kota`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('feeder1', 'K1', 'feeder1@g.c', '$2y$12$yNDtUccAKEAYIh5P5KVD5eABaEIL8IdgDKCO8yCmHYaxtBaQfreAi', 'Feeder Satu', '089756764565', 1, NULL, NULL),
('feeder2', 'K2', 'feeder2@g.c', '$2y$12$S37phesstxadcPvUEoLPSeW0u4DCWS2twNtKh.90Bwf7cgb/fO4iO\r\n', 'Feeder Dua', '089856764565', 2, NULL, NULL);

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
('K3', 'Payakumbuh', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `username` varchar(15) NOT NULL,
  `id_kota` varchar(2) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`username`, `id_kota`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('operator1', 'K1', 'operator1@g.c', '$2y$12$w4k7VQSxETjTwLyvso3qYOBcLreWcmtL77bsMLcjMcvfCnhMvE/aK\r\n', 'Operator Satu', '089756765456', 1, NULL, NULL),
('operator2', 'K2', 'operator2@g.c', '$2y$12$.Y2C8Ys5vBtPQT.pCVIScuaijvXz5UPFkLvtiHq6jfkMawgoiz1ey', 'Operator Dua', '078965453456', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
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

INSERT INTO `pemesan` (`username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
('pemesan1', 'pemesan1@g.c', '$2y$12$0BtWCN/bnDJ1FMJcOxd3CuHJaPBMwe9jaAASEE02XRTOP5bRvRXQa\r\n', 'Pemesan Satu', '087678985678', 2, 'Alamat Satu', NULL, NULL),
('pemesan2', 'pemesan2@g.c', '$2y$12$uUwMLyaROvCqUmHDoLLzB.Aq/lyqGV8l6grYUEHkMjPxcm.bgSel2\r\n', 'Pemesan Dua', '089876567654', 2, 'Alamat Dua', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(5) NOT NULL,
  `id_trip` varchar(5) NOT NULL,
  `username_pemesan` varchar(15) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_trip`, `username_pemesan`, `tanggal_pesan`, `created_at`, `updated_at`) VALUES
('1', 'T0001', 'pemesan1', '2020-01-29 04:00:00', NULL, NULL),
('2', 'T0001', 'pemesan2', '2020-01-29 05:00:00', NULL, NULL),
('3', 'T0002', 'pemesan1', '2020-01-29 14:21:48', NULL, NULL);

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
('K1', 'K2', '0', NULL, NULL),
('K2', 'K1', '0', NULL, NULL);

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
('S1', 'Sebelah Sopir', NULL, NULL),
('S2', 'Tengah Kiri', NULL, NULL),
('S3', 'Tiga', NULL, NULL),
('S4', 'Empat', NULL, NULL),
('S5', 'Lima', NULL, NULL),
('S6', 'Enam', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `plat_mobil` varchar(8) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(300) NOT NULL,
  `kontak` varchar(13) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`plat_mobil`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('BA6789OO', 'driver1', 'driver1@g.c', '$2y$12$FiiYDpk2hrfTMhlW3DpEd.7nbyPOL.NXaTQkQ6Tyur08LKga0qT7K', 'Driver Satu', '089767875676', 1, NULL, NULL),
('BA9999UU', 'driver2', 'driver2@g.c', '$2y$12$KfFCoobIQE4tQIwHeey0mO4VTP/mS3KHLGrBJ.sE6VFZ2z0Npev5u', 'Driver Dua', '078967875676', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id_trip` varchar(5) NOT NULL,
  `id_kota_asal` varchar(2) NOT NULL,
  `id_kota_tujuan` varchar(2) NOT NULL,
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) DEFAULT NULL,
  `username_operator` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id_trip`, `id_kota_asal`, `id_kota_tujuan`, `jadwal`, `plat_mobil`, `username_operator`, `created_at`, `updated_at`) VALUES
('T0001', 'K2', 'K1', '2020-01-15 03:00:00', 'BA6789OO', 'operator1', NULL, NULL),
('T0002', 'K2', 'K1', '2020-01-15 11:00:00', 'BA6789OO', 'operator1', NULL, NULL),
('T0003', 'K1', 'K2', '2020-01-15 04:00:00', 'BA6789OO', 'operator2', NULL, NULL),
('T0004', 'K1', 'K2', '2020-01-15 05:00:00', 'BA9999UU', 'operator2', NULL, NULL),
('T0005', 'K2', 'K1', '2020-01-15 03:00:00', 'BA9999UU', 'operator1', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_trip`,`id_seat`),
  ADD KEY `feeder_detail_pesanan_fk` (`username_feeder`),
  ADD KEY `pesanan_detail_pesanan_fk` (`id_pesanan`,`id_trip`),
  ADD KEY `seat_detail_pesanan_fk` (`id_seat`);

--
-- Indexes for table `feeder`
--
ALTER TABLE `feeder`
  ADD PRIMARY KEY (`username`),
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
  ADD PRIMARY KEY (`username`),
  ADD KEY `kota_operator_fk` (`id_kota`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`,`id_trip`),
  ADD UNIQUE KEY `pesanan_idx` (`id_trip`,`username_pemesan`),
  ADD KEY `pemesan_pesanan_fk` (`username_pemesan`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_kota_asal`,`id_kota_tujuan`),
  ADD UNIQUE KEY `id_kota_asal` (`id_kota_asal`,`id_kota_tujuan`),
  ADD KEY `kota_rute_fk1` (`id_kota_tujuan`),
  ADD KEY `kota_rute_fk` (`id_kota_asal`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id_seat`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`plat_mobil`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id_trip`),
  ADD UNIQUE KEY `trip_idx` (`jadwal`,`plat_mobil`),
  ADD KEY `rute_trip_fk` (`id_kota_asal`,`id_kota_tujuan`),
  ADD KEY `operator_trip_fk` (`username_operator`),
  ADD KEY `sopir_trip_fk` (`plat_mobil`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `feeder_detail_pesanan_fk` FOREIGN KEY (`username_feeder`) REFERENCES `feeder` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_detail_pesanan_fk` FOREIGN KEY (`id_pesanan`,`id_trip`) REFERENCES `pesanan` (`id_pesanan`, `id_trip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_detail_pesanan_fk` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feeder`
--
ALTER TABLE `feeder`
  ADD CONSTRAINT `kota_feeder_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `kota_operator_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pemesan_pesanan_fk` FOREIGN KEY (`username_pemesan`) REFERENCES `pemesan` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `operator_trip_fk` FOREIGN KEY (`username_operator`) REFERENCES `operator` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rute_trip_fk` FOREIGN KEY (`id_kota_asal`,`id_kota_tujuan`) REFERENCES `rute` (`id_kota_asal`, `id_kota_tujuan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sopir_trip_fk` FOREIGN KEY (`plat_mobil`) REFERENCES `sopir` (`plat_mobil`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
