-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2024 at 04:53 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `validity` bigint DEFAULT NULL,
  `status` int DEFAULT NULL,
  `plan_category` int DEFAULT NULL,
  `configuration_type` int DEFAULT NULL,
  `allowed_material` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_genres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_department` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_subject` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allowed_publisher` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isFree` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_parent_category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `name`, `price`, `description`, `validity`, `status`, `plan_category`, `configuration_type`, `allowed_material`, `allowed_genres`, `allowed_department`, `allowed_subject`, `allowed_publisher`, `isFree`, `created_at`, `updated_at`, `plan_parent_category_id`) VALUES
(1, 'FREE', 0, 'Access to unlimited books', 7, 1, 1, NULL, '5', NULL, NULL, NULL, NULL, '1', NULL, NULL, 1),
(14, 'DAILY', 15, 'Access to unlimited books', 1, 1, 1, NULL, '5', NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(16, 'WEEKLY', 100, 'Access to unlimited books', 7, 1, 1, NULL, '5', NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(17, 'MONTHLY', 349, 'Access to unlimited books', 30, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(18, 'YEARLY', 3499, 'Access to unlimited books', 365, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(19, 'DAILY', 25, 'Access to premium content', 1, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(20, 'WEEKLY', 120, 'Access to premium content', 7, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(21, 'MONTHLY', 549, 'Access to premium content', 30, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(23, 'YEARLY', 5499, 'Access to premium content', 365, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1),
(24, 'MONTHLY', 549, 'Access to unlimited book, audio & video', 30, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2),
(25, 'YEARLY', 5499, 'Access to unlimited book, audio & video', 365, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2),
(26, 'MONTHLY', 549, 'Access to unlimited books, audio & video', 30, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2),
(27, 'YEARLY', 5499, 'Access to unlimited books, audio & video', 365, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2),
(28, 'MONTHLY', 549, 'Access to unlimited books, audio & video', 30, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3),
(29, 'YEARLY', 5499, 'Access to unlimited books, audio &video', 365, 1, 2, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
