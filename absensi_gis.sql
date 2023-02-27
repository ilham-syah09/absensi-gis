-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2023 at 03:30 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `namaJabatan` varchar(30) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `namaJabatan`, `createdAt`, `updatedAt`) VALUES
(1, 'Operator Produksi', '2023-02-20 02:19:38', '2023-02-20 04:23:42'),
(3, 'Operator QC', '2023-02-20 02:25:18', '2023-02-20 02:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `idJabatan` int(11) NOT NULL,
  `jk` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `image` text NOT NULL DEFAULT 'default.png',
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `email`, `password`, `nama`, `nip`, `idJabatan`, `jk`, `status`, `image`, `createAt`, `updateAt`) VALUES
(1, 'pegawai.1@gmail.com', '$2y$10$RCnEISXcGP68RQIyYtcot.5itQA.MDUpFCRhZXBJUHAAYp.oiH3wi', 'Pegawai 1', '199912030001', 3, 2, 1, '94a9588862e5e5926c420fe2c474c2da.png', '2023-02-20 02:17:29', '2023-02-22 02:36:27'),
(5, 'ilham@gmail.com', '$2y$10$RCnEISXcGP68RQIyYtcot.5itQA.MDUpFCRhZXBJUHAAYp.oiH3wi', 'Ilham', '129091209', 1, 1, 1, 'default.png', '2023-02-20 04:15:23', '2023-02-22 02:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(11) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `presensiMasuk` time DEFAULT NULL,
  `pictureMasuk` text DEFAULT NULL,
  `presensiPulang` time DEFAULT NULL,
  `picturePulang` text DEFAULT NULL,
  `izin` time DEFAULT NULL,
  `alasanIzin` text DEFAULT NULL,
  `document` text DEFAULT NULL,
  `statusIzin` varchar(25) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id`, `idPegawai`, `tanggal`, `presensiMasuk`, `pictureMasuk`, `presensiPulang`, `picturePulang`, `izin`, `alasanIzin`, `document`, `statusIzin`, `createdAt`, `updatedAt`) VALUES
(1, 1, '2023-02-20', '07:55:52', 'sample-presensi.png', '16:03:52', 'sample-presensi.png', NULL, NULL, NULL, NULL, '2023-02-21 02:04:43', '2023-02-21 14:26:25'),
(2, 5, '2023-02-20', '07:59:52', 'sample-presensi.png', '17:13:52', 'sample-presensi.png', NULL, NULL, NULL, NULL, '2023-02-21 02:04:43', '2023-02-21 13:51:03'),
(3, 1, '2023-02-21', '08:02:52', 'sample-presensi.png', '17:03:52', 'sample-presensi.png', NULL, NULL, NULL, NULL, '2023-02-21 02:04:43', '2023-02-21 13:51:04'),
(4, 5, '2023-02-21', '07:56:52', 'sample-presensi.png', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-21 02:04:43', '2023-02-21 13:50:58'),
(5, 5, '2023-02-19', NULL, NULL, NULL, NULL, '07:45:00', 'sakit', 'sample-izin.png', 'Disetujui', '2023-02-21 02:04:43', '2023-02-26 13:39:16'),
(6, 1, '2023-02-19', '08:09:52', 'sample-presensi.png', '16:03:52', 'sample-presensi.png', NULL, NULL, NULL, NULL, '2023-02-21 02:04:43', '2023-02-24 14:38:59'),
(9, 5, '2023-02-24', '21:58:39', '4916b998ec40dfc46dad1f617b494b50.jpg', '21:59:06', '30c8789c572852291c7d844529ac0a88.jpg', NULL, NULL, NULL, NULL, '2023-02-24 14:58:39', '2023-02-24 14:59:06'),
(10, 5, '2023-02-25', '16:01:52', 'e392ff71a58e81567422e80ba7944387.jpg', '16:02:26', 'e3c888931a67f6193b61e4bedc5085b0.jpg', NULL, NULL, NULL, NULL, '2023-02-25 09:01:52', '2023-02-25 09:02:26'),
(11, 5, '2023-02-18', NULL, NULL, NULL, NULL, '20:24:05', 'Sakit gaes', '468ce3cfe4c8f8716112c33cab3c209f.png', 'Disetujui', '2023-02-26 13:24:05', '2023-02-26 13:38:47'),
(12, 5, '2023-02-27', '09:30:23', '60e0b67c6ce97c577980c1759cfebb22.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-27 02:30:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `jamMasuk` time NOT NULL,
  `jamPulang` time NOT NULL,
  `lintangBujur` varchar(100) NOT NULL,
  `jarak` int(3) NOT NULL,
  `hariKerja` varchar(20) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `jamMasuk`, `jamPulang`, `lintangBujur`, `jarak`, `hariKerja`, `createdAt`, `updatedAt`) VALUES
(1, '08:00:00', '16:30:00', '-6.868544669341357, 109.10728119733434', 50, '1,2,3,4,5', '2023-02-20 08:52:48', '2023-02-27 02:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `image` text NOT NULL DEFAULT 'default.png',
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `name`, `username`, `image`, `password`) VALUES
(1, 'Admin Kepegawaian', 'superadmin', 'default.png', '$2y$10$aX3KtHwTSYkN0AZ0fn7LcO727KuqwFEu91mL4kEKw7fYsOou1exSu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
