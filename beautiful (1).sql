-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 01:01 PM
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
-- Database: `beautiful`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_line` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `user_id`, `address_line`, `city`, `state`, `postal_code`, `country`) VALUES
(13, 4, 'Thôn phước thọ 5, aephe, krongpak, dak lak', 'Đắk Lắk', 'Đắk Lắk', '630000', 'Vietnam'),
(14, 4, 'Thôn phước thọ 5, aephe, krongpak, dak lak', 'abc', 'BMT', '630000', 'Vietnam'),
(15, 4, 'Thôn phước thọ 5, aephe, krongpak, dak lak', 'Đắk Lắk', 's', '630000', 'Vietnam'),
(16, 4, '68a Dinh Nup', 'Tan Hoa', 'Đắk Lắk', '2433T32R', 'Vietnam');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 4, '2024-11-24 07:14:48', '2024-11-24 07:14:48'),
(7, 5, '2024-11-29 09:21:42', '2024-11-29 09:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cart_item_id` int(11) NOT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `variant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `image_path`) VALUES
(3, 'Quần áo bé trai', 'https://tse2.mm.bing.net/th?id=OIP.D8qftodXjdmXC2_DIW5JSwHaKY&pid=Api&P=0&h=180'),
(4, 'Quần áo bé gái', 'https://cdn.jadiny.vn/ag030_1-197431252-d636969817432362783.jpg'),
(7, 'Quần áo nam', '../uploads/do-nam-1.png'),
(8, 'Quần áo nữ', '../uploads/do-nu-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL CHECK (`discount_percentage` > 0 and `discount_percentage` <= 100),
  `expiry_date` date DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `code`, `discount_percentage`, `expiry_date`, `is_active`) VALUES
(2, '2hYA25', 20.00, '2024-11-26', 1),
(4, 'DISCOUNT20', 20.00, '2024-11-27', 1),
(5, 'YZ6sw3', 60.00, '2024-11-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Processing','Completed','Cancelled') DEFAULT 'Pending',
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `phone`, `address`, `total`, `order_date`, `status`, `payment_method`) VALUES
(24, 4, 'Triệu Bảo Chương ', '0782554808', 'Thôn phước thọ 5, aephe, krongpak, dak lak', 1492344.00, '2024-11-25 13:56:37', 'Completed', 'COD'),
(25, 5, 'Triệu Bảo Chương ', '(+84) 782 554 8', '', 349300.00, '2024-11-29 16:22:01', 'Pending', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(32, 24, 19, 3, 349300.00),
(33, 24, 20, 1, 444444.00),
(34, 25, 19, 1, 349300.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `quantity`, `category_id`, `image_path`, `size`, `color`) VALUES
(18, 'Bộ pyjama nữ', 'Bộ mặc nhà pyjamas nữ cộc tay quần soóc. Màu sắc, họa tiết nhã nhặn cảnh nghỉ ngơi thư giãn.\r\nNguyên liệu tự nhiên cotton pha spandex mềm mại, co giãn tốt, sử dụng thoải mái dễ chịu.', 349000, 10, 3, '../uploads/bé-gai-1.png', NULL, NULL),
(19, 'Bộ pyjama nam', 'Bộ mặc nhà pyjama nữ áo ngắn tay quần soóc. Phom dáng trẻ trung hiện đại. Màu sắc phong phú thích hợp nhiều lứa tuổi, sử dụng được nhiều hoàn cảnh.\r\nNguyên liệu tự nhiên 100% cotton thoáng mát, mỏng nhẹ, tạo cảm giác dễ chịu khi mặc.', 349300, 10, 4, '../uploads/be-trai-2.png', NULL, NULL),
(20, 'Set quần áo bé gái', 'Quần áo bé gái đẹp', 444444, 1, 4, '../uploads/bé-gái-2.png', NULL, NULL),
(21, 'Set đồ bé trai', 'Set đồ bé trai đẹp', 150000, 24, 3, '../uploads/bé-trai-1.png', NULL, NULL),
(22, 'Quần áo nam ', 'quần áo nam đẹp', 190000, 320000, 7, '../uploads/do-nam-1.png', NULL, NULL),
(23, 'Set quần áo nam', 'set đồ nam đẹp', 124000, 12, 7, '../uploads/do-nam-2.png', NULL, NULL),
(24, 'Áo nữ  đồ bộ đẹp', 'Áo nữ đẹp', 150000, 43, 8, '../uploads/do-nu-1.png', NULL, NULL),
(25, 'Set đồ nữ', 'set đồ nữ đẹp', 150000, 123, 8, '../uploads/do-nu-2.png', NULL, NULL),
(29, 'zeisc2', 'ádsaaaaaaaaaaaaaaaaaa', 1222222, 1, 4, '../uploads/do-nu-2.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_image`
--

CREATE TABLE `products_image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `is_main` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_image`
--

