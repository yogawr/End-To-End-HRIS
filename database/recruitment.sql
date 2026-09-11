-- Tumbakmas Recruitment database schema for MySQL/MariaDB/phpMyAdmin.
-- This replaces only the four recruitment tables in the selected database.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `job_applications`;
DROP TABLE IF EXISTS `candidate_profiles`;
DROP TABLE IF EXISTS `recruitment_jobs`;
DROP TABLE IF EXISTS `candidates`;

CREATE TABLE `candidates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'candidate',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidates_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `recruitment_jobs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `department` varchar(100) NOT NULL,
  `location` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `employment_type` varchar(30) NOT NULL DEFAULT 'full_time',
  `status` varchar(20) NOT NULL DEFAULT 'published',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `recruitment_jobs` (`title`, `department`, `location`, `description`, `employment_type`, `status`, `created_at`, `updated_at`) VALUES
('Area Sales Supervisor', 'sales', 'Madiun', 'Bertanggung jawab atas pencapaian target penjualan area, supervisi tim lapangan, dan penetrasi pasar regional.', 'full_time', 'published', NOW(), NOW()),
('Warehouse Supervisor', 'logistik', 'Sidoarjo', 'Mengelola inventaris, kontrol stok opname, penerapan budaya 5R gudang, serta ketaatan standar K3.', 'full_time', 'published', NOW(), NOW()),
('HRGA Officer', 'human', 'Semarang', 'Menangani rekrutmen end-to-end, pengelolaan fasilitas kantor, serta hubungan industrial karyawan.', 'full_time', 'published', NOW(), NOW());

CREATE TABLE `candidate_profiles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int unsigned NOT NULL,
  `full_name` varchar(150) DEFAULT NULL,
  `profile` longtext DEFAULT NULL,
  `cv_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `candidate_profiles_candidate_unique` (`candidate_id`),
  CONSTRAINT `candidate_profiles_candidate_fk` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `job_applications` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `candidate_id` int unsigned NOT NULL,
  `job_id` int unsigned NOT NULL,
  `cv_path` varchar(255) NOT NULL,
  `status` varchar(40) NOT NULL DEFAULT 'Menunggu seleksi',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_applications_candidate_job_unique` (`candidate_id`, `job_id`),
  CONSTRAINT `job_applications_candidate_fk` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE,
  CONSTRAINT `job_applications_job_fk` FOREIGN KEY (`job_id`) REFERENCES `recruitment_jobs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;