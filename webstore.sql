-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3304
-- Generation Time: Dec 02, 2022 at 02:59 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `gender_id`, `created_at`, `updated_at`) VALUES
(1, 'Clothes', 'clothes', 0, '2022-11-29 14:41:28', '2022-11-29 14:41:28'),
(2, 'Shoes', 'shoes', 0, '2022-11-29 14:41:37', '2022-11-29 14:41:37'),
(3, 'Accessories', 'accessories', 0, '2022-11-29 14:41:57', '2022-11-29 14:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2021_08_10_154358_create_products_table', 1),
(7, '2021_08_11_121642_create_categories_table', 1),
(8, '2021_08_11_123859_create_subcategories_table', 1),
(9, '2021_08_11_164343_create_product_images_table', 1),
(10, '2021_08_21_160846_create_permission_tables', 1),
(11, '2021_09_02_200906_add_google_id_column_in_users_table', 1),
(12, '2021_09_04_230618_create_orders_table', 1),
(13, '2021_09_04_230634_create_order_products_table', 1),
(14, '2021_09_05_123007_add_status_column_in_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `surname`, `email`, `tel`, `additional_info`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Bohdan', 'Ponomarenko', 'bogdan.ponomarenko.777@gmail.com', '+380991164706', NULL, '2022-11-30 19:39:49', '2022-12-01 11:12:05', 1),
(2, 'Bohdan', 'Ponomarenko', 'bogdan.ponomarenko.777@gmail.com', '+380991164706', NULL, '2022-11-30 19:47:14', '2022-11-30 19:47:29', 1),
(3, 'Rich', 'Man', 'rich@man.com', '0000000000000000000', NULL, '2022-12-01 19:40:45', '2022-12-01 19:40:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `size` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` bigint DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `size`, `qty`, `product_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'S', 1, 1, 1, '2022-11-30 19:39:49', '2022-11-30 19:39:49'),
(2, 'XXL', 1, 1, 2, '2022-11-30 19:47:15', '2022-11-30 19:47:15'),
(3, 'XL', 2, 2, 2, '2022-11-30 19:47:15', '2022-11-30 19:47:15'),
(4, 'XL', 1, 3, 2, '2022-11-30 19:47:15', '2022-11-30 19:47:15'),
(5, 'XXL', 5, 1, 3, '2022-12-01 19:40:45', '2022-12-01 19:40:45'),
(6, 'XXL', 1, 4, 3, '2022-12-01 19:40:45', '2022-12-01 19:40:45'),
(7, 'XXL', 1, 9, 3, '2022-12-01 19:40:45', '2022-12-01 19:40:45'),
(8, 'XXL', 1, 7, 3, '2022-12-01 19:40:45', '2022-12-01 19:40:45'),
(9, 'XXL', 1, 8, 3, '2022-12-01 19:40:45', '2022-12-01 19:40:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_stock` tinyint(1) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subcategory_id` bigint UNSIGNED NOT NULL,
  `bought` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `in_stock`, `price`, `subcategory_id`, `bought`, `created_at`, `updated_at`) VALUES
(1, 'Regular fit short sleeve T-shirt with photo print', 'regular-fit-short-sleeve-t-shirt-with-photo-print', 'Model size: L\r\nModel height: 188 cm\r\nColour: Black', 1, '20.00', 2, 0, '2022-11-29 15:14:22', '2022-11-29 15:15:54'),
(2, 'Regular fit short sleeve T-shirt with an art print', 'regular-fit-short-sleeve-t-shirt-with-an-art-print', 'Model size: L\r\nModel height: 184 cm\r\nColour: White', 1, '25.00', 2, 0, '2022-11-30 19:41:28', '2022-11-30 19:41:28'),
(3, 'House of Dragons oversize boxy fit T-shirt', 'house-of-dragons-oversize-boxy-fit-t-shirt', 'Model size: L\r\nModel height: 188 cm\r\nColour: Black', 1, '45.00', 2, 0, '2022-11-30 19:44:10', '2022-11-30 19:44:10'),
(4, 'Parachute jeans', 'parachute-jeans', 'Model size: L\r\nModel height: 186 cm\r\nColour: Sand', 1, '50.00', 3, 0, '2022-12-01 11:16:47', '2022-12-01 11:16:47'),
(5, 'Oversize round neck House of Dragons sweatshirt', 'oversize-round-neck-house-of-dragons-sweatshirt', 'Model size: L\r\n\r\nModel height: 184 cm\r\n\r\nColour: Cream', 1, '49.00', 4, 0, '2022-12-01 11:19:57', '2022-12-01 11:19:57'),
(6, 'Round neck varsity print sweatshirt', 'round-neck-varsity-print-sweatshirt', 'Model size: L\r\n\r\nModel height: 187 cm\r\n\r\nColour: Brown', 1, '30.00', 4, 0, '2022-12-01 11:23:15', '2022-12-01 11:23:15'),
(7, 'Round neck printed sweatshirt', 'round-neck-printed-sweatshirt', 'Model size: L\r\n\r\nModel height: 184 cm\r\n\r\nColour: Brown', 1, '33.00', 4, 0, '2022-12-01 11:24:45', '2022-12-01 11:25:03'),
(8, 'Oversized printed sweatshirt', 'oversized-printed-sweatshirt', 'Model size: L\r\n\r\nModel height: 183 cm\r\n\r\nColour: Grey', 1, '33.00', 4, 0, '2022-12-01 11:26:15', '2022-12-01 11:26:29'),
(9, 'Men’s contrast mesh chunky trainers', 'mens-contrast-mesh-chunky-trainers', 'Colour: WHITE\r\n\r\nSTARFIT®. Flexible technical polyurethane foam insole, designed to offer greater comfort.\r\n\r\nContrast trainers with mesh detail. Chunky sole.', 1, '99.00', 6, 0, '2022-12-01 11:30:19', '2022-12-01 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `img`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'uploads/3eQcoK7WLHP79TfqxvyzSFAkgrqIsv1k9JgRXp5K.webp', 1, '2022-11-30 19:18:41', '2022-11-30 19:18:41'),
(2, 'uploads/7syyxzBZxChkMmDQpnplAKnQFfh361PqHfXYqmjX.webp', 1, '2022-11-30 19:19:17', '2022-11-30 19:19:17'),
(4, 'uploads/gJc3l4ZKWlugTWzqgw92lPTyvMWtVXWjJ82zremt.webp', 1, '2022-11-30 19:19:51', '2022-11-30 19:19:51'),
(5, 'uploads/WQHzrNI5WYq949LjaO6EOlS0F3lkkzPmRxVQTywN.webp', 1, '2022-11-30 19:19:51', '2022-11-30 19:19:51'),
(6, 'uploads/df8BkX81U6aLM45yvnkAIuXCMYC0QHFzR59AYpuY.webp', 1, '2022-11-30 19:19:51', '2022-11-30 19:19:51'),
(7, 'uploads/0Dh9sT0P7jzKThNKHSx2wU5yviuFPTRGCnFIgXpp.webp', 2, '2022-11-30 19:41:28', '2022-11-30 19:41:28'),
(8, 'uploads/H6jk5Gv56T7ybiq92agnQnPydXl4XEMS92xhfEBY.webp', 2, '2022-11-30 19:41:28', '2022-11-30 19:41:28'),
(9, 'uploads/kbWMzsaMECygs4T6TlgRJGJBvQE9DjYfmTHllvUk.webp', 2, '2022-11-30 19:41:28', '2022-11-30 19:41:28'),
(10, 'uploads/cKBVbtaD6h6KfQ1L2bUOK5dpiazsCSfamF1f5l33.webp', 2, '2022-11-30 19:41:28', '2022-11-30 19:41:28'),
(11, 'uploads/ceetyrMQE6OTge50OwTJU0JrqNCD1AvE7mo7Wb0V.webp', 2, '2022-11-30 19:41:28', '2022-11-30 19:41:28'),
(12, 'uploads/6pAIx2TraG3ddPQ7FNSbKt8tp3N5mBskne5reKx2.webp', 3, '2022-11-30 19:44:10', '2022-11-30 19:44:10'),
(13, 'uploads/sJGVjDPMZRNHqqA17qipLAL7fQuIMKeFSbqMnXps.webp', 3, '2022-11-30 19:44:10', '2022-11-30 19:44:10'),
(14, 'uploads/Pr6r7aTaLlz0W5Num0wBFObgj9hb9VF1bcDl3LVI.webp', 3, '2022-11-30 19:44:10', '2022-11-30 19:44:10'),
(15, 'uploads/sFzROgEdsdOFBjOvayurGpGmttjenDSA5T64DgmS.webp', 3, '2022-11-30 19:44:10', '2022-11-30 19:44:10'),
(16, 'uploads/XFxYrzUbgivNLklKKuIp7xdrDDnw4Biayxp3x4QP.webp', 3, '2022-11-30 19:44:10', '2022-11-30 19:44:10'),
(17, 'uploads/rXdeWypR5g9KgxhoeQHdcCNVdjvyIIUhJkPXG0l3.webp', 4, '2022-12-01 11:16:47', '2022-12-01 11:16:47'),
(18, 'uploads/5WHJpvVyDB9wqFD5N8o1yk3aUo4EuDSUSPiBHJNy.webp', 4, '2022-12-01 11:16:47', '2022-12-01 11:16:47'),
(19, 'uploads/DF1lefuADZfqZJ2yxE28G7FHyDp85Ej0728e8oBN.webp', 4, '2022-12-01 11:16:47', '2022-12-01 11:16:47'),
(20, 'uploads/daxCWUEIJQzjZjiOsjhGnCpz0cr8oeWNfTkJ7AIR.webp', 4, '2022-12-01 11:16:47', '2022-12-01 11:16:47'),
(21, 'uploads/3mi4Gs4PSp5n1rNWSpAVVgOiYncfAnbeNERlktIi.jpg', 4, '2022-12-01 11:16:47', '2022-12-01 11:16:47'),
(22, 'uploads/IlM9WuJlXF1UV87UM2Xkln6G4o6nLv4PqB9piDLY.webp', 5, '2022-12-01 11:19:57', '2022-12-01 11:19:57'),
(23, 'uploads/9gQd5l2oYFgZtni2QAjG6qz3tnNCBk2YxLUfPxvQ.webp', 5, '2022-12-01 11:19:57', '2022-12-01 11:19:57'),
(24, 'uploads/Y1q72nhpXne3FjVJkLaDa8D108Aanxfwxks0SN90.webp', 5, '2022-12-01 11:19:57', '2022-12-01 11:19:57'),
(25, 'uploads/RzfvCOOzbDQbWHThUwX5qhhrBtSfMgw5r4Ms9U7s.webp', 6, '2022-12-01 11:23:15', '2022-12-01 11:23:15'),
(26, 'uploads/WHCLqHqw9fRStp7TrmUi4dMrFZgPUkkYrD79tKLS.webp', 6, '2022-12-01 11:23:15', '2022-12-01 11:23:15'),
(27, 'uploads/EHGpVFucJcW0rkk0B9gbUQmdaz4XhBa8l4RjEO35.webp', 6, '2022-12-01 11:23:15', '2022-12-01 11:23:15'),
(28, 'uploads/3YXJCvJUx10yIkn7lJbyykx3BsIqILNwwb2d6B6w.webp', 7, '2022-12-01 11:24:45', '2022-12-01 11:24:45'),
(29, 'uploads/inB08a4EmGixNsoOdqguJc3gesKQAo9UH5bixhps.webp', 7, '2022-12-01 11:24:45', '2022-12-01 11:24:45'),
(30, 'uploads/WH3oS5NSO5nWDhMIZVXv3rs5xOtOXn2TLfMDWTpn.webp', 7, '2022-12-01 11:24:45', '2022-12-01 11:24:45'),
(31, 'uploads/HRbfmoR0rNY5jjjN5Q9gMENiMgNpaSlUTAvod3Lb.webp', 8, '2022-12-01 11:26:15', '2022-12-01 11:26:15'),
(32, 'uploads/UdUMymt1SJEtEOFBN0k1SBAZJqjzsPDQQnQ4qujQ.webp', 8, '2022-12-01 11:26:15', '2022-12-01 11:26:15'),
(33, 'uploads/PgAmOFzW2lj0AnkMm62eSLsVDmXCjQbmUVDPuV91.webp', 8, '2022-12-01 11:26:15', '2022-12-01 11:26:15'),
(34, 'uploads/93170oB15HwfIXWtV1Bkp3CCUZGKLxuQm9USO144.jpg', 9, '2022-12-01 11:30:19', '2022-12-01 11:30:19'),
(35, 'uploads/sFCiR5CJdiOkuwB8p0lWp9IZjJODON5GDv39w1eh.webp', 9, '2022-12-01 11:30:19', '2022-12-01 11:30:19'),
(36, 'uploads/595Wdkb9n8JNHYrNbhphGDvKeYXMlraJjYGfh3Bh.webp', 9, '2022-12-01 11:30:19', '2022-12-01 11:30:19'),
(37, 'uploads/9QEhTKc9ls4QCd40YD5ztFAzyAckkin3P7EUtyIN.webp', 9, '2022-12-01 11:30:19', '2022-12-01 11:30:19'),
(38, 'uploads/0imVJWU8XIQA4hauaPk0jxIJ9ZWeI3iam6W8UHA7.webp', 9, '2022-12-01 11:30:19', '2022-12-01 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'user', 'web', '2022-11-29 14:34:58', '2022-11-29 14:34:58'),
(2, 'admin', 'web', '2022-11-29 14:35:24', '2022-11-29 14:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `title`, `slug`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'T-Shirts', 't-shirts', 1, '2022-11-29 14:42:43', '2022-11-29 14:42:43'),
(3, 'Jeans', 'jeans', 1, '2022-11-29 14:42:56', '2022-11-29 14:42:56'),
(4, 'Sweatshirts', 'sweatshirts', 1, '2022-11-29 15:01:22', '2022-11-29 15:01:22'),
(5, 'Trainers', 'trainers', 2, '2022-11-29 15:02:19', '2022-11-29 15:02:19'),
(6, 'Sneakers', 'sneakers', 2, '2022-11-29 15:02:30', '2022-11-29 15:03:13'),
(7, 'Sandals', 'sandals', 2, '2022-11-29 15:02:42', '2022-11-29 15:03:19'),
(8, 'Belts', 'belts', 3, '2022-11-29 15:04:27', '2022-11-29 15:04:27'),
(9, 'Jewellery', 'jewellery', 3, '2022-11-29 15:04:47', '2022-11-29 15:04:47'),
(10, 'Socks', 'socks', 3, '2022-11-29 15:04:55', '2022-11-29 15:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `img`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `google_id`) VALUES
(2, 'Bohdan', NULL, NULL, NULL, 'bogdan.ponomarenko.777@gmail.com', NULL, 'eyJpdiI6IityZDNhL29KY1hRUUJNZjZDYXJWL1E9PSIsInZhbHVlIjoiTjhobkxjaGhhVkU3MThrdFJFTmdUQT09IiwibWFjIjoiMzBiNzQyNTUzNmFmYTNkMjllMTA0NjQ0OGZkOTMxMmZmNjJhNTVmNGQyOGY1ZmZhOGM2YTFkYmIwOGIwZmQ1NCIsInRhZyI6IiJ9', NULL, NULL, NULL, '2022-11-29 12:27:45', '2022-11-29 12:27:45', '102349361282053889906'),
(4, 'admin', NULL, NULL, 'uploads/VN8rUUVvLjv1gs5weNZIkCuvJaHiAQtofMzxqXXs.png', 'admin@gmail.com', NULL, '$2y$10$00pE/YcpiH8SLa2puR6h6uFdNHzzn.ubwTUHGtb2dOjAeOtdc7AWa', NULL, NULL, NULL, '2022-11-29 14:39:38', '2022-12-01 19:36:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
