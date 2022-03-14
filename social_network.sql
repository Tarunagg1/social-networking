-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 14, 2022 at 03:38 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_content` longtext NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numarical_time` int(255) NOT NULL,
  `parent` varchar(1200) DEFAULT NULL,
  `is_display` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `user_id`, `comment_content`, `posting_date`, `numarical_time`, `parent`, `is_display`) VALUES
(2, 36, 4, '9u8y7t65r', '2020-06-27 08:51:08', 1593247868, 'NULL', 1),
(3, 36, 4, 'ou8y7t6', '2020-06-27 08:51:36', 1593247896, 'NULL', 1),
(4, 36, 4, 'l,kjihuygtfr', '2020-06-27 08:54:01', 1593248041, 'NULL', 1),
(5, 36, 4, 'sdd', '2020-06-27 08:56:16', 1593248176, 'NULL', 1),
(6, 36, 4, 'doi9u8y7t6r5de', '2020-06-27 08:56:23', 1593248183, 'NULL', 1),
(7, 36, 4, 'thgis sis teug7y', '2020-06-27 08:57:35', 1593248255, 'NULL', 1),
(8, 7, 4, 'koi9u8y7t6rd', '2020-06-28 08:13:50', 1593332030, 'NULL', 1),
(9, 36, 4, 'thsi sisuhdd b  ib  ihbef fihb v iuv eih juh32 cg32 ch3 chuybhc hc2cbc uchcu cuh cuhcch cjuhcc cjuh4 chc c4juhbcc uhc ccch ci4 ch c', '2020-06-28 08:44:37', 1593333877, 'NULL', 1),
(10, 36, 4, 'this is tarun', '2020-06-28 09:08:42', 1593335322, 'NULL', 1),
(11, 36, 4, 'sss', '2020-06-28 09:09:46', 1593335386, 'NULL', 1),
(12, 36, 4, 'hahahha', '2020-06-28 09:10:27', 1593335427, 'NULL', 1),
(13, 35, 4, 'hjahha', '2020-06-28 09:10:51', 1593335451, 'NULL', 1),
(14, 35, 4, 'this is ttttt', '2020-06-28 09:11:37', 1593335497, 'NULL', 1),
(15, 1, 4, 'hahaahhaha', '2020-06-30 11:35:20', 1593516920, 'NULL', 1),
(16, 37, 4, 'ss', '2020-07-01 10:45:18', 1593600318, 'NULL', 1),
(17, 37, 4, 'sss', '2020-07-01 10:45:53', 1593600353, 'NULL', 1),
(18, 37, 4, 'ssssssss', '2020-07-01 10:45:59', 1593600359, 'NULL', 1),
(19, 37, 4, 'ssssss', '2020-07-01 10:46:03', 1593600363, 'NULL', 1),
(20, 37, 4, 'sssssssssssssssssssssssssssssssssssssss', '2020-07-01 10:46:10', 1593600370, 'NULL', 1),
(21, 37, 4, 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '2020-07-01 10:46:17', 1593600377, 'NULL', 1),
(22, 36, 4, 'oi98uy7t6rd', '2020-07-01 10:48:20', 1593600500, 'NULL', 1),
(23, 5, 4, 'oi9u8y7t6re', '2020-07-01 10:48:30', 1593600510, 'NULL', 1),
(24, 37, 4, 'okiu8y7t6rd', '2020-07-01 10:59:22', 1593601162, 'NULL', 1),
(25, 37, 4, 'tttttttttttttttttt', '2020-07-01 11:01:50', 1593601310, 'NULL', 1),
(26, 37, 4, 'ijuytrde', '2020-07-01 11:04:28', 1593601468, 'NULL', 1),
(27, 37, 4, 'oiu8y7t', '2020-07-01 11:07:45', 1593601665, 'NULL', 1),
(28, 37, 4, 'iuy7t65rde', '2020-07-01 11:08:43', 1593601723, 'NULL', 1),
(29, 37, 4, 'ijuytfrd', '2020-07-01 11:09:08', 1593601748, 'NULL', 1),
(30, 37, 4, 'jiuytfrd', '2020-07-01 11:10:00', 1593601800, 'NULL', 1),
(31, 37, 4, 'ijuytfrd', '2020-07-01 11:10:15', 1593601815, 'NULL', 1),
(32, 36, 4, 'i9u8y7t6fr', '2020-07-01 11:10:37', 1593601837, 'NULL', 1),
(33, 36, 4, 'i9u876t5r4es', '2020-07-01 11:10:40', 1593601840, 'NULL', 1),
(34, 37, 4, '9u87654e', '2020-07-01 12:19:55', 1593605995, 'NULL', 1),
(35, 36, 4, 'www', '2020-07-05 08:07:29', 1593936449, 'NULL', 1),
(36, 37, 4, 'Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled pa', '2020-07-05 09:00:51', 1593939651, 'NULL', 1),
(37, 37, 4, 'okiuytrde', '2020-07-05 10:15:59', 1593944159, 'NULL', 1),
(38, 36, 4, 'jiuhygtfr', '2020-07-05 10:16:07', 1593944167, 'NULL', 1),
(39, 36, 4, 'sssssss', '2020-07-05 10:20:38', 1593944438, 'NULL', 1),
(40, 36, 4, 'sss', '2020-07-05 10:20:41', 1593944441, 'NULL', 1),
(41, 36, 4, 'sss', '2020-07-05 10:20:43', 1593944443, 'NULL', 1),
(42, 38, 4, '9iu87y6t5r', '2020-07-06 11:32:20', 1594035140, 'NULL', 1),
(43, 38, 15, 'koijuhygt', '2020-07-06 11:33:02', 1594035182, 'NULL', 1),
(44, 38, 4, 'ijuhytfr', '2020-07-06 12:00:51', 1594036851, 'NULL', 1),
(45, 40, 4, 'ijuytrd', '2020-07-15 08:51:09', 1594803069, 'NULL', 1),
(46, 37, 4, 'thjinouhh oknu ijnbu jnuib  ', '2020-07-20 11:38:24', 1595245104, 'NULL', 1),
(47, 51, 4, 'mijuhygtfcd', '2020-08-02 11:30:48', 1596367848, 'NULL', 1),
(48, 51, 4, 'u8y76t5', '2020-08-02 11:31:06', 1596367866, 'NULL', 1),
(49, 50, 4, 'kjhgf', '2020-08-02 11:31:09', 1596367869, 'NULL', 1),
(50, 48, 4, 'okjiuytfr', '2020-08-02 11:31:14', 1596367874, 'NULL', 1),
(51, 48, 4, 'kijuhygtfr', '2020-08-02 11:31:39', 1596367899, 'NULL', 1),
(52, 47, 4, 'liuhygt', '2020-08-02 11:31:46', 1596367906, 'NULL', 1),
(53, 45, 4, ',lkoijhuygtf', '2020-08-02 11:33:40', 1596368020, 'NULL', 1),
(54, 37, 4, 'hehrzsssssssssssssss', '2020-08-02 11:37:34', 1596368254, 'NULL', 1),
(55, 53, 4, 'okijuhygt', '2020-08-08 11:44:18', 1596887058, 'NULL', 1),
(56, 51, 4, 'oi9u8y7t6', '2020-08-08 12:11:52', 1596888712, 'NULL', 1),
(57, 66, 4, 'ijuhygt', '2020-08-08 12:16:56', 1596889016, 'NULL', 1),
(58, 53, 4, 'okiuy', '2020-08-08 12:32:39', 1596889959, 'NULL', 1),
(59, 53, 4, '0o9876t5r', '2020-08-08 12:32:41', 1596889961, 'NULL', 1),
(60, 52, 4, 'oi9u8y7t6r5e', '2020-08-08 12:38:20', 1596890300, 'NULL', 1),
(61, 53, 4, 'oi9u8y', '2020-08-08 12:38:27', 1596890307, 'NULL', 1),
(62, 68, 4, 'okiuygt', '2020-08-08 12:38:33', 1596890313, 'NULL', 1),
(63, 52, 4, 'ploiuhyg', '2020-08-08 12:39:23', 1596890363, 'NULL', 1),
(64, 68, 4, 'koiuygtfr', '2020-08-08 13:03:13', 1596891793, 'NULL', 1),
(65, 72, 4, 'pokiuygtf', '2020-08-08 13:03:22', 1596891802, 'NULL', 1),
(66, 76, 4, 'ploiuytf ', '2020-08-09 10:58:36', 1596970716, 'NULL', 1),
(67, 49, 4, 'i098uy76tfrd', '2020-08-10 09:07:27', 1597050447, 'NULL', 1),
(68, 75, 15, 'hj79g8g8f7', '2020-09-25 06:35:32', 1601015731, 'NULL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend_request`
--

DROP TABLE IF EXISTS `friend_request`;
CREATE TABLE IF NOT EXISTS `friend_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `from_id` (`from_id`,`to_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_request`
--

INSERT INTO `friend_request` (`id`, `from_id`, `to_id`, `date`, `status`, `is_active`) VALUES
(74, 15, 4, '2020-07-08 09:11:47', 'aprove', 1),
(78, 4, 14, '2020-07-10 11:51:00', 'aprove', 1),
(102, 16, 4, '2020-08-09 10:57:47', 'aprove', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend_table`
--

DROP TABLE IF EXISTS `friend_table`;
CREATE TABLE IF NOT EXISTS `friend_table` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `friend_req_table` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `secreat_key` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `status` varchar(110) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_from` (`user_from`,`user_to`) USING BTREE,
  KEY `friend_req_table` (`friend_req_table`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_table`
--

INSERT INTO `friend_table` (`id`, `friend_req_table`, `user_from`, `user_to`, `date`, `secreat_key`, `is_active`, `status`) VALUES
(8, 74, 15, 4, '2020-07-08 09:14:30', 'e526081dc406646bd0104a2bb9588672', 1, 'friend'),
(9, 78, 4, 14, '2020-07-10 11:52:10', '2d52683e145d86a4027400f849227115', 1, 'friend'),
(12, 102, 16, 4, '2020-08-09 10:57:59', 'c63feeaca204aa9c29c9c7b026add033', 1, 'friend');

-- --------------------------------------------------------

--
-- Table structure for table `like_table`
--

DROP TABLE IF EXISTS `like_table`;
CREATE TABLE IF NOT EXISTS `like_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `post_id` varchar(110) NOT NULL,
  `action` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_table`
--

INSERT INTO `like_table` (`id`, `user_id`, `post_id`, `action`, `date`, `is_active`) VALUES
(15, '15', '38', 'like', '2020-07-06 12:00:31', 1),
(19, '4', '39', 'like', '2020-07-09 05:17:59', 1),
(20, '4', '38', 'like', '2020-07-09 05:18:10', 1),
(21, '4', '40', 'like', '2020-07-15 08:51:07', 1),
(25, '4', '37', 'like', '2020-07-20 11:38:11', 1),
(26, '4', '47', 'like', '2020-07-21 11:58:12', 1),
(33, '4', '46', 'like', '2020-07-21 11:58:37', 1),
(71, '4', '53', 'like', '2020-08-08 12:28:21', 1),
(77, '4', '68', 'like', '2020-08-08 13:03:10', 1),
(82, '4', '76', 'like', '2020-08-09 10:58:31', 1),
(87, '4', '49', 'like', '2020-08-10 09:07:24', 1),
(89, '15', '75', 'like', '2020-09-25 06:35:29', 1),
(91, '4', '75', 'like', '2020-11-21 11:25:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `friend_id` int(11) DEFAULT NULL,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(100) NOT NULL,
  `time_numerical` int(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enc_dcrypt_id` varchar(200) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `friend_id`, `sender_id`, `reciver_id`, `message`, `status`, `time_numerical`, `date`, `enc_dcrypt_id`, `is_active`) VALUES
(1, 9, 4, 14, 'JsS1HINdD8arYsHZbmWypGXhJW3+ZpdCtw==', 'unread', 1594890949, '2020-07-16 09:15:49', '2d52683e145d86a4027400f849227115', 1),
(2, 9, 4, 14, 'OGjSe3BVFgpbEnU1hxSsNW1bZwyjm+smfw==', 'unread', 1594890953, '2020-07-16 09:15:53', '2d52683e145d86a4027400f849227115', 1),
(3, 9, 4, 14, 'aOboO78f2LpTtXgFuuuhpr/1m5mBHM0m5q4=', 'unread', 1594892431, '2020-07-16 09:40:31', '2d52683e145d86a4027400f849227115', 1),
(4, 9, 4, 14, 'XkDnFWfNDGe5y+mDoNrKFhFZcINvS0Wo/g==', 'unread', 1595337316, '2020-07-21 13:15:16', '2d52683e145d86a4027400f849227115', 1),
(5, 9, 4, 14, 'lZLaG/uwx/T12c/y98jzjyO4Yc0qgd0Dstbp', 'unread', 1595760232, '2020-07-26 10:43:52', '2d52683e145d86a4027400f849227115', 1),
(6, 12, 4, 16, 'vQulkD1/Tnef0gpGhsaxxcLKeQiqEWwwLA==', 'read', 1597061484, '2020-08-10 12:11:24', 'c63feeaca204aa9c29c9c7b026add033', 1),
(7, 12, 16, 4, 'BxgOs/kr/rOVoLEpEiggBE84omjp', 'read', 1605958237, '2020-11-21 11:30:37', 'c63feeaca204aa9c29c9c7b026add033', 1),
(8, 12, 4, 16, 'VHmtxLbEf6AgKvdEJ//SJKSSRQ==', 'read', 1605958244, '2020-11-21 11:30:44', 'c63feeaca204aa9c29c9c7b026add033', 1),
(9, 12, 16, 4, 'q0Iix0YkJM7pB+bb9gk1GL71FQ==', 'read', 1605958259, '2020-11-21 11:30:59', 'c63feeaca204aa9c29c9c7b026add033', 1),
(10, 12, 16, 4, 'tSxu6GRl/ONFBZNPBsqxDsYtzNhi6u6HNRw=', 'read', 1611674973, '2021-01-26 15:29:33', 'c63feeaca204aa9c29c9c7b026add033', 1),
(11, 12, 4, 16, 'tIR6MDs3ntb3ZPdaHKnmxh+VLA==', 'read', 1611674992, '2021-01-26 15:29:52', 'c63feeaca204aa9c29c9c7b026add033', 1),
(12, 12, 4, 16, 'VWbY6GPV1kUL+9Ji8O2Rg2RJpA==', 'read', 1611675012, '2021-01-26 15:30:12', 'c63feeaca204aa9c29c9c7b026add033', 1),
(13, 12, 4, 16, '1al6n+dILaqDts7KwQBEG/U8Kg==', 'read', 1611675053, '2021-01-26 15:30:53', 'c63feeaca204aa9c29c9c7b026add033', 1),
(14, 12, 4, 16, '7bBE+kGax0IXoDy1S7wfiIVjnw==', 'read', 1611675069, '2021-01-26 15:31:09', 'c63feeaca204aa9c29c9c7b026add033', 1),
(15, 12, 4, 16, '4qreoTg5biPNI7EgDQVHSvOqk+MQo2Y6+kCagRE=', 'read', 1611675099, '2021-01-26 15:31:39', 'c63feeaca204aa9c29c9c7b026add033', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_form_id` varchar(11) DEFAULT NULL,
  `notification_to_id` int(11) DEFAULT NULL,
  `message` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_numerical` int(50) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `notification_form_id`, `notification_to_id`, `message`, `date`, `time_numerical`, `is_active`) VALUES
(1, '6', 4, 'lpoiuydrtxfhjoppiu p[oiugyt p-=o0i9u8yg poiuyg toiugy ', '2020-07-15 18:30:00', 6559959, 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_number` text NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` varchar(100) DEFAULT NULL,
  `user_img` varchar(100) DEFAULT NULL,
  `user_cover_img` varchar(250) DEFAULT NULL,
  `is_active` int(100) NOT NULL DEFAULT '0',
  `user_regdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updation` varchar(100) DEFAULT NULL,
  `user_otp` varchar(100) DEFAULT NULL,
  `user_bio` varchar(110) DEFAULT NULL,
  `user_lastseen` int(100) DEFAULT NULL,
  `user_login` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`,`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`user_id`, `username`, `user_email`, `user_number`, `user_password`, `user_gender`, `user_birthday`, `user_img`, `user_cover_img`, `is_active`, `user_regdate`, `user_updation`, `user_otp`, `user_bio`, `user_lastseen`, `user_login`) VALUES
(4, 'tarun aggarwal', 'tarun@gmail.com', '8510967005', '4ec6b242322a0139def69c6380c7aa27', 'male', '2020-06-17', 'temp-user.png', '9713d3e30be4096f6520df83b1c91147.jpeg', 1, '2020-06-06 16:56:18', NULL, 'c372f3e64cac0d07fb6064196b76400d', 'tarun\ndreamer\nthinker | haok\nsimple living high thinking.', 1614097980, '0'),
(10, 'tarun6', 'tarun6@gmail.com', '123456789', 'tarun', 'male', 'NULL', NULL, NULL, 0, '2020-06-12 16:13:37', NULL, NULL, '', NULL, NULL),
(11, 'tarun7', 'tarun7@gmail.com', '123456789', 'tarun', 'male', NULL, NULL, NULL, 0, '2020-06-12 16:13:49', NULL, NULL, '', NULL, NULL),
(12, 'varun', 'tarun1@gmai9.com', '123456789', 'tarun', 'male', NULL, NULL, NULL, 0, '2020-06-12 16:14:36', NULL, NULL, '', NULL, NULL),
(13, 'karun', 'tarun89@gmail.com', '123456789', 'tarun', 'male', NULL, NULL, NULL, 0, '2020-06-12 16:14:51', NULL, NULL, '', NULL, NULL),
(14, 'karan aggarwal', 'karan@gmail.com', '8510967005', '4ec6b242322a0139def69c6380c7aa27', 'male', '2020-06-16', '63ce5df4a6b95d049b47c7d6b67e7c4b.png', 'blackbener.jpg', 1, '2020-06-17 18:24:51', NULL, '3716c676882bb2064822a8b83e75c04b', NULL, 1596885008, '0'),
(15, 'arun', 'arunaggarwal096@gmail.com', '8510967005', '4ec6b242322a0139def69c6380c7aa27', 'male', '2020-07-08', '8a2fa9292906834823a624cbe0cd0887.png', 'blackbener.jpg', 1, '2020-07-06 16:17:47', NULL, '737837b32d575b410654dda9a96c3a99', 'thi shu lkjo\n', 1596892088, '1'),
(16, 'shruti', 'shrutisharma@gmail.com', '8549698710', 'eab6930b3c87b22874b40a0e52fe1ca3', 'female', '2020-07-14', 'temp-user.png', 'blackbener.jpg', 1, '2020-07-24 17:10:05', NULL, '82edbee63af251924002a8d9327a1e39', NULL, 1611675831, '0'),
(17, 'priyanka', 'priyanka@gmail.com', '1234567890', '1fd96777aedeadb325c66f3780054765', 'female', '2021-01-20', 'temp-user.png', 'blackbener.jpg', 0, '2021-01-26 20:54:46', NULL, '1c7094989f2d417a3726bec44cacbae1', NULL, NULL, '1'),
(18, 'arun1', 'aggtarun4@gmail.com', '1234567899', '58d6a4dbf3ac275fc1a1dbcdac61df67', 'male', '2021-02-11', 'temp-user.png', 'blackbener.jpg', 0, '2021-02-23 22:01:05', NULL, '3309da13ee0a5ef6eecd4a2bc210c448', NULL, NULL, NULL),
(19, 'tarunagg', 'tarunagg@gmail.com', '1234567899', '9129ec202f254acf9522bfb03bf6afb2', 'male', '2022-03-18', 'd55c8cb79eaf42a9246e77ecb123842c.png', '33bb91822257e22b7e21a58964f915ea.jpeg', 1, '2022-03-14 21:00:45', NULL, 'f170ac7c5337503e2fc62d1864bf78de', 'ojfvijfiojiojreoifjeroi', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
CREATE TABLE IF NOT EXISTS `stories` (
  `story_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `story_img` varchar(255) NOT NULL,
  `story_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `story_time_numrical` int(100) NOT NULL,
  `valid_till` int(100) NOT NULL,
  `story_isvalid` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`story_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`story_id`, `user_id`, `story_img`, `story_time`, `story_time_numrical`, `valid_till`, `story_isvalid`) VALUES
(1, 4, '96d6f2e7e1f705ab5e59c84a6dc009b2.png', '2020-08-06 08:09:19', 1596701359, 1596787759, 0),
(2, 4, 'fd456406745d816a45cae554c788e754.jpg', '2020-08-06 08:21:16', 1596702076, 1596788476, 0),
(3, 4, '21433bd5fe1c28b9afd98227a45a1055.png', '2020-08-06 08:35:07', 1596702907, 1596789307, 0),
(4, 4, '96d6f2e7e1f705ab5e59c84a6dc009b2.png', '2020-08-07 08:34:28', 1596789268, 1596875668, 0),
(6, 4, '21433bd5fe1c28b9afd98227a45a1055.png', '2020-08-07 08:39:22', 1596789562, 1596875962, 0),
(7, 4, 'fd456406745d816a45cae554c788e754.jpg', '2020-08-07 09:29:44', 1596792584, 1596878984, 0),
(8, 4, '2402bb5ad72179a5c4ec0d42e2b7eba0.jpg', '2020-08-07 10:50:17', 1596797417, 1596883817, 0),
(9, 14, '74e8333ad11685ff3bdae589c8f6e34d.jpg', '2020-08-07 10:54:40', 1596797679, 1596884079, 0),
(10, 14, '21433bd5fe1c28b9afd98227a45a1055.png', '2020-08-07 11:00:26', 1596798026, 1596884426, 0),
(11, 4, '74e8333ad11685ff3bdae589c8f6e34d.jpg', '2020-08-07 11:04:46', 1596798286, 1596884686, 0),
(12, 4, '30fcacb70938c9b6a78e49ba379cd250.png', '2020-08-07 14:17:05', 1596809825, 1596896225, 0),
(13, 16, '875e5f8948f6e2d89c7262bea09d0de5.jpg', '2020-08-09 11:15:33', 1596971733, 1597058133, 0),
(14, 16, '6d57089352cff55241af0ecc52e1d8e0.png', '2020-08-09 11:17:00', 1596971820, 1597058220, 0),
(15, 4, 'b27696a5788739425c9acfe24c254d9c.jpg', '2020-08-09 11:17:12', 1596971832, 1597058232, 0),
(16, 4, '30fcacb70938c9b6a78e49ba379cd250.png', '2020-08-09 13:47:47', 1596980866, 1597067266, 0),
(17, 19, '33bb91822257e22b7e21a58964f915ea.jpeg', '2022-03-14 15:32:49', 1647271969, 1647358369, 1),
(18, 19, 'a3dc19fa55e50dfa00fa73f1ffeb830d.jpeg', '2022-03-14 15:33:04', 1647271984, 1647358384, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

DROP TABLE IF EXISTS `user_post`;
CREATE TABLE IF NOT EXISTS `user_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_content` longtext,
  `post_img` varchar(250) DEFAULT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time` int(200) DEFAULT NULL,
  `hide_timeline` int(11) NOT NULL DEFAULT '1',
  `post_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`post_id`, `user_id`, `post_content`, `post_img`, `post_date`, `time`, `hide_timeline`, `post_active`) VALUES
(1, 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fringilla venenatis eros, et aliquet leo dignissim vitae. Donec ornare ut arcu at sodales. Aliquam erat volutpat. Integer quis ligula sed neque viverra interdum. Morbi dapibus nisi in dapibus egestas. Integer eget molestie justo. Donec libero sapien, accumsan non porttitor id, volutpat sed sapien. In elementum dolor vel pharetra pellentesque.\n\nAenean pharetra mattis nisl, in rutrum diam convallis a. Vivamus pretium et ante sed dapibus. Phasellus tortor neque, maximus id tincidunt ut, tristique sit amet dui. Sed quam enim, laoreet eget vulputate nec, luctus vel arcu. Vivamus non hendrerit mi. Nulla fringilla odio molestie, egestas odio ut, faucibus orci. Pellentesque velit libero, interdum facilisis erat in, efficitur auctor sem. Integer nec vestibulum nisi. Pellentesque enim sem, fringilla et consequat semper, dapibus nec velit. Vivamus posuere mattis efficitur. Nulla sit amet velit sit amet eros facilisis viverra. Maecenas in justo tempus, convallis ante eu, pharetra nibh. Sed non pulvinar massa. Mauris sit amet odio bibendum, faucibus ex vel, sollicitudin risus.', 'image_01.jpg', '2020-06-19 09:20:02', 1592558402, 1, 1),
(5, 4, '=p-o0i9u8yt765ro0-987t6', 'profile1.jpg', '2020-06-23 13:33:46', 1593161946, 1, 1),
(7, 4, 'In vehicula aliquet ex, ac euismod nisl sodales vitae. Cras lobortis metus non lobortis dapibus. Vivamus auctor enim quis tristique sollicitudin. Vivamus rhoncus, sem a egestas dignissim, odio ligula sollicitudin quam, sit amet feugiat velit turpis nec libero. Phasellus ac turpis tincidunt, sagittis purus in, bibendum augue. Ut id mauris nisi. Vivamus imperdiet dui vitae luctus ultrices. Quisque a dapibus risus. Integer nisi augue, malesuada sit amet ultricies vel, commodo ac nulla. Curabitur cursus faucibus est in lobortis. Pellentesque ut nunc erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer auctor sagittis maximus. Nullam viverra, dui eget blandit iaculis, diam risus eleifend purus, id eleifend nisi nulla quis sapien.', 'NULL', '2020-06-23 14:51:59', 1592923919, 1, 1),
(35, 4, '6t5rfdcss  cd', 'avatar7.png', '2020-06-24 12:33:58', 1593418706, 1, 1),
(36, 4, 'this is  tarun aggarwal uhygt kjnhby nijuby njibh oinu ionub oin ub knjbh oknji njoiokijuyt utvyrevbnbtvrcec uhytcrerdtfgyh koi9u8y79ij8uh7 plokij koiuy j8h 8uh 7tgf 7f v6f vuy g76tf tg bg7g 7g uy', 'imgban.jpg', '2020-06-26 07:42:02', 1595244915, 1, 1),
(37, 4, 'hrhhrssssssss', 'Banner1.jpeg', '2020-06-30 11:33:25', 1593677273, 1, 1),
(38, 15, 'p[koiu89y7t654e iug67 uybv b87bu 7by y 7utb\nm mm', 'NULL', '2020-07-06 11:29:44', 1594035023, 1, 1),
(39, 4, '-0o8765\n', 'NULL', '2020-07-09 05:17:46', 1594271866, 1, 1),
(40, 4, 'lpkojihugycf', '7.png', '2020-07-13 08:21:12', 1594628472, 1, 1),
(44, 4, '', '1543408957_agents-dealers.png', '2020-07-21 10:02:58', 1595325778, 1, 1),
(45, 4, '', '1543409062_message-beauty.png', '2020-07-21 11:53:33', 1595332413, 1, 1),
(46, 4, 'lkoijhuyg oiuby knjbh ijouh oijubh njobh nojh  mkonjhb ', '551290610_art-craft.png', '2020-07-21 11:54:06', 1595332446, 1, 1),
(47, 4, '', '1543409150_import-export.png', '2020-07-21 11:54:39', 1595332479, 1, 1),
(48, 4, 'po0i98uy7t6 0oi9u8t675 -o0i9u8y7 6toipuyg to0[iu y ploiuygt', 'NULL', '2020-07-25 08:31:49', 1595665909, 1, 1),
(49, 16, 'hucsyuvvl niu honmoi h h j ipo', 'NULL', '2020-07-25 09:14:08', 1595668448, 1, 1),
(50, 4, '', '3.png', '2020-07-27 09:27:33', 1595842053, 1, 1),
(51, 4, '', '1112.png', '2020-07-27 09:28:15', 1595842094, 1, 1),
(52, 14, 'this isnjib nbuyt uhnby tvyu bytv yib 7t ', 'NULL', '2020-08-08 10:34:16', 1596882856, 1, 1),
(53, 14, '9iu0y7t6 8uy76t 98uhyg ', 'NULL', '2020-08-08 10:36:42', 1596883002, 1, 1),
(54, 4, 'ploiu8y76t i-09u8y7gtf0-i9u87yt kpoijuhygtf ', 'NULL', '2020-08-08 10:37:35', 1596883055, 1, 1),
(55, 4, '-=o0i9u8y76 =-po0i9u8y =-o0i9huy p-0iouy', 'NULL', '2020-08-08 10:48:28', 1596883708, 1, 1),
(56, 4, 'B. Tech Admissions Open For 2020 Batch at Bennett University (Times of India Group). Learning through Internships, Live Projects & Curriculum designed by Industry Experts. Industry Ready Programs designed by Experts. Faculties from IITs & Global Institutions. Highest CTC 44 lac pa for placement 2020. Apply Based on 12th, JEE Or SAT Score. Get Upto 100% Scholarship.\n\n', 'NULL', '2020-08-08 10:53:32', 1596884012, 1, 1),
(57, 4, 'ploiuhygt 0oi9u87y i98uyt ', 'NULL', '2020-08-08 10:54:38', 1596884078, 1, 1),
(58, 4, 'ploiuhygt i0-98u7y ', 'NULL', '2020-08-08 10:57:03', 1596884223, 1, 1),
(66, 4, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'NULL', '2020-08-08 11:10:19', 1596885019, 1, 1),
(67, 4, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 'NULL', '2020-08-08 11:12:48', 1596885168, 1, 1),
(68, 4, 'cccccccccccccccccccccccccccccccccccccccccccccccccccc', 'NULL', '2020-08-08 11:15:58', 1596885358, 1, 1),
(72, 15, '=p-o0i98uy7t', 'NULL', '2020-08-08 12:57:40', 1596891460, 1, 1),
(73, 15, '-p]o0i9u87t6r\n', 'NULL', '2020-08-08 13:03:41', 1596891821, 1, 1),
(74, 15, 'vvvvvvvvvvvvvvvvvvvvv vvvvvvvvvvvvvvvvvvvv vvvvvvvvvvvvvvvvvvvvvvvvv vvvvvvvvvvvvvvvvvvvv', 'NULL', '2020-08-08 13:04:00', 1596891840, 1, 1),
(75, 15, '', 'cpp-program1.png', '2020-08-08 13:04:43', 1596891883, 1, 1),
(76, 16, '-po0i9u87gyt =-po0i9uhyt ', 'NULL', '2020-08-09 10:58:19', 1596970699, 1, 1),
(77, 4, 'this is hacking', 'hack2.jpg', '2020-11-21 11:28:14', 1605958094, 1, 1),
(78, 4, 'this is for testong', 'NULL', '2021-01-26 15:18:09', 1611674289, 1, 1),
(79, 4, 'final', '308515058_post-bg.jpg', '2021-01-26 15:18:49', 1611674329, 1, 1),
(80, 19, 'iohsdviushoivoivhjwe89vh98vhuid', 'headphone1.jpeg', '2022-03-14 15:31:58', 1647271918, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profession` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `user_post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `friend_table`
--
ALTER TABLE `friend_table`
  ADD CONSTRAINT `friend_table_ibfk_1` FOREIGN KEY (`friend_req_table`) REFERENCES `friend_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`friend_id`) REFERENCES `friend_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stories`
--
ALTER TABLE `stories`
  ADD CONSTRAINT `stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_post`
--
ALTER TABLE `user_post`
  ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `registration` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
