-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 11:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `st_inv_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cate_name` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cate_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Tea', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `deliver_status` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `date_time`, `message`, `sender_id`, `receiver_id`, `deliver_status`, `created_at`, `updated_at`) VALUES
(16, '2023-12-06 02:58 AM', 'DDDDD', 3, 2, 0, '2023-12-05 21:28:26', '2023-12-05 21:28:26'),
(17, '2023-12-06 02:58 AM', 'asdasdad', 2, 3, 0, '2023-12-05 21:28:29', '2023-12-05 21:28:29'),
(18, '2023-12-06 02:58 AM', 'ADDFF', 2, 3, 0, '2023-12-05 21:28:38', '2023-12-05 21:28:38'),
(19, '2023-12-06 03:17 AM', 'd', 2, 3, 0, '2023-12-05 21:47:21', '2023-12-05 21:47:21'),
(20, '2023-12-06 04:01 AM', 'Desaha', 2, 3, 0, '2023-12-05 22:31:48', '2023-12-05 22:31:48'),
(21, '2023-12-06 04:02 AM', 'asdasdasd', 2, 3, 0, '2023-12-05 22:32:02', '2023-12-05 22:32:02'),
(22, '2023-12-06 04:02 AM', 'asdasd', 2, 3, 0, '2023-12-05 22:32:05', '2023-12-05 22:32:05'),
(23, '2023-12-06 04:02 AM', 'asdasd', 2, 3, 0, '2023-12-05 22:32:07', '2023-12-05 22:32:07'),
(24, '2023-12-06 04:02 AM', 'asdasd', 2, 3, 0, '2023-12-05 22:32:11', '2023-12-05 22:32:11'),
(25, '2023-12-06 04:05 AM', 'Pramodya Deshan', 2, 3, 0, '2023-12-05 22:35:09', '2023-12-05 22:35:09'),
(26, '2023-12-06 04:06 AM', 'Hello', 1, 2, 0, '2023-12-05 22:36:21', '2023-12-05 22:36:21'),
(27, '2023-12-06 04:15 AM', 'Pramodya', 1, 3, 0, '2023-12-05 22:45:53', '2023-12-05 22:45:53'),
(28, '2023-12-06 04:28 AM', 'ADD', 1, 2, 0, '2023-12-05 22:58:24', '2023-12-05 22:58:24'),
(29, '2023-12-06 04:32 AM', 'sdfsdfsdf', 1, 2, 0, '2023-12-05 23:02:44', '2023-12-05 23:02:44'),
(30, '2023-12-06 04:39 AM', 'Deshan', 2, 1, 0, '2023-12-05 23:09:23', '2023-12-05 23:09:23'),
(31, '2023-12-06 04:43 AM', 'asdasdasdasd', 2, 3, 0, '2023-12-05 23:13:38', '2023-12-05 23:13:38'),
(32, '2023-12-06 04:43 AM', 'XXXXXXXXXXX', 2, 3, 0, '2023-12-05 23:13:44', '2023-12-05 23:13:44'),
(33, '2023-12-06 04:48 AM', 'asdasdasd', 3, 2, 0, '2023-12-05 23:18:18', '2023-12-05 23:18:18'),
(34, '2023-12-06 04:48 AM', 'Heloooo', 1, 2, 0, '2023-12-05 23:18:46', '2023-12-05 23:18:46'),
(35, '2023-12-06 05:25 AM', 'asdasdasd', 2, 1, 0, '2023-12-05 23:55:53', '2023-12-05 23:55:53'),
(36, '2023-12-06 05:31 AM', 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', 1, 2, 0, '2023-12-06 00:01:00', '2023-12-06 00:01:00'),
(37, '2023-12-06 05:35 AM', 'Pramodya Deshan', 2, 1, 0, '2023-12-06 00:05:12', '2023-12-06 00:05:12'),
(38, '2023-12-06 05:36 AM', 'adasd', 2, 1, 0, '2023-12-06 00:06:41', '2023-12-06 00:06:41'),
(39, '2023-12-06 05:37 AM', 'CRRR', 1, 2, 0, '2023-12-06 00:07:31', '2023-12-06 00:07:31'),
(40, '2023-12-06 10:14 AM', 'DEshan', 1, 2, 0, '2023-12-06 04:44:28', '2023-12-06 04:44:28');

-- --------------------------------------------------------

--
-- Table structure for table `chat_bots`
--

CREATE TABLE `chat_bots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conferences`
--

CREATE TABLE `conferences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `unread` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conferences`
--

INSERT INTO `conferences` (`id`, `title`, `link`, `unread`, `status`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mercilin Pathirana', 'https://www.youtube.com/watch?v=5kG6V_0eGBc', 0, 1, 1, 1, '2023-12-07 21:35:29', '2023-12-07 21:11:10'),
(2, 'Roy Peris', 'https://www.youtube.com/watch?v=Rw-RbmG8t8s', 0, 1, 1, 1, '2023-12-07 23:35:29', '2023-12-07 21:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_name` varchar(255) DEFAULT NULL,
  `state_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `division_name`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Test Division', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `price` double(16,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `date`, `note`, `price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-01-02', 'Internet Bill', 8500.00, 1, NULL, NULL);

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
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `price` double(16,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `date`, `note`, `price`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2024-01-01', 'Sell a laptop', 32500.00, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media_files`
--

CREATE TABLE `media_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(255) NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_files`
--

INSERT INTO `media_files` (`id`, `file_name`, `file_type`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1701108595.png', 'image/png', 0, NULL, NULL, NULL),
(2, '1701985798.jpg', 'image/jpeg', 1, NULL, '2023-12-07 21:49:59', '2023-12-07 21:49:59'),
(3, '1701985799.jpg', 'image/jpeg', 1, NULL, '2023-12-07 21:49:59', '2023-12-07 21:49:59'),
(7, '1701985801.jpg', 'image/jpeg', 1, NULL, '2023-12-07 21:50:01', '2023-12-07 21:50:01'),
(8, '1701985819.jpg', 'image/jpeg', 1, NULL, '2023-12-07 21:50:19', '2023-12-07 21:50:19'),
(9, '1701985826.jpg', 'image/jpeg', 1, NULL, '2023-12-07 21:50:26', '2023-12-07 21:50:26'),
(10, '1701985834.jpg', 'image/jpeg', 1, NULL, '2023-12-07 21:50:34', '2023-12-07 21:50:34');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_23_223944_create_user_roles_table', 1),
(7, '2023_11_24_212249_create_categories_table', 1),
(8, '2023_11_25_083905_create_media_files_table', 1),
(9, '2023_11_27_090129_create_products_table', 1),
(10, '2023_11_29_174948_create_divisions_table', 1),
(11, '2023_11_29_174959_create_states_table', 1),
(12, '2023_11_29_235021_create_system_settings_table', 1),
(13, '2023_11_30_020202_create_incomes_table', 1),
(14, '2023_11_30_020226_create_expenditures_table', 1),
(15, '2023_12_02_045021_create_stocks_table', 1),
(16, '2023_12_04_173827_create_chat_bots_table', 2),
(17, '2023_12_05_022307_create_permissions_table', 2),
(18, '2023_12_06_012644_create_chats_table', 3),
(23, '2023_12_06_114133_create_conferences_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `isActive` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `menu_name`, `menu_id`, `isActive`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Menu 01', 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `buy_price` double(8,2) NOT NULL,
  `sell_price` double(8,2) NOT NULL,
  `manu_date` varchar(255) DEFAULT NULL,
  `exp_date` varchar(255) DEFAULT NULL,
  `isActive` tinyint(3) UNSIGNED NOT NULL,
  `cate_id` varchar(255) NOT NULL,
  `img_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `qty`, `buy_price`, `sell_price`, `manu_date`, `exp_date`, `isActive`, `cate_id`, `img_id`, `user_id`, `division_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Ceylon Tea', 20, 100.00, 120.00, '2023-09-30', '2024-01-01', 1, '1', '1', '2', 1, NULL, NULL, '2023-12-07 21:48:39'),
(10, 'Green Tea - Packet 10', 9, 400.00, 450.00, '2023-12-06', '2024-01-06', 1, '1', '1', '2', 1, NULL, '2023-12-05 19:02:32', '2023-12-06 07:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state_name`, `created_at`, `updated_at`) VALUES
(1, 'Test State', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) NOT NULL,
  `price` double(16,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` double(16,2) NOT NULL,
  `division_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `date`, `price`, `qty`, `total`, `division_id`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '2023-12-01', 100.00, 2, 200.00, 1, 1, 2, NULL, NULL),
(25, '2023-12-06', 450.00, 1, 450.00, 1, 10, 1, '2023-12-05 19:27:49', '2023-12-05 19:27:49'),
(26, '2023-12-06', 450.00, 2, 900.00, 1, 10, 2, '2023-12-06 07:28:40', '2023-12-06 07:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `footer_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `title`, `logo`, `footer_title`, `created_at`, `updated_at`) VALUES
(1, 'Inventory System', '1701108595.png', '© 2023 Your Company Name. All rights reserved.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `state_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`state_id`)),
  `current_state` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unread_message` bigint(20) NOT NULL,
  `msg_sender_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `status`, `role_id`, `image`, `state_id`, `current_state`, `remember_token`, `created_at`, `updated_at`, `unread_message`, `msg_sender_id`) VALUES
(1, 'Super Admin', 'super', '$2y$12$D1BrxmAh0h525C7b3dKVqe268Xf3UWMCwhf92biAnZhLYrge68AWK', 1, 1, '1701108377.png', '[\"1\"]', 1, '', NULL, '2023-12-07 21:47:43', 0, 2),
(2, 'Admin', 'admin', '$2y$12$RqPO2QuQM8aJ.UQO9pB.6efPwyeFyxL.KTjrVO2nhpwrIrXYGEJ8q', 1, 2, '1701108377.png', '[\"1\"]', 1, '', NULL, '2023-12-06 06:42:15', 0, 1),
(3, 'Employee', 'emp', '$2y$12$J2thnQxqKXZgZhWeyJ6JFelmOQ30fZFj.VIF4u9Sc/sKbVLVSSMmu', 1, 3, '1701108377.png', '[\"1\"]', 1, '', NULL, '2023-12-06 06:42:07', 0, 2),
(5, 'XXXXX', 'aaa', '$2y$12$95/x.Mb90aeLRwpq9fOl5Otc2fgjkBlRsPdklAfFGG8xGfihudJK6', 1, 2, NULL, '[\"1\"]', 1, NULL, '2023-12-06 05:43:02', '2023-12-06 06:41:59', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `group_level` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `group_level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 0, 1, NULL, NULL),
(2, 'Admin', 1, 1, NULL, NULL),
(3, 'Employee', 2, 1, NULL, '2023-12-05 16:23:47'),
(4, 'AAA', 2, 1, '2023-12-05 16:28:02', '2023-12-05 16:28:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_bots`
--
ALTER TABLE `chat_bots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conferences`
--
ALTER TABLE `conferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `chat_bots`
--
ALTER TABLE `chat_bots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conferences`
--
ALTER TABLE `conferences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media_files`
--
ALTER TABLE `media_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
