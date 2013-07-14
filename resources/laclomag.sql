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

 Date: 07/10/2013 21:43:27 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `admins_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `admins`
-- ----------------------------
BEGIN;
INSERT INTO `admins` VALUES ('1', '1');
COMMIT;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `authors`
-- ----------------------------
BEGIN;
INSERT INTO `authors` VALUES ('1', '2');
COMMIT;

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
--  Table structure for `magazine_editors`
-- ----------------------------
DROP TABLE IF EXISTS `magazine_editors`;
CREATE TABLE `magazine_editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `publish_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `magazine_id_idx` (`magazine_id`),
  KEY `editor_id_idx` (`editor_id`),
  CONSTRAINT `magazine_editor_editor_id` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `magazine_editor_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `magazine_files`
-- ----------------------------
DROP TABLE IF EXISTS `magazine_files`;
CREATE TABLE `magazine_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `file` longblob,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
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
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mapped_messages`
-- ----------------------------
DROP TABLE IF EXISTS `mapped_messages`;
CREATE TABLE `mapped_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_read` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `message_id_idx` (`message_id`),
  CONSTRAINT `mapped_messages_message_id` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mapped_messages_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `body` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `sender` int(11) DEFAULT NULL,
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
  CONSTRAINT `paper_authors_author_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_authors_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `paper_authors`
-- ----------------------------
BEGIN;
INSERT INTO `paper_authors` VALUES ('1', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `paper_comments`
-- ----------------------------
DROP TABLE IF EXISTS `paper_comments`;
CREATE TABLE `paper_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `evaluator_id_idx` (`evaluator_id`),
  CONSTRAINT `paper_comments_evaluator_id` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_comments_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_editors`
-- ----------------------------
DROP TABLE IF EXISTS `paper_editors`;
CREATE TABLE `paper_editors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `editor_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `editor_id_idx` (`editor_id`),
  CONSTRAINT `paper_editors_editor_id` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_editors_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `paper_evaluators`
-- ----------------------------
DROP TABLE IF EXISTS `paper_evaluators`;
CREATE TABLE `paper_evaluators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paper_id` int(11) DEFAULT NULL,
  `evaluator_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `paper_id_idx` (`paper_id`),
  KEY `evaluator_id_idx` (`evaluator_id`),
  CONSTRAINT `paper_evaluators_evaluator_id` FOREIGN KEY (`evaluator_id`) REFERENCES `evaluators` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `paper_evaluators_paper_id` FOREIGN KEY (`paper_id`) REFERENCES `papers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `paper_files`
-- ----------------------------
BEGIN;
INSERT INTO `paper_files` VALUES ('1', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHA+U3RhcnQ6ICB0byBFbmQ6IDwvcD4KICA8dGFibGU+CiAgICAgIDx0cj4KICAgICAgICAgIDx0aD5JRDwvdGg+CiAgICAgICAgICA8dGg+VXNlcm5hbWU8L3RoPgogICAgICAgICAgPHRoPlJvbGU8L3RoPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MTwvdGQ+CiAgICAgICAgICA8dGQ+YWxlPC90ZD4KICAgICAgICAgIDx0ZD5hZG1pbjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICAgICAgPHRkPmF1dGhvcjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgPC90cj4KICAgICAgPHRyPgogICAgICAgICAgPHRkPjxiPlRvdGFsczo8L2I+PC90ZD4KICAgICAgICAgIDx0ZD4wPC90ZD4KICAgICAgICAgIDx0ZD4yIGl0ZW1zPC90ZD4KICAgICAgPC90cj4KICA8L3RhYmxlPgo8L2JvZHk+CjwvaHRtbD4K', 'My Super Awesome PDF', null, null), ('2', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHA+U3RhcnQ6ICB0byBFbmQ6IDwvcD4KICA8dGFibGU+CiAgICAgIDx0cj4KICAgICAgICAgIDx0aD5JRDwvdGg+CiAgICAgICAgICA8dGg+VXNlcm5hbWU8L3RoPgogICAgICAgICAgPHRoPlJvbGU8L3RoPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MTwvdGQ+CiAgICAgICAgICA8dGQ+YWxlPC90ZD4KICAgICAgICAgIDx0ZD5hZG1pbjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICAgICAgPHRkPmF1dGhvcjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgPC90cj4KICAgICAgPHRyPgogICAgICAgICAgPHRkPjxiPlRvdGFsczo8L2I+PC90ZD4KICAgICAgICAgIDx0ZD4wPC90ZD4KICAgICAgICAgIDx0ZD4yIGl0ZW1zPC90ZD4KICAgICAgPC90cj4KICA8L3RhYmxlPgo8L2JvZHk+CjwvaHRtbD4K', 'My Super Awesome PDF', null, null), ('3', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHA+U3RhcnQ6ICB0byBFbmQ6IDwvcD4KICA8dGFibGU+CiAgICAgIDx0cj4KICAgICAgICAgIDx0aD5JRDwvdGg+CiAgICAgICAgICA8dGg+VXNlcm5hbWU8L3RoPgogICAgICAgICAgPHRoPlJvbGU8L3RoPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MTwvdGQ+CiAgICAgICAgICA8dGQ+YWxlPC90ZD4KICAgICAgICAgIDx0ZD5hZG1pbjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICAgICAgPHRkPmF1dGhvcjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgPC90cj4KICAgICAgPHRyPgogICAgICAgICAgPHRkPjxiPlRvdGFsczo8L2I+PC90ZD4KICAgICAgICAgIDx0ZD4wPC90ZD4KICAgICAgICAgIDx0ZD4yIGl0ZW1zPC90ZD4KICAgICAgPC90cj4KICA8L3RhYmxlPgo8L2JvZHk+CjwvaHRtbD4K', 'My Super Awesome PDF', null, null), ('4', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHA+U3RhcnQ6ICB0byBFbmQ6IDwvcD4KICA8dGFibGU+CiAgICAgIDx0cj4KICAgICAgICAgIDx0aD5JRDwvdGg+CiAgICAgICAgICA8dGg+VXNlcm5hbWU8L3RoPgogICAgICAgICAgPHRoPlJvbGU8L3RoPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MTwvdGQ+CiAgICAgICAgICA8dGQ+YWxlPC90ZD4KICAgICAgICAgIDx0ZD5hZG1pbjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICAgICAgPHRkPmF1dGhvcjwvdGQ+CiAgICAgIDwvdHI+CiAgICAgICAgICAgIDx0cj4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgPC90cj4KICAgICAgPHRyPgogICAgICAgICAgPHRkPjxiPlRvdGFsczo8L2I+PC90ZD4KICAgICAgICAgIDx0ZD4wPC90ZD4KICAgICAgICAgIDx0ZD4yIGl0ZW1zPC90ZD4KICAgICAgPC90cj4KICA8L3RhYmxlPgo8L2JvZHk+CjwvaHRtbD4K', 'My Super Awesome PDF', null, null), ('5', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHRhYmxlPgogICAgICA8dHI+CiAgICAgICAgICA8dGg+SUQ8L3RoPgogICAgICAgICAgPHRoPlVzZXJuYW1lPC90aD4KICAgICAgICAgIDx0aD5Sb2xlPC90aD4KICAgICAgPC90cj4KICAgICAgICAgICAgPHRyPgogICAgICAgICAgPHRkPjE8L3RkPgogICAgICAgICAgPHRkPmFsZTwvdGQ+CiAgICAgICAgICA8dGQ+YWRtaW48L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MjwvdGQ+CiAgICAgICAgICA8dGQ+YXV0aG9yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgIDwvdHI+CiAgICAgIDx0cj4KICAgICAgICAgIDx0ZD48Yj5Ub3RhbHM6PC9iPjwvdGQ+CiAgICAgICAgICA8dGQ+MDwvdGQ+CiAgICAgICAgICA8dGQ+MiBpdGVtczwvdGQ+CiAgICAgIDwvdHI+CiAgPC90YWJsZT4KPC9ib2R5Pgo8L2h0bWw+Cg==', 'My Super Awesome PDF', null, null), ('6', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHRhYmxlPgogICAgICA8dHI+CiAgICAgICAgICA8dGg+SUQ8L3RoPgogICAgICAgICAgPHRoPlVzZXJuYW1lPC90aD4KICAgICAgICAgIDx0aD5Sb2xlPC90aD4KICAgICAgPC90cj4KICAgICAgICAgICAgPHRyPgogICAgICAgICAgPHRkPjE8L3RkPgogICAgICAgICAgPHRkPmFsZTwvdGQ+CiAgICAgICAgICA8dGQ+YWRtaW48L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MjwvdGQ+CiAgICAgICAgICA8dGQ+YXV0aG9yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgIDwvdHI+CiAgICAgIDx0cj4KICAgICAgICAgIDx0ZD48Yj5Ub3RhbHM6PC9iPjwvdGQ+CiAgICAgICAgICA8dGQ+MDwvdGQ+CiAgICAgICAgICA8dGQ+MiBpdGVtczwvdGQ+CiAgICAgIDwvdHI+CiAgPC90YWJsZT4KPC9ib2R5Pgo8L2h0bWw+Cg==', 'My Super Awesome PDF', null, null), ('7', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHRhYmxlPgogICAgICA8dHI+CiAgICAgICAgICA8dGg+SUQ8L3RoPgogICAgICAgICAgPHRoPlVzZXJuYW1lPC90aD4KICAgICAgICAgIDx0aD5Sb2xlPC90aD4KICAgICAgPC90cj4KICAgICAgICAgICAgPHRyPgogICAgICAgICAgPHRkPjE8L3RkPgogICAgICAgICAgPHRkPmFsZTwvdGQ+CiAgICAgICAgICA8dGQ+YWRtaW48L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MjwvdGQ+CiAgICAgICAgICA8dGQ+YXV0aG9yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgIDwvdHI+CiAgICAgIDx0cj4KICAgICAgICAgIDx0ZD48Yj5Ub3RhbHM6PC9iPjwvdGQ+CiAgICAgICAgICA8dGQ+MDwvdGQ+CiAgICAgICAgICA8dGQ+MiBpdGVtczwvdGQ+CiAgICAgIDwvdHI+CiAgPC90YWJsZT4KPC9ib2R5Pgo8L2h0bWw+Cg==', 'My Super Awesome PDF', null, null), ('8', null, 'PCEtLSBleHBlbnNlIHJlcG9ydCAtLT4KPGh0bWw+Cjxib2R5PgogIDxoMz5FeHBlbnNlIFJlcG9ydDwvaDM+CiAgPHRhYmxlPgogICAgICA8dHI+CiAgICAgICAgICA8dGg+SUQ8L3RoPgogICAgICAgICAgPHRoPlVzZXJuYW1lPC90aD4KICAgICAgICAgIDx0aD5Sb2xlPC90aD4KICAgICAgPC90cj4KICAgICAgICAgICAgPHRyPgogICAgICAgICAgPHRkPjE8L3RkPgogICAgICAgICAgPHRkPmFsZTwvdGQ+CiAgICAgICAgICA8dGQ+YWRtaW48L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+MjwvdGQ+CiAgICAgICAgICA8dGQ+YXV0aG9yPC90ZD4KICAgICAgICAgIDx0ZD5hdXRob3I8L3RkPgogICAgICA8L3RyPgogICAgICAgICAgICA8dHI+CiAgICAgICAgICA8dGQ+Jm5ic3A7PC90ZD4KICAgICAgICAgIDx0ZD4mbmJzcDs8L3RkPgogICAgICAgICAgPHRkPiZuYnNwOzwvdGQ+CiAgICAgIDwvdHI+CiAgICAgIDx0cj4KICAgICAgICAgIDx0ZD48Yj5Ub3RhbHM6PC9iPjwvdGQ+CiAgICAgICAgICA8dGQ+MDwvdGQ+CiAgICAgICAgICA8dGQ+MiBpdGVtczwvdGQ+CiAgICAgIDwvdHI+CiAgPC90YWJsZT4KPC9ib2R5Pgo8L2h0bWw+Cg==', 'My Super Awesome PDF', null, null), ('9', null, null, 'Diagramas de flujo.graffle', null, null);
COMMIT;

-- ----------------------------
--  Table structure for `papers`
-- ----------------------------
DROP TABLE IF EXISTS `papers`;
CREATE TABLE `papers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `papers`
-- ----------------------------
BEGIN;
INSERT INTO `papers` VALUES ('1', 'Prueba', '2013-07-02 15:20:21', '2013-07-02 15:20:23', '0'), ('2', null, '2013-07-10 19:16:31', '2013-07-10 19:16:31', null), ('3', null, '2013-07-10 19:18:16', '2013-07-10 19:18:16', null), ('4', 'asdasda', '2013-07-10 19:26:56', '2013-07-10 19:26:56', null);
COMMIT;

