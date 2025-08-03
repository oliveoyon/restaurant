-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 31, 2025 at 10:07 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u806727328_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

CREATE TABLE `account_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_head` varchar(100) DEFAULT NULL,
  `account_desc` varchar(100) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `ach_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `account_head`, `account_desc`, `store_id`, `ach_status`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 'Debit', 101, 1, '2025-07-31 15:20:15', '2025-07-31 15:20:15'),
(2, 'Liabilities', 'Credit', 101, 1, '2025-07-31 15:20:27', '2025-07-31 15:20:27'),
(3, 'Expenses', 'Debit', 101, 1, '2025-07-31 15:20:36', '2025-07-31 15:20:36'),
(4, 'Revenue', 'Credit', 101, 1, '2025-07-31 15:20:50', '2025-07-31 15:20:50'),
(5, 'Equity', 'Credit', 101, 1, '2025-07-31 15:20:50', '2025-07-31 15:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_type_hash_id` varchar(255) NOT NULL,
  `account_head_id` bigint(20) UNSIGNED DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `is_money` tinyint(1) NOT NULL,
  `is_wallet` tinyint(1) NOT NULL,
  `store_id` int(11) NOT NULL,
  `acctype_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` int(11) NOT NULL,
  `acc_type` varchar(10) NOT NULL,
  `normal` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `account_type_hash_id`, `account_head_id`, `account_name`, `is_money`, `is_wallet`, `store_id`, `acctype_status`, `created_at`, `updated_at`, `code`, `acc_type`, `normal`) VALUES
