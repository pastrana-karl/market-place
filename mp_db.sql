-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 07:37 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `submissionDate` date NOT NULL,
  `feedback` text NOT NULL,
  `suggestions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `name`, `submissionDate`, `feedback`, `suggestions`) VALUES
(30, 'IC', '2021-10-27', 'excellent', 'Calandria '),
(31, 'KG', '2021-10-28', 'neutral', ' Its alright');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetId`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(32, 'UOC.Management@gmail.com', 'e005aeaa3d952dbf', '$2y$10$iJEmNYkDfqSEWW8o2eIcheOPWHj4y2KHiZ/87eqgRYZvtst/BM1Pi', '1621158887');

-- --------------------------------------------------------

--
-- Table structure for table `securitylog`
--

CREATE TABLE `securitylog` (
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `securitylog`
--

INSERT INTO `securitylog` (`id`, `username`, `name`, `password`) VALUES
(1, 'marketordering69@gmail.com', 'MP_Admin', '$2y$10$8kmdYx0H6XUvCVfvE36AoucTNTUJvtancM6IcGCKmwiQ.XS2fbzFq');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`) VALUES
(20, 'Coffee'),
(21, 'Non-Coffee'),
(22, 'Frappe (Coffee - Based)'),
(23, 'Ice Blend (Cream - Based)'),
(24, 'Pizza'),
(25, 'Pasta'),
(26, 'Meals'),
(27, 'Snacks'),
(28, 'Pastries'),
(29, 'Cakes'),
(38, 'HEHEHEHE'),
(39, 'Bacon Bits');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_ID` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `order_items` varchar(255) NOT NULL,
  `paymentmode` varchar(100) NOT NULL,
  `order_date` datetime NOT NULL,
  `cart_total` decimal(10,2) NOT NULL,
  `order_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_ID`, `name`, `email`, `phonenumber`, `address`, `city`, `region`, `order_items`, `paymentmode`, `order_date`, `cart_total`, `order_status`) VALUES
(214, 'a', 'a@asdfl.com', 'a', '123', 'sda', 'asd', 'Espresso(3), AHAY(9)', 'Cash On Delivery', '2021-10-27 10:49:04', '4710.00', 'Pending'),
(215, 'a', 'a@asdf.com', 'a', 'a', 'a', 'a', 'AHAY(6)', 'Cash On Delivery', '2021-10-28 09:12:13', '3000.00', 'Pending'),
(216, 'a', 'a@asd.com', 'a', 'a', 'a', 'a', 'AHAY(4)', 'Cash On Delivery', '2021-10-28 09:16:42', '2000.00', 'Pending'),
(217, 'b', 'b@gmail.com', 'b', 'b', 'b', 'b', 'AHAY(5)', 'Cash On Delivery', '2021-10-29 04:43:07', '2500.00', 'Pending'),
(218, 'Mark', 'mark.uy69011@gmail.com', '09876546321', '108 ilang ilang St. Brgy. 1 Morning', 'Caloocan', 'Metro Manila', 'AHAY(2)', 'Cash On Delivery', '2021-11-15 02:17:29', '1000.00', 'Ordered');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `description` varchar(225) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `featured` varchar(10) CHARACTER SET utf8 NOT NULL,
  `active` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(96, 'AHAY', 'HAHAHA', '500.00', '', 22, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersPwd`) VALUES
(18, 'IC', 'i@g.com', '$2y$10$o7VNOsD7fe7d6o0cMtFC.e95HitMA4toOH4TH5tRr7QTbxbme55Dq'),
(19, 'John', 't@t.com', '$2y$10$BKt3WiCJ3kyGiO66OtUqvuBOdqTPs5lYoxwfTd/buNd6qiGeRqZK2'),
(20, 'mark', 'mark.uy69011@gmail.com', '$2y$10$8CFiJW48zkf.4fb9HFBhne4.BqQ8TDLahSjr/lFUmwPVkFJdOV8iy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `securitylog`
--
ALTER TABLE `securitylog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_ID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `securitylog`
--
ALTER TABLE `securitylog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
