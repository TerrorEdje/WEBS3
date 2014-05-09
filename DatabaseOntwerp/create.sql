SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `jverhoev5_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `jverhoev5_db` ;

-- -----------------------------------------------------
-- Table `jverhoev5_db`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`users` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `joindate` DATETIME NOT NULL ,
  `lasttimeonline` DATETIME NOT NULL ,
  `timesonline` INT NOT NULL ,
  `signature` TEXT NULL ,
  `image` VARCHAR(100) NULL ,
  `description` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`categories` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`categories` (
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`name`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`subcategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`subcategories` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`subcategories` (
  `name` INT NOT NULL ,
  `description` VARCHAR(200) NOT NULL ,
  `categories_name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`name`) ,
  INDEX `fk_subcategories_categories1_idx` (`categories_name` ASC) ,
  CONSTRAINT `fk_subcategories_categories1`
    FOREIGN KEY (`categories_name` )
    REFERENCES `jverhoev5_db`.`categories` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`topics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`topics` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`topics` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `by` INT NOT NULL ,
  `subcategories_name` INT NOT NULL ,
  `open` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_topics_users1_idx` (`by` ASC) ,
  INDEX `fk_topics_subcategories1_idx` (`subcategories_name` ASC) ,
  CONSTRAINT `fk_topics_users1`
    FOREIGN KEY (`by` )
    REFERENCES `jverhoev5_db`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topics_subcategories1`
    FOREIGN KEY (`subcategories_name` )
    REFERENCES `jverhoev5_db`.`subcategories` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`replies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`replies` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`replies` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `content` TEXT NOT NULL ,
  `date` DATETIME NOT NULL ,
  `by` INT NOT NULL ,
  `topics_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_replies_users_idx` (`by` ASC) ,
  INDEX `fk_replies_topics1_idx` (`topics_id` ASC) ,
  CONSTRAINT `fk_replies_users`
    FOREIGN KEY (`by` )
    REFERENCES `jverhoev5_db`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_replies_topics1`
    FOREIGN KEY (`topics_id` )
    REFERENCES `jverhoev5_db`.`topics` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`polloptions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`polloptions` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`polloptions` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `topics_id` INT NOT NULL ,
  `date` DATETIME NOT NULL ,
  `description` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_polloptions_topics1_idx` (`topics_id` ASC) ,
  CONSTRAINT `fk_polloptions_topics1`
    FOREIGN KEY (`topics_id` )
    REFERENCES `jverhoev5_db`.`topics` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`pollvotes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`pollvotes` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`pollvotes` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NOT NULL ,
  `polloptions_id` INT NOT NULL ,
  `by` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_pollvotes_polloptions1_idx` (`polloptions_id` ASC) ,
  INDEX `fk_pollvotes_users1_idx` (`by` ASC) ,
  CONSTRAINT `fk_pollvotes_polloptions1`
    FOREIGN KEY (`polloptions_id` )
    REFERENCES `jverhoev5_db`.`polloptions` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pollvotes_users1`
    FOREIGN KEY (`by` )
    REFERENCES `jverhoev5_db`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`rights`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`rights` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`rights` (
  `name` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NULL ,
  PRIMARY KEY (`name`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`users_subcategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `jverhoev5_db`.`users_subcategories` ;

CREATE  TABLE IF NOT EXISTS `jverhoev5_db`.`users_subcategories` (
  `users_id` INT NOT NULL ,
  `subcategories_name` INT NOT NULL ,
  `rights_name` VARCHAR(45) NOT NULL ,
  INDEX `fk_users_subcategories_users1_idx` (`users_id` ASC) ,
  PRIMARY KEY (`users_id`, `subcategories_name`) ,
  INDEX `fk_users_subcategories_subcategories1_idx` (`subcategories_name` ASC) ,
  INDEX `fk_users_subcategories_rights1_idx` (`rights_name` ASC) ,
  CONSTRAINT `fk_users_subcategories_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `jverhoev5_db`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_subcategories_subcategories1`
    FOREIGN KEY (`subcategories_name` )
    REFERENCES `jverhoev5_db`.`subcategories` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_subcategories_rights1`
    FOREIGN KEY (`rights_name` )
    REFERENCES `jverhoev5_db`.`rights` (`name` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `jverhoev5_db` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
