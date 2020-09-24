-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Agu 2019 pada 14.47
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lebah_madu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nik` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `ttl` varchar(100) DEFAULT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `alamat` text,
  `status` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `id_kth` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `jml_stup` int(11) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nik`, `nama`, `ttl`, `jk`, `alamat`, `status`, `pekerjaan`, `id_kth`, `id_jabatan`, `jml_stup`, `token`) VALUES
(1, '1111111111111889', 'Ade Hikmat FR', 'ciamis, 17 mei 1980', 'laki-laki', 'Dusun sindangasih', 'Lajang', 'Programer', 1, 12, 5, 'zZqn9'),
(3, '1111111111111880', 'Aa lol ', 'ciamis, 17 mei 2001', 'laki-laki', 'rt 12 rw 05 dsn.Nanggela', 'Lajang', 'Programer', 1, 10, 2, '0NHIj');

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
(1, '+622318006177', 'binalestari@gmail.com', 'KTH Bina Lestari adalah Kelompok Tani Hutan Yang memelihara Madu Berkualitas Asli ', 'Bina Lestari');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id` int(11) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `deskripsi` text,
  `tmp` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokumentasi`
--

INSERT INTO `dokumentasi` (`id`, `img`, `deskripsi`, `tmp`) VALUES
(1, '5d47a6e96425d.jpg', 'test', '../img/dokument/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `jumlah` double DEFAULT NULL,
  `periode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `jumlah`, `periode`) VALUES
(1, 0.46, '05-08-2019');

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
(10, 'Anggota'),
(11, 'Logistik'),
(12, 'Seksi Pengembangan IT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(100) DEFAULT NULL,
  `jangka_panen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `jangka_panen`) VALUES
(1, 'Apis Cerena', 4),
(3, 'Apis Trigona', 3),
(4, 'Apis Dorsata', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kth`
--

CREATE TABLE `kth` (
  `id_kth` int(11) NOT NULL,
  `nama_kth` varchar(100) DEFAULT NULL,
  `alamat` text,
  `maps` varchar(255) DEFAULT NULL,
  `anggota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kth`
--

INSERT INTO `kth` (`id_kth`, `nama_kth`, `alamat`, `maps`, `anggota`) VALUES
(1, 'Bina Lestari', 'Dusun sindangasih', '-', 56);

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
  `id_anggota` int(11) DEFAULT NULL,
  `id_stup` int(11) DEFAULT NULL,
  `lebah_masuk` int(11) DEFAULT NULL,
  `panen` varchar(100) DEFAULT NULL,
  `id_hasil` int(11) DEFAULT NULL,
  `panen_ke` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `panen`
--

INSERT INTO `panen` (`id_panen`, `id_anggota`, `id_stup`, `lebah_masuk`, `panen`, `id_hasil`, `panen_ke`, `role_id`) VALUES
(5, 1, 1, 1554588000, '05-08-2019', 1, 2, 0),
(9, 3, 2, 1565042400, '03-12-2019', 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `panen_real`
--

CREATE TABLE `panen_real` (
  `id_p` int(11) NOT NULL,
  `id_stup` int(11) DEFAULT NULL,
  `hasil` double DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `id_pemeliharaan` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `id_stup` int(11) DEFAULT NULL,
  `keadaan` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `penanganan` text,
  `waktu` int(11) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `period` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stup`
--

CREATE TABLE `stup` (
  `id_stup` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `code_stup` varchar(100) DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stup`
--

INSERT INTO `stup` (`id_stup`, `id_anggota`, `code_stup`, `id_jenis`) VALUES
(1, 1, '1-02', 1),
(2, 3, '2-01', 1),
(3, 3, '2-02', 1);

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
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `id_kth` (`id_kth`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `contac`
--
ALTER TABLE `contac`
  ADD PRIMARY KEY (`id_con`);

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

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
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_stup` (`id_stup`),
  ADD KEY `id_hasil` (`id_hasil`);

--
-- Indexes for table `panen_real`
--
ALTER TABLE `panen_real`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_stup` (`id_stup`);

--
-- Indexes for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`id_pemeliharaan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_stup` (`id_stup`);

--
-- Indexes for table `stup`
--
ALTER TABLE `stup`
  ADD PRIMARY KEY (`id_stup`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `contac`
--
ALTER TABLE `contac`
  MODIFY `id_con` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id_panen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `panen_real`
--
ALTER TABLE `panen_real`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `id_pemeliharaan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stup`
--
ALTER TABLE `stup`
  MODIFY `id_stup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  ADD CONSTRAINT `panen_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `panen_ibfk_2` FOREIGN KEY (`id_stup`) REFERENCES `stup` (`id_stup`),
  ADD CONSTRAINT `panen_ibfk_3` FOREIGN KEY (`id_hasil`) REFERENCES `hasil` (`id_hasil`);

--
-- Ketidakleluasaan untuk tabel `panen_real`
--
ALTER TABLE `panen_real`
  ADD CONSTRAINT `panen_real_ibfk_1` FOREIGN KEY (`id_stup`) REFERENCES `stup` (`id_stup`);

--
-- Ketidakleluasaan untuk tabel `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD CONSTRAINT `pemeliharaan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `pemeliharaan_ibfk_2` FOREIGN KEY (`id_stup`) REFERENCES `stup` (`id_stup`);

--
-- Ketidakleluasaan untuk tabel `stup`
--
ALTER TABLE `stup`
  ADD CONSTRAINT `stup_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `stup_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
