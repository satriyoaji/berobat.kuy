-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 04:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

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
-- Table structure for table `detailresep`
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
-- Table structure for table `jadwaldokter`
--

CREATE TABLE `jadwaldokter` (
  `jadwalID` int(15) NOT NULL,
  `dokterID` int(15) DEFAULT NULL,
  `jadwalWaktu` varchar(30) DEFAULT NULL,
  `jadwalKuota` int(45) DEFAULT NULL,
  `jadwalRuangan` varchar(15) DEFAULT NULL,
  `jadwalTanggal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwaldokter`
--

INSERT INTO `jadwaldokter` (`jadwalID`, `dokterID`, `jadwalWaktu`, `jadwalKuota`, `jadwalRuangan`, `jadwalTanggal`) VALUES
(3, 14, '12.00 - 15.00', 4, 'C303', '12-05-2019'),
(4, 16, '12.00 - 15.00', 6, 'C45', NULL),
(5, 17, '14.00 - 16.00', 6, 'C55', NULL),
(6, 16, '08.00 - 11.00', 3, 'C45', NULL),
(7, 14, '12.00 - 15.00', 4, 'C303', '13-05-2019'),
(8, 14, '12.00 - 15.00', 4, 'C303', '14-05-2019');

-- --------------------------------------------------------

--
-- Table structure for table `jenisperiksa`
--

CREATE TABLE `jenisperiksa` (
  `jenisPeriksaID` int(15) NOT NULL,
  `jenisPeriksaNama` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1557127716),
('m130524_201442_init', 1557127721),
('m190124_110200_add_verification_token_column_to_user_table', 1557127721);

-- --------------------------------------------------------

--
-- Table structure for table `nota`
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
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `obatID` int(15) NOT NULL,
  `obatNama` varchar(30) DEFAULT NULL,
  `obatHarga` int(30) DEFAULT NULL,
  `obatGolongan` varchar(15) DEFAULT NULL,
  `obatFoto` varchar(50) DEFAULT NULL,
  `obatDeskripsi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `pekerjaanID` int(15) NOT NULL,
  `pekerjaanNama` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`pekerjaanID`, `pekerjaanNama`) VALUES
(1, 'Customer'),
(2, 'Dokter'),
(3, 'Apoteker'),
(4, 'Kasir'),
(5, 'Dokter Mata'),
(6, 'Dokter Jantung'),
(7, 'Dokter Kulit');

-- --------------------------------------------------------

--
-- Table structure for table `pemeriksaan`
--

CREATE TABLE `pemeriksaan` (
  `pemeriksaanID` int(15) NOT NULL,
  `pendaftranID` int(15) DEFAULT NULL,
  `pemeriksaanHasil` varchar(50) DEFAULT NULL,
  `jenisPeriksaID` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `pendaftaranID` int(15) NOT NULL,
  `pasienID` int(15) DEFAULT NULL,
  `jadwalID` int(15) DEFAULT NULL,
  `pendaftaranTanggal` varchar(20) DEFAULT NULL,
  `pendaftaranStatus` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`pendaftaranID`, `pasienID`, `jadwalID`, `pendaftaranTanggal`, `pendaftaranStatus`) VALUES
(3, 12, NULL, '27-05-2019', 'Belum Periksa'),
(4, 12, 3, '27-05-2019', 'Belum Periksa'),
(5, 12, 7, '27-05-2019', 'Belum Periksa'),
(6, 12, 8, '27-05-2019', 'Belum Periksa'),
(7, 12, 3, '27-05-2019', 'Belum Periksa'),
(8, 12, 3, '27-05-2019', 'Belum Periksa'),
(9, 12, 3, '27-05-2019', 'Belum Periksa');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
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
-- Table structure for table `user`
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
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `username`, `userNama`, `password`, `userEmail`, `userTelephone`, `userAlamat`, `userPekerjaan`, `userFoto`, `userTanggalLahir`, `userJenisKelamin`) VALUES
(10, 'dokter', 'dokter', '9d2878abdd504d16fe6262f17c80dae5cec34440', '', '', '', 2, '', '', 'Laki-laki'),
(11, 'apoterker', 'apoteker', '8e30c3e6d50e5d7c02e7eaffa5954b04d4a3afaf', '', '', '', 3, '', '', 'Laki-laki'),
(12, 'hai', 'hai', '8d813378c294d9c43ea7cbe34e05c65cfa43b630', '', '', '', 1, '', '', ''),
(13, 'hai', 'hai', '8d813378c294d9c43ea7cbe34e05c65cfa43b630', '', '', '', 1, '', '', ''),
(14, 'Dokter1', 'dokter mata', '9d2878abdd504d16fe6262f17c80dae5cec34440', '', '', '', 5, '', '', ''),
(16, 'Dokter2', 'Dokter Jantung', '9d2878abdd504d16fe6262f17c80dae5cec34440', '', NULL, NULL, 6, '585e4bf3cb11b227491c339a.png', NULL, 'Laki-laki'),
(17, 'dokter3', 'Dokter Kulit', '9d2878abdd504d16fe6262f17c80dae5cec34440', '', NULL, NULL, 7, '585e4bf3cb11b227491c339a.png', NULL, 'Perempuan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailresep`
--
ALTER TABLE `detailresep`
  ADD PRIMARY KEY (`detailResepID`),
  ADD KEY `obatID` (`obatID`),
  ADD KEY `resepID` (`resepID`);

--
-- Indexes for table `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  ADD PRIMARY KEY (`jadwalID`),
  ADD KEY `jadwalDokterID` (`dokterID`);

--
-- Indexes for table `jenisperiksa`
--
ALTER TABLE `jenisperiksa`
  ADD PRIMARY KEY (`jenisPeriksaID`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`notaID`),
  ADD KEY `resepID` (`resepID`),
  ADD KEY `pemeriksaanID` (`pemeriksaanID`),
  ADD KEY `kasirID` (`kasirID`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`obatID`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`pekerjaanID`);

--
-- Indexes for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD PRIMARY KEY (`pemeriksaanID`),
  ADD UNIQUE KEY `jenisPeriksaID` (`jenisPeriksaID`),
  ADD KEY `pendaftranID` (`pendaftranID`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`pendaftaranID`),
  ADD KEY `pendaftaranPasienID` (`pasienID`),
  ADD KEY `pendaftaranDokterID` (`jadwalID`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`resepID`),
  ADD KEY `resepApotekerID` (`apotekerID`),
  ADD KEY `pendaftaranID` (`pendaftaranID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `userPekerjaan` (`userPekerjaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailresep`
--
ALTER TABLE `detailresep`
  MODIFY `detailResepID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  MODIFY `jadwalID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenisperiksa`
--
ALTER TABLE `jenisperiksa`
  MODIFY `jenisPeriksaID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nota`
--
ALTER TABLE `nota`
  MODIFY `notaID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `obatID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `pekerjaanID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  MODIFY `pemeriksaanID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `pendaftaranID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `resepID` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailresep`
--
ALTER TABLE `detailresep`
  ADD CONSTRAINT `detailresep_ibfk_1` FOREIGN KEY (`resepID`) REFERENCES `resep` (`resepID`),
  ADD CONSTRAINT `detailresep_ibfk_2` FOREIGN KEY (`obatID`) REFERENCES `obat` (`obatID`);

--
-- Constraints for table `jadwaldokter`
--
ALTER TABLE `jadwaldokter`
  ADD CONSTRAINT `jadwaldokter_ibfk_1` FOREIGN KEY (`dokterID`) REFERENCES `users` (`userId`);

--
-- Constraints for table `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`kasirID`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`resepID`) REFERENCES `resep` (`resepID`),
  ADD CONSTRAINT `nota_ibfk_3` FOREIGN KEY (`pemeriksaanID`) REFERENCES `pemeriksaan` (`pemeriksaanID`);

--
-- Constraints for table `pemeriksaan`
--
ALTER TABLE `pemeriksaan`
  ADD CONSTRAINT `pemeriksaan_ibfk_1` FOREIGN KEY (`jenisPeriksaID`) REFERENCES `jenisperiksa` (`jenisPeriksaID`),
  ADD CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`pendaftranID`) REFERENCES `pendaftaran` (`pendaftaranID`);

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`pasienID`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`jadwalID`) REFERENCES `jadwaldokter` (`jadwalID`);

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`pendaftaranID`) REFERENCES `pendaftaran` (`pendaftaranID`),
  ADD CONSTRAINT `resep_ibfk_3` FOREIGN KEY (`apotekerID`) REFERENCES `users` (`userId`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userPekerjaan`) REFERENCES `pekerjaan` (`pekerjaanID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
