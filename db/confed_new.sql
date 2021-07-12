-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2021 at 05:53 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `confed_new`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`wbsmconf_confed`@`%` FUNCTION `f_getclosing` (`adt_dt` DATE, `ad_acc_cd` INT(10)) RETURNS DECIMAL(10,2) NO SQL
BEGIN
    DECLARE	ld_cls_bal  	decimal(10,2);
    DECLARE	ls_acc_flag		varchar(5);
    DECLARE ldt_max_dt		date;
  
    SET ld_cls_bal = 0;
   
           Select max(balance_dt)
           into   ldt_max_dt
           From   tm_account_balance
           where  acc_code  = ad_acc_cd
           and    balance_dt <= adt_dt;
           
           Select IFNULL(balance_amt,0)
           Into   ld_cls_bal
           From   tm_account_balance
           Where  balance_dt = ldt_max_dt
           And    acc_code   = ad_acc_cd;
       
     
    return ld_cls_bal;
    
END$$

CREATE DEFINER=`wbsmconf_confed`@`%` FUNCTION `f_getopening` (`adt_dt` DATE, `ad_acc_cd` INT(10)) RETURNS DECIMAL(10,2) NO SQL
BEGIN
    DECLARE	ld_opn_bal  	decimal(10,2);
    
    DECLARE ldt_max_dt		date;
     
    
    SET ld_opn_bal = 0;
      
           Select max(balance_dt)
           into   ldt_max_dt
           From   tm_account_balance
           where  acc_code  = ad_acc_cd
           and    balance_dt < adt_dt;
           
           Select IFNULL(balance_amt,0)
           Into   ld_opn_bal
           From   tm_account_balance
           Where  balance_dt = ldt_max_dt
           And    acc_code   = ad_acc_cd;
        	
        
            
            
  
     
    return ld_opn_bal;
    
END$$

CREATE DEFINER=`wbsmconf_confed`@`%` FUNCTION `f_getparamval` (`ad_sl_no` INT) RETURNS VARCHAR(100) CHARSET latin1 NO SQL
BEGIN

	DECLARE ls_param_val varchar(100);

	select param_value
    into   ls_param_val
    from   md_parameters
    where  sl_no = ad_sl_no;
 
 RETURN (ls_param_val);
END$$

CREATE DEFINER=`wbsmconf_confed`@`%` FUNCTION `f_get_first_day` (`adt_dt` DATE) RETURNS DATE NO SQL
BEGIN
DECLARE ldt_dt   date;
DECLARE ld_month decimal(10);
DECLARE ld_year  decimal(10);

select month(adt_dt)
into   ld_month
from   dual;

select year(adt_dt)
into   ld_year
from   dual;

if ld_month >= 4 and ld_month <= 12 THEN
	
    SET ldt_dt = concat(ld_year,'-04-01');
ELSE
	SET ld_year = (ld_year - 1); 
    SET ldt_dt = concat(ld_year,'-04-01');
    
end if;
   
 
return ldt_dt;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `md_account_heads`
--

