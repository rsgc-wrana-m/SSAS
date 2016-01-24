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
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`student` (
  `id` INT NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NULL,
  `password` VARCHAR(45) NOT NULL,
  `salt` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`missiontype`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`missiontype` (
  `id` INT NOT NULL,
  `Type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`mission` (
  `id` INT NOT NULL,
  `missiontype_id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `rubric` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mission_missiontypes_idx` (`missiontype_id` ASC),
  CONSTRAINT `fk_mission_missiontypes`
    FOREIGN KEY (`missiontype_id`)
    REFERENCES `mydb`.`missiontype` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`rejectedmission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`rejectedmission` (
  `id` INT NOT NULL,
  `mission_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rejectedmission_mission1_idx` (`mission_id` ASC),
  INDEX `fk_rejectedmission_student1_idx` (`student_id` ASC),
  CONSTRAINT `fk_rejectedmission_mission1`
    FOREIGN KEY (`mission_id`)
    REFERENCES `mydb`.`mission` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rejectedmission_student1`
    FOREIGN KEY (`student_id`)
    REFERENCES `mydb`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`acceptedmission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`acceptedmission` (
  `id` INT NOT NULL,
  `mission_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_acceptedmission_mission1_idx` (`mission_id` ASC),
  INDEX `fk_acceptedmission_student1_idx` (`student_id` ASC),
  CONSTRAINT `fk_acceptedmission_mission1`
    FOREIGN KEY (`mission_id`)
    REFERENCES `mydb`.`mission` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_acceptedmission_student1`
    FOREIGN KEY (`student_id`)
    REFERENCES `mydb`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`failedmission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`failedmission` (
  `id` INT NOT NULL,
  `mission_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_failedmission_mission1_idx` (`mission_id` ASC),
  INDEX `fk_failedmission_student1_idx` (`student_id` ASC),
  CONSTRAINT `fk_failedmission_mission1`
    FOREIGN KEY (`mission_id`)
    REFERENCES `mydb`.`mission` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_failedmission_student1`
    FOREIGN KEY (`student_id`)
    REFERENCES `mydb`.`student` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`chainmission`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`chainmission` (
  `id` INT NOT NULL,
  `chain_id` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`teacher`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`teacher` (
  `id` INT NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `salt` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
