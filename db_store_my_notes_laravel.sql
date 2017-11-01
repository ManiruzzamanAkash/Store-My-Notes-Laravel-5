-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2017 at 07:58 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_store_my_notes_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `admin_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maniruzzaman', 'manirujjamanakash@gmail.com', 'maniruzzamanakash', '$2y$10$ekiJqraji4q8aRngrzYWJevJAIFgN1Y1g6IWMGYuGsdayhf7t7Zmy', 'Super Admin', 'A74Fl6Dxuqzh8FUSjg1xuSyZ9kXsK4lEBQLiRkJs8BNSm3itTMtkcPcyX6E5', '2017-09-01 07:44:54', '2017-09-01 07:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note_id` int(11) DEFAULT NULL COMMENT 'Note ID if that is a Report for note',
  `is_seen` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'O means Unseen | 1 means seen',
  `seen_by` tinyint(4) DEFAULT NULL COMMENT 'Admin ID -> When admin Saw then it will be filled',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `email`, `subject`, `description`, `note_id`, `is_seen`, `seen_by`, `created_at`, `updated_at`) VALUES
(1, 'manirujjamanakash@gmail.com', 'Request for reporting a note', 'Hello Author, \r\nWhat is life and what is programming.. is a fake note and it is totally copied from my site.', 15, 1, 1, '2017-09-08 23:04:25', '2017-09-08 23:05:25'),
(2, 'manirujjamanakash@gmail.com', 'Request for reporting a note', 'Hello Author, \r\nWhat is life and what is programming.. is a fake note and it is totally copied from my site.', 15, 1, 1, '2017-09-08 23:04:58', '2017-09-09 05:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'C Programming', 'C programming is one of the most popular easy programming language.', 'c-programming', '2017-08-31 18:00:00', '2017-09-05 10:17:53'),
(2, 'Codeigniter PHP Framework', 'Codeigniter PHP Framework is the oldest PHP object oriented secured framework..', 'codeigniter-php-framework', '2017-09-05 08:17:52', '2017-09-05 08:17:52'),
(3, 'Java Programming', 'Java programming is a big, scaffolding and secured Java language...', 'java-programming', '2017-09-05 09:14:16', '2017-09-05 09:14:16'),
(4, 'Laravel PHP Web Artisan', 'Laravel is todays most secured PHP framework to do any job easily and more effectively.', 'laravel-php-web-artisan', '2017-09-05 10:21:10', '2017-09-05 10:21:10'),
(6, 'C++ Programming', 'C++ Programming is the best programming language for an absolute and serious programmer and this programming language is used now in all of the International Online Judges.', 'c-programming', '2017-09-05 10:32:12', '2017-09-05 10:32:12'),
(7, 'Blogging Career', 'Blogging is a best career for free minded peoples, who will write blog and earn money from that blog by his own effort.', 'blogging-career', '2017-09-05 10:33:45', '2017-09-07 04:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `note_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_comment_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `note_id`, `name`, `email`, `website`, `comment`, `reply_comment_id`, `created_at`, `updated_at`) VALUES
(1, 13, 'Maniruzzaman Akash', 'manirujjamanakash@gmail.com', 'https://maniruzzaman-akash.blogspot.com', 'Awesome Tutorial and thanks Admin..', NULL, '2017-09-06 07:44:03', '2017-09-06 07:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `main_city`, `phone_code`) VALUES
(1, 'India', 'Delhi', '990'),
(2, 'Bangladesh', 'Dhaka', '+880'),
(3, 'Nepal', 'Katmundu', '001'),
(4, 'Malaysia', 'Kualalampur', '006');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(10) UNSIGNED NOT NULL,
  `note_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `note_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 13, 2, '2017-09-06 07:37:29', '2017-09-06 07:37:29'),
(3, 12, 1, '2017-09-07 04:58:35', '2017-09-07 04:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `note_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `note_id`, `user_id`, `created_at`, `updated_at`) VALUES
(23, 13, 1, '2017-09-06 06:04:41', '2017-09-06 06:04:41'),
(27, 13, 2, '2017-09-06 07:33:10', '2017-09-06 07:33:10'),
(30, 12, 1, '2017-09-07 03:34:36', '2017-09-07 03:34:36'),
(31, 15, 1, '2017-09-08 21:29:43', '2017-09-08 21:29:43'),
(33, 16, 1, '2017-09-09 08:46:11', '2017-09-09 08:46:11'),
(34, 14, 1, '2017-09-19 09:26:05', '2017-09-19 09:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2017_09_01_134014_create_admins_table', 2),
(5, '2017_09_02_075545_create_notes_table', 3),
(8, '2017_09_02_084810_create_note_tag_table', 3),
(9, '2017_09_03_105131_create_statistics_table', 4),
(12, '2017_09_04_010932_create_comments_table', 5),
(14, '2017_09_05_140830_create_categories_table', 6),
(15, '2017_09_05_164324_create_tags_table', 7),
(21, '2017_09_06_041432_create_likes_table', 8),
(22, '2017_09_06_122422_create_dislikes_table', 9),
(26, '2017_09_06_161049_create_countries_table', 11),
(28, '2017_09_07_022811_create_users_table', 12),
(30, '2017_09_07_152155_create_settings_table', 13),
(33, '2017_09_08_082030_create_admin_notifications_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0=private note | 1=public note',
  `meta_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `description`, `slug`, `image`, `status`, `meta_keywords`, `meta_description`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(12, 'Download Tutorials point offline documentation latest version 2017', '<p>Download Tutorials point offline documentation latest version 2017</p>\r\n<p> </p>\r\n<p>Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017.</p>\r\n<p> </p>\r\n<p>Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017</p>\r\n<p> </p>\r\n<p>Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017.</p>\r\n<p> </p>\r\n<p>Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017Download Tutorials point offline documentation latest version 2017.</p>\r\n<p> </p>', 'download-tutorials-point-offline-documentation-latest-version-2017', '1504666927.jpg', 1, 'Download, Tutorials point offline documentation, latest version 2017', 'Download Tutorials point offline documentation latest version 2017', 1, 7, '2017-09-05 21:02:08', '2017-09-05 21:02:08'),
(13, 'Simple blog template by bootstrap Testing it..', '<p>Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..</p>\r\n<p>Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..</p>\r\n<p> </p>\r\n<p>Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..</p>\r\n<p> </p>\r\n<p>Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..Simple blog template by bootstrap Testing it..</p>', 'simple-blog-template-by-bootstrap-testing-it', '1504927636.png', 1, NULL, NULL, 1, 7, '2017-09-08 21:27:17', '2017-09-08 21:27:17'),
(14, 'This is our third post in store my notes', '<p>This is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notes</p>\r\n<p>This is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notes</p>\r\n<p>This is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notes</p>\r\n<p> </p>\r\n<p>This is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notesThis is our third post in store my notes</p>', 'this-is-our-third-post-in-store-my-notes', '1504927717.png', 1, NULL, NULL, 1, 6, '2017-09-08 21:28:37', '2017-09-08 21:28:37'),
(15, 'What is life and what is programming..', '<p>What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..</p>\r\n<p> </p>\r\n<p>What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..</p>\r\n<p> </p>\r\n<p>What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..What is life and what is programming..</p>', 'what-is-life-and-what-is-programming', '1504927769.jpg', 1, NULL, NULL, 1, 1, '2017-09-08 21:29:29', '2017-09-08 21:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `note_tag`
--

CREATE TABLE `note_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `note_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `note_tag`
--

INSERT INTO `note_tag` (`id`, `note_id`, `tag_id`) VALUES
(14, 12, 3),
(15, 13, 3),
(16, 13, 2),
(18, 15, 3),
(19, 15, 2),
(21, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `site_meta_description` text COLLATE utf8mb4_unicode_ci,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` tinyint(3) UNSIGNED NOT NULL,
  `site_description_visible` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `home_min_note` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_description`, `site_meta_keywords`, `site_meta_description`, `site_logo`, `admin_id`, `site_description_visible`, `home_min_note`, `created_at`, `updated_at`) VALUES
(1, 'Store My Notes 3', 'Store My Notes is a site to store your notes', 'sdsdsdsd', 'sdsdsdsdgfg', 'logo.png', 1, 1, 5, '2017-09-03 21:30:17', '2017-09-07 09:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `id` int(10) UNSIGNED NOT NULL,
  `note_id` int(10) UNSIGNED NOT NULL,
  `total_visits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_likes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `total_dislikes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `note_id`, `total_visits`, `total_likes`, `total_dislikes`, `created_at`, `updated_at`) VALUES
(9, 12, 96, 0, 0, '2017-09-05 21:02:08', '2017-09-13 20:33:17'),
(10, 13, 124, 0, 0, '2017-09-05 23:49:24', '2017-09-19 09:20:47'),
(11, 13, 0, 0, 0, '2017-09-08 21:27:17', '2017-09-08 21:27:17'),
(12, 14, 15, 0, 0, '2017-09-08 21:28:37', '2017-09-24 09:11:23'),
(13, 15, 51, 0, 0, '2017-09-08 21:29:29', '2017-09-19 09:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'C++', 'C++ is an advance serious level programming language.', 'c', '2017-09-05 11:03:36', '2017-09-05 11:03:36'),
(3, 'Java', 'Java is the most leading and most secured web and desktop language.', 'java', '2017-09-05 11:03:55', '2017-09-05 11:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio_description` text COLLATE utf8mb4_unicode_ci,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1 Means User is active | 0 means user is banned',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `birthdate`, `bio_title`, `website`, `image`, `bio_description`, `country`, `organization`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maniruzzaman Akash', 'manirujjamanakash@gmail.com', 'maniruzzamanakash', '$2y$10$COMntCdc6MBq9rUyAc.i/e579zFnFfW4765DPikgyw8UFrPDXIYU6', '1995-12-30', 'Web Developer in Major PHP frameworks like Codeinigniter, Laravel.', 'https://maniruzzaman-akash.blogspot.com', 'maniruzzamanakash.jpg', 'Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.\r\nWeb Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.\r\n\r\n\r\nWeb Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.Web Developer in Major PHP frameworks like Codeinigniter, Laravel.', '2', 'Patuakhali Science & Technology University', '1', '3NEGOrHkqhahfkQVKAbEbY5IdzU0R7FhnZb5M31nQSuD2PlXDMkqZlh3Lrsm', '2017-09-06 21:56:03', '2017-09-08 10:48:00'),
(2, 'Abul Kalam', 'abulkalam.skg@gmail.com', 'abulkalambd', '$2y$10$jyI7DtYwS83kBAJVMYqTO.iv/VE1zyetTFcxFss3uO81rFbbQ4Y8e', '1963-09-02', 'Headmaster of a kinder garten and political worker', 'https://urisolve.blogspot.com', 'abulkalambd.jpg', 'Headmaster of Shodesh Kinder Garten and union secrateriot of National party of Bangladesh.', '2', 'Deyanganj Bajar, Ishwarganj, Mymensingh', '1', NULL, '2017-09-07 10:42:11', '2017-09-07 19:36:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note_tag`
--
ALTER TABLE `note_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `note_tag`
--
ALTER TABLE `note_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
