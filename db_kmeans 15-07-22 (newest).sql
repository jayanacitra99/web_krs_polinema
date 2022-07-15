-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 01:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kmeans`
--

-- --------------------------------------------------------

--
-- Table structure for table `dataset`
--

CREATE TABLE `dataset` (
  `id` int(11) NOT NULL,
  `jurusanAsal` int(11) DEFAULT NULL,
  `jurusanTujuan` int(11) DEFAULT NULL,
  `id_mk` varchar(11) DEFAULT NULL,
  `x1` int(11) NOT NULL,
  `x2` int(11) NOT NULL,
  `x3` int(11) NOT NULL,
  `tempx1` decimal(11,6) NOT NULL,
  `tempx2` decimal(11,6) NOT NULL,
  `tempx3` decimal(11,6) NOT NULL,
  `pusatC1` text NOT NULL,
  `pusatC2` text NOT NULL,
  `pusatC3` text NOT NULL,
  `cluster` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `jurusanAsal`, `jurusanTujuan`, `id_mk`, `x1`, `x2`, `x3`, `tempx1`, `tempx2`, `tempx3`, `pusatC1`, `pusatC2`, `pusatC3`, `cluster`, `updated_at`, `created_at`) VALUES
(3, 3, 3, 'RTI215003', 2, 3, 1, '2.236068', '2.449490', '2.449490', '1 1 1', '1 1 2', '1 1 2', 1, '2022-07-13 16:06:50', '2022-07-12 07:45:39'),
(4, 3, 3, 'RTI216005', 1, 1, 2, '1.000000', '0.000000', '0.000000', '1 1 1', '1 1 2', '1 1 2', 2, '2022-07-13 16:06:50', '2022-07-12 07:45:39'),
(5, 3, 3, 'RTI216006', 1, 1, 2, '1.000000', '0.000000', '0.000000', '1 1 1', '1 1 2', '1 1 2', 2, '2022-07-14 07:04:07', '2022-07-12 07:45:39'),
(7, 3, 3, 'RTI212005', 3, 1, 1, '2.000000', '2.236068', '2.236068', '1 1 1', '1 1 2', '1 1 2', 1, '2022-07-14 07:04:07', '2022-07-12 07:45:39'),
(8, 3, 3, 'RTI212008', 1, 1, 2, '1.000000', '0.000000', '0.000000', '1 1 1', '1 1 2', '1 1 2', 2, '2022-07-14 07:04:07', '2022-07-12 07:45:39'),
(9, 3, 3, 'RSI215001', 1, 1, 1, '0.000000', '1.732051', '3.000000', '1 1 1', '2 2 2', '3 3 2', 1, '2022-07-14 07:30:46', '2022-07-12 07:48:07'),
(10, 3, 3, 'RSI215005', 3, 3, 1, '2.828427', '1.732051', '1.000000', '1 1 1', '2 2 2', '3 3 2', 3, '2022-07-14 07:30:46', '2022-07-12 07:48:07'),
(12, 3, 3, 'RSI215006', 1, 1, 2, '1.000000', '1.414214', '2.828427', '1 1 1', '2 2 2', '3 3 2', 1, '2022-07-14 07:30:46', '2022-07-12 07:48:07'),
(13, 3, 3, 'RSI216006', 2, 2, 2, '1.732051', '0.000000', '1.414214', '1 1 1', '2 2 2', '3 3 2', 2, '2022-07-14 07:30:46', '2022-07-12 07:48:07'),
(14, 3, 3, 'RSI216005', 3, 1, 2, '2.236068', '1.414214', '2.000000', '1 1 1', '2 2 2', '3 3 2', 2, '2022-07-14 07:30:46', '2022-07-12 07:48:07'),
(18, 3, 3, 'RTI216007', 2, 1, 1, '1.000000', '1.414214', '1.414214', '1 1 1', '1 1 2', '1 1 2', 1, '2022-07-14 07:04:07', '2022-07-13 09:56:10'),
(19, 3, 3, 'RSI216003', 2, 2, 1, '1.414214', '1.000000', '1.732051', '1 1 1', '2 2 2', '3 3 2', 2, '2022-07-14 07:30:46', '2022-07-13 10:05:45'),
(20, 3, 3, 'RSI215007', 2, 2, 2, '1.732051', '0.000000', '1.414214', '1 1 1', '2 2 2', '3 3 2', 2, '2022-07-14 07:30:46', '2022-07-13 10:05:45'),
(21, 3, 3, 'RTI216002', 1, 1, 1, '0.000000', '1.000000', '1.000000', '1 1 1', '1 1 2', '1 1 2', 1, '2022-07-14 07:04:07', '2022-07-13 16:06:50'),
(22, 3, 3, 'RTI216003', 2, 3, 1, '2.236068', '2.449490', '2.449490', '1 1 1', '1 1 2', '1 1 2', 1, '2022-07-14 07:04:07', '2022-07-13 16:06:50'),
(23, 3, 3, 'RSI215003', 3, 3, 2, '3.000000', '1.414214', '0.000000', '1 1 1', '2 2 2', '3 3 2', 3, '2022-07-14 07:30:46', '2022-07-14 07:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `matkul` text NOT NULL,
  `status` enum('APPROVED','WAITING','REJECTED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `id_user`, `matkul`, `status`) VALUES
(1, 12, 'a:2:{i:0;s:3:\"212\";i:1;s:3:\"218\";}', 'APPROVED');

-- --------------------------------------------------------

--
-- Table structure for table `list_jurusan`
--

CREATE TABLE `list_jurusan` (
  `id_lj` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_jurusan`
