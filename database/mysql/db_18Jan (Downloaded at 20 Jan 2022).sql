-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2022 at 06:33 AM
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
  `id_feeder` char(16) DEFAULT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `detail_asal` varchar(191) NOT NULL,
  `detail_tujuan` varchar(191) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `status` char(1) NOT NULL,
  `biaya_tambahan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_seat`, `plat_mobil`, `id_pemesan`, `jadwal`, `id_feeder`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`) VALUES
('1', 'BA1111LA', '1223345634563452', '2022-01-18 12:00:00', '1000000000000000', 'Penumpang 2', 'Perempuan', 'Asal', 'Tujuan', '087867676767', '1', NULL),
('1', 'BA1111LA', '1123345634563451', '2022-01-19 07:00:00', NULL, 'a', '1', '1', '1', '1', '1', NULL),
('1', 'BA1111LA', '1123345634563451', '2022-01-19 12:00:00', NULL, '1', '1', '1', '1', '1', '1', NULL),
('1', 'BA1111LA', '1123345634563451', '2022-01-20 08:00:00', NULL, '1', '1', '1', '1', '1', '1', NULL),
('2', 'BA1111LA', '1123345634563451', '2022-01-18 12:00:00', '1000000000000000', 'a', '1', '1', '1', '2', '2', NULL),
('3', 'BA1111LA', '1123345634563451', '2022-01-18 12:00:00', '1000000000000000', 'a', 'a', 'a', 'a', '1', '1', NULL),
('4', 'BA1111LA', '1123345634563451', '2022-01-18 12:00:00', '1000000000000000', '1', '1', '1', '1', '1', '1', NULL),
('5', 'BA1111LA', '1123345634563451', '2022-01-18 12:00:00', '1000000000000000', '1', '1', '1', '1', '1', '1', NULL),
('6', 'BA1111LA', '1123345634563451', '2022-01-18 12:00:00', '1000000000000000', '1', '1', '1', '1', '1', '1', NULL),
('7', 'BA1111LA', '1123345634563451', '2022-01-18 12:00:00', '1000000000000000', '1', '1', '1', '1', '1', '1', NULL),
('7', 'BA1111LA', '1123345634563451', '2022-01-20 08:00:00', NULL, '1', '1', '1', '1', '1', '1', NULL);

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

--
-- Dumping data for table `feeder`
--

INSERT INTO `feeder` (`id_feeder`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`) VALUES
('1000000000000000', 'K1', 'feeder1', 'feeder1@gmail.com', '$2a$12$GnBe1xbMH/dSjzZV5O8yUufYWggxf70MkVkHx4OX/VbwMe8cEN1.C', 'Feeder Satu', '081234345656', 'Laki-laki'),
('2000000000000000', 'K2', 'feeder2', 'feeder2@gmail.com', '$2a$12$tX2DyU3fPn40fVSJHFMHPO4//6S51dywSdEFMPL35ADmdetFpa4D2', 'Feeder Dua', '08127878676765', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` char(2) NOT NULL,
  `nama_kota` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
('K1', 'Bukittinggi'),
('K2', 'Padang'),
('K3', 'Pekanbaru');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `plat_mobil` varchar(8) NOT NULL,
  `id_sopir` char(16) NOT NULL,
  `merek_mobil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`plat_mobil`, `id_sopir`, `merek_mobil`) VALUES
