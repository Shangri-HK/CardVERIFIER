-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 25 Mars 2015 à 07:48
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cardverifier`
--

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` int(4) NOT NULL,
  `label` varchar(50) NOT NULL,
  `digits` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Contenu de la table `cards`
--

INSERT INTO `cards` (`id`, `prefix`, `label`, `digits`) VALUES
(1, 4024, 'Visa', 13),
(2, 4024, 'Visa', 16),
(3, 4485, 'Visa', 13),
(4, 4485, 'Visa', 16),
(5, 4532, 'Visa', 13),
(6, 4532, 'Visa', 16),
(7, 4539, 'Visa', 13),
(8, 4539, 'Visa', 16),
(9, 4556, 'Visa', 13),
(10, 4556, 'Visa', 16),
(11, 4716, 'Visa', 13),
(12, 4716, 'Visa', 16),
(13, 4916, 'Visa', 13),
(14, 4916, 'Visa', 16),
(15, 4929, 'Visa', 13),
(16, 4929, 'Visa', 16),
(17, 4026, 'Visa Electron', 16),
(18, 4175, 'Visa Electron', 16),
(19, 4508, 'Visa Electron', 16),
(20, 4844, 'Visa Electron', 16),
(21, 4913, 'Visa Electron', 16),
(22, 4917, 'Visa Electron', 16),
(23, 8699, 'Voyager', 15),
(24, 51, 'MasterCard', 16),
(25, 52, 'MasterCard', 16),
(26, 53, 'MasterCard', 16),
(27, 54, 'MasterCard', 16),
(28, 55, 'MasterCard', 16),
(29, 6304, 'Laser (16 digits)', 16),
(30, 6706, 'Laser (16 digits)', 16),
(31, 6709, 'Laser (16 digits)', 16),
(32, 6771, 'Laser (16 digits)', 16),
(33, 6304, 'Laser (17 digits)', 17),
(34, 6706, 'Laser (17 digits)', 17),
(35, 6709, 'Laser (17 digits)', 17),
(36, 6771, 'Laser (17 digits)', 17),
(37, 6304, 'Laser (18 digits)', 18),
(38, 6706, 'Laser (18 digits)', 18),
(39, 6709, 'Laser (18 digits)', 18),
(40, 6771, 'Laser (18 digits)', 18),
(41, 6304, 'Laser (19 digits)', 19),
(42, 6706, 'Laser (19 digits)', 19),
(43, 6709, 'Laser (19 digits)', 19),
(44, 6771, 'Laser (19 digits)', 19),
(45, 1800, 'JCB Co Inc (15 digits)', 15),
(46, 2100, 'JCB Co Inc (15 digits)', 15),
(47, 3088, 'JCB Co Inc (16 digits)', 16),
(48, 3096, 'JCB Co Inc (16 digits)', 16),
(49, 3112, 'JCB Co Inc (16 digits)', 16),
(50, 3158, 'JCB Co Inc (16 digits)', 16),
(51, 3337, 'JCB Co Inc (16 digits)', 16),
(52, 3528, 'JCB Co Inc (16 digits)', 16),
(53, 637, 'InstaPayment', 16),
(54, 638, 'InstaPayment', 16),
(55, 639, 'InstaPayment', 16),
(56, 2014, 'En Route', 15),
(57, 2149, 'En Route', 15),
(58, 6011, 'Discover', 16),
(59, 644, 'Discover', 16),
(60, 645, 'Discover', 16),
(61, 646, 'Discover', 16),
(62, 647, 'Discover', 16),
(63, 649, 'Discover', 16),
(64, 65, 'Discover', 16),
(65, 54, 'Diner Club USA & CA', 16),
(66, 36, 'Diner Club International', 14),
(67, 38, 'Diner Club International', 14),
(68, 300, 'Diner Club Carte Blanche ', 14),
(69, 301, 'Diner Club Carte Blanche', 14),
(70, 302, 'Diner Club Carte Blanche', 14),
(71, 303, 'Diner Club Carte Blanche ', 14),
(72, 304, 'Diner Club Carte Blanche', 14),
(73, 305, 'Diner Club Carte Blanche', 14),
(74, 34, 'American Express', 15),
(75, 37, 'American Express', 15);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
