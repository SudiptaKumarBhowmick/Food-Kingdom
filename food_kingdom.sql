-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2018 at 06:30 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food kingdom`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_ID` int(11) NOT NULL,
  `customerName` varchar(25) NOT NULL,
  `customerAddress` varchar(30) NOT NULL,
  `customerPhone` int(11) NOT NULL,
  `customerAge` int(3) NOT NULL,
  `customerEmail` varchar(20) NOT NULL,
  `NoOfOrder` int(4) DEFAULT NULL,
  `userPoint` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_ID`, `customerName`, `customerAddress`, `customerPhone`, `customerAge`, `customerEmail`, `NoOfOrder`, `userPoint`) VALUES
(1, 'abc', 'dhaka', 123456789, 21, 'abc@gmail.com', 1, 1),
(2, 'dfg', 'tangail, Bangladesh', 1254789, 25, 'dfg@gmail.com', 1, 1),
(3, 'selim', 'dhamrai, dhaka', 124578, 15, 'selim@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `ID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `food_Category` varchar(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `availability` varchar(15) NOT NULL,
  `rating` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`ID`, `name`, `food_Category`, `code`, `image`, `price`, `availability`, `rating`) VALUES
(1, 'Burger', 'Fast Food', '32dFRGTi', 'product-images/food1.jpg', 180.00, 'available', 4),
(2, 'Pizza', 'Fast Food', 'dgT487IU', 'product-images/food2.jpg', 750.00, 'available', 4),
(3, 'Lunch', 'Lunch', '25RTyIOp', 'product-images/food3.jpg', 580.00, 'available', 4),
(4, 'Juice', 'Drinks', '456ReTY', 'product-images/food4.jpg', 100.00, 'available', 3),
(5, 'Chips', 'Fast Food', '5987FRTy', 'product-images/food5.jpg', 100.00, 'available', 3),
(6, 'Dessert', 'Desserts', '578RTY4i', 'product-images/food6.jpg', 250.00, 'available', 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_food`
--

CREATE TABLE `order_food` (
  `OrderID` int(11) NOT NULL,
  `food_ID` int(11) NOT NULL,
  `food_Name` varchar(40) NOT NULL,
  `food_Price` int(11) NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `processor_ID` int(11) DEFAULT NULL,
  `supplier_ID` int(11) DEFAULT NULL,
  `supplierName` varchar(25) DEFAULT NULL,
  `orderDelivery` varchar(25) DEFAULT NULL,
  `orderLocation` varchar(100) DEFAULT NULL,
  `orderDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_food`
--

INSERT INTO `order_food` (`OrderID`, `food_ID`, `food_Name`, `food_Price`, `customer_ID`, `processor_ID`, `supplier_ID`, `supplierName`, `orderDelivery`, `orderLocation`, `orderDateTime`) VALUES
(8, 4, 'Juice', 100, 1, 1, 1, 'rahim', 'Delivered', 'Narayanganj, Bangladesh', '2018-06-19 01:00:35'),
(14, 1, 'Burger', 180, 1, 1, 4, 'samir', 'NotDelivered', 'Narayanganj, Bangladesh', '2018-07-16 09:48:22'),
(17, 6, 'Dessert', 250, 1, 1, 2, 'karim', 'Delivered', 'Orion Informatics Limited, Road No.7, Dhaka, Bangladesh', '2018-07-22 07:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `processor`
--

CREATE TABLE `processor` (
  `processor_ID` int(2) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Age` int(2) NOT NULL,
  `Address` varchar(35) NOT NULL,
  `Phone` varchar(11) NOT NULL,
  `Email` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `processor`
--

INSERT INTO `processor` (`processor_ID`, `Name`, `Age`, `Address`, `Phone`, `Email`) VALUES
(1, 'sudipta', 22, 'Dhaka, Bangladesh', '123456789', 's@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_ID` int(11) NOT NULL,
  `supplierName` varchar(25) NOT NULL,
  `supplierAge` int(2) NOT NULL,
  `supplierPhone` int(11) NOT NULL,
  `supplierEmail` varchar(20) NOT NULL,
  `DeliveryState` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_ID`, `supplierName`, `supplierAge`, `supplierPhone`, `supplierEmail`, `DeliveryState`) VALUES
(1, 'rahim', 23, 1457896, 'rahim@rahim.com', 'NotInDelivery'),
(2, 'karim', 24, 1254698, 'karim@karim.com', 'NotInDelivery'),
(3, 'salman', 19, 2547983, 'salman@salman.com', 'NotInDelivery'),
(4, 'samir', 22, 1459873, 'samir@samir.com', 'InDelivery');

-- --------------------------------------------------------

--
-- Table structure for table `tracelocation`
--

CREATE TABLE `tracelocation` (
  `ID` int(10) NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `supplier_ID` int(11) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_authentication`
--

CREATE TABLE `user_authentication` (
  `email` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `customer_ID` int(11) DEFAULT NULL,
  `processor_ID` int(11) DEFAULT NULL,
  `supplier_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_authentication`
--

INSERT INTO `user_authentication` (`email`, `pass`, `customer_ID`, `processor_ID`, `supplier_ID`) VALUES
('abc@gmail.com', 'abc', 1, NULL, NULL),
('dfg@gmail.com', 'dfg', 2, NULL, NULL),
('karim@karim.com', 'karim', NULL, NULL, 2),
('rahim@rahim.com', 'rahim', NULL, NULL, 1),
('s@gmail.com', 'sudipta', NULL, 1, NULL),
('salman@salman.com', 'salman', NULL, NULL, 3),
('samir@samir.com', 'samir', NULL, NULL, 4),
('selim@gmail.com', 'selim', 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_ID`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `order_food`
--
ALTER TABLE `order_food`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `food_ID` (`food_ID`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `processor_ID` (`processor_ID`),
  ADD KEY `supplier_ID` (`supplier_ID`);

--
-- Indexes for table `processor`
--
ALTER TABLE `processor`
  ADD PRIMARY KEY (`processor_ID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_ID`);

--
-- Indexes for table `tracelocation`
--
ALTER TABLE `tracelocation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_authentication`
--
ALTER TABLE `user_authentication`
  ADD PRIMARY KEY (`email`),
  ADD KEY `customer_ID` (`customer_ID`),
  ADD KEY `processor_ID` (`processor_ID`),
  ADD KEY `supplier_ID` (`supplier_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_food`
--
ALTER TABLE `order_food`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `processor`
--
ALTER TABLE `processor`
  MODIFY `processor_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tracelocation`
--
ALTER TABLE `tracelocation`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_food`
--
ALTER TABLE `order_food`
  ADD CONSTRAINT `order_food_ibfk_1` FOREIGN KEY (`food_ID`) REFERENCES `food` (`ID`),
  ADD CONSTRAINT `order_food_ibfk_2` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`customer_ID`),
  ADD CONSTRAINT `order_food_ibfk_3` FOREIGN KEY (`processor_ID`) REFERENCES `processor` (`processor_ID`),
  ADD CONSTRAINT `order_food_ibfk_4` FOREIGN KEY (`supplier_ID`) REFERENCES `supplier` (`supplier_ID`);

--
-- Constraints for table `user_authentication`
--
ALTER TABLE `user_authentication`
  ADD CONSTRAINT `user_authentication_ibfk_1` FOREIGN KEY (`customer_ID`) REFERENCES `customer` (`customer_ID`),
  ADD CONSTRAINT `user_authentication_ibfk_2` FOREIGN KEY (`processor_ID`) REFERENCES `processor` (`processor_ID`),
  ADD CONSTRAINT `user_authentication_ibfk_3` FOREIGN KEY (`supplier_ID`) REFERENCES `supplier` (`supplier_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
