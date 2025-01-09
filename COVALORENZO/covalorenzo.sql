-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 09, 2025 alle 12:16
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covalorenzo`
--
CREATE DATABASE IF NOT EXISTS `covalorenzo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covalorenzo`;

-- --------------------------------------------------------

--
-- Struttura della tabella `rappresentante`
--

CREATE TABLE `rappresentante` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `ultimo_fatturato` decimal(10,2) NOT NULL,
  `regione` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `percentuale_provvigione` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `rappresentante`
--

INSERT INTO `rappresentante` (`id`, `nome`, `cognome`, `ultimo_fatturato`, `regione`, `provincia`, `percentuale_provvigione`) VALUES
(1, 'Mario', 'Rossi', 10000.50, 'Lombardia', 'Milano', 5.50),
(2, 'Luigi', 'Verdi', 20000.75, 'Lazio', 'Roma', 7.00),
(3, 'Anna', 'Bianchi', 15000.00, 'Veneto', 'Venezia', 6.50),
(4, 'Paolo', 'Neri', 12000.25, 'Sicilia', 'Palermo', 5.00),
(5, 'Sara', 'Blu', 18000.80, 'Campania', 'Napoli', 6.00);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `rappresentante`
--
ALTER TABLE `rappresentante`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `rappresentante`
--
ALTER TABLE `rappresentante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
