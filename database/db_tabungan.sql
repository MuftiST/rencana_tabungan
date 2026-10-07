-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2026 at 07:07 AM
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
-- Database: `db_tabungan`
--

-- --------------------------------------------------------

--
-- Table structure for table `badges`
--

CREATE TABLE `badges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(20) NOT NULL DEFAULT '?',
  `description` text NOT NULL,
  `xp_reward` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`id`, `slug`, `name`, `icon`, `description`, `xp_reward`, `created_at`, `updated_at`) VALUES
(1, 'first-deposit', 'Langkah Pertama', '🌱', 'Melakukan setoran pertama', 25, '2026-09-12 13:05:59', '2026-09-12 13:05:59'),
(2, 'goal-achiever', 'Goal Achiever', '🏆', 'Mencapai satu target tabungan', 50, '2026-09-13 08:39:01', '2026-09-13 08:39:01');

-- --------------------------------------------------------

--
-- Table structure for table `badge_user`
--

CREATE TABLE `badge_user` (
  `badge_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `earned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `badge_user`
--

INSERT INTO `badge_user` (`badge_id`, `user_id`, `earned_at`) VALUES
(1, 1, '2026-09-12 13:05:59'),
(1, 3, '2026-09-16 06:34:00'),
(1, 4, '2026-09-19 02:13:23'),
(1, 5, '2026-09-19 04:19:39'),
(1, 6, '2026-10-03 04:17:26'),
(2, 1, '2026-09-13 08:39:01'),
(2, 3, '2026-09-16 06:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('tabungan-cache-1@gmail.com|127.0.0.1', 'i:1;', 1789791487),
('tabungan-cache-1@gmail.com|127.0.0.1:timer', 'i:1789791487;', 1789791487),
('tabungan-cache-budi@gmail.com|127.0.0.1', 'i:1;', 1789214507),
('tabungan-cache-budi@gmail.com|127.0.0.1:timer', 'i:1789214507;', 1789214507),
('tabungan-cache-rencana@tabungan.test|127.0.0.1', 'i:1;', 1789540436),
('tabungan-cache-rencana@tabungan.test|127.0.0.1:timer', 'i:1789540436;', 1789540436),
('tabungan-cache-testadmin@gmail.com.test|127.0.0.1', 'i:1;', 1789283465),
('tabungan-cache-testadmin@gmail.com.test|127.0.0.1:timer', 'i:1789283465;', 1789283465);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tabungan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `aktivitas` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id`, `user_id`, `tabungan_id`, `aktivitas`, `deskripsi`, `created_at`, `updated_at`) VALUES
(3, 1, 3, 'setoran', 'Menambahkan setoran Rp 40.000.000', '2026-09-12 12:24:05', '2026-09-12 12:24:05'),
(4, 1, 3, 'setoran', 'Menambahkan setoran Rp 600.000.000', '2026-09-12 12:26:56', '2026-09-12 12:26:56'),
(5, 1, 4, 'tabungan baru', 'Membuat tabungan baru: Biaya Nikah', '2026-09-12 12:32:00', '2026-09-12 12:32:00'),
(6, 1, 4, 'setoran', 'Menambahkan setoran Rp 100.000.000', '2026-09-12 12:34:42', '2026-09-12 12:34:42'),
(7, 1, 4, 'setoran', 'Menambahkan setoran Rp 10.000.000', '2026-09-12 13:05:59', '2026-09-12 13:05:59'),
(8, 1, 5, 'tabungan baru', 'Membuat tabungan baru: Liburan', '2026-09-12 13:27:22', '2026-09-12 13:27:22'),
(9, 1, 4, 'setoran', 'Menambahkan setoran Rp 50.000.000', '2026-09-13 08:06:53', '2026-09-13 08:06:53'),
(10, 1, 5, 'setoran', 'Menambahkan setoran Rp 400.000', '2026-09-13 08:33:35', '2026-09-13 08:33:35'),
(11, 1, 5, 'setoran', 'Menambahkan setoran Rp 700.000', '2026-09-13 08:39:01', '2026-09-13 08:39:01'),
(12, 1, 4, 'setoran', 'Menambahkan setoran Rp 50.000.000', '2026-09-13 08:40:33', '2026-09-13 08:40:33'),
(13, 1, 4, 'setoran', 'Menambahkan setoran Rp 250.000.000', '2026-09-13 08:41:06', '2026-09-13 08:41:06'),
(14, 1, 3, 'setoran', 'Menambahkan setoran Rp 1.000.000', '2026-09-13 08:43:32', '2026-09-13 08:43:32'),
(15, 1, 3, 'setoran', 'Menambahkan setoran Rp 100.000', '2026-09-13 09:14:25', '2026-09-13 09:14:25'),
(16, 3, 6, 'tabungan baru', 'Membuat tabungan baru: umrah', '2026-09-16 06:33:40', '2026-09-16 06:33:40'),
(17, 3, 6, 'setoran', 'Menambahkan setoran Rp 10.000.000', '2026-09-16 06:34:00', '2026-09-16 06:34:00'),
(18, 3, 6, 'setoran', 'Menambahkan setoran Rp 40.000.000', '2026-09-16 06:34:14', '2026-09-16 06:34:14'),
(19, 4, 7, 'tabungan baru', 'Membuat tabungan baru: Biaya Kuliah', '2026-09-19 02:13:01', '2026-09-19 02:13:01'),
(20, 4, 7, 'setoran', 'Menambahkan setoran Rp 100.000.000', '2026-09-19 02:13:23', '2026-09-19 02:13:23'),
(21, 5, 8, 'tabungan baru', 'Membuat tabungan baru: Beli laptop', '2026-09-19 04:19:04', '2026-09-19 04:19:04'),
(22, 5, 8, 'setoran', 'Menambahkan setoran Rp 200.000', '2026-09-19 04:19:38', '2026-09-19 04:19:38'),
(23, 6, 9, 'tabungan baru', 'Membuat tabungan baru: Biaya Sekolah Anak', '2026-10-03 04:17:06', '2026-10-03 04:17:06'),
(24, 6, 9, 'setoran', 'Menambahkan setoran Rp 90.000.000', '2026-10-03 04:17:26', '2026-10-03 04:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `menabung`
--

CREATE TABLE `menabung` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tabungan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menabung`
--

INSERT INTO `menabung` (`id`, `tabungan_id`, `user_id`, `nominal`, `tanggal`, `created_at`, `updated_at`) VALUES
(9, 3, 1, 40000000.00, '2026-09-12', '2026-09-12 12:24:05', '2026-09-12 12:24:05'),
(10, 3, 1, 600000000.00, '2026-09-12', '2026-09-12 12:26:56', '2026-09-12 12:26:56'),
(11, 4, 1, 100000000.00, '2026-09-12', '2026-09-12 12:34:42', '2026-09-12 12:34:42'),
(12, 4, 1, 10000000.00, '2026-09-12', '2026-09-12 13:05:59', '2026-09-12 13:05:59'),
(13, 4, 1, 50000000.00, '2026-09-13', '2026-09-13 08:06:53', '2026-09-13 08:06:53'),
(14, 5, 1, 400000.00, '2026-09-10', '2026-09-13 08:33:35', '2026-09-13 08:33:35'),
(15, 5, 1, 700000.00, '2026-09-13', '2026-09-13 08:39:01', '2026-09-13 08:39:01'),
(16, 4, 1, 50000000.00, '2026-08-13', '2026-09-13 08:40:33', '2026-09-13 08:40:33'),
(17, 4, 1, 250000000.00, '2026-06-25', '2026-09-13 08:41:06', '2026-09-13 08:41:06'),
(18, 3, 1, 1000000.00, '2026-09-13', '2026-09-13 08:43:32', '2026-09-13 08:43:32'),
(19, 3, 1, 100000.00, '2026-09-13', '2026-09-13 09:14:25', '2026-09-13 09:14:25'),
(20, 6, 3, 10000000.00, '2026-09-16', '2026-09-16 06:34:00', '2026-09-16 06:34:00'),
(21, 6, 3, 40000000.00, '2026-09-16', '2026-09-16 06:34:13', '2026-09-16 06:34:13'),
(22, 7, 4, 100000000.00, '2026-09-19', '2026-09-19 02:13:23', '2026-09-19 02:13:23'),
(23, 8, 5, 200000.00, '2026-09-19', '2026-09-19 04:19:38', '2026-09-19 04:19:38'),
(24, 9, 6, 90000000.00, '2026-10-03', '2026-10-03 04:17:26', '2026-10-03 04:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `menabung_payments`
--

CREATE TABLE `menabung_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tabungan_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menabung_payments`
--

INSERT INTO `menabung_payments` (`id`, `user_id`, `tabungan_id`, `order_id`, `nominal`, `tanggal`, `status`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'TAB-20260913161411-1QAUFESU', 100000.00, '2026-09-13', 'pending', NULL, '2026-09-13 09:14:11', '2026-09-13 09:14:11'),
(2, 1, 4, 'TAB-20260913163459-JBFSB3XU', 100000.00, '2026-09-13', 'pending', NULL, '2026-09-13 09:34:59', '2026-09-13 09:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_12_180000_create_tabungan_table', 1),
(5, '2026_09_12_180001_create_menabung_table', 1),
(6, '2026_09_12_190000_create_log_aktivitas_table', 2),
(7, '2026_09_12_200000_create_advanced_features_tables', 3),
(8, '2026_09_12_200001_create_notifications_table', 3),
(9, '2026_09_12_200002_add_email_verified_at_to_users_table', 4),
(10, '2026_09_12_200003_add_user_id_to_menabung_table', 5),
(11, '2026_09_12_200004_create_tabungan_kontributor_table', 5),
(12, '2026_09_13_160000_create_menabung_payments_table', 6),
(13, '2026_10_07_000000_ensure_tabungan_kontributor_table_exists', 7);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('5e050aa6-9f90-48ea-b87d-8369b007b731', 'App\\Notifications\\TabunganTercapai', 'App\\Models\\User', 1, '{\"title\":\"Tabungan tercapai!\",\"message\":\"Selamat, target Liburan sudah tercapai.\",\"tabungan_id\":5,\"url\":\"http:\\/\\/127.0.0.1:8000\\/tabungan\\/5\"}', '2026-09-13 08:39:19', '2026-09-13 08:39:01', '2026-09-13 08:39:19'),
('939f049e-c71c-4157-9653-c59970d51db8', 'App\\Notifications\\TabunganTercapai', 'App\\Models\\User', 3, '{\"title\":\"Tabungan tercapai!\",\"message\":\"Selamat, target umrah sudah tercapai.\",\"tabungan_id\":6,\"url\":\"http:\\/\\/127.0.0.1:8000\\/tabungan\\/6\"}', '2026-09-16 06:39:49', '2026-09-16 06:34:14', '2026-09-16 06:39:49');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('omOzxH2rcp4FyrA3Vt5d4riBrmD0gsjQCgEc8ULk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEtuWXIwVVVMdkJvNGpqQlhabjJFaE9vVm1BTHZKdGhYdFg3cUQ0OSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1789540831),
('yUA50O7bk2wHU5aBesFGsGrFbNc2pgGiRMEL96Zf', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1luNmlIaEFNMVZSdEdnMU0yZVVlOVI2VndyRHMwS0pGMExzZWtOMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1789791724);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `judul` varchar(150) NOT NULL,
  `target_nominal` decimal(15,2) NOT NULL,
  `target_tanggal` date NOT NULL,
  `status` enum('belum_tercapai','tercapai') NOT NULL DEFAULT 'belum_tercapai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id`, `user_id`, `foto`, `judul`, `target_nominal`, `target_tanggal`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'tabungan/qwlYGMMRQLSgTZ2jjz32yQiKiUzzlrHeT8skoHqu.jpg', 'Biaya Pendidikan Anak', 1000000000.00, '2033-01-11', 'belum_tercapai', '2026-09-12 05:09:36', '2026-09-12 12:36:24'),
