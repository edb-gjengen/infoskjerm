-- phpMyAdmin SQL Dump
-- version 3.2.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2010 at 03:50 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `infoskjerm`
--

-- --------------------------------------------------------

--
-- Table structure for table `display_times`
--

CREATE TABLE IF NOT EXISTS `display_times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slide_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `stop` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `display_times`
--

INSERT INTO `display_times` (`id`, `slide_id`, `start`, `stop`) VALUES
(31, 2, 1282471200, 1282503600),
(30, 2, 1282384800, 1282417200),
(29, 2, 1282298400, 1282330800),
(28, 2, 1282212000, 1282244400),
(27, 2, 1282125600, 1282158000),
(24, 2, 1282039200, 1282071600),
(25, 2, 1281952800, 1281985200),
(26, 2, 1281823200, 1281909600),
(9, 3, 1281304800, 1281391200),
(10, 3, 1281477600, 1281564000),
(11, 3, 1281650400, 1281736800),
(12, 3, 1281823200, 1281996000),
(13, 3, 1282082400, 1282168800),
(14, 3, 1282255200, 1282341600),
(15, 3, 1282428000, 1282514400),
(16, 3, 1282600800, 1282687200),
(17, 3, 1282773600, 1282860000),
(18, 3, 1282946400, 1283032800),
(19, 3, 1283205600, 1283292000),
(20, 3, 1283378400, 1283464800),
(21, 3, 1283551200, 1283637600),
(32, 4, 1283702400, 1283713200),
(33, 4, 1283616000, 1283648400),
(34, 4, 1283529600, 1283562000),
(35, 4, 1283443200, 1283475600),
(36, 4, 1283356800, 1283389200),
(37, 4, 1283270400, 1283302800),
(38, 4, 1283184000, 1283216400),
(39, 4, 1283097600, 1283130000),
(40, 4, 1283011200, 1283043600),
(41, 4, 1282924800, 1282957200),
(42, 4, 1282838400, 1282870800),
(43, 4, 1282752000, 1282784400),
(44, 4, 1282665600, 1282698000),
(45, 4, 1282579200, 1282611600),
(46, 4, 1282492800, 1282525200),
(47, 4, 1282406400, 1282438800),
(48, 4, 1282320000, 1282352400),
(49, 4, 1282233600, 1282266000),
(50, 4, 1282147200, 1282179600),
(51, 4, 1282060800, 1282093200),
(52, 4, 1281974400, 1282006800),
(53, 4, 1281888000, 1281920400),
(54, 4, 1281801600, 1281834000),
(55, 4, 1281715200, 1281747600),
(56, 4, 1281628800, 1281661200),
(57, 4, 1281542400, 1281574800),
(58, 4, 1281456000, 1281488400),
(59, 4, 1281369600, 1281402000),
(60, 4, 1281304800, 1281315600),
(61, 11, 1281477600, 1282687200),
(62, 12, 1282082400, 2147483647),
(63, 14, 1281304800, 1283713200),
(64, 15, 1281304800, 1283713200),
(65, 17, 1281304800, 1283713200),
(66, 18, 1281304800, 1283713200),
(67, 19, 1281304800, 1283713200),
(68, 1, 1281304800, 1283713200),
(69, 20, 1281304800, 1283713200),
(70, 21, 1281304800, 1283713200),
(71, 22, 1281304800, 1283713200);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(255) NOT NULL,
  `type` char(255) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `size` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `type`, `added`, `size`) VALUES
(1, 'imgad.jpeg', 'image/jpeg', '0000-00-00 00:00:00', 30554),
(2, 'imgad.jpeg', 'image/jpeg', '0000-00-00 00:00:00', 30554),
(3, 'imgad.jpeg', 'image/jpeg', '0000-00-00 00:00:00', 30554),
(4, 'imgad.jpeg', 'image/jpeg', '0000-00-00 00:00:00', 30554),
(5, 'imgad.jpeg', 'image/jpeg', '0000-00-00 00:00:00', 30554),
(6, 'imgad.jpeg', 'image/jpeg', '0000-00-00 00:00:00', 30554),
(7, 'imgad.jpeg', 'image/jpeg', '2010-08-10 14:14:57', 30554),
(8, 'imgad.jpeg', 'image/jpeg', '2010-08-10 14:30:20', 30554);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  `thumbnail` char(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `simple` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `title`, `url`, `thumbnail`, `enabled`, `order`, `simple`) VALUES
(1, 'uio', 'http://www.uio.no', '', 1, NULL, 0),
(21, 'Studio', 'http://studio.studentersamfundet.no', '', 1, NULL, 0),
(22, 'IFI', 'http://ifi.uio.no', '', 1, NULL, 0),
(4, 'studentersamfundet.no', 'http://www.studentersamfundet.no', '', 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(255) NOT NULL,
  `password` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'olivaq', '3b59bef115de5467ef99213f23e83af92b9c3b4a');

