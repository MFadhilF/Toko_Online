-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Okt 2023 pada 13.40
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `kode_customer` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `telp` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`kode_customer`, `nama`, `email`, `username`, `password`, `telp`) VALUES
('C0001', 'fadhil', 'm.fadhil7305@gmail.com', 'fadhil', '$2y$10$brpA6jlDqV/xTj9HxRNfvOeVlhx7vQ9ELbG3mKXLCSt8rD3NzgkUu', '082122214514');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Baju Kemeja 2'),
(2, 'Sepatu'),
(3, 'Tas'),
(5, 'Jam'),
(8, 'Jaket'),
(9, 'Celana');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(5, 1, 'kemeja 2', 400000, '2Cxzl0unNSnxjAvetVlH.jpg', '                        Baju kemeja untuk keluar                        ', 'tersedia'),
(6, 1, 'Baju 2', 140000, 'gdsmq2E1KFc3PeVQxEuy.jpg', '', 'tersedia'),
(7, 1, 'Baju 3', 150000, '0qVh4VH8HcLYdTeV3NAB.jpg', '', 'tersedia'),
(8, 3, 'Tas 1', 500000, '7ehqpfhMTJ0pT2jsOqjn.jpg', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', 'tersedia'),
(11, 3, 'Tas 2', 120000, 'fZgqnesN0mlzXnQ3mzLE.jpg', '                                                                                                                                                                                                                                                ', 'tersedia'),
(12, 3, 'Tas 3', 200000, 'tk3jvYr16w8n9V7JRKy7.jpg', '                                                                                                ', 'tersedia'),
(13, 2, 'Sepatu 1', 320000, '8LCq89mpr4mTgEYy6Ubk.jpg', '', 'tersedia'),
(14, 2, 'Sepatu 2', 200000, 'UsdBM8SmTNfc2vv1fGmb.jpg', '', 'tersedia'),
(15, 2, 'Sepatu 3', 100000, 'yuZ9hFkMd5xmUs5xAWRF.jpg', '', 'tersedia'),
(16, 5, 'Jam 1', 400000, '1aCLoByV3X4lQ3mj4nV4.jpg', '', 'tersedia'),
(17, 5, 'Jam 2', 500000, 'k6H3MvyLfYW6BlhxzJ3x.jpg', '', 'tersedia'),
(18, 5, 'Jam 3', 300000, 'K6KTnmbywc04RfPQ63mN.jpg', '', 'tersedia'),
(19, 8, 'Jaket 1', 1500000, '5UYq3aTY5lK2uAbDVndv.jpg', '', 'tersedia'),
(20, 8, 'Jaket 2', 1500000, 'niRZ9KrxMxXPLtTkIWKs.jpg', '', 'tersedia'),
(21, 8, 'Jaket 3', 500000, 'nXK0Qh1mm6dsIKXzPUsa.jpg', '', 'tersedia'),
(22, 9, 'Celana 1', 100000, 'lKzkvFt0h1Xz7GuvXzpC.jpg', '', 'tersedia'),
(23, 9, 'Celana 2', 140000, 'z7DRHVLO2xqgFsz02l3e.jpg', '', 'tersedia'),
(24, 9, 'Celana 3', 520000, 'rOOQSJ8nRpx9uFDXIPqT.jpg', '', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2a$12$WmZc8oGq6b6EMSJm82iF5eWHtBBITzWpXq9EAtX2icaadvprNuInW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nama` (`nama`),
  ADD KEY `kategori_produk` (`kategori_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
