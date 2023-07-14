-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2023 at 11:15 PM
-- Server version: 5.7.23-23
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moneyty2_moneyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventenqueries`
--

CREATE TABLE `eventenqueries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateevent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guestCount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eBudget` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `knowAbout` longtext COLLATE utf8mb4_unicode_ci,
  `otherInfo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eventenqueries`
--

INSERT INTO `eventenqueries` (`id`, `event`, `fullName`, `email`, `phone`, `company`, `website`, `dateevent`, `location`, `venue`, `guestCount`, `eBudget`, `knowAbout`, `otherInfo`, `created_at`, `updated_at`) VALUES
(1, 'dj', 'Baljeet Singh', 'aronasoft@gmail.com', 7888342216, 'Aronasoft', 'https://www.subd.app/', '33', '33', '34', '43', '44', 'party', '44', '2023-05-28 12:44:18', '2023-05-28 12:44:18'),
(2, 'party', 'Baljeet Singh', 'developer0945@gmail.com', 2344445566, 'Aronasoft', 'https://www.subd.app/', '34', '445', '444', '33', '223', 'party', '44', '2023-05-28 12:57:33', '2023-05-28 12:57:33'),
(3, 'dj', 'Andy Aronasoft', 'andy@aronasoft.com', 9565565565, 'Aronasoft', 'www.aronasoft.com', '6565555', 'PKL', 'PKL', '150', '10', 'beer', 'TEst', '2023-07-12 15:57:55', '2023-07-12 15:57:55'),
(4, 'dj', 'Andy Aronasoft', 'gurmukhsingh997@gmail.com', 9565565565, '', '', '3233', 'PKL', 'PKL', '150', NULL, 'party', '', '2023-07-12 16:16:55', '2023-07-12 16:16:55'),
(5, 'party', 'Sudhir', 'aronasoft@gmail.com', 9898808998, '', '', '348343', 'indian', 'hekko', '123', NULL, 'party', '', '2023-07-13 10:29:18', '2023-07-13 10:29:18'),
(6, 'dj', 'Baljeet Singh', 'developer0945@gmail.com', 7888342216, '', '', '2023-07-12', '444', '5t', 'sw3', '', 'party', '', '2023-07-13 20:02:20', '2023-07-13 20:02:20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `eventService` bigint(20) UNSIGNED DEFAULT NULL,
  `event_category_id` longtext COLLATE utf8mb4_unicode_ci,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decription` longtext COLLATE utf8mb4_unicode_ci,
  `eventTicketsPrice` decimal(8,2) DEFAULT NULL,
  `eventLocation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expireAt` bigint(20) DEFAULT NULL,
  `eventTickets` bigint(20) DEFAULT NULL,
  `eventPurchased` bigint(20) DEFAULT '0',
  `featureImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventService`, `event_category_id`, `title`, `slug`, `decription`, `eventTicketsPrice`, `eventLocation`, `latitude`, `longitude`, `eventDate`, `eventTime`, `expireAt`, `eventTickets`, `eventPurchased`, `featureImage`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1,3', 'Carnival Night', 'carnival-night', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 500.50, '9591 Elizabeth Avenue, Elizabeth, New Jersey, USA', '40.6560014', '-74.19987309999999', '02/09/2023', '17:00', 1693674000, 200, 1, 'https://superadmin.moneytrainevents.com/uploads/event_images/carnival-night-bigLargeImg.jpg', 'publish', '2023-04-06 07:32:44', '2023-07-13 17:13:45'),
