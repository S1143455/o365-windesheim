-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 dec 2019 om 16:12
-- Serverversie: 10.4.8-MariaDB
-- PHP-versie: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omasbeste`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `newslettercontent`
--

DROP TABLE IF EXISTS `newslettercontent`;
CREATE TABLE `newslettercontent` (
  `NewsletterContentID` int(11) NOT NULL,
  `NewsletterID` int(11) NOT NULL,
  `NewsletterTitle` varchar(255) NOT NULL,
  `NewsletterContent` longblob NOT NULL,
  `NewsletterContentCreatedBy` int(11) NOT NULL,
  `NewsletterContentLastEditedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `NewsletterID` int(10) NOT NULL,
  `NewsletterCreated` date NOT NULL,
  `NewsletterSend` date DEFAULT NULL,
  `NewsletterCreatedBy` int(10) NOT NULL,
  `NewsletterLasteditedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `newslettercontent`
--
ALTER TABLE `newslettercontent`
  ADD PRIMARY KEY (`NewsletterContentID`);

--
-- Indexen voor tabel `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`NewsletterID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `newslettercontent`
--
ALTER TABLE `newslettercontent`
  MODIFY `NewsletterContentID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
