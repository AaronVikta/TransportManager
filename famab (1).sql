-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2018 at 11:08 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `famab`
--

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `name`) VALUES
(1, 'Ajala1'),
(2, 'Awam1'),
(3, 'Benjamin101'),
(4, 'jay'),
(5, 'john');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Cool pants', '29.99', '39.99', 1, '6', '/ecommerce/images/dd.jpg', 'This is a very popular pants in western africa especially for young adults try them out and you would be the hottest personality in the neighbourhood', 1, '28:3,32:5,36:1', 1),
(2, 'Cool All Stars', '9.99', '15.99', 1, '7', '/ecommerce/images/index.jpg', 'This is a super comfy shoes that goes well with jeans and is never out of trend', 1, '41:4,42:3,45:3', 1),
(3, 'Mens Shoe', '19.99', '24.99', 1, '7', '/ecommerce/images/8.jpg', 'This is an awesome shoe makes you stand out in  a large crowd and it has quality leather.', 1, '42:5,43:6,44:4,45:4,46:2', 1),
(5, 'New Pants', '12.99', '16.99', 1, '14', '/ecommerce/images/products/a208b879876f8d5f1787dd39fb953383.jpg', 'this i a cool jeans', 1, 'small:4,medium:5,', 1),
(6, 'Chival Dress', '14.99', '15.99', 1, '12', '/ecommerce/images/products/4b2f5283a28c8576b2f486096fc69cca.jpg', '		\r\n	This is chival dress she rocks', 1, 'small:6,Medium:8,', 1),
(7, 'Famab Jeans', '12.99', '17.99', 1, '14', '/ecommerce/images/products/1821b6c7d1cbe5ecd11477048e34b349.jpg', '		\r\n	Top Notch jeans by my dad', 1, 'Small:6,Medium:8,', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `routes` varchar(255) NOT NULL,
  `time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `routes`, `time`) VALUES
(2, 'Lagos-Abuja', '0000-00-00'),
(3, 'Lagos-Enugu', '0000-00-00'),
(4, 'Lagos-Kaduna', '0000-00-00'),
(5, 'Benin-Abuja', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `routes` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `featured` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL,
  `DepartureTime` datetime NOT NULL,
  `services` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `available` int(11) NOT NULL,
  `description` text NOT NULL,
  `driver` varchar(240) NOT NULL,
  `Bus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `routes`, `deleted`, `featured`, `price`, `DepartureTime`, `services`, `title`, `image`, `available`, `description`, `driver`, `Bus`) VALUES
(1, 0, 1, 0, '7500.00', '2018-12-03 00:00:00', 8, '776', '/transportManager/images/schedules/21b57a26281f7d45825fde9f92ddc27e.jpg', 0, '	this is a safe route		', '0', ''),
(2, 0, 1, 1, '5000.00', '2018-03-03 00:00:00', 8, '777', '/transportManager/images/schedules/c4aab3223607b736d27143607bb43058.jpg', 0, 'this is even safer ', '0', ''),
(3, 0, 1, 1, '5000.00', '1999-12-12 00:00:00', 8, '751', '/transportManager/images/schedules/369b48bbfb58a5afd10be7d2c5f2e883.jpg', 0, '	ok this is a good route		', '0', ''),
(4, 0, 1, 1, '7500.00', '2018-12-12 00:00:00', 4, '523', '/transportManager/images/schedules/43e9489980ec4b7dee66f33b76b16b2e.jpg', 0, '	You have to wake up early		', '0', ''),
(5, 0, 1, 1, '9000.00', '2018-07-03 00:00:00', 7, '126', '/transportManager/images/schedules/7d04b4727b1b26be7c004c59dec8a180.jpg', 0, '			This is super comfortable', '0', ''),
(6, 0, 1, 1, '6500.00', '2018-12-07 00:00:00', 9, '453', '/transportManager/images/schedules/56fc1514e60bb05cc9c091404ab857f7.jpg', 0, '			this bus is safe', '0', ''),
(7, 0, 1, 1, '8000.00', '2018-12-12 00:00:00', 8, '456', '/transportManager/images/schedules/b6fd32924ae2189fa65f27ce8d07274f.jpg', 0, '			This is another route', '0', ''),
(8, 0, 1, 0, '8000.00', '2018-12-12 00:00:00', 8, 'Abuja', '/transportManager/images/schedules/ffb413c1a8d4665bae1546490051b6f9.jpg', 0, '	this is new		', 'john', '002'),
(9, 0, 0, 0, '8000.00', '2018-12-12 00:00:00', 8, 'Abuja', '', 0, '			this is new			', '', ''),
(10, 0, 0, 0, '8000.00', '2018-12-12 00:00:00', 9, 'Lagos-Abuja', '', 0, '			this is new			', '', ''),
(11, 0, 0, 0, '8000.00', '2018-12-12 00:00:00', 8, 'Abuja-Benin', '/transportManager/images/schedules/8167b17c812fc2bfde92e4c7bbaf9fcf.jpg', 0, '					this is new				', '', ''),
(12, 0, 0, 1, '5000.00', '2018-12-02 00:00:00', 4, 'Benin-Abuja 1', '/transportManager/images/schedules/5b3c46a7a064733a501e4742bcb9f9e5.jpg', 0, '		this is a complete bus detail fromthe admin	', 'john', '005'),
(13, 0, 0, 1, '1000.00', '2018-12-12 00:00:00', 8, 'Abuja-Lagos', '/transportManager/images/schedules/71fa8616e2be4b90c4393e459c7fdd3c.jpg', 0, 'ok			', 'jay', '004'),
(14, 0, 0, 1, '2000.00', '2018-12-12 00:00:00', 8, 'Lagos-Benin', '/transportManager/images/schedules/35122611a2335e1a4b7110f55bdaab86.jpg', 0, '	this is the final version of the cose		', 'Ajala1', '003'),
(15, 0, 0, 0, '2800.00', '2018-12-03 00:00:00', 11, 'Aba-Ikot', '/transportManager/images/schedules/53d9811988af9393736e99b7032b0322.jpg', 0, '	this should also work		', 'Benjamin101', ''),
(16, 0, 0, 1, '2800.00', '2018-12-01 00:00:00', 8, 'Aba-Ikot', '/transportManager/images/schedules/8cf0581339dee66a28ed7cca686c5639.jpg', 0, '	this is the latest		', 'Benjamin101', '002');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `services` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `services`, `parent`) VALUES
(1, 'Ticket Booking', 0),
(2, 'Courier Service', 0),
(3, 'Private Transportation', 0),
(4, 'Small Bus', 1),
(5, 'Intra-State Delivery', 2),
(6, 'Inter-State Delivery', 2),
(8, 'Large Bus', 1),
(9, 'Family', 3),
(10, 'Money Delivery', 0),
(11, 'Company', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `travel_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seat_number` int(11) NOT NULL,
  `luguage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `name`, `email`, `phone`, `travel_time`, `seat_number`, `luguage`) VALUES
(1, 'awam', 'aryanvikta@gmail.com', 454323432, '2018-02-12 23:00:00', 2, 343);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
