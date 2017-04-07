-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Kwi 2017, 18:49
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `social`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `saved`
--

CREATE TABLE `saved` (
  `idsave` int(11) NOT NULL,
  `name_save` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `url` text COLLATE utf8_polish_ci NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `saved`
--

INSERT INTO `saved` (`idsave`, `name_save`, `url`, `iduser`) VALUES
(1, 'Portfolio', 'http://patrykfilipiak.pl/', 2),
(2, 'Fejs', 'https://www.facebook.com/', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sites`
--

CREATE TABLE `sites` (
  `idsite` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `type` int(11) NOT NULL,
  `admin` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `type_site`
--

CREATE TABLE `type_site` (
  `id` int(11) NOT NULL,
  `name_type` varchar(50) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `type_site`
--

INSERT INTO `type_site` (`id`, `name_type`) VALUES
(1, 'Firma'),
(2, 'Organizacja'),
(3, 'Marka'),
(4, 'Produkt'),
(5, 'Artysta'),
(6, 'Zespół');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `birth` date NOT NULL,
  `home` varchar(100) COLLATE utf8_polish_ci DEFAULT NULL,
  `work` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `school` varchar(200) COLLATE utf8_polish_ci DEFAULT NULL,
  `phone` varchar(9) COLLATE utf8_polish_ci DEFAULT NULL,
  `about` text COLLATE utf8_polish_ci,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `birth`, `home`, `work`, `school`, `phone`, `about`, `status`) VALUES
(1, 'Patryk', 'Filipiak', 'thepatrykooo@gmail.com', '$2y$10$DT5USNr67/gHAGrxGQj8ueoXUl4QwsO1mX0pkgiTYYNrve7WMc45O', '2000-01-02', 'Explorer', 'Programista HTML', 'ILO ILO', '736657933', 'Jestem Patryk kappa Programista HTML Kappa', 0),
(2, 'Jan', 'Kowalski', 'patrykowegry1@gmail.com', '$2y$10$JXxHaIaPHxItellEklmpFebmZ5zQaVPKQTgehzLmqQ3ZrCXQYj7xO', '1999-02-23', NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `saved`
--
ALTER TABLE `saved`
  ADD PRIMARY KEY (`idsave`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`idsite`);

--
-- Indexes for table `type_site`
--
ALTER TABLE `type_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `saved`
--
ALTER TABLE `saved`
  MODIFY `idsave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `sites`
--
ALTER TABLE `sites`
  MODIFY `idsite` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `type_site`
--
ALTER TABLE `type_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
