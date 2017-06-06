-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2016 at 12:41 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `qwickpic`
--

DROP DATABASE IF EXISTS qwickpic;

CREATE DATABASE qwickpic;

-- --------------------------------------------------------
GRANT SELECT, INSERT, DELETE, UPDATE ON qwickpic.*

TO Arthur_Rozenberg@localhost IDENTIFIED BY 'Chris_Dahdouh';

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

USE qwickpic;

CREATE TABLE IF NOT EXISTS `accounts` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
`user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_Name` varchar(255) NOT NULL,
  `last_Name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`username`, `password`, `user_id`, `email`, `first_Name`, `last_Name`) VALUES
('shadowarty', '$2y$05$QiAbmfo4o7C0pzdS8GaDzeJXX5yJODb.EyPTuOgFrKxPeQ/5QNb2a', 1, 'rozenberga1@montclair.edu', 'Brian', 'Moseby'),
('doomsday', '$2y$05$Bo.dQO.wMppZUdMOV.6Y1OhqRknLURo1hTG82WGsZDLLaMMw.Ktb.', 3, 'doomsday170@gmail.com', 'Mario', 'Manning'),
('lebron', '$2y$05$dWPzr1kvDT15Gvm0nl7e0uT3DW5pVPIoLlqNnxyPEkLtIvF9UKwQS', 4, 'browns@gmail.com', 'sfdfdsfd', 'dsfsdfdf');

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE IF NOT EXISTS `admin_accounts` (
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_firstName` varchar(255) NOT NULL,
  `admin_lastName` varchar(255) NOT NULL,
`admin_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`admin_username`, `admin_password`, `admin_firstName`, `admin_lastName`, `admin_id`) VALUES
('rozenberg', '$2y$05$fd53RO4vCrUaS4EwMf5Bq.uT0SVVEHu.Fbs6Tc3Mn0K2yCNCeKK42', 'Arthur', 'Rozenberg', 1),
('dahdouh', '$2y$05$zHP3eNGJkPMk9v1VOhnuOe.TA5yOCsAo.2bAeaWlu8qfaCHOjSv3e', 'Chris', 'Dahdouh', 8);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `album_name` varchar(255) NOT NULL,
  `cover_photo` varchar(255) NOT NULL,
`album_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_name`, `cover_photo`, `album_id`, `user_id`) VALUES
('Montclair', 'Photos/album_cover/montclair.png', 8, 1),
('Sports', 'Photos/album_cover/sports.jpg', 9, 1),
('Beach', 'Photos/album_cover/beach.jpg', 10, 3),
('Food', 'Photos/album_cover/food.jpg', 11, 1),
('Games', 'Photos/album_cover/games.jpg', 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `caption` varchar(255) NOT NULL,
  `source` text NOT NULL,
`picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`caption`, `source`, `picture_id`, `user_id`, `album_id`) VALUES
('University Hall', 'Photos/univhall.jpg', 1, 1, 8),
('CELS', 'Photos/cels.jpg', 2, 1, 8),
('NJ Devils', 'Photos/hockey.jpg', 4, 1, 9),
('Witcher 3', 'Photos/witcher3.jpg', 5, 3, 12),
('Dishonored 2', 'Photos/Dishonored2.jpg', 6, 3, 12),
('Pokemon Moon', 'Photos/pokemon-moon.jpg', 7, 3, 12),
('Fallout 4', 'Photos/Fallout_4.jpg', 8, 3, 12),
('Cheese Burger', 'Photos/hamburger.jpg', 9, 1, 11),
('Entrance', 'Photos/MSU_entry.jpeg', 10, 1, 8),
('Tacos', 'Photos/tacos.jpg', 11, 1, 11),
('USA Soccer', 'Photos/usa_soccer.jpg', 12, 1, 9),
('Red Hawks', 'Photos/msu_redhawks.jpg', 13, 1, 8),
('Donuts', 'Photos/donuts.png', 14, 1, 11),
('Beach Drink', 'Photos/drink.jpg', 16, 3, 10),
('Parasailing', 'Photos/parasailing.jpg', 17, 3, 10),
('Sand Castle', 'Photos/sand castle.jpg', 18, 3, 10),
('New York Knicks', 'Photos/knicks.jpg', 19, 1, 9),
('Call of Duty: Ghosts', 'Photos/Cod Ghosts.jpg', 20, 3, 12),
('Beach VolleyBall', 'Photos/beach_volleyball.jpg', 21, 3, 10),
('Baseball', 'Photos/baseball-pic.jpg', 31, 1, 9),
('pizza', 'Photos/pizza.jpg', 34, 1, 11),
('Filet Minon', 'Photos/filet.jpg', 37, 1, 11),
('New York Jets', 'Photos/sacked.jpg', 38, 1, 9),
('Yogi Berra Museum', 'Photos/Yogi_museum.jpg', 39, 1, 8),
('Sushi Platter', 'Photos/sushi_and_sashimi_for_two.jpg', 40, 1, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
 ADD PRIMARY KEY (`album_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
 ADD PRIMARY KEY (`picture_id`), ADD KEY `user_id` (`user_id`), ADD KEY `album_id` (`album_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
MODIFY `picture_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
ADD CONSTRAINT `user's_albums_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
ADD CONSTRAINT `albums's_pictures_fk` FOREIGN KEY (`album_id`) REFERENCES `album` (`album_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `user's_pictures_fk` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


