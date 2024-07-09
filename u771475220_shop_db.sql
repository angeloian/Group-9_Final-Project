-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 09, 2024 at 02:10 PM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u771475220_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(254, 20, 53, 'Helia', 1250, 1, 'Helia.png'),
(266, 27, 83, 'Hand Made Wooden Bird Statue', 240, 1, 'Hand Made Wooden Bird Statue.png'),
(267, 24, 83, 'Hand Made Wooden Bird Statue', 240, 0, 'Hand Made Wooden Bird Statue.png'),
(268, 24, 84, 'Bamboo Weaved Backpack', 880, 0, 'Bamboo Weaved Backpack.png'),
(269, 24, 81, 'Palawan South Sea Natural Rich Gold Color Pearls', 500, 0, 'Palawan South Sea Natural Rich Gold Color Pearls.png');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` int(12) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(17, 24, 'Sam Paul', 'Sampaul@gmail.com', 2147483647, 'I really like your products , I would recommend this to my friends!!\r\n'),
(18, 26, 'Reina Torres', 'reina@gmail.com', 2147483647, 'No concerns at all—just wanted to let you know that your products are absolutely amazing! Keep up the fantastic work!'),
(19, 32, 'Angelo', 'angeloiancalzar@gmail.com', 2147483647, 'Your products are really amazing!');

-- --------------------------------------------------------

--
-- Table structure for table `online_payment`
--

CREATE TABLE `online_payment` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(50) NOT NULL,
  `note` varchar(255) NOT NULL,
  `delivery_charges` int(50) NOT NULL,
  `placed_on` varchar(100) NOT NULL,
  `time` time NOT NULL,
  `tracking_number` varchar(100) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `reference_number` varchar(20) NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_payment`
--

INSERT INTO `online_payment` (`id`, `user_id`, `name`, `contact_number`, `email`, `method`, `address`, `total_products`, `total_price`, `note`, `delivery_charges`, `placed_on`, `time`, `tracking_number`, `delivery_date`, `delivery_time`, `reference_number`, `order_type`, `payment_status`) VALUES
(45, 32, 'Angelo', '9063041448', 'angeloiancalzar@gmail.com', 'online payment', 'Block 1 Lot 28  Saint Martin Executive Homes Brgy.Bagumbayan Taguig City - NCR zip:1630', ', Bamboo Cased Utensils Set (1) , Bamboo Weaved Backpack (1) ', 1090, 'white car in the garage', 0, '09-Jul-2024', '13:08:30', 'GMYPH2024070913083032', '', '', '16857496358854', 'fixed-ONLINE', 'On - Transit');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `note` varchar(255) NOT NULL,
  `method` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `custom_note` varchar(100) NOT NULL,
  `delivery_charges` int(100) NOT NULL,
  `placed_on` varchar(255) NOT NULL,
  `time` time NOT NULL,
  `tracking_number` varchar(40) NOT NULL,
  `delivery_date` varchar(255) NOT NULL,
  `delivery_time` varchar(255) NOT NULL,
  `order_type` varchar(50) NOT NULL,
  `payment_status` varchar(30) NOT NULL DEFAULT 'Pending (COD)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payee`
--

