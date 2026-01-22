-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 22, 2026 at 02:51 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jumantik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_galeri`
--

CREATE TABLE `tb_galeri` (
  `id_galeri` int NOT NULL,
  `judul` text,
  `foto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_galeri`
--

INSERT INTO `tb_galeri` (`id_galeri`, `judul`, `foto`, `deskripsi`) VALUES
(1, 'Tekan Kasus DBD dengan Gerakan Satu Rumah Satu Jumantik', '1768969265_Tekan Kasus DBD dengan Gerakan Satu Rumah Satu Jumantik.jpeg', 'Dinas Kesehatan (Dinkes) mengimbau kepada masyarakat agar berpartisipasi dalam menekan kasus Demam Berdarah Dengue (DBD) dengan gerakan satu rumah satu juru pemantau jentik (jumantik).'),
(2, 'Cegah DBD di Sekolah, Puskesmas Batusari Gandeng Pelajar SMAN 14 Tangerang Jadi Jumantik', '1768971996_Cegah DBD di Sekolah, Puskesmas Batusari Gandeng Pelajar SMAN 14 Tangerang Jadi Jumantik.jpeg', 'Puskesmas Batusari, Kecamatan Batuceper, Kota Tangerang, mengambil langkah proaktif dalam menekan angka kasus Demam Berdarah Dengue (DBD) di lingkungan pendidikan.\r\n\r\nMelalui program inovatif, pihak puskesmas melibatkan puluhan pelajar SMA Negeri 14 Tangerang untuk menjadi Juru Pemantau Jentik (Jumantik) mandiri di sekolah mereka.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_statistik`
--

CREATE TABLE `tb_statistik` (
  `id_statistik` int NOT NULL,
  `rw` varchar(10) DEFAULT NULL,
  `patuh` int DEFAULT NULL,
  `tidak_patuh` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_statistik`
--

INSERT INTO `tb_statistik` (`id_statistik`, `rw`, `patuh`, `tidak_patuh`) VALUES
(2, '001', 132, 3),
(3, '002', 147, 8),
(4, '003', 195, 10),
(5, '004', 132, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_tentang`
--

CREATE TABLE `tb_tentang` (
  `id_tentang` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nomor` varchar(30) DEFAULT NULL,
  `alamat` text,
  `deskripsi` text,
  `link_ig` text,
  `link_tt` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_tentang`
--

INSERT INTO `tb_tentang` (`id_tentang`, `nama`, `email`, `nomor`, `alamat`, `deskripsi`, `link_ig`, `link_tt`) VALUES
(1, 'Sistem Informasi Jingkang Jumantik', 'jingkang@email.com', '6281930461343', 'Jl. Ajibarang-Purwok, Kaliwulan, Jingkang, Kec. Ajibarang, Kabupaten Banyumas, Jawa Tengah 53163', 'Jumantik (Juru Pemantau Jentik) adalah petugas atau relawan yang berperan dalam upaya pencegahan penyakit yang ditularkan oleh nyamuk, khususnya Demam Berdarah Dengue (DBD), dengan cara melakukan pemantauan dan pemeriksaan jentik nyamuk di lingkungan rumah, fasilitas umum, serta tempat-tempat penampungan air yang berpotensi menjadi sarang nyamuk. Selain melakukan pemeriksaan, Jumantik juga memberikan edukasi kepada masyarakat tentang pentingnya menjaga kebersihan lingkungan melalui  enerapan gerakan 3M Plus sebagai langkah pencegahan, sehingga dapat menekan perkembangbiakan nyamuk dan menurunkan risiko penyebaran penyakit berbasis lingkungan.', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tim`
--

CREATE TABLE `tb_tim` (
  `id_tim` int NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `nomor` varchar(30) DEFAULT NULL,
  `foto` text,
  `link_ig` text,
  `link_fb` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_tim`
--

INSERT INTO `tb_tim` (`id_tim`, `nama`, `jabatan`, `nomor`, `foto`, `link_ig`, `link_fb`) VALUES
(3, 'Nisa Anjani', 'Koordinator Jumantik', '0812291123', '1768973734-856.jpg', '-', '-'),
(4, 'Ahmad', 'Koordinator RW 01', '0971351', '1768973421-217.jpg', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `tb_video`
--

CREATE TABLE `tb_video` (
  `id_video` int NOT NULL,
  `judul` text,
  `deskripsi` text,
  `link` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_video`
--

INSERT INTO `tb_video` (`id_video`, `judul`, `deskripsi`, `link`) VALUES
(1, ' Edukasi Pencegahan DBD 3M Plus dan Jumantik', 'Video ini berisi edukasi mengenai pencegahan DBD dengan 3M Plus dan pengenalan Jumant', 'https://www.youtube.com/watch?v=7bk8V32Xvo0&pp=ygUQZWR1a2FzaSBqdW1hbnRpaw%3D%3D');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama_pengguna` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_pengguna`) VALUES
(1, 'admin', 'admin', 'Admin1'),
(3, 'kknump', 'kknump', 'KKN 017 UMP 2026');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `tb_statistik`
--
ALTER TABLE `tb_statistik`
  ADD PRIMARY KEY (`id_statistik`);

--
-- Indexes for table `tb_tentang`
--
ALTER TABLE `tb_tentang`
  ADD PRIMARY KEY (`id_tentang`);

--
-- Indexes for table `tb_tim`
--
ALTER TABLE `tb_tim`
  ADD PRIMARY KEY (`id_tim`);

--
-- Indexes for table `tb_video`
--
ALTER TABLE `tb_video`
  ADD PRIMARY KEY (`id_video`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_galeri`
--
ALTER TABLE `tb_galeri`
  MODIFY `id_galeri` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_statistik`
--
ALTER TABLE `tb_statistik`
  MODIFY `id_statistik` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_tentang`
--
ALTER TABLE `tb_tentang`
  MODIFY `id_tentang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_tim`
--
ALTER TABLE `tb_tim`
  MODIFY `id_tim` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_video`
--
ALTER TABLE `tb_video`
  MODIFY `id_video` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
