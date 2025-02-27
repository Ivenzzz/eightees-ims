-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 03:40 AM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `phone`, `address`, `created_at`) VALUES
(1, 'John Doe', '09123456789', '123 Rizal Street, Barangay 6, Victorias City', '2025-02-27 01:52:56'),
(2, 'Jane Smith', '09234567890', '456 Burgos Avenue, Barangay 19-A, Victorias City', '2025-02-27 01:52:56'),
(3, 'Alice Johnson', '09345678901', '789 Osmeña Street, Barangay 7, Victorias City', '2025-02-27 01:52:56'),
(4, 'Bob Brown', '09456789012', '159 Mabini Street, Barangay 1 Poblacion, E.B. Magalona', '2025-02-27 01:52:56'),
(5, 'Charlie White', '09567890123', '753 Lopez Jaena Street, Barangay Alicante, E.B. Magalona', '2025-02-27 01:52:56'),
(6, 'David Black', '09678901234', '852 Bonifacio Street, Barangay Consing, E.B. Magalona', '2025-02-27 01:52:56'),
(7, 'Emma Green', '09789012345', '369 Rizal Street, Barangay Mambulac, Silay City', '2025-02-27 01:52:56'),
(8, 'Frank Adams', '09890123456', '951 Lacson Street, Barangay Guinhalaran, Silay City', '2025-02-27 01:52:56'),
(9, 'Grace Lee', '09901234567', '753 Zamora Street, Barangay 2, Silay City', '2025-02-27 01:52:56'),
(10, 'Henry Clark', '09012345678', '852 Araneta Street, Barangay Hawaiian, Silay City', '2025-02-27 01:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expense_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gains_losses`
--

CREATE TABLE `gains_losses` (
  `report_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `total_revenue` decimal(10,2) NOT NULL,
  `total_expense` decimal(10,2) NOT NULL,
  `net_profit` decimal(10,2) GENERATED ALWAYS AS (`total_revenue` - `total_expense`) STORED,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `category_id`, `name`, `description`, `amount`, `quantity`, `total_price`, `purchase_date`, `supplier`, `last_updated`) VALUES
(11, 1, 'Polydex', '180GSM', 3000.00, 3.00, 9000.00, '2024-02-20 02:30:00', 'ABC Textiles', '2025-02-27 02:36:01'),
(12, 1, 'Polydex', '140GSM', 4500.00, 5.00, 22500.00, '2024-02-18 06:45:00', 'XYZ Clothing', '2025-02-27 02:35:48'),
(13, 2, 'Vinyl Heat Transfer', 'High-quality vinyl for heat transfer', 200.00, 20.00, 4000.00, '2024-02-15 01:20:00', 'PrintTech Supplies', '2025-02-27 02:32:14'),
(14, 2, 'Screen Printing Ink', '500ML', 500.00, 10.00, 5000.00, '2024-02-12 04:00:00', 'InkWorld Ltd.', '2025-02-27 02:32:14'),
(15, 3, 'Heat Press Machine', 'Digital heat press machine for t-shirts', 15000.00, 2.00, 30000.00, '2024-02-10 00:15:00', 'Machinery Hub', '2025-02-27 02:32:14'),
(16, 3, 'Sublimation Paper', 'High-quality sublimation transfer paper', 250.00, 15.00, 3750.00, '2024-02-08 08:30:00', 'PrintSupply Co.', '2025-02-27 02:32:14'),
(17, 4, 'Tarpaulin Roll', 'Large-format tarpaulin for printing', 5000.00, 5.00, 25000.00, '2024-02-05 02:00:00', 'BigPrint Materials', '2025-02-27 02:32:14'),
(18, 4, 'Banner Stands', 'Adjustable stands for banners', 1200.00, 4.00, 4800.00, '2024-02-02 03:50:00', 'Display Solutions', '2025-02-27 02:32:14'),
(19, 5, 'Fabric Ink', 'Premium ink for fabric printing', 750.00, 6.00, 4500.00, '2024-01-30 06:10:00', 'ColorTech Inc.', '2025-02-27 02:32:14'),
(20, 5, 'Embroidery Thread', 'Assorted colors of embroidery threads', 100.00, 100.00, 10000.00, '2024-01-28 01:00:00', 'ThreadMaster', '2025-02-27 02:32:14');

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
(6, 'Adhesives'),
(1, 'Fabric'),
(5, 'Heat Transfer Paper'),
(2, 'Ink'),
(7, 'Packaging Materials'),
(8, 'Printing Accessories'),
(3, 'Threads'),
(4, 'Vinyl');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `size` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `total_revenue` decimal(10,2) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `fk_expenses_categoryId` (`category_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `gains_losses`
--
ALTER TABLE `gains_losses`
  ADD PRIMARY KEY (`report_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_customersId` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`);

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gains_losses`
--
ALTER TABLE `gains_losses`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `material_categories`
--
ALTER TABLE `material_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `fk_expenses_categoryId` FOREIGN KEY (`category_id`) REFERENCES `expense_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `fk_materials_categoryId` FOREIGN KEY (`category_id`) REFERENCES `material_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customersId` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
