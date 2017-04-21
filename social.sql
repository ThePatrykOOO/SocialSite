-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Kwi 2017, 18:41
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
-- Struktura tabeli dla tabeli `commentpost`
--

CREATE TABLE `commentpost` (
  `id` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `idAutor` int(11) NOT NULL,
  `comment` varchar(500) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `commentpost`
--

INSERT INTO `commentpost` (`id`, `idpost`, `idAutor`, `comment`) VALUES
(1, 6, 1, 'No witam witam'),
(2, 3, 1, 'Siema');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `friendrequest`
--

CREATE TABLE `friendrequest` (
  `id` int(11) NOT NULL,
  `fromUser` int(11) NOT NULL,
  `toUser` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `friendrequest`
--

INSERT INTO `friendrequest` (`id`, `fromUser`, `toUser`, `status`) VALUES
(9, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `nameGroup` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `admin` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `nameGroup`, `admin`, `status`) VALUES
(1, 'Grupa fanów Kappy', 1, 2),
(4, 'Grupa Fanów HTMLa', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likepost`
--

CREATE TABLE `likepost` (
  `id` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `idperson` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `likepost`
--

INSERT INTO `likepost` (`id`, `idpost`, `idperson`, `status`) VALUES
(24, 38, 2, 1),
(36, 35, 1, 1),
(92, 4, 1, 0),
(93, 39, 1, 1),
(94, 1, 1, 0),
(95, 3, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `likesite`
--

CREATE TABLE `likesite` (
  `id` int(11) NOT NULL,
  `idsite` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `membersgroup`
--

CREATE TABLE `membersgroup` (
  `id` int(11) NOT NULL,
  `idgroup` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `membersgroup`
--

INSERT INTO `membersgroup` (`id`, `idgroup`, `iduser`) VALUES
(2, 1, 1),
(9, 1, 2),
(12, 4, 1),
(13, 4, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fromUser` int(11) NOT NULL,
  `toUser` int(11) NOT NULL,
  `text` varchar(1000) COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `fromUser`, `toUser`, `text`, `data`) VALUES
(1, 2, 1, 'trucate', '2017-04-18 18:19:03'),
(2, 2, 1, 'tak trochę był', '2017-04-18 18:19:09'),
(3, 2, 1, 'siema', '2017-04-19 20:44:06'),
(4, 1, 2, 'no witam', '2017-04-19 20:44:19'),
(5, 1, 2, 'witam', '2017-04-20 17:40:37');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `typeAutor` int(11) NOT NULL,
  `idtype` int(11) DEFAULT NULL,
  `idAutor` int(11) NOT NULL,
  `text` varchar(3000) COLLATE utf8_polish_ci NOT NULL,
  `data` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `typeAutor`, `idtype`, `idAutor`, `text`, `data`, `status`) VALUES
(1, 1, NULL, 1, 'Pierwszy Post w Social Site', '2017-04-14 09:27:05', 1),
(2, 3, 1, 1, 'Elo siema grupa', '2017-04-14 22:10:13', 1),
(3, 3, 1, 1, 'Drugi post na grupie Kappa', '2017-04-14 22:22:09', 1),
(4, 2, 2, 1, 'PHP Tutorials echo;', '2017-04-14 22:32:43', 1);

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
(1, 'Portfolio', 'http://patrykfilipiak.pl/', 2);

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

--
-- Zrzut danych tabeli `sites`
--

INSERT INTO `sites` (`idsite`, `name`, `description`, `type`, `admin`, `status`) VALUES
(1, 'Social Site', 'Fanpage tej strony. Witamy u nas :)', 1, 2, 1),
(2, 'PHP SQL Tutorials', 'Pokazuje tutaj tutoriale na temat języka PHP i SQL', 2, 1, 1);

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
(1, 'Patryk', 'Filipiak', 'thepatrykooo@gmail.com', '$2y$10$su3aFsr6aSeLFm54CLOfS.LGEy9JrgaLw4mlzNXmWDBXgpGpJwyWq', '2000-01-02', 'Explorer', 'Programista Brainfuck', 'ILO ILO', '73665', 'Jestem Patryk kappa Programista HTML Kappa', 0),
(2, 'Jan', 'Kowalski', 'patrykowegry1@gmail.com', '$2y$10$JXxHaIaPHxItellEklmpFebmZ5zQaVPKQTgehzLmqQ3ZrCXQYj7xO', '1999-02-23', NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `commentpost`
--
ALTER TABLE `commentpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likepost`
--
ALTER TABLE `likepost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likesite`
--
ALTER TABLE `likesite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membersgroup`
--
ALTER TABLE `membersgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT dla tabeli `commentpost`
--
ALTER TABLE `commentpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `friendrequest`
--
ALTER TABLE `friendrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `likepost`
--
ALTER TABLE `likepost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT dla tabeli `likesite`
--
ALTER TABLE `likesite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `membersgroup`
--
ALTER TABLE `membersgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `saved`
--
ALTER TABLE `saved`
  MODIFY `idsave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `sites`
--
ALTER TABLE `sites`
  MODIFY `idsite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
