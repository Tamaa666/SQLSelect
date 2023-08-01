-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 20, 2023 at 11:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juna`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_table`
--

CREATE TABLE `data_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_table`
--

INSERT INTO `data_table` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'data_table_produk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `data_table_produk`
--

CREATE TABLE `data_table_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` enum('pestisida','vitamin','pupuk','alat','bibit') NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kemasan` varchar(100) NOT NULL,
  `harga_satuan` varchar(10) NOT NULL,
  `harga_borongan` varchar(10) NOT NULL DEFAULT '0',
  `qty_borongan` int(10) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_table_produk`
--

INSERT INTO `data_table_produk` (`id`, `kategori`, `kode`, `nama`, `kemasan`, `harga_satuan`, `harga_borongan`, `qty_borongan`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'pupuk', 'PPK001', 'NPK Petroganik', '5 kg', '100000', '100000', 10, 100, NULL, NULL),
(2, 'pupuk', 'PPK002', 'NPK Mutiara', '10 kg', '150000', '150000', 10, 100, NULL, NULL),
(3, 'pupuk', 'PPK003', 'pupuk Kujang NPK', '25 kg', '200000', '200000', 10, 100, NULL, NULL),
(4, 'pupuk', 'PPK004', 'Astra Agro Lestari (AAL) NPK', '20 kg', '180000', '180000', 10, 100, NULL, NULL),
(5, 'pupuk', 'PPK005', 'pupuk Indonesia Holding Company (PIHC) NPK', '10 kg', '140000', '140000', 10, 100, NULL, NULL),
(6, 'pupuk', 'PPK006', 'pupuk Sriwidjaja Palembang (Pusri) NPK', '50 kg', '250000', '250000', 10, 100, NULL, NULL),
(7, 'pupuk', 'PPK007', 'pupuk Iskandar Muda (PIM) NPK', '30 kg', '220000', '220000', 10, 100, NULL, NULL),
(8, 'pupuk', 'PPK008', 'pupuk Kalimantan Timur (pupuk Kaltim) NPK', '25 kg', '200000', '200000', 10, 100, NULL, NULL),
(9, 'pupuk', 'PPK009', 'pupuk Kaltim Prima NPK', '20 kg', '180000', '180000', 10, 100, NULL, NULL),
(10, 'pupuk', 'PPK010', 'pupuk Kujang Cikampek NPK', '10 kg', '140000', '140000', 10, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nim` bigint(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `simulasi`
--

CREATE TABLE `simulasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('ujian','latihan') NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `start_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_hasil`
--

CREATE TABLE `simulasi_hasil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `simulasi_id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_log`
--

CREATE TABLE `simulasi_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `simulasi_id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(100) NOT NULL,
  `status` enum('right','not') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_materi`
--

CREATE TABLE `simulasi_materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `materi_id` bigint(20) UNSIGNED NOT NULL,
  `simulasi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_soal`
--

CREATE TABLE `simulasi_soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `simualasi_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `soal_query_select`
--

CREATE TABLE `soal_query_select` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `data_table_id` bigint(20) UNSIGNED NOT NULL,
  `bobot` varchar(10) NOT NULL,
  `feedback_benar` text DEFAULT NULL,
  `feedback_salah` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('dosen','mahasiswa') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'dosen', 'Arjuna Pratama', 'arjuna_dosen', '$2y$10$cgEpt6bsqnKqYSvnZXKGfe7rZ.ljdoc4JSs7fvsgregWIdMRV8xRK', '2023-07-10 20:08:11', '2023-07-10 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_table`
--
ALTER TABLE `data_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_table_produk`
--
ALTER TABLE `data_table_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kls_mhs` (`kelas_id`),
  ADD KEY `user_mhs` (`user_id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simulasi`
--
ALTER TABLE `simulasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_simulasi` (`kelas_id`);

--
-- Indexes for table `simulasi_hasil`
--
ALTER TABLE `simulasi_hasil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `simulasi_mhs` (`mahasiswa_id`),
  ADD KEY `simulasi_hasil` (`simulasi_id`);

--
-- Indexes for table `simulasi_log`
--
ALTER TABLE `simulasi_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_soal` (`soal_id`),
  ADD KEY `log_simulasi` (`simulasi_id`),
  ADD KEY `log_mhs` (`mahasiswa_id`);

--
-- Indexes for table `simulasi_materi`
--
ALTER TABLE `simulasi_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materi_sml` (`simulasi_id`),
  ADD KEY `sml_materi` (`materi_id`);

--
-- Indexes for table `simulasi_soal`
--
ALTER TABLE `simulasi_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_sml` (`simualasi_id`),
  ADD KEY `soal_soal` (`soal_id`);

--
-- Indexes for table `soal_query_select`
--
ALTER TABLE `soal_query_select`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_table_id` (`data_table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_table`
--
ALTER TABLE `data_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_table_produk`
--
ALTER TABLE `data_table_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `simulasi`
--
ALTER TABLE `simulasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simulasi_hasil`
--
ALTER TABLE `simulasi_hasil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simulasi_log`
--
ALTER TABLE `simulasi_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simulasi_materi`
--
ALTER TABLE `simulasi_materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simulasi_soal`
--
ALTER TABLE `simulasi_soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `soal_query_select`
--
ALTER TABLE `soal_query_select`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `kls_mhs` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_mhs` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi`
--
ALTER TABLE `simulasi`
  ADD CONSTRAINT `kelas_simulasi` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi_hasil`
--
ALTER TABLE `simulasi_hasil`
  ADD CONSTRAINT `simulasi_hasil` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `simulasi_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi_log`
--
ALTER TABLE `simulasi_log`
  ADD CONSTRAINT `log_mhs` FOREIGN KEY (`mahasiswa_id`) REFERENCES `mahasiswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_simulasi` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `log_soal` FOREIGN KEY (`soal_id`) REFERENCES `soal_query_select` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi_materi`
--
ALTER TABLE `simulasi_materi`
  ADD CONSTRAINT `materi_sml` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sml_materi` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi_soal`
--
ALTER TABLE `simulasi_soal`
  ADD CONSTRAINT `soal_sml` FOREIGN KEY (`simualasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soal_soal` FOREIGN KEY (`soal_id`) REFERENCES `soal_query_select` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal_query_select`
--
ALTER TABLE `soal_query_select`
  ADD CONSTRAINT `data_table_id` FOREIGN KEY (`data_table_id`) REFERENCES `data_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
