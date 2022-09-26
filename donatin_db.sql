-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2021 at 04:55 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donatin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nomPrenoms` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qtier` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objectif` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbreMise` int(11) DEFAULT NULL,
  `mise` int(11) DEFAULT NULL,
  `mntMise` int(11) DEFAULT NULL,
  `statutClient` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cli_SF` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cli_SP` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbreJours` int(11) DEFAULT NULL,
  `agent` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2240 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `clientparagent`
--

DROP TABLE IF EXISTS `clientparagent`;
CREATE TABLE IF NOT EXISTS `clientparagent` (
  `nomPrenoms` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qtier` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objectif` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbreMise` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mise` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mntMise` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statutClient` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cli_SF` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Cli_SP` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbreJours` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agent` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `trash`
--

DROP TABLE IF EXISTS `trash`;
CREATE TABLE IF NOT EXISTS `trash` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomPrenoms_trash` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_trash` int(11) DEFAULT NULL,
  `qtier_trash` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomPrenoms` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pseudo` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
