SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `jverhoev5_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `jverhoev5_db` ;

-- -----------------------------------------------------
-- Table `jverhoev5_db`.`rights`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`rights` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `password_temp` VARCHAR(60) NULL,
  `email` VARCHAR(50) NOT NULL,
  `lasttimeonline` DATETIME NULL,
  `timesonline` INT NULL,
  `signature` TEXT NULL,
  `image` VARCHAR(100) NULL,
  `description` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `active` INT NULL,
  `code` VARCHAR(60) NULL,
  `rights_id` INT NOT NULL,
  `remember_token` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_users_rights1_idx` (`rights_id` ASC),
  CONSTRAINT `fk_users_rights1`
    FOREIGN KEY (`rights_id`)
    REFERENCES `jverhoev5_db`.`rights` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(200) NULL,
  `hidden` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`subcategories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`subcategories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(120) NULL,
  `hidden` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `categories_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_subcategories_categories1_idx` (`categories_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_subcategories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `jverhoev5_db`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`topics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`topics` (
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
    REFERENCES `jverhoev5_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topics_subcategories1`
    FOREIGN KEY (`subcategories_id`)
    REFERENCES `jverhoev5_db`.`subcategories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`replies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`replies` (
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
    REFERENCES `jverhoev5_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_replies_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `jverhoev5_db`.`topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`polloptions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`polloptions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `topics_id` INT NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_polloptions_topics1_idx` (`topics_id` ASC),
  CONSTRAINT `fk_polloptions_topics1`
    FOREIGN KEY (`topics_id`)
    REFERENCES `jverhoev5_db`.`topics` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`pollvotes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`pollvotes` (
  `id` INT NOT NULL AUTO_INCREMENT,
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
    REFERENCES `jverhoev5_db`.`polloptions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pollvotes_users1`
    FOREIGN KEY (`by`)
    REFERENCES `jverhoev5_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`users_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`users_categories` (
  `categories_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `rights_id` INT NOT NULL,
  INDEX `fk_users_categories_categories1_idx` (`categories_id` ASC),
  INDEX `fk_users_categories_rights1_idx` (`rights_id` ASC),
  INDEX `fk_users_categories_users1_idx` (`users_id` ASC),
  PRIMARY KEY (`categories_id`, `users_id`),
  CONSTRAINT `fk_users_categories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `jverhoev5_db`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_categories_rights1`
    FOREIGN KEY (`rights_id`)
    REFERENCES `jverhoev5_db`.`rights` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_categories_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `jverhoev5_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`users_read_replies`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`users_read_replies` (
  `users_id` INT NOT NULL,
  `replies_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`users_id`, `replies_id`),
  INDEX `fk_users_has_replies_replies1_idx` (`replies_id` ASC),
  INDEX `fk_users_has_replies_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_users_has_replies_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `jverhoev5_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_replies_replies1`
    FOREIGN KEY (`replies_id`)
    REFERENCES `jverhoev5_db`.`replies` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`news`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`news` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `content` TEXT NULL,
  `users_id` INT NOT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_news_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_news_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `jverhoev5_db`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jverhoev5_db`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jverhoev5_db`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `link` VARCHAR(100) NULL,
  `rights_id` INT NULL,
  `parent` INT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_menu_rights1_idx` (`rights_id` ASC),
  INDEX `fk_menu_menu1_idx` (`parent` ASC),
  CONSTRAINT `fk_menu_rights1`
    FOREIGN KEY (`rights_id`)
    REFERENCES `jverhoev5_db`.`rights` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_menu1`
    FOREIGN KEY (`parent`)
    REFERENCES `jverhoev5_db`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
