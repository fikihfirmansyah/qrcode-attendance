-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Okt 2021 pada 08.12
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medina`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen`
--

CREATE TABLE `absen` (
  `id_absen` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absen`
--

INSERT INTO `absen` (`id_absen`, `username`, `tanggal`, `jam_masuk`, `jam_keluar`, `status`) VALUES
(1, 'kiki', '2021-06-01', '08:10:29', '16:13:39', 'pulang'),
(2, 'kiki', '2021-06-02', '08:10:29', '16:13:39', 'pulang'),
(3, 'kiki', '2021-06-03', '08:10:29', '16:13:39', 'pulang'),
(4, 'kiki', '2021-06-04', '08:10:29', '16:13:39', 'pulang'),
(5, 'kiki', '2021-06-05', '08:10:29', '16:13:39', 'pulang'),
(6, 'kiki', '2021-06-06', '08:10:29', '16:13:39', 'pulang'),
(7, 'kiki', '2021-07-21', '15:44:40', '00:00:00', 'terlambat'),
(8, 'kaikai', '2021-07-22', '01:32:26', '00:00:00', 'masuk'),
(13, 'kaikai', '2021-07-24', '08:12:57', '00:00:00', 'masuk'),
(14, 'kiki', '2021-07-24', '21:04:02', '00:00:00', 'terlambat'),
(15, 'kiki', '2021-07-28', '19:55:51', '19:56:30', 'pulang'),
(17, 'kiki', '2021-07-29', '16:33:19', '16:34:30', 'pulang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `jabatan_id` int(11) NOT NULL,
  `jabatan_nama` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`) VALUES
(1, 'Barang dan Jasa Keuangan'),
(11, 'Keuangan'),
(12, 'Testing'),
(13, 'sekretaris');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam`
--

CREATE TABLE `jam` (
  `id_jam` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time NOT NULL,
  `toleransi_masuk` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jam`
--

INSERT INTO `jam` (`id_jam`, `jam_masuk`, `jam_keluar`, `toleransi_masuk`) VALUES
(1, '08:00:00', '16:00:00', '09:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `nip` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` enum('1','2') NOT NULL,
  `photo` varchar(120) DEFAULT NULL,
  `jabatan_id` int(11) NOT NULL,
  `waktu_masuk` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`nip`, `nama`, `jenis_kelamin`, `username`, `password`, `role_id`, `photo`, `jabatan_id`, `waktu_masuk`) VALUES
(123, 'Administrator', 'L', 'admin', '$2y$10$VqvV0UfbaEhwfR0v1nQUOOz0SY461B3Q41cwaHiqocwfN5uG9lUge', '1', 'default.png', 10, '2021-05-10'),
(234565, 'kiki salam ruzkii', 'L', 'kiki', '$2y$10$K4vt9LlHiz7/9jdpeyZcp.9sA8HGQYDqTGEyC.a9pVZmbGVgb8jdy', '2', NULL, 1, '2021-06-26');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absen`
--
ALTER TABLE `absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`jabatan_id`);

--
-- Indeks untuk tabel `jam`
--
ALTER TABLE `jam`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`nip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absen`
--
ALTER TABLE `absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `jabatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `jam`
--
ALTER TABLE `jam`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