INSERT INTO `products_image` (`image_id`, `product_id`, `image_path`, `is_main`, `created_at`) VALUES
(27, 18, '../uploads/bé-gai-1.png', 1, '2024-11-29 09:08:24'),
(28, 18, '../uploads/do-nu-1.png', 1, '2024-11-29 09:08:24'),
(29, 18, '../uploads/do-nu-2.png', 1, '2024-11-29 09:08:24'),
(33, 19, '../uploads/bé-gai-1.png', 0, '2024-11-29 09:19:23'),
(34, 19, '../uploads/do-nam-1.png', 0, '2024-11-29 09:19:23'),
(35, 19, '../uploads/do-nam-2.png', 0, '2024-11-29 09:19:23'),
(36, 20, '../uploads/bé-gái-2.png', 0, '2024-11-29 09:19:37'),
(37, 20, '../uploads/do-nam-2.png', 0, '2024-11-29 09:19:37'),
(38, 20, '../uploads/do-nu-1.png', 0, '2024-11-29 09:19:37'),
(39, 21, '../uploads/do-nam-1.png', 0, '2024-11-29 09:19:45'),
(40, 21, '../uploads/do-nam-2.png', 0, '2024-11-29 09:19:45'),
(41, 21, '../uploads/do-nu-1.png', 0, '2024-11-29 09:19:45'),
(42, 21, '../uploads/do-nam-1.png', 0, '2024-11-29 09:19:52'),
(43, 21, '../uploads/do-nam-2.png', 0, '2024-11-29 09:19:52'),
(44, 21, '../uploads/do-nu-2.png', 0, '2024-11-29 09:19:52'),
(45, 22, '../uploads/bé-gái-2.png', 0, '2024-11-29 09:19:58'),
(46, 22, '../uploads/do-nam-2.png', 0, '2024-11-29 09:19:58'),
(47, 22, '../uploads/do-nu-1.png', 0, '2024-11-29 09:19:58'),
(48, 23, '../uploads/bé-trai-1.png', 0, '2024-11-29 09:20:07'),
(49, 23, '../uploads/be-trai-2.png', 0, '2024-11-29 09:20:07'),
(50, 23, '../uploads/do-nu-2.png', 0, '2024-11-29 09:20:07'),
(51, 24, '../uploads/bé-gái-2.png', 0, '2024-11-29 09:20:21'),
(52, 24, '../uploads/bé-trai-1.png', 0, '2024-11-29 09:20:21'),
(53, 24, '../uploads/be-trai-2.png', 0, '2024-11-29 09:20:21'),
(54, 25, '../uploads/bé-gái-2.png', 0, '2024-11-29 09:20:27'),
(55, 25, '../uploads/do-nam-2.png', 0, '2024-11-29 09:20:27'),
(56, 25, '../uploads/do-nu-1.png', 0, '2024-11-29 09:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `color` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `product_id`, `size`, `color`, `price`, `stock`) VALUES
(9, 18, 'S', 'red', 349000.00, 10),
(10, 18, 'S', 'blue', 349000.00, 10),
(11, 18, 'S', 'yellow', 349000.00, 10),
(12, 18, 'M', 'red', 349010.00, 10),
(13, 18, 'M', 'blue', 349010.00, 10),
(14, 18, 'M', 'yellow', 349010.00, 10),
(15, 18, 'L', 'red', 349020.00, 10),
(16, 18, 'L', 'blue', 349020.00, 10),
(17, 18, 'L', 'yellow', 349020.00, 10),
(18, 19, 'S', 'red', 349300.00, 10),
(19, 19, 'S', 'blue', 349300.00, 10),
(20, 19, 'S', 'yellow', 349300.00, 10),
(21, 19, 'M', 'red', 349310.00, 10),
(22, 19, 'M', 'blue', 349310.00, 10),
(23, 19, 'M', 'yellow', 349310.00, 10),
(24, 19, 'L', 'red', 349320.00, 10),
(25, 19, 'L', 'blue', 349320.00, 10),
(26, 19, 'L', 'yellow', 349320.00, 10),
(27, 20, 'S', 'red', 444444.00, 10),
(28, 20, 'S', 'blue', 444444.00, 10),
(29, 20, 'S', 'yellow', 444444.00, 10),
(30, 20, 'M', 'red', 444454.00, 10),
(31, 20, 'M', 'yellow', 444454.00, 10),
(32, 20, 'L', 'red', 444464.00, 20),
(33, 20, 'L', 'blue', 444464.00, 10),
(34, 20, 'M', 'yellow', 444454.00, 10),
(35, 20, 'L', 'yellow', 444464.00, 10),
(36, 20, 'M', 'blue', 444454.00, 16);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id_shipping` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `addresss` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `created_at`) VALUES
(4, 'chuong123', '$2y$10$TL2f9Pc9otfFVYNblZH2vO0A12et06grtD7hw1TthaVQOM2cgmThS', 'zeisc2@gmail.com', 'admin', '2024-11-17 09:47:03'),
(5, 'chuong123343', '$2y$10$zY/6hqnsFrwUDIB0GiEIIeNQrlD8TWnBllbu9WRMBbBfK1t50Ndtu', 'chuong123343@gmail.com', 'customer', '2024-11-29 05:52:18'),
(8, 'buivanchau', '$2y$10$mzG/pdZ1ceSithwaTSkviuJcHr/QgBOKRfdhMEvN.Cwgl8lyuYRni', 'chua21@gmailcom', 'customer', '2024-11-30 13:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `user_id`, `name`, `phone`, `address`, `city`, `note`, `created_at`) VALUES
(19, 4, 'Trieu Bao Chuong', '0782554808', '68a Dinh Nup', 'Buôn Ma Thuột', 'dassssssss', '2024-11-24 05:32:00'),
(20, 4, 'Trieu Bao Chuong', '0782554808', '68a Dinh Nup', 'Phú Quốc', '', '2024-11-29 11:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `view_history`
--

CREATE TABLE `view_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `viewed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_image`
--
ALTER TABLE `products_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id_shipping`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `view_history`
--
ALTER TABLE `view_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `products_image`
--
ALTER TABLE `products_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id_shipping` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `view_history`
--
ALTER TABLE `view_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`cart_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `products_image`
--
ALTER TABLE `products_image`
  ADD CONSTRAINT `products_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `view_history`
--
ALTER TABLE `view_history`
  ADD CONSTRAINT `view_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `view_history_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
