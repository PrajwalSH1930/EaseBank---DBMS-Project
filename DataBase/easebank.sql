-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 01:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `acc_id` int(3) NOT NULL,
  `acc_name` varchar(25) NOT NULL,
  `acc_num` varchar(25) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `acc_type` varchar(10) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `adhaar` varchar(12) NOT NULL,
  `pan` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `pwd` int(4) NOT NULL,
  `upi` varchar(25) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `acc_name`, `acc_num`, `gender`, `acc_type`, `phone`, `adhaar`, `pan`, `email`, `dob`, `address`, `pwd`, `upi`, `profile_pic`, `created_at`) VALUES
(1, 'Prajwal Hiremath', '1001143', 'M', 'Savings', 9353956074, '440812696487', 'BKTPH0483G', 'psh23g@gmail.com', '2003-09-30', 'Bailhongal', 1903, '9353956074@okeasebank', 'ph.jpg', '2024-03-10 19:36:46'),
(5, 'Mohd Gouse Mujawar', '1806558', 'M', 'Deposit', 8454017366, '111111111111', 'ABCDE12345', 'mohammadmujawar9766@gmail.com', '2003-06-23', 'Mumbai', 2610, '8454017366@okeasebank', '', '2024-03-11 11:24:16'),
(6, 'Tanmay Nidagundi', '1305099', 'M', 'Savings', 8050487989, '768769357619', 'CNSPN5522R', 'tanmaynidagundi@gmail.com', '2002-12-06', 'Ugar BK', 5050, '8050487989@okeasebank', '', '2024-03-12 08:44:52'),
(7, 'Suyash Badi', '1531230', 'M', 'Deposit', 7483833507, '111111111111', 'ABCDE12345', 'yashbadi9@gmail.com', '2004-01-14', 'Belagavi', 1234, '7483833507@okeasebank', '', '2024-03-12 11:07:49'),
(10, 'Apurva ambiger', '1005432', 'F', 'Deposit', 1111111111, '111111111111', 'abcde11111', 'apurvambiger09@Gmail.com', '2003-11-11', 'ajcnAjkcn', 1234, '1111111111@okeasebank', '', '2024-03-12 12:34:32'),
(11, 'Pruthviraj Pandav', '1416719', 'M', 'Savings', 7795958917, '111111111111', 'ABCDE12345', 'pruthvirajpandav4777@gmail.com', '2004-03-28', 'Hukkeri', 1234, '7795958917@okeasebank', 'naruto-uzumaki-3840x2160-12705.jpg', '2024-03-12 13:04:27'),
(12, 'Sachin', '1251569', 'M', 'Current', 1111111111, '111111111111', 'ABCDE12345', 'sachinhuchhannavar@gmail.com', '2003-02-12', 'Hukkeri', 1234, '1111111111@okeasebank', '', '2024-03-12 13:14:03'),
(13, 'Umakant Karadi', '1029636', 'M', 'Current', 1111111111, '111111111111', 'ABCDE12345', 'karadiumakant@gmail.com', '2003-12-12', 'HUkkeri', 1234, '1111111111@okeasebank', '', '2024-03-12 13:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `acc_types`
--

CREATE TABLE `acc_types` (
  `accType_id` int(2) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acc_types`
--

INSERT INTO `acc_types` (`accType_id`, `name`) VALUES
(1, 'Savings '),
(2, 'Current '),
(3, 'Deposit ');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(10) NOT NULL,
  `pin` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `pin`) VALUES
(1, 'admin', '1903');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `card_id` int(11) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `card_num` bigint(20) NOT NULL,
  `card_holder` varchar(25) NOT NULL,
  `cvv` int(11) NOT NULL,
  `expires` varchar(15) NOT NULL,
  `bg_pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`card_id`, `acc_id`, `card_num`, `card_holder`, `cvv`, `expires`, `bg_pic`) VALUES
(2, 1, 1111111111111111, 'Prajwal Hiremath', 0, '/', 'naruto-uzumaki-3840x2160-12705.jpg'),
(3, 6, 2222222222222222, 'Tanmay Nidagundi', 111, '/2025', 'naruto-uzumaki-3840x2160-12705.jpg'),
(5, 11, 6666666666666, 'Pruthviraj Pandav', 122, '12/2024', 'naruto-uzumaki-3840x2160-12705.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_accs`
--

CREATE TABLE `deleted_accs` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `acc_num` bigint(20) NOT NULL,
  `reason` varchar(150) NOT NULL,
  `deleted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deleted_accs`
--

INSERT INTO `deleted_accs` (`id`, `acc_id`, `acc_num`, `reason`, `deleted_at`) VALUES
(1, 3, 1070000, 'Switching Banks', '2024-03-11 00:09:02'),
(2, 2, 1001146, 'Bored', '2024-03-11 17:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `education` varchar(50) NOT NULL,
  `civil_status` varchar(50) NOT NULL,
  `employment` varchar(50) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_phone` bigint(20) NOT NULL,
  `p_address` varchar(50) NOT NULL,
  `relation` varchar(25) NOT NULL,
  `facility` varchar(25) NOT NULL,
  `repayment` varchar(25) NOT NULL,
  `term` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `acc_id`, `amount`, `purpose`, `education`, `civil_status`, `employment`, `p_name`, `p_phone`, `p_address`, `relation`, `facility`, `repayment`, `term`, `created_at`) VALUES
(1, 1, 84100, 'College Fees', 'College Undergraduate', 'Single', 'Self-Employed', '', 0, '', '', 'Term Loan', 'Auto Debit', 5, '2024-03-12');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `not_id` int(11) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `not_desc` varchar(300) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`not_id`, `acc_id`, `not_desc`, `created_at`) VALUES
(1, 1, 'Hello, Prajwal Hiremath!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-10 19:36:46'),
(2, 1, 'A/c 1707168 Credited for Rs.5000.00 on 10-03-2024 19:36:46 by Deposit ref no 130221590669 -EaseBank.', '2024-03-10 19:36:46'),
(3, 1, 'A/c 1001143 Credited for Rs.15000.00 on 10-03-2024 20:07:17 by Deposit ref no 122130968143 -EaseBank.', '2024-03-10 20:07:17'),
(4, 1, 'A/c 1001143 Debited for Rs.12000.00 on 10-03-2024 20:07:29 by Withdrawal ref no .134204626892 -EaseBank', '2024-03-10 20:07:29'),
(5, 1, 'A/c 1001143, Your application for loan is successfully submitted -EaseBank.', '2024-03-10 20:11:10'),
(6, 1, 'A/c 1001143, Your loan application is Approved -EaseBank.', '2024-03-10 20:11:45'),
(7, 1, 'A/c 1001143, Credited for 84100 on 10-03-2024 20:11:45 by Deposit ref no 197137861801 - EaseBank.', '2024-03-10 20:11:45'),
(8, 1, 'A/c 1001143, Your application for loan is successfully submitted -EaseBank.', '2024-03-10 20:13:03'),
(9, 1, 'A/c 1001143, Your loan application is Approved -EaseBank.', '2024-03-10 20:13:06'),
(10, 1, 'A/c 1001143, Credited for 120 on 10-03-2024 20:13:06 by Deposit ref no 176054112483 - EaseBank.', '2024-03-10 20:13:06'),
(11, 1, 'A/c 1001143, Your application for loan is successfully submitted -EaseBank.', '2024-03-10 20:13:11'),
(12, 1, 'A/c 1001143, Your loan application is Rejected -EaseBank.', '2024-03-10 20:13:19'),
(16, 1, 'A/c 1001143 Credited for Rs.1680.00 on 10-03-2024 23:56:04 by Transfer ref no 180670834183 -EaseBank.', '2024-03-10 23:56:04'),
(21, 1, 'A/c 1001143 Debited for Rs.1350.00 on 10-03-2024 23:59:32 by Transfer ref no 150940875723 -EaseBank.', '2024-03-10 23:59:32'),
(28, 5, 'Hello, Mohd Gouse Mujawar!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-11 11:24:16'),
(29, 5, 'A/c 1806558 Credited for Rs.5000.00 on 11-03-2024 11:24:16 by Deposit ref no 150956091707 -EaseBank.', '2024-03-11 11:24:16'),
(30, 5, 'A/c 1806558 Credited for Rs.2000.00 on 11-03-2024 11:25:38 by Deposit ref no 136764102014 -EaseBank.', '2024-03-11 11:25:38'),
(31, 5, 'A/c 1806558 Debited for Rs.150.00 on 11-03-2024 11:26:04 by Withdrawal ref no .169568238415 -EaseBank', '2024-03-11 11:26:04'),
(32, 5, 'A/c 1806558 Debited for Rs.2500.00 on 11-03-2024 11:26:32 by Transfer ref no 172194312715 -EaseBank.', '2024-03-11 11:26:32'),
(33, 1, 'A/c 1001143 Credited for Rs.2500.00 on 11-03-2024 11:26:32 by Transfer ref no 172194312715 -EaseBank.', '2024-03-11 11:26:32'),
(34, 1, 'A/c 1001143, Your application for loan is successfully submitted -EaseBank.', '2024-03-11 11:27:23'),
(35, 1, 'A/c 1001143, Your loan application is Approved -EaseBank.', '2024-03-11 11:28:10'),
(36, 1, 'A/c 1001143, Credited for 15000 on 11-03-2024 11:28:10 by Deposit ref no 107570760032 - EaseBank.', '2024-03-11 11:28:10'),
(37, 1, 'A/c 1001143 Credited for Rs.1000.00 on 11-03-2024 12:39:58 by Deposit ref no 183607341581 -EaseBank.', '2024-03-11 12:39:58'),
(38, 1, 'A/c 1001143, Your application for loan is successfully submitted -EaseBank.', '2024-03-11 12:49:04'),
(39, 1, 'A/c 1001143, Your loan application is Approved -EaseBank.', '2024-03-11 12:49:37'),
(40, 1, 'A/c 1001143, Credited for 84100 on 11-03-2024 12:49:37 by Deposit ref no 132650162813 - EaseBank.', '2024-03-11 12:49:37'),
(41, 1, 'A/c 1001143 Credited for Rs.99999.00 on 11-03-2024 14:48:42 by Deposit ref no 170401945172 -EaseBank.', '2024-03-11 14:48:42'),
(42, 1, 'A/c 1001143 Credited for Rs.1500.00 on 11-03-2024 17:28:11 by Deposit ref no 107390514307 -EaseBank.', '2024-03-11 17:28:11'),
(43, 1, 'A/c 1001143 Debited for Rs.1680.00 on 11-03-2024 17:28:22 by Withdrawal ref no .105211935209 -EaseBank', '2024-03-11 17:28:22'),
(44, 6, 'Hello, Tanmay Nidagundi!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-12 08:44:52'),
(45, 6, 'A/c 1305099 Credited for 10000.00 on 12-03-2024 08:44:52 by Deposit ref no 185430633990 -EaseBank.', '2024-03-12 08:44:52'),
(46, 1, 'A/c 1001143 Debited for Rs.15000.00 on 12-03-2024 10:54:34 by Transfer ref no 101457120774 -EaseBank.', '2024-03-12 10:54:34'),
(47, 6, 'A/c 1305099 Credited for Rs.15000.00 on 12-03-2024 10:54:34 by Transfer ref no 101457120774 -EaseBank.', '2024-03-12 10:54:34'),
(48, 1, 'A/c 1001143 Debited for Rs.1500.00 on 12-03-2024 11:01:38 by Withdrawal ref no .151880592072 -EaseBank', '2024-03-12 11:01:38'),
(49, 7, 'Hello, Suyash Badi!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-12 11:07:50'),
(50, 7, 'A/c 1531230 Credited for Rs.5000.00 on 12-03-2024 11:07:49 by Deposit ref no 105592917499 -EaseBank.', '2024-03-12 11:07:50'),
(56, 1, 'A/c 1001143 Credited for Rs.1500.00 on 12-03-2024 12:15:29 by Transfer ref no 142554814802 -EaseBank.', '2024-03-12 12:15:29'),
(59, 10, 'Hello, Apurva ambiger!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-12 12:34:32'),
(60, 10, 'A/c 1005432 Credited for Rs.5000.00 on 12-03-2024 12:34:32 by Deposit ref no 167140045879 -EaseBank.', '2024-03-12 12:34:32'),
(61, 1, 'A/c 1001143 Credited for Rs.12000.00 on 12-03-2024 12:36:19 by Deposit ref no 180335660635 -EaseBank.', '2024-03-12 12:36:19'),
(62, 1, 'A/c 1001143 Debited for Rs.12000.00 on 12-03-2024 12:36:55 by Transfer ref no 150405157114 -EaseBank.', '2024-03-12 12:36:55'),
(64, 11, 'Hello, Pruthviraj Pandav!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-12 13:04:27'),
(65, 11, 'A/c 1416719 Credited for Rs.5000.00 on 12-03-2024 13:04:27 by Deposit ref no 141633360679 -EaseBank.', '2024-03-12 13:04:27'),
(66, 11, 'A/c 1416719 Debited for Rs.20.00 on 12-03-2024 13:07:03 by Transfer ref no 157494784041 -EaseBank.', '2024-03-12 13:07:03'),
(67, 1, 'A/c 1001143 Credited for Rs.20.00 on 12-03-2024 13:07:03 by Transfer ref no 157494784041 -EaseBank.', '2024-03-12 13:07:03'),
(68, 11, 'A/c 1416719 Debited for Rs.200.00 on 12-03-2024 13:07:54 by Withdrawal ref no .166809392558 -EaseBank', '2024-03-12 13:07:54'),
(69, 12, 'Hello, Sachin!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-12 13:14:03'),
(70, 12, 'A/c 1251569 Credited for Rs.5000.00 on 12-03-2024 13:14:03 by Deposit ref no 153005184940 -EaseBank.', '2024-03-12 13:14:03'),
(71, 13, 'Hello, Umakant Karadi!, Welcome to EaseBank. Your new account comes with access to EaseBank features and services. Get started with EaseBank.', '2024-03-12 13:17:18'),
(72, 13, 'A/c 1029636 Credited for Rs.5000.00 on 12-03-2024 13:17:18 by Deposit ref no 184495568637 -EaseBank.', '2024-03-12 13:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `pay_id` int(4) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `payment_to` varchar(20) NOT NULL,
  `pay_amt` int(11) NOT NULL,
  `notes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`pay_id`, `acc_id`, `payment_to`, `pay_amt`, `notes`) VALUES
(1, 1, 'Tanmay NIdagundi', 24, 'Wadapav'),
(4, 6, 'Prajwal Hiremath', 1500, ''),
(5, 6, 'Prajwal Hiremath', 1500, ''),
(6, 6, 'Prajwal Hiremath', 120, ''),
(7, 6, 'Prajwal Hiremath', 150, ''),
(8, 6, 'Prajwal Hiremath', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `tr_id` int(11) NOT NULL,
  `tr_code` bigint(12) NOT NULL,
  `acc_id` int(3) NOT NULL,
  `acc_name` varchar(25) NOT NULL,
  `acc_num` varchar(20) NOT NULL,
  `acc_type` varchar(10) NOT NULL,
  `tr_type` varchar(15) NOT NULL,
  `tr_amt` varchar(15) NOT NULL,
  `receivingAcc_no` varchar(25) NOT NULL,
  `receivingAcc_name` varchar(25) NOT NULL,
  `transferd_by` varchar(25) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `create_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`tr_id`, `tr_code`, `acc_id`, `acc_name`, `acc_num`, `acc_type`, `tr_type`, `tr_amt`, `receivingAcc_no`, `receivingAcc_name`, `transferd_by`, `created_at`, `create_time`) VALUES
(1, 130221590669, 1, 'Prajwal Hiremath', '1707168', 'Savings', 'Deposit', '50000', '', '', '', '2024-03-10', '19:36:46'),
(2, 122130968143, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '15000.00', '', '', '', '2024-03-10', '20:07:17'),
(3, 134204626892, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Withdraw', '12000.00', '', '', '', '2024-03-10', '20:07:29'),
(4, 197137861801, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '84100.00', '', '', '', '2024-03-10', '20:11:45'),
(5, 176054112483, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '120.00', '', '', '', '2024-03-10', '20:13:06'),
(8, 180670834183, 1, 'Prajwal Hiremath', '1001143', 'Current', 'Recieved', '1680.00', '', '', 'Tanmay Nidagundi', '2024-03-10', '23:56:04'),
(12, 150940875723, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Transfer', '1350.00', '1070000', 'Kakashi Hatake ', '', '2024-03-10', '23:59:32'),
(16, 150956091707, 5, 'Mohd Gouse Mujawar', '1806558', 'Deposit', 'Deposit', '10000', '', '', '', '2024-03-11', '11:24:16'),
(17, 136764102014, 5, 'Mohd Gouse Mujawar', '1806558', 'Deposit', 'Deposit', '2000.00', '', '', '', '2024-03-11', '11:25:38'),
(18, 169568238415, 5, 'Mohd Gouse Mujawar', '1806558', 'Deposit', 'Withdraw', '150.00', '', '', '', '2024-03-11', '11:26:04'),
(21, 107570760032, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '15000.00', '', '', '', '2024-03-11', '11:28:10'),
(22, 183607341581, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '1000.00', '', '', '', '2024-03-11', '12:39:58'),
(23, 132650162813, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '84100.00', '', '', '', '2024-03-11', '12:49:37'),
(27, 185430633990, 6, 'Tanmay Nidagundi', '1305099', 'Savings', 'Deposit', '10000.00', '', '', '', '2024-03-12', '08:44:52'),
(38, 167140045879, 10, 'Apurva ambiger', '1005432', 'Deposit', 'Deposit', '10000', '', '', '', '2024-03-12', '12:34:32'),
(39, 180335660635, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Deposit', '12000.00', '', '', '', '2024-03-12', '12:36:19'),
(42, 141633360679, 11, 'Pruthviraj Pandav', '1416719', 'Savings', 'Deposit', '5001', '', '', '', '2024-03-12', '13:04:27'),
(43, 157494784041, 11, 'Pruthviraj Pandav', '1416719', 'Savings', 'Transfer', '20.00', '1001143', 'Prajwal Hiremath', '', '2024-03-12', '13:07:03'),
(44, 157494784041, 1, 'Prajwal Hiremath', '1001143', 'Savings', 'Recieved', '20.00', '', '', 'Pruthviraj Pandav', '2024-03-12', '13:07:03'),
(46, 153005184940, 12, 'Sachin', '1251569', 'Current', 'Deposit', '10000', '', '', '', '2024-03-12', '13:14:03'),
(47, 184495568637, 13, 'Umakant Karadi', '1029636', 'Current', 'Deposit', '12000', '', '', '', '2024-03-12', '13:17:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `acc_types`
--
ALTER TABLE `acc_types`
  ADD PRIMARY KEY (`accType_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `Test` (`acc_id`);

--
-- Indexes for table `deleted_accs`
--
ALTER TABLE `deleted_accs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acc_id` (`acc_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`not_id`),
  ADD KEY `FK` (`acc_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `FK` (`acc_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`tr_id`),
  ADD KEY `FK` (`acc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `acc_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deleted_accs`
--
ALTER TABLE `deleted_accs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `not_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `pay_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `Test` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan`
--
ALTER TABLE `loan`
  ADD CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
