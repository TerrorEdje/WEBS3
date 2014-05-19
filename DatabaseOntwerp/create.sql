SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`rights`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`rights` ;

CREATE TABLE IF NOT EXISTS `mydb`.`rights` (
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`name`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `password_temp` VARCHAR(60) NULL,
  `email` VARCHAR(50) NOT NULL,
  `lasttimeonline` DATETIME NOT NULL,
  `timesonline` INT NOT NULL,
  `signature` TEXT NULL,
  `image` VARCHAR(100) NULL,
  `description` VARCHAR(100) NULL,
  `rights_name` VARCHAR(45) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `active` INT NULL,
  `code` VARCHAR(60) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_users_rights1_idx` (`rights_name` ASC),
  CONSTRAINT `fk_users_rights1`
    FOREIGN KEY (`rights_name`)
    REFERENCES `mydb`.`rights` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`categories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`categories` (
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  PRIMARY KEY (`name`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`subcategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`subcategories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`subcategories` (
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  `categories_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`name`),
  INDEX `fk_subcategories_categories1_idx` (`categories_name` ASC),
  CONSTRAINT `fk_subcategories_categories1`
    FOREIGN KEY (`categories_name`)
    REFERENCES `mydb`.`categories` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`topics`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`topics` ;

CREATE TABLE IF NOT EXISTS `mydb`.`topics` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `date` DATETIME NOT NULL,
  `by` INT NOT NULL,
  `subcategories_name` VARCHAR(45) NOT NULL,
  `open` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_topics_users1_idx` (`by` ASC),
  INDEX `fk_topics_subcategories1_idx` (`subcategories_name` ASC),
  CONSTRAINT `fk_topics_users1`
    FOREIGN KEY (`by`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topics_subcategories1`
    FOREIGN KEY (`subcategories_name`)
    REFERENCES `mydb`.`subcategories` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`replies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`replies` ;

CREATE TABLE IF NOT EXISTS `mydb`.`replies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL,
  `date` DATETIME NOT NULL,
  `by` INT NOT NULL,
  `topics_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_replies_users_idx` (`by` ASC),
  INDEX `fk_replies_topics1_idx` (`topics_id` ASC),
  CONSTRAINT `fk_replies_users`
    FOREIGN KEY (`by`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_replies_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `mydb`.`topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`polloptions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`polloptions` ;

CREATE TABLE IF NOT EXISTS `mydb`.`polloptions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `topics_id` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_polloptions_topics1_idx` (`topics_id` ASC),
  CONSTRAINT `fk_polloptions_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `mydb`.`topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pollvotes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`pollvotes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`pollvotes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `polloptions_id` INT NOT NULL,
  `by` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_pollvotes_polloptions1_idx` (`polloptions_id` ASC),
  INDEX `fk_pollvotes_users1_idx` (`by` ASC),
  CONSTRAINT `fk_pollvotes_polloptions1`
    FOREIGN KEY (`polloptions_id`)
    REFERENCES `mydb`.`polloptions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pollvotes_users1`
    FOREIGN KEY (`by`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users_subcategories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users_subcategories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users_subcategories` (
  `users_id` INT NOT NULL,
  `subcategories_name` VARCHAR(45) NOT NULL,
  `rights_name` VARCHAR(45) NOT NULL,
  INDEX `fk_users_subcategories_users1_idx` (`users_id` ASC),
  PRIMARY KEY (`users_id`, `subcategories_name`),
  INDEX `fk_users_subcategories_subcategories1_idx` (`subcategories_name` ASC),
  INDEX `fk_users_subcategories_rights1_idx` (`rights_name` ASC),
  CONSTRAINT `fk_users_subcategories_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_subcategories_subcategories1`
    FOREIGN KEY (`subcategories_name`)
    REFERENCES `mydb`.`subcategories` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_subcategories_rights1`
    FOREIGN KEY (`rights_name`)
    REFERENCES `mydb`.`rights` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users_read_replies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users_read_replies` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users_read_replies` (
  `users_id` INT NOT NULL,
  `replies_id` INT NOT NULL,
  PRIMARY KEY (`users_id`, `replies_id`),
  INDEX `fk_users_has_replies_replies1_idx` (`replies_id` ASC),
  INDEX `fk_users_has_replies_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_replies_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_replies_replies1`
    FOREIGN KEY (`replies_id`)
    REFERENCES `mydb`.`replies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
