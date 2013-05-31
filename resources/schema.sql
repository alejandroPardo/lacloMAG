SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `laclomag` ;
CREATE SCHEMA IF NOT EXISTS `laclomag` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `laclomag` ;

-- -----------------------------------------------------
-- Table `laclomag`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`users` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `first_name` VARCHAR(255) NOT NULL ,
  `middle_name` VARCHAR(255) NULL ,
  `last_name` VARCHAR(255) NOT NULL ,
  `email` VARCHAR(255) NOT NULL ,
  `phone` VARCHAR(255) NULL ,
  `date_created` DATETIME NULL ,
  `date_modified` DATETIME NULL ,
  `birthday` DATE NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `role` ENUM('admin','editor','author','reader') NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`papers` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `created_at` DATETIME NULL ,
  `modified_at` DATETIME NULL ,
  `status` VARCHAR(45) NULL ,
  `paper_url` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`institutions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`institutions` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`institutions` (
  `id` INT(10) UNSIGNED NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`authors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`authors` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`authors` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `institution_id` INT(10) UNSIGNED NOT NULL ,
  `grade` VARCHAR(45) NULL ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `users_userId` (`user_id` ASC) ,
  INDEX `institutions_institutionId` (`institution_id` ASC) ,
  CONSTRAINT `authors_fk_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `authors_fk_2`
    FOREIGN KEY (`institution_id` )
    REFERENCES `laclomag`.`institutions` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`author_papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`author_papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`author_papers` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `author_id` INT(10) UNSIGNED NOT NULL ,
  `paper_id` INT UNSIGNED NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `papers_paperId` (`paper_id` ASC) ,
  INDEX `authors_authorsId` (`author_id` ASC) ,
  UNIQUE INDEX `unique_paper_author` (`paper_id` ASC, `author_id` ASC) ,
  CONSTRAINT `papers_authors_fk_1`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `papers_authors_fk_2`
    FOREIGN KEY (`author_id` )
    REFERENCES `laclomag`.`authors` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`admins`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`admins` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`admins` (
  `id` INT(10) NOT NULL ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  `date_created` DATETIME NULL ,
  `date_modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `users_userId` (`user_id` ASC) ,
  CONSTRAINT `admins_fk_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`referee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`referee` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`referee` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `institution_id` INT(10) UNSIGNED NOT NULL ,
  `especialization` VARCHAR(45) NULL ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `institutions_institutionId` (`institution_id` ASC) ,
  INDEX `users_userId` (`user_id` ASC) ,
  CONSTRAINT `referee_fk_1`
    FOREIGN KEY (`institution_id` )
    REFERENCES `laclomag`.`institutions` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `referee_fk_2`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
PACK_KEYS = 1;


-- -----------------------------------------------------
-- Table `laclomag`.`referee_papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`referee_papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`referee_papers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `referee_id` INT(10) UNSIGNED NOT NULL ,
  `paper_id` INT(10) UNSIGNED NOT NULL ,
  `date_asigned` DATETIME NULL ,
  `status` ENUM('APPROVED', 'UNAPPROVED', 'REVIEWING', 'PENDING') NOT NULL DEFAULT 'PENDING' ,
  PRIMARY KEY (`id`) ,
  INDEX `papers_paperId` (`paper_id` ASC) ,
  INDEX `referees_refereeId` (`referee_id` ASC) ,
  UNIQUE INDEX `unique_referee_paper` (`referee_id` ASC, `paper_id` ASC) ,
  CONSTRAINT `referee_papers_fk_1`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `referee_papers_fk_2`
    FOREIGN KEY (`referee_id` )
    REFERENCES `laclomag`.`referee` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`magazines`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazines` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazines` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  `date_updated` DATETIME NULL ,
  `title` VARCHAR(255) NULL ,
  `exemplary` INT(10) NOT NULL ,
  `status` ENUM('PUBLISHED','NOT_PUBLISHED','STORED') NULL DEFAULT 'NOT_PUBLISHED' ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`magazine_papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`magazine_papers` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`magazine_papers` (
  `id` INT(10) NOT NULL AUTO_INCREMENT ,
  `magazine_id` INT(10) UNSIGNED NOT NULL ,
  `paper_id` INT(10) UNSIGNED NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `papers_paperId` (`paper_id` ASC) ,
  INDEX `magazines_magazineId` (`magazine_id` ASC) ,
  UNIQUE INDEX `unique_magazine_paper` (`magazine_id` ASC, `paper_id` ASC) ,
  CONSTRAINT `magazine_papers_fk_1`
    FOREIGN KEY (`magazine_id` )
    REFERENCES `laclomag`.`magazines` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `magazine_papers_fk_2`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`news`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`news` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`news` (
  `id` INT(10) UNSIGNED NOT NULL ,
  `headline` VARCHAR(255) NOT NULL ,
  `summary` VARCHAR(510) NULL ,
  `content` TEXT NOT NULL ,
  `date_created` DATETIME NOT NULL ,
  `date_updated` DATETIME NOT NULL ,
  `photo_url` VARCHAR(255) NULL ,
  `more_info_url` VARCHAR(255) NULL ,
  `video_url` VARCHAR(255) NULL ,
  `author` VARCHAR(255) NULL ,
  `order` INT(10) NULL ,
  `active` TINYINT(1) NULL DEFAULT 1 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laclomag`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `laclomag`.`comments` ;

CREATE  TABLE IF NOT EXISTS `laclomag`.`comments` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `content` TEXT NOT NULL ,
  `paper_id` INT(10) UNSIGNED NOT NULL ,
  `user_id` INT(10) UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `user_userId` (`user_id` ASC) ,
  INDEX `papers_paperId` (`paper_id` ASC) ,
  CONSTRAINT `comments_fk_1`
    FOREIGN KEY (`paper_id` )
    REFERENCES `laclomag`.`papers` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `comments_fk_2`
    FOREIGN KEY (`user_id` )
    REFERENCES `laclomag`.`users` (`id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

USE `laclomag` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
