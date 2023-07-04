-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 10:10 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `pendidikan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `nip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`pendidikan`, `nama`, `alamat`, `agama`, `no_telp`, `username`, `pass`, `nip`) VALUES
('S1 Teknologi Pendidi', 'Yogi', 'Singaraja', 'Hindu', '08498597394', 'yogik', '12345678', '21398429842');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `nama` varchar(20) NOT NULL,
  `id` varchar(6) NOT NULL,
  `username_guru` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`nama`, `id`, `username_guru`) VALUES
('MTK XI 13', '1', 'yogik'),
('BING X 13', '2', 'yogik');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_mapel` varchar(6) NOT NULL,
  `judul_materi` varchar(150) NOT NULL,
  `teks` varchar(5000) NOT NULL,
  `id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`created_at`, `id_mapel`, `judul_materi`, `teks`, `id`) VALUES
('2023-07-04 07:09:55', '1', 'Cara menentukan domain dan range fungsi', 'test', '2c11b2');

-- --------------------------------------------------------

--
-- Table structure for table `pengumpulan_tugas`
--

CREATE TABLE `pengumpulan_tugas` (
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` varchar(250) NOT NULL,
  `id_tugas` varchar(6) NOT NULL,
  `username_siswa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `username`, `pass`, `alamat`, `agama`, `no_telp`) VALUES
('3847438', 'RafliZ', 'rafliz', '12345678', 'Singaraja', 'Islam', '08698597394');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_enrolled_mapel`
--

CREATE TABLE `siswa_enrolled_mapel` (
  `id_mapel` varchar(6) NOT NULL,
  `username_siswa` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa_enrolled_mapel`
--

INSERT INTO `siswa_enrolled_mapel` (`id_mapel`, `username_siswa`) VALUES
('1', 'rafliz');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` varchar(6) NOT NULL,
  `id_mapel` varchar(6) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `judul_tugas` varchar(150) NOT NULL,
  `deskripsi_tugas` varchar(5000) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `id_mapel`, `created_at`, `judul_tugas`, `deskripsi_tugas`, `deadline`) VALUES
('468046', '1', '2023-07-04 07:22:33', 'Tugas 1', 'test', '2023-07-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mata_pelajaran_diajar_guru` (`username_guru`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_materi` (`id_mapel`);

--
-- Indexes for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD UNIQUE KEY `filename` (`filename`),
  ADD KEY `fk_siswa_pengumpulan` (`username_siswa`),
  ADD KEY `fk_tugas_pengumpulan` (`id_tugas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `siswa_enrolled_mapel`
--
ALTER TABLE `siswa_enrolled_mapel`
  ADD KEY `fk_mapel_enrolled` (`id_mapel`),
  ADD KEY `fk_siswa_enrolled` (`username_siswa`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mapel_tugas` (`id_mapel`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD CONSTRAINT `fk_mata_pelajaran_diajar_guru` FOREIGN KEY (`username_guru`) REFERENCES `guru` (`username`);

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `fk_mapel_materi` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`);

--
-- Constraints for table `pengumpulan_tugas`
--
ALTER TABLE `pengumpulan_tugas`
  ADD CONSTRAINT `fk_siswa_pengumpulan` FOREIGN KEY (`username_siswa`) REFERENCES `siswa` (`username`),
  ADD CONSTRAINT `fk_tugas_pengumpulan` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id`);

--
-- Constraints for table `siswa_enrolled_mapel`
--
ALTER TABLE `siswa_enrolled_mapel`
  ADD CONSTRAINT `fk_mapel_enrolled` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`),
  ADD CONSTRAINT `fk_siswa_enrolled` FOREIGN KEY (`username_siswa`) REFERENCES `siswa` (`username`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `fk_mapel_tugas` FOREIGN KEY (`id_mapel`) REFERENCES `mata_pelajaran` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
