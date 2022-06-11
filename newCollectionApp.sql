-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 11, 2022 at 03:48 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newCollectionApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `ADMIN_ID` bigint(20) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PHONE_NUMBER` varchar(50) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT 1,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`ADMIN_ID`, `USERNAME`, `PHONE_NUMBER`, `PASSWORD`, `STATUS`, `CREATED_AT`) VALUES
(1, 'admin', '7708454539', '0e4e946668cf2afc4299b462b812caca', 1, '2021-10-11 06:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `agent_master`
--

CREATE TABLE `agent_master` (
  `AGENT_ID` bigint(20) NOT NULL,
  `AGENT_NAME` varchar(50) DEFAULT NULL,
  `AGENT_PH_NO` varchar(25) DEFAULT NULL,
  `AGENT_LOCATION` int(11) DEFAULT NULL,
  `AGENT_DL_STATUS` int(11) DEFAULT 1,
  `AGENT_CREATED_AT` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agent_master`
--

INSERT INTO `agent_master` (`AGENT_ID`, `AGENT_NAME`, `AGENT_PH_NO`, `AGENT_LOCATION`, `AGENT_DL_STATUS`, `AGENT_CREATED_AT`) VALUES
(1, 'RAKIDA RAKIDA', '7708454539', 1, 1, '2021-10-09'),
(2, 'ADI ADI', '7708454539', 1, 1, '2021-10-09'),
(3, 'test agent 23', '787778', 2, 1, '2022-06-11'),
(4, 'test agent xcxv', '787778', 2, 1, '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `collection_master`
--

CREATE TABLE `collection_master` (
  `COL_ID` bigint(20) UNSIGNED NOT NULL,
  `COL_FOR_CUS_ID` bigint(20) NOT NULL,
  `CUS_TOTAL_DUE` bigint(20) NOT NULL COMMENT 'TOTAL AMOUNT NEED TO BE PAID BY CUSTOMER  INSERT  BY MULTIPLYING THE PLAN AMOUNT AND INSERTING HERE',
  `COL_DUE_BALANCE` bigint(20) NOT NULL DEFAULT 0,
  `COL_DUE_LAST_BALANCE` bigint(20) NOT NULL DEFAULT 0 COMMENT 'IT SHOWS THE RECORD OF LAST BALANCE BEFORE NEXT NEW',
  `CL_LAST_UPDATED_ON` date NOT NULL DEFAULT curdate(),
  `CL_CREATED_ON` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collection_master`
--

INSERT INTO `collection_master` (`COL_ID`, `COL_FOR_CUS_ID`, `CUS_TOTAL_DUE`, `COL_DUE_BALANCE`, `COL_DUE_LAST_BALANCE`, `CL_LAST_UPDATED_ON`, `CL_CREATED_ON`) VALUES
(1, 17, 2400, 1650, 1900, '2021-11-01', '2021-11-01'),
(2, 18, 2400, 2200, 2300, '2021-11-01', '2021-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `CUS_ID` bigint(20) NOT NULL,
  `CUS_MEMBER_ID` bigint(20) NOT NULL COMMENT 'Memeber_ID user enetred value',
  `CUS_NAME` varchar(50) DEFAULT NULL,
  `CUS_SUR_NAME` varchar(50) DEFAULT NULL,
  `CUS_PM_PH_NO` varchar(50) NOT NULL,
  `CUS_SE_PH_NO` varchar(50) DEFAULT NULL,
  `CUS_PLACE_ID` bigint(20) NOT NULL,
  `CUS_REF_BY` bigint(20) NOT NULL,
  `CUS_PLAN_ID` bigint(20) NOT NULL,
  `CUS_DL_STATUS` int(11) DEFAULT 1,
  `CUS_COM_ONE` int(11) DEFAULT 0,
  `CUS_COM_TWO` int(11) DEFAULT 0,
  `CUS_CREATED_AT` date DEFAULT curdate(),
  `CUS_SCHEME_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`CUS_ID`, `CUS_MEMBER_ID`, `CUS_NAME`, `CUS_SUR_NAME`, `CUS_PM_PH_NO`, `CUS_SE_PH_NO`, `CUS_PLACE_ID`, `CUS_REF_BY`, `CUS_PLAN_ID`, `CUS_DL_STATUS`, `CUS_COM_ONE`, `CUS_COM_TWO`, `CUS_CREATED_AT`, `CUS_SCHEME_ID`) VALUES
(17, 0, 'RAGUL', 'SAI', '7708458701', '5252522525', 2, 1, 1, 1, 1, 0, '2021-11-01', 1),
(18, 0, 'KOWSI', 'SAI', '7708458701', '5252522525', 2, 1, 1, 1, 1, 0, '2021-11-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `place_master`
--

CREATE TABLE `place_master` (
  `PLACE_ID` bigint(20) NOT NULL,
  `PLACE_NAME` varchar(50) DEFAULT NULL,
  `PLACE_DL_STATUS` int(11) DEFAULT 1,
  `PLACE_CREATED_AT` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `place_master`
--

INSERT INTO `place_master` (`PLACE_ID`, `PLACE_NAME`, `PLACE_DL_STATUS`, `PLACE_CREATED_AT`) VALUES
(1, 'dfgdf', 0, '2021-10-09'),
(2, 'k.k.nagar', 1, '2021-10-09'),
(3, 'test place ', 1, '2022-06-11'),
(4, 'test place q', 1, '2022-06-11'),
(5, 'dfgdf', 1, '2022-06-11');

-- --------------------------------------------------------

--
-- Table structure for table `plan_master`
--

CREATE TABLE `plan_master` (
  `PL_ID` bigint(20) NOT NULL,
  `PL_AMOUNT` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_master`
--

INSERT INTO `plan_master` (`PL_ID`, `PL_AMOUNT`) VALUES
(1, '100'),
(2, '300'),
(4, '200');

-- --------------------------------------------------------

--
-- Table structure for table `scheme_master`
--

CREATE TABLE `scheme_master` (
  `SCHEME_ID` bigint(20) NOT NULL,
  `SCHEME_NAME` varchar(100) NOT NULL COMMENT 'NAME OF THE SCHEME THAT CAN HANDLE MULTUPLE SCHEMES FOR YEAR',
  `SCHEME_START_DATE` date NOT NULL COMMENT 'IT SHOUDE BE THE SCHEME STARTING DATE',
  `SCHEME_END_DATE` date DEFAULT NULL COMMENT 'IT SHOULDE BE 12 MONTHS AFTER START DATE',
  `SCHEME_ACTIVE_STATUS` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 MEANS ACTIVE 0 MEANS CLOSED',
  `SCHEME_DL_STATUS` bit(1) DEFAULT b'1' COMMENT 'SOFT_DELETE FOR SCHEME 1 MEANS NO DELETED  MEANS DELETED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='THIS TABLES HANDLES THE SCHEME FOR  MONTHS';

--
-- Dumping data for table `scheme_master`
--

INSERT INTO `scheme_master` (`SCHEME_ID`, `SCHEME_NAME`, `SCHEME_START_DATE`, `SCHEME_END_DATE`, `SCHEME_ACTIVE_STATUS`, `SCHEME_DL_STATUS`) VALUES
(1, 'FIRTS SCHEME', '2021-10-12', '2021-11-12', b'1', b'1'),
(2, 'SECOND SCHEME', '2021-10-12', '2021-11-12', b'1', b'1'),
(3, '300', '2021-10-12', '2021-11-12', b'1', b'1'),
(4, 'SHEME TEST', '2021-10-12', '2021-11-12', b'1', b'1'),
(5, 'SHEME TEST', '2021-10-12', '2021-11-12', b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_master`
--

CREATE TABLE `transaction_master` (
  `TR_ID` bigint(20) UNSIGNED NOT NULL,
  `TR_OF_CUS` int(11) DEFAULT NULL,
  `TR_OF_PL_ID` int(11) DEFAULT NULL,
  `TR_DONE_TO` int(11) DEFAULT NULL COMMENT 'TRANSACTION DONE BY ADMIN',
  `TR_PAID_AMOUNT` varchar(10) DEFAULT NULL COMMENT 'AMOUNT PAID ON TRANSACTION',
  `TR_ON_DATE` date DEFAULT curdate(),
  `TR_ON_TIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_master`
--

INSERT INTO `transaction_master` (`TR_ID`, `TR_OF_CUS`, `TR_OF_PL_ID`, `TR_DONE_TO`, `TR_PAID_AMOUNT`, `TR_ON_DATE`, `TR_ON_TIME`) VALUES
(1, 17, NULL, 1, '250', '2021-11-01', '2021-11-01 07:50:33'),
(2, 17, NULL, 1, '200', '2021-11-01', '2021-11-01 07:54:34'),
(3, 17, NULL, 1, '200', '2021-11-01', '2021-11-01 07:57:30'),
(4, 18, NULL, 1, '100', '2021-11-01', '2021-11-01 08:19:39'),
(5, 18, NULL, 1, '200', '2021-11-01', '2021-11-01 08:20:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`ADMIN_ID`),
  ADD UNIQUE KEY `PHONE_NUMBER` (`PHONE_NUMBER`);

--
-- Indexes for table `agent_master`
--
ALTER TABLE `agent_master`
  ADD PRIMARY KEY (`AGENT_ID`),
  ADD KEY `AGENT_LOCATION` (`AGENT_LOCATION`);

--
-- Indexes for table `collection_master`
--
ALTER TABLE `collection_master`
  ADD PRIMARY KEY (`COL_ID`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`CUS_ID`),
  ADD KEY `fk_customer_master_plan_master` (`CUS_PLAN_ID`),
  ADD KEY `fk_customer_master` (`CUS_PLACE_ID`),
  ADD KEY `Fk_customer_master_scheme` (`CUS_SCHEME_ID`),
  ADD KEY `Fk_customer_master_ref_id` (`CUS_REF_BY`);

--
-- Indexes for table `place_master`
--
ALTER TABLE `place_master`
  ADD PRIMARY KEY (`PLACE_ID`);

--
-- Indexes for table `plan_master`
--
ALTER TABLE `plan_master`
  ADD PRIMARY KEY (`PL_ID`);

--
-- Indexes for table `scheme_master`
--
ALTER TABLE `scheme_master`
  ADD PRIMARY KEY (`SCHEME_ID`);

--
-- Indexes for table `transaction_master`
--
ALTER TABLE `transaction_master`
  ADD PRIMARY KEY (`TR_ID`),
  ADD KEY `TR_OF_CUS` (`TR_OF_CUS`),
  ADD KEY `TR_OF_PL_ID` (`TR_OF_PL_ID`),
  ADD KEY `TR_DONE_TO` (`TR_DONE_TO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `ADMIN_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agent_master`
--
ALTER TABLE `agent_master`
  MODIFY `AGENT_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collection_master`
--
ALTER TABLE `collection_master`
  MODIFY `COL_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `CUS_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `place_master`
--
ALTER TABLE `place_master`
  MODIFY `PLACE_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plan_master`
--
ALTER TABLE `plan_master`
  MODIFY `PL_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scheme_master`
--
ALTER TABLE `scheme_master`
  MODIFY `SCHEME_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_master`
--
ALTER TABLE `transaction_master`
  MODIFY `TR_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD CONSTRAINT `Fk_customer_master_ref_id` FOREIGN KEY (`CUS_REF_BY`) REFERENCES `agent_master` (`AGENT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Fk_customer_master_scheme` FOREIGN KEY (`CUS_SCHEME_ID`) REFERENCES `scheme_master` (`SCHEME_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_master` FOREIGN KEY (`CUS_PLACE_ID`) REFERENCES `place_master` (`PLACE_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_customer_master_plan_master` FOREIGN KEY (`CUS_PLAN_ID`) REFERENCES `plan_master` (`PL_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
