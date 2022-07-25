-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2021 at 04:08 PM
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
  `id_detail_pesanan` int(5) NOT NULL,
  `id_trip` varchar(5) NOT NULL,
  `id_seat` varchar(2) NOT NULL,
  `id_pesanan` varchar(5) NOT NULL,
  `id_users_feeder` varchar(5) DEFAULT NULL,
  `nama_penumpang` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
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

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_trip`, `id_seat`, `id_pesanan`, `id_users_feeder`, `nama_penumpang`, `jenis_kelamin`, `detail_asal`, `detail_tujuan`, `no_hp`, `status`, `biaya_tambahan`, `created_at`, `updated_at`) VALUES
(1, 'T1', '6', 'P1', NULL, 'Penumpang Dua', 'Laki-laki', 'Alamat Asal Penumpang Dua', 'Alamat Tujuan Penumpang Dua', '087656764565', 5, NULL, '2020-08-13 00:36:59', '2020-11-26 04:34:57'),
(9, 'T1', '2', 'P2', NULL, 'Max', 'Perempuan', 'Asal Max', 'Tujuan Max', NULL, 1, NULL, '2020-08-13 02:38:53', '2021-06-26 02:13:01'),
(10, 'T1', '3', 'P2', NULL, 'Min', 'Perempuan', 'Asal Min', 'Tujuan Min', '089746474546', 1, NULL, '2020-08-13 02:38:53', '2021-06-26 02:13:01'),
(11, 'T1', '5', 'P3', NULL, 'Mod', 'Perempuan', 'Asal Mod', 'Tujuan Mod', '089888888888', 5, NULL, '2020-08-15 00:38:52', '2020-08-24 07:25:55'),
(21, 'T1', '1', 'P4', 'F2', 'Satu', 'Laki-laki', 'ss', 'ss', NULL, 3, NULL, '2020-08-23 09:52:09', '2021-07-08 12:54:11'),
(22, 'T1', '4', 'P4', 'F2', 'Empat', 'Perempuan', 'aaa', 'aa', '089807676787', 1, NULL, '2020-08-23 09:52:09', '2021-07-08 12:54:11'),
(23, 'T1', '6', 'P4', 'F2', 'Enam', 'Laki-laki', 'dd', 'dd', NULL, 1, NULL, '2020-08-23 09:52:09', '2021-07-08 12:54:11'),
(31, 'T3', '1', 'P5', 'F2', 'Cici', 'Perempuan', 'Asal Penumpang', 'Tujuan Penumpang', '087656764545', 1, '0', '2020-08-25 01:32:25', '2021-06-26 14:47:17'),
(32, 'T1', '5', 'P2', NULL, 'Lima', 'Perempuan', 'qq', 'q', NULL, 1, NULL, '2020-08-25 03:37:29', '2020-08-25 03:37:29'),
(33, 'T4', '4', 'P6', NULL, 'qq', 'Laki-laki', 'ggg', 'hhh', NULL, 1, NULL, '2020-10-21 02:19:24', '2021-06-27 05:07:57'),
(34, 'T4', '7', 'P6', NULL, 'yyy', 'Perempuan', 'kkk', 'kkkki', NULL, 1, NULL, '2020-10-21 02:19:24', '2021-06-27 05:07:57'),
(36, 'T2', '1', 'P7', NULL, 'Mereng', 'Perempuan', 'Guguak Randah', 'Bang Thoyib', '08126766442', 1, NULL, '2021-01-02 07:53:28', '2021-04-26 07:38:26'),
(40, 'T7', '7', 'P34', NULL, 'Hang Up', 'perempuan', 'Asal si UUy', 'Tujuan si Uuy', '089878786767', 1, '0', '2021-07-02 00:50:04', '2021-07-02 00:50:04'),
(41, 'T7', '6', 'P35', NULL, 'Whoever He Is', 'Laki-laki', 'Morning', 'Afternoon', '1209901290', 1, '0', '2021-07-02 10:54:47', '2021-07-02 10:54:47'),
(42, 'T2', '4', 'P36', NULL, 'Whoever He Is', 'Laki-laki', 'Morning', 'Afternoon', '12345123', 1, '0', '2021-07-03 03:11:31', '2021-07-03 03:11:31'),
(46, 'T2', '7', 'P37', NULL, 'Update Asal', 'Laki-laki', 'Update Asal Asal', 'Update Alamat Asal', '111000', 1, '0', '2021-07-03 07:32:53', '2021-07-05 09:02:53'),
(64, 'T2', '3', 'P38', NULL, 'Best', 'Laki-laki', 'Yesterday', 'The same', NULL, 1, '0', '2021-07-04 02:07:31', '2021-07-04 02:07:31'),
(65, 'T2', '5', 'P38', NULL, 'Kiky', 'Perempuan', 'Whoever he is', 'We lost', '2222', 1, '0', '2021-07-04 02:08:05', '2021-07-04 02:08:05'),
(66, 'T2', '6', 'P38', NULL, 'Dream', 'Laki-laki', 'wwwww', 'popopo', NULL, 1, '0', '2021-07-04 02:08:32', '2021-07-04 02:08:32'),
(76, 'T7', '1', 'P39', NULL, 'Shori Satu', 'Laki-laki', 'Alamat Shori Satu', 'Tujuan Shori Satu', '4444444', 1, '0', '2021-07-04 10:09:07', '2021-07-06 10:38:56'),
(77, 'T7', '2', 'P39', NULL, 'Shori Dua', 'Laki-laki', 'ghhhhh', 'hhhhh', NULL, 1, '0', '2021-07-04 10:09:26', '2021-07-05 07:39:27'),
(78, 'T7', '3', 'P39', NULL, 'Shori Tiga Tes Update', 'Laki-laki', 'Update Detail Asal Shori Tiga', 'Update Detail Tujuan Shori Tiga', '9000000', 5, '0', '2021-07-04 10:09:53', '2021-07-06 23:28:51'),
(79, 'T1', '7', 'P40', NULL, 'Fadli', 'Laki-laki', 'Asal sipad', 'Tujuan sipad', NULL, 1, '0', '2021-07-05 09:31:17', '2021-07-05 09:31:17'),
(84, 'T7', '4', 'P39', NULL, 'cek ya', 'Laki-laki', 'cek', 'cek', NULL, 5, '0', '2021-07-06 22:39:21', '2021-07-06 23:28:36'),
(85, 'T7', '5', 'P39', NULL, 'cek lagi', 'Perempuan', 'alamat', 'lagi', NULL, 5, '0', '2021-07-06 22:39:48', '2021-07-06 23:28:05'),
(86, 'T4', '4', 'P41', 'F1', 'tenti', 'Perempuan', 'pasar baru unand', 'kantor pos bukittinggi', '082286219618', 1, '0', '2021-07-07 02:01:54', '2021-07-12 04:26:25'),
(87, 'T4', '7', 'P41', 'F1', 'humaira', 'Perempuan', 'pasar baru unand', 'guguak randah', NULL, 2, '0', '2021-07-07 02:06:05', '2021-07-12 04:27:50'),
(88, 'T5', '2', 'P43', NULL, 'ipad', 'Laki-laki', 'Sjj', 'LEA', NULL, 1, '0', '2021-07-08 13:30:42', '2021-07-08 13:30:42'),
(89, 'T5', '3', 'P43', NULL, 'Cici', 'Perempuan', 'samo jo ipad', 'ikut ipad', NULL, 1, '0', '2021-07-08 13:30:42', '2021-07-08 13:30:42'),
(90, 'T5', '5', 'P42', NULL, 'Apis', 'Laki-laki', 'pyk', 'ddd', NULL, 3, '0', '2021-07-08 13:31:57', '2021-07-08 13:41:19'),
(91, 'T5', '1', 'P42', NULL, 'Abel', 'Perempuan', 'rrrr', 'rrr', NULL, 2, '0', '2021-07-08 13:32:58', '2021-07-12 04:24:05'),
(92, 'T5', '4', 'P42', NULL, 'dddd', 'Laki-laki', 'ddd', 'sss', NULL, 5, '0', '2021-07-08 13:36:02', '2021-07-08 13:37:17'),
(93, 'T8', '1', 'P44', NULL, 'Ade Ipad', 'Laki-laki', 'LEA', 'LABGIS', NULL, 1, '0', '2021-07-09 06:57:58', '2021-07-09 06:57:58'),
(94, 'T16', '3', 'P45', NULL, 'Penumpang 1', 'Perempuan', 'Aa', 'aaa', '083949349834', 1, '0', '2021-07-12 09:54:50', '2021-07-12 09:55:49'),
(95, 'T16', '1', 'P45', NULL, 'Penumpang 2', 'Laki-laki', 'ggg', 'ggg', '93933939030', 1, '0', '2021-07-12 09:54:50', '2021-07-12 09:54:50'),
(96, 'T12', '1', 'P46', NULL, 'Nama Pemesan 2', 'Laki-laki', 'Alamat', 'alamat', NULL, 5, '0', '2021-07-12 10:18:10', '2021-07-12 10:19:38'),
(97, 'T12', '2', 'P46', NULL, 'kahfjsda', 'Perempuan', 'sss', 'sss', NULL, 5, '0', '2021-07-12 10:18:29', '2021-07-12 10:19:47'),
(98, 'T14', '3', 'P47', 'F2', 'Lagi', 'Laki-laki', 'jsjsjs', 'sss', NULL, 1, '0', '2021-07-12 10:21:04', '2021-07-12 10:26:35'),
(99, 'T14', '6', 'P47', 'F2', 'Tambahan', 'Laki-laki', 'alaalala', 'tutjjtjt', NULL, 1, '0', '2021-07-12 10:21:21', '2021-07-12 10:26:35'),
(100, 'T14', '2', 'P48', NULL, 'Melalui Admin', 'Laki-laki', 'Asalalala', 'Tujuaana', NULL, 1, '0', '2021-07-12 10:23:42', '2021-07-13 12:33:39'),
(101, 'T14', '7', 'P47', 'F2', 'Lalalala', 'Perempuan', 'sss', 'sss', NULL, 2, '0', '2021-07-12 10:24:51', '2021-07-12 10:30:53'),
(103, 'T14', '2', 'P48', NULL, 'jjjj', 'Laki-laki', 'sss', 'sss', '2224545', 1, NULL, '2021-07-13 15:38:41', '2021-07-13 15:38:41'),
(107, 'T17', '1', 'P51', NULL, 'qqq', 'Laki-laki', 'qqq', 'qqq', NULL, 1, '0', '2021-07-14 13:50:27', '2021-07-14 13:50:27'),
(108, 'T17', '2', 'P51', NULL, 'www', 'Perempuan', 'wwww', 'eee', NULL, 1, '0', '2021-07-14 13:50:27', '2021-07-14 13:50:27'),
(109, 'T17', '3', 'P51', NULL, 'rrrr', 'Laki-laki', 'ggg', 'rrrrrr', NULL, 1, '0', '2021-07-14 13:50:27', '2021-07-14 13:50:27'),
(110, 'T17', '4', 'P52', NULL, 'aaaa', 'Laki-laki', 'sss', 'sss', NULL, 1, '0', '2021-07-14 13:51:58', '2021-07-14 13:51:58'),
(111, 'T17', '5', 'P52', NULL, 'dddaa', 'Laki-laki', 'sss', 'dddd', NULL, 1, '0', '2021-07-14 13:51:58', '2021-07-14 13:51:58'),
(112, 'T17', '6', 'P52', NULL, 'dddd', 'Laki-laki', 'fss', 'dsdss', NULL, 1, '0', '2021-07-14 13:51:58', '2021-07-14 13:51:58'),
(113, 'T17', '7', 'P52', NULL, 'dss', 'Laki-laki', 'dddd', 'ddd', NULL, 1, '0', '2021-07-14 13:51:58', '2021-07-14 13:51:58'),
(118, 'T7', '4', 'P55', NULL, 'fss', 'Laki-laki', 'dd', 'dd', NULL, 5, '0', '2021-07-16 10:00:58', '2021-07-17 12:54:42'),
(119, 'T7', '5', 'P55', NULL, 'ddd', 'Laki-laki', 'd', 'd', NULL, 5, '0', '2021-07-16 10:00:58', '2021-07-17 12:54:42');

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
  `jenis_kelamin` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feeder`