CREATE TABLE `md_account_heads` (
  `sch_code` int(11) NOT NULL,
  `acc_code` int(11) NOT NULL,
  `acc_head` varchar(100) NOT NULL,
  `acc_flag` char(1) NOT NULL,
  `auto_flag` char(1) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` date DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `md_account_heads`
--
DELIMITER $$
CREATE TRIGGER `ai_md_account_heads` AFTER INSERT ON `md_account_heads` FOR EACH ROW BEGIN
insert into tm_account_balance
select DISTINCT balance_dt,
       new.acc_code,
       new.acc_flag,
       0
from  tm_account_balance;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `md_bank`
--

CREATE TABLE `md_bank` (
  `sl_no` int(11) NOT NULL,
  `acc_code` varchar(10) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `ac_type` varchar(5) NOT NULL,
  `ac_no` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_bank`
--

INSERT INTO `md_bank` (`sl_no`, `acc_code`, `bank_name`, `branch_name`, `ac_type`, `ac_no`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, '10185', 'Axis Bank  -  1726', '', 'S', '915010065341726', 'Synergic Softek', '2018-10-10 01:25:09', NULL, NULL),
(2, '10188', 'Axis Bank  G.  C.  Ave.  A/c.  -  1146', 'G.C Avenue', 'C', '910020036541146', 'Synergic Softek', '2018-10-22 08:40:33', NULL, NULL),
(3, '10184', 'Allahabad  Bank  Int.  A/c.  No.  1404', '', 'C', '50057591404', 'Synergic Softek', '2018-10-22 08:42:23', NULL, NULL),
(4, '10207', 'S.B.I.  Park  St. CD I  A/c.  No.  0851', 'Park Street', 'C', '30147550851', 'Synergic Softek', '2018-10-22 08:43:39', NULL, NULL),
(5, '10208', 'SBI  Park  St CD II  A/c.  No.  2309', 'Park Street', 'C', '30379602309', 'Synergic Softek', '2018-10-22 08:44:17', NULL, NULL),
(6, '10210', 'S.B.I-Suravi  A/c.Sys.(Todiman).', '', 'C', '31426358521', 'Synergic Softek', '2018-10-22 08:45:15', NULL, NULL),
(7, '10010', 'S.B.L-TodiM..Empl.G.Grattiity  Fund', '', 'C', '31895922163', 'Synergic Softek', '2018-10-22 08:45:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_bank_dtls`
--

CREATE TABLE `md_bank_dtls` (
  `acc_cd` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `bank_ac` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_block`
--

CREATE TABLE `md_block` (
  `sl_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `block_name` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_block`
--

INSERT INTO `md_block` (`sl_no`, `dist`, `block_name`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 8, 'Shympur-I', 'CONFED', '2019-03-12 08:19:39', NULL, NULL),
(2, 8, 'Shympur-II', 'CONFED', '2019-03-12 08:33:46', NULL, NULL),
(3, 8, 'Bagnan-I', 'CONFED', '2019-03-13 05:44:24', NULL, NULL),
(4, 8, 'Bagnan-II', 'CONFED', '2019-03-13 05:45:18', NULL, NULL),
(5, 11, 'Deganga', 'CONFED', '2019-03-13 05:45:55', NULL, NULL),
(6, 11, 'Hasnabad', 'CONFED', '2019-03-13 05:46:31', NULL, NULL),
(7, 11, 'Basirhat-II', 'CONFED', '2019-03-13 06:03:48', NULL, NULL),
(8, 11, 'Habra-I', 'CONFED', '2019-03-13 06:04:38', NULL, NULL),
(9, 11, 'Gaighata', 'CONFED', '2019-03-13 06:05:06', NULL, NULL),
(10, 11, 'Bongaon', 'CONFED', '2019-03-13 06:05:47', NULL, NULL),
(11, 11, 'Bagdah', 'CONFED', '2019-03-13 06:10:18', NULL, NULL),
(12, 9, 'Arambag', 'CONFED', '2019-03-13 07:44:31', 'CONFED', '2019-03-13 07:44:49'),
(13, 9, 'Goghat-I', 'CONFED', '2019-03-13 07:46:49', NULL, NULL),
(14, 9, 'Khanakul-I', 'CONFED', '2019-03-13 07:47:39', NULL, NULL),
(15, 9, 'Chanditala-I', 'CONFED', '2019-03-13 07:54:34', NULL, NULL),
(16, 9, 'Jangipara', 'CONFED', '2019-03-13 07:55:15', NULL, NULL),
(17, 10, 'Bharatpur-II', 'CONFED', '2019-03-13 07:56:53', NULL, NULL),
(18, 10, 'Kandi', 'CONFED', '2019-03-13 07:57:24', NULL, NULL),
(19, 10, 'Raninagar-II', 'CONFED', '2019-03-13 08:00:15', NULL, NULL),
(20, 10, 'Sagardighi', 'CONFED', '2019-03-13 08:01:44', NULL, NULL),
(21, 10, 'Beldanga-II', 'CONFED', '2019-03-13 08:04:05', NULL, NULL),
(22, 10, 'Jiaganj', 'CONFED', '2019-03-13 08:45:02', NULL, NULL),
(23, 3, 'Ketugram-I', 'CONFED', '2019-03-13 08:54:41', 'CONFED', '2019-04-04 06:47:53'),
(24, 3, 'Ketugram-II', 'CONFED', '2019-03-13 09:04:54', NULL, NULL),
(25, 3, 'Katwa-I', 'CONFED', '2019-03-13 09:05:46', NULL, NULL),
(26, 12, 'Patashpur-II', 'CONFED', '2019-03-13 10:58:33', NULL, NULL),
(27, 12, 'Khejuri-I', 'CONFED', '2019-03-13 10:59:50', 'CONFED', '2019-04-03 11:03:49'),
(28, 12, 'Ramnagar I', 'CONFED', '2019-03-13 11:12:31', 'Synergic Softek', '2019-04-05 08:44:55'),
(29, 12, 'Bhagwanpur II', 'CONFED', '2019-03-13 11:13:40', 'Synergic Softek', '2019-04-05 08:32:07'),
(30, 12, 'Khejuri-II', 'CONFED', '2019-03-13 11:18:55', 'Synergic Softek', '2019-04-05 08:31:32'),
(31, 12, 'Contai I', 'CONFED', '2019-04-04 06:35:56', 'Synergic Softek', '2019-04-05 08:35:15'),
(32, 12, 'Contai II', 'CONFED', '2019-04-05 06:13:55', 'Synergic Softek', '2019-04-05 08:35:41'),
(33, 12, 'Patashpur I', 'CONFED', '2019-04-05 07:51:49', 'Synergic Softek', '2019-04-05 08:36:17'),
(34, 9, 'Chinsurah-Mogra', 'Synergic Softek', '2019-04-05 07:53:52', NULL, NULL),
(35, 9, 'Balagarh', 'Synergic Softek', '2019-04-05 07:54:10', NULL, NULL),
(36, 9, 'Chanditala II', 'Synergic Softek', '2019-04-05 07:54:33', NULL, NULL),
(37, 9, 'Dhaniakhali', 'Synergic Softek', '2019-04-05 07:55:21', NULL, NULL),
(38, 9, 'Khanakul II', 'Synergic Softek', '2019-04-05 07:55:53', NULL, NULL),
(39, 9, 'Tarakeshwar', 'Synergic Softek', '2019-04-05 07:56:19', NULL, NULL),
(40, 9, 'Haripal', 'Synergic Softek', '2019-04-05 07:58:57', NULL, NULL),
(41, 9, 'Pandua', 'Synergic Softek', '2019-04-05 07:59:13', NULL, NULL),
(42, 9, 'Polba-Dadpur', 'Synergic Softek', '2019-04-05 07:59:33', NULL, NULL),
(43, 9, 'Pursurah', 'Synergic Softek', '2019-04-05 08:00:08', NULL, NULL),
(44, 9, 'Singur', 'Synergic Softek', '2019-04-05 08:00:21', NULL, NULL),
(45, 9, 'Goghat II', 'Synergic Softek', '2019-04-05 08:00:37', NULL, NULL),
(46, 8, 'Amta I', 'Synergic Softek', '2019-04-05 08:02:11', NULL, NULL),
(47, 8, 'Amta II', 'Synergic Softek', '2019-04-05 08:02:21', NULL, NULL),
(48, 8, 'Uluberia I', 'Synergic Softek', '2019-04-05 08:02:36', 'Synergic Softek', '2019-04-05 08:03:31'),
(49, 8, 'Uluberia II', 'Synergic Softek', '2019-04-05 08:02:51', 'Synergic Softek', '2019-04-05 08:03:43'),
(50, 8, 'Udaynarayanpur', 'Synergic Softek', '2019-04-05 08:04:13', NULL, NULL),
(51, 8, 'Jagatballavpur', 'Synergic Softek', '2019-04-05 08:04:35', NULL, NULL),
(52, 3, 'Purbasthali I', 'Synergic Softek', '2019-04-05 08:06:10', NULL, NULL),
(53, 3, 'Purbasthali II', 'Synergic Softek', '2019-04-05 08:06:22', NULL, NULL),
(54, 3, 'Kalna I', 'Synergic Softek', '2019-04-05 08:06:39', NULL, NULL),
(55, 3, 'Kalna II', 'Synergic Softek', '2019-04-05 08:06:47', NULL, NULL),
(56, 3, 'Bhatar', 'Synergic Softek', '2019-04-05 08:07:01', NULL, NULL),
(57, 3, 'Burdwan I', 'Synergic Softek', '2019-04-05 08:07:17', NULL, NULL),
(58, 3, 'Burdwan II', 'Synergic Softek', '2019-04-05 08:07:25', NULL, NULL),
(59, 3, 'Galsi I', 'Synergic Softek', '2019-04-05 08:07:54', NULL, NULL),
(60, 3, 'Galsi II', 'Synergic Softek', '2019-04-05 08:08:04', NULL, NULL),
(61, 3, 'Aushgram I', 'Synergic Softek', '2019-04-05 08:08:29', NULL, NULL),
(62, 3, 'Aushgram II', 'Synergic Softek', '2019-04-05 08:08:38', NULL, NULL),
(63, 3, 'Katwa II', 'Synergic Softek', '2019-04-05 08:09:21', NULL, NULL),
(64, 3, 'Jamalpur', 'Synergic Softek', '2019-04-05 08:09:49', NULL, NULL),
(65, 3, 'Memari I', 'Synergic Softek', '2019-04-05 08:10:09', NULL, NULL),
(66, 3, 'Memari II', 'Synergic Softek', '2019-04-05 08:10:20', NULL, NULL),
(67, 3, 'Mongalkote', 'Synergic Softek', '2019-04-05 08:11:02', NULL, NULL),
(68, 3, 'Monteswar', 'Synergic Softek', '2019-04-05 08:11:49', NULL, NULL),
(69, 3, 'Raina I', 'Synergic Softek', '2019-04-05 08:12:30', NULL, NULL),
(70, 3, 'Raina II', 'Synergic Softek', '2019-04-05 08:12:42', NULL, NULL),
(71, 3, 'Khandaghosh', 'Synergic Softek', '2019-04-05 08:13:12', NULL, NULL),
(72, 10, 'Bhaganwangola I', 'Synergic Softek', '2019-04-05 08:14:24', NULL, NULL),
(73, 10, 'Bhaganwangola II', 'Synergic Softek', '2019-04-05 08:14:44', NULL, NULL),
(74, 10, 'Berhampur', 'Synergic Softek', '2019-04-05 08:15:17', NULL, NULL),
(75, 10, 'Beldanga I', 'Synergic Softek', '2019-04-05 08:15:37', NULL, NULL),
(76, 10, 'Bharatpur I', 'Synergic Softek', '2019-04-05 08:15:48', 'Synergic Softek', '2019-04-05 08:16:36'),
(77, 10, 'Burwan', 'Synergic Softek', '2019-04-05 08:16:52', NULL, NULL),
(78, 10, 'Jalangi', 'Synergic Softek', '2019-04-05 08:17:07', NULL, NULL),
(79, 10, 'Suti I', 'Synergic Softek', '2019-04-05 08:17:37', NULL, NULL),
(80, 10, 'Suti II', 'Synergic Softek', '2019-04-05 08:17:51', NULL, NULL),
(81, 10, 'Farakka', 'Synergic Softek', '2019-04-05 08:18:07', NULL, NULL),
(82, 10, 'Hariharpara', 'Synergic Softek', '2019-04-05 08:18:26', NULL, NULL),
(83, 10, 'Raninagar I', 'Synergic Softek', '2019-04-05 08:19:51', NULL, NULL),
(84, 10, 'Raghunathganj I', 'Synergic Softek', '2019-04-05 08:20:23', NULL, NULL),
(85, 10, 'Raghunathganj II', 'Synergic Softek', '2019-04-05 08:20:36', NULL, NULL),
(86, 10, 'Domkal', 'Synergic Softek', '2019-04-05 08:21:02', NULL, NULL),
(87, 10, 'Khargram', 'Synergic Softek', '2019-04-05 08:21:25', NULL, NULL),
(88, 10, 'Lalgola', 'Synergic Softek', '2019-04-05 08:21:51', NULL, NULL),
(89, 10, 'Nabagram', 'Synergic Softek', '2019-04-05 08:22:10', 'Nemai Ghosh', '2020-10-08 07:20:04'),
(90, 10, 'Naoda', 'Synergic Softek', '2019-04-05 08:22:26', NULL, NULL),
(91, 10, 'Samserganj', 'Synergic Softek', '2019-04-05 08:22:54', NULL, NULL),
(92, 11, 'Amdanga', 'Synergic Softek', '2019-04-05 08:23:51', NULL, NULL),
(93, 11, 'Baduria', 'Synergic Softek', '2019-04-05 08:24:05', NULL, NULL),
(94, 11, 'Barrakpore I', 'Synergic Softek', '2019-04-05 08:24:38', NULL, NULL),
(95, 11, 'Basirhat I', 'Synergic Softek', '2019-04-05 08:25:23', NULL, NULL),
(96, 11, 'Barasat I', 'Synergic Softek', '2019-04-05 08:25:51', 'Synergic Softek', '2019-04-05 08:26:31'),
(97, 11, 'Barasat II', 'Synergic Softek', '2019-04-05 08:26:45', NULL, NULL),
(98, 11, 'Habra II', 'Synergic Softek', '2019-04-05 08:27:07', NULL, NULL),
(99, 11, 'Haroa', 'Synergic Softek', '2019-04-05 08:27:28', NULL, NULL),
(100, 11, 'Hingalganj', 'Synergic Softek', '2019-04-05 08:28:05', NULL, NULL),
(101, 11, 'Minakha', 'Synergic Softek', '2019-04-05 08:28:50', NULL, NULL),
(102, 11, 'Swarupnagar', 'Synergic Softek', '2019-04-05 08:29:13', NULL, NULL),
(103, 12, 'Egra I', 'Synergic Softek', '2019-04-05 08:30:31', NULL, NULL),
(104, 12, 'Egra II', 'Synergic Softek', '2019-04-05 08:30:50', NULL, NULL),
(105, 12, 'Bhagwanpur I', 'Synergic Softek', '2019-04-05 08:32:22', NULL, NULL),
(106, 12, 'Deshapran', 'Synergic Softek', '2019-04-05 08:32:48', NULL, NULL),
(108, 12, 'Haldia', 'Synergic Softek', '2019-04-05 08:37:01', NULL, NULL),
(109, 12, 'Mahishadal', 'Synergic Softek', '2019-04-05 08:37:33', NULL, NULL),
(110, 12, 'Nandingram I', 'Synergic Softek', '2019-04-05 08:38:02', NULL, NULL),
(111, 12, 'Nandingram II', 'Synergic Softek', '2019-04-05 08:38:18', NULL, NULL),
(112, 12, 'Tamluk', 'Synergic Softek', '2019-04-05 08:38:59', NULL, NULL),
(113, 12, 'Panskura', 'Synergic Softek', '2019-04-05 08:39:46', NULL, NULL),
(114, 12, 'Chandipur', 'Synergic Softek', '2019-04-05 08:40:32', NULL, NULL),
(115, 12, 'Sutahata', 'Synergic Softek', '2019-04-05 08:41:09', NULL, NULL),
(116, 12, 'Nandakumar', 'Synergic Softek', '2019-04-05 08:41:35', NULL, NULL),
(117, 12, 'Sahid Matangini', 'Synergic Softek', '2019-04-05 08:42:03', 'Anamita Sen', '2019-08-22 08:14:51'),
(118, 12, 'Ramnagar II', 'Synergic Softek', '2019-04-05 08:45:19', NULL, NULL),
(120, 12, 'Contai III', 'Anamita Sen', '2020-06-29 09:43:50', NULL, NULL),
(121, 12, 'Contai III', 'Anamita Sen', '2020-07-08 08:35:26', NULL, NULL),
(122, 21, 'Jaynagar II', 'Tumpa Majumdar', '2020-08-24 07:46:48', NULL, NULL),
(123, 21, 'Mathurapur II', 'Tumpa Majumdar', '2020-08-24 09:10:00', NULL, NULL),
(124, 14, 'Ranaghat II', 'Tumpa Majumdar', '2020-08-25 06:58:52', NULL, NULL),
(125, 14, 'Chakdaha', 'Tumpa Majumdar', '2020-08-25 07:06:34', NULL, NULL),
(126, 21, 'Basanti', 'Tumpa Majumdar', '2020-08-25 08:03:31', 'Tumpa Majumdar', '2020-08-25 08:05:16'),
(128, 21, 'Bhangarh-I', 'Tumpa Majumdar', '2020-08-25 08:12:57', NULL, NULL),
(132, 21, 'Budge Budge-I', 'Tumpa Majumdar', '2020-08-28 06:29:36', NULL, NULL),
(133, 21, 'Kakdwip', 'Tumpa Majumdar', '2020-08-28 06:46:04', 'Tumpa Majumdar', '2020-08-28 07:05:01'),
(135, 21, 'Sagar', 'Subrata Ghosh', '2020-08-28 07:51:20', 'Tumpa Majumdar', '2020-08-28 09:37:21'),
(136, 21, 'Magrahat I', 'Tumpa Majumdar', '2020-08-28 08:17:41', NULL, NULL),
(138, 21, 'Budge Budge -II', 'Sandip Kumar Das', '2020-09-04 05:48:10', 'Sandip Kumar Das', '2020-09-04 05:54:17'),
(139, 21, 'Kultali', 'Anamita Sen', '2021-01-11 07:45:41', NULL, NULL),
(140, 21, 'KULPI', 'Anamita Sen', '2021-01-11 07:46:25', NULL, NULL),
(141, 21, 'BISHNUPUR 1', 'Anamita Sen', '2021-01-14 06:09:59', NULL, NULL),
(143, 2, 'Harischandrapur - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(144, 2, 'Harischandrapur - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(145, 2, 'Chanchal - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(146, 2, 'Chanchal - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(147, 2, 'Ratua - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(148, 2, 'Ratua - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(149, 2, 'Gazole', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(150, 2, 'Bamangola', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(151, 2, 'Habibpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(152, 2, 'Maldah (Old)', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(153, 2, 'English Bazar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(154, 2, 'Manikchak', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(155, 2, 'Kaliachak - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(156, 2, 'Kaliachak - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(157, 2, 'Kaliachak - III', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(159, 5, 'Madarihat', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(160, 5, 'Kalchini', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(161, 5, 'Kumargram', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(162, 5, 'Alipurduar - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(163, 5, 'Alipurduar - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(164, 5, 'Falakata', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(165, 8, 'Domjur', NULL, '2021-07-07 16:08:23', NULL, '2021-07-07 16:08:23'),
(166, 8, 'Bally Jagachha', NULL, '2021-07-07 16:08:23', NULL, '2021-07-07 16:08:23'),
(167, 8, 'Sankrail', NULL, '2021-07-07 16:08:23', NULL, '2021-07-07 16:08:23'),
(168, 8, 'Panchla', NULL, '2021-07-07 16:08:23', NULL, '2021-07-07 16:08:23'),
(169, 9, 'Serampur Uttarpara', NULL, '2021-07-07 16:10:07', NULL, '2021-07-07 16:10:07'),
(170, 11, 'Barrackpur - II', NULL, '2021-07-07 16:17:59', NULL, '2021-07-07 16:17:59'),
(171, 11, 'Rajarhat', NULL, '2021-07-07 16:19:00', NULL, '2021-07-07 16:19:00'),
(172, 11, 'Sandeshkhali - I', NULL, '2021-07-07 16:19:00', NULL, '2021-07-07 16:19:00'),
(173, 11, 'Sandeshkhali - II', NULL, '2021-07-07 16:19:24', NULL, '2021-07-07 16:19:24'),
(174, 14, 'Chapra', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(175, 14, 'Hanskhali', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(176, 14, 'Haringhata', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(177, 14, 'Kaliganj', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(178, 14, 'Karimpur - I', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(179, 14, 'Karimpur - II', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(180, 14, 'Krishnaganj', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(181, 14, 'Krishnagar - I', NULL, '2021-07-07 16:22:16', NULL, '2021-07-07 16:22:16'),
(182, 14, 'Krishnagar - II', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(183, 14, 'Nabadwip', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(184, 14, 'Nakashipara', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(185, 14, 'Ranaghat - I', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(186, 14, 'Santipur', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(187, 14, 'Tehatta - I', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(188, 14, 'Tehatta - II', NULL, '2021-07-07 16:24:19', NULL, '2021-07-07 16:24:19'),
(189, 21, 'Baruipur', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(190, 21, 'Bhangar - II', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(191, 21, 'Bishnupur - II', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(192, 21, 'Canning - I', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(193, 21, 'Canning - II', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(194, 21, 'Diamond Harbour - I', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(195, 21, 'Diamond Harbour - II', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(196, 21, 'Falta', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(197, 21, 'Gosaba', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(198, 21, 'Jaynagar - I', NULL, '2021-07-07 16:27:29', NULL, '2021-07-07 16:27:29'),
(199, 21, 'Magrahat - II', NULL, '2021-07-07 16:31:40', NULL, '2021-07-07 16:31:40'),
(200, 21, 'Mandirbazar', NULL, '2021-07-07 16:31:40', NULL, '2021-07-07 16:31:40'),
(201, 21, 'Mathurapur - I', NULL, '2021-07-07 16:32:18', NULL, '2021-07-07 16:32:18'),
(202, 21, 'Namkhana', NULL, '2021-07-07 16:32:18', NULL, '2021-07-07 16:32:18'),
(203, 21, 'Patharpratima', NULL, '2021-07-07 16:33:34', NULL, '2021-07-07 16:33:34'),
(204, 21, 'Sonarpur', NULL, '2021-07-07 16:33:34', NULL, '2021-07-07 16:33:34'),
(205, 21, 'Thakurpukur Mahestola', NULL, '2021-07-07 16:33:34', NULL, '2021-07-07 16:33:34'),
(206, 19, 'Darjeeling Pulbazar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(207, 19, 'Kharibari', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(208, 19, 'Phansidewa', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(209, 19, 'Naxalbari', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(210, 19, 'Matigara', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(211, 19, 'Kurseong', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(212, 19, 'Mirik', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(213, 19, 'Jorebunglow Sukiapokhri', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(214, 19, 'Gorubathan', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(215, 19, 'Kalimpong - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(216, 19, 'Kalimpong -I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(217, 19, 'Rangli Rangliot', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(218, 20, 'Jalpaiguri', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(219, 20, 'Maynaguri', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(220, 20, 'Dhupguri', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(221, 20, 'Nagrakata', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(222, 20, 'Matiali', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(223, 20, 'Mal', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(224, 20, 'Rajganj', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(225, 17, 'Sitalkuchi', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(226, 17, 'Sitai', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(227, 17, 'Dinhata - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(228, 17, 'Dinhata - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(229, 17, 'Tufanganj - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(230, 17, 'Tufanganj - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(231, 17, 'Cooch Behar - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(232, 17, 'Haldibari', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(233, 17, 'Mekliganj', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(234, 17, 'Mathabhanga - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(235, 17, 'Mathabhanga - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(236, 17, 'Cooch Behar - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(237, 18, 'Suri - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(238, 18, 'Sainthia', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(239, 18, 'Labpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(240, 18, 'Nanoor', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(241, 18, 'Bolpur Sriniketan', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(242, 18, 'Illambazar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(243, 18, 'Dubrajpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(244, 18, 'Khoyrasol', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(245, 18, 'Suri - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(246, 18, 'Rajnagar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(247, 18, 'Mohammad Bazar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(248, 18, 'Murarai - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(249, 18, 'Murarai - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(250, 18, 'Nalhati - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(251, 18, 'Nalhati - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(252, 18, 'Rampurhat - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(253, 18, 'Rampurhat - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(254, 18, 'Mayureswar - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(255, 18, 'Mayureswar - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(256, 23, 'Kanksa', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(257, 23, 'Faridpur Durgapur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(258, 23, 'Pandabeswar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(259, 23, 'Ondal', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(260, 23, 'Raniganj', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(261, 23, 'Jamuria', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(262, 23, 'Barabani', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(263, 23, 'Salanpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(264, 22, 'Nayagram', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(265, 22, 'Gopiballavpur - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(266, 22, 'Gopiballavpur - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(267, 22, 'Jamboni', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(268, 22, 'Jhargram', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(269, 22, 'Binpur - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(270, 22, 'Binpur - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(271, 22, 'Sankrail', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(275, 6, 'Gangarampur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(276, 6, 'Harirampur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(277, 6, 'Bansihari', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(278, 6, 'Tapan', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(279, 6, 'Balurghat', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(280, 6, 'Hilli', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(281, 6, 'Kumarganj', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(282, 6, 'Kushmundi', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(283, 7, 'Debra', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(284, 7, 'Keshpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(285, 7, 'Daspur - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(286, 7, 'Daspur - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(287, 7, 'Ghatal', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(288, 7, 'Chandrakona - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(289, 7, 'Chandrakona - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(290, 7, 'Garbeta - III', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(291, 7, 'Garbeta - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(292, 7, 'Garbeta - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(293, 7, 'Salbani', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(294, 7, 'Midnapore', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(295, 7, 'Pingla', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(296, 7, 'Kharagpur - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(297, 7, 'Sabang', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(298, 7, 'Narayangarh', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(299, 7, 'Keshiary', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(300, 7, 'Dantan - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(301, 7, 'Dantan - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(302, 7, 'Mohanpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(303, 7, 'Kharagpur - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(304, 13, 'Chopra', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(305, 13, 'Hemtabad', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(306, 13, 'Itahar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(307, 13, 'Kaliaganj', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(308, 13, 'Raiganj', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(309, 13, 'Karandighi', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(310, 13, 'Goalpokhar - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(311, 13, 'Goalpokhar - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(312, 13, 'Islampur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(313, 15, 'Kotulpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(314, 15, 'Indus', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(315, 15, 'Sonamukhi', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(316, 15, 'Barjora', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(317, 15, 'Bankura - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(318, 15, 'Bankura - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(319, 15, 'Indpur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(320, 15, 'Chhatna', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(321, 15, 'Bankura Municipality', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(322, 15, 'Mejhia', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(323, 15, 'Saltora', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(324, 15, 'Gangajalghati', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(325, 15, 'Vishnupur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(326, 15, 'Jaypur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(327, 15, 'Sarenga', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(328, 15, 'Raipur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(329, 15, 'Ranibundh', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(330, 15, 'Hirbandh', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(331, 15, 'Patrasayer', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(332, 15, 'Khatra', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(333, 15, 'Simlapal', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(334, 15, 'Taldangra', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(335, 15, 'Onda', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(336, 16, 'Para', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(337, 16, 'Jaipur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(338, 16, 'Purulia - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(339, 16, 'Barabazar', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(340, 16, 'Raghunathpur - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(341, 16, 'Raghunathpur - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(342, 16, 'Jhalda - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(343, 16, 'Jhalda - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(344, 16, 'Bagmundi', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(345, 16, 'Balarampur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(346, 16, 'Manbazar - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(347, 16, 'Manbazar - II', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(348, 16, 'Bundwan', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(349, 16, 'Purulia - I', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(350, 16, 'Hura', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(351, 16, 'Puncha', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(352, 16, 'Kashipur', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(353, 16, 'Santuri', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(354, 16, 'Neturia', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00'),
(355, 16, 'Arsha', 'CONFED', '0000-00-00 00:00:00', 'CONFED', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `md_block_deleted`
--

CREATE TABLE `md_block_deleted` (
  `sl_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `block_name` varchar(50) NOT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_block_deleted`
--

INSERT INTO `md_block_deleted` (`sl_no`, `dist`, `block_name`, `deleted_by`, `deleted_dt`) VALUES
(5, 5, 'PAP', 'Synergic Softek', '2018-10-12 04:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `md_comm_params`
--

CREATE TABLE `md_comm_params` (
  `sl_no` int(11) NOT NULL,
  `param_name` varchar(100) NOT NULL,
  `boiled_val` decimal(10,2) NOT NULL DEFAULT 0.00,
  `raw_val` decimal(10,2) NOT NULL DEFAULT 0.00,
  `action` char(1) NOT NULL,
  `kms_yr` varchar(20) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_comm_params`
--

INSERT INTO `md_comm_params` (`sl_no`, `param_name`, `boiled_val`, `raw_val`, `action`, `kms_yr`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Minimum Support Price[MSP]', '1750.00', '1750.00', 'P', '2018-19', 'Synergic Softek', '2018-10-31 02:37:46', NULL, NULL),
(1, 'Minimum Support Price[MSP]', '1815.00', '1815.00', 'P', '2019-20', 'Synergic Softek', '2018-10-31 02:37:46', NULL, NULL),
(1, 'Minimum Support Price[MSP]', '1868.00', '1868.00', 'P', '2020-21', 'Synergic Softek', '2018-10-31 02:37:46', NULL, NULL),
(2, 'Statutory Charges[Market fee]', '0.00', '0.00', 'P', '2018-19', 'Synergic Softek', '2018-11-01 12:57:05', NULL, NULL),
(2, 'Statutory Charges[Market fee]', '0.00', '0.00', 'P', '2019-20', 'Synergic Softek', '2018-11-01 12:57:05', NULL, NULL),
(2, 'Statutory Charges[Market fee]', '0.00', '0.00', 'P', '2020-21', 'Synergic Softek', '2018-11-01 12:57:05', NULL, NULL),
(3, 'Mandi Labour Charge', '10.33', '10.33', 'P', '2018-19', 'Synergic Softek', '2018-11-01 12:57:52', NULL, NULL),
(3, 'Mandi Labour Charge', '10.33', '10.33', 'P', '2019-20', 'Synergic Softek', '2018-11-01 12:57:52', NULL, NULL),
(3, 'Mandi Labour Charge', '10.33', '10.33', 'P', '2020-21', 'Synergic Softek', '2018-11-01 12:57:52', NULL, NULL),
(4, 'Transportation Charges of paddy(1-25 KM)', '18.38', '18.38', 'P', '2018-19', 'Synergic Softek', '2018-11-01 12:59:17', NULL, NULL),
(4, 'Transportation Charges of paddy(1-25 KM)', '18.38', '18.38', 'P', '2019-20', 'Synergic Softek', '2018-11-01 12:59:17', NULL, NULL),
(4, 'Transportation Charges of paddy(1-25 KM)', '18.38', '18.38', 'P', '2020-21', 'Synergic Softek', '2018-11-01 12:59:17', NULL, NULL),
(5, 'Transportation Charges of paddy(26-50 KM)', '0.50', '0.50', 'P', '2018-19', 'Synergic Softek', '2018-11-01 12:59:54', NULL, NULL),
(5, 'Transportation Charges of paddy(26-50 KM)', '0.50', '0.50', 'P', '2019-20', 'Synergic Softek', '2018-11-01 12:59:54', NULL, NULL),
(5, 'Transportation Charges of paddy(26-50 KM)', '0.50', '0.50', 'P', '2020-21', 'Synergic Softek', '2018-11-01 12:59:54', NULL, NULL),
(6, 'Transportation Charges of paddy(51-99 KM)', '0.20', '0.00', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:00:18', NULL, NULL),
(6, 'Transportation Charges of paddy(51-99 KM)', '0.20', '0.00', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:00:18', NULL, NULL),
(6, 'Transportation Charges of paddy(51-99 KM)', '0.20', '0.00', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:00:18', NULL, NULL),
(7, 'Inter District Transportation Charges', '0.00', '0.00', 'P', '2018-19', 'Synergic Softek', '2019-07-03 12:46:47', NULL, NULL),
(7, 'Inter District Transportation Charges', '0.00', '0.00', 'P', '2019-20', 'Synergic Softek', '2019-07-03 12:46:47', NULL, NULL),
(7, 'Inter District Transportation Charges', '0.00', '0.00', 'P', '2020-21', 'Synergic Softek', '2019-07-03 12:46:47', NULL, NULL),
(8, 'Driage[@1% of MSP]', '0.00', '15.50', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:01:26', NULL, NULL),
(8, 'Driage[@1% of MSP]', '0.00', '15.50', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:01:26', NULL, NULL),
(8, 'Driage[@1% of MSP]', '0.00', '15.50', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:01:26', NULL, NULL),
(9, 'Commission to Society', '31.25', '31.25', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:01:58', NULL, NULL),
(9, 'Commission to Society', '31.25', '31.25', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:01:58', NULL, NULL),
(9, 'Commission to Society', '31.25', '31.25', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:01:58', NULL, NULL),
(10, 'Milling Charges', '30.00', '20.00', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:02:52', NULL, NULL),
(10, 'Milling Charges', '30.00', '20.00', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:02:52', NULL, NULL),
(10, 'Milling Charges', '30.00', '20.00', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:02:52', NULL, NULL),
(11, 'CGST on Milling Charges', '2.50', '2.50', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:05:41', NULL, NULL),
(11, 'CGST on Milling Charges', '2.50', '2.50', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:05:41', NULL, NULL),
(11, 'CGST on Milling Charges', '2.50', '2.50', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:05:41', NULL, NULL),
(12, 'SGST on Milling Charges', '2.50', '2.50', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:08:32', NULL, NULL),
(12, 'SGST on Milling Charges', '2.50', '2.50', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:08:32', NULL, NULL),
(12, 'SGST on Milling Charges', '2.50', '2.50', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:08:32', NULL, NULL),
(13, 'Administrative Charges', '17.50', '17.50', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:09:16', NULL, NULL),
(13, 'Administrative Charges', '18.15', '18.15', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:09:16', NULL, NULL),
(13, 'Administrative Charges', '18.15', '18.15', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:09:16', NULL, NULL),
(14, 'Out turn Ratio', '68.00', '67.00', 'P', '2018-19', 'Synergic Softek', '2018-11-01 01:12:18', NULL, NULL),
(14, 'Out turn Ratio', '68.00', '67.00', 'P', '2019-20', 'Synergic Softek', '2018-11-01 01:12:18', NULL, NULL),
(14, 'Out turn Ratio', '68.00', '67.00', 'P', '2020-21', 'Synergic Softek', '2018-11-01 01:12:18', NULL, NULL),
(15, 'Transportation Charges of CMR', '18.38', '18.38', 'C', '2018-19', 'Synergic Softek', '2018-11-01 01:13:37', NULL, NULL),
(15, 'Transportation Charges of CMR', '18.38', '18.38', 'C', '2019-20', 'Synergic Softek', '2018-11-01 01:13:37', NULL, NULL),
(15, 'Transportation Charges of CMR', '18.38', '18.38', 'C', '2020-21', 'Synergic Softek', '2018-11-01 01:13:37', NULL, NULL),
(16, 'Gunny Charge for Paddy', '28.10', '28.98', 'C', '2018-19', 'Synergic Softek', '2018-11-01 01:17:58', NULL, NULL),
(16, 'Gunny Charge for Paddy', '28.10', '28.98', 'C', '2019-20', 'Synergic Softek', '2018-11-01 01:17:58', NULL, NULL),
(16, 'Gunny Charge for Paddy', '28.10', '28.98', 'C', '2020-21', 'Synergic Softek', '2018-11-01 01:17:58', NULL, NULL),
(17, 'CGST for Gunny usage charges', '2.50', '2.50', 'C', '2018-19', 'Synergic Softek', '2018-11-01 01:18:42', NULL, NULL),
(17, 'CGST for Gunny usage charges', '2.50', '2.50', 'C', '2019-20', 'Synergic Softek', '2018-11-01 01:18:42', NULL, NULL),
(17, 'CGST for Gunny usage charges', '2.50', '2.50', 'C', '2020-21', 'Synergic Softek', '2018-11-01 01:18:42', NULL, NULL),
(18, 'SGST for Gunny usage charges', '2.50', '2.50', 'C', '2018-19', 'Synergic Softek', '2018-11-01 04:04:18', NULL, NULL),
(18, 'SGST for Gunny usage charges', '2.50', '2.50', 'C', '2019-20', 'Synergic Softek', '2018-11-01 04:04:18', NULL, NULL),
(18, 'SGST for Gunny usage charges', '2.50', '2.50', 'C', '2020-21', 'Synergic Softek', '2018-11-01 04:04:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_district`
--

CREATE TABLE `md_district` (
  `district_code` int(10) NOT NULL,
  `district_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_district`
--

INSERT INTO `md_district` (`district_code`, `district_name`) VALUES
(2, 'MALDAH'),
(3, 'PURBA BARDHAMAN'),
(4, 'KOLKATA'),
(5, 'ALIPURDUAR'),
(6, 'DAKHSHIN DINAJPUR'),
(7, 'PASCHIM MEDINIPUR'),
(8, 'HOWRAH'),
(9, 'HOOGHLY'),
(10, 'MURSHIDABAD'),
(11, 'NORTH 24 PARGANAS'),
(12, 'PURBA MEDINIPUR'),
(13, 'UTTAR DINAJPUR'),
(14, 'NADIA'),
(15, 'BANKURA'),
(16, 'PURULIA'),
(17, 'COOCHBEHAR'),
(18, 'BIRBHUM'),
(19, 'DARJEELING'),
(20, 'JALPAIGURI'),
(21, 'SOUTH 24 PARGANAS'),
(22, 'JHARGRAM'),
(23, 'PASCHIM BARDHAMAN'),
(24, 'KALIMPONG');

-- --------------------------------------------------------

--
-- Table structure for table `md_documents`
--

CREATE TABLE `md_documents` (
  `sl_no` varchar(10) NOT NULL,
  `documents` varchar(100) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_documents`
--

INSERT INTO `md_documents` (`sl_no`, `documents`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('1', 'Check List [ANNEXURE-I]', 'Synergic Softek', '2019-01-21 02:48:19', 'Synergic Softek', '2019-01-21 03:04:04'),
('2', 'Synopsis of Bill [ANNEXURE-II]', 'Synergic Softek', '2019-01-21 03:13:21', NULL, NULL),
('3(a)', 'Statement of Advance taken & Disbursement made thereof', 'Synergic Softek', '2019-01-21 03:14:12', 'Synergic Softek', '2019-01-21 03:14:30'),
('3(b)', 'Original Govt order/Notification containing rate at Market Fees', 'Synergic Softek', '2019-01-22 12:02:08', 'Synergic Softek', '2019-01-22 12:28:17'),
('3(c)', 'Original Voucher regarding payment of Market Fees', 'Synergic Softek', '2019-01-22 12:27:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_mill`
--

CREATE TABLE `md_mill` (
  `sl_no` int(11) NOT NULL,
  `mill_name` varchar(100) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `reg_date` date NOT NULL,
  `mill_addr` text NOT NULL,
  `block` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `ph_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(25) DEFAULT NULL,
  `acc_type` varchar(25) DEFAULT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` date NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_mill`
--

INSERT INTO `md_mill` (`sl_no`, `mill_name`, `reg_no`, `reg_date`, `mill_addr`, `block`, `dist`, `ph_no`, `email`, `bank_name`, `branch_name`, `acc_type`, `acc_no`, `ifsc_code`, `pan_no`, `gst_no`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Satyanaryan Rice Mill', '123', '2019-03-12', '', 1, 8, '0', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-03-12', NULL, NULL),
(2, 'MAA ANNAPURNA MINI RICE MILL', 'XXXXX', '2000-01-02', 'P.O. KALINDI', 28, 12, '9679468651', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-03-15', NULL, NULL),
(3, 'GOURI MINI RICE MILL', '1', '2000-01-01', 'VILL: KAMALNAYANBOY, P.O. ITABARIA, PIN-721456', 27, 12, '7797093517', '', 'IDBI BANK', 'MECHHEDA', 'Current Account', 0, 'IBKL0000752', 'AREPP94912', '13AREPP9436217P', 'CONFED', '2019-04-03', NULL, NULL),
(4, 'MA ANANDAMOYEE (Mini) RICE MILL', '001', '2000-01-01', 'VILL + P.O.KARALDA NIMAKBAR, DIST-PURBO MEDINIPUR', 27, 12, '9932977796', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-04', 'Anamita Sen', '2020-07-08'),
(5, 'BHARATMATA RICE MILL', '001', '2000-01-01', 'Vill + P.O. Dihibayra,\r\nPin 712413\r\n', 12, 9, '9474193030', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-04', NULL, NULL),
(6, 'OMKAR RICE MILL', '001', '2000-01-01', 'Vill-Kakhuria, P.O. Itaberia\r\nP.S. Pataspur,Pin 721456\r\n', 28, 12, '8967565728', '', '', '', 'Current Account', 0, '', '', '19AYOPS3202L1ZY', 'CONFED', '2019-04-04', NULL, NULL),
(8, 'Amboula Modern Rice Mill Pvt. Ltd.', '001', '2000-01-01', 'Vill-Amboula, P.O.Natagram\r\nP.S. Gaighata, Pin 743249\r\n', 9, 11, '9932819064', '', '', '', 'Current Account', 0, '', '', '19AALCA9406A1ZS', 'CONFED', '2019-04-04', 'CONFED', '2019-04-08'),
(9, 'Mother India Rice Mill', '001', '2000-01-01', 'Vill-Jinandapur, P.O.Islampur\r\nP.S. Ramnagar, Pin 721455\r\n', 12, 9, '9679033337', '', '', '', 'Current Account', 0, '', '', '19CKPS8081B1ZW', 'CONFED', '2019-04-04', NULL, NULL),
(10, 'Rajlaxmi Agro Food Product(P) Ltd.', '001', '2000-01-01', 'Vill & P.O- Gunanandabati,\r\nPin 742140\r\n', 21, 10, '8967503918', '', '', '', 'Current Account', 0, '', '', '19AAECR2126B1ZT', 'CONFED', '2019-04-04', NULL, NULL),
(11, 'Maa Namita Rice Mill', '001', '2000-01-01', 'Vill-Jinandapur, P.O.Islampur\r\nPS- Ramnagar, Pin 721455 \r\n', 28, 12, '9735293930', '', '', '', 'Current Account', 0, '', '', '19CKEPS8081B1ZW', 'CONFED', '2019-04-04', NULL, NULL),
(12, 'TRINATHESWAR AGRO PRODUCTS PVT. LTD', '22(Contai)', '1968-06-22', 'Vill-Baranalgeria, P.O. Atbati\r\nP.Segra, Pin 721422\r\n', 32, 12, '9046813381', '', 'SYNDICATE BANK', 'SATMILE', 'Current Account', 2147483647, 'SYNB0009780', 'AAFCT1185M', '19AAF6T1185MIZU', 'CONFED', '2019-04-05', NULL, NULL),
(13, 'J.H.M. RICE MILL PVT. LTD.', '0002/MR/Y/2018', '0001-01-01', 'Vill- Dakshingram, \r\nP.O. Polsanda, Pin 742181\r\n', 89, 10, '9733385300', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-05', NULL, NULL),
(14, 'NPG Rice Mill Pvt. Ltd.', '001', '0001-01-01', 'Vill-Kaukepara,\r\nP.O. Debalaya, Pin 743424\r\n\r\n', 5, 11, '9775259124', '', '', '', 'Current Account', 0, '', '', '19AACCN1698L12V', 'CONFED', '2019-04-05', NULL, NULL),
(16, 'RADHA KRISHNA RICE MILL', '001', '0001-01-01', 'Vill+P.O. Kalupur, Pin 743235\r\n', 11, 11, '8145376136', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-05', NULL, NULL),
(17, 'Shiba Kali Agro Products  Pvt Ltd', 'UI5400W82009PTC138141', '0001-01-01', 'Vill-Dakshinkhanda, P.O.-\r\nDuttabarutia, Pin 742401\r\n', 17, 10, '9434666356', '', 'ALLAHABAD BANK', 'SADAR', 'Current Account', 2147483647, 'ALLA0212713', 'AANCS8361A', '19AANCS8361A1ZA', 'CONFED', '2019-04-05', NULL, NULL),
(18, 'Berhampur Agro Med & Dairy Pvt. Ltd', '001', '0001-01-01', 'Vill- Dakshingram \r\nP.O.Palsanda Pin 742238\r\n', 89, 10, '9434572782', '', 'UNITED BANK OF INDIA', 'BERHAMPORE', 'Current Account', 2147483647, 'UTBI0BHW206', 'AABCB9908J', '19AABCB9908J1ZB', 'CONFED', '2019-04-05', NULL, NULL),
(19, 'M/S Loknath Food  Products', '62', '0001-01-01', 'Vill- Uttar Balarampur\r\nP.O. Mirga-chatra, Pin 712602\r\n', 14, 9, '9434057223', '', 'ALLAHABAD BANK', 'AEAMBAGH', 'Current Account', 2147483647, '', 'AABSL3562H', '19AABSL3562H1Z8', 'CONFED', '2019-04-05', 'Anamita Sen', '2021-01-08'),
(20, 'AJIT RICE MILL PVT.LTD.', '12/GOG-17-18', '0001-01-01', 'Vill- Patulsara, P.O. Mirgachatra\r\nVill- Uttar Balarampur\r\n', 13, 9, '9434057223', '', 'STATE BANK OF INDIA', 'ARAMBAGH', 'Current Account', 2147483647, 'SBIN0001744', 'AAFCA0208A', '19AAFCA0208A1ZG', 'CONFED', '2019-04-05', NULL, NULL),
(21, 'M/S Kalimata Rice Mill', '001', '0001-01-01', 'Vill+P.O. Bengai, Pin 712611\r\n', 12, 9, '9735850685', '', '', '', 'Current Account', 0, '', '', '19AADFK1968L1ZU', 'CONFED', '2019-04-08', NULL, NULL),
(22, 'HARAPARBATI AGRITECH PVT.LTD.', '001', '0001-01-01', 'VILL + P.O. BHARATPUR, PIN-742301, MURSHIDABAD', 76, 10, '9474318117', '', 'ALLAHABAD BANK', 'DEHAPARA', 'Current Account', 0, 'ALL40211245', 'AADCH7746Q', '', 'CONFED', '2019-04-08', NULL, NULL),
(23, 'Dolphin Food Processing  Pvt Ltd', '088821', '0001-01-01', 'Vill- Gopemohal,\r\nP.O. Shikrakulingram\r\nPin 743428\r\n', 95, 11, '9733642922', '', 'AXIS BANK LTD.', 'BASIRHAT', 'Current Account', 2147483647, 'UTIB0000548', 'AACCD4209R', '19AACCD4209R1Z8', 'CONFED', '2019-04-08', NULL, NULL),
(24, 'M/S Chakraborty Brothers', '001', '0001-01-01', 'Vill+P.O. Gopalnagar\r\nPin 743262\r\n', 10, 11, '9733543015', '', '', '', 'Current Account', 0, '', '', '19AABFC8785D128', 'CONFED', '2019-04-08', NULL, NULL),
(25, 'MAA LAXMI MINI RICE MILL', '001', '0001-01-01', 'Vill- Joygachi, Pin 743263\r\n', 8, 11, '7003618143', '', '', '', 'Current Account', 0, '', '', '19AKEPD1326J12E', 'CONFED', '2019-04-08', NULL, NULL),
(26, 'P.G Hi-Tech Rice Mill', '001', '0001-01-01', 'Vill-Kaukepara, P.O. Debalaya\r\n', 5, 11, '9732297721', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', NULL, NULL),
(27, 'P.G. Mini Modernised  Rice Mill', '001', '0001-01-01', 'Vill- Kaukepara,\r\nP.O. Debalaya, Pin 743424\r\n', 5, 11, '9732297721', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', NULL, NULL),
(28, 'BURORAJ RICE MILL UNIT:RADHYA SHYAMA AGRO INDUSTRIES', '001', '0001-01-01', 'Vill+P.O. Kandra, Pin 713129\r\n', 23, 3, '9933767672', '', '', '', 'Current Account', 0, '', '', '19AADFB8557A2ZI', 'CONFED', '2019-04-08', NULL, NULL),
(29, 'Maa Gouri Mini Rice  Mill', '001', '0001-01-01', 'Vill & P.O. Itaberia, Block-\r\nBalyagobindapur,Pin 721456\r\n', 26, 12, '9593518009', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', NULL, NULL),
(30, 'M/S Sitaram Rice Mill', '001', '0001-01-01', 'Vill & P.O. Khatul, Pin 712611\r\n', 12, 9, '9647601219', 'sunilghoshkm@gmail.com', 'STATE BANK OF INDIA', 'GORHATI MORE, ARAMBAGH', 'Current Account', 2147483647, 'SBIN0001744', 'AAKFS6730P', '19AAKFS6730P1ZD', 'CONFED', '2019-04-08', 'Anamita Sen', '2021-01-19'),
(31, 'Digambari Rice Mill  Pvt Ltd', '001', '0001-01-01', 'Vill-Modina, P.O. Gobindapur\r\nPin 712602\r\n', 12, 9, '9474704652', '', '', '', 'Current Account', 0, '', '', '19AACCD0290J12N', 'CONFED', '2019-04-08', NULL, NULL),
(32, 'Krish Agro Farms Pvt Ltd', '001', '2004-08-01', 'Vill+P.O.+P.S. Gurap, BLOCK- DHANISHKHALI, DIST- HOOGHLY\r\nPin 712303\r\n', 16, 9, '9883145844', 'krishagrofarmspvtltd97@gmail.com', 'ALLAHABAD BANK', 'BUDGE BUDGE', 'Current Account', 2147483647, 'ALLA0210301', 'AAFCK2693F', '19AAFCK2693F1ZB', 'CONFED', '2019-04-08', 'Anamita Sen', '2021-01-19'),
(33, 'SHREE RAMKRISHNA RICE MILL', '001', '0001-01-01', 'RANGAMATI , GOGHAT, HOOGHLY', 45, 9, '9093664227', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', NULL, NULL),
(34, 'JOYRAMPUR RICE MILL PVT.LTD', '001', '0001-01-01', 'DIHIDAYRA, ARAMBAGH, HOOGHLY', 12, 9, '9093664227', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', NULL, NULL),
(35, 'Radharani Rice Mill', '15-H.G', '2007-07-16', 'ARAMBAGH', 12, 9, '9735850685', '', '', '', 'Current Account', 0, '', '', '19AAHFR6279D12U', 'CONFED', '2019-04-08', NULL, NULL),
(36, 'Nakuleswar agro product (P) Ltd.', '00', '2009-07-21', 'VILL URA,P.O.URA PIN-713433,', 60, 3, '9932132806', 'jimmybansal@gmail.com', 'ORIENTAL BANK OF COMMERCE,', 'DURGAPUR', 'Savings Account', 2147483647, 'ORBC0100304', 'AADCN0532E', '19AADCN0532E1ZU', 'Nemai Ghosh', '2019-08-20', NULL, NULL),
(37, 'NITYANANDA RICE MILL', '021151', '2005-02-08', 'VILL: NATIONAL PARA, P.O.+BLOCK- KATWA, DIST- PURBA BARDHAMAN ,PIN-713130', 25, 3, '9002733202', 'nityanandaricemill@gmail.com', 'SBI', 'BURDWAN', 'Savings Account', 2147483647, 'SBIN0013504', 'AACCN1797N', '19AACCN1797N1ZR', 'Nemai Ghosh', '2019-08-20', 'Anamita Sen', '2021-01-14'),
(38, 'JAGADHATRI RICE MILL', '000', '2019-12-04', 'vill:Belepara, P.O.BENGAI, PIN-712611', 45, 9, '9434404669', 'jagadhatriricemill@gmail.com', '', '', 'Current Account', 0, '', '', '19AAFFJ7658E1ZL', 'Nemai Ghosh', '2020-08-06', NULL, NULL),
(39, 'Sangrampur Agro Food Product Pvt Ltd', '38', '2013-03-06', 'Vill & P.O.- Sangrampur, Block- Basirhat I, Dist- 24 Parganas (North), Pin- 743422', 95, 11, '9734366354', 'sangrampuragrofood98@gmail.com', 'ICICI Bank', 'Basirhat', 'Current Account', 2147483647, 'ICICI0000914', 'ACLFS7564A', '19ACLFS7564A1ZT', 'Anamita Sen', '2020-08-19', NULL, NULL),
(40, 'Maa Usha Rice Mill', '12678', '2014-10-08', 'Vill- Talai, P.O.- Jarur, Dist- Murshidabad, Pin- 742235', 84, 10, '8373055932', 'maausharicemill@gmail.com', 'Allahabad Bank', 'Raghunathgunj', 'Current Account', 2147483647, 'ALLA0212508', 'AATFM3580E', '19AATFM3580EIZV', 'Tumpa Majumdar', '2020-08-24', NULL, NULL),
(41, 'S.S.S Rice Mill Pvt Ltd', '133', '2020-07-05', 'Vill- Companirthek, P.O.- DK.Bayargndi, Dist- South 24 pgs, Pin- 743349', 123, 21, '9874031327', 'purkait5inc@yahoo.com', 'Bank of Baroda', 'Dharmatalla', 'Current Account', 2147483647, 'BARBODHACAL', 'AALCS0176M', '19AALCS0176M1ZS', 'Tumpa Majumdar', '2020-08-24', 'Anamita Sen', '2021-01-13'),
(42, 'Radhagobinda Rice Mill Pvt Ltd', '137258', '2009-07-06', 'Vill- Janulia, P.O.- Banwarabad, Dist- Murshidabad, Pin- 713123', 17, 10, '8348980815', 'radhagobindaricemillpvtltd@gmail.com', 'State Bank of India', 'Kastwa', 'Current Account', 2147483647, 'SBINO013504', 'AAECR9388K', '19AAECR9388K12G', 'Tumpa Majumdar', '2020-08-25', NULL, NULL),
(43, 'M/S Saha Husking And Paddy Processing', '496', '2008-12-13', 'Vill- Sarmastipur, P.O.- Dighra, Dist- Chakdaha, Pin- 741222', 125, 14, '8942089192', 'sahahuskingpaddyprocessing@gmail.com', 'Bank of India', 'Chakdaha', 'Current Account', 2147483647, 'BKID0004221', 'BOKPS1751K', '19BOKPS1751K1ZD', 'Tumpa Majumdar', '2020-08-25', NULL, NULL),
(44, 'Pir Gorachand Food Processing Pvt Ltd', '12933', '2008-12-13', 'Vill- Jagulgachi, P.O.- B. Gobindapur, Dist- South 24 Parganas, pIN- 743502', 128, 21, '9732971952', 'pgfoodprocessing@gmail.com', 'ICICI Bank', 'Ghatakpukur', 'Current Account', 2147483647, 'ICICI0003300', 'AAICP3987E', '19AAICP3987E1ZY', 'Tumpa Majumdar', '2020-08-25', NULL, NULL),
(45, 'Maa Tara Rice Mill', '1', '1996-12-11', 'Vill- Bagmari, P.O.- Budge Budge, Dist- SOUTH 24 Parganas, Pin- 700137', 132, 21, '8017226702', 'maatararice97@gmail.com', 'Dena Bank', 'Budge Budge', 'Current Account', 2147483647, 'BKDN0910836', 'AAFFM1784J', '19AAFFM1784J1ZW', 'Tumpa Majumdar', '2020-08-28', 'Tumpa Majumdar', '2020-08-28'),
(46, 'Daipayan Agro Food Product Pvt Ltd', '572815', '2003-08-12', 'Vill- Chakrajumolla, P.O.- Pailan, Dist- South 24 Pgs, Pin- 700104', 136, 21, '7003282817', 'daipayanagro_01@yahoo.com', 'ALLAHABAD BANK', 'THAKURPUKUR', 'Current Account', 2147483647, 'ALLA0212261', 'AAGCD1284L', '19AAGCD1284L1ZB', 'Tumpa Majumdar', '2020-08-28', 'Anamita Sen', '2021-01-13'),
(48, 'Anandamoyee Agro & Allied Products (P) Ltd.', '12', '2019-12-04', 'Vill: Jashoari, P.O.-Jashohari, P.S. -Kandi, Block,Kandi', 18, 10, '943475213', 'anandamoyee2008@gmail.com', '', '', 'Current Account', 0, '', 'AAFCA0090G', '19AAFCA0090G1ZW', 'Sandip Kumar Das', '2020-09-03', NULL, NULL),
(50, 'Hemjee Rice Mill', '19', '2019-12-09', 'Vill & P.O.: Koshigram, Block-Katwa-I, Dist: Purba Burdwan, Pin: 713150\r\n', 25, 3, '8348311125', '', '', '', 'Current Account', 0, '', 'AAEFH7731F', '19AAEFH7731F1ZC', 'Sandip Kumar Das', '2020-09-04', NULL, NULL),
(51, 'DUTTA MINI RICE MILL', '0001', '1999-01-01', 'GAIGHATA', 9, 11, '033', '', '', '', 'Current Account', 0, '', '', '', 'Nemai Ghosh', '2020-10-08', NULL, NULL),
(52, 'MAA UTTAR BAHANI AGRO INDUSTRIES PVT.LTD.', '002', '1999-01-01', 'NABAGRAM', 89, 10, '033', '', '', '', 'Current Account', 0, '', '', '000', 'Nemai Ghosh', '2020-10-08', NULL, NULL),
(53, 'MERY RICE MILL', '437', '2004-03-11', 'VILL- KAPASDANGA, P.O. GAYASPUR, BLOCK- BURWAN, DISTRICT-MURSHIDABAD, PIN- 742147', 77, 10, '9614139306', '', '', '', 'Current Account', 0, '', 'ABDFM1578P', '19ABDFM1578P1ZK', 'Anamita Sen', '2020-12-01', NULL, NULL),
(54, 'M/S SHIV RICE MILL', '23', '2004-08-22', 'VILL- MATHURAPUR, P.O. BARALA, BLOCK- RAGHUNATHGUNJ, DISTRICT- MURSHIDABAD, PIN- 742235', 22, 10, '9434854032', '', '', '', 'Current Account', 0, '', 'ABHFS7444L', '19ABHFS7444L1ZH', 'Anamita Sen', '2020-12-07', NULL, NULL),
(55, 'Minar Agro Pvt. Ltd', '25', '2004-02-28', 'Vill- Daulatpur, P.O. Chandur, Block- Arambagh, Dist- Hooghly, Pin- 712602', 12, 9, '9830538023', '', '', '', 'Current Account', 0, '', 'AAFCM9959E', '19AAFCM9959E1ZW', 'Anamita Sen', '2020-12-16', 'Anamita Sen', '2020-12-16'),
(56, 'MAA EKADASHI MINI MODERN RICE MILL', '593', '1960-04-04', 'VILL+P.O. -PAILAN, BLOCK- BISHNUPUR 1, DIST- SOUTH 24 PGS, PIN- 700104 ', 141, 21, '7003282817', 'debmondal_8@yahoo.in', 'DENA BANK', 'BEHALA', 'Current Account', 2147483647, 'BKIDN0910690', 'AALFM0124A', '19AALFM0124A1ZT', 'Anamita Sen', '2021-01-14', 'Anamita Sen', '2021-01-14'),
(57, 'KALIMATA AGRO PRODUCTS', '1768', '1995-02-04', 'VILL+P.O.- CHOTO BELUN, BLOCK- BURDWAN I, DIST- PURBA BARDHAMAN, PIN- 713102', 57, 3, '8972997944', 'ramprosadghosh52@gmail.com', 'INDIAN BANK', 'BURDWAN BRANCH', 'Current Account', 2147483647, 'IDBI000B033', 'AAJFK9870B', '19AAJFK9870B1ZO', 'Anamita Sen', '2021-01-18', NULL, NULL),
(58, 'M/S SHREE RAMKRISHNA RICE MILL', '8', '1998-08-08', 'VILL- RANGAMATI, P.O. SINGRAPUR, BLOCK- GOGHAT II, DIST- HOOGHLY, PIN- 712614', 45, 9, '9933308406', '', 'SBI', 'ARAMBAGH', 'Current Account', 2147483647, 'SBIN0001744', 'ACWFS8060L', '19ACWFS8060L1ZZ', 'Anamita Sen', '2021-01-19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_mill_deleted`
--

CREATE TABLE `md_mill_deleted` (
  `sl_no` int(11) NOT NULL,
  `mill_name` varchar(100) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `reg_date` date NOT NULL,
  `mill_addr` text NOT NULL,
  `block` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `ph_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(25) DEFAULT NULL,
  `acc_type` varchar(25) DEFAULT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) NOT NULL,
  `deleted_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_parameters`
--

CREATE TABLE `md_parameters` (
  `sl_no` int(11) NOT NULL,
  `param_desc` varchar(100) NOT NULL,
  `param_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_parameters`
--

INSERT INTO `md_parameters` (`sl_no`, `param_desc`, `param_value`) VALUES
(1, 'Name of Client', 'West Bengal State Consumers\' Co-operative Federation Ltd.'),
(2, 'Address', 'P-1,Hide Lane,Akbar Mansion 3rd Floor,Kolkata - 700073'),
(3, 'Previous Day Opened', '2018-08-21'),
(4, 'Current Day Opened', '2018-08-22'),
(5, 'Previous Financial Year', '2017'),
(6, 'Current Financial Year ', '2018'),
(7, 'DA Percentage', '3'),
(8, 'HRA Percentage', '12'),
(9, 'Cash Allowance', '0'),
(10, 'Medical Allowance', '500'),
(11, 'PF Percentage', '12'),
(12, 'Yearly increment ', '3'),
(13, 'Cash A/C Head Code', '10181'),
(14, 'Bonus Salary Range', '25000'),
(15, 'Bonus Salary Range for the year', '2015-16'),
(16, 'KMS Year Start Date', '2018-10-01'),
(17, 'KMS Year End Date', '2019-11-30'),
(18, 'Per boiled ', '68'),
(19, 'Raw Rice', '67');

-- --------------------------------------------------------

--
-- Table structure for table `md_society`
--

CREATE TABLE `md_society` (
  `sl_no` int(11) NOT NULL,
  `soc_name` varchar(100) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `reg_date` date NOT NULL,
  `soc_addr` text NOT NULL,
  `block` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `ph_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(25) DEFAULT NULL,
  `acc_type` varchar(25) DEFAULT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` date NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_society`
--

INSERT INTO `md_society` (`sl_no`, `soc_name`, `reg_no`, `reg_date`, `soc_addr`, `block`, `dist`, `ph_no`, `email`, `bank_name`, `branch_name`, `acc_type`, `acc_no`, `ifsc_code`, `pan_no`, `gst_no`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'KULTHA S.K.U.S. LTD.', '13 (MID)', '1952-05-07', 'Vill-Kultha,P.O.Bansgora Bazar\r\nP.S.Khejuri, Pin 721430\r\n', 27, 12, '9735293930', 'kulthaskusltd1952@gmail.com', 'AXIS BANK LTD', 'CONTAI (WB)', 'Savings Account', 2147483647, 'UTIB0000498', 'AACAK5099E', '', 'CONFED', '2019-03-12', 'CONFED', '2019-04-29'),
(2, 'CHANDPUR S.K.U.S LTD', '97', '1963-03-07', 'VILL-MOMINABAD, P.O. KANFALA, BLOCK-NABAGRAM, PIN-742181', 22, 10, '9732875167', 'chandpurskusltd002015@gmail.com', 'M.D.CC BANK LTD', 'NABAGRAM', 'Current Account', 2147483647, 'WBSCOMCCB08', 'AABAC1566D', '', 'CONFED', '2019-03-15', 'Synergic Softek', '2019-04-05'),
(3, 'BIRBANDAR S K U S LTD.', '72(MID)', '1971-03-15', 'VILL BIRBANDAR P.O.AJAYA', 27, 12, '8372945815', '', '', '', 'Current Account', 0, '', 'AABAB8748E', '', 'CONFED', '2019-04-03', 'CONFED', '2019-04-16'),
(4, 'CHARALPARA BHATTABATI S.K.U.S. LTD', '102', '1964-05-14', 'VILL- NARIKELBAGAN, P.O. BHATTABATI, P.S. NABAGRAM, PIN- 742149', 22, 10, '9593193598', 'charalparabhattabatiskusltd@gmail.com', 'MDCC BANK', 'NABAGRAM', 'Current Account', 2147483647, 'WBSCOMCCB08', 'AAALC1106B', '', 'CONFED', '2019-04-03', 'Nemai Ghosh', '2020-08-03'),
(5, 'RAMNAGAR BACHRA ANCHAL S.K.U.S.LTD', '36', '1978-01-12', 'VILL + P.O. -BACHRA, P.S. SAKTIPUR,\r\n PIN- 7421`63', 21, 10, '8967503918', 'rbeaskus@gmail.com', 'AXIS BANK LTD', 'BERHAMPORE', 'Current Account', 2147483647, 'UTIB0000163', 'AAAAR7296L', '', 'CONFED', '2019-04-03', 'CONFED', '2019-04-22'),
(6, 'CHHANDRA S.K.U.S. LTD', '2 H.G', '2010-03-25', 'Vill- Purba Birati,\r\nP.O. Harinkhola, \r\nP.S. Arambagh, Pin 712415\r\n', 12, 9, '9679033337', '', '', '', 'Current Account', 0, '', 'AABTC2477N', '', 'CONFED', '2019-04-03', 'Nemai Ghosh', '2020-08-03'),
(7, 'SRI AUROBINDO S K U S LTD.', '36', '1957-06-22', 'VILL+P.O. HAROP, P.S. BAGNAN, PIN 711303', 3, 8, '8145486961', '', 'IDBI BANK', 'MUGKALYAN', 'Current Account', 2147483647, 'IBKL0001398', 'AAGAS8502E', '', 'CONFED', '2019-04-03', 'CONFED', '2019-04-09'),
(8, 'BORAGRAMYA S.K.U.S. LTD', '44/24', '1927-01-01', 'VILL- BORA, P.O. THAKURNAGAR, PIN- 743287', 9, 11, '9002064472', '', 'AXIS BANK LTD', 'HABSA', 'Current Account', 2147483647, 'UTIB0000238', 'AACAB4013G', '', 'CONFED', '2019-04-03', 'CONFED', '2019-04-08'),
(9, 'BAPUJI S.K.U.S. LTD', '27', '1926-01-01', 'VILL- LAWA, P.O. ITABERIA, PIN- 721456', 26, 12, '9800432245', 'ricemill.omkar2005@gmail.com', 'HDFC', 'CONTAI', 'Current Account', 2147483647, 'HDFC0000848', 'AAALB0552G', '', 'CONFED', '2019-04-04', 'CONFED', '2019-04-09'),
(10, 'MANDERPUR S.K.U.S. LTD', '98 MID', '1958-03-12', 'VILL- MANDERPUR, P.O. MANDERPUR, PIN- 721433', 28, 12, '8016114955', 'manderpurskus@gmail.com', 'AXIS BANK LTD', 'CONTAI', 'Current Account', 2147483647, 'UTIB0000498', 'AAFAM1142H', '', 'CONFED', '2019-04-04', 'CONFED', '2019-04-16'),
(11, 'CHUNAIT S.K.U.S. LTD', '3 H. G.', '1953-07-06', 'VILL- CHUNAIT, P.O. CHUNAIT, PIN- 712413', 12, 9, '9474193081', '', 'HDCC BANK LTD', 'ARAMBAGH', 'Current Account', 2147483647, 'WBSC0HDCB06', 'AABAC8677R', '', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-03'),
(12, 'RAGHUNANDANPUR S K U S LTD', '15(Mid)', '1951-06-15', 'VILL-TATKAPUR, P.O. BANAMALICHATTA, P.S. MARISHDA, PIN 721449', 120, 12, '9564874875', '', '', '', 'Current Account', 0, '', 'AADAR8885J', '', 'CONFED', '2019-04-04', 'Anamita Sen', '2020-07-08'),
(13, 'GARBARI UNION CO-OPERATIVE AGRICULTURAL CREDIT SOCIETY LTD', '104 MID', '1958-04-01', 'VILL- JHINUKKHALI, P.O. NAZIRBAZAR, PIN- 721655', 29, 12, '8001030770', 'gorbariunion@gmail.com', '', '', 'Current Account', 2147483647, 'WBSC0MGCB05', 'AABAG5532D', '', 'CONFED', '2019-04-04', 'CONFED', '2019-04-09'),
(14, 'ALIPINA S.K.U.S. LTD', '99', '1954-05-10', 'VILL- NARIKELBARH, P.O. SHYAMPUR, PIN- 711314', 1, 8, '9609065229', 'alipinaskusltd@gmail.com', 'HDCC BANK LTD', 'SHYAMPUR', 'Savings Account', 2147483647, 'WBSC0HCCB03', 'AADAA8874A', '', 'CONFED', '2019-04-04', 'Sandip Kumar Das', '2020-09-10'),
(15, 'HARINARAYANPUR S.K.U.S LTD', '3 (H)', '1959-08-28', 'VILL- HARINARAYANPUR, P.O. GOBINDAPUR, PIN- 711314', 1, 8, '9775205027', 'hnprscty@yahoo.com', 'HDCC BANK LTD', '', 'Current Account', 2147483647, 'WBSC0HCCD03', 'AAAAH5918H', '', 'CONFED', '2019-04-04', 'CONFED', '2019-04-09'),
(16, 'TANGRA S.K.U.S LTD', '78/ 24 PARGANS', '1957-05-17', 'VILL- TANGRAGRAM, P.O. SUNDARPUR, PIN- 743251', 10, 11, '9735271694', 'tangraskuslimited@gmail.com', '', '', 'Current Account', 2147483647, 'WBSC0000027', 'AACAT6237H', '19AACAT6237H129', 'CONFED', '2019-04-04', 'CONFED', '2019-04-08'),
(17, 'PILKHAN MAJPARA S.K.U.S. LTD', '8HG', '1940-06-07', 'VILL- PILKHAN, P.O. PILKHAN, PIN- 712613', 14, 9, '9932996719', 'pilkhanskus@gmail.com', 'HDCC BANK LTD', 'KHANAKUL', 'Current Account', 2147483647, 'WBSC0HDCB09', 'AADAP8811E', '', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-06'),
(19, 'KRISHNARAMPUR GRAM PANCHAYAT SAMABAY KRISHI UNNAYAN SAMITY LTD', '17 HG', '2007-08-01', 'VILL + P.O. - JANGALPARA BAZAR, PIN- 712701', 15, 9, '9474751410', 'krishnarampurgskusltd@gmail.com', 'AXIS BANK LTD', 'MASAT', 'Current Account', 2147483647, 'UTIB0003040', 'AABAK6010C', '', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-03'),
(20, 'RAMPARA S.K.U.S. LTD', '14', '1960-02-22', 'VILL- RAMPARA, P.O. RAMPARA, PIN- 742189', 21, 10, '9153847799', 'ramparaskusltd@gmail.com', 'IDBI BANK', 'BERHAMPUR', 'Savings Account', 2147483647, 'IBKL0000257', 'AAAAR9524K', '19AAAAR9524K1Z2', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-03'),
(21, 'GULHATIA S.K.U.S.LTD', '4', '1978-11-25', 'VILL- GULHATIA, P.O. GULHATIA, PIN- 742401', 17, 10, '7407959899', 'gulhatiaskusltd@gmail.com', 'M.D.CC BANK LTD', 'SALAR', 'Current Account', 2147483647, 'WBSC0MCCB17', 'AAABG0759N', '19aaabg0759n12z', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-03'),
(22, 'NAIHATI S.K.U.S.LTD', '19 K.T. ', '1961-12-28', 'VILL- NAIHATI, P.O. SITAHATI, PIN- 713123', 24, 3, '9332125731', 'naihatiskusltd@gmail.com', 'BURDWAN CENTRAL CO-OPERATIVE BANK LTD', 'KATWA', 'Savings Account', 2147483647, 'HDFC0CBCCBL', 'AAAAN2476Q', '19AAAA2476Q1ZX', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-03'),
(23, 'NABAJAGARAN S.K.U.S. LTD', '6   24PGS(N)', '1997-07-29', 'VILL- GOBINDAPUR, P.O. FAZILPUR, PIN- 743423', 5, 11, '9734357352', 'khalakhaliskus1@gmail.com', '', '', 'Current Account', 0, '', 'AACAN1913C', '', 'CONFED', '2019-04-04', 'CONFED', '2019-04-08'),
(24, 'DEOLY S.K.U.S. LTD', '23', '1956-06-05', 'VILL- DEOLY, P.O. DEOLY, PIN- 711301', 1, 8, '9932764570', 'deloyskus@gmail.com', 'AXIS BANK LTD', 'Bagnan', 'Savings Account', 2147483647, 'UTIB0000580', 'AABAD1628B', 'AA1908180101565', 'CONFED', '2019-04-04', 'Nemai Ghosh', '2020-08-03'),
(25, 'BIRKUL BAIDYANATHPUR S.K.U.S. LTD', '22', '1972-04-06', 'VILL- BAIDYANATHPUR, P.O. BAIDYANATHPUR, PIN- 711312', 4, 8, '8900681830', 'birkulbaidyanathpurskus22@gmail.com', 'AXIS BANK LTD', 'BAGNAN', 'Current Account', 2147483647, 'UTIB0000580', 'AABAB6020H', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-09'),
(26, 'MANIKPUR UTTAR ABJANAGAR S.K.U.S. LTD', '116   24PGS', '1969-07-18', 'VILL- UTTAR ABJANAGAR, P.O. GOURIBHOJE, PIN- 743445', 5, 11, '9735762953', '', 'BANDHAN BANK', 'BARASAT', 'Current Account', 2147483647, 'BDBL0001071', 'AAGAM2121K', '19AACAM2121K1ZQ', 'CONFED', '2019-04-05', 'CONFED', '2019-04-09'),
(27, 'ANOWERBERIA S.K.U.S. LTD', '55   24PGS', '1952-05-28', 'VILL- ANOWERBERIA, P.O. MANIKTALA, PIN- 743263', 8, 11, '9874668534', 'abskusltd@gmail.com', 'AXIS BANK LTD', 'HABRA', 'Current Account', 2147483647, 'UTIB0000238', 'AADTA0079J', '', 'CONFED', '2019-04-05', 'Nemai Ghosh', '2020-08-03'),
(28, 'KULTIKARI G S  S.K.U.S. LTD', '55', '1964-02-06', 'VILL- KULTIKARI, P.O. KULTIKARI, PIN- 711312', 2, 8, '9002919013', 'kultikarig.s.skusltd556264@gmail.com', 'IDBI  LTD', 'MUGKALYAN', 'Savings Account', 2147483647, 'IBKL0001398', 'AAAAK6681J', '19AAAA6681J1Z7', 'CONFED', '2019-04-05', 'CONFED', '2019-04-09'),
(29, 'AMULIA S.K.U.S. LTD', '134   24PGS(N)', '1962-06-06', 'VILL- AMULIA, P.O. CHANDPUR, PIN- 743424', 5, 11, '9732500879', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-08'),
(30, 'NEGUA S K U S LTD.', '001', '0001-01-01', 'Vill& P.O. Negua, Pin 721448\r\n', 32, 12, '9932379711', '', '', '', 'Current Account', 0, '', 'AABAN2474M', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-16'),
(31, 'SANNYASITALA S K U S LTD.', '95', '1975-05-20', 'Vill & P.O. Amaipara, \r\nP.S. Jiagung, Pin 742123\r\n\r\n', 22, 10, '9475195818', '', 'AXIS BANK LTD.', 'BERHAMPUR', 'Current Account', 2147483647, 'UTIB0000163', 'AAFAS7288A', '', 'CONFED', '2019-04-05', 'Nemai Ghosh', '2020-08-03'),
(32, 'RAJAPUR \'O\' BAGPUKURIA SKUS LTD.', '100', '0001-01-01', 'Vill- Rajapur, \r\nP.O.Champapukur,P.S. Basirha\r\nPin 743291\r\n', 7, 11, '9732760849', '', 'AXIS BANK LTD.', 'BASIRHAT', 'Current Account', 2147483647, 'UTIB0000548', 'AABAR4580J', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-10'),
(33, 'BANKRISHNAPUR S.K.U.S. LTD', '10    HG', '1962-04-27', 'VILL- BANKRISHNAPUR, P.O. JANGALPARA, PIN- 712701', 15, 9, '9836217080', 'bankrishnapurskusltd1962@gmail.com', 'CENTRAL BANK OF INDIA', 'RABINDRA SARANI', 'Current Account', 2147483647, 'CBIN0280110', 'AACAB8104D', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-22'),
(34, 'Chandraban S K U S Ltd', '105 H.G', '1963-07-06', 'Vill+P.O.-Hiatpur\r\nP.S. Arambagh, Pin 712412\r\n', 12, 9, '9732831050', '', 'HDFC BANK', 'ARAMBAGH', 'Current Account', 2147483647, 'AABAC8677R', 'AABAC4314R', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-18'),
(35, 'RANJAPUR S.K.U.S. LTD', '2 HG', '1962-01-08', 'VILL- RANJAPUR, P.O. GOURANGACHACK, PIN- 712408', 16, 9, '9883145844', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-22'),
(36, 'CHAKBHOGI KSHETRAPAL S.K.U.S. LTD', '18 MID', '1960-08-01', 'VILL- CHAKBHOGI, P.O. BALYAGOBINDAPUR, PIN- 721440', 26, 12, '7872879100', '', 'VIDYASAGAR C.C BANK', 'PRATAPDIGHI', 'Current Account', 2147483647, 'WBSC0VCCB11', 'AABAC4846L', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-24'),
(37, 'Bagdah Large Sized Primary Co-operative Agricultural  Credit Society Ltd', '43/24', '1957-03-12', 'Vill+P.O. Kalupur, Pin 743235\r\n', 11, 11, '8145376136', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-08'),
(38, 'Arandi Samabay Krishi Unnayan Samity Ltd', '18 H.G', '1960-02-26', 'Vill+P.O. Arandi, P.S.\r\nArambagh, Pin 712413\r\n', 12, 9, '9732338430', '', 'H D C C BANK', 'ARAMBAGH', 'Current Account', 2147483647, 'WBSC0HDCB06', 'AACAA3072B', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-22'),
(39, 'PURBA SINDRANI S.K.U.S. LTD', '91    24PGS(N)', '1957-05-21', 'VILL- NALDUGARI, P.O. NALDUGARI, PIN- 743297', 11, 11, '9647667467', 'purbasindraniskus@gmail.com', 'IDBI BANK', 'BONGAON', 'Savings Account', 2147483647, '1BKL000L467', 'AABAP3655N', '', 'CONFED', '2019-04-05', 'Nemai Ghosh', '2020-08-03'),
(40, 'Paschim Talibpur S.K.U.S Ltd', '33', '1974-05-25', 'Vill & P.O. Talibpur, \r\nP.S. Salar Pin 742402\r\n', 17, 10, '8944965294', '', 'ALLAHABAD BANK', 'SALAR', 'Current Account', 2147483647, 'ALLA0212713', 'AABAP8518Q', '', 'CONFED', '2019-04-05', 'Nemai Ghosh', '2020-08-03'),
(41, 'PANCHPOTA S.K.U.S. LTD (NO.1)', '20   24PGS(N)', '1954-05-11', 'VILL- PANCHPOTA, P.O. DK PANCHPOTA, PIN- 743251', 10, 11, '9775284355', '', 'IDBI BANK', 'BONGAON', 'Savings Account', 2147483647, 'IBKL0001467', 'AACAP3771E', '', 'CONFED', '2019-04-05', 'Nemai Ghosh', '2020-08-03'),
(42, 'THE RADHAPUR LARGE SIZED PRIMARY CO-OPERATIVE AGRIL. CREDIT SOCIETY LTD', '34/HOWRAH', '1957-06-12', 'VILL- RADHAPUR, P.O. RADHAPUR, PIN- 711301', 1, 8, '9932641925', 'radhapurlspacs@gmail.com', 'AXIS BANK LTD', 'BAGNAN', 'Current Account', 2147483647, 'UTIB0000580', 'AAAAR5488G', '19AAAAR5488G1Z4', 'CONFED', '2019-04-05', NULL, NULL),
(43, 'ICHHAPUR S.K.U.S. LTD', '100', '1981-05-06', 'VILL- ICHHAPUR, P.O. MADHABPUR, PIN- 711315', 1, 8, '9143100753', 'somnathsomnath1972@gmail.com', 'HDCC BANK LTD', 'BELARI', 'Current Account', 2147483647, 'WBSC0HCCB12', 'AAAA19186Q', '', 'CONFED', '2019-04-05', 'Sandip Kumar Das', '2020-09-10'),
(44, 'Gobindapur Sri Ramkrishna S K U S Ltd', '101 H.G', '1961-07-13', 'Vill+P.O. Gobindapur\r\nP.S. Goghat, Pin 712602\r\n', 13, 9, '973394005', '', 'AXIS BANK LTD.', 'ARAMBAGH', 'Current Account', 2147483647, 'UTIB0000364', 'AABAG1932F', '', 'CONFED', '2019-04-05', 'CONFED', '2019-04-18'),
(45, 'BURWAN RANGE-II WHOLESALE CONSUMERS CO-OPERATIVE SOCIETY LTD', '13 K T', '1990-10-31', 'VILL- R.M.C. MARKET, KATWA, P.O. KHAJURDIHI, PIN 713130', 25, 3, '8597299059', '', 'AXIS BANK LTD', 'KATWA', 'Savings Account', 2147483647, 'UTIB0000320', 'AABAB7092F', '', 'CONFED', '2019-04-08', 'Subrata Ghosh', '2020-11-24'),
(46, 'MAA SARADA S.K.U.S. ', '10 H. G.', '2008-11-24', 'Vill+P.O. Bolundi, P.S.\r\nArambagh, Pin 712413\r\n', 12, 9, '9093664227', '', '', '', 'Current Account', 0, '', 'AAEAM5599P', '', 'CONFED', '2019-04-08', 'Nemai Ghosh', '2020-08-03'),
(47, 'Sri Ramkrishna S K U S Ltd', '15-H.G', '2007-07-16', 'Vill+P.O. Dihibayra, \r\nP.S. Arambagh, Pin 712413\r\n', 12, 9, '9735850685', '', 'PUNJAB NATIONAL BANK', 'ARAMBAGH', 'Current Account', 2147483647, 'PUNB0607200', 'AAIAS3704Q', '', 'CONFED', '2019-04-08', 'Nemai Ghosh', '2020-08-03'),
(48, 'SHIBNAGAR S.K.U.S.LTD.', '94', '1975-05-16', 'Vill-Sibnagar, P.O. Bichpara,\r\nP.S. Raninagar, Pin 742306\r\n', 19, 10, '9733384090', '', 'MDCCB', 'ISLAMPUR', 'Current Account', 2147483647, 'WBSC0MCCB16', 'AAQAS6398N', '', 'CONFED', '2019-04-08', 'Subrata Ghosh', '2020-03-17'),
(49, 'Mobarakpur SKUS Ltd', '20/HG', '1953-12-26', 'Vill-Mobarakpur, P.O.\r\n Ramnagar, P.S. Arambagh\r\nPin 712616\r\n', 12, 9, '9474704652', '', '', '', 'Current Account', 0, '', 'AADAM3044L', '', 'CONFED', '2019-04-08', 'Nemai Ghosh', '2020-08-06'),
(50, 'Netajee S K U S Ltd', '11/HG', '2007-05-16', 'Vill- Basantapur, \r\nP.O.+P.S. Arambagh\r\nPin 712601\r\n', 12, 9, '9647601219', '', '', '', 'Current Account', 0, '', 'AACAN6365L', '', 'CONFED', '2019-04-08', 'Nemai Ghosh', '2020-08-03'),
(51, 'Pioneer Agril Consumers Co-operative Society Ltd', '01', '1900-01-01', 'Vill+P.O.+P.S. - Hasnabad\r\nPin 743426\r\n', 6, 11, '1234567891', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', 'Nemai Ghosh', '2020-10-08'),
(52, 'Gangati S K U S Ltd', '01', '1900-01-01', 'Vill-Gangati, P.O. Chaita\r\nP.S. Basirhat, Pin 743445\r\n', 7, 11, '1234567891', '', '', '', 'Current Account', 0, '', '', '', 'CONFED', '2019-04-08', 'Anamita Sen', '2020-08-19'),
(53, 'KANDI THANA COOPERATIVE MARKETING SOCIETY LTD', '01', '1900-01-01', 'Vill-Dohalia,P.O. Kandi,\r\nPin 742138\r\n', 18, 10, '1234567891', '', '', '', 'Current Account', 0, '', 'AAAJK0823D', '', 'CONFED', '2019-04-09', 'CONFED', '2019-04-09'),
(54, 'Agnibina Pariseba Samabay Samity Ltd', '01', '1900-01-01', 'Vill & P.O. Harhari,\r\nP.S. Sagardighi, Pin 742226\r\n', 20, 10, '1234567891', '', '', '', 'Current Account', 0, '', 'AAIAA1406B', '', 'CONFED', '2019-04-09', 'CONFED', '2019-04-22'),
(55, 'Dakhina Kali Consumers  Co-op Society Ltd', '01', '1900-01-01', 'Vill- Dohulia, P.O. Kandi\r\nPin 742137\r\n', 18, 10, '1234567891', '', '', '', 'Current Account', 0, '', 'AABAD9503B', '`19AAECR2126B1ZB', 'CONFED', '2019-04-09', 'CONFED', '2019-04-22'),
(56, 'Swami Vivekananda  S.K.U.S Ltd', '01', '1900-01-01', 'Vill & P.O. Pulinda, \r\nP.S. Beldanga, Pin 742134\r\n', 75, 10, '1234567891', '', '', '', 'Current Account', 0, '', 'AAKAS0455N', '', 'CONFED', '2019-04-09', 'CONFED', '2019-04-22'),
(61, 'Dera S.K.U.S Ltd', '01', '1900-01-01', 'Vii-Dera,P.O. Kalindi\r\nPin 721455\r\n', 118, 12, '9679468651', '', '', '', 'Current Account', 0, '', 'AACAD3836G', '', 'CONFED', '2019-04-09', 'CONFED', '2019-04-16'),
(62, 'Nazir Bazar Ramkrishna  Service Co-operative  Society Ltd.', '01', '1900-01-01', 'Vill-Jhinuk Khali, P.O. Nazir\r\nBazar, Pin 721655\r\n', 29, 12, '9382464110', '', '', '', 'Current Account', 0, '', 'AAEAN4649P', '', 'CONFED', '2019-04-09', 'CONFED', '2019-04-17'),
(63, 'Pandugram Paschimpara  S K U S Ltd', '01', '1900-01-01', 'Vill- Pandugram, P.O. Khatundi\r\nPin 713129\r\n', 23, 3, '9933767672', '', 'AXIS BANK', 'KATWA', 'Savings Account', 2147483647, 'UTIB80000320', 'AABAP4817E', '19AABAP4817E1ZM', 'CONFED', '2019-04-09', 'Anamita Sen', '2021-01-14'),
(65, 'Ghoshpara S.K.U.S. Ltd', '55', '1960-03-31', 'Gram- Ghoshpara, P.O.- Koregram, Block- Bharatpore II, Dist- Murshidabad, Pin- 782808', 17, 10, '9153441755', 'ghoshparaskus55@gmail.com', 'M.D.C.C.B', 'Salar', 'Savings Account', 2147483647, '', 'AAABG0722D', '', 'Anamita Sen', '2020-08-17', NULL, NULL),
(66, 'Bamihati Raghabpur S.K.U.S. Ltd', '54', '1976-03-02', 'Gram- Bamihati Raghabpur, p.o.- Jassure, P.S.- Habra, Pin- 743233', 8, 11, '7602589570', 'bamihatiraghabpurskusltd@gmail.com', 'Indian Bank', 'Habra', 'Current Account', 2147483647, 'IDIB000H035', 'AACAB9134B', '19AACAB9134B1Z1', 'Anamita Sen', '2020-08-17', 'Nemai Ghosh', '2020-10-08'),
(67, 'Badeshola S.K.U.S. Ltd', '133', '1963-09-30', 'Gram- Badeshola, P.O.- Haripur, Dist- Hooghly, Pin- 712701', 15, 9, '9932708529', 'badesholaskusltd@gmail.com', 'Hooghly District Central Co-operative Bank Ltd', 'Chanditala ', 'Savings Account', 2147483647, 'WBSC0HDCB17', 'AAFAB8795F', 'ARNAA190419005698Q', 'Anamita Sen', '2020-08-17', NULL, NULL),
(69, 'Kanchdaha SKUS Ltd', '19', '1961-03-06', 'Vill & P.O.- Kanchdaha, Block- Swarupnagar, Dist- 24 parganas (North), Pin- 743247', 102, 11, '7865022300', 'kanchdahaskus2019@gmail.com', 'The W.B. State Co-operative Bank Ltd', 'Baduria', 'Savings Account', 129360019, 'WBSC0000029', 'AAABK0962F', 'NA', 'Anamita Sen', '2020-08-19', 'Anamita Sen', '2020-08-19'),
(70, 'BDO Para SKUS Ltd', '39', '2015-02-09', 'Vill- BDO Para, P.O.- N. Balagachi, Dist- Murshidabad, Pin- 742135', 73, 10, '8670130379', 'bdoparaskus@gmail.com', 'MDCC Bank', 'Lalbagh', 'Savings Account', 2147483647, 'WBSC0MCCB14', 'AADAB0720A', '', 'Tumpa Majumdar', '2020-08-24', 'Tumpa Majumdar', '2020-08-24'),
(71, 'Khalakhali SKUS Ltd', '20', '1976-09-29', 'Vill & P.O.- Khalakhali, Dist- South 24 Parganas, Pin- 743338  ', 122, 21, '9874031327', 'kaikhaliskus2gmail.com', 'Axis Bank', 'Baruipur', 'Current Account', 2147483647, 'UTIB0000259', 'AACAK1608B', '', 'Tumpa Majumdar', '2020-08-24', 'Anamita Sen', '2021-01-13'),
(72, 'Kazisaha SKUS Ltd', '168', '1965-12-05', 'Vill & P.O. - Kazisaha, Dist- Murshidabad, Pin- 742133', 75, 10, '9564055347', 'kazisahaskus19@gmail.com', 'MDCCB Ltd', 'Beldanga', 'Savings Account', 2147483647, 'WBSC0MCCB12', 'AADAK1412A', '19AADAK1412A1ZC', 'Tumpa Majumdar', '2020-08-25', NULL, NULL),
(73, 'Raghunathpur Jafarnagar SKUS Ltd', '243', '1963-01-05', 'Vill- Jafarnagar, P.O.- Halalpur, Dist- Nadia, Pin- 741202', 124, 14, '8637593854', '', 'IDBI Bank', 'Ranaghat', 'Savings Account', 2147483647, 'IBKL0001732', 'AACAR5334H', '', 'Tumpa Majumdar', '2020-08-25', 'Tumpa Majumdar', '2020-08-25'),
(74, 'Hiranmoypur SKUS Ltd', '246', '1963-03-30', 'Vill & P.O.- Hiranmoypur, Dist- South 24 Parganas, Pin- 743312', 126, 21, '9732971959', 'hiranmoypur820@gmail.com', 'ICICI Bank', 'Ghatakpukur', 'Savings Account', 2147483647, 'ICICI0003300', 'AABHA60080', '19AABAH6888DZD', 'Tumpa Majumdar', '2020-08-25', 'Tumpa Majumdar', '2020-08-25'),
(75, 'Monirtat SKUS Ltd', '146', '1962-12-26', 'Vill & P.O.- Madhyamonirtat, Dist- South 24 Parganas, Pin- 743349', 122, 21, '9153878147', 'monirtatskus222@gmail.com', 'ICICI Bank', 'Ghatakpukur', 'Savings Account', 19, 'ICICI0003300', 'AACAM1631N', '19AACAM1631NTZF', 'Tumpa Majumdar', '2020-08-25', 'Sandip Kumar Das', '2020-09-04'),
(76, 'Shyambati Bayugram SKUS Ltd', '80', '1963-03-22', 'Vill- Shyambati, P.O.- Dhulepur, Dist- Hooghly, Pin- 712616', 13, 9, '9382203502', 'shyambatiskusltd@gmail.com', 'ICICI Bank', 'Arambagh', 'Savings Account', 2147483647, 'ICICI0000823', 'AAGAS4406D', '19AAGAS4406D1ZN', 'Tumpa Majumdar', '2020-08-28', NULL, NULL),
(77, 'Sagar Thana Primary Co-op Marketing Society Ltd', '25', '1976-09-22', 'Vill & P.O.- Harinbari, Dist- South 24 Pgs, Pin- 743373', 135, 21, '9903944741', 'sagarthanaprimarycoopmarsocltd@gmail.com', 'Dena Bank', 'Budge Budge', 'Savings Account', 2147483647, 'BKDN0910836', 'AACAS5856R', '', 'Tumpa Majumdar', '2020-08-28', 'Anamita Sen', '2021-01-13'),
(78, 'Kashiabad SKUS Ltd', '170', '1963-03-29', 'Vill- Kashiabad, P.O.- MP. Kashiabad, Dist- South 24 Pgs, Pin- 743347', 133, 21, '9874031327', 'kashiabadskusltd@gmail.com', 'Bank of Baroda', 'Dharmatalla', 'Current Account', 2147483647, 'BARB0DHACAL', 'AABAK1310P', '', 'Tumpa Majumdar', '2020-08-28', NULL, NULL),
(79, 'Ramchandrapur SKUS Ltd', '24', '1960-05-23', 'Vill- Ramchandrapur, P.O.- Sherpur, Dist- South 24 Pgs, Pin- 743513', 136, 21, '7003282817', 'ramchandrapurskusltd@gmail.com', 'ICICI Bank', 'Thakurpukur', 'Current Account', 2147483647, 'ICICI0001973', 'AFAR0059J', '', 'Tumpa Majumdar', '2020-08-28', NULL, NULL),
(81, 'Ruharpara SKUS Ltd.', '20', '1998-01-01', 'Vill: Ruharpara,P.O.-Madanpur, P.S.-Daulatabad,Block-Berhampore, Dist: Murshidabad, Pin: 742304', 74, 10, '9832881652', '', '', '', 'Current Account', 0, '', 'AABAR2160E', '19AABAR2160E1ZS', 'Sandip Kumar Das', '2020-09-03', NULL, NULL),
(82, 'Pamaipur SKUS Ltd.', '12', '2019-12-04', 'Vill: Pamaipur, P.O.-Pamaipur, Block: Raninagar-I, P.S.-Islampur, Dist: Murshidabad, Pin: 742302', 83, 10, '9733654080', '', '', '', 'Current Account', 0, '', 'AAHAP1254B', '', 'Sandip Kumar Das', '2020-09-03', 'Sandip Kumar Das', '2020-09-03'),
(83, 'DK.BHEBIA S.K.U.S.LTD.', '32', '2019-12-17', 'Vill: DK Bhebia, P.O.-Bhebia, Block-Hasnabad, P.S.-Hasnabad, Dist: North 24 Pgs, Pin: 743456', 6, 11, '9732962934', '', '', '', 'Current Account', 0, '', 'AABAD6545P', '19AABAD6542P1Z6', 'Sandip Kumar Das', '2020-09-03', 'Nemai Ghosh', '2020-10-08'),
(84, 'Sutra SKUS Ltd.', '44', '2019-12-23', 'Vill: Sutra, P.O.-Gouripur, Block-Chakdaha, P.S.-Chakdaha, District: Nadia,PIN-741223\r\n', 125, 14, '6296123557', '', '', '', 'Current Account', 0, '', 'AADAS5605D', '19AADAS56005D1ZN', 'Sandip Kumar Das', '2020-09-03', 'Sandip Kumar Das', '2020-09-03'),
(85, 'Darappur SKUS Ltd.', '43', '2019-12-13', 'Vill: Darappur, P.O.-Darappur, Block: Chakdaha, P.S.-Chakdaha, Dist: Nadia, PIN: 741223', 125, 14, '7679593741', '', '', '', 'Current Account', 0, '', '19AABAD1279Q', '19AABAD1279Q1Z7', 'Sandip Kumar Das', '2020-09-03', NULL, NULL),
(87, 'Bishnupur SKUS Ltd.', '168', '2013-01-08', 'Vill: Bishnupur, P.O.: Sagarthana, P.O.: Sagar Bishnupur, Block: Sagar, P.S.: Gangasagar Kostal, Dist: South 24 Pgs, PIN: 743353', 135, 21, '9239593065', 'animeshm216@gmail.com', 'WBSCB LTD', '57 Sagar', 'Current Account', 2147483647, 'WBSC0000021', 'AACAB9678E', '', 'Sandip Kumar Das', '2020-09-04', 'Anamita Sen', '2021-01-13'),
(88, 'Hatari SKUS Ltd.', '300', '1928-09-29', 'VILL- CHARKHI, P.O.- BILLESWAR, BLOCK- KETUGRAM II, DIST- PURBA BARDHAMAN, Pin: 713130', 24, 3, '9083378758', 'hatariskusltd@gmail.com', 'THE BURDWAN CENTRAL CO-OP BANK LTD', 'KATWA', 'Savings Account', 2147483647, 'HDFCOCBCCBL', 'AAAAH7529B', '19AAAAH7529L1Z9', 'Sandip Kumar Das', '2020-09-04', 'Anamita Sen', '2021-01-14'),
(89, 'Purbasthali Block-II Cooperative Agricultural Marketing Society Ltd.', '19', '2019-12-09', 'Vill & PO: Patuli, Block-Purbasthali-II, PS-Purbasthali, Dist:-Purba Burdhaman, PIN-713514', 53, 3, '9547711154', '', '', '', 'Current Account', 0, '', 'AABAP7932J', '19AABAP7932J1Z5', 'Sandip Kumar Das', '2020-09-04', NULL, NULL),
(91, 'Bahirghannya Srirampur SKUS Ltd.', '45', '2019-12-30', 'Vill: Bahirghanny, P.O.-Galsi, Block: Galsi-II, P.S.-Galsi, Dist: Purba Burdwan, PIN: 713406', 60, 3, '8170047907', '', '', '', 'Current Account', 0, '', 'AACAB1096N', '', 'Sandip Kumar Das', '2020-09-04', NULL, NULL),
(92, 'Murgram SKUS Ltd.', '50', '2020-01-10', 'Vill: Murgram, P.O.-Murgram, Block-Kutugram-I, P.S.-Ketugram, District: Purba Bardhaman, PIN-713123', 23, 3, '9735997728', '', '', '', 'Current Account', 0, '', 'AACAM1471E', '', 'Sandip Kumar Das', '2020-09-04', NULL, NULL),
(93, 'Katwa Thana Cooperative Agiculural Marketing Society Ltd.', '27', '2019-12-16', 'Katwa Burdwan Road, P.O.-Katwa, Block: Katwa-I, P.S.-Katwa, Dist: Purba Burdwan, PIN-713130', 25, 3, '9800306922', '', '', '', 'Current Account', 0, '', 'AACAK1717F', '19AACAK1717F2ZU', 'Sandip Kumar Das', '2020-09-04', NULL, NULL),
(94, 'JOYCHANDRAPUR SKUS LTD', '001', '1999-01-01', 'NABAGRAM', 89, 10, '033', '', '', '', 'Current Account', 0, '', '', '', 'Nemai Ghosh', '2020-10-08', NULL, NULL),
(95, 'KISHOREPUR PASCHIMANCHAL SKUS LTD', '35(Hg)', '1965-06-02', 'VILL:BANDIPUR,P.O.MAYAL-BANDIPUR, DIST-HOOGHLY', 14, 9, '8343020684', '', '', '', 'Current Account', 0, '', 'AACAK9370Q', '19AACAK9370IZR', 'Nemai Ghosh', '2020-10-09', 'Anamita Sen', '2020-12-16'),
(96, 'JAJAN GUNDURIA ANCHAL FARMAR\'S CO-OP SOCIETY LTD', '352', '2004-04-20', 'VILL+P.O. - JAJAN, BLOCK+P.S. - BHARATPUR 1, DIST- MURSHIDABAD, PIN-742140', 76, 10, '8016727325', '', '', '', 'Current Account', 0, '', 'AAALJ0397F', '19AAALJ0397F1Z1', 'Anamita Sen', '2020-12-02', NULL, NULL),
(101, 'PANCHPOTA S.K.U.S. LTD NO.2', '421', '2019-03-31', 'VILL- PANCHPOTA, P.O. KALUPUR, BLOCK- GAIGHATA, P.S. BONGAO, DIST- NORTH 24 PARGANAS, PIN- 743235 ', 9, 11, '8670777067', 'panchpotaskus2@gmail.com', 'IDBI', 'BONGAON', 'Savings Account', 2147483647, '', 'AABAP6894R', '19AABAP6894R1ZE', 'Anamita Sen', '2021-01-06', 'Anamita Sen', '2021-01-06'),
(102, 'TIROL UNION LARGE SIZED PRIMARY CO-OP AGRIL CREDIT', '23HG', '1957-03-05', 'VILL+P.O. - TIROL, BLOCK+ P.S.- ARAMBAGH, DIST- HOOGHLY', 12, 9, '9933065850', 'tirolskus@gmail.com', 'HDCCB', 'ARAMBAGH', 'Savings Account', 2147483647, 'WBSCOHDCB06', 'AAEAT5991J', '', 'Anamita Sen', '2021-01-08', NULL, NULL),
(103, 'RADHABALLAVPUR SKUS LTD', '17-HG', '1953-07-24', 'VILL- RADHABALLAVPUR, P.O.- PATUL, BLOCK+P.S.- KHANAKUL1, DIST- HOOGHLY, PIN- 712406', 14, 9, '9775293822', 'radhaballavpurskus@gmail.com', 'HDCCBL', 'KHANAKUL', 'Current Account', 2147483647, '', 'AAFAR2872M', '', 'Anamita Sen', '2021-01-08', NULL, NULL),
(104, 'PANCHAPALLY SKUS LTD', '59/24PGS(N)', '1976-03-22', 'VILL- JAGANNATHPUR, P.O. TARAGUNIA, BLOCK+P.S.- BADURIA, DIST-NORTH 24 PARGANAS, PIN- 743401 ', 93, 11, '7501506075', 'panchapallyskusltd@gmail.com', 'AXIS BANK', 'BASIRHAT', 'Current Account', 2147483647, 'UTIB0000548', 'AADAP5857C', '19AADAP5857C1ZE', 'Anamita Sen', '2021-01-11', 'Anamita Sen', '2021-01-11'),
(105, 'KURULIA BAJITPUR SKUS LTD', '386/24PGS (N)', '1960-03-26', 'VILL-KURULIA, P.O. HAT KURULIA, BLOCK+P.S.- BAGDAH, DIST- NORTH 24 PGS, PIN- 743232 ', 11, 11, '9933703061', 'kbskusltd1960@gmail.com', 'IDBI', 'BONGAON', 'Savings Account', 2147483647, 'IBKL0001467', 'AABAK5375N', '19AABAK5375N1Z1', 'Anamita Sen', '2021-01-11', NULL, NULL),
(106, 'HALALPUR KRISHNAPUR HIJULISKUS LTD', '514', '1967-02-10', 'VILL+P.O.- HALALPUR, BLOCK- RANAGHAT II, P.S.- DHANTALA, DIST- NADIA, PIN- 741202', 124, 14, '7908336303', 'hkhskusltd@gmail.com', 'NDCCB', 'RANAGHAT', 'Current Account', 2147483647, 'WBSCONDCB02', 'AABAH7694B', '', 'Anamita Sen', '2021-01-11', NULL, NULL),
(107, 'CHAKBAIDYA SKUS LTD', '548', '1965-08-17', 'VILL-CHAKBAIDYA,P.O. BAIDYAHAT, BLOCK+P.S.-KULPI, DIST- SOUTH 24 PGS, PIN- 743336', 139, 21, '7003282817', '', 'WBSCB LTD', 'DIAMOND HARBOUR', 'Current Account', 2147483647, 'WBSC0000016', 'AABAC2978F', '', 'Anamita Sen', '2021-01-11', NULL, NULL),
(108, 'KAKDWIP UNION CO-OP L/S P.A.C.S. LTD', '177', '2016-01-05', 'VILL- KAKDWIP BAZAR, P.O.+BLOCK+P.S.- KAKDWIP, DIST- SOUTH 24 PGS, PIN- 743347', 133, 21, '8777056230', 'kucooplspacsltd@gmail.com', 'WBSC BANK', '45 KAKDWIP', 'Current Account', 2147483647, 'WBSC0000018', 'AACAK6283C', '19AACAK6283C1ZM', 'Anamita Sen', '2021-01-11', NULL, NULL),
(109, 'GOMAI SKUS LTD', '45', '1952-06-16', 'VILL+BLOCK- GOMAI, P.O.- PORSURA, DIST- PURBA BARDHAMAN, PIN- 713406', 60, 3, '9932970858', 'gomaiskusltd@gmail.com', 'THE BURDWAN CENTRAL COOPERATIVE BANK LTD', 'GALSI', 'Savings Account', 2147483647, 'HDFC0CBCCBL', 'AABAG7287P', '', 'Anamita Sen', '2021-01-14', 'Anamita Sen', '2021-01-14'),
(110, 'SUSUNIA SKUS LTD', '12KT', '1963-03-23', 'VILL- KULI, P.O. SUSUNIA, BLOCK- MANTESWAR, DIST- PURBA BARDHAMAN, PIN- 713145', 68, 3, '9433410549', 'hisusuniaskusltd29@gmail.com', 'AXIS BANK', 'KALNA BRANCH', 'Current Account', 2147483647, 'UTIB0000323', 'AAABS0868E', '19AAABS0868E1ZF', 'Anamita Sen', '2021-01-18', 'Anamita Sen', '2021-01-18'),
(111, 'BILLESWAR RASUI O TEORA SKUS LTD', '12KT', '1966-11-16', 'VILL+P.O.- BILLESWAR, P.S.- KETUGRAM, BLOCK- KETUGRAM II, DIST- PURBA BARDHAMAN, PIN-713150 ', 24, 3, '6297090898', 'billeswarasuioteoraskus@gmail.com', 'BANK OF INDIA', 'CHARKHI', 'Current Account', 2147483647, 'BKID0004219', 'AAALB2767P', '19AAALB2767P1ZM', 'Anamita Sen', '2021-01-18', NULL, NULL),
(112, 'MONBAR SKUS LTD', '20', '1966-05-23', 'VILL- MONBER, P.O.- MRIGALA, BLOCK- CHANDITALA II, DIST- HOOGHLY, PIN- 712311', 36, 9, '8016165829', 'ankursarkar_secretary@gmail.com', 'AXIS BANK', 'MONBER', 'Current Account', 2147483647, 'UTIB0001367', 'AAEAM1012B1', '19AAEAM1012B1ZB', 'Anamita Sen', '2021-01-18', NULL, NULL),
(113, 'JAYER SKUS LTD', '20', '1967-06-16', 'VILL+P.O. - JAYER, BLOCK- PANDUA, DIST- HOOGHLY, PIN- 712149 ', 41, 9, '03213 2434', 'jayerskus@gmail.com', 'HOOGHLY DISTRICT CENTRAL CO-OPERATIVE BANK LIMITED', 'PANDUA', 'Current Account', 2147483647, '', 'AAEAJ0209K', '', 'Anamita Sen', '2021-01-19', NULL, NULL),
(114, 'KHARSARAI SKUS LTD', '88', '1961-05-20', 'VILL+P.O.- KHARSARAI, BLOCK- CHANDITALA II, DIST- HOOGHLY, PIN- 712304', 36, 9, '8017568609', 'kharsaraiskus@gmail.com', 'AXIS BANK', 'BAIDYABATI', 'Current Account', 2147483647, 'UTIB0001357', 'AACAK3023A', '', 'Anamita Sen', '2021-01-19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_society_deleted`
--

CREATE TABLE `md_society_deleted` (
  `sl_no` int(11) NOT NULL,
  `soc_name` varchar(100) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `reg_date` date NOT NULL,
  `soc_addr` text NOT NULL,
  `block` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `ph_no` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(25) DEFAULT NULL,
  `acc_type` varchar(25) DEFAULT NULL,
  `acc_no` int(11) DEFAULT NULL,
  `ifsc_code` varchar(50) DEFAULT NULL,
  `pan_no` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) NOT NULL,
  `deleted_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `md_soc_mill`
--

CREATE TABLE `md_soc_mill` (
  `kms_year` varchar(10) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `agreement_no` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mm_kms_yr`
--

CREATE TABLE `mm_kms_yr` (
  `sl_no` int(10) NOT NULL,
  `kms_yr` varchar(10) NOT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mm_kms_yr`
--

INSERT INTO `mm_kms_yr` (`sl_no`, `kms_yr`, `from_date`, `to_date`, `status`) VALUES
(1, '2018-19', '2018-11-01', '2019-09-30', 'O'),
(2, '2019-20', '2019-11-01', '2020-09-30', 'C'),
(3, '2020-21', '2020-11-01', '2021-09-30', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `mm_users`
--

CREATE TABLE `mm_users` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` char(1) NOT NULL,
  `emp_cd` varchar(25) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_status` char(1) NOT NULL,
  `accounts` tinyint(1) NOT NULL DEFAULT 0,
  `payroll` tinyint(1) NOT NULL DEFAULT 0,
  `paddy` tinyint(1) NOT NULL DEFAULT 0,
  `dm` tinyint(1) NOT NULL DEFAULT 0,
  `sw` tinyint(1) NOT NULL DEFAULT 0,
  `st` tinyint(1) NOT NULL DEFAULT 0,
  `lv` tinyint(1) NOT NULL DEFAULT 0,
  `ddmo` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mm_users`
--

INSERT INTO `mm_users` (`user_id`, `password`, `user_type`, `emp_cd`, `user_name`, `user_status`, `accounts`, `payroll`, `paddy`, `dm`, `sw`, `st`, `lv`, `ddmo`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('10', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'MURSHIDABAD', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('11', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'NORTH 24 PARGANAS', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('12', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'PURBA MEDINIPUR', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('13', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'UTTAR DINAJPUR', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('14', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'NADIA', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('15', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'BANKURA', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('16', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'PURULIA', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('17', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'COOCHBEHAR', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('18', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'BIRBHUM', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('19', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'DARJEELING', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('2', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'MALDAH', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('20', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'JALPAIGURI', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('21', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'SOUTH 24 PARGANAS', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('3', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'PURBA BARDHAMAN', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('4', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'KOLKATA', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('5', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'ALIPURDUAR', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('6', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'DAKHSHIN DINAJPUR', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('7', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'PASCHIM MEDINIPUR', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('8', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'HOWRAH', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('9', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '', 'HOOGHLY', 'A', 0, 0, 0, 0, 0, 0, 0, 1, 'Synergic Softek', '2019-04-29 00:00:00', '', '2019-04-29 00:00:00'),
('anamita', '$2y$10$QmkLE5f23lNrdFQbQ7yULO6X0hCstQq5s./jwQ7pj3Omue.V4P856', 'G', '17', 'Anamita Sen', 'A', 0, 1, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-04-29 03:39:41', 'Synergic Softek', '2019-04-29 03:40:04'),
('anup', '$2y$10$mJZ7mkFyo7qMBxA0MITAVO5uDtVmzmxLItvHIo8mD.yMJLl2JdXhS', 'A', '104', 'Anup Chowdhury', 'A', 1, 1, 1, 1, 1, 1, 1, 0, 'Synergic Softek', '2020-02-17 09:36:30', 'Synergic Softek', '2020-02-17 09:37:29'),
('anutosh', '$2y$10$U06t94keoRjDTbCgCoXVZu6/HYhjX8mdsCxZgp5Puk8u2aza9mrA.', 'G', '4', 'Anutosh Roy', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 07:00:29', NULL, NULL),
('ARCS', '$2y$10$p6LA72tuMUzraRhBZUgb6.gibyPM6Opuif1K5Rd0uyIglHhSUq9ZW', 'A', '', 'Jyoti Shankar Mondal', 'A', 1, 1, 1, 1, 1, 0, 0, 0, 'Synergic Softek', '2019-04-29 11:30:22', NULL, NULL),
('arindam', '$2y$10$mS5gIrZ/A/BWSucXOW88Se9c.99PJDrGdTCwMBK8tnyJPZoHkESo.', 'G', '103', 'Arindam Das', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2020-02-17 09:37:59', NULL, NULL),
('arka', '$2y$10$cUaqW1GRXI9SdIYjkTy8K.uX/LV9x3lJ/d3eKkRMizYoJMhRYikF.', 'G', '23', 'Arka Prosad Sen', 'A', 1, 1, 0, 0, 0, 1, 0, 0, 'Synergic Softek', '2019-11-05 07:06:24', 'Synergic Softek', '2020-02-19 06:17:13'),
('bankim', '$2y$10$Xswgy0mBv5fgPwVW9nuj8u4xuf/E4/eqFnaJuNsFimAq8rVQTGGvi', 'G', '19', 'Bamkim Roy Chowdury', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 07:04:17', NULL, NULL),
('bapan', '$2y$10$GC6aJaGZWvWOgxa5eO.ja.6lTnQnMSN0YWjx9UTLJxu8OeMm4WGXy', 'G', '5', 'Bapan Chatterjee', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 07:01:22', NULL, NULL),
('CEO', '$2y$10$REA7XwVA96e/dVKyuxQK.ueUkMizHmFdfdOehS7.NHSUlIIvQ0aLm', 'A', '', 'Ajit Kumar Biswas', 'A', 1, 1, 1, 1, 1, 0, 0, 0, 'Synergic Softek', '2019-04-29 12:27:18', NULL, NULL),
('debashis', '$2y$10$dFOFuGGHiP6mZ1oHMB75DeqqzOiEq2DaqHjn7BuhwN5gtb5rJ.lNi', 'G', '105', 'Debashis Debnath', 'A', 1, 1, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2020-02-17 09:38:32', 'Synergic Softek', '2020-08-26 07:11:22'),
('dmd', '$2y$10$/UOORXdPpW3k3wcPgUgCMOta7B5EmkkrbC93HNl/k50P2C31VUisW', 'G', '15', 'Disaster Management Department', 'A', 0, 0, 0, 1, 1, 0, 0, 0, 'Synergic Softek', '2019-04-24 06:38:09', 'Synergic Softek', '2019-10-17 09:01:58'),
('gulshan', '$2y$10$dVO/lSQ2pT85IKlCP0uMqetWiD.2LQbMXrmLtetwsT46cpCpfb4F.', 'G', '3', 'Gulshan Gund', 'A', 0, 1, 0, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-10-17 06:32:44', NULL, NULL),
('islam', '$2y$10$fIoDego8UthyefI/qcd1Ge8OPzFEK1KxViQwYp0jgUWSq18qqWQiC', 'G', '1', 'Sheikh Samsul Islam', 'A', 1, 0, 0, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 06:58:40', NULL, NULL),
('mohan', '$2y$10$BKm7Pj1nY130tjNilFenoerEzcgZ/ODmlm.PTShlLT/7tAnl1/Nf6', 'G', '8', 'Mohan Ram', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 07:02:32', NULL, NULL),
('nemai', '$2y$10$WP917qXloaFOwQ3agJ17vedrbG6bgfYKcGWBRTthxwqy9s/8DyF4K', 'G', '13', 'Nemai Ghosh', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-04-29 03:38:26', NULL, NULL),
('rupa', '$2y$10$qjfRL.p5voHcQtk5refG8OHyploArcHltcPotye.R/wriIyykvhBi', 'G', '15', 'Rupa Hazra', 'A', 0, 0, 0, 1, 1, 0, 0, 0, 'Synergic Softek', '2019-04-30 07:09:57', NULL, NULL),
('sambhu', '$2y$10$hPbDZXw4YkGWkBy3dm7.muho5bcaHA2DSIeAods.MDIoPkr/KrfrG', 'G', '20', 'Sambhunath Narua', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 07:05:24', NULL, NULL),
('sandip', '$2y$10$gdcHUuUVi84xP4o8227g/.0xsT6zuTUfLl8/0rC5rQ8nCUBsv8TBu', 'G', '7', 'Sandip Kumar Das', 'A', 1, 0, 1, 0, 0, 1, 0, 0, 'Synergic Softek', '2019-04-29 03:39:03', 'Synergic Softek', '2019-07-04 12:33:25'),
('shila', '$2y$10$b/QQAqgxsvu7LwWcahlUge1xYIJ1PmVoRQmYTIGYGFrSng5e7Ltay', 'G', '', 'Shila Pal', 'A', 0, 0, 0, 1, 1, 0, 0, 0, NULL, NULL, NULL, NULL),
('shyamal', '$2y$10$AXVu38yPFnKCJQuQuPzZDOePbcotrk8gaag/CfbngxeyEWNcICveC', 'G', '6', 'Shyamal Samanta', 'A', 0, 0, 0, 0, 0, 1, 0, 0, 'Synergic Softek', '2019-11-05 07:01:55', NULL, NULL),
('sss', '$2y$10$TAB7eISC0m/dWOXyNks.huMmgrnL.YDADT/XTZVzmOok1MV.MwVIi', 'A', '100', 'Synergic Softek', 'A', 1, 1, 1, 1, 1, 1, 0, 0, 'Tanmy', '2018-08-20 00:00:00', 'Synergic Softek', '2019-07-04 11:25:49'),
('sss123', '$2y$10$hIrPeULLvbS9mB.tU33K4.vgHPLaqL4IOqzEkl5CJCK2mf8cN7.pW', 'G', '100', 'sss', 'A', 1, 1, 1, 1, 1, 1, 0, 0, 'Synergic Softek', '2019-07-04 11:04:46', 'Synergic Softek', '2019-07-04 12:32:16'),
('subhas', '$2y$10$DptAbRt7gT0Kfo3wCo0cwuEohn0DR923PRGoahtdoMOUcVh1AdhDy', 'G', '', 'Subhas Dutta', 'A', 1, 1, 1, 1, 1, 0, 0, 0, 'Synergic Softek', '2019-05-03 06:54:17', NULL, NULL),
('subhasis', '$2y$10$MEH9I6OFiz9QonC7ocmdO.g3LAkUsx1EvFxVu2LvR4QKnV26uSYRu', 'G', '22', 'Subhasis Saha', 'A', 1, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-04-29 03:36:54', 'Synergic Softek', '2019-04-29 03:37:52'),
('subrata', '$2y$10$mypNAYZopXGm7VVKDP6ghOBdkJef6vdOX.fF4uCun5W9VEkZsRb2e', 'G', '14', 'Subrata Ghosh', 'A', 1, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-04-29 03:37:33', NULL, NULL),
('surojit', '$2y$10$1mNepndjS5V4KzQKGSIv0eVatYNGh5xPNEUU91ZPWUTHaTMyFAbxC', 'G', '102', 'Surojit Banerjee', 'A', 0, 0, 1, 0, 1, 0, 0, 0, 'Synergic Softek', '2020-02-17 09:43:10', NULL, NULL),
('susanta', '$2y$10$Zwabwbpj5msEpOJRpknfI.2b.JEA/6xGov..8aQIMpPSAdMAiRt/C', 'G', '2', 'Susanta Kr. Chakrabarty', 'A', 0, 0, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 06:59:58', NULL, NULL),
('tarak', '$2y$10$RGoHVsnvWFIfMqcf/SWNQevURdun8cWDrqWtrclTOUyMjM3hXOFT2', 'G', '11', 'Tarak Nath Kar', 'A', 0, 0, 0, 0, 0, 1, 0, 0, 'Synergic Softek', '2019-11-05 07:03:15', NULL, NULL),
('tuhin', '$2y$10$0DZxu/Zacn.g5USXF27PeOSD7Ha2PTRaRWCbopSicwJzo7JXg6UFG', 'G', '24', 'Tuhinagshu Ghosh', 'A', 1, 0, 0, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-11-05 07:07:16', NULL, NULL),
('tumpa', '$2y$10$4M2okITvPUZY6ptQ3AJp6O.UjRXRAs.nAU34uv5V4kiBuCqXQFOYK', 'G', '12', 'Tumpa Majumdar', 'A', 0, 1, 1, 0, 0, 0, 0, 0, 'Synergic Softek', '2019-04-29 03:40:36', 'Synergic Softek', '2019-05-16 07:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `mm_users_deleted`
--

CREATE TABLE `mm_users_deleted` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` char(1) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_status` char(1) NOT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mm_users_deleted`
--

INSERT INTO `mm_users_deleted` (`user_id`, `password`, `user_type`, `user_name`, `user_status`, `deleted_by`, `deleted_dt`) VALUES
('arcs', '$2y$10$btDdMKRIlexk9hNGfm4NN.EdDpd40EHLUtaoMeNc41Ge/dokIbSLO', 'G', 'Jyoti Shankar Mondal', 'A', 'Synergic Softek', '2019-04-29 11:29:56'),
('confed', '$2y$10$8V8rjilB3obHpkmVvpoTaOL12wI/R4qkSJDuhhZG1E3GBpYzvN/sW', 'A', 'CONFED', 'A', 'CONFED', '2019-04-29 09:39:51'),
('surajit', '$2y$10$IMpwHZBVsAKUj3AQNM3G3urnDmp5KJkVM3NY5NJ9TMs7FDPpRnmpu', 'G', 'Surojit Banerjee', 'A', 'Synergic Softek', '2020-02-17 09:42:37'),
('susanta', '$2y$10$F9UBomNwWIDXeIWyFwS5M.3rV2A2i7zkCegBj7rb1j2YgZhSC04PK', 'S', 'Susanta Kr. Chakrabarty', 'A', 'Synergic Softek', '2018-10-05 07:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `td_bill`
--

CREATE TABLE `td_bill` (
  `bill_no` varchar(50) NOT NULL,
  `bill_dt` date NOT NULL,
  `kms_yr` varchar(15) NOT NULL,
  `pool_type` varchar(15) NOT NULL,
  `rice_type` varchar(20) NOT NULL,
  `dist` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL,
  `tot_msp` decimal(20,3) NOT NULL,
  `market_fee` int(11) NOT NULL,
  `mandi_chrg` decimal(10,2) NOT NULL,
  `transport_dist` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation2` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation3` decimal(10,2) NOT NULL DEFAULT 0.00,
  `inter_dist_transprt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `driage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `comm_soc` decimal(10,2) NOT NULL DEFAULT 0.00,
  `comm_mill` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cgst_milling` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sgst_milling` decimal(10,2) NOT NULL DEFAULT 0.00,
  `admin_chrg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tot_milled_paddy` decimal(10,2) NOT NULL DEFAULT 0.00,
  `out_ratio` int(11) NOT NULL,
  `sub_tot_cmr_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `sub_tot_cmr_rate` decimal(10,3) NOT NULL DEFAULT 0.000,
  `transport_dist1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_cmr1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_cmr2` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_cmr3` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gunny_usege` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cgst_gunny` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sgst_gunny` decimal(10,2) NOT NULL DEFAULT 0.00,
  `butta_cut` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gunny_cut` decimal(10,2) NOT NULL DEFAULT 0.00,
  `approval_status` varchar(1) NOT NULL DEFAULT 'U',
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` datetime DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_bill_deleted`
--

CREATE TABLE `td_bill_deleted` (
  `bill_no` varchar(50) NOT NULL,
  `bill_dt` date NOT NULL,
  `kms_yr` varchar(15) NOT NULL,
  `pool_type` varchar(15) NOT NULL,
  `rice_type` varchar(20) NOT NULL,
  `dist` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL,
  `tot_msp` decimal(20,3) NOT NULL,
  `market_fee` int(11) NOT NULL,
  `mandi_chrg` decimal(10,2) NOT NULL,
  `transport_dist` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation2` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation3` decimal(10,2) NOT NULL DEFAULT 0.00,
  `driage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `comm_soc` decimal(10,2) NOT NULL DEFAULT 0.00,
  `comm_mill` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cgst_milling` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sgst_milling` decimal(10,2) NOT NULL DEFAULT 0.00,
  `admin_chrg` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tot_milled_paddy` decimal(10,2) NOT NULL DEFAULT 0.00,
  `out_ratio` int(11) NOT NULL,
  `sub_tot_cmr_qty` decimal(20,2) NOT NULL DEFAULT 0.00,
  `sub_tot_cmr_rate` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transport_dist1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_cmr1` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_cmr2` decimal(10,2) NOT NULL DEFAULT 0.00,
  `transportation_cmr3` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gunny_usege` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cgst_gunny` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sgst_gunny` decimal(10,2) NOT NULL DEFAULT 0.00,
  `butta_cut` decimal(10,2) NOT NULL DEFAULT 0.00,
  `gunny_cut` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deleted_by` varchar(50) DEFAULT NULL,
  `deleted_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_bill_submit`
--

CREATE TABLE `td_bill_submit` (
  `submit_no` int(11) NOT NULL,
  `submit_date` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `pool_type` varchar(2) NOT NULL,
  `tot_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_by` varchar(50) NOT NULL,
  `created_dt` date NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_cmr_delivery`
--

CREATE TABLE `td_cmr_delivery` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `trans_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `tot_doisseued` decimal(10,3) NOT NULL DEFAULT 0.000,
  `sp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fci` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tot_delivery` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_cmr_offered`
--

CREATE TABLE `td_cmr_offered` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `trans_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `tot_paddy_delivered` decimal(10,3) NOT NULL DEFAULT 0.000,
  `milled` decimal(10,3) DEFAULT 0.000,
  `rice_type` char(1) NOT NULL,
  `resultant_cmr` decimal(10,3) NOT NULL DEFAULT 0.000,
  `sp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fci` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tot_offered` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_collections`
--

CREATE TABLE `td_collections` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `coll_no` bigint(20) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `no_of_camp` int(11) NOT NULL,
  `no_of_farmer` int(11) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_collections_deleted`
--

CREATE TABLE `td_collections_deleted` (
  `sl_no` int(11) NOT NULL,
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `coll_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `no_of_camp` int(11) NOT NULL,
  `no_of_farmer` int(11) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `deleted_by` varchar(50) NOT NULL,
  `deleted_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_commission_bill`
--

CREATE TABLE `td_commission_bill` (
  `trans_dt` date NOT NULL,
  `pmt_commission_no` bigint(20) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `tot_paddy` decimal(10,3) NOT NULL DEFAULT 0.000,
  `con_bill_no` varchar(9) NOT NULL,
  `con_bill_dt` date NOT NULL,
  `soc_bill_no` varchar(9) NOT NULL,
  `soc_bill_dt` date NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `rate_per_qtls` decimal(10,3) NOT NULL DEFAULT 0.000,
  `value` decimal(10,3) NOT NULL DEFAULT 0.000,
  `pool_type` char(2) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_commission_bill_dtls`
--

CREATE TABLE `td_commission_bill_dtls` (
  `trans_dt` date NOT NULL,
  `pmt_commission_no` bigint(20) NOT NULL,
  `tds_percentage` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deducted_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payble_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `kms_year` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_details_farmer`
--

CREATE TABLE `td_details_farmer` (
  `coll_no` bigint(20) NOT NULL,
  `trans_id` varchar(150) NOT NULL,
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL DEFAULT '',
  `beneficiary_name` varchar(250) NOT NULL,
  `ifsc` varchar(30) NOT NULL,
  `acc_no` varchar(30) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_details_farmer_cheque`
--

CREATE TABLE `td_details_farmer_cheque` (
  `coll_no` int(11) NOT NULL,
  `trans_id` varchar(150) NOT NULL,
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL DEFAULT '2018-19',
  `beneficiary_name` varchar(250) NOT NULL,
  `cheque_no` varchar(15) NOT NULL,
  `address` varchar(100) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_doc_maintenance`
--

CREATE TABLE `td_doc_maintenance` (
  `bill_no` int(11) NOT NULL,
  `pool_type` char(1) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `doc_id` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_do_isseued`
--

CREATE TABLE `td_do_isseued` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `trans_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `tot_cmr_offered` decimal(10,3) NOT NULL DEFAULT 0.000,
  `rice_type` char(1) NOT NULL,
  `resultant_cmr` decimal(10,1) NOT NULL DEFAULT 0.0,
  `sp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cp` decimal(10,3) NOT NULL DEFAULT 0.000,
  `fci` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tot_doisseued` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_incentive`
--

CREATE TABLE `td_incentive` (
  `trans_dt` date NOT NULL,
  `month` varchar(15) NOT NULL,
  `year` int(2) NOT NULL,
  `emp_no` int(2) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `amount` int(5) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_paid_bill_dtls`
--

CREATE TABLE `td_paid_bill_dtls` (
  `paid_no` int(11) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `pool_type` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_paid_dtls`
--

CREATE TABLE `td_paid_dtls` (
  `payment_dt` date NOT NULL,
  `paid_no` int(11) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `total_payble` decimal(10,2) DEFAULT 0.00,
  `amount` decimal(10,2) DEFAULT 0.00,
  `trans_type` char(1) NOT NULL,
  `chq_no` varchar(10) NOT NULL,
  `chq_dt` date NOT NULL,
  `bank` int(11) NOT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `approve_by` varchar(50) DEFAULT NULL,
  `approve_dt` datetime DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_payment_bill`
--

CREATE TABLE `td_payment_bill` (
  `trans_dt` date NOT NULL,
  `pmt_bill_no` bigint(20) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `tot_paddy` decimal(10,3) NOT NULL DEFAULT 0.000,
  `tot_cmr` decimal(10,3) NOT NULL DEFAULT 0.000,
  `con_bill_no` varchar(9) NOT NULL,
  `con_bill_dt` date NOT NULL,
  `mill_bill_no` varchar(9) NOT NULL,
  `mill_bill_dt` date NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `paddy_cmr` decimal(10,3) NOT NULL DEFAULT 0.000,
  `paddy_butta` decimal(10,3) NOT NULL DEFAULT 0.000,
  `extra_delivery` decimal(10,3) NOT NULL DEFAULT 0.000,
  `rice_type` char(1) NOT NULL,
  `pool_type` char(2) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_payment_bill_dtls`
--

CREATE TABLE `td_payment_bill_dtls` (
  `trans_dt` date NOT NULL,
  `pmt_bill_no` bigint(20) NOT NULL,
  `account_type` varchar(50) NOT NULL,
  `per_unit` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tds_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `cgst_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `sgst_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payble_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `kms_year` varchar(10) DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_payment_dtls`
--

CREATE TABLE `td_payment_dtls` (
  `payment_dt` date NOT NULL,
  `trans_no` int(11) NOT NULL,
  `pmt_bill_no` int(11) NOT NULL,
  `total_payble` decimal(10,2) DEFAULT 0.00,
  `amount` decimal(10,2) DEFAULT 0.00,
  `trans_type` char(1) NOT NULL,
  `chq_no` varchar(10) NOT NULL,
  `chq_dt` date NOT NULL,
  `bank` int(11) NOT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `approve_by` varchar(50) DEFAULT NULL,
  `approve_dt` datetime DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `mofified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_payment_received`
--

CREATE TABLE `td_payment_received` (
  `received_no` int(11) NOT NULL,
  `received_date` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `pool_type` varchar(2) NOT NULL,
  `payment_type` char(2) NOT NULL,
  `payment_for` char(4) NOT NULL,
  `receivable_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tot_amt` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_by` varchar(50) NOT NULL,
  `created_dt` date NOT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_received`
--

CREATE TABLE `td_received` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `trans_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_received_bill_dtls`
--

CREATE TABLE `td_received_bill_dtls` (
  `received_no` int(11) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `pool_type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_reg_farmer`
--

CREATE TABLE `td_reg_farmer` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `reg_no` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `farmer_no` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_submitted_bill_dtls`
--

CREATE TABLE `td_submitted_bill_dtls` (
  `submit_no` int(11) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `pool_type` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_transaction`
--

CREATE TABLE `td_transaction` (
  `trans_cd` bigint(20) NOT NULL,
  `trans_dt` date NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `dist` mediumint(9) NOT NULL,
  `block` int(11) NOT NULL,
  `camp_no` int(11) NOT NULL,
  `farmer_no` int(11) NOT NULL,
  `progressive` decimal(5,0) NOT NULL DEFAULT 0,
  `delivared_to_mill` decimal(10,3) NOT NULL DEFAULT 0.000,
  `resultant_cmr` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cmr_offered` decimal(10,3) NOT NULL DEFAULT 0.000,
  `do_isseue` decimal(10,3) NOT NULL DEFAULT 0.000,
  `cmr_delivered` decimal(10,3) NOT NULL DEFAULT 0.000,
  `approval_status` varchar(1) NOT NULL DEFAULT 'U',
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` date DEFAULT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_transaction_deleted`
--

CREATE TABLE `td_transaction_deleted` (
  `trans_cd` int(11) NOT NULL,
  `trans_dt` date NOT NULL,
  `soc_id` int(11) NOT NULL,
  `mill_id` int(11) NOT NULL,
  `dist` int(11) NOT NULL,
  `block` int(11) NOT NULL,
  `camp_no` int(11) NOT NULL,
  `farmer_no` int(11) NOT NULL,
  `progressive` decimal(5,0) NOT NULL DEFAULT 0,
  `delivared_to_mill` decimal(10,0) NOT NULL,
  `resultant_cmr` decimal(10,0) NOT NULL,
  `cmr_offered` decimal(10,0) NOT NULL,
  `do_isseue` decimal(10,0) NOT NULL,
  `cmr_delivered` decimal(10,0) NOT NULL,
  `deleted_by` varchar(50) NOT NULL,
  `deleted_dt` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_work_order`
--

CREATE TABLE `td_work_order` (
  `trans_dt` date NOT NULL,
  `kms_year` varchar(10) NOT NULL,
  `dist` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `soc_id` int(11) NOT NULL,
  `paddy_qty` decimal(10,3) NOT NULL DEFAULT 0.000,
  `created_by` varchar(30) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_wqsc_sheet`
--

CREATE TABLE `td_wqsc_sheet` (
  `sl_no` int(5) NOT NULL,
  `pool_type` varchar(5) NOT NULL,
  `dis_cd` int(5) NOT NULL,
  `wqsc_no` varchar(10) NOT NULL,
  `analysis_no` varchar(20) NOT NULL,
  `bill_no` varchar(50) NOT NULL,
  `trn_dt` varchar(15) NOT NULL,
  `no_bags` int(5) NOT NULL,
  `qty` int(10) NOT NULL,
  `remarks` varchar(15) NOT NULL,
  `kms_yr` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_wqsc_sheet_deleted`
--

CREATE TABLE `td_wqsc_sheet_deleted` (
  `sl_no` int(5) NOT NULL,
  `dis_cd` int(5) NOT NULL,
  `pool_type` int(5) DEFAULT NULL,
  `wqsc_no` varchar(10) CHARACTER SET latin1 NOT NULL,
  `analysis_no` varchar(20) CHARACTER SET latin1 NOT NULL,
  `bill_no` varchar(50) CHARACTER SET latin1 NOT NULL,
  `trn_dt` varchar(15) CHARACTER SET latin1 NOT NULL,
  `no_bags` int(5) NOT NULL,
  `qty` int(10) NOT NULL,
  `remarks` varchar(15) CHARACTER SET latin1 NOT NULL,
  `deleted_by` varchar(15) NOT NULL,
  `deleted_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `md_account_heads`
--
ALTER TABLE `md_account_heads`
  ADD PRIMARY KEY (`acc_code`);

--
-- Indexes for table `md_bank`
--
ALTER TABLE `md_bank`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_bank_dtls`
--
ALTER TABLE `md_bank_dtls`
  ADD PRIMARY KEY (`acc_cd`);

--
-- Indexes for table `md_block`
--
ALTER TABLE `md_block`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_block_deleted`
--
ALTER TABLE `md_block_deleted`
  ADD PRIMARY KEY (`sl_no`) USING BTREE;

--
-- Indexes for table `md_comm_params`
--
ALTER TABLE `md_comm_params`
  ADD PRIMARY KEY (`sl_no`,`kms_yr`) USING BTREE;

--
-- Indexes for table `md_district`
--
ALTER TABLE `md_district`
  ADD PRIMARY KEY (`district_code`);

--
-- Indexes for table `md_documents`
--
ALTER TABLE `md_documents`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_mill`
--
ALTER TABLE `md_mill`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_mill_deleted`
--
ALTER TABLE `md_mill_deleted`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_parameters`
--
ALTER TABLE `md_parameters`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_society`
--
ALTER TABLE `md_society`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_society_deleted`
--
ALTER TABLE `md_society_deleted`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `md_soc_mill`
--
ALTER TABLE `md_soc_mill`
  ADD PRIMARY KEY (`kms_year`,`soc_id`,`mill_id`);

--
-- Indexes for table `mm_kms_yr`
--
ALTER TABLE `mm_kms_yr`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `mm_users`
--
ALTER TABLE `mm_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `mm_users_deleted`
--
ALTER TABLE `mm_users_deleted`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `td_bill`
--
ALTER TABLE `td_bill`
  ADD PRIMARY KEY (`bill_no`,`pool_type`,`kms_yr`) USING BTREE;

--
-- Indexes for table `td_bill_submit`
--
ALTER TABLE `td_bill_submit`
  ADD PRIMARY KEY (`submit_no`);

--
-- Indexes for table `td_cmr_delivery`
--
ALTER TABLE `td_cmr_delivery`
  ADD PRIMARY KEY (`trans_no`);

--
-- Indexes for table `td_cmr_offered`
--
ALTER TABLE `td_cmr_offered`
  ADD PRIMARY KEY (`trans_no`);

--
-- Indexes for table `td_collections`
--
ALTER TABLE `td_collections`
  ADD PRIMARY KEY (`coll_no`);

--
-- Indexes for table `td_collections_deleted`
--
ALTER TABLE `td_collections_deleted`
  ADD PRIMARY KEY (`sl_no`) USING BTREE;

--
-- Indexes for table `td_commission_bill`
--
ALTER TABLE `td_commission_bill`
  ADD PRIMARY KEY (`trans_dt`,`pmt_commission_no`,`con_bill_no`,`kms_year`) USING BTREE;

--
-- Indexes for table `td_commission_bill_dtls`
--
ALTER TABLE `td_commission_bill_dtls`
  ADD PRIMARY KEY (`trans_dt`,`pmt_commission_no`,`tds_percentage`);

--
-- Indexes for table `td_details_farmer`
--
ALTER TABLE `td_details_farmer`
  ADD PRIMARY KEY (`trans_id`,`beneficiary_name`,`coll_no`) USING BTREE;

--
-- Indexes for table `td_details_farmer_cheque`
--
ALTER TABLE `td_details_farmer_cheque`
  ADD PRIMARY KEY (`trans_id`,`beneficiary_name`,`coll_no`) USING BTREE;

--
-- Indexes for table `td_doc_maintenance`
--
ALTER TABLE `td_doc_maintenance`
  ADD PRIMARY KEY (`bill_no`,`kms_year`,`doc_id`,`pool_type`) USING BTREE;

--
-- Indexes for table `td_do_isseued`
--
ALTER TABLE `td_do_isseued`
  ADD PRIMARY KEY (`trans_no`);

--
-- Indexes for table `td_incentive`
--
ALTER TABLE `td_incentive`
  ADD PRIMARY KEY (`trans_dt`,`month`,`year`,`emp_no`);

--
-- Indexes for table `td_paid_bill_dtls`
--
ALTER TABLE `td_paid_bill_dtls`
  ADD PRIMARY KEY (`paid_no`,`bill_no`,`kms_year`);

--
-- Indexes for table `td_paid_dtls`
--
ALTER TABLE `td_paid_dtls`
  ADD PRIMARY KEY (`paid_no`);

--
-- Indexes for table `td_payment_bill`
--
ALTER TABLE `td_payment_bill`
  ADD PRIMARY KEY (`trans_dt`,`pmt_bill_no`,`con_bill_no`,`kms_year`) USING BTREE;

--
-- Indexes for table `td_payment_bill_dtls`
--
ALTER TABLE `td_payment_bill_dtls`
  ADD PRIMARY KEY (`trans_dt`,`pmt_bill_no`,`account_type`);

--
-- Indexes for table `td_payment_dtls`
--
ALTER TABLE `td_payment_dtls`
  ADD PRIMARY KEY (`pmt_bill_no`,`trans_no`);

--
-- Indexes for table `td_payment_received`
--
ALTER TABLE `td_payment_received`
  ADD PRIMARY KEY (`received_no`);

--
-- Indexes for table `td_received`
--
ALTER TABLE `td_received`
  ADD PRIMARY KEY (`trans_no`);

--
-- Indexes for table `td_received_bill_dtls`
--
ALTER TABLE `td_received_bill_dtls`
  ADD PRIMARY KEY (`bill_no`,`kms_year`,`pool_type`,`received_no`) USING BTREE;

--
-- Indexes for table `td_reg_farmer`
--
ALTER TABLE `td_reg_farmer`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `td_submitted_bill_dtls`
--
ALTER TABLE `td_submitted_bill_dtls`
  ADD PRIMARY KEY (`bill_no`,`kms_year`,`pool_type`) USING BTREE;

--
-- Indexes for table `td_transaction`
--
ALTER TABLE `td_transaction`
  ADD PRIMARY KEY (`trans_cd`);

--
-- Indexes for table `td_transaction_deleted`
--
ALTER TABLE `td_transaction_deleted`
  ADD PRIMARY KEY (`trans_cd`,`trans_dt`) USING BTREE;

--
-- Indexes for table `td_work_order`
--
ALTER TABLE `td_work_order`
  ADD PRIMARY KEY (`order_no`);

--
-- Indexes for table `td_wqsc_sheet`
--
ALTER TABLE `td_wqsc_sheet`
  ADD PRIMARY KEY (`sl_no`,`kms_yr`,`pool_type`,`bill_no`) USING BTREE;

--
-- Indexes for table `td_wqsc_sheet_deleted`
--
ALTER TABLE `td_wqsc_sheet_deleted`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `md_bank`
--
ALTER TABLE `md_bank`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `md_block`
--
ALTER TABLE `md_block`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `md_block_deleted`
--
ALTER TABLE `md_block_deleted`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `md_district`
--
ALTER TABLE `md_district`
  MODIFY `district_code` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `md_mill`
--
ALTER TABLE `md_mill`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `md_mill_deleted`
--
ALTER TABLE `md_mill_deleted`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `md_parameters`
--
ALTER TABLE `md_parameters`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `md_society`
--
ALTER TABLE `md_society`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `md_society_deleted`
--
ALTER TABLE `md_society_deleted`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mm_kms_yr`
--
ALTER TABLE `mm_kms_yr`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `td_cmr_delivery`
--
ALTER TABLE `td_cmr_delivery`
  MODIFY `trans_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_cmr_offered`
--
ALTER TABLE `td_cmr_offered`
  MODIFY `trans_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_collections_deleted`
--
ALTER TABLE `td_collections_deleted`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_do_isseued`
--
ALTER TABLE `td_do_isseued`
  MODIFY `trans_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_received`
--
ALTER TABLE `td_received`
  MODIFY `trans_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_reg_farmer`
--
ALTER TABLE `td_reg_farmer`
  MODIFY `reg_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_work_order`
--
ALTER TABLE `td_work_order`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_wqsc_sheet`
--
ALTER TABLE `td_wqsc_sheet`
  MODIFY `sl_no` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_wqsc_sheet_deleted`
--
ALTER TABLE `td_wqsc_sheet_deleted`
  MODIFY `sl_no` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
