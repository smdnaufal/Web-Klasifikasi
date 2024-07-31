-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 12:02 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_klasifikasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_rumah`
--

CREATE TABLE `tb_data_rumah` (
  `id_data_rumah` int(11) NOT NULL,
  `kepemilikan_rumah` varchar(50) NOT NULL,
  `sumber_listrik` varchar(50) NOT NULL,
  `daya_listrik` varchar(20) NOT NULL,
  `luas_rumah` varchar(50) NOT NULL,
  `atap` varchar(50) NOT NULL,
  `tembok` varchar(50) NOT NULL,
  `sumber_air` varchar(50) NOT NULL,
  `orang_tinggal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ekonomi`
--

CREATE TABLE `tb_ekonomi` (
  `id_ekonomi` int(11) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `penghasilan_orang_tua` varchar(20) NOT NULL,
  `total_tabungan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `nim` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_data_rumah` int(11) NOT NULL,
  `id_ekonomi` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `id_rencana` int(11) NOT NULL,
  `jenis_beasiswa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `id_nilai` int(11) NOT NULL,
  `ranking` varchar(30) NOT NULL,
  `rerata_nilai` varchar(20) NOT NULL,
  `ip_semester` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rencana_hidup`
--

CREATE TABLE `tb_rencana_hidup` (
  `id_rencana` int(11) NOT NULL,
  `rencana_tinggal` varchar(50) NOT NULL,
  `biaya_transportasi` varchar(20) NOT NULL,
  `kendaraan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_data_rumah`
--
ALTER TABLE `tb_data_rumah`
  ADD PRIMARY KEY (`id_data_rumah`);

--
-- Indexes for table `tb_ekonomi`
--
ALTER TABLE `tb_ekonomi`
  ADD PRIMARY KEY (`id_ekonomi`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `id_data_rumah` (`id_data_rumah`),
  ADD KEY `id_ekonomi` (`id_ekonomi`),
  ADD KEY `id_nilai` (`id_nilai`),
  ADD KEY `id_rencana` (`id_rencana`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `tb_rencana_hidup`
--
ALTER TABLE `tb_rencana_hidup`
  ADD PRIMARY KEY (`id_rencana`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_data_rumah`
--
ALTER TABLE `tb_data_rumah`
  MODIFY `id_data_rumah` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_ekonomi`
--
ALTER TABLE `tb_ekonomi`
  MODIFY `id_ekonomi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_rencana_hidup`
--
ALTER TABLE `tb_rencana_hidup`
  MODIFY `id_rencana` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD CONSTRAINT `tb_mahasiswa_ibfk_1` FOREIGN KEY (`id_rencana`) REFERENCES `tb_rencana_hidup` (`id_rencana`),
  ADD CONSTRAINT `tb_mahasiswa_ibfk_2` FOREIGN KEY (`id_ekonomi`) REFERENCES `tb_ekonomi` (`id_ekonomi`),
  ADD CONSTRAINT `tb_mahasiswa_ibfk_3` FOREIGN KEY (`id_nilai`) REFERENCES `tb_nilai` (`id_nilai`),
  ADD CONSTRAINT `tb_mahasiswa_ibfk_4` FOREIGN KEY (`id_data_rumah`) REFERENCES `tb_data_rumah` (`id_data_rumah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
