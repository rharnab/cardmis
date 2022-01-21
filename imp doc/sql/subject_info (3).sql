-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2021 at 10:38 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `card`
--

-- --------------------------------------------------------

--
-- Table structure for table `subject_info`
--

CREATE TABLE IF NOT EXISTS `subject_info` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fi_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fathers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mothers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spouse_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dath_of_brth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_street` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parmanent_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parmanent_country_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nr` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_info`
--

INSERT INTO `subject_info` (`id`, `record_type`, `fi_code`, `acc_date`, `production_date`, `code_link`, `branch_code`, `fi_subject_code`, `title`, `name`, `fathers_title`, `fathers_name`, `mothers_title`, `mothers_name`, `spouse_title`, `spouse`, `sector_type`, `sector_code`, `gender`, `dath_of_brth`, `place_of_birth`, `country_of_birth`, `nid_number`, `is_nid`, `tin_number`, `parmanent_street`, `parmanent_postal_code`, `parmanent_district`, `parmanent_country_code`, `additional_street`, `additional_postal_code`, `additional_district`, `additional_country_code`, `id_type`, `id_nr`, `id_issue_date`, `id_issue_country_code`, `phone_number`, `full_nid_number`, `reporting_date`) VALUES
(1, 'H', '007', '2020-12-12', '2020-12-12', '001', '0071', '1234567891234567', 'MR', 'RAMJAN', 'FATHER TITLE', 'FATHER NAME', 'MOTHER TITLE', 'MOTHER NAME', 'spouse_title', 'spouse', 'S', '123456', 'M', '2020-10-01', 'COMILLA', 'ba', '1234567891234', '1', '123456789123', 'RAMPURA', '1207', 'DHAKA', '23', 'RAMPURA', '1205', 'DHAKA', '23', 'Y', NULL, '2020-12-01', '25', '12345678912', '12345678912345678', '2020-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subject_info`
--
ALTER TABLE `subject_info`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject_info`
--
ALTER TABLE `subject_info`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
