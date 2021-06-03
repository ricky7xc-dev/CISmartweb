-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 03:10 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukutamu`
--

CREATE TABLE `bukutamu` (
  `id_bt` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `kritik_saran` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bukutamu`
--

INSERT INTO `bukutamu` (`id_bt`, `tanggal`, `email`, `nama`, `kritik_saran`) VALUES
(24, '2021-05-11', 'non login', 'Faldy Faza', 'toko cabe keren sekali'),
(25, '2021-05-11', 'FaldyFaza@gmail.com', 'Faldy', 'tokonya keren');

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `kode` int(11) NOT NULL,
  `nama_gambar` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_pembelian`, `tanggal`, `email`, `nama`, `alamat`, `nama_cabe`, `gambar`, `harga`, `jumlah`, `total`, `status`) VALUES
(104, '2021-05-22', 'FaldyFaza@gmail.com', 'Faldy Faza', 'bekasi', 'cabe3', 'img3.jpeg', 14000, 3, 42000, 'Menunggu Konfirmasi');

--
-- Triggers `keranjang`
--
DELIMITER $$
CREATE TRIGGER `batalbeliproduk` AFTER DELETE ON `keranjang` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + old.jumlah WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `produkbeli` AFTER INSERT ON `keranjang` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - new.jumlah WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `konfirm`
--

CREATE TABLE `konfirm` (
  `id_konfirmasi` int(11) NOT NULL,
  `kode_konfirm` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfirm`
--

INSERT INTO `konfirm` (`id_konfirmasi`, `kode_konfirm`, `tanggal`, `email`, `nama`, `alamat`, `nama_cabe`, `gambar`, `harga`, `jumlah`, `total`, `status`) VALUES
(13, 93, '2021-04-04', 'tester@gmail.com', 'tester', 'tes', 'cabe3', 'img3.jpeg', 14000, 1, 14000, 'Pesanan Diproses'),
(14, 96, '2021-04-04', 'tonystark@gmail.com', 'Tony stark', 'dada', 'cabe waw', 'img9.jpeg', 16000, 2, 32000, 'Pesanan Diproses');

--
-- Triggers `konfirm`
--
DELIMITER $$
CREATE TRIGGER `afterkonfirm` AFTER INSERT ON `konfirm` FOR EACH ROW DELETE FROM keranjang WHERE
keranjang.id_pembelian = new.kode_konfirm
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `batalbeli` AFTER DELETE ON `konfirm` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + old.jumlah WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforekonfirm` AFTER INSERT ON `konfirm` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - new.jumlah WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk_keluar`
--

