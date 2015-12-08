-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`teachers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`teachers` (
  `id` INT NOT NULL COMMENT '',
  `email` VARCHAR(45) NULL COMMENT '',
  `username` VARCHAR(45) NULL COMMENT '',
  `pw` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`prescriptions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`prescriptions` (
  `id` INT NOT NULL COMMENT '',
  `name` VARCHAR(45) NULL COMMENT '',
  `desc` VARCHAR(45) NULL COMMENT '',
  `time` INT NULL COMMENT '',
  `rewardp` INT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`students` (
  `id` INT NOT NULL COMMENT '',
  `email` VARCHAR(45) NULL COMMENT '',
  `username` VARCHAR(45) NULL COMMENT '',
  `pw` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`userdata`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`userdata` (
  `id` INT NOT NULL COMMENT '',
  `students_id` INT NOT NULL COMMENT '',
  `points` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  INDEX `fk_userdata_students_idx` (`students_id` ASC)  COMMENT '',
  CONSTRAINT `fk_userdata_students`
    FOREIGN KEY (`students_id`)
    REFERENCES `mydb`.`students` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`teachers`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`teachers` (`id`, `email`, `username`, `pw`) VALUES (1, 'pdarvasi@rsgc.on.ca', 'PDarvasi', 'English185');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`prescriptions`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`prescriptions` (`id`, `name`, `desc`, `time`, `rewardp`) VALUES (1, 'Essay on Germany', 'Write a 5000 word essay on german independance', 86, 54);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`students`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`students` (`id`, `email`, `username`, `pw`) VALUES (1, 'sbowlby@rsgc.on.ca', 'ScottBowlby', 'IAmScott');
INSERT INTO `mydb`.`students` (`id`, `email`, `username`, `pw`) VALUES (2, 'cmolloy@rsgc.on.ca', 'ChrisMolloy', 'Whales123');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`userdata`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`userdata` (`id`, `students_id`, `points`) VALUES (1, 1, '10');
INSERT INTO `mydb`.`userdata` (`id`, `students_id`, `points`) VALUES (2, 2, '56');

COMMIT;