('BA1111LA', '1000000000000000', 'Suzuki APV'),
('BA2222LA', '2000000000000000', 'Suzuki APV');

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

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_pemesan`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `alamat`) VALUES
('1123345634563451', 'pemesan1', 'pemesan1@gmail.com', '$2a$12$ar1/DXJuMjxUCidx.osXlOCWobpCO2Px0Ub9AatMvNRkyABECQIpe', 'Pemesan Satu', '081267675656', 'Perempuan', 'Alamat Pemesan 1'),
('1223345634563452', 'pemesan2', 'pemesan2@gmail.com', '$2a$12$qkELQaNx5jlq9rYdiJmSQ.1R8SSWlNUZ.HmdzlegEQO2xZTtOePAe', 'Pemesan Dua', '087867655434', 'Laki-laki', 'Alamat Pemesan 2'),
('3', '1', '1', '1', '1', '', '1', '1');

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

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`) VALUES
('1000000', 'K1', 'pengurus1', 'pengurus1@gmail.com', '$2a$12$qDZkSasMpGJP4kzfSvOKs.BfN6SI8DYpYyNLO2Y3aUycxRbvfVpn.', 'Pengurus Satu', '081212121212', 'Laki-laki'),
('2000000', 'K2', 'pengurus2', 'pengurus2@gmail.com', '$2a$12$0b0ah0OB7JcPdVvr75WKb.VPyDrQkGlM6vDcoL8rx5BURack5LKpW', 'Pengurus Dua', '081234542343', 'Perempuan');

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

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pemesan`, `jadwal`, `plat_mobil`, `id_pengurus`, `tanggal_pesan`) VALUES
('1123345634563451', '2022-01-18 12:00:00', 'BA1111LA', NULL, '2022-01-18 09:42:08'),
('1123345634563451', '2022-01-18 12:00:00', 'BA2222LA', NULL, '2022-01-18 09:43:14'),
('1123345634563451', '2022-01-19 07:00:00', 'BA1111LA', NULL, '2022-01-19 07:23:30'),
('1123345634563451', '2022-01-19 12:00:00', 'BA1111LA', NULL, '2022-01-19 07:30:01'),
('1123345634563451', '2022-01-20 08:00:00', 'BA1111LA', NULL, '2022-01-19 07:23:30'),
('1223345634563452', '2022-01-18 12:00:00', 'BA1111LA', NULL, '2022-01-18 09:42:08'),
('1223345634563452', '2022-01-18 12:00:00', 'BA2222LA', NULL, '2022-01-18 09:43:14'),
('3', '2022-01-19 12:00:00', 'BA1111LA', NULL, '2022-01-20 06:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_kota_asal` char(2) NOT NULL,
  `id_kota_tujuan` char(2) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_kota_asal`, `id_kota_tujuan`, `tarif`) VALUES
('K1', 'K2', 50000),
('K2', 'K1', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` char(2) NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id_seat`, `plat_mobil`, `keterangan`) VALUES
('1', 'BA1111LA', 'Satu'),
('1', 'BA2222LA', '1'),
('2', 'BA1111LA', 'Dua'),
('2', 'BA2222LA', '2'),
('3', 'BA1111LA', '3'),
('3', 'BA2222LA', '3'),
('4', 'BA1111LA', '4'),
('4', 'BA2222LA', '4'),
('5', 'BA1111LA', '5'),
('5', 'BA2222LA', '5'),
('6', 'BA1111LA', '6'),
('6', 'BA2222LA', '6'),
('7', 'BA1111LA', '7'),
('7', 'BA2222LA', '7');

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

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id_sopir`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`) VALUES
('1000000000000000', 'sopir1', 'sopir1@gmail.com', '$2a$12$MdwbXq69jUS2Ai8ehd46HuId1T4B3izIgS1Cqt3wxSBWsS7wnZY1i', 'Sopir Satu', '089890900000', 'Laki-laki'),
('2000000000000000', 'sopir2', 'sopir2@gmail.com', '$2a$12$aGqfuVE32PSHyLCbhX5.teKhw1wqsh.XbDUNHxDrJmp2MSnTuo9IG', 'Sopir Dua', '081212121212', 'Laki-laki');

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
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`jadwal`, `plat_mobil`, `id_kota_asal`, `id_kota_tujuan`, `tarif_trip`) VALUES
('2022-01-18 12:00:00', 'BA1111LA', 'K1', 'K2', 50000),
('2022-01-18 12:00:00', 'BA2222LA', 'K2', 'K1', 50000),
('2022-01-19 07:00:00', 'BA1111LA', 'K1', 'K2', 50000),
('2022-01-19 12:00:00', 'BA1111LA', 'K1', 'K2', 50000),
('2022-01-20 08:00:00', 'BA1111LA', 'K1', 'K2', 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_seat`,`plat_mobil`,`jadwal`) USING BTREE,
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
  ADD KEY `kota_rute_fk1` (`id_kota_tujuan`),
  ADD KEY `kota_rute_fk` (`id_kota_asal`);

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
