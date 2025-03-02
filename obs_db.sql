-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 02, 2025 at 03:53 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `obs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `obs_books`
--

CREATE TABLE `obs_books` (
  `book_id` int NOT NULL,
  `book_title` varchar(255) DEFAULT NULL,
  `book_desc` text,
  `book_file` varchar(255) DEFAULT NULL,
  `book_price` float DEFAULT NULL,
  `book_genre` varchar(255) DEFAULT NULL,
  `book_feature` int DEFAULT NULL,
  `book_thumbnail` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `book_createat` timestamp NULL DEFAULT NULL,
  `book_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_books`
--

INSERT INTO `obs_books` (`book_id`, `book_title`, `book_desc`, `book_file`, `book_price`, `book_genre`, `book_feature`, `book_thumbnail`, `category_id`, `type_id`, `book_createat`, `book_status`) VALUES
(1, 'Napoleon', 'Lawrence James, The Times. Napoleon Bonaparte\'s .. So enthusiastic for Paoli was Boswell that Dr', 'Napoleon_1740718969.pdf', 0, '', 1, 'Napoleon_1740718969.jpg', 9, 1, '2025-02-28 05:02:49', 1),
(2, 'Mother Teresa', 'Fidel Castro: A Biography. Thomas M. Leonard. Oprah Winfrey: A Biography. Helen S. Garson. Mark Twain', 'Mother Teresa_1740719063.pdf', 2, '', 1, 'Mother Teresa_1740719063.jpg', 9, 1, '2025-02-28 05:04:23', 1),
(3, 'Braiding Sweetgrass', 'Braiding_Sweetgrass_-_Robin_Kimmerer.pdf Braiding Sweetgrass ', 'Braiding Sweetgrass_1740736019.pdf', 5, '', 0, 'Braiding Sweetgrass_1740736019.jpg', 11, 1, '2025-02-28 09:46:59', 1),
(4, 'The Complete Yoga Poses', 'Yoga is, indeed, an excellent form of exercise that carries with it many . own sequences of yoga poses,', 'The Complete Yoga Poses_1740736190.pdf', 0, '', 0, 'The Complete Yoga Poses_1740736190.jpg', 14, 1, '2025-02-28 09:49:50', 1),
(5, 'Masters of Science Fiction and Fantasy Art', 'Masters of Science Fiction and Fantasy Art profiles and celebrates the work of today’s leading', 'Masters of Science Fiction and Fantasy Art_1740736612.pdf', 3, '', 0, 'Masters of Science Fiction and Fantasy Art_1740736612.jpg', 1, 1, '2025-02-28 09:56:52', 1),
(6, 'My secret garden: women\'s sexual fantasies', 'of real women responded to Nancy Friday\'s call for details of their own most private fantasies.', 'My secret garden: women\'s sexual fantasies_1740736704.pdf', 0, '', 0, 'My secret garden: women\'s sexual fantasies_1740736704.jpg', 1, 1, '2025-02-28 09:58:24', 0),
(7, 'My_secret_garden', 'of real women responded to Nancy Friday\'s call for details of their own most private fantasies.', 'My_secret_garden_1740737203.pdf', 0, '', 0, 'My_secret_garden_1740737203.jpg', 1, 1, '2025-02-28 10:06:43', 1),
(8, 'On_Writing_Horror', 'The masters of horror have united to teach you the secrets of success in the scariest genre of all', 'On_Writing_Horror_1740751174.pdf', 2.5, '', 1, 'On_Writing_Horror_1740751174.jpg', 2, 1, '2025-02-28 13:59:34', 1),
(9, 'The_Locked_Room_and_Other_Horror_Stories', 'thin woman who moves through a man\'s picture. The boy with the long, dirty fingernails - and a hole in his', 'The_Locked_Room_and_Other_Horror_Stories_1740753186.pdf', 2, '', 1, 'The_Locked_Room_and_Other_Horror_Stories_1740753186.jpg', 2, 1, '2025-02-28 14:33:06', 1),
(10, 'Bedtime_Stories,_Three_Sensual_Tales_of_Love,_Lust_and_Romance', 'Bedtime Stories, Three Sensual Tales of Love, Lust and Romance Aidan Nadia', 'Bedtime_Stories,_Three_Sensual_Tales_of_Love,_Lust_and_Romance_1740822748.pdf', 2, '', 0, 'Bedtime_Stories,_Three_Sensual_Tales_of_Love,_Lust_and_Romance_1740822748.jpg', 5, 1, '2025-03-01 09:52:28', 1),
(11, 'Romancing_Mr._Bridgerton', 'Romancing Mr. Bridgerton (Bridgerton 4) Julia Quinn', 'Romancing_Mr._Bridgerton_1740837095.pdf', 3, '', 1, 'Romancing_Mr._Bridgerton_1740837095.jpg', 5, 1, '2025-03-01 13:51:35', 1),
(12, 'The_Rise_of_Modern_Philosophy', 'Sir Anthony Kenny\'s engaging new multi-volume history of Western philosophy now advances', 'The_Rise_of_Modern_Philosophy_1740837232.pdf', 5, '', 1, 'The_Rise_of_Modern_Philosophy_1740837232.jpg', 10, 1, '2025-03-01 13:53:52', 1),
(13, 'A_World_History_of_Nineteenth-Century_Archaeology', 'Margarita Diaz-Andreu offers an innovative history of archaeology during the nineteenth century', 'A_World_History_of_Nineteenth-Century_Archaeology_1740837334.pdf', 5, '', 1, 'A_World_History_of_Nineteenth-Century_Archaeology_1740837334.jpg', 10, 1, '2025-03-01 13:55:34', 1),
(14, 'Reading_Comprehension_Boosters', 'practices. Reading Comprehension Boosters: 100 Lessons for Building Higher-Level Literacy, Grades', 'Reading_Comprehension_Boosters_1740837562.pdf', 2, '', 1, 'Reading_Comprehension_Boosters_1740837562.jpg', 7, 1, '2025-03-01 13:59:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obs_booktype`
--

