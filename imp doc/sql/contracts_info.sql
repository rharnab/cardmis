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
-- Table structure for table `contracts_info`
--

CREATE TABLE IF NOT EXISTS `contracts_info` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_contract_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_phase` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code_of_credit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date_of_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planned_end_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actual_end_date_of_the_contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `periodicity_of_payment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method_of_payment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_instalment_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section_limit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date_of_next_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_overdue_and_not_paid_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_last_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_charged_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_delay_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_due` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_during_the_reporting_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cumulative_recovery` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_law_suit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_classification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times_rescheduled` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_purpose_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaulter_flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_disburse_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_amt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_update` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts_info`
--

INSERT INTO `contracts_info` (`id`, `record_type`, `fi_code`, `branch_code`, `fi_subject_code`, `fi_contract_code`, `contract_type`, `contract_phase`, `contract_status`, `currency_code`, `currency_code_of_credit`, `starting_date_of_contract`, `request_date_of_the_contract`, `planned_end_date_of_the_contract`, `actual_end_date_of_the_contract`, `periodicity_of_payment`, `method_of_payment`, `monthly_instalment_amt`, `section_limit`, `exp_date_of_next_installment`, `remaining_amt`, `number_of_overdue_and_not_paid_installment`, `overdue_amt`, `date_of_last_charge`, `type_of_installment`, `amount_charged_in_the_month`, `flag_card_used_in_the_month`, `monthly_card_used_in_the_month`, `payment_delay_number`, `recovery_due`, `recovery_during_the_reporting_period`, `cumulative_recovery`, `date_of_law_suit`, `date_of_classification`, `no_of_times_rescheduled`, `economic_purpose_code`, `defaulter_flag`, `total_disburse_amt`, `outstanding_amt`, `flag_update`, `reporting_date`) VALUES
(1, 'D', '007', '0001', '0013062809', '0001733001096', '21', '12', '1', '123', '123', '2020-12-08', '2020-12-08', '2020-12-08', '2020-12-08', '1', '123', '12545687', '12345678', '2020-12-08', '123456789', '123', '12345678912', '2020-12-08', 'f', '123456789123', '1', '12', '123', '12345678', '1234567891', '123456789', '2020-12-08', '2020-12-08', '123454', '1234', '1', '1234567891', '12345678', '1', '2020-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contracts_info`
--
ALTER TABLE `contracts_info`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contracts_info`
--
ALTER TABLE `contracts_info`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
