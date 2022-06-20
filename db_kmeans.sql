-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 02:13 AM
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
  `jurusanAsal` int(11) NOT NULL,
  `jurusanTujuan` int(11) NOT NULL,
  `id_mk` varchar(11) NOT NULL,
  `x1` int(11) NOT NULL,
  `x2` int(11) NOT NULL,
  `x3` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `cluster` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataset`
--

INSERT INTO `dataset` (`id`, `jurusanAsal`, `jurusanTujuan`, `id_mk`, `x1`, `x2`, `x3`, `total`, `cluster`, `updated_at`, `created_at`) VALUES
(1, 2, 1, '1', 4, 4, 3, 11, 4, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(2, 2, 1, '2', 1, 2, 2, 5, 2, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(3, 2, 1, '3', 1, 3, 2, 6, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(4, 2, 1, '4', 2, 2, 3, 7, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(5, 2, 1, '9', 2, 3, 1, 6, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(6, 2, 1, '10', 2, 3, 3, 8, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(7, 2, 1, '11', 3, 1, 4, 8, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(8, 2, 1, '12', 1, 3, 4, 8, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(9, 2, 1, '13', 1, 4, 4, 9, 4, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(10, 2, 1, '14', 1, 2, 3, 6, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(11, 2, 1, '15', 3, 4, 4, 11, 4, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(12, 2, 1, '16', 1, 1, 4, 6, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(13, 2, 1, '17', 1, 2, 2, 5, 2, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(14, 2, 1, '18', 2, 3, 3, 8, 3, '2022-06-19 16:53:31', '2022-06-19 16:53:31'),
(15, 2, 3, '7', 2, 2, 1, 5, 2, '2022-06-19 16:55:40', '2022-06-19 16:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE `krs` (
  `id_krs` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `matkul` text NOT NULL,
  `status` enum('APPROVED','WAITING','REJECTED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`id_krs`, `id_user`, `matkul`, `status`) VALUES
(3, 2, 'a:1:{i:0;s:1:\"7\";}', 'REJECTED'),
(4, 2, 'a:2:{i:0;s:2:\"15\";i:1;s:2:\"13\";}', 'APPROVED');

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
(1, 'Teknik Mesin'),
(2, 'Teknik Elektronika'),
(3, 'Teknik Kimia');

-- --------------------------------------------------------

--
-- Table structure for table `list_matkul`
--

CREATE TABLE `list_matkul` (
  `id_mk` varchar(11) NOT NULL,
  `id_prodi` int(11) NOT NULL,
  `matkul` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_matkul`
--

INSERT INTO `list_matkul` (`id_mk`, `id_prodi`, `matkul`, `sks`, `kuota`) VALUES
('1', 1, 'Sinyal Analog & Digital', 1, 100),
('10', 2, 'Desain Penelitian', 1, 100),
('11', 1, 'Antarmuka & Mikrokontroler', 1, 100),
('12', 1, 'Manajemen Perusahaan & Pemasaran', 1, 100),
('13', 1, 'Desain Kontrol', 1, 100),
('14', 1, 'Sensor dan Aktuator', 1, 100),
('15', 1, 'Sistem Pengaturan', 1, 100),
('16', 2, 'Otomatisasi Industri dan Robotika', 1, 100),
('17', 2, 'Analisis Struktur', 1, 100),
('18', 2, 'Teknik Inspeksi', 1, 100),
('19', 4, 'Ekonomi dan Manajemen Proyek', 1, 100),
('2', 1, 'Sistem Informasi Manajemen', 1, 100),
('20', 4, 'Kontrol Sistem Tenaga', 1, 100),
('3', 2, 'Desain & Pengembangan Produk', 1, 100),
('4', 2, 'Sistem Manajemen Mutu', 1, 100),
('5', 3, 'Sistem Komunikasi Seluler', 1, 100),
('6', 4, 'Sistem Manajemen Kualitas', 1, 100),
('7', 5, 'Optimasi Proses', 1, 100),
('8', 4, 'Sistem Manajemen Energi', 1, 100),
('9', 2, 'Analisis Kegagalan Teknik', 1, 100);

-- --------------------------------------------------------

--
-- Table structure for table `list_prodi`
--

CREATE TABLE `list_prodi` (
  `id_prodi` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_prodi`
--

INSERT INTO `list_prodi` (`id_prodi`, `jurusan_id`, `prodi`) VALUES
(1, 1, 'D4 TOE'),
(2, 1, 'D4 TMPP'),
(3, 2, 'JTD'),
(4, 2, 'D4 LISTRIK'),
(5, 3, 'TEKNOLOGI KIMIA INDUSTRI');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `jurusan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nim`, `jurusan`, `nama`, `username`, `password`, `role`) VALUES
(1, 0, 1, 'admin', 'admin', '$2y$10$7lGTO4Dbs5wLYpomxsV.CeI68LqOdKzTEa1LJ5yovfp6Dmjd9arq2', 1),
(2, 1, 2, '', 'user', '$2y$10$8rulMeFTNpEr1MYPh1B6HeXH6hANZkHjFf7S/faPksKrXDm2mESmS', 3),
(3, 2, 3, '', 'user2', '$2y$10$JT4w30c/gkI5Z9ue6o5TiuehK7kez72.dlHz1pC5Y0EQgXrXqg/C6', 3),
(4, 3, 1, '', 'user3', '$2y$10$1x/QRD6Jj35hPkCIyyB8o.xrAa/0IPiVRiWvKTLxU5fLUkkfv0ml2', 3),
(5, 4, 2, '', 'user4', '$2y$10$M/0a.NcVClF3otJAfZWNj.PK0/TKoPSvrCtEs7cRxSdcRoXiM8LRW', 3),
(6, 21212121, 1, 'adsfasdf', 'asdasd', '$2y$10$uao90L9aYHDXdstlciQq3ui.fjo32f8DXCi81jYTLvb2DlH.LcT86', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataset`
--
ALTER TABLE `dataset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mk` (`id_mk`),
  ADD KEY `jurusanAkhir` (`jurusanTujuan`),
  ADD KEY `jurusanAsal` (`jurusanAsal`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
  ADD PRIMARY KEY (`id_krs`),
  ADD KEY `id_user` (`id_user`);

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
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `list_prodi`
--
ALTER TABLE `list_prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIM` (`nim`),
  ADD KEY `jurusan` (`jurusan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataset`
--
ALTER TABLE `dataset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dataset`
--
ALTER TABLE `dataset`
  ADD CONSTRAINT `dataset_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `list_matkul` (`id_mk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dataset_ibfk_2` FOREIGN KEY (`jurusanTujuan`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dataset_ibfk_3` FOREIGN KEY (`jurusanAsal`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list_matkul`
--
ALTER TABLE `list_matkul`
  ADD CONSTRAINT `list_matkul_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `list_prodi` (`id_prodi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `list_prodi`
--
ALTER TABLE `list_prodi`
  ADD CONSTRAINT `list_prodi_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`jurusan`) REFERENCES `list_jurusan` (`id_lj`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
