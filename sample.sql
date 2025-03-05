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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `transaction_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;