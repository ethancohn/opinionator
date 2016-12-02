-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 02, 2016 at 03:41 AM
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
  `password` varchar(200) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `country` varchar(50) CHARACTER SET armscii8 COLLATE armscii8_bin NOT NULL DEFAULT 'NOT NULL',
  `avatar` varchar(200) NOT NULL DEFAULT 'img/default/avatar.png',
  `about` varchar(200) NOT NULL,
  `post_count` int(3) NOT NULL,
  `notifications` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;