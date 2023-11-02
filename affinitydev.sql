-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2023 at 07:30 PM
-- Server version: 8.1.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affinitydev`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `order`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'Category 1', 'category-1', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(2, NULL, 1, 'Category 2', 'category-2', '2023-09-24 23:14:58', '2023-09-24 23:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_address`, `company_phone`, `company_email`, `company_number`, `vat_number`, `logo`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Etihad Resources', 'Abuja', '1232133', 'airondev@gmail.com', '535234', '213213', '', 1, '2023-10-05 09:14:43', '2023-10-05 09:16:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `store_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `store_id`, `name`, `email`, `phone`, `address_line_1`, `address_line_2`, `address_city`, `address_state`, `address_country`, `address_postcode`, `note`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:54:25', '2023-10-06 06:54:25'),
(2, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:55:41', '2023-10-06 06:55:41'),
(3, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:55:55', '2023-10-06 06:55:55'),
(4, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:56:15', '2023-10-06 06:56:15'),
(5, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:56:47', '2023-10-06 06:56:47'),
(6, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:57:29', '2023-10-06 06:57:29'),
(7, NULL, 1, 'John Deo', 'airondev@gmail.com', NULL, 'Gwagwas', 'Abuja', 'FCT', NULL, 'Nigeria', '1231', NULL, '2023-10-06 06:57:38', '2023-10-06 06:57:38'),
(8, NULL, 1, 'sa', 'as', NULL, 'as', 'sa', 'as', NULL, 'as', 'aS', NULL, '2023-10-14 12:06:36', '2023-10-14 12:06:36'),
(9, NULL, 1, 'sad', 'sad', NULL, 'asd', 'asd', 'asd', NULL, 'asd', 'asd', NULL, '2023-10-14 12:11:22', '2023-10-14 12:11:22'),
(10, NULL, 1, 'asd', 'ads', NULL, 'ads', 'ads', 'dsa', NULL, 'ad', 'ads', NULL, '2023-10-14 12:16:10', '2023-10-14 12:16:10'),
(11, NULL, 1, 'q', 'q', NULL, 'q', 'q', 'as', NULL, 'W', 'Q', NULL, '2023-10-14 12:19:51', '2023-10-14 12:19:51'),
(12, NULL, 1, 'Greentech', 'greentech@gmail.com', '213213', 'Gwagwas', 'Abaji', 'London', NULL, 'UK', '123213', NULL, '2023-10-26 07:50:42', '2023-10-26 07:50:42'),
(13, NULL, 1, 'Harry', 'Harry@gmail.com', '00000000', 'Qwe', 'Qwe', 'derby', NULL, 'united kingdom', 'Qwe', NULL, '2023-10-30 18:40:22', '2023-10-30 18:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `data_rows`
--

CREATE TABLE `data_rows` (
  `id` int UNSIGNED NOT NULL,
  `data_type_id` int UNSIGNED NOT NULL,
  `field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_rows`
--

INSERT INTO `data_rows` (`id`, `data_type_id`, `field`, `type`, `display_name`, `required`, `browse`, `read`, `edit`, `add`, `delete`, `details`, `order`) VALUES
(1, 1, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(2, 1, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(3, 1, 'email', 'text', 'Email', 1, 1, 1, 1, 1, 1, NULL, 3),
(4, 1, 'password', 'password', 'Password', 1, 0, 0, 1, 1, 0, NULL, 4),
(5, 1, 'remember_token', 'text', 'Remember Token', 0, 0, 0, 0, 0, 0, NULL, 5),
(6, 1, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 6),
(7, 1, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 7),
(8, 1, 'avatar', 'image', 'Avatar', 0, 1, 1, 1, 1, 1, NULL, 8),
(9, 1, 'user_belongsto_role_relationship', 'relationship', 'Role', 0, 1, 1, 1, 1, 0, '{\"model\":\"Modules\\\\Admin\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}', 10),
(10, 1, 'user_belongstomany_role_relationship', 'relationship', 'Roles', 0, 1, 1, 1, 1, 0, '{\"model\":\"Modules\\\\Admin\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}', 11),
(11, 1, 'settings', 'hidden', 'Settings', 0, 0, 0, 0, 0, 0, NULL, 12),
(12, 2, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(13, 2, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(14, 2, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(15, 2, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(16, 3, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(17, 3, 'name', 'text', 'Name', 1, 1, 1, 1, 1, 1, NULL, 2),
(18, 3, 'created_at', 'timestamp', 'Created At', 0, 0, 0, 0, 0, 0, NULL, 3),
(19, 3, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 4),
(20, 3, 'display_name', 'text', 'Display Name', 1, 1, 1, 1, 1, 1, NULL, 5),
(21, 1, 'role_id', 'text', 'Role', 1, 1, 1, 1, 1, 1, NULL, 9),
(29, 5, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(30, 5, 'author_id', 'text', 'Author', 1, 0, 1, 1, 0, 1, NULL, 2),
(31, 5, 'category_id', 'text', 'Category', 1, 0, 1, 1, 1, 0, NULL, 3),
(32, 5, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 4),
(33, 5, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 5),
(34, 5, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 6),
(35, 5, 'image', 'image', 'Post Image', 0, 1, 1, 1, 1, 1, '{\"resize\":{\"width\":\"1000\",\"height\":\"null\"},\"quality\":\"70%\",\"upsize\":true,\"thumbnails\":[{\"name\":\"medium\",\"scale\":\"50%\"},{\"name\":\"small\",\"scale\":\"25%\"},{\"name\":\"cropped\",\"crop\":{\"width\":\"300\",\"height\":\"250\"}}]}', 7),
(36, 5, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\",\"forceUpdate\":true},\"validation\":{\"rule\":\"unique:posts,slug\"}}', 8),
(37, 5, 'meta_description', 'text_area', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 9),
(38, 5, 'meta_keywords', 'text_area', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 10),
(39, 5, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"DRAFT\",\"options\":{\"PUBLISHED\":\"published\",\"DRAFT\":\"draft\",\"PENDING\":\"pending\"}}', 11),
(40, 5, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 0, 0, 0, NULL, 12),
(41, 5, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, NULL, 13),
(42, 5, 'seo_title', 'text', 'SEO Title', 0, 1, 1, 1, 1, 1, NULL, 14),
(43, 5, 'featured', 'checkbox', 'Featured', 1, 1, 1, 1, 1, 1, NULL, 15),
(44, 6, 'id', 'number', 'ID', 1, 0, 0, 0, 0, 0, NULL, 1),
(45, 6, 'author_id', 'text', 'Author', 1, 0, 0, 0, 0, 0, NULL, 2),
(46, 6, 'title', 'text', 'Title', 1, 1, 1, 1, 1, 1, NULL, 3),
(47, 6, 'excerpt', 'text_area', 'Excerpt', 1, 0, 1, 1, 1, 1, NULL, 4),
(48, 6, 'body', 'rich_text_box', 'Body', 1, 0, 1, 1, 1, 1, NULL, 5),
(49, 6, 'slug', 'text', 'Slug', 1, 0, 1, 1, 1, 1, '{\"slugify\":{\"origin\":\"title\"},\"validation\":{\"rule\":\"unique:pages,slug\"}}', 6),
(50, 6, 'meta_description', 'text', 'Meta Description', 1, 0, 1, 1, 1, 1, NULL, 7),
(51, 6, 'meta_keywords', 'text', 'Meta Keywords', 1, 0, 1, 1, 1, 1, NULL, 8),
(52, 6, 'status', 'select_dropdown', 'Status', 1, 1, 1, 1, 1, 1, '{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}', 9),
(53, 6, 'created_at', 'timestamp', 'Created At', 1, 1, 1, 0, 0, 0, NULL, 10),
(54, 6, 'updated_at', 'timestamp', 'Updated At', 1, 0, 0, 0, 0, 0, NULL, 11),
(55, 6, 'image', 'image', 'Page Image', 0, 1, 1, 1, 1, 1, NULL, 12),
(56, 8, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(57, 8, 'title', 'text', 'Title', 0, 1, 1, 1, 1, 1, '{}', 2),
(58, 8, 'description', 'text', 'Description', 0, 1, 1, 1, 1, 1, '{}', 3),
(74, 8, 'user_id', 'text', 'User Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(75, 8, 'store_id', 'text', 'Store Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(76, 8, 'customer_id', 'text', 'Customer Id', 0, 1, 1, 1, 1, 1, '{}', 4),
(77, 8, 'note', 'text', 'Note', 0, 1, 1, 1, 1, 1, '{}', 7),
(78, 8, 'due_at', 'text', 'Due At', 0, 1, 1, 1, 1, 1, '{}', 8),
(79, 8, 'paid_at', 'text', 'Paid At', 0, 1, 1, 1, 1, 1, '{}', 9),
(80, 8, 'sent_at', 'text', 'Sent At', 0, 1, 1, 1, 1, 1, '{}', 10),
(81, 8, 'is_recurring', 'text', 'Is Recurring', 1, 1, 1, 1, 1, 1, '{}', 11),
(82, 8, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 12),
(83, 8, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 13),
(84, 12, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(85, 12, 'company_id', 'text', 'Company Id', 0, 1, 1, 1, 1, 1, '{}', 2),
(86, 12, 'user_id', 'text', 'User Id', 0, 1, 1, 1, 1, 1, '{}', 3),
(87, 12, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 4),
(88, 12, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 5),
(89, 13, 'id', 'text', 'Id', 1, 0, 0, 0, 0, 0, '{}', 1),
(90, 13, 'company_id', 'text', 'Company Id', 1, 1, 1, 1, 1, 1, '{}', 2),
(91, 13, 'store_name', 'text', 'Store Name', 1, 1, 1, 1, 1, 1, '{}', 3),
(92, 13, 'next_invoice_number', 'text', 'Next Invoice Number', 1, 1, 1, 1, 1, 1, '{}', 4),
(93, 13, 'address_line_1', 'text', 'Address Line 1', 1, 1, 1, 1, 1, 1, '{}', 5),
(94, 13, 'address_line_2', 'text', 'Address Line 2', 0, 1, 1, 1, 1, 1, '{}', 6),
(95, 13, 'address_city', 'text', 'Address City', 1, 1, 1, 1, 1, 1, '{}', 7),
(96, 13, 'address_county', 'text', 'Address County', 0, 1, 1, 1, 1, 1, '{}', 8),
(97, 13, 'address_country', 'text', 'Address Country', 1, 1, 1, 1, 1, 1, '{}', 9),
(98, 13, 'address_postcode', 'text', 'Address Postcode', 1, 1, 1, 1, 1, 1, '{}', 10),
(99, 13, 'store_email', 'text', 'Store Email', 0, 1, 1, 1, 1, 1, '{}', 11),
(100, 13, 'store_phone', 'text', 'Store Phone', 0, 1, 1, 1, 1, 1, '{}', 12),
(101, 13, 'logo', 'text', 'Logo', 0, 1, 1, 1, 1, 1, '{}', 13),
(102, 13, 'created_at', 'timestamp', 'Created At', 0, 1, 1, 1, 0, 1, '{}', 14),
(103, 13, 'updated_at', 'timestamp', 'Updated At', 0, 0, 0, 0, 0, 0, '{}', 15),
(104, 13, 'deleted_at', 'timestamp', 'Deleted At', 0, 1, 1, 1, 1, 1, '{}', 16);

-- --------------------------------------------------------

--
-- Table structure for table `data_types`
--

CREATE TABLE `data_types` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_types`
--

