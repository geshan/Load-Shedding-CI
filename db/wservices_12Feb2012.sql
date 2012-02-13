-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2012 at 01:18 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `ls_hash_map`
--

CREATE TABLE IF NOT EXISTS `ls_hash_map` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `xday1` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `xgroup` enum('2','3','4','5','6','7') NOT NULL,
  `group1_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `ls_hash_map`
--

INSERT INTO `ls_hash_map` (`hid`, `xday1`, `xgroup`, `group1_day`) VALUES
(1, 'Monday', '2', 'Sunday'),
(2, 'Tuesday', '2', 'Monday'),
(3, 'Wednesday', '2', 'Tuesday'),
(4, 'Thursday', '2', 'Wednesday'),
(5, 'Friday', '2', 'Thursday'),
(6, 'Saturday', '2', 'Friday'),
(7, 'Sunday', '2', 'Saturday'),
(8, 'Sunday', '3', 'Friday'),
(9, 'Monday', '3', 'Saturday'),
(10, 'Tuesday', '3', 'Sunday'),
(11, 'Wednesday', '3', 'Monday'),
(12, 'Thursday', '3', 'Tuesday'),
(13, 'Friday', '3', 'Wednesday'),
(14, 'Saturday', '3', 'Thursday'),
(15, 'Sunday', '4', 'Thursday'),
(16, 'Monday', '4', 'Friday'),
(17, 'Tuesday', '4', 'Saturday'),
(18, 'Wednesday', '4', 'Sunday'),
(19, 'Thursday', '4', 'Monday'),
(20, 'Friday', '4', 'Tuesday'),
(21, 'Saturday', '4', 'Wednesday'),
(22, 'Sunday', '5', 'Wednesday'),
(23, 'Monday', '5', 'Thursday'),
(24, 'Tuesday', '5', 'Friday'),
(25, 'Wednesday', '5', 'Saturday'),
(26, 'Thursday', '5', 'Sunday'),
(27, 'Friday', '5', 'Monday'),
(28, 'Saturday', '5', 'Tuesday'),
(29, 'Sunday', '6', 'Tuesday'),
(30, 'Monday', '6', 'Wednesday'),
(31, 'Tuesday', '6', 'Thursday'),
(32, 'Wednesday', '6', 'Friday'),
(33, 'Thursday', '6', 'Saturday'),
(34, 'Friday', '6', 'Sunday'),
(35, 'Saturday', '6', 'Monday'),
(36, 'Sunday', '7', 'Monday'),
(37, 'Monday', '7', 'Tuesday'),
(38, 'Tuesday', '7', 'Wednesday'),
(39, 'Wednesday', '7', 'Thursday'),
(40, 'Thursday', '7', 'Friday'),
(41, 'Friday', '7', 'Saturday'),
(42, 'Saturday', '7', 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `ls_schedule`
--

CREATE TABLE IF NOT EXISTS `ls_schedule` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') NOT NULL,
  `group` enum('1','2','3','4','5','6','7') NOT NULL,
  `effective_from` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `type` enum('First','Second') NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ls_schedule`
--

INSERT INTO `ls_schedule` (`lid`, `day`, `group`, `effective_from`, `start_time`, `end_time`, `type`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Sunday', '1', '2012-01-16', '03:00:00', '09:00:00', 'First', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(2, 'Sunday', '1', '2012-01-16', '13:00:00', '19:00:00', 'Second', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(3, 'Monday', '1', '2012-01-16', '10:00:00', '17:00:00', 'First', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(4, 'Monday', '1', '2012-01-16', '20:00:00', '24:00:00', 'Second', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(5, 'Tuesday', '1', '2012-01-16', '09:00:00', '15:00:00', 'First', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(6, 'Tuesday', '1', '2012-01-16', '19:00:00', '24:00:00', 'Second', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(7, 'Wednesday', '1', '2012-01-16', '08:00:00', '14:00:00', 'First', 1, '2012-01-24 16:36:45', '2012-01-24 00:00:00'),
(8, 'Wednesday', '1', '2012-01-16', '17:00:00', '24:00:00', 'Second', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(9, 'Thursday', '1', '2012-01-16', '05:00:00', '13:00:00', 'First', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(10, 'Thursday', '1', '2012-01-16', '18:00:00', '24:00:00', 'Second', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(11, 'Friday', '1', '2012-01-16', '04:00:00', '11:00:00', 'First', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(12, 'Friday', '1', '2012-01-16', '15:00:00', '22:00:00', 'Second', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(13, 'Saturday', '1', '2012-01-16', '03:00:00', '10:00:00', 'First', 1, '2012-01-24 16:36:45', '0000-00-00 00:00:00'),
(14, 'Saturday', '1', '2012-01-16', '14:00:00', '20:00:00', 'Second', 1, '2012-01-24 16:36:08', '2012-01-24 16:36:08');
