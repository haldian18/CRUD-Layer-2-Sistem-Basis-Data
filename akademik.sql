-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2022 pada 12.08
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_prodi`
--

CREATE TABLE `dt_prodi` (
  `idprodi` int(11) NOT NULL,
  `kdprodi` varchar(6) NOT NULL,
  `akreditasi` enum('A','B','C','-') NOT NULL,
  `nmprodi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dt_prodi`
--

INSERT INTO `dt_prodi` (`idprodi`, `kdprodi`, `akreditasi`, `nmprodi`) VALUES
(75, '1', 'A', 'example'),
(79, '2', '-', 'engginering'),
(84, '4', '-', 'DevOps');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dt_prodi`
--
ALTER TABLE `dt_prodi`
  ADD PRIMARY KEY (`idprodi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dt_prodi`
--
ALTER TABLE `dt_prodi`
  MODIFY `idprodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
