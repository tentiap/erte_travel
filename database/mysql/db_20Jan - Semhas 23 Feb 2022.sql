-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2022 at 07:34 AM
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
-- Database: `db_20Jan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `jadwal` datetime NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `id_seat` char(2) NOT NULL,
  `order_number` int(11) NOT NULL,
  `id_pemesan` char(16) NOT NULL,
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

INSERT INTO `detail_pesanan` (`jadwal`, `plat_mobil`, `id_seat`, `order_number`, `id_pemesan`, `id_feeder`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`, `created_at`, `updated_at`) VALUES
('2022-02-23 15:00:00', 'BA2222LA', '2', 2, '5555555555555555', '1000000000000000', 'Loli', 'Perempuan', 'Pasar Bawah', 'Pasar Baru Unand', NULL, '1', 0, '2022-02-02 02:00:53', '2022-02-03 04:47:09'),
('2022-02-23 15:00:00', 'BA2222LA', '3', 1, '7777777777777777', '1000000000000000', 'Hagi', 'Laki-laki', 'Pasar Atas', 'Pasar Baru', '08126766442', '1', 0, '2022-02-02 01:59:01', '2022-02-03 03:26:52'),
('2022-02-23 15:00:00', 'BA2222LA', '5', 1, '5555555555555555', '1000000000000000', 'Cimon', 'Perempuan', 'Pasar Atas', 'Pasar Baru', NULL, '1', 0, '2022-02-02 03:05:49', '2022-02-03 04:47:09'),
('2022-02-23 15:00:00', 'BA3333LZ', '1', 1, '1000000000000000', NULL, 'Seat 1 ON 1', 'Perempuan', 'd', 'd', NULL, '5', 0, '2022-01-26 08:38:40', '2022-01-26 08:40:41'),
('2022-02-23 15:00:00', 'BA3333LZ', '1', 2, '1000000000000000', NULL, 'Seat 1 ON 2', 'Laki-laki', 'd', 'f', NULL, '5', 0, '2022-01-26 08:39:46', '2022-01-27 03:41:14'),
('2022-02-23 15:00:00', 'BA3333LZ', '1', 3, '1000000000000000', '2000000000000000', 'Cici', 'Laki-laki', 'Pasar Baru', 'Ampek Angkek', NULL, '1', 0, '2022-01-27 05:00:38', '2022-02-22 23:45:04'),
('2022-02-23 15:00:00', 'BA3333LZ', '2', 1, '3333333333333333', NULL, 'Order Number Satu', 'Laki-laki', 's', 's', NULL, '5', 0, '2022-01-24 16:21:42', '2022-01-25 12:39:12'),
('2022-02-23 15:00:00', 'BA3333LZ', '2', 2, '4444444444444444', '2000000000000000', 'Putri', 'Perempuan', 'Gerbang Unand', 'Jambu Aia', NULL, '3', 0, '2022-01-25 12:35:49', '2022-02-22 05:47:11'),
('2022-02-23 15:00:00', 'BA3333LZ', '2', 3, '4444444444444444', NULL, 'Seat Dua Order Number Tiga', 'Laki-laki', 'Alamat Seat Dua Order Number Tiga', 'Tujuan2', NULL, '5', 0, '2022-01-25 12:47:38', '2022-01-27 03:44:38'),
('2022-02-23 15:00:00', 'BA3333LZ', '2', 5, '1000000000000000', NULL, 'Seat 2 ON 5', 'Perempuan', 'f', 'f', NULL, '5', 0, '2022-01-26 07:46:29', '2022-01-27 03:43:59'),
('2022-02-23 15:00:00', 'BA3333LZ', '3', 1, '2222222222222222', '2000000000000000', 'Hafizh', 'Laki-laki', 'Kampuang Dalam', 'Simpang Padang Lua', NULL, '3', 0, '2022-01-27 02:43:23', '2022-02-22 23:44:03'),
('2022-02-23 15:00:00', 'BA3333LZ', '4', 1, '4444444444444444', NULL, 'Seat Empat Order Number Ntah', 'Perempuan', 'Alamat Seat 4', 'Tujuan3', NULL, '5', 0, '2022-01-25 07:29:44', '2022-01-27 01:58:09'),
('2022-02-23 15:00:00', 'BA3333LZ', '4', 2, '1000000000000000', '2000000000000000', 'Risky', 'Perempuan', 'Pasar Baru', 'Ampek Angkek', NULL, '3', 0, '2022-01-26 07:46:29', '2022-02-22 05:44:29'),
('2022-02-23 15:00:00', 'BA3333LZ', '5', 1, '1000000000000000', '2000000000000000', 'Nanda', 'Laki-laki', 'Irigasi', 'Belakang Balok', NULL, '1', 0, '2022-01-26 07:46:29', '2022-02-22 23:45:04'),
('2022-02-23 15:00:00', 'BA3333LZ', '6', 1, '2222222222222222', NULL, 'sss', 'Perempuan', 's', 's', NULL, '5', 0, '2022-01-27 02:43:23', '2022-01-27 04:58:58'),
('2022-02-23 15:00:00', 'BA3333LZ', '6', 2, '1000000000000000', '2000000000000000', 'Jurly', 'Perempuan', 'Irigasi', 'Pasar Atas', NULL, '1', 0, '2022-01-27 05:00:38', '2022-02-22 23:45:04'),
('2022-02-23 15:00:00', 'BA3333LZ', '7', 1, '1111111111111111', '2000000000000000', 'Pemesan Satu', 'Perempuan', 'Alamat Jemput', 'Alamat Antar', NULL, '1', 0, '2022-02-01 12:27:24', '2022-02-23 00:05:19'),
('2022-02-23 16:00:00', 'BA1111LA', '1', 1, '1375015009970001', '1000000000000000', 'Putri', 'Perempuan', 'Belakang SMP 1', 'Kos Irigasi Pasar Baru', NULL, '1', 0, '2022-02-23 00:23:46', '2022-02-23 00:30:49'),
('2022-02-23 16:00:00', 'BA1111LA', '5', 1, '0000000000000000', NULL, 'Dian', 'Perempuan', 'Guguak Tinggi', 'Kampung Dalam', '081278674543', '1', NULL, '2022-02-23 00:16:41', '2022-02-23 00:16:41'),
('2022-02-23 16:00:00', 'BA1111LA', '6', 1, '7777777777777777', '1000000000000000', 'Suci Susilawati Yono', 'Perempuan', 'Lapangan Kantin', 'Inaya Cell Pasar Baru', NULL, '1', 0, '2022-02-02 01:30:20', '2022-02-02 23:01:27'),
('2022-02-23 17:00:00', 'BA4444QA', '1', 1, '1356890978786767', '1000000000000000', 'Aldi', 'Laki-laki', 'Belakang Balok', 'Kos Belakang Masjid Pasar Baru', NULL, '1', 0, '2022-02-03 04:24:11', '2022-02-23 00:05:56'),
('2022-02-24 15:00:00', 'BA2222LA', '1', 1, '1111111111111111', '5000000000', 'Yona', 'Perempuan', 'Kos Putri Irigasi Yona', 'Belakang Balok Yona', NULL, '5', 0, '2022-01-24 12:13:26', '2022-02-06 23:55:21'),
('2022-02-24 15:00:00', 'BA2222LA', '1', 2, '1111111111111111', NULL, 'Yona Pradipta', 'Perempuan', 'Kos Putri Irigasi Yona', 'Belakang Balok Yona', NULL, '1', 0, '2022-02-06 23:47:19', '2022-02-07 00:07:07'),
('2022-02-24 15:00:00', 'BA2222LA', '2', 1, '1323456745674567', '2000000000000000', 'Penumpang Satu', 'Laki-laki', 'Detail Asal', 'Detail Tujuan', '087867675656', '1', 0, '2022-02-01 16:40:21', '2022-02-06 15:10:40'),
('2022-02-24 15:00:00', 'BA2222LA', '2', 2, '1323456745674567', '2000000000000000', 'Penumpang Satu Baru', 'Laki-laki', 'Detail Asal', 'Detail Tujuan', '087867675656', '5', 0, '2022-02-02 00:49:22', '2022-02-06 14:20:56'),
('2022-02-24 15:00:00', 'BA2222LA', '3', 1, '1111111111111111', NULL, 'Hagi Pra', 'Laki-laki', 'Kos Putri Irigasi', 'Belakang Balok', NULL, '1', 0, '2022-02-06 23:37:11', '2022-02-06 23:42:05'),
('2022-02-24 15:00:00', 'BA2222LA', '4', 1, '1111111111111111', NULL, 'Loli', 'Perempuan', 'Kos Putri Irigasi', 'Belakang Balok', NULL, '5', 0, '2022-02-06 23:37:47', '2022-02-06 23:38:28'),
('2022-02-24 15:00:00', 'BA2222LA', '4', 2, '1111111111111111', NULL, 'Nad', 'Perempuan', 'Indaruang', 'Belakang Balok', NULL, '1', 0, '2022-02-06 23:48:54', '2022-02-06 23:48:54'),
('2022-02-24 15:00:00', 'BA2222LA', '5', 1, '1111111111111111', NULL, 'Tiwi', 'Perempuan', 'Alamat Tiwi', 'Tujuan Tiwi', NULL, '5', 0, '2022-02-07 00:11:20', '2022-02-07 00:12:48'),
('2022-02-24 15:00:00', 'BA2222LA', '6', 1, '1111111111111111', NULL, 'Rani', 'Perempuan', 'Alamat Rani', 'Tujuan Rani', NULL, '5', 0, '2022-02-07 00:11:47', '2022-02-07 00:13:04'),
('2022-02-24 15:00:00', 'BA2222LA', '6', 2, '1111111111111111', NULL, 'Tambahan', 'Laki-laki', 'Alamat Tambahan', 'Alamat Tujuan', NULL, '1', 0, '2022-02-16 14:04:55', '2022-02-16 14:04:55');

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
('1000000000000000', 'K1', 'feeder1', 'feeder1@gmail.com', '$2a$12$GnBe1xbMH/dSjzZV5O8yUufYWggxf70MkVkHx4OX/VbwMe8cEN1.C', 'Feeder Satu', '081234345656', 'Laki-laki', '2022-01-21 02:01:57', '2022-01-21 02:01:57'),
('2000000000000000', 'K2', 'feeder2', 'feeder2@gmail.com', '$2a$12$tX2DyU3fPn40fVSJHFMHPO4//6S51dywSdEFMPL35ADmdetFpa4D2', 'Feeder Dua', '08127878676765', 'Laki-laki', '2022-01-21 02:01:57', '2022-01-21 02:01:57'),
('300000000', 'K3', 'feeder3', 'feeder3@gmail.com', '$2a$12$voM6mvZMhIO/jIOOEb7zyew/fBdZz23hdDhqp796tk48AMUXVdogW', 'Feeder Tiga', '089878786565', 'Laki-laki', '2022-01-21 02:41:18', '2022-01-21 02:51:27'),
('40000000', 'K1', 'feeder4', 'feeder4@gmail.com', '$2y$10$0y8Wy6pzbmHNkDwPojGXzO1y6HHiS1CclzEVpksXJ9Ffbk0QEfTRy', 'Feeder Empat', '089876564322', 'Laki-laki', '2022-01-27 00:36:54', '2022-01-27 00:36:54'),
('5000000000', 'K2', 'feeder5', 'feeder5@gmail.com', '$2y$10$Iqv.uHqoHsTzINslbvMRWOZQnL.z7HDLhpeDUn.6s2/JHhiXkGkyS', 'Feeder Lima', '087690909090', 'Laki-laki', '2022-01-27 00:41:58', '2022-01-27 00:41:58');

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
('K1', 'Bukittinggi', '2022-01-21 03:12:29', '2022-01-21 03:51:00'),
('K2', 'Padang', '2022-01-21 03:12:29', '2022-01-21 03:51:17'),
('K3', 'Pekanbaru', '2022-01-21 03:12:29', '2022-01-21 03:51:25'),
('K4', 'Pasar Baru', '2022-02-23 05:25:35', '2022-02-23 05:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `mobil`
--

CREATE TABLE `mobil` (
  `plat_mobil` varchar(8) NOT NULL,
  `id_sopir` char(16) NOT NULL,
  `merek_mobil` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobil`
--

INSERT INTO `mobil` (`plat_mobil`, `id_sopir`, `merek_mobil`, `created_at`, `updated_at`) VALUES
('BA1111LA', '1000000000000000', 'Suzuki APV', '2022-01-21 03:13:36', '2022-01-21 03:13:36'),
('BA2222LA', '2000000000000000', 'Suzuki APV', '2022-01-21 03:13:36', '2022-01-21 03:13:36'),
('BA3333LZ', '4000000000000000', 'Suzuki APV', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('BA4444QA', '4000000000000000', 'Suzuki APV', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('BA5555LC', '5000000000000000', 'Suzuki APV', '2022-02-22 08:59:33', '2022-02-22 08:59:33');

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
('0000000000000000', 'admin', 'admin@gmail.com', '$2y$10$K.qAsCc2GzV8/rCKKb4voe6iuT0VnF1/2ACYBbnvtXuSvOuuhKkXe', 'Admin', '08126766442', 'Laki-laki', 'Kantor', '2022-02-23 00:13:15', '2022-02-23 00:17:39'),
('1000000000000000', 'pengurus1', 'pengurus1@gmail.com', '$2y$10$HJ41vacmpDlGwuVICZqSMe7dmTvfqMhTn57UD.NNO2ybEjjAlgmjS', 'Pengurus Satu', '08976765454', 'Perempuan', 'Alamat Kantor', '2022-01-24 14:40:55', '2022-02-01 14:05:04'),
('1111111111111111', 'pemesan1', 'pemesan1@gmail.com', '$2a$12$ar1/DXJuMjxUCidx.osXlOCWobpCO2Px0Ub9AatMvNRkyABECQIpe', 'Pemesan Satu', '0812676749098', 'Laki-laki', 'Alamat Pemesan Satu', '2022-01-21 00:43:12', '2022-02-06 21:46:14'),
('1323456745674567', 'pemesan6', 'pemesan6@gmail.com', '$2y$10$wS/6mCwsIxaomlY/upYZWe8BizCwhk5B9GSH0CNLOdXS/0RVT1w.6', 'Pemesan Enam', '081256554455', 'Laki-laki', 'Alamat Pemesan Enam', '2022-02-01 04:24:51', '2022-02-01 04:24:51'),
('1356890978786767', 'aldialdi', 'aldi@gmail.com', '$2y$10$0reNrWIgSIbHT2Q6VXYvuuwuTuBenYKVOURAiHBRb9nrOk9Qy75Qm', 'Aldi', '089789807865', 'Laki-laki', 'Pasar Baru', '2022-02-03 03:57:46', '2022-02-03 03:58:04'),
('1375015009970001', 'putri', 'putri@gmail.com', '$2y$10$JbiiXltwbdv7qRlJ3m6QPeHAKd9y9OHgt3SyrEyUkaAWgrgOFRdDi', 'Putri', '082286219618', 'Perempuan', 'Belakang SMP 1 Bukittinggi', '2022-02-23 00:22:08', '2022-02-23 00:22:08'),
('2000000000000000', 'pengurus2', 'pengurus2@gmail.com', '$2y$10$stO77euwZOAjk5gMpbtKRuv3gWRLv5ibN3a6wXT523RVbwaPYLMsO', 'Pengurus Dua', '089878786767', 'Laki-laki', 'Alamat Pengurus Dua', '2022-01-26 07:54:00', '2022-01-26 07:54:00'),
('2222222222222222', 'pemesan2', 'pemesan2@gmail.com', '$2a$12$qkELQaNx5jlq9rYdiJmSQ.1R8SSWlNUZ.HmdzlegEQO2xZTtOePAe', 'Pemesan Dua', '087867655434', 'Perempuan', 'Alamat Pemesan 2', '2022-01-21 00:04:31', '2022-02-01 04:08:34'),
('3333333333333333', 'pemesan3', 'pemesan3@gmail.com', '$2a$12$V68RTJ/.j/aiAGj5oG1rLO8AHdZp9.sIaM8PQjO1z2xC5goiUsjya', 'Pemesan Tiga', '087867676767', 'Laki-laki', '1', '2022-01-21 00:04:31', '2022-02-01 10:29:45'),
('4444444444444444', 'pemesan4', 'pemesan4@gmail.com', '$2y$10$hTkAUKr4daPHnkFq9k7Rq.ZqEs2gXUJRgy7CT4q6MS1F.5O6CHt.W', 'Pemesan Empat', '087656564545', 'Laki-laki', 'Alamat Pemesan Empat', '2022-01-21 01:13:11', '2022-02-01 04:08:11'),
('5555555555555555', 'pemesan5', 'pemesan5@gmail.com', '$2y$10$bfCobG2xhA9mQ7RSPOT5I.zrv.QYhfDSV.sfRzBvsVfmxIKgaRoGe', 'Pemesan Lima', '076789895352', 'Perempuan', 'Alamat Pemesan Lima', '2022-02-01 04:13:56', '2022-02-01 04:39:28'),
('7777777777777777', 'pemesan7', 'pemesan7@gmail.com', '$2y$10$doZBP5dSE5LYdjXJMfo9Z.kZGxD7QJ7kPhln912b8Ieh.FfudGy6.', 'Pemesan Tujuh', '081289896459', 'Perempuan', 'Alamat Pemesan 7', '2022-02-01 04:40:34', '2022-02-15 00:11:12');

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
('1000000', 'K1', 'pengurus1', 'pengurus1@gmail.com', '$2a$12$qDZkSasMpGJP4kzfSvOKs.BfN6SI8DYpYyNLO2Y3aUycxRbvfVpn.', 'Pengurus Satu', '081212121212', 'Laki-laki', '2022-01-21 03:14:48', '2022-01-21 03:14:48'),
('2000000', 'K2', 'pengurus2', 'pengurus2@gmail.com', '$2a$12$0b0ah0OB7JcPdVvr75WKb.VPyDrQkGlM6vDcoL8rx5BURack5LKpW', 'Pengurus Dua', '081234542343', 'Perempuan', '2022-01-21 03:14:48', '2022-01-21 03:14:48'),
('admin', 'K1', 'admin', 'admin@gmail.com', '$2a$12$GDbfY29fUIj1OXOGftbMiOYIyn5Pke3PEpHdTqYRxlg.wW06D1Tj6', 'Admin', '08126766442', 'Perempuan', '2022-01-21 03:14:48', '2022-01-21 03:14:48');

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
('0000000000000000', '2022-02-23 16:00:00', 'BA1111LA', 'admin', '2022-02-23 00:16:41', '2022-02-23 00:16:41', '2022-02-23 00:16:41'),
('1000000000000000', '2022-02-23 15:00:00', 'BA3333LZ', 'admin', '2022-01-26 07:46:29', '2022-01-26 07:46:29', '2022-01-26 07:46:29'),
('1111111111111111', '2022-02-23 15:00:00', 'BA3333LZ', 'admin', '2022-02-01 12:27:24', '2022-02-01 12:27:24', '2022-02-01 12:27:24'),
('1111111111111111', '2022-02-24 15:00:00', 'BA2222LA', 'admin', '2022-01-24 14:04:17', '2022-01-24 03:22:13', '2022-01-24 14:04:17'),
('1323456745674567', '2022-02-24 15:00:00', 'BA2222LA', NULL, '2022-02-01 15:53:51', '2022-02-01 15:53:51', '2022-02-01 15:53:51'),
('1356890978786767', '2022-02-23 17:00:00', 'BA4444QA', NULL, '2022-02-03 04:17:37', '2022-02-03 04:17:37', '2022-02-03 04:17:37'),
('1375015009970001', '2022-02-23 16:00:00', 'BA1111LA', NULL, '2022-02-23 00:23:16', '2022-02-23 00:23:16', '2022-02-23 00:23:16'),
('2222222222222222', '2022-02-23 15:00:00', 'BA3333LZ', 'admin', '2022-01-27 02:43:23', '2022-01-27 02:43:23', '2022-01-27 02:43:23'),
('3333333333333333', '2022-02-23 15:00:00', 'BA3333LZ', 'admin', '2022-01-24 16:21:42', '2022-01-24 16:21:42', '2022-01-24 16:21:42'),
('4444444444444444', '2022-02-23 15:00:00', 'BA3333LZ', 'admin', '2022-01-25 07:29:44', '2022-01-25 07:29:44', '2022-01-25 07:29:44'),
('5555555555555555', '2022-02-23 15:00:00', 'BA2222LA', NULL, '2022-02-02 02:00:11', '2022-02-02 02:00:11', '2022-02-02 02:00:11'),
('7777777777777777', '2022-02-23 15:00:00', 'BA2222LA', NULL, '2022-02-02 01:56:34', '2022-02-02 01:56:34', '2022-02-02 01:56:34'),
('7777777777777777', '2022-02-23 16:00:00', 'BA1111LA', NULL, '2022-02-02 01:29:49', '2022-02-02 01:29:49', '2022-02-02 01:29:49');

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
('K1', 'K2', 50000, '2022-01-21 03:16:22', '2022-01-27 04:45:54'),
('K1', 'K3', 100000, '2022-01-21 03:58:12', '2022-01-21 03:58:12'),
('K2', 'K1', 50000, '2022-01-21 03:16:22', '2022-01-21 03:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `id_seat` char(2) NOT NULL,
  `plat_mobil` varchar(8) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`id_seat`, `plat_mobil`, `keterangan`, `created_at`, `updated_at`) VALUES
('1', 'BA1111LA', 'Satu', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('1', 'BA2222LA', 'Satu', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('1', 'BA3333LZ', 'Satu', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('1', 'BA4444QA', 'Satu', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('1', 'BA5555LC', 'Satu', '2022-02-22 08:59:33', '2022-02-22 08:59:33'),
('2', 'BA1111LA', 'Dua', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('2', 'BA2222LA', 'Dua', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('2', 'BA3333LZ', 'Dua', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('2', 'BA4444QA', 'Dua', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('2', 'BA5555LC', 'Dua', '2022-02-22 08:59:33', '2022-02-22 08:59:33'),
('3', 'BA1111LA', 'Tiga', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('3', 'BA2222LA', 'Tiga', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('3', 'BA3333LZ', 'Tiga', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('3', 'BA4444QA', 'Tiga', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('3', 'BA5555LC', 'Tiga', '2022-02-22 08:59:33', '2022-02-22 08:59:33'),
('4', 'BA1111LA', 'Empat', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('4', 'BA2222LA', 'Empat', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('4', 'BA3333LZ', 'Empat', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('4', 'BA4444QA', 'Empat', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('4', 'BA5555LC', 'Empat', '2022-02-22 08:59:33', '2022-02-22 08:59:33'),
('5', 'BA1111LA', 'Lima', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('5', 'BA2222LA', 'Lima', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('5', 'BA3333LZ', 'Lima', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('5', 'BA4444QA', 'Lima', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('5', 'BA5555LC', 'Lima', '2022-02-22 08:59:33', '2022-02-22 08:59:33'),
('6', 'BA1111LA', 'Enam', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('6', 'BA2222LA', 'Enam', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('6', 'BA3333LZ', 'Enam', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('6', 'BA4444QA', 'Enam', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('6', 'BA5555LC', 'Enam', '2022-02-22 08:59:33', '2022-02-22 08:59:33'),
('7', 'BA1111LA', 'Tujuh', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('7', 'BA2222LA', 'Tujuh', '2022-01-21 03:17:04', '2022-01-21 03:17:04'),
('7', 'BA3333LZ', 'Tujuh', '2022-01-26 14:32:58', '2022-01-26 14:32:58'),
('7', 'BA4444QA', 'Tujuh', '2022-01-28 07:40:33', '2022-01-28 07:40:33'),
('7', 'BA5555LC', 'Tujuh', '2022-02-22 08:59:33', '2022-02-22 08:59:33');

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
  `jenis_kelamin` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id_sopir`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('1000000000000000', 'sopir1', 'sopir1@gmail.com', '$2a$12$MdwbXq69jUS2Ai8ehd46HuId1T4B3izIgS1Cqt3wxSBWsS7wnZY1i', 'Sopir Satu', '089890900000', 'Perempuan', '2022-01-21 01:56:18', '2022-01-21 01:57:41'),
('2000000000000000', 'sopir2', 'sopir2@gmail.com', '$2a$12$aGqfuVE32PSHyLCbhX5.teKhw1wqsh.XbDUNHxDrJmp2MSnTuo9IG', 'Sopir Dua', '081212121212', 'Laki-laki', '2022-01-21 01:56:18', '2022-01-21 01:56:18'),
('3000000000000000', 'sopir3', 'sopir3@gmail.com', '$2y$10$8FKh6VNBz2eKxEamWrjHmOz2j/5vNo7qmw1viYKpFjP/yw0rS/uPK', 'Sopir Tiga', '087865455434', 'Laki-laki', '2022-01-21 01:57:19', '2022-01-21 01:57:19'),
('4000000000000000', 'sopir4', 'sopir4@gmail.com', '$2y$10$W7B249ZojcCVJIATt4XS6OqyvOzbUu788msy/JXUcFhYY9Sc12wQG', 'Sopir Empat', '089867543434', 'Laki-laki', '2022-01-21 05:15:27', '2022-01-21 05:15:27'),
('5000000000000000', 'sopir5', 'sopir5@gmail.com', '$2y$10$yDp9H3aWGtY/wOf7zcEUTOOZZakFs5z5Ivyu0l/mKLa.JuipLeiQO', 'Sopir Lima', '081267673434', 'Laki-laki', '2022-01-28 07:41:20', '2022-01-28 07:41:20');

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
('2022-02-14 11:00:00', 'BA4444QA', 'K1', 'K2', 50000, '2022-02-07 04:26:31', '2022-02-13 23:33:01'),
('2022-02-14 12:00:00', 'BA4444QA', 'K1', 'K2', 50000, '2022-02-07 04:36:48', '2022-02-13 23:33:24'),
('2022-02-23 15:00:00', 'BA2222LA', 'K1', 'K2', 50000, '2022-01-21 05:46:42', '2022-02-22 23:43:32'),
('2022-02-23 15:00:00', 'BA3333LZ', 'K2', 'K1', 50000, '2022-01-24 14:37:00', '2022-02-22 23:25:03'),
('2022-02-23 16:00:00', 'BA1111LA', 'K1', 'K2', 50000, '2022-01-21 03:17:51', '2022-02-23 00:04:50'),
('2022-02-23 17:00:00', 'BA4444QA', 'K1', 'K2', 50000, '2022-02-03 03:51:10', '2022-02-23 00:04:08'),
('2022-02-24 14:00:00', 'BA1111LA', 'K1', 'K2', 50000, '2022-02-03 03:43:00', '2022-02-22 23:29:15'),
('2022-02-24 15:00:00', 'BA1111LA', 'K1', 'K2', 50000, '2022-02-14 08:20:36', '2022-02-22 23:41:08'),
('2022-02-24 15:00:00', 'BA2222LA', 'K2', 'K1', 50000, '2022-01-21 05:21:00', '2022-02-22 23:29:54'),
('2022-02-25 15:00:00', 'BA4444QA', 'K1', 'K2', 50000, '2022-02-14 08:18:37', '2022-02-22 23:41:25'),
('2022-02-26 08:00:00', 'BA4444QA', 'K1', 'K2', 50000, '2022-02-14 08:16:54', '2022-02-22 23:34:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`jadwal`,`plat_mobil`,`id_seat`,`order_number`) USING BTREE,
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
