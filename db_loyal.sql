-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 02:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_loyal`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `group_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`group_name`) VALUES
('Group A'),
('Group B'),
('Group C'),
('Group D'),
('Group E');

-- --------------------------------------------------------

--
-- Table structure for table `finish_add`
--

CREATE TABLE `finish_add` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `size6` int(11) NOT NULL,
  `size7` int(11) NOT NULL,
  `size8` int(11) NOT NULL,
  `size9` int(11) NOT NULL,
  `size10` int(11) NOT NULL,
  `size11` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `given_by` varchar(25) NOT NULL,
  `remarks` text NOT NULL,
  `storeman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finish_add`
--

INSERT INTO `finish_add` (`date`, `time`, `product_code`, `product_name`, `size6`, `size7`, `size8`, `size9`, `size10`, `size11`, `total`, `given_by`, `remarks`, `storeman`) VALUES
('2023-09-14', '18:24:00', '1919', 'Cut Shoe', 7, 6, 5, 7, 5, 9, 31, 'Dharanya', 'no remarks', 'Kabilan'),
('2023-09-01', '18:25:00', '10971', 'Sport Shoe', 5, 5, 5, 5, 5, 5, 30, 'abbc', 'done', 'ravi'),
('2023-11-17', '07:06:00', '89', 'shoe', 3, 6, 3, 6, 2, 5, 20, '4r4r', 'no remarks', 'ramya');

-- --------------------------------------------------------

--
-- Table structure for table `finish_release`
--

CREATE TABLE `finish_release` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `size6` int(11) NOT NULL,
  `size7` int(11) NOT NULL,
  `size8` int(11) NOT NULL,
  `size9` int(11) NOT NULL,
  `size10` int(11) NOT NULL,
  `size11` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `taken_by` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  `storeman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finish_release`
--

INSERT INTO `finish_release` (`date`, `time`, `product_code`, `product_name`, `size6`, `size7`, `size8`, `size9`, `size10`, `size11`, `total`, `taken_by`, `remarks`, `storeman`) VALUES
('2023-09-10', '18:52:00', '121', 'Shoe', 1, 1, 1, 1, 1, 1, 6, 'Akash', 'done', 'ram'),
('2023-09-12', '21:31:00', '121', 'Shoe', 1, 1, 1, 1, 1, 1, 6, 'pavan', 'no remark', 'Kabil'),
('1323-02-02', '01:02:00', '123', 'Product A', 2, 2, 2, 2, 3, 2, 4, '23', 'good', 'rahul'),
('2002-04-23', '05:06:00', '34', 'Polish shoe', 4, 4, 3, 3, 2, 5, 50, 'aradya', 'no remarks', 'ramya'),
('2023-11-09', '04:03:00', '89', 'shoe', 2, 2, 3, 2, 4, 2, 14, 'aradya', 'no remarks', 'ABC Solution');

-- --------------------------------------------------------

--
-- Table structure for table `raw_add`
--

CREATE TABLE `raw_add` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `department` varchar(20) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `units` varchar(10) NOT NULL,
  `given_by` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  `storeman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raw_add`
--

INSERT INTO `raw_add` (`date`, `time`, `department`, `product_code`, `product_name`, `size`, `quantity`, `units`, `given_by`, `remarks`, `storeman`) VALUES
('3333-04-03', '01:02:00', 'Upper', '123', 'Product A', 0, 50, '12', 'abi', 'donee', 'rahul'),
('2023-04-02', '23:34:00', 'Bottom', '789', 'Product C', 7, 30, '12', 'abi', 'donee', 'nithya'),
('2023-12-27', '03:04:00', 'Cutting', '123', 'Product A', 10, 34, '12', 'aradya', 'good', 'rahul'),
('2023-12-21', '03:04:00', 'Bottom', '789', 'Product C', 7, 78, '12', 'Group E', 'donee', 'ABC Solution');

-- --------------------------------------------------------

--
-- Table structure for table `raw_release`
--

CREATE TABLE `raw_release` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `department` varchar(20) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `units` varchar(10) NOT NULL,
  `taken_by` varchar(20) NOT NULL,
  `remarks` text NOT NULL,
  `storeman` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raw_release`
--

INSERT INTO `raw_release` (`date`, `time`, `department`, `product_code`, `product_name`, `size`, `quantity`, `units`, `taken_by`, `remarks`, `storeman`) VALUES
('2023-09-15', '10:19:00', 'Production', '1101', 'Leather', 6, 2, 'sq mtr', 'pavan', 'no remark', 'ram'),
('2023-09-20', '13:18:00', 'Packing', '2091', 'Glue', 8, 2, 'count', 'Akash', 'released', 'ravi'),
('2023-09-20', '10:29:00', 'Production', '1101', 'Leather', 6, 5, 'sq mtr', 'Vimal', 'done', 'ravi'),
('2023-09-15', '21:27:00', 'Sales', '1101', 'Leather', 6, 7, 'sq mtr', 'Akash', 'no remark', 'ram'),
('2023-09-01', '18:57:00', 'Sales', '44', 'xxx', 8, 2, 'sq mtr', 'Akash', 'no remark', 'Kabil'),
('2023-09-14', '19:13:00', 'Sales', '876', 'Leather', 9, 30, 'sq mtr', 'pavan', 'no remark', 'ram'),
('2023-10-31', '04:05:00', 'production', '123', 'product', 6, 7, '68', 'aradya', 'no', 'nithya'),
('0003-02-01', '01:02:00', 'Cutting', '123', 'Product A', 10, 12, '23', 'abi', 'no remarks', 'ramya'),
('2023-04-04', '05:06:00', 'Cutting', '123', 'Product A', 7, 4, '68', 'abi', 'good', 'ABC Solution'),
('5444-04-04', '02:02:00', 'Upper', '123', 'Product A', 9, 13, '12', 'abi', 'donee', 'rahul'),
('2023-11-09', '01:01:00', 'Cutting', '12', 'shoe', 0, 10, '12', 'abi', 'no remarks', 'Kabilan'),
('2023-11-09', '01:02:00', 'Cutting', '123', 'Product A', 0, 5, '12', 'abi', 'donee', 'rahul'),
('2023-11-16', '01:02:00', 'Upper', '34', 'shoe', 0, 2, '12', 'abi', 'no remarks', '1');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
