-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2016 at 10:37 PM
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
(1, 222, 'rrerer', ':username', 'hrjgkhak'),
(3, 60, 'hello', 'jeffrey', 'I hate comp307'),
(4, 1, 'wow', 'tony', 'tthis is cool'),
(5, 1, 'hello', 'tony', 'max'),
(8, 5, 'populate', 'tony', 'hey whats up'),
(9, 5, 'populate', 'tony', 'wow im talking to myself'),
(10, 5, 'populate', 'tony', 'how are you doing'),
(11, 5, 'populate', 'tony', 'yo wow'),
(12, 5, 'populate', 'tony', 'wow this is sick'),
(13, 5, 'populate', 'tony', 'pls work');

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
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;