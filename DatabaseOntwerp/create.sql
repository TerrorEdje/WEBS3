SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`rights`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`rights` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
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
CREATE TABLE IF NOT EXISTS `mydb`.`categories` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  `hidden` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`subcategories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`subcategories` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  `hidden` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subcategories_categories1_idx` (`categories_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_subcategories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `mydb`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`topics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`topics` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `by` INT NOT NULL,
  `open` TINYINT(1) NOT NULL,
  `hidden` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `subcategories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_topics_users1_idx` (`by` ASC),
  INDEX `fk_topics_subcategories1_idx` (`subcategories_id` ASC),
  CONSTRAINT `fk_topics_users1`
    FOREIGN KEY (`by`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topics_subcategories1`
    FOREIGN KEY (`subcategories_id`)
    REFERENCES `mydb`.`subcategories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`replies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`replies` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` TEXT NOT NULL,
  `by` INT NOT NULL,
  `topics_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
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
CREATE TABLE IF NOT EXISTS `mydb`.`polloptions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `topics_id` INT NOT NULL,
  `date` DATETIME NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
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
CREATE TABLE IF NOT EXISTS `mydb`.`pollvotes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL,
  `polloptions_id` INT NOT NULL,
  `by` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
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
-- Table `mydb`.`users_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users_categories` (
  `users_id` INT NOT NULL,
  `rights_name` VARCHAR(45) NOT NULL,
  `categories_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  INDEX `fk_users_subcategories_users1_idx` (`users_id` ASC),
  PRIMARY KEY (`users_id`),
  INDEX `fk_users_subcategories_rights1_idx` (`rights_name` ASC),
  UNIQUE INDEX `users_id_UNIQUE` (`users_id` ASC),
  INDEX `fk_users_categories_categories1_idx` (`categories_id` ASC),
  CONSTRAINT `fk_users_subcategories_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_subcategories_rights1`
    FOREIGN KEY (`rights_name`)
    REFERENCES `mydb`.`rights` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_categories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `mydb`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`users_read_replies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users_read_replies` (
  `users_id` INT NOT NULL,
  `replies_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
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


-- -----------------------------------------------------
-- Table `mydb`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`news` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `content` TEXT NULL,
  `users_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_news_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_news_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
