-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2023 at 03:25 AM
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
(1, 'pegawai.1@gmail.com', '$2y$10$Eu/xosyX37.owhFV6h/ad.Eqxf0TmO6L/KqzT/aPz0MZ7LcnL2UVe', 'Pegawai 1', '199912030001', 3, 2, 1, '94a9588862e5e5926c420fe2c474c2da.png', '2023-02-20 02:17:29', '2023-02-21 04:17:19'),
(5, 'ilham@gmail.com', '$2y$10$ClPbZ.S9Ij0vYDgEnc9KI.ErEFjycS5LK/AajTIs8Qycyh/Ti1FKa', 'Ilham', '129091209', 1, 1, 1, 'default.png', '2023-02-20 04:15:23', '2023-02-20 04:33:23');

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
(5, 1, '2023-02-19', NULL, NULL, NULL, NULL, '07:45:00', 'sakit', 'sample-izin.png', 'Menunggu', '2023-02-21 02:04:43', '2023-02-22 02:24:01'),
(6, 5, '2023-02-19', '08:09:52', 'sample-presensi.png', '16:03:52', 'sample-presensi.png', NULL, NULL, NULL, NULL, '2023-02-21 02:04:43', '2023-02-21 13:51:03');

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
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `jamMasuk`, `jamPulang`, `lintangBujur`, `jarak`, `createdAt`, `updatedAt`) VALUES
(1, '08:00:00', '16:30:00', '-6.868502061993143, 109.10734557034732', 50, '2023-02-20 08:52:48', '2023-02-21 01:17:31');

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
(1, 'superadmin', 'superadmin', 'default.png', '$2y$10$aX3KtHwTSYkN0AZ0fn7LcO727KuqwFEu91mL4kEKw7fYsOou1exSu');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
