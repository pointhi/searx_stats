-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 18. Dez 2014 um 14:48
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Daten für Tabelle `searx_engines`
--

INSERT INTO `searx_engines` (`ID`, `NAME`, `IS_WORKING`, `ACTIVE`, `LAST_UPDATE`) VALUES
(1, 'wikipedia', 0, 1, '0000-00-00 00:00:00'),
(2, 'bing', 0, 1, '0000-00-00 00:00:00'),
(3, 'bing_images', 0, 1, '0000-00-00 00:00:00'),
(4, 'bing_news', 0, 1, '0000-00-00 00:00:00'),
(5, 'currency', 0, 0, '0000-00-00 00:00:00'),
(6, 'deviantart', 0, 1, '0000-00-00 00:00:00'),
(7, 'ddg_definitions', 0, 1, '0000-00-00 00:00:00'),
(8, 'duckduckgo', 0, 1, '0000-00-00 00:00:00'),
(9, 'faroo', 0, 0, '0000-00-00 00:00:00'),
(10, 'filecrop', 0, 0, '0000-00-00 00:00:00'),
(11, 'flickr', 0, 1, '0000-00-00 00:00:00'),
(12, 'general_file', 0, 1, '0000-00-00 00:00:00'),
(13, 'github', 0, 1, '0000-00-00 00:00:00'),
(14, 'google', 0, 1, '0000-00-00 00:00:00'),
(15, 'google_images', 0, 1, '0000-00-00 00:00:00'),
(16, 'google_news', 0, 1, '0000-00-00 00:00:00'),
(17, 'openstreetmap', 0, 1, '0000-00-00 00:00:00'),
(18, 'photon', 0, 1, '0000-00-00 00:00:00'),
(19, 'piratebay', 0, 0, '0000-00-00 00:00:00'),
(20, 'kickass', 0, 1, '0000-00-00 00:00:00'),
(21, 'soundcloud', 0, 1, '0000-00-00 00:00:00'),
(22, 'stackoverflow', 0, 1, '0000-00-00 00:00:00'),
(23, 'startpage', 0, 1, '0000-00-00 00:00:00'),
(24, 'ixquick', 0, 0, '0000-00-00 00:00:00'),
(25, 'twitter', 0, 1, '0000-00-00 00:00:00'),
(26, 'uncyclopedia', 0, 0, '0000-00-00 00:00:00'),
(27, 'urbandictionary', 0, 0, '0000-00-00 00:00:00'),
(28, 'yahoo', 0, 1, '0000-00-00 00:00:00'),
(29, 'yahoo_news', 0, 1, '0000-00-00 00:00:00'),
(30, 'youtube', 0, 1, '0000-00-00 00:00:00'),
(31, 'dailymotion', 0, 1, '0000-00-00 00:00:00'),
(32, 'vimeo', 0, 1, '0000-00-00 00:00:00'),
(33, 'yacy', 0, 0, '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Daten für Tabelle `searx_instances`
--

INSERT INTO `searx_instances` (`ID`, `URL`, `VERSION_STRING`, `RETURN_CODE`, `ACTIVE`, `LAST_UPDATE`) VALUES
(1, 'https://searx.me', '', 0, 1, '0000-00-00 00:00:00'),
(2, 'https://searx.0x2a.tk/', '', 0, 1, '0000-00-00 00:00:00'),
(3, 'https://searx.oe5tpo.com', '', 0, 1, '0000-00-00 00:00:00'),
(4, 'https://seeks.okhin.fr', '', 0, 1, '0000-00-00 00:00:00'),
(5, 'https://quackquackgo.nl', '', 0, 1, '0000-00-00 00:00:00'),
(6, 'https://seeks.hsbp.org', '', 0, 1, '0000-00-00 00:00:00'),
(7, 'https://searx.scriptores.com', '', 0, 1, '0000-00-00 00:00:00'),
(8, 'https://searx.coding4schoki.org', '', 0, 1, '0000-00-00 00:00:00'),
(9, 'https://searx.netzspielplatz.de', '', 0, 1, '0000-00-00 00:00:00'),
(10, 'https://searx.laquadrature.net', '', 0, 1, '0000-00-00 00:00:00'),
(11, 'https://searx.kiberpipa.org', '', 0, 1, '0000-00-00 00:00:00'),
(12, 'https://searx.volcanis.me', '', 0, 1, '0000-00-00 00:00:00'),
(13, 'https://search.trashserver.net', '', 0, 1, '0000-00-00 00:00:00'),
(14, 'https://searx.brihx.fr', '', 0, 1, '0000-00-00 00:00:00'),
(15, 'https://search.kujiu.org', '', 0, 1, '0000-00-00 00:00:00'),
(16, 'https://searx.new-admin.net', '', 0, 1, '0000-00-00 00:00:00'),
(17, 'https://search.homecomputing.fr', '', 0, 1, '0000-00-00 00:00:00'),
(18, 'https://posativ.org/search', '', 0, 1, '0000-00-00 00:00:00'),
(19, 'https://search.viewskew.com', '', 0, 1, '0000-00-00 00:00:00'),
(20, 'https://searx.crazypotato.tk', '', 0, 1, '0000-00-00 00:00:00'),
(21, 'https://el-hoyo.net/searx', '', 0, 1, '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
