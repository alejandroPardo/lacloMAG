-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2014 at 09:33 PM
-- Server version: 5.6.21
-- PHP Version: 5.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laclomag`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `editors`
--

CREATE TABLE IF NOT EXISTS `editors` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `editors`
--

INSERT INTO `editors` (`id`, `user_id`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `evaluators`
--

CREATE TABLE IF NOT EXISTS `evaluators` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE IF NOT EXISTS `logbooks` (
`id` int(11) NOT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE IF NOT EXISTS `magazines` (
`id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exemplary` int(11) DEFAULT NULL,
  `status` enum('ACTUAL','ARCHIVED','ONCONSTRUCTION') NOT NULL DEFAULT 'ONCONSTRUCTION'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `magazine_editors`
--

CREATE TABLE IF NOT EXISTS `magazine_editors` (
`id` int(11) NOT NULL,
  `magazine_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `magazine_files`
--

CREATE TABLE IF NOT EXISTS `magazine_files` (
`id` int(11) NOT NULL,
  `magazine_id` int(11) DEFAULT NULL,
  `file` mediumtext,
  `name` varchar(50) DEFAULT NULL,
  `type` enum('COVER','INDEX','EDITORIAL') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `magazine_papers`
--

CREATE TABLE IF NOT EXISTS `magazine_papers` (
`id` int(11) NOT NULL,
  `magazine_id` int(11) DEFAULT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mapped_messages`
--

CREATE TABLE IF NOT EXISTS `mapped_messages` (
`id` int(11) NOT NULL,
  `message_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_read` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
`id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `summary` varchar(512) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `more_info_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `order` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE IF NOT EXISTS `papers` (
`id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('UNSENT','SENT','ASIGNED','ONREVISION','REJECTED','APPROVED','PUBLISHED','UNPUBLISHED','REVIEW') NOT NULL DEFAULT 'UNSENT',
  `evaluation_type` enum('BLIND','OPEN','DOUBLEBLIND') DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `paper_authors`
--

CREATE TABLE IF NOT EXISTS `paper_authors` (
`id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paper_comments`
--

CREATE TABLE IF NOT EXISTS `paper_comments` (
`id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paper_editors`
--

CREATE TABLE IF NOT EXISTS `paper_editors` (
`id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paper_evaluators`
--

CREATE TABLE IF NOT EXISTS `paper_evaluators` (
`id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `status` enum('ASIGNED','ACCEPT','REJECT','APPROVED','MINORCHANGE','AUTHORCHANGE','DENIED','CORRECTED','EDITOR') NOT NULL DEFAULT 'ASIGNED',
  `comment` mediumtext,
  `type` enum('PRINCIPAL','SURROGATE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `paper_files`
--

CREATE TABLE IF NOT EXISTS `paper_files` (
`id` int(11) NOT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `raw` mediumtext,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `readers`
--

CREATE TABLE IF NOT EXISTS `readers` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reader_comments`
--

CREATE TABLE IF NOT EXISTS `reader_comments` (
`id` int(11) NOT NULL,
  `magazine_id` int(11) DEFAULT NULL,
  `reader_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `tokenhash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created`, `modified`, `last_login`, `first_name`, `last_name`, `tokenhash`) VALUES
(5, 'editor', 'laclomag@gmail.com', 'f6caa9aaf55160618260aac07fab499a70e8e941', 'editor', '2014-10-26 21:30:00', '2014-10-26 21:31:57', '2014-10-26 21:31:57', 'Editor', 'Principal', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `editors`
--
ALTER TABLE `editors`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `evaluators`
--
ALTER TABLE `evaluators`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `magazine_editors`
--
ALTER TABLE `magazine_editors`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `magazine_id_idx` (`magazine_id`), ADD KEY `editor_id_idx` (`editor_id`);

--
-- Indexes for table `magazine_files`
--
ALTER TABLE `magazine_files`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `magazine_id_idx` (`magazine_id`);

--
-- Indexes for table `magazine_papers`
--
ALTER TABLE `magazine_papers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `magazine_id_idx` (`magazine_id`), ADD KEY `paper_id_idx` (`paper_id`);

--
-- Indexes for table `mapped_messages`
--
ALTER TABLE `mapped_messages`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `user_id_idx` (`user_id`), ADD KEY `message_id_idx` (`message_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `paper_authors`
--
ALTER TABLE `paper_authors`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `paper_id_idx` (`paper_id`), ADD KEY `author_id_idx` (`author_id`);

--
-- Indexes for table `paper_comments`
--
ALTER TABLE `paper_comments`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `paper_id_idx` (`paper_id`), ADD KEY `evaluator_id_idx` (`evaluator_id`);

--
-- Indexes for table `paper_editors`
--
ALTER TABLE `paper_editors`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `paper_id_idx` (`paper_id`), ADD KEY `editor_id_idx` (`editor_id`);

--
-- Indexes for table `paper_evaluators`
--
ALTER TABLE `paper_evaluators`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `paper_id_idx` (`paper_id`), ADD KEY `evaluator_id_idx` (`evaluator_id`);

--
-- Indexes for table `paper_files`
--
ALTER TABLE `paper_files`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `paper_id_idx` (`paper_id`);

--
-- Indexes for table `readers`
--
ALTER TABLE `readers`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `reader_comments`
--
ALTER TABLE `reader_comments`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD KEY `magazine_id_idx` (`magazine_id`), ADD KEY `reader_id_idx` (`reader_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username_UNIQUE` (`username`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `editors`
--
ALTER TABLE `editors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `evaluators`
--
ALTER TABLE `evaluators`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `magazine_editors`
--
ALTER TABLE `magazine_editors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `magazine_files`
--
ALTER TABLE `magazine_files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `magazine_papers`
--
ALTER TABLE `magazine_papers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapped_messages`
--
ALTER TABLE `mapped_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `paper_authors`
--
ALTER TABLE `paper_authors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paper_comments`
--
ALTER TABLE `paper_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paper_editors`
--
ALTER TABLE `paper_editors`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paper_evaluators`
--
ALTER TABLE `paper_evaluators`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paper_files`
--
ALTER TABLE `paper_files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `readers`
--
ALTER TABLE `readers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reader_comments`
--
ALTER TABLE `reader_comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
ADD CONSTRAINT `authors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `editors`
--
ALTER TABLE `editors`
ADD CONSTRAINT `editors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluators`
--
ALTER TABLE `evaluators`
ADD CONSTRAINT `evaluators_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magazine_editors`
--
ALTER TABLE `magazine_editors`
ADD CONSTRAINT `magazine_editor_editor_id` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `magazine_editor_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magazine_files`
--
ALTER TABLE `magazine_files`
ADD CONSTRAINT `magazine_files_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magazine_papers`
--
ALTER TABLE `magazine_papers`
ADD CONSTRAINT `magazine_papers_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `magazine_papers_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mapped_messages`
--
ALTER TABLE `mapped_messages`
ADD CONSTRAINT `mapped_messages_message_id` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `mapped_messages_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paper_authors`
--
ALTER TABLE `paper_authors`
ADD CONSTRAINT `paper_authors_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `paper_authors_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paper_comments`
--
ALTER TABLE `paper_comments`
ADD CONSTRAINT `paper_comments_evaluator_id` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `paper_comments_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paper_editors`
--
ALTER TABLE `paper_editors`
ADD CONSTRAINT `paper_editors_editor_id` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `paper_editors_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paper_evaluators`
--
ALTER TABLE `paper_evaluators`
ADD CONSTRAINT `paper_evaluators_evaluator_id` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `paper_evaluators_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paper_files`
--
ALTER TABLE `paper_files`
ADD CONSTRAINT `paper_files_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `readers`
--
ALTER TABLE `readers`
ADD CONSTRAINT `readers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reader_comments`
--
ALTER TABLE `reader_comments`
ADD CONSTRAINT `reader_comments_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reader_comments_reader_id` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
