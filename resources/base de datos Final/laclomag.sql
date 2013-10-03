/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50528
 Source Host           : localhost
 Source Database       : laclomag

 Target Server Type    : MySQL
 Target Server Version : 50528
 File Encoding         : utf-8

 Date: 10/02/2013 19:01:52 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `authors`
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `authors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `editors`
-- ----------------------------
DROP TABLE IF EXISTS `editors`;
CREATE TABLE `editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `editors_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `evaluators`
-- ----------------------------
DROP TABLE IF EXISTS `evaluators`;
CREATE TABLE `evaluators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `evaluators_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `logbooks`
-- ----------------------------
DROP TABLE IF EXISTS `logbooks`;
CREATE TABLE `logbooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `magazine_files`
-- ----------------------------
DROP TABLE IF EXISTS `magazine_files`;
CREATE TABLE `magazine_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `file` mediumtext,
  `name` varchar(50) DEFAULT NULL,
  `type` enum('COVER','INDEX','EDITORIAL') DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `magazine_id_idx` (`magazine_id`),
  CONSTRAINT `magazine_files_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `magazine_papers`
-- ----------------------------
DROP TABLE IF EXISTS `magazine_papers`;
CREATE TABLE `magazine_papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `paper_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `magazine_id_idx` (`magazine_id`),
  KEY `paper_id_idx` (`paper_id`),
  CONSTRAINT `magazine_papers_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `magazine_papers_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `magazines`
-- ----------------------------
DROP TABLE IF EXISTS `magazines`;
CREATE TABLE `magazines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exemplary` int(11) DEFAULT NULL,
  `status` enum('ACTUAL','ARCHIVED','ONCONSTRUCTION') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `news`
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `headline` varchar(255) DEFAULT NULL,
  `summary` varchar(512) DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `more_info_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_authors`
-- ----------------------------
DROP TABLE IF EXISTS `paper_authors`;
CREATE TABLE `paper_authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `author_id_idx` (`author_id`),
  CONSTRAINT `paper_authors_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_authors_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_evaluators`
-- ----------------------------
DROP TABLE IF EXISTS `paper_evaluators`;
CREATE TABLE `paper_evaluators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `status` enum('ASIGNED','ACCEPT','REJECT','APPROVED','MINORCHANGE','AUTHORCHANGE','DENIED','CORRECTED','EDITOR') NOT NULL DEFAULT 'ASIGNED',
  `comment` mediumtext,
  `type` enum('PRINCIPAL','SURROGATE') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `evaluator_id_idx` (`evaluator_id`),
  CONSTRAINT `paper_evaluators_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_evaluators_evaluator_id` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_files`
-- ----------------------------
DROP TABLE IF EXISTS `paper_files`;
CREATE TABLE `paper_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `raw` mediumtext,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  CONSTRAINT `paper_files_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `papers`
-- ----------------------------
DROP TABLE IF EXISTS `papers`;
CREATE TABLE `papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` enum('UNSENT','SENT','ASIGNED','ONREVISION','REJECTED','APPROVED','PUBLISHED','UNPUBLISHED','REVIEW') NOT NULL DEFAULT 'UNSENT',
  `evaluation_type` enum('BLIND','OPEN','DOUBLEBLIND') NOT NULL DEFAULT 'BLIND',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `tokenhash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'editor', 'laclomag@gmail.com', 'f6caa9aaf55160618260aac07fab499a70e8e941', 'editor', null, '2013-10-02 23:31:33', '2013-10-02 23:31:33', 'Editor', 'Editor', null);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
