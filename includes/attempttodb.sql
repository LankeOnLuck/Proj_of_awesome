-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 09 jun 2014 kl 19:38
-- Serverversion: 5.5.16
-- PHP-version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `attempttodb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `summary_id` int(11) NOT NULL,
  `author_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `summary-id` (`summary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `date`, `content`, `summary_id`, `author_name`) VALUES
(1, '2014-06-08 20:00:00', 'stuff', 2, 'Beuford'),
(2, '2014-06-08 21:53:35', 'pyhi', 2, 'iuogi'),
(3, '2014-06-08 21:53:44', 'hreaaehrreh', 2, 'herherreah'),
(4, '2014-06-09 00:45:54', 'Ã¥Ã¤Ã¶', 2, 'Ã¥Ã¤Ã¶'),
(5, '2014-06-09 13:42:58', 'hrzhrh', 5, 'rszhrhzrh');

-- --------------------------------------------------------

--
-- Tabellstruktur `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=17 ;

--
-- Dumpning av Data i tabell `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Engelska'),
(2, 'Idrott'),
(3, 'Fysik'),
(4, 'Gränssnitt'),
(5, 'Matte'),
(6, 'Programmering'),
(7, 'Svenska'),
(8, 'Teknik'),
(9, 'Webbutveckling'),
(10, 'Webbserverprogrammering'),
(11, ''),
(12, 'fwefqwwqf'),
(13, 'fwefqwwqf'),
(14, 'fe<sfes'),
(15, 'fe<sfes'),
(16, 'fe<sfes');

-- --------------------------------------------------------

--
-- Tabellstruktur `summaries`
--

CREATE TABLE IF NOT EXISTS `summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `author_name` varchar(64) CHARACTER SET utf8mb4 NOT NULL,
  `date` datetime NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject-id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci AUTO_INCREMENT=6 ;

--
-- Dumpning av Data i tabell `summaries`
--

INSERT INTO `summaries` (`id`, `title`, `content`, `author_name`, `date`, `subject_id`) VALUES
(1, 'Presentation', 'Lägg till bilder\r\nLägg till awesome effekter\r\nAnvänd flera olika fonts\r\nLägg till fler bilder\r\nSe till att ha några slides med massor av information som du kan läsa rakt av\r\nKlart!\r\nGaranterat bra betyg!', 'Trollmaster4', '2014-06-08 09:00:00', 1),
(2, 'Träning', 'Stuff', 'whoever', '2014-06-08 20:00:00', 2),
(3, 'herssehrsehrrseh', 'hsersehrhrsehrse', 'eshrserhsehrhrse', '2014-06-08 18:30:53', 1),
(4, 'hareherher', 'aehrhaerher', 'thsherhear', '2014-06-09 01:49:26', 1),
(5, 'rghrzsgrz', 'rhrzhzrsh', 'hrehgerzhg', '2014-06-09 13:42:46', 13);

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`summary_id`) REFERENCES `summaries` (`id`);

--
-- Restriktioner för tabell `summaries`
--
ALTER TABLE `summaries`
  ADD CONSTRAINT `summaries_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
