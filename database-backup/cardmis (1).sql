-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2021 at 07:35 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cardmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_summary`
--

CREATE TABLE IF NOT EXISTS `account_summary` (
  `IdClient` varchar(50) NOT NULL,
  `CARD_LIST` varchar(50) NOT NULL,
  `STATEMENT_DATE` varchar(50) NOT NULL,
  `ACCOUNTNO` varchar(50) NOT NULL,
  `STATEMENT_DATE_SORT` date NOT NULL,
  `OVLFEE_AMOUNT` varchar(50) NOT NULL,
  `OVDFEE_AMOUNT` varchar(50) NOT NULL,
  `SUM_REVERSE` varchar(50) NOT NULL,
  `SUM_CREDIT` varchar(50) NOT NULL,
  `SUM_OTHER` varchar(50) NOT NULL,
  `SUM_INTEREST` varchar(50) NOT NULL,
  `SUM_PURCHASE` varchar(50) NOT NULL,
  `SUM_WITHDRAWAL` varchar(50) NOT NULL,
  `MIN_AMOUNT_DUE` varchar(50) NOT NULL,
  `AVAIL_CASH_LIMIT` varchar(50) NOT NULL,
  `CASH_LIMIT` varchar(50) NOT NULL,
  `INSTALL_UNPAID_AMOUNT` varchar(50) NOT NULL,
  `INSTALL_MONTH_PAYM` varchar(50) NOT NULL,
  `AVAIL_CRD_LIMIT` varchar(50) NOT NULL,
  `CRD_LIMIT` varchar(50) NOT NULL,
  `EBALANCE` varchar(50) NOT NULL,
  `SBALANCE` varchar(50) NOT NULL,
  `ACURC` varchar(50) NOT NULL,
  `ACURN` varchar(50) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `uploadedFIleName` varchar(200) NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auto_card_charge_histry_log`
--

