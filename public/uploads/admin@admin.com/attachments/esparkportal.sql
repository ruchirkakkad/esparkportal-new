-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2015 at 02:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `esparkportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `general_modules`
--

CREATE TABLE IF NOT EXISTS `general_modules` (
  `general_module_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `general_module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `general_module_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`general_module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marketing_categories`
--

CREATE TABLE IF NOT EXISTS `marketing_categories` (
  `marketing_categories_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_categories_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`marketing_categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `marketing_categories`
--

INSERT INTO `marketing_categories` (`marketing_categories_id`, `marketing_categories_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Designing', '2015-04-08 08:32:48', '2015-04-08 08:32:48', NULL),
(4, 'sdfsad', '2015-04-08 05:44:04', '2015-04-08 07:39:17', '2015-04-08 07:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_countries`
--

CREATE TABLE IF NOT EXISTS `marketing_countries` (
  `marketing_countries_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_countries_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`marketing_countries_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `marketing_countries`
--

INSERT INTO `marketing_countries` (`marketing_countries_id`, `marketing_countries_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'India', '2015-04-07 01:45:25', '2015-04-07 03:43:06', NULL),
(2, 'USA', '2015-04-07 01:46:32', '2015-04-07 01:46:32', NULL),
(3, 'Canada', '2015-04-07 01:50:43', '2015-04-07 01:50:43', NULL),
(7, 'sadf', '2015-04-07 03:11:37', '2015-04-07 03:47:38', '2015-04-07 03:47:38'),
(8, 'Demo', '2015-04-07 03:18:36', '2015-04-07 03:18:39', '2015-04-07 03:18:39'),
(9, 'Canada1', '2015-04-07 03:40:54', '2015-04-07 03:41:00', '2015-04-07 03:41:00'),
(10, 'India1', '2015-04-07 03:41:08', '2015-04-07 03:41:15', '2015-04-07 03:41:15'),
(11, 'Pakistan12', '2015-04-07 03:45:41', '2015-04-07 03:46:02', '2015-04-07 03:46:02'),
(12, 'China', '2015-04-07 07:42:14', '2015-04-07 07:46:38', '2015-04-07 07:46:38'),
(14, 'asdfa2q', '2015-04-08 03:11:23', '2015-04-08 03:11:41', '2015-04-08 03:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `marketing_states`
--

CREATE TABLE IF NOT EXISTS `marketing_states` (
  `marketing_states_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `marketing_states_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marketing_countries_id` int(11) NOT NULL,
  `timezones_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`marketing_states_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `marketing_states`
--

INSERT INTO `marketing_states` (`marketing_states_id`, `marketing_states_name`, `marketing_countries_id`, `timezones_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Gujarat', 1, 1, '2015-04-07 06:11:30', '2015-04-07 06:11:30', NULL),
(2, 'Maharashtra', 1, 2, '2015-04-07 06:49:32', '2015-04-07 07:08:52', NULL),
(3, 'asdsadf', 2, 1, '2015-04-08 03:12:25', '2015-04-08 03:12:40', '2015-04-08 03:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_04_02_125849_create_modules_table', 2),
('2015_04_03_050310_create_general_modules_table', 2),
('2015_04_07_043758_create_marketing_countries_table', 3),
('2015_04_07_092146_create_timezones_table', 4),
('2015_04_07_104214_create_marketing_states_table', 5),
('2015_04_08_051222_create_marketing_categories_table', 6),
('2015_04_08_092914_create_sheets_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `module_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_inmenu` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`, `parent_id`, `module_url`, `is_active`, `is_inmenu`, `created_at`, `updated_at`) VALUES
(1, 'Organization', 0, '#', 1, 1, '2015-04-03 03:42:14', '2015-04-03 03:42:14'),
(2, 'HRMS', 0, '#', 1, 1, '2015-04-03 03:52:31', '2015-04-03 03:52:31'),
(3, 'Recruitment', 0, '#', 1, 1, '2015-04-03 04:13:38', '2015-04-03 04:13:38'),
(4, 'Marketing', 0, '#', 1, 1, '2015-04-03 04:23:04', '2015-04-03 04:23:04'),
(5, 'PMS', 0, '#', 1, 1, '2015-04-03 05:00:24', '2015-04-03 05:00:24'),
(6, 'Support', 0, '#', 1, 1, '2015-04-03 05:04:06', '2015-04-03 05:04:06'),
(7, 'company details', 1, '#', 1, 1, '2015-04-03 05:50:37', '2015-04-03 05:50:37'),
(9, 'Add Job Vacancy', 3, '#', 1, 1, '2015-04-03 06:02:01', '2015-04-03 06:02:01'),
(10, 'Department Management', 1, '#', 1, 1, '2015-04-03 06:17:34', '2015-04-03 06:17:34'),
(11, 'Branch Management', 1, '#', 1, 1, '2015-04-03 06:17:45', '2015-04-03 06:17:45'),
(12, 'General Settings', 1, '', 1, 1, '2015-04-03 06:18:04', '2015-04-03 06:18:04'),
(13, 'Work Shifts', 1, '', 1, 1, '2015-04-03 06:18:25', '2015-04-03 06:18:25'),
(14, 'Policy Management', 1, '', 1, 1, '2015-04-03 06:18:30', '2015-04-03 06:18:30'),
(15, 'Roles Management', 1, '', 1, 1, '2015-04-03 06:19:02', '2015-04-03 06:19:02'),
(16, 'Time Tracker', 2, '#', 1, 1, '2015-04-03 05:52:43', '2015-04-03 05:52:43'),
(17, 'Time log', 16, '', 1, 1, '2015-04-03 06:19:57', '2015-04-03 06:19:57'),
(18, 'Time-sheet', 16, '', 1, 1, '2015-04-03 06:20:06', '2015-04-03 06:20:06'),
(19, 'User wise Time-sheet', 16, '', 1, 1, '2015-04-03 06:20:16', '2015-04-03 06:20:16'),
(20, 'Date wise Time-sheet', 16, '', 1, 1, '2015-04-03 06:20:27', '2015-04-03 06:20:27'),
(21, 'Attendance Chart', 16, '', 1, 1, '2015-04-03 06:20:34', '2015-04-03 06:20:34'),
(22, 'Employee Management', 2, '', 1, 1, '2015-04-03 06:20:45', '2015-04-03 06:20:45'),
(23, 'View User', 22, '', 1, 1, '2015-04-03 06:21:02', '2015-04-03 06:21:02'),
(24, 'Add User', 22, '', 1, 1, '2015-04-03 06:21:09', '2015-04-03 06:21:09'),
(25, 'Qualification', 2, '', 1, 1, '2015-04-03 06:21:23', '2015-04-03 06:21:23'),
(26, 'Skills', 25, '', 1, 1, '2015-04-03 06:21:33', '2015-04-03 06:21:33'),
(27, 'Education', 25, '', 1, 1, '2015-04-03 06:21:40', '2015-04-03 06:21:40'),
(28, 'Leave Management', 2, '', 1, 1, '2015-04-03 06:21:49', '2015-04-03 06:21:49'),
(29, 'View Leave', 28, '', 1, 1, '2015-04-03 06:21:59', '2015-04-03 06:21:59'),
(30, 'Leave Request', 28, '', 1, 1, '2015-04-03 06:22:12', '2015-04-03 06:22:12'),
(31, 'Leave Report', 28, '', 1, 1, '2015-04-03 06:22:18', '2015-04-03 06:22:18'),
(32, 'Payroll', 2, '', 1, 1, '2015-04-03 06:22:26', '2015-04-03 06:22:26'),
(33, 'View Salary', 32, '', 1, 1, '2015-04-03 06:22:34', '2015-04-03 06:22:34'),
(34, 'Add Salary', 32, '', 1, 1, '2015-04-03 06:22:40', '2015-04-03 06:22:40'),
(35, 'Salary Slip', 32, '', 1, 1, '2015-04-03 06:22:47', '2015-04-03 06:22:47'),
(36, 'Salary Slip Generation', 32, '', 1, 1, '2015-04-03 06:22:52', '2015-04-03 06:22:52'),
(37, 'Salary Report', 32, '', 1, 1, '2015-04-03 06:23:00', '2015-04-03 06:23:00'),
(38, 'Designation Management', 2, '', 1, 1, '2015-04-03 06:23:08', '2015-04-03 06:23:08'),
(39, 'Expense Management', 2, '', 1, 1, '2015-04-03 06:23:22', '2015-04-03 06:23:22'),
(40, 'Holiday Management', 2, '', 1, 1, '2015-04-03 06:23:38', '2015-04-03 06:23:38'),
(41, 'View Holiday', 40, '', 1, 1, '2015-04-03 06:23:49', '2015-04-03 06:23:49'),
(42, 'Add Holiday', 40, '', 1, 1, '2015-04-03 06:24:03', '2015-04-03 06:24:03'),
(43, 'General Announcement', 2, '', 1, 1, '2015-04-03 06:24:13', '2015-04-03 06:24:13'),
(44, 'Add Candidate', 3, '', 1, 1, '2015-04-03 06:24:28', '2015-04-03 06:24:28'),
(45, 'View Candidate', 3, '', 1, 1, '2015-04-03 06:24:35', '2015-04-03 06:24:35'),
(46, 'Recruitment Process', 3, '', 1, 1, '2015-04-03 06:24:43', '2015-04-03 06:24:43'),
(47, 'Sheet Management', 4, '', 1, 1, '2015-04-03 06:25:09', '2015-04-06 07:29:20'),
(48, 'Leads', 4, '', 1, 1, '2015-04-03 06:25:15', '2015-04-03 06:25:15'),
(49, 'Leads Status Management', 4, '', 1, 1, '2015-04-03 06:25:24', '2015-04-03 06:25:24'),
(50, 'Follow Up', 4, '', 1, 1, '2015-04-03 06:25:57', '2015-04-03 06:25:57'),
(51, 'Other Leads', 4, '', 1, 1, '2015-04-03 06:26:03', '2015-04-03 06:26:03'),
(52, 'Add Other Lead', 51, '', 1, 1, '2015-04-03 06:26:11', '2015-04-03 06:26:11'),
(53, 'View Other Lead', 51, '', 1, 1, '2015-04-03 06:26:18', '2015-04-03 06:26:18'),
(54, 'Follow Up Other Lead', 51, '', 1, 1, '2015-04-03 06:26:24', '2015-04-03 06:26:24'),
(55, 'Country Management', 4, '', 1, 1, '2015-04-03 06:26:31', '2015-04-03 06:26:31'),
(56, 'Country', 55, '#/app/marketing_countries/index', 1, 1, '2015-04-03 06:26:38', '2015-04-06 23:19:17'),
(57, 'State', 55, '/#/app/marketing_states/index', 1, 1, '2015-04-03 06:26:52', '2015-04-07 05:27:13'),
(58, 'Time Zone', 55, '#/app/timezones/index', 1, 1, '2015-04-03 06:26:59', '2015-04-07 04:16:09'),
(59, 'Category Management', 4, '#/app/marketing_categories/index', 1, 1, '2015-04-03 06:28:01', '2015-04-08 00:18:49'),
(62, 'Sheet Assignment', 4, '', 1, 1, '2015-04-03 06:28:31', '2015-04-03 06:28:31'),
(63, 'Email Marketing', 4, '', 1, 1, '2015-04-03 06:28:47', '2015-04-03 06:28:47'),
(64, 'Group Management', 63, '', 1, 1, '2015-04-03 06:29:14', '2015-04-03 06:29:14'),
(65, 'Category', 63, '', 1, 1, '2015-04-03 06:29:26', '2015-04-03 06:29:26'),
(66, 'Upload Data Sheet', 63, '', 1, 1, '2015-04-03 06:29:33', '2015-04-03 06:29:33'),
(67, 'View Data Sheet', 63, '', 1, 1, '2015-04-03 06:29:45', '2015-04-03 06:29:45'),
(68, 'PMS', 5, '#', 1, 1, '2015-04-03 06:30:09', '2015-04-03 06:30:09'),
(69, 'Support', 6, '#', 1, 1, '2015-04-03 06:30:42', '2015-04-03 06:30:42'),
(70, 'Modules', 0, '', 1, 1, '2015-04-03 06:32:15', '2015-04-03 06:32:15'),
(71, 'Modules', 70, '#/app/modules/index', 1, 1, '2015-04-03 06:32:24', '2015-04-03 06:32:24'),
(72, 'General Modules', 70, '', 1, 1, '2015-04-03 06:32:30', '2015-04-03 06:32:30'),
(73, 'Support 1', 6, '', 1, 1, '2015-04-03 07:58:47', '2015-04-03 07:58:47'),
(87, 'Add Sheet', 47, '#/app/sheets/create', 1, 1, '2015-04-06 07:29:40', '2015-04-08 08:50:28'),
(88, 'View Sheet', 47, '#/app/sheets/index', 1, 1, '2015-04-06 07:29:52', '2015-04-09 06:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `sheets`
--

CREATE TABLE IF NOT EXISTS `sheets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `input_date` date NOT NULL,
  `marketing_countries_id` int(10) unsigned NOT NULL,
  `marketing_categories_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sheets_marketing_countries_id_foreign` (`marketing_countries_id`),
  KEY `sheets_user_id_foreign` (`user_id`),
  KEY `sheets_marketing_categories_id_foreign` (`marketing_categories_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sheets`
--

INSERT INTO `sheets` (`id`, `input_date`, `marketing_countries_id`, `marketing_categories_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, '2015-04-15', 2, 3, 1, '2015-04-09 05:16:25', '2015-04-09 05:16:25', NULL),
(5, '2015-04-09', 1, 3, 1, '2015-04-09 06:32:08', '2015-04-09 06:32:08', NULL),
(6, '2015-04-09', 3, 3, 1, '2015-04-09 06:33:12', '2015-04-09 06:33:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE IF NOT EXISTS `timezones` (
  `timezones_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `timezones_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`timezones_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`timezones_id`, `timezones_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'UTC−11:00', '2015-04-07 04:23:39', '2015-04-07 04:35:00', NULL),
(2, 'UTC−12:00', '2015-04-07 04:31:10', '2015-04-07 04:31:10', NULL),
(3, 'asd', '2015-04-07 04:35:08', '2015-04-07 04:35:10', '2015-04-07 04:35:10'),
(4, 'UTC+05:30', '2015-04-07 07:42:32', '2015-04-07 07:42:32', NULL),
(5, 'sdfasdfasdfasd', '2015-04-08 03:13:40', '2015-04-08 03:13:58', '2015-04-08 03:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text,
  `profile_pic` text,
  `date_of_birth` date DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `marital_status` varchar(9) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `anniversary_date` date DEFAULT NULL,
  `driving_license_number` varchar(255) DEFAULT NULL,
  `passport_number` varchar(255) DEFAULT NULL,
  `bio` text,
  `current_address` text,
  `current_city` varchar(255) DEFAULT NULL,
  `current_state` varchar(255) DEFAULT NULL,
  `current_zipcode` varchar(255) DEFAULT NULL,
  `personal_contact_number` varchar(255) DEFAULT NULL,
  `local_contact_number` varchar(255) DEFAULT NULL,
  `company_emailid` varchar(255) DEFAULT NULL,
  `company_skypeid` varchar(255) DEFAULT NULL,
  `permanent_address` text,
  `permanent_city` varchar(255) DEFAULT NULL,
  `permanent_state` varchar(255) DEFAULT NULL,
  `permanent_zipcode` varchar(255) DEFAULT NULL,
  `permanent_contact_number_1` varchar(255) DEFAULT NULL,
  `permanent_contact_number_2` varchar(255) DEFAULT NULL,
  `personal_emailid` varchar(255) DEFAULT NULL,
  `personal_skypeid` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_relation` varchar(255) DEFAULT NULL,
  `emergency_contact_number` varchar(255) DEFAULT NULL,
  `emergency_contact_address` text,
  `skills` text,
  `known_language` varchar(255) DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `department` enum('Marketing','Development','Design','HR') DEFAULT NULL,
  `designation` enum('Jr Developer Trainee','Jr Designer Trainee','Jr Business Development Executive Trainee','Jr Business Development Executive','Jr Developer','Jr Designer','Sr Designer','Sr Developer','Sr Business Development Executive','HR','Jr Mobile Application Developer Trainee','Jr Mobile Application Developer','Sr Mobile Application Developer','Jr Business Analyst Trainee','Jr Business Analyst','Sr Business Analyst','HR Executive','Sr HR Executive','Tester Engineer') DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_branch_name` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `login_status` int(11) DEFAULT NULL,
  `last_logout_time` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `notice_flag` tinyint(4) DEFAULT '0',
  `job_profile` varchar(255) DEFAULT NULL,
  `salt` text,
  `forgot_password_salt` text,
  `salt1` text,
  `remember_token` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `middlename`, `lastname`, `gender`, `email`, `password`, `profile_pic`, `date_of_birth`, `blood_group`, `marital_status`, `spouse_name`, `anniversary_date`, `driving_license_number`, `passport_number`, `bio`, `current_address`, `current_city`, `current_state`, `current_zipcode`, `personal_contact_number`, `local_contact_number`, `company_emailid`, `company_skypeid`, `permanent_address`, `permanent_city`, `permanent_state`, `permanent_zipcode`, `permanent_contact_number_1`, `permanent_contact_number_2`, `personal_emailid`, `personal_skypeid`, `emergency_contact_name`, `emergency_contact_relation`, `emergency_contact_number`, `emergency_contact_address`, `skills`, `known_language`, `date_of_joining`, `employee_id`, `department`, `designation`, `user_role`, `bank_name`, `bank_branch_name`, `bank_account_number`, `login_status`, `last_logout_time`, `status`, `notice_flag`, `job_profile`, `salt`, `forgot_password_salt`, `salt1`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', NULL, NULL, 'Male', 'admin@admin.com', '$2y$10$HhZObS8CYkkp1nk3kcpIOOBY2LM68zxqU95Nfc1fvnHgguKCzD1Cq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'E2ktWuaYRGSsvaEqSDiwveUf5DbcYCHEIxwS3zMRe11N0ENXZiFZYHUQMUti', NULL, '2015-04-08 03:15:17'),
(2, 'Jaimin', '', 'Faldu', NULL, 'jaimin@esparkinfo.com', '$2y$10$HhZObS8CYkkp1nk3kcpIOOBY2LM68zxqU95Nfc1fvnHgguKCzD1Cq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, '4y6PAyx5dqfz4iprfEol4Iwu3rUcY5IiJxoT93scoQDkl3iG565sPfRictkd', NULL, '2015-04-08 01:10:10');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sheets`
--
ALTER TABLE `sheets`
  ADD CONSTRAINT `sheets_marketing_categories_id_foreign` FOREIGN KEY (`marketing_categories_id`) REFERENCES `marketing_categories` (`marketing_categories_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sheets_marketing_countries_id_foreign` FOREIGN KEY (`marketing_countries_id`) REFERENCES `marketing_countries` (`marketing_countries_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sheets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
