-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 22, 2023 at 10:03 PM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `marsfeed_db`
--
CREATE DATABASE IF NOT EXISTS `marsfeed_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `marsfeed_db`;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` varchar(400) NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`id`, `username`, `comment`, `post_id`) VALUES
(1, 'Arlen Donovan', 'Please keep posting, I love your content!', 1),
(2, 'Izabelle Colbert', 'I hope nothing bad will happen... ', 1),
(3, 'Melissa Parnel', 'What they won\'t invent, just incredible', 3),
(10, 'Laura James', 'wauuuuuuuuu', 2),
(12, 'Laura James', 'boom', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `picture_path` varchar(200) NOT NULL,
  `is_hearted` tinyint(1) DEFAULT NULL,
  `total_hearts` int DEFAULT NULL,
  `is_bookmarked` tinyint(1) DEFAULT NULL,
  `total_bookmarks` int DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Posts`
--

INSERT INTO `Posts` (`id`, `username`, `picture_path`, `is_hearted`, `total_hearts`, `is_bookmarked`, `total_bookmarks`, `description`, `title`, `date_time`) VALUES
(1, 'Jeff Foust', 'images/rocketlaunch.jpg', 1, 30, 1, 3, 'A Crew Dragon spacecraft is headed towards the International Space Station three days after a technical problem scrubbed its first launch attempt.', 'Crew-6 launches to space station', '2023-03-02 17:07:35'),
(2, 'Jeff Foust', 'images/parachute.jpg', 0, 35, 0, 4, 'he Electron booster, descending under a parachute (right), as seen from the helicopter as it attempted to grapple the parachute. The helicopter released the booster moments later, though.', 'Rocket Lab reconsidering mid-air recovery of Electron boosters', '2023-03-01 15:08:29'),
(3, 'Jason Rainbow', 'images/apple_phone.jpg', 0, 10, 0, 1, 'Apple’s iPhone 14 is currently able to send emergency messages via Globalstar satellites from the United States, Canada, France, Germany, Ireland, and the U.K.', 'Apple lends Globalstar $252 million for satellite-enabled iPhones', '2023-02-28 17:09:14'),
(4, 'Sandra Erwin', 'images/hybrid_Buildings.jpg', 0, 0, 0, 0, 'The U.S. Army has extended its contract with Maxar Technologies to provide 3D geospatial data used to create immersive digital environments.', 'U.S. Army extends Maxar’s contract for 3D geospatial data', '2023-02-27 17:10:30'),
(5, 'Jeff Foust', 'images/spaceport-company.jpg', 0, 50, 0, 0, 'A startup is proposing one solution to the increasing congestion at major launch sites: build mobile launch pads that operate at sea.', 'Startup developing sea-based launch pads', '2023-02-26 10:10:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_id` (`post_id`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `fk_post_id` FOREIGN KEY (`post_id`) REFERENCES `Posts` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
