-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 01, 2023 at 03:01 PM
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
  `nama` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_table`
--

INSERT INTO `data_table` (`id`, `nama`, `file`, `created_at`, `updated_at`) VALUES
(1, 'produk', '1593606957_file_table.sql', '2023-07-20 19:49:03', '2023-07-20 19:59:51');

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

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'TI-1A', '2023-07-21 17:20:33', '2023-07-21 18:01:07'),
(2, 'TI-1B', '2023-07-21 17:20:43', NULL);

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

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `kelas_id`, `user_id`, `nim`, `nama`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 1941720069, 'Arjuna Mahasiswa', '2023-07-21 18:01:00', '2023-07-21 18:13:31');

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

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `nama`, `deskripsi`, `file`, `created_at`, `updated_at`) VALUES
(1, 'select', 'dasasdadccccccc', '664316570_file_materi.pdf', '2023-07-21 17:33:19', '2023-07-21 17:33:29');

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
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Latihan Semester 1', '2023-07-21 21:20:08', '2023-07-28 20:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `paket_soal`
--

CREATE TABLE `paket_soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_soal`
--

INSERT INTO `paket_soal` (`id`, `paket_id`, `soal_id`, `created_at`, `updated_at`) VALUES
(9, 2, 2, '2023-07-28 20:16:33', NULL),
(10, 2, 3, '2023-07-28 20:16:33', NULL),
(11, 2, 4, '2023-07-28 20:16:33', NULL),
(12, 2, 5, '2023-07-28 20:16:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
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
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori`, `kode`, `nama`, `kemasan`, `harga_satuan`, `harga_borongan`, `qty_borongan`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'vitamin', 'PPK001', 'NPK Petroganik', '5 kg', '100000', '100000', 10, 100, NULL, NULL),
(2, 'vitamin', 'PPK002', 'NPK Mutiara', '10 kg', '150000', '150000', 10, 100, NULL, NULL),
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
-- Table structure for table `simulasi`
--

CREATE TABLE `simulasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `autograding` enum('iya','tidak') NOT NULL,
  `skip` tinyint(1) NOT NULL DEFAULT 0,
  `type` enum('ujian','latihan') NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `start_date_time` datetime DEFAULT NULL,
  `end_date_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simulasi`
--

INSERT INTO `simulasi` (`id`, `autograding`, `skip`, `type`, `kelas_id`, `paket_id`, `nama`, `deskripsi`, `start_date_time`, `end_date_time`, `created_at`, `updated_at`) VALUES
(2, 'tidak', 1, 'latihan', 2, 2, 'Latihan Semester 1 Kelas TI-1B', 'Simulasi adalah suatu proses peniruan dari sesuatu yang nyata beserta keadaan sekelilingnya (state of affairs). Aksi melakukan simulasi ini secara umum menggambarkan sifat-sifat karakteristik kunci dari kelakuan sistem fisik atau sistem.', '2023-07-28 20:21:00', '2023-08-01 20:21:00', '2023-07-28 20:21:12', '2023-07-31 23:09:30'),
(3, 'iya', 0, 'ujian', 2, 2, 'Ujian Semester 1', 'Simulasi adalah suatu proses peniruan dari sesuatu yang nyata beserta keadaan sekelilingnya (state of affairs). Aksi melakukan simulasi ini secara umum menggambarkan sifat-sifat karakteristik kunci dari kelakuan sistem fisik atau sistem.', '2023-07-28 20:31:00', '2023-08-01 20:31:00', '2023-07-28 20:33:30', '2023-08-01 00:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_hasil`
--

CREATE TABLE `simulasi_hasil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('latihan','ujian') NOT NULL,
  `simulasi_id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `nilai` varchar(10) NOT NULL,
  `sesi` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simulasi_hasil`
--

INSERT INTO `simulasi_hasil` (`id`, `type`, `simulasi_id`, `mahasiswa_id`, `nilai`, `sesi`, `created_at`, `updated_at`) VALUES
(1, 'latihan', 2, 1, '20', 1, '2023-08-01 14:11:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_log`
--