--

INSERT INTO `list_jurusan` (`id_lj`, `nama_jurusan`) VALUES
(3, 'Teknologi Informasi'),
(4, 'Teknologi Informasiasdfjasdkjfbadsjkfbads'),
(5, 'sdaasdlkfjads');

-- --------------------------------------------------------

--
-- Table structure for table `list_matkul`
--

CREATE TABLE `list_matkul` (
  `id_mk` varchar(11) NOT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `matkul` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_matkul`
--

INSERT INTO `list_matkul` (`id_mk`, `id_prodi`, `matkul`, `sks`, `kuota`) VALUES
('RSI215001', 7, 'Data Mining', 3, 50),
('RSI215003', 7, 'Kecerdasan Bisnis', 2, 50),
('RSI215005', 7, 'Manajemen Hubungan Pelanggan', 2, 50),
('RSI215006', 7, 'Keamanan Sistem Informasi', 2, 50),
('RSI215007', 7, 'Manajemen Investasi', 2, 50),
('RSI216003', 7, 'Komputasi Awan', 2, 50),
('RSI216005', 7, 'Perencanaan Sumber Daya', 3, 50),
('RSI216006', 7, 'Audit Sistem Informasi', 2, 50),
('RTI212005', 4, 'Rekayasa Perangkat Lunak', 2, 50),
('RTI212008', 4, 'Algoritma dan Struktur Data', 2, 50),
('RTI215003', 4, 'Pemrograman Mobile', 3, 50),
('RTI216002', 4, 'Sistem Pendukung Keputusan', 2, 50),
('RTI216003', 4, 'Big Data', 3, 50),
('RTI216005', 4, 'Internet Of Things', 3, 50),
('RTI216006', 4, 'Pengolahan Citra dan Visi Komputer', 3, 50),
('RTI216007', 4, 'Pemrograman Berbasis Framework', 3, 50);

-- --------------------------------------------------------

--
-- Table structure for table `list_prodi`
--

CREATE TABLE `list_prodi` (
  `id_prodi` int(11) NOT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_prodi`
--

INSERT INTO `list_prodi` (`id_prodi`, `jurusan_id`, `prodi`) VALUES
(4, 3, 'D-IV Teknik Informatika'),
(7, 3, 'D-IV Sistem Informasi Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `jurusan` int(11) DEFAULT NULL,
  `prodi` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `jurusan`, `prodi`, `nama`, `username`, `password`, `role`) VALUES
(1, 0, NULL, NULL, 'admin', 'admin', '$2y$10$7lGTO4Dbs5wLYpomxsV.CeI68LqOdKzTEa1LJ5yovfp6Dmjd9arq2', 1),
(12, 1841720000, 3, 4, 'fima', 'qw', '$2y$10$99/Hzi/hvL.b5AhMd4Xw6OK8HljaEjKrdznM5Ihgdb/sz6xRUJj1q', 3),
(14, 1841720198, 3, 4, 'Bagas Pramana Putra', 'Bagas', '$2y$10$uwWK8FSZ57bN6zDffdZH3esPjjX3cRK6bnJpV/FnmbexXCIGS4atu', 3),
(16, 1841720089, 3, 4, 'microfon', 'we', '$2y$10$LuKtzdeXJGDesIqqO10W0eT.1cYD5RJ0vNZZG7jNQTEsMMKxQtufy', 3),
(17, 1841720099, 3, 7, 'cv', 'cv', '$2y$10$AiQ2zc0mpJBDnLR.9fAGNuLmIEz.eN1VlS75lPql/Pk2JgAjbiEf2', 3),
(18, 9, 3, 4, 'gh', 'mn', '$2y$10$Erj4KBbXpG.BsZbvlfUSqenhBHdoJzENuNxkURVIk4f2tfFDPhuh.', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dataset_ibfk_1` (`id_mk`),
  ADD KEY `dataset_ibfk_2` (`jurusanAsal`),
  ADD KEY `dataset_ibfk_3` (`jurusanTujuan`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `krs_ibfk_1` (`id_user`);

--
-- Indexes for table `list_jurusan`
--
ALTER TABLE `list_jurusan`
  ADD PRIMARY KEY (`id_lj`);

--
-- Indexes for table `list_matkul`
--
ALTER TABLE `list_matkul`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `list_matkul_ibfk_1` (`id_prodi`);

--
-- Indexes for table `list_prodi`
--
ALTER TABLE `list_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `list_prodi_ibfk_1` (`jurusan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIM` (`nim`),
  ADD KEY `users_ibfk_1` (`jurusan`),
  ADD KEY `prodi` (`prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `list_jurusan`
--
ALTER TABLE `list_jurusan`
  MODIFY `id_lj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `list_prodi`
--
ALTER TABLE `list_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dataset`
--
ALTER TABLE `dataset`
  ADD CONSTRAINT `dataset_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `list_matkul` (`id_mk`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dataset_ibfk_2` FOREIGN KEY (`jurusanAsal`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `dataset_ibfk_3` FOREIGN KEY (`jurusanTujuan`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `list_matkul`
--
ALTER TABLE `list_matkul`
  ADD CONSTRAINT `list_matkul_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `list_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `list_prodi`
--
ALTER TABLE `list_prodi`
  ADD CONSTRAINT `list_prodi_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`jurusan`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`prodi`) REFERENCES `list_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
