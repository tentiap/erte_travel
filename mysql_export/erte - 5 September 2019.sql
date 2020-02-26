-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2019 at 05:23 PM
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
-- Database: `erte`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_trip` varchar(5) NOT NULL,
  `id_users_pemesan` varchar(5) NOT NULL,
  `id_seat` varchar(2) NOT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `detail_asal` varchar(254) NOT NULL,
  `detail_tujuan` varchar(254) NOT NULL,
  `biaya_tambahan` decimal(10,0) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_trip`, `id_users_pemesan`, `id_seat`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `biaya_tambahan`, `status`, `no_hp`, `created_at`, `updated_at`) VALUES
('T0001', 'P0001', 'S1', 'Penumpang Satu', 1, 'Jalan raya Padang-Bukittinggi km 6', 'Jalan nama jalan Bukitttinggi', NULL, 1, NULL, NULL, NULL),
('T0002', 'P0002', 'S2', 'Penumpang Dua', 2, 'Jalan nama jalan di Padang', 'Jalan nama jalan di Bukittinggi', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feeder`
--

CREATE TABLE `feeder` (
  `id_users` varchar(5) NOT NULL,
  `id_kota` varchar(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeder`
--

INSERT INTO `feeder` (`id_users`, `id_kota`, `created_at`, `updated_at`) VALUES
('F0001', 'K1', NULL, NULL);

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
('K3', 'Pekanbaru', NULL, NULL),
('K4', 'Bandara', '2019-08-10 21:45:23', '2019-08-10 21:45:23'),
('K5', 'Payakumbuh', '2019-08-13 21:05:53', '2019-08-13 21:05:53'),
('K6', 'LPTIK', '2019-08-14 15:53:33', '2019-09-05 06:10:36'),
('K7', 'LPTIK Lagi', '2019-09-05 06:15:30', '2019-09-05 06:15:30');

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id_users` varchar(5) NOT NULL,
  `id_kota` varchar(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id_users`, `id_kota`, `created_at`, `updated_at`) VALUES