--

INSERT INTO `feeder` (`id_users`, `id_kota`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('F1', 'K2', 'feeder1', 'feeder1@g.c', '$2y$10$G1efJ5EZyKDf5Z8gK2f6qun3IQzeVvPh/C5YdILHecmfT./qPo5Y.', 'Feeder Satu', '99', 'Laki-Laki', '2020-06-21 00:18:08', '2020-06-21 00:18:08'),
('F2', 'K1', 'feeder2', 'feeder2@g.c', '$2y$10$25S2RGS9DJQgHRoUTIKWf.1awFCzwkfa/SVyjGZMK7m59Uzoy3R3C', 'Feeder Dua', '989', 'Perempuan', '2020-06-30 02:47:00', '2021-06-21 08:26:03'),
('F3', 'K3', 'feeder3', 'feeder3@g.c', '$2y$10$/noiAd7qkjHEDmfknc5wJ.jxD6VasNaajVgSTdPVaaHy91QgH4FvS', 'Feeder Tiga', '89', 'Laki-Laki', '2020-07-04 03:28:12', '2020-07-04 03:28:12'),
('F4', 'K1', 'feederbaru', 'feederbaru@g.c', '$2y$10$IuQm6UlbZGXOcYHhy1bk4uSQmYYBFnnozeqwDDmI0PcxU4KrCZpwK', 'Feeder Baru', '06955478272', 'Laki-laki', '2021-07-13 10:08:24', '2021-07-13 10:08:34');

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
('K3', 'Pekanbaru', '2020-03-04 07:14:36', '2020-08-25 00:18:48');

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
('O3', 'K3', 'operator3', 'operator3@g.c', '$2y$10$FgtsecWBsCiVIvOCIjvGP.rfwMQQJ/rr3rMNu7gPBM4M2bzq6jk5m', 'Operator Tiga', '03794949', 1, '2020-08-03 07:49:16', '2020-08-03 07:49:16'),
('O4', 'K1', 'order_mobile', 'ordermobile@g.c', '$2y$10$G7fvoDk9tQ3gSK68ZxFBYO/XfgPHTWSktg7Y70yCsjJBQAjRqvbtW', 'Order From Mobile', '0000000', 1, '2021-01-11 12:58:11', '2021-01-11 12:58:11');

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
  `jenis_kelamin` varchar(9) NOT NULL,
  `alamat` varchar(254) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesan`
--

INSERT INTO `pemesan` (`id_users`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `alamat`, `created_at`, `updated_at`) VALUES
('admin', 'admin', 'admin@g.c', '$2y$10$pgIDX0tPMuCX8.FqHF5BI.VzjYI8GrrkIX4hnygA7l8rSWJuojo/6', 'Admin', '08976', 'Laki-laki', 'Alamat Admin', NULL, NULL),
('O1', 'operator1', 'operator1@g.c', '$2y$10$8AkaKioXdGrDFUcPdVaYi.GHHqh1C3nGmhqI3Cigkqk8q8m7i3Opy', 'Operator Satu', '84948', 'Perempuan', 'Alamat Operator', NULL, NULL),
('U1', 'pemesan1', 'pemesan1@g.c', '$2y$10$LUDvi214m5GpBPsyBr06xeQ1RmsVR0rSyQ66db5BWVdcd9415BW1O', 'Pemesan Satu', '087867564545', 'Perempuan', 'LDKOM', '2020-07-10 05:52:51', '2020-07-10 05:52:51'),
('U10', 'papad', 'papad@gmail.com', '$2y$10$qXFixidGURVoQlIexIMT2uyZPBuWiuqyvvKeTSuzIvqJ0u4WX7Qca', 'Fadli Ganteng', '081234567892', 'Laki-laki', 'pdg', '2021-04-05 10:58:37', '2021-04-05 10:58:37'),
('U11', 'tesapiusername', 'emailtesapi@g.c', '$2y$10$yC7LFhETEXKkUO58kxIdN.SsYzsiD9l.b7wX5ZQW8W6iqojPS5tQi', 'tesapi', '08269292', 'Perempuan', 'alamat Tes APi', '2021-05-30 08:58:44', '2021-05-30 08:58:44'),
('U12', 'shori', 'shori@g.c', '$2y$10$fhXPT5APXi3BIiaMiHpb8.0XiHweYDt7CBge0lVHQeM2oV9Etnmni', 'Shori', '089878986787', 'Laki-laki', 'Alamat si Shori', '2021-06-19 03:12:42', '2021-06-26 14:07:40'),
('U13', 'sia.namo', 'sianamo@g.c', '$2y$10$DGVstWzq3S8qGqRfcKetvuuwgIN8IBWgb.UGDfJNvr1xchcYeDvD.', 'Sia Namo', '081234567', 'Perempuan', 'Sabaru', '2021-07-06 12:18:21', '2021-07-06 12:18:21'),
('U14', 'aya', 'humairakj@gmail.com', '$2y$10$ww3wxJ9CCVc5gTdbcwzz0ufVFp5UYRUGVfL4RjhsgESMZ4IROTH0W', 'Aya', '085265425374', 'Perempuan', 'padang', '2021-07-07 01:57:38', '2021-07-07 01:57:38'),
('U15', 'abel_apis', 'abel@g.c', '$2y$10$QbKHxuuOuNo.FJj0rZh1Me0BafhjJv0nC01d5APWmFi3fZtC0hbfW', 'Abel', '085365478544', 'Perempuan', 'Koto nan Ompek', '2021-07-08 13:23:02', '2021-07-08 13:23:02'),
('U16', 'namaPemesan', 'namaPemesan@g.c', '$2y$10$zr9do9b3uTT7opXm9f5b4.RyvsY3JaI3VI7HS4BOr8xEXiQHDlas.', 'Nama Pemesan', '0875363733', 'Laki-laki', 'Banda Buek', '2021-07-12 10:11:36', '2021-07-12 10:11:36'),
('U2', 'pemesan2', 'pemesan2@g.c', '$2y$10$Bl.UWDwKhIfYzPkEdbcmiO6n.dqRrBOsOp8v8tCln0LBqVvFwY4i6', 'Pemesan Dua', '089745376589', 'Laki-laki', 'LDKOM Pemesan 2', '2020-07-10 05:53:39', '2021-07-02 07:24:09'),
('U3', 'pemesan3', 'pemesan3@g.c', '$2y$10$MGOFi8YJjvfzDJVYcY8IuuggFuv1uHdMJxWImW3QN25SQdeV1xvNu', 'Pemesan Tiga', '098778900987', 'Perempuan', 'Alamat Pemesan Tiga', '2020-07-11 11:39:41', '2020-07-11 11:39:41'),
('U4', 'leo', 'leo@g.c', '$2y$10$w4ePJd0QxDi5AL2saI7taegCbA2GMHF3i.lbj4mjWPxfw6a3QUWc6', 'Leo', '089878676565', 'Laki-laki', 'Seattle', '2020-12-05 12:48:30', '2020-12-05 12:48:30'),
('U5', 'tomo', 'tomo@g.c', '$2y$10$76f9DuJLhbjBwlLG6yFUnOda/b8rJK8xqpHG4Mmzy9DZvS3qBnb..', 'Tomo', '082286219618', 'Laki-laki', 'Waseda', '2020-12-05 13:35:07', '2020-12-05 13:35:07'),
('U6', 'aya', 'alala@gmail.com', '$2y$10$SFXHl84b.cZbQ.TGewBjd.E40/pQPQxSoNZZ5STyS1R3Cjq.qn1hK', 'Aya', '080887', 'Perempuan', 'coret', '2020-12-27 10:56:36', '2020-12-27 10:56:36'),
('U7', 'cicici', 'cici@g.c', '$2y$10$MtcDOaiLqMjVPGJqODUUyOnYh2goJa4k2VrnS09M5Z1FK9ePz1gK6', 'Cic', '085328654643', 'Perempuan', 'Jwksjkdld', '2021-01-04 11:12:03', '2021-01-04 11:12:03'),
('U8', 'cici', 'cici@gmail.com', '$2y$10$BuY8HZIDf.jLEKXIb4b2auVLUMflFYcBy0ANDD95lEUmp9dwcPwgy', 'Cici', '085363439729', 'Perempuan', 'Bang Thoyib', '2021-01-04 11:14:19', '2021-01-04 11:14:19'),
('U9', 'pemesan7', 'pemesan7@gmail.com', '$2y$10$n6VkN058xAFnNYnwh2TfouwZZjbXTAw1zWXxFj.IxgeCRdeqhou1.', 'Pemesan Tujuh', '08778786789', 'Laki-laki', 'Jalan Jalan', '2021-01-06 08:25:46', '2021-01-06 08:25:46');

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
('P1', 'T1', 'U1', '2020-08-13 07:36:59', 'admin', '2020-08-13 00:36:59', '2020-08-13 00:36:59', NULL),
('P2', 'T1', 'U2', '2020-08-13 09:38:53', 'admin', '2020-08-13 02:38:53', '2020-08-18 07:35:51', NULL),
('P3', 'T1', 'U3', '2020-08-15 07:38:52', 'admin', '2020-08-15 00:38:52', '2020-08-20 04:45:12', NULL),
('P34', 'T7', 'U2', '2021-07-02 07:50:04', 'O4', '2021-07-02 00:50:04', '2021-07-02 00:50:04', NULL),
('P35', 'T7', 'U10', '2021-07-02 17:43:39', 'O4', '2021-07-02 10:43:39', '2021-07-02 10:43:39', NULL),
('P36', 'T2', 'U2', '2021-07-03 09:51:45', 'admin', '2021-07-03 02:51:45', '2021-07-03 03:15:17', NULL),
('P37', 'T2', 'U12', '2021-07-03 14:32:33', 'O4', '2021-07-03 07:32:33', '2021-07-03 07:32:33', NULL),
('P38', 'T2', 'U1', '2021-07-04 09:07:15', 'admin', '2021-07-04 02:07:15', '2021-07-04 02:09:33', NULL),
('P39', 'T7', 'U12', '2021-07-04 17:08:36', 'admin', '2021-07-04 10:08:36', '2021-07-05 07:39:27', NULL),
('P4', 'T1', 'O1', '2020-08-23 16:52:09', 'admin', '2020-08-23 09:52:09', '2020-08-23 09:52:09', NULL),
('P40', 'T1', 'U10', '2021-07-05 16:31:17', 'admin', '2021-07-05 09:31:17', '2021-07-05 09:31:17', NULL),
('P41', 'T4', 'U14', '2021-07-07 09:00:56', 'admin', '2021-07-07 02:00:56', '2021-07-07 02:15:39', NULL),
('P42', 'T5', 'U15', '2021-07-08 20:27:15', 'O4', '2021-07-08 13:27:15', '2021-07-08 13:27:15', NULL),
('P43', 'T5', 'U10', '2021-07-08 20:30:42', 'admin', '2021-07-08 13:30:42', '2021-07-08 13:30:42', NULL),
('P44', 'T8', 'admin', '2021-07-09 13:57:22', 'O4', '2021-07-09 06:57:22', '2021-07-09 06:57:22', NULL),
('P45', 'T16', 'U3', '2021-07-12 16:54:50', 'O1', '2021-07-12 09:54:50', '2021-07-12 09:54:50', NULL),
('P46', 'T12', 'U16', '2021-07-12 17:17:10', 'O4', '2021-07-12 10:17:10', '2021-07-12 10:17:10', NULL),
('P47', 'T14', 'U16', '2021-07-12 17:20:45', 'admin', '2021-07-12 10:20:45', '2021-07-12 10:26:35', NULL),
('P48', 'T14', 'admin', '2021-07-12 17:23:42', 'admin', '2021-07-12 10:23:42', '2021-07-12 10:23:42', NULL),
('P49', 'T7', 'U7', '2021-07-14 20:43:06', 'admin', '2021-07-14 13:43:06', '2021-07-14 13:43:06', NULL),
('P5', 'T3', 'admin', '2020-08-24 13:32:23', 'admin', '2020-08-24 06:32:23', '2020-08-24 06:32:23', NULL),
('P50', 'T7', 'U16', '2021-07-14 20:46:02', 'admin', '2021-07-14 13:46:02', '2021-07-14 13:46:02', NULL),
('P51', 'T17', 'U14', '2021-07-14 20:50:27', 'admin', '2021-07-14 13:50:27', '2021-07-14 13:50:27', NULL),
('P52', 'T17', 'U12', '2021-07-14 20:51:58', 'admin', '2021-07-14 13:51:58', '2021-07-14 13:51:58', NULL),
('P53', 'T7', 'U4', '2021-07-14 21:45:53', 'admin', '2021-07-14 14:45:53', '2021-07-14 14:45:53', NULL),
('P54', 'T7', 'U11', '2021-07-14 22:21:50', 'admin', '2021-07-14 15:21:50', '2021-07-14 15:21:50', NULL),
('P55', 'T7', 'U14', '2021-07-16 17:00:58', 'admin', '2021-07-16 10:00:58', '2021-07-16 10:00:58', NULL),
('P56', 'T7', 'U9', '2021-07-17 22:43:39', 'admin', '2021-07-17 15:43:39', '2021-07-17 15:43:39', NULL),
('P6', 'T4', 'U1', '2020-10-21 09:19:24', 'admin', '2020-10-21 02:19:24', '2020-10-21 02:19:24', NULL),
('P7', 'T2', 'U6', '2021-01-02 14:53:28', 'admin', '2021-01-02 07:53:28', '2021-01-02 07:53:28', NULL),
('P8', 'T2', 'U4', '2021-02-04 22:53:50', 'O4', '2021-02-04 15:53:50', '2021-02-04 15:53:50', NULL);

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
('K1', 'K2', '70000', '2020-03-26 10:08:38', '2021-07-12 10:02:03'),
('K1', 'K3', '100000', '2020-03-10 18:35:44', '2020-08-25 00:19:40'),
('K2', 'K1', '60000', '2020-03-04 13:32:10', '2020-03-10 00:30:26'),
('K2', 'K3', '150000', '2020-03-10 00:30:45', '2020-08-25 00:20:38'),
('K3', 'K1', '100000', '2020-03-26 10:09:17', '2020-08-25 00:20:52'),
('K3', 'K2', '150000', '2020-03-10 00:31:28', '2020-08-25 00:21:11');

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
('7', 'Tujuh', '2021-05-07 22:20:38', '2021-05-07 22:20:38');

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
  `jenis_kelamin` varchar(9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`id_users`, `plat_mobil`, `merek_mobil`, `username`, `email`, `password`, `nama`, `kontak`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('S1', 'BA6709IP', 'Suzuki APV', 'sopir1', 'sopir1@g.c', '$2y$10$NdfSvo3szJJeETt3I5.w/eclNMTG3uo/oY/ExTfWHnGU8AFh/Yiya', 'Sopir Satu', '07855', 'Laki-laki', '2020-06-21 00:20:16', '2021-06-21 08:24:53'),
('S2', 'BA7777BA', 'Xenia', 'sopir2', 'sopir2@g.c', '$2y$10$3iIYyU9rvjwWPdzfO83.pOYm.N3WsJpDd4fL2yOEeRw8R3F6tlp9W', 'Sopir Dua', '06928282', 'Laki-laki', '2020-08-05 02:58:58', '2021-06-21 08:24:41');

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
('T1', 'admin', NULL, 'K1', 'K2', '2021-07-10 12:00:00', '2020-06-25 05:18:29', '2021-07-08 13:50:23'),
('T10', 'admin', NULL, 'K2', 'K1', '2021-07-13 16:44:00', '2021-07-12 09:45:22', '2021-07-13 10:14:32'),
('T11', 'admin', 'S1', 'K1', 'K2', '2021-07-13 16:45:00', '2021-07-12 09:45:55', '2021-07-13 10:14:56'),
('T12', 'admin', NULL, 'K1', 'K2', '2021-07-13 18:05:00', '2021-07-12 09:47:53', '2021-07-13 11:04:21'),
('T13', 'admin', NULL, 'K1', 'K2', '2021-07-13 18:48:00', '2021-07-12 09:48:05', '2021-07-13 10:13:29'),
('T14', 'admin', 'S2', 'K2', 'K1', '2021-07-27 23:48:00', '2021-07-12 09:48:20', '2021-07-27 01:47:08'),
('T15', 'admin', NULL, 'K2', 'K1', '2021-07-13 17:50:00', '2021-07-12 09:50:25', '2021-07-13 10:13:43'),
('T16', 'admin', NULL, 'K1', 'K2', '2021-07-13 17:00:00', '2021-07-12 09:52:28', '2021-07-13 10:14:47'),
('T17', 'admin', NULL, 'K2', 'K1', '2021-07-27 23:44:00', '2021-07-13 12:44:05', '2021-07-27 01:46:36'),
('T2', 'admin', 'S1', 'K1', 'K2', '2021-07-10 12:18:00', '2020-06-25 05:18:48', '2021-07-08 13:51:02'),
('T3', 'admin', 'S1', 'K1', 'K2', '2021-07-11 14:00:00', '2020-06-25 05:19:09', '2021-06-19 04:55:49'),
('T4', 'admin', 'S1', 'K2', 'K1', '2021-07-11 07:39:00', '2020-06-30 00:39:55', '2021-07-07 02:19:40'),
('T5', 'admin', 'S1', 'K1', 'K2', '2021-07-27 09:30:00', '2020-07-12 02:30:41', '2021-07-27 01:46:58'),
('T6', 'admin', NULL, 'K1', 'K2', '2021-07-27 10:57:00', '2020-08-03 03:57:28', '2021-07-27 01:46:49'),
('T7', 'admin', NULL, 'K2', 'K1', '2021-07-27 23:31:00', '2020-08-03 07:31:50', '2021-07-27 01:46:42'),
('T8', 'admin', 'S2', 'K1', 'K2', '2021-07-09 18:01:00', '2021-04-05 11:01:34', '2021-07-09 06:51:08'),
('T9', 'admin', 'S1', 'K1', 'K2', '2021-04-12 18:36:00', '2021-04-05 11:36:42', '2021-04-05 11:36:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
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
  ADD UNIQUE KEY `id_trip` (`id_trip`,`id_users_pemesan`),
  ADD KEY `operator_pesanan_fk` (`id_users_operator`),
  ADD KEY `pemesan_pesanan_fk` (`id_users_pemesan`),
  ADD KEY `trip_pesanan_fk` (`id_trip`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

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
