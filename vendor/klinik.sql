-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Bulan Mei 2019 pada 08.36
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detailresep`
--

CREATE TABLE `detailresep` (
  `detailResepID` int(15) NOT NULL,
  `obatID` int(15) DEFAULT NULL,
  `detailResepDosis` varchar(15) DEFAULT NULL,
  `resepID` int(15) DEFAULT NULL,
  `detailResepQuantity` int(30) DEFAULT NULL,
  `detailResepSubtotal` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwaldokter`
--

CREATE TABLE `jadwaldokter` (
  `jadwalID` int(15) NOT NULL,
  `dokterID` int(15) DEFAULT NULL,
  `jadwalWaktu` varchar(30) DEFAULT NULL,
  `jadwalKuota` int(45) DEFAULT NULL,
  `jadwalRuangan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenisperiksa`
--

CREATE TABLE `jenisperiksa` (
  `jenisPeriksaID` int(15) NOT NULL,
  `jenisPeriksaNama` varchar(15) DEFAULT NULL
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
  `notaStatus` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `obatID` int(15) NOT NULL,
  `obatNama` varchar(30) DEFAULT NULL,
  `obatHarga` int(30) DEFAULT NULL,
  `obatGolongan` varchar(15) DEFAULT NULL,
  `obatFoto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `pekerjaanID` int(15) NOT NULL,
  `pekerjaanNama` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `pemeriksaanID` int(15) NOT NULL,
  `pendaftranID` int(15) DEFAULT NULL,
  `pemeriksaanHasil` varchar(50) DEFAULT NULL,
  `jenisPeriksaID` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `pendaftaranID` int(15) NOT NULL,
  `pasienID` int(15) DEFAULT NULL,
  `dokterID` int(15) DEFAULT NULL,
  `pendaftaranTanggal` varchar(20) DEFAULT NULL,
  `pendaftaranStatus` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `resep`
--

CREATE TABLE `resep` (
  `resepID` int(15) NOT NULL,
  `resepTanggal` varchar(20) DEFAULT NULL,
  `apotekerID` int(15) DEFAULT NULL,
  `pendaftaranID` int(15) DEFAULT NULL,
  `resepStatus` varchar(30) DEFAULT NULL,
  `resepTotalHarga` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userId` int(15) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `userNama` varchar(30) DEFAULT NULL,
  `userPassword` varchar(30) DEFAULT NULL,
  `userEmail` varchar(30) DEFAULT NULL,
  `userTelephone` varchar(30) DEFAULT NULL,
  `userAlamat` varchar(30) DEFAULT NULL,
  `userPekerjaan` int(15) DEFAULT NULL,
  `userFoto` varchar(50) DEFAULT NULL,
  `userTanggalLahir` varchar(20) DEFAULT NULL,
  `userJenisKelamin` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `jenisPeriksaID` (`jenisPeriksaID`),
  ADD KEY `pendaftranID` (`pendaftranID`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`pendaftaranID`),
  ADD KEY `pendaftaranPasienID` (`pasienID`),
  ADD KEY `pendaftaranDokterID` (`dokterID`);

--
-- Indeks untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`resepID`),
  ADD KEY `resepApotekerID` (`apotekerID`),
  ADD KEY `pendaftaranID` (`pendaftaranID`);

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
-- AUTO_INCREMENT untuk tabel `detailresep`
--
ALTER TABLE `detailresep`
  MODIFY `detailResepID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  MODIFY `jadwalID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenisperiksa`
--
ALTER TABLE `jenisperiksa`
  MODIFY `jenisPeriksaID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `notaID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `obatID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `pekerjaanID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `pemeriksaanID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `pendaftaranID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `resep`
--
ALTER TABLE `resep`
  MODIFY `resepID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(15) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

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
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`dokterID`) REFERENCES `users` (`userId`);

--
-- Ketidakleluasaan untuk tabel `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`pendaftaranID`) REFERENCES `pendaftaran` (`pendaftaranID`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`apotekerID`) REFERENCES `users` (`userId`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userPekerjaan`) REFERENCES `pekerjaan` (`pekerjaanID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