INSERT INTO `data_types` (`id`, `name`, `slug`, `display_name_singular`, `display_name_plural`, `icon`, `model_name`, `policy_name`, `controller`, `description`, `generate_permissions`, `server_side`, `details`, `created_at`, `updated_at`) VALUES
(1, 'users', 'users', 'User', 'Users', 'voyager-person', 'Modules\\Admin\\Models\\User', 'Modules\\Admin\\Policies\\UserPolicy', 'Modules\\Admin\\Http\\Controllers\\VoyagerUserController', '', 1, 0, NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(2, 'menus', 'menus', 'Menu', 'Menus', 'voyager-list', 'Modules\\Admin\\Models\\Menu', NULL, '', '', 1, 0, NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(3, 'roles', 'roles', 'Role', 'Roles', 'voyager-lock', 'Modules\\Admin\\Models\\Role', NULL, 'Modules\\Admin\\Http\\Controllers\\VoyagerRoleController', '', 1, 0, NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(5, 'posts', 'posts', 'Post', 'Posts', 'voyager-news', 'Modules\\Admin\\Models\\Post', 'Modules\\Admin\\Policies\\PostPolicy', '', '', 1, 0, NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(6, 'pages', 'pages', 'Page', 'Pages', 'voyager-file-text', 'Modules\\Admin\\Models\\Page', NULL, '', '', 1, 0, NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(8, 'invoices', 'invoices', 'Invoice', 'Invoices', NULL, 'App\\Models\\Invoice', 'InvoicePolicy', '\\App\\Http\\Controllers\\InvoiceController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}', '2023-10-05 10:06:39', '2023-10-05 13:23:50'),
(12, 'products', 'products', 'Product', 'Products', NULL, 'App\\Models\\Product', NULL, 'App\\Http\\Controllers\\ProductController', NULL, 1, 0, '{\"order_column\":\"created_at\",\"order_display_column\":\"created_at\",\"order_direction\":\"desc\",\"default_search_key\":null}', '2023-10-24 17:46:33', '2023-10-24 17:46:33'),
(13, 'stores', 'stores', 'Store', 'Stores', NULL, 'App\\Models\\Store', NULL, 'App\\Http\\Controllers\\StoreController', NULL, 1, 0, '{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}', '2023-10-30 18:30:39', '2023-10-30 18:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `store_id` bigint UNSIGNED DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `due_at` date DEFAULT NULL,
  `paid_at` date DEFAULT NULL,
  `sent_at` date DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `store_id`, `customer_id`, `title`, `description`, `currency`, `note`, `due_at`, `paid_at`, `sent_at`, `is_recurring`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 1, 12, 'Greentech Sales Invoice', 'Greentech Sales Invoice Description', NULL, NULL, '2023-10-27', NULL, NULL, 0, '2023-10-26 07:50:42', '2023-10-26 07:50:42', NULL),
(2, NULL, 1, 13, 'Logicbarn', 'Create Invoice for LogicBarn', NULL, NULL, '2023-10-25', NULL, NULL, 0, '2023-10-30 18:40:22', '2023-10-30 18:40:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-10-26 08:52:43', '2023-10-26 08:52:43'),
(2, 1, 2, '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(15, 2, 3, '2023-10-30 19:29:38', '2023-10-30 19:29:38'),
(16, 2, 4, '2023-10-30 19:29:46', '2023-10-30 19:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item_metas`
--

CREATE TABLE `invoice_item_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_item_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'text',
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_item_metas`
--

INSERT INTO `invoice_item_metas` (`id`, `invoice_item_id`, `name`, `value`, `visibility`, `type`, `identifier`, `created_at`, `updated_at`) VALUES
(1, 1, 'unit_price', '190', 'readonly', 'number', 'PM11', '2023-10-26 08:52:43', '2023-10-26 08:52:43'),
(2, 1, 'quantity', '499', '', 'number', 'PM12', '2023-10-26 08:52:43', '2023-10-26 09:28:47'),
(3, 1, 'title', 'Carpet', 'readonly', 'text', 'PM13', '2023-10-26 08:52:43', '2023-10-26 08:52:43'),
(4, 1, 'description', 'Lorem Descriprion here ds', 'readonly', 'text', 'PM14', '2023-10-26 08:52:43', '2023-10-26 08:52:43'),
(5, 1, 'formular', 'PM11*PM12+PM18', 'readonly', 'formular', 'PM15', '2023-10-26 08:52:43', '2023-10-26 08:52:43'),
(6, 1, 'Height', '490', NULL, 'number', 'PM16', '2023-10-26 08:52:43', '2023-10-26 09:28:58'),
(7, 1, 'Width', '90', NULL, 'number', 'PM17', '2023-10-26 08:52:43', '2023-10-26 09:28:47'),
(8, 1, 'Fitting Cost', 'PM16*PM17', 'readonly', 'formular', 'PM18', '2023-10-26 08:52:43', '2023-10-26 08:52:43'),
(9, 2, 'unit_price', '450', 'readonly', 'number', 'PM29', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(10, 2, 'quantity', '4', '', 'number', 'PM210', '2023-10-26 09:44:54', '2023-10-26 09:45:15'),
(11, 2, 'title', 'Paint Emusifier', 'readonly', 'text', 'PM211', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(12, 2, 'description', 'Paint Emusifier Description', 'readonly', 'text', 'PM212', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(13, 2, 'formular', 'PM29*PM210+PM216', 'readonly', 'formular', 'PM213', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(14, 2, 'height', '1', 'default', 'number', 'PM214', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(15, 2, 'width', '1', 'default', 'number', 'PM215', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(16, 2, 'casting cost', 'PM214*PM215', 'readonly', 'formular', 'PM216', '2023-10-26 09:44:54', '2023-10-26 09:44:54'),
(69, 15, 'title', 'Vinyl', 'readonly', 'text', 'PM317', '2023-10-30 19:29:38', '2023-10-30 19:29:38'),
(70, 15, 'description', 'good', 'readonly', 'text', 'PM318', '2023-10-30 19:29:38', '2023-10-30 19:29:38'),
(71, 15, 'unit_price', '1', 'readonly', 'number', 'PM319', '2023-10-30 19:29:38', '2023-10-30 19:29:38'),
(72, 15, 'quantity', '1', '', 'number', 'PM320', '2023-10-30 19:29:38', '2023-10-30 19:29:38'),
(73, 15, 'formular', 'PM319*PM320', 'readonly', 'formular', 'PM321', '2023-10-30 19:29:38', '2023-10-30 19:29:38'),
(74, 16, 'title', 'Carpet', 'readonly', 'text', 'PM422', '2023-10-30 19:29:46', '2023-10-30 19:29:46'),
(75, 16, 'description', 'good', 'readonly', 'text', 'PM423', '2023-10-30 19:29:46', '2023-10-30 19:29:46'),
(76, 16, 'unit_price', '1', 'readonly', 'number', 'PM424', '2023-10-30 19:29:46', '2023-10-30 19:29:46'),
(77, 16, 'quantity', '1', '', 'number', 'PM425', '2023-10-30 19:29:46', '2023-10-30 19:29:46'),
(78, 16, 'formular', 'PM424*PM425', 'readonly', 'formular', 'PM426', '2023-10-30 19:29:46', '2023-10-30 19:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_pricings`
--

CREATE TABLE `invoice_pricings` (
  `id` bigint UNSIGNED NOT NULL,
  `invoice_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_pricings`
--

INSERT INTO `invoice_pricings` (`id`, `invoice_id`, `name`, `value`, `identifier`, `created_at`, `updated_at`) VALUES
(1, 1, 'subtotal', '140711', 'P11', '2023-10-26 07:50:42', '2023-10-26 12:22:35'),
(2, 1, 'tax', '0', 'P12', '2023-10-26 07:50:42', '2023-10-26 07:50:42'),
(3, 1, 'discount', '0', 'P13', '2023-10-26 07:50:42', '2023-10-26 07:50:42'),
(4, 1, 'formular', 'P11-P11*P12-P11*P13', 'P14', '2023-10-26 07:50:42', '2023-10-26 07:50:42'),
(5, 2, 'subtotal', '2', 'P25', '2023-10-30 18:40:22', '2023-10-30 19:29:51'),
(6, 2, 'tax', '1', 'P26', '2023-10-30 18:40:22', '2023-10-30 19:01:47'),
(7, 2, 'discount', '1', 'P27', '2023-10-30 18:40:22', '2023-10-30 19:01:54'),
(8, 2, 'formular', 'P25 * P26 - P27 + P29', 'P28', '2023-10-30 18:40:22', '2023-10-30 19:09:01'),
(9, 2, 'Total Fitting cost', '100', 'P29', '2023-10-30 18:53:45', '2023-10-30 19:08:37'),
(10, 2, 'formular', 'P25-P25*P26-P25*P27', 'P210', '2023-10-30 19:01:33', '2023-10-30 19:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_schedules`
--

CREATE TABLE `invoice_schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2023-09-24 23:14:58', '2023-09-24 23:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int UNSIGNED NOT NULL,
  `menu_id` int UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `title`, `url`, `target`, `icon_class`, `color`, `parent_id`, `order`, `created_at`, `updated_at`, `route`, `parameters`) VALUES
(1, 1, 'Dashboard', '', '_self', 'voyager-boat', NULL, NULL, 1, '2023-09-24 23:14:58', '2023-09-24 23:14:58', 'voyager.dashboard', NULL),
(2, 1, 'Media', '', '_self', 'voyager-images', NULL, NULL, 4, '2023-09-24 23:14:58', '2023-10-06 10:25:26', 'voyager.media.index', NULL),
(3, 1, 'Users', '', '_self', 'voyager-person', NULL, NULL, 3, '2023-09-24 23:14:58', '2023-09-24 23:14:58', 'voyager.users.index', NULL),
(4, 1, 'Roles', '', '_self', 'voyager-lock', NULL, NULL, 2, '2023-09-24 23:14:58', '2023-09-24 23:14:58', 'voyager.roles.index', NULL),
(5, 1, 'Tools', '', '_self', 'voyager-tools', NULL, NULL, 10, '2023-09-24 23:14:58', '2023-10-24 17:47:02', NULL, NULL),
(6, 1, 'Menu Builder', '', '_self', 'voyager-list', NULL, 5, 1, '2023-09-24 23:14:58', '2023-10-05 09:23:07', 'voyager.menus.index', NULL),
(7, 1, 'Database', '', '_self', 'voyager-data', NULL, 5, 2, '2023-09-24 23:14:58', '2023-10-05 09:23:07', 'voyager.database.index', NULL),
(8, 1, 'Compass', '', '_self', 'voyager-compass', NULL, 5, 3, '2023-09-24 23:14:58', '2023-10-05 09:23:07', 'voyager.compass.index', NULL),
(9, 1, 'BREAD', '', '_self', 'voyager-bread', NULL, 5, 4, '2023-09-24 23:14:58', '2023-10-05 09:23:07', 'voyager.bread.index', NULL),
(10, 1, 'Settings', '', '_self', 'voyager-settings', NULL, NULL, 11, '2023-09-24 23:14:58', '2023-10-24 17:47:02', 'voyager.settings.index', NULL),
(12, 1, 'Posts', '', '_self', 'voyager-news', NULL, NULL, 5, '2023-09-24 23:14:58', '2023-10-06 10:25:26', 'voyager.posts.index', NULL),
(18, 1, 'Invoices', '', '_self', 'voyager-file-text', NULL, NULL, 6, '2023-09-24 23:14:58', '2023-10-06 10:26:09', 'voyager.invoices.index', NULL),
(19, 1, 'Products', '', '_self', 'voyager-bag', '#000000', NULL, 7, '2023-10-24 17:46:33', '2023-10-24 17:47:39', 'voyager.products.index', 'null'),
(22, 1, 'Store', '', '_self', 'voyager-shop', '#000000', NULL, 8, '2023-10-30 19:17:02', '2023-10-30 19:17:09', 'voyager.stores.index', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(29, '2014_10_12_000000_create_users_table', 1),
(30, '2014_10_12_100000_create_password_resets_table', 1),
(31, '2016_01_01_000000_add_voyager_user_fields', 1),
(32, '2016_01_01_000000_create_data_types_table', 1),
(33, '2016_01_01_000000_create_pages_table', 1),
(34, '2016_01_01_000000_create_posts_table', 1),
(35, '2016_02_15_204651_create_categories_table', 1),
(36, '2016_05_19_173453_create_menu_table', 1),
(37, '2016_10_21_190000_create_roles_table', 1),
(38, '2016_10_21_190000_create_settings_table', 1),
(39, '2016_11_30_135954_create_permission_table', 1),
(40, '2016_11_30_141208_create_permission_role_table', 1),
(41, '2016_12_26_201236_data_types__add__server_side', 1),
(42, '2017_01_13_000000_add_route_to_menu_items_table', 1),
(43, '2017_01_14_005015_create_translations_table', 1),
(44, '2017_01_15_000000_make_table_name_nullable_in_permissions_table', 1),
(45, '2017_03_06_000000_add_controller_to_data_types_table', 1),
(46, '2017_04_11_000000_alter_post_nullable_fields_table', 1),
(47, '2017_04_21_000000_add_order_to_data_rows_table', 1),
(48, '2017_07_05_210000_add_policyname_to_data_types_table', 1),
(49, '2017_08_05_000000_add_group_to_settings_table', 1),
(50, '2017_11_26_013050_add_user_role_relationship', 1),
(51, '2017_11_26_015000_create_user_roles_table', 1),
(52, '2018_03_11_000000_add_user_settings', 1),
(53, '2018_03_14_000000_add_details_to_data_types_table', 1),
(54, '2018_03_16_000000_make_settings_value_nullable', 1),
(55, '2019_08_19_000000_create_failed_jobs_table', 1),
(56, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(57, '2023_09_29_123958_add_company_id_and_store_id_to_users_table', 2),
(58, '2023_09_29_124401_create_companies_table', 2),
(59, '2023_09_29_124412_create_stores_table', 2),
(60, '2023_09_29_162700_create_plans_table', 2),
(61, '2023_09_29_162727_create_subscriptions_table', 2),
(62, '2023_10_05_111523_create_invoices_table', 3),
(63, '2023_10_05_111645_create_customers_table', 3),
(66, '2023_10_05_121512_create_invoice_schedules_table', 3),
(67, '2023_10_06_104953_add_currency_to_invoices_table', 4),
(68, '2023_10_07_083106_create_invoice_pricings_table', 5),
(73, '2023_10_24_113435_create_products_table', 6),
(74, '2023_10_24_121449_create_product_metas_table', 6),
(75, '2023_10_05_114944_create_invoice_items_table', 7),
(76, '2023_10_05_115020_create_invoice_item_metas_table', 7),
(77, '2023_10_17_161209_add_deleted_at_to_invoices_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int UNSIGNED NOT NULL,
  `author_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `author_id`, `title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hello World', 'Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.', '<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', 'pages/September2023/wnh60VYjFOFbXPorjeMf.png', 'hello-world', 'Yar Meta Description', 'Keyword1, Keyword2', 'ACTIVE', '2023-09-24 23:14:58', '2023-09-29 07:08:45'),
(2, 1, 'test', 'working', NULL, 'pages/September2023/Obw5BRJ15GSxWRFWgTCV.jpg', 'testing', 'working', 'test', 'ACTIVE', '2023-09-28 23:45:18', '2023-09-29 07:08:15');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_admin', NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(2, 'browse_bread', NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(3, 'browse_database', NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(4, 'browse_media', NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(5, 'browse_compass', NULL, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(6, 'browse_menus', 'menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(7, 'read_menus', 'menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(8, 'edit_menus', 'menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(9, 'add_menus', 'menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(10, 'delete_menus', 'menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(11, 'browse_roles', 'roles', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(12, 'read_roles', 'roles', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(13, 'edit_roles', 'roles', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(14, 'add_roles', 'roles', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(15, 'delete_roles', 'roles', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(16, 'browse_users', 'users', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(17, 'read_users', 'users', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(18, 'edit_users', 'users', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(19, 'add_users', 'users', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(20, 'delete_users', 'users', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(21, 'browse_settings', 'settings', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(22, 'read_settings', 'settings', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(23, 'edit_settings', 'settings', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(24, 'add_settings', 'settings', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(25, 'delete_settings', 'settings', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(31, 'browse_posts', 'posts', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(32, 'read_posts', 'posts', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(33, 'edit_posts', 'posts', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(34, 'add_posts', 'posts', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(35, 'delete_posts', 'posts', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(36, 'browse_pages', 'pages', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(37, 'read_pages', 'pages', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(38, 'edit_pages', 'pages', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(39, 'add_pages', 'pages', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(40, 'delete_pages', 'pages', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(41, 'browse_invoices', 'invoices', '2023-10-05 10:06:39', '2023-10-05 10:06:39'),
(42, 'read_invoices', 'invoices', '2023-10-05 10:06:39', '2023-10-05 10:06:39'),
(43, 'edit_invoices', 'invoices', '2023-10-05 10:06:39', '2023-10-05 10:06:39'),
(44, 'add_invoices', 'invoices', '2023-10-05 10:06:39', '2023-10-05 10:06:39'),
(45, 'delete_invoices', 'invoices', '2023-10-05 10:06:39', '2023-10-05 10:06:39'),
(56, 'browse_products', 'products', '2023-10-24 17:46:33', '2023-10-24 17:46:33'),
(57, 'read_products', 'products', '2023-10-24 17:46:33', '2023-10-24 17:46:33'),
(58, 'edit_products', 'products', '2023-10-24 17:46:33', '2023-10-24 17:46:33'),
(59, 'add_products', 'products', '2023-10-24 17:46:33', '2023-10-24 17:46:33'),
(60, 'delete_products', 'products', '2023-10-24 17:46:33', '2023-10-24 17:46:33'),
(61, 'browse_stores', 'stores', '2023-10-30 18:30:39', '2023-10-30 18:30:39'),
(62, 'read_stores', 'stores', '2023-10-30 18:30:39', '2023-10-30 18:30:39'),
(63, 'edit_stores', 'stores', '2023-10-30 18:30:39', '2023-10-30 18:30:39'),
(64, 'add_stores', 'stores', '2023-10-30 18:30:39', '2023-10-30 18:30:39'),
(65, 'delete_stores', 'stores', '2023-10-30 18:30:39', '2023-10-30 18:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(41, 2),
(41, 3),
(41, 4),
(42, 1),
(42, 2),
(42, 3),
(42, 4),
(43, 1),
(43, 2),
(43, 3),
(43, 4),
(44, 1),
(44, 2),
(44, 3),
(44, 4),
(45, 1),
(45, 2),
(45, 3),
(45, 4),
(56, 1),
(56, 3),
(57, 1),
(57, 3),
(58, 1),
(58, 3),
(59, 1),
(59, 3),
(60, 1),
(60, 3),
(61, 1),
(61, 3),
(62, 1),
(62, 3),
(63, 1),
(63, 3),
(64, 1),
(64, 3),
(65, 1),
(65, 3);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double DEFAULT NULL,
  `currencyIsoCode` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `billingFrequency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numberOfBillingCycles` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trialPeriod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trialDuration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trialDurationUnit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `addOns` json DEFAULT NULL,
  `discounts` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `description`, `price`, `currencyIsoCode`, `billingFrequency`, `numberOfBillingCycles`, `trialPeriod`, `trialDuration`, `trialDurationUnit`, `addOns`, `discounts`, `created_at`, `updated_at`) VALUES
('68cm', 'Affinity Yearly Subscription', 'Yearly subscription for the Affinity Flooring invoice and quotation system', 1250, 'GBP', '12', NULL, '1', '7', 'day', '\"[{\\\"amount\\\":\\\"250.00\\\",\\\"createdAt\\\":{\\\"date\\\":\\\"2023-02-10 10:46:38.000000\\\",\\\"timezone_type\\\":3,\\\"timezone\\\":\\\"UTC\\\"},\\\"description\\\":\\\"Additional user for the affinity flooring system\\\",\\\"id\\\":\\\"qrfm\\\",\\\"kind\\\":\\\"add_on\\\",\\\"merchantId\\\":\\\"ypmkwpsp4t2yvk2q\\\",\\\"name\\\":\\\"Additional Yearly Affinity User\\\",\\\"neverExpires\\\":true,\\\"numberOfBillingCycles\\\":null,\\\"updatedAt\\\":{\\\"date\\\":\\\"2023-02-10 10:46:52.000000\\\",\\\"timezone_type\\\":3,\\\"timezone\\\":\\\"UTC\\\"}}]\"', '\"[]\"', '2023-02-10 09:46:03', '2023-02-10 09:58:58'),
('twt6', 'Affinity Monthly Subscription', 'Subscription for the Affinity Flooring invoice and quotation system', 125, 'GBP', '1', NULL, '1', '7', 'day', '\"[{\\\"amount\\\":\\\"25.00\\\",\\\"createdAt\\\":{\\\"date\\\":\\\"2023-02-09 14:14:27.000000\\\",\\\"timezone_type\\\":3,\\\"timezone\\\":\\\"UTC\\\"},\\\"description\\\":\\\"Additional user for the affinity flooring system\\\",\\\"id\\\":\\\"hs8g\\\",\\\"kind\\\":\\\"add_on\\\",\\\"merchantId\\\":\\\"ypmkwpsp4t2yvk2q\\\",\\\"name\\\":\\\"Additional Monthly Affinity User\\\",\\\"neverExpires\\\":true,\\\"numberOfBillingCycles\\\":null,\\\"updatedAt\\\":{\\\"date\\\":\\\"2023-02-10 10:46:21.000000\\\",\\\"timezone_type\\\":3,\\\"timezone\\\":\\\"UTC\\\"}}]\"', '\"[]\"', '2023-02-09 13:14:48', '2023-02-10 09:58:47');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int UNSIGNED NOT NULL,
  `author_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `seo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` enum('PUBLISHED','DRAFT','PENDING') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `category_id`, `title`, `seo_title`, `excerpt`, `body`, `image`, `slug`, `meta_description`, `meta_keywords`, `status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 'Lorem Ipsum Post', NULL, 'This is the excerpt for the Lorem Ipsum Post', '<p>This is the body of the lorem ipsum post</p>', 'posts/post1.jpg', 'lorem-ipsum-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(2, 0, NULL, 'My Sample Post', NULL, 'This is the excerpt for the sample Post', '<p>This is the body for the sample post, which includes the body.</p>\n                <h2>We can use all kinds of format!</h2>\n                <p>And include a bunch of other stuff.</p>', 'posts/post2.jpg', 'my-sample-post', 'Meta Description for sample post', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(3, 0, NULL, 'Latest Post', NULL, 'This is the excerpt for the latest post', '<p>This is the body for the latest post</p>', 'posts/post3.jpg', 'latest-post', 'This is the meta description', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(4, 0, NULL, 'Yarr Post', NULL, 'Reef sails nipperkin bring a spring upon her cable coffer jury mast spike marooned Pieces of Eight poop deck pillage. Clipper driver coxswain galleon hempen halter come about pressgang gangplank boatswain swing the lead. Nipperkin yard skysail swab lanyard Blimey bilge water ho quarter Buccaneer.', '<p>Swab deadlights Buccaneer fire ship square-rigged dance the hempen jig weigh anchor cackle fruit grog furl. Crack Jennys tea cup chase guns pressgang hearties spirits hogshead Gold Road six pounders fathom measured fer yer chains. Main sheet provost come about trysail barkadeer crimp scuttle mizzenmast brig plunder.</p>\n<p>Mizzen league keelhaul galleon tender cog chase Barbary Coast doubloon crack Jennys tea cup. Blow the man down lugsail fire ship pinnace cackle fruit line warp Admiral of the Black strike colors doubloon. Tackle Jack Ketch come about crimp rum draft scuppers run a shot across the bow haul wind maroon.</p>\n<p>Interloper heave down list driver pressgang holystone scuppers tackle scallywag bilged on her anchor. Jack Tar interloper draught grapple mizzenmast hulk knave cable transom hogshead. Gaff pillage to go on account grog aft chase guns piracy yardarm knave clap of thunder.</p>', 'posts/post4.jpg', 'yarr-post', 'this be a meta descript', 'keyword1, keyword2, keyword3', 'PUBLISHED', 0, '2023-09-24 23:14:58', '2023-09-24 23:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `in_stock` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `user_id`, `title`, `description`, `in_stock`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'Vinyl', 'good', 1, '2023-10-30 18:39:07', '2023-10-30 18:39:07'),
(4, 1, 1, 'Carpet', 'good', 1, '2023-10-30 18:42:44', '2023-10-30 18:42:44'),
(5, 1, 1, 'Book', 'good', 1, '2023-10-30 18:42:53', '2023-10-30 18:42:53'),
(6, 1, 1, 'Computer', 'good', 1, '2023-10-30 18:43:05', '2023-10-30 18:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_metas`
--

CREATE TABLE `product_metas` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibility` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'text',
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_metas`
--

INSERT INTO `product_metas` (`id`, `product_id`, `name`, `value`, `visibility`, `type`, `identifier`, `created_at`, `updated_at`) VALUES
(1, 1, 'unit_price', '190', 'readonly', 'number', 'PM11', '2023-10-26 07:18:26', '2023-10-26 07:18:26'),
(2, 1, 'quantity', '1', '', 'number', 'PM12', '2023-10-26 07:18:26', '2023-10-26 07:18:26'),
(3, 1, 'title', 'Carpet', 'readonly', 'text', 'PM13', '2023-10-26 07:18:26', '2023-10-26 07:18:26'),
(4, 1, 'description', 'Lorem Descriprion here ds', 'readonly', 'text', 'PM14', '2023-10-26 07:18:26', '2023-10-26 07:27:26'),
(5, 1, 'formular', 'PM11*PM12+PM18', 'readonly', 'formular', 'PM15', '2023-10-26 07:18:26', '2023-10-26 07:32:03'),
(6, 1, 'Height', '1', NULL, 'number', 'PM16', '2023-10-26 07:20:01', '2023-10-26 07:20:01'),
(7, 1, 'Width', '1', NULL, 'number', 'PM17', '2023-10-26 07:20:14', '2023-10-26 07:20:14'),
(8, 1, 'Fitting Cost', 'PM16*PM17', 'readonly', 'formular', 'PM18', '2023-10-26 07:20:37', '2023-10-26 07:20:37'),
(9, 2, 'unit_price', '450', 'readonly', 'number', 'PM29', '2023-10-26 07:21:01', '2023-10-26 07:21:01'),
(10, 2, 'quantity', '1', '', 'number', 'PM210', '2023-10-26 07:21:01', '2023-10-26 07:21:01'),
(11, 2, 'title', 'Paint Emusifier', 'readonly', 'text', 'PM211', '2023-10-26 07:21:01', '2023-10-26 07:21:01'),
(12, 2, 'description', 'Paint Emusifier Description', 'readonly', 'text', 'PM212', '2023-10-26 07:21:01', '2023-10-26 07:21:01'),
(13, 2, 'formular', 'PM29*PM210+PM216', 'readonly', 'formular', 'PM213', '2023-10-26 07:21:01', '2023-10-26 09:44:26'),
(14, 2, 'height', '1', 'default', 'number', 'PM214', '2023-10-26 09:37:22', '2023-10-26 09:37:22'),
(15, 2, 'width', '1', 'default', 'number', 'PM215', '2023-10-26 09:37:37', '2023-10-26 09:37:37'),
(16, 2, 'casting cost', 'PM214*PM215', 'readonly', 'formular', 'PM216', '2023-10-26 09:38:16', '2023-10-26 09:38:16'),
(17, 3, 'title', 'Vinyl', 'readonly', 'text', 'PM317', '2023-10-30 18:39:07', '2023-10-30 18:39:07'),
(18, 3, 'description', 'good', 'readonly', 'text', 'PM318', '2023-10-30 18:39:07', '2023-10-30 18:39:07'),
(19, 3, 'unit_price', '1', 'readonly', 'number', 'PM319', '2023-10-30 18:39:07', '2023-10-30 18:39:07'),
(20, 3, 'quantity', '1', '', 'number', 'PM320', '2023-10-30 18:39:07', '2023-10-30 18:39:07'),
(21, 3, 'formular', 'PM319*PM320', 'readonly', 'formular', 'PM321', '2023-10-30 18:39:07', '2023-10-30 18:39:07'),
(22, 4, 'title', 'Carpet', 'readonly', 'text', 'PM422', '2023-10-30 18:42:44', '2023-10-30 18:42:44'),
(23, 4, 'description', 'good', 'readonly', 'text', 'PM423', '2023-10-30 18:42:44', '2023-10-30 18:42:44'),
(24, 4, 'unit_price', '1', 'readonly', 'number', 'PM424', '2023-10-30 18:42:44', '2023-10-30 18:42:44'),
(25, 4, 'quantity', '1', '', 'number', 'PM425', '2023-10-30 18:42:44', '2023-10-30 18:42:44'),
(26, 4, 'formular', 'PM424*PM425', 'readonly', 'formular', 'PM426', '2023-10-30 18:42:44', '2023-10-30 18:42:44'),
(27, 5, 'title', 'Book', 'readonly', 'text', 'PM527', '2023-10-30 18:42:53', '2023-10-30 18:42:53'),
(28, 5, 'description', 'good', 'readonly', 'text', 'PM528', '2023-10-30 18:42:53', '2023-10-30 18:42:53'),
(29, 5, 'unit_price', '1', 'readonly', 'number', 'PM529', '2023-10-30 18:42:53', '2023-10-30 18:42:53'),
(30, 5, 'quantity', '1', '', 'number', 'PM530', '2023-10-30 18:42:53', '2023-10-30 18:42:53'),
(31, 5, 'formular', 'PM529*PM530', 'readonly', 'formular', 'PM531', '2023-10-30 18:42:53', '2023-10-30 18:42:53'),
(32, 6, 'title', 'Computer', 'readonly', 'text', 'PM632', '2023-10-30 18:43:05', '2023-10-30 18:43:05'),
(33, 6, 'description', 'good', 'readonly', 'text', 'PM633', '2023-10-30 18:43:05', '2023-10-30 18:43:05'),
(34, 6, 'unit_price', '1', 'readonly', 'number', 'PM634', '2023-10-30 18:43:05', '2023-10-30 18:43:05'),
(35, 6, 'quantity', '1', '', 'number', 'PM635', '2023-10-30 18:43:05', '2023-10-30 18:43:05'),
(36, 6, 'formular', 'PM634*PM635', 'readonly', 'formular', 'PM636', '2023-10-30 18:43:05', '2023-10-30 18:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrator', '2023-09-24 23:14:58', '2023-10-30 19:22:42'),
(2, 'Company', 'Company Admin', '2023-09-24 23:14:58', '2023-09-24 23:17:45'),
(3, 'Store Manager', 'Store Manager', '2023-09-24 23:14:58', '2023-10-30 19:25:04'),
(4, 'Sales Person', 'Sales Person', '2023-09-24 23:14:58', '2023-10-30 19:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `display_name`, `value`, `details`, `type`, `order`, `group`) VALUES
(1, 'site.title', 'Site Title', 'Affinity', '', 'text', 1, 'Site'),
(2, 'site.description', 'Site Description', 'Accelerate your Carpet Stores Invoice Processing with Affinity', '', 'text', 2, 'Site'),
(3, 'site.logo', 'Site Logo', 'settings/September2023/fGL2MsV9zafWUmXUKgQR.png', '', 'image', 3, 'Site'),
(4, 'site.google_analytics_tracking_id', 'Google Analytics Tracking ID', NULL, '', 'text', 4, 'Site'),
(5, 'admin.bg_image', 'Admin Background Image', 'settings/September2023/hBiOkcZ19sxJBjYBN6x0.png', '', 'image', 5, 'Admin'),
(6, 'admin.title', 'Admin Title', 'Affinity', '', 'text', 1, 'Admin'),
(7, 'admin.description', 'Admin Description', 'Accelerate your Carpet Stores Invoice Processing with Affinity', '', 'text', 2, 'Admin'),
(8, 'admin.loader', 'Admin Loader', 'settings/September2023/GZwOI7yUTcAuj1dP58AP.png', '', 'image', 3, 'Admin'),
(9, 'admin.icon_image', 'Admin Icon Image', 'settings/September2023/8SWS9Wxt68J6roAB6cLZ.png', '', 'image', 4, 'Admin'),
(10, 'admin.google_analytics_client_id', 'Google Analytics Client ID (used for admin dashboard)', NULL, '', 'text', 1, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint UNSIGNED NOT NULL,
  `company_id` bigint UNSIGNED NOT NULL,
  `store_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `next_invoice_number` bigint NOT NULL DEFAULT '1',
  `address_line_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_county` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_postcode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `store_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `plan_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `billingDayOfMonth` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `firstBillingDate` timestamp NOT NULL,
  `nextBillingDate` timestamp NOT NULL,
  `billingPeriodStartDate` timestamp NULL DEFAULT NULL,
  `billingPeriodEndDate` timestamp NULL DEFAULT NULL,
  `paidThroughDate` timestamp NULL DEFAULT NULL,
  `currentBillingCycle` smallint UNSIGNED NOT NULL,
  `numberOfBillingCycles` smallint UNSIGNED DEFAULT NULL,
  `neverExpires` tinyint(1) NOT NULL DEFAULT '0',
  `daysPastDue` tinyint UNSIGNED DEFAULT NULL,
  `failureCount` tinyint UNSIGNED DEFAULT NULL,
  `addOns` json DEFAULT NULL,
  `discounts` json DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusHistory` json NOT NULL,
  `transactions` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `plan_id`, `balance`, `billingDayOfMonth`, `firstBillingDate`, `nextBillingDate`, `billingPeriodStartDate`, `billingPeriodEndDate`, `paidThroughDate`, `currentBillingCycle`, `numberOfBillingCycles`, `neverExpires`, `daysPastDue`, `failureCount`, `addOns`, `discounts`, `status`, `statusHistory`, `transactions`, `created_at`, `updated_at`) VALUES
('crbf4z', 2, 'twt6', 0, 12, '2023-10-11 23:00:00', '2023-10-11 23:00:00', NULL, NULL, NULL, 0, NULL, 1, NULL, 0, '[{\"id\": \"hs8g\", \"name\": \"Additional Monthly Affinity User\", \"amount\": \"25.00\", \"quantity\": 1, \"neverExpires\": true, \"currentBillingCycle\": 0, \"numberOfBillingCycles\": null}]', '[]', 'Active', '[{}]', '[]', '2023-10-05 09:16:39', '2023-10-05 09:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE `translations` (
  `id` int UNSIGNED NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int UNSIGNED NOT NULL,
  `locale` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `table_name`, `column_name`, `foreign_key`, `locale`, `value`, `created_at`, `updated_at`) VALUES
(1, 'data_types', 'display_name_singular', 5, 'pt', 'Post', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(2, 'data_types', 'display_name_singular', 6, 'pt', 'Página', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(3, 'data_types', 'display_name_singular', 1, 'pt', 'Utilizador', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(4, 'data_types', 'display_name_singular', 4, 'pt', 'Categoria', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(5, 'data_types', 'display_name_singular', 2, 'pt', 'Menu', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(6, 'data_types', 'display_name_singular', 3, 'pt', 'Função', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(7, 'data_types', 'display_name_plural', 5, 'pt', 'Posts', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(8, 'data_types', 'display_name_plural', 6, 'pt', 'Páginas', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(9, 'data_types', 'display_name_plural', 1, 'pt', 'Utilizadores', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(10, 'data_types', 'display_name_plural', 4, 'pt', 'Categorias', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(11, 'data_types', 'display_name_plural', 2, 'pt', 'Menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(12, 'data_types', 'display_name_plural', 3, 'pt', 'Funções', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(13, 'categories', 'slug', 1, 'pt', 'categoria-1', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(14, 'categories', 'name', 1, 'pt', 'Categoria 1', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(15, 'categories', 'slug', 2, 'pt', 'categoria-2', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(16, 'categories', 'name', 2, 'pt', 'Categoria 2', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(17, 'pages', 'title', 1, 'pt', 'Olá Mundo', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(18, 'pages', 'slug', 1, 'pt', 'ola-mundo', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(19, 'pages', 'body', 1, 'pt', '<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(20, 'menu_items', 'title', 1, 'pt', 'Painel de Controle', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(21, 'menu_items', 'title', 2, 'pt', 'Media', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(22, 'menu_items', 'title', 12, 'pt', 'Publicações', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(23, 'menu_items', 'title', 3, 'pt', 'Utilizadores', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(24, 'menu_items', 'title', 11, 'pt', 'Categorias', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(25, 'menu_items', 'title', 13, 'pt', 'Páginas', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(26, 'menu_items', 'title', 4, 'pt', 'Funções', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(27, 'menu_items', 'title', 5, 'pt', 'Ferramentas', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(28, 'menu_items', 'title', 6, 'pt', 'Menus', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(29, 'menu_items', 'title', 7, 'pt', 'Base de dados', '2023-09-24 23:14:58', '2023-09-24 23:14:58'),
(30, 'menu_items', 'title', 10, 'pt', 'Configurações', '2023-09-24 23:14:58', '2023-09-24 23:14:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `company_id` bigint UNSIGNED DEFAULT NULL,
  `store_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'users/default.png',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `company_id`, `store_id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `settings`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Admin', 'admin@admin.com', 'users/September2023/i444jtQRWLHqBjOiugxB.png', NULL, '$2y$10$I.KSqF2b84ZkFHYWedlCeetioSMka9TD1DatBaYwrjSCDS6PACxaW', 'guCfPQcsqDpikW0cCTaogv8uUOaEPCj3mBXlpt5RhAYQK3vN3FQ7qXxEFBiQ', '{\"locale\":\"en\"}', '2023-09-24 23:14:58', '2023-09-29 07:07:21'),
(2, 2, 1, NULL, 'Aaron A', 'airondev@gmail.com', 'users/October2023/E8JXynDcAFUj05aLoxI1.png', NULL, '$2y$10$HE8OFO7W40hfCf7MXuA9TesJOu9F61kQGvf8zXC9ywI7lAUq1OvFK', NULL, NULL, '2023-10-05 09:13:57', '2023-10-30 19:27:15'),
(3, 4, NULL, NULL, 'sales person', 'test@gmail.com', 'users/October2023/7rigScHxajpMpZnvCzS2.png', NULL, '$2y$10$PE49m/u/oU.PcDMMVntGXeFffdOkBOLClD9qtN/BRHPn6YCFmqu0K', NULL, NULL, '2023-10-26 12:20:52', '2023-10-26 12:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_rows_data_type_id_foreign` (`data_type_id`);

--
-- Indexes for table `data_types`
--
ALTER TABLE `data_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_types_name_unique` (`name`),
  ADD UNIQUE KEY `data_types_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_item_metas`
--
ALTER TABLE `invoice_item_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_item_metas_identifier_unique` (`identifier`);

--
-- Indexes for table `invoice_pricings`
--
ALTER TABLE `invoice_pricings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_pricings_identifier_unique` (`identifier`);

--
-- Indexes for table `invoice_schedules`
--
ALTER TABLE `invoice_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_metas`
--
ALTER TABLE `product_metas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_metas_identifier_unique` (`identifier`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `user_roles_user_id_index` (`user_id`),
  ADD KEY `user_roles_role_id_index` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `data_rows`
--
ALTER TABLE `data_rows`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `data_types`
--
ALTER TABLE `data_types`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `invoice_item_metas`
--
ALTER TABLE `invoice_item_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `invoice_pricings`
--
ALTER TABLE `invoice_pricings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice_schedules`
--
ALTER TABLE `invoice_schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_metas`
--
ALTER TABLE `product_metas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `translations`
--
ALTER TABLE `translations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `data_rows`
--
ALTER TABLE `data_rows`
  ADD CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
