-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2025 pada 10.03
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms_angkatan_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `education` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instructors`
--

INSERT INTO `instructors` (`id`, `id_role`, `name`, `gender`, `education`, `phone`, `email`, `password`, `address`, `created_at`, `updated_at`) VALUES
(4, 4, 'Aldo Rio prayoga', 1, 'S1', '0813', 'alprayoga@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Bekasi', '2025-06-05 04:02:52', '2025-06-11 01:57:24'),
(5, 0, 'Budi Astaman', 1, 'S2', '0812', 'budi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Bekut', '2025-06-10 07:24:02', NULL),
(6, 0, 'Cole Palmer', 1, 'Harvard', '0899', 'cole@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'london', '2025-06-10 07:52:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `instructors_majors`
--

CREATE TABLE `instructors_majors` (
  `id` int(11) NOT NULL,
  `id_majors` int(11) NOT NULL,
  `id_instructors` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `instructors_majors`
--

INSERT INTO `instructors_majors` (`id`, `id_majors`, `id_instructors`, `created_at`, `updated_at`) VALUES
(6, 5, 3, '2025-06-04 07:50:02', NULL),
(9, 7, 1, '2025-06-05 02:07:56', NULL),
(10, 6, 1, '2025-06-05 02:07:59', NULL),
(11, 8, 1, '2025-06-05 02:08:49', NULL),
(13, 4, 0, '2025-06-05 02:09:33', NULL),
(17, 7, 1, '2025-06-05 02:15:02', NULL),
(21, 8, 1, '2025-06-05 02:33:40', NULL),
(28, 7, 1, '2025-06-05 02:43:20', '2025-06-05 02:45:00'),
(30, 7, 4, '2025-06-05 07:30:23', NULL),
(31, 8, 4, '2025-06-05 07:37:47', NULL),
(32, 5, 5, '2025-06-10 07:25:18', NULL),
(33, 6, 5, '2025-06-10 07:25:23', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `majors`
--

CREATE TABLE `majors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `majors`
--

INSERT INTO `majors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Mobile Programming', '2025-06-04 04:33:24', NULL),
(5, 'Sastra Jepang', '2025-06-04 07:32:50', NULL),
(6, 'Sastra Korea', '2025-06-04 07:32:57', NULL),
(7, 'Web Programming', '2025-06-04 07:33:05', '2025-06-04 07:33:12'),
(8, 'DKV', '2025-06-04 07:33:18', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(5) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `icon`, `url`, `urutan`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'bi bi-grid', 'home.php', 1, '2025-06-11 04:21:53', '2025-06-11 04:38:02'),
(2, 0, 'Master Data', 'bi bi-menu-button-wide', '', 2, '2025-06-11 04:28:52', '2025-06-11 04:38:06'),
(3, 0, 'Modul', 'bi bi-book', '?page=moduls', 3, '2025-06-11 04:29:59', '2025-06-11 05:14:54'),
(5, 2, 'Instructors', 'bi bi-circle', 'instructors', 1, '2025-06-11 04:31:00', '2025-06-11 04:38:15'),
(6, 2, 'Majors', 'bi bi-circle', 'majors', 2, '2025-06-11 04:31:24', '2025-06-11 04:38:18'),
(8, 2, 'Menu', 'bi bi-circle', 'menu', 3, '2025-06-11 04:32:38', '2025-06-11 04:38:21'),
(9, 2, 'Roles', 'bi bi-circle', 'roles', 4, '2025-06-11 04:33:00', '2025-06-11 04:38:24'),
(10, 2, 'Users', 'bi bi-circle', 'user', 5, '2025-06-11 04:33:20', '2025-06-11 04:38:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `moduls`
--

CREATE TABLE `moduls` (
  `id` int(11) NOT NULL,
  `id_majors` int(11) NOT NULL,
  `id_instructors` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `moduls`
--

INSERT INTO `moduls` (`id`, `id_majors`, `id_instructors`, `name`, `created_at`, `updated_at`) VALUES
(15, 7, 4, 'CSS file', '2025-06-10 02:54:43', NULL),
(23, 8, 4, 'Materi DKV', '2025-06-10 04:25:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `moduls_details`
--

CREATE TABLE `moduls_details` (
  `id` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `moduls_details`
--

INSERT INTO `moduls_details` (`id`, `id_modul`, `file`, `created_at`, `updated_at`) VALUES
(9, 23, '6847b3cea5cfc-Sistem Informasi Manajemen Modul Pelatihan.docx.pdf', '2025-06-10 04:25:50', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Admin', '2025-06-04 01:59:36', '2025-06-11 01:19:26'),
(3, 'PIC', '2025-06-11 01:20:35', NULL),
(4, 'Instructors', '2025-06-11 01:20:51', NULL),
(5, 'Administrators', '2025-06-11 01:20:56', NULL),
(6, 'Students', '2025-06-11 01:22:28', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_majors` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `education` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `id_majors`, `name`, `gender`, `education`, `phone`, `email`, `password`, `address`, `created_at`, `updated_at`) VALUES
(1, 0, 'Aldo', 0, 'S1', '0813', 'aldo@gmail.com', '', 'Bekasi', '2025-06-03 07:38:12', NULL),
(3, 7, 'siswa', 1, 'S1', '0856', 'siswa@gmail.com', '123456', 'Jakarta', '2025-06-03 08:15:51', '2025-06-10 07:48:26'),
(4, 0, 'Aldo Rio prayoga', 1, 'S1', '0813', 'alprayoga@gmail.com', 'e1294892bc74e2ef72b7a1761c9d0c41b25057cb', 'Bekasi', '2025-06-05 04:02:52', '2025-06-05 04:04:35'),
(5, 7, 'Budi Astaman', 1, 'S2', '0812', 'budi@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Bekut', '2025-06-10 07:24:02', '2025-06-10 07:54:40'),
(6, 7, 'Rio', 0, 'Sistem Informasi', '0857', 'rio@gmail.com', '123456', 'Bektim', '2025-06-10 07:49:46', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aldo', 'admin@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '2025-06-03 02:51:33', '2025-06-04 01:40:35', 0),
(2, 'Rio', 'rio@gmail.com', '123456', '2025-06-03 06:47:04', '2025-06-03 07:04:30', 1),
(3, 'Reihan1', 'reihan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2025-06-03 07:17:29', '2025-06-04 02:17:39', 0),
(4, 'Aldo Rio', 'aldorio12@gmail.com', 'e1294892bc74e2ef72b7a1761c9d0c41b25057cb', '2025-06-04 02:35:03', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instructors_majors`
--
ALTER TABLE `instructors_majors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `moduls`
--
ALTER TABLE `moduls`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `moduls_details`
--
ALTER TABLE `moduls_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `instructors_majors`
--
ALTER TABLE `instructors_majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `majors`
--
ALTER TABLE `majors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `moduls`
--
ALTER TABLE `moduls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `moduls_details`
--
ALTER TABLE `moduls_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
