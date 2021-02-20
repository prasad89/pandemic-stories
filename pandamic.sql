-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2021 at 07:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pandamic`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `u_id` int(11) NOT NULL,
  `th_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`u_id`, `th_id`) VALUES
(33, 1057),
(33, 1058),
(30, 1061),
(29, 1061);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `c_content` text NOT NULL,
  `c_parent` int(11) DEFAULT NULL,
  `c_code` text DEFAULT NULL,
  `th_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `c_content`, `c_parent`, `c_code`, `th_id`, `comment_by`, `timestamp`) VALUES
(1, 'dfhdfghd', NULL, '', 1064, 29, '2021-02-20 12:19:18'),
(2, 'dfgdfgd', 1, '', 1064, 29, '2021-02-20 12:19:25'),
(3, 'sdfsdf', NULL, '', 1062, 29, '2021-02-20 12:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `comment_rating`
--

CREATE TABLE `comment_rating` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_rating`
--

INSERT INTO `comment_rating` (`c_id`, `u_id`, `info`) VALUES
(1, 29, 'like'),
(2, 29, 'dislike'),
(3, 29, 'dislike');

-- --------------------------------------------------------

--
-- Table structure for table `follow_topic`
--

CREATE TABLE `follow_topic` (
  `u_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow_topic`
--

INSERT INTO `follow_topic` (`u_id`, `t_id`) VALUES
(29, 103);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `n_id` int(11) NOT NULL,
  `n_title` text NOT NULL,
  `news` text NOT NULL,
  `n_source` varchar(255) NOT NULL,
  `timestamp` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `p_id` int(11) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `bio` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `sfp` text NOT NULL,
  `u_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `th_id` int(11) NOT NULL,
  `th_title` varchar(255) NOT NULL,
  `th_description` text NOT NULL,
  `th_code` text DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `fdownloads` int(11) DEFAULT NULL,
  `fsize` int(11) DEFAULT NULL,
  `th_t_id` int(11) NOT NULL,
  `th_u_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`th_id`, `th_title`, `th_description`, `th_code`, `fname`, `fdownloads`, `fsize`, `th_t_id`, `th_u_id`, `timestamp`) VALUES
