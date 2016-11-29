-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2016 at 02:47 AM
-- Server version: 5.7.13-0ubuntu0.16.04.2
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opinionator_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `convo_id` int(11) NOT NULL,
  `convo_name` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `username` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `msg_body` varchar(10000) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `convo_id`, `convo_name`, `username`, `msg_body`) VALUES
(1, 6, 'maxi', 'jeffrey', 'hrjgkhak'),
(3, 6, 'maxi', 'jeffrey', 'I hate comp307'),
(4, 3, 'wow', 'tony', 'tthis is cool'),
(5, 2, 'hello', 'tony', 'max'),
(8, 5, 'populate', 'tony', 'hey whats up'),
(9, 5, 'populate', 'tony', 'wow im talking to myself'),
(10, 5, 'populate', 'tony', 'how are you doing'),
(11, 5, 'populate', 'tony', 'yo wow'),
(12, 5, 'populate', 'tony', 'wow this is sick'),
(14, 5, 'populate', 'tony', 'damn right it worked'),
(15, 5, 'populate', 'tony', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus rem, accusantium placeat animi ut perferendis culpa recusandae, incidunt, aliquam numquam cum deleniti facilis laboriosam autem quam maiores molestias quasi, ab?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus rem, accusantium placeat animi ut perferendis culpa recusandae, incidunt, aliquam numquam cum deleniti facilis laboriosam autem quam maiores molestias quasi, ab?'),
(16, 4, 'yo', 'tony', 'test'),
(19, 1, 'max', 'tony', 'what up'),
(20, 1, 'max', 'tony', 'up'),
(21, 1, 'max', 'tony', 'test'),
(23, 6, 'maxi', 'tony', 'cmon'),
(24, 6, 'maxi', 'tony', 'nice'),
(25, 3, 'wow', 'tony', 'wow'),
(26, 4, 'yo', 'tony', 'does this work?'),
(27, 2, 'hello', 'tony', 'wut?'),
(28, 3, 'wow', 'tony', 'hi'),
(29, 1, 'max', 'tony', 'EVERYTIME'),
(30, 2, 'hello', 'tony', ''),
(32, 4, 'yo', 'tony', 'what da fuq'),
(33, 3, 'wow', 'tony', 'whyyyy'),
(35, 5, 'populate', 'tony', 'yo'),
(36, 4, 'yo', 'tony', 'wuuuuuuuuut'),
(41, 4, 'yo', 'tony', 'yoyoyoyoyo'),
(42, 4, 'yo', 'tony', 'hello'),
(43, 2, 'hello', 'tony', 'weerrrkkk'),
(44, 2, 'hello', 'tony', 'goddamn');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;