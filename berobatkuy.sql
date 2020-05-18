-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Bulan Mei 2020 pada 10.37
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berobatkuy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `artikelID` int(11) NOT NULL,
  `isiArtikel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `commentID` int(15) NOT NULL,
  `review` varchar(255) DEFAULT NULL,
  `userID` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`commentID`, `review`, `userID`) VALUES
(1, 'platform yang uapik tenaannn', 22),
(2, 'muantap bagi pasien-pasien jaman now', 24),
(3, 'bagi dokter juga dipermudah sekali', 25),
(11, 'comment dari aji123, mantuulll!!', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailresep`
--

CREATE TABLE `detailresep` (
  `detailResepID` int(15) NOT NULL,
  `obatID` int(15) DEFAULT NULL,
  `detailResepDosis` varchar(50) DEFAULT NULL,
  `resepID` int(15) DEFAULT NULL,
  `detailResepQuantity` int(30) DEFAULT NULL,
  `detailResepSubtotal` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detailresep`
--

INSERT INTO `detailresep` (`detailResepID`, `obatID`, `detailResepDosis`, `resepID`, `detailResepQuantity`, `detailResepSubtotal`) VALUES
(3, 4, '3x sehari setelah minum', 9, 2, 42000),
(7, 5, '2x setelah minum', 9, 1, 8500),
(10, 7, '2x tetes sebelum tidur', 14, 1, 16000),
(14, 7, '1x tetes sebelum tidur', 19, 2, 32000),
(15, 5, '1 sendok makan per hari', 19, 1, 8500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwaldokter`
--

CREATE TABLE `jadwaldokter` (
  `jadwalID` int(15) NOT NULL,
  `dokterID` int(15) DEFAULT NULL,
  `jadwalWaktu` varchar(30) DEFAULT NULL,
  `jadwalDurasi` int(2) NOT NULL,
  `jadwalKuota` int(45) DEFAULT NULL,
  `jadwalRuangan` varchar(15) DEFAULT NULL,
  `jadwalTanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jadwaldokter`
--

INSERT INTO `jadwaldokter` (`jadwalID`, `dokterID`, `jadwalWaktu`, `jadwalDurasi`, `jadwalKuota`, `jadwalRuangan`, `jadwalTanggal`) VALUES
(10, 25, '14:30', 4, 4, 'A01', '2020-04-09'),
(11, 25, '18:00', 2, 2, 'A02', '2020-05-02'),
(12, 25, '16:00', 3, 3, 'A03', '2020-04-07'),
(13, 25, '20:30', 2, 2, 'C111', '2020-05-13'),
(14, 26, '19:30', 2, 4, 'B999', '2020-05-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisperiksa`
--

CREATE TABLE `jenisperiksa` (
  `jenisPeriksaID` int(15) NOT NULL,
  `jenisPeriksaNama` varchar(15) DEFAULT NULL,
  `jenisPeriksaHarga` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenisperiksa`
--

INSERT INTO `jenisperiksa` (`jenisPeriksaID`, `jenisPeriksaNama`, `jenisPeriksaHarga`) VALUES
(1, 'Penyakit Ringan', 100000),
(2, 'Penyakit Sedang', 200000),
(3, 'Penyakit Kronis', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `notaID` int(15) NOT NULL,
  `kasirID` int(15) DEFAULT NULL,
  `notaTotalHarga` int(30) DEFAULT NULL,
  `pemeriksaanID` int(15) DEFAULT NULL,
  `resepID` int(15) DEFAULT NULL,
  `notaStatus` varchar(15) DEFAULT NULL,
  `code` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`notaID`, `kasirID`, `notaTotalHarga`, `pemeriksaanID`, `resepID`, `notaStatus`, `code`) VALUES
(7, 21, 50500, NULL, 9, 'sudah bayar', '447'),
(8, 21, 300000, 19, NULL, 'sudah bayar', '275'),
(10, 21, 16000, NULL, 14, 'sudah bayar', '313'),
(11, 21, 200000, 20, NULL, 'sudah bayar', '937'),
(13, 21, 40500, NULL, 19, 'sudah bayar', '261');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `obatID` int(15) NOT NULL,
  `obatNama` varchar(30) DEFAULT NULL,
  `obatHarga` int(30) DEFAULT NULL,
  `obatGolongan` varchar(15) DEFAULT NULL,
  `obatFoto` varchar(50) DEFAULT NULL,
  `obatDeskripsi` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`obatID`, `obatNama`, `obatHarga`, `obatGolongan`, `obatFoto`, `obatDeskripsi`) VALUES
(4, 'Paracetamol', 14000, 'sedang', 'paracetamol.jpg', 'obat yang dapat meredakan demam dan mengurangi rasa pusing'),
(5, 'mixagrip', 8500, 'ringan', NULL, 'digunakan untuk meredakan pusing kepala'),
(6, 'OBH Combi', 18000, 'sedang', 'obh.jpg', 'obat yang dapat mengurangi dahak dan batuk - batuk'),
(7, 'Insto', 16000, 'ringan', '', 'obat untuk mengurangi nyeri mata dan keburaman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `pekerjaanID` int(15) NOT NULL,
  `pekerjaanNama` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`pekerjaanID`, `pekerjaanNama`) VALUES
(1, 'Customer'),
(2, 'Admin'),
(3, 'Apoteker'),
(4, 'Kasir'),
(5, 'Dokter Mata'),
(6, 'Dokter THT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `pemeriksaanID` int(15) NOT NULL,
  `pendaftranID` int(15) DEFAULT NULL,
  `pemeriksaanHasil` varchar(100) DEFAULT NULL,
  `jenisPeriksaID` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemeriksaan`
--

INSERT INTO `pemeriksaan` (`pemeriksaanID`, `pendaftranID`, `pemeriksaanHasil`, `jenisPeriksaID`) VALUES
(15, 14, 'cukup banyakin istirahat sm vitamin C', 1),
(16, 16, 'semangat...masih ada harapan hdup kok', 2),
(19, 19, 'coba perbanyak dengan main game, insyaAllah tambah kronis', 3),
(20, 20, 'hanya karena kebanyakan begadang saja, sebenarnya baik-baik saja', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `pendaftaranID` int(15) NOT NULL,
  `pasienID` int(15) DEFAULT NULL,
  `jadwalID` int(15) DEFAULT NULL,
  `pendaftaranTanggal` varchar(20) DEFAULT NULL,
  `pendaftaranStatus` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`pendaftaranID`, `pasienID`, `jadwalID`, `pendaftaranTanggal`, `pendaftaranStatus`) VALUES
(14, 22, 12, '08-04-2020', 'Sudah Diperiksa'),
(16, 22, 10, '09-04-2020', 'Sudah Diperiksa'),
(19, 22, 11, '26-04-2020', 'Sudah Diperiksa'),
(20, 22, 13, '13-05-2020', 'Sudah Diperiksa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `resepID` int(15) NOT NULL,
  `resepTanggal` varchar(50) NOT NULL,
  `dokterID` int(15) NOT NULL,
  `pendaftaranID` int(15) DEFAULT NULL,
  `apotekerID` int(11) DEFAULT NULL,
  `resepStatus` varchar(30) DEFAULT NULL,
  `resepTotalHarga` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `resep`
--

INSERT INTO `resep` (`resepID`, `resepTanggal`, `dokterID`, `pendaftaranID`, `apotekerID`, `resepStatus`, `resepTotalHarga`) VALUES
(9, '2020-04-13', 25, 16, 20, 'Sudah Dibuat', 50500),
(14, '2020-05-02', 25, 19, 20, 'Sudah Dibuat', 16000),
(19, '2020-05-13', 25, 20, 20, 'Sudah Dibuat', 40500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userId` int(15) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `userNama` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `userEmail` varchar(30) DEFAULT NULL,
  `userTelephone` varchar(30) DEFAULT NULL,
  `userAlamat` varchar(30) DEFAULT NULL,
  `userPekerjaan` int(15) DEFAULT NULL,
  `userFoto` varchar(50) DEFAULT NULL,
  `userTanggalLahir` varchar(20) DEFAULT NULL,
  `userJenisKelamin` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userId`, `username`, `userNama`, `password`, `userEmail`, `userTelephone`, `userAlamat`, `userPekerjaan`, `userFoto`, `userTanggalLahir`, `userJenisKelamin`) VALUES
(10, 'admin1', 'admin1', '9d2878abdd504d16fe6262f17c80dae5cec34440', '', '', '', 2, '', '', 'Laki-laki'),
(20, 'apoteker', 'apoteker 1', '8e30c3e6d50e5d7c02e7eaffa5954b04d4a3afaf', '', NULL, NULL, 3, '585e4bf3cb11b227491c339a.png', NULL, 'Laki-laki'),
(21, 'kasir', 'kasir', '8691e4fc53b99da544ce86e22acba62d13352eff', '', NULL, NULL, 4, '585e4bf3cb11b227491c339a.png', NULL, 'Laki-laki'),
(22, 'aji123', 'Satriyo Aji', '7c33489720fccf682f22f2efb2cefc7aee7de177', 'aji@gmail.com', '087754478760', 'Jl. Gajah Putih', 1, NULL, '', 'Laki-laki'),
(24, 'pasien1', 'Pasien 1', '60f96079f03633e437caf4aad4a8e482a678dc3d', 'pasien@gmail.com', NULL, NULL, 1, NULL, NULL, 'Laki-laki'),
(25, 'doktermata1', 'Dokter Mata A', '92f0fa0edfab97c45d68233b209af073460e6d48', 'doktermata1@gmail.com', NULL, NULL, 5, NULL, NULL, 'Laki-laki'),
(26, 'doktermata2', 'Dokter Mata B', '7dbe51b057467cdd48b58b016aa919fc9f635a85', 'doktermata2@gmail.com', NULL, NULL, 5, NULL, NULL, 'Perempuan'),
(27, 'doktertht1', 'Dokter THT 1', '9587c92a768b3bee2817951d7db89616f09fc225', 'dokter@tht.com', NULL, NULL, 6, NULL, NULL, 'Laki-laki');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikelID`);

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentID`),
  ADD KEY `comment_ibfk_1` (`userID`);

--
-- Indeks untuk tabel `detailresep`
--
ALTER TABLE `detailresep`
  ADD PRIMARY KEY (`detailResepID`),
  ADD KEY `obatID` (`obatID`),
  ADD KEY `resepID` (`resepID`);

--
-- Indeks untuk tabel `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  ADD PRIMARY KEY (`jadwalID`),
  ADD KEY `jadwalDokterID` (`dokterID`);

--
-- Indeks untuk tabel `jenisperiksa`
--
ALTER TABLE `jenisperiksa`
  ADD PRIMARY KEY (`jenisPeriksaID`);

--
-- Indeks untuk tabel `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`notaID`),
  ADD KEY `resepID` (`resepID`),
  ADD KEY `pemeriksaanID` (`pemeriksaanID`),
  ADD KEY `kasirID` (`kasirID`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`obatID`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`pekerjaanID`);

--
-- Indeks untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`pemeriksaanID`),
  ADD KEY `pendaftranID` (`pendaftranID`),
  ADD KEY `jenisPeriksaID` (`jenisPeriksaID`) USING BTREE;

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`pendaftaranID`),
  ADD KEY `pendaftaranPasienID` (`pasienID`),
  ADD KEY `pendaftaranDokterID` (`jadwalID`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`resepID`),
  ADD KEY `resepApotekerID` (`dokterID`),
  ADD KEY `pendaftaranID` (`pendaftaranID`),
  ADD KEY `resep_ibfk_4` (`apotekerID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userPekerjaan` (`userPekerjaan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `commentID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `detailresep`
--
ALTER TABLE `detailresep`
  MODIFY `detailResepID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  MODIFY `jadwalID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `jenisperiksa`
--
ALTER TABLE `jenisperiksa`
  MODIFY `jenisPeriksaID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `notaID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `obatID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `pekerjaanID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `pemeriksaanID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `pendaftaranID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `resepID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userId`);

--
-- Ketidakleluasaan untuk tabel `detailresep`
--
ALTER TABLE `detailresep`
  ADD CONSTRAINT `detailresep_ibfk_1` FOREIGN KEY (`resepID`) REFERENCES `resep` (`resepID`),
  ADD CONSTRAINT `detailresep_ibfk_2` FOREIGN KEY (`obatID`) REFERENCES `obat` (`obatID`);

--
-- Ketidakleluasaan untuk tabel `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  ADD CONSTRAINT `jadwaldokter_ibfk_1` FOREIGN KEY (`dokterID`) REFERENCES `users` (`userId`);

--
-- Ketidakleluasaan untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`kasirID`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`resepID`) REFERENCES `resep` (`resepID`),
  ADD CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`pemeriksaanID`) REFERENCES `pemeriksaan` (`pemeriksaanID`);

--
-- Ketidakleluasaan untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`jenisPeriksaID`) REFERENCES `jenisperiksa` (`jenisPeriksaID`),
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`pendaftranID`) REFERENCES `pendaftaran` (`pendaftaranID`);

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`pasienID`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`jadwalID`) REFERENCES `jadwaldokter` (`jadwalID`);

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk1_1` FOREIGN KEY (`apotekerID`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `resep_ibfk1_2` FOREIGN KEY (`dokterID`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `resep_ibfk1_3` FOREIGN KEY (`pendaftaranID`) REFERENCES `pendaftaran` (`pendaftaranID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
