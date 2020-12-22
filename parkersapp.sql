-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 10:09 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkersapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pk_categories`
--

CREATE TABLE `pk_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_company`
--

CREATE TABLE `pk_company` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `company_logo` varchar(255) NOT NULL,
  `company_balance` varchar(255) NOT NULL DEFAULT '0',
  `status` varchar(15) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_expenses`
--

CREATE TABLE `pk_expenses` (
  `id` int(3) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `description` varchar(225) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `expense_amount` decimal(10,0) DEFAULT NULL,
  `balance` decimal(10,0) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_income`
--

CREATE TABLE `pk_income` (
  `id` int(3) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `income_amount` decimal(10,0) DEFAULT NULL,
  `balance` decimal(10,0) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_locals`
--

CREATE TABLE `pk_locals` (
  `local_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `local_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_payroll`
--

CREATE TABLE `pk_payroll` (
  `id` int(11) NOT NULL,
  `staff_id` int(5) NOT NULL,
  `basic` varchar(255) NOT NULL,
  `deduction` varchar(255) NOT NULL,
  `tax` varchar(255) NOT NULL,
  `month` int(4) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(5) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_roles`
--

CREATE TABLE `pk_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_states`
--

CREATE TABLE `pk_states` (
  `state_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pk_users`
--

CREATE TABLE `pk_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `salary` decimal(10,0) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `position` varchar(255) NOT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pk_categories`
--
ALTER TABLE `pk_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `pk_company`
--
ALTER TABLE `pk_company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `pk_expenses`
--
ALTER TABLE `pk_expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `fk1` (`created_by`),
  ADD KEY `fk2` (`updated_by`),
  ADD KEY `fk3` (`deleted_by`);

--
-- Indexes for table `pk_income`
--
ALTER TABLE `pk_income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `deleted_by` (`deleted_by`);

--
-- Indexes for table `pk_locals`
--
ALTER TABLE `pk_locals`
  ADD PRIMARY KEY (`local_id`);

--
-- Indexes for table `pk_payroll`
--
ALTER TABLE `pk_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pk_states`
--
ALTER TABLE `pk_states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `pk_users`
--
ALTER TABLE `pk_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pk_categories`
--
ALTER TABLE `pk_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_company`
--
ALTER TABLE `pk_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_expenses`
--
ALTER TABLE `pk_expenses`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_income`
--
ALTER TABLE `pk_income`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_locals`
--
ALTER TABLE `pk_locals`
  MODIFY `local_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_payroll`
--
ALTER TABLE `pk_payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_states`
--
ALTER TABLE `pk_states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pk_users`
--
ALTER TABLE `pk_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pk_categories`
--
ALTER TABLE `pk_categories`
  ADD CONSTRAINT `pk_categories_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_categories_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`);

--
-- Constraints for table `pk_company`
--
ALTER TABLE `pk_company`
  ADD CONSTRAINT `pk_company_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_company_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`);

--
-- Constraints for table `pk_expenses`
--
ALTER TABLE `pk_expenses`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `fk2` FOREIGN KEY (`updated_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `fk3` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_expenses_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `pk_company` (`id`);

--
-- Constraints for table `pk_income`
--
ALTER TABLE `pk_income`
  ADD CONSTRAINT `pk_income_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `pk_company` (`id`),
  ADD CONSTRAINT `pk_income_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_income_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `pk_users` (`id`),
  ADD CONSTRAINT `pk_income_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `pk_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
