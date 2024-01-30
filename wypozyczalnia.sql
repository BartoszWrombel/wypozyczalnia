-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 27, 2024 at 06:35 AM
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

--
-- Dumping data for table `klient`
--

INSERT INTO `klient` (`id_klient`, `imie`, `nazwisko`, `pesel`) VALUES
(1, 'Jan', 'Kowalski', '12345678901'),
(2, 'Anna', 'Nowak', '98765432109'),
(3, 'Piotr', 'Wiśniewski', '56789012345'),
(4, 'Katarzyna', 'Dąbrowska', '10987654321'),
(5, 'Marcin', 'Lewandowski', '23456789012'),
(6, 'Karolina', 'Kaczmarek', '34567890123'),
(7, 'Adam', 'Szymański', '89012345678'),
(8, 'Ewa', 'Wójcik', '45678901234'),
(9, 'Michał', 'Kamiński', '67890123456'),
(10, 'Natalia', 'Zając', '01234567890');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `samochod`
--

CREATE TABLE `samochod` (
  `id_samochod` int(11) NOT NULL,
  `marka` varchar(100) NOT NULL,
  `model` varchar(100) DEFAULT NULL,
  `kolor` varchar(50) NOT NULL,
  `numer_rejestracyjny` varchar(20) NOT NULL,
  `rok_produkcji` year(4) NOT NULL,
  `cena_za_dzien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `samochod`
--

INSERT INTO `samochod` (`id_samochod`, `marka`, `model`, `kolor`, `numer_rejestracyjny`, `rok_produkcji`, `cena_za_dzien`) VALUES
(1, 'Toyota', 'Corolla', 'Czerwony', 'ABC123', '2020', 150.00),
(2, 'Volkswagen', 'Golf', 'Niebieski', 'XYZ789', '2018', 120.50),
(3, 'Ford', 'Focus', 'Czarny', 'DEF456', '2019', 130.75),
(4, 'Opel', 'Astra', 'Biały', 'GHI789', '2021', 160.00),
(5, 'Renault', 'Megane', 'Srebrny', 'JKL012', '2017', 110.25),
(6, 'BMW', 'X5', 'Czarny', 'MNO345', '2022', 200.00),
(7, 'Mercedes', 'A-Class', 'Biały', 'PQR678', '2019', 140.50),
(8, 'Audi', 'A3', 'Czerwony', 'STU901', '2020', 155.50),
(9, 'Kia', 'Sportage', 'Zielony', 'VWX234', '2021', 170.25),
(10, 'Hyundai', 'Tucson', 'Szary', 'YZA567', '2018', 125.75);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uprawnienia`
--

CREATE TABLE `uprawnienia` (
  `id_uprawnienia` int(11) NOT NULL,
  `nazwa_uprawnienia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uprawnienia`
--

INSERT INTO `uprawnienia` (`id_uprawnienia`, `nazwa_uprawnienia`) VALUES
(1, 'Administrator'),
(2, 'Kierownik'),
(3, 'Pracownik');

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
  `utworzone` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `login`, `haslo`, `email`, `id_uprawnienia`, `utworzone`) VALUES
(1, 'admin', '$2y$10$xfIwkQ9pcBv5eEKB.NFwaukZRQ8b4MDbs/2Vx0brcJdz89hJr6sqy', 'admin@gmail.com', 1, '2024-01-25 13:07:23'),
(2, 'pracownik', '$2y$10$1rqBcG2f/AmpYZZBOP/66ebDEalNjnFKjwH/kflrwBqLEtNh1hS0K', 'pracownik@gmail.com', 3, '2024-01-26 22:19:28'),
(3, 'kierownik', '$2y$10$hHgJKVR1vR95HkiVJe1ERO5gQqx5FdIuFzKpc2lpoOAjpNqscW44q', 'kierownik@gmail.com', 2, '2024-01-26 22:20:31');

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
  `koszt_calkowity` decimal(10,2) DEFAULT NULL,
  `uwagi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id_wypozyczenia`, `id_klient`, `id_samochod`, `data_wypozyczenia`, `data_zwrotu`, `koszt_calkowity`, `uwagi`) VALUES
(1, 1, 1, '2022-01-10', '2022-01-15', 700.00, 'Brak uwag'),
(2, 2, 3, '2022-02-05', '2022-02-10', 500.50, 'Brak uwag'),
(3, 3, 5, '2022-03-20', '2022-03-25', 600.75, 'Uwaga: Mniej paliwa po ostatnim kliencie'),
(4, 4, 2, '2022-04-15', '2022-04-20', 450.00, 'Brak uwag'),
(5, 5, 4, '2022-05-01', '2022-05-05', 520.25, 'Uwaga: Drobne rysy'),
(6, 6, 7, '2022-06-18', '2022-06-25', 900.00, 'Brak uwag'),
(7, 7, 8, '2022-07-10', '2022-07-15', 620.50, 'Uwaga: Problemy z klimatyzacją'),
(8, 8, 9, '2022-08-05', '2022-08-10', 550.75, 'Brak uwag'),
(9, 9, 6, '2022-09-12', '2022-09-18', 800.00, 'Brak uwag'),
(10, 10, 10, '2022-10-22', '2022-10-28', 670.25, 'Brak uwag'),
(11, 5, 4, '2024-05-01', '2024-05-08', 1120.00, ''),
(12, 8, 6, '2024-05-05', '2024-05-08', 600.00, ''),
(13, 6, 6, '2024-05-09', '2024-05-10', 200.00, ''),
(14, 10, 6, '2024-05-11', '2024-05-12', 200.00, '');

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
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `samochod`
--
ALTER TABLE `samochod`
  MODIFY `id_samochod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `uprawnienia`
--
ALTER TABLE `uprawnienia`
  MODIFY `id_uprawnienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id_wypozyczenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
