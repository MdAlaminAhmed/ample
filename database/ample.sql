-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2025 at 10:15 AM
-- Server version: 10.6.23-MariaDB
-- PHP Version: 8.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belmonte_ample`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `name`, `description`, `created_by`, `update_at`, `create_at`) VALUES
(4, 'Grocery', '', 1, NULL, '2025-09-17 15:17:44'),
(5, 'Daily Essentials', '', 1, NULL, '2025-09-17 15:28:50'),
(6, 'Fruits &amp; Vegetables', '', 1, NULL, '2025-09-17 15:28:58'),
(7, 'Meat, Fish &amp; Eggs', '', 1, NULL, '2025-09-17 15:29:08'),
(8, 'Dairy &amp; Frozen Foods', '', 1, NULL, '2025-09-17 15:29:16'),
(9, 'Household', '', 1, NULL, '2025-09-17 15:29:25'),
(10, 'Personal Care', '', 1, NULL, '2025-09-17 15:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `ex_date` date NOT NULL,
  `expense_for` varchar(50) NOT NULL,
  `amount` float(15,2) NOT NULL DEFAULT 0.00,
  `expense_cat` int(10) NOT NULL,
  `ex_description` text NOT NULL,
  `added_by` int(4) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `ex_date`, `expense_for`, `amount`, `expense_cat`, `ex_description`, `added_by`, `added_date`) VALUES
(1, '2023-07-19', 'Transport', 500.00, 1, 'order delivery', 1, '2023-07-21 12:35:30');

-- --------------------------------------------------------

--
-- Table structure for table `expense_catagory`
--

CREATE TABLE `expense_catagory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `added_by` int(4) NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `expense_catagory`
--