CREATE TABLE `payee` (
  `payee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `shipping_rate` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payee`
--

INSERT INTO `payee` (`payee_id`, `name`, `contact_number`, `qr_code`, `shipping_rate`, `date`) VALUES
(32, 'Juan Dela Crush', '09876543212', 'bdcb6414071ce880f3fa1dc18e2eda5b.jpg', 50, '2024-02-19 14:36:39'),
(33, 'Gamay Co.', '09569124627', 'Untitled design.jpg', 100, '2024-07-09 08:12:27'),
(34, 'Angelo Ian Calzar', '09063041448', 'Bamboo Cased Utensils.png', 50, '2024-07-09 13:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_and_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `details`, `stock`, `sold`, `price`, `image`, `date_and_time`) VALUES
(76, 'Embroidered Filipiana', 'A traditional Filipino dress adorned with intricate hand embroidery, often featuring floral and cultural motifs, perfect for formal events and cultural celebrations.\r\nAvailable in sizes: One-Size (bust: 32-33 inches, waist 24-25 inches)\r\n', 5, 0, 650, 'Embroidered Filipiana.png', NULL),
(77, 'Handwoven Kalinga Cropped Bolero', 'This elegant bolero, made from handwoven Kalinga fabric, adds a touch of indigenous heritage to any outfit, showcasing vibrant patterns and craftsmanship.\r\nAvailable in sizes: One-Size (bust: 34-35 inches)\r\n', 5, 0, 700, 'Handwoven Kalinga Cropped Bolero.png', NULL),
(78, 'Black Modern Barong Tagalog', 'A contemporary take on the traditional Barong, this black variant offers a sleek and stylish option for formal gatherings, maintaining the elegance of Filipino heritage.\r\nAvailable in sizes: One-Size (chest: 34-36 inches, waist: 31-32 inches)\r\n', 10, 0, 750, 'Black Modern Barong Tagalog.png', NULL),
(79, 'Sun & Stars Ear Cuff', 'A unique ear cuff design that captures the essence of the Philippine flag\'s sun and stars, adding a patriotic flair to any ensemble.\r\nDiameter: 0.5 inches\r\n', 10, 0, 380, 'Sun & Stars Ear Cuff.png', NULL),
(80, 'Philippine Palmera Pearl Earrings', 'Elegant earrings featuring pearls sourced from the Philippines, set in a design inspired by the Palmera tree, symbolizing beauty and grace.\r\nPearl diameter: 8-10mm', 98, 2, 430, 'Philippine Palmera Pearl Earrings.png', NULL),
(81, 'Palawan South Sea Natural Rich Gold Color Pearls', 'These exquisite pearls from Palawan are renowned for their rich golden hue, making them a luxurious addition to any jewelry collection.\r\nPearl diameter: 10-13mm\r\n', 30, 0, 500, 'Palawan South Sea Natural Rich Gold Color Pearls.png', NULL),
(82, 'Wooden Horse Carving', 'A detailed wooden sculpture of a horse, showcasing the craftsmanship and attention to detail typical of Filipino wood carvers.\r\nHeight: 9 inches\r\nBase diameter: 4 inches\r\n', 98, 2, 1500, 'Wooden Horse Carving.png', NULL),
(83, 'Hand Made Wooden Bird Statue', 'An elegant wooden statue of a bird, capturing the grace and beauty of the avian form through skilled craftsmanship.\r\nHeight: 8 inches\r\nBase diameter: 3 inches\r\n', 194, 6, 240, 'Hand Made Wooden Bird Statue.png', NULL),
(84, 'Bamboo Weaved Backpack', 'A stylish and eco-friendly backpack woven from bamboo, combining functionality with traditional craftsmanship.\r\nDimensions: 15 x 12 x 5 inches\r\n', 98, 2, 880, 'Bamboo Weaved Backpack.png', NULL),
(85, 'Bamboo Cased Utensils Set', 'A set of bamboo utensils stored in a bamboo case, ideal for sustainable dining on the go and reducing plastic waste.\r\nCase length: 8 inches\r\nUtensil length: 7 inches\r\n', 292, 8, 210, 'Bamboo Cased Utensils.png', NULL),
(86, 'Baybayin Engraved Titanium Ring', 'A modern titanium ring engraved with Baybayin script, one of the ancient writing systems of the Philippines, blending history with contemporary style.\r\nAvailable in sizes: 6 (16.5mm)', 100, 0, 300, 'Baybayin Engraved Titanium Ring.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `flat` varchar(20) NOT NULL,
  `street` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_number`, `flat`, `street`, `barangay`, `city`, `region`, `zip`, `password`, `user_type`) VALUES
(17, 'admin', 'admin@gmail.com', '', '', '', '', '', '', '', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(24, 'Sam Paul Neym', 'sampaul@gmail.com', '9876541235', '4234', 'here', 'yeh', 'Taguig City', 'NCR', '1250', 'e807f1fcf82d132f9bb018ca6738a19f', 'user'),
(26, 'Reina Torres', 'reina@gmail.com', '9188273827', 'B150 L30', 'Fernandez St.', 'Central Bicutan', 'Taguig', 'NCR', '1631', 'a4f0e8405432b73b6ce7cf4813a946fa', 'user'),
(32, 'Angelo', 'angeloiancalzar@gmail.com', '9063041448', 'Block 1 Lot 28 ', 'Saint Martin Executive Homes', 'Bagumbayan', 'Taguig City', 'NCR', '1630', '98a8d3f11b400ddc06d7343375b71a84', 'user'),
(33, 'auriapple', 'irishbtegio@gmail.com', '', '', '', '', '', '', '', '149231476fa672de43683c8f057429f1', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(73, 24, 80, 'Philippine Palmera Pearl Earrings', 430, 'Philippine Palmera Pearl Earrings.png'),
(74, 24, 79, 'Sun & Stars Ear Cuff', 380, 'Sun & Stars Ear Cuff.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_payment`
--
ALTER TABLE `online_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payee`
--
ALTER TABLE `payee`
  ADD PRIMARY KEY (`payee_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `online_payment`
--
ALTER TABLE `online_payment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `payee`
--
ALTER TABLE `payee`
  MODIFY `payee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
