-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 01:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `status` enum('Present','Absent','Half Day','Leave') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `attendance_date`, `status`, `created_at`) VALUES
(1, 1, '2026-07-01', 'Present', '2026-07-04 10:39:35'),
(2, 1, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(3, 1, '2026-07-03', 'Half Day', '2026-07-04 10:39:35'),
(4, 1, '2026-07-04', 'Leave', '2026-07-04 10:39:35'),
(5, 1, '2026-07-05', 'Present', '2026-07-04 10:39:35'),
(6, 1, '2026-07-06', 'Absent', '2026-07-04 10:39:35'),
(7, 2, '2026-07-01', 'Absent', '2026-07-04 10:39:35'),
(8, 2, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(9, 2, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(10, 2, '2026-07-04', 'Leave', '2026-07-04 10:39:35'),
(11, 2, '2026-07-05', 'Half Day', '2026-07-04 10:39:35'),
(12, 2, '2026-07-06', 'Present', '2026-07-04 10:39:35'),
(13, 3, '2026-07-01', 'Present', '2026-07-04 10:39:35'),
(14, 3, '2026-07-02', 'Half Day', '2026-07-04 10:39:35'),
(15, 3, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(16, 3, '2026-07-04', 'Present', '2026-07-04 10:39:35'),
(17, 3, '2026-07-05', 'Absent', '2026-07-04 10:39:35'),
(18, 3, '2026-07-06', 'Leave', '2026-07-04 10:39:35'),
(19, 4, '2026-07-01', 'Leave', '2026-07-04 10:39:35'),
(20, 4, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(21, 4, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(22, 4, '2026-07-04', 'Absent', '2026-07-04 10:39:35'),
(23, 4, '2026-07-05', 'Present', '2026-07-04 10:39:35'),
(24, 4, '2026-07-06', 'Half Day', '2026-07-04 10:39:35'),
(25, 5, '2026-07-01', 'Present', '2026-07-04 10:39:35'),
(26, 5, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(27, 5, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(28, 5, '2026-07-04', 'Half Day', '2026-07-04 10:39:35'),
(29, 5, '2026-07-05', 'Absent', '2026-07-04 10:39:35'),
(30, 5, '2026-07-06', 'Leave', '2026-07-04 10:39:35'),
(31, 6, '2026-07-01', 'Absent', '2026-07-04 10:39:35'),
(32, 6, '2026-07-02', 'Leave', '2026-07-04 10:39:35'),
(33, 6, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(34, 6, '2026-07-04', 'Present', '2026-07-04 10:39:35'),
(35, 6, '2026-07-05', 'Half Day', '2026-07-04 10:39:35'),
(36, 6, '2026-07-06', 'Present', '2026-07-04 10:39:35'),
(37, 7, '2026-07-01', 'Present', '2026-07-04 10:39:35'),
(38, 7, '2026-07-02', 'Absent', '2026-07-04 10:39:35'),
(39, 7, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(40, 7, '2026-07-04', 'Present', '2026-07-04 10:39:35'),
(41, 7, '2026-07-05', 'Leave', '2026-07-04 10:39:35'),
(42, 7, '2026-07-06', 'Half Day', '2026-07-04 10:39:35'),
(43, 8, '2026-07-01', 'Half Day', '2026-07-04 10:39:35'),
(44, 8, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(45, 8, '2026-07-03', 'Absent', '2026-07-04 10:39:35'),
(46, 8, '2026-07-04', 'Present', '2026-07-04 10:39:35'),
(47, 8, '2026-07-05', 'Present', '2026-07-04 10:39:35'),
(48, 8, '2026-07-06', 'Leave', '2026-07-04 10:39:35'),
(49, 9, '2026-07-01', 'Present', '2026-07-04 10:39:35'),
(50, 9, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(51, 9, '2026-07-03', 'Leave', '2026-07-04 10:39:35'),
(52, 9, '2026-07-04', 'Absent', '2026-07-04 10:39:35'),
(53, 9, '2026-07-05', 'Half Day', '2026-07-04 10:39:35'),
(54, 9, '2026-07-06', 'Present', '2026-07-04 10:39:35'),
(55, 10, '2026-07-01', 'Absent', '2026-07-04 10:39:35'),
(56, 10, '2026-07-02', 'Present', '2026-07-04 10:39:35'),
(57, 10, '2026-07-03', 'Present', '2026-07-04 10:39:35'),
(58, 10, '2026-07-04', 'Present', '2026-07-04 10:39:35'),
(59, 10, '2026-07-05', 'Leave', '2026-07-04 10:39:35'),
(60, 10, '2026-07-06', 'Half Day', '2026-07-04 10:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` text DEFAULT NULL,
  `login_id` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Employee','HR') NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `salary_basic` decimal(10,2) DEFAULT 0.00,
  `salary_hra` decimal(10,2) DEFAULT 0.00,
  `salary_allowance` decimal(10,2) DEFAULT 0.00,
  `tax_percent` decimal(5,2) DEFAULT 0.00,
  `nationality` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `bank_account` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `attendance_status` varchar(20) NOT NULL DEFAULT 'Checked Out',
  `last_action_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `company_name`, `full_name`, `email`, `phone`, `address`, `login_id`, `password`, `role`, `department`, `job_title`, `manager`, `salary_basic`, `salary_hra`, `salary_allowance`, `tax_percent`, `nationality`, `dob`, `gender`, `marital_status`, `date_of_joining`, `bank_name`, `bank_account`, `ifsc_code`, `created_at`, `attendance_status`, `last_action_time`) VALUES
(1, 'hrms', 'Lipika Hait', 'LIPIKA@gmail.com', '8735674574', NULL, 'LIHA20260001', '$2y$10$FiDXgUB.0B0qNbgzujuw2O/uvY.recoF7Wuq.bO2QznRj0lLP3QZ.', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 06:50:33', 'Checked Out', NULL),
(2, 'hrms india', 'Tiyasa Hait', 'TIYASA@gmail.com', '2345678901', NULL, 'TIHA20260002', '$2y$10$acBgqqlLTFoAkYeui9wxJ.LaswYraGebqiMkY3Gcsupr8b7RpWpUa', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 06:59:30', 'Checked Out', NULL),
(3, 'hrms india', 'Tiyasa Hait', 'TIYASA123@gmail.com', '3456789643', NULL, 'TIHA20260003', '$2y$10$jGA/JDd7FkBflLNfsNvPZ.fwKeioZawBJ.mTbP78ulYyf3JgTWHHW', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 07:03:05', 'Checked Out', NULL),
(4, 'hrms india', 'Tiyasa Hait', 'TIYASA867675@gmail.com', '3447778565', NULL, 'TIHA20260004', '$2y$10$TQNt92n/yTPqskmffu0YyOWlh/QtF5SRJFurYfLKgIWXOPdwmwJdS', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 07:06:19', 'Checked Out', NULL),
(5, 'hrms india', 'Lipika Hait', 'LIPIKA765@gmail.com', '6545667869', NULL, 'HILIHA20260005', '$2y$10$PBZmRFG9edQh85XsgboQquKjcCNnY6KC3ktWSlm6PKw8YMip7OxE6', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 07:13:53', 'Checked Out', NULL),
(8, 'hrms india', 'Tiyasa Hait', 'LIPIKAjggjfj@gmail.com', '1234567657', NULL, 'HITIHA20260006', '$2y$10$SReIiq73HzWu5/pmcOggzurXYNGPjvrLNz4lED3Mta/Vg5VDd4PAS', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 07:38:26', 'Checked Out', NULL),
(9, 'hrms india', 'Tiyasa Hait', 'LIPIKAgftyr@gmail.com', '7654387654', 'kolkata', 'HITIHA20260007', 'CMhjo2', 'Employee', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 07:52:06', 'Checked Out', '2026-07-04 13:59:30'),
(10, 'JAGGU FAN', 'AYAN HAIT', 'AYAN54765@gmail.com', '6543789654', 'kolkata', 'JFAYHA20260008', 'dh8xwq', 'HR', NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-04 09:21:53', 'Checked Out', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_type` enum('Paid Leave','Sick Leave','Unpaid Leave') NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `admin_comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `employee_id`, `leave_type`, `from_date`, `to_date`, `reason`, `status`, `admin_comment`, `created_at`, `updated_at`) VALUES
(1, 1, 'Paid Leave', '2026-06-01', '2026-06-02', 'Family function', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(2, 2, 'Sick Leave', '2026-06-03', '2026-06-04', 'Fever', 'Approved', 'Get well soon', '2026-07-04 10:15:20', NULL),
(3, 3, 'Unpaid Leave', '2026-06-05', '2026-06-06', 'Personal work', 'Rejected', 'Not eligible', '2026-07-04 10:15:20', NULL),
(4, 4, 'Paid Leave', '2026-06-07', '2026-06-08', 'Wedding', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(5, 5, 'Sick Leave', '2026-06-09', '2026-06-10', 'Headache', 'Pending', NULL, '2026-07-04 10:15:20', NULL),
(6, 6, 'Paid Leave', '2026-06-11', '2026-06-12', 'Travel', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(7, 7, 'Unpaid Leave', '2026-06-13', '2026-06-14', 'Family issue', 'Rejected', 'Denied', '2026-07-04 10:15:20', NULL),
(8, 8, 'Sick Leave', '2026-06-15', '2026-06-16', 'Fever', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(9, 9, 'Paid Leave', '2026-06-17', '2026-06-18', 'Vacation', 'Pending', NULL, '2026-07-04 10:15:20', NULL),
(10, 10, 'Sick Leave', '2026-06-19', '2026-06-20', 'Cold', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(11, 1, 'Unpaid Leave', '2026-06-21', '2026-06-22', 'Personal', 'Rejected', 'Denied', '2026-07-04 10:15:20', NULL),
(12, 2, 'Paid Leave', '2026-06-23', '2026-06-24', 'Trip', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(13, 3, 'Sick Leave', '2026-06-25', '2026-06-26', 'Illness', 'Pending', NULL, '2026-07-04 10:15:20', NULL),
(14, 4, 'Paid Leave', '2026-06-27', '2026-06-28', 'Marriage', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(15, 5, 'Unpaid Leave', '2026-06-29', '2026-06-30', 'Urgent work', 'Rejected', 'Denied', '2026-07-04 10:15:20', NULL),
(16, 6, 'Sick Leave', '2026-07-01', '2026-07-02', 'Fever', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(17, 7, 'Paid Leave', '2026-07-03', '2026-07-04', 'Vacation', 'Pending', NULL, '2026-07-04 10:15:20', NULL),
(18, 8, 'Unpaid Leave', '2026-07-05', '2026-07-06', 'Personal', 'Rejected', 'Not allowed', '2026-07-04 10:15:20', NULL),
(19, 9, 'Sick Leave', '2026-07-07', '2026-07-08', 'Cold', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(20, 10, 'Paid Leave', '2026-07-09', '2026-07-10', 'Trip', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(21, 1, 'Sick Leave', '2026-07-11', '2026-07-12', 'Fever', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(22, 2, 'Unpaid Leave', '2026-07-13', '2026-07-14', 'Work issue', 'Rejected', 'Denied', '2026-07-04 10:15:20', NULL),
(23, 3, 'Paid Leave', '2026-07-15', '2026-07-16', 'Family', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(24, 4, 'Sick Leave', '2026-07-17', '2026-07-18', 'Illness', 'Pending', NULL, '2026-07-04 10:15:20', NULL),
(25, 5, 'Paid Leave', '2026-07-19', '2026-07-20', 'Travel', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(26, 6, 'Unpaid Leave', '2026-07-21', '2026-07-22', 'Personal', 'Rejected', 'Denied', '2026-07-04 10:15:20', NULL),
(27, 7, 'Sick Leave', '2026-07-23', '2026-07-24', 'Fever', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(28, 8, 'Paid Leave', '2026-07-25', '2026-07-26', 'Vacation', 'Approved', 'Approved', '2026-07-04 10:15:20', NULL),
(29, 9, 'Unpaid Leave', '2026-07-27', '2026-07-28', 'Issue', 'Rejected', 'Denied', '2026-07-04 10:15:20', NULL),
(30, 10, 'Sick Leave', '2026-07-29', '2026-07-30', 'Cold', 'Rejected', 'Approved', '2026-07-04 10:15:20', '2026-07-04 11:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `basic_salary` decimal(10,2) DEFAULT NULL,
  `housing_allowance` decimal(10,2) DEFAULT NULL,
  `transport_allowance` decimal(10,2) DEFAULT NULL,
  `performance_bonus` decimal(10,2) DEFAULT NULL,
  `leave_deduction` decimal(10,2) DEFAULT NULL,
  `tax_deduction` decimal(10,2) DEFAULT NULL,
  `working_days` int(11) DEFAULT NULL,
  `present_days` int(11) DEFAULT NULL,
  `net_salary` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `employee_id`, `month`, `year`, `basic_salary`, `housing_allowance`, `transport_allowance`, `performance_bonus`, `leave_deduction`, `tax_deduction`, `working_days`, `present_days`, `net_salary`) VALUES
(11, 1, 'June', 2026, 30000.00, 5000.00, 2000.00, 3000.00, 1000.00, 1500.00, 26, 25, 0.00),
(12, 2, 'June', 2026, 28000.00, 4000.00, 1500.00, 2000.00, 500.00, 1200.00, 26, 24, 0.00),
(13, 3, 'June', 2026, 32000.00, 6000.00, 2500.00, 3500.00, 0.00, 1800.00, 26, 26, 0.00),
(14, 4, 'June', 2026, 25000.00, 3000.00, 1000.00, 1500.00, 1000.00, 900.00, 26, 23, 0.00),
(15, 5, 'June', 2026, 27000.00, 3500.00, 1200.00, 1800.00, 700.00, 1100.00, 26, 24, 0.00),
(16, 6, 'June', 2026, 29000.00, 4500.00, 1800.00, 2200.00, 500.00, 1300.00, 26, 25, 0.00),
(17, 7, 'June', 2026, 31000.00, 5000.00, 2000.00, 3000.00, 0.00, 1600.00, 26, 26, 0.00),
(18, 8, 'June', 2026, 26000.00, 3000.00, 1000.00, 1200.00, 900.00, 1000.00, 26, 22, 0.00),
(19, 9, 'June', 2026, 29500.00, 4000.00, 1500.00, 2000.00, 800.00, 1400.00, 26, 25, 0.00),
(20, 10, 'June', 2026, 33000.00, 5500.00, 2200.00, 4000.00, 0.00, 2000.00, 26, 26, 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `login_id` (`login_id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
