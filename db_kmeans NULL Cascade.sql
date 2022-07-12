-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 07:03 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `list_jurusan`
--

CREATE TABLE `list_jurusan` (
  `id_lj` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `list_prodi`
--

CREATE TABLE `list_prodi` (
  `id_prodi` int(11) NOT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 0, NULL, NULL, 'admin', 'admin', '$2y$10$7lGTO4Dbs5wLYpomxsV.CeI68LqOdKzTEa1LJ5yovfp6Dmjd9arq2', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
  MODIFY `id_krs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_jurusan`
--
ALTER TABLE `list_jurusan`
  MODIFY `id_lj` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_prodi`
--
ALTER TABLE `list_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
