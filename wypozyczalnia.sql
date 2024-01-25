-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 24, 2024 at 11:24 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wypozyczalnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id_klient` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `pesel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochod`
--

CREATE TABLE `samochod` (
  `id_samochod` int(11) NOT NULL,
  `marka` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `wariant` varchar(100) NOT NULL,
  `kolor` varchar(50) NOT NULL,
  `numer_rejestracyjny` varchar(20) NOT NULL,
  `rok_produkcji` year(4) NOT NULL,
  `cena_za_dzien` decimal(10,2) NOT NULL,
  `status_samochodu` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `id_uprawnienia` int(11) NOT NULL,
  `nazwa_uprawnienia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_uprawnienia` int(11) NOT NULL,
  `utworzone` timestamp NOT NULL DEFAULT current_timestamp(),
  `ostatnie_logowanie` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id_wypozyczenia` int(11) NOT NULL,
  `id_klient` int(11) NOT NULL,
  `id_samochod` int(11) NOT NULL,
  `data_wypozyczenia` date NOT NULL,
  `data_zwrotu` date NOT NULL,
  `uwagi` text NOT NULL,
  `status_wypozyczenia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id_klient`),
  ADD UNIQUE KEY `pesel` (`pesel`);

--
-- Indeksy dla tabeli `samochod`
--
ALTER TABLE `samochod`
  ADD PRIMARY KEY (`id_samochod`),
  ADD UNIQUE KEY `numer_rejestracyjny` (`numer_rejestracyjny`);

--
-- Indeksy dla tabeli `uprawnienia`
--
ALTER TABLE `uprawnienia`
  ADD PRIMARY KEY (`id_uprawnienia`),
  ADD UNIQUE KEY `nazwa_uprawnienia` (`nazwa_uprawnienia`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `haslo` (`haslo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_id_uprawnienia` (`id_uprawnienia`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id_wypozyczenia`),
  ADD KEY `fk_wypozyczenia_id_klient` (`id_klient`),
  ADD KEY `fk_wypozyczenia_id_samochod` (`id_samochod`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `samochod`
--
ALTER TABLE `samochod`
  MODIFY `id_samochod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `id_uprawnienia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id_wypozyczenia` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_id_uprawnienia` FOREIGN KEY (`id_uprawnienia`) REFERENCES `uprawnienia` (`id_uprawnienia`);

--
-- Constraints for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `fk_wypozyczenia_id_klient` FOREIGN KEY (`id_klient`) REFERENCES `klient` (`id_klient`),
  ADD CONSTRAINT `fk_wypozyczenia_id_samochod` FOREIGN KEY (`id_samochod`) REFERENCES `samochod` (`id_samochod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
