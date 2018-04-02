-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Kwi 2018, 08:34
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `firma`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id_pracownika` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `stanowisko` text COLLATE utf8_polish_ci NOT NULL,
  `pensja` float NOT NULL,
  `data_zatrudnienia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id_pracownika`, `imie`, `nazwisko`, `stanowisko`, `pensja`, `data_zatrudnienia`) VALUES
(1, 'Franciszek', 'Janowski', 'developer', 2500, '2018-03-11'),
(2, 'Maria', 'Kowalska', 'developer', 3200, '2016-04-22'),
(3, 'Anna', 'Zalewska', 'developer', 3100, '2016-07-02'),
(4, 'Marek', 'Nowak', 'developer', 2800, '2017-09-13'),
(5, 'Adam', 'Kowalski', 'developer', 3000, '2018-01-23'),
(6, 'Krzysztof', 'Rutkowski', 'developer', 3200, '2017-03-28'),
(7, 'Krystyna', 'Pawłowicz', 'developer', 2600, '2017-11-18'),
(8, 'Antoni', 'Macierewicz', 'developer', 2900, '2017-07-11');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `projekty`
--

CREATE TABLE `projekty` (
  `id_projektu` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `data_rozpoczecia` date NOT NULL,
  `data_zakonczenia` date NOT NULL,
  `koszt` float NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `procent_wykonania` int(11) NOT NULL,
  `kierownik` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `projekty`
--

INSERT INTO `projekty` (`id_projektu`, `nazwa`, `data_rozpoczecia`, `data_zakonczenia`, `koszt`, `opis`, `procent_wykonania`, `kierownik`) VALUES
(1, 'p1', '2016-06-03', '2016-09-07', 40000, 'Pierwszy projekt.', 100, 'Maria Kowalska'),
(2, 'p2', '2016-10-05', '2017-01-24', 50000, 'Drugi projekt.', 100, 'Anna Zalewska'),
(3, 'p3', '2017-02-11', '2017-05-08', 45000, 'Trzeci projekt.', 100, 'Maria Kowalska'),
(4, 'p4', '2017-05-16', '2017-07-18', 30000, 'Czwarty projekt.', 100, 'Krzysztof Rutkowski'),
(5, 'p5', '2017-07-19', '2017-09-03', 35000, 'Piąty projekt.', 100, 'Anna Zalewska'),
(6, 'p6', '2017-09-23', '2017-11-07', 42000, 'Szósty projekt.', 100, 'Maria Kowalska'),
(7, 'p7', '2017-10-17', '2018-01-05', 43000, 'Siódmy projekt.', 100, 'Krzysztof Rutkowski'),
(8, 'p8', '2018-01-14', '2018-03-22', 55000, 'Ósmy projekt.', 100, 'Maria Kowalska'),
(9, 'p9', '2018-03-08', '2018-05-12', 51000, 'Dziewiąty projekt.', 48, 'Anna Zalweska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczestnicy`
--

CREATE TABLE `uczestnicy` (
  `id_pracownika` int(11) NOT NULL,
  `id_projektu` int(11) NOT NULL,
  `funkcja` text COLLATE utf8_polish_ci NOT NULL,
  `premia` int(11) NOT NULL,
  `ocena` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uczestnicy`
--

INSERT INTO `uczestnicy` (`id_pracownika`, `id_projektu`, `funkcja`, `premia`, `ocena`) VALUES
(1, 9, 'developer', 0, 8),
(2, 1, 'kierownik', 800, 8.5),
(2, 2, 'developer', 900, 9),
(2, 3, 'kierownik', 1400, 9.5),
(2, 4, 'developer', 1200, 9),
(2, 5, 'developer', 1600, 9),
(2, 6, 'kierownik', 1800, 9),
(2, 7, 'developer', 1800, 9),
(2, 8, 'kierownik', 2000, 9),
(2, 9, 'developer', 0, 9.5),
(3, 1, 'developer', 600, 7.5),
(3, 2, 'kierownik', 1200, 9),
(3, 3, 'developer', 1000, 8.5),
(3, 4, 'developer', 1000, 9),
(3, 5, 'kierownik', 1800, 9.5),
(3, 6, 'developer', 1500, 8.5),
(3, 7, 'developer', 1700, 8.5),
(3, 8, 'developer', 1900, 9),
(3, 9, 'kierownik', 0, 9.5),
(4, 6, 'developer', 700, 7.5),
(4, 7, 'developer', 900, 8),
(4, 8, 'developer', 1400, 9),
(4, 9, 'developer', 0, 8),
(5, 8, 'developer', 800, 9),
(5, 9, 'developer', 0, 8.5),
(6, 3, 'developer', 500, 7),
(6, 4, 'kierownik', 1200, 8),
(6, 5, 'developer', 1500, 9),
(6, 6, 'developer', 1500, 9),
(6, 7, 'kierownik', 2000, 9.5),
(6, 8, 'developer', 1800, 9),
(6, 9, 'developer', 0, 9.5),
(7, 7, 'developer', 400, 6),
(7, 8, 'developer', 700, 9),
(7, 9, 'developer', 0, 8),
(8, 5, 'developer', 600, 6),
(8, 6, 'developer', 500, 7),
(8, 7, 'developer', 600, 7),
(8, 8, 'developer', 800, 9),
(8, 9, 'developer', 0, 8.5);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id_pracownika`);

--
-- Indexes for table `projekty`
--
ALTER TABLE `projekty`
  ADD PRIMARY KEY (`id_projektu`);

--
-- Indexes for table `uczestnicy`
--
ALTER TABLE `uczestnicy`
  ADD PRIMARY KEY (`id_pracownika`,`id_projektu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `projekty`
--
ALTER TABLE `projekty`
  MODIFY `id_projektu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
