-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 08:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toga`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama`) VALUES
(1, 'restaurant'),
(2, 'playgorund'),
(3, 'parasut');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL,
  `text` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `id_fasilitas`, `text`, `foto`) VALUES
(1, 1, 'Restoran Gunung Toga, destinasi kuliner istimewa di Toga Hills, Sumedang, menyajikan hidangan lokal dan internasional dengan pemandangan alam yang mempesona. Suasana santai dan layanan ramah membuatnya tempat sempurna untuk menikmati makanan lezat setelah menjelajahi keindahan alam. Jangan lewatkan pengalaman kuliner tak terlupakan di Restoran Gunung Toga!', 'resto.jpg'),
(2, 2, 'Playground adalah taman bermain anak-anak yang menyenangkan dan mendidik, dirancang untuk mempromosikan kreativitas, aktivitas fisik, dan interaksi sosial. Dengan berbagai permainan seperti ayunan, jungkat-jungkit, dan perosotan, serta area terbuka untuk berlarian dan bermain bola, playground menjadi tempat ideal bagi anak-anak untuk belajar dan tumbuh secara positif dalam lingkungan yang aman dan mendukung.', 'play.jpg'),
(3, 3, 'Parasut di Toga Hills, Sumedang, menawarkan petualangan seru dan pemandangan alam yang menakjubkan. Dibimbing oleh instruktur berpengalaman dan dilengkapi dengan peralatan yang aman, pengunjung dapat merasakan sensasi terbang bebas di udara dengan parasut. Dari ketinggian, mereka dapat menikmati panorama perbukitan hijau dan keindahan alam lainnya. Pengalaman ini tidak hanya mendebarkan, tetapi juga memberikan kesempatan untuk mengagumi keindahan alam dari perspektif yang unik. Ideal bagi para petualang dan pecinta alam!', 'parasut.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `tanggal_keberangkatan` date DEFAULT NULL,
  `jumlah_peserta` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `nama_lengkap`, `email`, `telepon`, `tanggal_keberangkatan`, `jumlah_peserta`, `status`, `tanggal_pembuatan`) VALUES
(1, 'Reffy Lesmana', 'Reffylesmana@gmail.com', '08987654321', '2024-04-29', 1, 'Disetujui', '2024-04-28 23:12:47'),
(2, 'Cahya Agus', 'cahyaagus1@gmail.com', '08123432123', '2025-04-01', 2, 'Menunggu Persetujuan', '2024-04-28 23:12:47'),
(12, 'Fahmi Husain', 'fahmi19@gmail.com', '089876543456', '2024-04-30', 2, 'Ditolak', '2024-04-28 19:21:27'),
(21, 'Asep Basri', 'asepbotax@gmail.com', '083456765432', '2024-06-05', 3, NULL, '2024-04-28 20:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$D3rVNT.5OZ1yuui8wgNkGetnqkwbSmcwcKmvnzZLtKGtLlDcrtU3e', 'admin'),
(2, 'reffy', '$2y$10$JmFC0llNWleoGbEnxd/S3OpDn0XUH8mbMw4AkBJ2ckmBnPpcEY5eG', 'user'),
(3, 'cahya', '$2y$10$Baj2F5sii040NNHuvK1/WuR83M8WjPRbtgUlPVPuiuKYlMKNrinG6', 'user'),
(4, 'fahmi', '$2y$10$gWTBoUG.RQNdidHeVvYtYuXI8v7Nu4F1mDOd2CJGAaifQPSMGJ7ra', 'user'),
(5, 'asep', '$2y$10$OPywgAUpNHK.qk1Rdd8RJeGGQgd0GVwXjlQ14Krh6YETWkpjHMpCG', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`),
  ADD UNIQUE KEY `nama` (`id_fasilitas`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_fasilitas` (`id_fasilitas`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_fasilitas`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
