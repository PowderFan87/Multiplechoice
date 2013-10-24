-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 24. Okt 2013 um 19:18
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `multiplechoice`
--
CREATE DATABASE IF NOT EXISTS `multiplechoice` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `multiplechoice`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblanswer`
--

CREATE TABLE IF NOT EXISTS `tblanswer` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strAnswer` varchar(256) NOT NULL,
  `lngCountshowed` int(11) DEFAULT NULL,
  `lngCountselected` int(11) DEFAULT NULL,
  `blnTrue` tinyint(1) NOT NULL DEFAULT '0',
  `blnDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tblquestion_UID` int(11) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_tblanswer_tblquestion1_idx` (`tblquestion_UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=235 ;

--
-- Daten für Tabelle `tblanswer`
--

INSERT INTO `tblanswer` (`UID`, `strAnswer`, `lngCountshowed`, `lngCountselected`, `blnTrue`, `blnDeleted`, `tblquestion_UID`) VALUES
(1, 'Nord-Ostsee-Kanal', 0, 0, 0, 0, 1),
(2, 'Nil-Kanal', 0, 0, 0, 0, 1),
(3, 'Suezkanal', 0, 0, 1, 0, 1),
(4, 'Dortmund-Ems-Kanal', 0, 0, 0, 0, 1),
(5, 'Mittelmeer-Kanal', 0, 0, 0, 0, 1),
(6, 'Timphu', 0, 0, 0, 0, 2),
(7, 'Vientiane', 0, 0, 0, 0, 2),
(8, 'Phnom Penh', 0, 0, 0, 0, 2),
(9, 'Sabah', 0, 0, 0, 0, 2),
(10, 'Dhaka', 0, 0, 1, 0, 2),
(11, '1989', 0, 0, 1, 0, 3),
(12, '1990', 0, 0, 0, 0, 3),
(13, '1889', 0, 0, 0, 0, 3),
(14, '1991', 0, 0, 0, 0, 3),
(15, '1941', 0, 0, 1, 0, 4),
(16, '1936', 0, 0, 0, 0, 4),
(17, '1943', 0, 0, 0, 0, 4),
(18, '1938', 0, 0, 0, 0, 4),
(19, '1914', 0, 0, 1, 0, 5),
(20, '1909', 0, 0, 0, 0, 5),
(21, '1923', 0, 0, 0, 0, 5),
(22, '1953', 0, 0, 0, 0, 5),
(23, '1967', 0, 0, 1, 0, 6),
(24, '1970', 0, 0, 0, 0, 6),
(25, '1971', 0, 0, 0, 0, 6),
(26, '1976', 0, 0, 0, 0, 6),
(27, '1947', 0, 0, 1, 0, 7),
(28, '1951', 0, 0, 0, 0, 7),
(29, '1945', 0, 0, 0, 0, 7),
(30, '1935', 0, 0, 0, 0, 7),
(31, '1901', 0, 0, 1, 0, 8),
(32, '1896', 0, 0, 0, 0, 8),
(33, '1900', 0, 0, 0, 0, 8),
(34, '1906', 0, 0, 0, 0, 8),
(35, '1969', 0, 0, 1, 0, 9),
(36, '1972', 0, 0, 0, 0, 9),
(37, '1973', 0, 0, 0, 0, 9),
(38, '1976', 0, 0, 0, 0, 9),
(39, '1957', 0, 0, 1, 0, 10),
(40, '1966', 0, 0, 0, 0, 10),
(41, '1953', 0, 0, 0, 0, 10),
(42, '1951', 0, 0, 0, 0, 10),
(43, '1981', 0, 0, 1, 0, 11),
(44, '1976', 0, 0, 0, 0, 11),
(45, '1988', 0, 0, 0, 0, 11),
(46, '1969', 0, 0, 0, 0, 11),
(47, '1956', 0, 0, 1, 0, 12),
(48, '1953', 0, 0, 0, 0, 12),
(49, '1963', 0, 0, 0, 0, 12),
(50, '1958', 0, 0, 0, 0, 12),
(51, '1996', 0, 0, 1, 0, 13),
(52, '1992', 0, 0, 0, 0, 13),
(53, '1988', 0, 0, 0, 0, 13),
(54, '1984', 0, 0, 0, 0, 13),
(55, '1924', 0, 0, 1, 0, 14),
(56, '1920', 0, 0, 0, 0, 14),
(57, '1928', 0, 0, 0, 0, 14),
(58, '1932', 0, 0, 0, 0, 14),
(59, '1996', 0, 0, 1, 0, 15),
(60, '2000', 0, 0, 0, 0, 15),
(61, '1992', 0, 0, 0, 0, 15),
(62, '1988', 0, 0, 0, 0, 15),
(63, '1990', 0, 0, 1, 0, 16),
(64, '1994', 0, 0, 0, 0, 16),
(65, '1998', 0, 0, 0, 0, 16),
(66, '1986', 0, 0, 0, 0, 16),
(67, '1912', 0, 0, 1, 0, 17),
(68, '1910', 0, 0, 0, 0, 17),
(69, '1909', 0, 0, 0, 0, 17),
(70, '1916', 0, 0, 0, 0, 17),
(71, 'Olymp', 0, 0, 1, 0, 18),
(72, 'Pita', 0, 0, 0, 0, 18),
(73, 'Mordor', 0, 0, 0, 0, 18),
(74, 'Vesuv', 0, 0, 0, 0, 18),
(75, 'Brasilien', 0, 0, 1, 0, 19),
(76, 'Deutschland', 0, 0, 0, 0, 19),
(77, 'Russland', 0, 0, 0, 0, 19),
(78, 'Katar', 0, 0, 0, 0, 19),
(79, 'Eiffelturm', 0, 0, 1, 0, 20),
(80, 'Brandenburger Tor', 0, 0, 0, 0, 20),
(81, 'Big Ben', 0, 0, 0, 0, 20),
(82, 'Freiheitsstatue', 0, 0, 0, 0, 20),
(83, 'Kanada', 0, 0, 1, 0, 21),
(84, 'USA', 0, 0, 0, 0, 21),
(85, 'Mexiko', 0, 0, 0, 0, 21),
(86, 'England', 0, 0, 0, 0, 21),
(87, 'Hera', 0, 0, 1, 0, 22),
(88, 'Artemis', 0, 0, 0, 0, 22),
(89, 'Xena', 0, 0, 0, 0, 22),
(90, 'Dionysos', 0, 0, 0, 0, 22),
(91, 'HCI', 0, 0, 1, 0, 23),
(92, 'Se', 0, 0, 0, 0, 23),
(93, 'S', 0, 0, 0, 0, 23),
(94, 'Kr', 0, 0, 0, 0, 23),
(95, 'Islamabad', 0, 0, 1, 0, 24),
(96, 'Dhaka', 0, 0, 0, 0, 24),
(97, 'Mumbai', 0, 0, 0, 0, 24),
(98, 'Wien', 0, 0, 0, 0, 24),
(99, 'Katzen', 0, 0, 1, 0, 25),
(100, 'Hunde', 0, 0, 0, 0, 25),
(101, 'Pferde', 0, 0, 0, 0, 25),
(102, 'M&auml;use', 0, 0, 0, 0, 25),
(103, 'Hawaii', 0, 0, 1, 0, 26),
(104, 'Mallorca', 0, 0, 0, 0, 26),
(105, 'Dominikanische Republik', 0, 0, 0, 0, 26),
(106, 'Costa Rica', 0, 0, 0, 0, 26),
(107, 'George Washington', 0, 0, 1, 0, 27),
(108, 'Thomas Jefferson', 0, 0, 0, 0, 27),
(109, 'James Madison', 0, 0, 0, 0, 27),
(110, 'Abraham Lincoln', 0, 0, 0, 0, 27),
(111, 'Andorra', 0, 0, 1, 0, 28),
(112, 'Monaco', 0, 0, 0, 0, 28),
(113, 'Vatikan', 0, 0, 0, 0, 28),
(114, 'F&auml;r&ouml;r Inseln', 0, 0, 0, 0, 28),
(115, 'Vier', 0, 0, 1, 0, 29),
(116, 'Drei', 0, 0, 0, 0, 29),
(117, 'Sechs', 0, 0, 0, 0, 29),
(118, 'Acht', 0, 0, 0, 0, 29),
(119, 'South Tarawa', 0, 0, 1, 0, 30),
(120, 'Buariki', 0, 0, 0, 0, 30),
(121, 'Betio', 0, 0, 0, 0, 30),
(122, 'Bairiki', 0, 0, 0, 0, 30),
(123, 'Kingston', 0, 0, 0, 0, 31),
(124, 'Tel Aviv', 0, 0, 0, 0, 31),
(125, 'Rabat', 0, 0, 1, 0, 31),
(126, 'Khartum', 0, 0, 0, 0, 31),
(127, 'Mbabane', 0, 0, 1, 0, 32),
(128, 'Paramaribo', 0, 0, 0, 0, 32),
(129, 'Mogadischu', 0, 0, 0, 0, 32),
(130, 'Khartum', 0, 0, 0, 0, 32),
(131, 'Syrien', 0, 0, 1, 0, 33),
(132, 'Irak', 0, 0, 0, 0, 33),
(133, 'Iran', 0, 0, 0, 0, 33),
(134, 'Jordanien', 0, 0, 0, 0, 33),
(135, 'Bolivien', 0, 0, 1, 0, 34),
(136, 'Uruguay', 0, 0, 0, 0, 34),
(137, 'Kolumbien', 0, 0, 0, 0, 34),
(138, 'Venezuela', 0, 0, 0, 0, 34),
(139, 'Bogota', 0, 0, 1, 0, 35),
(140, 'Quito', 0, 0, 0, 0, 35),
(141, 'Cali', 0, 0, 0, 0, 35),
(142, 'Medellin', 0, 0, 0, 0, 35),
(143, 'Duschanbe', 0, 0, 0, 0, 36),
(144, 'Warschau', 0, 0, 0, 0, 36),
(145, 'Pristina', 0, 0, 1, 0, 36),
(146, 'Pyinmana', 0, 0, 0, 0, 36),
(147, 'Victoria', 0, 0, 1, 0, 37),
(148, 'Port-au-Prince', 0, 0, 0, 0, 37),
(149, 'Castries', 0, 0, 0, 0, 37),
(150, 'Valletta', 0, 0, 0, 0, 37),
(151, 'Freetown', 0, 0, 1, 0, 38),
(152, 'Freevillage', 0, 0, 0, 0, 38),
(153, 'Freecity', 0, 0, 0, 0, 38),
(154, 'Freeplace', 0, 0, 0, 0, 38),
(155, 'Katmandu', 0, 0, 0, 0, 39),
(156, 'Dalai Lama', 0, 0, 0, 0, 39),
(157, 'Lhasa', 0, 0, 1, 0, 39),
(158, 'Bhutan', 0, 0, 0, 0, 39),
(159, 'Abuja', 0, 0, 0, 0, 40),
(160, 'Kigali', 0, 0, 1, 0, 40),
(161, 'Kinshasa', 0, 0, 0, 0, 40),
(162, 'Harare', 0, 0, 0, 0, 40),
(163, 'Buraydah', 0, 0, 0, 0, 41),
(164, 'Jiddah', 0, 0, 0, 0, 41),
(165, 'Medina', 0, 0, 0, 0, 41),
(166, 'Riad', 0, 0, 1, 0, 41),
(167, 'Doha', 0, 0, 0, 0, 42),
(168, 'Abu Dhabi', 0, 0, 1, 0, 42),
(169, 'Al Hufuf', 0, 0, 0, 0, 42),
(170, 'Dubai', 0, 0, 0, 0, 42),
(171, 'Oslo', 0, 0, 1, 0, 43),
(172, 'Helsinki', 0, 0, 0, 0, 43),
(173, 'Stockholm', 0, 0, 0, 0, 43),
(174, 'Kigali', 0, 0, 0, 0, 43),
(175, 'La Paz', 0, 0, 0, 0, 44),
(176, 'Kampala', 0, 0, 0, 0, 44),
(177, 'Sarajewo', 0, 0, 0, 0, 44),
(178, 'Taschkent', 0, 0, 1, 0, 44),
(179, 'Harare', 0, 0, 0, 0, 45),
(180, 'Dakar', 0, 0, 0, 0, 45),
(181, 'Niamey', 0, 0, 1, 0, 45),
(182, 'Belgrad', 0, 0, 0, 0, 45),
(183, 'Belgrad', 0, 0, 1, 0, 46),
(184, 'Bukarest', 0, 0, 0, 0, 46),
(185, 'Banjul', 0, 0, 0, 0, 46),
(186, 'Budapest', 0, 0, 0, 0, 46),
(187, 'Caracas', 0, 0, 0, 0, 47),
(188, 'Trinidad', 0, 0, 0, 0, 47),
(189, 'Asuncion', 0, 0, 0, 0, 47),
(190, 'Montevideo', 0, 0, 1, 0, 47),
(191, 'Panama', 0, 0, 0, 0, 48),
(192, 'Bolivien', 0, 0, 0, 0, 48),
(193, 'Venezuela', 0, 0, 1, 0, 48),
(194, 'Chile', 0, 0, 0, 0, 48),
(195, 'Malabo', 0, 0, 0, 0, 49),
(196, 'Colombo', 0, 0, 1, 0, 49),
(197, 'Tirana', 0, 0, 0, 0, 49),
(198, 'Dhaka', 0, 0, 0, 0, 49),
(199, 'New York', 0, 0, 0, 0, 50),
(200, 'Los Angeles', 0, 0, 0, 0, 50),
(201, 'Washington D.C.', 0, 0, 1, 0, 50),
(202, 'Hanoi', 0, 0, 0, 0, 50),
(203, 'Moldawien', 0, 0, 0, 0, 51),
(204, 'Ukraine', 0, 0, 1, 0, 51),
(205, 'Mongolei', 0, 0, 0, 0, 51),
(206, 'Wei&szlig;russland', 0, 0, 0, 0, 51),
(207, 'Islandia', 0, 0, 0, 0, 52),
(208, 'Aalborg', 0, 0, 0, 0, 52),
(209, 'Reykjavik', 0, 0, 1, 0, 52),
(210, 'Varna', 0, 0, 0, 0, 52),
(211, 'Vilnius', 0, 0, 0, 0, 53),
(212, 'Bratislava', 0, 0, 0, 0, 53),
(213, 'Praia', 0, 0, 0, 0, 53),
(214, 'Ljubljana', 0, 0, 1, 0, 53),
(215, 'Sydney', 0, 0, 0, 0, 54),
(216, 'Melbourne', 0, 0, 0, 0, 54),
(217, 'Canberra', 0, 0, 0, 0, 54),
(218, 'Brisbane', 0, 0, 1, 0, 54),
(219, 'Lausanne', 0, 0, 0, 0, 55),
(220, 'Genf', 0, 0, 0, 0, 55),
(221, 'Bern', 0, 0, 1, 0, 55),
(222, 'Z&uuml;rich', 0, 0, 0, 0, 55),
(223, 'Br&uuml;ssel', 0, 0, 1, 0, 56),
(224, 'Bern', 0, 0, 0, 0, 56),
(225, 'Anderlecht', 0, 0, 0, 0, 56),
(226, 'Den Haag', 0, 0, 0, 0, 56),
(227, 'Dublin', 0, 0, 0, 0, 57),
(228, 'Belfast', 0, 0, 1, 0, 57),
(229, 'London', 0, 0, 0, 0, 57),
(230, 'Swansea', 0, 0, 0, 0, 57),
(231, '50', 0, 0, 1, 0, 58),
(232, '51', 0, 0, 0, 0, 58),
(233, '52', 0, 0, 0, 0, 58),
(234, '53', 0, 0, 0, 0, 58);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblbackenduser`
--

CREATE TABLE IF NOT EXISTS `tblbackenduser` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(256) NOT NULL,
  `blnDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tblbackenduser`
--

INSERT INTO `tblbackenduser` (`UID`, `strName`, `blnDeleted`) VALUES
(1, 'Hartmann', 0),
(2, 'Kreuz', 0),
(3, 'Vogt', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblcategory`
--

