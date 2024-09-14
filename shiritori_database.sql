-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 08:21 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `abbyndeb_shiritori`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `message` varchar(25) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alphabet` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `name`, `message`, `ctimestamp`, `alphabet`) VALUES
(61, 'Deborah', 'hellothere', '2013-03-25 09:18:12', NULL),
(62, 'Miffy', 'lephantsarecute', '2013-03-25 09:18:37', 'e'),
(63, 'LITTLEMISS', 'rrr', '2013-03-25 09:21:02', 'e'),
(64, 'ahboyxzxzx', 'ubberducky', '2013-03-25 09:24:56', 'r');

-- --------------------------------------------------------

--
-- Table structure for table `entryfood`
--

CREATE TABLE IF NOT EXISTS `entryfood` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `message` varchar(25) NOT NULL,
  `ctimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alphabet` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `entryfood`
--

INSERT INTO `entryfood` (`id`, `name`, `message`, `ctimestamp`, `alphabet`) VALUES
(9, 'dude-dudeâ', 'potato', '2013-03-25 09:21:36', NULL),
(10, 'ah-girl!:)', 'nion', '2013-03-25 09:22:13', 'o');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