CREATE TABLE IF NOT EXISTS `auto_card_charge_histry_log` (
`id` int(11) NOT NULL,
  `debit_sl` varchar(10) DEFAULT NULL,
  `card_no` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `balance_amt` varchar(100) DEFAULT NULL,
  `paid_amt` varchar(100) DEFAULT NULL,
  `payable_amount` varchar(100) NOT NULL,
  `due_amt` varchar(100) DEFAULT NULL,
  `charge_date` varchar(100) DEFAULT NULL,
  `msg` varchar(100) DEFAULT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `TraceNoList_0` varchar(100) DEFAULT NULL,
  `TraceNoList_1` varchar(100) DEFAULT NULL,
  `entry_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=531 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auto_card_cvs_charge_log`
--

CREATE TABLE IF NOT EXISTS `auto_card_cvs_charge_log` (
`id` int(100) NOT NULL,
  `log_id` varchar(100) NOT NULL,
  `error` text NOT NULL,
  `cvs_log` text NOT NULL,
  `log_type` varchar(5) DEFAULT NULL,
  `logTimeStamp` varchar(200) DEFAULT NULL,
  `send_data` text
) ENGINE=InnoDB AUTO_INCREMENT=4085531 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auto_debit_charge`
--

CREATE TABLE IF NOT EXISTS `auto_debit_charge` (
`sl` int(11) NOT NULL,
  `card_holder_name` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `payment_instruction` varchar(100) NOT NULL,
  `outstanding_balacne` double(10,2) NOT NULL,
  `due_amount` double(10,2) NOT NULL,
  `payment_amount` double(10,2) NOT NULL,
  `net_due_amount` double(10,2) NOT NULL,
  `payable_amount` double(10,2) NOT NULL,
  `paid_fee_amt` double(10,2) NOT NULL,
  `due_fee_amt` double(10,2) NOT NULL,
  `process_dt` date NOT NULL,
  `exc_till_date` varchar(20) NOT NULL,
  `usd_rate` double(8,2) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `entry_dt` date NOT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Not processed;1=processed, 2=due',
  `file_type` varchar(5) NOT NULL COMMENT 'U for usd B for bdt'
) ENGINE=MyISAM AUTO_INCREMENT=2058 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill_entry_log`
--

CREATE TABLE IF NOT EXISTS `bill_entry_log` (
`tr_id` int(11) NOT NULL,
  `card_no` varchar(16) NOT NULL,
  `trdate` date NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `traceno` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
`br_key` int(11) NOT NULL,
  `br_code` varchar(4) NOT NULL DEFAULT '',
  `br_name` varchar(100) NOT NULL DEFAULT '',
  `br_add` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
`id` int(11) NOT NULL,
  `br_title` varchar(120) NOT NULL,
  `br_code` varchar(9) NOT NULL,
  `br_address` longtext NOT NULL,
  `br_city` longtext NOT NULL,
  `br_division` longtext,
  `br_phone` varchar(50) DEFAULT NULL,
  `br_email` varchar(50) DEFAULT NULL,
  `swift_code` varchar(200) DEFAULT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch_card_charge_histry_log`
--

CREATE TABLE IF NOT EXISTS `branch_card_charge_histry_log` (
`id` int(11) NOT NULL,
  `debit_sl` varchar(10) DEFAULT NULL,
  `card_no` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `balance_amt` varchar(100) DEFAULT NULL,
  `paid_amt` varchar(100) DEFAULT NULL,
  `charge_amount` varchar(100) NOT NULL,
  `due_amt` varchar(100) DEFAULT NULL,
  `charge_date` varchar(100) DEFAULT NULL,
  `msg` varchar(100) DEFAULT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `TraceNoList_0` varchar(100) DEFAULT NULL,
  `TraceNoList_1` varchar(100) DEFAULT NULL,
  `entry_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch_card_cvs_charge_log`
--

CREATE TABLE IF NOT EXISTS `branch_card_cvs_charge_log` (
`id` int(100) NOT NULL,
  `log_id` varchar(100) NOT NULL,
  `error` varchar(100) NOT NULL,
  `cvs_log` text NOT NULL,
  `log_type` varchar(5) DEFAULT NULL,
  `logTimeStamp` varchar(200) DEFAULT NULL,
  `send_data` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch_debit_charge`
--

CREATE TABLE IF NOT EXISTS `branch_debit_charge` (
`sl` int(11) NOT NULL,
  `card_holder_name` varchar(50) DEFAULT NULL,
  `card_no` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `charge_amount` double(10,2) NOT NULL,
  `paid_fee_amt` double(10,2) NOT NULL,
  `due_fee_amt` double(10,2) NOT NULL,
  `process_dt` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Not processed;1=processed, 2=due',
  `remarks` varchar(100) NOT NULL,
  `entry_by` varchar(10) NOT NULL,
  `entry_dt` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_charge_histry_log`
--

CREATE TABLE IF NOT EXISTS `card_charge_histry_log` (
`id` int(11) NOT NULL,
  `debit_sl` varchar(10) DEFAULT NULL,
  `card_no` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `balance_amt` varchar(100) DEFAULT NULL,
  `paid_amt` varchar(100) DEFAULT NULL,
  `card_fee` varchar(50) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `due_amt` varchar(100) DEFAULT NULL,
  `charge_date` varchar(100) DEFAULT NULL,
  `msg` varchar(100) DEFAULT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `TraceNoList_0` varchar(100) DEFAULT NULL,
  `TraceNoList_1` varchar(100) DEFAULT NULL,
  `entry_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1933 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_charge_temp`
--

CREATE TABLE IF NOT EXISTS `card_charge_temp` (
`temp_id` int(11) NOT NULL,
  `card_holder_name` varchar(200) NOT NULL,
  `card_no_file` varchar(200) NOT NULL,
  `account_no_file` varchar(200) NOT NULL,
  `payable_net_amount` varchar(50) NOT NULL,
  `payable_vat_amount` varchar(50) NOT NULL,
  `debit_amount` varchar(50) NOT NULL,
  `upload_dt` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_cvs_charge_log`
--

CREATE TABLE IF NOT EXISTS `card_cvs_charge_log` (
`id` int(100) NOT NULL,
  `log_id` varchar(100) NOT NULL,
  `error` varchar(100) NOT NULL,
  `cvs_log` text NOT NULL,
  `log_type` varchar(5) DEFAULT NULL,
  `logTimeStamp` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7782764 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_no_manual`
--

CREATE TABLE IF NOT EXISTS `card_no_manual` (
`card_sl` int(11) NOT NULL,
  `card_name` varchar(160) NOT NULL,
  `card_no` varchar(16) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_status`
--

CREATE TABLE IF NOT EXISTS `card_status` (
`id` int(11) NOT NULL,
  `status_type` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cib_download_history`
--

CREATE TABLE IF NOT EXISTS `cib_download_history` (
`id` int(11) NOT NULL,
  `download_file` varchar(200) DEFAULT NULL,
  `download_by` varchar(10) DEFAULT NULL,
  `reporting_date` varchar(50) DEFAULT NULL,
  `download_timestamp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cib_error`
--

CREATE TABLE IF NOT EXISTS `cib_error` (
`id` int(11) NOT NULL,
  `error_type` varchar(10) DEFAULT NULL,
  `error_code` varchar(10) DEFAULT NULL,
  `error_description` text,
  `query` text,
  `condition` varchar(250) DEFAULT NULL,
  `error_field` text
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cib_generate_history`
--

CREATE TABLE IF NOT EXISTS `cib_generate_history` (
`id` bigint(20) unsigned NOT NULL,
  `mis_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cl_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cib_history_log`
--

CREATE TABLE IF NOT EXISTS `cib_history_log` (
`id` bigint(20) unsigned NOT NULL,
  `mis_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cl_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `download_timestamp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_table`
--

CREATE TABLE IF NOT EXISTS `cl_table` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address` text COLLATE utf8mb4_unicode_ci,
  `correspondence_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketed_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_cycle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unpaid_emi_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliquency` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report'
) ENGINE=MyISAM AUTO_INCREMENT=20800 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_table_1`
--

CREATE TABLE IF NOT EXISTS `cl_table_1` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address` text COLLATE utf8mb4_unicode_ci,
  `correspondence_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketed_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_cycle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unpaid_emi_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliquency` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report'
) ENGINE=MyISAM AUTO_INCREMENT=2309 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts_info`
--

CREATE TABLE IF NOT EXISTS `contracts_info` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `section_limit` int(100) DEFAULT NULL,
  `exp_date_of_next_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amt` int(100) DEFAULT NULL,
  `number_of_overdue_and_not_paid_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt` int(100) DEFAULT NULL,
  `date_of_last_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_charged_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_delay_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_due` int(100) DEFAULT NULL,
  `recovery_during_the_reporting_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cumulative_recovery` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_law_suit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_classification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times_rescheduled` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_purpose_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaulter_flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_disburse_amt` int(100) DEFAULT NULL,
  `outstanding_amt` int(100) DEFAULT NULL,
  `flag_update` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2293 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts_info_1`
--

CREATE TABLE IF NOT EXISTS `contracts_info_1` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `section_limit` int(100) DEFAULT NULL,
  `exp_date_of_next_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amt` int(100) DEFAULT NULL,
  `number_of_overdue_and_not_paid_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt` int(100) DEFAULT NULL,
  `date_of_last_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_charged_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_delay_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_due` int(100) DEFAULT NULL,
  `recovery_during_the_reporting_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cumulative_recovery` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_law_suit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_classification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times_rescheduled` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_purpose_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaulter_flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_disburse_amt` int(100) DEFAULT NULL,
  `outstanding_amt` int(100) DEFAULT NULL,
  `flag_update` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13849 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts_info_archive`
--

CREATE TABLE IF NOT EXISTS `contracts_info_archive` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `section_limit` int(100) DEFAULT NULL,
  `exp_date_of_next_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_amt` int(100) DEFAULT NULL,
  `number_of_overdue_and_not_paid_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt` int(100) DEFAULT NULL,
  `date_of_last_charge` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_installment` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_charged_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_card_used_in_the_month` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_delay_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recovery_due` int(100) DEFAULT NULL,
  `recovery_during_the_reporting_period` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cumulative_recovery` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_law_suit` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_classification` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_times_rescheduled` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `economic_purpose_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defaulter_flag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_disburse_amt` int(100) DEFAULT NULL,
  `outstanding_amt` int(100) DEFAULT NULL,
  `flag_update` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5812 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contract_phases`
--

CREATE TABLE IF NOT EXISTS `contract_phases` (
`contr_phases_id` int(11) NOT NULL,
  `value` varchar(2) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contract_types`
--

CREATE TABLE IF NOT EXISTS `contract_types` (
`contr_type_id` int(11) NOT NULL,
  `value` varchar(2) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `currency_codes`
--

CREATE TABLE IF NOT EXISTS `currency_codes` (
`currency_code_id` int(11) NOT NULL,
  `value` varchar(3) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`keyCode` int(11) NOT NULL,
  `IdClient` varchar(50) NOT NULL,
  `Client` varchar(100) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `ZIP` varchar(50) NOT NULL,
  `Pager` varchar(50) NOT NULL,
  `Mobile` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `PersonalCode` varchar(100) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Fax` varchar(50) NOT NULL,
  `StreetAddress` varchar(200) NOT NULL,
  `House` varchar(50) NOT NULL,
  `ContractNo` varchar(100) NOT NULL,
  `ContractType` varchar(50) NOT NULL,
  `ClientLat` varchar(100) NOT NULL,
  `Sex` varchar(20) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `actStatus` int(11) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2508 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer1`
--

CREATE TABLE IF NOT EXISTS `customer1` (
`keyCode` int(11) NOT NULL,
  `IdClient` varchar(50) NOT NULL,
  `Client` varchar(100) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Region` varchar(50) NOT NULL,
  `ZIP` varchar(50) NOT NULL,
  `Pager` varchar(50) NOT NULL,
  `Mobile` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `PersonalCode` varchar(100) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Telephone` varchar(50) NOT NULL,
  `Fax` varchar(50) NOT NULL,
  `StreetAddress` varchar(200) NOT NULL,
  `House` varchar(50) NOT NULL,
  `ContractNo` varchar(100) NOT NULL,
  `ContractType` varchar(50) NOT NULL,
  `ClientLat` varchar(100) NOT NULL,
  `Sex` varchar(20) NOT NULL,
  `Title` varchar(20) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=800 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_card`
--

CREATE TABLE IF NOT EXISTS `customer_card` (
  `IdClient` varchar(50) NOT NULL,
  `PAN` varchar(50) NOT NULL,
  `MBR` varchar(50) NOT NULL,
  `CLIENTNAME` varchar(100) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact_1`
--

CREATE TABLE IF NOT EXISTS `customer_contact_1` (
  `IdClient` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `actStatus` char(1) NOT NULL,
  `entryDateTime` datetime NOT NULL,
  `entryUsr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact_bk`
--

CREATE TABLE IF NOT EXISTS `customer_contact_bk` (
  `IdClient` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `actStatus` char(1) NOT NULL,
  `entryDateTime` datetime NOT NULL,
  `entryUsr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debit_advice_charge`
--

CREATE TABLE IF NOT EXISTS `debit_advice_charge` (
`id` int(11) NOT NULL,
  `card_no` varchar(100) NOT NULL,
  `holder_name` varchar(100) NOT NULL,
  `branch_ac_no` varchar(100) NOT NULL,
  `payment_instruction` varchar(100) NOT NULL,
  `outstanding_balance` varchar(100) NOT NULL,
  `due_amount` varchar(100) NOT NULL,
  `pay_amount` varchar(100) NOT NULL,
  `net_due_amount` varchar(100) NOT NULL,
  `upload_date` varchar(20) NOT NULL,
  `upload_by` varchar(10) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `rate` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debit_card_api`
--

CREATE TABLE IF NOT EXISTS `debit_card_api` (
`id` int(11) NOT NULL,
  `accountno` varchar(13) DEFAULT NULL,
  `customerid` bigint(13) NOT NULL,
  `accounttype` varchar(100) NOT NULL,
  `actypecode` int(3) NOT NULL,
  `accountname` varchar(50) NOT NULL,
  `accstatus` varchar(50) NOT NULL,
  `accnameoncard` varchar(35) NOT NULL,
  `accopendate` date NOT NULL,
  `accfather` varchar(50) NOT NULL,
  `accmother` varchar(100) DEFAULT NULL,
  `nationalid` bigint(17) DEFAULT NULL,
  `accphone` int(11) NOT NULL,
  `accotheremail` text,
  `accotherphone` int(11) NOT NULL,
  `accaddress` text NOT NULL,
  `accdateofbirth` date NOT NULL,
  `accsex` char(1) NOT NULL,
  `bal_tk` decimal(13,2) NOT NULL,
  `card_status` varchar(20) NOT NULL,
  `receive_branch` int(11) DEFAULT NULL,
  `entry_by_id` varchar(100) NOT NULL,
  `approve_by_id` varchar(100) NOT NULL,
  `requestDate` varchar(50) DEFAULT NULL,
  `approve_date` date NOT NULL,
  `batch_num` int(11) NOT NULL,
  `status` int(5) DEFAULT NULL COMMENT '0 for entry, 1 for branch authorize, 2 for headoffice authorize , 3 for XML generate and 5 for rezec',
  `branch_id` int(10) DEFAULT NULL,
  `request_type` int(11) DEFAULT NULL COMMENT '1 = new card, 2 = reissue, 3 for card activition, 4 = card blocked ,5 pin change',
  `request_for` int(11) DEFAULT NULL COMMENT '1 for card re-issue, 2 for pin re-issue, 3 activation, 4 block, 5 cancel, 6 expired',
  `remarks` varchar(200) DEFAULT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `issue_branch` int(11) DEFAULT NULL,
  `narration` varchar(200) DEFAULT NULL,
  `markated_by` varchar(100) DEFAULT NULL,
  `card_type` varchar(150) DEFAULT NULL,
  `br_approve_id` varchar(100) DEFAULT NULL,
  `forword_card_number` varchar(50) DEFAULT NULL,
  `br_auth_time` varchar(15) DEFAULT NULL,
  `ho_auth_time` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4781 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debit_card_api_bk`
--

CREATE TABLE IF NOT EXISTS `debit_card_api_bk` (
`id` int(11) NOT NULL,
  `accountno` varchar(13) DEFAULT NULL,
  `customerid` bigint(13) NOT NULL,
  `accounttype` varchar(100) NOT NULL,
  `accountname` varchar(50) NOT NULL,
  `accstatus` varchar(50) NOT NULL,
  `accopendate` date NOT NULL,
  `accfather` varchar(50) NOT NULL,
  `nationalid` bigint(17) DEFAULT NULL,
  `accphone` int(11) NOT NULL,
  `accemail` varchar(120) NOT NULL,
  `accaddress` text NOT NULL,
  `accdateofbirth` date NOT NULL,
  `accsex` char(1) NOT NULL,
  `bal_tk` decimal(13,2) NOT NULL,
  `approveDate` date NOT NULL,
  `approve_by_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `status_by_id` int(11) NOT NULL,
  `status_date` date NOT NULL,
  `batch` int(11) NOT NULL,
  `batch_cr_date` date NOT NULL,
  `approve_batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=949 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debit_card_api_old`
--

CREATE TABLE IF NOT EXISTS `debit_card_api_old` (
`id` int(11) NOT NULL,
  `accountno` varchar(13) DEFAULT NULL,
  `customerid` bigint(13) NOT NULL,
  `accounttype` varchar(100) NOT NULL,
  `actypecode` int(3) NOT NULL,
  `accountname` varchar(50) NOT NULL,
  `accstatus` varchar(50) NOT NULL,
  `accnameoncard` varchar(35) NOT NULL,
  `accopendate` date NOT NULL,
  `accfather` varchar(50) NOT NULL,
  `accmother` varchar(100) DEFAULT NULL,
  `nationalid` bigint(17) DEFAULT NULL,
  `accphone` int(11) NOT NULL,
  `accotheremail` text,
  `accotherphone` int(11) NOT NULL,
  `accaddress` text NOT NULL,
  `accdateofbirth` date NOT NULL,
  `accsex` char(1) NOT NULL,
  `bal_tk` decimal(13,2) NOT NULL,
  `card_status` varchar(20) NOT NULL,
  `receive_branch` int(11) DEFAULT NULL,
  `entry_by_id` int(11) NOT NULL,
  `approve_by_id` int(11) NOT NULL,
  `requestDate` varchar(50) DEFAULT NULL,
  `approve_date` date NOT NULL,
  `batch_num` int(11) NOT NULL,
  `status` int(5) DEFAULT NULL COMMENT '0 for entry, 1 for branch authorize, 2 for headoffice authorize , 3 for XML generate and 5 for rezec',
  `branch_id` int(10) DEFAULT NULL,
  `request_type` int(11) DEFAULT NULL COMMENT '1 = new card, 2 = reissue, 3 for card activition, 4 = card blocked ,5 pin change',
  `request_for` int(11) DEFAULT NULL COMMENT '1 for card re-issue, 2 for pin re-issue, 3 activation, 4 block, 5 cancel, 6 expired',
  `remarks` varchar(200) DEFAULT NULL,
  `card_number` varchar(50) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `issue_branch` int(11) DEFAULT NULL,
  `narration` varchar(200) DEFAULT NULL,
  `markated_by` varchar(100) DEFAULT NULL,
  `card_type` varchar(150) DEFAULT NULL,
  `br_approve_id` int(11) DEFAULT NULL,
  `forword_card_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=957 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debit_card_sms`
--

CREATE TABLE IF NOT EXISTS `debit_card_sms` (
`id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_type` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debit_charge_deduction`
--

CREATE TABLE IF NOT EXISTS `debit_charge_deduction` (
`sl` int(11) NOT NULL,
  `file_name` varchar(200) DEFAULT NULL,
  `posting_dt` varchar(25) NOT NULL,
  `card_holder_name` varchar(50) NOT NULL,
  `card_no_file` varchar(50) NOT NULL,
  `account_no_file` varchar(50) NOT NULL,
  `card_status` varchar(10) NOT NULL,
  `created_dt` varchar(25) NOT NULL,
  `expiry_dt` varchar(25) NOT NULL,
  `card_fee` double(8,2) NOT NULL,
  `vat` double(8,2) NOT NULL,
  `total_card_fee` double(8,2) NOT NULL,
  `card_fee_rev` double(8,2) NOT NULL,
  `vat_rev` double(8,2) NOT NULL,
  `total_card_fee_rev` double(8,2) NOT NULL,
  `ac_from_flora` varchar(20) NOT NULL,
  `ac_from_tebonus` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Not processed;1=processed, 2=due',
  `entry_dt` varchar(50) NOT NULL,
  `process_dt` varchar(50) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `paid_fee_amt` varchar(100) DEFAULT NULL,
  `due_fee_amt` varchar(100) DEFAULT NULL,
  `payable_net_amount` varchar(100) NOT NULL,
  `payable_vat_amount` varchar(100) NOT NULL,
  `debit_amount` varchar(50) NOT NULL,
  `narrition` varchar(200) DEFAULT NULL,
  `update_by` varchar(5) DEFAULT NULL,
  `update_timestamp` varchar(20) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=3155 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district_list`
--

CREATE TABLE IF NOT EXISTS `district_list` (
`id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_notification_sent_record`
--

CREATE TABLE IF NOT EXISTS `email_notification_sent_record` (
`keyCode` int(11) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `sentDate` date NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_sent_record`
--

CREATE TABLE IF NOT EXISTS `email_sent_record` (
`keyCode` int(11) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `stmtDate` date NOT NULL,
  `sentDate` date NOT NULL,
  `user` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10551 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_table`
--

CREATE TABLE IF NOT EXISTS `menu_table` (
`sl` int(11) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `parent` varchar(30) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `role` varchar(250) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mis_table`
--

CREATE TABLE IF NOT EXISTS `mis_table` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_address` text COLLATE utf8mb4_unicode_ci,
  `contract_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_address` text COLLATE utf8mb4_unicode_ci,
  `register_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_region` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `register_country` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_zone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_circle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_officer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no_bdt` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit_amt_bd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `limit_amt_usd` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report'
) ENGINE=MyISAM AUTO_INCREMENT=2323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `new_cl_table`
--

CREATE TABLE IF NOT EXISTS `new_cl_table` (
`id` bigint(20) unsigned NOT NULL,
  `personal_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_birth` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `resident_city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_region` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident_country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `correspondence_city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_region` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correspondence_country` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referenced_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marketed_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_product_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statement_cycle` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unpaid_emi_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_bdt` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caredit_limit_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suspense_profit_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_outstanding_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mp_due_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overdue_amt_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_amt_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_paid_date_usd` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliquency` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_by` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 not create report 1 create report'
) ENGINE=MyISAM AUTO_INCREMENT=2309 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE IF NOT EXISTS `operations` (
  `IdClient` varchar(50) NOT NULL,
  `CARD_LIST` varchar(50) NOT NULL,
  `STATEMENT_DATE` varchar(50) NOT NULL,
  `STATEMENT_DATE_SORT` date NOT NULL,
  `O` varchar(20) NOT NULL,
  `OD` varchar(30) NOT NULL,
  `OD_SORT` datetime NOT NULL,
  `TD` varchar(30) NOT NULL,
  `TD_SORT` datetime NOT NULL,
  `A` varchar(50) NOT NULL,
  `ACURC` varchar(50) NOT NULL,
  `ACURN` varchar(50) NOT NULL,
  `D` varchar(50) NOT NULL,
  `DE` varchar(50) NOT NULL,
  `P` varchar(50) NOT NULL,
  `OA` varchar(30) NOT NULL,
  `OCC` varchar(50) NOT NULL,
  `OC` varchar(30) NOT NULL,
  `TL` varchar(50) NOT NULL,
  `TERMN` varchar(50) NOT NULL,
  `CF` varchar(50) NOT NULL,
  `S` varchar(50) NOT NULL,
  `MN` varchar(200) NOT NULL,
  `DOCNO` varchar(50) NOT NULL,
  `NO` varchar(50) NOT NULL,
  `ACC` varchar(50) NOT NULL,
  `AMOUNTSIGN` varchar(50) NOT NULL,
  `ACCOUNT` varchar(50) NOT NULL,
  `FR` varchar(50) NOT NULL,
  `APPROVAL` varchar(200) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
`payment_method_id` int(11) NOT NULL,
  `value` varchar(3) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `periodicity`
--

CREATE TABLE IF NOT EXISTS `periodicity` (
`periodicity_id` int(11) NOT NULL,
  `value` varchar(1) NOT NULL,
  `description` varchar(70) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(4) NOT NULL,
  `permission_name` varchar(120) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rate_tb`
--

CREATE TABLE IF NOT EXISTS `rate_tb` (
`id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `rate_date` date NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `re_issue_cbs_log`
--

CREATE TABLE IF NOT EXISTS `re_issue_cbs_log` (
`id` int(100) NOT NULL,
  `log_id` varchar(100) NOT NULL,
  `error` varchar(100) NOT NULL,
  `cvs_log` text NOT NULL,
  `log_type` varchar(5) DEFAULT NULL,
  `logTimeStamp` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72126 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `re_issue_charge_deduction`
--

CREATE TABLE IF NOT EXISTS `re_issue_charge_deduction` (
`sl` int(11) NOT NULL,
  `card_holder_name` varchar(50) NOT NULL,
  `account_no_file` varchar(50) NOT NULL,
  `card_no_file` varchar(50) NOT NULL,
  `card_fee` double(8,2) NOT NULL,
  `vat` double(8,2) NOT NULL,
  `total_card_fee` double(8,2) NOT NULL,
  `paid_fee_amt` varchar(100) DEFAULT NULL,
  `due_fee_amt` varchar(100) DEFAULT NULL,
  `payable_net_amount` varchar(100) NOT NULL,
  `payable_vat_amount` varchar(100) NOT NULL,
  `debit_amount` varchar(50) NOT NULL,
  `reason` int(10) DEFAULT NULL,
  `request_type` int(10) NOT NULL,
  `narrition` varchar(200) DEFAULT NULL,
  `posting_dt` varchar(50) NOT NULL,
  `entry_dt` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Not processed;1=processed, 2=due'
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `re_issue_charge_log`
--

CREATE TABLE IF NOT EXISTS `re_issue_charge_log` (
`id` int(11) NOT NULL,
  `debit_sl` varchar(10) DEFAULT NULL,
  `card_no` varchar(100) DEFAULT NULL,
  `acc_no` varchar(100) DEFAULT NULL,
  `balance_amt` varchar(100) DEFAULT NULL,
  `paid_amt` varchar(100) DEFAULT NULL,
  `card_fee` varchar(50) DEFAULT NULL,
  `vat` varchar(50) DEFAULT NULL,
  `due_amt` varchar(100) DEFAULT NULL,
  `charge_date` varchar(100) DEFAULT NULL,
  `msg` varchar(100) DEFAULT NULL,
  `batch_no` varchar(100) DEFAULT NULL,
  `TraceNoList_0` varchar(100) DEFAULT NULL,
  `TraceNoList_1` varchar(100) DEFAULT NULL,
  `entry_date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `role_name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_old`
--

CREATE TABLE IF NOT EXISTS `role_old` (
`id` int(11) NOT NULL,
  `role_name` varchar(60) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbac_all_card_list`
--

CREATE TABLE IF NOT EXISTS `sbac_all_card_list` (
`sl` int(11) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `card_holder_name` varchar(50) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `ac_no` varchar(20) NOT NULL,
  `card_status` varchar(200) DEFAULT NULL,
  `name_on_card` varchar(100) DEFAULT NULL,
  `upload_dt` datetime NOT NULL,
  `file_upload_by` varchar(10) NOT NULL,
  `phone` int(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=55806 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbac_all_card_list_temp`
--

CREATE TABLE IF NOT EXISTS `sbac_all_card_list_temp` (
`sl` int(11) NOT NULL,
  `client_id` varchar(10) NOT NULL,
  `card_holder_name` varchar(50) NOT NULL,
  `card_no` varchar(50) NOT NULL,
  `ac_no` varchar(20) NOT NULL,
  `card_status` varchar(200) DEFAULT NULL,
  `name_on_card` varchar(100) DEFAULT NULL,
  `upload_dt` datetime DEFAULT NULL,
  `file_upload_by` varchar(10) DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sector_list`
--

CREATE TABLE IF NOT EXISTS `sector_list` (
  `code` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slug_table`
--

CREATE TABLE IF NOT EXISTS `slug_table` (
`id` int(11) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `menu_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_send_record`
--

CREATE TABLE IF NOT EXISTS `sms_send_record` (
`id` int(11) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `send_date` datetime NOT NULL,
  `response` text NOT NULL,
  `success` int(11) NOT NULL COMMENT '1 for send sms, 0 for not send sms'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stmt_info`
--

CREATE TABLE IF NOT EXISTS `stmt_info` (
  `IdClient` varchar(50) NOT NULL,
  `CARD_LIST` varchar(50) NOT NULL,
  `STATEMENT_DATE` varchar(30) NOT NULL,
  `STATEMENT_DATE_SORT` date NOT NULL,
  `MAIN_CARD` varchar(50) NOT NULL,
  `StartDate` varchar(50) NOT NULL,
  `StartDateSort` datetime NOT NULL,
  `NEXT_STATEMENT_DATE` varchar(30) NOT NULL,
  `NEXT_STATEMENT_DATE_SORT` date NOT NULL,
  `PAYMENT_DATE` varchar(30) NOT NULL,
  `PAYMENT_DATE_SORT` date NOT NULL,
  `EndDate` varchar(50) NOT NULL,
  `EndDateSort` datetime NOT NULL,
  `STATEMENT_PERIOD` varchar(50) NOT NULL,
  `StatementType` varchar(50) NOT NULL,
  `SendType` varchar(50) NOT NULL,
  `lastUpdOn` datetime NOT NULL,
  `usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_info`
--

CREATE TABLE IF NOT EXISTS `subject_info` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `production_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_brth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nr` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error_code` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_info_1`
--

CREATE TABLE IF NOT EXISTS `subject_info_1` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fi_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `production_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_fi_sub` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `business_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nr` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=13807 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_info_archive`
--

CREATE TABLE IF NOT EXISTS `subject_info_archive` (
`id` bigint(20) unsigned NOT NULL,
  `record_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `production_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_link` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fi_subject_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_fi_sub` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dath_of_brth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_nid` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_postal_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_postal_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_country_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_nr` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_issue_country_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_nid_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reporting_date` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 for start, 1 for process, 2 for final CIB accept and 5 for hold',
  `archive_date` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entry_date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table 24`
--

CREATE TABLE IF NOT EXISTS `table 24` (
  `COL 1` varchar(4) DEFAULT NULL,
  `COL 2` varchar(17) DEFAULT NULL,
  `COL 3` varchar(9) DEFAULT NULL,
  `COL 4` varchar(5) DEFAULT NULL,
  `COL 5` varchar(36) DEFAULT NULL,
  `COL 6` varchar(13) DEFAULT NULL,
  `COL 7` varchar(3) DEFAULT NULL,
  `COL 8` varchar(40) DEFAULT NULL,
  `COL 9` varchar(29) DEFAULT NULL,
  `COL 10` varchar(33) DEFAULT NULL,
  `COL 11` varchar(78) DEFAULT NULL,
  `COL 12` varchar(13) DEFAULT NULL,
  `COL 13` varchar(17) DEFAULT NULL,
  `COL 14` varchar(16) DEFAULT NULL,
  `COL 15` varchar(78) DEFAULT NULL,
  `COL 16` varchar(19) DEFAULT NULL,
  `COL 17` varchar(21) DEFAULT NULL,
  `COL 18` varchar(22) DEFAULT NULL,
  `COL 19` varchar(11) DEFAULT NULL,
  `COL 20` varchar(17) DEFAULT NULL,
  `COL 21` varchar(16) DEFAULT NULL,
  `COL 22` varchar(48) DEFAULT NULL,
  `COL 23` varchar(32) DEFAULT NULL,
  `COL 24` varchar(9) DEFAULT NULL,
  `COL 25` varchar(18) DEFAULT NULL,
  `COL 26` varchar(18) DEFAULT NULL,
  `COL 27` varchar(20) DEFAULT NULL,
  `COL 28` varchar(11) DEFAULT NULL,
  `COL 29` varchar(13) DEFAULT NULL,
  `COL 30` varchar(11) DEFAULT NULL,
  `COL 31` varchar(16) DEFAULT NULL,
  `COL 32` varchar(25) DEFAULT NULL,
  `COL 33` varchar(15) DEFAULT NULL,
  `COL 34` varchar(10) DEFAULT NULL,
  `COL 35` varchar(23) DEFAULT NULL,
  `COL 36` varchar(11) DEFAULT NULL,
  `COL 37` varchar(11) DEFAULT NULL,
  `COL 38` varchar(10) DEFAULT NULL,
  `COL 39` varchar(20) DEFAULT NULL,
  `COL 40` varchar(11) DEFAULT NULL,
  `COL 41` varchar(17) DEFAULT NULL,
  `COL 42` varchar(15) DEFAULT NULL,
  `COL 43` varchar(19) DEFAULT NULL,
  `COL 44` varchar(14) DEFAULT NULL,
  `COL 45` varchar(21) DEFAULT NULL,
  `COL 46` varchar(11) DEFAULT NULL,
  `COL 47` varchar(15) DEFAULT NULL,
  `COL 48` varchar(17) DEFAULT NULL,
  `COL 49` varchar(18) DEFAULT NULL,
  `COL 50` varchar(17) DEFAULT NULL,
  `COL 51` varchar(15) DEFAULT NULL,
  `COL 52` varchar(19) DEFAULT NULL,
  `COL 53` varchar(21) DEFAULT NULL,
  `COL 54` varchar(10) DEFAULT NULL,
  `COL 55` varchar(15) DEFAULT NULL,
  `COL 56` varchar(17) DEFAULT NULL,
  `COL 57` varchar(18) DEFAULT NULL,
  `COL 58` varchar(8) DEFAULT NULL,
  `COL 59` varchar(16) DEFAULT NULL,
  `COL 60` varchar(8) DEFAULT NULL,
  `COL 61` varchar(10) DEFAULT NULL,
  `COL 62` varchar(13) DEFAULT NULL,
  `COL 63` varchar(4) DEFAULT NULL,
  `COL 64` varchar(14) DEFAULT NULL,
  `COL 65` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `table 25`
--

CREATE TABLE IF NOT EXISTS `table 25` (
  `COL 1` varchar(4) DEFAULT NULL,
  `COL 2` varchar(17) DEFAULT NULL,
  `COL 3` varchar(9) DEFAULT NULL,
  `COL 4` varchar(5) DEFAULT NULL,
  `COL 5` varchar(36) DEFAULT NULL,
  `COL 6` varchar(13) DEFAULT NULL,
  `COL 7` varchar(3) DEFAULT NULL,
  `COL 8` varchar(40) DEFAULT NULL,
  `COL 9` varchar(29) DEFAULT NULL,
  `COL 10` varchar(33) DEFAULT NULL,
  `COL 11` varchar(78) DEFAULT NULL,
  `COL 12` varchar(13) DEFAULT NULL,
  `COL 13` varchar(17) DEFAULT NULL,
  `COL 14` varchar(16) DEFAULT NULL,
  `COL 15` varchar(78) DEFAULT NULL,
  `COL 16` varchar(19) DEFAULT NULL,
  `COL 17` varchar(21) DEFAULT NULL,
  `COL 18` varchar(22) DEFAULT NULL,
  `COL 19` varchar(11) DEFAULT NULL,
  `COL 20` varchar(17) DEFAULT NULL,
  `COL 21` varchar(16) DEFAULT NULL,
  `COL 22` varchar(48) DEFAULT NULL,
  `COL 23` varchar(32) DEFAULT NULL,
  `COL 24` varchar(9) DEFAULT NULL,
  `COL 25` varchar(18) DEFAULT NULL,
  `COL 26` varchar(18) DEFAULT NULL,
  `COL 27` varchar(20) DEFAULT NULL,
  `COL 28` varchar(11) DEFAULT NULL,
  `COL 29` varchar(13) DEFAULT NULL,
  `COL 30` varchar(11) DEFAULT NULL,
  `COL 31` varchar(16) DEFAULT NULL,
  `COL 32` varchar(25) DEFAULT NULL,
  `COL 33` varchar(15) DEFAULT NULL,
  `COL 34` varchar(10) DEFAULT NULL,
  `COL 35` varchar(23) DEFAULT NULL,
  `COL 36` varchar(11) DEFAULT NULL,
  `COL 37` varchar(11) DEFAULT NULL,
  `COL 38` varchar(10) DEFAULT NULL,
  `COL 39` varchar(20) DEFAULT NULL,
  `COL 40` varchar(11) DEFAULT NULL,
  `COL 41` varchar(17) DEFAULT NULL,
  `COL 42` varchar(15) DEFAULT NULL,
  `COL 43` varchar(19) DEFAULT NULL,
  `COL 44` varchar(14) DEFAULT NULL,
  `COL 45` varchar(21) DEFAULT NULL,
  `COL 46` varchar(11) DEFAULT NULL,
  `COL 47` varchar(15) DEFAULT NULL,
  `COL 48` varchar(17) DEFAULT NULL,
  `COL 49` varchar(18) DEFAULT NULL,
  `COL 50` varchar(17) DEFAULT NULL,
  `COL 51` varchar(15) DEFAULT NULL,
  `COL 52` varchar(19) DEFAULT NULL,
  `COL 53` varchar(21) DEFAULT NULL,
  `COL 54` varchar(10) DEFAULT NULL,
  `COL 55` varchar(15) DEFAULT NULL,
  `COL 56` varchar(17) DEFAULT NULL,
  `COL 57` varchar(18) DEFAULT NULL,
  `COL 58` varchar(8) DEFAULT NULL,
  `COL 59` varchar(16) DEFAULT NULL,
  `COL 60` varchar(8) DEFAULT NULL,
  `COL 61` varchar(10) DEFAULT NULL,
  `COL 62` varchar(13) DEFAULT NULL,
  `COL 63` varchar(4) DEFAULT NULL,
  `COL 64` varchar(14) DEFAULT NULL,
  `COL 65` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `text_file_info`
--

CREATE TABLE IF NOT EXISTS `text_file_info` (
`id` int(11) NOT NULL,
  `cl_id` int(11) NOT NULL,
  `cl_name` varchar(40) NOT NULL,
  `card_number` text NOT NULL,
  `card_title` varchar(20) NOT NULL,
  `mobile` text NOT NULL,
  `email` text NOT NULL,
  `card_status` varchar(50) NOT NULL,
  `cl_dob` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=633 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_fname` varchar(25) DEFAULT NULL,
  `user_lname` varchar(25) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `access_id` varchar(100) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `change_password_YN` varchar(5) DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_old`
--

CREATE TABLE IF NOT EXISTS `users_old` (
`uid` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_fname` varchar(25) DEFAULT NULL,
  `user_lname` varchar(25) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `user_pass` varchar(40) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL,
  `access_id` varchar(100) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `change_password_YN` varchar(5) DEFAULT 'N'
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_summary`
--
ALTER TABLE `account_summary`
 ADD PRIMARY KEY (`IdClient`,`CARD_LIST`,`STATEMENT_DATE`,`ACCOUNTNO`);

--
-- Indexes for table `auto_card_charge_histry_log`
--
ALTER TABLE `auto_card_charge_histry_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_card_cvs_charge_log`
--
ALTER TABLE `auto_card_cvs_charge_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auto_debit_charge`
--
ALTER TABLE `auto_debit_charge`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `bill_entry_log`
--
ALTER TABLE `bill_entry_log`
 ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
 ADD PRIMARY KEY (`br_key`), ADD UNIQUE KEY `br_code` (`br_code`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_card_charge_histry_log`
--
ALTER TABLE `branch_card_charge_histry_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_card_cvs_charge_log`
--
ALTER TABLE `branch_card_cvs_charge_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch_debit_charge`
--
ALTER TABLE `branch_debit_charge`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `card_charge_histry_log`
--
ALTER TABLE `card_charge_histry_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_charge_temp`
--
ALTER TABLE `card_charge_temp`
 ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `card_cvs_charge_log`
--
ALTER TABLE `card_cvs_charge_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card_no_manual`
--
ALTER TABLE `card_no_manual`
 ADD PRIMARY KEY (`card_sl`);

--
-- Indexes for table `card_status`
--
ALTER TABLE `card_status`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_download_history`
--
ALTER TABLE `cib_download_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_error`
--
ALTER TABLE `cib_error`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_generate_history`
--
ALTER TABLE `cib_generate_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cib_history_log`
--
ALTER TABLE `cib_history_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cl_table`
--
ALTER TABLE `cl_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cl_table_1`
--
ALTER TABLE `cl_table_1`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts_info`
--
ALTER TABLE `contracts_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts_info_1`
--
ALTER TABLE `contracts_info_1`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts_info_archive`
--
ALTER TABLE `contracts_info_archive`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_phases`
--
ALTER TABLE `contract_phases`
 ADD PRIMARY KEY (`contr_phases_id`);

--
-- Indexes for table `contract_types`
--
ALTER TABLE `contract_types`
 ADD PRIMARY KEY (`contr_type_id`);

--
-- Indexes for table `currency_codes`
--
ALTER TABLE `currency_codes`
 ADD PRIMARY KEY (`currency_code_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`keyCode`), ADD UNIQUE KEY `IdClient` (`IdClient`);

--
-- Indexes for table `customer1`
--
ALTER TABLE `customer1`
 ADD PRIMARY KEY (`keyCode`), ADD UNIQUE KEY `IdClient` (`IdClient`);

--
-- Indexes for table `customer_card`
--
ALTER TABLE `customer_card`
 ADD PRIMARY KEY (`IdClient`,`PAN`);

--
-- Indexes for table `customer_contact_1`
--
ALTER TABLE `customer_contact_1`
 ADD PRIMARY KEY (`IdClient`);

--
-- Indexes for table `customer_contact_bk`
--
ALTER TABLE `customer_contact_bk`
 ADD PRIMARY KEY (`IdClient`);

--
-- Indexes for table `debit_advice_charge`
--
ALTER TABLE `debit_advice_charge`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debit_card_api`
--
ALTER TABLE `debit_card_api`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debit_card_api_bk`
--
ALTER TABLE `debit_card_api_bk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debit_card_api_old`
--
ALTER TABLE `debit_card_api_old`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debit_card_sms`
--
ALTER TABLE `debit_card_sms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debit_charge_deduction`
--
ALTER TABLE `debit_charge_deduction`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `district_list`
--
ALTER TABLE `district_list`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_notification_sent_record`
--
ALTER TABLE `email_notification_sent_record`
 ADD PRIMARY KEY (`keyCode`);

--
-- Indexes for table `email_sent_record`
--
ALTER TABLE `email_sent_record`
 ADD PRIMARY KEY (`keyCode`);

--
-- Indexes for table `menu_table`
--
ALTER TABLE `menu_table`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `mis_table`
--
ALTER TABLE `mis_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_cl_table`
--
ALTER TABLE `new_cl_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
 ADD PRIMARY KEY (`IdClient`,`CARD_LIST`,`STATEMENT_DATE`,`O`,`ACCOUNT`) USING BTREE;

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
 ADD PRIMARY KEY (`payment_method_id`);

--
-- Indexes for table `periodicity`
--
ALTER TABLE `periodicity`
 ADD PRIMARY KEY (`periodicity_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_tb`
--
ALTER TABLE `rate_tb`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_issue_cbs_log`
--
ALTER TABLE `re_issue_cbs_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `re_issue_charge_deduction`
--
ALTER TABLE `re_issue_charge_deduction`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `re_issue_charge_log`
--
ALTER TABLE `re_issue_charge_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_old`
--
ALTER TABLE `role_old`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
 ADD PRIMARY KEY (`id`), ADD KEY `role_id` (`role_id`), ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `sbac_all_card_list`
--
ALTER TABLE `sbac_all_card_list`
 ADD PRIMARY KEY (`sl`), ADD UNIQUE KEY `unique_index` (`card_no`,`ac_no`);

--
-- Indexes for table `sbac_all_card_list_temp`
--
ALTER TABLE `sbac_all_card_list_temp`
 ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `sector_list`
--
ALTER TABLE `sector_list`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `slug_table`
--
ALTER TABLE `slug_table`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_send_record`
--
ALTER TABLE `sms_send_record`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stmt_info`
--
ALTER TABLE `stmt_info`
 ADD PRIMARY KEY (`IdClient`,`MAIN_CARD`,`STATEMENT_DATE`) USING BTREE;

--
-- Indexes for table `subject_info`
--
ALTER TABLE `subject_info`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `card_fi_sub` (`card_fi_sub`), ADD UNIQUE KEY `fi_subject_code` (`fi_subject_code`);

--
-- Indexes for table `subject_info_1`
--
ALTER TABLE `subject_info_1`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `fi_subject_code` (`fi_subject_code`), ADD UNIQUE KEY `card_fi_sub` (`card_fi_sub`);

--
-- Indexes for table `subject_info_archive`
--
ALTER TABLE `subject_info_archive`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text_file_info`
--
ALTER TABLE `text_file_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `access_id` (`access_id`), ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `users_old`
--
ALTER TABLE `users_old`
 ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `access_id` (`access_id`), ADD KEY `branch_id` (`branch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_card_charge_histry_log`
--
ALTER TABLE `auto_card_charge_histry_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=531;
--
-- AUTO_INCREMENT for table `auto_card_cvs_charge_log`
--
ALTER TABLE `auto_card_cvs_charge_log`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4085531;
--
-- AUTO_INCREMENT for table `auto_debit_charge`
--
ALTER TABLE `auto_debit_charge`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2058;
--
-- AUTO_INCREMENT for table `bill_entry_log`
--
ALTER TABLE `bill_entry_log`
MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
MODIFY `br_key` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `branch_card_charge_histry_log`
--
ALTER TABLE `branch_card_charge_histry_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branch_card_cvs_charge_log`
--
ALTER TABLE `branch_card_cvs_charge_log`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `branch_debit_charge`
--
ALTER TABLE `branch_debit_charge`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `card_charge_histry_log`
--
ALTER TABLE `card_charge_histry_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1933;
--
-- AUTO_INCREMENT for table `card_charge_temp`
--
ALTER TABLE `card_charge_temp`
MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `card_cvs_charge_log`
--
ALTER TABLE `card_cvs_charge_log`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7782764;
--
-- AUTO_INCREMENT for table `card_no_manual`
--
ALTER TABLE `card_no_manual`
MODIFY `card_sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=255;
--
-- AUTO_INCREMENT for table `card_status`
--
ALTER TABLE `card_status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cib_download_history`
--
ALTER TABLE `cib_download_history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `cib_error`
--
ALTER TABLE `cib_error`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=314;
--
-- AUTO_INCREMENT for table `cib_generate_history`
--
ALTER TABLE `cib_generate_history`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `cib_history_log`
--
ALTER TABLE `cib_history_log`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cl_table`
--
ALTER TABLE `cl_table`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20800;
--
-- AUTO_INCREMENT for table `cl_table_1`
--
ALTER TABLE `cl_table_1`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2309;
--
-- AUTO_INCREMENT for table `contracts_info`
--
ALTER TABLE `contracts_info`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2293;
--
-- AUTO_INCREMENT for table `contracts_info_1`
--
ALTER TABLE `contracts_info_1`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13849;
--
-- AUTO_INCREMENT for table `contracts_info_archive`
--
ALTER TABLE `contracts_info_archive`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5812;
--
-- AUTO_INCREMENT for table `contract_phases`
--
ALTER TABLE `contract_phases`
MODIFY `contr_phases_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `contract_types`
--
ALTER TABLE `contract_types`
MODIFY `contr_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `currency_codes`
--
ALTER TABLE `currency_codes`
MODIFY `currency_code_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `keyCode` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2508;
--
-- AUTO_INCREMENT for table `customer1`
--
ALTER TABLE `customer1`
MODIFY `keyCode` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=800;
--
-- AUTO_INCREMENT for table `debit_advice_charge`
--
ALTER TABLE `debit_advice_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `debit_card_api`
--
ALTER TABLE `debit_card_api`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4781;
--
-- AUTO_INCREMENT for table `debit_card_api_bk`
--
ALTER TABLE `debit_card_api_bk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=949;
--
-- AUTO_INCREMENT for table `debit_card_api_old`
--
ALTER TABLE `debit_card_api_old`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=957;
--
-- AUTO_INCREMENT for table `debit_card_sms`
--
ALTER TABLE `debit_card_sms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `debit_charge_deduction`
--
ALTER TABLE `debit_charge_deduction`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3155;
--
-- AUTO_INCREMENT for table `district_list`
--
ALTER TABLE `district_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `email_notification_sent_record`
--
ALTER TABLE `email_notification_sent_record`
MODIFY `keyCode` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email_sent_record`
--
ALTER TABLE `email_sent_record`
MODIFY `keyCode` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10551;
--
-- AUTO_INCREMENT for table `menu_table`
--
ALTER TABLE `menu_table`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `mis_table`
--
ALTER TABLE `mis_table`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2323;
--
-- AUTO_INCREMENT for table `new_cl_table`
--
ALTER TABLE `new_cl_table`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2309;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
MODIFY `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `periodicity`
--
ALTER TABLE `periodicity`
MODIFY `periodicity_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rate_tb`
--
ALTER TABLE `rate_tb`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `re_issue_cbs_log`
--
ALTER TABLE `re_issue_cbs_log`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72126;
--
-- AUTO_INCREMENT for table `re_issue_charge_deduction`
--
ALTER TABLE `re_issue_charge_deduction`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `re_issue_charge_log`
--
ALTER TABLE `re_issue_charge_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `role_old`
--
ALTER TABLE `role_old`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbac_all_card_list`
--
ALTER TABLE `sbac_all_card_list`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55806;
--
-- AUTO_INCREMENT for table `sbac_all_card_list_temp`
--
ALTER TABLE `sbac_all_card_list_temp`
MODIFY `sl` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slug_table`
--
ALTER TABLE `slug_table`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sms_send_record`
--
ALTER TABLE `sms_send_record`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `subject_info`
--
ALTER TABLE `subject_info`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2286;
--
-- AUTO_INCREMENT for table `subject_info_1`
--
ALTER TABLE `subject_info_1`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13807;
--
-- AUTO_INCREMENT for table `subject_info_archive`
--
ALTER TABLE `subject_info_archive`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4211;
--
-- AUTO_INCREMENT for table `text_file_info`
--
ALTER TABLE `text_file_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=633;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=364;
--
-- AUTO_INCREMENT for table `users_old`
--
ALTER TABLE `users_old`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=324;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role_old` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
