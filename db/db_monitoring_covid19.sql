-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2021 pada 00.26
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_monitoring_covid19`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_jk`
--

CREATE TABLE `master_jk` (
  `id_jk` int(11) NOT NULL,
  `kode_jk` varchar(5) NOT NULL,
  `jk` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_jk`
--

INSERT INTO `master_jk` (`id_jk`, `kode_jk`, `jk`) VALUES
(1, 'JK001', 'Laki-Laki'),
(2, 'JK002', 'Perempuan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pasien`
--

CREATE TABLE `master_pasien` (
  `id_pasien` int(11) NOT NULL,
  `kode_pasien` varchar(7) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kode_jk` varchar(5) NOT NULL,
  `usia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_pasien`
--

INSERT INTO `master_pasien` (`id_pasien`, `kode_pasien`, `nama`, `kode_jk`, `usia`) VALUES
(1, 'NO_0001', 'Pasien 1', 'JK001', 20),
(2, 'NO_0002', 'Pasien 2', 'JK002', 15),
(3, 'NO_0003', 'Pasien 3', 'JK001', 50),
(4, 'NO_0004', 'Pasien 4', 'JK001', 15),
(12, 'NO_0005', 'Pasien 5', 'JK002', 68),
(13, 'NO_0006', 'Pasien 6', 'JK002', 45),
(14, 'NO_0007', 'Pasien 7', 'JK002', 34),
(15, 'NO_0008', 'Pasien 8', 'JK002', 54),
(16, 'NO_0009', 'Pasien 9', 'JK002', 16),
(17, 'NO_0010', 'Pasien 10', 'JK001', 16),
(18, 'NO_0011', 'Pasien 11', 'JK001', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_status_pasien`
--

CREATE TABLE `master_status_pasien` (
  `id_status` int(11) NOT NULL,
  `kode_status_pasien` varchar(5) NOT NULL,
  `status_pasien` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_status_pasien`
--

INSERT INTO `master_status_pasien` (`id_status`, `kode_status_pasien`, `status_pasien`) VALUES
(1, 'SP001', 'Sembuh'),
(2, 'SP002', 'Dirawat'),
(3, 'SP003', 'Meninggal'),
(4, 'SP004', 'Positif'),
(5, 'SP005', 'Orang Tanpa Gejala');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_status_user`
--

CREATE TABLE `master_status_user` (
  `id_su` int(11) NOT NULL,
  `kode_su` varchar(5) NOT NULL,
  `status_user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_status_user`
--

INSERT INTO `master_status_user` (`id_su`, `kode_su`, `status_user`) VALUES
(1, 'SU001', 'Admin'),
(2, 'SU002', 'SuperAdmin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_status_pasien`
--

CREATE TABLE `tb_status_pasien` (
  `id_pasien` int(11) NOT NULL,
  `kode_pasien` varchar(7) NOT NULL,
  `kode_status_pasien` varchar(5) NOT NULL,
  `tgl_input` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_status_pasien`
--

INSERT INTO `tb_status_pasien` (`id_pasien`, `kode_pasien`, `kode_status_pasien`, `tgl_input`) VALUES
(1, 'NO_0001', 'SP004', '2021-02-22'),
(2, 'NO_0002', 'SP001', '2021-02-23'),
(3, 'NO_0003', 'SP004', '2021-02-21'),
(5, 'NO_0004', 'SP004', '2021-02-24'),
(6, 'NO_0005', 'SP004', '2021-02-24'),
(7, 'NO_0006', 'SP003', '2021-02-20'),
(8, 'NO_0007', 'SP004', '2021-02-20'),
(9, 'NO_0008', 'SP002', '2021-02-19'),
(10, 'NO_0009', 'SP004', '2021-02-18'),
(11, 'NO_0010', 'SP004', '2021-02-18'),
(12, 'NO_0011', 'SP001', '2021-02-17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `kode_user` varchar(5) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `kode_su` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `kode_user`, `nama_user`, `username`, `password`, `kode_su`) VALUES
(1, 'US001', 'Super Admin', 'superadmin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'SU002'),
(3, 'US002', '12345', 'asdasaaa', '8cb2237d0679ca88db6464eac60da96345513964', 'SU001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `master_jk`
--
ALTER TABLE `master_jk`
  ADD PRIMARY KEY (`id_jk`),
  ADD UNIQUE KEY `kode_jk` (`kode_jk`);

--
-- Indeks untuk tabel `master_pasien`
--
ALTER TABLE `master_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD UNIQUE KEY `kode_pasien` (`kode_pasien`),
  ADD KEY `kode_jk` (`kode_jk`);

--
-- Indeks untuk tabel `master_status_pasien`
--
ALTER TABLE `master_status_pasien`
  ADD PRIMARY KEY (`id_status`),
  ADD UNIQUE KEY `kode_status` (`kode_status_pasien`);

--
-- Indeks untuk tabel `master_status_user`
--
ALTER TABLE `master_status_user`
  ADD PRIMARY KEY (`id_su`),
  ADD UNIQUE KEY `kode_su` (`kode_su`);

--
-- Indeks untuk tabel `tb_status_pasien`
--
ALTER TABLE `tb_status_pasien`
  ADD PRIMARY KEY (`id_pasien`),
  ADD KEY `kode_pasien` (`kode_pasien`),
  ADD KEY `kode_status_pasien` (`kode_status_pasien`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `kode_user` (`kode_user`),
  ADD KEY `kode_su` (`kode_su`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_jk`
--
ALTER TABLE `master_jk`
  MODIFY `id_jk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_pasien`
--
ALTER TABLE `master_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `master_status_pasien`
--
ALTER TABLE `master_status_pasien`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `master_status_user`
--
ALTER TABLE `master_status_user`
  MODIFY `id_su` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_status_pasien`
--
ALTER TABLE `tb_status_pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `master_pasien`
--
ALTER TABLE `master_pasien`
  ADD CONSTRAINT `master_pasien_ibfk_1` FOREIGN KEY (`kode_jk`) REFERENCES `master_jk` (`kode_jk`);

--
-- Ketidakleluasaan untuk tabel `tb_status_pasien`
--
ALTER TABLE `tb_status_pasien`
  ADD CONSTRAINT `tb_status_pasien_ibfk_1` FOREIGN KEY (`kode_pasien`) REFERENCES `master_pasien` (`kode_pasien`),
  ADD CONSTRAINT `tb_status_pasien_ibfk_2` FOREIGN KEY (`kode_status_pasien`) REFERENCES `master_status_pasien` (`kode_status_pasien`);

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`kode_su`) REFERENCES `master_status_user` (`kode_su`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