CREATE TABLE `obs_booktype` (
  `type_id` int NOT NULL,
  `type_title` varchar(255) DEFAULT NULL,
  `type_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_booktype`
--

INSERT INTO `obs_booktype` (`type_id`, `type_title`, `type_status`) VALUES
(1, 'eBook', 1),
(2, 'physicBook', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obs_categories`
--

CREATE TABLE `obs_categories` (
  `cate_id` int NOT NULL,
  `cate_title` varchar(255) DEFAULT NULL,
  `cate_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_categories`
--

INSERT INTO `obs_categories` (`cate_id`, `cate_title`, `cate_status`) VALUES
(1, 'Fantasy', 1),
(2, 'Horror', 1),
(3, 'Mystery', 1),
(4, 'Science fiction', 1),
(5, 'Romance', 1),
(6, 'Historical fantasy', 1),
(7, 'Literary fiction', 1),
(8, 'Adventure fiction', 1),
(9, 'Autobiography', 1),
(10, 'Historical', 1),
(11, 'Young adult', 1),
(12, 'Kids', 1),
(13, 'Business', 1),
(14, 'Health & Fitness', 1);

-- --------------------------------------------------------

--
-- Table structure for table `obs_comments`
--

CREATE TABLE `obs_comments` (
  `com_id` int NOT NULL,
  `com_date` timestamp NULL DEFAULT NULL,
  `com_text` text,
  `user_id` int DEFAULT NULL,
  `book_id` int NOT NULL,
  `com_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_comments`
--

INSERT INTO `obs_comments` (`com_id`, `com_date`, `com_text`, `user_id`, `book_id`, `com_status`) VALUES
(1, '2025-02-28 10:40:32', 'great book', 2, 1, 1),
(2, '2025-02-28 16:15:36', 'great book ever', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obs_invoice`
--

CREATE TABLE `obs_invoice` (
  `invoice_id` int NOT NULL,
  `invoice_date` timestamp NULL DEFAULT NULL,
  `invoice_total` float NOT NULL,
  `invoice_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_invoice`
--

INSERT INTO `obs_invoice` (`invoice_id`, `invoice_date`, `invoice_total`, `invoice_status`) VALUES
(1, '2025-03-01 02:30:24', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obs_invoice_detail`
--

CREATE TABLE `obs_invoice_detail` (
  `invd_id` int NOT NULL,
  `invoice_id` int DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `plan_id` int DEFAULT NULL,
  `invd_price` float DEFAULT NULL,
  `invd_discount` int DEFAULT NULL,
  `invd_amount` float DEFAULT NULL,
  `invd_remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_invoice_detail`
--

INSERT INTO `obs_invoice_detail` (`invd_id`, `invoice_id`, `book_id`, `plan_id`, `invd_price`, `invd_discount`, `invd_amount`, `invd_remark`) VALUES
(1, 1, 2, NULL, 2, NULL, 2, '242305KJASKL'),
(2, 1, 3, NULL, 5, NULL, 5, '242305KJ90990L');

-- --------------------------------------------------------

--
-- Table structure for table `obs_plans`
--

CREATE TABLE `obs_plans` (
  `plan_id` int NOT NULL,
  `plan_title` varchar(255) DEFAULT NULL,
  `plan_desc` text,
  `plan_days` int DEFAULT NULL,
  `plan_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_plans`
--

INSERT INTO `obs_plans` (`plan_id`, `plan_title`, `plan_desc`, `plan_days`, `plan_status`) VALUES
(1, 'lifetime', 'lifetime access', 3650, 1),
(2, 'rent', 'monthly access for premium books', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `obs_rating`
--

CREATE TABLE `obs_rating` (
  `rate_id` int NOT NULL,
  `rate_date` timestamp NULL DEFAULT NULL,
  `rate_num` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `book_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `obs_roles`
--

CREATE TABLE `obs_roles` (
  `role_id` int NOT NULL,
  `role_title` varchar(255) DEFAULT NULL,
  `role_status` int DEFAULT NULL,
  `role_createat` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_roles`
--

INSERT INTO `obs_roles` (`role_id`, `role_title`, `role_status`, `role_createat`) VALUES
(1, 'admin', 1, '2025-02-25 14:23:23'),
(2, 'subscribe', 1, '2025-02-25 14:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `obs_users`
--

CREATE TABLE `obs_users` (
  `user_id` int NOT NULL,
  `user_no` varchar(255) DEFAULT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` text,
  `user_bio` text,
  `user_confirmcode` varchar(255) DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `user_status` int DEFAULT NULL,
  `user_createat` timestamp NULL DEFAULT NULL,
  `user_updateat` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_users`
--

INSERT INTO `obs_users` (`user_id`, `user_no`, `user_firstname`, `user_lastname`, `user_email`, `user_password`, `user_bio`, `user_confirmcode`, `role_id`, `user_status`, `user_createat`, `user_updateat`) VALUES
(1, '820413a8-1774-4af5-9858-280c363f9c06', 'thaiheng', NULL, 'thaihenghai@gmail.com', '$2y$10$EwOU7LJ5RPkgnbZDUFEzqeW6VSb/.Tf2dWnjjctSW5QrSspBEk6Nm', NULL, NULL, 1, 1, '2025-02-28 05:15:35', NULL),
(2, '846b6132-9266-4b79-9f7d-1eed39c00521', 'admin', NULL, 'admin@example.com', '$2y$10$g5DeqBS8F2qo96HEK/pk6eFvLTOvVrModLOsBavtHxUUh4UGydvPG', NULL, NULL, 1, 1, '2025-02-28 10:28:36', '2025-02-28 10:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `obs_usersorder`
--

CREATE TABLE `obs_usersorder` (
  `order_id` int NOT NULL,
  `order_date` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `invoice_id` int DEFAULT NULL,
  `order_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `obs_usersorder`
--

INSERT INTO `obs_usersorder` (`order_id`, `order_date`, `user_id`, `invoice_id`, `order_status`) VALUES
(1, '2025-03-01 02:30:24', 1, 1, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obs_books`
--
ALTER TABLE `obs_books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `obs_booktype`
--
ALTER TABLE `obs_booktype`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `obs_categories`
--
ALTER TABLE `obs_categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `obs_comments`
--
ALTER TABLE `obs_comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `obs_invoice`
--
ALTER TABLE `obs_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `obs_invoice_detail`
--
ALTER TABLE `obs_invoice_detail`
  ADD PRIMARY KEY (`invd_id`);

--
-- Indexes for table `obs_plans`
--
ALTER TABLE `obs_plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `obs_rating`
--
ALTER TABLE `obs_rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `obs_roles`
--
ALTER TABLE `obs_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `obs_users`
--
ALTER TABLE `obs_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `obs_usersorder`
--
ALTER TABLE `obs_usersorder`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obs_books`
--
ALTER TABLE `obs_books`
  MODIFY `book_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `obs_booktype`
--
ALTER TABLE `obs_booktype`
  MODIFY `type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obs_categories`
--
ALTER TABLE `obs_categories`
  MODIFY `cate_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `obs_comments`
--
ALTER TABLE `obs_comments`
  MODIFY `com_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obs_invoice`
--
ALTER TABLE `obs_invoice`
  MODIFY `invoice_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `obs_invoice_detail`
--
ALTER TABLE `obs_invoice_detail`
  MODIFY `invd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obs_plans`
--
ALTER TABLE `obs_plans`
  MODIFY `plan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obs_rating`
--
ALTER TABLE `obs_rating`
  MODIFY `rate_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obs_roles`
--
ALTER TABLE `obs_roles`
  MODIFY `role_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obs_users`
--
ALTER TABLE `obs_users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obs_usersorder`
--
ALTER TABLE `obs_usersorder`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
