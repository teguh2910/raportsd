-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2023 at 03:40 PM
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
-- Database: `db_raport`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_guru`
--

CREATE TABLE `data_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_guru`
--

INSERT INTO `data_guru` (`id_guru`, `nama_guru`, `jabatan`, `password`, `nip`) VALUES
(2, 'sri', 'wali_kelas', 'password', 123),
(3, 'teguh', 'wali_kelas', 'pass', 234);

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nis` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jen_kel` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `nama_siswa`, `alamat`, `kelas`, `password`, `nis`, `jen_kel`) VALUES
(2, 'teguh', 'solo', '4', 'password', '123', 'L'),
(4, 'rizky', 'Karawang', '3', 'pass', '234', 'P'),
(5, 'Doni', 'Bekasi', '5', '123', '999', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `kasus_siswa`
--

CREATE TABLE `kasus_siswa` (
  `id_kasus` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `kasus` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kasus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kasus_siswa`
--

INSERT INTO `kasus_siswa` (`id_kasus`, `id_siswa`, `kasus`, `tgl_kasus`) VALUES
(2, 2, 'Tawuran', '2023-03-05'),
(3, 4, 'Gelut', '2023-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `nama_mata_pelajaran` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_pelajaran`, `nama_mata_pelajaran`, `id_guru`) VALUES
(2, 'Matematika', 2),
(3, 'Bahasa Indonesia', 2),
(4, 'Bahasa Ingris', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_siswa`
--

CREATE TABLE `nilai_siswa` (
  `id_nilai` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `nilai_harian` int(11) NOT NULL,
  `nilai_uts` int(11) NOT NULL,
  `nilai_uas` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nilai_siswa`
--

INSERT INTO `nilai_siswa` (`id_nilai`, `id_siswa`, `id_pelajaran`, `nilai_harian`, `nilai_uts`, `nilai_uas`, `semester`, `tahun`) VALUES
(2, 2, 4, 100, 10, 80, 2, 2022),
(3, 4, 2, 100, 100, 100, 2, 2022),
(4, 2, 2, 100, 100, 100, 3, 2022),
(5, 2, 2, 100, 100, 100, 1, 2022);

-- --------------------------------------------------------

--
-- Table structure for table `presensi_siswa`
--

CREATE TABLE `presensi_siswa` (
  `id_presensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `presensi` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi_siswa`
--

INSERT INTO `presensi_siswa` (`id_presensi`, `id_siswa`, `id_pelajaran`, `presensi`, `tgl`) VALUES
(2, 2, 2, 'Hadir', '2023-03-05'),
(3, 4, 2, 'Hadir', '2023-03-06'),
(4, 2, 2, 'Izin', '2023-03-15'),
(5, 2, 2, 'Sakit', '2023-03-16'),
(6, 2, 3, 'Alpha', '2023-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hak_akses` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hak_akses`) VALUES
(3, 'admin', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_guru`
--
ALTER TABLE `data_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `kasus_siswa`
--
ALTER TABLE `kasus_siswa`
  ADD PRIMARY KEY (`id_kasus`);

--
-- Indexes for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`id_pelajaran`);

--
-- Indexes for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `presensi_siswa`
--
ALTER TABLE `presensi_siswa`
  ADD PRIMARY KEY (`id_presensi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_guru`
--
ALTER TABLE `data_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kasus_siswa`
--
ALTER TABLE `kasus_siswa`
  MODIFY `id_kasus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `presensi_siswa`
--
ALTER TABLE `presensi_siswa`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