(4, 1, 'tabungan/8UpTLTyJLC4loNNccUwYd437cjCRMALJb63MeJ2E.jpg', 'Biaya Nikah', 500000000.00, '2033-08-13', 'belum_tercapai', '2026-09-12 12:32:00', '2026-09-12 12:32:00'),
(5, 1, NULL, 'Liburan', 1000000.00, '2026-09-14', 'tercapai', '2026-09-12 13:27:22', '2026-09-13 08:39:01'),
(6, 3, 'tabungan/7qtaQi7agDtpmSn0QFmkGAPoWrSYCTIqn26NcPaw.jpg', 'umrah', 50000000.00, '2026-09-17', 'tercapai', '2026-09-16 06:33:40', '2026-09-16 06:34:40'),
(7, 4, 'tabungan/27bblUtZ0eV53MzPNvRBiQcFpCESpE7UB6A241a6.jpg', 'Biaya Kuliah', 300000000.00, '2027-12-22', 'belum_tercapai', '2026-09-19 02:13:01', '2026-09-19 02:13:01'),
(8, 5, NULL, 'Beli laptop', 15000000.00, '2026-09-30', 'belum_tercapai', '2026-09-19 04:19:04', '2026-09-19 04:19:04'),
(9, 6, 'tabungan/zLllv1GzLDZ8AmSnMXWr5OcxbabRKPrzCbb7Ab4D.jpg', 'Biaya Sekolah Anak', 500000000.00, '2026-11-05', 'belum_tercapai', '2026-10-03 04:17:06', '2026-10-03 04:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan_kontributor`
--

CREATE TABLE `tabungan_kontributor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tabungan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('pemilik','kontributor') NOT NULL DEFAULT 'kontributor',
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `xp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `level` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `current_streak` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `last_activity_date` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `xp`, `level`, `current_streak`, `last_activity_date`, `email_verified_at`) VALUES
(1, 'Pengguna Demo', 'demo@tabungan.test', '$2y$12$NNpb2m/AbFziPcRNFKdW8Oktmlwq02HrnTPH34UrTVfeZJfPCHTSG', NULL, '2026-09-12 04:56:34', '2026-09-13 09:14:25', 155, 2, 1, '2026-09-13', NULL),
(3, 'MoveTea', 'move@gmail.com', '$2y$12$maDcG9A0zGeje7hsw1nd0unBKxKZbyKSf5Nov287qXr8kNABf0v.S', NULL, '2026-09-13 09:20:39', '2026-09-16 06:34:14', 95, 1, 1, '2026-09-16', NULL),
(4, 'Mufti Subhan Toha', 'ytp326784@gmail.com', '$2y$12$tNAMxXP52L2M1hGNwLalFeThNuAs86NuUyR0vh9rRtA2dJdpAnb7u', NULL, '2026-09-19 02:12:05', '2026-09-19 02:13:23', 35, 1, 1, '2026-09-19', NULL),
(5, 'Gazax', 'gazax@gmail.com', '$2y$12$Z1SpyIpq0Qs6ok6k8obGEuYxyaTKF/PGm3J5KFV7tTmKpcWp7eT6y', NULL, '2026-09-19 04:17:51', '2026-09-19 04:19:39', 35, 1, 1, '2026-09-19', NULL),
(6, '3', '3@gmail.com', '$2y$12$zDtJ8rih2fIht5p7EF4JN.vou2.jXTAe5HGpK.TWH.nWtf25h3/Zm', NULL, '2026-10-03 03:51:04', '2026-10-03 04:17:26', 35, 1, 1, '2026-10-03', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_tabungan_summary`
-- (See below for the actual view)
--
CREATE TABLE `v_tabungan_summary` (
`id` bigint(20) unsigned
,`user_id` bigint(20) unsigned
,`foto` varchar(255)
,`judul` varchar(150)
,`target_nominal` decimal(15,2)
,`target_tanggal` date
,`status` enum('belum_tercapai','tercapai')
,`nominal_terkumpul` decimal(37,2)
,`persentase_progress` decimal(43,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v_tabungan_summary`
--
DROP TABLE IF EXISTS `v_tabungan_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tabungan_summary`  AS SELECT `t`.`id` AS `id`, `t`.`user_id` AS `user_id`, `t`.`foto` AS `foto`, `t`.`judul` AS `judul`, `t`.`target_nominal` AS `target_nominal`, `t`.`target_tanggal` AS `target_tanggal`, `t`.`status` AS `status`, coalesce(sum(`m`.`nominal`),0) AS `nominal_terkumpul`, round(coalesce(sum(`m`.`nominal`),0) / `t`.`target_nominal` * 100,2) AS `persentase_progress` FROM (`tabungan` `t` left join `menabung` `m` on(`m`.`tabungan_id` = `t`.`id`)) GROUP BY `t`.`id`, `t`.`user_id`, `t`.`foto`, `t`.`judul`, `t`.`target_nominal`, `t`.`target_tanggal`, `t`.`status` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `badges_slug_unique` (`slug`);

--
-- Indexes for table `badge_user`
--
ALTER TABLE `badge_user`
  ADD PRIMARY KEY (`badge_id`,`user_id`),
  ADD KEY `badge_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_aktivitas_tabungan_id_foreign` (`tabungan_id`),
  ADD KEY `log_aktivitas_user_id_created_at_index` (`user_id`,`created_at`);

--
-- Indexes for table `menabung`
--
ALTER TABLE `menabung`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menabung_tabungan_id_foreign` (`tabungan_id`),
  ADD KEY `menabung_user_id_foreign` (`user_id`);

--
-- Indexes for table `menabung_payments`
--
ALTER TABLE `menabung_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menabung_payments_order_id_unique` (`order_id`),
  ADD KEY `menabung_payments_tabungan_id_foreign` (`tabungan_id`),
  ADD KEY `menabung_payments_user_id_status_index` (`user_id`,`status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_read_at_index` (`notifiable_type`,`notifiable_id`,`read_at`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tabungan_user_id_foreign` (`user_id`);

--
-- Indexes for table `tabungan_kontributor`
--
ALTER TABLE `tabungan_kontributor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tabungan_kontributor_tabungan_id_user_id_unique` (`tabungan_id`,`user_id`),
  ADD KEY `tabungan_kontributor_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `menabung`
--
ALTER TABLE `menabung`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `menabung_payments`
--
ALTER TABLE `menabung_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tabungan_kontributor`
--
ALTER TABLE `tabungan_kontributor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `badge_user`
--
ALTER TABLE `badge_user`
  ADD CONSTRAINT `badge_user_badge_id_foreign` FOREIGN KEY (`badge_id`) REFERENCES `badges` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `badge_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `log_aktivitas_tabungan_id_foreign` FOREIGN KEY (`tabungan_id`) REFERENCES `tabungan` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `log_aktivitas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menabung`
--
ALTER TABLE `menabung`
  ADD CONSTRAINT `menabung_tabungan_id_foreign` FOREIGN KEY (`tabungan_id`) REFERENCES `tabungan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menabung_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menabung_payments`
--
ALTER TABLE `menabung_payments`
  ADD CONSTRAINT `menabung_payments_tabungan_id_foreign` FOREIGN KEY (`tabungan_id`) REFERENCES `tabungan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menabung_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tabungan_kontributor`
--
ALTER TABLE `tabungan_kontributor`
  ADD CONSTRAINT `tabungan_kontributor_tabungan_id_foreign` FOREIGN KEY (`tabungan_id`) REFERENCES `tabungan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tabungan_kontributor_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
