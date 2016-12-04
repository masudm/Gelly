-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2016 at 10:31 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `recipe`
--
CREATE DATABASE IF NOT EXISTS `recipe` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `recipe`;

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

DROP TABLE IF EXISTS `featured`;
CREATE TABLE IF NOT EXISTS `featured` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL,
  `ingredient` text NOT NULL,
  `uniqueID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`uniqueID`),
  UNIQUE KEY `uniqueID` (`uniqueID`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recipeinfo`
--

DROP TABLE IF EXISTS `recipeinfo`;
CREATE TABLE IF NOT EXISTS `recipeinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `method` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_3` (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipeinfo`
--
ALTER TABLE `recipeinfo` ADD FULLTEXT KEY `name` (`name`);
ALTER TABLE `recipeinfo` ADD FULLTEXT KEY `name_2` (`name`);
ALTER TABLE `recipeinfo` ADD FULLTEXT KEY `name_3` (`name`,`ingredients`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
