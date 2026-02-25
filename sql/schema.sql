-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Feb 2026 pada 07.13
-- Versi server: 8.0.42
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;

--
-- Database: `meeting_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
    `id` bigint UNSIGNED NOT NULL,
    `admin_id` bigint UNSIGNED NOT NULL,
    `user_id` bigint UNSIGNED NOT NULL,
    `room_id` bigint UNSIGNED NOT NULL,
    `start_time` datetime NOT NULL,
    `end_time` datetime NOT NULL,
    `purpose` varchar(255) DEFAULT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
    `id` bigint UNSIGNED NOT NULL,
    `owner_admin_id` bigint UNSIGNED NOT NULL,
    `name` varchar(120) NOT NULL,
    `capacity` int NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `wallpaper_url` text
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
    `id` bigint UNSIGNED NOT NULL,
    `owner_admin_id` bigint UNSIGNED DEFAULT NULL,
    `name` varchar(150) NOT NULL,
    `email` varchar(190) NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `role` enum('superadmin', 'admin', 'user') NOT NULL,
    `plan_type` enum('trial', 'permanent') DEFAULT NULL,
    `trial_end` datetime DEFAULT NULL,
    `paid_until` datetime DEFAULT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO
    `users` (
        `id`,
        `owner_admin_id`,
        `name`,
        `email`,
        `password_hash`,
        `role`,
        `plan_type`,
        `trial_end`,
        `paid_until`,
        `created_at`
    )
VALUES (
        1,
        NULL,
        'Super Admin',
        'super@fcom.com',
        '$2a$12$IY31QnMgDLpVbraBQBoE/OuVdQP4Tn6PjwlT.20oSqjALmb3jf/Ri',
        'superadmin',
        'permanent',
        NULL,
        NULL,
        '2026-02-25 13:12:38'
    );

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
ADD PRIMARY KEY (`id`),
ADD KEY `idx_bookings_admin` (`admin_id`),
ADD KEY `idx_bookings_room_time` (
    `room_id`,
    `start_time`,
    `end_time`
),
ADD KEY `idx_bookings_user` (`user_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `uq_rooms_name` (`name`),
ADD KEY `idx_rooms_owner` (`owner_admin_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `uq_users_email` (`email`),
ADD KEY `idx_users_role` (`role`),
ADD KEY `idx_users_owner` (`owner_admin_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
ADD CONSTRAINT `fk_bookings_admin` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_bookings_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rooms`
--
ALTER TABLE `rooms`
ADD CONSTRAINT `fk_rooms_owner_admin` FOREIGN KEY (`owner_admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `fk_users_owner_admin` FOREIGN KEY (`owner_admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;