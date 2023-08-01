-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 01, 2023 at 06:48 PM
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
-- Database: `temp`
--

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` bigint(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nilai` bigint(20) NOT NULL,
  `nilai_huruf` char(1) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `kode_matakuliah` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `nama`, `nilai`, `nilai_huruf`, `nim`, `kode_matakuliah`) VALUES
(1, 'arasataman', 80, 'A', '1941720066', 'PBO'),
(2, 'bandi muhammad', 84, 'A', '1941720067', 'PBO'),
(3, 'budi bandi', 70, 'C', '1941720068', 'PBF'),
(4, 'Bani Eko', 84, 'A', '1941720069', 'PBO'),
(5, 'arjuna', 79, 'B', '1941720070', 'PBF'),
(6, 'shella mega', 65, 'C', '1941720071', 'PBO'),
(7, 'cinta abadi', 77, 'B', '1941720072', 'PBF'),
(8, 'badang ml', 80, 'A', '1941720073', 'PBO'),
(9, 'nana hapsari', 70, 'C', '1941720074', 'PBF'),
(10, 'novaria', 80, 'A', '1941720073', 'PBF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
