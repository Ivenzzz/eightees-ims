-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 06:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eightees_ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','employee') NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `role`, `profile_pic`, `created_at`) VALUES
(1, 'admin', '$2y$10$kCv982BLq1TV.92yV.oL2ON8e4HExnuATk5yjwcpkjdaFKGokq9iS', 'admin', '/eightees_ims/storage/uploads/182ce976-c8f4-4e81-9b1b-568589019b44.jpg', '2025-02-24 06:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '09308309634', '123 Rizal Street, Poblacion II, E.B. Magalona', '2025-02-27 01:52:56', '2025-03-03 03:02:35'),
(2, 'Jane Smith', '09234567890', '456 Burgos Avenue, Barangay 19-A, Victorias City', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(3, 'Alice Johnson', '09345678901', '789 Osmeña Street, Barangay 7, Victorias City', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(4, 'Bob Brown', '09456789012', '159 Mabini Street, Barangay 1 Poblacion, E.B. Magalona', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(5, 'Charlie White', '09567890123', '753 Lopez Jaena Street, Barangay Alicante, E.B. Magalona', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(6, 'David Black', '09678901234', '852 Bonifacio Street, Barangay Consing, E.B. Magalona', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(7, 'Emma Green', '09789012345', '369 Rizal Street, Barangay Mambulac, Silay City', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(8, 'Frank Adams', '09890123456', '951 Lacson Street, Barangay Guinhalaran, Silay City', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(9, 'Grace Lee', '09901234567', '753 Zamora Street, Barangay 2, Silay City', '2025-02-27 01:52:56', '2025-03-03 02:57:29'),
(10, 'Henry Clark', '09012345678', '852 Araneta Street, Barangay Hawaiian, Silay City', '2025-02-27 01:52:56', '2025-03-03 02:57:29');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `salary_id` int(11) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `salary_period` varchar(7) NOT NULL,
  `present_days` int(11) NOT NULL DEFAULT 0,
  `absent_days` int(11) NOT NULL DEFAULT 0,
  `overtime_hours` int(11) NOT NULL DEFAULT 0,
  `total_salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employee_salaries`
--

INSERT INTO `employee_salaries` (`salary_id`, `employee_name`, `salary_period`, `present_days`, `absent_days`, `overtime_hours`, `total_salary`) VALUES
(1, 'Clint', '2025-03', 12, 2, 4, 4200.00),
(2, 'Brent', '2025-03', 10, 10, 1, 531.25),
(3, 'Gerome', '2025-03', 12, 0, 0, 4243.75),
(4, 'Maylene', '2025-03', 12, 0, 1, 3637.50),
(5, 'Yahyah', '2025-03', 12, 0, 1, 3637.50),
(6, 'Emil', '2025-03', 12, 0, 1, 3031.25),
(7, 'Glen', '2025-03', 12, 0, 1, 3637.50),
(8, 'Nicole', '2025-03', 12, 0, 1, 3637.50);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `amount`, `expense_date`, `description`) VALUES
(2, 15000.00, '2025-03-12 02:35:58', 'New cellphone for business use'),
(3, 5000.00, '2025-03-12 02:35:58', 'Office rent payment'),
(4, 1200.00, '2025-03-12 02:35:58', 'Electricity bill for the month'),
(6, 500.00, '2025-03-12 03:20:37', 'Rice'),
(7, 1500.00, '2025-03-12 03:22:41', 'Electric Fan');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `category_id`, `name`, `description`, `amount`, `quantity`, `total_price`, `purchase_date`, `supplier`, `created_at`, `updated_at`) VALUES
(12, 1, 'Polydex', '140GSM', 4500.00, 5.00, 22500.00, '2024-02-18 06:45:00', 'XYZ Clothing', '2025-02-27 02:35:48', '2025-02-27 07:12:49'),
(23, 1, 'Polydex', '180gsm', 3075.00, 2.00, 6150.00, '2025-02-27 03:50:57', 'Graphic Solutions Inc.', '2025-02-27 07:16:53', '2025-02-27 07:16:53'),
(24, 1, 'Polydex', '170GSM', 3250.00, 3.00, 9750.00, '2025-02-27 07:18:14', 'Graphic Solutions Inc.', '2025-02-27 07:31:23', '2025-02-27 07:31:23'),
(25, 1, 'Polydex', '170GSM', 3000.00, 4.00, 12000.00, '2025-02-27 07:32:52', 'Graphic Solutions Inc.', '2025-02-27 07:32:52', '2025-02-27 07:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `material_categories`
--

CREATE TABLE `material_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `material_categories`
--

INSERT INTO `material_categories` (`category_id`, `category_name`) VALUES
(1, 'Fabric'),
(16, 'Ink'),
(10, 'Sublimation Paper');

-- --------------------------------------------------------

--
-- Table structure for table `project_transactions`
--

CREATE TABLE `project_transactions` (
  `project_transaction_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL DEFAULT current_timestamp(),
  `customer_id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `design_file` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `downpayment` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payable` decimal(10,2) NOT NULL,
  `due_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `project_transactions`
--

INSERT INTO `project_transactions` (`project_transaction_id`, `transaction_date`, `customer_id`, `team_name`, `category_id`, `description`, `design_file`, `quantity`, `amount`, `downpayment`, `total`, `payable`, `due_date`, `start_date`, `created_at`, `updated_at`) VALUES
(37, '2025-03-02', 2, 'Team Beta', 3, 'Polo Shirts', NULL, 30, 150.00, 1500.00, 4500.00, 3000.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 02:51:47'),
(38, '2025-03-03', 3, 'Team Gamma', 1, 'Event Shirts', NULL, 100, 120.00, 2000.00, 12000.00, 10000.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 02:51:47'),
(39, '2025-03-04', 4, 'Team Delta', 2, 'Custom Jerseys', NULL, 20, 125.00, 500.00, 2500.00, 2000.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 02:51:47'),
(40, '2025-03-05', 5, 'Team Epsilon', 5, 'Tarpaulin Printing', NULL, 10, 200.00, 800.00, 2000.00, 1200.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 02:51:47'),
(41, '2025-03-06', 6, 'Team Zeta', 3, 'Custom Hoodies', NULL, 15, 250.00, 1000.00, 3750.00, 2750.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 02:51:47'),
(42, '2025-03-07', 7, 'Team Eta', 1, 'School T-Shirts', NULL, 80, 90.00, 1800.00, 7200.00, 5400.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 02:51:47'),
(43, '2025-03-08', 8, 'Team Theta', 2, 'Corporate Uniforms', '/eightees_ims/storage/uploads/design_67c7e494779888.26472383.jpg', 25, 200.00, 1200.00, 5000.00, 3800.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 05:43:48'),
(44, '2025-03-09', 9, 'Team Idlfta', 3, 'Athletic Wear', '/eightees_ims/storage/uploads/design_67c7e4e5b61266.66287043.jpg', 40, 180.00, 2500.00, 7200.00, 4700.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-05 05:45:09'),
(45, '2025-03-10', 10, 'Brgy. IV', 1, 'T-Shirts', '/eightees_ims/storage/uploads/design_67c7e63462b024.10371364.jpg', 15, 300.00, 2500.00, 4500.00, 2000.00, '2025-03-06 07:39:28', '2025-03-06 07:44:55', '2025-03-05 02:51:47', '2025-03-06 07:46:22'),
(47, '2025-03-10', 1, 'Brgy. VI', 2, 'XL - 100', NULL, 20, 400.00, 0.00, 8000.00, 8000.00, '2025-03-10 06:03:23', '2025-03-10 06:03:23', '2025-03-10 06:03:23', '2025-03-10 07:44:43'),
(49, '2025-03-10', 1, 'Brgy. V', 2, 'L - 20\r\nXS - 10\r\nS - 5', '/eightees_ims/storage/uploads/design_67ce829e499300.59845199.png', 35, 400.00, 2000.00, 14000.00, 12000.00, '2025-03-12 22:10:00', '2025-03-09 22:10:00', '2025-03-10 06:11:08', '2025-03-10 07:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_categories`
--

CREATE TABLE `transaction_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaction_categories`
--

INSERT INTO `transaction_categories` (`category_id`, `category_name`) VALUES
(1, 'T-Shirts'),
(2, 'Jersey'),
(3, 'Polo'),
(5, 'Long Pants'),
(7, 'Scarfs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `fk_materials_categoryId` (`category_id`);

--
-- Indexes for table `material_categories`
--
ALTER TABLE `material_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `project_transactions`
--
ALTER TABLE `project_transactions`
  ADD PRIMARY KEY (`project_transaction_id`),
  ADD KEY `fk_project_transaction_customer_id` (`customer_id`),
  ADD KEY `fk_project_transaction_category_id` (`category_id`);

--
-- Indexes for table `transaction_categories`
--
ALTER TABLE `transaction_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `material_categories`
--
ALTER TABLE `material_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_transactions`
--
ALTER TABLE `project_transactions`
  MODIFY `project_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `transaction_categories`
--
ALTER TABLE `transaction_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `fk_materials_categoryId` FOREIGN KEY (`category_id`) REFERENCES `material_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_transactions`
--
ALTER TABLE `project_transactions`
  ADD CONSTRAINT `fk_project_transaction_category_id` FOREIGN KEY (`category_id`) REFERENCES `transaction_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_project_transaction_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
