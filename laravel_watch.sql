-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 04 2021 г., 12:56
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `laravel_watch`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_groups`
--

CREATE TABLE `attribute_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute_groups`
--

INSERT INTO `attribute_groups` (`id`, `title`) VALUES
(1, 'Механизм'),
(2, 'Стекло'),
(3, 'Ремешок'),
(4, 'Корпус'),
(5, 'Индикация');

-- --------------------------------------------------------

--
-- Структура таблицы `attribute_value`
--

CREATE TABLE `attribute_value` (
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attribute_group_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute_value`
--

INSERT INTO `attribute_value` (`id`, `value`, `attribute_group_id`) VALUES
(1, 'Механика с автоподзаводом', 1),
(2, 'Механика с ручным заводом', 1),
(3, 'Кварцевый от батарейки', 1),
(4, 'Кварцевый от солнечного аккумулятора', 1),
(5, 'Сапфировое', 2),
(6, 'Минеральное', 2),
(7, 'Полимерное', 2),
(8, 'Стальной', 3),
(9, 'Кожаный', 3),
(10, 'Каучуковый', 3),
(11, 'Полимерный', 3),
(12, 'Нержавеющая сталь', 4),
(13, 'Титановый сплав', 4),
(14, 'Латунь', 4),
(15, 'Полимер', 4),
(16, 'Керамика', 4),
(17, 'Алюминий', 4),
(18, 'Аналоговые', 5),
(19, 'Цифровые', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `attribute__products`
--

CREATE TABLE `attribute__products` (
  `id` int(10) UNSIGNED NOT NULL,
  `attr_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `product_id` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `attribute__products`
--

INSERT INTO `attribute__products` (`id`, `attr_id`, `product_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(6, 2, 8),
(7, 5, 1),
(8, 5, 2),
(9, 5, 3),
(10, 5, 4),
(13, 8, 1),
(14, 8, 2),
(15, 8, 3),
(16, 8, 4),
(18, 12, 1),
(19, 12, 2),
(20, 12, 3),
(21, 12, 4),
(23, 18, 1),
(24, 18, 2),
(25, 18, 4),
(27, 19, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `parent_id`, `description`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'Men', 'men', 0, 'Men', 'Men', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(2, 'Women', 'women', 0, 'Women', 'Women', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(3, 'Kids', 'kids', 0, 'Kids', 'Kids', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(4, 'Электронные', 'elektronnye', 1, 'Электронные', 'Электронные', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(5, 'Механические', 'mehanicheskie', 1, 'mehanicheskie', 'mehanicheskie', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(6, 'Casio', 'casio', 4, 'Casio', 'Casio', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(7, 'Citizen', 'citizen', 4, 'Citizen', 'Citizen', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(8, 'Royal London', 'royal-london', 5, 'Royal London', 'Royal London', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(9, 'Seiko', 'seiko', 5, 'Seiko', 'Seiko', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(10, 'Epos', 'epos', 12, 'Epos', 'Epos', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(11, 'Электронные', 'elektronnye-11', 2, 'Электронные', 'Электронные', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(12, 'Механические', 'mehanicheskie-12', 2, 'Механические', 'Механические', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(13, 'Adriatica', 'adriatica', 11, 'Adriatica', 'Adriatica', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(14, 'Anne Klein', 'anne-klein', 12, 'Anne Klein', 'Anne Klein', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(15, 'Тестовая категория!', 'testovaya-kategoriya', 0, '111', '222', '2021-04-15 05:46:01', '2021-04-15 05:46:01'),
(16, 'Тестовая категория2', 'testovaya-kategoriya2', 20, '111', '333', '2021-04-15 05:46:01', '2021-04-15 05:46:01');

-- --------------------------------------------------------

--
-- Структура таблицы `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol_left` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_right` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` decimal(6,2) NOT NULL,
  `base` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id`, `title`, `code`, `symbol_left`, `symbol_right`, `value`, `base`, `created_at`, `updated_at`) VALUES
(1, 'Гривна', 'UAH', '', ' грн.', '25.80', 0, NULL, NULL),
(2, 'Доллар', 'USD', '$ ', '', '1.00', 1, NULL, NULL),
(3, 'Евро', 'EUR', '€ ', '', '0.88', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `forgots`
--

CREATE TABLE `forgots` (
  `id` int(10) UNSIGNED NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_04_14_180836_alter_users_table_add_is_admin', 1),
(6, '2021_04_15_112720_create_categories_table', 2),
(8, '2021_04_16_184641_create_products_table', 3),
(9, '2021_04_20_162529_create_previews_table', 4),
(10, '2021_04_24_183502_create_currencies_table', 5),
(12, '2021_04_29_201352_create_orders_table', 6),
(13, '2021_04_29_203146_create_order_product_table', 7),
(14, '2021_03_23_194157_create_forgots_table', 8),
(15, '2021_05_01_180609_create_attribute_groups_table', 9),
(16, '2021_05_01_181024_create_attribute_value_table', 9),
(20, '2021_05_02_201337_create_attribute__products_table', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `phone`, `currency_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '8-921-974-54-75', 3, 'admin test', '2021-04-29 17:34:28', '2021-04-29 17:34:28'),
(2, 1, 0, '8-921-974-54-75', 3, 'admin test', '2021-04-29 17:36:34', '2021-04-29 17:36:34'),
(3, 1, 0, '8-921-974-54-75', 3, 'test', '2021-04-30 13:42:46', '2021-04-30 13:42:46'),
(4, 1, 0, '8-921-974-54-75', 3, 'test', '2021-05-01 07:56:45', '2021-05-01 07:56:45');

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

CREATE TABLE `order_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `qty`, `title`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 3, 'adipisci molestias', '86.51', '2021-04-29 17:34:29', '2021-04-29 17:34:29'),
(2, 1, 5, 1, 'vero et', '47.76', '2021-04-29 17:34:29', '2021-04-29 17:34:29'),
(3, 1, 2, 1, 'qui temporibus', '1.08', '2021-04-29 17:34:29', '2021-04-29 17:34:29'),
(4, 2, 4, 3, 'adipisci molestias', '86.51', '2021-04-29 17:36:34', '2021-04-29 17:36:34'),
(5, 2, 5, 1, 'vero et', '47.76', '2021-04-29 17:36:34', '2021-04-29 17:36:34'),
(6, 2, 2, 1, 'qui temporibus', '1.08', '2021-04-29 17:36:34', '2021-04-29 17:36:34'),
(7, 3, 1, 1, 'eos est', '51.25', '2021-04-30 13:42:47', '2021-04-30 13:42:47'),
(8, 4, 4, 1, 'adipisci molestias', '86.51', '2021-05-01 07:56:51', '2021-05-01 07:56:51'),
(9, 4, 5, 3, 'vero et', '47.76', '2021-05-01 07:56:52', '2021-05-01 07:56:52'),
(10, 4, 1, 1, 'eos est', '51.25', '2021-05-01 07:56:52', '2021-05-01 07:56:52');

-- --------------------------------------------------------

--
-- Структура таблицы `previews`
--

CREATE TABLE `previews` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `previews`
--

INSERT INTO `previews` (`id`, `product_id`, `img`) VALUES
(1, 1, 'http://placehold.it/762x1100/cccccc&text=Casio MRP'),
(2, 1, 'http://placehold.it/762x1100/cccccc&text=Casio MQ'),
(3, 1, 'http://placehold.it/762x1100/cccccc&text=Casio RT'),
(4, 2, 'http://placehold.it/762x1100/cccccc&text=Citizen BJ'),
(5, 2, 'http://placehold.it/762x1100/cccccc&text=Citizen FD'),
(6, 2, 'http://placehold.it/762x1100/cccccc&text=Citizen PC'),
(7, 3, 'http://placehold.it/762x1100/cccccc&text=Q&Q 95'),
(8, 3, 'http://placehold.it/762x1100/cccccc&text=Q&Q 67'),
(9, 3, 'http://placehold.it/762x1100/cccccc&text=Q&Q 45\r\n'),
(10, 4, 'http://placehold.it/762x1100/cccccc&text=Royal London 89'),
(11, 4, 'http://placehold.it/762x1100/cccccc&text=Royal London 41'),
(12, 4, 'http://placehold.it/762x1100/cccccc&text=Royal London 89'),
(13, 5, 'http://placehold.it/762x1100/cccccc&text=Rolex ASX'),
(14, 5, 'http://placehold.it/762x1100/cccccc&text=Rolex DFG'),
(15, 5, 'http://placehold.it/762x1100/cccccc&text=Rolex ERT'),
(16, 6, 'http://placehold.it/762x1100/cccccc&text=Breguet 67'),
(17, 6, 'http://placehold.it/762x1100/cccccc&text=Breguet 23'),
(18, 6, 'http://placehold.it/762x1100/cccccc&text=Breguet 89'),
(19, 7, 'http://placehold.it/762x1100/cccccc&text=Longines RT'),
(20, 7, 'http://placehold.it/762x1100/cccccc&text=Longines DF'),
(21, 7, 'http://placehold.it/762x1100/cccccc&text=Longines KL'),
(22, 8, 'http://placehold.it/762x1100/cccccc&text=Omega ZB'),
(23, 8, 'http://placehold.it/762x1100/cccccc&text=Omega CV'),
(24, 8, 'http://placehold.it/762x1100/cccccc&text=Omega FD'),
(25, 9, 'http://placehold.it/762x1100/cccccc&text=Vega HGJ'),
(26, 9, 'http://placehold.it/762x1100/cccccc&text=Vega RTY'),
(27, 9, 'http://placehold.it/762x1100/cccccc&text=Vega KLJ'),
(28, 10, 'http://placehold.it/762x1100/cccccc&text=Delta 56'),
(29, 10, 'http://placehold.it/762x1100/cccccc&text=Delta 23'),
(30, 10, 'http://placehold.it/762x1100/cccccc&text=Delta 22');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) UNSIGNED NOT NULL,
  `status` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `title`, `slug`, `content`, `price`, `status`, `img`, `created_at`, `updated_at`) VALUES
(1, 6, 'eos est', 'reprehenderit-quae-sed', 'Quo at optio culpa iure. Quia voluptatem in maxime distinctio facilis.', 58.24, 1, 'products/2021-03-04/p-1.png', '1989-08-16 17:45:23', '1982-06-01 20:53:18'),
(2, 6, 'qui temporibus', 'tenetur-ut-repudiandae-ut', 'Officia soluta et illo vitae quisquam assumenda vel. Ipsa ut non amet voluptas eos ipsam aut.', 1.23, 1, 'products/2021-03-04/p-2.png', '1998-07-03 01:46:42', '2002-07-11 11:11:11'),
(3, 6, 'aut est', 'sed-voluptate-sit-architecto', 'Possimus qui aliquam eos dolores vero culpa. Eum non impedit consequuntur quos.', 54.38, 1, 'products/2021-03-04/p-3.png', '2020-01-27 07:09:24', '1996-12-01 09:25:47'),
(4, 6, 'adipisci molestias', 'rerum-molestias-iste-nobis-aliquid', 'Quaerat eum molestiae aut cumque.', 98.31, 1, 'products/2021-03-04/p-4.png', '2007-01-04 19:16:08', '1998-03-12 14:22:20'),
(5, 14, 'vero et', 'et-omnis-quis-et-est', 'Non consequuntur nobis ipsam aut in iure dolorem.', 54.27, 1, 'products/2021-03-04/p-5.png', '2017-03-31 17:37:16', '1989-11-14 13:35:30'),
(6, 8, 'delectus fugiat', 'enim-expedita-accusantium-enim-nisi', 'Corporis libero possimus non harum aliquid dolor illo. Voluptate quasi nulla sit et.', 40.68, 1, 'products/2021-03-04/p-6.png', '1978-10-07 17:17:25', '2003-02-10 13:28:21'),
(7, 7, 'illum necessitatibus', 'tenetur-doloribus-vitae-necessitatibus', 'Autem corporis fugiat quia labore ab quod ipsa mollitia.', 84.61, 1, 'products/2021-03-04/p-7.png', '1986-04-22 13:23:36', '2014-04-15 23:14:41'),
(8, 6, 'tempore repellendus', 'autem-tenetur-sunt', 'Et atque illum sed atque minus omnis esse.', 43.88, 1, 'products/2021-03-04/p-8.png', '2016-10-28 14:54:27', '1994-05-15 18:47:00'),
(9, 6, 'sed eligendi', 'officia-ratione-repellat-quis', 'Nihil quo ratione nemo aut ipsum sed velit. Odit est voluptatem est sint earum officiis repudiandae.', 88.68, 1, 'products/2021-03-04/p-4.png', '1973-03-11 00:28:34', '2013-06-06 01:02:12'),
(10, 13, 'illum explicabo', 'sint-ab', 'Et molestias distinctio adipisci et quia recusandae tempora eos.', 10.13, 1, 'products/2021-03-04/p-5.png', '1979-09-26 20:59:09', '1982-04-15 09:29:47');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'admin', 'vov20a@mail.ru', NULL, '$2y$10$3jJieIGcsKstQ7RQ9i87Q.jSU6Zxa/0NQUC0P3o0WqVDE3ZaWq6dC', NULL, '2021-04-29 15:17:09', '2021-05-01 07:55:49', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attribute_groups`
--
ALTER TABLE `attribute_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_value_attr_group_id_index` (`attribute_group_id`);

--
-- Индексы таблицы `attribute__products`
--
ALTER TABLE `attribute__products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute__products_attr_id_index` (`attr_id`),
  ADD KEY `attribute__products_product_id_index` (`product_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_index` (`parent_id`);

--
-- Индексы таблицы `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forgots`
--
ALTER TABLE `forgots`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `previews`
--
ALTER TABLE `previews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previews_product_id_index` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attribute_groups`
--
ALTER TABLE `attribute_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `attribute__products`
--
ALTER TABLE `attribute__products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `forgots`
--
ALTER TABLE `forgots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `previews`
--
ALTER TABLE `previews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
