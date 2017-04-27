-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Št 27.Apr 2017, 17:05
-- Verzia serveru: 5.6.13
-- Verzia PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `poslanci`
--
CREATE DATABASE IF NOT EXISTS `poslanci` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovak_ci;
USE `poslanci`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `casy`
--

CREATE TABLE IF NOT EXISTS `casy` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `den` date NOT NULL,
  `cas_prichodu` char(5) COLLATE utf8_slovak_ci NOT NULL,
  `cas_odchodu` char(5) COLLATE utf8_slovak_ci NOT NULL,
  `poznamka` char(100) COLLATE utf8_slovak_ci NOT NULL,
  `id_poslanca` smallint(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_poslanca` (`id_poslanca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=31 ;

--
-- Sťahujem dáta pre tabuľku `casy`
--

INSERT INTO `casy` (`id`, `den`, `cas_prichodu`, `cas_odchodu`, `poznamka`, `id_poslanca`) VALUES
(22, '2017-04-29', '09:22', '16:55', '', 236),
(23, '2017-04-29', '09:22', '12:12', '', 236),
(24, '2017-04-29', '09:22', '12:16', '', 236),
(27, '2012-01-20', '02:12', '13:11', '', 236),
(29, '2020-01-20', '12:13', '12:14', '', 236),
(30, '2001-06-20', '12:13', '12:15', '', 236);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `osoby`
--

CREATE TABLE IF NOT EXISTS `osoby` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `meno` char(60) COLLATE utf8_slovak_ci NOT NULL,
  `adresa` char(100) COLLATE utf8_slovak_ci NOT NULL,
  `strana` char(5) COLLATE utf8_slovak_ci NOT NULL,
  `zamestnanie` char(100) COLLATE utf8_slovak_ci NOT NULL,
  `vek` tinyint(2) NOT NULL,
  `pocet_absencii` smallint(4) NOT NULL,
  `pocet_zvoleni` tinyint(1) NOT NULL,
  `heslo` char(16) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=237 ;

--
-- Sťahujem dáta pre tabuľku `osoby`
--

INSERT INTO `osoby` (`id`, `meno`, `adresa`, `strana`, `zamestnanie`, `vek`, `pocet_absencii`, `pocet_zvoleni`, `heslo`) VALUES
(1, 'Jozef Mrkva', 'Kratka 417/6', 'OSN', 'Trubkar', 66, 5, 2, 'mrkva123'),
(236, 'Peter Novak', 'Dlha ulica, Vrutky', 'ABC', 'Inizinier', 22, 0, 1, 'Inzinier12');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
