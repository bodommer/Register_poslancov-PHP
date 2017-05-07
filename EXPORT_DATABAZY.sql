-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u8
-- http://www.phpmyadmin.net
--
-- Hostiteľ: localhost
-- Vygenerované: Ned 07.Máj 2017, 10:35
-- Verzia serveru: 5.5.53
-- Verzia PHP: 5.6.29-0+deb8u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `jurco15`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=52 ;

--
-- Sťahujem dáta pre tabuľku `casy`
--

INSERT INTO `casy` (`id`, `den`, `cas_prichodu`, `cas_odchodu`, `poznamka`, `id_poslanca`) VALUES
(32, '2017-05-01', '08:22', '16:01', '', 237),
(33, '2017-05-02', '08:01', '16:55', 'Dlhe rokovanie', 237),
(34, '2017-05-03', '07:44', '15:22', '', 237),
(35, '2017-05-04', '09:55', '17:05', 'Neskory prichod - navsteva zubara', 237),
(36, '2017-05-05', '07:30', '18:00', '', 237),
(37, '2017-05-01', '08:00', '16:00', '', 238),
(38, '2017-05-02', '08:00', '16:00', '', 238),
(39, '2017-05-03', '10:00', '18:00', 'Neskora schodza', 238),
(40, '2017-05-04', '07:00', '15:15', '', 238),
(41, '2017-05-05', '12:00', '16:00', 'Zapcha na moste', 238),
(42, '2017-05-01', '07:00', '15:00', '', 241),
(43, '2017-05-02', '07:00', '15:00', '', 241),
(44, '2017-05-03', '07:05', '15:05', '', 241),
(45, '2017-05-04', '07:00', '18:00', 'Nadrabanie prac. casu, dorabanie administracie', 241),
(46, '2017-05-05', '07:00', '12:00', 'Skorsi odchod - dlhsi vikend', 241),
(47, '2017-05-01', '09:00', '18:00', '', 242),
(48, '2017-05-02', '09:00', '18:00', '', 242),
(49, '2017-05-03', '07:00', '18:00', '', 242),
(50, '2017-05-04', '09:00', '18:00', '', 242),
(51, '2017-05-05', '09:00', '11:00', '', 242);

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
  `heslo` varchar(50) COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=245 ;

--
-- Sťahujem dáta pre tabuľku `osoby`
--

INSERT INTO `osoby` (`id`, `meno`, `adresa`, `strana`, `zamestnanie`, `vek`, `pocet_absencii`, `pocet_zvoleni`, `heslo`) VALUES
(237, 'Jozef Mrkva', 'Kratka 417/6, 058 01 Poprad', 'ABC', 'Vodoinstalater', 33, 12, 2, '957627bf68e49c58d8836ca48b4fcf07'),
(238, 'Jan Kratky', 'Stefanikova 12, 094 58 Malacky', 'ABC', 'Nezamestnany', 55, 1, 1, 'd8f471196408a1a637144f9a7aa7c56e'),
(241, 'Peter Stastny', 'Dlha 512, 055 12 Kozarovce', 'SOS', 'Vodic', 21, 24, 1, '025b9cccc37b4fd8fde90c493917bd76'),
(242, 'Lea Rychla', 'Letna 457/12, 014 56 Trencin', 'DDD', 'Ekonomka', 41, 0, 2, 'd9b9768a129ccf45eba4ad5762f24da4');

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `casy`
--
ALTER TABLE `casy`
  ADD CONSTRAINT `casy_ibfk_1` FOREIGN KEY (`id_poslanca`) REFERENCES `osoby` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
