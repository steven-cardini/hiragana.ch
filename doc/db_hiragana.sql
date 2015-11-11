-- MySQL Script generated by MySQL Workbench
-- 11/11/15 20:47:25
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema hiragana
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hiragana
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hiragana` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `hiragana` ;

-- -----------------------------------------------------
-- Table `hiragana`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`user` (
  `email` VARCHAR(40) NOT NULL,
  `nickname` VARCHAR(20) NOT NULL,
  `pwd_hash` CHAR(32) NULL,
  `pwd_salt` CHAR(16) NULL,
  `t_registered` DATETIME NULL,
  `admin_rights` TINYINT(1) NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`course` (
  `course_id` SMALLINT(6) UNSIGNED NOT NULL,
  `name_en` VARCHAR(40) NULL,
  `name_de` VARCHAR(40) NULL,
  PRIMARY KEY (`course_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`lesson` (
  `course_id` SMALLINT(6) UNSIGNED NOT NULL,
  `lesson_nr` TINYINT(4) UNSIGNED NOT NULL,
  `name_en` VARCHAR(40) NULL,
  `name_de` VARCHAR(40) NULL,
  `points` INT(8) UNSIGNED NULL,
  `t_added` DATETIME NULL,
  PRIMARY KEY (`course_id`, `lesson_nr`),
  CONSTRAINT `fk_lesson_course`
    FOREIGN KEY (`course_id`)
    REFERENCES `hiragana`.`course` (`course_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`exercise` (
  `exercise_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` SMALLINT(6) UNSIGNED NULL,
  `lesson_nr` TINYINT(4) UNSIGNED NULL,
  `question` VARCHAR(50) NULL,
  `answer` VARCHAR(50) NULL,
  PRIMARY KEY (`exercise_id`),
  INDEX `fk_exercise_lesson_idx` (`course_id` ASC, `lesson_nr` ASC),
  CONSTRAINT `fk_exercise_lesson`
    FOREIGN KEY (`course_id` , `lesson_nr`)
    REFERENCES `hiragana`.`lesson` (`course_id` , `lesson_nr`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`user_lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`user_lesson` (
  `email` VARCHAR(40) NOT NULL,
  `course_id` SMALLINT(6) UNSIGNED NOT NULL,
  `lesson_nr` TINYINT(4) UNSIGNED NOT NULL,
  `t_started` DATETIME NOT NULL,
  `t_completed` DATETIME NULL,
  PRIMARY KEY (`email`, `course_id`, `lesson_nr`, `t_started`),
  INDEX `fk_user_lesson_lesson_idx` (`course_id` ASC, `lesson_nr` ASC),
  CONSTRAINT `fk_user_lesson_user`
    FOREIGN KEY (`email`)
    REFERENCES `hiragana`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_lesson_lesson`
    FOREIGN KEY (`course_id` , `lesson_nr`)
    REFERENCES `hiragana`.`lesson` (`course_id` , `lesson_nr`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`user_exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`user_exercise` (
  `email` VARCHAR(40) NOT NULL,
  `exercise_id` INT UNSIGNED NOT NULL,
  `t_answered` VARCHAR(45) NOT NULL,
  `correct` TINYINT(1) NULL,
  PRIMARY KEY (`email`, `exercise_id`, `t_answered`),
  INDEX `fk_user_exercise_exercise_idx` (`exercise_id` ASC),
  CONSTRAINT `fk_user_exercise_user`
    FOREIGN KEY (`email`)
    REFERENCES `hiragana`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_exercise_exercise`
    FOREIGN KEY (`exercise_id`)
    REFERENCES `hiragana`.`exercise` (`exercise_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;