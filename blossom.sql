-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2026 at 11:07 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blossom`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hero_slides`
--

CREATE TABLE `hero_slides` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_slides`
--

INSERT INTO `hero_slides` (`id`, `title`, `subtitle`, `image`, `link_url`, `link_text`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sundry Blossom', 'Handcrafted & Sustainable Goods Sourced from Rural Artisans', 'hero-slides/hero-1.jpeg', '/products', 'Explore Collections', 1, 1, '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(2, 'Sundry Blossom 2', 'Connecting Global Retailers with Authentic Bangladeshi Craftsmanship', 'hero-slides/01M0W28WQJXAGGTDZ1G8CY0D6C.jpeg', '/inquiry', 'Trade Inquiries', 2, 1, '2026-08-25 02:42:28', '2026-08-25 02:58:27'),
(3, 'Hand-loomed & Organic', 'Pure Natural Fibers, Sustainable Textiles & Mindful Living', 'hero-slides/hero-3.jpeg', '/our-story', 'Our Heritage', 3, 0, '2026-08-25 02:42:28', '2026-08-25 02:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_details` text COLLATE utf8mb4_unicode_ci,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_23_070356_create_products_table', 1),
(5, '2026_08_23_080000_create_our_stories_table', 1),
(6, '2026_08_23_090000_add_details_to_products_table', 1),
(7, '2026_08_25_140000_create_contact_messages_table', 1),
(8, '2026_08_25_140100_create_inquiries_table', 1),
(9, '2026_08_25_140200_create_site_settings_table', 1),
(10, '2026_08_25_143500_create_hero_slides_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `our_stories`
--

CREATE TABLE `our_stories` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `our_stories`
--

INSERT INTO `our_stories` (`id`, `title`, `slug`, `short_description`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Our Story', 'our-story', 'Founded in 2018, Sundry Blossom has grown into a trusted name for handcrafted and sourced products. With a passion for quality and authenticity, we bring you the finest from across Bangladesh and beyond.', 'At Sundry Blossom, we believe that every object carries a story — of the hands that shaped it, the land it came from, and the love poured into its creation.\n\nFounded in 2018, our journey began with a simple idea: to connect people with authentic, handcrafted products that carry the soul of their origin. What started as a small initiative has now grown into a movement that supports local artisans, farmers, and craftspeople across Bangladesh.\n\nWe travel to remote villages, work closely with communities, and ensure every product we offer is ethically sourced and sustainably made. From the cotton fields of Rajshahi to the weaving looms of Sylhet, every item in our collection tells a story of tradition, skill, and dedication.\n\nOur mission is simple — to bring beauty, quality, and soul into your everyday life while empowering the hands that create these treasures. When you choose Sundry Blossom, you\'re not just buying a product. You\'re becoming part of a story that spans generations, cultures, and borders.\n\nWe are committed to fair trade practices, environmental sustainability, and preserving the rich heritage of Bangladeshi craftsmanship. Every purchase directly supports the artisans and their families, helping preserve traditional skills for future generations.', 'stories/cta.jpeg', '2026-08-25 02:42:28', '2026-08-25 02:42:28');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `long_description` longtext COLLATE utf8mb4_unicode_ci,
  `highlights` json DEFAULT NULL,
  `style_guidance` json DEFAULT NULL,
  `partnerships` json DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `long_description`, `highlights`, `style_guidance`, `partnerships`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Legumes', 'legumes', 'Fresh and organic legumes sourced directly from local farms.', 'Our legumes are sourced directly from local farmers who use sustainable farming practices. We ensure the highest quality pulses and grains reach your table.\n\nFrom red lentils to chickpeas, every product is carefully selected, cleaned, and packaged to preserve freshness and nutritional value.', '[\"Red Lentils\", \"Chickpeas\", \"Black Gram\", \"Green Peas\", \"Mixed Pulses\"]', '[\"Buy in bulk for better value\", \"Store in airtight containers\", \"Check for uniform size and color\", \"Prefer organic options\", \"Rotate stock regularly\"]', '[\"Wholesale supply agreements\", \"Restaurant and hotel partnerships\", \"Custom packaging options\", \"Volume discounts available\", \"Farm-to-table collaboration\"]', 'products/legumes.jpeg', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(2, 'Cotton', 'cotton', 'Premium quality cotton products for everyday comfort.', 'Our cotton products are crafted from the finest natural fibers, ensuring softness and durability. We work with skilled artisans to bring you premium cotton goods.\n\nEach piece is made with care, combining traditional weaving techniques with modern design sensibilities.', '[\"Organic Cotton Fabrics\", \"Handwoven Textiles\", \"Cotton Home Linens\", \"Cotton Garment Fabrics\", \"Custom Dyeing Services\"]', '[\"Choose organic for sustainability\", \"Mix textures for depth\", \"Pair with natural materials\", \"Layer for warmth and style\", \"Care with gentle washing\"]', '[\"Fashion brand collaborations\", \"Interior design supply\", \"Bulk fabric orders\", \"Custom color development\", \"Sustainable sourcing programs\"]', 'products/cotton.jpeg', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(3, 'Garments', 'garments', 'Handcrafted garments with unique designs and patterns.', 'Our garment collection features handcrafted clothing that blends traditional artistry with contemporary fashion. Each piece tells a story of skilled craftsmanship.\n\nFrom casual wear to formal attire, our garments are designed for comfort and elegance.', '[\"Hand-stitched Apparel\", \"Embroidered Collections\", \"Casual Wear Line\", \"Formal Attire Range\", \"Seasonal Collections\"]', '[\"Layer with complementary pieces\", \"Accessorize thoughtfully\", \"Choose quality over quantity\", \"Invest in versatile staples\", \"Express personal style\"]', '[\"Boutique retail supply\", \"Online store partnerships\", \"Custom design services\", \"Bulk order discounts\", \"Private label manufacturing\"]', 'products/garments1.jpeg', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(4, 'Home Decor', 'home-decor', 'Beautiful home decor items to brighten your living space.', 'The biggest shift in home decor is a move toward spaces that feel warm, personal, and lived-in. We embrace warm minimalism with layered neutrals, natural materials, and spaces that prioritize emotional comfort.\n\nTransform any room with our carefully curated home decor products. We blend warm minimalism with functional design to create pieces that feel both beautiful and comfortable.', '[\"Handwoven rugs and floor mats\", \"Ceramic and terracotta pottery\", \"Wooden furniture accents\", \"Textured wall panels and hangings\", \"Natural fiber baskets and storage\"]', '[\"Mix textures for visual depth\", \"Layer neutrals with accent tones\", \"Balance open space with statement pieces\", \"Incorporate natural light and organic shapes\", \"Personal touches over showroom perfection\"]', '[\"Interior designer collaboration program\", \"Hotel and hospitality project supply\", \"Custom color and size options\", \"Volume discounts for project orders\", \"Showroom visits by appointment\"]', 'products/home-decor.jpeg', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(5, 'Accessories', 'accessories', 'Stylish accessories to complement your look.', 'Our accessories collection adds the perfect finishing touch to any outfit or space. Handcrafted with attention to detail, each piece is unique.\n\nFrom bags to jewelry, our accessories are designed to complement your personal style with artisan quality.', '[\"Handcrafted Bags\", \"Artisan Jewelry\", \"Woven Baskets\", \"Decorative Items\", \"Gift Collections\"]', '[\"Choose statement pieces wisely\", \"Mix materials for contrast\", \"Keep it minimal and elegant\", \"Match with your outfit palette\", \"Quality over quantity always\"]', '[\"Fashion accessory boutiques\", \"Gift shop distribution\", \"Custom branding available\", \"Wholesale pricing tiers\", \"Consignment opportunities\"]', 'products/accessories.jpeg', '2026-08-25 02:42:28', '2026-08-25 02:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Sundry Blossom', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(2, 'site_tagline', 'Handcrafted & Sustainable Goods', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(3, 'contact_phone', '+880 4767 775689', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(4, 'contact_phone_display', '04767775689', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(5, 'contact_email', 'sundryblossom@gmail.com', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(6, 'contact_hours', 'Mon - Fri, 9am - 6pm', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(7, 'contact_response_time', 'We reply within 24 hours', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28'),
(8, 'contact_address', 'Dhaka, Bangladesh', 'general', '2026-08-25 02:42:28', '2026-08-25 02:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Inoodex', 'hello@inoodex.com', '2026-08-25 02:42:27', '$2y$12$taF9A/x20kGyZKD3FyFlpOmZg8yZazqlY3N7/W5Xmca0SWYU38aO2', 'jnjDucAJKQleXby4W4lRcuceqP5cvBnNT0hoyOtMs52MbYXfKEeBSscjgBrc', '2026-08-25 02:42:28', '2026-08-25 02:42:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `hero_slides`
--
ALTER TABLE `hero_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `our_stories`
--
ALTER TABLE `our_stories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `our_stories_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_settings_key_unique` (`key`);

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
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero_slides`
--
ALTER TABLE `hero_slides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `our_stories`
--
ALTER TABLE `our_stories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