-- ----------------------------
--  Table structure for `reader_comments`
-- ----------------------------
DROP TABLE IF EXISTS `reader_comments`;
CREATE TABLE `reader_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `reader_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `magazine_id_idx` (`magazine_id`),
  KEY `reader_id_idx` (`reader_id`),
  CONSTRAINT `reader_comments_magazine_id` FOREIGN KEY (`magazine_id`) REFERENCES `magazines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reader_comments_reader_id` FOREIGN KEY (`reader_id`) REFERENCES `readers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `readers`
-- ----------------------------
DROP TABLE IF EXISTS `readers`;
CREATE TABLE `readers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `readers_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
INSERT INTO `users` VALUES ('1', 'ale', 'alejandro.pardo.r@gmail.com', 'f6caa9aaf55160618260aac07fab499a70e8e941', 'admin', '2013-06-29 15:43:00', '2013-07-10 16:22:29', '2013-07-02 19:14:10', 'Alejandro', 'Pardo', '1b8fb4d1830b5cea8564c11e61c981fb50d34576'), ('2', 'author', 'author@laclomag.com', 'f6caa9aaf55160618260aac07fab499a70e8e941', 'author', '2013-06-29 15:43:00', '2013-07-10 21:21:33', '2013-07-10 21:21:33', 'Test', 'Author', '384b05616ce2e1c3495c82573aa388e4fbfdfa85a4329453f2e6abe96c10f00485c81adf61851c2ce66cbb295d2addd2715eb9e5c2c4948bd6263a97cc425fd2');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;