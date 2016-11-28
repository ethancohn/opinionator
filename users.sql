-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 28, 2016 at 05:53 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `opinionator_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `password` varchar(20) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `country` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `convos_following` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `country`, `convos_following`) VALUES
(14, 'e', '$2y$10$K3ofQAIzmD3Tg', 'Afghanistan', NULL),
(15, 'r', 'c', 'Afghanistan', NULL),
(16, 'tony', 'chen', 'Afghanistan', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `username_3` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
