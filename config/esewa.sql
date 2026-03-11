-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Mar 2026 pada 03.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esewa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `gedung_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_sesi` int(11) DEFAULT NULL,
  `info_sesi` text DEFAULT NULL,
  `durasi_jam` int(11) DEFAULT NULL,
  `jenis_acara` varchar(255) DEFAULT NULL,
  `jumlah_orang` int(10) DEFAULT NULL,
  `status` enum('Proses','Disetujui','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_estonian_ci DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `booking`
--

INSERT INTO `booking` (`id`, `nik`, `nama_pemesan`, `alamat`, `telp`, `gedung_id`, `tanggal`, `jumlah_sesi`, `info_sesi`, `durasi_jam`, `jenis_acara`, `jumlah_orang`, `status`) VALUES
(11, '', 'XYZ', '', '', 1, '2026-03-15', 3, 'Sesi 2 (10.00 - 12.00)\nSesi 3 (12.00 - 14.00)\nSesi 4 (14.00 - 16.00)', 6, 'Pernikahan', NULL, 'Proses'),
(12, '', 'DB', '', '', 2, '2026-03-20', 4, 'Sesi 2 (10.00 - 12.00)\nSesi 3 (12.00 - 14.00)\nSesi 4 (14.00 - 16.00)\nSesi 5 (16.00 - 18.00)', 8, 'Lomba / Kompetisi', NULL, 'Proses'),
(13, '', 'DA', '', '', 3, '2026-03-23', 4, 'Sesi 1 (08.00 - 10.00)\nSesi 2 (10.00 - 12.00)\nSesi 3 (12.00 - 14.00)\nSesi 4 (14.00 - 16.00)', 8, 'Seminar', NULL, 'Proses'),
(14, '', 'XXX', '', '', 4, '2026-03-27', 1, 'Sesi 6 (18.00 - 20.00)', 2, 'Latihan Olahraga', NULL, 'Proses'),
(15, '', 'ABC', '', '', 3, '2026-03-23', 2, 'Sesi 6 (18.00 - 20.00)\nSesi 7 (20.00 - 22.00)', 4, 'Latihan Olahraga', NULL, 'Proses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedung`
--

CREATE TABLE `gedung` (
  `id` int(11) NOT NULL,
  `nama_gedung` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kelurahan` varchar(50) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `luas` varchar(50) NOT NULL,
  `kapasitas` int(11) DEFAULT NULL,
  `harga_persesi` int(11) DEFAULT NULL,
  `fasilitas` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gedung`
--

INSERT INTO `gedung` (`id`, `nama_gedung`, `alamat`, `kelurahan`, `kecamatan`, `luas`, `kapasitas`, `harga_persesi`, `fasilitas`, `gambar`) VALUES
(1, 'Gedung 1', 'Jl. Jugruk Rejosari', 'Kandangan', 'Benowo', '1091,61', 500, 100000, 'Air, Listrik, Parkir', 'assets/custom/img/Gedung1.jpg'),
(2, 'Gedung 2', 'Jl. Sememi Kidul', 'Sememi', 'Benowo', '332,66 ', 200, 50000, 'Air, Listrik, Parkir', 'assets/custom/img/Gedung2.jpg'),
(3, 'Gedung 3', 'Jl. Dukuh Pakis III/5A', 'Dukuh Pakis', 'Dukuh Pakis', '302', 200, 50000, 'Air, Listrik, Parkir', 'assets/custom/img/Gedung3.jpg'),
(4, 'Gedung 4', 'Jl. Tanah Merah', 'Tanah Kali Kedinding', 'Kenjeran', '575,67', 400, 75000, 'Air, Listrik, Parkir', 'assets/custom/img/Gedung4.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`) VALUES
(1, 'Kecamatan A'),
(2, 'Kecamatan B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','validator','kecamatan') DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `kecamatan_id`) VALUES
(1, 'superadmin', '202cb962ac59075b964b07152d234b70', 'superadmin', NULL),
(2, 'validator', '202cb962ac59075b964b07152d234b70', 'validator', NULL),
(3, 'adminA', '202cb962ac59075b964b07152d234b70', 'kecamatan', 1),
(4, 'adminB', '202cb962ac59075b964b07152d234b70', 'kecamatan', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