(1, '5eba176bd8b8ed5cec88d74880cb270c', 1, 'Food Ingredients', 0, 0, 101, 1, '2025-07-31 09:23:38', '2025-07-31 09:23:38', 101, '', 1),
(2, '5ebb938464fc3ed8bedacc923d1f3b15', 1, 'Food Equipment', 0, 0, 101, 1, '2025-07-31 09:23:50', '2025-07-31 09:23:50', 102, '', 1),
(3, '30dcd408c51cb00c4cf3de4d25a50ab8', 1, 'Inventory', 0, 0, 101, 1, '2025-07-31 15:24:43', '2025-07-31 15:24:43', 103, '', 1),
(4, 'e8754d3ee0a243e7746dfe6ebe70c2d3', 1, 'Shop Decoration', 0, 0, 101, 1, '2025-07-31 09:26:47', '2025-07-31 09:26:47', 104, '', 1),
(5, 'a70a958cf7a4b321973dd064e4b5cd26', 1, 'Kitchen Accessories', 0, 0, 101, 1, '2025-07-31 09:26:56', '2025-07-31 09:26:56', 105, '', 1),
(6, 'b62471b9d0978b9fe7848de06fca0d89', 1, 'Machineries', 0, 0, 101, 1, '2025-07-31 09:27:07', '2025-07-31 09:27:07', 106, '', 1),
(7, '9fc9612e21bb6f5567dc729fc378ca1d', 1, 'IT Equipment & Others', 0, 0, 101, 1, '2025-07-31 09:27:17', '2025-07-31 09:27:17', 107, '', 1),
(8, '99d29a7d48f8b92f931cb210311710a0', 1, 'Cash', 1, 0, 101, 1, '2025-07-31 09:27:30', '2025-07-31 09:27:30', 108, '', 1),
(9, 'e273fd2ac118efd7e3d2dff5a47ff231', 1, 'Cash at City Bank', 1, 0, 101, 1, '2025-07-31 09:27:48', '2025-07-31 09:27:48', 109, '', 1),
(10, '44bae97939cfce87a423ac95b838ae1f', 1, 'Cash at DBBL', 1, 0, 101, 1, '2025-07-31 09:28:17', '2025-07-31 09:28:17', 110, '', 1),
(11, '84fddbcf471130c647f7ddc2f2b4d403', 1, 'bKash', 1, 1, 101, 1, '2025-07-31 09:28:48', '2025-07-31 09:28:48', 111, '', 1),
(12, 'bedd544db99ccbf70cb9eff6778e886a', 1, 'Nadag', 1, 1, 101, 1, '2025-07-31 09:28:59', '2025-07-31 09:28:59', 112, '', 1),
(13, 'd5ccb65ba37a724934decd93d30fb380', 1, 'PoS City Bank', 1, 1, 101, 1, '2025-07-31 09:29:10', '2025-07-31 09:29:10', 113, '', 1),
(14, 'e99ab20e3582cc3ba2a3a388214d7464', 1, 'PoS DBBL Bank', 1, 1, 101, 1, '2025-07-31 09:29:23', '2025-07-31 09:29:23', 114, '', 1),
(15, '3263b27e4a928a12bf2f9bed23185a34', 1, 'Food Panda', 1, 1, 101, 1, '2025-07-31 09:30:03', '2025-07-31 09:30:03', 115, '', 1),
(16, '78af4f72bc4d7ac372dd0954bd513ebb', 1, 'Advance/Security', 0, 0, 101, 1, '2025-07-31 09:30:16', '2025-07-31 09:30:16', 116, '', 1),
(17, 'c877f9419a3d63fa1dae18e2ab9baebe', 2, 'Loan', 0, 0, 101, 1, '2025-07-31 09:36:43', '2025-07-31 09:36:43', 201, '', -1),
(18, 'bdf09c0065c3a08f729a5399d4c77eb3', 2, 'Income Tax Payable', 0, 0, 101, 1, '2025-07-31 09:39:36', '2025-07-31 09:39:36', 202, '', -1),
(19, '8f2c1a8c0f70f574318402cbc94a954f', 2, 'VAT Payable', 0, 0, 101, 1, '2025-07-31 09:39:46', '2025-07-31 09:39:46', 203, '', -1),
(20, '33119e32bf4b777bae9489f0f599ea21', 3, 'Shop Rent', 0, 0, 101, 1, '2025-07-31 09:43:20', '2025-07-31 09:43:20', 301, '', 1),
(21, 'f0dde563ad7b7b090687501304bbecb2', 3, 'Electricity bill', 0, 0, 101, 1, '2025-07-31 09:43:31', '2025-07-31 09:43:31', 302, '', 1),
(22, '5a9632d47577e9d820bfd306d834d839', 3, 'Stuff Salary', 0, 0, 101, 1, '2025-07-31 09:43:42', '2025-07-31 09:43:42', 303, '', 1),
(23, '97b72bf93cdec31b34942fb5f88bfabf', 3, 'Stuff Accommodation', 0, 0, 101, 1, '2025-07-31 09:43:53', '2025-07-31 09:43:53', 304, '', 1),
(24, '66f0a9c98aa51bf1ef9c4fab84d252a7', 3, 'Stuff fooding', 0, 0, 101, 1, '2025-07-31 09:44:03', '2025-07-31 09:44:03', 305, '', 1),
(25, '67ecc8d57e0224c5982fd392d7d26018', 3, 'Shop Equipment', 0, 0, 101, 1, '2025-07-31 09:44:12', '2025-07-31 09:44:12', 306, '', 1),
(26, 'fd1402d5a901281f2ba104f72711233b', 3, 'Business License Cost', 0, 0, 101, 1, '2025-07-31 09:44:23', '2025-07-31 09:44:23', 7, '', 1),
(27, '24f7ec9ac0eef310012f0a0cd80b2951', 3, 'Monthly VAT', 0, 0, 101, 1, '2025-07-31 09:44:33', '2025-07-31 09:44:33', 8, '', 1),
(28, 'cac31e652c2a7b578574467693275010', 3, 'Income Tax', 0, 0, 101, 1, '2025-07-31 09:46:03', '2025-07-31 09:46:03', 307, '', 1),
(29, 'b09d54a6ea4b41707856f1a8ea14da9b', 3, 'Stuff Commission', 0, 0, 101, 1, '2025-07-31 09:46:13', '2025-07-31 09:46:13', 308, '', 1),
(30, '026adc8e7cef34814d5b39d5682779f2', 3, 'Payment Gateway Charge', 0, 0, 101, 1, '2025-07-31 09:46:24', '2025-07-31 09:46:24', 309, '', 1),
(31, '7f441cb2ea22e2972d4c14acb2c6ad90', 3, 'Franchise Cost', 0, 0, 101, 1, '2025-07-31 09:46:35', '2025-07-31 09:46:35', 310, '', 1),
(32, 'feb29c2c514cb68002648a23e3180714', 3, 'TA/DA', 0, 0, 101, 1, '2025-07-31 09:46:44', '2025-07-31 09:46:44', 311, '', 1),
(33, '3bb4e627c75ac7c58e9f22c27b3408c1', 3, 'Repair & Maintenance', 0, 0, 101, 1, '2025-07-31 09:46:53', '2025-07-31 09:46:53', 312, '', 1),
(34, '640ff93b6fc9d93bf53eda95d8664de6', 3, 'Product Transport Cost', 0, 0, 101, 1, '2025-07-31 09:47:19', '2025-07-31 09:47:19', 313, '', 1),
(35, '0c52ea4ebb9e721c5ebe20d9df27b35d', 3, 'Advertisement & Promotion', 0, 0, 101, 1, '2025-07-31 09:47:28', '2025-07-31 09:47:28', 314, '', 1),
(36, 'd2e06a0e6f88439cf9e2d3b8aae994fd', 3, 'Shop Utilities', 0, 0, 101, 1, '2025-07-31 09:47:37', '2025-07-31 09:47:37', 315, '', 1),
(37, 'f084367cdb79982351fbb1f35f760a81', 3, 'Misc. Expanse', 0, 0, 101, 1, '2025-07-31 09:47:47', '2025-07-31 09:47:47', 316, '', 1),
(38, 'f496dc1b4a6d93eb8a8a11ce17df42e0', 3, 'Damage Expense', 0, 0, 101, 1, '2025-07-31 15:51:45', '2025-07-31 15:51:45', 317, '', 1),
(39, 'f496dc1b4a6d93eb8a8a11ce17df42e0', 3, 'Discount Allowed', 0, 0, 101, 1, '2025-07-31 15:51:45', '2025-07-31 15:51:45', 318, '', 1),
(40, 'f9ce32937873e5b5e46de6462c2f44be', 4, 'Sales Revenue', 0, 0, 101, 1, '2025-07-31 15:58:13', '2025-07-31 15:58:13', 401, '', -1),
(41, 'e33e8034413885ee6ca97ef432eb0d5f', 4, 'Others Income', 0, 0, 101, 1, '2025-07-31 10:00:01', '2025-07-31 10:00:01', 402, '', -1),
(42, 'a8b0f6a98e66002e2e2bd4911dcb783a', 4, 'Discount Received', 0, 0, 101, 1, '2025-07-31 16:01:32', '2025-07-31 16:01:32', 403, '', -1),
(43, '2f873de28000b4c9bd9d1e8425ffc353', 5, 'Owners Investment', 0, 0, 101, 1, '2025-07-31 10:03:43', '2025-07-31 10:03:43', 501, '', -1),
(44, '0d082a9e2a89b330c4f49a03cfc2ba11', 5, 'Owners Return', 0, 0, 101, 1, '2025-07-31 10:05:25', '2025-07-31 10:05:25', 502, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_hash_id` varchar(100) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_hash_id`, `store_id`, `name`, `email`, `email_verified_at`, `password`, `verify`, `remember_token`, `created_at`, `updated_at`, `pin`, `user_status`) VALUES
(1, 'oyG6egwYMsMDkdr4KwinBuaN87', 101, 'Admin', 'admin@email.com', '2023-02-01 08:08:24', '$2y$10$FrWHOM98uB9UemCsiCWAa.jaSRgb4zNQhzI8KwDpLvCxVy.tzdizu', 1, NULL, '2023-02-01 08:08:24', '2023-11-01 01:53:26', '', 1),
(2, 'oyG6egwYMsMDkdr4KwinBuaN87fdfdf', 102, 'Admin', 'admin1@email.com', '2023-02-01 08:08:24', '$2a$12$oyG6egwYMsMDkdr4KwinBuaN87.ZKfbzjDK4c509zc2d3.d45QX/y', 1, NULL, '2023-02-01 08:08:24', '2023-02-01 08:08:24', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_hash_id` varchar(100) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `brand_address` varchar(300) DEFAULT NULL,
  `brand_phone` varchar(300) DEFAULT NULL,
  `brand_email` varchar(100) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `brand_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_hash_id` varchar(100) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_img` varchar(100) NOT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_hash_id`, `category_name`, `category_img`, `category_status`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '58c5ce79945b63ece719fcb89f695a27', 'Direct Purchased Product', '', 1, 101, '2025-07-11 04:01:39', '2025-07-11 05:53:16'),
(2, 'bf739bf463ca8ba018715bd1f17d04b4', 'Finished Product', '', 1, 101, '2025-07-11 05:53:28', '2025-07-11 05:53:28'),
(3, '942b207f2adc9a28725f256971c3c175', 'Raw Materials Ingredients', '', 1, 101, '2025-07-11 05:53:58', '2025-07-11 05:53:58');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_hash_id` varchar(100) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `customer_address` varchar(300) DEFAULT NULL,
  `customer_phone` varchar(300) DEFAULT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL,
  `is_walkin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `damage_products`
--

CREATE TABLE `damage_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `damage_hash_id` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pdtstock_id` int(11) NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `rate` double NOT NULL DEFAULT 0,
  `invoice_no` varchar(200) NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `damage_date` datetime DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

CREATE TABLE `expenditures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expen_hash_id` varchar(100) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `acc_head_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL DEFAULT 0,
  `description` varchar(200) NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `exp_date` datetime NOT NULL,
  `from_account` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `expense_by` int(11) NOT NULL,
  `expense_status` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_hash_id` varchar(100) NOT NULL,
  `company_title` varchar(200) NOT NULL,
  `company_title_bn` varchar(200) NOT NULL,
  `company_email` varchar(200) NOT NULL,
  `company_phone` varchar(200) NOT NULL,
  `company_phone1` varchar(200) NOT NULL,
  `company_phone2` varchar(200) NOT NULL,
  `company_fax` varchar(200) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `company_country` varchar(200) NOT NULL,
  `company_currency` varchar(200) NOT NULL,
  `company_currency_sign` varchar(200) NOT NULL,
  `company_facebook` varchar(200) NOT NULL,
  `company_twitter` varchar(200) NOT NULL,
  `company_google` varchar(200) NOT NULL,
  `company_linkedin` varchar(200) NOT NULL,
  `company_youtube` varchar(200) NOT NULL,
  `company_copyright` varchar(200) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `store_id` int(11) NOT NULL,
  `company_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `company_hash_id`, `company_title`, `company_title_bn`, `company_email`, `company_phone`, `company_phone1`, `company_phone2`, `company_fax`, `company_address`, `company_country`, `company_currency`, `company_currency_sign`, `company_facebook`, `company_twitter`, `company_google`, `company_linkedin`, `company_youtube`, `company_copyright`, `company_logo`, `store_id`, `company_status`, `created_at`, `updated_at`) VALUES
