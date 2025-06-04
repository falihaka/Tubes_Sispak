-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2025 at 06:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adasampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `laporanweb`
--

CREATE TABLE `laporanweb` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `sesinama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporanweb`
--

INSERT INTO `laporanweb` (`id`, `nama`, `telepon`, `kota`, `lokasi`, `tanggal`, `deskripsi`, `gambar`, `sesinama`) VALUES
(84, 'Asyifa Afra Sayyida', '083994712093', 'Kabupaten Bandung', 'Depan pabrik nirwana Majalaya', '31-05-2025', 'Sesuai gambar, sampah sudah menumpuk sampai di jalan raya. hal itu mengganggu pengguna jalan yang sedang beraktifitas.Tak itu juga sampahnya juga sangat bau.Tolong DLH sidoarjo untuk membantu', 'tempat5.jpeg', 'Afra'),
(85, 'Asyifa Afra Sayyida', '0810232391821', 'Kabupaten Bandung', 'Depan taman ', '31-05-2025', 'Sesuai gambar, sampah sudah menumpuk sampai di jalan raya. hal itu mengganggu pengguna jalan yang sedang beraktifitas.Tak itu juga sampahnya juga sangat bau.Tolong DLH Sumenep untuk membantu', 'tempat3.jpeg', 'Afra'),
(95, 'Asyifa Afra Sayyida', '08922380132', 'Kabupaten Garut', 'Bayongbong', '2025-06-02', 'Sampah yang ada pada lingkungan masyarakat', '683d253c74264.jpg', 'afra ');

-- --------------------------------------------------------

--
-- Table structure for table `materiweb`
--

CREATE TABLE `materiweb` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materiweb`
--

INSERT INTO `materiweb` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(49, 'Sampah Organik', 'sampah organik yaitu sampah yang berasal dari sisa mahkluk hidup yang mudah terurai secara alami tanpa proses campur tangan manusia untuk dapat terurai.', '639dc30e37488.jpg'),
(50, 'Sampah Anorganik', 'Sampah anorganik adalah sampah yang terdiri atas bahan-bahan anorganik. Contoh bahan-bahan anorganik adalah bahan logam, plastik, kaca, karet, dan kaleng.', 'sampah2.jpg'),
(51, 'Sampah Daur Ulang', 'Daur ulang adalah proses mengubah bahan limbah menjadi bahan dan benda baru.Sampah plastik seperti gelas minuman kemasan dapat dikreasikan menjadi vas ', '639dc484d91f0.png'),
(52, 'Kota Terbersih', '3 kota terbersih se Indonesia dari provinsi Jawa Timur adalah Kota Malang yang menjadi gudang wisata, Kota Surabaya atau Kota Pahlawan, dan Kota Kediri ', '639dc5a74baf0.jpeg'),
(53, 'Lingkungan Hidup', 'Dinas Lingkungan Hidup adalah merupakan unsur pelaksana Pemerintah Daerah dibidang Lingkungan Hidup, dipimpin oleh seorang Kepala Dinas', '639dc768cd069.jpg'),
(54, 'Kebersihan', 'Kebersihan adalah upaya manusia untuk memelihara lingkungannya dari berbagai sampah dalam rangka mewujudkan kehidupan yang sehat dan nyaman.', 'sampah7.jpg'),
(55, 'Penyakit', 'Penyakit akibat infeksi bakteri yang perlu diwaspadai jika kebersihan lingkungan tidak terjaga, yaitu diare, leptospirosis, demam tifoid, penyakit pes, dan shigellosis', 'sampah3.jpg'),
(56, 'Membuang sampah', 'MEmbuang sampah pada tempatnya Mengurangi Risiko Penularan Penyakit sampah organik yang dibuang secara sembarangan rentan dihinggapi serangga dan mikroorganisme penyebar penyakit.', '639dc3a27edfc.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `katasandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `katasandi`) VALUES
(15, 'afra', '$2y$10$I1By.2kgCZOY3Wz0BW89peZl0icyjK1LCujTNc2wcXgZRMJWhugH2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `laporanweb`
--
ALTER TABLE `laporanweb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materiweb`
--
ALTER TABLE `materiweb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `laporanweb`
--
ALTER TABLE `laporanweb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `materiweb`
--
ALTER TABLE `materiweb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
