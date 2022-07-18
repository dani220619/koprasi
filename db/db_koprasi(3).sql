-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2022 at 02:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_koprasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id` int(11) NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_angsuran` varchar(30) NOT NULL,
  `jumlah_angsuran` int(20) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `no_virtual` varchar(30) NOT NULL,
  `status` char(3) NOT NULL DEFAULT '',
  `order_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id`, `id_pinjaman`, `id_user`, `no_angsuran`, `jumlah_angsuran`, `nilai`, `tanggal`, `metode_pembayaran`, `no_virtual`, `status`, `order_id`) VALUES
(32413, 783, 12, 'ANG687', 1, 200000, '2022-07-18 12:01:27', 'Manual', '', '200', ''),
(32414, 783, 12, 'ANG687', 2, 200000, '2022-07-18 12:01:27', 'Manual', '', '200', ''),
(32415, 783, 12, 'ANG687', 3, 200000, '2022-07-18 12:01:27', 'Manual', '', '200', ''),
(32416, 783, 12, 'ANG687', 4, 200000, '2022-07-18 12:01:27', 'Manual', '', '200', ''),
(32417, 783, 12, 'ANG687', 5, 200000, '2022-07-18 12:01:27', 'Manual', '', '200', ''),
(32418, 783, 12, 'ANG687', 6, 200000, '2022-07-18 12:01:27', 'Manual', '', '200', ''),
(32419, 9230, 13, 'ANG558', 1, 400000, '2022-07-18 12:01:34', 'Manual', '', '200', ''),
(32420, 9230, 13, 'ANG558', 2, 400000, '2022-07-18 12:01:34', 'Manual', '', '200', ''),
(32421, 9230, 13, 'ANG558', 3, 400000, '2022-07-18 12:01:34', 'Manual', '', '200', ''),
(32422, 9230, 13, 'ANG558', 4, 400000, '2022-07-18 12:01:34', 'Manual', '', '200', ''),
(32423, 9230, 13, 'ANG558', 5, 400000, '2022-07-18 12:01:34', 'Manual', '', '200', ''),
(32424, 9230, 13, 'ANG558', 6, 400000, '2022-07-18 12:01:34', 'Manual', '', '200', ''),
(32429, 7446, 12, 'ANG551', 1, 480000, '2022-07-18 18:54:36', 'Online', '67517664494|bca', '1', '461216809'),
(32430, 7446, 12, 'ANG551', 2, 480000, '2022-07-18 18:54:36', 'Online', '67517664494|bca', '1', '461216809');

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(50) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `nama_aplikasi` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `copy_right` varchar(50) DEFAULT NULL,
  `versi` varchar(20) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`) VALUES
(1, 'Komed', 'JL. nin aja ya', '0812-9936-9059', 'Koprasi', 'KOPRASI', 'ig1.png', 'Copy Right ©', '1.0.0.0', 2022);

-- --------------------------------------------------------

--
-- Table structure for table `lama`
--

CREATE TABLE `lama` (
  `id` int(11) NOT NULL,
  `lama` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lama`
--

INSERT INTO `lama` (`id`, `lama`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_pinjaman` varchar(30) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `tanggal` datetime NOT NULL,
  `lama` int(11) NOT NULL,
  `bunga` int(11) NOT NULL,
  `status` enum('Y','N','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_user`, `no_pinjaman`, `jumlah`, `tanggal`, `lama`, `bunga`, `status`) VALUES