INSERT INTO `expense_catagory` (`id`, `name`, `description`, `added_by`, `added_time`) VALUES
(1, 'Petrol', 'Petrol for transport', 1, '2023-07-21 12:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `factory_products`
--

CREATE TABLE `factory_products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `catagory_id` int(11) NOT NULL,
  `catagory_name` varchar(100) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL,
  `alert_quantity` int(4) NOT NULL,
  `product_expense` float(15,2) NOT NULL DEFAULT 0.00,
  `sell_price` float(15,2) NOT NULL DEFAULT 0.00,
  `added_by` int(4) NOT NULL,
  `last_update_at` date NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `sub_total` float(15,2) NOT NULL DEFAULT 0.00,
  `discount` float(15,2) NOT NULL DEFAULT 0.00,
  `pre_cus_due` float(15,2) NOT NULL DEFAULT 0.00,
  `net_total` float(15,2) NOT NULL DEFAULT 0.00,
  `paid_amount` float(15,2) NOT NULL DEFAULT 0.00,
  `due_amount` float(15,2) NOT NULL DEFAULT 0.00,
  `payment_type` varchar(20) NOT NULL,
  `return_status` varchar(30) NOT NULL DEFAULT 'no',
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_number`, `customer_id`, `customer_name`, `order_date`, `sub_total`, `discount`, `pre_cus_due`, `net_total`, `paid_amount`, `due_amount`, `payment_type`, `return_status`, `last_update`) VALUES
(1, 'S1689942866', 1, 'Nilesh Pandit', '2023-07-28', 9000.00, 0.00, 0.00, 9000.00, 9000.00, 0.00, 'Bank Transfer', 'no', NULL),
(2, 'S1689943248', 1, 'Nilesh Pandit', '2023-07-27', 10000.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 'Debit Card', 'no', NULL),
(3, 'S1758119045', 1, 'Nilesh Pandit', '2025-09-01', 9000.00, 0.00, 0.00, 9000.00, 9000.00, 0.00, 'Debit Card', 'no', NULL),
(4, 'S1758119053', 1, 'Nilesh Pandit', '2025-09-01', 9000.00, 0.00, 0.00, 9000.00, 9000.00, 0.00, 'Debit Card', 'no', NULL),
(5, 'S1758127222', 1, 'Nilesh Pandit', '2025-09-02', 4500.00, 0.00, 0.00, 4500.00, 0.00, 0.00, 'Gpay', 'no', NULL),
(6, 'S1758127234', 1, 'Nilesh Pandit', '2025-09-02', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Gpay', 'no', NULL),
(7, 'S1758127241', 1, 'Nilesh Pandit', '2025-09-02', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Gpay', 'no', NULL),
(8, 'S1758128069', 2, 'Md. Rahim Hossain', '2025-09-09', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(9, 'S1758128676', 4, 'Fatima Akter', '2025-09-09', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(12, 'S1758162183', 1, 'Md. Rayhan', '2025-09-16', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(13, 'S1758162596', 1, 'Md. Rayhan', '2025-09-09', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(14, 'S1758162607', 1, 'Md. Rayhan', '2025-09-09', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(15, 'S1758162652', 2, 'Md. Rahim Hossain', '2025-09-08', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Credit Card', 'no', NULL),
(16, 'S1758162758', 2, 'Md. Rahim Hossain', '2025-09-08', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Credit Card', 'no', NULL),
(17, 'S1758162777', 2, 'Md. Rahim Hossain', '2025-09-08', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Credit Card', 'no', NULL),
(18, 'S1758162833', 2, 'Md. Rahim Hossain', '2025-09-08', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Credit Card', 'no', NULL),
(19, 'S1758162931', 1, 'Md. Rayhan', '2025-09-01', 0.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Cash', 'no', NULL),
(20, 'S1758163189', 1, 'Md. Rayhan', '2025-09-01', 0.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Cash', 'no', NULL),
(21, 'S1758163207', 2, 'Md. Rahim Hossain', '2025-09-09', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(22, 'S1758163307', 2, 'Md. Rahim Hossain', '2025-09-02', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Bkash', 'no', NULL),
(23, 'S1758164419', 2, 'Md. Rahim Hossain', '2025-09-08', 75.00, 0.00, 0.00, 75.00, 75.00, 0.00, 'Cash', 'no', NULL),
(24, 'S1758164434', 2, 'Md. Rahim Hossain', '2025-09-08', 4500.00, 0.00, 0.00, 4500.00, 4500.00, 0.00, 'Cash', 'no', NULL),
(25, 'S1758164482', 2, 'Md. Rahim Hossain', '2025-09-10', 80.00, 0.00, 0.00, 80.00, 80.00, 0.00, 'Bkash', 'no', NULL),
(26, 'S1758164543', 2, 'Md. Rahim Hossain', '2025-09-09', 80.00, 0.00, 0.00, 80.00, 80.00, 0.00, 'Debit Card', 'no', NULL),
(27, 'S1758164549', 2, 'Md. Rahim Hossain', '2025-09-09', 80.00, 0.00, 0.00, 80.00, 80.00, 0.00, 'Debit Card', 'no', NULL),
(28, 'S1758164561', 2, 'Md. Rahim Hossain', '2025-09-09', 80.00, 0.00, 0.00, 80.00, 80.00, 0.00, 'Debit Card', 'no', NULL),
(29, 'S1758164686', 4, 'Fatima Akter', '2025-09-15', 80.00, 0.00, 0.00, 80.00, 80.00, 0.00, 'Cash', 'no', NULL),
(30, 'S1758165097', 4, 'Fatima Akter', '2025-09-16', 100.00, 0.00, 0.00, 100.00, 100.00, 0.00, 'Bkash', 'no', NULL),
(31, 'S1758165105', 4, 'Fatima Akter', '2025-09-16', 100.00, 0.00, 0.00, 100.00, 100.00, 0.00, 'Bkash', 'no', NULL),
(32, 'S1758165234', 1, 'Md. Rayhan', '2025-09-01', 200.00, 0.00, 0.00, 200.00, 200.00, 0.00, 'Bkash', 'no', NULL),
(33, 'S1758165234', 1, 'Md. Rayhan', '2025-09-01', 200.00, 0.00, 0.00, 200.00, 200.00, 0.00, 'Bkash', 'no', NULL),
(34, 'S1758165249', 1, 'Md. Rayhan', '1970-01-01', 200.00, 0.00, 0.00, 200.00, 200.00, 0.00, 'Bkash', 'no', NULL),
(35, 'S1758165249', 1, 'Md. Rayhan', '1970-01-01', 200.00, 0.00, 0.00, 200.00, 200.00, 0.00, 'Bkash', 'no', NULL),
(36, 'S1758165638', 2, 'Md. Rahim Hossain', '2025-09-01', 170.00, 0.00, 0.00, 170.00, 170.00, 0.00, 'Bkash', 'no', NULL),
(37, 'S1758165638', 2, 'Md. Rahim Hossain', '2025-09-01', 170.00, 0.00, 0.00, 170.00, 170.00, 0.00, 'Bkash', 'no', NULL),
(38, 'S1758166021', 1, 'Md. Rayhan', '2025-09-01', 100.00, 0.00, 0.00, 100.00, 100.00, 0.00, 'Bkash', 'no', NULL),
(39, 'S1758166021', 1, 'Md. Rayhan', '2025-09-01', 100.00, 0.00, 0.00, 100.00, 100.00, 0.00, 'Bkash', 'no', NULL),
(40, 'S1758166336', 2, 'Md. Rahim Hossain', '2025-09-07', 190.00, 0.00, 0.00, 190.00, 190.00, 0.00, 'Bkash', 'no', NULL),
(41, 'S1758166336', 2, 'Md. Rahim Hossain', '2025-09-07', 190.00, 0.00, 0.00, 190.00, 190.00, 0.00, 'Bkash', 'no', NULL),
(42, 'S1758167497', 2, 'Md. Rahim Hossain', '2025-09-08', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Bkash', 'no', NULL),
(43, 'S1758167497', 2, 'Md. Rahim Hossain', '2025-09-08', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Bkash', 'no', NULL),
(44, 'S1759137864', 2, 'Md. Rahim Hossain', '2025-09-16', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Bkash', 'no', NULL),
(45, 'S1759137864', 2, 'Md. Rahim Hossain', '2025-09-16', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Bkash', 'no', NULL),
(46, 'S1759137930', 2, 'Md. Rahim Hossain', '2025-09-16', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Cash', 'no', NULL),
(47, 'S1759137930', 2, 'Md. Rahim Hossain', '2025-09-16', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Cash', 'no', NULL),
(48, 'S1759138548', 1, 'Md. Rayhan', '2025-09-29', 35.00, 0.00, 0.00, 35.00, 200.00, -165.00, 'Cash', 'no', NULL),
(49, 'S1759138548', 1, 'Md. Rayhan', '2025-09-29', 35.00, 0.00, 0.00, 35.00, 200.00, -165.00, 'Cash', 'no', NULL),
(50, 'S1759146452', 1, 'Md. Rayhan', '2025-09-16', 70.00, 0.00, 0.00, 70.00, 70.00, 0.00, 'Cash', 'no', NULL),
(51, 'S1759146452', 1, 'Md. Rayhan', '2025-09-16', 70.00, 0.00, 0.00, 70.00, 70.00, 0.00, 'Cash', 'no', NULL),
(52, 'S1759146510', 1, 'Md. Rayhan', '2025-09-08', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Cash', 'no', NULL),
(53, 'S1759146510', 1, 'Md. Rayhan', '2025-09-08', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Cash', 'no', NULL),
(54, 'S1759221083', 7, 'Arnob', '2025-09-17', 70.00, 0.00, 0.00, 70.00, 70.00, 0.00, 'Cash', 'no', NULL),
(55, 'S1759221083', 7, 'Arnob', '2025-09-17', 70.00, 0.00, 0.00, 70.00, 70.00, 0.00, 'Cash', 'no', NULL),
(56, 'S1759221156', 7, 'Arnob', '2025-09-16', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Cash', 'no', NULL),
(57, 'S1759221157', 7, 'Arnob', '2025-09-16', 35.00, 0.00, 0.00, 35.00, 35.00, 0.00, 'Cash', 'no', NULL),
(58, 'S1759228356', 1, 'Md. Rayhan', '2025-09-23', 4535.00, 0.00, 0.00, 4535.00, 4535.00, 0.00, 'Bkash', 'no', NULL),
(59, 'S1759228356', 1, 'Md. Rayhan', '2025-09-23', 4535.00, 0.00, 0.00, 4535.00, 4535.00, 0.00, 'Bkash', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `pid`, `product_name`, `price`, `quantity`) VALUES
(1, 1, 1, 'AMD Ryzen 9 5900X Processor', '9000', 2),
(2, 2, 3, 'Adata XPG Gammix D30 8GB 3200MHz DDR4 CL16 RAM Memory Module', '10000', 5),
(3, 9, 1, 'AMD Ryzen 9 5900X Processor', '4500', 1),
(6, 21, 1, 'AMD Ryzen 9 5900X Processor', '4500', 1),
(7, 22, 1, 'AMD Ryzen 9 5900X Processor', '4500', 1),
(8, 24, 1, 'AMD Ryzen 9 5900X Processor', '4500', 1),
(9, 32, 5, 'Teer Oil 1L', '200', 2),
(10, 33, 5, 'Teer Oil 1L', '200', 2),
(11, 36, 6, 'Red Lentil (Masoor Dal) 1kg', '170', 1),
(12, 37, 6, 'Red Lentil (Masoor Dal) 1kg', '170', 1),
(13, 38, 5, 'Teer Oil 1L', '100', 1),
(14, 39, 5, 'Teer Oil 1L', '100', 1),
(15, 40, 7, 'Tomato 1kg', '190', 1),
(16, 41, 7, 'Tomato 1kg', '190', 1),
(17, 42, 8, 'Lux Soap 100g', '35.00', 1),
(18, 43, 8, 'Lux Soap 100g', '35.00', 1),
(19, 44, 8, 'Lux Soap 100g', '35', 1),
(20, 45, 8, 'Lux Soap 100g', '35', 1),
(21, 46, 8, 'Lux Soap 100g', '35', 1),
(22, 47, 8, 'Lux Soap 100g', '35', 1),
(23, 48, 8, 'Lux Soap 100g', '35', 1),
(24, 49, 8, 'Lux Soap 100g', '35', 1),
(25, 50, 8, 'Lux Soap 100g', '70', 2),
(26, 51, 8, 'Lux Soap 100g', '70', 2),
(27, 52, 8, 'Lux Soap 100g', '35', 1),
(28, 53, 8, 'Lux Soap 100g', '35', 1),
(29, 54, 8, 'Lux Soap 100g', '70', 2),
(30, 55, 8, 'Lux Soap 100g', '70', 2),
(31, 56, 8, 'Lux Soap 100g', '35', 1),
(32, 57, 8, 'Lux Soap 100g', '35', 1),
(33, 58, 8, 'Lux Soap 100g', '35', 1),
(34, 58, 1, 'AMD Ryzen 9 5900X Processor', '4500', 1),
(35, 59, 8, 'Lux Soap 100g', '35', 1),
(36, 59, 1, 'AMD Ryzen 9 5900X Processor', '4500', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `member_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `con_num` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `total_buy` float(15,2) NOT NULL DEFAULT 0.00,
  `total_paid` float(15,2) NOT NULL DEFAULT 0.00,
  `total_due` float(15,2) NOT NULL DEFAULT 0.00,
  `reg_date` date NOT NULL,
  `update_by` int(8) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `member_id`, `name`, `company`, `address`, `con_num`, `email`, `total_buy`, `total_paid`, `total_due`, `reg_date`, `update_by`, `update_at`, `create_at`) VALUES
(1, 'C1689940620', 'Md. Rayhan', 'Regular', '2nd floor, Nikhil Pride Building, Rampura', '+8801712345678', 'rayhan@gmail.com', 28950.00, 29280.00, 0.00, '2023-07-21', 1, '2025-09-17', '2023-07-21 11:57:00'),
(2, 'C1758127638', 'Md. Rahim Hossain', 'Regular', 'House 12, Road 5, Dhanmondi, Dhaka', '01712345678', 'rahim.hossain01@example.com', 14430.00, 14430.00, 0.00, '2025-09-17', 1, NULL, '2025-09-17 16:47:18'),
(4, 'C1758127701', 'Fatima Akter', 'Regular', 'House 33, Road 7A, Dhanmondi, Dhaka', '01798765432', 'fatima.akter02@example.com', 0.00, 0.00, 0.00, '2025-09-17', 1, NULL, '2025-09-17 16:48:21'),
(5, 'C1759220987', 'Arnob', 'Regular', 'd', '0123', 'f@gmail.com', 0.00, 0.00, 0.00, '2025-09-30', 1, NULL, '2025-09-30 08:29:47'),
(6, 'C1759220997', 'Arnob', 'Regular', 'd', '01912234569', 'f@gmail.com', 0.00, 0.00, 0.00, '2025-09-30', 1, NULL, '2025-09-30 08:29:57'),
(7, 'C1759221003', 'Arnob', 'Regular', 'd', '01912234569', 'f@gmail.com', 210.00, 210.00, 0.00, '2025-09-30', 1, NULL, '2025-09-30 08:30:03'),
(9, 'C1759224402', 'Ahmed', 'Regular', 'Rampura', '01518936412', 'contact.alamin02@gmail.com', 0.00, 0.00, 0.00, '2025-09-30', 1, NULL, '2025-09-30 09:26:42'),
(10, 'C1759550714', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:14'),
(11, 'C1759550730', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:30'),
(12, 'C1759550731', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:31'),
(17, 'C1759550732', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:32'),
(19, 'C1759550733', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:33'),
(22, 'C1759550738', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:38'),
(26, 'C1759550739', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:39'),
(28, 'C1759550743', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:43'),
(29, 'C1759550744', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:05:44'),
(30, 'C1759551016', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:10:16'),
(31, 'C1759551017', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:10:17'),
(32, 'C1759551018', 'Md. Al-Amin Ahmed', 'Regular', '170 Ulon Road, Rampura', '01518936411', 'contact@gmail.com', 0.00, 0.00, 0.00, '2025-10-04', 1, NULL, '2025-10-04 04:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `paymethode`
--

CREATE TABLE `paymethode` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `paymethode`
--

INSERT INTO `paymethode` (`id`, `name`, `added_by`, `added_time`) VALUES
(1, 'Cash', NULL, '2023-06-27 04:28:58'),
(2, 'Bkash', NULL, '2023-06-27 04:29:29'),
(3, 'Bank Transfer', NULL, '2023-06-27 04:29:29'),
(4, 'Credit Card', NULL, '2023-06-27 04:30:08'),
(5, 'Debit Card', NULL, '2023-06-27 04:30:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_id` varchar(50) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `catagory_id` int(10) NOT NULL,
  `catagory_name` varchar(100) DEFAULT NULL,
  `product_source` varchar(20) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `quantity` int(10) DEFAULT 0,
  `alert_quanttity` int(3) DEFAULT NULL,
  `buy_price` varchar(10) DEFAULT NULL,
  `sell_price` varchar(10) DEFAULT NULL,
  `added_by` int(4) DEFAULT NULL,
  `last_update_at` date NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_image`, `product_id`, `brand_name`, `catagory_id`, `catagory_name`, `product_source`, `sku`, `quantity`, `alert_quanttity`, `buy_price`, `sell_price`, `added_by`, `last_update_at`, `added_time`) VALUES
(1, 'AMD Ryzen 9 5900X Processor', '', 'P1689942626', 'Ryzen', 1, 'Processors', 'factory', '456AD5S', 43, 5, '3653', '4500', 1, '2023-07-27', '2023-07-21 12:30:26'),
(2, 'Intel Core I5-10400 Processor', '', 'P1689942673', 'Intel', 1, 'Processors', 'factory', 'SDS55S', 0, 5, NULL, NULL, 1, '0000-00-00', '2023-07-21 12:31:13'),
(3, 'Adata XPG Gammix D30 8GB 3200MHz DDR4 CL16 RAM Memory Module', '', 'P1689943120', 'XPG', 3, 'RAM (Memory)', 'factory', '2365SDSV', 0, 160, '1839', '2000', 1, '2023-07-19', '2023-07-21 12:38:40'),
(4, 'Miniket Rice', '', 'P1758164366', 'Rice', 5, 'Daily Essentials', 'buy', '', 100, 50, NULL, '70', 1, '2025-09-29', '2025-09-18 02:59:26'),
(5, 'Teer Oil 1L', '', 'P1758164627', 'Teer', 4, 'Grocery', 'factory', '', 47, 10, NULL, '100', 1, '2025-09-18', '2025-09-18 03:03:47'),
(6, 'Red Lentil (Masoor Dal) 1kg', '', 'P1758165595', 'NA', 5, 'Daily Essentials', 'factory', '', 49, 5, '150', '170', 1, '0000-00-00', '2025-09-18 03:19:55'),
(7, 'Tomato 1kg', '', 'P1758166294', 'Tomato', 4, 'Grocery', 'factory', '', 49, 5, '180', '190', 1, '2025-09-30', '2025-09-18 03:31:34'),
(8, 'Lux Soap 100g', 'assets/images/products/product_P1758167450.png', 'P1758167450', 'Lux', 4, 'Grocery', 'factory', '', 489, 10, '25', '35', 1, '0000-00-00', '2025-09-18 03:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_payment`
--

CREATE TABLE `purchase_payment` (
  `id` int(11) NOT NULL,
  `suppliar_id` int(11) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_amount` float(15,2) NOT NULL DEFAULT 0.00,
  `payment_type` varchar(20) DEFAULT NULL,
  `pay_description` text NOT NULL,
  `added_by` int(4) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `purchase_payment`
--

INSERT INTO `purchase_payment` (`id`, `suppliar_id`, `payment_date`, `payment_amount`, `payment_type`, `pay_description`, `added_by`, `last_update`, `added_time`) VALUES
(1, 1, '2023-07-27', 180000.00, 'Gpay', '', 1, NULL, '2023-07-21 12:34:03'),
(2, 1, '2023-07-19', 9195.00, 'Debit Card', '', 1, NULL, '2023-07-21 12:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_products`
--

CREATE TABLE `purchase_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_suppliar` int(11) DEFAULT NULL,
  `suppliar_name` varchar(255) DEFAULT NULL,
  `prev_quantity` int(11) DEFAULT NULL,
  `purchase_quantity` int(11) DEFAULT NULL,
  `purchase_price` float(15,2) DEFAULT 0.00,
  `purchase_sell_price` float(15,2) DEFAULT 0.00,
  `purchase_subtotal` float(15,2) DEFAULT 0.00,
  `prev_total_due` float(15,2) DEFAULT 0.00,
  `purchase_net_total` float(15,2) DEFAULT 0.00,
  `purchase_paid_bill` float(15,2) DEFAULT 0.00,
  `purchase_due_bill` float(15,2) DEFAULT 0.00,
  `purchase_pamyent_by` varchar(20) DEFAULT NULL,
  `return_status` varchar(50) NOT NULL DEFAULT 'no',
  `added_by` int(4) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `purchase_products`
--

INSERT INTO `purchase_products` (`id`, `product_id`, `product_name`, `purchase_date`, `purchase_suppliar`, `suppliar_name`, `prev_quantity`, `purchase_quantity`, `purchase_price`, `purchase_sell_price`, `purchase_subtotal`, `prev_total_due`, `purchase_net_total`, `purchase_paid_bill`, `purchase_due_bill`, `purchase_pamyent_by`, `return_status`, `added_by`, `added_time`) VALUES
(1, 1, 'AMD Ryzen 9 5900X Processor', '2023-07-27', 1, 'Rakesh Jadhav', 0, 50, 3653.00, 4500.00, 182650.00, 500.00, 183150.00, 180000.00, 3150.00, 'Gpay', 'no', 1, '2023-07-21 12:34:03'),
(2, 3, 'Adata XPG Gammix D30 8GB 3200MHz DDR4 CL16 RAM Memory Module', '2023-07-19', 1, 'Rakesh Jadhav', 0, 5, 1839.00, 2000.00, 9195.00, 3150.00, 12345.00, 9195.00, 3150.00, 'Debit Card', 'no', 1, '2023-07-21 12:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return`
--

CREATE TABLE `purchase_return` (
  `id` int(11) NOT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `suppliar_id` int(11) DEFAULT NULL,
  `suppliar_name` varchar(50) NOT NULL,
  `return_date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `return_quantity` int(11) NOT NULL,
  `subtotal` float(15,2) NOT NULL DEFAULT 0.00,
  `discount` float(15,2) NOT NULL DEFAULT 0.00,
  `netTotal` float(15,2) NOT NULL DEFAULT 0.00,
  `create_by` int(4) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sell_payment`
--

CREATE TABLE `sell_payment` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` float(15,2) NOT NULL DEFAULT 0.00,
  `payment_type` varchar(20) NOT NULL,
  `pay_description` text NOT NULL,
  `added_by` int(4) NOT NULL,
  `last_update` date DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sell_payment`
--

INSERT INTO `sell_payment` (`id`, `customer_id`, `invoice_number`, `payment_date`, `payment_amount`, `payment_type`, `pay_description`, `added_by`, `last_update`, `added_time`) VALUES
(1, 1, 'HISTORICAL-1', '2023-07-28', 9000.00, 'Bank Transfer', '', 1, NULL, '2023-07-21 12:34:26'),
(2, 1, 'HISTORICAL-2', '2023-07-27', 10000.00, 'Debit Card', '', 1, NULL, '2023-07-21 12:40:48'),
(3, 2, 'HISTORICAL-3', '2025-09-09', 4500.00, 'Bkash', '', 1, NULL, '2025-09-18 02:40:07'),
(4, 2, 'HISTORICAL-4', '2025-09-02', 4500.00, 'Bkash', '', 1, NULL, '2025-09-18 02:41:47'),
(5, 2, 'HISTORICAL-5', '2025-09-08', 4500.00, 'Cash', '', 1, NULL, '2025-09-18 03:00:34'),
(6, 1, 'HISTORICAL-6', '2025-09-01', 200.00, 'Bkash', '', 1, NULL, '2025-09-18 03:13:54'),
(7, 1, 'HISTORICAL-7', '2025-09-01', 200.00, 'Bkash', '', 1, NULL, '2025-09-18 03:13:54'),
(8, 2, 'HISTORICAL-8', '2025-09-01', 170.00, 'Bkash', '', 1, NULL, '2025-09-18 03:20:38'),
(9, 2, 'HISTORICAL-9', '2025-09-01', 170.00, 'Bkash', '', 1, NULL, '2025-09-18 03:20:38'),
(10, 1, 'S1758166021', '2025-09-01', 100.00, 'Bkash', '', 1, NULL, '2025-09-18 03:27:01'),
(11, 1, 'S1758166021', '2025-09-01', 100.00, 'Bkash', '', 1, NULL, '2025-09-18 03:27:01'),
(12, 2, 'S1758166336', '2025-09-07', 190.00, 'Bkash', '', 1, NULL, '2025-09-18 03:32:16'),
(13, 2, 'S1758166336', '2025-09-07', 190.00, 'Bkash', '', 1, NULL, '2025-09-18 03:32:16'),
(14, 2, 'S1758167497', '2025-09-08', 35.00, 'Bkash', '', 1, NULL, '2025-09-18 03:51:37'),
(15, 2, 'S1758167497', '2025-09-08', 35.00, 'Bkash', '', 1, NULL, '2025-09-18 03:51:37'),
(16, 2, 'S1759137864', '2025-09-16', 35.00, 'Bkash', '', 1, NULL, '2025-09-29 09:24:24'),
(17, 2, 'S1759137864', '2025-09-16', 35.00, 'Bkash', '', 1, NULL, '2025-09-29 09:24:24'),
(18, 2, 'S1759137930', '2025-09-16', 35.00, 'Cash', '', 1, NULL, '2025-09-29 09:25:30'),
(19, 2, 'S1759137930', '2025-09-16', 35.00, 'Cash', '', 1, NULL, '2025-09-29 09:25:30'),
(20, 1, 'S1759138548', '2025-09-29', 200.00, 'Cash', '', 1, NULL, '2025-09-29 09:35:48'),
(21, 1, 'S1759138548', '2025-09-29', 200.00, 'Cash', '', 1, NULL, '2025-09-29 09:35:48'),
(22, 1, 'S1759146452', '2025-09-16', 70.00, 'Cash', '', 1, NULL, '2025-09-29 11:47:32'),
(23, 1, 'S1759146452', '2025-09-16', 70.00, 'Cash', '', 1, NULL, '2025-09-29 11:47:32'),
(24, 1, 'S1759146510', '2025-09-08', 35.00, 'Cash', '', 1, NULL, '2025-09-29 11:48:30'),
(25, 1, 'S1759146510', '2025-09-08', 35.00, 'Cash', '', 1, NULL, '2025-09-29 11:48:30'),
(26, 7, 'S1759221083', '2025-09-17', 70.00, 'Cash', '', 1, NULL, '2025-09-30 08:31:23'),
(27, 7, 'S1759221083', '2025-09-17', 70.00, 'Cash', '', 1, NULL, '2025-09-30 08:31:23'),
(28, 7, 'S1759221156', '2025-09-16', 35.00, 'Cash', '', 1, NULL, '2025-09-30 08:32:37'),
(29, 7, 'S1759221157', '2025-09-16', 35.00, 'Cash', '', 1, NULL, '2025-09-30 08:32:37'),
(30, 1, 'S1759228356', '2025-09-23', 4535.00, 'Bkash', '', 1, NULL, '2025-09-30 10:32:36'),
(31, 1, 'S1759228356', '2025-09-23', 4535.00, 'Bkash', '', 1, NULL, '2025-09-30 10:32:36');

-- --------------------------------------------------------

--
-- Table structure for table `sell_return`
--

CREATE TABLE `sell_return` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `amount` float(15,2) NOT NULL DEFAULT 0.00,
  `added_by` int(11) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `con_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `added_by` int(4) DEFAULT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `designation`, `con_no`, `email`, `address`, `added_by`, `added_time`) VALUES
(1, 'Sushant Kolhe', 'Manager', '8708708702', 'sushant@gmail.com', 'besides maruti temple, Shahupuri 5th Ln, E Ward, Shahupuri, Kolhapur, Maharashtra 416001', 1, '2023-07-21 12:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `suppliar`
--

CREATE TABLE `suppliar` (
  `id` int(11) NOT NULL,
  `suppliar_id` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `con_num` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `total_buy` float(15,2) NOT NULL DEFAULT 0.00,
  `total_paid` float(15,2) NOT NULL DEFAULT 0.00,
  `total_due` float(15,2) NOT NULL DEFAULT 0.00,
  `reg_date` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `update_at` date DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `suppliar`
--

INSERT INTO `suppliar` (`id`, `suppliar_id`, `name`, `company`, `address`, `con_num`, `email`, `total_buy`, `total_paid`, `total_due`, `reg_date`, `update_by`, `update_at`, `create_at`) VALUES
(1, 'S1689942181', 'Kamrul Hasan', 'Kamrul Trade Pvt Ltd.', 'House 90, Road 11, Dhanmondi, Dhaka', '01755667788', 'kamrul.hasan03@example.com', 191845.00, 189195.00, 3150.00, '2023-07-21', 1, '2025-09-17', '2023-07-21 12:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_role` varchar(10) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `last_update_at` int(11) DEFAULT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `user_role`, `update_by`, `last_update_at`, `added_date`) VALUES
(1, 'belmonte', '21232f297a57a5a743894a0e4a801fc3', 'admin', 1, 0, '2023-08-24 18:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_catagory`
--
ALTER TABLE `expense_catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factory_products`
--
ALTER TABLE `factory_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- Indexes for table `paymethode`
--
ALTER TABLE `paymethode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_payment`
--
ALTER TABLE `purchase_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_products`
--
ALTER TABLE `purchase_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_return`
--
ALTER TABLE `purchase_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_payment`
--
ALTER TABLE `sell_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_return`
--
ALTER TABLE `sell_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliar`
--
ALTER TABLE `suppliar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_catagory`
--
ALTER TABLE `expense_catagory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `factory_products`
--
ALTER TABLE `factory_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `paymethode`
--
ALTER TABLE `paymethode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `purchase_payment`
--
ALTER TABLE `purchase_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_products`
--
ALTER TABLE `purchase_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_return`
--
ALTER TABLE `purchase_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sell_payment`
--
ALTER TABLE `sell_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sell_return`
--
ALTER TABLE `sell_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliar`
--
ALTER TABLE `suppliar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
