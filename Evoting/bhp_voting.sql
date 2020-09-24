-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2019 at 10:25 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhp_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'pramuka', '$2y$10$QFhfimZiCFkBtJbNUBnifOgtgMRVmjhCZdYnvPOnNDb6BgueVhwj2'),
(2, 'ade', '$2y$10$e3X92cpkux6.vO9L9Ih8uOYB4/RU49tRs13gtpyvKuP4fat9uDcnS');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(11) NOT NULL,
  `no_kandidat` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jk` varchar(11) NOT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `visi` text,
  `misi` text,
  `img` varchar(255) NOT NULL,
  `jml_suara` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE `pemilih` (
  `id_pemilih` int(11) NOT NULL,
  `token` varchar(10) DEFAULT NULL,
  `lv` varchar(2) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilih`
--

INSERT INTO `pemilih` (`id_pemilih`, `token`, `lv`, `status`) VALUES
(33, 'UJM2G', 'P', 'Belum Vote'),
(34, 'LDP9H', 'P', 'Belum Vote'),
(35, '5KOPZ', 'P', 'Belum Vote'),
(36, 'AUDTS', 'P', 'Belum Vote'),
(37, 'LCEG1', 'P', 'Belum Vote'),
(38, 'Y3VYW', 'P', 'Belum Vote'),
(39, 'LKRPM', 'P', 'Belum Vote'),
(40, 'Q53KF', 'P', 'Belum Vote'),
(41, '3UPOU', 'P', 'Belum Vote'),
(42, '6IRDG', 'P', 'Belum Vote'),
(143, 'L2LIG', 'L', 'Belum Vote'),
(144, 'EECGC', 'L', 'Belum Vote'),
(145, 'ET3S8', 'L', 'Belum Vote'),
(146, '0CNTA', 'L', 'Belum Vote'),
(147, 'P590S', 'L', 'Belum Vote'),
(148, 'UZJ4A', 'L', 'Belum Vote'),
(149, 'MV3TL', 'L', 'Belum Vote'),
(150, 'IV95R', 'L', 'Belum Vote'),
(151, 'C2ZS5', 'L', 'Belum Vote'),
(152, 'RCFH5', 'L', 'Belum Vote');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(11) NOT NULL,
  `id_pemilih` int(11) NOT NULL,
  `id_kandidat` int(11) DEFAULT NULL,
  `voute` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `voting`
--
DELIMITER $$
CREATE TRIGGER `del` AFTER DELETE ON `voting` FOR EACH ROW update kandidat set jml_suara=jml_suara-old.voute
where kandidat.id_kandidat=old.id_kandidat
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins` AFTER INSERT ON `voting` FOR EACH ROW update kandidat set jml_suara=jml_suara+new.voute
where kandidat.id_kandidat=new.id_kandidat
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`),
  ADD UNIQUE KEY `id_pemilih_2` (`id_pemilih`),
  ADD KEY `id_kandidat` (`id_kandidat`),
  ADD KEY `id_pemilih` (`id_pemilih`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id_pemilih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `voting`
--
ALTER TABLE `voting`
  ADD CONSTRAINT `voting_ibfk_1` FOREIGN KEY (`id_kandidat`) REFERENCES `kandidat` (`id_kandidat`),
  ADD CONSTRAINT `voting_ibfk_2` FOREIGN KEY (`id_pemilih`) REFERENCES `pemilih` (`id_pemilih`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
