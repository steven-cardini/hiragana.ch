SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

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
  `pwd_hash` CHAR(32) NOT NULL,
  `pwd_salt` CHAR(16) NOT NULL,
  `t_registered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`course` (
  `course_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` VARCHAR(40) NOT NULL,
  `name_de` VARCHAR(40) NOT NULL,
  PRIMARY KEY (`course_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`lesson` (
  `lesson_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT UNSIGNED NOT NULL,
  `lesson_nr` INT UNSIGNED NOT NULL,
  `name_en` VARCHAR(40) NOT NULL,
  `name_de` VARCHAR(40) NOT NULL,
  `points` INT UNSIGNED NOT NULL,
  `t_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lesson_id`),
  INDEX `ind_course_id_3324` (`course_id` ASC),
  CONSTRAINT `fk_lesson_course_23423`
    FOREIGN KEY (`course_id`)
    REFERENCES `hiragana`.`course` (`course_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`exercise` (
  `exercise_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesson_id` INT UNSIGNED NOT NULL,
  `question` VARCHAR(50) NOT NULL,
  `answer_en` VARCHAR(50) NOT NULL,
  `answer_de` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`exercise_id`),
  INDEX `fk_excercise_lesson_8733_idx` (`lesson_id` ASC),
  CONSTRAINT `fk_excercise_lesson_8733`
    FOREIGN KEY (`lesson_id`)
    REFERENCES `hiragana`.`lesson` (`lesson_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`user_lesson`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`user_lesson` (
  `email` VARCHAR(40) NOT NULL,
  `lesson_id` INT UNSIGNED NOT NULL,
  `t_started` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `t_completed` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`, `lesson_id`, `t_started`),
  INDEX `fk_user_lesson_lesson_2343_idx` (`lesson_id` ASC),
  CONSTRAINT `fk_user_lesson_user_4384`
    FOREIGN KEY (`email`)
    REFERENCES `hiragana`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_lesson_lesson_2343`
    FOREIGN KEY (`lesson_id`)
    REFERENCES `hiragana`.`lesson` (`lesson_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hiragana`.`user_exercise`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hiragana`.`user_exercise` (
  `email` VARCHAR(40) NOT NULL,
  `exercise_id` INT UNSIGNED NOT NULL,
  `t_answered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `correct` TINYINT(1) NOT NULL,
  PRIMARY KEY (`email`, `exercise_id`, `t_answered`),
  INDEX `fk_user_exercise_exercise_idx` (`exercise_id` ASC),
  CONSTRAINT `fk_user_exercise_exercise_3849`
    FOREIGN KEY (`exercise_id`)
    REFERENCES `hiragana`.`exercise` (`exercise_id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_user_exercise_user_4384`
    FOREIGN KEY (`email`)
    REFERENCES `hiragana`.`user` (`email`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
