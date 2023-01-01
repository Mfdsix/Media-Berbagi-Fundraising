-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Mar 2022 pada 04.37
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediaberbagi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `direct_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `author` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `category` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `APP_NAME` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_MAILER` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_HOST` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_PORT` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_USERNAME` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_PASSWORD` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_ENCRYPTION` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_FROM_ADDRESS` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MAIL_FROM_NAME` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MB_HOST` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MB_ACCESS_KEY` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RUANGWA_TOKEN` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `configs`
--

INSERT INTO `configs` (`id`, `APP_NAME`, `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`, `MAIL_FROM_ADDRESS`, `MAIL_FROM_NAME`, `MB_HOST`, `MB_ACCESS_KEY`, `RUANGWA_TOKEN`, `created_at`, `updated_at`) VALUES
(1, 'MediaBerbagi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MediaBerbagi', NULL, NULL, NULL, '2022-03-21 04:33:30', '2022-03-21 04:33:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `docs`
--

CREATE TABLE `docs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `donaturs`
--

CREATE TABLE `donaturs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fundings`
--

CREATE TABLE `fundings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `nominal` double NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donature_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donature_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` int(11) DEFAULT NULL,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `total` double NOT NULL DEFAULT 0,
  `additional_fee` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donature_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `payment_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fund_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'donation',
  `wish_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_id` int(11) DEFAULT NULL,
  `bill_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `inputer_id` int(11) DEFAULT NULL,
  `inputer_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `pay_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fundraisers`
--

CREATE TABLE `fundraisers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_in_charge` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commissions` int(11) NOT NULL DEFAULT 0,
  `collected` int(11) NOT NULL DEFAULT 0,
  `clicks` int(11) NOT NULL DEFAULT 0,
  `transaction` int(11) NOT NULL DEFAULT 0,
  `success_transaction` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_confirmed` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fundraiser_transactions`
--

CREATE TABLE `fundraiser_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'commission',
  `amount` int(11) NOT NULL DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reference_id` int(11) DEFAULT NULL,
  `fundraiser_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inboxes`
--

CREATE TABLE `inboxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `instant_programs`
--

CREATE TABLE `instant_programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `instant_programs`
--

INSERT INTO `instant_programs` (`id`, `program`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'sedekah', 1, NULL, NULL),
(2, 'wakaf', 1, NULL, NULL),
(3, 'zakat', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_06_07_074849_create_donaturs_table', 1),
(4, '2020_06_07_075059_create_project_categories_table', 1),
(5, '2020_06_07_075537_create_projects_table', 1),
(6, '2020_06_07_075749_create_updates_table', 1),
(7, '2020_06_07_080644_create_fundings_table', 1),
(8, '2020_06_07_081639_create_sliders_table', 1),
(9, '2020_07_07_210337_create_fundraisers_table', 1),
(10, '2020_07_07_223555_create_withdrawals_table', 1),
(11, '2020_07_07_224110_create_inboxes_table', 1),
(12, '2020_07_26_132958_add_payment_proof_to_fundings_table', 1),
(13, '2020_08_04_215521_add_is_confirmed_to_fundraisers_table', 1),
(14, '2020_08_11_161602_create_banks_table', 1),
(15, '2020_09_13_235629_add_tripay_to_funding_table', 1),
(16, '2020_10_04_235123_create_notifs_table', 1),
(17, '2020_10_25_095321_add_slug_to_projects_table', 1),
(18, '2020_10_25_103027_create_docs_table', 1),
(19, '2020_12_03_085243_add_is_admin_to_fundings_table', 1),
(20, '2020_12_03_092936_create_settings_table', 1),
(21, '2020_12_03_095404_add_payment_code_to_fundings_table', 1),
(22, '2021_01_19_193840_add_user_id_to_updates_table', 1),
(23, '2021_01_24_232358_create_topups_table', 1),
(24, '2021_01_24_232517_add_saldo_to_users_table', 1),
(25, '2021_01_31_190512_create_activities_table', 1),
(26, '2021_02_01_105112_add_type_to_projects_table', 1),
(27, '2021_02_03_230355_add_wakaf_price_to_projects_table', 1),
(28, '2021_02_04_093522_add_fund_type_to_fundings_table', 1),
(29, '2021_02_04_093930_add_wakaf_to_projects_table', 1),
(30, '2021_02_07_230111_add_wish_message_to_fundings_table', 1),
(31, '2021_02_08_135016_create_zakats_table', 1),
(32, '2021_02_25_123716_add_position_to_sliders_table', 1),
(33, '2021_02_25_124921_create_blogs_table', 1),
(34, '2021_03_01_212038_add_phone_to_users_table', 1),
(35, '2021_03_11_151358_add_order_number_to_projects_table', 1),
(36, '2021_03_29_221425_add_button_label_to_projects_table', 1),
(37, '2021_03_30_120200_add_order_to_project_categories_table', 1),
(38, '2021_08_11_003752_create_products_table', 1),
(39, '2021_08_12_121640_create_product_variants_table', 1),
(40, '2021_08_12_121721_create_product_images_table', 1),
(41, '2021_08_12_160458_create_carts_table', 1),
(42, '2021_08_13_105231_create_qurban_checkouts_table', 1),
(43, '2021_08_13_105530_create_qurban_details_table', 1),
(44, '2021_08_13_110626_create_qurban_payments_table', 1),
(45, '2021_08_13_142335_create_qurbans_table', 1),
(46, '2021_08_15_044349_add_cart_to_users_table', 1),
(47, '2021_08_16_090106_add_grand_price_to_qurbans_table', 1),
(48, '2021_08_16_115946_create_projects_favourite_table', 1),
(49, '2021_08_16_125030_create_personal_settings_table', 1),
(50, '2021_09_15_151441_add_path_proof_to_topups_table', 1),
(51, '2021_09_20_111210_add_path_proof_to_qurban_payments_table', 1),
(52, '2021_09_20_114559_add_variable_to_settings_table', 1),
(53, '2021_09_20_135304_add_qurban_detail_id_to_qurban_details_table', 1),
(54, '2021_09_20_145018_add_user_id_to_qurban_details_table', 1),
(55, '2021_09_20_153052_create_uniqe_codes_table', 1),
(56, '2021_09_20_162338_add_unique_code_to_qurban_payments_table', 1),
(57, '2021_10_01_140113_add_risalah_status_to_project_categories_table', 1),
(58, '2021_11_26_110623_create_referrals_table', 1),
(59, '2021_11_26_111327_add_referral_id_to_fundings_table', 1),
(60, '2021_11_26_172406_add_slug_to_blogs_table', 1),
(61, '2021_11_26_214743_add_views_to_blogs_table', 1),
(62, '2021_11_28_144923_add_bill_no_to_fundings_table', 1),
(63, '2021_11_29_104806_add_operational_percentage_to_projects_table', 1),
(64, '2021_12_01_163800_create_blog_categories_table', 1),
(65, '2021_12_01_164814_add_category_to_blogs_table', 1),
(66, '2021_12_01_210257_add_notification_settings_data', 1),
(67, '2021_12_02_161357_add_title_to_updates_table', 1),
(68, '2021_12_25_150611_create_partners_table', 1),
(69, '2021_12_25_153119_add_image_to_project_categories_table', 1),
(70, '2021_12_25_155349_add_statisctic_to_projects_table', 1),
(71, '2021_12_25_170644_add_is_fundraiser_to_users_table', 1),
(72, '2021_12_25_232443_create_fundraiser_transactions_table', 1),
(73, '2021_12_26_192036_add_account_type_to_projects_table', 1),
(74, '2021_12_26_201041_add_account_type_to_withdrawals_table', 1),
(75, '2021_12_26_213354_add_inputer_to_fundings_table', 1),
(76, '2021_12_26_230756_create_storage_usages_table', 1),
(77, '2021_12_27_115329_create_instant_programs_table', 1),
(78, '2021_12_28_094130_add_withdrawal_type_to_withdrawals_table', 1),
(79, '2021_12_28_100653_add_reference_id_to_updates_table', 1),
(80, '2022_01_01_114733_add_receiver_to_withdrawal_tables', 1),
(81, '2022_01_01_115851_add_project_type_to_withdrawals_table', 1),
(82, '2022_01_01_120528_add_soft_delete_to_projects_table', 1),
(83, '2022_01_10_215532_add_google_analytics_to_setting_table', 1),
(84, '2022_01_12_231641_add_font_to_settings_table', 1),
(85, '2022_02_03_110718_create_configs_table', 1),
(86, '2022_02_03_142043_create_payment_credentials_table', 1),
(87, '2022_02_03_143405_add_payment_gateway_vendor_to_settings_table', 1),
(88, '2022_02_05_084430_add_tripay_to_fundings_table', 1),
(89, '2022_02_17_132711_add_path_icon_to_setting_table', 1),
(90, '2022_02_21_145937_add_facebook_pixel_to_setting_table', 1),
(91, '2022_02_25_140526_add_direct_link_to_activities_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifs`
--

CREATE TABLE `notifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sended` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `partner_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_credentials`
--

CREATE TABLE `payment_credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'faspay',
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_settings`
--

CREATE TABLE `personal_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_whatsapp` int(11) NOT NULL DEFAULT 0,
  `is_anonymous` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`custom`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `path` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_featured` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominal_target` double DEFAULT NULL,
  `date_target` date DEFAULT NULL,
  `category_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `is_fixed` tinyint(4) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'donation',
  `wakaf_price` double NOT NULL DEFAULT 0,
  `wakaf_unit` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `button_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operational_percentage` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `donations` int(11) NOT NULL DEFAULT 0,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `projects`
--

INSERT INTO `projects` (`id`, `title`, `content`, `path_featured`, `nominal_target`, `date_target`, `category_id`, `user_id`, `is_fixed`, `status`, `created_at`, `updated_at`, `slug`, `type`, `wakaf_price`, `wakaf_unit`, `order_number`, `button_label`, `operational_percentage`, `views`, `donations`, `account_type`, `deleted_at`) VALUES
(122, 'Tenetur blanditiis et odit.', 'Quia et cumque saepe aut tenetur molestias. Unde est dolorem nihil hic architecto ut. Qui id enim dolores quisquam doloribus.', 'uploads/project/M0UDdUCFEf6hrT0W.png', 96000000, NULL, 2, 1, 1, 1, '2022-03-21 04:42:37', '2022-03-21 04:42:37', 'tenetur-blanditiis-et-odit', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(123, 'Qui ipsa aut vero dolor necessitatibus et.', 'Dicta nam suscipit enim expedita in. Qui voluptatem possimus modi exercitationem consequuntur et. Est error ducimus a nam eos. Totam quae nihil ut velit iusto fuga illo et.', 'uploads/project/ytzVg3kOzu3gYKow.png', 75600000, NULL, 2, 1, 1, 1, '2022-03-21 04:42:41', '2022-03-21 04:42:41', 'qui-ipsa-aut-vero-dolor-necessitatibus-et', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(124, 'Sapiente est similique pariatur.', 'Minus et et natus impedit quisquam. Tempore saepe accusantium quidem quis sit minima officiis aut. Quis dolores blanditiis placeat laborum est. Ut blanditiis eos similique velit. Dolorem in ab tempora nisi culpa omnis et.', 'uploads/project/7YLFPWnsfk1VltNG.png', 24900000, NULL, 2, 1, 1, 1, '2022-03-21 04:42:45', '2022-03-21 04:42:45', 'sapiente-est-similique-pariatur', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(125, 'Suscipit blanditiis est molestiae est.', 'Nihil autem sed consequuntur aperiam saepe et. Ea cum doloremque qui nobis itaque asperiores ut quis. Et ut saepe veritatis distinctio cum. Delectus sed facere unde nam qui incidunt sint enim.', 'uploads/project/bjHbyG3zIE73vto8.png', 43300000, NULL, 3, 1, 1, 1, '2022-03-21 04:42:49', '2022-03-21 04:42:49', 'suscipit-blanditiis-est-molestiae-est', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(126, 'Soluta consequuntur ut eligendi veniam.', 'Magnam veritatis quasi voluptatem. Consequuntur aut molestiae voluptatibus ullam. Expedita ullam consectetur omnis cupiditate voluptas.', 'uploads/project/eh4FBgUrhIPejdey.png', 63000000, NULL, 2, 1, 1, 1, '2022-03-21 04:42:53', '2022-03-21 04:42:53', 'soluta-consequuntur-ut-eligendi-veniam', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(127, 'Et est quis autem pariatur debitis et.', 'Est consequatur est ratione laudantium ea. Ut soluta a incidunt magnam molestiae. Labore est necessitatibus eveniet quis tempore. Delectus omnis voluptates expedita tempora eveniet.', 'uploads/project/3fQUhGhg3PyI2Ee4.png', 64400000, NULL, 7, 1, 1, 1, '2022-03-21 04:42:56', '2022-03-21 04:42:56', 'et-est-quis-autem-pariatur-debitis-et', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(128, 'Accusamus doloremque laboriosam quis qui.', 'Accusantium consequatur mollitia sed iusto dolor magni nisi. Delectus beatae perferendis deserunt illo omnis. Ullam magni officiis provident amet quam delectus esse. Libero aut quia aut culpa vero ab.', 'uploads/project/pe77uFHTl63KFkFs.png', 79000000, NULL, 2, 1, 1, 1, '2022-03-21 04:42:59', '2022-03-21 04:42:59', 'accusamus-doloremque-laboriosam-quis-qui', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(129, 'Sapiente voluptatem voluptas est ratione sed.', 'Enim dolores eligendi mollitia. Harum incidunt ab laborum officia. Autem voluptatem consequatur totam modi iure velit.', 'uploads/project/9BfLVXdpw4h72tFB.png', 16300000, NULL, 5, 1, 1, 1, '2022-03-21 04:43:03', '2022-03-21 04:43:03', 'sapiente-voluptatem-voluptas-est-ratione-sed', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(130, 'Ullam quis praesentium cumque eum.', 'Fugiat est maiores minus doloribus consequatur saepe. Qui aspernatur quia nobis exercitationem cumque aut. Voluptatem facere pariatur a qui voluptatibus sed. Ea at eius nostrum quia delectus.', 'uploads/project/fosD4aKLeasPRm88.png', 20400000, NULL, 2, 1, 1, 1, '2022-03-21 04:43:07', '2022-03-21 04:43:07', 'ullam-quis-praesentium-cumque-eum', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(131, 'Dolores corrupti animi quasi nobis sit est.', 'Dolores veritatis est nam eum voluptatem tempora sint sunt. Aut rerum earum consequatur atque soluta perspiciatis. Aut expedita suscipit minima blanditiis porro. Autem similique molestiae ut amet officiis consequatur omnis.', 'uploads/project/MD232gMXN7HnjHb2.png', 68400000, NULL, 9, 1, 1, 1, '2022-03-21 04:43:11', '2022-03-21 04:43:11', 'dolores-corrupti-animi-quasi-nobis-sit-est', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(132, 'Eos deleniti repellat et maiores voluptatem.', 'Sit quis nihil cumque. Amet officiis aut ut dolorum est amet. Pariatur in est id officiis sunt fugiat. Ea nostrum et consequatur veniam sit.', 'uploads/project/NlLIWHhX6ngdtBWm.png', 88900000, NULL, 8, 1, 1, 1, '2022-03-21 04:43:15', '2022-03-21 04:43:15', 'eos-deleniti-repellat-et-maiores-voluptatem', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(133, 'Ea quis ut voluptatibus mollitia dignissimos esse qui quae.', 'Earum quia facere tempora quisquam harum. Error nihil nihil est dolore. Et tempore qui hic numquam est.', 'uploads/project/6knMZf8XGJJbwQL3.png', 52900000, NULL, 8, 1, 1, 1, '2022-03-21 04:43:18', '2022-03-21 04:43:18', 'ea-quis-ut-voluptatibus-mollitia-dignissimos-esse-qui-quae', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(134, 'Voluptas delectus nam ut sapiente deleniti molestiae.', 'Aperiam ex impedit harum nihil ab atque ipsa. Recusandae illum nihil ut eius cupiditate eveniet molestiae.', 'uploads/project/IjgzHLMxSOtEilWo.png', 16900000, NULL, 9, 1, 1, 1, '2022-03-21 04:43:22', '2022-03-21 04:43:22', 'voluptas-delectus-nam-ut-sapiente-deleniti-molestiae', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(135, 'Temporibus dignissimos ipsa harum totam doloremque aut.', 'Voluptates dicta debitis rerum neque aliquam. Et modi tempora natus ut omnis illo molestiae velit. Ut quia qui eos quis debitis repudiandae esse facilis.', 'uploads/project/Tx5wRXhDpz1PHbAk.png', 94000000, NULL, 4, 1, 1, 1, '2022-03-21 04:43:25', '2022-03-21 04:43:25', 'temporibus-dignissimos-ipsa-harum-totam-doloremque-aut', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(136, 'Quo temporibus consequatur minima ut.', 'Eos harum aliquid laudantium error eum ducimus perferendis porro. Omnis voluptas dolore qui et nostrum. Perferendis inventore iste iusto perferendis. Assumenda nemo magni sit quis aperiam exercitationem.', 'uploads/project/LlroF7utxXYdAME9.png', 90600000, NULL, 8, 1, 1, 1, '2022-03-21 04:43:30', '2022-03-21 04:43:30', 'quo-temporibus-consequatur-minima-ut', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(137, 'Occaecati in explicabo sunt nemo at porro ullam.', 'Harum laboriosam reprehenderit officia itaque consequatur sapiente totam et. Quia consequatur unde delectus dolorem ipsa id. Praesentium enim vel quidem sed itaque accusantium et.', 'uploads/project/Si0VzixREgp4SRaq.png', 32900000, NULL, 8, 1, 1, 1, '2022-03-21 04:43:34', '2022-03-21 04:43:34', 'occaecati-in-explicabo-sunt-nemo-at-porro-ullam', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(138, 'Cupiditate placeat harum autem magni tenetur quos corrupti.', 'Porro fugiat a deleniti soluta est repudiandae necessitatibus. Qui voluptatibus harum eos atque rerum harum. Sed sunt vel dignissimos delectus quia consectetur consequatur.', 'uploads/project/62ANtp4wkw92kaWp.png', 50500000, NULL, 6, 1, 1, 1, '2022-03-21 04:43:40', '2022-03-21 04:43:40', 'cupiditate-placeat-harum-autem-magni-tenetur-quos-corrupti', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(139, 'Unde impedit error est dolor enim.', 'Accusantium quaerat occaecati quae aliquid. Quis officia esse et minus reiciendis ut. Debitis eveniet ea facilis ut. Et quis nemo nam tempora magni asperiores veritatis est.', 'uploads/project/Xlx1yJzoDg9aBrUV.png', 92600000, NULL, 10, 1, 1, 1, '2022-03-21 04:43:43', '2022-03-21 04:43:43', 'unde-impedit-error-est-dolor-enim', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(140, 'Qui ducimus sapiente quisquam sit.', 'Temporibus ut sequi quis perferendis eius et. Error perferendis quia dolorum laudantium. Voluptate et quasi et suscipit et adipisci corrupti. Nihil accusamus fugit vel quod dolorem deleniti magnam.', 'uploads/project/ylueLszpSlvLbcKN.png', 90300000, NULL, 5, 1, 1, 1, '2022-03-21 04:43:47', '2022-03-21 04:43:47', 'qui-ducimus-sapiente-quisquam-sit', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(141, 'Animi velit atque qui sit enim alias sed.', 'Voluptas non occaecati quia facere sed vel. Dolores error voluptatum dolor nihil non distinctio. Nostrum in molestiae molestias voluptas dicta fugiat molestias non. Veniam reprehenderit nam voluptas placeat tempora fugit ut.', 'uploads/project/sAIG3y7geKXtZhCJ.png', 83700000, NULL, 6, 1, 1, 1, '2022-03-21 04:43:51', '2022-03-21 04:43:51', 'animi-velit-atque-qui-sit-enim-alias-sed', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(142, 'Blanditiis voluptatum expedita autem est eum molestiae.', 'Nemo sint perspiciatis ab natus quisquam. Quo debitis sunt sit quidem inventore exercitationem atque. Placeat omnis maiores veniam. Nostrum ipsum dicta culpa sequi sapiente magni.', 'uploads/project/2N1AclN5MN4fabbt.png', 88500000, NULL, 3, 1, 1, 1, '2022-03-21 04:43:54', '2022-03-21 04:43:54', 'blanditiis-voluptatum-expedita-autem-est-eum-molestiae', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(143, 'Omnis nulla alias sit reiciendis totam ad.', 'Est eum et fugiat blanditiis accusantium. Eos ullam ipsa molestiae quos iste odit aut qui. Itaque ipsam assumenda sed error sunt ut. Ea non doloribus rerum laborum iusto.', 'uploads/project/TptQAYKCqQADhZaQ.png', 4800000, NULL, 10, 1, 1, 1, '2022-03-21 04:44:01', '2022-03-21 04:44:01', 'omnis-nulla-alias-sit-reiciendis-totam-ad', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(144, 'Eum ut quasi ullam eius repudiandae consequatur vero.', 'Optio iusto beatae commodi ullam asperiores sunt libero. Mollitia praesentium fuga autem quibusdam occaecati. Repellendus libero repellat doloribus cumque quod et inventore.', 'uploads/project/E3bFKugGA9khIubo.png', 60800000, NULL, 1, 1, 1, 1, '2022-03-21 04:44:05', '2022-03-21 04:44:05', 'eum-ut-quasi-ullam-eius-repudiandae-consequatur-vero', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(145, 'Reprehenderit hic impedit vitae ipsam.', 'Quisquam commodi similique illum id ut consequatur. Officia molestias id ut id illo ut earum voluptatibus. Necessitatibus consectetur quo qui delectus. Cumque perferendis sapiente et necessitatibus corrupti est aut omnis.', 'uploads/project/swFx1bH01I8n11qb.png', 88400000, NULL, 9, 1, 1, 1, '2022-03-21 04:44:09', '2022-03-21 04:44:09', 'reprehenderit-hic-impedit-vitae-ipsam', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(146, 'Possimus dolores eius non qui.', 'Sed ea aliquid aut impedit esse illo illum. Labore perspiciatis perferendis occaecati tenetur. Recusandae ut dolores ut earum nesciunt sit laboriosam.', 'uploads/project/sINQoItaZ7ltoCZX.png', 22300000, NULL, 8, 1, 1, 1, '2022-03-21 04:44:13', '2022-03-21 04:44:13', 'possimus-dolores-eius-non-qui', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(147, 'Commodi neque quasi velit sint rem.', 'Totam atque voluptatibus at et. Quisquam odio perferendis inventore fuga placeat sit modi. Molestias dolores cupiditate qui saepe sunt ut. Blanditiis aspernatur ipsum facilis laboriosam saepe.', 'uploads/project/umNcN7I2G7sYS3Hn.png', 97000000, NULL, 10, 1, 1, 1, '2022-03-21 04:44:18', '2022-03-21 04:44:18', 'commodi-neque-quasi-velit-sint-rem', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(148, 'Itaque qui dignissimos ea ipsum aperiam.', 'Dolores quibusdam est asperiores veniam est nemo ipsum. Possimus ut ea accusantium et. Aut porro enim tenetur eveniet et quas perferendis.', 'uploads/project/LXfeEdSwpMwqfwaG.png', 9000000, NULL, 1, 1, 1, 1, '2022-03-21 04:44:24', '2022-03-21 04:44:24', 'itaque-qui-dignissimos-ea-ipsum-aperiam', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(149, 'Aut molestiae modi modi consequuntur.', 'Dolores ratione et ratione omnis minima non. A quia pariatur vel est ipsa. Ea inventore perspiciatis ipsa voluptas natus. Laborum eius voluptas odit laboriosam autem cupiditate eaque.', 'uploads/project/TOtBsiJezUZ9m3Xy.png', 95500000, NULL, 8, 1, 1, 1, '2022-03-21 04:44:27', '2022-03-21 04:44:27', 'aut-molestiae-modi-modi-consequuntur', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(150, 'Reiciendis et quos cupiditate est dolorem dolores.', 'Commodi voluptas placeat quasi eos numquam culpa facilis et. Sed consequatur explicabo minima libero suscipit recusandae soluta. Harum ipsum fugiat libero. Autem maiores cum eum saepe incidunt accusamus hic.', 'uploads/project/h0ww18lJ4Uwsg6OQ.png', 40100000, NULL, 10, 1, 1, 1, '2022-03-21 04:44:30', '2022-03-21 04:44:30', 'reiciendis-et-quos-cupiditate-est-dolorem-dolores', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(151, 'Nulla iure facere qui.', 'Est aut cumque aut consequatur quibusdam animi. Quae excepturi odio qui consequatur. Aut sapiente excepturi et. Temporibus aut corrupti voluptatum itaque.', 'uploads/project/wXJbsOBAMWailEW5.png', 3900000, NULL, 2, 1, 1, 1, '2022-03-21 04:44:37', '2022-03-21 04:44:37', 'nulla-iure-facere-qui', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(152, 'Voluptas accusamus sed hic non.', 'Reiciendis id quod optio ea. Dolore atque consequatur et autem et. Amet voluptate soluta debitis ut ut hic asperiores.', 'uploads/project/olHOyCAPJ4tJBhFR.png', 46300000, NULL, 9, 1, 1, 1, '2022-03-21 04:44:42', '2022-03-21 04:44:42', 'voluptas-accusamus-sed-hic-non', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(153, 'Molestiae at nihil voluptatem fuga quia corporis.', 'Sint explicabo eveniet quia est. Quo officia quam nam excepturi occaecati ea dignissimos. In laboriosam est excepturi repudiandae. Consequatur illo dolor voluptas quo et.', 'uploads/project/YUKylCbSzgeR4BWd.png', 29500000, NULL, 8, 1, 1, 1, '2022-03-21 04:44:46', '2022-03-21 04:44:46', 'molestiae-at-nihil-voluptatem-fuga-quia-corporis', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(154, 'Aliquid non cupiditate deserunt sequi dolorem maxime aliquam cupiditate.', 'Sint quae vitae ipsam nobis voluptas optio corporis. Autem iste est aut quidem doloribus sed. Eum quibusdam suscipit dolorum cumque.', 'uploads/project/uOKItsI8uiMpkvt7.png', 95700000, NULL, 9, 1, 1, 1, '2022-03-21 04:44:51', '2022-03-21 04:44:51', 'aliquid-non-cupiditate-deserunt-sequi-dolorem-maxime-aliquam-cupiditate', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(155, 'Rerum possimus aut sit.', 'Libero aut ut doloribus deleniti qui ut. Eos eius quaerat cumque doloribus. Illum ut qui esse voluptas maxime qui earum distinctio. Odit impedit libero ea et aspernatur nam consequatur.', 'uploads/project/NYWH3lnyHqlJGxXP.png', 19800000, NULL, 2, 1, 1, 1, '2022-03-21 04:44:54', '2022-03-21 04:44:54', 'rerum-possimus-aut-sit', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(156, 'Sed dolorem qui sint qui similique.', 'Beatae sint voluptas quaerat dolorem. Reiciendis et sint expedita. Deleniti consequatur mollitia blanditiis suscipit libero iste.', 'uploads/project/17u4B4DelKzE3ju5.png', 70500000, NULL, 5, 1, 1, 1, '2022-03-21 04:44:57', '2022-03-21 04:44:57', 'sed-dolorem-qui-sint-qui-similique', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(157, 'Voluptas eum odit recusandae numquam accusantium nostrum fuga sed.', 'Rem vero eius est est tempora. Ex architecto dolor quam accusantium magni ipsum ut. Id eveniet est atque. Natus incidunt laboriosam rerum. Ipsam rem fugiat quasi non impedit.', 'uploads/project/onStiOiOfU9P7Q9o.png', 13400000, NULL, 1, 1, 1, 1, '2022-03-21 04:45:02', '2022-03-21 04:45:02', 'voluptas-eum-odit-recusandae-numquam-accusantium-nostrum-fuga-sed', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(158, 'Cupiditate voluptatem cum placeat sunt eligendi quo.', 'Et et necessitatibus aperiam est ea. Fugiat voluptatem minus quia sunt. Facilis occaecati et quis debitis.', 'uploads/project/fT69vrCJsq4Rh7TM.png', 91500000, NULL, 4, 1, 1, 1, '2022-03-21 04:45:05', '2022-03-21 04:45:05', 'cupiditate-voluptatem-cum-placeat-sunt-eligendi-quo', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(159, 'Maiores ex dicta fugit enim quam.', 'Earum vel alias quam omnis. Placeat omnis itaque suscipit in et. Ex qui quos culpa quia. Quod illo eum aliquam.', 'uploads/project/2EFy8NPvub22caU8.png', 11700000, NULL, 9, 1, 1, 1, '2022-03-21 04:45:08', '2022-03-21 04:45:08', 'maiores-ex-dicta-fugit-enim-quam', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(160, 'Modi reprehenderit eligendi sequi cumque.', 'Rerum ut architecto reprehenderit aperiam et. Commodi error non quos velit quasi. Eveniet ut optio iure. Similique alias quia alias. Omnis dolore aut inventore beatae repellendus quibusdam reprehenderit.', 'uploads/project/0xJoirecmwkmIkfN.png', 78700000, NULL, 7, 1, 1, 1, '2022-03-21 04:45:11', '2022-03-21 04:45:11', 'modi-reprehenderit-eligendi-sequi-cumque', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(161, 'Ea et cumque rem consequatur qui est.', 'Aut porro quod quibusdam. Ut nostrum commodi repellat cupiditate. Quia consequatur consequatur eius non facilis est.', 'uploads/project/s5xz2FL7jQv9e8Tk.png', 62000000, NULL, 4, 1, 1, 1, '2022-03-21 04:45:15', '2022-03-21 04:45:15', 'ea-et-cumque-rem-consequatur-qui-est', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(162, 'Qui consequatur est id laudantium et nam.', 'Minus similique qui deleniti est tenetur perspiciatis. Et reprehenderit quasi itaque consequatur et eos. Tempore et sunt aut.', 'uploads/project/mS5xwtEpFyROivOc.png', 58800000, NULL, 2, 1, 1, 1, '2022-03-21 04:45:18', '2022-03-21 04:45:18', 'qui-consequatur-est-id-laudantium-et-nam', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(163, 'Explicabo et laborum est voluptatum.', 'Voluptatibus est necessitatibus dolores illum et. Consequatur quam eligendi architecto reprehenderit. Est exercitationem officiis commodi aut dolorem velit.', 'uploads/project/ccpHfm7h3hRQgJNE.png', 72500000, NULL, 8, 1, 1, 1, '2022-03-21 04:45:22', '2022-03-21 04:45:22', 'explicabo-et-laborum-est-voluptatum', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(164, 'Ut esse ut doloremque quis molestiae voluptatem.', 'Aspernatur qui officia maxime et. Sed aut nam a nesciunt. Nam est est libero est assumenda.', 'uploads/project/LPtxrwHB3tDKTn3m.png', 82200000, NULL, 3, 1, 1, 1, '2022-03-21 04:45:25', '2022-03-21 04:45:25', 'ut-esse-ut-doloremque-quis-molestiae-voluptatem', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(165, 'Tempora ut quia non veniam sed inventore.', 'Et voluptas ratione hic autem. Maiores nihil nulla sunt est repellat repellendus quibusdam. Aperiam odio vel error quia molestiae.', 'uploads/project/vaySmaS3wzkxfzRQ.png', 9900000, NULL, 1, 1, 1, 1, '2022-03-21 04:45:28', '2022-03-21 04:45:28', 'tempora-ut-quia-non-veniam-sed-inventore', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(166, 'Vel magni aspernatur sit voluptatem id.', 'Ea dignissimos est corrupti molestiae consequatur. Non ea qui eos porro. Sint inventore tempora quod officia. Esse aperiam quis rerum earum.', 'uploads/project/0aE9iIAXeO1uGSxI.png', 38200000, NULL, 4, 1, 1, 1, '2022-03-21 04:45:31', '2022-03-21 04:45:31', 'vel-magni-aspernatur-sit-voluptatem-id', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(167, 'Eligendi laudantium atque eaque et aut omnis nihil.', 'Commodi eum sit doloribus animi est corporis ducimus. Modi blanditiis modi nihil quia non. Recusandae voluptate voluptas id non delectus. Expedita est ut eum sed enim ducimus error.', 'uploads/project/elBagIw3BYB1cfxI.png', 92100000, NULL, 9, 1, 1, 1, '2022-03-21 04:45:34', '2022-03-21 04:45:34', 'eligendi-laudantium-atque-eaque-et-aut-omnis-nihil', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(168, 'Qui laudantium accusamus sit rem sunt.', 'Debitis architecto tempore maxime voluptas eum omnis. Nemo aut dolor velit non deserunt omnis quia. Saepe hic quae velit et. Perferendis sunt ipsam quia temporibus et.', 'uploads/project/UlRYxrTNvGuc8E3m.png', 76900000, NULL, 2, 1, 1, 1, '2022-03-21 04:45:39', '2022-03-21 04:45:39', 'qui-laudantium-accusamus-sit-rem-sunt', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(169, 'Dolorum reprehenderit consequuntur qui.', 'Placeat tenetur incidunt perferendis at dolore ea. Reprehenderit aut ut ratione aut consequuntur et distinctio. Cum quisquam voluptatibus non sunt. Quisquam dignissimos molestiae ipsam eos deserunt dolorem ipsum eum.', 'uploads/project/rBrEdnILYFfXa1lh.png', 3900000, NULL, 6, 1, 1, 1, '2022-03-21 04:45:43', '2022-03-21 04:45:43', 'dolorum-reprehenderit-consequuntur-qui', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(170, 'Veritatis mollitia et officia rerum quaerat vel nisi.', 'Rem vero quaerat temporibus maiores et ut similique alias. Architecto dolorem praesentium illum dolores voluptatibus deserunt in. Asperiores dolor cum sit iure atque. Delectus minus ad ut reprehenderit.', 'uploads/project/bxIxrHXoO9yiq8hy.png', 85600000, NULL, 1, 1, 1, 1, '2022-03-21 04:45:48', '2022-03-21 04:45:48', 'veritatis-mollitia-et-officia-rerum-quaerat-vel-nisi', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL),
(171, 'Non est dolorem aut eos id beatae perspiciatis.', 'Placeat in quasi qui optio. Eum repellendus eaque voluptatem dicta laboriosam voluptatem voluptatum. Cumque consequuntur culpa dolores qui quos ut voluptatem. Nesciunt magni rerum rerum ut saepe non culpa a.', 'uploads/project/9bhdbFV4k5dnBTg2.png', 29900000, NULL, 6, 1, 1, 1, '2022-03-21 04:45:51', '2022-03-21 04:45:51', 'non-est-dolorem-aut-eos-id-beatae-perspiciatis', 'donation', 0, NULL, 0, 'Donasi Sekarang', 1, 0, 0, 'admin', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `projects_favourite`
--

CREATE TABLE `projects_favourite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `risalah` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_number` int(11) NOT NULL DEFAULT 0,
  `risalah_status` tinyint(1) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `project_categories`
--

INSERT INTO `project_categories` (`id`, `path_icon`, `category`, `risalah`, `created_at`, `updated_at`, `order_number`, `risalah_status`, `image`) VALUES
(1, 'uploads/category/UGfqDNnp9fFnAlxV.png', 'deleniti', NULL, '2022-03-21 04:33:44', '2022-03-21 04:33:44', 0, 0, 'uploads/category/acSe3eGc1ZC5lOA3.png'),
(2, 'uploads/category/tvMlrNdIoDoFYVQy.png', 'molestias', NULL, '2022-03-21 04:33:45', '2022-03-21 04:33:45', 0, 0, 'uploads/category/Kk4BnvCk0NhY0UOz.png'),
(3, 'uploads/category/Szc77gfHbo4bT2g6.png', 'saepe', NULL, '2022-03-21 04:33:46', '2022-03-21 04:33:46', 0, 0, 'uploads/category/5Fr6BWF7K2wWmw67.png'),
(4, 'uploads/category/AnhSJJORYDo5pJPS.png', 'est', NULL, '2022-03-21 04:33:47', '2022-03-21 04:33:47', 0, 0, 'uploads/category/eDuluaYacB1hEsrK.png'),
(5, 'uploads/category/p23bhhvlOoLFy2DY.png', 'reiciendis', NULL, '2022-03-21 04:33:47', '2022-03-21 04:33:47', 0, 0, 'uploads/category/1IjNn3mTg9FUCW6g.png'),
(6, 'uploads/category/7fe48ZDPiiTE3m1o.png', 'minima', NULL, '2022-03-21 04:33:48', '2022-03-21 04:33:48', 0, 0, 'uploads/category/U8IQnie97qzafTFq.png'),
(7, 'uploads/category/hRSTX4xJ4NP0KjEL.png', 'sunt', NULL, '2022-03-21 04:33:49', '2022-03-21 04:33:49', 0, 0, 'uploads/category/uYBXuKliqezI2M6U.png'),
(8, 'uploads/category/lxNQSWHNqtHVBlvS.png', 'odio', NULL, '2022-03-21 04:33:49', '2022-03-21 04:33:49', 0, 0, 'uploads/category/jXemFamEUXRY4U2O.png'),
(9, 'uploads/category/jePmQIuJensL3a5Y.png', 'quia', NULL, '2022-03-21 04:33:50', '2022-03-21 04:33:50', 0, 0, 'uploads/category/J4DrDsEriPZE5jgn.png'),
(10, 'uploads/category/N86X0kZXDxS8KrJL.png', 'rerum', NULL, '2022-03-21 04:33:51', '2022-03-21 04:33:51', 0, 0, 'uploads/category/GRwd9AVBSHAPjQBR.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `qurbans`
--

CREATE TABLE `qurbans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_wa` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `atas_nama` int(11) DEFAULT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `grand_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qurban_checkouts`
--

CREATE TABLE `qurban_checkouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `grand_price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qurban_details`
--

CREATE TABLE `qurban_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qurban_id` int(11) NOT NULL,
  `field` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qurban_payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `qurban_payments`
--

CREATE TABLE `qurban_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qurban_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `donatur_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donatur_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donatur_whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atas_nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_whatsapp` tinyint(1) NOT NULL DEFAULT 0,
  `nominal` double NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_limit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `donature_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` int(11) NOT NULL,
  `collected` int(11) NOT NULL DEFAULT 0,
  `referred` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secondary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `danger` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_primary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans_secondary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_analytics` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_gateway_vendor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_pixel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`, `path_logo`, `title`, `primary`, `secondary`, `danger`, `trans_primary`, `trans_secondary`, `google_analytics`, `font`, `payment_gateway_vendor`, `path_icon`, `facebook_pixel`) VALUES
(1, 'donation_reminder', 'Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nTerima kasih telah berniat untuk investasi akhirat di <<app_name>>.\n\nKami hanya ingin mengingatkan niat baik Bapak/Ibu untuk berinvestasi akhirat di <<app_name>>\nPahala besar dan keberkahan sudah menunggu segera tunaikan niat baik Anda\n\nIni Nomor Transaksinya : <<invoice_number>>\nDonasi untuk program: <<campaign_name>>\nTinggal selangkah lagi pahala Anda langsung mengalir in syaa Allah.\n\nSilahkan transfer sejumlah <<donation_amount>>\n(Pastikan nominal transfernya sama persis, agar bisa kami konfirmasi dengan tepat)\n\nPembayaran dengan: <<payment_method>>\nLakukan sebelum <<time_limit>>\n\nSemoga niat baik kita semua, dimudahkan oleh Allah.\n\nSilahkan simpan kontak ini sebagai Admin Amal <<app_name>> untuk mendapatkan info terkait program lainnya.\n\nTerima kasih.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'donation_thanks', 'Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nAlhamdulillah investasi akhirat Anda sebesar <<donation_amount>> telah kami terima\n\nKami berdoa semoga membalasnya dengan pahala yang besar dan tidak putus putus nya. Menambahkan keberkahan pada harta yang tersisa dan memberikan kebahagiaan bagi Anda dan keluarga. Serta Allah mudahkan semua urusan Anda.\nAmin Ya Robbal Alamin\n\nTerima kasih.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'gold_price', '830000', '2022-03-21 04:33:24', '2022-03-21 04:33:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'silver_price', '12000', '2022-03-21 04:33:24', '2022-03-21 04:33:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path_slider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `position` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'top'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `storage_usages`
--

CREATE TABLE `storage_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `disk_usage` double NOT NULL DEFAULT 0,
  `database_usage` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `storage_usages`
--

INSERT INTO `storage_usages` (`id`, `disk_usage`, `database_usage`, `created_at`, `updated_at`) VALUES
(1, 264773450, 23372194, '2022-03-21 04:33:24', '2022-03-21 04:33:24'),
(2, 251867174, 40715760, '2022-03-20 04:33:24', '2022-03-21 04:33:24'),
(3, 264420596, 42298976, '2022-03-19 04:33:24', '2022-03-21 04:33:24'),
(4, 262145300, 29553710, '2022-03-18 04:33:24', '2022-03-21 04:33:24'),
(5, 226723148, 30990128, '2022-03-17 04:33:24', '2022-03-21 04:33:24'),
(6, 205074111, 24134840, '2022-03-16 04:33:24', '2022-03-21 04:33:24'),
(7, 301459450, 62781020, '2022-03-15 04:33:24', '2022-03-21 04:33:24'),
(8, 261113525, 9251788, '2022-03-14 04:33:24', '2022-03-21 04:33:24'),
(9, 224528717, 10124839, '2022-03-13 04:33:24', '2022-03-21 04:33:24'),
(10, 256238399, 76160270, '2022-03-12 04:33:24', '2022-03-21 04:33:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `topups`
--

CREATE TABLE `topups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `extra_cost` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `req_at` datetime NOT NULL,
  `pay_at` datetime DEFAULT NULL,
  `expire_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `uniqe_codes`
--

CREATE TABLE `uniqe_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `updates`
--

CREATE TABLE `updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) DEFAULT NULL,
  `nominal` double NOT NULL DEFAULT 0,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `path_foto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `saldo` double NOT NULL DEFAULT 0,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`cart`)),
  `is_fundraiser` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `path_foto`, `remember_token`, `created_at`, `updated_at`, `saldo`, `phone`, `cart`, `is_fundraiser`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$9JVppeghckvAaCERxkPA7uSGsl9PKYef0Xx9o8NydolrYDhT/TnSC', 'admin', NULL, NULL, '2022-03-21 04:33:24', '2022-03-21 04:33:24', 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `nominal` double NOT NULL,
  `use_plan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `withdraw_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `approve_date` timestamp NULL DEFAULT NULL,
  `path_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `reject_reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `withdrawal_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'distribution',
  `receiver` int(11) NOT NULL DEFAULT 0,
  `receiver_unit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `zakats`
--

CREATE TABLE `zakats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'harta',
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `funding_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `docs`
--
ALTER TABLE `docs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `donaturs`
--
ALTER TABLE `donaturs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fundings`
--
ALTER TABLE `fundings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fundraisers`
--
ALTER TABLE `fundraisers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fundraiser_transactions`
--
ALTER TABLE `fundraiser_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inboxes`
--
ALTER TABLE `inboxes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instant_programs`
--
ALTER TABLE `instant_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `payment_credentials`
--
ALTER TABLE `payment_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_settings`
--
ALTER TABLE `personal_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `projects_favourite`
--
ALTER TABLE `projects_favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qurbans`
--
ALTER TABLE `qurbans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qurban_checkouts`
--
ALTER TABLE `qurban_checkouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qurban_details`
--
ALTER TABLE `qurban_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `qurban_payments`
--
ALTER TABLE `qurban_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `storage_usages`
--
ALTER TABLE `storage_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `topups`
--
ALTER TABLE `topups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `uniqe_codes`
--
ALTER TABLE `uniqe_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `zakats`
--
ALTER TABLE `zakats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `docs`
--
ALTER TABLE `docs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `donaturs`
--
ALTER TABLE `donaturs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fundings`
--
ALTER TABLE `fundings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fundraisers`
--
ALTER TABLE `fundraisers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `fundraiser_transactions`
--
ALTER TABLE `fundraiser_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inboxes`
--
ALTER TABLE `inboxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `instant_programs`
--
ALTER TABLE `instant_programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT untuk tabel `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `payment_credentials`
--
ALTER TABLE `payment_credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_settings`
--
ALTER TABLE `personal_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT untuk tabel `projects_favourite`
--
ALTER TABLE `projects_favourite`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `qurbans`
--
ALTER TABLE `qurbans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `qurban_checkouts`
--
ALTER TABLE `qurban_checkouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `qurban_details`
--
ALTER TABLE `qurban_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `qurban_payments`
--
ALTER TABLE `qurban_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `storage_usages`
--
ALTER TABLE `storage_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `topups`
--
ALTER TABLE `topups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uniqe_codes`
--
ALTER TABLE `uniqe_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `updates`
--
ALTER TABLE `updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `zakats`
--
ALTER TABLE `zakats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
