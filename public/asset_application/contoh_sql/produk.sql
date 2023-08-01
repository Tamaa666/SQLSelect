SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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


INSERT INTO `produk` (`id`, `kategori`, `kode`, `nama`, `kemasan`, `harga_satuan`, `harga_borongan`, `qty_borongan`, `stock`, `created_at`, `updated_at`) VALUES
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

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;
COMMIT;