CREATE TABLE `simulasi_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('latihan','ujian') NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `soal_id` bigint(20) UNSIGNED NOT NULL,
  `simulasi_id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_id` bigint(20) UNSIGNED NOT NULL,
  `file` text NOT NULL,
  `status` enum('right','not') NOT NULL,
  `message` text DEFAULT NULL,
  `sesi` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simulasi_log`
--

INSERT INTO `simulasi_log` (`id`, `type`, `paket_id`, `soal_id`, `simulasi_id`, `mahasiswa_id`, `file`, `status`, `message`, `sesi`, `created_at`, `updated_at`) VALUES
(1, 'latihan', 2, 2, 2, 1, 'select * from produk where kategori=\'pupuk\'', 'right', 'syntax berhasil di eksekusi dan jawaban sudah sesuai anda bisa melanjutkan ke soal berikutnya', 1, '2023-07-31 23:41:58', '2023-07-31 23:41:58'),
(2, 'ujian', 2, 2, 3, 1, 'select * from produk where kategori=\'pupuk\'', 'right', 'syntax berhasil di eksekusi dan jawaban sudah sesuai anda bisa melanjutkan ke soal berikutnya', 1, '2023-08-01 00:16:56', '2023-08-01 00:16:56'),
(3, 'latihan', 2, 3, 2, 1, 'select * from produk;', 'right', 'syntax berhasil di eksekusi dan jawaban sudah sesuai anda bisa melanjutkan ke soal berikutnya', 1, '2023-08-01 13:31:14', '2023-08-01 13:31:14'),
(4, 'latihan', 2, 4, 2, 1, 'fdfd', 'not', ' Syntax error or access violation:  You have an error in your SQL syntax near \'fdfd\' at line 1 ', 1, '2023-08-01 14:10:14', '2023-08-01 14:10:14'),
(5, 'latihan', 2, 5, 2, 1, 'sdsd', 'not', ' Syntax error or access violation:  You have an error in your SQL syntax near \'sdsd\' at line 1 ', 1, '2023-08-01 14:11:50', '2023-08-01 14:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `simulasi_materi`
--

CREATE TABLE `simulasi_materi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `materi_id` bigint(20) UNSIGNED NOT NULL,
  `simulasi_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('latihan','ujian') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simulasi_materi`
--

INSERT INTO `simulasi_materi` (`id`, `materi_id`, `simulasi_id`, `type`, `created_at`, `updated_at`) VALUES
(8, 1, 2, 'latihan', '2023-07-31 23:09:30', '2023-07-31 23:09:30'),
(9, 1, 3, 'ujian', '2023-08-01 00:16:21', '2023-08-01 00:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `soal_sql`
--

CREATE TABLE `soal_sql` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `data_table_id` bigint(20) UNSIGNED NOT NULL,
  `bobot` varchar(10) NOT NULL DEFAULT '0',
  `feedback_benar` text DEFAULT NULL,
  `feedback_salah` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_sql`
--

INSERT INTO `soal_sql` (`id`, `soal`, `jawaban`, `data_table_id`, `bobot`, `feedback_benar`, `feedback_salah`, `created_at`, `updated_at`) VALUES
(2, 'Tulisakan query untuk mendapatkan produk dengan kategori pupuk', 'SELECT * FROM produk WHERE kategori = \'pupuk\';', 1, '10', 'Selamat jawban anda benar untuk terus meningkatkan pemahaman anda terus belajar ya', 'Jawaban anda masih salah, harap perhatkan syntax yang anda upload dan periksa, serta korelasikan dengan petunjuk di soal', '2023-07-21 18:58:15', '2023-07-30 06:43:04'),
(3, 'Tulisakan query untuk mendapatkan semua data produk', 'SELECT * FROM produk;', 1, '10', 'Selamat jawban anda benar untuk terus meningkatkan pemahaman anda terus belajar ya', 'Jawaban anda masih salah, harap perhatkan syntax yang anda upload dan periksa, serta korelasikan dengan petunjuk di soal', '2023-07-21 18:58:15', NULL),
(4, 'Tulisakan query untuk mendapatkan semua data produk kecuali dengan kode PPK001', 'SELECT * FROM produk WHERE kode NOT IN (\'PPK001\');', 1, '10', 'Selamat jawban anda benar untuk terus meningkatkan pemahaman anda terus belajar ya', 'Jawaban anda masih salah, harap perhatkan syntax yang anda upload dan periksa, serta korelasikan dengan petunjuk di soal', '2023-07-21 18:58:15', NULL),
(5, 'Tulisakan query untuk mendapatkan semua data produk akan tetapi tidak boleh ada kemasan yang sama', 'SELECT * FROM produk GROUP BY kemasan;', 1, '10', 'Selamat jawban anda benar untuk terus meningkatkan pemahaman anda terus belajar ya', 'Jawaban anda masih salah, harap perhatkan syntax yang anda upload dan periksa, serta korelasikan dengan petunjuk di soals', '2023-07-21 18:58:15', '2023-07-21 19:07:23');

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
(1, 'dosen', 'Arjuna Pratama', 'arjuna_dosen', '$2y$10$cgEpt6bsqnKqYSvnZXKGfe7rZ.ljdoc4JSs7fvsgregWIdMRV8xRK', '2023-07-10 20:08:11', '2023-07-10 17:00:00'),
(2, 'mahasiswa', 'Arjuna Mahasiswa', '1941720069', '$2y$10$DysRmHmPnmGMcD8wk.a5A.jM/MAY.dRI19/fje1.Dge00DF1/1GcK', '2023-07-21 11:01:00', '2023-07-21 11:13:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_table`
--
ALTER TABLE `data_table`
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
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_soal`
--
ALTER TABLE `paket_soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paket_soal` (`paket_id`),
  ADD KEY `soal_soal_paket` (`soal_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `simulasi`
--
ALTER TABLE `simulasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_simulasi` (`kelas_id`),
  ADD KEY `kelas_paket` (`paket_id`);

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
  ADD KEY `log_mhs` (`mahasiswa_id`),
  ADD KEY `paket_simulasi` (`paket_id`);

--
-- Indexes for table `simulasi_materi`
--
ALTER TABLE `simulasi_materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materi_sml` (`simulasi_id`),
  ADD KEY `sml_materi` (`materi_id`);

--
-- Indexes for table `soal_sql`
--
ALTER TABLE `soal_sql`
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
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paket_soal`
--
ALTER TABLE `paket_soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `simulasi`
--
ALTER TABLE `simulasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `simulasi_hasil`
--
ALTER TABLE `simulasi_hasil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `simulasi_log`
--
ALTER TABLE `simulasi_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `simulasi_materi`
--
ALTER TABLE `simulasi_materi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `soal_sql`
--
ALTER TABLE `soal_sql`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `paket_soal`
--
ALTER TABLE `paket_soal`
  ADD CONSTRAINT `paket_soal` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `soal_soal_paket` FOREIGN KEY (`soal_id`) REFERENCES `soal_sql` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi`
--
ALTER TABLE `simulasi`
  ADD CONSTRAINT `kelas_paket` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `log_soal` FOREIGN KEY (`soal_id`) REFERENCES `soal_sql` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paket_simulasi` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simulasi_materi`
--
ALTER TABLE `simulasi_materi`
  ADD CONSTRAINT `materi_sml` FOREIGN KEY (`simulasi_id`) REFERENCES `simulasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sml_materi` FOREIGN KEY (`materi_id`) REFERENCES `materi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `soal_sql`
--
ALTER TABLE `soal_sql`
  ADD CONSTRAINT `data_table_id` FOREIGN KEY (`data_table_id`) REFERENCES `data_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
