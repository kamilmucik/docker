-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Czas generowania: 14 Paź 2020, 19:57
-- Wersja serwera: 8.0.19
-- Wersja PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklepy_e_strix_com`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` bigint NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_group_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_group`
--

CREATE TABLE `category_group` (
  `id` bigint NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `collector`
--

CREATE TABLE `collector` (
  `id` bigint NOT NULL,
  `number` varchar(50) NOT NULL,
  `session_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `printer`
--

CREATE TABLE `printer` (
  `id` bigint NOT NULL,
  `active` bit(1) NOT NULL,
  `is_default` bit(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `print_file`
--

CREATE TABLE `print_file` (
  `id` bigint NOT NULL,
  `active` bit(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `setting`
--

CREATE TABLE `setting` (
  `id` bigint NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `value` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `setting`
--

INSERT INTO `setting` (`id`, `name`, `value`) VALUES
(1, 'path', 'C://temp/'),
(2, 'hour', '02:00'),
(3, 'doBackup', '1'),
(4, 'tempDirectory', 'C:/temp/');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipment`
--

CREATE TABLE `shipment` (
  `id` bigint NOT NULL,
  `active` bit(1) NOT NULL,
  `_groups` int NOT NULL DEFAULT '1',
  `number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipment_event`
--

CREATE TABLE `shipment_event` (
  `id` bigint NOT NULL,
  `collector_id` bigint DEFAULT NULL,
  `_description` varchar(256) DEFAULT NULL,
  `last_update` varchar(255) DEFAULT NULL,
  `shipment_number` varchar(256) DEFAULT NULL,
  `user_name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipment_product`
--

CREATE TABLE `shipment_product` (
  `id` bigint NOT NULL,
  `art_number` bigint DEFAULT NULL,
  `art_return` varchar(50) DEFAULT NULL,
  `art_volume` double DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `counter` bigint DEFAULT NULL,
  `ean` varchar(4096) DEFAULT NULL,
  `last_update` varchar(255) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `scan_correct` int DEFAULT '0',
  `scan_error` int DEFAULT '0',
  `scan_label` int DEFAULT '0',
  `shipment_id` bigint DEFAULT NULL,
  `weight` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `shipment_product_shop`
--

CREATE TABLE `shipment_product_shop` (
  `id` bigint NOT NULL,
  `art_number` bigint DEFAULT NULL,
  `art_return` varchar(50) DEFAULT NULL,
  `product_id` bigint DEFAULT NULL,
  `recognition_counter` bigint DEFAULT NULL,
  `recognition_number` bigint DEFAULT NULL,
  `scan_correct` int DEFAULT '0',
  `scan_error` int DEFAULT '0',
  `scan_label` int DEFAULT '0',
  `ship_number` bigint DEFAULT NULL,
  `shop_number` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_enabled` bit(1) DEFAULT b'0',
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `is_locked` bit(1) DEFAULT b'0',
  `password` varchar(80) DEFAULT NULL,
  `role_name` varchar(20) DEFAULT NULL,
  `is_subscribed` bit(1) DEFAULT b'0',
  `verificationKey` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `email`, `is_enabled`, `first_name`, `last_name`, `is_locked`, `password`, `role_name`, `is_subscribed`, `verificationKey`) VALUES
(1, 'user@estrix.pl', b'1', 'user', 'github', b'0', '36767690feffd782e729ae821dff3355dda8ad40896263c007ad5a372cac7edc6da6cefca1bcdb11', 'ROLE_USER', b'0', NULL),
(2, 'admin@estrix.pl', b'1', 'admin', 'github', b'0', '36767690feffd782e729ae821dff3355dda8ad40896263c007ad5a372cac7edc6da6cefca1bcdb11', 'ROLE_ADMIN', b'0', NULL),
(3, 'superuser@estrix.pl', b'1', 'superuser', 'github', b'0', '36767690feffd782e729ae821dff3355dda8ad40896263c007ad5a372cac7edc6da6cefca1bcdb11', 'ROLE_SUPERUSER', b'0', NULL),
(4, 'operator@estrix.pl', b'1', 'operator', 'github', b'0', '36767690feffd782e729ae821dff3355dda8ad40896263c007ad5a372cac7edc6da6cefca1bcdb11', 'ROLE_SCANER_OPERATOR', b'0', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKmxd8tydhahlu5f4w8i7jik6j7` (`category_group_id`);

--
-- Indeksy dla tabeli `category_group`
--
ALTER TABLE `category_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `collector`
--
ALTER TABLE `collector`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UKln0yq5axuyimrntn5pel05uiy` (`number`);

--
-- Indeksy dla tabeli `printer`
--
ALTER TABLE `printer`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `print_file`
--
ALTER TABLE `print_file`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UKr6v12o33phn8pcwlmr76n4h3s` (`number`);

--
-- Indeksy dla tabeli `shipment_event`
--
ALTER TABLE `shipment_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `shipment_product`
--
ALTER TABLE `shipment_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `shipment_product_shop`
--
ALTER TABLE `shipment_product_shop`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uidx_user_email` (`email`),
  ADD UNIQUE KEY `uidx_verification_key` (`verificationKey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `category_group`
--
ALTER TABLE `category_group`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `collector`
--
ALTER TABLE `collector`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `printer`
--
ALTER TABLE `printer`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `print_file`
--
ALTER TABLE `print_file`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `shipment_event`
--
ALTER TABLE `shipment_event`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `shipment_product`
--
ALTER TABLE `shipment_product`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `shipment_product_shop`
--
ALTER TABLE `shipment_product_shop`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FKmxd8tydhahlu5f4w8i7jik6j7` FOREIGN KEY (`category_group_id`) REFERENCES `category_group` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