CREATE TABLE `produk_keluar` (
  `id_keluar` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kategori_cabe` varchar(50) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_keluar`
--

INSERT INTO `produk_keluar` (`id_keluar`, `tanggal`, `kategori_cabe`, `nama_cabe`, `jumlah_keluar`, `keterangan`) VALUES
(2, '2021-03-29', 'cabe pedes', 'cabe cabena', 2, 'busuk 2 buah'),
(3, '2021-03-29', 'cabe pedes', 'cabe cabena', 3, 'busuk 5 biji');

--
-- Triggers `produk_keluar`
--
DELIMITER $$
CREATE TRIGGER `batalkeluar` AFTER DELETE ON `produk_keluar` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + old.jumlah_keluar WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `produkkeluar` AFTER INSERT ON `produk_keluar` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - new.jumlah_keluar WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatekeluar` AFTER UPDATE ON `produk_keluar` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + old.jumlah_keluar WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatekeluar2` BEFORE UPDATE ON `produk_keluar` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - new.jumlah_keluar WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk_kita`
--

CREATE TABLE `produk_kita` (
  `kode_cabe` int(11) NOT NULL,
  `kategori_cabe` varchar(50) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `img` varchar(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_kita`
--

INSERT INTO `produk_kita` (`kode_cabe`, `kategori_cabe`, `nama_cabe`, `img`, `harga`, `stok`) VALUES
(12, 'cabe lain', 'cabe apkek', 'img11.jpeg', 25500, 10),
(15, 'cabe ijo', 'cabe cabean', 'img14.jpg', 23000, 50),
(19, 'cabe merah', 'cabe cabean2', 'img19.jpeg', 30000, 6),
(1, 'cabe merah', 'cabe cabean3', 'img1.jpeg', 15000, 3),
(17, 'cabe pedes', 'cabe cabena', 'img16.jpg', 25000, 38),
(20, 'cabe ijo', 'cabe ijo ijoan', 'img25.jpg', 20000, 11),
(11, 'cabe lain', 'cabe rusu', 'img10.jpeg', 17000, 30),
(10, 'cabe lain', 'cabe waw', 'img9.jpeg', 16000, 10),
(14, 'cabe ijo', 'cabe wiu', 'img13.jpeg', 9000, 40),
(13, 'cabe ijo', 'cabe wowo', 'img12.jpeg', 10000, 25),
(2, 'cabe merah', 'cabe2', 'img2.jpeg', 15000, 4),
(3, 'cabe merah', 'cabe3', 'img3.jpeg', 14000, 5),
(4, 'cabe lain', 'cabe4', 'img5.jpeg', 10000, 5),
(5, 'cabe ijo', 'cabe5', 'img6.jpeg', 12000, 3),
(6, 'cabe merah', 'cabe6', 'img7.jpeg', 15000, 10),
(7, 'cabe pedes', 'cabe7', 'img8.jpeg', 13000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `produk_masuk`
--

CREATE TABLE `produk_masuk` (
  `id_masuk` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kategori_cabe` varchar(50) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_masuk`
--

INSERT INTO `produk_masuk` (`id_masuk`, `tanggal`, `kategori_cabe`, `nama_cabe`, `jumlah_masuk`, `keterangan`) VALUES
(2, '2021-03-29', 'cabe pedes', 'cabe cabena', 12, 'panen mingguan'),
(3, '2021-03-29', 'cabe pedes', 'cabe cabena', 5, 'panen dikit bat dah'),
(4, '2021-03-29', 'cabe pedes', 'cabe cabena', 5, 'dapet dijalanan');

--
-- Triggers `produk_masuk`
--
DELIMITER $$
CREATE TRIGGER `batalmasuk` AFTER DELETE ON `produk_masuk` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - old.jumlah_masuk WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `produkmasuk` AFTER INSERT ON `produk_masuk` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + new.jumlah_masuk WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatemasuk` AFTER UPDATE ON `produk_masuk` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - old.jumlah_masuk WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updatemasuk2` BEFORE UPDATE ON `produk_masuk` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + new.jumlah_masuk WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `proses`
--

CREATE TABLE `proses` (
  `id_proses` int(11) NOT NULL,
  `kode_proses` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proses`
--

INSERT INTO `proses` (`id_proses`, `kode_proses`, `tanggal`, `email`, `nama`, `alamat`, `nama_cabe`, `gambar`, `harga`, `jumlah`, `total`, `status`) VALUES
(2, 9, '2021-04-04', 'Admin.web2@gmail.com', 'Shalahuddin', 'poris', 'cabe rusu', 'img10.jpeg', 17000, 4, 68000, 'Barang Sedang Dalam Perjalanan'),
(10, 8, '2021-04-04', 'thor@gmail.com', 'Thor', 'new york', 'cabe wiu', 'img13.jpeg', 9000, 5, 45000, 'Barang Sedang Dalam Perjalanan'),
(11, 20, '2021-04-04', 'tonystark@gmail.com', 'Tony stark', 'tesada', 'cabe4', 'img5.jpeg', 10000, 1, 10000, 'Barang Sedang Dalam Perjalanan');

--
-- Triggers `proses`
--
DELIMITER $$
CREATE TRIGGER `afterproses` AFTER INSERT ON `proses` FOR EACH ROW DELETE FROM konfirm WHERE
konfirm.id_konfirmasi = new.kode_proses
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `batalproses` AFTER DELETE ON `proses` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok + old.jumlah WHERE produk_kita.nama_cabe = old.nama_cabe
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforeproses` AFTER INSERT ON `proses` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - new.jumlah WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_selesai`
--

CREATE TABLE `riwayat_selesai` (
  `id_selesai` int(11) NOT NULL,
  `kode_selesai` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `nama_cabe` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `riwayat_selesai`
--

INSERT INTO `riwayat_selesai` (`id_selesai`, `kode_selesai`, `tanggal`, `email`, `nama`, `alamat`, `nama_cabe`, `gambar`, `harga`, `jumlah`, `total`, `status`) VALUES
(3, 4, '2021-04-04', 'captainamerica@gmail.com', 'Steve Roger Cap Avengers', 'hydra', 'cabe wowo', 'img12.jpeg', 10000, 1, 10000, 'Pesanan Selesai'),
(4, 5, '2021-04-04', 'tonystark@gmail.com', 'Tony stark', 'new york', 'cabe wiu', 'img13.jpeg', 9000, 5, 45000, 'Pesanan Selesai'),
(5, 6, '2021-04-06', 'tonystark@gmail.com', 'Tony stark', 'Bekasi', 'cabe cabean2', 'img19.jpeg', 30000, 3, 90000, 'Pesanan Selesai'),
(7, 8, '2021-05-11', 'rivoyajnatantra@gmail.com', 'Rivo', '', 'cabe cabean2', 'img19.jpeg', 30000, 1, 30000, 'Pesanan Selesai'),
(8, 9, '2021-05-12', 'FaldyFaza@gmail.com', 'Faldy Faza', 'Bekasi', 'cabe cabean2', 'img19.jpeg', 30000, 1, 30000, 'Pesanan Selesai');

--
-- Triggers `riwayat_selesai`
--
DELIMITER $$
CREATE TRIGGER `afterselesai` AFTER INSERT ON `riwayat_selesai` FOR EACH ROW DELETE FROM proses WHERE
proses.id_proses = new.kode_selesai
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforeselesai` AFTER INSERT ON `riwayat_selesai` FOR EACH ROW UPDATE produk_kita SET produk_kita.stok = produk_kita.stok - new.jumlah WHERE produk_kita.nama_cabe = new.nama_cabe
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Ical', 'taylor.lautnerpattinson@gmail.com', 'ical.jpg', '$2y$10$EOojqHS1Zi.zCCiUMxOZW.VD.bcWmZZuAk254OBzm8AwVbhFvaZua', 1, 1, 1586079430),
(2, 'Tony stark', 'tonystark@gmail.com', 'tony.jpg', '$2y$10$36qH4hv4yHDiSAhMSrfriuZJjgYH06NxafEKNf0cA8Pk9y.B8KLQ.', 2, 1, 1614837467),
(3, 'Thor', 'thor@gmail.com', 'thor.jpg', '$2y$10$Qc4yQUYiUcRva38OKvAxTObkVfg7cYtZpVXALhxgkXW3WSG2/aJNG', 2, 1, 1614838035),
(4, 'Steve Roger', 'captainamerica@gmail.com', 'cap.jpg', '$2y$10$dhVUv9HhdhLdVzLhdkyFH.yvbaOdxMmPndsIAIsYI5P6rjeTmZiCC', 2, 1, 1614838082),
(6, 'Shalahuddin', 'Admin.web2@gmail.com', 'ical.jpg', '$2y$10$2XS7KEp7huasaQC0rXNZWejSWX2g8Pf6uO0cLaZl6lksFnlNqaZ8W', 2, 1, 1617073854),
(8, 'tester', 'tester@gmail.com', 'default.jpg', '$2y$10$gMGsMf.Jg4/1.BFF1N9.FeHVGozx.AAEJU4/rEM8nqEkhHjJHex9y', 2, 1, 1617109119),
(9, 'Faldy Faza', 'FaldyFaza@gmail.com', 'team3.jpg', '$2y$10$9u4/y.1ikB1DeJLd7R9mCejiApCV8MBPzhP3r1Mg3WpcUIlByBqvq', 2, 1, 1617695931),
(11, 'Rivo', 'rivoyajnatantra@gmail.com', 'team2.png', '$2y$10$hDhqaJrMxItwVMTeBf9aSOcS9YkQQv77uf3gQsEH7.Hj2SsJhQu9W', 2, 1, 1620718888);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 2, 3),
(6, 1, 4),
(7, 1, 5),
(8, 1, 6),
(10, 2, 7),
(11, 1, 9),
(12, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu2`
--

CREATE TABLE `user_access_menu2` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu2`
--

INSERT INTO `user_access_menu2` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(4, 2, 1),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu3`
--

CREATE TABLE `user_access_menu3` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu3`
--

INSERT INTO `user_access_menu3` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `url`, `icon`, `is_active`) VALUES
(1, 'Control', 'control', 'fa fa-cog', 1),
(2, 'Home', 'user', 'fa fa-home', 1),
(3, 'Our Product', 'shop', 'fa fa-shopping-cart', 1),
(4, 'Control1', 'controlmasuk', 'fa fa-pencil-square', 1),
(5, 'Control2', 'controlkeluar', 'fa fa-share-square', 1),
(6, 'Kelola', 'kelola', 'fa fa-cogs', 1),
(7, 'Buku Tamu', 'bukutamu', 'fa fa-book', 1),
(9, 'Shop', 'shopscrap', 'fa fa-shopping-cart', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu2`
--

CREATE TABLE `user_menu2` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu2`
--

INSERT INTO `user_menu2` (`id`, `menu`, `url`, `icon`, `is_active`) VALUES
(1, 'My Profile', 'profile', 'ti-user', 1),
(2, 'Keranjang', 'keranjang', 'ti-shopping-cart', 1),
(3, 'Stat Control', 'statcontrol', 'ti-settings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu3`
--

CREATE TABLE `user_menu3` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu3`
--

INSERT INTO `user_menu3` (`id`, `menu`, `url`, `icon`, `is_active`) VALUES
(1, 'Menu Control', 'menucontrol', 'ti-menu-alt', 1),
(2, 'Cari', 'shop/cari', 'ti-direction', 1),
(3, 'Data Buku Tamu', 'databuku', 'ti-book', 1),
(4, 'Menu Access Control', 'menuaccess', 'ti-credit-card', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukutamu`
--
ALTER TABLE `bukutamu`
  ADD PRIMARY KEY (`id_bt`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `nama_cabe` (`nama_cabe`);

--
-- Indexes for table `konfirm`
--
ALTER TABLE `konfirm`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `nama_cabe` (`nama_cabe`);

--
-- Indexes for table `produk_kita`
--
ALTER TABLE `produk_kita`
  ADD PRIMARY KEY (`nama_cabe`),
  ADD UNIQUE KEY `kode_cabe` (`kode_cabe`);

--
-- Indexes for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `nama_cabe` (`nama_cabe`);

--
-- Indexes for table `proses`
--
ALTER TABLE `proses`
  ADD PRIMARY KEY (`id_proses`);

--
-- Indexes for table `riwayat_selesai`
--
ALTER TABLE `riwayat_selesai`
  ADD PRIMARY KEY (`id_selesai`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu2`
--
ALTER TABLE `user_access_menu2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu3`
--
ALTER TABLE `user_access_menu3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu2`
--
ALTER TABLE `user_menu2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu3`
--
ALTER TABLE `user_menu3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukutamu`
--
ALTER TABLE `bukutamu`
  MODIFY `id_bt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `konfirm`
--
ALTER TABLE `konfirm`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk_kita`
--
ALTER TABLE `produk_kita`
  MODIFY `kode_cabe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `proses`
--
ALTER TABLE `proses`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `riwayat_selesai`
--
ALTER TABLE `riwayat_selesai`
  MODIFY `id_selesai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_access_menu2`
--
ALTER TABLE `user_access_menu2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_access_menu3`
--
ALTER TABLE `user_access_menu3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `user_menu2`
--
ALTER TABLE `user_menu2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_menu3`
--
ALTER TABLE `user_menu3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`nama_cabe`) REFERENCES `produk_kita` (`nama_cabe`);

--
-- Constraints for table `produk_keluar`
--
ALTER TABLE `produk_keluar`
  ADD CONSTRAINT `produk_keluar_ibfk_1` FOREIGN KEY (`nama_cabe`) REFERENCES `produk_kita` (`nama_cabe`);

--
-- Constraints for table `produk_masuk`
--
ALTER TABLE `produk_masuk`
  ADD CONSTRAINT `produk_masuk_ibfk_1` FOREIGN KEY (`nama_cabe`) REFERENCES `produk_kita` (`nama_cabe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
