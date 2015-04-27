-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2015 at 08:55 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aristocart`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
`id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `carts_products`
--

CREATE TABLE IF NOT EXISTS `carts_products` (
`id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `created_by_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE IF NOT EXISTS `category_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `sku` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `category_id` int(11) NOT NULL,
  `created_by_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_type` enum('owner','customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
`id` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `abbreviation` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `abbreviation`) VALUES
(1, 'Alabama', 'AL'),
(2, 'Alaska', 'AK'),
(3, 'Arizona', 'AZ'),
(4, 'Arkansas', 'AR'),
(5, 'California', 'CA'),
(6, 'Colorado', 'CO'),
(7, 'Connecticut', 'CT'),
(8, 'Delaware', 'DE'),
(9, 'Florida', 'FL'),
(10, 'Georgia', 'GA'),
(11, 'Hawaii', 'HI'),
(12, 'Idaho', 'ID'),
(13, 'Illinois', 'IL'),
(14, 'Indiana', 'IN'),
(15, 'Iowa', 'IA'),
(16, 'Kansas', 'KS'),
(17, 'Kentucky', 'KY'),
(18, 'Louisiana', 'LA'),
(19, 'Maine', 'ME'),
(20, 'Maryland', 'MD'),
(21, 'Massachusetts', 'MA'),
(22, 'Michigan', 'MI'),
(23, 'Minnesota', 'MN'),
(24, 'Mississippi', 'MS'),
(25, 'Missouri', 'MO'),
(26, 'Montana', 'MT'),
(27, 'Nebraska', 'NE'),
(28, 'Nevada', 'NV'),
(29, 'New Hampshire', 'NH'),
(30, 'New Jersey', 'NJ'),
(31, 'New Mexico', 'NM'),
(32, 'New York', 'NY'),
(33, 'North Carolina', 'NC'),
(34, 'North Dakota', 'ND'),
(35, 'Ohio', 'OH'),
(36, 'Oklahoma', 'OK'),
(37, 'Oregon', 'OR'),
(38, 'Pennsylvania', 'PA'),
(39, 'Rhode Island', 'RI'),
(40, 'South Carolina', 'SC'),
(41, 'South Dakota', 'SD'),
(42, 'Tennessee', 'TN'),
(43, 'Texas', 'TX'),
(44, 'Utah', 'UT'),
(45, 'Vermont', 'VT'),
(46, 'Virginia', 'VA'),
(47, 'Washington', 'WA'),
(48, 'West Virginia', 'WV'),
(49, 'Wisconsin', 'WI'),
(50, 'Wyoming', 'WY');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `age` int(11) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_carts`
--

CREATE TABLE IF NOT EXISTS `user_carts` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `active` enum('true','false') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts_products`
--
ALTER TABLE `carts_products`
 ADD PRIMARY KEY (`id`), ADD KEY `cart_id` (`cart_id`,`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_carts`
--
ALTER TABLE `user_carts`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carts_products`
--
ALTER TABLE `carts_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_carts`
--
ALTER TABLE `user_carts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
