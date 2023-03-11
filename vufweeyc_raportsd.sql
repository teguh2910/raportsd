-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2023 at 04:28 PM
-- Server version: 10.3.38-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vufweeyc_raportsd`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_guru`
--

CREATE TABLE `data_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(40) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nip` int(11) NOT NULL,
  `kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_guru`
--

INSERT INTO `data_guru` (`id_guru`, `nama_guru`, `jabatan`, `password`, `nip`, `kelas`) VALUES
(2, 'sri', 'wali_kelas4', 'password', 123, 4),
(4, 'parno', 'wali_kelas1', 'parno', 123, 1),
(9, 'Gunawan', 'wali_kelas5', 'gunawan', 990, 5),
(10, 'sarah', 'wali_kelas2', 'sarah', 1212, 2),
(11, 'Parjo', 'wali_kelas', '123', 123, 3),
(12, 'Obel', 'wali_kelas3', 'obel', 333, 3);

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(40) NOT NULL,
  `alamat` text NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `nis` varchar(30) DEFAULT NULL,
  `jen_kel` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `nama_siswa`, `alamat`, `kelas`, `password`, `nis`, `jen_kel`) VALUES
(2, 'teguh', 'solo', '4', 'password', '123', 'L'),
(4, 'rizky', 'Karawang', '2', 'pass', '234', 'P'),
(5, 'Doni', 'Bekasi', '5', '123', '999', 'P'),
(6, 'Abdul', 'Kemlaka', '1', 'abdul', '1000', 'L'),
(7, 'kiki', 'dawuan', '3', 'kiki', '990', 'L'),
(8, 'marsa', 'Dawuan', '6', 'marsa', '2000', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `kasus_siswa`
--

CREATE TABLE `kasus_siswa` (
  `id_kasus` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `kasus` text NOT NULL,
  `tgl_kasus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kasus_siswa`
--

INSERT INTO `kasus_siswa` (`id_kasus`, `id_siswa`, `kasus`, `tgl_kasus`) VALUES
(2, 2, 'Tawuran', '2023-03-05'),
(3, 4, 'Gelut', '2023-03-07'),
(4, 6, 'kaca pecah', '2023-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `mata_pelajaran`
--

CREATE TABLE `mata_pelajaran` (
  `id_pelajaran` int(11) NOT NULL,
  `nama_mata_pelajaran` varchar(30) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_pelajaran`
--

INSERT INTO `mata_pelajaran` (`id_pelajaran`, `nama_mata_pelajaran`, `id_guru`, `kelas`) VALUES
(3, 'Pendidikan Agama Islam', 9, 5),
(4, 'Bahasa Ingris', 2, 4),
(9, 'Pendidikan Agama Islam', 2, 5),
(10, 'matematika', 9, 5),
(11, 'Pendidikan Kewarganegaraan', 2, 4),
(12, 'Bahasa Indonesia', 9, 5),
(13, 'Bahasa Ingris', 4, 3),
(14, 'Pendidikan Agama Islam', 4, 1),
(15, 'matematika', 4, 1),
(16, 'Pendidikan Kewarganegaraan', 4, 1),
(18, 'Seni Budaya', 9, 5);

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
(4, 2, 4, 100, 10, 80, 1, 2022),
(7, 6, 5, 75, 75, 75, 1, 2023),
(8, 7, 6, 80, 80, 80, 2, 2023),
(9, 2, 2, 80, 86, 90, 1, 2022),
(10, 2, 3, 90, 85, 85, 1, 2022),
(11, 2, 7, 85, 90, 90, 1, 2022),
(12, 2, 11, 86, 87, 88, 1, 2022),
(13, 2, 11, 86, 87, 88, 1, 2022),
(14, 5, 3, 80, 80, 80, 1, 2022),
(15, 6, 9, 80, 80, 80, 1, 2022);

-- --------------------------------------------------------

--
-- Stand-in structure for view `nilai_siswa_ranked`
-- (See below for the actual view)
--
CREATE TABLE `nilai_siswa_ranked` (
`id_siswa` int(11)
,`nilai_akhir_avg` decimal(16,4)
,`rank` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `presensi_siswa`
--

CREATE TABLE `presensi_siswa` (
  `id_presensi` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `presensi` varchar(10) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi_siswa`
--

INSERT INTO `presensi_siswa` (`id_presensi`, `id_siswa`, `id_pelajaran`, `presensi`, `tgl`) VALUES
(6, 2, 3, 'Hadir', '2022-05-09'),
(7, 5, 14, 'Hadir', '2023-03-08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `hak_akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hak_akses`) VALUES
(3, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Structure for view `nilai_siswa_ranked`
--
DROP TABLE IF EXISTS `nilai_siswa_ranked`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `nilai_siswa_ranked`  AS SELECT `nilai_siswa`.`id_siswa` AS `id_siswa`, avg(`nilai_siswa`.`nilai_harian` + `nilai_siswa`.`nilai_uts` + `nilai_siswa`.`nilai_uas`) AS `nilai_akhir_avg`, dense_rank() over ( order by avg(`nilai_siswa`.`nilai_harian` + `nilai_siswa`.`nilai_uts` + `nilai_siswa`.`nilai_uas`) desc) AS `rank` FROM `nilai_siswa` GROUP BY `nilai_siswa`.`id_siswa`;

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
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kasus_siswa`
--
ALTER TABLE `kasus_siswa`
  MODIFY `id_kasus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mata_pelajaran`
--
ALTER TABLE `mata_pelajaran`
  MODIFY `id_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `nilai_siswa`
--
ALTER TABLE `nilai_siswa`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `presensi_siswa`
--
ALTER TABLE `presensi_siswa`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
