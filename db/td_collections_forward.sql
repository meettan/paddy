-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 21, 2020 at 06:06 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `benfed`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_collections_forward`
--

CREATE TABLE `td_collections_forward` (
  `forward_dt` datetime DEFAULT NULL,
  `forward_bulk_trans_id` varchar(25) NOT NULL,
  `forward_trans_id` bigint(14) NOT NULL,
  `ifsc_code` varchar(13) NOT NULL,
  `acc_no` bigint(20) NOT NULL,
  `forward_sl` int(2) NOT NULL DEFAULT '0',
  `bank_id` int(4) NOT NULL,
  `kms_id` int(5) NOT NULL,
  `response` varchar(55) DEFAULT NULL,
  `response_dt` datetime DEFAULT NULL,
  `status` enum('C','R') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