(1, 'hg8hhu8ygjdfhhuy', 'IconBangla Software Services and Solutions', '', 'faruk_traders@email.com', '01911-121287, 01712-105580', '', '', '', 'Katasur, Mohammadpur, Dhaka - 1207', 'Bangladesh', 'BDT', '৳', 'https://facebook.com/faruk', '', '', '', '', '', '', 101, 1, NULL, NULL),
(2, 'hg8hhu8ygjdfhhuyfdf', 'M/S: Purna Laxmi Dal Mill1', '', 'faruk_traders@email.com', '01711-469377,  01715-081953', ' 01715-081953', ' 01715-081953', '', 'Takerhat, Shantipur, Gopalganj', 'Bangladesh', 'BDT', '৳', 'https://facebook.com/faruk', '', '', '', '', '', '', 102, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shelf_hash_id` varchar(100) NOT NULL,
  `shelf_name` varchar(100) NOT NULL,
  `shelf_status` tinyint(1) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manufacturer_hash_id` varchar(100) NOT NULL,
  `manufacturer_name` varchar(100) NOT NULL,
  `manufacturer_status` tinyint(1) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_13_155619_create_admins_table', 1),
(6, '2022_11_19_112922_create_categories_table', 1),
(7, '2022_11_19_131321_create_units_table', 1),
(8, '2022_11_19_150721_create_locations_table', 2),
(9, '2022_11_21_060228_create_suppliers_table', 3),
(10, '2022_11_21_082530_create_brands_table', 4),
(11, '2022_11_25_164136_create_products_table', 5),
(12, '2022_11_26_121935_create_manufacturers_table', 5),
(15, '2022_11_29_064541_create_products_table', 6),
(17, '2022_11_30_070949_create_product_stocks_table', 7),
(18, '2022_12_07_143116_create_account_heads_table', 8),
(21, '2022_12_08_112919_create_account_types_table', 9),
(22, '2022_12_17_143955_create_purchases_table', 10),
(23, '2022_12_30_171950_create_transactions_table', 11),
(25, '2023_01_02_093931_create_taxes_table', 12),
(28, '2023_01_06_092929_create_purchase_returns_table', 13),
(29, '2023_01_08_143653_create_customers_table', 14),
(30, '2023_01_08_151612_create_sales_table', 15),
(32, '2023_01_22_120213_create_sale_products_table', 16),
(33, '2023_01_25_142321_create_sale_returns_table', 17),
(34, '2023_02_03_135441_create_general_settings_table', 18),
(35, '2023_02_13_085756_create_opening_balances_table', 19),
(36, '2023_02_22_052606_create_damage_products_table', 20),
(37, '2023_03_01_085120_create_expenditures_table', 21),
(38, '2025_06_01_064523_create_product_recipes_table', 22),
(39, '2025_06_01_064700_create_productions_table', 23),
(40, '2025_06_01_064703_create_production_items_table', 24),
(41, '2025_06_18_064709_create_stock_movements_table', 25),
(42, '2025_07_04_152203_create_wallet_transfers_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `opening_balances`
--

CREATE TABLE `opening_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ob_hash_id` varchar(100) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `entry_date` datetime DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productions`
--

CREATE TABLE `productions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `batch_no` varchar(255) DEFAULT NULL,
  `production_date` date DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `production_items`
--

CREATE TABLE `production_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `production_id` bigint(20) UNSIGNED NOT NULL,
  `raw_product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_used` decimal(15,6) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_hash_id` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `manufacturer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_title` varchar(255) NOT NULL,
  `title_slug` varchar(255) NOT NULL,
  `pdt_description` longtext DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_status` tinyint(4) NOT NULL DEFAULT 1,
  `total_quantity` bigint(20) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_recipes`
--

CREATE TABLE `product_recipes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `raw_product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(15,6) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pdt_stock_hash_id` varchar(255) NOT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `barcode` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shelf_id` int(11) DEFAULT NULL,
  `tax_id` int(11) NOT NULL DEFAULT 0,
  `tax_value_percent` float NOT NULL DEFAULT 0,
  `serial_no` varchar(100) DEFAULT NULL,
  `batch_no` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `stckpdt_image` varchar(255) DEFAULT NULL,
  `quantity` double NOT NULL,
  `buy_price` double NOT NULL DEFAULT 0,
  `buy_price_with_tax` double NOT NULL,
  `sell_price` double NOT NULL DEFAULT 0,
  `purchase_date` timestamp NULL DEFAULT NULL,
  `expired_date` timestamp NULL DEFAULT NULL,
  `post_by` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `pdtstk_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `trns_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `due` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `paid` double NOT NULL DEFAULT 0,
  `purchase_status` int(11) NOT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pr_hash_id` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `pi_invoice` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pdtstock_id` int(11) NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `rate` double NOT NULL DEFAULT 0,
  `amount` double NOT NULL DEFAULT 0,
  `pur_return_status` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `return_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `trns_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `total` double NOT NULL DEFAULT 0,
  `due` double NOT NULL DEFAULT 0,
  `discount` double NOT NULL DEFAULT 0,
  `paid` double NOT NULL DEFAULT 0,
  `sale_status` int(11) NOT NULL,
  `check_pending` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_products`
--

CREATE TABLE `sale_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_hash_id` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pdtstock_id` int(11) NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `rate` double NOT NULL DEFAULT 0,
  `invoice_no` varchar(20) NOT NULL,
  `sale_by` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_return_hash_id` varchar(100) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pdtstock_id` int(11) NOT NULL,
  `quantity` double NOT NULL DEFAULT 0,
  `rate` double NOT NULL DEFAULT 0,
  `sale_invoice` varchar(200) NOT NULL,
  `return_by` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `batch_no` varchar(255) DEFAULT NULL,
  `quantity_deducted` decimal(10,3) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_hash_id` varchar(100) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `supplier_address` varchar(300) DEFAULT NULL,
  `supplier_phone` varchar(300) DEFAULT NULL,
  `supplier_email` varchar(100) DEFAULT NULL,
  `supplier_status` tinyint(1) NOT NULL DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_hash_id` varchar(100) NOT NULL,
  `tax_name` varchar(100) DEFAULT NULL,
  `tax_short_name` varchar(10) DEFAULT NULL,
  `tax_value_percent` double NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL,
  `tax_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trns_id` varchar(255) NOT NULL,
  `account_head_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `direction` varchar(11) NOT NULL,
  `trns_date` date NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_hash_id` varchar(100) NOT NULL,
  `unit_name` varchar(100) NOT NULL,
  `unit_status` tinyint(1) NOT NULL DEFAULT 0,
  `store_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_hash_id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transfers`
--

CREATE TABLE `wallet_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account_type_id` bigint(20) UNSIGNED NOT NULL,
  `wallet_name` varchar(50) NOT NULL,
  `transfer_date` date NOT NULL,
  `gross_amount` decimal(15,2) NOT NULL,
  `fee_percentage` decimal(5,2) NOT NULL,
  `fee_amount` decimal(15,2) NOT NULL,
  `net_amount` decimal(15,2) NOT NULL,
  `bank_account` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_heads`
--
ALTER TABLE `account_heads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_types_account_head_id_foreign` (`account_head_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_admin_hash_id_unique` (`admin_hash_id`),
  ADD UNIQUE KEY `admins_store_id_unique` (`store_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brand_hash_id_unique` (`brand_hash_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_hash_id_unique` (`category_hash_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_customer_hash_id_unique` (`customer_hash_id`);

--
-- Indexes for table `damage_products`
--
ALTER TABLE `damage_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `damage_products_damage_hash_id_unique` (`damage_hash_id`);

--
-- Indexes for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `expenditures_expen_hash_id_unique` (`expen_hash_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `general_settings_company_hash_id_unique` (`company_hash_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_shelf_hash_id_unique` (`shelf_hash_id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `manufacturers_manufacturer_hash_id_unique` (`manufacturer_hash_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opening_balances`
--
ALTER TABLE `opening_balances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opening_balances_ob_hash_id_unique` (`ob_hash_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productions`
--
ALTER TABLE `productions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productions_product_id_foreign` (`product_id`);

--
-- Indexes for table `production_items`
--
ALTER TABLE `production_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `production_items_production_id_foreign` (`production_id`),
  ADD KEY `production_items_raw_product_id_foreign` (`raw_product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_manufacturer_id_foreign` (`manufacturer_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_unit_id_foreign` (`unit_id`),
  ADD KEY `products_location_id_foreign` (`location_id`);

--
-- Indexes for table `product_recipes`
--
ALTER TABLE `product_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_recipes_product_id_foreign` (`product_id`),
  ADD KEY `product_recipes_raw_product_id_foreign` (`raw_product_id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_stocks_product_id_foreign` (`product_id`),
  ADD KEY `product_stocks_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_products`
--
ALTER TABLE `sale_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_products_sale_hash_id_unique` (`sale_hash_id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sale_returns_sale_return_hash_id_unique` (`sale_return_hash_id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_product_id_foreign` (`product_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_supplier_hash_id_unique` (`supplier_hash_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `taxes_tax_hash_id_unique` (`tax_hash_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_unit_hash_id_unique` (`unit_hash_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_hash_id_unique` (`user_hash_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallet_transfers`
--
ALTER TABLE `wallet_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_transfers_account_type_id_foreign` (`account_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_heads`
--
ALTER TABLE `account_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `damage_products`
--
ALTER TABLE `damage_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenditures`
--
ALTER TABLE `expenditures`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `opening_balances`
--
ALTER TABLE `opening_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productions`
--
ALTER TABLE `productions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `production_items`
--
ALTER TABLE `production_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_recipes`
--
ALTER TABLE `product_recipes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_products`
--
ALTER TABLE `sale_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transfers`
--
ALTER TABLE `wallet_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
