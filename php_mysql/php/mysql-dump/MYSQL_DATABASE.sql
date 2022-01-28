-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Czas generowania: 28 Sty 2022, 06:31
-- Wersja serwera: 8.0.28
-- Wersja PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `MYSQL_DATABASE`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `exercise`
--

CREATE TABLE `exercise` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image_base64` varchar(2048) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `exercise`
--

INSERT INTO `exercise` (`id`, `name`, `description`, `image_base64`) VALUES
(1, 'pompki', '5x 20 na biurku', ''),
(2, 'skłon', 'opis skłonu', 'obrazek skłony'),
(3, 'lezenie', '', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `profile`
--

INSERT INTO `profile` (`id`, `name`) VALUES
(1, 'Dom: 1'),
(2, 'Dom: 2'),
(3, 'Dom: 3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `profile_exercise`
--

CREATE TABLE `profile_exercise` (
  `id` int NOT NULL,
  `profile_id` int NOT NULL,
  `exercise_id` int NOT NULL,
  `is_done` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Zrzut danych tabeli `profile_exercise`
--

INSERT INTO `profile_exercise` (`id`, `profile_id`, `exercise_id`, `is_done`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0),
(6, 3, 2, 1),
(5, 3, 1, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `profile_exercise`
--
ALTER TABLE `profile_exercise`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `profile_exercise`
--
ALTER TABLE `profile_exercise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
