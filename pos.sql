-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 23, 2024 at 01:28 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_heads`
--

DROP TABLE IF EXISTS `account_heads`;
CREATE TABLE IF NOT EXISTS `account_heads` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_head` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_desc` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `store_id` int NOT NULL,
  `ach_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `account_heads`
--

INSERT INTO `account_heads` (`id`, `account_head`, `account_desc`, `store_id`, `ach_status`, `created_at`, `updated_at`) VALUES
(1, 'Assets', 'Debit', 101, 1, '2022-12-07 16:43:40', '2022-12-07 16:43:40'),
(2, 'Liabilities', 'Credit', 101, 1, '2022-12-07 16:43:40', '2022-12-07 16:43:40'),
(3, 'Expenses', 'Debit', 101, 1, '2022-12-07 16:45:55', '2022-12-07 16:45:55'),
(4, 'Revenue', 'Credit', 101, 1, '2022-12-07 16:45:55', '2022-12-07 16:45:55'),
(5, 'Equity', 'Credit', 101, 1, '2022-12-07 16:47:03', '2022-12-07 16:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

DROP TABLE IF EXISTS `account_types`;
CREATE TABLE IF NOT EXISTS `account_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_type_hash_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `account_head_id` bigint UNSIGNED DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `is_money` int DEFAULT NULL,
  `store_id` int NOT NULL,
  `acctype_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` int NOT NULL,
  `acc_type` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `normal` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_types_account_head_id_foreign` (`account_head_id`)
) ENGINE=MyISAM AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `account_type_hash_id`, `account_head_id`, `account_name`, `is_money`, `store_id`, `acctype_status`, `created_at`, `updated_at`, `code`, `acc_type`, `normal`) VALUES
(1, 'f1515f217821d66d71591ef77f949c2d', 1, 'Cash', 1, 101, 1, '2022-12-08 07:23:20', '2022-12-08 07:23:20', 101, '', 1),
(2, '36108265ea5adcf8eca8c5c55b3472d0', 1, 'Savings', 0, 101, 1, '2022-12-08 07:23:32', '2022-12-08 07:23:32', 102, '', 1),
(3, '364846d6b6a3fac48d5e326b3b9a7c8f', 1, 'Bank', 1, 101, 1, '2022-12-08 07:23:43', '2022-12-08 07:23:43', 103, '', 1),
(4, '48d403274f4ee166aeef5435276ee2ef', 1, 'Accounts Receivable', 0, 101, 1, '2022-12-08 07:24:06', '2022-12-08 07:24:06', 104, '', 1),
(5, '30dcd408c51cb00c4cf3de4d25a50ab8', 1, 'Inventory', 0, 101, 1, '2022-12-08 07:25:08', '2022-12-08 07:25:08', 105, '', 1),
(6, '4e3cf89e5520fb4605cf28e76d50c4ff', 1, 'Equipment', 0, 101, 1, '2022-12-08 07:25:18', '2022-12-08 07:25:18', 106, '', 1),
(7, '1c70e15432147e1c525066bf4e764199', 1, 'Land', 0, 101, 1, '2022-12-08 07:25:51', '2022-12-08 07:25:51', 107, '', 1),
(8, 'ff93f3a1a12363115fa6d5bfecfea5e0', 1, 'Vehicle', 0, 101, 1, '2022-12-08 07:25:59', '2022-12-08 07:25:59', 108, '', 1),
(9, 'b658a9f670dd356d2f0adb61a213a3ed', 1, 'Furniture', 0, 101, 1, '2022-12-08 07:26:06', '2022-12-08 07:26:06', 109, '', 1),
(10, '986cb8ed22361f16364ab15aba0a79b7', 1, 'Prepaid Expenses', 0, 101, 1, '2022-12-08 07:26:32', '2022-12-08 07:26:32', 110, '', 1),
(11, 'c6a49ba56948a2d6f545a5018224cd30', 2, 'Accounts Payable', 0, 101, 1, '2022-12-08 07:27:34', '2022-12-08 07:27:34', 201, '', -1),
(12, '3ff16ab8ef4602ee32c2afc7ad035e56', 2, 'Notes Payable', 0, 101, 1, '2022-12-08 07:27:47', '2022-12-08 07:27:47', 202, '', -1),
(13, '9ccfc5ed0d7d850422a26ed39bbece09', 2, 'Sale Tax Payable', 0, 101, 1, '2022-12-08 07:28:47', '2022-12-08 07:29:02', 203, '', -1),
(14, 'db065d1354d35fd40bcdd9e9a565c9d1', 2, 'Income Tax Payable', 0, 101, 1, '2022-12-08 07:29:19', '2022-12-08 07:29:19', 204, '', -1),
(15, 'fd284223ce1193cd335bca137a9d65fc', 2, 'Wages Payable', 0, 101, 1, '2022-12-08 07:29:50', '2022-12-08 07:29:50', 205, '', -1),
(16, 'bfb41c3400169a996a0b035ba3b2b27c', 2, 'Unearned Revenue', 0, 101, 1, '2022-12-08 07:30:12', '2022-12-08 07:30:12', 206, '', -1),
(17, '7f3445522c6cdad3e3eadfe5b97dd223', 5, 'Owners’ Capital', 0, 101, 1, '2022-12-08 07:32:29', '2022-12-08 07:32:29', 501, '', -1),
(18, 'e615572741eae527b4c3de404e993549', 5, 'Withdrawals', 0, 101, 1, '2022-12-08 07:32:52', '2022-12-08 07:32:52', 502, '', -1),
(19, 'f9ce32937873e5b5e46de6462c2f44be', 4, 'Sales Revenue', 0, 101, 1, '2022-12-08 07:33:18', '2022-12-08 07:33:18', 401, '', -1),
(20, 'f0bc7090e8f1ec42f8a3f30372d11757', 4, 'Service Revenue', 0, 101, 1, '2022-12-08 07:33:36', '2022-12-08 07:33:36', 402, '', -1),
(21, 'e772614c216146171578a6b2b8b1cf85', 3, 'General Expense', 0, 101, 1, '2022-12-08 07:40:24', '2022-12-08 07:40:24', 301, '', 1),
(22, 'dec5820cc8f6677ffd27ead439c9c06a', 3, 'Salary Expense', 0, 101, 1, '2022-12-08 07:42:13', '2022-12-08 07:46:12', 302, '', 1),
(23, '651cfe2e5787b4be4271b27e637f4c9b', 3, 'Rent Expense', 0, 101, 1, '2022-12-08 07:42:27', '2022-12-08 07:46:18', 303, '', 1),
(24, '64ee638a495abee0bd67004f17437ef5', 3, 'Electricity Bill', 0, 101, 1, '2022-12-08 07:42:52', '2022-12-08 07:42:52', 304, '', 1),
(25, 'f08881cc7e2da93437d7dfa5657bcdb7', 3, 'Insurance Expense', 0, 101, 1, '2022-12-08 07:44:18', '2022-12-08 07:46:26', 305, '', 1),
(29, 'a8b0f6a98e66002e2e2bd4911dcb783a', 4, 'Discount Received', 0, 101, 1, '2022-12-30 07:59:21', '2022-12-30 07:59:21', 403, '', -1),
(28, '41d6d742974a0ee58132dfec0fe7f1d6', 3, 'Discount Allowed', 0, 101, 1, '2022-12-30 07:59:07', '2022-12-30 07:59:07', 306, '', 1),
(118, '42dfefecf2b038a2b52ba4fed70eaf45', 3, 'Salary Expense', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 309, '', 1),
(119, '4e778792a2d6ab40a1f6dbf0a9b35b1d', 3, 'Rent Expense', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 310, '', 1),
(120, 'ef4050fb638663743e5787697d58174a', 3, 'Electricity Bill', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 311, '', 1),
(52, 'f496dc1b4a6d93eb8a8a11ce17df42e0', 3, 'Damage Expense', 0, 101, 1, '2023-02-21 23:43:36', '2023-02-21 23:43:36', 307, '', -1),
(115, '26c933f1f4777c4dc1b11d9306eb9de6', 4, 'Sales Revenue', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 404, '', -1),
(116, '35a46aefedea99157fc75ca96c4e4859', 4, 'Service Revenue', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 405, '', -1),
(117, '1893936185988128cc309105717f48e2', 3, 'General Expense', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 308, '', 1),
(61, '2186273af29a9708ba62ca29fc12bfe2', 1, 'Bank Cheque', 1, 101, 1, '2023-03-05 10:30:11', '2023-03-05 10:30:11', 112, '', 1),
(121, '6e6f652e438d518c0098c945e17e7a40', 3, 'Insurance Expense', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 312, '', 1),
(122, 'e1438e4884a7d637947151899b7506c3', 4, 'Discount Received', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 406, '', -1),
(123, '71aac919bdecc9b32f7fffacfc1d8245', 3, 'Discount Allowed', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 313, '', 1),
(114, 'a2b28acb9f27e687f5589b34b8400705', 5, 'Withdrawals', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 504, '', -1),
(113, '796dd433c49f434949aec5de4ddea0cd', 5, 'Owners’ Capital', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 503, '', -1),
(112, '665547d77ee3413a4b0c8f7a76753b9a', 2, 'Unearned Revenue', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 212, '', -1),
(111, '532735b0ec8b34fb21795d8c73cc8c74', 2, 'Wages Payable', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 211, '', -1),
(110, '73894edf4ff2d46aada2b8c9e236cae6', 2, 'Income Tax Payable', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 210, '', -1),
(109, 'f7993445e327721e02e472d5351fe80a', 2, 'Sale Tax Payable', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 209, '', -1),
(108, 'aaa5c0dd43b3ee2a6818b00837539fd0', 2, 'Notes Payable', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 208, '', -1),
(107, '8e3d7ff8312eb4cc881c48aef3cb4a3e', 2, 'Accounts Payable', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 207, '', -1),
(106, '677281ae836656602fccc19df83e5576', 1, 'Prepaid Expenses', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 122, '', 1),
(105, '73f80c65c751bf7f5ab36f9372925f04', 1, 'Furniture', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 121, '', 1),
(104, '8437a77b32a41b37f4a57ae33d58d1b9', 1, 'Vehicle', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 120, '', 1),
(103, 'e0b21b5ee27603eec4e8984b35df03d4', 1, 'Land', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 119, '', 1),
(102, 'f4c20a2bd92d441c60247d6751575b24', 1, 'Equipment', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 118, '', 1),
(101, 'f4793dcdd2f4ef7dcc97120f494652c3', 1, 'Inventory', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 117, '', 1),
(100, '21d1020a164dcd983f211486baf723ff', 1, 'Accounts Receivable', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 116, '', 1),
(99, '5a3619ca6facab0b8bd18722723101af', 1, 'Bank', 1, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 115, '', 1),
(98, '66c6377d3dc1927c3618afd76dcb0daf', 1, 'Savings', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 114, '', 1),
(97, 'fbd72624ff59623c3d5ab5c20e006805', 1, 'Cash', 1, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 113, '', 1),
(124, '73c46124aa34d534d894199269768b0c', 3, 'Damage Expense', 0, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 314, '', -1),
(125, 'e28d81455ba70feaca0f4c3b648f69d6', 1, 'Bank Cheque', 1, 102, 1, '2023-03-27 09:55:29', '2023-03-27 09:55:29', 123, '', 1),
(133, '4cca68d6a4a429838abcb5a273dc4371', 1, 'Noor', 0, 101, 1, '2023-05-19 07:24:18', '2023-05-19 07:24:18', 125, 'customer', 1),
(132, '8abc7a14216a33c373163fd7e8941d32', 2, 'fdf', 0, 101, 1, '2023-05-03 01:04:40', '2023-05-03 01:04:40', 214, 'supplier', -1),
(131, 'c36d6ed1f3934856c091b8c968d9042f', 1, 'DHS Motors', 0, 101, 1, '2023-04-15 13:44:40', '2023-04-15 13:44:40', 124, 'customer', 1),
(130, 'cd6b724521b4265b9f4964b09239ff6a', 2, 'Shahabuddin', 0, 101, 1, '2023-04-15 13:44:16', '2023-04-15 13:44:16', 213, 'supplier', -1),
(134, '828af843ae10bb1b5bffe4aaea741626', 2, 'akjk', 0, 101, 1, '2023-05-19 07:43:54', '2023-05-19 07:43:54', 215, 'supplier', -1),
(135, '6063dab8693e7e706a4506985131c08a', 1, 'Noor High School', 0, 101, 1, '2023-09-09 12:05:19', '2023-09-09 12:05:19', 126, 'customer', 1),
(136, 'f3615ea32bfe1d9030791d6a941005ea', 2, 'IconBangla', 0, 101, 1, '2023-09-09 13:12:40', '2023-09-09 13:12:40', 216, 'supplier', -1),
(137, '38cf30c7b61037649c4b8a5033b3f994', 1, 'MD ARIFUR RAHMAN', 0, 101, 1, '2023-09-09 13:12:53', '2023-09-09 13:12:53', 127, 'customer', 1),
(138, 'c651301b307ae01b636549799ff064c6', 1, 'Kurshi Secondary High School', 0, 101, 1, '2023-09-13 23:16:35', '2023-09-13 23:16:35', 128, 'customer', 1),
(139, 'faef161e0d92646b9bc3257939fc86a0', 1, 'Nobabpur High School', 0, 101, 1, '2023-09-14 00:28:40', '2023-09-14 00:28:40', 129, 'customer', 1),
(140, '45258ccac3a2c4a05be9f1a5bbf41ce7', 1, 'Amzad Ali Secondary School', 0, 101, 1, '2023-09-14 02:22:04', '2023-09-14 02:22:04', 130, 'customer', 1),
(141, 'cb3ebebfe8bfe3e4f15368cc386bdfb6', 1, 'Pulum GS Secondary School', 0, 101, 1, '2023-09-14 02:23:16', '2023-09-14 02:23:16', 131, 'customer', 1),
(142, '3163ae4f214833d7acf63107704144f5', 1, 'Kuchiamora Secondary Girls High School', 0, 101, 1, '2023-09-14 23:30:35', '2023-09-14 23:30:35', 132, 'customer', 1),
(143, '157f4d2e375318d98c6be023d9a13416', 1, 'Potora Adorsho High School', 0, 101, 1, '2023-09-14 23:32:08', '2023-09-14 23:32:08', 133, 'customer', 1),
(144, 'bff7bf034f36d8bcaa6f8495912e3050', 1, 'Ghee Komola High School', 0, 101, 1, '2023-09-17 09:38:01', '2023-09-17 09:38:01', 134, 'customer', 1),
(145, '34e507ff437e4b9fb58784577575034d', 1, 'GANGARAMPUR P.K. SECONDARY SCHOOL', 0, 101, 1, '2023-09-17 09:48:20', '2023-09-17 09:48:20', 135, 'customer', 1),
(146, 'c6b300969e37657507dbd430797f6334', 1, 'Abhayacharan Madhymic School', 0, 101, 1, '2023-09-22 00:56:10', '2023-09-22 00:56:10', 136, 'customer', 1),
(147, '9441c3563e05858b35c2b3a4650a9e09', 1, 'Saraswtee girls high school', 0, 101, 1, '2023-09-22 01:01:19', '2023-09-22 01:01:19', 137, 'customer', 1),
(148, 'd5c5f8228a883e998cf8539de69ea3ba', 1, 'talkhari', 0, 101, 1, '2023-09-22 01:06:09', '2023-09-22 01:06:09', 138, 'customer', 1),
(149, '6d107009ddbfd3a9082492fbc9fcc8e9', 3, 'Marketting and Travel', 0, 101, 1, '2023-09-22 06:36:02', '2023-09-22 06:36:02', 315, '', 1),
(150, 'e57898cab4bb81c383c66cc268c81842', 3, 'Domain Purchase', 0, 101, 1, '2023-09-22 07:10:27', '2023-09-22 07:10:27', 316, '', 1),
(151, '38b3541024a413ae5c942ca6ca91f6b0', 1, 'sadashipur ghoramara dakhil madrasa', 0, 101, 1, '2023-09-24 06:37:24', '2023-09-24 06:37:24', 139, 'customer', 1),
(152, '44991e280f20b6684d31ccc2e16ff580', 1, 'shalikha high school', 0, 101, 1, '2023-09-24 06:40:55', '2023-09-24 06:40:55', 140, 'customer', 1),
(153, 'fc8550ab1b894d0c59afa3f97f733065', 1, 'Baliakandi. dhakil madrasa', 0, 101, 1, '2023-09-25 05:01:55', '2023-09-25 05:01:55', 141, 'customer', 1),
(154, '672c97c48052113b1db41ccab9472fa1', 1, 'Baulia High school', 0, 101, 1, '2023-09-25 05:06:11', '2023-09-25 05:06:11', 142, 'customer', 1),
(155, 'aa586e3c0935df3c2128716b0be4a5d6', 1, 'Sorusuna High school', 0, 101, 1, '2023-09-25 05:09:31', '2023-09-25 05:09:31', 143, 'customer', 1),
(156, 'a057f7c7ebb6c1f974fa4fd898168701', 1, 'Tatulia dakhil madrasa', 0, 101, 1, '2023-09-26 06:40:11', '2023-09-26 06:40:11', 144, 'customer', 1),
(157, '9be100fccb5d8e6ae12ce1f8c7532dd3', 1, 'Boro gheekomla', 0, 101, 1, '2023-09-26 06:43:36', '2023-09-26 06:43:36', 145, 'customer', 1),
(158, '3f88b1f28928285a0be5f61f2b9a3532', 1, 'Shalmara dakhil madrasa', 0, 101, 1, '2023-09-26 06:46:08', '2023-09-26 06:46:08', 146, 'customer', 1),
(159, '8d7139a4d76c017892ee1d38cc884cf9', 1, 'baduli madrasa', 0, 101, 1, '2023-09-27 06:12:44', '2023-09-27 06:12:44', 147, 'customer', 1),
(162, '9800a78aac0e8dbab4be359a9f418673', 1, 'sadipur fazil madrasa', 0, 101, 1, '2023-10-04 01:32:57', '2023-10-04 01:32:57', 149, 'customer', 1),
(161, 'e56865d127ec0b6718cdda976920e2e5', 1, 'Natapara dakhil madrasa', 0, 101, 1, '2023-09-27 06:15:29', '2023-09-27 06:15:29', 148, 'customer', 1),
(163, '66de0f3894431ae0420539e1b7a3b1d4', 1, 'bhogirathpur fazil madrasa', 0, 101, 1, '2023-10-04 01:35:31', '2023-10-04 01:35:31', 150, 'customer', 1),
(164, 'c99f5dd9f0062a1d4bd2ca658bac7df9', 1, 'patkiabari dakhil madrasa', 0, 101, 1, '2023-10-08 06:54:14', '2023-10-08 06:54:14', 151, 'customer', 1),
(165, 'adb2db675dbcfbbc474487731f530838', 1, 'boro hijli dakhil madrasa', 0, 101, 1, '2023-10-09 07:14:03', '2023-10-09 07:14:03', 152, 'customer', 1),
(166, '5c55fd1e677ddf9ac71f7e0563d031d2', 1, 'ahladipur dakil madrasah', 0, 101, 1, '2023-10-09 07:17:46', '2023-10-09 07:17:46', 153, 'customer', 1),
(167, '1defe67cc02071a54beeef69ec919fa5', 1, 'mordanga fazil madrasa', 0, 101, 1, '2023-10-12 06:41:35', '2023-10-12 06:41:35', 154, 'customer', 1),
(168, '1884c376f0908316ee7e63d07c4e97b1', 1, 'kallaynpur dakhil madrasa', 0, 101, 1, '2023-10-12 06:43:37', '2023-10-12 06:43:37', 155, 'customer', 1),
(169, 'b3f83c7d608cfc41e7437e775f84baf7', 1, 'barat alim madrasha', 0, 101, 1, '2023-10-16 07:08:01', '2023-10-16 07:08:01', 156, 'customer', 1),
(170, '4377198856e9625f22766932a3595ad3', 1, 'baraijuri dakhil madrasa', 0, 101, 1, '2023-10-16 07:11:10', '2023-10-16 07:11:10', 157, 'customer', 1),
(171, 'c4bef6669cc9282ec93d21af1165b700', 1, 'mopdanga fazil madrasa', 0, 101, 1, '2023-10-16 07:13:02', '2023-10-16 07:13:02', 158, 'customer', 1),
(172, '231477715fde943c708cd0f4ec37c82c', 1, 'belgachi dakhil madrasa', 0, 101, 1, '2023-10-17 04:56:09', '2023-10-17 04:56:09', 159, 'customer', 1),
(173, 'fc8fe6bbb7fc4e97f25f8cf6b651233d', 1, 'sorusona dakhil madrasa', 0, 101, 1, '2023-10-17 05:01:51', '2023-10-17 05:01:51', 160, 'customer', 1),
(174, '4ed1c25abb7b64a3cff237b334849675', 1, 'soru adorso high school', 0, 101, 1, '2023-10-17 05:47:24', '2023-10-17 05:47:24', 161, 'customer', 1),
(175, '1747768ea44665e012d204e52df59af5', 1, 'sreepur kamil madrasa', 0, 101, 1, '2023-10-18 04:35:28', '2023-10-18 04:35:28', 162, 'customer', 1),
(176, '93869a7ee4526a4af8fbd09442672fa0', 1, 'goalundo dakhil maDRASA', 0, 101, 1, '2023-10-22 05:40:24', '2023-10-22 05:40:24', 163, 'customer', 1),
(177, '99475e2ebbd27b703ce976451db18354', 1, 'khankhanapur dakhil madrasah', 0, 101, 1, '2023-10-26 07:10:07', '2023-10-26 07:10:07', 164, 'customer', 1),
(178, 'a46c8b7b383d09f0e347cfd1af800a6e', 1, 'shalmara high  school', 0, 101, 1, '2023-10-30 03:06:41', '2023-10-30 03:06:41', 165, 'customer', 1),
(179, '65667eb6341b50ba9ab8d7d6fc3261b8', 1, 'Majhbari alim madrada', 0, 101, 1, '2023-11-06 07:30:26', '2023-11-06 07:30:26', 166, 'customer', 1),
(180, 'dae6e125bf3ea3c7df3dfd4baceef30b', 1, 'Poijur fazil madrasa', 0, 101, 1, '2023-11-08 23:46:06', '2023-11-08 23:46:06', 167, 'customer', 1),
(181, 'bf24df1b5bca0aa6fb00d183c482791e', 1, 'Muchida alim madrasa', 0, 101, 1, '2023-11-14 06:39:45', '2023-11-14 06:39:45', 168, 'customer', 1),
(182, '596f337c1274530576da064126095748', 1, 'Paturia dakhil madrasa', 0, 101, 1, '2023-11-19 06:33:14', '2023-11-19 06:33:14', 169, 'customer', 1),
(183, '7d10666adf31922df20068e93ccf327e', 1, 'Rupiat dakhil madrasa', 0, 101, 1, '2023-11-20 05:02:13', '2023-11-20 05:02:13', 170, 'customer', 1),
(184, 'ceabda52bcfbd9da8d107f02f3331688', 1, 'Jamtala dakhil madrasa', 0, 101, 1, '2023-11-21 06:02:57', '2023-11-21 06:02:57', 171, 'customer', 1),
(185, '2bd6391567addf7ea9cfe697c82b792a', 1, 'Goya iddris dakhil madrasa', 0, 101, 1, '2023-11-21 06:04:46', '2023-11-21 06:04:46', 172, 'customer', 1),
(186, 'daa765bc834f676c8ed9f7984f325020', 1, 'Pailot high School', 0, 101, 1, '2023-11-26 03:21:03', '2023-11-26 03:21:03', 173, 'customer', 1),
(187, '7745f626da5c70324cf5210b44d6389e', 1, 'faridpur city college', 0, 101, 1, '2024-03-12 00:55:48', '2024-03-12 00:55:48', 174, 'customer', 1),
(188, 'a3c7153758fbeb71c38664540949e8c7', 1, 'National polytechnic institute', 0, 101, 1, '2024-04-02 02:31:46', '2024-04-02 02:31:46', 175, 'customer', 1),
(189, '75346fbcbaf7c317588664ab2df8d02b', 1, 'Mongolpur Mohila Dakhil Madrasa', 0, 101, 1, '2024-05-28 23:31:17', '2024-05-28 23:31:17', 176, 'customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `store_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_admin_hash_id_unique` (`admin_hash_id`),
  UNIQUE KEY `admins_store_id_unique` (`store_id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brand_address` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand_phone` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `brand_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `store_id` int NOT NULL,
  `brand_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `brands_brand_hash_id_unique` (`brand_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_hash_id`, `brand_name`, `brand_address`, `brand_phone`, `brand_email`, `store_id`, `brand_status`, `created_at`, `updated_at`) VALUES
(9, 'b0d36619c8b1443f9b7adca08d9fdfd0', 'IconBangla', NULL, NULL, NULL, 101, 1, '2023-09-09 12:03:36', '2024-09-07 01:27:50'),
(14, '5382f9c5d67302e6b78471d79497dab0', 'test', 'hdd', '04343535', 'test@fgg.com', 101, 1, '2024-09-07 01:27:59', '2024-09-07 01:27:59'),
(15, 'b72ecdf438bc11e7ec3767d51211029c', 'hhj', NULL, NULL, NULL, 101, 1, '2024-09-07 01:33:12', '2024-09-07 01:33:12'),
(16, '86309b62ded037227e117f2421027710', 'tat', NULL, NULL, NULL, 101, 1, '2024-09-07 01:42:27', '2024-09-07 01:42:27');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category_img` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category_status` tinyint(1) NOT NULL DEFAULT '0',
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_category_hash_id_unique` (`category_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_hash_id`, `category_name`, `category_img`, `category_status`, `store_id`, `created_at`, `updated_at`) VALUES
(8, 'd35809249e323a7393970e07dd5bac52', 'School Website', '', 1, 101, '2023-09-09 13:08:28', '2023-09-09 13:08:28'),
(18, 'b098c771fadad5fe6b1915737a1f4b20', 'tee', '', 1, 101, '2024-09-07 01:15:14', '2024-09-07 01:15:14'),
(19, 'f6faebecb0066bf306b6ad6b2527a88b', 'hh', 'dfd', 1, 101, '2024-09-07 01:32:58', '2024-09-07 01:32:58'),
(20, '2a0a3a72551bb22d166a847f5e372f24', 'rr', 'dfd', 1, 101, '2024-09-07 01:33:08', '2024-09-07 01:33:08'),
(21, 'e94f2d6c43d054f1703fe7e33a49489e', 'hgh', 'dfd', 1, 101, '2024-09-07 01:34:37', '2024-09-07 01:34:37'),
(22, 'f6b469947ae4687f97b1688e17d0dae2', 'wew', 'dfd', 1, 101, '2024-09-07 01:35:05', '2024-09-07 01:35:05'),
(23, '434e96a8ea4d471bdf44b3226d0853f0', 'hghg', 'dfd', 1, 101, '2024-09-07 01:35:33', '2024-09-07 01:35:33'),
(24, '1991b7037254d81e3f8d7ea481e29363', 'kuyt', 'dfd', 1, 101, '2024-09-07 01:36:13', '2024-09-07 01:36:13'),
(25, '1a528104fe442e47ea6430fc4d53340e', 'hghh', 'dfd', 1, 101, '2024-09-07 01:39:28', '2024-09-07 01:39:28'),
(26, '8b12b919321d7b216e4a12d335c312c9', 'fgyhersd', 'dfd', 1, 101, '2024-09-07 01:39:32', '2024-09-07 01:39:32'),
(27, '76b861e2dc4cb60dd605583904d216e5', 'werw', 'dfd', 1, 101, '2024-09-07 01:40:03', '2024-09-07 01:40:03'),
(28, 'e226029bbc54d627f56b6ff9778fe7c1', 'cat', 'dfd', 1, 101, '2024-09-07 01:42:09', '2024-09-07 01:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_address` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `customer_phone` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `customer_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `store_id` int NOT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int NOT NULL,
  `is_walkin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_customer_hash_id_unique` (`customer_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_hash_id`, `customer_name`, `customer_address`, `customer_phone`, `customer_email`, `store_id`, `customer_status`, `parent_id`, `is_walkin`, `created_at`, `updated_at`) VALUES
(1, 'ad0a9dc312bf24c1a3ce11a3808d17a5', 'Kurshi Secondary High School', 'Baliakandi, Rajbari', '01728351570', 'kurshi@email.com', 101, 1, 128, 0, '2023-09-13 23:16:35', '2023-09-13 23:16:35'),
(2, '2116ce5fc4859244d7897f5a58333a01', 'Nobabpur High School', 'Rajbari', '01721451764', 'admin@email.com', 101, 1, 129, 0, '2023-09-14 00:28:40', '2023-09-14 00:28:40'),
(3, '9533f2441c371409ab3186419385e16d', 'Amzad Ali Secondary School', 'Bunagati, Shalikha, Magura', '01712925008', 'iconbangla.soft@gmail.com', 101, 1, 130, 0, '2023-09-14 02:22:04', '2023-09-14 02:22:04'),
(4, '73a102bbc7bcad8c4d80ae086bdcc7fe', 'Pulum GS Secondary School', 'Pulum, Shalikha, Magura', '01856559696', 'pgsss1957@gmail.com', 101, 1, 131, 0, '2023-09-14 02:23:16', '2023-09-14 02:23:16'),
(5, 'a835fa1594c904ecd1e370aafe0d1ed0', 'Kuchiamora Secondary Girls High School', 'Amuria, Magura', '01767454659', 'ksghs1987@gmail.com', 101, 1, 132, 0, '2023-09-14 23:30:35', '2023-09-14 23:30:35'),
(6, '017b8505671970666a291809b5adf53f', 'Potora Adorsho High School', 'Somadhinagar, Baliakandi, Rajbari', '01719657191', 'potoraadorshohighschool@gmail.com', 101, 1, 133, 0, '2023-09-14 23:32:08', '2023-09-14 23:32:08'),
(7, '530cf1fddbe5afd24cead8858c907fad', 'Ghee Komola High School', 'Baliakandi, Rajbari', '01718985677', 'gkhs113269@gmail.com', 101, 1, 134, 0, '2023-09-17 09:38:01', '2023-09-17 09:38:32'),
(8, '724c278a3e91586fbc272884e15ca1f6', 'GANGARAMPUR P.K. SECONDARY SCHOOL', 'Salikha, Magura', '01713918210', 'gangarampurpkhs@gmail.com', 101, 1, 135, 0, '2023-09-17 09:48:20', '2023-09-17 09:48:20'),
(9, 'e38c73fa52015ee8ec80c036d1e30cf6', 'Abhayacharan Madhymic School', 'Shalikha, Magura', '01309118070', 'Abhayacharan1940@gmail.com', 101, 1, 136, 0, '2023-09-22 00:56:10', '2023-09-22 00:56:10'),
(10, '8657345c18dbdb11230883b0d8af0c3c', 'Saraswtee girls high school', 'Shalikha, Magura.', '01309118092', 'saraswteeg@gmail.com', 101, 1, 137, 0, '2023-09-22 01:01:19', '2023-09-22 01:01:19'),
(11, '2607b903d7d3b41aefd5d7441e3a9142', 'talkhari', 'shalikha, magura.', '01728076770', '19tal7kha9ri84@gmail.com', 101, 1, 138, 0, '2023-09-22 01:06:09', '2023-09-22 01:06:09'),
(12, '1f10ed31fabf64731e04341b5e2428b6', 'sadashipur ghoramara dakhil madrasa', 'sadashipur , baliakandi, rajbari', '01309113286', 'm113286madrasa@gmail.com', 101, 1, 139, 0, '2023-09-24 06:37:24', '2023-09-24 06:37:24'),
(13, 'ff2dc90bc56b7e687f59f46f646f38e9', 'shalikha high school', 'shalikha magura', '01309118082', 'shalikhaschool@gmail.com', 101, 1, 140, 0, '2023-09-24 06:40:55', '2023-09-24 06:40:55'),
(14, '5d4e0ae2eaa3b4cbfc5a36415fc9d9c2', 'Baliakandi. dhakil madrasa', 'Baliakamdi rajbari', '01782947203', 'baliakandidakhilmadrasa@gmail.com', 101, 1, 141, 0, '2023-09-25 05:01:55', '2023-09-25 05:01:55'),
(15, 'e97a3e31607c1d6e576dab22a75a02d1', 'Baulia High school', 'shalika magura', '01309118076', 'bauliankhighschool@gmail.com', 101, 1, 142, 0, '2023-09-25 05:06:11', '2023-09-25 05:06:11'),
(16, 'd80dfcc2756a6105c03b8b4e59abadaa', 'Sorusuna High school', 'shalikha. magura', '01309118075', 'shahiduzzaman68@gmail.com', 101, 1, 143, 0, '2023-09-25 05:09:31', '2023-09-25 05:09:31'),
(17, 'c66080755f0e1c5594c7335d765819f7', 'Tatulia dakhil madrasa', 'baliakandi, rajbari', '01720514807', 'm113287@gmail.com', 101, 1, 144, 0, '2023-09-26 06:40:11', '2023-09-26 06:40:11'),
(18, '6b451f89a7142eada0801ed9314636bd', 'Boro gheekomla', 'baliakandi. rajbari', '01984639194', 'm113292g@gmail.com', 101, 1, 145, 0, '2023-09-26 06:43:36', '2023-09-26 06:43:36'),
(19, '5f19f76f61819b169e2f3a61673d850e', 'Shalmara dakhil madrasa', 'Baliakandi,rajbari', '01719973994', 'sdm113290@gmail.com', 101, 1, 146, 0, '2023-09-26 06:46:08', '2023-09-26 06:46:08'),
(23, '181bb0c3a9092d538b1645eb0686f59e', 'sadipur fazil madrasa', 'sadipur, rajbari', '01309113480', 'abuj772@gmail.com', 101, 1, 149, 0, '2023-10-04 01:32:57', '2023-10-04 01:32:57'),
(21, 'a0ef480873b5a131fcfbe90777c0a8c5', 'baduli madrasa', 'baduli , baliakandi, rajbari', '01309113293', 'badulikhalkulamadrasah@gmail.com', 101, 1, 147, 0, '2023-09-27 06:12:44', '2023-09-27 06:12:44'),
(22, 'af430f027e6d08997f1393370a314a6b', 'Natapara dakhil madrasa', 'baliakandi, rajbari', '01309113291', NULL, 101, 1, 148, 0, '2023-09-27 06:15:29', '2023-09-27 06:15:29'),
(24, '580c8ceba98f15d4e5baf6894b69a74f', 'bhogirathpur fazil madrasa', 'bhogirathpur, rajbari', '01309113470', '113470bifm@gmail.com', 101, 1, 150, 0, '2023-10-04 01:35:31', '2023-10-04 01:35:31'),
(25, '3befbef2ddb92c9ce00e02d8d74914b1', 'patkiabari dakhil madrasa', 'baliakandi, rajbari', '01309113288', NULL, 101, 1, 151, 0, '2023-10-08 06:54:14', '2023-10-08 06:54:14'),
(26, '139b3bb86a9bc4c7db1fc8b7e02cfda9', 'boro hijli dakhil madrasa', 'baliakandi, rajbari', '01309113285', 'borohijlimadrasha113285@gmail.com', 101, 1, 152, 0, '2023-10-09 07:14:03', '2023-10-09 07:14:03'),
(27, '856d8f40ca25c51209586128a5e2d124', 'ahladipur dakil madrasah', 'rajbari sador, rajbari', '01309113484', 'adm113484@gmail.com', 101, 1, 153, 0, '2023-10-09 07:17:46', '2023-10-09 07:17:46'),
(28, 'f96dadb2442bacf20b6a7dccfc591ffd', 'mordanga fazil madrasa', 'rajbari sador, rajbari', '01309113475', 'mordangasfm@gmail.com', 101, 1, 154, 0, '2023-10-12 06:41:35', '2023-10-12 06:41:35'),
(29, '6c5d02ba111e9a8c36f0752cd8afc93a', 'kallaynpur dakhil madrasa', 'rajbari sador, rajbari', '01390113477', 'kallayanurmadrasha@gmail.com', 101, 1, 155, 0, '2023-10-12 06:43:37', '2023-10-12 06:43:37'),
(30, '23245bf2e88d5a28405a2529e8a422a0', 'barat alim madrasha', 'barat , rajbari', '01309113476', 'akironnessa@gmail.com', 101, 1, 156, 0, '2023-10-16 07:08:01', '2023-10-16 07:08:01'),
(31, '030814c3f58e2de6909b952cdff715d3', 'baraijuri dakhil madrasa', 'rajbari sador, rajbari', '01309113485', NULL, 101, 1, 157, 0, '2023-10-16 07:11:10', '2023-10-16 07:11:10'),
(32, '85f8164e0a2a2c1d55e9bf5529b8e64e', 'betulia kamil madrasa', 'rajbari sador, rajbari', '01309113474', 'bethulabsfm@gmail.com', 101, 1, 158, 0, '2023-10-16 07:13:02', '2023-10-17 04:56:36'),
(33, '166fcb2021a8863178b2212980f4945e', 'belgachi dakhil madrasa', 'rajbari sador, rajbari', '01309113467', '113467m@gmail.com', 101, 1, 159, 0, '2023-10-17 04:56:09', '2023-10-17 04:56:09'),
(34, '9ec85d3de0d16c169e3bdb82be625374', 'sorusona dakhil madrasa', 'shalikha, magura', '01309118119', 'dakkhinsharushoonadakhilm51@gmail.com', 101, 1, 160, 0, '2023-10-17 05:01:51', '2023-10-17 05:01:51'),
(35, '14988ed1d35923910ec43b5a47c68414', 'soru adorso high school', 'shalikha, magura', '01309118094', 'saschool95@gmail.com', 101, 1, 161, 0, '2023-10-17 05:47:24', '2023-10-17 05:47:24'),
(36, '1ea6d7361749327cc0748470d2128e77', 'sreepur kamil madrasa', 'rajbari sador, rajbari', '01309113471', 'principal.sreepurmadrasah@gmail.com', 101, 1, 162, 0, '2023-10-18 04:35:28', '2023-10-18 04:35:28'),
(37, 'ff8af739c0045dde5f51554644443d1d', 'goalundo dakhil maDRASA', 'rajbari sador, rajbari', '01309113313', 'gdmgr1990@gmail.com', 101, 1, 163, 0, '2023-10-22 05:40:24', '2023-10-22 05:40:24'),
(38, '1b550a5ca37406eb4e0c06806e2cec69', 'khankhanapur dakhil madrasah', 'rajbari sador, rajbari', '01309113472', 'foyejunnesa113472@gmail.com', 101, 1, 164, 0, '2023-10-26 07:10:07', '2023-10-26 07:10:07'),
(39, '45d7416c2752a6fe100d84981feaec76', 'shalmara high  school', 'baliakandi, rajbari', '01309113267', 'sc113267@gmail.com', 101, 1, 165, 0, '2023-10-30 03:06:41', '2023-10-30 03:06:41'),
(40, 'd6000ebf24f4faefb6c8195eab7e8ba0', 'Majhbari alim madrada', 'Kalukhali, rajbari', '01309113403', 'mm113403@gmail.com', 101, 1, 166, 0, '2023-11-06 07:30:26', '2023-11-06 07:30:26'),
(41, 'fb62a5b7a6e31624e83b87e3a020e7d4', 'Poijur fazil madrasa', 'Nangsa, rajbari', '01309113390', 'pmadrasha@gmail.com', 101, 1, 167, 0, '2023-11-08 23:46:06', '2023-11-08 23:46:06'),
(42, '26ce0db59f23a64b4b87931053ac9082', 'Muchida alim madrasa', 'Pangsha,  rajbari', '01309113401', 'muchidahmadrasha@gmail.com', 101, 1, 168, 0, '2023-11-14 06:39:45', '2023-11-14 06:39:45'),
(43, '694117ed372daebc6ad5d798e2f42a03', 'Paturia dakhil madrasa', 'Kalukhali, rajbari', '01309113379', 'm113379@yahoo', 101, 1, 169, 0, '2023-11-19 06:33:14', '2023-11-19 06:33:14'),
(44, 'acd2121e6f0e6e385967dc14b4516088', 'Rupiat dakhil madrasa', 'Pangsha, rajbari', '01309113389', 'mad113389@gmail.com', 101, 1, 170, 0, '2023-11-20 05:02:13', '2023-11-20 05:02:13'),
(45, 'd8b9691047fc9661572cc3e529d64382', 'Jamtala dakhil madrasa', 'Goyalanda, rajbari', '01309113317', 'ahjamtala@gmail.com', 101, 1, 171, 0, '2023-11-21 06:02:57', '2023-11-21 06:02:57'),
(46, '59880b0f3fcea0c5ec8f1688a7149c0c', 'Goya iddris dakhil madrasa', 'Goyalanda, rajbari', '01309113314', 'tahergidm@gmail.com', 101, 1, 172, 0, '2023-11-21 06:04:46', '2023-11-21 06:04:46'),
(47, '89d62937cbcb024693ba93c792257137', 'Pailot high School', 'Goalundo, rajbari', '01552350833', 'gnpghs1943@gmail.com', 101, 1, 173, 0, '2023-11-26 03:21:03', '2023-11-26 03:21:03'),
(48, 'ccd612170b2d4eb0ff1494cfda439e41', 'faridpur city college', 'faridpur sador', '01309108798', 'faridpurcityc@gmail.com', 101, 1, 174, 0, '2024-03-12 00:55:48', '2024-03-12 00:55:48'),
(49, '1028ade718b4b2b7e186353ddd768ec3', 'National polytechnic institute', 'Komlapur Faridpur', '01309132529', 'npif@gmail.com', 101, 1, 175, 0, '2024-04-02 02:31:46', '2024-04-02 02:31:46'),
(50, '805fa99ac35880f816a6bb6d5568e4aa', 'Mongolpur Mohila Dakhil Madrasa', 'Mongolpur, Faridpur', '01309113312', 'ismailhossain113312@gmail.com', 101, 1, 176, 0, '2024-05-28 23:31:17', '2024-05-28 23:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `damage_products`
--

DROP TABLE IF EXISTS `damage_products`;
CREATE TABLE IF NOT EXISTS `damage_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `damage_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_id` int NOT NULL,
  `pdtstock_id` int NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0',
  `invoice_no` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amount` bigint UNSIGNED NOT NULL DEFAULT '0',
  `damage_date` datetime DEFAULT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `damage_products_damage_hash_id_unique` (`damage_hash_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

DROP TABLE IF EXISTS `expenditures`;
CREATE TABLE IF NOT EXISTS `expenditures` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expen_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `invoice_no` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `acc_head_id` int NOT NULL,
  `employee_id` int NOT NULL DEFAULT '0',
  `description` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `amount` bigint UNSIGNED NOT NULL DEFAULT '0',
  `exp_date` datetime NOT NULL,
  `from_account` bigint UNSIGNED NOT NULL DEFAULT '0',
  `expense_by` int NOT NULL,
  `expense_status` int NOT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expenditures_expen_hash_id_unique` (`expen_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `expenditures`
--

INSERT INTO `expenditures` (`id`, `expen_hash_id`, `invoice_no`, `acc_head_id`, `employee_id`, `description`, `amount`, `exp_date`, `from_account`, `expense_by`, `expense_status`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 'ea20101ee0688421654fd2c2485843bd', 'EXP-230519-1', 301, 0, 'Tea coffe', 200, '2023-05-19 00:00:00', 101, 1, 1, 101, '2023-05-19 07:51:11', '2023-05-19 07:51:11'),
(2, '3608c12bdb21d018ce718d0145039520', 'EXP-230519-2', 304, 0, 'Electirif', 1000, '2023-05-19 00:00:00', 101, 1, 1, 101, '2023-05-19 07:51:35', '2023-05-19 07:51:35'),
(3, 'b46363c7f6c304acc877a8208139fce1', 'EXP-230922-3', 302, 0, 'Samiran Biswash', 2000, '2023-09-22 00:00:00', 101, 1, 1, 101, '2023-09-22 06:11:16', '2023-09-22 06:11:16'),
(4, '546020cfc03c4d824839c934a67fe53e', 'EXP-230922-4', 301, 0, 'Hosting Purchase', 7500, '2023-09-21 00:00:00', 101, 1, 1, 101, '2023-09-22 06:12:40', '2023-09-22 06:12:40'),
(5, '985ad0ec8e5e8886fbdf102826e93e34', 'EXP-230922-5', 301, 0, 'Travel and Marketting', 2000, '2023-09-21 00:00:00', 101, 1, 1, 101, '2023-09-22 06:15:24', '2023-09-22 06:15:24'),
(6, 'c788da76370b59b709db0f424f21e952', 'EXP-230922-6', 315, 0, 'Marketting and Travel', 2000, '2023-09-13 00:00:00', 101, 1, 1, 101, '2023-09-22 06:36:32', '2023-09-22 06:36:32'),
(7, '7f982b4fbe560216a803d9aa945c0fb3', 'EXP-230922-7', 316, 0, 'Gheekamala high school', 1610, '2023-09-19 00:00:00', 101, 1, 1, 101, '2023-09-22 07:11:48', '2023-09-22 07:11:48'),
(8, 'ec51895c5e286c38a8bf5600925a7e20', 'EXP-230922-8', 316, 0, 'Amzad Ali school', 1610, '2023-09-20 00:00:00', 101, 1, 1, 101, '2023-09-22 07:12:35', '2023-09-22 07:12:35'),
(9, '0ab3d56635500e34a31bf6f542cce0c6', 'EXP-230924-9', 316, 0, 'talkhari', 1610, '2023-09-23 00:00:00', 101, 1, 1, 101, '2023-09-24 07:46:48', '2023-09-24 07:46:48'),
(10, 'd82fef4ee5545e1a091c70e98206fbc3', 'EXP-230924-10', 316, 0, 'abhayacharan', 1610, '2023-09-23 00:00:00', 101, 1, 1, 101, '2023-09-24 07:47:26', '2023-09-24 07:47:26'),
(11, 'dcf42566b7dd6d70760b619fe77985bb', 'EXP-230924-11', 316, 0, 'nababpur', 1610, '2023-09-24 00:00:00', 101, 1, 1, 101, '2023-09-24 07:47:50', '2023-09-24 07:47:50'),
(12, 'a615ad57796e191ebc8df2e9ede2f9ae', 'EXP-230925-12', 302, 0, 'shamiran biswas', 2000, '2023-09-25 00:00:00', 101, 1, 1, 101, '2023-09-25 05:22:10', '2023-09-25 05:22:10'),
(13, 'b38f2becc450fc43b1ff6264f395a4f4', 'EXP-230926-13', 316, 0, 'baliakandidm', 1610, '2023-09-26 00:00:00', 101, 1, 1, 101, '2023-09-26 07:02:23', '2023-09-26 07:02:23'),
(19, '0b1cb1c4900d250b0ea9a77513227985', 'EXP-231001-18', 316, 0, 'baulia high school', 1610, '2023-10-01 00:00:00', 101, 1, 1, 101, '2023-10-01 04:49:38', '2023-10-01 04:49:38'),
(15, '2d5ba1df8bb34fbb8ffb52824ada51e8', 'EXP-230926-15', 316, 0, 'sadashipur d m', 1610, '2023-09-24 00:00:00', 101, 1, 1, 101, '2023-09-26 07:07:37', '2023-09-26 07:07:37'),
(16, '9aa57de353d9c41b48ad72d80420d50d', 'EXP-230926-16', 315, 0, 'fazla rabby', 1000, '2023-09-25 00:00:00', 101, 1, 1, 101, '2023-09-26 07:11:49', '2023-09-26 07:11:49'),
(17, 'ad65bdc5461fd48ecc72603afd75d9a7', 'EXP-230926-17', 316, 0, 'ssgsac.edu.bd', 1610, '2023-09-26 00:00:00', 101, 1, 1, 101, '2023-09-26 07:43:33', '2023-09-26 07:43:33'),
(18, '2ff6a04ce558d0508f63a1acc0c99679', 'EXP-230927-18', 316, 0, 'shalmara D M', 1610, '2023-09-27 00:00:00', 101, 1, 1, 101, '2023-09-27 06:24:07', '2023-09-27 06:24:07'),
(20, '086ce66235f2cf1e5459cd1ea36e9107', 'EXP-231001-19', 316, 0, 'baduli khalkula madrasa', 1610, '2023-10-01 00:00:00', 101, 1, 1, 101, '2023-10-01 04:57:38', '2023-10-01 04:57:38'),
(21, '973309ca6b51b28dd092cfc2a4346140', 'EXP-231001-20', 316, 0, 'tentlia madrasa', 1610, '2023-10-01 00:00:00', 101, 1, 1, 101, '2023-10-01 05:28:30', '2023-10-01 05:28:30'),
(22, '362f835131140e2135812be49865ee63', 'EXP-231001-21', 301, 0, 'hosting purchase', 1500, '2023-10-01 00:00:00', 101, 1, 1, 101, '2023-10-01 05:31:46', '2023-10-01 05:31:46'),
(23, 'ede922f2ff7105517152b9912bdd1cdb', 'EXP-231003-22', 316, 0, 'sorusuna high school', 1610, '2023-10-03 00:00:00', 101, 1, 1, 101, '2023-10-03 06:30:51', '2023-10-03 06:30:51'),
(24, 'c1be6f766c1089d1d759f00d9bf2ef7b', 'EXP-231003-23', 315, 0, 'fazla rabby', 1150, '2023-10-03 00:00:00', 101, 1, 1, 101, '2023-10-03 06:47:50', '2023-10-03 06:47:50'),
(25, '2f3af4a7281d575c253586ff1969f81a', 'EXP-231004-24', 316, 0, 'boro ghee M', 1610, '2023-10-04 00:00:00', 101, 1, 1, 101, '2023-10-04 06:05:23', '2023-10-04 06:05:23'),
(26, '02b37c9f001b47b6d3f97dd50feb3e20', 'EXP-231007-25', 301, 0, 'arifur', 2000, '2023-10-05 00:00:00', 101, 1, 1, 101, '2023-10-06 22:30:08', '2023-10-06 22:30:08'),
(27, 'dc6184ff4ff3333a640c586b0659a994', 'EXP-231007-26', 316, 0, 'sadipur f  m', 1610, '2023-10-06 00:00:00', 101, 1, 1, 101, '2023-10-06 22:31:20', '2023-10-06 22:31:20'),
(28, 'a75808b09f55a2a9cf1623ad700ef5e7', 'EXP-231008-27', 301, 0, 'fazle rabby', 2000, '2023-10-08 00:00:00', 101, 1, 1, 101, '2023-10-08 06:57:40', '2023-10-08 06:57:40'),
(29, '857c0563e42f7f09aad0d44d369551d6', 'EXP-231008-28', 315, 0, 'marketting', 1500, '2023-10-08 00:00:00', 101, 1, 1, 101, '2023-10-08 06:58:34', '2023-10-08 06:58:34'),
(30, '98693bec90fa98bc0e80fe53725253ab', 'EXP-231009-29', 316, 0, 'shalikha high school', 1610, '2023-10-09 00:00:00', 101, 1, 1, 101, '2023-10-09 08:37:27', '2023-10-09 08:37:27'),
(31, 'd7949554dadfaa68327f74fc4b512deb', 'EXP-231009-30', 316, 0, 'pulum high school', 1610, '2023-10-09 00:00:00', 101, 1, 1, 101, '2023-10-09 08:38:07', '2023-10-09 08:38:07'),
(32, '43a3a74b7fb596443cb6a3cc8dc808ce', 'EXP-231009-31', 316, 0, 'kuchiyamara high school', 1610, '2023-10-09 00:00:00', 101, 1, 1, 101, '2023-10-09 08:39:02', '2023-10-09 08:39:02'),
(33, '386a4691577507a52e2bcde3169c1f7b', 'EXP-231009-32', 316, 0, 'bhogirathpur dakhil  madasa', 1610, '2023-10-09 00:00:00', 101, 1, 1, 101, '2023-10-09 08:40:10', '2023-10-09 08:40:10'),
(34, '042c0646cc77abfcabecf5d12af02f9a', 'EXP-231010-33', 316, 0, 'potora high school', 1610, '2023-10-10 00:00:00', 101, 1, 1, 101, '2023-10-09 22:46:42', '2023-10-09 22:46:42'),
(35, '11f0af3bafb868a614adb92657abc8b4', 'EXP-231011-34', 302, 0, 'shamiran biswas', 3200, '2023-10-11 00:00:00', 101, 1, 1, 101, '2023-10-10 22:12:13', '2023-10-10 22:12:13'),
(36, 'ac6642519f8e0ab5efe8356d56411a53', 'EXP-231011-35', 316, 0, 'gangarampur high school', 1610, '2023-10-11 00:00:00', 101, 1, 1, 101, '2023-10-10 22:28:13', '2023-10-10 22:28:13'),
(37, '805f322f97a109ac485b9e3d13a7cd03', 'EXP-231011-36', 316, 0, 'natapara dakhil madrasa', 1610, '2023-10-11 00:00:00', 101, 1, 1, 101, '2023-10-11 03:59:08', '2023-10-11 03:59:08'),
(38, '3321c0c40695fc2654f457ce49af66a9', 'EXP-231011-37', 316, 0, 'ahladipur dakhil madrasa', 1610, '2023-10-11 00:00:00', 101, 1, 1, 101, '2023-10-11 09:43:43', '2023-10-11 09:43:43'),
(39, 'e3d6d81a299f830661ae384280c402e9', 'EXP-231012-38', 301, 0, 'yasin for application', 500, '2023-10-12 00:00:00', 101, 1, 1, 101, '2023-10-12 06:47:45', '2023-10-12 06:47:45'),
(40, 'c2a93eb236764f2c860be7e2d3ca38a2', 'EXP-231013-39', 301, 0, 'Arifur Rahman', 2000, '2023-10-14 00:00:00', 101, 1, 1, 101, '2023-10-13 11:42:05', '2023-10-13 11:42:05'),
(41, 'f221e69dac853768904b3df46489936b', 'EXP-231014-40', 316, 0, 'Boro hijli  madrasa', 1610, '2023-10-14 00:00:00', 101, 1, 1, 101, '2023-10-14 01:14:14', '2023-10-14 01:14:14'),
(42, 'efe2a04591d4f70675ac9717de2a4dab', 'EXP-231014-41', 316, 0, 'patkiabari dakhil madrasa', 1610, '2023-10-14 00:00:00', 101, 1, 1, 101, '2023-10-14 01:31:09', '2023-10-14 01:31:09'),
(43, '0c7a8a5dd38d62de3726c7728130669c', 'EXP-231017-42', 302, 0, 'samiran biswas', 3000, '2023-10-17 00:00:00', 101, 1, 1, 101, '2023-10-17 05:52:09', '2023-10-17 05:52:09'),
(44, '65d14d92a70d6ea4b66011bfbf1ead6d', 'EXP-231017-43', 315, 0, 'fazla rabby', 2000, '2023-10-16 00:00:00', 101, 1, 1, 101, '2023-10-17 05:52:43', '2023-10-17 05:52:43'),
(45, '7acad4114e56085817ce49b1840b6b46', 'EXP-231019-44', 302, 0, 'arifur', 4000, '2023-10-19 00:00:00', 101, 1, 1, 101, '2023-10-19 06:01:47', '2023-10-19 06:01:47'),
(46, '37e3e0803a1d44d4fd4174110a7f67a2', 'EXP-231022-45', 302, 0, 'fazla rabby', 10000, '2023-10-22 00:00:00', 101, 1, 1, 101, '2023-10-21 23:17:28', '2023-10-21 23:17:28'),
(47, '0e86a9ef64bcd700094fe323a854876f', 'EXP-231022-46', 316, 0, 'kallayanpur dakhil madrasa', 1610, '2023-10-22 00:00:00', 101, 1, 1, 101, '2023-10-21 23:18:26', '2023-10-21 23:18:26'),
(48, 'ef0f828fc9445a4f0b49494c0e717a96', 'EXP-231023-47', 315, 0, 'fazla rabby', 2000, '2023-10-22 00:00:00', 101, 1, 1, 101, '2023-10-22 21:08:46', '2023-10-22 21:08:46'),
(49, '06073929d7c019de34ad56d06e25a0fd', 'EXP-231026-48', 315, 0, 'fazla rabby', 1500, '2023-10-26 00:00:00', 101, 1, 1, 101, '2023-10-26 07:15:41', '2023-10-26 07:15:41'),
(50, '50686f79983a0c14155b2dbaa897a7e1', 'EXP-231101-49', 302, 0, 'arifur', 2000, '2023-11-01 00:00:00', 101, 1, 1, 101, '2023-11-01 05:54:43', '2023-11-01 05:54:43'),
(51, 'dbea9837d0028e4a270c2d38b1a3ff5a', 'EXP-231101-50', 315, 0, 'fazle rabby', 2000, '2023-11-01 00:00:00', 101, 1, 1, 101, '2023-11-01 05:56:15', '2023-11-01 05:56:15'),
(52, '5ac86e4fe8ddc5774a5ca1a960a2610a', 'EXP-231101-51', 316, 0, 'goyalonda dakhil madrasa', 1610, '2023-11-01 00:00:00', 101, 1, 1, 101, '2023-11-01 06:16:21', '2023-11-01 06:16:21'),
(53, 'd19066b49112d914e4fdded20336b290', 'EXP-231104-52', 302, 0, 'Fazla rabby', 3000, '2023-11-04 00:00:00', 101, 1, 1, 101, '2023-11-04 05:43:20', '2023-11-04 05:43:20'),
(54, 'a26305f577c0d4fdb160c92f5b137823', 'EXP-231105-53', 315, 0, 'Fazla rabby', 2500, '2023-11-05 00:00:00', 101, 1, 1, 101, '2023-11-05 03:36:23', '2023-11-05 03:36:23'),
(55, '4c74240b7dc297757f13a62127f22e6d', 'EXP-231105-54', 316, 0, 'Sreepur kamil madrasa', 1610, '2023-11-05 00:00:00', 101, 1, 1, 101, '2023-11-05 08:40:44', '2023-11-05 08:40:44'),
(56, '3fb6892abdae34a6eaaf9971d07421c7', 'EXP-231106-55', 316, 0, 'Khankhanapur dakhil madrasa', 1610, '2023-11-06 00:00:00', 101, 1, 1, 101, '2023-11-06 06:55:45', '2023-11-06 06:55:45'),
(57, '81e735f5ee2461786a464958b7ef865e', 'EXP-231107-56', 302, 0, 'Fazla rabby for bike', 15000, '2023-11-07 00:00:00', 101, 1, 1, 101, '2023-11-06 20:16:18', '2023-11-06 20:16:18'),
(58, '4534754945ebde695d653244081aaacc', 'EXP-231109-57', 302, 0, 'Fazla rabby', 2000, '2023-11-06 00:00:00', 101, 1, 1, 101, '2023-11-09 00:06:19', '2023-11-09 00:06:19'),
(59, '0daf6e07adea74d90d3599d40e931680', 'EXP-231109-58', 302, 0, 'Fazla rabby for bike', 15000, '2023-11-09 00:00:00', 101, 1, 1, 101, '2023-11-09 00:07:07', '2023-11-09 00:07:07'),
(60, '9e5c395b8380fb098d5ed0995c75a5ae', 'EXP-231109-59', 316, 0, 'Shalmara high school', 1610, '2023-11-09 00:00:00', 101, 1, 1, 101, '2023-11-09 00:08:24', '2023-11-09 00:08:24'),
(61, '54ad4916d2c1d277e3799977d6c4ee36', 'EXP-231109-60', 316, 0, 'Belgaci dakhil madrasa', 1610, '2023-11-09 00:00:00', 101, 1, 1, 101, '2023-11-09 00:37:06', '2023-11-09 00:37:06'),
(62, '243f56808c6408b69283e08138f0c5d3', 'EXP-231114-61', 302, 0, 'Fazla rabby for bike', 5000, '2023-11-14 00:00:00', 101, 1, 1, 101, '2023-11-14 06:44:36', '2023-11-14 06:44:36'),
(63, '4b483a444a9b8114b93cea7e4a8373f9', 'EXP-231114-62', 315, 0, 'Fazla rabby', 2500, '2023-11-14 00:00:00', 101, 1, 1, 101, '2023-11-14 06:45:05', '2023-11-14 06:45:05'),
(64, '7e7a97d39eb8b4233948ff36b58e7ffa', 'EXP-231119-63', 302, 0, 'Yeasin', 2500, '2023-11-19 00:00:00', 101, 1, 1, 101, '2023-11-19 06:47:01', '2023-11-19 06:47:01'),
(65, 'bab5dfaa0e43836eeb6d441109c08a59', 'EXP-231119-64', 315, 0, 'Fazla rabby', 1240, '2023-11-19 00:00:00', 101, 1, 1, 101, '2023-11-19 06:47:47', '2023-11-19 06:47:47'),
(66, '8e08abafd3551a3a46d05c858d4b46be', 'EXP-231122-65', 315, 0, 'fazla rabby', 1200, '2023-11-22 00:00:00', 101, 1, 1, 101, '2023-11-22 06:13:34', '2023-11-22 06:13:34'),
(67, '5bf67650530f4b31a5da9e793fe1b4b1', 'EXP-231122-66', 316, 0, 'bethulia dakhil madrasa', 1610, '2023-11-22 00:00:00', 101, 1, 1, 101, '2023-11-22 06:15:28', '2023-11-22 06:15:28'),
(68, 'b7ded721950dbf00270c40effc9909b9', 'EXP-231124-67', 302, 0, 'Yeasin', 1000, '2023-11-23 00:00:00', 101, 1, 1, 101, '2023-11-23 21:26:16', '2023-11-23 21:26:16'),
(69, '6fb72034fd3e61a41d542932a720162a', 'EXP-231124-68', 316, 0, 'Poijur dakhil madrasa', 1610, '2023-11-23 00:00:00', 101, 1, 1, 101, '2023-11-23 21:26:51', '2023-11-23 21:26:51'),
(70, '2df9c2073bce15b8f8ad4f0dbd20c20d', 'EXP-231128-69', 315, 0, 'Fazla rabby', 2500, '2023-11-26 00:00:00', 101, 1, 1, 101, '2023-11-28 01:17:13', '2023-11-28 01:17:13'),
(71, 'e28ab5b7b28cfd3c1f1ffa45b22f5777', 'EXP-231129-70', 316, 0, 'Varat alim madrasa', 1610, '2023-11-29 00:00:00', 101, 1, 1, 101, '2023-11-29 03:30:37', '2023-11-29 03:30:37'),
(72, '64eef7965a02bbb1553dd985699e2bf3', 'EXP-231129-71', 316, 0, 'Majbari alim madrasa', 1610, '2023-11-29 00:00:00', 101, 1, 1, 101, '2023-11-29 03:31:27', '2023-11-29 03:31:27'),
(73, 'd819203695906c9b206cff77bf896172', 'EXP-231202-72', 302, 0, 'Arifur rahman', 1000, '2024-01-02 00:00:00', 101, 1, 1, 101, '2023-12-01 20:50:09', '2023-12-01 20:50:09'),
(74, '12e6600d84eb555f4afbc6bf642b5972', 'EXP-231205-73', 315, 0, 'Fazla rabby', 2500, '2023-12-05 00:00:00', 101, 1, 1, 101, '2023-12-05 08:34:17', '2023-12-05 08:34:17'),
(75, '6e72a571cffe6f24df8883472417862c', 'EXP-231214-74', 302, 0, 'yasin', 500, '2023-12-11 00:00:00', 101, 1, 1, 101, '2023-12-14 00:28:41', '2023-12-14 00:28:41'),
(76, '9ef9aeab92791e0f453c232e0ad5646f', 'EXP-231214-75', 315, 0, 'fazla rabby', 2500, '2023-12-11 00:00:00', 101, 1, 1, 101, '2023-12-14 00:29:35', '2023-12-14 00:29:35'),
(77, '046044cfe349d04952fb7469059d342a', 'EXP-231214-76', 301, 0, 'magura', 500, '2023-12-11 00:00:00', 101, 1, 1, 101, '2023-12-14 00:31:09', '2023-12-14 00:31:09'),
(78, '376f48c171497fda312c938762317859', 'EXP-231214-77', 315, 0, 'fazla rabby', 550, '2023-12-14 00:00:00', 101, 1, 1, 101, '2023-12-14 00:32:08', '2023-12-14 00:32:08'),
(79, 'ea944e4d316d6a2bf9160f965d0403c0', 'EXP-231218-78', 302, 0, 'rabby for bike', 10000, '2023-12-18 00:00:00', 101, 1, 1, 101, '2023-12-18 05:24:48', '2023-12-18 05:24:48'),
(80, '0ce7c89fe8e006124b74f9932373d135', 'EXP-231218-79', 316, 0, 'goalanda pilot high', 1610, '2023-12-18 00:00:00', 101, 1, 1, 101, '2023-12-18 05:25:47', '2023-12-18 05:25:47'),
(81, '7b7c724747395d3d98c860d3069d347b', 'EXP-240104-80', 315, 0, 'Fazla rabby', 2500, '2024-01-04 00:00:00', 101, 1, 1, 101, '2024-01-04 08:30:41', '2024-01-04 08:30:41'),
(82, '66791378c2f8b18ef7f1a2340a04b098', 'EXP-240104-81', 316, 0, 'Idrish dakhil madrasa', 1610, '2024-01-04 00:00:00', 101, 1, 1, 101, '2024-01-04 08:34:23', '2024-01-04 08:34:23'),
(83, '908d0ba0992713411c38ff3611009e32', 'EXP-240104-82', 301, 0, 'Fazla rabby', 500, '2024-01-04 00:00:00', 101, 1, 1, 101, '2024-01-04 08:48:18', '2024-01-04 08:48:18'),
(84, '073f4a053fabc561e9d35e2d0b854701', 'EXP-240104-83', 301, 0, 'Fazla rabby', 500, '2024-01-04 00:00:00', 101, 1, 1, 101, '2024-01-04 08:48:29', '2024-01-04 08:48:29'),
(85, 'f7922150d9fab0e9acf0de0329a54f9a', 'EXP-240114-84', 315, 0, 'Fazla rabby', 2500, '2024-01-14 00:00:00', 101, 1, 1, 101, '2024-01-14 11:05:27', '2024-01-14 11:05:27'),
(86, 'c8230647a5e2ad2c3632a312ce888a2e', 'EXP-240114-85', 302, 0, 'Fazla rabby', 3000, '2024-01-14 00:00:00', 101, 1, 1, 101, '2024-01-14 11:06:04', '2024-01-14 11:06:04'),
(87, '038e9c0cb8e5c455847bdfc65809f117', 'EXP-240131-86', 315, 0, 'Fazla rabby', 2500, '2024-01-31 00:00:00', 101, 1, 1, 101, '2024-01-31 08:59:14', '2024-01-31 08:59:14'),
(88, '829edec3d08b5ebc3d748dbad336d7d2', 'EXP-240131-87', 301, 0, 'Arifur', 2000, '2024-01-31 00:00:00', 101, 1, 1, 101, '2024-01-31 08:59:56', '2024-01-31 08:59:56'),
(89, '00e81e2ba7c63814c3c26ba84f77f09f', 'EXP-240131-88', 302, 0, 'Fazle rabby', 1500, '2024-01-31 00:00:00', 101, 1, 1, 101, '2024-01-31 09:02:58', '2024-01-31 09:02:58'),
(90, '52e828e241fcfb20934410be91d91ad4', 'EXP-240222-89', 315, 0, 'Fazla rabby', 2500, '2024-02-22 00:00:00', 101, 1, 1, 101, '2024-02-21 22:46:26', '2024-02-21 22:46:26'),
(91, '849642956c5fdfe16a7f5bbe1f4347f0', 'EXP-240314-90', 316, 0, 'Faridpur city College', 2875, '2024-03-13 00:00:00', 101, 1, 1, 101, '2024-03-13 21:10:27', '2024-03-13 21:10:27'),
(92, 'ecff3fb04fb76c46a55fa8eea732776e', 'EXP-240314-91', 302, 0, 'Arifur Rahman', 1000, '2024-03-14 00:00:00', 101, 1, 1, 101, '2024-03-13 21:11:06', '2024-03-13 21:11:06'),
(93, '0074dab6bc404db1f1b6fe772ed9e953', 'EXP-240314-92', 302, 0, 'Fazla rabby', 1000, '2024-03-13 00:00:00', 101, 1, 1, 101, '2024-03-13 21:11:39', '2024-03-13 21:11:39'),
(94, '706ce17d236db221d12ef1ecda42e777', 'EXP-240314-93', 315, 0, 'Fazla rabby', 1500, '2024-03-13 00:00:00', 101, 1, 1, 101, '2024-03-13 21:12:31', '2024-03-13 21:12:31'),
(95, '20f03d39eb23719c18eb9c46607353c4', 'EXP-240314-93', 315, 0, 'Fazla rabby', 1500, '2024-03-13 00:00:00', 101, 1, 1, 101, '2024-03-13 21:12:32', '2024-03-13 21:12:32'),
(96, '959358bd17942ef224ea6dcdaa334c7b', 'EXP-240402-95', 316, 0, 'Npif', 160, '2024-04-02 00:00:00', 101, 1, 1, 101, '2024-04-02 02:36:19', '2024-04-02 02:36:19'),
(97, '371ff574d4e26c65069f02f3864f0233', 'EXP-240402-96', 316, 0, 'Npif', 1610, '2024-04-02 00:00:00', 101, 1, 1, 101, '2024-04-02 02:37:08', '2024-04-02 02:37:08'),
(98, '46906b999ac4b1a478752c405ea88847', 'EXP-240520-97', 302, 0, 'Arifur Rahman', 3000, '2024-04-10 00:00:00', 101, 1, 1, 101, '2024-05-20 02:57:11', '2024-05-20 02:57:11'),
(99, 'de08aade9549c2460b73771a7f52dcaf', 'EXP-240520-98', 302, 0, 'Fazla rabby', 7000, '2024-04-10 00:00:00', 101, 1, 1, 101, '2024-05-20 02:58:03', '2024-05-20 02:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_title_bn` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_email` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_phone` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_phone1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_phone2` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_fax` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_address` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_country` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_currency` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_currency_sign` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_facebook` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_twitter` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_google` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_linkedin` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_youtube` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_copyright` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `company_logo` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `store_id` int NOT NULL,
  `company_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `general_settings_company_hash_id_unique` (`company_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `shelf_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `shelf_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `shelf_status` tinyint(1) NOT NULL DEFAULT '0',
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_shelf_hash_id_unique` (`shelf_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `shelf_hash_id`, `shelf_name`, `shelf_status`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '2510d58ea825da2a50a9bf8e55bbe98d', 'Godown 1', 1, 101, '2023-05-02 02:54:31', '2023-05-02 02:54:31'),
(3, 'd5962457b2ee554061885a57ae181c60', 'tse', 1, 101, '2024-09-07 01:15:26', '2024-09-07 01:15:26'),
(4, '89860b05b631998a0b7ffeff5f31cc77', 'test', 1, 101, '2024-09-07 01:18:12', '2024-09-07 01:18:12'),
(5, 'ca2df8c8463c8aff0cd011c388c0f9a3', 'fddf', 1, 101, '2024-09-07 01:18:47', '2024-09-07 01:18:47'),
(6, 'e787c9bd63dab00cc4a41192faa96dcd', 'hfgh', 1, 101, '2024-09-07 01:20:34', '2024-09-07 01:20:34'),
(7, 'c83699da9e5f2bbcd6b5881e2b476f7d', 'jj', 1, 101, '2024-09-07 01:33:16', '2024-09-07 01:33:16'),
(8, 'c19d65c14b1eff37fc6a5a63a6b45645', 'hgha', 1, 101, '2024-09-07 01:42:34', '2024-09-07 01:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacturer_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `manufacturer_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `manufacturer_status` tinyint(1) NOT NULL DEFAULT '0',
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `manufacturers_manufacturer_hash_id_unique` (`manufacturer_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `manufacturer_hash_id`, `manufacturer_name`, `manufacturer_status`, `store_id`, `created_at`, `updated_at`) VALUES
(5, 'c01da0191deee73415f4fa1a6f1d4a7a', 'IconBangla', 1, 101, '2023-09-09 12:03:03', '2023-09-09 12:03:03'),
(9, '707ef14b0fd923ada842be0d21dfa4a0', 'tes', 1, 101, '2024-08-23 23:56:49', '2024-08-23 23:56:49'),
(10, '332914d05c1939b7c02c79b8f8501f41', 'tss', 1, 101, '2024-08-24 00:15:45', '2024-08-24 00:15:45'),
(11, '55d22a5cf4d20670327d6a24f81cf75b', 'gg', 1, 101, '2024-09-07 01:32:50', '2024-09-07 01:32:50'),
(12, '5623553234dc1975a1a3d34e027b47ad', 'hh', 1, 101, '2024-09-07 01:33:02', '2024-09-07 01:33:02'),
(13, '65b8e42504061c954075fe1a1d10155c', 'jj', 1, 101, '2024-09-07 01:33:19', '2024-09-07 01:33:19'),
(14, '80532b7fcb5978bee8b41f879403afac', 'hgh', 1, 101, '2024-09-07 01:34:30', '2024-09-07 01:34:30'),
(15, 'a3f2e3981c2fc12271cad3d4a30b1599', 'hfhf', 1, 101, '2024-09-07 01:35:26', '2024-09-07 01:35:26'),
(16, 'd337c5d01f57d9f6a3b35a2b4dda0df4', 'tgt', 1, 101, '2024-09-07 01:36:05', '2024-09-07 01:36:05'),
(17, '9a8572f77a07a9fa8a53f39d28cd7c40', 'hhh', 1, 101, '2024-09-07 01:38:53', '2024-09-07 01:38:53'),
(18, '4e0badb37dddbf82d8be22712ed74de2', 'jjjj', 1, 101, '2024-09-07 01:39:12', '2024-09-07 01:39:12'),
(19, '4eac77b09fc43114ced43438c72a5f18', 'hgthg', 1, 101, '2024-09-07 01:39:54', '2024-09-07 01:39:54'),
(20, '10df265589d8dedb3f79d4eb4d83f780', 'gat', 1, 101, '2024-09-07 01:42:18', '2024-09-07 01:42:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(37, '2023_03_01_085120_create_expenditures_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `opening_balances`
--

DROP TABLE IF EXISTS `opening_balances`;
CREATE TABLE IF NOT EXISTS `opening_balances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ob_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `invoice_no` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `category` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `account_id` int NOT NULL,
  `amount` bigint UNSIGNED NOT NULL DEFAULT '0',
  `entry_date` datetime DEFAULT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `opening_balances_ob_hash_id_unique` (`ob_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `opening_balances`
--

INSERT INTO `opening_balances` (`id`, `ob_hash_id`, `invoice_no`, `category`, `description`, `account_id`, `amount`, `entry_date`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '1f7ff2a953b800e0ed4b3419b7d6f3fa', 'OB-230519-1', 'supplier', 'Purchased', 214, 1000, '2023-05-01 00:00:00', 101, '2023-05-19 07:47:47', '2023-05-19 07:47:47'),
(2, 'e2703fbf63c992270b24381b3c55124c', 'OB-230519-2', 'customer', 'Sale', 125, 800, '2023-05-24 00:00:00', 101, '2023-05-19 07:48:13', '2023-05-19 07:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_hash_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `manufacturer_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `unit_id` bigint UNSIGNED NOT NULL,
  `location_id` bigint UNSIGNED DEFAULT NULL,
  `product_title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title_slug` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pdt_description` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `product_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `product_status` tinyint NOT NULL DEFAULT '1',
  `total_quantity` bigint NOT NULL DEFAULT '0',
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_manufacturer_id_foreign` (`manufacturer_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  KEY `products_unit_id_foreign` (`unit_id`),
  KEY `products_location_id_foreign` (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_hash_id`, `barcode`, `manufacturer_id`, `category_id`, `brand_id`, `unit_id`, `location_id`, `product_title`, `title_slug`, `pdt_description`, `product_image`, `product_status`, `total_quantity`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '1b1e95a3b9bdd04e75bf7d9a6cc0a25e', '32291686', 5, 8, 9, 8, NULL, 'Dynamic School Website Making+hosting', 'dynamic-school-website-making-hosting', NULL, '', 1, 0, 101, '2023-09-09 13:11:18', '2023-09-09 13:11:18'),
(2, '06ecc1f7eb7faaac71a6df163b051f62', '59880785', 5, 8, 9, 8, NULL, 'Dynamic School Website Making', 'dynamic-school-website-making', NULL, '', 1, 0, 101, '2023-09-13 08:33:43', '2023-09-13 08:33:43'),
(3, 'f72582646fae74fb775638427079b321', '28903710', 5, 8, 9, 8, NULL, 'Domain and Hosting', 'domain-and-hosting', NULL, '', 1, 0, 101, '2023-09-13 08:34:43', '2023-09-13 08:34:43'),
(4, '3cec3623d5f9528b2a8b727f07affd37', '01712', 5, 9, 9, 9, NULL, 'Anamul Fan', 'anamul-fan', NULL, '', 1, 0, 101, '2023-10-02 05:07:10', '2023-10-02 05:07:10'),
(5, '669c4cc26213dbec88cf2926276ec0cf', '54039273', 20, 28, 16, 16, NULL, 'tes', 'tes', NULL, '', 1, 0, 101, '2024-09-07 01:42:55', '2024-09-07 01:42:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

DROP TABLE IF EXISTS `product_stocks`;
CREATE TABLE IF NOT EXISTS `product_stocks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pdt_stock_hash_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `invoice_no` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `product_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `shelf_id` int DEFAULT NULL,
  `tax_id` int NOT NULL DEFAULT '0',
  `tax_value_percent` float NOT NULL DEFAULT '0',
  `serial_no` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `batch_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `stckpdt_image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `quantity` double NOT NULL,
  `buy_price` double NOT NULL DEFAULT '0',
  `buy_price_with_tax` double NOT NULL,
  `sell_price` double NOT NULL DEFAULT '0',
  `purchase_date` timestamp NULL DEFAULT NULL,
  `expired_date` timestamp NULL DEFAULT NULL,
  `post_by` int NOT NULL,
  `store_id` int NOT NULL,
  `pdtstk_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_stocks_product_id_foreign` (`product_id`),
  KEY `product_stocks_supplier_id_foreign` (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `pdt_stock_hash_id`, `invoice_no`, `product_type`, `barcode`, `product_id`, `supplier_id`, `shelf_id`, `tax_id`, `tax_value_percent`, `serial_no`, `batch_no`, `size`, `color`, `stckpdt_image`, `quantity`, `buy_price`, `buy_price_with_tax`, `sell_price`, `purchase_date`, `expired_date`, `post_by`, `store_id`, `pdtstk_status`, `created_at`, `updated_at`) VALUES
(1, '28a96bb8cf952475a7ad79ad54f35571', 'Initial Stock', NULL, '85566890', 1, 1, NULL, 0, 0, NULL, 'B-29816983', NULL, NULL, '', 951, 3000, 3000, 0, '2023-09-09 13:12:02', '2023-09-09 13:12:02', 1, 101, 1, '2023-09-09 13:12:02', '2023-09-09 13:12:02'),
(2, 'e7b6cd09226a185c7be99e64202b360d', 'Initial Stock', NULL, '30339048', 2, 1, NULL, 0, 0, NULL, 'B-12199039', NULL, NULL, '', 1000, 3000, 3000, 0, '2023-09-13 08:34:09', '2023-09-13 08:34:09', 1, 101, 1, '2023-09-13 08:34:09', '2023-09-13 08:34:09'),
(3, '46633bc5ff9605dfd012d1c003206b8a', 'Initial Stock', NULL, '79715628', 3, 1, NULL, 0, 0, NULL, 'B-25558573', NULL, NULL, '', 1000, 2000, 2000, 0, '2023-09-13 08:35:02', '2023-09-13 08:35:02', 1, 101, 1, '2023-09-13 08:35:02', '2023-09-13 08:35:02'),
(4, 'b74313e43623ade03498fade35890abc', 'Initial Stock', NULL, '52934389', 4, NULL, NULL, 0, 0, NULL, 'B-49819594', NULL, NULL, '', 10, 0, 0, 0, '2023-10-02 05:07:17', '2023-10-02 05:07:17', 1, 101, 1, '2023-10-02 05:07:17', '2023-10-02 05:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` int NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trns_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0',
  `due` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `paid` double NOT NULL DEFAULT '0',
  `purchase_status` int NOT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `supplier_id`, `invoice_no`, `trns_type`, `description`, `total`, `due`, `discount`, `paid`, `purchase_status`, `purchase_date`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'PI-230503-1', '1', NULL, 264, 264, 0, 0, 1, '2023-05-04 00:00:00', 101, '2023-05-03 01:05:40', '2023-05-03 01:05:40'),
(2, 1, 'PI-230519-2', '1', NULL, 8454, 8454, 0, 0, 1, '2023-05-19 13:32:28', 101, '2023-05-19 07:33:24', '2023-05-19 07:33:24'),
(3, 1, 'OB-230519-1', '1', 'Opening Balance', 1000, 1000, 0, 0, 1, '2023-05-19 00:00:00', 101, '2023-05-19 07:47:47', '2023-05-19 07:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

DROP TABLE IF EXISTS `purchase_returns`;
CREATE TABLE IF NOT EXISTS `purchase_returns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pr_hash_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `supplier_id` int NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pi_invoice` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `product_id` int NOT NULL,
  `pdtstock_id` int NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `pur_return_status` int NOT NULL,
  `store_id` int NOT NULL,
  `return_date` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trns_type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0',
  `due` double NOT NULL DEFAULT '0',
  `discount` double NOT NULL DEFAULT '0',
  `paid` double NOT NULL DEFAULT '0',
  `sale_status` int NOT NULL,
  `check_pending` int NOT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `invoice_no`, `trns_type`, `description`, `total`, `due`, `discount`, `paid`, `sale_status`, `check_pending`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 128, 'SI-230914-1', 'Cash', '', 6000, 4400, 0, 1600, 1, 0, 101, '2023-09-13 23:17:18', '2023-09-13 23:17:18'),
(2, 130, 'SI-230914-2', 'Cash', '', 6000, 3000, 0, 3000, 1, 0, 101, '2023-09-14 00:29:04', '2023-09-14 00:29:04'),
(3, 129, 'SI-230914-3', 'Cash', '', 6000, 4400, 0, 1600, 1, 0, 101, '2023-09-14 00:29:35', '2023-09-14 00:29:35'),
(4, 131, 'SI-230914-4', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-09-14 03:02:43', '2023-09-14 03:02:43'),
(5, 131, 'SI-230914-4', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-09-14 23:27:39', '2023-09-14 23:27:39'),
(6, 132, 'SI-230915-6', 'Cash', '', 6000, 3500, 0, 2500, 1, 0, 101, '2023-09-14 23:33:09', '2023-09-14 23:33:09'),
(7, 133, 'SI-230915-7', 'Cash', '', 6000, 4400, 0, 1600, 1, 0, 101, '2023-09-14 23:34:04', '2023-09-14 23:34:04'),
(8, 134, 'SI-230917-8', 'Cash', '', 6000, 3000, 0, 3000, 1, 0, 101, '2023-09-17 09:39:24', '2023-09-17 09:39:24'),
(9, 135, 'SI-230922-9', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-09-22 06:03:24', '2023-09-22 06:03:24'),
(10, 138, 'SI-230922-10', 'Cash', '', 6000, 5000, 0, 1000, 1, 0, 101, '2023-09-22 06:04:16', '2023-09-22 06:04:16'),
(11, 137, 'SI-230922-11', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-09-22 06:05:25', '2023-09-22 06:05:25'),
(12, 136, 'SI-230922-12', 'Cash', '', 6000, 3000, 0, 3000, 1, 0, 101, '2023-09-22 06:06:07', '2023-09-22 06:06:07'),
(13, 140, 'SI-230924-13', 'Cash', '', 40000, 37000, 0, 3000, 1, 0, 101, '2023-09-24 07:39:49', '2023-09-24 07:39:49'),
(14, 139, 'SI-230924-14', 'Cash', '', 3500, 3500, 0, 0, 1, 0, 101, '2023-09-24 07:42:19', '2023-09-24 07:42:19'),
(15, 141, 'SI-230925-15', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-09-25 05:12:33', '2023-09-25 05:12:33'),
(16, 142, 'SI-230925-16', 'Cash', '', 6000, 3000, 0, 3000, 1, 0, 101, '2023-09-25 05:13:12', '2023-09-25 05:13:12'),
(17, 143, 'SI-230925-17', 'Cash', '', 6000, 3000, 0, 3000, 1, 0, 101, '2023-09-25 05:13:56', '2023-09-25 05:13:56'),
(18, 130, 'SI-230914-2', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-09-25 05:29:44', '2023-09-25 05:29:44'),
(19, 144, 'SI-230926-19', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-09-26 06:49:46', '2023-09-26 06:49:46'),
(20, 145, 'SI-230926-20', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-09-26 06:53:00', '2023-09-26 06:53:00'),
(21, 146, 'SI-230926-21', 'Cash', '', 4000, 2500, 0, 1500, 1, 0, 101, '2023-09-26 06:54:15', '2023-09-26 06:54:15'),
(22, 141, 'SI-230925-15', '101', NULL, 0, 0, 0, 1600, 1, 0, 101, '2023-09-26 06:57:15', '2023-09-26 06:57:15'),
(23, 137, 'SI-230922-11', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-09-26 07:27:41', '2023-09-26 07:27:41'),
(24, 148, 'SI-230927-24', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-09-27 06:16:31', '2023-09-27 06:16:31'),
(25, 147, 'SI-230927-25', 'Cash', '', 4000, 2300, 0, 1700, 1, 0, 101, '2023-09-27 06:23:03', '2023-09-27 06:23:03'),
(26, 144, 'SI-230926-19', '101', NULL, 0, 0, 0, 1600, 1, 0, 101, '2023-10-01 04:44:38', '2023-10-01 04:44:38'),
(27, 129, 'SI-230914-3', '101', NULL, 0, 0, 0, 4400, 1, 0, 101, '2023-10-03 06:46:46', '2023-10-03 06:46:46'),
(28, 134, 'SI-230917-8', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-10-03 06:47:09', '2023-10-03 06:47:09'),
(29, 149, 'SI-231004-29', 'Cash', '', 4000, 1000, 0, 3000, 1, 0, 101, '2023-10-04 01:36:51', '2023-10-04 01:36:51'),
(30, 150, 'SI-231004-30', 'Cash', '', 4000, 2000, 0, 2000, 1, 0, 101, '2023-10-04 01:37:25', '2023-10-04 01:37:25'),
(31, 151, 'SI-231008-31', 'Cash', '', 4000, 800, 0, 3200, 1, 0, 101, '2023-10-08 06:55:04', '2023-10-08 06:55:04'),
(32, 139, 'SI-230924-14', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-10-08 06:56:08', '2023-10-08 06:56:08'),
(33, 146, 'SI-230926-21', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-10-08 06:57:00', '2023-10-08 06:57:00'),
(34, 141, 'SI-230925-15', '101', NULL, 0, 0, 0, 2400, 1, 0, 101, '2023-10-08 07:02:32', '2023-10-08 07:02:32'),
(35, 145, 'SI-230926-20', '101', NULL, 0, 0, 0, 1600, 1, 0, 101, '2023-10-08 07:04:43', '2023-10-08 07:04:43'),
(36, 144, 'SI-230926-19', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-10-08 07:06:17', '2023-10-08 07:06:17'),
(37, 152, 'SI-231009-37', 'Cash', '', 4000, 2000, 0, 2000, 1, 0, 101, '2023-10-09 07:18:32', '2023-10-09 07:18:32'),
(38, 153, 'SI-231009-38', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2023-10-09 07:19:08', '2023-10-09 07:19:08'),
(39, 135, 'SI-230922-9', '101', NULL, 0, 0, 0, 3200, 1, 0, 101, '2023-10-10 22:07:48', '2023-10-10 22:07:48'),
(40, 131, 'SI-230914-4', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-10-10 22:08:38', '2023-10-10 22:08:38'),
(41, 143, 'SI-230925-17', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-10-10 22:09:34', '2023-10-10 22:09:34'),
(42, 136, 'SI-230922-12', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-10-10 22:10:05', '2023-10-10 22:10:05'),
(43, 138, 'SI-230922-10', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-10-10 22:10:39', '2023-10-10 22:10:39'),
(44, 149, 'SI-231004-29', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-10-11 06:04:12', '2023-10-11 06:04:12'),
(45, 148, 'SI-230927-24', '101', NULL, 0, 0, 0, 3200, 1, 0, 101, '2023-10-11 06:04:54', '2023-10-11 06:04:54'),
(46, 142, 'SI-230925-16', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-10-11 06:17:48', '2023-10-11 06:17:48'),
(47, 154, 'SI-231012-47', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2023-10-12 06:44:15', '2023-10-12 06:44:15'),
(48, 155, 'SI-231012-48', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-10-12 06:44:41', '2023-10-12 06:44:41'),
(49, 153, 'SI-231009-38', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-10-12 06:45:28', '2023-10-12 06:45:28'),
(50, 156, 'SI-231017-50', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2023-10-16 22:01:03', '2023-10-16 22:01:03'),
(51, 157, 'SI-231017-51', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-10-16 22:01:36', '2023-10-16 22:01:36'),
(52, 158, 'SI-231017-52', 'Cash', '', 4500, 4500, 0, 0, 1, 0, 101, '2023-10-17 05:04:24', '2023-10-17 05:04:24'),
(53, 159, 'SI-231017-53', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2023-10-17 05:05:01', '2023-10-17 05:05:01'),
(54, 160, 'SI-231017-54', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-10-17 05:05:26', '2023-10-17 05:05:26'),
(55, 161, 'SI-231017-55', 'Cash', '', 6000, 3000, 0, 3000, 1, 0, 101, '2023-10-17 05:48:51', '2023-10-17 05:48:51'),
(56, 162, 'SI-231018-56', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-10-18 04:35:58', '2023-10-18 04:35:58'),
(57, 155, 'SI-231012-48', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-10-18 04:37:26', '2023-10-18 04:37:26'),
(58, 163, 'SI-231022-58', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-10-22 05:41:14', '2023-10-22 05:41:14'),
(59, 151, 'SI-231008-31', '101', NULL, 0, 0, 0, 800, 1, 0, 101, '2023-10-22 21:09:49', '2023-10-22 21:09:49'),
(60, 146, 'SI-230926-21', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-10-22 21:10:26', '2023-10-22 21:10:26'),
(61, 145, 'SI-230926-20', '101', NULL, 0, 0, 0, 500, 1, 0, 101, '2023-10-22 21:11:08', '2023-10-22 21:11:08'),
(62, 139, 'SI-230924-14', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-10-22 21:12:10', '2023-10-22 21:12:10'),
(63, 147, 'SI-230927-25', '101', NULL, 0, 0, 0, 2300, 1, 0, 101, '2023-10-25 10:16:08', '2023-10-25 10:16:08'),
(64, 150, 'SI-231004-30', '101', NULL, 0, 0, 0, 1700, 1, 0, 101, '2023-10-25 10:17:28', '2023-10-25 10:17:28'),
(65, 164, 'SI-231026-65', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-10-26 07:10:39', '2023-10-26 07:10:39'),
(66, 145, 'SI-230926-20', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-10-28 00:57:03', '2023-10-28 00:57:03'),
(67, 152, 'SI-231009-37', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-10-28 00:57:38', '2023-10-28 00:57:38'),
(68, 153, 'SI-231009-38', '101', NULL, 0, 0, 0, 1200, 1, 0, 101, '2023-10-28 00:58:30', '2023-10-28 00:58:30'),
(69, 165, 'SI-231030-69', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-10-30 03:07:08', '2023-10-30 03:07:08'),
(70, 148, 'SI-230927-24', '101', NULL, 0, 0, 0, 800, 1, 0, 101, '2023-11-05 03:37:38', '2023-11-05 03:37:38'),
(71, 164, 'SI-231026-65', '101', NULL, 0, 0, 0, 3500, 1, 0, 101, '2023-11-05 04:01:56', '2023-11-05 04:01:56'),
(72, 153, 'SI-231009-38', '101', NULL, 0, 0, 0, 1300, 1, 0, 101, '2023-11-05 04:08:08', '2023-11-05 04:08:08'),
(73, 162, 'SI-231018-56', '101', NULL, 0, 0, 0, 3500, 1, 0, 101, '2023-11-05 22:22:09', '2023-11-05 22:22:09'),
(74, 166, 'SI-231106-74', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2023-11-06 07:33:50', '2023-11-06 07:33:50'),
(75, 133, 'SI-230915-7', '101', NULL, 0, 0, 0, 4400, 1, 0, 101, '2023-11-06 20:18:04', '2023-11-06 20:18:04'),
(76, 163, 'SI-231022-58', '101', NULL, 0, 0, 0, 6000, 1, 0, 101, '2023-11-06 20:18:59', '2023-11-06 20:18:59'),
(77, 158, 'SI-231017-52', '101', NULL, 0, 0, 0, 4500, 1, 0, 101, '2023-11-06 20:22:38', '2023-11-06 20:22:38'),
(78, 167, 'SI-231109-78', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-11-08 23:46:50', '2023-11-08 23:46:50'),
(79, 139, 'SI-230924-14', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-11-09 00:11:09', '2023-11-09 00:11:09'),
(80, 144, 'SI-230926-19', '101', NULL, 0, 0, 0, 900, 1, 0, 101, '2023-11-09 00:11:49', '2023-11-09 00:11:49'),
(81, 162, 'SI-231018-56', '101', NULL, 0, 0, 0, 2500, 1, 0, 101, '2023-11-09 00:14:20', '2023-11-09 00:14:20'),
(82, 159, 'SI-231017-53', '101', NULL, 0, 0, 0, 3200, 1, 0, 101, '2023-11-09 00:15:46', '2023-11-09 00:15:46'),
(94, 170, 'SI-231120-93', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-11-20 05:03:13', '2023-11-20 05:03:13'),
(84, 154, 'SI-231012-47', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-11-09 00:38:59', '2023-11-09 00:38:59'),
(85, 166, 'SI-231106-74', '101', NULL, 0, 0, 0, 4000, 1, 0, 101, '2023-11-09 00:39:55', '2023-11-09 00:39:55'),
(86, 165, 'SI-231030-69', '101', NULL, 0, 0, 0, 3200, 1, 0, 101, '2023-11-09 00:41:28', '2023-11-09 00:41:28'),
(87, 168, 'SI-231114-87', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-11-14 06:40:26', '2023-11-14 06:40:26'),
(88, 167, 'SI-231109-78', '101', NULL, 0, 0, 0, 4000, 1, 0, 101, '2023-11-14 06:41:35', '2023-11-14 06:41:35'),
(89, 164, 'SI-231026-65', '101', NULL, 0, 0, 0, 2500, 1, 0, 101, '2023-11-14 06:42:19', '2023-11-14 06:42:19'),
(90, 156, 'SI-231017-50', '101', NULL, 0, 0, 0, 3500, 1, 0, 101, '2023-11-18 05:26:56', '2023-11-18 05:26:56'),
(91, 155, 'SI-231012-48', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2023-11-18 05:27:47', '2023-11-18 05:27:47'),
(92, 169, 'SI-231119-92', 'Cash', '', 4000, 4000, 0, 0, 1, 0, 101, '2023-11-19 06:34:31', '2023-11-19 06:34:31'),
(93, 145, 'SI-230926-20', '101', NULL, 0, 0, 0, 400, 1, 0, 101, '2023-11-19 06:44:48', '2023-11-19 06:44:48'),
(95, 171, 'SI-231121-94', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2023-11-21 06:05:23', '2023-11-21 06:05:23'),
(96, 172, 'SI-231121-95', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-11-21 06:06:12', '2023-11-21 06:06:12'),
(97, 159, 'SI-231017-53', '101', NULL, 0, 0, 0, 1800, 1, 0, 101, '2023-11-22 06:16:32', '2023-11-22 06:16:32'),
(98, 157, 'SI-231017-51', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-11-22 06:17:31', '2023-11-22 06:17:31'),
(99, 173, 'SI-231126-98', 'Cash', '', 6000, 6000, 0, 0, 1, 0, 101, '2023-11-26 03:21:41', '2023-11-26 03:21:41'),
(100, 146, 'SI-230926-21', '101', NULL, 0, 0, 0, 500, 1, 0, 101, '2023-11-28 01:04:52', '2023-11-28 01:04:52'),
(101, 168, 'SI-231114-87', '101', NULL, 0, 0, 0, 4000, 1, 0, 101, '2023-11-28 01:06:51', '2023-11-28 01:06:51'),
(102, 171, 'SI-231121-94', '101', NULL, 0, 0, 0, 3500, 1, 0, 101, '2023-11-28 01:11:21', '2023-11-28 01:11:21'),
(103, 172, 'SI-231121-95', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-11-28 01:12:55', '2023-11-28 01:12:55'),
(104, 136, 'SI-230922-12', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-12-14 00:23:39', '2023-12-14 00:23:39'),
(105, 138, 'SI-230922-10', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-12-18 05:26:41', '2023-12-18 05:26:41'),
(106, 140, 'SI-230924-13', '101', NULL, 0, 0, 0, 3000, 1, 0, 101, '2023-12-18 05:27:25', '2023-12-18 05:27:25'),
(107, 156, 'SI-231017-50', '101', NULL, 0, 0, 0, 1500, 1, 0, 101, '2023-12-18 05:29:11', '2023-12-18 05:29:11'),
(108, 132, 'SI-230915-6', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2023-12-18 05:33:00', '2023-12-18 05:33:00'),
(109, 173, 'SI-231126-98', '101', NULL, 0, 0, 0, 6000, 1, 0, 101, '2024-01-04 08:38:58', '2024-01-04 08:38:58'),
(110, 172, 'SI-231121-95', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2024-01-04 08:40:36', '2024-01-04 08:40:36'),
(111, 135, 'SI-230922-9', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2024-01-04 08:53:01', '2024-01-04 08:53:01'),
(112, 131, 'SI-230914-4', '101', NULL, 0, 0, 0, 2000, 1, 0, 101, '2024-01-14 11:03:43', '2024-01-14 11:03:43'),
(113, 172, 'SI-231121-95', '101', NULL, 0, 0, 0, 2500, 1, 0, 101, '2024-01-14 11:04:19', '2024-01-14 11:04:19'),
(114, 140, 'SI-230924-13', '101', NULL, 0, 0, 0, 4000, 1, 0, 101, '2024-01-31 08:54:34', '2024-01-31 08:54:34'),
(115, 137, 'SI-230922-11', '101', NULL, 0, 0, 0, 1000, 1, 0, 101, '2024-01-31 09:04:09', '2024-01-31 09:04:09'),
(116, 174, 'SI-240312-115', 'Cash', '', 15000, 10000, 0, 5000, 1, 0, 101, '2024-03-12 00:57:33', '2024-03-12 00:57:33'),
(117, 175, 'SI-240402-116', 'Cash', '', 3110, 0, 0, 3110, 1, 0, 101, '2024-04-02 02:33:30', '2024-04-02 02:33:30'),
(118, 174, 'SI-240312-115', '101', NULL, 0, 0, 0, 10000, 1, 0, 101, '2024-04-08 00:07:41', '2024-04-08 00:07:41'),
(119, 176, 'SI-240529-118', 'Cash', '', 5000, 5000, 0, 0, 1, 0, 101, '2024-05-28 23:32:16', '2024-05-28 23:32:16'),
(120, 176, 'SI-240529-118', '101', NULL, 0, 0, 0, 5000, 1, 0, 101, '2024-05-28 23:38:15', '2024-05-28 23:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `sale_products`
--

DROP TABLE IF EXISTS `sale_products`;
CREATE TABLE IF NOT EXISTS `sale_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `pdtstock_id` int NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0',
  `invoice_no` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sale_by` int NOT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sale_products_sale_hash_id_unique` (`sale_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sale_products`
--

INSERT INTO `sale_products` (`id`, `sale_hash_id`, `customer_id`, `product_id`, `pdtstock_id`, `quantity`, `rate`, `invoice_no`, `sale_by`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '8c9c7507b9414e52c9aafa996077cfbf', 128, 1, 1, 1, 6000, 'SI-230914-1', 1, 101, '2023-09-13 23:17:18', '2023-09-13 23:17:18'),
(2, '716df7d9107a3efa28985d9b991b865d', 130, 1, 1, 1, 6000, 'SI-230914-2', 1, 101, '2023-09-14 00:29:04', '2023-09-14 00:29:04'),
(3, '2ebc122ace692d7142ea840dfa5d805b', 129, 1, 1, 1, 6000, 'SI-230914-3', 1, 101, '2023-09-14 00:29:35', '2023-09-14 00:29:35'),
(4, 'cfdcafaf1dd11099d2f0765194599ac2', 131, 1, 1, 1, 6000, 'SI-230914-4', 1, 101, '2023-09-14 03:02:43', '2023-09-14 03:02:43'),
(5, '79918ff3f1ed7e1cb17bcc2632f37b3e', 132, 1, 1, 1, 6000, 'SI-230915-6', 1, 101, '2023-09-14 23:33:09', '2023-09-14 23:33:09'),
(6, '2e7b69a1fa164065beec30db0f687e61', 133, 1, 1, 1, 6000, 'SI-230915-7', 1, 101, '2023-09-14 23:34:04', '2023-09-14 23:34:04'),
(7, '5974365a56cb0ebd0615a65a208076c7', 134, 1, 1, 1, 6000, 'SI-230917-8', 1, 101, '2023-09-17 09:39:24', '2023-09-17 09:39:24'),
(8, '88ef36ab4ea7978785593f29d2060b89', 135, 1, 1, 1, 6000, 'SI-230922-9', 1, 101, '2023-09-22 06:03:24', '2023-09-22 06:03:24'),
(9, 'd551e267a8dd8e40b674d91943a9e8ca', 138, 1, 1, 1, 6000, 'SI-230922-10', 1, 101, '2023-09-22 06:04:16', '2023-09-22 06:04:16'),
(10, 'f192e3cb6c2863d5751540cb9902aa77', 137, 1, 1, 1, 6000, 'SI-230922-11', 1, 101, '2023-09-22 06:05:25', '2023-09-22 06:05:25'),
(11, '4f07f70f2cc39c660a0ce4d4307da38b', 136, 1, 1, 1, 6000, 'SI-230922-12', 1, 101, '2023-09-22 06:06:07', '2023-09-22 06:06:07'),
(12, '93d0bb20de21aacc2d4e8f93b6b26e56', 140, 1, 1, 1, 40000, 'SI-230924-13', 1, 101, '2023-09-24 07:39:49', '2023-09-24 07:39:49'),
(13, 'b9a1b32757cf9bae71e36d09f046e898', 139, 1, 1, 1, 3500, 'SI-230924-14', 1, 101, '2023-09-24 07:42:19', '2023-09-24 07:42:19'),
(14, '400a7a3a14c3038a442e70eea18534c8', 141, 1, 1, 1, 4000, 'SI-230925-15', 1, 101, '2023-09-25 05:12:33', '2023-09-25 05:12:33'),
(15, '69ae5691bfac0f87391c0c995fdacb42', 142, 1, 1, 1, 6000, 'SI-230925-16', 1, 101, '2023-09-25 05:13:12', '2023-09-25 05:13:12'),
(16, '0cab9d06f40a0230a5add0b7d1e0beca', 143, 1, 1, 1, 6000, 'SI-230925-17', 1, 101, '2023-09-25 05:13:56', '2023-09-25 05:13:56'),
(17, '0158e0c92fb8298df10a42b5adcedf7d', 144, 1, 1, 1, 4000, 'SI-230926-19', 1, 101, '2023-09-26 06:49:46', '2023-09-26 06:49:46'),
(18, 'd9f0b58311af663dd01039ebdaf77187', 145, 1, 1, 1, 4000, 'SI-230926-20', 1, 101, '2023-09-26 06:53:00', '2023-09-26 06:53:00'),
(19, '98916995b8c8ffc1cf00266ec288871e', 146, 1, 1, 1, 4000, 'SI-230926-21', 1, 101, '2023-09-26 06:54:15', '2023-09-26 06:54:15'),
(20, '51de0bce443f6c10e04621ffb98e0c73', 148, 1, 1, 1, 4000, 'SI-230927-24', 1, 101, '2023-09-27 06:16:31', '2023-09-27 06:16:31'),
(21, '38eb914a625013ad8708223d969a94de', 147, 1, 1, 1, 4000, 'SI-230927-25', 1, 101, '2023-09-27 06:23:03', '2023-09-27 06:23:03'),
(22, '3793c51e420b066ff64dfbb100439d3d', 149, 1, 1, 1, 4000, 'SI-231004-29', 1, 101, '2023-10-04 01:36:51', '2023-10-04 01:36:51'),
(23, 'd772b18c382c68b948f0e5be961dd215', 150, 1, 1, 1, 4000, 'SI-231004-30', 1, 101, '2023-10-04 01:37:25', '2023-10-04 01:37:25'),
(24, 'a61d98b5b6232dcd3c4ef9f943b02426', 151, 1, 1, 1, 4000, 'SI-231008-31', 1, 101, '2023-10-08 06:55:04', '2023-10-08 06:55:04'),
(25, '1deceed637d1df12f9ee7c283d388c17', 152, 1, 1, 1, 4000, 'SI-231009-37', 1, 101, '2023-10-09 07:18:32', '2023-10-09 07:18:32'),
(26, '95d93be59900382b632cf952b7ddbc42', 153, 1, 1, 1, 5000, 'SI-231009-38', 1, 101, '2023-10-09 07:19:08', '2023-10-09 07:19:08'),
(27, 'd343a177dccc64f16a7769955e8e5b80', 154, 1, 1, 1, 5000, 'SI-231012-47', 1, 101, '2023-10-12 06:44:15', '2023-10-12 06:44:15'),
(28, '22ac4169838de01c78c2aeb818bf0423', 155, 1, 1, 1, 4000, 'SI-231012-48', 1, 101, '2023-10-12 06:44:41', '2023-10-12 06:44:41'),
(29, '79bafcaadacb221a6bc886defa41a985', 156, 1, 1, 1, 5000, 'SI-231017-50', 1, 101, '2023-10-16 22:01:03', '2023-10-16 22:01:03'),
(30, '9471cb1e4debdb73cfcbd09c5cb22166', 157, 1, 1, 1, 4000, 'SI-231017-51', 1, 101, '2023-10-16 22:01:36', '2023-10-16 22:01:36'),
(31, 'f3b8287df359d1dc92bf790a8ac7cce9', 158, 1, 1, 1, 4500, 'SI-231017-52', 1, 101, '2023-10-17 05:04:24', '2023-10-17 05:04:24'),
(32, '8874c442a2dec9786ff1d6fe905d7b15', 159, 1, 1, 1, 5000, 'SI-231017-53', 1, 101, '2023-10-17 05:05:01', '2023-10-17 05:05:01'),
(33, '4405c7ef2d018bfdb12be1d6de4dc7cc', 160, 1, 1, 1, 4000, 'SI-231017-54', 1, 101, '2023-10-17 05:05:26', '2023-10-17 05:05:26'),
(34, '577915d1962449b3dd9bf9ce25b5401b', 161, 1, 1, 1, 6000, 'SI-231017-55', 1, 101, '2023-10-17 05:48:51', '2023-10-17 05:48:51'),
(35, '5ac60bb0d38339e1b022a6b2076e5079', 162, 1, 1, 1, 6000, 'SI-231018-56', 1, 101, '2023-10-18 04:35:58', '2023-10-18 04:35:58'),
(36, '00b3ad5d290162bd1e23c210cffb9a95', 163, 1, 1, 1, 6000, 'SI-231022-58', 1, 101, '2023-10-22 05:41:13', '2023-10-22 05:41:13'),
(37, '0b800ceb390e384426b19ecf44d2b57a', 164, 1, 1, 1, 6000, 'SI-231026-65', 1, 101, '2023-10-26 07:10:39', '2023-10-26 07:10:39'),
(38, '3f7c932c0e5e4748cb54eb6ce7a122d6', 165, 1, 1, 1, 6000, 'SI-231030-69', 1, 101, '2023-10-30 03:07:08', '2023-10-30 03:07:08'),
(39, '1e994972e462e60af6d300ad60305a84', 166, 1, 1, 1, 5000, 'SI-231106-74', 1, 101, '2023-11-06 07:33:50', '2023-11-06 07:33:50'),
(40, 'fb91c0b023e099fadb219b7d7d1ed168', 167, 1, 1, 1, 4000, 'SI-231109-78', 1, 101, '2023-11-08 23:46:49', '2023-11-08 23:46:49'),
(41, '8e0ab3998acd430594837bb6b90d677f', 168, 1, 1, 1, 4000, 'SI-231114-87', 1, 101, '2023-11-14 06:40:26', '2023-11-14 06:40:26'),
(42, '61660c5bff23d8213babd9ff4737d4c1', 169, 1, 1, 1, 4000, 'SI-231119-92', 1, 101, '2023-11-19 06:34:31', '2023-11-19 06:34:31'),
(43, 'c31c2a871a4375cf046f7e8e295dea55', 170, 1, 1, 1, 4000, 'SI-231120-93', 1, 101, '2023-11-20 05:03:13', '2023-11-20 05:03:13'),
(44, 'c243df71b3acb3ec32ed198fe84d3f27', 171, 1, 1, 1, 5000, 'SI-231121-94', 1, 101, '2023-11-21 06:05:23', '2023-11-21 06:05:23'),
(45, 'e4363ceac984f873a9de262fd577393f', 172, 1, 1, 1, 6000, 'SI-231121-95', 1, 101, '2023-11-21 06:06:12', '2023-11-21 06:06:12'),
(46, 'cb3588c107413891d3f2b852a51d4d43', 173, 1, 1, 1, 6000, 'SI-231126-98', 1, 101, '2023-11-26 03:21:41', '2023-11-26 03:21:41'),
(47, 'f56e817fe46a3e8d4e08e135c1b25a8c', 174, 1, 1, 1, 15000, 'SI-240312-115', 1, 101, '2024-03-12 00:57:33', '2024-03-12 00:57:33'),
(48, '57175c9b2f201b6c4b3218ebf7f35e2b', 175, 1, 1, 1, 3110, 'SI-240402-116', 1, 101, '2024-04-02 02:33:30', '2024-04-02 02:33:30'),
(49, 'dc72fb94d3d766933b60860210541d5e', 176, 1, 1, 1, 5000, 'SI-240529-118', 1, 101, '2024-05-28 23:32:16', '2024-05-28 23:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

DROP TABLE IF EXISTS `sale_returns`;
CREATE TABLE IF NOT EXISTS `sale_returns` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_return_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `invoice_no` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `customer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `pdtstock_id` int NOT NULL,
  `quantity` double NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0',
  `sale_invoice` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `return_by` int NOT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sale_returns_sale_return_hash_id_unique` (`sale_return_hash_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `supplier_name` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `supplier_address` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `supplier_phone` varchar(300) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `supplier_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `supplier_status` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int DEFAULT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `suppliers_supplier_hash_id_unique` (`supplier_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_hash_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_email`, `supplier_status`, `parent_id`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '50d21ef98512e7440a31ab7c053ce539', 'IconBangla', 'House: 29, Road: 02', '01712105580', 'me@arifur.info', 1, 216, 101, '2023-09-09 13:12:40', '2023-09-09 13:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

DROP TABLE IF EXISTS `taxes`;
CREATE TABLE IF NOT EXISTS `taxes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tax_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `tax_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tax_short_name` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `tax_value_percent` double NOT NULL DEFAULT '0',
  `store_id` int NOT NULL,
  `tax_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `taxes_tax_hash_id_unique` (`tax_hash_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `trns_id` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `account_head_id` int NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `direction` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `trns_date` date NOT NULL,
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=460 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `trns_id`, `account_head_id`, `description`, `amount`, `direction`, `trns_date`, `store_id`, `created_at`, `updated_at`) VALUES
(1, 'SI-230914-1', 101, '--Goods Sold in cash 1600', 1600, '1', '2023-09-14', 101, NULL, NULL),
(2, 'SI-230914-1', 128, '--Goods Sold on credit with discount', 4400, '1', '2023-09-14', 101, NULL, NULL),
(3, 'SI-230914-1', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-14', 101, NULL, NULL),
(4, 'SI-230914-2', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-09-14', 101, NULL, NULL),
(5, 'SI-230914-2', 130, '--Goods Sold on credit with discount', 3000, '1', '2023-09-14', 101, NULL, NULL),
(6, 'SI-230914-2', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-14', 101, NULL, NULL),
(7, 'SI-230914-3', 101, '--Goods Sold in cash 1600', 1600, '1', '2023-09-14', 101, NULL, NULL),
(8, 'SI-230914-3', 129, '--Goods Sold on credit with discount', 4400, '1', '2023-09-14', 101, NULL, NULL),
(9, 'SI-230914-3', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-14', 101, NULL, NULL),
(10, 'SI-230914-4', 131, 'Goods sold on credit', 6000, '1', '2023-09-14', 101, NULL, NULL),
(11, 'SI-230914-4', 401, 'Goods sold on credit', 6000, '-1', '2023-09-14', 101, NULL, NULL),
(12, 'SI-230914-4', 101, 'Received from Customer for Invoice SI-230914-4', 1500, '1', '2023-09-15', 101, NULL, NULL),
(13, 'SI-230914-4', 131, 'Received from Customer for Invoice SI-230914-4', 1500, '-1', '2023-09-15', 101, NULL, NULL),
(14, 'SI-230915-6', 101, '--Goods Sold in cash 2500', 2500, '1', '2023-09-15', 101, NULL, NULL),
(15, 'SI-230915-6', 132, '--Goods Sold on credit with discount', 3500, '1', '2023-09-15', 101, NULL, NULL),
(16, 'SI-230915-6', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-15', 101, NULL, NULL),
(17, 'SI-230915-7', 101, '--Goods Sold in cash 1600', 1600, '1', '2023-09-15', 101, NULL, NULL),
(18, 'SI-230915-7', 133, '--Goods Sold on credit with discount', 4400, '1', '2023-09-15', 101, NULL, NULL),
(19, 'SI-230915-7', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-15', 101, NULL, NULL),
(20, 'SI-230917-8', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-09-17', 101, NULL, NULL),
(21, 'SI-230917-8', 134, '--Goods Sold on credit with discount', 3000, '1', '2023-09-17', 101, NULL, NULL),
(22, 'SI-230917-8', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-17', 101, NULL, NULL),
(23, 'SI-230922-9', 135, 'Goods sold on credit', 6000, '1', '2023-09-22', 101, NULL, NULL),
(24, 'SI-230922-9', 401, 'Goods sold on credit', 6000, '-1', '2023-09-22', 101, NULL, NULL),
(25, 'SI-230922-10', 101, '--Goods Sold in cash 1000', 1000, '1', '2023-09-22', 101, NULL, NULL),
(26, 'SI-230922-10', 138, '--Goods Sold on credit with discount', 5000, '1', '2023-09-22', 101, NULL, NULL),
(27, 'SI-230922-10', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-22', 101, NULL, NULL),
(28, 'SI-230922-11', 137, 'Goods sold on credit', 6000, '1', '2023-09-22', 101, NULL, NULL),
(29, 'SI-230922-11', 401, 'Goods sold on credit', 6000, '-1', '2023-09-22', 101, NULL, NULL),
(30, 'SI-230922-12', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-09-22', 101, NULL, NULL),
(31, 'SI-230922-12', 136, '--Goods Sold on credit with discount', 3000, '1', '2023-09-22', 101, NULL, NULL),
(32, 'SI-230922-12', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-22', 101, NULL, NULL),
(33, 'EXP-230922-3', 302, 'Salary Expense', 2000, '1', '2023-09-22', 101, NULL, NULL),
(34, 'EXP-230922-3', 101, 'Salary Expense', 2000, '-1', '2023-09-22', 101, NULL, NULL),
(35, 'EXP-230922-4', 301, 'General Expense', 7500, '1', '2023-09-22', 101, NULL, NULL),
(36, 'EXP-230922-4', 101, 'General Expense', 7500, '-1', '2023-09-22', 101, NULL, NULL),
(37, 'EXP-230922-5', 301, 'General Expense', 2000, '1', '2023-09-22', 101, NULL, NULL),
(38, 'EXP-230922-5', 101, 'General Expense', 2000, '-1', '2023-09-22', 101, NULL, NULL),
(39, 'JI-230922-1', 101, 'Investment', 2000, '1', '2023-09-01', 101, NULL, NULL),
(40, 'JI-230922-1', 501, 'Investment', 2000, '-1', '2023-09-01', 101, NULL, NULL),
(41, 'EXP-230922-6', 315, 'Marketting and Travel', 2000, '1', '2023-09-22', 101, NULL, NULL),
(42, 'EXP-230922-6', 101, 'Marketting and Travel', 2000, '-1', '2023-09-22', 101, NULL, NULL),
(43, 'JI-230922-2', 105, 'Entry', 0, '1', '2023-09-01', 101, NULL, NULL),
(44, 'JI-230922-2', 216, 'Entry', 0, '-1', '2023-09-01', 101, NULL, NULL),
(45, 'EXP-230922-7', 316, 'Domain Purchase', 1610, '1', '2023-09-22', 101, NULL, NULL),
(46, 'EXP-230922-7', 101, 'Domain Purchase', 1610, '-1', '2023-09-22', 101, NULL, NULL),
(47, 'EXP-230922-8', 316, 'Domain Purchase', 1610, '1', '2023-09-22', 101, NULL, NULL),
(48, 'EXP-230922-8', 101, 'Domain Purchase', 1610, '-1', '2023-09-22', 101, NULL, NULL),
(49, 'SI-230924-13', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-09-24', 101, NULL, NULL),
(50, 'SI-230924-13', 140, '--Goods Sold on credit with discount', 37000, '1', '2023-09-24', 101, NULL, NULL),
(51, 'SI-230924-13', 401, '--Goods Sold on credit with discount', 40000, '-1', '2023-09-24', 101, NULL, NULL),
(52, 'SI-230924-14', 139, 'Goods sold on credit', 3500, '1', '2023-09-24', 101, NULL, NULL),
(53, 'SI-230924-14', 401, 'Goods sold on credit', 3500, '-1', '2023-09-24', 101, NULL, NULL),
(54, 'EXP-230924-9', 316, 'Domain Purchase', 1610, '1', '2023-09-24', 101, NULL, NULL),
(55, 'EXP-230924-9', 101, 'Domain Purchase', 1610, '-1', '2023-09-24', 101, NULL, NULL),
(56, 'EXP-230924-10', 316, 'Domain Purchase', 1610, '1', '2023-09-24', 101, NULL, NULL),
(57, 'EXP-230924-10', 101, 'Domain Purchase', 1610, '-1', '2023-09-24', 101, NULL, NULL),
(58, 'EXP-230924-11', 316, 'Domain Purchase', 1610, '1', '2023-09-24', 101, NULL, NULL),
(59, 'EXP-230924-11', 101, 'Domain Purchase', 1610, '-1', '2023-09-24', 101, NULL, NULL),
(60, 'SI-230925-15', 141, 'Goods sold on credit', 4000, '1', '2023-09-25', 101, NULL, NULL),
(61, 'SI-230925-15', 401, 'Goods sold on credit', 4000, '-1', '2023-09-25', 101, NULL, NULL),
(62, 'SI-230925-16', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-09-25', 101, NULL, NULL),
(63, 'SI-230925-16', 142, '--Goods Sold on credit with discount', 3000, '1', '2023-09-25', 101, NULL, NULL),
(64, 'SI-230925-16', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-25', 101, NULL, NULL),
(65, 'SI-230925-17', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-09-25', 101, NULL, NULL),
(66, 'SI-230925-17', 143, '--Goods Sold on credit with discount', 3000, '1', '2023-09-25', 101, NULL, NULL),
(67, 'SI-230925-17', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-09-25', 101, NULL, NULL),
(68, 'EXP-230925-12', 302, 'Salary Expense', 2000, '1', '2023-09-25', 101, NULL, NULL),
(69, 'EXP-230925-12', 101, 'Salary Expense', 2000, '-1', '2023-09-25', 101, NULL, NULL),
(70, 'SI-230914-2', 101, 'Received from Customer for Invoice SI-230914-2', 2000, '1', '2023-09-25', 101, NULL, NULL),
(71, 'SI-230914-2', 130, 'Received from Customer for Invoice SI-230914-2', 2000, '-1', '2023-09-25', 101, NULL, NULL),
(72, 'SI-230926-19', 144, 'Goods sold on credit', 4000, '1', '2023-09-26', 101, NULL, NULL),
(73, 'SI-230926-19', 401, 'Goods sold on credit', 4000, '-1', '2023-09-26', 101, NULL, NULL),
(74, 'SI-230926-20', 145, 'Goods sold on credit', 4000, '1', '2023-09-26', 101, NULL, NULL),
(75, 'SI-230926-20', 401, 'Goods sold on credit', 4000, '-1', '2023-09-26', 101, NULL, NULL),
(76, 'SI-230926-21', 101, '--Goods Sold in cash 1500', 1500, '1', '2023-09-26', 101, NULL, NULL),
(77, 'SI-230926-21', 146, '--Goods Sold on credit with discount', 2500, '1', '2023-09-26', 101, NULL, NULL),
(78, 'SI-230926-21', 401, '--Goods Sold on credit with discount', 4000, '-1', '2023-09-26', 101, NULL, NULL),
(79, 'SI-230925-15', 101, 'Received from Customer for Invoice SI-230925-15', 1600, '1', '2023-09-26', 101, NULL, NULL),
(80, 'SI-230925-15', 141, 'Received from Customer for Invoice SI-230925-15', 1600, '-1', '2023-09-26', 101, NULL, NULL),
(81, 'EXP-230926-13', 316, 'Domain Purchase', 1610, '1', '2023-09-26', 101, NULL, NULL),
(82, 'EXP-230926-13', 101, 'Domain Purchase', 1610, '-1', '2023-09-26', 101, NULL, NULL),
(100, 'SI-230926-19', 101, 'Received from Customer for Invoice SI-230926-19', 1600, '1', '2023-10-01', 101, NULL, NULL),
(85, 'EXP-230926-15', 316, 'Domain Purchase', 1610, '1', '2023-09-26', 101, NULL, NULL),
(86, 'EXP-230926-15', 101, 'Domain Purchase', 1610, '-1', '2023-09-26', 101, NULL, NULL),
(87, 'EXP-230926-16', 315, 'Marketting and Travel', 1000, '1', '2023-09-26', 101, NULL, NULL),
(88, 'EXP-230926-16', 101, 'Marketting and Travel', 1000, '-1', '2023-09-26', 101, NULL, NULL),
(89, 'SI-230922-11', 101, 'Received from Customer for Invoice SI-230922-11', 2000, '1', '2023-09-26', 101, NULL, NULL),
(90, 'SI-230922-11', 137, 'Received from Customer for Invoice SI-230922-11', 2000, '-1', '2023-09-26', 101, NULL, NULL),
(91, 'EXP-230926-17', 316, 'Domain Purchase', 1610, '1', '2023-09-26', 101, NULL, NULL),
(92, 'EXP-230926-17', 101, 'Domain Purchase', 1610, '-1', '2023-09-26', 101, NULL, NULL),
(93, 'SI-230927-24', 148, 'Goods sold on credit', 4000, '1', '2023-09-27', 101, NULL, NULL),
(94, 'SI-230927-24', 401, 'Goods sold on credit', 4000, '-1', '2023-09-27', 101, NULL, NULL),
(95, 'SI-230927-25', 101, '--Goods Sold in cash 1700', 1700, '1', '2023-09-27', 101, NULL, NULL),
(96, 'SI-230927-25', 147, '--Goods Sold on credit with discount', 2300, '1', '2023-09-27', 101, NULL, NULL),
(97, 'SI-230927-25', 401, '--Goods Sold on credit with discount', 4000, '-1', '2023-09-27', 101, NULL, NULL),
(98, 'EXP-230927-18', 316, 'Domain Purchase', 1610, '1', '2023-09-27', 101, NULL, NULL),
(99, 'EXP-230927-18', 101, 'Domain Purchase', 1610, '-1', '2023-09-27', 101, NULL, NULL),
(101, 'SI-230926-19', 144, 'Received from Customer for Invoice SI-230926-19', 1600, '-1', '2023-10-01', 101, NULL, NULL),
(102, 'EXP-231001-18', 316, 'Domain Purchase', 1610, '1', '2023-10-01', 101, NULL, NULL),
(103, 'EXP-231001-18', 101, 'Domain Purchase', 1610, '-1', '2023-10-01', 101, NULL, NULL),
(104, 'EXP-231001-19', 316, 'Domain Purchase', 1610, '1', '2023-10-01', 101, NULL, NULL),
(105, 'EXP-231001-19', 101, 'Domain Purchase', 1610, '-1', '2023-10-01', 101, NULL, NULL),
(106, 'EXP-231001-20', 316, 'Domain Purchase', 1610, '1', '2023-10-01', 101, NULL, NULL),
(107, 'EXP-231001-20', 101, 'Domain Purchase', 1610, '-1', '2023-10-01', 101, NULL, NULL),
(108, 'EXP-231001-21', 301, 'General Expense', 1500, '1', '2023-10-01', 101, NULL, NULL),
(109, 'EXP-231001-21', 101, 'General Expense', 1500, '-1', '2023-10-01', 101, NULL, NULL),
(110, 'EXP-231003-22', 316, 'Domain Purchase', 1610, '1', '2023-10-03', 101, NULL, NULL),
(111, 'EXP-231003-22', 101, 'Domain Purchase', 1610, '-1', '2023-10-03', 101, NULL, NULL),
(112, 'SI-230914-3', 101, 'Received from Customer for Invoice SI-230914-3', 4400, '1', '2023-10-03', 101, NULL, NULL),
(113, 'SI-230914-3', 129, 'Received from Customer for Invoice SI-230914-3', 4400, '-1', '2023-10-03', 101, NULL, NULL),
(114, 'SI-230917-8', 101, 'Received from Customer for Invoice SI-230917-8', 3000, '1', '2023-10-03', 101, NULL, NULL),
(115, 'SI-230917-8', 134, 'Received from Customer for Invoice SI-230917-8', 3000, '-1', '2023-10-03', 101, NULL, NULL),
(116, 'EXP-231003-23', 315, 'Marketting and Travel', 1150, '1', '2023-10-03', 101, NULL, NULL),
(117, 'EXP-231003-23', 101, 'Marketting and Travel', 1150, '-1', '2023-10-03', 101, NULL, NULL),
(118, 'SI-231004-29', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-10-04', 101, NULL, NULL),
(119, 'SI-231004-29', 149, '--Goods Sold on credit with discount', 1000, '1', '2023-10-04', 101, NULL, NULL),
(120, 'SI-231004-29', 401, '--Goods Sold on credit with discount', 4000, '-1', '2023-10-04', 101, NULL, NULL),
(121, 'SI-231004-30', 101, '--Goods Sold in cash 2000', 2000, '1', '2023-10-04', 101, NULL, NULL),
(122, 'SI-231004-30', 150, '--Goods Sold on credit with discount', 2000, '1', '2023-10-04', 101, NULL, NULL),
(123, 'SI-231004-30', 401, '--Goods Sold on credit with discount', 4000, '-1', '2023-10-04', 101, NULL, NULL),
(124, 'EXP-231004-24', 316, 'Domain Purchase', 1610, '1', '2023-10-04', 101, NULL, NULL),
(125, 'EXP-231004-24', 101, 'Domain Purchase', 1610, '-1', '2023-10-04', 101, NULL, NULL),
(126, 'EXP-231007-25', 301, 'General Expense', 2000, '1', '2023-10-07', 101, NULL, NULL),
(127, 'EXP-231007-25', 101, 'General Expense', 2000, '-1', '2023-10-07', 101, NULL, NULL),
(128, 'EXP-231007-26', 316, 'Domain Purchase', 1610, '1', '2023-10-07', 101, NULL, NULL),
(129, 'EXP-231007-26', 101, 'Domain Purchase', 1610, '-1', '2023-10-07', 101, NULL, NULL),
(130, 'SI-231008-31', 101, '--Goods Sold in cash 3200', 3200, '1', '2023-10-08', 101, NULL, NULL),
(131, 'SI-231008-31', 151, '--Goods Sold on credit with discount', 800, '1', '2023-10-08', 101, NULL, NULL),
(132, 'SI-231008-31', 401, '--Goods Sold on credit with discount', 4000, '-1', '2023-10-08', 101, NULL, NULL),
(133, 'SI-230924-14', 101, 'Received from Customer for Invoice SI-230924-14', 1500, '1', '2023-10-08', 101, NULL, NULL),
(134, 'SI-230924-14', 139, 'Received from Customer for Invoice SI-230924-14', 1500, '-1', '2023-10-08', 101, NULL, NULL),
(135, 'SI-230926-21', 101, 'Received from Customer for Invoice SI-230926-21', 1000, '1', '2023-10-08', 101, NULL, NULL),
(136, 'SI-230926-21', 146, 'Received from Customer for Invoice SI-230926-21', 1000, '-1', '2023-10-08', 101, NULL, NULL),
(137, 'EXP-231008-27', 301, 'General Expense', 2000, '1', '2023-10-08', 101, NULL, NULL),
(138, 'EXP-231008-27', 101, 'General Expense', 2000, '-1', '2023-10-08', 101, NULL, NULL),
(139, 'EXP-231008-28', 315, 'Marketting and Travel', 1500, '1', '2023-10-08', 101, NULL, NULL),
(140, 'EXP-231008-28', 101, 'Marketting and Travel', 1500, '-1', '2023-10-08', 101, NULL, NULL),
(141, 'SI-230925-15', 101, 'Received from Customer for Invoice SI-230925-15', 2400, '1', '2023-10-08', 101, NULL, NULL),
(142, 'SI-230925-15', 141, 'Received from Customer for Invoice SI-230925-15', 2400, '-1', '2023-10-08', 101, NULL, NULL),
(143, 'SI-230926-20', 101, 'Received from Customer for Invoice SI-230926-20', 1600, '1', '2023-10-08', 101, NULL, NULL),
(144, 'SI-230926-20', 145, 'Received from Customer for Invoice SI-230926-20', 1600, '-1', '2023-10-08', 101, NULL, NULL),
(145, 'SI-230926-19', 101, 'Received from Customer for Invoice SI-230926-19', 1500, '1', '2023-10-08', 101, NULL, NULL),
(146, 'SI-230926-19', 144, 'Received from Customer for Invoice SI-230926-19', 1500, '-1', '2023-10-08', 101, NULL, NULL),
(147, 'SI-231009-37', 101, '--Goods Sold in cash 2000', 2000, '1', '2023-10-09', 101, NULL, NULL),
(148, 'SI-231009-37', 152, '--Goods Sold on credit with discount', 2000, '1', '2023-10-09', 101, NULL, NULL),
(149, 'SI-231009-37', 401, '--Goods Sold on credit with discount', 4000, '-1', '2023-10-09', 101, NULL, NULL),
(150, 'SI-231009-38', 153, 'Goods sold on credit', 5000, '1', '2023-10-09', 101, NULL, NULL),
(151, 'SI-231009-38', 401, 'Goods sold on credit', 5000, '-1', '2023-10-09', 101, NULL, NULL),
(152, 'EXP-231009-29', 316, 'Domain Purchase', 1610, '1', '2023-10-09', 101, NULL, NULL),
(153, 'EXP-231009-29', 101, 'Domain Purchase', 1610, '-1', '2023-10-09', 101, NULL, NULL),
(154, 'EXP-231009-30', 316, 'Domain Purchase', 1610, '1', '2023-10-09', 101, NULL, NULL),
(155, 'EXP-231009-30', 101, 'Domain Purchase', 1610, '-1', '2023-10-09', 101, NULL, NULL),
(156, 'EXP-231009-31', 316, 'Domain Purchase', 1610, '1', '2023-10-09', 101, NULL, NULL),
(157, 'EXP-231009-31', 101, 'Domain Purchase', 1610, '-1', '2023-10-09', 101, NULL, NULL),
(158, 'EXP-231009-32', 316, 'Domain Purchase', 1610, '1', '2023-10-09', 101, NULL, NULL),
(159, 'EXP-231009-32', 101, 'Domain Purchase', 1610, '-1', '2023-10-09', 101, NULL, NULL),
(160, 'EXP-231010-33', 316, 'Domain Purchase', 1610, '1', '2023-10-10', 101, NULL, NULL),
(161, 'EXP-231010-33', 101, 'Domain Purchase', 1610, '-1', '2023-10-10', 101, NULL, NULL),
(162, 'SI-230922-9', 101, 'Received from Customer for Invoice SI-230922-9', 3200, '1', '2023-10-11', 101, NULL, NULL),
(163, 'SI-230922-9', 135, 'Received from Customer for Invoice SI-230922-9', 3200, '-1', '2023-10-11', 101, NULL, NULL),
(164, 'SI-230914-4', 101, 'Received from Customer for Invoice SI-230914-4', 1500, '1', '2023-10-11', 101, NULL, NULL),
(165, 'SI-230914-4', 131, 'Received from Customer for Invoice SI-230914-4', 1500, '-1', '2023-10-11', 101, NULL, NULL),
(166, 'SI-230925-17', 101, 'Received from Customer for Invoice SI-230925-17', 3000, '1', '2023-10-11', 101, NULL, NULL),
(167, 'SI-230925-17', 143, 'Received from Customer for Invoice SI-230925-17', 3000, '-1', '2023-10-11', 101, NULL, NULL),
(168, 'SI-230922-12', 101, 'Received from Customer for Invoice SI-230922-12', 1000, '1', '2023-10-11', 101, NULL, NULL),
(169, 'SI-230922-12', 136, 'Received from Customer for Invoice SI-230922-12', 1000, '-1', '2023-10-11', 101, NULL, NULL),
(170, 'SI-230922-10', 101, 'Received from Customer for Invoice SI-230922-10', 2000, '1', '2023-10-11', 101, NULL, NULL),
(171, 'SI-230922-10', 138, 'Received from Customer for Invoice SI-230922-10', 2000, '-1', '2023-10-11', 101, NULL, NULL),
(172, 'EXP-231011-34', 302, 'Salary Expense', 3200, '1', '2023-10-11', 101, NULL, NULL),
(173, 'EXP-231011-34', 101, 'Salary Expense', 3200, '-1', '2023-10-11', 101, NULL, NULL),
(174, 'EXP-231011-35', 316, 'Domain Purchase', 1610, '1', '2023-10-11', 101, NULL, NULL),
(175, 'EXP-231011-35', 101, 'Domain Purchase', 1610, '-1', '2023-10-11', 101, NULL, NULL),
(176, 'EXP-231011-36', 316, 'Domain Purchase', 1610, '1', '2023-10-11', 101, NULL, NULL),
(177, 'EXP-231011-36', 101, 'Domain Purchase', 1610, '-1', '2023-10-11', 101, NULL, NULL),
(178, 'SI-231004-29', 101, 'Received from Customer for Invoice SI-231004-29', 1000, '1', '2023-10-11', 101, NULL, NULL),
(179, 'SI-231004-29', 149, 'Received from Customer for Invoice SI-231004-29', 1000, '-1', '2023-10-11', 101, NULL, NULL),
(180, 'SI-230927-24', 101, 'Received from Customer for Invoice SI-230927-24', 3200, '1', '2023-10-11', 101, NULL, NULL),
(181, 'SI-230927-24', 148, 'Received from Customer for Invoice SI-230927-24', 3200, '-1', '2023-10-11', 101, NULL, NULL),
(182, 'SI-230925-16', 101, 'Received from Customer for Invoice SI-230925-16', 3000, '1', '2023-10-11', 101, NULL, NULL),
(183, 'SI-230925-16', 142, 'Received from Customer for Invoice SI-230925-16', 3000, '-1', '2023-10-11', 101, NULL, NULL),
(184, 'EXP-231011-37', 316, 'Domain Purchase', 1610, '1', '2023-10-11', 101, NULL, NULL),
(185, 'EXP-231011-37', 101, 'Domain Purchase', 1610, '-1', '2023-10-11', 101, NULL, NULL),
(186, 'SI-231012-47', 154, 'Goods sold on credit', 5000, '1', '2023-10-12', 101, NULL, NULL),
(187, 'SI-231012-47', 401, 'Goods sold on credit', 5000, '-1', '2023-10-12', 101, NULL, NULL),
(188, 'SI-231012-48', 155, 'Goods sold on credit', 4000, '1', '2023-10-12', 101, NULL, NULL),
(189, 'SI-231012-48', 401, 'Goods sold on credit', 4000, '-1', '2023-10-12', 101, NULL, NULL),
(190, 'SI-231009-38', 101, 'Received from Customer for Invoice SI-231009-38', 2000, '1', '2023-10-12', 101, NULL, NULL),
(191, 'SI-231009-38', 153, 'Received from Customer for Invoice SI-231009-38', 2000, '-1', '2023-10-12', 101, NULL, NULL),
(192, 'EXP-231012-38', 301, 'General Expense', 500, '1', '2023-10-12', 101, NULL, NULL),
(193, 'EXP-231012-38', 101, 'General Expense', 500, '-1', '2023-10-12', 101, NULL, NULL),
(194, 'EXP-231013-39', 301, 'General Expense', 2000, '1', '2023-10-13', 101, NULL, NULL),
(195, 'EXP-231013-39', 101, 'General Expense', 2000, '-1', '2023-10-13', 101, NULL, NULL),
(196, 'EXP-231014-40', 316, 'Domain Purchase', 1610, '1', '2023-10-14', 101, NULL, NULL),
(197, 'EXP-231014-40', 101, 'Domain Purchase', 1610, '-1', '2023-10-14', 101, NULL, NULL),
(198, 'EXP-231014-41', 316, 'Domain Purchase', 1610, '1', '2023-10-14', 101, NULL, NULL),
(199, 'EXP-231014-41', 101, 'Domain Purchase', 1610, '-1', '2023-10-14', 101, NULL, NULL),
(200, 'SI-231017-50', 156, 'Goods sold on credit', 5000, '1', '2023-10-17', 101, NULL, NULL),
(201, 'SI-231017-50', 401, 'Goods sold on credit', 5000, '-1', '2023-10-17', 101, NULL, NULL),
(202, 'SI-231017-51', 157, 'Goods sold on credit', 4000, '1', '2023-10-17', 101, NULL, NULL),
(203, 'SI-231017-51', 401, 'Goods sold on credit', 4000, '-1', '2023-10-17', 101, NULL, NULL),
(204, 'SI-231017-52', 158, 'Goods sold on credit', 4500, '1', '2023-10-17', 101, NULL, NULL),
(205, 'SI-231017-52', 401, 'Goods sold on credit', 4500, '-1', '2023-10-17', 101, NULL, NULL),
(206, 'SI-231017-53', 159, 'Goods sold on credit', 5000, '1', '2023-10-17', 101, NULL, NULL),
(207, 'SI-231017-53', 401, 'Goods sold on credit', 5000, '-1', '2023-10-17', 101, NULL, NULL),
(208, 'SI-231017-54', 160, 'Goods sold on credit', 4000, '1', '2023-10-17', 101, NULL, NULL),
(209, 'SI-231017-54', 401, 'Goods sold on credit', 4000, '-1', '2023-10-17', 101, NULL, NULL),
(210, 'SI-231017-55', 101, '--Goods Sold in cash 3000', 3000, '1', '2023-10-17', 101, NULL, NULL),
(211, 'SI-231017-55', 161, '--Goods Sold on credit with discount', 3000, '1', '2023-10-17', 101, NULL, NULL),
(212, 'SI-231017-55', 401, '--Goods Sold on credit with discount', 6000, '-1', '2023-10-17', 101, NULL, NULL),
(213, 'EXP-231017-42', 302, 'Salary Expense', 3000, '1', '2023-10-17', 101, NULL, NULL),
(214, 'EXP-231017-42', 101, 'Salary Expense', 3000, '-1', '2023-10-17', 101, NULL, NULL),
(215, 'EXP-231017-43', 315, 'Marketting and Travel', 2000, '1', '2023-10-17', 101, NULL, NULL),
(216, 'EXP-231017-43', 101, 'Marketting and Travel', 2000, '-1', '2023-10-17', 101, NULL, NULL),
(217, 'SI-231018-56', 162, 'Goods sold on credit', 6000, '1', '2023-10-18', 101, NULL, NULL),
(218, 'SI-231018-56', 401, 'Goods sold on credit', 6000, '-1', '2023-10-18', 101, NULL, NULL),
(219, 'SI-231012-48', 101, 'Received from Customer for Invoice SI-231012-48', 3000, '1', '2023-10-18', 101, NULL, NULL),
(220, 'SI-231012-48', 155, 'Received from Customer for Invoice SI-231012-48', 3000, '-1', '2023-10-18', 101, NULL, NULL),
(221, 'EXP-231019-44', 302, 'Salary Expense', 4000, '1', '2023-10-19', 101, NULL, NULL),
(222, 'EXP-231019-44', 101, 'Salary Expense', 4000, '-1', '2023-10-19', 101, NULL, NULL),
(223, 'EXP-231022-45', 302, 'Salary Expense', 10000, '1', '2023-10-22', 101, NULL, NULL),
(224, 'EXP-231022-45', 101, 'Salary Expense', 10000, '-1', '2023-10-22', 101, NULL, NULL),
(225, 'EXP-231022-46', 316, 'Domain Purchase', 1610, '1', '2023-10-22', 101, NULL, NULL),
(226, 'EXP-231022-46', 101, 'Domain Purchase', 1610, '-1', '2023-10-22', 101, NULL, NULL),
(227, 'SI-231022-58', 163, 'Goods sold on credit', 6000, '1', '2023-10-22', 101, NULL, NULL),
(228, 'SI-231022-58', 401, 'Goods sold on credit', 6000, '-1', '2023-10-22', 101, NULL, NULL),
(229, 'EXP-231023-47', 315, 'Marketting and Travel', 2000, '1', '2023-10-23', 101, NULL, NULL),
(230, 'EXP-231023-47', 101, 'Marketting and Travel', 2000, '-1', '2023-10-23', 101, NULL, NULL),
(231, 'SI-231008-31', 101, 'Received from Customer for Invoice SI-231008-31', 800, '1', '2023-10-23', 101, NULL, NULL),
(232, 'SI-231008-31', 151, 'Received from Customer for Invoice SI-231008-31', 800, '-1', '2023-10-23', 101, NULL, NULL),
(233, 'SI-230926-21', 101, 'Received from Customer for Invoice SI-230926-21', 1000, '1', '2023-10-23', 101, NULL, NULL),
(234, 'SI-230926-21', 146, 'Received from Customer for Invoice SI-230926-21', 1000, '-1', '2023-10-23', 101, NULL, NULL),
(235, 'SI-230926-20', 101, 'Received from Customer for Invoice SI-230926-20', 500, '1', '2023-10-23', 101, NULL, NULL),
(236, 'SI-230926-20', 145, 'Received from Customer for Invoice SI-230926-20', 500, '-1', '2023-10-23', 101, NULL, NULL),
(237, 'SI-230924-14', 101, 'Received from Customer for Invoice SI-230924-14', 1000, '1', '2023-10-23', 101, NULL, NULL),
(238, 'SI-230924-14', 139, 'Received from Customer for Invoice SI-230924-14', 1000, '-1', '2023-10-23', 101, NULL, NULL),
(239, 'SI-230927-25', 101, 'Received from Customer for Invoice SI-230927-25', 2300, '1', '2023-10-25', 101, NULL, NULL),
(240, 'SI-230927-25', 147, 'Received from Customer for Invoice SI-230927-25', 2300, '-1', '2023-10-25', 101, NULL, NULL),
(241, 'SI-231004-30', 101, 'Received from Customer for Invoice SI-231004-30', 1700, '1', '2023-10-25', 101, NULL, NULL),
(242, 'SI-231004-30', 150, 'Received from Customer for Invoice SI-231004-30', 1700, '-1', '2023-10-25', 101, NULL, NULL),
(243, 'SI-231026-65', 164, 'Goods sold on credit', 6000, '1', '2023-10-26', 101, NULL, NULL),
(244, 'SI-231026-65', 401, 'Goods sold on credit', 6000, '-1', '2023-10-26', 101, NULL, NULL),
(245, 'EXP-231026-48', 315, 'Marketting and Travel', 1500, '1', '2023-10-26', 101, NULL, NULL),
(246, 'EXP-231026-48', 101, 'Marketting and Travel', 1500, '-1', '2023-10-26', 101, NULL, NULL),
(247, 'SI-230926-20', 101, 'Received from Customer for Invoice SI-230926-20', 1500, '1', '2023-10-28', 101, NULL, NULL),
(248, 'SI-230926-20', 145, 'Received from Customer for Invoice SI-230926-20', 1500, '-1', '2023-10-28', 101, NULL, NULL),
(249, 'SI-231009-37', 101, 'Received from Customer for Invoice SI-231009-37', 2000, '1', '2023-10-28', 101, NULL, NULL),
(250, 'SI-231009-37', 152, 'Received from Customer for Invoice SI-231009-37', 2000, '-1', '2023-10-28', 101, NULL, NULL),
(251, 'SI-231009-38', 101, 'Received from Customer for Invoice SI-231009-38', 1200, '1', '2023-10-28', 101, NULL, NULL),
(252, 'SI-231009-38', 153, 'Received from Customer for Invoice SI-231009-38', 1200, '-1', '2023-10-28', 101, NULL, NULL),
(253, 'SI-231030-69', 165, 'Goods sold on credit', 6000, '1', '2023-10-30', 101, NULL, NULL),
(254, 'SI-231030-69', 401, 'Goods sold on credit', 6000, '-1', '2023-10-30', 101, NULL, NULL),
(255, 'EXP-231101-49', 302, 'Salary Expense', 2000, '1', '2023-11-01', 101, NULL, NULL),
(256, 'EXP-231101-49', 101, 'Salary Expense', 2000, '-1', '2023-11-01', 101, NULL, NULL),
(257, 'EXP-231101-50', 315, 'Marketting and Travel', 2000, '1', '2023-11-01', 101, NULL, NULL),
(258, 'EXP-231101-50', 101, 'Marketting and Travel', 2000, '-1', '2023-11-01', 101, NULL, NULL),
(259, 'EXP-231101-51', 316, 'Domain Purchase', 1610, '1', '2023-11-01', 101, NULL, NULL),
(260, 'EXP-231101-51', 101, 'Domain Purchase', 1610, '-1', '2023-11-01', 101, NULL, NULL),
(261, 'EXP-231104-52', 302, 'Salary Expense', 3000, '1', '2023-11-04', 101, NULL, NULL),
(262, 'EXP-231104-52', 101, 'Salary Expense', 3000, '-1', '2023-11-04', 101, NULL, NULL),
(263, 'EXP-231105-53', 315, 'Marketting and Travel', 2500, '1', '2023-11-05', 101, NULL, NULL),
(264, 'EXP-231105-53', 101, 'Marketting and Travel', 2500, '-1', '2023-11-05', 101, NULL, NULL),
(265, 'SI-230927-24', 101, 'Received from Customer for Invoice SI-230927-24', 800, '1', '2023-11-05', 101, NULL, NULL),
(266, 'SI-230927-24', 148, 'Received from Customer for Invoice SI-230927-24', 800, '-1', '2023-11-05', 101, NULL, NULL),
(267, 'SI-231026-65', 101, 'Received from Customer for Invoice SI-231026-65', 3500, '1', '2023-11-05', 101, NULL, NULL),
(268, 'SI-231026-65', 164, 'Received from Customer for Invoice SI-231026-65', 3500, '-1', '2023-11-05', 101, NULL, NULL),
(269, 'SI-231009-38', 101, 'Received from Customer for Invoice SI-231009-38', 1300, '1', '2023-11-05', 101, NULL, NULL),
(270, 'SI-231009-38', 153, 'Received from Customer for Invoice SI-231009-38', 1300, '-1', '2023-11-05', 101, NULL, NULL),
(271, 'EXP-231105-54', 316, 'Domain Purchase', 1610, '1', '2023-11-05', 101, NULL, NULL),
(272, 'EXP-231105-54', 101, 'Domain Purchase', 1610, '-1', '2023-11-05', 101, NULL, NULL),
(273, 'SI-231018-56', 101, 'Received from Customer for Invoice SI-231018-56', 3500, '1', '2023-11-06', 101, NULL, NULL),
(274, 'SI-231018-56', 162, 'Received from Customer for Invoice SI-231018-56', 3500, '-1', '2023-11-06', 101, NULL, NULL),
(275, 'EXP-231106-55', 316, 'Domain Purchase', 1610, '1', '2023-11-06', 101, NULL, NULL),
(276, 'EXP-231106-55', 101, 'Domain Purchase', 1610, '-1', '2023-11-06', 101, NULL, NULL),
(277, 'SI-231106-74', 166, 'Goods sold on credit', 5000, '1', '2023-11-06', 101, NULL, NULL),
(278, 'SI-231106-74', 401, 'Goods sold on credit', 5000, '-1', '2023-11-06', 101, NULL, NULL),
(279, 'EXP-231107-56', 302, 'Salary Expense', 15000, '1', '2023-11-07', 101, NULL, NULL),
(280, 'EXP-231107-56', 101, 'Salary Expense', 15000, '-1', '2023-11-07', 101, NULL, NULL),
(281, 'SI-230915-7', 101, 'Received from Customer for Invoice SI-230915-7', 4400, '1', '2023-11-07', 101, NULL, NULL),
(282, 'SI-230915-7', 133, 'Received from Customer for Invoice SI-230915-7', 4400, '-1', '2023-11-07', 101, NULL, NULL),
(283, 'SI-231022-58', 101, 'Received from Customer for Invoice SI-231022-58', 6000, '1', '2023-11-07', 101, NULL, NULL),
(284, 'SI-231022-58', 163, 'Received from Customer for Invoice SI-231022-58', 6000, '-1', '2023-11-07', 101, NULL, NULL),
(285, 'SI-231017-52', 101, 'Received from Customer for Invoice SI-231017-52', 4500, '1', '2023-11-07', 101, NULL, NULL),
(286, 'SI-231017-52', 158, 'Received from Customer for Invoice SI-231017-52', 4500, '-1', '2023-11-07', 101, NULL, NULL),
(287, 'SI-231109-78', 167, 'Goods sold on credit', 4000, '1', '2023-11-09', 101, NULL, NULL),
(288, 'SI-231109-78', 401, 'Goods sold on credit', 4000, '-1', '2023-11-09', 101, NULL, NULL),
(289, 'EXP-231109-57', 302, 'Salary Expense', 2000, '1', '2023-11-09', 101, NULL, NULL),
(290, 'EXP-231109-57', 101, 'Salary Expense', 2000, '-1', '2023-11-09', 101, NULL, NULL),
(291, 'EXP-231109-58', 302, 'Salary Expense', 15000, '1', '2023-11-09', 101, NULL, NULL),
(292, 'EXP-231109-58', 101, 'Salary Expense', 15000, '-1', '2023-11-09', 101, NULL, NULL),
(293, 'EXP-231109-59', 316, 'Domain Purchase', 1610, '1', '2023-11-09', 101, NULL, NULL),
(294, 'EXP-231109-59', 101, 'Domain Purchase', 1610, '-1', '2023-11-09', 101, NULL, NULL),
(295, 'SI-230924-14', 101, 'Received from Customer for Invoice SI-230924-14', 1000, '1', '2023-11-09', 101, NULL, NULL),
(296, 'SI-230924-14', 139, 'Received from Customer for Invoice SI-230924-14', 1000, '-1', '2023-11-09', 101, NULL, NULL),
(297, 'SI-230926-19', 101, 'Received from Customer for Invoice SI-230926-19', 900, '1', '2023-11-09', 101, NULL, NULL),
(298, 'SI-230926-19', 144, 'Received from Customer for Invoice SI-230926-19', 900, '-1', '2023-11-09', 101, NULL, NULL),
(299, 'SI-231018-56', 101, 'Received from Customer for Invoice SI-231018-56', 2500, '1', '2023-11-09', 101, NULL, NULL),
(300, 'SI-231018-56', 162, 'Received from Customer for Invoice SI-231018-56', 2500, '-1', '2023-11-09', 101, NULL, NULL),
(301, 'SI-231017-53', 101, 'Received from Customer for Invoice SI-231017-53', 3200, '1', '2023-11-09', 101, NULL, NULL),
(302, 'SI-231017-53', 159, 'Received from Customer for Invoice SI-231017-53', 3200, '-1', '2023-11-09', 101, NULL, NULL),
(336, 'SI-231120-93', 401, 'Goods sold on credit', 4000, '-1', '2023-11-20', 101, NULL, NULL),
(335, 'SI-231120-93', 170, 'Goods sold on credit', 4000, '1', '2023-11-20', 101, NULL, NULL),
(305, 'EXP-231109-60', 316, 'Domain Purchase', 1610, '1', '2023-11-09', 101, NULL, NULL),
(306, 'EXP-231109-60', 101, 'Domain Purchase', 1610, '-1', '2023-11-09', 101, NULL, NULL),
(307, 'SI-231012-47', 101, 'Received from Customer for Invoice SI-231012-47', 3000, '1', '2023-11-09', 101, NULL, NULL),
(308, 'SI-231012-47', 154, 'Received from Customer for Invoice SI-231012-47', 3000, '-1', '2023-11-09', 101, NULL, NULL),
(309, 'SI-231106-74', 101, 'Received from Customer for Invoice SI-231106-74', 4000, '1', '2023-11-09', 101, NULL, NULL),
(310, 'SI-231106-74', 166, 'Received from Customer for Invoice SI-231106-74', 4000, '-1', '2023-11-09', 101, NULL, NULL),
(311, 'SI-231030-69', 101, 'Received from Customer for Invoice SI-231030-69', 3200, '1', '2023-11-09', 101, NULL, NULL),
(312, 'SI-231030-69', 165, 'Received from Customer for Invoice SI-231030-69', 3200, '-1', '2023-11-09', 101, NULL, NULL),
(313, 'SI-231114-87', 168, 'Goods sold on credit', 4000, '1', '2023-11-14', 101, NULL, NULL),
(314, 'SI-231114-87', 401, 'Goods sold on credit', 4000, '-1', '2023-11-14', 101, NULL, NULL),
(315, 'SI-231109-78', 101, 'Received from Customer for Invoice SI-231109-78', 4000, '1', '2023-11-14', 101, NULL, NULL),
(316, 'SI-231109-78', 167, 'Received from Customer for Invoice SI-231109-78', 4000, '-1', '2023-11-14', 101, NULL, NULL),
(317, 'SI-231026-65', 101, 'Received from Customer for Invoice SI-231026-65', 2500, '1', '2023-11-14', 101, NULL, NULL),
(318, 'SI-231026-65', 164, 'Received from Customer for Invoice SI-231026-65', 2500, '-1', '2023-11-14', 101, NULL, NULL),
(319, 'EXP-231114-61', 302, 'Salary Expense', 5000, '1', '2023-11-14', 101, NULL, NULL),
(320, 'EXP-231114-61', 101, 'Salary Expense', 5000, '-1', '2023-11-14', 101, NULL, NULL),
(321, 'EXP-231114-62', 315, 'Marketting and Travel', 2500, '1', '2023-11-14', 101, NULL, NULL),
(322, 'EXP-231114-62', 101, 'Marketting and Travel', 2500, '-1', '2023-11-14', 101, NULL, NULL),
(323, 'SI-231017-50', 101, 'Received from Customer for Invoice SI-231017-50', 3500, '1', '2023-11-18', 101, NULL, NULL),
(324, 'SI-231017-50', 156, 'Received from Customer for Invoice SI-231017-50', 3500, '-1', '2023-11-18', 101, NULL, NULL),
(325, 'SI-231012-48', 101, 'Received from Customer for Invoice SI-231012-48', 1000, '1', '2023-11-18', 101, NULL, NULL),
(326, 'SI-231012-48', 155, 'Received from Customer for Invoice SI-231012-48', 1000, '-1', '2023-11-18', 101, NULL, NULL),
(327, 'SI-231119-92', 169, 'Goods sold on credit', 4000, '1', '2023-11-19', 101, NULL, NULL),
(328, 'SI-231119-92', 401, 'Goods sold on credit', 4000, '-1', '2023-11-19', 101, NULL, NULL),
(329, 'SI-230926-20', 101, 'Received from Customer for Invoice SI-230926-20', 400, '1', '2023-11-19', 101, NULL, NULL),
(330, 'SI-230926-20', 145, 'Received from Customer for Invoice SI-230926-20', 400, '-1', '2023-11-19', 101, NULL, NULL),
(331, 'EXP-231119-63', 302, 'Salary Expense', 2500, '1', '2023-11-19', 101, NULL, NULL),
(332, 'EXP-231119-63', 101, 'Salary Expense', 2500, '-1', '2023-11-19', 101, NULL, NULL),
(333, 'EXP-231119-64', 315, 'Marketting and Travel', 1240, '1', '2023-11-19', 101, NULL, NULL),
(334, 'EXP-231119-64', 101, 'Marketting and Travel', 1240, '-1', '2023-11-19', 101, NULL, NULL),
(337, 'SI-231121-94', 171, 'Goods sold on credit', 5000, '1', '2023-11-21', 101, NULL, NULL),
(338, 'SI-231121-94', 401, 'Goods sold on credit', 5000, '-1', '2023-11-21', 101, NULL, NULL),
(339, 'SI-231121-95', 172, 'Goods sold on credit', 6000, '1', '2023-11-21', 101, NULL, NULL),
(340, 'SI-231121-95', 401, 'Goods sold on credit', 6000, '-1', '2023-11-21', 101, NULL, NULL),
(341, 'EXP-231122-65', 315, 'Marketting and Travel', 1200, '1', '2023-11-22', 101, NULL, NULL),
(342, 'EXP-231122-65', 101, 'Marketting and Travel', 1200, '-1', '2023-11-22', 101, NULL, NULL),
(343, 'EXP-231122-66', 316, 'Domain Purchase', 1610, '1', '2023-11-22', 101, NULL, NULL),
(344, 'EXP-231122-66', 101, 'Domain Purchase', 1610, '-1', '2023-11-22', 101, NULL, NULL),
(345, 'SI-231017-53', 101, 'Received from Customer for Invoice SI-231017-53', 1800, '1', '2023-11-22', 101, NULL, NULL),
(346, 'SI-231017-53', 159, 'Received from Customer for Invoice SI-231017-53', 1800, '-1', '2023-11-22', 101, NULL, NULL),
(347, 'SI-231017-51', 101, 'Received from Customer for Invoice SI-231017-51', 3000, '1', '2023-11-22', 101, NULL, NULL),
(348, 'SI-231017-51', 157, 'Received from Customer for Invoice SI-231017-51', 3000, '-1', '2023-11-22', 101, NULL, NULL),
(349, 'EXP-231124-67', 302, 'Salary Expense', 1000, '1', '2023-11-24', 101, NULL, NULL),
(350, 'EXP-231124-67', 101, 'Salary Expense', 1000, '-1', '2023-11-24', 101, NULL, NULL),
(351, 'EXP-231124-68', 316, 'Domain Purchase', 1610, '1', '2023-11-24', 101, NULL, NULL),
(352, 'EXP-231124-68', 101, 'Domain Purchase', 1610, '-1', '2023-11-24', 101, NULL, NULL),
(353, 'SI-231126-98', 173, 'Goods sold on credit', 6000, '1', '2023-11-26', 101, NULL, NULL),
(354, 'SI-231126-98', 401, 'Goods sold on credit', 6000, '-1', '2023-11-26', 101, NULL, NULL),
(355, 'SI-230926-21', 101, 'Received from Customer for Invoice SI-230926-21', 500, '1', '2023-11-28', 101, NULL, NULL),
(356, 'SI-230926-21', 146, 'Received from Customer for Invoice SI-230926-21', 500, '-1', '2023-11-28', 101, NULL, NULL),
(357, 'SI-231114-87', 101, 'Received from Customer for Invoice SI-231114-87', 4000, '1', '2023-11-28', 101, NULL, NULL),
(358, 'SI-231114-87', 168, 'Received from Customer for Invoice SI-231114-87', 4000, '-1', '2023-11-28', 101, NULL, NULL),
(359, 'SI-231121-94', 101, 'Received from Customer for Invoice SI-231121-94', 3500, '1', '2023-11-28', 101, NULL, NULL),
(360, 'SI-231121-94', 171, 'Received from Customer for Invoice SI-231121-94', 3500, '-1', '2023-11-28', 101, NULL, NULL),
(361, 'SI-231121-95', 101, 'Received from Customer for Invoice SI-231121-95', 1500, '1', '2023-11-28', 101, NULL, NULL),
(362, 'SI-231121-95', 172, 'Received from Customer for Invoice SI-231121-95', 1500, '-1', '2023-11-28', 101, NULL, NULL),
(363, 'EXP-231128-69', 315, 'Marketting and Travel', 2500, '1', '2023-11-28', 101, NULL, NULL),
(364, 'EXP-231128-69', 101, 'Marketting and Travel', 2500, '-1', '2023-11-28', 101, NULL, NULL),
(365, 'EXP-231129-70', 316, 'Domain Purchase', 1610, '1', '2023-11-29', 101, NULL, NULL),
(366, 'EXP-231129-70', 101, 'Domain Purchase', 1610, '-1', '2023-11-29', 101, NULL, NULL),
(367, 'EXP-231129-71', 316, 'Domain Purchase', 1610, '1', '2023-11-29', 101, NULL, NULL),
(368, 'EXP-231129-71', 101, 'Domain Purchase', 1610, '-1', '2023-11-29', 101, NULL, NULL),
(369, 'EXP-231202-72', 302, 'Salary Expense', 1000, '1', '2023-12-02', 101, NULL, NULL),
(370, 'EXP-231202-72', 101, 'Salary Expense', 1000, '-1', '2023-12-02', 101, NULL, NULL),
(371, 'EXP-231205-73', 315, 'Marketting and Travel', 2500, '1', '2023-12-05', 101, NULL, NULL),
(372, 'EXP-231205-73', 101, 'Marketting and Travel', 2500, '-1', '2023-12-05', 101, NULL, NULL),
(373, 'SI-230922-12', 101, 'Received from Customer for Invoice SI-230922-12', 2000, '1', '2023-12-14', 101, NULL, NULL),
(374, 'SI-230922-12', 136, 'Received from Customer for Invoice SI-230922-12', 2000, '-1', '2023-12-14', 101, NULL, NULL),
(375, 'EXP-231214-74', 302, 'Salary Expense', 500, '1', '2023-12-14', 101, NULL, NULL),
(376, 'EXP-231214-74', 101, 'Salary Expense', 500, '-1', '2023-12-14', 101, NULL, NULL),
(377, 'EXP-231214-75', 315, 'Marketting and Travel', 2500, '1', '2023-12-14', 101, NULL, NULL),
(378, 'EXP-231214-75', 101, 'Marketting and Travel', 2500, '-1', '2023-12-14', 101, NULL, NULL),
(379, 'EXP-231214-76', 301, 'General Expense', 500, '1', '2023-12-14', 101, NULL, NULL),
(380, 'EXP-231214-76', 101, 'General Expense', 500, '-1', '2023-12-14', 101, NULL, NULL),
(381, 'EXP-231214-77', 315, 'Marketting and Travel', 550, '1', '2023-12-14', 101, NULL, NULL),
(382, 'EXP-231214-77', 101, 'Marketting and Travel', 550, '-1', '2023-12-14', 101, NULL, NULL),
(383, 'EXP-231218-78', 302, 'Salary Expense', 10000, '1', '2023-12-18', 101, NULL, NULL),
(384, 'EXP-231218-78', 101, 'Salary Expense', 10000, '-1', '2023-12-18', 101, NULL, NULL),
(385, 'EXP-231218-79', 316, 'Domain Purchase', 1610, '1', '2023-12-18', 101, NULL, NULL),
(386, 'EXP-231218-79', 101, 'Domain Purchase', 1610, '-1', '2023-12-18', 101, NULL, NULL),
(387, 'SI-230922-10', 101, 'Received from Customer for Invoice SI-230922-10', 3000, '1', '2023-12-18', 101, NULL, NULL),
(388, 'SI-230922-10', 138, 'Received from Customer for Invoice SI-230922-10', 3000, '-1', '2023-12-18', 101, NULL, NULL),
(389, 'SI-230924-13', 101, 'Received from Customer for Invoice SI-230924-13', 3000, '1', '2023-12-18', 101, NULL, NULL),
(390, 'SI-230924-13', 140, 'Received from Customer for Invoice SI-230924-13', 3000, '-1', '2023-12-18', 101, NULL, NULL),
(391, 'SI-231017-50', 101, 'Received from Customer for Invoice SI-231017-50', 1500, '1', '2023-12-18', 101, NULL, NULL),
(392, 'SI-231017-50', 156, 'Received from Customer for Invoice SI-231017-50', 1500, '-1', '2023-12-18', 101, NULL, NULL),
(393, 'SI-230915-6', 101, 'Received from Customer for Invoice SI-230915-6', 2000, '1', '2023-12-18', 101, NULL, NULL),
(394, 'SI-230915-6', 132, 'Received from Customer for Invoice SI-230915-6', 2000, '-1', '2023-12-18', 101, NULL, NULL),
(395, 'EXP-240104-80', 315, 'Marketting and Travel', 2500, '1', '2024-01-04', 101, NULL, NULL),
(396, 'EXP-240104-80', 101, 'Marketting and Travel', 2500, '-1', '2024-01-04', 101, NULL, NULL),
(397, 'EXP-240104-81', 316, 'Domain Purchase', 1610, '1', '2024-01-04', 101, NULL, NULL),
(398, 'EXP-240104-81', 101, 'Domain Purchase', 1610, '-1', '2024-01-04', 101, NULL, NULL),
(399, 'SI-231126-98', 101, 'Received from Customer for Invoice SI-231126-98', 6000, '1', '2024-01-04', 101, NULL, NULL),
(400, 'SI-231126-98', 173, 'Received from Customer for Invoice SI-231126-98', 6000, '-1', '2024-01-04', 101, NULL, NULL),
(401, 'SI-231121-95', 101, 'Received from Customer for Invoice SI-231121-95', 2000, '1', '2024-01-04', 101, NULL, NULL),
(402, 'SI-231121-95', 172, 'Received from Customer for Invoice SI-231121-95', 2000, '-1', '2024-01-04', 101, NULL, NULL),
(403, 'EXP-240104-82', 301, 'General Expense', 500, '1', '2024-01-04', 101, NULL, NULL),
(404, 'EXP-240104-82', 101, 'General Expense', 500, '-1', '2024-01-04', 101, NULL, NULL),
(405, 'EXP-240104-83', 301, 'General Expense', 500, '1', '2024-01-04', 101, NULL, NULL),
(406, 'EXP-240104-83', 101, 'General Expense', 500, '-1', '2024-01-04', 101, NULL, NULL),
(407, 'SI-230922-9', 101, 'Received from Customer for Invoice SI-230922-9', 2000, '1', '2024-01-04', 101, NULL, NULL),
(408, 'SI-230922-9', 135, 'Received from Customer for Invoice SI-230922-9', 2000, '-1', '2024-01-04', 101, NULL, NULL),
(409, 'SI-230914-4', 101, 'Received from Customer for Invoice SI-230914-4', 2000, '1', '2024-01-14', 101, NULL, NULL),
(410, 'SI-230914-4', 131, 'Received from Customer for Invoice SI-230914-4', 2000, '-1', '2024-01-14', 101, NULL, NULL),
(411, 'SI-231121-95', 101, 'Received from Customer for Invoice SI-231121-95', 2500, '1', '2024-01-14', 101, NULL, NULL),
(412, 'SI-231121-95', 172, 'Received from Customer for Invoice SI-231121-95', 2500, '-1', '2024-01-14', 101, NULL, NULL),
(413, 'EXP-240114-84', 315, 'Marketting and Travel', 2500, '1', '2024-01-14', 101, NULL, NULL),
(414, 'EXP-240114-84', 101, 'Marketting and Travel', 2500, '-1', '2024-01-14', 101, NULL, NULL),
(415, 'EXP-240114-85', 302, 'Salary Expense', 3000, '1', '2024-01-14', 101, NULL, NULL),
(416, 'EXP-240114-85', 101, 'Salary Expense', 3000, '-1', '2024-01-14', 101, NULL, NULL),
(417, 'SI-230924-13', 101, 'Received from Customer for Invoice SI-230924-13', 4000, '1', '2024-01-31', 101, NULL, NULL),
(418, 'SI-230924-13', 140, 'Received from Customer for Invoice SI-230924-13', 4000, '-1', '2024-01-31', 101, NULL, NULL),
(419, 'EXP-240131-86', 315, 'Marketting and Travel', 2500, '1', '2024-01-31', 101, NULL, NULL),
(420, 'EXP-240131-86', 101, 'Marketting and Travel', 2500, '-1', '2024-01-31', 101, NULL, NULL),
(421, 'EXP-240131-87', 301, 'General Expense', 2000, '1', '2024-01-31', 101, NULL, NULL),
(422, 'EXP-240131-87', 101, 'General Expense', 2000, '-1', '2024-01-31', 101, NULL, NULL),
(423, 'EXP-240131-88', 302, 'Salary Expense', 1500, '1', '2024-01-31', 101, NULL, NULL),
(424, 'EXP-240131-88', 101, 'Salary Expense', 1500, '-1', '2024-01-31', 101, NULL, NULL),
(425, 'SI-230922-11', 101, 'Received from Customer for Invoice SI-230922-11', 1000, '1', '2024-01-31', 101, NULL, NULL),
(426, 'SI-230922-11', 137, 'Received from Customer for Invoice SI-230922-11', 1000, '-1', '2024-01-31', 101, NULL, NULL),
(427, 'EXP-240222-89', 315, 'Marketting and Travel', 2500, '1', '2024-02-22', 101, NULL, NULL),
(428, 'EXP-240222-89', 101, 'Marketting and Travel', 2500, '-1', '2024-02-22', 101, NULL, NULL),
(429, 'SI-240312-115', 101, '--Goods Sold in cash 5000', 5000, '1', '2024-03-12', 101, NULL, NULL),
(430, 'SI-240312-115', 174, '--Goods Sold on credit with discount', 10000, '1', '2024-03-12', 101, NULL, NULL),
(431, 'SI-240312-115', 401, '--Goods Sold on credit with discount', 15000, '-1', '2024-03-12', 101, NULL, NULL),
(432, 'EXP-240314-90', 316, 'Domain Purchase', 2875, '1', '2024-03-14', 101, NULL, NULL),
(433, 'EXP-240314-90', 101, 'Domain Purchase', 2875, '-1', '2024-03-14', 101, NULL, NULL),
(434, 'EXP-240314-91', 302, 'Salary Expense', 1000, '1', '2024-03-14', 101, NULL, NULL),
(435, 'EXP-240314-91', 101, 'Salary Expense', 1000, '-1', '2024-03-14', 101, NULL, NULL),
(436, 'EXP-240314-92', 302, 'Salary Expense', 1000, '1', '2024-03-14', 101, NULL, NULL),
(437, 'EXP-240314-92', 101, 'Salary Expense', 1000, '-1', '2024-03-14', 101, NULL, NULL),
(438, 'EXP-240314-93', 315, 'Marketting and Travel', 1500, '1', '2024-03-14', 101, NULL, NULL),
(439, 'EXP-240314-93', 101, 'Marketting and Travel', 1500, '-1', '2024-03-14', 101, NULL, NULL),
(440, 'EXP-240314-93', 315, 'Marketting and Travel', 1500, '1', '2024-03-14', 101, NULL, NULL),
(441, 'EXP-240314-93', 101, 'Marketting and Travel', 1500, '-1', '2024-03-14', 101, NULL, NULL),
(442, 'SI-240402-116', 101, 'Goods sold in cash 3110', 3110, '1', '2024-04-02', 101, NULL, NULL),
(443, 'SI-240402-116', 401, 'Goods sold in cash3110', 3110, '-1', '2024-04-02', 101, NULL, NULL),
(444, 'EXP-240402-95', 316, 'Domain Purchase', 160, '1', '2024-04-02', 101, NULL, NULL),
(445, 'EXP-240402-95', 101, 'Domain Purchase', 160, '-1', '2024-04-02', 101, NULL, NULL),
(446, 'EXP-240402-96', 316, 'Domain Purchase', 1610, '1', '2024-04-02', 101, NULL, NULL),
(447, 'EXP-240402-96', 101, 'Domain Purchase', 1610, '-1', '2024-04-02', 101, NULL, NULL),
(448, 'SI-240312-115', 101, 'Received from Customer for Invoice SI-240312-115', 10000, '1', '2024-04-08', 101, NULL, NULL),
(449, 'SI-240312-115', 174, 'Received from Customer for Invoice SI-240312-115', 10000, '-1', '2024-04-08', 101, NULL, NULL),
(450, 'EXP-240520-97', 302, 'Salary Expense', 3000, '1', '2024-05-20', 101, NULL, NULL),
(451, 'EXP-240520-97', 101, 'Salary Expense', 3000, '-1', '2024-05-20', 101, NULL, NULL),
(452, 'EXP-240520-98', 302, 'Salary Expense', 7000, '1', '2024-05-20', 101, NULL, NULL),
(453, 'EXP-240520-98', 101, 'Salary Expense', 7000, '-1', '2024-05-20', 101, NULL, NULL),
(454, 'SI-240529-118', 176, 'Goods sold on credit', 5000, '1', '2024-05-29', 101, NULL, NULL),
(455, 'SI-240529-118', 401, 'Goods sold on credit', 5000, '-1', '2024-05-29', 101, NULL, NULL),
(456, 'SI-240529-118', 101, 'Received from Customer for Invoice SI-240529-118', 5000, '1', '2024-05-29', 101, NULL, NULL),
(457, 'SI-240529-118', 176, 'Received from Customer for Invoice SI-240529-118', 5000, '-1', '2024-05-29', 101, NULL, NULL),
(458, 'JI-240907-3', 101, 'test', 500, '1', '2024-09-10', 101, NULL, NULL),
(459, 'JI-240907-3', 316, 'test', 500, '-1', '2024-09-10', 101, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `unit_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `unit_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `unit_status` tinyint(1) NOT NULL DEFAULT '0',
  `store_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `units_unit_hash_id_unique` (`unit_hash_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_hash_id`, `unit_name`, `unit_status`, `store_id`, `created_at`, `updated_at`) VALUES
(8, '644d8d8a0db263fe8e6b9770d7e4a3f4', 'Job', 1, 101, '2023-09-09 12:03:52', '2023-09-09 12:03:52'),
(13, '7b3da5dca0e1ac8d541869965b990fea', 'tsts', 1, 101, '2024-08-24 00:01:44', '2024-08-24 00:01:44'),
(15, '9f41d28029a6e5498efe36b2ccde9647', 'tst', 1, 101, '2024-09-07 01:15:20', '2024-09-07 01:15:20'),
(16, '399f16ec97ff05b0a42c79852a9d42f2', 'retr', 1, 101, '2024-09-07 01:42:40', '2024-09-07 01:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_hash_id` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_user_hash_id_unique` (`user_hash_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
