-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2022 pada 16.38
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Struktur dari tabel `list_jurusan`
--

CREATE TABLE `list_jurusan` (
  `id_lj` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `list_jurusan`
--

INSERT INTO `list_jurusan` (`id_lj`, `nama_jurusan`) VALUES
(1, 'Teknologi Informatika'),
(2, 'Manajemen Informatika'),
(3, 'Teknik Elektro'),
(4, 'Kimia'),
(5, 'Akuntansi'),
(6, 'Administrasi Niaga'),
(7, 'Dokter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_matkul`
--

CREATE TABLE `list_matkul` (
  `id_mk` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `matkul` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  `kuota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_prodi`
--

CREATE TABLE `list_prodi` (
  `id_prodi` int(11) NOT NULL,
  `jurusan_id` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `tingkat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$IvAH2mpLumeyqXzU0zfokuYBsN4ObJcGf9gtWgpwV77yH03VS5Gzy', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `list_jurusan`
--
ALTER TABLE `list_jurusan`
  ADD PRIMARY KEY (`id_lj`);

--
-- Indeks untuk tabel `list_matkul`
--
ALTER TABLE `list_matkul`
  ADD PRIMARY KEY (`id_mk`);

--
-- Indeks untuk tabel `list_prodi`
--
ALTER TABLE `list_prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `list_jurusan`
--
ALTER TABLE `list_jurusan`
  MODIFY `id_lj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `list_matkul`
--
ALTER TABLE `list_matkul`
  MODIFY `id_mk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `list_prodi`
--
ALTER TABLE `list_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
