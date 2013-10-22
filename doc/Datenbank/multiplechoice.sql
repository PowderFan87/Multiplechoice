-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Okt 2013 um 11:03
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
  `tblquestion_UID` int(11) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_tblanswer_tblquestion1_idx` (`tblquestion_UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `tblanswer`
--

INSERT INTO `tblanswer` (`UID`, `strAnswer`, `lngCountshowed`, `lngCountselected`, `blnTrue`, `tblquestion_UID`) VALUES
(1, 'Nord-Ostsee-Kanal', 0, 0, 0, 1),
(2, 'Nil-Kanal', 0, 0, 0, 1),
(3, 'Suezkanal', 0, 0, 1, 1),
(4, 'Dortmund-Ems-Kanal', 0, 0, 0, 1),
(5, 'Mittelmeer-Kanal', 0, 0, 0, 1),
(6, 'Timphu', 0, 0, 0, 2),
(7, 'Vientiane', 0, 0, 0, 2),
(8, 'Phnom Penh', 0, 0, 0, 2),
(9, 'Sabah', 0, 0, 0, 2),
(10, 'Dhaka', 0, 0, 1, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblbackenduser`
--

CREATE TABLE IF NOT EXISTS `tblbackenduser` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(256) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tblbackenduser`
--

INSERT INTO `tblbackenduser` (`UID`, `strName`) VALUES
(1, 'Hartmann'),
(2, 'Kreuz'),
(3, 'Vogt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblcategory`
--

CREATE TABLE IF NOT EXISTS `tblcategory` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `lngParentid` int(11) DEFAULT NULL,
  `strName` varchar(100) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tblcategory`
--

INSERT INTO `tblcategory` (`UID`, `lngParentid`, `strName`) VALUES
(1, NULL, 'Geographie'),
(2, 1, 'Allgemein'),
(3, 1, 'Hauptstaedte');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbldifficulty`
--

CREATE TABLE IF NOT EXISTS `tbldifficulty` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(100) NOT NULL,
  `lngTime` int(11) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `tbldifficulty`
--

INSERT INTO `tbldifficulty` (`UID`, `strName`, `lngTime`) VALUES
(1, 'Leicht', 30),
(2, 'Mittel', 60),
(3, 'Schwer', 120);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblquestion`
--

CREATE TABLE IF NOT EXISTS `tblquestion` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `strQuestion` varchar(256) NOT NULL,
  `lngCountshowed` int(11) DEFAULT NULL,
  `lngOpttime` varchar(45) DEFAULT NULL,
  `tbldifficulty_UID` int(11) NOT NULL,
  `tblbackenduser_UID` int(11) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_tblquestion_tbldifficulty1_idx` (`tbldifficulty_UID`),
  KEY `fk_tblquestion_tblbackenduser1_idx` (`tblbackenduser_UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `tblquestion`
--

INSERT INTO `tblquestion` (`UID`, `strQuestion`, `lngCountshowed`, `lngOpttime`, `tbldifficulty_UID`, `tblbackenduser_UID`) VALUES
(1, 'Wie heißt der Kanal der das Mittelmeer und das Rote Meer verbindet?', 0, '0', 1, 1),
(2, 'Wie heißt die Hauptstadt von Bangladesch?', 0, '0', 2, 1);

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
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tblsessions`
--

CREATE TABLE IF NOT EXISTS `tblsessions` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `dtmStart` datetime NOT NULL,
  `lngPoints` int(11) NOT NULL,
  `tblcategory_UID` int(11) NOT NULL,
  PRIMARY KEY (`UID`),
  KEY `fk_tblsessions_tblcategory1_idx` (`tblcategory_UID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Daten für Tabelle `tblsessions`
--

INSERT INTO `tblsessions` (`UID`, `dtmStart`, `lngPoints`, `tblcategory_UID`) VALUES
(1, '2013-10-13 00:00:00', 87, 3),
(2, '2013-10-13 00:00:00', 76, 2),
(3, '2013-10-14 00:00:00', 92, 2),
(4, '2013-10-15 00:00:00', 69, 2),
(5, '2013-10-15 00:00:00', 77, 3),
(6, '2013-10-15 00:00:00', 64, 2),
(7, '2013-10-17 00:00:00', 83, 2),
(8, '2013-10-18 00:00:00', 42, 2),
(9, '2013-10-18 00:00:00', 78, 3),
(10, '2013-10-19 00:00:00', 84, 2);

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
