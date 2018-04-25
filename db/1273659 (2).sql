-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2017 at 02:41 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1273659`
--

-- --------------------------------------------------------

--
-- Table structure for table `fts_actionable_letter`
--

CREATE TABLE IF NOT EXISTS `fts_actionable_letter` (
  `action_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `letter_id` bigint(20) NOT NULL,
  `deadline_dt` date NOT NULL,
  `action_details` varchar(255) NOT NULL,
  `trail_letter_id` bigint(20) NOT NULL,
  `action_status` varchar(10) NOT NULL,
  PRIMARY KEY (`action_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_authority`
--

CREATE TABLE IF NOT EXISTS `fts_authority` (
  `authority_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `authority_name` varchar(255) NOT NULL,
  PRIMARY KEY (`authority_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `fts_authority`
--

INSERT INTO `fts_authority` (`authority_id`, `authority_name`) VALUES
(1, 'Homicide Squad'),
(2, 'DRBT Section'),
(3, 'Motor Theft Squad'),
(4, 'Special Operation Group (SOG)'),
(5, 'Railway & Highway Crime Cell'),
(6, 'Special Crime Unit'),
(7, 'Cyber Crime Cell ( also covering Cyber Forensics)'),
(8, 'Narcotic Cell'),
(9, 'Economic Offence Wing (EOW)'),
(10, 'Cheating & Fraud Section'),
(11, 'Protection of Women & Children Cell (POWC)'),
(12, 'Anti Human Trafficking Unit (AHTU) '),
(13, 'Srt'),
(14, 'Mm'),
(15, 'KKKKK'),
(16, 'PWD'),
(17, 'TEST'),
(18, 'TESST'),
(19, 'VVVVVVVVVVVVVVV'),
(20, 'SP SOUTH 24 PGS'),
(21, 'TTTTTTTTTTTTTTTTTT'),
(22, 'KKKKKKKKKKKKKK'),
(23, 'AVIK'),
(24, 'EB'),
(25, 'ADSEQWE');

-- --------------------------------------------------------

--
-- Table structure for table `fts_category`
--

CREATE TABLE IF NOT EXISTS `fts_category` (
  `cat_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `fts_category`
--

INSERT INTO `fts_category` (`cat_id`, `category`) VALUES
(1, 'Modernization'),
(2, 'Account'),
(3, 'Recruitment'),
(4, 'Wer'),
(5, 'M123');

-- --------------------------------------------------------

--
-- Table structure for table `fts_designation`
--

CREATE TABLE IF NOT EXISTS `fts_designation` (
  `desig_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `desig_name` varchar(255) NOT NULL,
  PRIMARY KEY (`desig_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `fts_designation`
--

INSERT INTO `fts_designation` (`desig_id`, `desig_name`) VALUES
(1, 'ADGP,CID'),
(2, 'IGP,CID'),
(3, 'DIG,OPS'),
(4, 'DIG,CID'),
(5, 'IPS'),
(6, 'SS,CID'),
(7, 'SS,SPECIAL'),
(8, 'SS,HQ'),
(9, 'OS'),
(10, 'OC'),
(11, 'SUPERVISOR II'),
(12, 'Inspr'),
(13, 'SUPERINTENDENT ');

-- --------------------------------------------------------

--
-- Table structure for table `fts_employee`
--

CREATE TABLE IF NOT EXISTS `fts_employee` (
  `emp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gpf_id` varchar(200) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_file_history_info`
--

CREATE TABLE IF NOT EXISTS `fts_file_history_info` (
  `trail_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_id` bigint(20) NOT NULL,
  `user_id` bigint(50) NOT NULL,
  `sender_desig_id` varchar(90) NOT NULL,
  `sender_section_id` varchar(90) NOT NULL,
  `note_id` bigint(20) NOT NULL,
  `addressing_id` varchar(20) NOT NULL,
  `addressing_desig_id` varchar(90) NOT NULL,
  `addressing_section_id` varchar(90) NOT NULL,
  `date_of_action` datetime NOT NULL,
  `action_type` enum('D','R','A') NOT NULL,
  `delete_status` enum('N','Y') NOT NULL,
  PRIMARY KEY (`trail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_file_movement`
--

CREATE TABLE IF NOT EXISTS `fts_file_movement` (
  `movement_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_id` bigint(20) NOT NULL,
  `qrcode_image` varchar(250) NOT NULL,
  `qrcode_text` varchar(250) NOT NULL,
  `received_date_time` datetime NOT NULL,
  `current_dept` varchar(100) NOT NULL,
  `sender_user_id` varchar(50) NOT NULL,
  `reciver_user_id` bigint(20) NOT NULL,
  `from_desig_id` varchar(100) NOT NULL,
  `file_receive_key` varchar(50) NOT NULL,
  `addressing_desig_id` varchar(50) NOT NULL,
  `dispatch_date_time` datetime NOT NULL,
  `dispatch_key` varchar(50) NOT NULL,
  `file_status` varchar(20) NOT NULL,
  `delete_status` varchar(10) NOT NULL,
  PRIMARY KEY (`movement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_file_note`
--

CREATE TABLE IF NOT EXISTS `fts_file_note` (
  `note_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nsp_id` varchar(50) NOT NULL,
  `note_text` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `file_ref_sl_no` varchar(100) NOT NULL,
  `file_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_file_registration`
--

CREATE TABLE IF NOT EXISTS `fts_file_registration` (
  `file_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_ref_sl_no` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `desig_id` varchar(50) NOT NULL,
  `br_image_name` varchar(100) NOT NULL,
  `br_value` varchar(255) NOT NULL,
  `sec_id` bigint(20) NOT NULL,
  `file_reg_date` datetime NOT NULL,
  `description` varchar(250) NOT NULL,
  `file_priority` varchar(20) NOT NULL,
  `file_status` varchar(20) NOT NULL,
  `subject_id` bigint(100) NOT NULL,
  `type_of_paper` varchar(20) NOT NULL,
  `folder_name` varchar(200) NOT NULL,
  `file_move_status` enum('P','M','A') NOT NULL,
  `delete_status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_letter_history_info`
--

CREATE TABLE IF NOT EXISTS `fts_letter_history_info` (
  `trail_letter_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `letter_id` bigint(20) NOT NULL,
  `recv_id` bigint(20) NOT NULL,
  `receiver_section_id` varchar(90) NOT NULL,
  `receiver_desig_id` varchar(90) NOT NULL,
  `sender_user_id` bigint(20) NOT NULL,
  `sender_section_id` varchar(90) NOT NULL,
  `sender_desig_id` varchar(90) NOT NULL,
  `date_of_action` date NOT NULL,
  PRIMARY KEY (`trail_letter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_letter_movement`
--

CREATE TABLE IF NOT EXISTS `fts_letter_movement` (
  `move_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `letter_id` bigint(20) NOT NULL,
  `received_date_time` datetime NOT NULL,
  `receiver_id` varchar(100) NOT NULL,
  `sender_id` varchar(100) NOT NULL,
  `recv_desig_id` bigint(20) NOT NULL,
  `sender_desig_id` bigint(20) NOT NULL,
  `action_id` bigint(20) NOT NULL,
  `dispatch_dt_time` varchar(100) NOT NULL,
  `recv_status` varchar(50) NOT NULL,
  `delete_status` enum('N','Y') NOT NULL,
  PRIMARY KEY (`move_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_letter_record`
--

CREATE TABLE IF NOT EXISTS `fts_letter_record` (
  `letter_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sl_no` bigint(20) NOT NULL,
  `memo_no` varchar(200) NOT NULL,
  `issue_dt` date NOT NULL,
  `cp_no` int(11) NOT NULL,
  `page_count` bigint(20) NOT NULL,
  `file_id` bigint(20) NOT NULL,
  `letter_name` varchar(100) NOT NULL,
  `user_id` bigint(11) NOT NULL,
  `content` longtext NOT NULL,
  `sending_authority` bigint(20) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `addressing_desig_id` bigint(20) NOT NULL,
  `reg_dt` date NOT NULL,
  `location_path` varchar(255) NOT NULL,
  `regis_status` enum('L','F') NOT NULL,
  `letter_move_status` enum('P','M') NOT NULL,
  `addressing_user_id` bigint(20) NOT NULL,
  `register_id` bigint(20) NOT NULL,
  `attached_by` bigint(20) NOT NULL,
  PRIMARY KEY (`letter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fts_letter_register`
--

CREATE TABLE IF NOT EXISTS `fts_letter_register` (
  `register_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) NOT NULL,
  `paper_type` varchar(255) NOT NULL,
  PRIMARY KEY (`register_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `fts_letter_register`
--

INSERT INTO `fts_letter_register` (`register_id`, `keyword`, `paper_type`) VALUES
(1, 'PP', 'Public Petition'),
(2, 'NHRC', 'National Human Rights Commisson'),
(3, 'WBHRC', 'West Bengal State Human Right Commission'),
(4, 'COURT', 'Any Court related matter'),
(5, 'WBSWC', 'West Bengal State Women Commission'),
(6, 'NWC', 'National Women Commission'),
(7, 'PD', 'Police Directorate'),
(8, 'STATE GOVT', 'Any State Government Department (Secretaries etc.)'),
(9, 'PU', 'Any Police Unit like District Sps,DIG etc.'),
(10, 'NPU', 'Non Police Unit like DM, SDO, Engineers etc.'),
(11, 'CG', 'Central Government'),
(12, 'CBI', 'Central Bureau of Investigation'),
(13, 'OTHERS', 'Any paper other than above');

-- --------------------------------------------------------

--
-- Table structure for table `fts_login_log`
--

CREATE TABLE IF NOT EXISTS `fts_login_log` (
  `user_id` bigint(20) NOT NULL,
  `login_ip` varchar(200) NOT NULL,
  `action_time` datetime NOT NULL,
  `month_year` varchar(20) NOT NULL,
  `action` varchar(255) NOT NULL,
  `doc_type` varchar(50) NOT NULL,
  `doc_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fts_login_log`
--

INSERT INTO `fts_login_log` (`user_id`, `login_ip`, `action_time`, `month_year`, `action`, `doc_type`, `doc_id`) VALUES
(46, '47.15.170.248', '2017-01-12 01:30:38', '01-2017', 'Login', 'U', 46),
(46, '47.15.170.248', '2017-01-12 01:31:34', '01-2017', 'Manage User(Active)', 'U', 45),
(46, '47.15.170.248', '2017-01-12 01:31:37', '01-2017', 'Manage User(Active)', 'U', 44),
(46, '47.15.170.248', '2017-01-12 01:31:39', '01-2017', 'Manage User(Active)', 'U', 43),
(46, '47.15.170.248', '2017-01-12 01:31:41', '01-2017', 'Manage User(Active)', 'U', 42),
(46, '47.15.170.248', '2017-01-12 01:31:43', '01-2017', 'Manage User(Active)', 'U', 41),
(46, '47.15.170.248', '2017-01-12 01:31:44', '01-2017', 'Manage User(Active)', 'U', 40),
(46, '47.15.170.248', '2017-01-12 01:31:50', '01-2017', 'Manage User(Active)', 'U', 39),
(46, '47.15.170.248', '2017-01-12 01:31:52', '01-2017', 'Manage User(Active)', 'U', 38),
(46, '47.15.170.248', '2017-01-12 01:31:53', '01-2017', 'Manage User(Active)', 'U', 37),
(46, '47.15.170.248', '2017-01-12 01:31:55', '01-2017', 'Manage User(Active)', 'U', 36),
(46, '47.15.170.248', '2017-01-12 01:31:56', '01-2017', 'Manage User(Active)', 'U', 35),
(46, '47.15.170.248', '2017-01-12 01:31:58', '01-2017', 'Manage User(Active)', 'U', 34),
(46, '47.15.170.248', '2017-01-12 01:32:00', '01-2017', 'Manage User(Active)', 'U', 33),
(46, '47.15.170.248', '2017-01-12 01:32:06', '01-2017', 'Manage User(Active)', 'U', 32),
(46, '47.15.170.248', '2017-01-12 01:32:07', '01-2017', 'Manage User(Active)', 'U', 31),
(46, '47.15.170.248', '2017-01-12 01:32:08', '01-2017', 'Manage User(Active)', 'U', 30),
(46, '47.15.170.248', '2017-01-12 01:32:10', '01-2017', 'Manage User(Active)', 'U', 29),
(46, '47.15.170.248', '2017-01-12 01:32:11', '01-2017', 'Manage User(Inactive)', 'U', 29),
(46, '47.15.170.248', '2017-01-12 01:32:13', '01-2017', 'Manage User(Active)', 'U', 29),
(46, '47.15.170.248', '2017-01-12 01:32:15', '01-2017', 'Manage User(Active)', 'U', 28),
(46, '47.15.170.248', '2017-01-12 01:32:17', '01-2017', 'Manage User(Active)', 'U', 27),
(46, '47.15.170.248', '2017-01-12 01:32:18', '01-2017', 'Manage User(Active)', 'U', 26),
(46, '47.15.170.248', '2017-01-12 01:32:25', '01-2017', 'Manage User(Active)', 'U', 25),
(46, '47.15.170.248', '2017-01-12 01:32:27', '01-2017', 'Manage User(Active)', 'U', 24),
(46, '47.15.170.248', '2017-01-12 01:32:29', '01-2017', 'Manage User(Active)', 'U', 23),
(46, '47.15.170.248', '2017-01-12 01:32:31', '01-2017', 'Manage User(Active)', 'U', 22),
(46, '47.15.170.248', '2017-01-12 01:32:33', '01-2017', 'Manage User(Active)', 'U', 21),
(46, '47.15.170.248', '2017-01-12 01:32:35', '01-2017', 'Manage User(Active)', 'U', 20),
(46, '47.15.170.248', '2017-01-12 01:32:42', '01-2017', 'Manage User(Active)', 'U', 19),
(46, '47.15.170.248', '2017-01-12 01:32:49', '01-2017', 'Manage User(Active)', 'U', 18),
(46, '47.15.170.248', '2017-01-12 01:32:50', '01-2017', 'Manage User(Active)', 'U', 17),
(46, '47.15.170.248', '2017-01-12 01:32:53', '01-2017', 'Manage User(Active)', 'U', 16),
(46, '47.15.170.248', '2017-01-12 01:32:54', '01-2017', 'Manage User(Active)', 'U', 15),
(46, '47.15.170.248', '2017-01-12 01:32:56', '01-2017', 'Manage User(Active)', 'U', 14),
(46, '47.15.170.248', '2017-01-12 01:32:58', '01-2017', 'Manage User(Active)', 'U', 13),
(46, '47.15.170.248', '2017-01-12 01:33:00', '01-2017', 'Manage User(Active)', 'U', 12),
(46, '47.15.170.248', '2017-01-12 01:33:07', '01-2017', 'Manage User(Active)', 'U', 11),
(46, '47.15.170.248', '2017-01-12 01:33:09', '01-2017', 'Manage User(Active)', 'U', 10),
(46, '47.15.170.248', '2017-01-12 01:33:09', '01-2017', 'Manage User(Active)', 'U', 9),
(46, '47.15.170.248', '2017-01-12 01:33:11', '01-2017', 'Manage User(Active)', 'U', 8),
(46, '47.15.170.248', '2017-01-12 01:33:12', '01-2017', 'Manage User(Active)', 'U', 7),
(46, '47.15.170.248', '2017-01-12 01:33:14', '01-2017', 'Manage User(Active)', 'U', 6),
(46, '47.15.170.248', '2017-01-12 01:33:14', '01-2017', 'Manage User(Active)', 'U', 5),
(46, '47.15.170.248', '2017-01-12 01:33:20', '01-2017', 'Manage User(Active)', 'U', 4),
(46, '47.15.170.248', '2017-01-12 01:33:22', '01-2017', 'Manage User(Active)', 'U', 3),
(46, '47.15.170.248', '2017-01-12 01:33:23', '01-2017', 'Manage User(Active)', 'U', 2),
(46, '47.15.170.248', '2017-01-12 01:33:24', '01-2017', 'Manage User(Active)', 'U', 1),
(46, '47.15.170.248', '2017-01-12 01:33:44', '01-2017', 'Log Out', 'U', 46),
(5, '47.15.170.248', '2017-01-12 01:35:58', '01-2017', 'Login', 'U', 5),
(5, '47.15.170.248', '2017-01-12 01:39:07', '01-2017', 'Profile Update', 'U', 5),
(5, '47.15.170.248', '2017-01-12 01:39:07', '01-2017', 'Profile Update', 'U', 5),
(5, '47.15.170.248', '2017-01-12 01:39:20', '01-2017', 'Log Out', 'U', 5),
(38, '47.15.170.248', '2017-01-12 01:39:46', '01-2017', 'Login', 'U', 38),
(38, '47.15.170.248', '2017-01-12 01:41:34', '01-2017', 'Profile Update', 'U', 38),
(38, '47.15.170.248', '2017-01-12 01:45:20', '01-2017', 'Log Out', 'U', 38),
(46, '47.15.62.15', '2017-01-12 02:07:19', '01-2017', 'Login', 'U', 46),
(46, '47.15.62.15', '2017-01-12 02:07:30', '01-2017', 'Manage User(Active)', 'U', 54),
(46, '47.15.62.15', '2017-01-12 02:07:32', '01-2017', 'Manage User(Active)', 'U', 53),
(46, '47.15.62.15', '2017-01-12 02:07:34', '01-2017', 'Manage User(Active)', 'U', 52),
(46, '47.15.62.15', '2017-01-12 02:07:36', '01-2017', 'Manage User(Active)', 'U', 51),
(46, '47.15.62.15', '2017-01-12 02:07:38', '01-2017', 'Manage User(Active)', 'U', 50),
(46, '47.15.62.15', '2017-01-12 02:07:39', '01-2017', 'Manage User(Active)', 'U', 49),
(46, '47.15.62.15', '2017-01-12 02:07:42', '01-2017', 'Manage User(Active)', 'U', 48),
(46, '47.15.62.15', '2017-01-12 02:07:48', '01-2017', 'Manage User(Active)', 'U', 47),
(46, '47.15.62.15', '2017-01-12 02:07:53', '01-2017', 'Log Out', 'U', 46),
(25, '47.15.62.15', '2017-01-12 02:08:32', '01-2017', 'Login', 'U', 25),
(25, '47.15.62.15', '2017-01-12 02:08:44', '01-2017', 'Log Out', 'U', 25);

-- --------------------------------------------------------

--
-- Table structure for table `fts_personel_info`
--

CREATE TABLE IF NOT EXISTS `fts_personel_info` (
  `emp_desig_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `gpf_id` varchar(255) NOT NULL,
  `desig_id` varchar(255) NOT NULL,
  `sec_id` varchar(255) NOT NULL,
  PRIMARY KEY (`emp_desig_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `fts_personel_info`
--

INSERT INTO `fts_personel_info` (`emp_desig_id`, `user_id`, `gpf_id`, `desig_id`, `sec_id`) VALUES
(1, 1, '', '10', '10'),
(2, 2, '', '10', '11'),
(3, 3, '', '10', '12'),
(4, 4, '', '10', '13'),
(5, 5, '', '10', '14,15,20'),
(6, 6, '', '10', '16'),
(7, 7, '', '10', '1'),
(8, 8, '', '10', '3'),
(9, 9, '', '10', '2'),
(10, 10, '', '10', '17'),
(11, 11, '', '10', '18'),
(12, 12, '', '10', '19'),
(13, 13, '', '10', '8'),
(14, 14, '', '10', '4'),
(15, 15, '', '10', '21'),
(16, 16, '', '10', '22'),
(17, 17, '', '10', '23'),
(18, 18, '', '10', '24'),
(19, 19, '', '10', '5'),
(20, 20, '', '10', '25'),
(21, 21, '', '10', '26'),
(22, 22, '', '10', '7'),
(23, 23, '', '10', '27'),
(24, 24, '', '10', '6'),
(25, 25, '', '10', '9'),
(26, 26, '', '10', '29'),
(27, 27, '', '12', '30'),
(28, 28, '', '12', '31'),
(29, 29, '', '12', '32'),
(30, 30, '', '12', '33'),
(31, 31, '', '12', '34'),
(32, 32, '', '12', '35'),
(33, 33, '', '12', '36'),
(34, 34, '', '12', '37'),
(35, 35, '', '12', '38'),
(36, 36, '', '12', '39'),
(37, 37, '', '12', '40'),
(38, 38, '', '12', '41,50'),
(39, 39, '', '12', '42'),
(40, 40, '', '12', '43'),
(41, 41, '', '12', '44'),
(42, 42, '', '12', '45'),
(43, 43, '', '12', '46'),
(44, 44, '', '12', '47'),
(45, 45, '', '12', '49'),
(46, 46, '', '13', '51'),
(47, 47, '', '10', '52'),
(48, 48, '', '10', '53'),
(49, 49, '', '10', '54'),
(50, 50, '', '10', '55'),
(51, 51, '', '10', '57'),
(52, 52, '', '10', '56'),
(53, 53, '', '10', '58'),
(54, 54, '', '10', '59');

-- --------------------------------------------------------

--
-- Table structure for table `fts_section`
--

CREATE TABLE IF NOT EXISTS `fts_section` (
  `sec_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(255) NOT NULL,
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `fts_section`
--

INSERT INTO `fts_section` (`sec_id`, `sec_name`) VALUES
(1, 'Cyber Crime '),
(2, 'Homicide'),
(3, 'D.R.BT'),
(4, 'M.T.S'),
(5, 'S.O.G'),
(6, 'R.O.'),
(7, 'R.I'),
(8, 'M.T Sec'),
(9, 'ATS'),
(10, 'A.H.T.U'),
(11, 'POWC'),
(12, 'B.D.D.S'),
(13, 'C & F'),
(14, 'C.I. Sec'),
(15, 'C.I.W'),
(16, 'Computer Section'),
(17, 'Rly.& Hgy.'),
(18, 'E.O.W'),
(19, 'Law Cell'),
(20, 'M.P.B'),
(21, 'M.Unit'),
(22, 'Narcotic'),
(23, 'SCU'),
(24, 'Photo Sec.'),
(25, 'QDEB'),
(26, 'FPB'),
(27, 'CID CR'),
(29, 'Bankura DD'),
(30, 'Barasat DD'),
(31, 'Barrackpur DD'),
(32, 'Birbhum DD'),
(33, 'Burdwan DD'),
(34, 'Coochbehar DD'),
(35, 'Darjeeling DD'),
(36, 'Durgapur / Asansol DD'),
(37, 'Diamond Harbour DD'),
(38, 'Hooghly DD'),
(39, 'Howrah DD'),
(40, 'Jalpaiguri DD'),
(41, 'Malda DD'),
(42, 'Murshidabad DD'),
(43, 'Nadia DD'),
(44, 'North Dinajpur DD'),
(45, 'Purulia DD'),
(46, 'Purba MDP DD'),
(47, 'Paschim MDP DD'),
(48, 'Salt Lake DD'),
(49, 'Sadar DD (Alipore)'),
(50, 'South Dinajpur DD'),
(51, 'Police Office'),
(52, 'Lock UP'),
(53, 'P.A. to A.D.G. CID'),
(54, 'Tele-Comm'),
(55, 'Control Room'),
(56, 'Armourary Sec'),
(57, 'Library Sec'),
(58, 'O.S. Police Office'),
(59, 'Data Base Sec');

-- --------------------------------------------------------

--
-- Table structure for table `fts_subject`
--

CREATE TABLE IF NOT EXISTS `fts_subject` (
  `subject_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `fts_subject`
--

INSERT INTO `fts_subject` (`subject_id`, `subject_name`) VALUES
(1, 'Allotment of Fund'),
(2, 'Ammunition'),
(3, 'Arms'),
(4, 'Assembly Questions'),
(5, 'Audit'),
(6, 'Advertisement');

-- --------------------------------------------------------

--
-- Table structure for table `fts_user`
--

CREATE TABLE IF NOT EXISTS `fts_user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gpf_id` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `user_type` varchar(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `is_active` enum('Y','N') NOT NULL,
  `is_deleted` enum('N','Y') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `fts_user`
--

INSERT INTO `fts_user` (`user_id`, `gpf_id`, `name`, `gender`, `user_name`, `phone`, `email`, `password`, `last_login`, `user_type`, `reg_date`, `is_active`, `is_deleted`) VALUES
(1, '', 'SARBARI BHATTACHARJEE', 'F', 'sarbari', '9836250868', 'sarbari@gmail.com', '440434ebadbfbb311aad991d3d0f48dc', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:03:56', 'Y', 'N'),
(2, '', 'KAKALI GHOSH KUNDU', 'F', 'kakali', '9830501201', 'kakali@gmail.com', 'c9db8225de88c92c3d0e85527082a7d7', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:05:37', 'Y', 'N'),
(3, '', 'SAMBHU NATH DAS', 'M', 'sambhu', '8697985191', 'sambhu@gmail.com', 'c618511b8d8da2bb0f60638bba569cd5', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:07:31', 'Y', 'N'),
(4, '', 'ARINDRAJIT SAHA', 'M', 'arindrajit', '9432070393', 'arindrajit@gmail.com', 'ea9bcf4d694aea7054e27603521392a2', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:09:16', 'Y', 'N'),
(5, '', 'APARNA SARKAR', 'M', 'aparna', '9433187409', 'aparna@gmail.com', '46aab74d298e13f19d28aa38dda7277f', '2017-01-12 01:35:58', 'normal_user', '2017-01-11 23:11:03', 'Y', 'N'),
(6, '', 'MAHARSHI PATTRE', 'M', 'maharshi', '9331159489', 'mahershi@gmail.com', 'dd942dcaceb40438a09b809d3101ece4', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:44:27', 'Y', 'N'),
(7, '', 'RAJARSHI BANERJEE', 'M', 'rajarshi', '9836769722', 'rajarshi@gmail.com', '49249158d7c1f79ebe942bd24e7ae926', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:46:43', 'Y', 'N'),
(8, '', 'BIJOY YADAB', 'M', 'bijoy', '9475433955', 'bijoy@gmail.com', '605ab26297d84bf9ff5344870dd8a85a', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:48:24', 'Y', 'N'),
(9, '', 'PALLAB KUMAR GANGULY', 'M', 'pallab', '9051515997', 'pallab@gmail.com', 'd5e323ab460b1453ead64258b2db5456', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:49:53', 'Y', 'N'),
(10, '', 'DRUBAJYOTI BANDOPADHYAY', 'M', 'drubajyoti', '9836114449', 'drubajyoti@gmail.com', '7efa8695aee1cfbe3f1c37d3fe53ea26', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:52:05', 'Y', 'N'),
(11, '', 'TIRTHANKAR SYANAL', 'M', 'tirthankar', '9830609052', 't@gmail.com', '6145ff69aa2c9dfc9a493125dae37da2', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:54:07', 'Y', 'N'),
(12, '', 'ASOKE CHAKRABORTY', 'M', 'asoke', '9433133442', 'a@gmail.com', '4a7e6cd940b871bae52d7b592f09c686', '0000-00-00 00:00:00', 'normal_user', '2017-01-11 23:55:47', 'Y', 'N'),
(13, '', 'AMITAVA CHANDA', 'M', 'amitava', '9836064334', 'ami@gmail.com', '095d611f2ced24942461da530e62b07d', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:04:36', 'Y', 'N'),
(14, '', 'MANAS ROYCHOWDHURI', 'M', 'manas', '9432126319', 'ma@gmail.com', '5d45c58ea1ef37f17c2f885219215426', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:06:09', 'Y', 'N'),
(15, '', 'ASHIM KUMAR NAG', 'M', 'ashim', '8145201051', 'ashim@gmail.com', '1babd634c07d6ac0d35ecfe06e5cc1a6', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:07:45', 'Y', 'N'),
(16, '', 'KRISHNENDU GHOSH', 'M', 'krishnendu', '9836943332', 'krish@gmail.com', '71d802c9fdfb1f8d6a4f47db73d79742', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:10:50', 'Y', 'N'),
(17, '', 'SOMENDRA NATH SUR', 'M', 'somendra', '9874221904', 'som@gmail.com', '1a8273e7476ae3d923b6663552c8e000', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:12:29', 'Y', 'N'),
(18, '', 'GOPAL NATH', 'M', 'gopal', '9874752175', 'gopal@gmail.com', 'e123edb488db303fde7b3ad19134361d', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:13:41', 'Y', 'N'),
(19, '', 'SOUGATA GHOSH', 'M', 'sougata', '9434123560', 'sou@gmail.com', 'c24dbe383c82b93997d244fc9ead3f10', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:15:00', 'Y', 'N'),
(20, '', 'UJJALENDRA MUKHOPADHAYA', 'M', 'ujjalendra', '9874760788', 'ujjal@gmail.com', 'c16eec645aca0253e1f1f8851fd9e6cb', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:16:59', 'Y', 'N'),
(21, '', 'DEBASIS GHOSH', 'M', 'debasis', '9051096664', 'deba@gmail.com', 'd813946bc12f2e3a8d87192582fd78e6', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:18:44', 'Y', 'N'),
(22, '', 'AVIJIT BISWAS', 'M', 'avijit', '9831110707', 'avijit@gmail.com', '028d296f6c0bab381e401515be8eb9e4', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:20:20', 'Y', 'N'),
(23, '', 'SUNIL THAPA', 'M', 'sunil', '9434187286', 'sunil@gmail.com', 'b0b86080c976aa7651bffe0801644d74', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:21:41', 'Y', 'N'),
(24, '', 'GOUTAM DAS', 'M', 'goutam', '9051025729', 'goutam@gmail.com', '67b47334b0acbe725e3a15ddca14f7a9', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:23:23', 'Y', 'N'),
(25, '', 'SUDIP KUMAR DUTTA', 'M', 'sudip', '9830024251', 'sudip@gmail.com', '550bbf0991fd493d1afaa2bdd246af6a', '2017-01-12 02:08:32', 'normal_user', '2017-01-12 00:24:36', 'Y', 'N'),
(26, '', 'MANIK LAL KARFA', 'M', 'manik', '9474184351', 'manik@gmail.com', 'e2e735edee93b141f8db7d861af5ba90', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:34:38', 'Y', 'N'),
(27, '', 'MD. SALIM', 'M', 'salim', '9830326430', 'salim@gmail.com', 'ca6b147b8fbdd688d8ebcaa3b803c22a', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:41:42', 'Y', 'N'),
(28, '', 'SIMUL SARKAR', 'M', 'simul', '9434142177', 'simul@gmail.com', 'b43ff3bdf49a21cf04ffb82df19ffc4a', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:46:11', 'Y', 'N'),
(29, '', 'PRASANTA NANDI', 'M', 'prasanta', '9474632211', 'prasanta@gmail.com', '29fe2f755ccc23b62f1702dbc644eed4', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:47:42', 'Y', 'N'),
(30, '', 'BICHITRA BIKASH ROY', 'M', 'bichitra', '9734909204', 'bichitra@gmail.com', '7beb92acb62f43d617bc39baa96d86a6', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:49:10', 'Y', 'N'),
(31, '', 'ASHIS MAITRA', 'M', 'ashis', '9434174255', 'ashis@gmail.com', '7945ff32978d89dc5ecdc23a44251700', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:50:35', 'Y', 'N'),
(32, '', 'PRASANNA RAI', 'M', 'prasanna', '9474963305', 'prasanna@gmail.com', 'adf825e70a5bd444872f83e35086a851', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:52:16', 'Y', 'N'),
(33, '', 'SHRI SHYAMAL KANTI DAS', 'M', 'shyamal', '9933455548', 'shyamal@gmail.com', '0c7d73764986d70ae7af208f6ef0509f', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:53:41', 'Y', 'N'),
(34, '', 'ATIBUR RAHAMAN', 'M', 'atibur', '9830092544', 'ati@gmail.com', '1e6a6f243a568787bc8327d7aefeba2f', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:54:50', 'Y', 'N'),
(35, '', 'LAXMI NARAYAN DEY', 'M', 'narayan', '9475051107', 'narayan@gmail.com', '762a8f47e2a15a321a3f0472c6d1cb6d', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:56:33', 'Y', 'N'),
(36, '', 'SUBHAS JANA', 'M', 'subhas', '9836348897', 'subhas@gmail.com', '57ee47677feccae1c67291c373d5fb9a', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:57:39', 'Y', 'N'),
(37, '', 'SURAJ THAKURI', 'M', 'suraj', '7586989677', 'suraj@gmail.com', '4dd49f4f84e4d6945e3bc6d14812004e', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 00:58:51', 'Y', 'N'),
(38, '', 'RAJU SYLVESTER CHETTRI', 'M', 'raju', '9434449616', 'raju@gmail.com', '03c017f682085142f3b60f56673e22dc', '2017-01-12 01:39:46', 'normal_user', '2017-01-12 01:00:28', 'Y', 'N'),
(39, '', 'SUDIPTA BANERJEE', 'M', 'sudipta', '9830176188', 'sudipta@gmail.com', '82482e6d4b367c8bacb569dbaab76cab', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:01:44', 'Y', 'N'),
(40, '', 'BIBEK JYOTI MAJUMDER', 'M', 'bibek', '9733612129', 'bibek@gmail.com', 'b52100c453228b8eadd4a3642fc412f0', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:03:01', 'Y', 'N'),
(41, '', 'RAKESH GURUNG', 'M', 'rakesh', '9564245446', 'rakesh@gmail.com', '67a05e3822ce48a6386746388e6c81f5', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:04:21', 'Y', 'N'),
(42, '', 'SUJIT KUMAR PATI', 'M', 'sujit', '8001010666', 'sujit@gmail.com', 'e68adc58f2062f58802e4cdcfec0af2d', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:05:27', 'Y', 'N'),
(43, '', 'SHRI SUDIP BANEHJEE', 'M', 'shrisudip', '9434990948', 'sudipbnr@gmail.com', '6ccdfab3beb2309b4720ca70dee25b10', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:08:32', 'Y', 'N'),
(44, '', 'DEBASIS PAHARI', 'M', 'debasispahari', '8436697270', 'debasis@gmail.com', 'e76c5118aafa321faf85e4e1a79e5f14', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:10:50', 'Y', 'N'),
(45, '', 'SATYABRATA DUTTA', 'M', 'satyabrata', '9434021717', 'satyabrata@gmail.com', '9cd6fdd682973ba6f3b506ad0cef469e', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:14:01', 'Y', 'N'),
(46, '', 'ADMIN', 'M', 'admin', '1234567890', 'admin@gmail.com', 'ee10c315eba2c75b403ea99136f5b48d', '2017-01-12 02:07:19', 'admin', '2017-01-12 01:26:42', 'Y', 'N'),
(47, '', 'OC LOCKUP', 'M', 'oclockup', '1234567890', 'lock@gmail.com', '8885d4bc39a0b84533798bd714451a4b', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:55:37', 'Y', 'N'),
(48, '', 'OC PA ADG', 'M', 'pa', '2123456789', 'pa@gmail.com', 'e529a9cea4a728eb9c5828b13b22844c', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:56:52', 'Y', 'N'),
(49, '', 'OC TELECOM', 'M', 'telecom', '3212345678', 'telecom@gmail.com', '29e7396b6b7e8b8ab20daabcde1c7732', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:57:53', 'Y', 'N'),
(50, '', 'OC CONTROL', 'M', 'control', '4212345678', 'control@gmail.com', 'fc5364bf9dbfa34954526becad136d4b', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 01:59:04', 'Y', 'N'),
(51, '', 'OC LIBRARY', 'M', 'library', '5432123456', 'lib@gmail.com', 'd521f765a49c72507257a2620612ee96', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 02:00:09', 'Y', 'N'),
(52, '', 'OC ARMOURARY', 'M', 'armourary', '6543123456', 'armourary@gmail.com', '25cc679b418a0f960875ba65b8021caf', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 02:01:30', 'Y', 'N'),
(53, '', 'OS POLICE', 'M', 'ospolice', '7654321234', 'os@gmail.com', '833469d82f4b29edf0e5df3962cff141', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 02:02:51', 'Y', 'N'),
(54, '', 'TAPAN', 'M', 'tapan', '9876543210', 'tapan@gmail.com', '40909d4fa936ef6397fb8f6439cb7555', '0000-00-00 00:00:00', 'normal_user', '2017-01-12 02:03:46', 'Y', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL,
  `txt` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
