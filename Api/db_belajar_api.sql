-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2017 at 10:56 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_belajar_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mhasiswa`
--

CREATE TABLE IF NOT EXISTS `tbl_mhasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `npm` int(15) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_mhasiswa`
--

INSERT INTO `tbl_mhasiswa` (`id`, `npm`, `nama`, `alamat`) VALUES
(5, 13421054, 'Dwi Romadon', 'Natar, Lampung Selatan'),
(6, 13421055, 'Andre Taulani', 'Bandar Lampung, Selatan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(23) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `encrypted_password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `unique_id` (`unique_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `unique_id`, `name`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(10, '5a239362ddc129.39554227', 'Dwi Romadon', 'dwi25@gmail.com', 'ezZk9rrly3GE1f160fX6KPbwSxI3YzAxY2Y0YzM2', '7c01cf4c36', '2017-12-03 13:02:10', NULL),
(11, '5a2393758abe95.17313581', 'kampret', 'kampret123@gmail.com', '4wB5CNKEkjfX24WAndoum/p/w4gyODFlYjAwZTk3', '281eb00e97', '2017-12-03 13:02:29', NULL),
(12, '5a24eed688f195.25574373', 'Dwi Romadon', 'test@gmail.com', 'gvDNiy1sklt9psU1+NCKZWmNetI4MWIxNGZmMTg3', '81b14ff187', '2017-12-04 13:44:38', NULL),
(13, '5a38e1bbeab7b8.44915291', 'ss', 'ss@gmail.com', 'PvpKceCR45OiVXN/yrOvNldFi7ViZTc4ZDcxMDdj', 'be78d7107c', '2017-12-19 16:54:03', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