('O0001', 'K2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesan`
--

CREATE TABLE `pemesan` (
  `id_users` varchar(5) NOT NULL,
  `alamat` varchar(254) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_users`, `alamat`, `created_at`, `updated_at`) VALUES
('P0001', 'LDKOM', NULL, NULL),
('P0002', 'LPTIK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_trip` varchar(5) NOT NULL,
  `id_users_pemesan` varchar(5) NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_trip`, `id_users_pemesan`, `tanggal_pesan`, `created_at`, `updated_at`) VALUES
('T0001', 'P0001', '2019-08-07 08:00:00', NULL, NULL),
('T0002', 'P0002', '2019-08-07 06:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `id_rute` varchar(2) NOT NULL,
  `id_kota_asal` varchar(2) NOT NULL,
  `id_kota_tujuan` varchar(2) DEFAULT NULL,
  `harga` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id_rute`, `id_kota_asal`, `id_kota_tujuan`, `harga`, `created_at`, `updated_at`) VALUES
('R1', 'K2', 'K1', '50000', '2019-08-17 03:41:00', '0000-00-00 00:00:00'),
('R2', 'K1', 'K2', '50000', '2019-08-17 03:41:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` varchar(2) NOT NULL,
  `posisi` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id_seat`, `posisi`, `created_at`, `updated_at`) VALUES
('S1', '1', NULL, NULL),
('S2', '2', NULL, NULL),
('S3', '3', NULL, NULL),
('S4', 'Di Tengah Baris Kedua', NULL, '2019-09-04 23:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE `sopir` (
  `id_users` varchar(5) NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `merek_mobil` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id_users`, `plat_mobil`, `merek_mobil`, `created_at`, `updated_at`) VALUES
('D0001', 'BA5678WR', 'Toyota Rush', NULL, '2019-09-04 22:44:26'),
('D0002', 'BA7909NM', 'Toyota Rush', '2019-09-04 20:55:52', '2019-09-04 20:55:52'),
('D0003', 'BA6745GK', 'Suzuki APV', '2019-09-04 21:03:18', '2019-09-04 21:07:28'),
('D0004', 'BA6789OO', 'Suzuki Swift', '2019-09-04 04:52:13', '2019-09-04 04:52:13'),
('D0005', 'BB6786GH', 'Suzuki Swift', '2019-09-04 22:48:06', '2019-09-04 22:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id_trip` varchar(5) NOT NULL,
  `id_users_operator` varchar(5) NOT NULL,
  `id_users_sopir` varchar(5) NOT NULL,
  `id_users_feeder` varchar(5) NOT NULL,
  `id_rute` varchar(2) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id_trip`, `id_users_operator`, `id_users_sopir`, `id_users_feeder`, `id_rute`, `tanggal`, `jam`, `created_at`, `updated_at`) VALUES
('T0001', 'O0001', 'D0001', 'F0001', 'R1', '2019-08-08', '12:00:00', NULL, NULL),
('T0002', 'O0001', 'D0001', 'F0001', 'R1', '2019-08-08', '12:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` varchar(5) NOT NULL,
  `role` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kontak` varchar(12) NOT NULL,
  `jenis_kelamin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `role`, `username`, `password`, `email`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('D0001', 2, 'driver1', '$2y$10$oHa7GwjPDi6cLCpwo6fueOZCvcOzPjlm8oZAQajnDAPiAmh6pHfN6', 'driver1@g.c', 'Driver Satu', '082286219618', 1, NULL, '2019-09-04 22:45:36'),
('D0002', 2, 'driver2', '$2y$10$swvfIS8tnDCU1mD9lTJHs.4c5HkgV4Z8OXyr8cd3CB/IE8avVxBN6', 'driver2@g.c', 'Driver Dua', '082286219618', 1, '2019-09-04 20:55:52', '2019-09-04 20:56:46'),
('D0003', 2, 'driver3', '$2y$10$f/lBQykuQjUsoV5sKfwj4ushFIpGhuwKQMvqkOz4mciROgp6EH8eK', 'driver3@g.c', 'Driver Tiga', '082286219618', 1, '2019-09-04 21:03:18', '2019-09-04 22:43:03'),
('D0004', 2, 'driver4', '$2y$10$PhD.xoPWCxdvHdzeWCp6AOj5Lv6tqpL9DIO.J3IgnueHd0w1UH8ZW', 'driver4@g.c', 'Driver Empat', '089787654567', 1, '2019-09-04 04:52:13', '2019-09-04 20:57:31'),
('D0005', 2, 'driver5', '$2y$10$GvX2thg2OKJVh15EOgVL6eGKvQCSYRldhp8V8mrZX8ZnrMBfq2YwG', 'driver5@g.c', 'Driver Lima', '082286219618', 1, '2019-09-04 22:48:06', '2019-09-04 22:48:06'),
('F0001', 3, 'feeder1', 'feeder1', 'feeder1@g.c', 'Feeder Satu', '067887654567', 1, NULL, NULL),
('F0002', 3, 'feeder2', 'feeder2', 'feeder2@g.c', 'Feeder Dua', '082286219618', 1, '2019-08-16 23:40:10', '2019-08-16 23:41:14'),
('O0001', 1, 'operator1', 'operator1', 'operatorr1@g.c', 'Operator Satu', '098765434567', 2, NULL, NULL),
('O0002', 1, 'operator2', 'operator2', 'operator2@g.c', 'Operator Dua', '567654537', 1, '2019-08-16 20:42:36', '2019-08-16 20:42:36'),
('P0001', 4, 'passenger1', 'passenger1', 'passenger1@g.c', 'Passenger Satu', '078965431245', 1, NULL, NULL),
('P0002', 4, 'passenger2', 'passenger2', 'passenger2@g.c', 'Passenger Dua', '078967896543', 2, NULL, NULL),
('P0003', 4, 'passenger3', 'passenger3', 'passenger3@g.c', 'Passenger Tiga', '089765456789', 1, '2019-08-16 22:02:21', '2019-08-16 22:02:21'),
('P0004', 4, 'passenger4', 'PASSENGER4', 'passenger4@g.c', 'Passenger Empat', '098778985676', 2, '2019-08-16 22:11:28', '2019-08-16 22:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_trip`,`id_users_pemesan`,`id_seat`),
  ADD KEY `seat_detail_pesanan_fk` (`id_seat`);

--
-- Indexes for table `feeder`
--
ALTER TABLE `feeder`
  ADD PRIMARY KEY (`id_users`),
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
  ADD KEY `kota_operator_fk` (`id_kota`);

--
-- Indexes for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD PRIMARY KEY (`id_users`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_trip`,`id_users_pemesan`),
  ADD KEY `penumpang_pesanan_fk` (`id_users_pemesan`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`),
  ADD KEY `kota_rute_fk` (`id_kota_tujuan`),
  ADD KEY `kota_rute_fk1` (`id_kota_asal`);

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
  ADD UNIQUE KEY `plat_mobil` (`plat_mobil`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`id_trip`),
  ADD KEY `rute_trip_fk` (`id_rute`),
  ADD KEY `operator_trip_fk` (`id_users_operator`),
  ADD KEY `feeder_trip_fk` (`id_users_feeder`),
  ADD KEY `sopir_trip_fk` (`id_users_sopir`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `pesanan_detail_pesanan_fk` FOREIGN KEY (`id_trip`,`id_users_pemesan`) REFERENCES `pesanan` (`id_trip`, `id_users_pemesan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `seat_detail_pesanan_fk` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `feeder`
--
ALTER TABLE `feeder`
  ADD CONSTRAINT `kota_feeder_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_feeder_fk` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operator`
--
ALTER TABLE `operator`
  ADD CONSTRAINT `kota_operator_fk` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_operator_fk` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pemesan`
--
ALTER TABLE `pemesan`
  ADD CONSTRAINT `users_penumpang_fk` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `penumpang_pesanan_fk` FOREIGN KEY (`id_users_pemesan`) REFERENCES `pemesan` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `trip_pesanan_fk` FOREIGN KEY (`id_trip`) REFERENCES `trip` (`id_trip`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rute`
--
ALTER TABLE `rute`
  ADD CONSTRAINT `kota_rute_fk` FOREIGN KEY (`id_kota_tujuan`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kota_rute_fk1` FOREIGN KEY (`id_kota_asal`) REFERENCES `kota` (`id_kota`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sopir`
--
ALTER TABLE `sopir`
  ADD CONSTRAINT `users_sopir_fk` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trip`
--
ALTER TABLE `trip`
  ADD CONSTRAINT `feeder_trip_fk` FOREIGN KEY (`id_users_feeder`) REFERENCES `feeder` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `operator_trip_fk` FOREIGN KEY (`id_users_operator`) REFERENCES `operator` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rute_trip_fk` FOREIGN KEY (`id_rute`) REFERENCES `rute` (`id_rute`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sopir_trip_fk` FOREIGN KEY (`id_users_sopir`) REFERENCES `sopir` (`id_users`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