(2, 3, '1,2,3', 'Summer Trap mix', 'summer-trap-mix', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 25.00, '1002 U.S. 9, Woodbridge, Woodbridge Township, NJ 07095, USA', '40.5466195', '-74.2904621', '12/12/2023', '17:00', 1702400400, 100, 0, 'https://superadmin.moneytrainevents.com/uploads/event_images/summer-trap-mix-event2.jpg', 'publish', '2023-04-06 07:34:27', '2023-07-13 17:13:24'),
(3, 2, '3,2', 'Anniversary Party', 'anniversary-party', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 8.00, 'USA Twisterz, Bloomfield Avenue, West Caldwell, New Jersey, USA', '40.8535539', '-74.3014484', '15/08/2023', '17:00', 1692118800, 29, 1, 'https://superadmin.moneytrainevents.com/uploads/event_images/anniversary-party-a91dc911-a63b-48c9-ae67-b36789a6002a.__CR0,0,970,600_PT0_SX970_V1___.jpg', 'publish', '2023-05-12 12:13:19', '2023-07-13 19:44:49'),
(4, 3, NULL, 'Time You’ll Remember', 'time-youll-remember', '<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 10.00, 'Mexico City, Newark Avenue, Jersey City, NJ, USA', '40.72243780000001', '-74.0474867', '12/09/2023', '18:00', 1694541600, 15, 2, 'https://superadmin.moneytrainevents.com/uploads/event_images/time-youll-remember-time-youll-remember-download.jpg', 'publish', '2023-05-12 12:18:38', '2023-07-13 19:44:49'),
(5, 3, NULL, 'Test', 'test', '<p>ede test</p>', 45.00, 'Estiatorio Milos - Midtown New York, West 55th Street, New York, NY, USA', '40.76354609999999', '-73.9790278', '25/08/2023', '17:00', 1692982800, 40, 0, 'https://superadmin.moneytrainevents.com/uploads/event_images/test-36b91.jpg', 'unpublish', '2023-06-01 09:39:18', '2023-07-13 05:18:27'),
(6, 2, '2', '80-90s Vibes', '80-90s-vibes', '<p>Urna condimentum sem quam sed mauris viverra vel proin vel. Amet sodales magna nunc aliquam ornare adipiscing.</p>', 1.00, '1002 U.S. 9, Woodbridge, Woodbridge Township, NJ 07095, USA', '40.5466195', '-74.2904621', '30/10/2023', '21:00', 1698699600, 10, 7, 'https://superadmin.moneytrainevents.com/uploads/event_images/80-90s-vibes-80-90s-vibes-REMINISCE-copy-3.jpg', 'publish', '2023-06-01 09:44:30', '2023-07-14 01:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `eventservices`
--

CREATE TABLE `eventservices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `eventId` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decription` longtext COLLATE utf8mb4_unicode_ci,
  `featureImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `eventservices`
--

INSERT INTO `eventservices` (`id`, `eventId`, `title`, `slug`, `decription`, `featureImage`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Cocktail Party', 'cocktail-party', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/cocktail-party-cocktail-party.jpg', 'publish', '2023-04-06 05:24:42', '2023-05-05 13:13:35'),
(2, NULL, 'Golden Parties', 'golden-parties', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/golden-parties-Golden-parties.jpg', 'publish', '2023-04-06 05:27:25', '2023-05-05 13:13:20'),
(3, NULL, 'Birthdays', 'birthdays', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/birthdays-birthday.jpg', 'publish', '2023-04-06 05:31:41', '2023-04-27 09:19:30'),
(4, NULL, 'Special Occasions', 'special-occasions', '<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/special-occasions-special-occasions.jpg', 'publish', '2023-04-06 05:45:46', '2023-06-27 08:15:22'),
(5, NULL, 'Theme parties', 'theme-parties', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/theme-parties-Theme-parties.jpg', 'publish', '2023-06-27 08:12:42', '2023-06-27 08:12:42'),
(6, NULL, 'Reunions', 'reunions', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/reunions-reunions.jpg', 'publish', '2023-06-27 08:14:13', '2023-06-27 08:14:13'),
(7, NULL, 'Graduation', 'graduation', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/graduation-Graduation.jpg', 'publish', '2023-06-27 08:14:30', '2023-06-27 08:14:30'),
(8, NULL, 'Holiday party', 'holiday-party', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/event_services_images/holiday-party-holidayparty.jpg', 'publish', '2023-06-27 08:14:45', '2023-06-27 08:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `event_categories`
--

CREATE TABLE `event_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CategoryName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CategoryStatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'unactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_categories`
--

INSERT INTO `event_categories` (`id`, `CategoryName`, `CategoryStatus`, `created_at`, `updated_at`) VALUES
(1, 'Music Events', 'active', '2023-07-13 10:06:15', '2023-07-13 10:06:15'),
(2, 'Conference Events', 'active', '2023-07-13 10:06:15', '2023-07-13 10:06:15'),
(3, 'DJ Party', 'active', '2023-07-13 10:06:15', '2023-07-13 10:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `event_galleries`
--

CREATE TABLE `event_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `event_gallery_images` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_galleries`
--

INSERT INTO `event_galleries` (`id`, `event_id`, `event_gallery_images`, `created_at`, `updated_at`) VALUES
(1, 2, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/182876550-gallery1.jpg', '2023-05-15 00:57:47', '2023-05-15 00:57:47'),
(2, 2, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/1455007024-gallery2.jpg', '2023-05-15 00:57:47', '2023-05-15 00:57:47'),
(3, 2, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/1296077195-gallery3.jpg', '2023-05-15 00:57:47', '2023-05-15 00:57:47'),
(4, 2, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/1986007587-gallery4.jpg', '2023-05-15 00:57:47', '2023-05-15 00:57:47'),
(5, 5, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/929484106-download (1).jfif', '2023-06-01 09:39:18', '2023-06-01 09:39:18'),
(6, 5, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/1792948472-download (2).jfif', '2023-06-01 09:39:18', '2023-06-01 09:39:18'),
(7, 6, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/1916838201-about-banner.jpg', '2023-06-28 11:50:24', '2023-06-28 11:50:24'),
(8, 6, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/731267540-abt1.jpg', '2023-06-28 11:50:24', '2023-06-28 11:50:24'),
(9, 6, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/148232581-abt2.jpg', '2023-06-28 11:50:24', '2023-06-28 11:50:24'),
(10, 6, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/587478168-bigLargeImg.jpg', '2023-06-28 11:50:24', '2023-06-28 11:50:24'),
(11, 6, 'https://superadmin.moneytrainevents.com/uploads/event_gallery/810543443-birthday.jpg', '2023-06-28 11:50:24', '2023-06-28 11:50:24');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `headervideos`
--

CREATE TABLE `headervideos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featureImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `headervideos`
--

INSERT INTO `headervideos` (`id`, `video_url`, `featureImage`, `status`, `created_at`, `updated_at`) VALUES
(3, 'https://www.youtube.com/watch?v=LAcPABqr1HM', 'https://superadmin.moneytrainevents.com/uploads/310762_headerVideo_featureImage-abt1.jpg', 'active', '2023-07-03 03:46:25', '2023-07-13 22:33:57');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_06_070559_create_eventservices_table', 1),
(6, '2023_04_06_071726_create_events_table', 1),
(7, '2023_04_06_090857_add_serviceslug_to_eventservices_table', 2),
(8, '2023_04_06_091033_add_eventsslug_to_events_table', 2),
(10, '2023_04_06_131127_add_event_ticket_price_to_events_table', 3),
(11, '2023_04_17_095119_create_settings_table', 4),
(12, '2023_04_18_074439_create_portfolios_table', 5),
(17, '2023_04_25_095755_create_teams_table', 6),
(18, '2023_04_26_102114_create_testimonials_table', 7),
(21, '2023_04_28_063608_create_packages_table', 8),
(22, '2023_04_28_071300_create_package_features_table', 8),
(23, '2016_06_01_000001_create_oauth_auth_codes_table', 9),
(24, '2016_06_01_000002_create_oauth_access_tokens_table', 9),
(25, '2016_06_01_000003_create_oauth_refresh_tokens_table', 9),
(26, '2016_06_01_000004_create_oauth_clients_table', 9),
(27, '2016_06_01_000005_create_oauth_personal_access_clients_table', 9),
(28, '2023_05_05_125608_add_verifycode_to_users_table', 10),
(30, '2023_05_09_104855_create_eventenqueries_table', 10),
(31, '2023_05_11_104104_add_phone_to_users_table', 11),
(32, '2023_05_15_053144_create_event_galleries_table', 12),
(34, '2017_06_16_140942_create_nikolag_customer_user_table', 13),
(45, '2023_05_23_092755_create_user_wishlist_events_table', 14),
(46, '2023_05_24_053957_add_forgot_password_code_to_users_table', 15),
(47, '2023_05_25_064603_create_orders_table', 16),
(48, '2023_05_25_065821_create_order_items_table', 16),
(49, '2023_05_26_050441_add_event_purchased_to_events_table', 17),
(50, '2023_05_26_051550_create_subscriptions_table', 18),
(51, '2023_05_26_054051_add_ticket_id_to_order_items_table', 19),
(55, '2023_06_29_064021_add_albums_to_portfolios_table', 20),
(56, '2023_07_03_064306_create_headervideos_table', 21),
(57, '2023_07_05_074309_add_headervideo_feature_image_to_headervideos_table', 22),
(58, '2023_07_11_074110_add_logandlati_to_events_table', 23),
(59, '2023_07_13_095630_create_event_categories_table', 24),
(60, '2023_07_13_100951_add_event_category_to_events_table', 25),
(62, '2023_07_13_140838_add_new_user_feilds_to_events_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('00f3b052e50da86e456cb58efd4cccaeaaebd649512f7f23513cf3bd7bb6710f1f22554bec00afe9', 53, 1, 'authToken', '[]', 0, '2023-06-28 10:58:11', '2023-06-28 10:58:11', '2024-06-28 10:58:11'),
('188af733ce2b2129982748055f9dfe94d860d9a92b71be110937fbf34751cbbd6099b0694d2401e8', 55, 1, 'authToken', '[]', 0, '2023-06-13 21:02:47', '2023-06-13 21:02:47', '2024-06-13 21:02:47'),
('2f0280c57768d50ea40b7bfc4028918ad76933c6d239b0654abf92fb8fe8b755afdb835bce031a4a', 53, 1, 'authToken', '[]', 1, '2023-06-28 08:26:15', '2023-06-30 05:32:38', '2024-06-28 08:26:15'),
('6fc9fa56aaf4a5364d6f2f19d0d2d636de5644cf81515a33e9956d6bbbb170d3f69347eac47bf993', 53, 1, 'authToken', '[]', 1, '2023-06-28 10:40:49', '2023-06-28 10:56:31', '2024-06-28 10:40:49'),
('79d321ccbef4f61a9f294db143d40e14710f6f7eb7f0f0f4003b24b80b6d453691b63a88b13a4681', 53, 1, 'authToken', '[]', 1, '2023-06-28 10:33:49', '2023-06-28 10:40:35', '2024-06-28 10:33:49'),
('8a94b9500e6be0dc80067a4edd798f9d4214d6eec120d48cbcb10be6c6d263cdd96c0a3d8120afc7', 60, 1, 'authToken', '[]', 1, '2023-07-14 01:21:13', '2023-07-14 01:37:48', '2024-07-13 19:21:13'),
('8eab8a419c99e66bee9eca8f36809e665a6cf3cf388e272389fbbd426297bd8462bd8a8543bde1c0', 57, 1, 'authToken', '[]', 0, '2023-07-13 02:47:02', '2023-07-13 02:47:02', '2024-07-12 20:47:02'),
('ad4e6ca99c359c1151b821f6a7593450e133332fa13ab971ce4874c1fae204471523a73b427075df', 55, 1, 'authToken', '[]', 0, '2023-06-13 21:03:18', '2023-06-13 21:03:18', '2024-06-13 21:03:18'),
('bfe248a8f67e26e5f466df4110ca1981abef331d22ec4a857a2f775a367e6caf2ba8a5a21d733437', 53, 1, 'authToken', '[]', 1, '2023-06-28 07:39:31', '2023-06-28 07:40:37', '2024-06-28 07:39:31'),
('c2634f83a6e1b94d680cf8c7f52221ca40129058da7738e8a640892f59a2d59e695c557d185242fe', 54, 1, 'authToken', '[]', 0, '2023-06-03 05:16:14', '2023-06-03 05:16:14', '2024-06-03 05:16:14'),
('f1d996d260a6eec6854320d4f36cf38991e148bf613fdb49034a7ee6ef55849207f7db706a569372', 58, 1, 'authToken', '[]', 1, '2023-07-13 17:17:39', '2023-07-13 21:40:04', '2024-07-13 11:17:39'),
('f46a56ad81c5d1b3b408bf627a56f764d9353b68eb6bfea80d962f04ea48c6b6f5acc24e0daea38f', 53, 1, 'authToken', '[]', 1, '2023-06-01 11:11:56', '2023-07-13 13:54:34', '2024-06-01 11:11:56'),
('f70a8c175e7098bb62ce9f570335f850610775fe6e974f16ec3b8c36eddc53d279ba0720284db24b', 59, 1, 'authToken', '[]', 0, '2023-07-13 21:42:12', '2023-07-13 21:42:12', '2024-07-13 15:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'h7q1QKQrjguBipSSAUbKcO2O8TzQjN7Xt15UAOLk', NULL, 'http://localhost', 1, 0, 0, '2023-05-10 06:47:46', '2023-05-10 06:47:46'),
(2, NULL, 'Laravel Password Grant Client', 'N1njr7VKlgLvi9tRqnItUn32JQHU3EQN6gW9F7a8', 'users', 'http://localhost', 0, 1, 0, '2023-05-10 06:47:46', '2023-05-10 06:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-05-10 06:47:46', '2023-05-10 06:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_id` longtext COLLATE utf8mb4_unicode_ci,
  `location_id` longtext COLLATE utf8mb4_unicode_ci,
  `order_id` longtext COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(8,2) DEFAULT NULL,
  `currency` longtext COLLATE utf8mb4_unicode_ci,
  `status` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `payment_id`, `location_id`, `order_id`, `total_amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(1, 53, 'lEpQUAUVQqsbIPhAhzgWIupquILZY', 'L0NKFZ5Y13GHS', '0LKGjsSi1w7Yv0TArThEDWWEmcbZY', 110.00, 'USD', 'COMPLETED', '2023-06-01 11:11:53', '2023-06-01 11:11:53'),
(2, 54, 'FuUD8NoL3HJKY4oziMKIdQ20ozNZY', 'L0NKFZ5Y13GHS', 'ADlL1iguTYfhLbgTUOX1JzHdWUIZY', 289.00, 'USD', 'COMPLETED', '2023-06-03 05:16:12', '2023-06-03 05:16:12'),
(3, 56, '9uSrDsuziaBHLehmvfLP3YxSIqCZY', 'L0NKFZ5Y13GHS', 'yWqc0M6vg0FOISIsMRfc9Ao7w5XZY', 500.50, 'USD', 'COMPLETED', '2023-07-12 22:04:44', '2023-07-12 22:04:44'),
(4, 58, 'XfGOQURsoC7K0eHZMFQmNe5FoBDZY', 'C9D4QDJN8KRHM', 'VsoA5tlbujGQOvEaLhA82ZX4Tg4F', 2.00, 'USD', 'COMPLETED', '2023-07-13 17:17:39', '2023-07-13 17:17:39'),
(5, 58, 'dYVqBAyHtSe9rNU0iy9L3ywSCnFZY', 'C9D4QDJN8KRHM', 'zbuDjudmYFENqzzUPIOOnyadUf4F', 19.00, 'USD', 'COMPLETED', '2023-07-13 19:44:49', '2023-07-13 19:44:49'),
(6, 60, '7N0OgGuj38jmwfOFSYejO4xUR29YY', '1AVXDZYF81BTT', 'qsqeqx0wIbzgMam4Xz3ruiTjCVQZY', 1.00, 'USD', 'COMPLETED', '2023-07-14 01:21:12', '2023-07-14 01:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` longtext COLLATE utf8mb4_unicode_ci,
  `event_id` bigint(20) UNSIGNED DEFAULT NULL,
  `purchase_tickets` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_id` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `event_id`, `purchase_tickets`, `ticket_id`, `created_at`, `updated_at`) VALUES
(1, '1', 6, '2', 'TK-6-789597', '2023-06-01 11:11:53', '2023-06-01 11:11:53'),
(2, '2', 6, '1', 'TK-6-922949', '2023-06-03 05:16:12', '2023-06-03 05:16:12'),
(3, '2', 4, '1', 'TK-4-723392', '2023-06-03 05:16:12', '2023-06-03 05:16:12'),
(4, '3', 1, '1', 'TK-1-297096', '2023-07-12 22:04:44', '2023-07-12 22:04:44'),
(5, '4', 6, '2', 'TK-6-142986', '2023-07-13 17:17:39', '2023-07-13 17:17:39'),
(6, '5', 6, '1', 'TK-6-774181', '2023-07-13 19:44:49', '2023-07-13 19:44:49'),
(7, '5', 4, '1', 'TK-4-589071', '2023-07-13 19:44:49', '2023-07-13 19:44:49'),
(8, '5', 3, '1', 'TK-3-472774', '2023-07-13 19:44:49', '2023-07-13 19:44:49'),
(9, '6', 6, '1', 'TK-6-629049', '2023-07-14 01:21:12', '2023-07-14 01:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) DEFAULT NULL,
  `features` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `slug`, `price`, `features`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Silver', 'silver', 39.00, 'a:2:{i:0;s:1:\"4\";i:1;s:1:\"3\";}', NULL, '2023-04-28 03:37:54', '2023-04-28 03:37:54'),
(2, 'Gold', 'gold', 69.00, 'a:3:{i:0;s:1:\"4\";i:1;s:1:\"3\";i:2;s:1:\"2\";}', NULL, '2023-04-28 03:38:17', '2023-04-28 03:38:17'),
(3, 'Platinum', 'platinum', 89.00, 'a:4:{i:0;s:1:\"4\";i:1;s:1:\"3\";i:2;s:1:\"2\";i:3;s:1:\"1\";}', NULL, '2023-04-28 03:38:35', '2023-04-28 10:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `package_features`
--

CREATE TABLE `package_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `feature_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_features`
--

INSERT INTO `package_features` (`id`, `feature_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Aliquet sagittis magna', NULL, '2023-04-28 02:14:35', '2023-04-28 02:14:35'),
(2, 'Aliquet sagittis Update', NULL, '2023-04-28 02:16:08', '2023-04-28 02:34:04'),
(3, 'New Aliquet sagittis magna', NULL, '2023-04-28 02:16:15', '2023-04-28 02:16:15'),
(4, 'Latest Aliquet sagittis magna', NULL, '2023-04-28 02:16:25', '2023-04-28 02:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `albumSlug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolios_type` longtext COLLATE utf8mb4_unicode_ci,
  `portfolios_images` longtext COLLATE utf8mb4_unicode_ci,
  `video_type` longtext COLLATE utf8mb4_unicode_ci,
  `upload_video` longtext COLLATE utf8mb4_unicode_ci,
  `featureImage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfoliosDate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `title`, `albumSlug`, `portfolios_type`, `portfolios_images`, `video_type`, `upload_video`, `featureImage`, `portfoliosDate`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Birthday Party', 'birthday-party', 'videos', NULL, NULL, 'https://www.youtube.com/watch?v=FWqYejZWzdA', 'https://superadmin.moneytrainevents.com/uploads/catalog-default-img.gif', NULL, 'publish', '2023-07-10 16:29:10', '2023-07-10 16:29:10'),
(2, 'Marriage Event', 'marriage-event', 'videos', NULL, NULL, 'https://www.youtube.com/watch?v=CbED1ZHOIqg', 'https://superadmin.moneytrainevents.com/uploads/catalog-default-img.gif', NULL, 'publish', '2023-07-10 16:31:51', '2023-07-10 16:31:51'),
(3, 'Cocktail Party', 'cocktail-party', 'images', 'a:3:{i:0;s:139:\"https://superadmin.moneytrainevents.com/uploads/portfolios/cocktail-party_album-image-1591559272birthday-party_album-image-21441076abt2.jpg\";i:1;s:140:\"https://superadmin.moneytrainevents.com/uploads/portfolios/cocktail-party_album-image-1487303890birthday-party_album-image-699297576abt1.jpg\";i:2;s:138:\"https://superadmin.moneytrainevents.com/uploads/portfolios/cocktail-party_album-image-1675703754chandigarh-event_featureImage-gallery4.jpg\";}', NULL, NULL, 'https://superadmin.moneytrainevents.com/uploads/portfolios/cocktail-party_featureImage-1512227808-vd3.jpg', NULL, 'publish', '2023-07-10 16:50:15', '2023-07-10 16:50:15'),
(4, 'Birthdays', 'birthdays', 'images', 'a:2:{i:0;s:141:\"https://superadmin.moneytrainevents.com/uploads/portfolios/birthdays_album-image-533928684chandigarh-event_album-image-1804514955gallery1.jpg\";i:1;s:132:\"https://superadmin.moneytrainevents.com/uploads/portfolios/birthdays_album-image-238995237chandigarh-event_featureImage-gallery4.jpg\";}', NULL, NULL, 'https://superadmin.moneytrainevents.com/uploads/portfolios/birthdays_featureImage-1874114066-vd2.jpg', NULL, 'publish', '2023-07-10 16:51:55', '2023-07-10 16:51:55');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siteName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SiteSupportNumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteEmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SiteCopyRight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteLogo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteFavicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FacebookLink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TwitterLink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LinkedinLink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `InstagramLink` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `siteName`, `SiteSupportNumber`, `siteEmail`, `SiteCopyRight`, `siteLogo`, `siteFavicon`, `FacebookLink`, `TwitterLink`, `LinkedinLink`, `InstagramLink`, `created_at`, `updated_at`) VALUES
(1, 'Money Train Events LLC', '2013444589', 'info@moneytrainevents.com', '2023', 'https://superadmin.moneytrainevents.com/uploads/logo.png', NULL, 'https://www.facebook.com/moneytrainevents/', 'https://twitter.com/moneytrainent', 'https://www.linkedin.com/company/moneytrainent/', 'https://www.instagram.com/moneytrainevents/', '2023-04-17 04:35:47', '2023-07-13 11:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `order_id` longtext COLLATE utf8mb4_unicode_ci,
  `package_id` bigint(20) DEFAULT NULL,
  `payment_id` longtext COLLATE utf8mb4_unicode_ci,
  `total_amount` decimal(8,2) DEFAULT NULL,
  `currency` longtext COLLATE utf8mb4_unicode_ci,
  `status` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `user_id`, `order_id`, `package_id`, `payment_id`, `total_amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(1, 58, 'FUW7HkhxLUD9PHMjoBYA2OJnVf4F', 2, 'ly8gp2Cn55K4pZAXoE5KHFuKdRFZY', 69.00, 'USD', 'COMPLETED', '2023-07-13 20:51:25', '2023-07-13 20:51:25'),
(2, 59, '9KpsW2Sklf4wtFNyzbE3J9CRoZ4F', 3, 'N64DQfe5w2OPltbRH6k1r6IGhRRZY', 89.00, 'USD', 'COMPLETED', '2023-07-13 21:42:12', '2023-07-13 21:42:12');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_code` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` longtext COLLATE utf8mb4_unicode_ci,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `designation` longtext COLLATE utf8mb4_unicode_ci,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` longtext COLLATE utf8mb4_unicode_ci,
  `twitter_url` longtext COLLATE utf8mb4_unicode_ci,
  `linkedin_url` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `slug`, `emp_code`, `email`, `mobile`, `address`, `designation`, `gender`, `image`, `status`, `facebook_url`, `twitter_url`, `linkedin_url`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Shakim Thompson', 'shakim-thompson', NULL, 'shakim@moneytrainevents.com', '2013444589', NULL, 'Event Coordinator', 'Male', 'https://superadmin.moneytrainevents.com/uploads/team_images/326503969-SJ1_5214.jpg', 'active', 'https://www.facebook.com/moneytrainent/', NULL, 'https://www.linkedin.com/in/shakim-thompson', NULL, '2023-04-25 06:06:44', '2023-07-09 21:09:56'),
(2, 'Smith Sudhir', 'smith-sudhir', NULL, 'sudhir_organizer@abc.com', '86787687', NULL, 'Part Organizer', 'Male', NULL, 'unactive', NULL, NULL, NULL, '2023-04-25 07:17:11', '2023-04-25 06:08:40', '2023-04-25 07:17:11'),
(3, 'Renesha Perry', 'renesha-perry', NULL, 'nancy_william@abc.com', '23343434', NULL, 'Event Stylist', 'Female', 'https://superadmin.moneytrainevents.com/uploads/team_images/15697144-GMGS-1038.jpg', 'active', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.linkedin.com/', NULL, '2023-04-25 06:10:21', '2023-07-09 21:14:09'),
(4, 'test', 'test', NULL, 'test@gmail.com', '8857756464', 'ffhfhfh fdhfdhd h', 'ghfjfj', 'Male', 'https://superadmin.moneytrainevents.com/uploads/team_images/859698508-images.jpg', 'active', NULL, NULL, NULL, '2023-06-15 10:51:53', '2023-06-15 06:05:54', '2023-06-15 10:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonials` longtext COLLATE utf8mb4_unicode_ci,
  `client_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `star_rating` bigint(20) DEFAULT NULL,
  `feature_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `testimonials`, `client_image`, `star_rating`, `feature_image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Garry Gill', '<p>Congue porta sollicitudin et mattis vitae interdum. Risus dolor molestie tellus interdum consequat massa accumsan ipsum in. Nec laoreet nam gravida vulputate pellentesque sed integer augue suspendisse. Maecenas donec nec est tinc idunt sed antest.</p>', 'https://superadmin.moneytrainevents.com/uploads/testimonials/75894616-admin-default-image.png', 4, 'https://moneyadmin.stageservices.xyz/uploads/testimonials/569778539-testimonial1.jpg', '1', NULL, '2023-04-26 07:31:33', '2023-07-12 15:43:17'),
(2, 'Sudhir K', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/testimonials/1002840818-admin-default-image.png', 3, 'https://moneyadmin.stageservices.xyz/uploads/testimonials/1305384725-test.png', '1', NULL, '2023-05-10 17:52:39', '2023-07-12 15:42:58'),
(3, 'manjeet', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/testimonials/180388970-user-default-image.jpg', 3, 'https://moneyadmin.stageservices.xyz/uploads/testimonials/1853229363-time-youll-remember-download.jpg', '1', NULL, '2023-05-12 12:20:19', '2023-07-12 15:42:37'),
(4, 'baljeet', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/testimonials/1709327644-admin-default-image.png', 4, 'https://moneyadmin.stageservices.xyz/uploads/testimonials/759669795-pexels-teddy-yang-2263436.jpg', '1', NULL, '2023-05-12 12:21:19', '2023-07-12 15:42:15'),
(5, 'sweety', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'https://superadmin.moneytrainevents.com/uploads/testimonials/334659994-download (2).jpg', 3, 'https://moneyadmin.stageservices.xyz/uploads/testimonials/37975775-a91dc911-a63b-48c9-ae67-b36789a6002a.__CR0,0,970,600_PT0_SX970_V1___.jpg', '1', NULL, '2023-05-12 12:22:33', '2023-05-12 12:22:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female','other','') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acceptTerms` int(11) DEFAULT NULL,
  `sendMeNoti` int(11) DEFAULT NULL,
  `verifycode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unactive',
  `forgot_password_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profilePic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'https://moneyadmin.stageservices.xyz/uploads/users_profile_pics/default.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `name`, `email`, `phone`, `gender`, `acceptTerms`, `sendMeNoti`, `verifycode`, `email_verified_at`, `status`, `forgot_password_code`, `password`, `profilePic`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'Super Admin', 'admin@abc.com', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, '$2y$10$TJ2ZNRtdG6IELh0y2EvUq.xea0dnANxXGmDb3qonfcjaYvBFWEsv2', '1_avatar-dummy.webp', NULL, '2023-04-06 02:10:01', '2023-06-21 09:59:27'),
(53, 'user', NULL, 'Baljeet Singh', 'developer0945@gmail.com', '7567567', NULL, NULL, NULL, NULL, NULL, 'active', NULL, '$2y$10$MbJJSij/J.paSPSeRUo0x.JqiCdNDxqutaONlfDuxUl6bP8C5cUCe', 'https://superadmin.moneytrainevents.com/uploads/users_profile_pics/53_team1.jpg', NULL, '2023-06-01 11:11:53', '2023-06-28 11:37:23'),
(54, 'user', NULL, 'baljeet singhhh', 'developer10945@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, '$2y$10$0DsfXHQV.4R3QlisTaWXpOvgIf6NVOwD02.3vXzgZkTjB.wJ5UYUe', 'https://superadmin.moneytrainevents.com/uploads/user/default.png', NULL, '2023-06-03 05:16:12', '2023-06-03 05:16:12'),
(55, 'user', NULL, 'hoyeaahh', 'himamo1336@anwarb.com', NULL, NULL, NULL, NULL, '', '2023-06-13 21:03:10', 'active', NULL, '$2y$10$iIzNklXm2wyHke0xPFUQuu0xyxP8NPjXXyffj8Sw2Or/OfAfwCr9S', 'https://superadmin.moneytrainevents.com/uploads/users_profile_pics/default.png', NULL, '2023-06-13 21:02:47', '2023-06-13 21:03:10'),
(56, 'user', NULL, 'Baljeet Singh', 'developer04945@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'active', NULL, '$2y$10$Nqd6wkA2hdNn8MUzG05e2.PJuEjQ.MHMkgwTWSm3tOz9Y.2MtejKu', 'https://moneyadmin.stageservices.xyz/uploads/users_profile_pics/default.png', NULL, '2023-07-12 22:04:44', '2023-07-12 22:04:44'),
(57, 'user', NULL, 'Rachel David', 'dramaqueenraeabby@yahoo.com', NULL, NULL, NULL, NULL, '234731', NULL, 'unactive', NULL, '$2y$10$TQ1FduKry65p.AoBqeQkYe8Bpcdxuy5VNTErdv1VfnGDpR0Ui5XHq', 'https://moneyadmin.stageservices.xyz/uploads/users_profile_pics/default.png', NULL, '2023-07-13 02:47:02', '2023-07-13 02:47:02'),
(58, 'user', NULL, 'Test Product', 'baljeet@aronasoft.com', NULL, 'male', 1, 0, NULL, NULL, 'active', NULL, '$2y$10$CDYDBurHPNKCOSeBN3Z8uOupGzRxbyAEs73..YSJOW2s1kl4j7hPy', 'https://moneyadmin.stageservices.xyz/uploads/users_profile_pics/default.png', NULL, '2023-07-13 17:17:39', '2023-07-13 17:17:39'),
(59, 'user', NULL, 'Baljeet Singh', 'aronasoft1@gmail.com', NULL, 'female', 0, 0, NULL, NULL, 'active', NULL, '$2y$10$9.MX0h3mSZuFygCqDxtrf.zzGuDrlZSaQdy1D2cfQRXYOToZywvu2', 'https://moneyadmin.stageservices.xyz/uploads/users_profile_pics/default.png', NULL, '2023-07-13 21:42:12', '2023-07-13 21:42:12'),
(60, 'user', NULL, 'Sudhir', 'sudhirkundal43@gmail.com', NULL, 'male', 1, 1, NULL, NULL, 'active', NULL, '$2y$10$GyI8ecffmj5akP2H6kBJW.8eWZvaRoKPM8OuFpz4zJUvQHaK0Lrru', 'https://moneyadmin.stageservices.xyz/uploads/users_profile_pics/default.png', NULL, '2023-07-14 01:21:12', '2023-07-14 01:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_wishlist_events`
--

CREATE TABLE `user_wishlist_events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventenqueries`
--
ALTER TABLE `eventenqueries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventservices`
--
ALTER TABLE `eventservices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_galleries`
--
ALTER TABLE `event_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_galleries_event_id_foreign` (`event_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `headervideos`
--
ALTER TABLE `headervideos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_features`
--
ALTER TABLE `package_features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_features_feature_name_unique` (`feature_name`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolios_title_unique` (`title`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wishlist_events`
--
ALTER TABLE `user_wishlist_events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventenqueries`
--
ALTER TABLE `eventenqueries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `eventservices`
--
ALTER TABLE `eventservices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event_galleries`
--
ALTER TABLE `event_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headervideos`
--
ALTER TABLE `headervideos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package_features`
--
ALTER TABLE `package_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_wishlist_events`
--
ALTER TABLE `user_wishlist_events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
