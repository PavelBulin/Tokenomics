-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 01 2022 г., 21:59
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `base_date`
--

CREATE TABLE `base_date` (
  `id` bigint UNSIGNED NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `base_date`
--

INSERT INTO `base_date` (`id`, `time`) VALUES
(1, 1656644400);

-- --------------------------------------------------------

--
-- Структура таблицы `base_sum`
--

CREATE TABLE `base_sum` (
  `id` bigint UNSIGNED NOT NULL,
  `sum` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `base_sum`
--

INSERT INTO `base_sum` (`id`, `sum`, `created_at`, `updated_at`) VALUES
(1, 300.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raund` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked` int NOT NULL DEFAULT '0',
  `unblocked` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `adress`, `raund`, `blocked`, `unblocked`, `created_at`, `updated_at`) VALUES
(9, 'Категория1', 'адрес1', '3', 0, 9, '2022-07-29 14:27:30', '2022-07-29 14:27:30'),
(11, 'Категория2', 'адрес2', '4', 0, 14, '2022-07-29 14:32:51', '2022-07-29 14:32:51'),
(31, 'new category', 'new address', '2', 1, 11, '2022-08-01 04:52:22', '2022-08-01 05:15:20');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_07_21_045445_create_users_table', 1),
(3, '2022_07_21_075358_create_categories_table', 1),
(4, '2022_07_21_075550_create_tokenomics_table', 1),
(5, '2022_07_27_063848_create_base_date_table', 1),
(7, '2022_08_01_133728_create_base_sum_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
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
-- Структура таблицы `tokenomics`
--

CREATE TABLE `tokenomics` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` int NOT NULL,
  `globalPercent` double(8,2) NOT NULL DEFAULT '1.00',
  `1Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `2Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `3Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `4Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `5Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `6Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `7Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `8Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `9Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `10Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `11Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `12Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `13Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `14Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `15Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `16Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `17Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `18Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `19Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `20Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `21Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `22Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `23Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `24Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `25Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `26Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `27Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `28Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `29Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `30Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `31Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `32Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `33Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `34Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `35Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `36Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `37Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `38Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `39Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `40Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `41Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `42Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `43Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `44Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `45Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `46Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `47Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `48Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `49Mo` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tokenomics`
--

INSERT INTO `tokenomics` (`id`, `category_id`, `globalPercent`, `1Mo`, `2Mo`, `3Mo`, `4Mo`, `5Mo`, `6Mo`, `7Mo`, `8Mo`, `9Mo`, `10Mo`, `11Mo`, `12Mo`, `13Mo`, `14Mo`, `15Mo`, `16Mo`, `17Mo`, `18Mo`, `19Mo`, `20Mo`, `21Mo`, `22Mo`, `23Mo`, `24Mo`, `25Mo`, `26Mo`, `27Mo`, `28Mo`, `29Mo`, `30Mo`, `31Mo`, `32Mo`, `33Mo`, `34Mo`, `35Mo`, `36Mo`, `37Mo`, `38Mo`, `39Mo`, `40Mo`, `41Mo`, `42Mo`, `43Mo`, `44Mo`, `45Mo`, `46Mo`, `47Mo`, `48Mo`, `49Mo`, `created_at`, `updated_at`) VALUES
(8, 9, 0.15, 0.10, 0.10, 0.10, 0.10, 0.10, 0.10, 0.10, 0.10, 0.10, 0.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2022-07-29 14:27:31', '2022-07-29 14:27:31'),
(10, 11, 0.25, 0.08, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.07, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2022-07-29 14:32:51', '2022-07-30 04:39:01'),
(18, 31, 0.05, 0.00, 0.20, 0.20, 0.20, 0.20, 0.03, 0.03, 0.03, 0.03, 0.03, 0.03, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '2022-08-01 04:52:22', '2022-08-01 05:15:20');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `remember_token`, `google_id`, `created_at`, `updated_at`) VALUES
(1, 'Павел Булин', 'test@test', '$2y$10$x6yz/I.6fdiXs2KLUBrgWOqTdmI8ssA6JnDUy/E7x2LlSUOh51cnO', 'user', NULL, NULL, '2022-07-28 09:15:09', '2022-07-28 09:15:09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `base_date`
--
ALTER TABLE `base_date`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `base_sum`
--
ALTER TABLE `base_sum`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `tokenomics`
--
ALTER TABLE `tokenomics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `base_date`
--
ALTER TABLE `base_date`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `base_sum`
--
ALTER TABLE `base_sum`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tokenomics`
--
ALTER TABLE `tokenomics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
