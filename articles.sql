-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2020 at 05:05 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(255) NOT NULL,
  `article_name` varchar(255) NOT NULL,
  `article_summary` varchar(550) NOT NULL,
  `article_key` varchar(255) NOT NULL,
  `article_content` blob NOT NULL,
  `article_category` int(255) NOT NULL,
  `article_create` datetime NOT NULL,
  `article_image` varchar(255) NOT NULL,
  `article_unique_key` varchar(10) NOT NULL,
  `article_block` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `article_name`, `article_summary`, `article_key`, `article_content`, `article_category`, `article_create`, `article_image`, `article_unique_key`, `article_block`) VALUES
(33, 'An Article on football', 'Something', '', 0x3c703e536f6d657468696e6720636f6f6c20616e6420736f6d653c2f703e0a, 41, '2020-06-07 17:27:26', 'Profile.jpg', 'a3jo21fwwj', 0),
(34, 'An Article on football2', 'dsadsa', '', 0x3c703e6473616473736473616473616473613c2f703e0a, 41, '2020-06-16 12:00:34', 'Profile.jpg', '4jlyiphu5y', 0),
(35, 'An Article on football3', 'ssadwadwdwa', '', 0x3c703e68657920686f772061726520646f696e673c2f703e0a, 41, '2020-06-16 12:01:47', 'Profile.jpg', '1l6doa02ar', 0),
(36, 'An Article on football4', 'dsadsa', '', 0x3c703e64736164736164736164617364736161777777777777777777777777773c2f703e0a, 41, '2020-06-16 12:02:22', 'Profile.jpg', 'lhi439k913', 0),
(37, 'An Article on football4', 'sdadwwead', '', 0x3c703e64737373736177646177643c2f703e0a, 41, '2020-06-16 12:02:47', 'Profile.jpg', '33wj8ar101', 0),
(38, 'An Article on football5', 'dsads', '', 0x3c703e647361647361647361643c2f703e0a, 41, '2020-06-16 12:03:26', 'Profile.jpg', 'yr2a3jljdp', 0),
(40, 'Test', 'Shouldnt', 'ds,hey', 0x3c703e68656c6c6f7373733c2f703e0a, 41, '2020-06-16 18:01:41', 'Profile.jpg', '1rpjdalpw4', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `article_category` (`article_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`article_category`) REFERENCES `category` (`cat_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