CREATE TABLE IF NOT EXISTS `tblcategory` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `lngParentid` int(11) DEFAULT NULL,
  `strName` varchar(100) NOT NULL,
  `blnDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `tblcategory`
--

INSERT INTO `tblcategory` (`UID`, `lngParentid`, `strName`, `blnDeleted`) VALUES
(1, NULL, 'Geographie', 0),
(2, 1, 'Geographie Allgemein', 0),
(3, 1, 'Hauptst&auml;dte', 0),
(4, 5, 'Allgemeinwissen', 0),
(5, NULL, 'Wissen', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbldifficulty`
--

CREATE TABLE IF NOT EXISTS `tbldifficulty` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(100) NOT NULL,
  `lngTime` int(11) NOT NULL,
  `blnDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tbldifficulty`
--

INSERT INTO `tbldifficulty` (`UID`, `strName`, `lngTime`, `blnDeleted`) VALUES
(1, 'Leicht', 30, 0),
(2, 'Mittel', 60, 0),
(3, 'Schwer', 120, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblquestion`
--

CREATE TABLE IF NOT EXISTS `tblquestion` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strQuestion` varchar(256) NOT NULL,
  `lngCountshowed` int(11) DEFAULT NULL,
  `lngOpttime` int(11) DEFAULT NULL,
  `blnDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tbldifficulty_UID` int(11) NOT NULL,
  `tblbackenduser_UID` int(11) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_tblquestion_tbldifficulty1_idx` (`tbldifficulty_UID`),
  KEY `fk_tblquestion_tblbackenduser1_idx` (`tblbackenduser_UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Daten für Tabelle `tblquestion`
--

INSERT INTO `tblquestion` (`UID`, `strQuestion`, `lngCountshowed`, `lngOpttime`, `blnDeleted`, `tbldifficulty_UID`, `tblbackenduser_UID`) VALUES
(1, 'Wie hei&szlig;t der Kanal der das Mittelmeer und das Rote Meer verbindet?', 0, 0, 0, 1, 1),
(2, 'Wie hei&szlig;t die Hauptstadt von Bangladesch?', 0, 0, 0, 2, 1),
(3, 'Wann wurde die Berliner Mauer niedergerissen?', 0, 0, 0, 1, 1),
(4, 'Wann attackierte Japan Pearl Harbour?', 0, 0, 0, 2, 1),
(5, 'Wann wurde Franz Ferdinand in Sarajewo erschossen?', 0, 0, 0, 3, 1),
(6, 'Wann war der Sechstagekrieg im Nahen Osten?', 0, 0, 0, 3, 1),
(7, 'Wann wurde Indien selbstst&auml;ndig?', 0, 0, 0, 3, 1),
(8, 'Wann starb K&ouml;nigin Victoria von Gro&szlig;britannien?', 0, 0, 0, 3, 1),
(9, 'Wann war Neil Armstrong auf dem Mond spazieren?', 0, 0, 0, 1, 1),
(10, 'Wann wurde die Sputnik ins All gesendet?', 0, 0, 0, 2, 1),
(11, 'Wann kam die erste CD auf den Markt?', 0, 0, 0, 2, 1),
(12, 'Wann wurde Elvis Presleys erste Platte &quot;Heartbreak Hotel&quot; ver&ouml;ffentlicht?', 0, 0, 0, 2, 1),
(13, 'Wann waren die Olympischen Spiele in Atlanta, USA?', 0, 0, 0, 1, 1),
(14, 'Wann waren die ersten Olympischen Winterspiele?', 0, 0, 0, 2, 1),
(15, 'Wann gewann Deutschland die letzte Europameisterschaft im Fu&szlig;ball?', 0, 0, 0, 1, 1),
(16, 'Wann gewann Deutschland die letzte Weltmeisterschaft im Fu&szlig;ball?', 0, 0, 0, 1, 1),
(17, 'Wann war der Untergang der Titanic?', 0, 0, 0, 1, 1),
(18, 'Wie hei&szlig;t der G&ouml;tterberg der Griechen?', 0, 0, 0, 1, 1),
(19, 'In welchem Land wird die Fu&szlig;ballweltmeisterschaft 2014 ausgetragen?', 0, 0, 0, 1, 1),
(20, 'Wie hei&szlig;t das bekannteste Wahrzeichen Frankreichs?', 0, 0, 0, 1, 1),
(21, 'In welchem Land liegt Vancouver?', 0, 0, 0, 1, 1),
(22, 'Wie hei&szlig;t die griechische G&ouml;ttermutter?', 0, 0, 0, 1, 1),
(23, 'Wie hei&szlig;t die chemische Formel f&uuml;r Salzs&auml;ure?', 0, 0, 0, 2, 1),
(24, 'Wie hei&szlig;t die Hauptstadt von Pakistan?', 0, 0, 0, 1, 1),
(25, 'Vor welchem Tieren f&uuml;rchtete sich Napoleon?', 0, 0, 0, 2, 1),
(26, 'Auf welcher Insel-Gruppe liegt Pearl Harbor?', 0, 0, 0, 1, 1),
(27, 'Wer war der erste amerikanische Pr&auml;sident?', 0, 0, 0, 1, 1),
(28, 'Welcher Zwergstaat befindet sich zwischen Frankreich und Spanien?', 0, 0, 0, 1, 1),
(29, 'Wie viele Zitzen hat das Euter einer Kuh?', 0, 0, 0, 1, 1),
(30, 'Wie hei&szlig;t die Hauptstadt von Kiribati?', 0, 0, 0, 3, 1),
(31, 'Wie hei&szlig;t die Hauptstadt von Marokko?', 0, 0, 0, 2, 1),
(32, 'Wie hei&szlig;t die Hauptstadt von Swasiland?', 0, 0, 0, 3, 1),
(33, 'Damaskus ist die Hauptstadt von...?', 0, 0, 0, 2, 1),
(34, 'Sucre ist die konstitutionelle Hauptstadt von ...?', 0, 0, 0, 2, 1),
(35, 'Wie hei&szlig;t die Hauptstadt von Kolumbien?', 0, 0, 0, 2, 1),
(36, 'Wie hei&szlig;t die Hauptstadt von Kosovo?', 0, 0, 0, 2, 1),
(37, 'Wie hei&szlig;t die Hauptstadt der Seychellen?', 0, 0, 0, 2, 1),
(38, 'Wie hei&szlig;t die Hauptstadt von Sierra Leone?', 0, 0, 0, 2, 1),
(39, 'Wie hei&szlig;t die Hauptstadt von Tibet?', 0, 0, 0, 2, 1),
(40, 'Wie hei&szlig;t die Hauptstadt von Ruanda?', 0, 0, 0, 3, 1),
(41, 'Wie lautet die Hauptstadt von Saudi Arabien?', 0, 0, 0, 1, 1),
(42, 'Wie hei&szlig;t die Hauptstadt der Vereinigten Arabischen Emirate (VAE)?', 0, 0, 0, 1, 1),
(43, 'Wie hei&szlig;t die Hauptstadt von Norwegen?', 0, 0, 0, 1, 1),
(44, 'Wie hei&szlig;t die Hauptstadt von Usbekistan?', 0, 0, 0, 2, 1),
(45, 'Wie hei&szlig;t die Hauptstadt von Niger?', 0, 0, 0, 2, 1),
(46, 'Wie hei&szlig;t die Hauptstadt von Serbien?', 0, 0, 0, 1, 1),
(47, 'Wie hei&szlig;t die Hauptstadt von Uruguay?', 0, 0, 0, 1, 1),
(48, 'Caracas ist die Hauptstadt von...?', 0, 0, 0, 2, 1),
(49, 'Wie hei&szlig;t die Hauptstadt von Sri Lanka?', 0, 0, 0, 2, 1),
(50, 'Wie hei&szlig;t die Hauptstadt der Vereinigten Staaten?', 0, 0, 0, 1, 1),
(51, 'Von welchem Land ist Kiew die Hauptstadt?', 0, 0, 0, 1, 1),
(52, 'Wie hei&szlig;t die Hauptstadt von Island?', 0, 0, 0, 1, 1),
(53, 'Wie hei&szlig;t die Hauptstadt von Slowenien?', 0, 0, 0, 1, 1),
(54, 'Wie hei&szlig;t die Hauptstadt Australiens?', 0, 0, 0, 1, 1),
(55, 'Wie hei&szlig;t die Hauptstadt der Schweiz?', 0, 0, 0, 1, 1),
(56, 'Wie hei&szlig;t die Hauptstadt von Belgien?', 0, 0, 0, 1, 1),
(57, 'Wie hei&szlig;t die Hauptstadt von Nordirland?', 0, 0, 0, 1, 1),
(58, 'Wie viele Sterne hat die amerikanische Nationalflagge?', 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblquestion_has_tblcategory`
--

CREATE TABLE IF NOT EXISTS `tblquestion_has_tblcategory` (
  `tblquestion_UID` int(11) NOT NULL,
  `tblcategory_UID` int(11) NOT NULL,
  PRIMARY KEY (`tblquestion_UID`,`tblcategory_UID`),
  KEY `fk_tblquestion_has_tblcategory_tblcategory1_idx` (`tblcategory_UID`),
  KEY `fk_tblquestion_has_tblcategory_tblquestion_idx` (`tblquestion_UID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `tblquestion_has_tblcategory`
--

INSERT INTO `tblquestion_has_tblcategory` (`tblquestion_UID`, `tblcategory_UID`) VALUES
(1, 2),
(7, 2),
(19, 2),
(20, 2),
(21, 2),
(26, 2),
(28, 2),
(58, 2),
(2, 3),
(24, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 3),
(39, 3),
(40, 3),
(41, 3),
(42, 3),
(43, 3),
(44, 3),
(45, 3),
(46, 3),
(47, 3),
(48, 3),
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(53, 3),
(54, 3),
(55, 3),
(56, 3),
(57, 3),
(1, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(22, 4),
(23, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(58, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblsessions`
--

CREATE TABLE IF NOT EXISTS `tblsessions` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `dtmStart` datetime NOT NULL,
  `lngPoints` int(11) NOT NULL,
  `blnDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `tblcategory_UID` int(11) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_tblsessions_tblcategory1_idx` (`tblcategory_UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Daten für Tabelle `tblsessions`
--

INSERT INTO `tblsessions` (`UID`, `dtmStart`, `lngPoints`, `blnDeleted`, `tblcategory_UID`) VALUES
(1, '2013-10-13 00:00:00', 87, 0, 3),
(2, '2013-10-13 00:00:00', 76, 0, 2),
(3, '2013-10-14 00:00:00', 92, 0, 2),
(4, '2013-10-15 00:00:00', 69, 0, 2),
(5, '2013-10-15 00:00:00', 77, 0, 3),
(6, '2013-10-15 00:00:00', 64, 0, 2),
(7, '2013-10-17 00:00:00', 83, 0, 2),
(8, '2013-10-18 00:00:00', 42, 0, 2),
(9, '2013-10-18 00:00:00', 78, 0, 3),
(10, '2013-10-19 00:00:00', 84, 0, 2),
(13, '2013-10-23 00:00:00', 84, 0, 4),
(14, '2013-10-23 00:00:00', 89, 0, 4);

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tblanswer`
--
ALTER TABLE `tblanswer`
  ADD CONSTRAINT `fk_tblanswer_tblquestion1` FOREIGN KEY (`tblquestion_UID`) REFERENCES `tblquestion` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblquestion`
--
ALTER TABLE `tblquestion`
  ADD CONSTRAINT `fk_tblquestion_tblbackenduser1` FOREIGN KEY (`tblbackenduser_UID`) REFERENCES `tblbackenduser` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblquestion_tbldifficulty1` FOREIGN KEY (`tbldifficulty_UID`) REFERENCES `tbldifficulty` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblquestion_has_tblcategory`
--
ALTER TABLE `tblquestion_has_tblcategory`
  ADD CONSTRAINT `fk_tblquestion_has_tblcategory_tblcategory1` FOREIGN KEY (`tblcategory_UID`) REFERENCES `tblcategory` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblquestion_has_tblcategory_tblquestion` FOREIGN KEY (`tblquestion_UID`) REFERENCES `tblquestion` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `tblsessions`
--
ALTER TABLE `tblsessions`
  ADD CONSTRAINT `fk_tblsessions_tblcategory1` FOREIGN KEY (`tblcategory_UID`) REFERENCES `tblcategory` (`UID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
