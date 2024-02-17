-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2024 at 06:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `BukuID` int NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Penulis` varchar(255) NOT NULL,
  `Penerbit` varchar(255) NOT NULL,
  `TahunTerbit` year NOT NULL,
  `Sampul` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `TahunTerbit`, `Sampul`) VALUES
(12, 'test2', 'test', 'test', '2009', '65cdd643bc158.jpg'),
(13, 'Naruto Shipudden', 'Masashi', 'Test Test', '2001', '65cecef41d01e.jpg'),
(14, 'Si Bolang', 'Ucup', 'Saha', '1999', '65d046e956b53.png');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` int NOT NULL,
  `NamaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
(1, 'Komedi'),
(3, 'Fisika'),
(4, 'Science'),
(5, 'MATEMATIKA');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `KategoriBukuID` int NOT NULL,
  `BukuID` int NOT NULL,
  `KategoriID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategoribuku_relasi`
--

INSERT INTO `kategoribuku_relasi` (`KategoriBukuID`, `BukuID`, `KategoriID`) VALUES
(4, 12, 1),
(5, 12, 3),
(20, 13, 4),
(21, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int NOT NULL,
  `UserID` int NOT NULL,
  `BukuID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`) VALUES
(7, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `PeminjamanID` int NOT NULL,
  `UserID` int NOT NULL,
  `BukuID` int NOT NULL,
  `TanggalPeminjaman` date NOT NULL,
  `TanggalPengembalian` date NOT NULL,
  `StatusPeminjaman` enum('dipinjam','dikembalikan') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`PeminjamanID`, `UserID`, `BukuID`, `TanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`) VALUES
(2, 6, 12, '2024-02-16', '2024-02-17', 'dikembalikan'),
(3, 6, 12, '2024-02-15', '2024-02-17', 'dipinjam'),
(4, 7, 12, '2024-02-05', '2024-02-23', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int NOT NULL,
  `UserID` int NOT NULL,
  `BukuID` int NOT NULL,
  `Ulasan` text,
  `Rating` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) NOT NULL,
  `Alamat` text,
  `Role` enum('admin','petugas','peminjam') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `Role`) VALUES
(1, 'admin', '$2y$10$qY/MnjMlJRor0J/WwZ0.AO/3cvlPdXG8XBWIiS97PzfLM9qEJWP5u', 'admin@localhost', 'Admin', 'Jalan Rusak', 'admin'),
(5, 'otong', '$2y$10$I3OrdXtx9b6/Q8ejTWfDg.CDWI6jb1knZXx5M9Hun52gjuINB7V36', 'otong@localhost', 'Otong Surotong', 'Jalan Hiburan', 'petugas'),
(6, 'bambang', '$2y$10$.s7sTTM0LySi9FjEcPHGbOo8qUsP3spoYKjpOt6HrilBCzhYJ6DYq', 'bambang@localhost', 'Bambang', 'Jalan Beng', 'peminjam'),
(7, 'udin', '$2y$10$afuM0LiJEkDH2fiEevSeoeQZPt1Oklje7wBoSGM5.rgea8iST4JiK', 'udin@localhost', 'Udin', 'Jalan Santai', 'peminjam');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_kategoribuku`
-- (See below for the actual view)
--
CREATE TABLE `view_kategoribuku` (
`BukuID` int
,`KategoriID` int
,`NamaKategori` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_koleksibuku`
-- (See below for the actual view)
--
CREATE TABLE `view_koleksibuku` (
`BukuID` int
,`Judul` varchar(255)
,`KoleksiID` int
,`Penerbit` varchar(255)
,`Penulis` varchar(255)
,`Sampul` varchar(100)
,`TahunTerbit` year
,`UserID` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_peminjaman`
-- (See below for the actual view)
--
CREATE TABLE `view_peminjaman` (
`BukuID` int
,`Judul` varchar(255)
,`NamaLengkap` varchar(255)
,`PeminjamanID` int
,`StatusPeminjaman` enum('dipinjam','dikembalikan')
,`TanggalPeminjaman` date
,`TanggalPengembalian` date
,`UserID` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ulasan`
-- (See below for the actual view)
--
CREATE TABLE `view_ulasan` (
`BukuID` int
,`Rating` int
,`Ulasan` text
,`UlasanID` int
,`UserID` int
,`Username` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `view_kategoribuku`
--
DROP TABLE IF EXISTS `view_kategoribuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_kategoribuku`  AS SELECT `buku`.`BukuID` AS `BukuID`, `kategoribuku`.`KategoriID` AS `KategoriID`, `kategoribuku`.`NamaKategori` AS `NamaKategori` FROM ((`buku` join `kategoribuku_relasi` on((`kategoribuku_relasi`.`BukuID` = `buku`.`BukuID`))) join `kategoribuku` on((`kategoribuku`.`KategoriID` = `kategoribuku_relasi`.`KategoriID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_koleksibuku`
--
DROP TABLE IF EXISTS `view_koleksibuku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_koleksibuku`  AS SELECT `koleksipribadi`.`KoleksiID` AS `KoleksiID`, `koleksipribadi`.`UserID` AS `UserID`, `buku`.`BukuID` AS `BukuID`, `buku`.`Judul` AS `Judul`, `buku`.`Penulis` AS `Penulis`, `buku`.`Penerbit` AS `Penerbit`, `buku`.`TahunTerbit` AS `TahunTerbit`, `buku`.`Sampul` AS `Sampul` FROM (`buku` join `koleksipribadi` on((`buku`.`BukuID` = `koleksipribadi`.`BukuID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_peminjaman`
--
DROP TABLE IF EXISTS `view_peminjaman`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_peminjaman`  AS SELECT `peminjaman`.`PeminjamanID` AS `PeminjamanID`, `peminjaman`.`UserID` AS `UserID`, `peminjaman`.`BukuID` AS `BukuID`, `user`.`NamaLengkap` AS `NamaLengkap`, `buku`.`Judul` AS `Judul`, `peminjaman`.`TanggalPeminjaman` AS `TanggalPeminjaman`, `peminjaman`.`TanggalPengembalian` AS `TanggalPengembalian`, `peminjaman`.`StatusPeminjaman` AS `StatusPeminjaman` FROM ((`user` join `peminjaman` on((`user`.`UserID` = `peminjaman`.`UserID`))) join `buku` on((`buku`.`BukuID` = `peminjaman`.`BukuID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `view_ulasan`
--
DROP TABLE IF EXISTS `view_ulasan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ulasan`  AS SELECT `ulasanbuku`.`UlasanID` AS `UlasanID`, `ulasanbuku`.`UserID` AS `UserID`, `ulasanbuku`.`BukuID` AS `BukuID`, `user`.`Username` AS `Username`, `ulasanbuku`.`Ulasan` AS `Ulasan`, `ulasanbuku`.`Rating` AS `Rating` FROM (`user` join `ulasanbuku` on((`user`.`UserID` = `ulasanbuku`.`UserID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`KategoriBukuID`,`BukuID`,`KategoriID`),
  ADD KEY `fk_kategoribuku_relasi_buku` (`BukuID`),
  ADD KEY `fk_kategoribuku_relasi_kategori` (`KategoriID`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`PeminjamanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `KategoriID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `KategoriBukuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `PeminjamanID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `fk_kategoribuku_relasi_buku` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`),
  ADD CONSTRAINT `fk_kategoribuku_relasi_kategori` FOREIGN KEY (`KategoriID`) REFERENCES `kategoribuku` (`KategoriID`);

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);

--
-- Constraints for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
