-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2020 at 07:39 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
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
(24, 1034),
(27, 1043),
(22, 1036);

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

-- --------------------------------------------------------

--
-- Table structure for table `comment_rating`
--

CREATE TABLE `comment_rating` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(22, 3);

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
(1034, 'Why you need String[] args?', '<p>just curious...</p>', '', NULL, NULL, NULL, 3, 24, '2020-12-07 15:27:27'),
(1035, 'How to sum even and odd values with one for-loop and no if-condition?', '<p>I&#39;ve been trying for a long time now and can&#39;t seem to find a way of doing it without using &quot;if&quot; statements to know if the loop variable is even or odd</p>', '', NULL, NULL, NULL, 7, 24, '2020-12-07 15:45:46'),
(1036, 'Print in one line dynamically', '<p>Even better, is it possible to print the single number&nbsp;<em>over</em>&nbsp;the last number, so only one number is on the screen at a time?</p>', '', NULL, NULL, NULL, 3, 24, '2020-12-07 15:47:38'),
(1043, 'How do you disable browser Autocomplete on web form field / input tag?', '<p>How do you disable autocomplete in the major browsers for a specific input (or form field)?</p>', '', 'operating-system-icon-5746821.jpg', 0, 37859, 1, 27, '2020-12-10 12:22:51');

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
(1034, 24, 'like'),
(1034, 27, 'like'),
(1035, 24, 'dislike'),
(1036, 24, 'like'),
(1036, 27, 'like');

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
(1, 'C', 'C is a general-purpose, procedural computer programming language supporting structured programming.', '2020-08-20 14:27:20'),
(2, 'C++', 'C++ is a general-purpose programming language created by Bjarne Stroustrup as an extension of the C programming language.', '2020-08-22 15:00:19'),
(3, 'JAVA', 'Java is a general-purpose programming language that is class-based, object-oriented, and designed to have as few implementation dependencies as possible.', '2020-08-22 15:00:19'),
(4, 'HTML', 'Hypertext Markup Language is the standard markup language for documents designed to be displayed in a web browser.', '2020-08-22 15:00:19'),
(5, 'CSS', 'Cascading Style Sheets is a style sheet language used for describing the presentation of a document written in a markup language like HTML.', '2020-08-23 14:59:25'),
(6, 'SQL', 'SQL is a domain-specific language used in programming and designed for managing data held in a relational database management system, or for stream processing in a relational data stream management system.', '2020-08-23 14:59:25'),
(7, 'PHP', 'PHP is a general-purpose scripting language that is especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994.', '2020-08-23 15:20:21'),
(8, 'PYTHON', 'Python is an interpreted, high-level and general-purpose programming language. Created by Guido van Rossum', '2020-10-05 15:52:02'),
(9, 'JAVASCRIPT', 'Javascript is a programming language that conforms to the ECMAScript specification. JavaScript is high-level programming langugae', '2020-10-05 15:52:02'),
(10, 'ALGORITHMS', 'An algorithm is a finite sequence of well-defined, computer-implementable instructions, typically to solve a class of problems or to perform a computation.', '2020-10-05 15:54:45'),
(11, 'DATA STRUCTURES', 'A data structure is a data organization, management, and storage format that enables efficient access and modification.', '2020-10-05 15:54:45'),
(12, 'SOFTWARE ENGINEERING', 'Software engineering is the systematic application of engineering approaches to the development of software. Software engineering is a computing discipline.', '2020-10-05 15:56:12'),
(13, 'COMPUTER ARCHITECTURE', 'Computer architecture is a set of rules and methods that describe the functionality, organization, and implementation of computer systems.', '2020-10-05 15:58:54'),
(14, 'COMPUTER GRAPHICS', 'Computer graphics is the branch of computer science that deals with generating images with the aid of computers.', '2020-10-05 15:58:54'),
(15, 'OPERATING SYSTEM', 'An operating system is system software that manages computer hardware, software resources, and provides common services for computer programs.', '2020-10-05 16:01:52'),
(16, 'COMPUTER NETWORKS', 'A computer network is a group of computers that use a set of common communication protocols over digital interconnections for the purpose of sharing resources located on or provided by the network nodes.', '2020-10-05 16:01:52'),
(17, 'ARTIFICIAL INTELLIGENCE', 'Artificial intelligence, sometimes called machine intelligence, is intelligence demonstrated by machines, unlike the natural intelligence displayed by humans and animals. ', '2020-10-05 16:04:03'),
(18, 'MACHINE LEARNING', 'Machine learning is the study of computer algorithms that improve automatically through experience. It is seen as a subset of artificial intelligence.', '2020-10-05 16:04:03'),
(19, 'DATA MINING', 'Data mining is a process of discovering patterns in large data sets involving methods at the intersection of machine learning, statistics, and database systems.', '2020-10-05 16:04:03'),
(20, 'THEORY OF COMPUTATION', 'The theory of computation is the branch that deals with what problems can be solved on a model of computation, using an algorithm, how efficiently they can be solved or to what degree', '2020-10-05 16:08:21'),
(21, 'DIGITAL LOGICS', 'Digital electronics is a field of electronics involving the study of digital signals and the engineering of devices that use or produce them. This is in contrast to analog electronics and analog signals.', '2020-10-05 16:08:21'),
(22, 'DISCRETE MATHEMATICS', 'Discrete mathematics is the study of mathematical structures that are fundamentally discrete rather than continuous.', '2020-10-05 16:08:21'),
(23, 'GRAPH THEORY', 'In mathematics, graph theory is the study of graphs, which are mathematical structures used to model pairwise relations between objects. A graph in this context is made up of vertices which are connected by edges.', '2020-10-05 16:08:21'),
(24, 'CRYPTOGRAPHY', 'Cryptography, or cryptology, is the practice and study of techniques for secure communication in the presence of third parties called adversaries.', '2020-10-05 16:08:21'),
(25, 'CODING INTERVIEWS', 'A coding interview, programming interview.', '2020-10-05 16:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_pass` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_email`, `u_pass`, `timestamp`) VALUES
(22, 'tushar@111.com', '$2y$10$yw1TEcmOqmXaXgjwguUgMex6nYlfpAqlqCZhQ4KmrFwCcDvLYUWXW', '2020-12-07 15:14:16'),
(23, 'vivek@12.com', '$2y$10$YBW3dTEh3GN51Sgr0bauquAaUEZFCvt722i/eUcehBWKzEiS2tYo6', '2020-12-07 15:14:57'),
(24, 'lalit@99.com', '$2y$10$dvryKtxy2R9lyUfcGOgN6uUB45JCnaTemlqnVJevyIijVNr9Sj31a', '2020-12-07 15:21:13'),
(25, 'ishan@45.com', '$2y$10$1TPjbV6uUiiMeMTm.ytFw.Dci2ymVOc97W3VEQB/0WVfW810pI55O', '2020-12-07 15:23:00'),
(26, 'vikas@222.com', '$2y$10$GNm5XNtswdr9TKr5VePOzO4frxTBFAMDV0MvaLhuW2XFwlO61kilW', '2020-12-07 15:23:41'),
(27, 'rishi@22.com', '$2y$10$b.3T9p7H6rxKtsUQFdRCxOxj2W3eBneijO8Sli8z5n91U8yLnBdRu', '2020-12-07 15:24:40'),
(28, 'nehal@22.com', '$2y$10$8nECOyYTkDd9MXdP1N2eYOf3RTJWqV6AREeZZzxbHdIStQoVmQKPe', '2020-12-07 15:26:43');

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
  MODIFY `th_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1044;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `t_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
