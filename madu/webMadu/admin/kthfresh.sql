-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08 Jul 2019 pada 12.07
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kth`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `nik` varchar(16) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `ttl` varchar(100) DEFAULT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `alamat` text,
  `status` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `id_kth` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `jml_stup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan`
--

CREATE TABLE `bahan` (
  `id_bahan` int(11) NOT NULL,
  `nama_bahan` varchar(100) DEFAULT NULL,
  `jangka_panen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bahan`
--

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `jangka_panen`) VALUES
(1, 'Kering', 4),
(2, 'Basah', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `contac`
--

CREATE TABLE `contac` (
  `id_con` int(11) NOT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `about` varchar(255) DEFAULT NULL,
  `fb` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `contac`
--

INSERT INTO `contac` (`id_con`, `nohp`, `email`, `about`, `fb`) VALUES
(1, '+62 2135 5555', 'binalestari@gmail.com', 'KTH Bina Lestari adalah Kelompok Tani Hutan Yang memelihara Madu Berkualitas Asli ', 'binalestari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `tanggal_hasil` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Pelindung'),
(2, 'Ketua'),
(3, 'Sekretaris'),
(4, 'Bendahara'),
(5, 'Seksi Kerohanian'),
(6, 'Seksi Perencanaan'),
(7, 'Seksi Sarana'),
(8, 'Seksi Pemasaran'),
(9, 'Seksi Humas'),
(10, 'Anggota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kth`
--

CREATE TABLE `kth` (
  `id_kth` int(11) NOT NULL,
  `nama_kth` varchar(100) DEFAULT NULL,
  `alamat` text NOT NULL,
  `maps` varchar(255) NOT NULL,
  `anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kth`
--

INSERT INTO `kth` (`id_kth`, `nama_kth`, `alamat`, `maps`, `anggota`) VALUES
(1, 'Bina Lestari', 'jalan kertasari', 'skulallala', 101);

-- --------------------------------------------------------

--
-- Struktur dari tabel `logo`
--

CREATE TABLE `logo` (
  `id_logo` int(11) NOT NULL,
  `nama_logo` varchar(100) DEFAULT NULL,
  `untuk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `logo`
--

INSERT INTO `logo` (`id_logo`, `nama_logo`, `untuk`) VALUES
(1, '5d12dfeead4cd.png', 'cdk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `panen`
--

CREATE TABLE `panen` (
  `id_panen` int(11) NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `id_stup` int(11) DEFAULT NULL,
  `lebah_masuk` varchar(100) NOT NULL,
  `panen` varchar(100) DEFAULT NULL,
  `id_hasil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stup`
--

CREATE TABLE `stup` (
  `id_stup` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `code_stup` varchar(100) DEFAULT NULL,
  `id_bahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `alamat` text,
  `level` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `jk`, `alamat`, `level`) VALUES
('admin', '28b11d177102ffe353ba050c806c67e2', 'Ade hikmat', 'Laki-Laki', 'rt 12 rw 05 sarongge dsn nanggela des Sandingtaman', 1),
('oprator', '28b11d177102ffe353ba050c806c67e2', 'Ade hikmat', 'Laki-Laki', 'rt 12 rw 05 sarongge dsn nanggela des Sandingtaman', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `id_kth` (`id_kth`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `contac`
--
ALTER TABLE `contac`
  ADD PRIMARY KEY (`id_con`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kth`
--
ALTER TABLE `kth`
  ADD PRIMARY KEY (`id_kth`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id_logo`);

--
-- Indexes for table `panen`
--
ALTER TABLE `panen`
  ADD PRIMARY KEY (`id_panen`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_stup` (`id_stup`),
  ADD KEY `id_hasil` (`id_hasil`);

--
-- Indexes for table `stup`
--
ALTER TABLE `stup`
  ADD PRIMARY KEY (`id_stup`),
  ADD KEY `nik` (`nik`),
  ADD KEY `id_bahan` (`id_bahan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contac`
--
ALTER TABLE `contac`
  MODIFY `id_con` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kth`
--
ALTER TABLE `kth`
  MODIFY `id_kth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id_logo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `panen`
--
ALTER TABLE `panen`
  MODIFY `id_panen` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stup`
--
ALTER TABLE `stup`
  MODIFY `id_stup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`id_kth`) REFERENCES `kth` (`id_kth`),
  ADD CONSTRAINT `anggota_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Ketidakleluasaan untuk tabel `panen`
--
ALTER TABLE `panen`
  ADD CONSTRAINT `panen_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `anggota` (`nik`),
  ADD CONSTRAINT `panen_ibfk_2` FOREIGN KEY (`id_stup`) REFERENCES `stup` (`id_stup`),
  ADD CONSTRAINT `panen_ibfk_3` FOREIGN KEY (`id_hasil`) REFERENCES `hasil` (`id_hasil`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stup`
--
ALTER TABLE `stup`
  ADD CONSTRAINT `stup_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `anggota` (`nik`),
  ADD CONSTRAINT `stup_ibfk_2` FOREIGN KEY (`id_bahan`) REFERENCES `bahan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