(1057, 'How to stop a virus from spreading', '', '', 'corona-2.mp4', 0, 53562, 102, 29, '2021-01-30 17:35:14'),
(1058, '101 year old man, born during the Spanish flu, has beaten Covid-19 in Italy', '<p><a href=\"https://www.today.it/attualita/coronavirus-guarisce-101-anni-rimini.html\">source</a></p>', '', NULL, NULL, NULL, 103, 29, '2021-01-30 18:00:38'),
(1059, 'Pfizer Covid vaccine 95% effective and passes all safety checks, final analysis shows', '<p>The companies have developed specially designed, temperature-controlled thermal shippers utilizing dry ice to maintain temperature conditions of -70&deg;C&plusmn;10&deg;C. They can be used be as temporary storage units for 15 days by refilling with dry ice. Each shipper contains a GPS-enabled thermal sensor to track the location and temperature of each vaccine shipment across their pre-set routes leveraging Pfizer&rsquo;s broad distribution network.<a href=\"https://www.independent.co.uk/news/health/pfizer-covid-vaccine-safety-coronavirus-b1724874.html\">source</a></p>', '', NULL, NULL, NULL, 103, 29, '2021-01-30 18:03:02'),
(1060, 'One third of adults shows signs of depressions or anxiety due to covid-19', '<p>read the full new<a href=\"https://www.hcplive.com/view/one-third-adults-show-signs-depression-anxiety-covid-19\"> here</a></p>', '', NULL, NULL, NULL, 101, 30, '2021-01-30 18:08:40'),
(1061, 'Here is a pdf document containing tips to relif stress happening due to corona virus.', '', '', 'coping-with-stress.pdf', 5, 52879, 101, 31, '2021-01-30 18:10:44'),
(1062, 'Resourceful links to fight depression!', '<p>Below are listed recommended resources for users who wish to read more about&nbsp;<a target=\"_blank\" href=\"https://patient.info/mental-health/depression-leaflet\">depression</a>, get self help, treatments etc. Users can also post the link to this discussion in any replies to guide users to this info. The post will not go for moderation as it is an internal link. The link to post is&nbsp;<a target=\"_blank\" href=\"https://patient.info/forums/discuss/depression-resources-298570\">https://patient.info/forums/discuss/depression-resources-298570</a></p><p>&nbsp;</p><p><strong>Samaritans website</strong></p><p><a target=\"_blank\" href=\"http://www.samaritans.org/\">http://www.samaritans.org</a>/</p><p>&nbsp;</p><p><strong>Depression health centre</strong></p><p><a target=\"_blank\" href=\"https://patient.info/depression\">https://patient.info/depression</a></p><p>A central hub with links to depression articles, videos, blogs support groups etc.</p><p>&nbsp;</p><p><strong>Coming off antidepressants leaflet</strong></p><p><a target=\"_blank\" href=\"https://patient.info/health/depression-leaflet/antidepressants\">https://patient.info/health/depression-leaflet/antidepressants</a></p><p>&nbsp;</p><p><strong>Reducing ADs using 10% withdrawal method</strong></p><p><a target=\"_blank\" href=\"http://survivingantidepressants.org/index.php?/topic/1024-why-taper-by-10-of-my-dosage/?&amp;gopid=16335#entry16335\">http://survivingantidepressants.org/index.php?/topic/1024-why-taper-by-10-of-my-dosage/?&amp;gopid=16335#entry16335</a></p><p>&nbsp;</p><p><strong>Suicidal thoughts leaflet</strong></p><p><a target=\"_blank\" href=\"https://patient.info/health/depression-leaflet/suicidal-thoughts\">https://patient.info/health/depression-leaflet/suicidal-thoughts</a></p><p>A leaflet with advice for people having suicidal thoughts and also for relatives/friends. It includes several contact details for relevant groups such as The Samaritans and others.</p>', '', NULL, NULL, NULL, 101, 30, '2021-02-15 14:01:31'),
(1064, 'Is this \"Breathe Easy\" Mask Enhancer safe?', '<p>Hello, I saw this new apparatus and wondering if it will be safe to use it please?</p><p>https://getcoolturtle.com</p>', '', NULL, NULL, NULL, 102, 31, '2021-02-15 14:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `thread_rating`
--

CREATE TABLE `thread_rating` (
  `th_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thread_rating`
--

INSERT INTO `thread_rating` (`th_id`, `u_id`, `info`) VALUES
(1057, 29, 'dislike'),
(1057, 31, 'dislike'),
(1057, 32, 'like'),
(1057, 33, 'dislike'),
(1058, 29, 'like'),
(1058, 30, 'like'),
(1058, 31, 'like'),
(1058, 32, 'dislike'),
(1059, 29, 'like'),
(1059, 30, 'like'),
(1059, 31, 'dislike'),
(1059, 32, 'like'),
(1059, 33, 'dislike'),
(1060, 31, 'like'),
(1060, 32, 'like'),
(1060, 33, 'like'),
(1061, 31, 'like'),
(1061, 32, 'dislike'),
(1061, 33, 'like'),
(1062, 30, 'like'),
(1064, 29, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `t_id` int(8) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_description` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`t_id`, `t_name`, `t_description`, `timestamp`) VALUES
(101, 'anxiety/saddness', 'This topic deals with mental health issues like anxiety, depression happened due to covid-19 pandamic', '2021-01-29 10:19:31'),
(102, 'Awareness', 'This topic is spread awareness about coid-19 and what precautions to take.', '2021-01-30 17:31:00'),
(103, 'news', 'This topic share news related to covid-19', '2021-01-30 17:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `verified` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_pass`, `timestamp`, `verified`) VALUES
(29, 'tushar@111.com', '$2y$10$hFuCgRUn/a06awok0wvTCOb.RxRCBZXKT8bI.KcY0LNwHJhu/YvJm', '2021-01-29 10:19:48', NULL),
(30, 'nehal@111.com', '$2y$10$LmYN5hC7OPS2cs4mfbrHS.rjLbxqhNr0.fUfMwy3oR/GhxifveUxO', '2021-01-30 18:05:08', 'yes'),
(31, 'paras@111.com', '$2y$10$WPOxbM935tTLQpKxhIMh..PI2H2RXKJXGIkO3ONdzbfXVpcmcyMHa', '2021-01-30 18:09:40', NULL),
(32, 'vikas@111.com', '$2y$10$EzMjAfSWNoh8EdIsUHkBC.mTNWEq45WOLpl7txzgGeGDi6GgH/T1S', '2021-01-30 18:16:11', NULL),
(33, 'vivek@111.com', '$2y$10$uTouxaSA1MuZy0KYpWwFB.qXZQMXaYOITVSYWXGhWfCD2X7rwTm4a', '2021-01-30 18:20:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD KEY `th_id` (`th_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `th_id` (`th_id`),
  ADD KEY `comment_by` (`comment_by`);

--
-- Indexes for table `comment_rating`
--
ALTER TABLE `comment_rating`
  ADD UNIQUE KEY `c_id` (`c_id`) USING BTREE,
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `follow_topic`
--
ALTER TABLE `follow_topic`
  ADD PRIMARY KEY (`u_id`,`t_id`),
  ADD KEY `t_id` (`t_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `u_id` (`u_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`th_id`),
  ADD KEY `th_u_id` (`th_u_id`),
  ADD KEY `threads_ibfk_2` (`th_t_id`);
ALTER TABLE `threads` ADD FULLTEXT KEY `th_title` (`th_title`,`th_description`);

--
-- Indexes for table `thread_rating`
--
ALTER TABLE `thread_rating`
  ADD UNIQUE KEY `th_id` (`th_id`,`u_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `th_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1070;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `t_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`th_id`) REFERENCES `threads` (`th_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`th_id`) REFERENCES `threads` (`th_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_by`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment_rating`
--
ALTER TABLE `comment_rating`
  ADD CONSTRAINT `comment_rating_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `comments` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_rating_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow_topic`
--
ALTER TABLE `follow_topic`
  ADD CONSTRAINT `follow_topic_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `follow_topic_ibfk_2` FOREIGN KEY (`t_id`) REFERENCES `topics` (`t_id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `threads`
--
ALTER TABLE `threads`
  ADD CONSTRAINT `threads_ibfk_1` FOREIGN KEY (`th_u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `threads_ibfk_2` FOREIGN KEY (`th_t_id`) REFERENCES `topics` (`t_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread_rating`
--
ALTER TABLE `thread_rating`
  ADD CONSTRAINT `thread_rating_ibfk_1` FOREIGN KEY (`th_id`) REFERENCES `threads` (`th_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thread_rating_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
