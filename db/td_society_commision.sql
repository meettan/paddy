-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 12, 2020 at 03:51 PM
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
-- Table structure for table `td_society_commision`
--

CREATE TABLE `td_society_commision` (
  `kms_id` int(6) NOT NULL,
  `branch_id` int(6) NOT NULL,
  `trans_dt` date NOT NULL,
  `trans_cd` int(6) NOT NULL,
  `block_id` varchar(10) NOT NULL,
  `soc_id` varchar(20) NOT NULL,
  `mill_id` varchar(10) NOT NULL,
  `aggrement_no` varchar(20) NOT NULL,
  `sanc_no` varchar(55) NOT NULL,
  `wqsc` varchar(55) NOT NULL,
  `branch_ref_no` varchar(20) NOT NULL,
  `pool_type` varchar(10) NOT NULL,
  `soc_bill_no` varchar(15) NOT NULL,
  `soc_bill_date` date DEFAULT NULL,
  `rice_type` varchar(5) NOT NULL,
  `rate` decimal(4,2) NOT NULL,
  `qty` decimal(8,2) NOT NULL,
  `amount_claimed` decimal(8,2) NOT NULL,
  `tot_amt` decimal(8,2) NOT NULL,
  `sgst_amt` decimal(6,2) DEFAULT NULL,
  `cgst_amt` decimal(6,2) DEFAULT NULL,
  `tds_amt` decimal(6,2) NOT NULL,
  `paid_amt` decimal(8,2) NOT NULL,
  `pay_mode` varchar(20) NOT NULL,
  `bank_id` int(5) NOT NULL,
  `ref_no` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  `ho_bill_no` varchar(55) NOT NULL,
  `approved_status` enum('U','A') NOT NULL DEFAULT 'U',
  `created_by` varchar(50) NOT NULL,
  `created_dt` date DEFAULT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` date DEFAULT NULL,
  `approved_by` varchar(50) NOT NULL,
  `approved_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_society_commision`
--

INSERT INTO `td_society_commision` (`kms_id`, `branch_id`, `trans_dt`, `trans_cd`, `block_id`, `soc_id`, `mill_id`, `aggrement_no`, `sanc_no`, `wqsc`, `branch_ref_no`, `pool_type`, `soc_bill_no`, `soc_bill_date`, `rice_type`, `rate`, `qty`, `amount_claimed`, `tot_amt`, `sgst_amt`, `cgst_amt`, `tds_amt`, `paid_amt`, `pay_mode`, `bank_id`, `ref_no`, `remarks`, `ho_bill_no`, `approved_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`, `approved_by`, `approved_dt`) VALUES
(2, 343, '2020-11-12', 1, '02413', '192000234320017', '961', 'SCMF/SOUTH24PGS/19-2', 'SAN/123/', 'CS-6540/2019-20/0001', '345', 'C', '456', '2020-11-12', 'P', '31.25', '0.00', '0.00', '239591.00', NULL, NULL, '9999.99', '239591.00', 'CHEQUE', 3, '3456', 'kolkata', '', 'U', 'synergic', '2020-11-12', '', NULL, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_society_commision`
--
ALTER TABLE `td_society_commision`
  ADD PRIMARY KEY (`kms_id`,`branch_id`,`trans_cd`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
