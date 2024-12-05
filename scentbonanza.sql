-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 04:06 PM
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
-- Database: `scentbonanza`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `Barangay` varchar(20) NOT NULL,
  `cityMunicipality` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `Customer_ID` int(11) DEFAULT NULL,
  `status` enum('Pending','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `totalPrice` double NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `Customer_ID`, `status`, `totalPrice`, `user_id`) VALUES
(1, NULL, 'Pending', 8200, NULL),
(3, NULL, 'Pending', 17700, 16);

-- --------------------------------------------------------

--
-- Table structure for table `perfumes`
--

CREATE TABLE `perfumes` (
  `perfumeID` int(11) NOT NULL,
  `PerfumeBrandName` varchar(50) NOT NULL,
  `perfumeName` varchar(50) NOT NULL,
  `sizes` varchar(10) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `concentration` varchar(40) NOT NULL,
  `brandImage` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perfumes`
--

INSERT INTO `perfumes` (`perfumeID`, `PerfumeBrandName`, `perfumeName`, `sizes`, `price`, `concentration`, `brandImage`, `quantity`, `image`) VALUES
(33, 'Dior', 'Sauvage', '100', 6160.00, 'Eau de Toilette', '../images/brandimages/dior-brand.png', 10, '../images/productsimages/dior-sauvage-100ml.png'),
(34, 'Dior', 'Sauvage', '200', 10920.00, 'Eau de Toilette', '../images/brandimages/dior-brand.png', 8, '../images/productsimages/dior-sauvage-200ml.png'),
(35, 'Dior', 'Sauvage', '100', 7280.00, 'Eau de Parfum', '../images/brandimages/dior-brand.png', 15, '../images/productsimages/dior-sauvage-edp-100ml.png'),
(36, 'Dior', 'Sauvage', '200', 10920.00, 'Eau de Parfum', '../images/brandimages/dior-brand.png', 7, '../images/productsimages/dior-sauvage-edp-200ml.png'),
(37, 'Dior', 'Homme', '100', 5880.00, 'Eau de Toilette', '../images/brandimages/dior-brand.png', 20, '../images/productsimages/dior-homme-100ml.png'),
(38, 'Dior', 'Homme', '200', 7560.00, 'Eau de Toilette', '../images/brandimages/dior-brand.png', 12, '../images/productsimages/dior-homme-200ml.png'),
(39, 'Dior', 'Miss Dior', '100', 8120.00, 'Eau de Parfum', '../images/brandimages/dior-brand.png', 10, '../images/productsimages/miss-dior-100ml.png'),
(40, 'Dior', 'Miss Dior', '150', 12040.00, 'Eau de Parfum', '../images/brandimages/dior-brand.png', 6, '../images/productsimages/miss-dior-150ml.png'),
(41, 'Versace', 'Dylan Blue', '100', 5880.00, 'Eau de Toilette', '../images/brandimages/versace-brand.png', 17, '../images/productsimages/versace-dylan-blue-100ml.png'),
(42, 'Versace', 'Dylan Blue', '200', 7560.00, 'Eau de Toilette', '../images/brandimages/versace-brand.png', 8, '../images/productsimages/versace-dylan-blue-200ml.png'),
(43, 'Versace', 'Pour Homme', '100', 5880.00, 'Eau de Toilette', '../images/brandimages/versace-brand.png', 16, '../images/productsimages/versace-pour-homme-100ml.png'),
(44, 'Versace', 'Pour Homme', '200', 7560.00, 'Eau de Toilette', '../images/brandimages/versace-brand.png', 10, '../images/productsimages/versace-pour-homme-200ml.png'),
(45, 'YSL', 'Y', '100', 6720.00, 'Eau de Toilette', '../images/brandimages/ysl-brand.png', 14, '../images/productsimages/ysl-y-100ml.png'),
(46, 'YSL', 'Y', '200', 8400.00, 'Eau de Toilette', '../images/brandimages/ysl-brand.png', 9, '../images/productsimages/ysl-y-200ml.png'),
(47, 'YSL', 'Libre', '90', 6720.00, 'Eau de Toilette', '../images/brandimages/ysl-brand.png', 15, '../images/productsimages/ysl-libre-90ml.png'),
(48, 'YSL', 'Libre', '150', 8400.00, 'Eau de Toilette', '../images/brandimages/ysl-brand.png', 10, '../images/productsimages/ysl-libre-150ml.png');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `promoID` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `discountPercentage` float DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `minSpend` float DEFAULT NULL,
  `applicableBrands` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_category`
--

CREATE TABLE `ref_category` (
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_cityname`
--

CREATE TABLE `ref_cityname` (
  `city` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_concentration`
--

CREATE TABLE `ref_concentration` (
  `concentration` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ref_concentration`
--

INSERT INTO `ref_concentration` (`concentration`) VALUES
('Eau de Parfum'),
('Eau de Toilette');

-- --------------------------------------------------------

--
-- Table structure for table `ref_perfumes`
--

CREATE TABLE `ref_perfumes` (
  `PerfumeBrandName` varchar(50) NOT NULL,
  `perfumeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ref_perfumes`
--

INSERT INTO `ref_perfumes` (`PerfumeBrandName`, `perfumeName`) VALUES
('Dior', 'Homme'),
('Dior', 'Miss Dior'),
('Dior', 'Miss Dior Absolutely Blooming'),
('Dior', 'Sauvage'),
('Versace', 'Dylan Blue'),
('Versace', 'Eros'),
('Versace', 'Eros Flame'),
('Versace', 'Pour Homme'),
('YSL', 'Libre'),
('YSL', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `ref_province`
--

CREATE TABLE `ref_province` (
  `province` varchar(30) NOT NULL,
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_region`
--

CREATE TABLE `ref_region` (
  `region` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ref_sizes`
--

CREATE TABLE `ref_sizes` (
  `sizes` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ref_sizes`
--

INSERT INTO `ref_sizes` (`sizes`) VALUES
('100'),
('150'),
('200'),
('60'),
('90');

-- --------------------------------------------------------

--
-- Table structure for table `ref_zipcodes`
--

CREATE TABLE `ref_zipcodes` (
  `Barangay` varchar(20) NOT NULL,
  `cityMunicipality` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `zipcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `is_disabled` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `is_admin`, `is_disabled`) VALUES
(15, 'Admin', '1', 'admin1@gmail.com', '$2y$10$bOI5HxgU6O0v7von9qbaEuKNQPO11tNIymbBnyA9ZEzN8X8RiKG4a', 1, 0),
(16, 'Test', 'User', 'test@gmail.com', '$2y$10$vh0a0K1nmw6MEiUu4ISEMOYHDN2jDfz/G7kF6blcF/cV.GPt9ZgNS', 0, 0),
(17, 'User', 'Ramirez', 'FB@gmail.com', '$2y$10$xAw8EQioOzvJNoeTFyHxLuXf..jukyofNaH0b0WIoDWHgtPAaVCK.', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `Barangay` (`Barangay`,`cityMunicipality`,`province`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`Customer_ID`);

--
-- Indexes for table `perfumes`
--
ALTER TABLE `perfumes`
  ADD PRIMARY KEY (`perfumeID`),
  ADD KEY `PerfumeBrandName` (`PerfumeBrandName`,`perfumeName`),
  ADD KEY `sizes` (`sizes`),
  ADD KEY `concentration` (`concentration`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`promoID`);

--
-- Indexes for table `ref_category`
--
ALTER TABLE `ref_category`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `ref_cityname`
--
ALTER TABLE `ref_cityname`
  ADD PRIMARY KEY (`city`,`province`),
  ADD KEY `province` (`province`);

--
-- Indexes for table `ref_concentration`
--
ALTER TABLE `ref_concentration`
  ADD PRIMARY KEY (`concentration`);

--
-- Indexes for table `ref_perfumes`
--
ALTER TABLE `ref_perfumes`
  ADD PRIMARY KEY (`PerfumeBrandName`,`perfumeName`);

--
-- Indexes for table `ref_province`
--
ALTER TABLE `ref_province`
  ADD PRIMARY KEY (`province`),
  ADD KEY `region` (`region`);

--
-- Indexes for table `ref_region`
--
ALTER TABLE `ref_region`
  ADD PRIMARY KEY (`region`);

--
-- Indexes for table `ref_sizes`
--
ALTER TABLE `ref_sizes`
  ADD PRIMARY KEY (`sizes`);

--
-- Indexes for table `ref_zipcodes`
--
ALTER TABLE `ref_zipcodes`
  ADD PRIMARY KEY (`Barangay`,`cityMunicipality`,`province`),
  ADD KEY `cityMunicipality` (`cityMunicipality`,`province`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perfumes`
--
ALTER TABLE `perfumes`
  MODIFY `perfumeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `promoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`Barangay`,`cityMunicipality`,`province`) REFERENCES `ref_zipcodes` (`Barangay`, `cityMunicipality`, `province`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customers` (`user_id`);

--
-- Constraints for table `perfumes`
--
ALTER TABLE `perfumes`
  ADD CONSTRAINT `perfumes_ibfk_1` FOREIGN KEY (`PerfumeBrandName`,`perfumeName`) REFERENCES `ref_perfumes` (`PerfumeBrandName`, `perfumeName`),
  ADD CONSTRAINT `perfumes_ibfk_2` FOREIGN KEY (`sizes`) REFERENCES `ref_sizes` (`sizes`),
  ADD CONSTRAINT `perfumes_ibfk_4` FOREIGN KEY (`concentration`) REFERENCES `ref_concentration` (`concentration`);

--
-- Constraints for table `ref_cityname`
--
ALTER TABLE `ref_cityname`
  ADD CONSTRAINT `ref_cityname_ibfk_1` FOREIGN KEY (`province`) REFERENCES `ref_province` (`province`);

--
-- Constraints for table `ref_province`
--
ALTER TABLE `ref_province`
  ADD CONSTRAINT `ref_province_ibfk_1` FOREIGN KEY (`region`) REFERENCES `ref_region` (`region`);

--
-- Constraints for table `ref_zipcodes`
--
ALTER TABLE `ref_zipcodes`
  ADD CONSTRAINT `ref_zipcodes_ibfk_1` FOREIGN KEY (`cityMunicipality`,`province`) REFERENCES `ref_cityname` (`city`, `province`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
