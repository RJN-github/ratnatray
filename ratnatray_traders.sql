-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 04:26 AM
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
-- Database: `ratnatray_traders`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `customer_name`, `customer_phone`, `total_amount`, `created_at`) VALUES
(1, 'rishikesh', '1234455we', 130.00, '2025-02-11 18:59:02'),
(2, 'rishikesh', NULL, 89.76, '2025-02-11 14:44:20'),
(3, 'rishikesh', NULL, 202.00, '2025-02-11 14:46:56'),
(4, 'rishikesh', NULL, 97.50, '2025-02-11 14:48:22'),
(5, 'quotes ', NULL, 237.50, '2025-02-11 15:03:27'),
(6, 'quotes ', NULL, 45.00, '2025-02-11 15:11:18'),
(7, 'rishikesh', NULL, 250.00, '2025-02-11 22:26:42'),
(8, 'rishikesh', NULL, 185.00, '2025-02-11 22:31:25'),
(9, 'rishikesh', NULL, 25.00, '2025-02-12 04:40:07'),
(10, 'asavari', NULL, 4784.00, '2025-02-12 04:57:17'),
(11, 'sample', NULL, 25.00, '2025-02-12 05:15:18'),
(12, 'sample', NULL, 100.00, '2025-02-12 08:03:40'),
(13, 'cash', NULL, 50.00, '2025-02-12 08:06:31'),
(14, 'rishikesh', NULL, 50.00, '2025-02-12 08:11:32'),
(15, 'rishikesh', NULL, 20.00, '2025-02-12 09:30:50'),
(16, 'cash', NULL, 409.00, '2025-02-12 16:48:46'),
(17, 'rishikesh', NULL, 325.00, '2025-02-14 01:40:11'),
(18, 'aniket', NULL, 445.00, '2025-02-15 02:13:39');

-- --------------------------------------------------------

--
-- Table structure for table `bills_products`
--

CREATE TABLE `bills_products` (
  `id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bills_products`
--

INSERT INTO `bills_products` (`id`, `bill_id`, `product_name`, `quantity`, `price`, `total_price`) VALUES
(1, 1, 'scale', 10, 10.00, 100.00),
(2, 1, 'rubber`', 15, 2.00, 30.00),
(3, 2, 'rubber', 12, 1.23, 14.76),
(4, 2, 'xo ball pen', 10, 7.50, 75.00),
(5, 3, 'scale', 10, 10.00, 100.00),
(6, 3, 'scale', 10, 10.20, 102.00),
(7, 4, 'scale', 10, 9.75, 97.50),
(8, 5, 'scale', 19, 12.50, 237.50),
(9, 6, 'scale', 12, 1.00, 12.00),
(10, 6, 'a', 1, 1.00, 1.00),
(11, 6, '1', 1, 11.00, 11.00),
(12, 6, '1', 1, 1.00, 1.00),
(13, 6, '1', 1, 1.00, 1.00),
(14, 6, '1', 1, 1.00, 1.00),
(15, 6, '1', 1, 1.00, 1.00),
(16, 6, '1', 1, 1.00, 1.00),
(17, 6, '1', 1, 1.00, 1.00),
(18, 6, '1', 1, 11.00, 11.00),
(19, 6, '1', 1, 1.00, 1.00),
(20, 6, '1', 1, 1.00, 1.00),
(21, 6, '1', 1, 1.00, 1.00),
(22, 6, '11', 1, 1.00, 1.00),
(23, 7, 'scale', 10, 5.00, 50.00),
(24, 7, 'eraser', 50, 2.50, 125.00),
(25, 7, 'xo ball pen', 10, 7.50, 75.00),
(26, 8, 'scale', 10, 5.00, 50.00),
(27, 8, 'xo blall pen ', 10, 7.50, 75.00),
(28, 8, 'book ', 1, 60.00, 60.00),
(29, 9, 'scale', 10, 2.50, 25.00),
(30, 10, 'scissors', 2, 95.00, 190.00),
(31, 10, 'plastic folder a4', 500, 3.00, 1500.00),
(32, 10, 'box files', 12, 100.00, 1200.00),
(33, 10, 'octane gel ', 40, 7.50, 300.00),
(34, 10, 'sticky note 4 color mix ', 12, 2.00, 24.00),
(35, 10, 'stapler pin 10 no. ', 20, 7.50, 150.00),
(36, 10, 'stapler pin big', 10, 12.00, 120.00),
(37, 10, 'writing pad transparent ', 12, 90.00, 1080.00),
(38, 10, 'rubber packet 250 gm', 1, 100.00, 100.00),
(39, 10, 'thumb pins', 4, 30.00, 120.00),
(40, 11, 'sdfdgdf weiufhsi u wewiuhwuihwwuthwiruirgierhgui', 10, 2.50, 25.00),
(41, 12, 'scale', 10, 5.00, 50.00),
(42, 12, 'scissors', 2, 25.00, 50.00),
(43, 13, 'scale', 10, 5.00, 50.00),
(44, 14, 'scale', 10, 5.00, 50.00),
(45, 15, 'xo ball pen ', 10, 2.00, 20.00),
(46, 16, '1', 1, 44.00, 44.00),
(47, 16, '1', 11, 1.00, 11.00),
(48, 16, '1', 11, 1.00, 11.00),
(49, 16, 'scale', 11, 2.00, 22.00),
(50, 16, 'scale1', 1, 1.00, 1.00),
(51, 16, 'scale', 1, 11.00, 11.00),
(52, 16, 'scale1', 1, 1.00, 1.00),
(53, 16, '1', 1, 11.00, 11.00),
(54, 16, '1', 1, 11.00, 11.00),
(55, 16, '1', 1, 11.00, 11.00),
(56, 16, 'scale', 1, 11.00, 11.00),
(57, 16, '1', 1, 11.00, 11.00),
(58, 16, 'scale', 1, 11.00, 11.00),
(59, 16, 'scale', 1, 11.00, 11.00),
(60, 16, 'scale1', 1, 11.00, 11.00),
(61, 16, 'scale', 11, 11.00, 121.00),
(62, 16, 'rhgui', 1, 11.00, 11.00),
(63, 16, '1', 1, 11.00, 11.00),
(64, 16, 'scale', 1, 11.00, 11.00),
(65, 16, '1', 1, 11.00, 11.00),
(66, 16, '1', 1, 11.00, 11.00),
(67, 16, '1', 1, 11.00, 11.00),
(68, 16, '1', 1, 11.00, 11.00),
(69, 16, '1', 1, 11.00, 11.00),
(70, 16, '1', 1, 11.00, 11.00),
(71, 17, 'xo ball pen ', 10, 7.50, 75.00),
(72, 17, 'scale', 50, 5.00, 250.00),
(73, 18, 'rorito ', 2, 10.00, 20.00),
(74, 18, 'non dust eraser ', 1, 5.00, 5.00),
(75, 18, 'a/4 book 200pg', 6, 70.00, 420.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bills_products`
--
ALTER TABLE `bills_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bills_products`
--
ALTER TABLE `bills_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills_products`
--
ALTER TABLE `bills_products`
  ADD CONSTRAINT `bills_products_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
