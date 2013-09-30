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
  `status` ENUM('UNSENT','SENT','ASIGNED','ONREVISION','REJECTED','APPROVED','PUBLISHED','UNPUBLISHED','REVIEW') NOT NULL DEFAULT 'UNSENT' ,
  `evaluation_type` ENUM('BLIND','OPEN','DOUBLEBLIND') NOT NULL DEFAULT 'BLIND' ,
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
  `status` ENUM('ACTUAL','ARCHIVED','ONCONSTRUCTION') NULL ,
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
-- Table `laclomag`.`paper_files`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_files` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_files` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `raw` MEDIUMTEXT NULL ,
  `name` VARCHAR(255) NULL ,
  `type` VARCHAR(20) NULL ,
  `url` VARCHAR(255) NULL ,
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
-- Table `laclomag`.`paper_evaluators`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`paper_evaluators` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`paper_evaluators` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NULL ,
  `evaluator_id` INT NULL ,
  `status` ENUM('ASIGNED','ACCEPT','REJECT','APPROVED','MINORCHANGE','AUTHORCHANGE','DENIED','CORRECTED','EDITOR') NOT NULL DEFAULT 'ASIGNED' ,
  `comment` MEDIUMTEXT NULL ,
  `type` ENUM('PRINCIPAL','SURROGATE') NULL ,
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
-- Table `laclomag`.`magazine_papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazine_papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazine_papers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `magazine_id` INT NULL ,
  `paper_id` INT NULL ,
  `order` INT NULL ,
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
  `file` MEDIUMTEXT NULL ,
  `name` VARCHAR(50) NULL ,
  `type` ENUM('COVER','INDEX','EDITORIAL') NULL ,
  `title` VARCHAR(255) NULL ,
  `edition` VARCHAR(255) NULL ,
  `color` VARCHAR(50) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `magazine_id_idx` (`magazine_id` ASC) ,
  CONSTRAINT `magazine_files_magazine_id`
    FOREIGN KEY (`magazine_id` )
    REFERENCES `laclomag`.`magazines` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `laclomag` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
