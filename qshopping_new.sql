-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 10:03 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qshopping_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `customer_id`, `address`, `country_id`, `city`, `zip`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'house no 100', 0, 'lahore', '54000', 'Pakistan', 'Inactive', '2021-11-13 12:03:22', '2021-11-13 12:04:47'),
(2, 2, 'house no 3', 0, 'shadara lahore', '54000', 'Pakistan', 'Active', '2021-11-13 12:03:46', '2021-11-13 12:04:13'),
(3, 7, 'shadar lahore', 0, 'lahore', '5400', 'Pakistan', 'Active', '2021-11-14 07:21:36', '2021-11-14 07:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `type`, `status`, `order`, `created_at`, `updated_at`) VALUES
(1, 'slider_1', 'sliders', 1, 1, '2021-11-08 15:36:47', '2021-11-08 15:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `category_order` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `update_by` int(10) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `account_id`, `parent_id`, `level`, `category_order`, `name`, `slug`, `short_description`, `created_by`, `update_by`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 1, 'Fashion', 'fashion', 'Added By default', 1, 1, 1, '2021-11-08 15:37:40', '2021-11-08 15:37:40'),
(2, 1, NULL, NULL, NULL, 'Toys', 'Toys', 'asd fsad as', 1, NULL, 1, '2021-11-10 14:02:00', '2021-11-10 14:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `account_id`, `name`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Green', 'Green', 1, '2021-11-08 15:38:01', '2021-11-08 15:38:01'),
(2, 1, 'Black', 'Black', 1, '2021-11-08 15:38:01', '2021-11-08 15:38:01'),
(3, 1, 'Blue', 'Blue', 1, '2021-11-08 15:38:01', '2021-11-08 15:38:01'),
(4, 1, 'Red', 'Red', 1, '2021-11-08 15:38:01', '2021-11-08 15:38:01'),
(5, 1, 'Orange', 'Orange', 1, '2021-11-08 15:38:01', '2021-11-08 15:38:01'),
(6, 1, 'Gray', 'Gray', 1, '2021-11-08 15:38:01', '2021-11-08 15:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(255) NOT NULL,
  `amount` double NOT NULL,
  `minimum_amount` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `account_id`, `code`, `type`, `amount`, `minimum_amount`, `quantity`, `expired_date`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'sign_20', 1, 20, 5000, 3, '2022-05-31', 7, 1, '2021-11-14 05:49:29', '2021-11-14 05:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_types`
--

CREATE TABLE `coupon_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `coupon_types`
--

INSERT INTO `coupon_types` (`id`, `account_id`, `name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sign Up coupon', 1, NULL, NULL),
(2, 1, 'Coupon for total price', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `products_alert_quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sign_up_discount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `account_id`, `site_title`, `date_format`, `currency`, `products_alert_quantity`, `comission`, `created_at`, `updated_at`, `sign_up_discount`) VALUES
(1, 1, 'qShopping', 'yyyy-mm-dd', 'pkr', '3', '3', '2021-11-13 17:37:46', '2021-11-13 17:37:46', '15');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `model_id`, `model_type`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Banner', 'slider1.jpg', '2021-11-08 15:36:47', '2021-11-08 15:36:47'),
(2, 4, 'App\\Models\\ProductVariant', 'shoes.jpg', '2021-11-08 15:45:38', '2021-11-08 15:45:38'),
(3, 2, 'App\\Models\\Category', 'h1GF9AFGC6.jpg', '2021-11-10 14:02:00', '2021-11-10 14:02:00'),
(4, 5, 'App\\Models\\ProductVariant', 'IWh2eHi0Iy.jpg', '2021-11-10 14:08:30', '2021-11-10 14:08:30'),
(5, 6, 'App\\Models\\ProductVariant', 'q48SvabING.jpg', '2021-11-10 14:08:30', '2021-11-10 14:08:30'),
(6, 6, 'App\\Models\\ProductVariant', 'QjvfvZ9Rk7.jpg', '2021-11-10 14:08:30', '2021-11-10 14:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `logs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_19_200225_create_categories_table', 1),
(5, '2021_08_19_200305_create_products_table', 1),
(6, '2021_08_19_200341_create_orders_table', 1),
(7, '2021_08_19_200401_create_coupons_table', 1),
(8, '2021_08_19_200411_create_logs_table', 1),
(9, '2021_08_19_200503_create_sizes_table', 1),
(10, '2021_08_19_200515_create_colors_table', 1),
(11, '2021_08_19_201022_create_vendors_table', 1),
(12, '2021_08_19_210453_create_orders_meta_table', 1),
(13, '2021_08_19_210924_create_shippings_table', 1),
(14, '2021_08_19_212202_create_customer_addresses_table', 1),
(15, '2021_08_20_201549_create_permission_tables', 1),
(16, '2021_08_21_111724_create_modules_table', 1),
(17, '2021_08_26_201131_create_images_table', 1),
(18, '2021_08_29_074100_create_general_settings_table', 1),
(19, '2021_09_08_195723_create_banners_table', 1),
(20, '2021_09_23_183325_create_product_colors_table', 1),
(21, '2021_09_23_183443_create_product_color_sizes_table', 1),
(22, '2021_10_03_101957_create_product_multiples_table', 1),
(23, '2021_10_05_204513_create_coupon_types_table', 1),
(24, '2021_10_09_121434_create_product_varients_table', 1),
(25, '2021_10_14_160523_create_wish_list_items_table', 1),
(26, '2021_10_20_155503_add_discount_price_to_orders_table', 1),
(27, '2021_10_20_155936_add_discount_price_to_orders_meta_table', 1),
(28, '2021_10_23_195839_add_is_new_arrival_to_product_variants_table', 1),
(29, '2021_10_25_163132_create_addresses_table', 1),
(30, '2021_10_25_213941_add_is_active_to_users_table', 1),
(31, '2021_10_26_191531_add_address_to_orders_table', 1),
(32, '2021_10_27_151407_create_product_reviews_table', 1),
(33, '2021_10_27_182027_add_deleted_at_column_to_product_variants_table', 1),
(34, '2021_10_27_183248_add_sign_up_discount_column_to_general_settings_table', 1),
(35, '2021_11_02_193528_add_discount_valid_till_column_to_product__variants_table', 1),
(36, '2021_11_05_204107_add_is_featured_column_to_product_varianats_table', 1),
(37, '2021_11_15_112040_create_user_coupons_table', 2),
(38, '2021_11_15_121933_add_variant_sku_column_to_product_variants_table', 3),
(39, '2021_11_27_091632_add_expiry_date_to_user_coupons_table', 4),
(40, '2021_11_30_071945_create_jobs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `customer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'user who buy the product',
  `price` int(11) NOT NULL,
  `commission` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `coupon_id` int(11) NOT NULL DEFAULT 0,
  `order_date_time` datetime NOT NULL,
  `is_delivered` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_price` int(11) NOT NULL DEFAULT 0,
  `order_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Delivered','Dispatched','Pending') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `account_id`, `customer_id`, `price`, `commission`, `discount`, `coupon_id`, `order_date_time`, `is_delivered`, `created_at`, `updated_at`, `discount_price`, `order_address`, `city`, `zip`, `country`, `status`) VALUES
(1, 1, '7', 2500, 3, 15, 0, '2021-11-30 11:01:39', 0, '2021-11-30 06:01:39', '2021-11-30 06:01:39', 2200, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(2, 1, '7', 2500, 3, NULL, 0, '2021-11-30 11:03:35', 0, '2021-11-30 06:03:35', '2021-11-30 06:03:35', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(3, 1, '7', 2500, 3, NULL, 0, '2021-11-30 11:03:43', 0, '2021-11-30 06:03:43', '2021-11-30 06:03:43', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(4, 1, '7', 2500, 3, NULL, 0, '2021-12-06 06:38:15', 0, '2021-12-06 01:38:15', '2021-12-06 01:38:15', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(5, 1, '7', 2500, 3, NULL, 0, '2021-12-06 06:47:55', 0, '2021-12-06 01:47:55', '2021-12-06 01:47:55', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(6, 1, '7', 2500, 3, NULL, 0, '2021-12-06 06:54:10', 0, '2021-12-06 01:54:10', '2021-12-06 01:54:10', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(7, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:13:32', 0, '2021-12-06 02:13:32', '2021-12-06 02:13:32', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(8, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:14:10', 0, '2021-12-06 02:14:10', '2021-12-06 02:14:10', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(9, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:16:16', 0, '2021-12-06 02:16:16', '2021-12-06 02:16:16', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(10, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:17:24', 0, '2021-12-06 02:17:24', '2021-12-06 02:17:24', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(11, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:19:45', 0, '2021-12-06 02:19:45', '2021-12-06 02:19:45', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(12, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:27:04', 0, '2021-12-06 02:27:04', '2021-12-06 02:27:04', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(13, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:30:06', 0, '2021-12-06 02:30:06', '2021-12-06 02:30:06', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(14, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:33:51', 0, '2021-12-06 02:33:51', '2021-12-06 02:33:51', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(15, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:40:59', 0, '2021-12-06 02:40:59', '2021-12-06 02:40:59', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(16, 1, '7', 2500, 3, NULL, 0, '2021-12-06 07:46:48', 0, '2021-12-06 02:46:48', '2021-12-06 02:46:48', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(17, 1, '7', 2500, 3, NULL, 0, '2021-12-06 08:36:19', 0, '2021-12-06 03:36:19', '2021-12-06 03:36:19', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(18, 1, '7', 2500, 3, NULL, 0, '2021-12-06 08:39:01', 0, '2021-12-06 03:39:01', '2021-12-06 03:39:01', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(19, 1, '7', 2500, 3, NULL, 0, '2021-12-06 08:39:54', 0, '2021-12-06 03:39:54', '2021-12-06 03:39:54', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(20, 1, '7', 2500, 3, NULL, 0, '2021-12-06 10:08:30', 0, '2021-12-06 05:08:30', '2021-12-06 05:08:30', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending'),
(21, 1, '7', 2500, 3, NULL, 0, '2021-12-06 10:09:34', 0, '2021-12-06 05:09:34', '2021-12-06 05:09:34', 2575, 'shadar lahore', 'lahore', '5400', 'Pakistan', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `orders_meta`
--

CREATE TABLE `orders_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `product_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount_price` int(11) NOT NULL DEFAULT 0,
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orders_meta`
--

INSERT INTO `orders_meta` (`id`, `order_id`, `product_id`, `product_sku`, `vendor_id`, `product_price`, `created_at`, `updated_at`, `discount_price`, `variant_id`, `product_qty`) VALUES
(1, 3, 11, NULL, 0, 2500, '2021-11-30 06:03:43', '2021-11-30 06:03:43', 2200, 5, 1),
(2, 4, 11, NULL, 0, 2500, '2021-12-06 01:38:15', '2021-12-06 01:38:15', 2200, 5, 1),
(3, 5, 11, NULL, 0, 2500, '2021-12-06 01:47:55', '2021-12-06 01:47:55', 2200, 5, 1),
(4, 6, 11, NULL, 0, 2500, '2021-12-06 01:54:10', '2021-12-06 01:54:10', 2200, 5, 1),
(5, 7, 11, NULL, 0, 2500, '2021-12-06 02:13:32', '2021-12-06 02:13:32', 2200, 5, 1),
(6, 8, 11, NULL, 0, 2500, '2021-12-06 02:14:10', '2021-12-06 02:14:10', 2200, 5, 1),
(7, 9, 11, NULL, 0, 2500, '2021-12-06 02:16:16', '2021-12-06 02:16:16', 2200, 5, 1),
(8, 10, 11, NULL, 0, 2500, '2021-12-06 02:17:24', '2021-12-06 02:17:24', 2200, 5, 1),
(9, 11, 11, NULL, 0, 2500, '2021-12-06 02:19:45', '2021-12-06 02:19:45', 2200, 5, 1),
(10, 12, 11, NULL, 0, 2500, '2021-12-06 02:27:04', '2021-12-06 02:27:04', 2200, 5, 1),
(11, 13, 11, NULL, 0, 2500, '2021-12-06 02:30:06', '2021-12-06 02:30:06', 2200, 5, 1),
(12, 14, 11, NULL, 0, 2500, '2021-12-06 02:33:51', '2021-12-06 02:33:51', 2200, 5, 1),
(13, 15, 11, NULL, 0, 2500, '2021-12-06 02:40:59', '2021-12-06 02:40:59', 2200, 5, 1),
(14, 16, 11, NULL, 0, 2500, '2021-12-06 02:46:48', '2021-12-06 02:46:48', 2200, 5, 1),
(15, 17, 11, NULL, 0, 2500, '2021-12-06 03:36:19', '2021-12-06 03:36:19', 2200, 5, 1),
(16, 18, 11, NULL, 0, 2500, '2021-12-06 03:39:01', '2021-12-06 03:39:01', 2200, 5, 1),
(17, 19, 11, NULL, 0, 2500, '2021-12-06 03:39:54', '2021-12-06 03:39:54', 2200, 5, 1),
(18, 20, 11, NULL, 0, 2500, '2021-12-06 05:08:30', '2021-12-06 05:08:30', 2200, 5, 1),
(19, 21, 11, NULL, 0, 2500, '2021-12-06 05:09:34', '2021-12-06 05:09:34', 2200, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2021-11-08 15:35:09', '2021-11-08 15:35:09'),
(2, 'role-create', 'web', '2021-11-08 15:35:09', '2021-11-08 15:35:09'),
(3, 'role-edit', 'web', '2021-11-08 15:35:09', '2021-11-08 15:35:09'),
(4, 'role-delete', 'web', '2021-11-08 15:35:09', '2021-11-08 15:35:09'),
(5, 'product-list', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(6, 'product-create', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(7, 'product-edit', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(8, 'product-delete', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(9, 'category-list', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(10, 'category-create', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(11, 'category-edit', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(12, 'category-delete', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(13, 'banners-list', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(14, 'banners-create', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(15, 'banners-edit', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(16, 'banners-delete', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(17, 'users-list', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(18, 'users-create', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(19, 'users-edit', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(20, 'users-delete', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(21, 'permissions-list', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(22, 'permissions-create', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(23, 'permissions-edit', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(24, 'permissions-delete', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(25, 'coupons-list', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(26, 'coupons-create', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(27, 'coupons-edit', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(28, 'coupons-delete', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(29, 'colors-listing', 'web', '2020-12-21 19:00:00', '2021-01-14 12:35:12'),
(30, 'general-settings-update', 'web', '2021-11-10 13:42:42', '2021-11-10 13:42:42'),
(31, 'size-listing', 'web', '2021-11-10 13:44:17', '2021-11-10 13:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `first_child_category` int(11) DEFAULT NULL,
  `second_child_category` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `account_id`, `name`, `description`, `sku`, `vendor_id`, `category_id`, `first_child_category`, `second_child_category`, `is_active`, `created_at`, `updated_at`) VALUES
(8, 1, 'Test Product', 'Test Product', 'tes-72749698', NULL, 1, NULL, NULL, 1, '2021-11-08 15:45:38', '2021-11-08 15:45:38'),
(11, 1, 'Speedy Car', 'saf as fsdf as s', 'spe-26558381', NULL, 2, NULL, NULL, 1, '2021-11-10 14:08:30', '2021-11-10 14:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_colors`
--

CREATE TABLE `product_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `product_color_sizes`
--

CREATE TABLE `product_color_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `size_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_color_sizes`
--

INSERT INTO `product_color_sizes` (`id`, `product_id`, `color_id`, `variant_id`, `size_id`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 4, 1, '2021-11-08 15:45:38', '2021-11-08 15:45:38'),
(2, 8, 1, 4, 2, '2021-11-08 15:45:38', '2021-11-08 15:45:38'),
(4, 11, 5, 6, 2, '2021-11-10 14:08:30', '2021-11-10 14:08:30'),
(6, 11, 4, 5, 1, '2021-11-13 13:20:25', '2021-11-13 13:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_multiples`
--

CREATE TABLE `product_multiples` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `size_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `images` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `variant_id` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `remarks` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Approved','Pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `size_id` int(11) DEFAULT NULL,
  `length` double(8,2) DEFAULT NULL,
  `width` double(8,2) DEFAULT NULL,
  `height` double(8,2) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `alert_quantity` int(11) NOT NULL,
  `is_discounted` int(11) NOT NULL DEFAULT 0,
  `discount_price` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `purchase_date` date DEFAULT NULL,
  `purchase_price` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `discount_valid_till` date DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `account_id`, `product_id`, `color_id`, `size_id`, `length`, `width`, `height`, `weight`, `price`, `quantity`, `alert_quantity`, `is_discounted`, `discount_price`, `created_at`, `updated_at`, `is_new_arrival`, `purchase_date`, `purchase_price`, `deleted_at`, `discount_valid_till`, `is_featured`, `sku`) VALUES
(4, 1, 8, 1, NULL, 1.00, 1.00, 1.00, NULL, 11, 1, 1, 1, 5, '2021-11-08 15:45:38', '2021-11-08 15:45:38', 1, NULL, NULL, NULL, '2025-12-31', 1, 'jog-292'),
(5, 1, 11, 4, NULL, NULL, NULL, NULL, NULL, 2500, 206, 2, 1, 300, '2021-11-10 14:08:30', '2021-12-06 05:09:34', 1, '2021-11-20', 300, NULL, '2021-11-20', 0, 'car-3fj'),
(6, 1, 11, 5, NULL, NULL, NULL, NULL, NULL, 3000, 4, 2, 0, NULL, '2021-11-10 14:08:30', '2021-11-14 07:41:21', 0, NULL, NULL, NULL, NULL, 0, 'speed-j3f');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(2, 'manger', 'web', '2021-11-08 15:35:10', '2021-11-08 15:35:10'),
(3, 'customer', 'web', '2021-11-08 15:35:11', '2021-11-08 15:35:11');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 3),
(5, 1),
(5, 2),
(5, 3),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(11, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(17, 3),
(18, 1),
(18, 2),
(18, 3),
(19, 1),
(19, 2),
(19, 3),
(20, 1),
(20, 2),
(20, 3),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(22, 3),
(23, 1),
(23, 2),
(23, 3),
(24, 1),
(24, 2),
(24, 3),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 2),
(27, 3),
(28, 1),
(28, 2),
(28, 3),
(29, 1),
(30, 1),
(31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tracking_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `received_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dispatched` tinyint(1) NOT NULL DEFAULT 0,
  `on_way` tinyint(1) NOT NULL DEFAULT 0,
  `received` tinyint(1) NOT NULL DEFAULT 0,
  `delivered_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `account_id`, `name`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'SM', 'SM', 1, '2021-11-08 15:38:11', '2021-11-08 15:38:11'),
(2, 1, 'M', 'M', 1, '2021-11-08 15:38:11', '2021-11-08 15:38:11'),
(3, 1, 'L', 'L', 1, '2021-11-08 15:38:11', '2021-11-08 15:38:11'),
(4, 1, 'XL', 'XL', 1, '2021-11-08 15:38:11', '2021-11-08 15:38:11'),
(5, 1, 'XXL', 'XXL', 1, '2021-11-08 15:38:11', '2021-11-08 15:38:11'),
(6, 1, 'XXXL', 'XXXL', 1, '2021-11-08 15:38:11', '2021-11-08 15:38:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `account_id`, `f_name`, `l_name`, `email`, `email_verified_at`, `password`, `phone_no`, `gender`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 1, 'Super ', 'Admin', 'admin@domain.com', NULL, '$2y$10$skbXJVh7YRn0WKiVKIsnMuFxMixuSMSaCQauevpMsf.FyrDPFA0de', 12345678, 'male', NULL, NULL, NULL, '2021-11-08 15:36:00', '2021-11-08 15:36:00', 1),
(2, 1, 'Test User', 'sdfs', 'user@domain.com', NULL, '$2y$10$sZftMr91iloegcTFI0j1He0Vx8er41Z64RJn/ftcKdUXTshIzZ7Nu', 12345678, 'male', NULL, NULL, NULL, '2021-11-08 15:36:00', '2021-11-08 15:36:00', 1),
(7, 1, 'shah', 'meer', 'gmail@naveedshahzad.com', NULL, '$2y$10$J7WNIIn8EJPmP.Po0mbnSuS1ftfpOfRxzMfgH.5Z7S/q7mj11OClO', 12345678, 'male', NULL, NULL, NULL, '2021-11-14 05:58:14', '2021-11-14 05:58:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_coupons`
--

CREATE TABLE `user_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `coupon_expiray_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_coupons`
--

INSERT INTO `user_coupons` (`id`, `user_id`, `coupon_id`, `is_active`, `created_at`, `updated_at`, `coupon_expiray_date`) VALUES
(1, 7, 1, 1, '2021-11-15 11:40:43', '2021-11-15 11:40:45', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `wish_list_items`
--

CREATE TABLE `wish_list_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `variant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `addresses_customer_id_index` (`customer_id`) USING BTREE;

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `coupon_types`
--
ALTER TABLE `coupon_types`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`) USING BTREE;

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`) USING BTREE,
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE;

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`) USING BTREE,
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`) USING BTREE;

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `orders_meta`
--
ALTER TABLE `orders_meta`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `orders_meta_variant_id_index` (`variant_id`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_color_sizes`
--
ALTER TABLE `product_color_sizes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `product_multiples`
--
ALTER TABLE `product_multiples`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `product_multiples_product_id_index` (`product_id`) USING BTREE;

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `product_reviews_customer_id_index` (`customer_id`) USING BTREE;

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`) USING BTREE;

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`) USING BTREE,
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`) USING BTREE;

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- Indexes for table `user_coupons`
--
ALTER TABLE `user_coupons`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `wish_list_items`
--
ALTER TABLE `wish_list_items`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `wish_list_items_user_id_index` (`user_id`) USING BTREE,
  ADD KEY `wish_list_items_product_id_index` (`product_id`) USING BTREE,
  ADD KEY `wish_list_items_variant_id_index` (`variant_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coupon_types`
--
ALTER TABLE `coupon_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders_meta`
--
ALTER TABLE `orders_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_color_sizes`
--
ALTER TABLE `product_color_sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_multiples`
--
ALTER TABLE `product_multiples`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_coupons`
--
ALTER TABLE `user_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wish_list_items`
--
ALTER TABLE `wish_list_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
