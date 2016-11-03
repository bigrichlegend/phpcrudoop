-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 02, 2016 at 06:44 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
CREATE TABLE `players` (
  `id`        INT(11)     NOT NULL,
  `firstname` VARCHAR(32) NOT NULL,
  `lastname`  VARCHAR(32) NOT NULL
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 17
  DEFAULT CHARSET = utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `firstname`, `lastname`) VALUES
  (1, 'Richard', 'McPherson'),
  (2, 'Llewellyn', 'McPherson'),
  (3, 'George', 'Zumbana'),
  (5, 'Bigrich', 'Legend'),
  (6, 'Mark', 'Allen'),
  (7, 'Jacqueline', 'Bigby'),
  (8, 'Carlton', 'Fuller'),
  (9, 'Stewart', 'Henry'),
  (10, 'Dave', 'Bowen'),
  (11, 'Angella', 'Dimple'),
  (12, 'Pauline', 'Daileigh'),
  (13, 'George', 'True'),
  (14, 'Sans', 'Seriff'),
  (15, 'Arial', 'Raleway');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT = 17;