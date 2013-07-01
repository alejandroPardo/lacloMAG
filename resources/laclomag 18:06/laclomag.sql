SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `laclomag` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `laclomag` ;

-- -----------------------------------------------------
-- Table `laclomag`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`users` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `role` VARCHAR(20) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `last_login` DATETIME NULL ,
  `first_name` VARCHAR(50) NULL ,
  `last_name` VARCHAR(50) NULL ,
  `tokenhash` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`papers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `status` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`magazines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazines` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazines` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(50) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  `title` VARCHAR(255) NULL ,
  `exemplary` INT NULL ,
  `status` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`messages` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `content` VARCHAR(255) NULL ,
  `body` VARCHAR(255) NULL ,
  `type` VARCHAR(20) NULL ,
  `sender` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`news` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`news` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `headline` VARCHAR(255) NULL ,
  `summary` VARCHAR(512) NULL ,
  `content` TEXT NULL ,
  `created` DATETIME NULL ,
  `updated` DATETIME NULL ,
  `photo_url` VARCHAR(255) NULL ,
  `more_info_url` VARCHAR(255) NULL ,
  `video_url` VARCHAR(255) NULL ,
  `author` VARCHAR(50) NULL ,
  `order` INT NULL ,
  `status` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`logbooks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`logbooks` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`logbooks` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` VARCHAR(45) NULL ,
  `description` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  `ip` VARCHAR(45) NULL ,
  `type` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`admins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`admins` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`admins` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `admins_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`authors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`authors` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`authors` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `authors_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`editors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`editors` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`editors` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `editors_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`evaluators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`evaluators` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`evaluators` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `evaluators_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`readers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`readers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`readers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  CONSTRAINT `readers_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`reader_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`reader_comments` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`reader_comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `magazine_id` INT NULL ,
  `reader_id` INT NULL ,
  `comment` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  `status` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `magazine_id_idx` (`magazine_id` ASC) ,
  INDEX `reader_id_idx` (`reader_id` ASC) ,
  CONSTRAINT `reader_comments_reader_id`
    FOREIGN KEY (`reader_id` )
    REFERENCES `laclomag`.`readers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `reader_comments_magazine_id`
    FOREIGN KEY (`magazine_id` )
    REFERENCES `laclomag`.`magazines` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`mapped_messages`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`mapped_messages` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`mapped_messages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `message_id` INT NULL ,
  `user_id` INT NULL ,
  `is_read` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `user_id_idx` (`user_id` ASC) ,
  INDEX `message_id_idx` (`message_id` ASC) ,
  CONSTRAINT `mapped_messages_user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `mapped_messages_message_id`
    FOREIGN KEY (`message_id` )
    REFERENCES `laclomag`.`messages` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`paper_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_files` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_files` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `file` LONGBLOB NULL ,
  `name` VARCHAR(50) NULL ,
  `type` VARCHAR(20) NULL ,
  `content` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `paper_id_idx` (`paper_id` ASC) ,
  CONSTRAINT `paper_files_paper_id`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`paper_authors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_authors` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_authors` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `author_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `paper_id_idx` (`paper_id` ASC) ,
  INDEX `author_id_idx` (`author_id` ASC) ,
  CONSTRAINT `paper_authors_paper_id`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `paper_authors_author_id`
    FOREIGN KEY (`author_id` )
    REFERENCES `laclomag`.`authors` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`paper_editors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_editors` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_editors` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `editor_id` INT NULL ,
  `status` VARCHAR(20) NULL ,
  `comments` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `paper_id_idx` (`paper_id` ASC) ,
  INDEX `editor_id_idx` (`editor_id` ASC) ,
  CONSTRAINT `paper_editors_paper_id`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `paper_editors_editor_id`
    FOREIGN KEY (`editor_id` )
    REFERENCES `laclomag`.`editors` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`paper_evaluators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_evaluators` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_evaluators` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `evaluator_id` INT NULL ,
  `status` VARCHAR(20) NULL ,
  `comment` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `paper_id_idx` (`paper_id` ASC) ,
  INDEX `evaluator_id_idx` (`evaluator_id` ASC) ,
  CONSTRAINT `paper_evaluators_paper_id`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `paper_evaluators_evaluator_id`
    FOREIGN KEY (`evaluator_id` )
    REFERENCES `laclomag`.`evaluators` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`paper_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_comments` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `evaluator_id` INT NULL ,
  `comment` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `paper_id_idx` (`paper_id` ASC) ,
  INDEX `evaluator_id_idx` (`evaluator_id` ASC) ,
  CONSTRAINT `paper_comments_paper_id`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `paper_comments_evaluator_id`
    FOREIGN KEY (`evaluator_id` )
    REFERENCES `laclomag`.`evaluators` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`magazine_papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazine_papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazine_papers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `magazine_id` INT NULL ,
  `paper_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `magazine_id_idx` (`magazine_id` ASC) ,
  INDEX `paper_id_idx` (`paper_id` ASC) ,
  CONSTRAINT `magazine_papers_magazine_id`
    FOREIGN KEY (`magazine_id` )
    REFERENCES `laclomag`.`magazines` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `magazine_papers_paper_id`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`magazine_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazine_files` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazine_files` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `magazine_id` INT NULL ,
  `file` LONGBLOB NULL ,
  `name` VARCHAR(50) NULL ,
  `type` VARCHAR(20) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `magazine_id_idx` (`magazine_id` ASC) ,
  CONSTRAINT `magazine_files_magazine_id`
    FOREIGN KEY (`magazine_id` )
    REFERENCES `laclomag`.`magazines` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`magazine_editors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazine_editors` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazine_editors` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `magazine_id` INT NULL ,
  `editor_id` INT NULL ,
  `publish_date` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `magazine_id_idx` (`magazine_id` ASC) ,
  INDEX `editor_id_idx` (`editor_id` ASC) ,
  CONSTRAINT `magazine_editor_magazine_id`
    FOREIGN KEY (`magazine_id` )
    REFERENCES `laclomag`.`magazines` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `magazine_editor_editor_id`
    FOREIGN KEY (`editor_id` )
    REFERENCES `laclomag`.`editors` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `laclomag` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
