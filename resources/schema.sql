SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL ,
  `first_name` VARCHAR(50) NULL ,
  `middle_name` VARCHAR(50) NULL ,
  `last_name` VARCHAR(50) NULL ,
  `email` VARCHAR(50) NULL ,
  `phone` VARCHAR(45) NULL ,
  `created at` DATE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`papers` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`papers` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `created_at` DATE NULL ,
  `modified_at` DATE NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`papers_authors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`papers_authors` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`papers_authors` (
  `paper_id` INT NOT NULL ,
  `author_id` VARCHAR(45) NULL ,
  PRIMARY KEY (`paper_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`authors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`authors` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`authors` (
  `id` INT NOT NULL ,
  `institution_id` VARCHAR(45) NULL ,
  `grade` VARCHAR(45) NULL ,
  `user_id` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`admin`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`admin` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`admin` (
  `id` INT NOT NULL ,
  `user_id` VARCHAR(45) NULL ,
  `level` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`referee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`referee` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`referee` (
  `id` INT NOT NULL ,
  `institution_id` VARCHAR(45) NULL ,
  `refereecol` VARCHAR(45) NULL ,
  `user_id` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`institution`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`institution` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`institution` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `type` VARCHAR(45) NULL ,
  `institutioncol` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`referee_papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`referee_papers` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`referee_papers` (
  `id` INT NOT NULL ,
  `paper_id` VARCHAR(45) NULL ,
  `referee_id` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
