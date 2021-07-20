-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2021 at 08:08 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(10) NOT NULL,
  `article_title` varchar(256) NOT NULL,
  `article_subtitle` varchar(256) NOT NULL,
  `article_content` varchar(2048) NOT NULL,
  `userID` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `post_date` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `article_title`, `article_subtitle`, `article_content`, `userID`, `category_id`, `post_date`) VALUES
(22, 'Worsening air quality raises public health concerns amid pandemic', 'As air pollution soars to a record high level, making Kathmandu the most polluted city in the world, doctors and government urge members of the public to exercise caution', 'On Monday evening, Kathmandu Valley was found to be the most polluted city in the world.\r\n\r\nEven before this unwelcome record was registered, the people of Kathmandu had already seen the adverse effects of air pollution on their health.\r\n\r\nThe number of people visiting Bir Hospital complaining of respiratory problems, in addition to those testing positive for the coronavirus, has increased significantly in the past five days, according to doctors at the hospital.\r\n\r\n“The number of coronavirus infected people seeking treatment at the hospital used to be 20 to 25 every day earlier, but this has increased to 35 to 40 for the last five days,” Dr Ashesh Dhungana, a pulmonologist at the hospital, told the Post.\r\n\r\n“Patients seeking treatment for other respiratory illnesses like chronic obstructive pulmonary disease and asthma have also risen these days.”\r\n\r\nThe worsening air quality of Kathmandu Valley could be one of the reasons behind a sharp increase in respiratory problems including the severity in patients infected with the coronavirus, according to doctors.\r\n\r\nKathmandu Valley’s air quality worsened to a record level on Monday.\r\n\r\nAQ AirVisual, a Swiss group that collects real-time air-quality data from around the world, ranked Kathmandu as the most polluted city in the world with PM2.5 levels reaching 488 micrograms per cubic meter (μg/m3) at 5:45pm at Ratnapark station as per the United States Environmental Protection Agency (EPA) Air Quality Index.\r\n\r\nPM 2.5 refers to particulate matter, or solid and liquid droplets in the air, that is less than 2.5 micrometres, or 400th of a millimetre, in diameter.', 15, 16, 1610910362),
(23, 'Nepal’s Covid-19 toll reaches 1,959 with five more deaths; national tally reaches 267,322 with 266 new infections', 'According to the Health Ministry, 3,508 PCR tests were performed in the past 24 hours', 'Nepal on Sunday reported five more Covid-19-related fatalities, pushing the death toll to 1,959. The country also recorded 266 new cases.\r\n\r\nThe overall infection tally has reached 267,322 with 3,919 active cases.\r\n\r\nAccording to the Ministry of Health and Population, 261,444 infected people have recovered from the disease so far; of them 400 in the past 24 hours.\r\n\r\nKathmandu Valley recorded 177 new infections in the past 24 hours. Of them, 145 cases were confirmed in Kathmandu, 23 in Lalitpur and nine in Bhaktapur.\r\n\r\nAs of Sunday, the number of confirmed cases in the Valley has reached 124,798. While Kathmandu has reported 487 Covid-19-related fatalities so far, Lalitpur and Bhaktapur have recorded 156 and 113 deaths respectively.\r\n\r\nAccording to the ministry, 973 individuals from Bagmati Province, 257 from Lumbini Province, 224 from Province 1, 218 from Province 2, 195 from Gandaki Province, 65 from Sudurpaschim Province, and 27 from Karnali Province have died of Covid-19 so far.\r\n\r\nAs of Sunday, 2,012,452 PCR tests have been carried out across the country.\r\n\r\nA total of 3,508 PCR tests were performed in the past 24 hours, according to the data released by the ministry.', 15, 7, 1610910210);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Technology'),
(5, 'Politics'),
(7, 'News'),
(15, 'Business'),
(16, 'Health');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `comment_value` varchar(1024) NOT NULL,
  `author_id` int(10) NOT NULL,
  `article_id` int(10) NOT NULL,
  `comment_time` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_value`, `author_id`, `article_id`, `comment_time`) VALUES
(24, 'good news 👍', 6, 20, 1610900430),
(25, 'hello\r\n', 6, 19, 1610904509),
(31, 'hello my 1st comment\r\n', 15, 22, 1610908777),
(32, 'hello my second comment', 15, 22, 1610909330),
(33, 'test', 15, 22, 1610909465),
(34, 'test', 15, 22, 1610909468);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(128) NOT NULL,
  `userID` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `userType` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `userID`, `username`, `email`, `password`, `userType`) VALUES
('Administrator', 15, 'admin', 'admin@admin.com', 'admin', 'admin'),
('User1', 16, 'user', 'user@gmail.com', 'user', 'user'),
('user2', 17, 'user2', 'user2@gmail.com', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
