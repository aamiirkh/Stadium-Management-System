-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema stadium_database
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema stadium_database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `stadium_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `stadium_database` ;

-- -----------------------------------------------------
-- Table `stadium_database`.`team`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`team` (
  `team_id` INT NOT NULL,
  `team_name` VARCHAR(50) NOT NULL,
  `no_of_team_members` INT NULL DEFAULT NULL,
  PRIMARY KEY (`team_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`billing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`billing` (
  `invoice_number` INT NOT NULL,
  `total_cost` INT NOT NULL,
  `team_ID` INT NOT NULL,
  PRIMARY KEY (`invoice_number`),
  UNIQUE INDEX `team_ID_UNIQUE` (`team_ID` ASC) VISIBLE,
  CONSTRAINT `billing_team_id_fk`
    FOREIGN KEY (`team_ID`)
    REFERENCES `stadium_database`.`team` (`team_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`location` (
  `location_id` INT NOT NULL,
  `address` VARCHAR(150) NOT NULL,
  `postal_code` INT NOT NULL,
  `city` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`location_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`stadium`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`stadium` (
  `stadium_id` INT NOT NULL,
  `stadium_name` VARCHAR(100) NOT NULL,
  `stadium_type` VARCHAR(20) NOT NULL,
  `stadium_capacity` INT NOT NULL,
  `location_id` INT NOT NULL,
  PRIMARY KEY (`stadium_id`),
  INDEX `stadium_location_fk` (`location_id` ASC) VISIBLE,
  CONSTRAINT `stadium_location_fk`
    FOREIGN KEY (`location_id`)
    REFERENCES `stadium_database`.`location` (`location_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`reservation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`reservation` (
  `reservation_id` INT NOT NULL,
  `Date` DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `team_id` INT NOT NULL,
  `stadium_id` INT NOT NULL,
  PRIMARY KEY (`reservation_id`),
  INDEX `reservation_stadium_fk` (`stadium_id` ASC) VISIBLE,
  INDEX `reservation_team_fk` (`team_id` ASC) VISIBLE,
  CONSTRAINT `reservation_stadium_fk`
    FOREIGN KEY (`stadium_id`)
    REFERENCES `stadium_database`.`stadium` (`stadium_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `reservation_team_fk`
    FOREIGN KEY (`team_id`)
    REFERENCES `stadium_database`.`team` (`team_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`duration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`duration` (
  `reservation_id` INT NOT NULL,
  `end_time` TIME NOT NULL,
  `no_of_reservation_hours` INT NOT NULL,
  PRIMARY KEY (`reservation_id`),
  CONSTRAINT `duration_reservation_fk`
    FOREIGN KEY (`reservation_id`)
    REFERENCES `stadium_database`.`reservation` (`reservation_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`jobs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`jobs` (
  `job_id` VARCHAR(10) NOT NULL,
  `job_title` VARCHAR(50) NOT NULL,
  `salary` INT NOT NULL,
  PRIMARY KEY (`job_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`seat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`seat` (
  `seat_type` VARCHAR(15) NOT NULL,
  `ticket_price` INT NOT NULL,
  PRIMARY KEY (`seat_type`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`staff` (
  `staff_id` INT NOT NULL,
  `f_name` VARCHAR(20) NOT NULL,
  `l_name` VARCHAR(20) NOT NULL,
  `phone_number` VARCHAR(11) NOT NULL,
  `hire_date` DATE NOT NULL,
  `job_id` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`staff_id`),
  INDEX `staff_jobs_fk` (`job_id` ASC) VISIBLE,
  CONSTRAINT `staff_jobs_fk`
    FOREIGN KEY (`job_id`)
    REFERENCES `stadium_database`.`jobs` (`job_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`team_member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`team_member` (
  `member_id` INT NOT NULL,
  `team_id` INT NOT NULL,
  `f_name` VARCHAR(20) NOT NULL,
  `l_name` VARCHAR(20) NULL DEFAULT NULL,
  `age` INT NOT NULL,
  `phone_number` VARCHAR(11) NOT NULL,
  `sex` CHAR(1) NULL DEFAULT NULL,
  `role` VARCHAR(25) NULL DEFAULT NULL,
  PRIMARY KEY (`member_id`),
  INDEX `team_member_team_fk` (`team_id` ASC) VISIBLE,
  CONSTRAINT `team_member_team_fk`
    FOREIGN KEY (`team_id`)
    REFERENCES `stadium_database`.`team` (`team_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `stadium_database`.`ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `stadium_database`.`ticket` (
  `ticket_id` INT NOT NULL,
  `reservation_id` INT NOT NULL,
  `stadium_id` INT NOT NULL,
  `seat_type` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  INDEX `ticket_seat_fk` (`seat_type` ASC) VISIBLE,
  INDEX `ticket_stadium_fk` (`stadium_id` ASC) VISIBLE,
  INDEX `ticket_reservation_fk_idx` (`reservation_id` ASC) VISIBLE,
  CONSTRAINT `ticket_seat_fk`
    FOREIGN KEY (`seat_type`)
    REFERENCES `stadium_database`.`seat` (`seat_type`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ticket_stadium_fk`
    FOREIGN KEY (`stadium_id`)
    REFERENCES `stadium_database`.`stadium` (`stadium_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `ticket_reservation_fk`
    FOREIGN KEY (`reservation_id`)
    REFERENCES `stadium_database`.`reservation` (`reservation_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
