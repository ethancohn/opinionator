-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 30, 2016 at 04:59 AM
-- Server version: 5.6.33
-- PHP Version: 7.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `opinionator_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `convos_following`
--

CREATE TABLE `convos_following` (
  `user_id` int(11) NOT NULL,
  `convo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
