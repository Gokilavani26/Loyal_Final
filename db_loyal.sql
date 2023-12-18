
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_loyal`
--

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



-- --------------------------------------------------------

--
-- Table structure for table `finish_release`
--

CREATE TABLE `finish_release` (
  `sell_id` int(11) NOT NULL,
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
-- Table structure for table `gatepass`
--

CREATE TABLE `gatepass` (
  `model` text NOT NULL,
  `company_name` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `gp_no` int(11) NOT NULL,
  `size6` int(11) NOT NULL,
  `size7` int(11) NOT NULL,
  `size8` int(11) NOT NULL,
  `size9` int(11) NOT NULL,
  `size10` int(11) NOT NULL,
  `size11` int(11) NOT NULL,
  `other_sizes` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `taken_by` text NOT NULL,
  `designation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


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
-- Indexes for table `finish_release`
--
ALTER TABLE `finish_release`
  ADD PRIMARY KEY (`sell_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finish_release`
--
ALTER TABLE `finish_release`
  MODIFY `sell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

