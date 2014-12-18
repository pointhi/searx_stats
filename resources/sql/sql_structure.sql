-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 18. Dez 2014 um 11:04
-- Server Version: 5.5.40-0ubuntu0.14.04.1
-- PHP-Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `searx_states`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `searx_engines`
--

CREATE TABLE IF NOT EXISTS `searx_engines` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` char(255) NOT NULL,
  `IS_WORKING` tinyint(1) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  `LAST_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `searx_instances`
--

CREATE TABLE IF NOT EXISTS `searx_instances` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` char(255) NOT NULL,
  `VERSION_STRING` char(64) NOT NULL,
  `RETURN_CODE` int(11) NOT NULL,
  `ACTIVE` tinyint(1) NOT NULL,
  `LAST_UPDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