(783, 12, 'ANG687', '1000000', '2022-07-13 11:09:20', 6, 20, 'Y'),
(2208, 12, 'ANG213', '1000000', '2022-07-13 12:37:08', 10, 20, 'Y'),
(3450, 12, 'ANG360', '1000000', '2022-07-13 12:22:21', 10, 0, 'T'),
(5721, 12, 'ANG791', '2000000', '2022-07-13 12:34:29', 6, 30, 'N'),
(7446, 12, 'ANG551', '4000000', '2022-07-12 23:44:25', 10, 20, 'Y'),
(8599, 12, 'ANG227', '1000000', '2022-07-18 19:31:01', 10, 20, 'Y'),
(9230, 13, 'ANG558', '2000000', '2022-07-13 13:51:07', 6, 20, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `simpanan`
--

CREATE TABLE `simpanan` (
  `id` int(11) NOT NULL,
  `nik` int(20) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `metode_pembayaran` varchar(10) NOT NULL,
  `no_virtual` varchar(30) NOT NULL,
  `status` char(4) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `tanggal_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simpanan`
--

INSERT INTO `simpanan` (`id`, `nik`, `jumlah`, `metode_pembayaran`, `no_virtual`, `status`, `order_id`, `tanggal_bayar`) VALUES
(23677, 2147483647, 300000, 'Online', '67517885561|bca', '100', '1026254428', '2022-07-17 23:29:15'),
(37603, 94659232, 900000, 'Manual', '', '200', '', '2022-07-17 23:29:44'),
(81405, 2147483647, 200000, 'Online', '67517087423|bca', '100', '536813375', '2022-07-17 23:21:30'),
(86014, 94659232, 100000, 'Manual', '', '200', '', '2022-07-18 13:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses_menu`
--

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_akses_menu`
--

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view_level`) VALUES
(1, 1, 1, 'Y'),
(2, 1, 2, 'Y'),
(43, 4, 1, 'Y'),
(44, 4, 2, 'N'),
(62, 5, 1, 'N'),
(63, 5, 2, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses_submenu`
--

CREATE TABLE `tbl_akses_submenu` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view_level` enum('Y','N') DEFAULT 'N',
  `add_level` enum('Y','N') DEFAULT 'N',
  `edit_level` enum('Y','N') DEFAULT 'N',
  `delete_level` enum('Y','N') DEFAULT 'N',
  `print_level` enum('Y','N') DEFAULT 'N',
  `upload_level` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_akses_submenu`
--

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view_level`, `add_level`, `edit_level`, `delete_level`, `print_level`, `upload_level`) VALUES
(2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(7, 1, 8, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(13, 1, 14, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(26, 1, 15, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(30, 1, 17, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(32, 1, 18, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(34, 1, 19, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(36, 1, 20, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(59, 4, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(60, 4, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(61, 4, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(62, 4, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(63, 4, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(64, 4, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(65, 4, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(66, 4, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(67, 4, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(68, 4, 20, 'N', 'N', 'N', 'N', 'N', 'N'),
(72, 5, 1, 'N', 'N', 'N', 'N', 'N', 'N'),
(73, 5, 2, 'N', 'N', 'N', 'N', 'N', 'N'),
(74, 5, 7, 'N', 'N', 'N', 'N', 'N', 'N'),
(75, 5, 8, 'N', 'N', 'N', 'N', 'N', 'N'),
(76, 5, 10, 'N', 'N', 'N', 'N', 'N', 'N'),
(77, 5, 15, 'N', 'N', 'N', 'N', 'N', 'N'),
(78, 5, 17, 'N', 'N', 'N', 'N', 'N', 'N'),
(79, 5, 18, 'N', 'N', 'N', 'N', 'N', 'N'),
(80, 5, 19, 'N', 'N', 'N', 'N', 'N', 'N'),
(81, 5, 20, 'N', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1, 'Y', 'Y'),
(2, 'System', '#', 'fas fa-cogs', 2, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) UNSIGNED NOT NULL,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`) VALUES
(1, 'Menu', 'menu', 'far fa-circle', 2, 'Y'),
(2, 'SubMenu', 'submenu', 'far fa-circle', 2, 'Y'),
(7, 'Aplikasi', 'aplikasi', 'far fa-circle', 2, 'Y'),
(8, 'User', 'user', 'far fa-circle', 2, 'Y'),
(10, 'User Level', 'userlevel', 'far fa-circle', 2, 'Y'),
(15, 'Barang', 'barang', 'far fa-circle', 32, 'Y'),
(17, 'Kategori', 'kategori', 'far fa-circle', 32, 'Y'),
(18, 'Satuan', 'satuan', 'far fa-circle', 32, 'Y'),
(19, 'Pembelian', 'pembelian', 'far fa-circle', 41, 'Y'),
(20, 'Penjualan', 'penjualan', 'far fa-circle', 41, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) UNSIGNED NOT NULL,
  `nik` int(40) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `tlp` varchar(20) NOT NULL,
  `alamat` varchar(400) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nik`, `username`, `full_name`, `tlp`, `alamat`, `jenis_kelamin`, `password`, `id_level`, `image`, `is_active`) VALUES
(10, 0, 'admin', 'dani', '085797887711', '', 'laki-laki', '$2y$05$oDJNmsPd0unSj1xbw2qP6.oeeuDhBhi.PBrwsCD1xkkMm/Iy2D.J6', 1, 'admin.jpg', 'Y'),
(11, 2147, 'hakim', 'hakim dani lukman', '085797887711', 'Banyumas', 'laki-laki', '$2y$05$eRcXS6h8tkRSFcnGSb6T4ucaS027lCbDtDRa6UIyEKL7aIqaVVaNu', 2, 'hakim.jpeg', 'Y'),
(12, 2147483647, 'komed', 'edwin yoga', '089636337580', 'Banyumas cilacap kebumen', 'laki-laki', '$2y$05$.USCxBQ53ZsDd5N2DXd1ZOrXNMF9XQ4wMeDKTqho4QJB3KN5LqEUi', 3, 'komed.png', 'Y'),
(13, 94659232, 'yuyu', 'ioio', '089636337580', 'JL. nin aja ya', 'laki-laki', '$2y$05$6iia7Tqs8.hGO.Desnb/B.Z6NlHwt8AuHUBkHzLcm4VUlOKDGAT4u', 3, 'yuyu.jpeg', 'Y'),
(16, 0, 'ronaldo', 'hakim', '085797887711', '', 'laki-laki', '$2y$05$/TbAsTzRRq.yEqIC3yRdcennyYsSsy3FV5Ia3/xNkHxJh1ER/5Tl6', 1, 'ronaldo.png', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) UNSIGNED NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'pegawai'),
(3, 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lama`
--
ALTER TABLE `lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32431;

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lama`
--
ALTER TABLE `lama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9827;

--
-- AUTO_INCREMENT for table `simpanan`
--
ALTER TABLE `simpanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95862;

--
-- AUTO_INCREMENT for table `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `id_submenu` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
