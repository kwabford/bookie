-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 22, 2013 at 02:42 PM
-- Server version: 5.5.9
-- PHP Version: 5.5.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alas_311`
--

-- --------------------------------------------------------

--
-- Table structure for table `Books_311`
--

CREATE TABLE IF NOT EXISTS `Books_311` (
  `ISBN` char(50) NOT NULL,
  `Author` char(50) NOT NULL,
  `Title` char(50) NOT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Books_311`
--

INSERT INTO `Books_311` (`ISBN`, `Author`, `Title`, `Price`) VALUES
('12345', 'Eric Alas', 'Test Book', 45),
('123456', 'Eric Alas', 'Test book 1', 23),
('5678', 'Kwab', 'Book', 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
