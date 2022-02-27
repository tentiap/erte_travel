-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2022 at 01:17 AM
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
-- Database: `db_18Jan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_seat` char(2) NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_pemesan` char(16) NOT NULL,
  `jadwal` datetime NOT NULL,
  `id_feeder` char(16) NOT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `detail_asal` varchar(191) NOT NULL,
  `detail_tujuan` varchar(191) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status` char(1) NOT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `jenis_kelamin` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` char(2) NOT NULL,
  `nama_kota` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `plat_mobil` varchar(8) NOT NULL,
  `id_sopir` char(16) NOT NULL,
  `merek_mobil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `alamat` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `jenis_kelamin` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pemesan` char(16) NOT NULL,
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_pengurus` char(16) DEFAULT NULL,
  `tanggal_pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_kota_asal` char(2) NOT NULL,
  `id_kota_tujuan` char(2) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` char(2) NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `id_sopir` char(16) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` char(60) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_kota_asal` char(2) NOT NULL,
  `id_kota_tujuan` char(2) NOT NULL,
  `tarif_trip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_seat`,`plat_mobil`,`id_pemesan`,`jadwal`),
  ADD KEY `feeder_detail_pesanan_fk` (`id_feeder`),
  ADD KEY `seat_detail_pesanan_fk` (`plat_mobil`,`id_seat`),
  ADD KEY `pesanan_detail_pesanan_fk` (`id_pemesan`,`jadwal`,`plat_mobil`);

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
  ADD PRIMARY KEY (`plat_mobil`),
  ADD KEY `sopir_mobil_fk` (`id_sopir`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_pemesan`),
  ADD UNIQUE KEY `pemesan_idx` (`email`),
  ADD UNIQUE KEY `pemesan_idx1` (`kontak`);

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
  ADD KEY `kota_rute_fk1` (`id_kota_tujuan`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`id_seat`,`plat_mobil`),
  ADD KEY `mobil_seat_fk` (`plat_mobil`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
  ADD PRIMARY KEY (`id_sopir`),
  ADD UNIQUE KEY `sopir_idx` (`email`),
  ADD UNIQUE KEY `sopir_idx1` (`kontak`);

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
  ADD CONSTRAINT `seat_detail_pesanan_fk` FOREIGN KEY (`plat_mobil`,`id_seat`) REFERENCES `seat` (`plat_mobil`, `id_seat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feeder`
--
ALTER TABLE `feeder`
  ADD CONSTRAINT `kota_feeder_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mobil`
--
ALTER TABLE `mobil`
  ADD CONSTRAINT `sopir_mobil_fk` FOREIGN KEY (`id_sopir`) REFERENCES `sopir` (`id_sopir`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `mobil_seat_fk` FOREIGN KEY (`plat_mobil`) REFERENCES `mobil` (`plat_mobil`) ON DELETE CASCADE ON UPDATE CASCADE;

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
