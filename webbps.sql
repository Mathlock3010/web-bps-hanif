-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Sep 2026 pada 15.29
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
-- Database: `webbps`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `publikasi`
--

CREATE TABLE `publikasi` (
  `no` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal_rilis` date NOT NULL,
  `sampul` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `publikasi`
--

INSERT INTO `publikasi` (`no`, `judul`, `tanggal_rilis`, `sampul`) VALUES
(1, 'Statistik Harga Produsen Beras di Penggilingan Ekonomi 2025', '2026-03-17', 'cover1.jpg'),
(2, 'Tourism Satellite Account Indonesia 2022-2024', '2026-03-16', 'cover2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', '12345'),
('admin2', '54321'),
('admin', '$2y$10$Ya94EPfsOIOuHTcG1bV6LO2xrRVITm4JsXLJGHKoYc4bL8xE6Acr2'),
('admin', '$2y$10$vBgOtYmfAMJUMrgTHaY19e7YFS4DavywRG7HWcElKQy1I5Zy/nkEG'),
('admin', '$2y$10$F6c9jTsxoqSNJZmGFc2ypufqh0uz0QP44j1dN02DUoRbH3fLFM/Ca');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `publikasi`
--
ALTER TABLE `publikasi`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `publikasi`
--
ALTER TABLE `publikasi`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
