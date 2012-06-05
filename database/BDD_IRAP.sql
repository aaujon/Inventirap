SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`admi_material`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`admi_material` (
  `id_adm_material` INT NOT NULL AUTO_INCREMENT ,
  `designation` VARCHAR(30) NULL ,
  `num_irap` VARCHAR(10) NULL ,
  `organisme` VARCHAR(20) NULL ,
  `type_materiel` ENUM('Inv', 'Tech', 'InvTech') NULL ,
  `supplier_name` VARCHAR(20) NULL ,
  `price_ht` INT NULL ,
  `eotp` VARCHAR(45) NULL ,
  `command_num` VARCHAR(45) NULL ,
  `code_comptable` VARCHAR(45) NULL ,
  `groupe_thematique` VARCHAR(45) NULL ,
  `groupe_metier` VARCHAR(45) NULL ,
  `exp_proj_service` VARCHAR(45) NULL ,
  `ref_existante` VARCHAR(45) NULL ,
  `lieu_stockage` VARCHAR(45) NULL ,
  `nom_utilisateur` VARCHAR(45) NULL ,
  `mail_utilisateur` VARCHAR(45) NULL ,
  `date_acquisition` DATE NULL ,
  PRIMARY KEY (`id_adm_material`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`category` (
  `id_category` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_category`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sub_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`sub_category` (
  `id_sub_category` INT NOT NULL AUTO_INCREMENT ,
  `category_id` INT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_sub_category`) ,
  INDEX `category_id` (`category_id` ASC) ,
  CONSTRAINT `category_id`
    FOREIGN KEY (`category_id` )
    REFERENCES `mydb`.`category` (`id_category` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tech_materiel`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tech_materiel` (
  `id_tech_materiel` INT NOT NULL AUTO_INCREMENT ,
  `model` VARCHAR(45) NULL ,
  `caracteristic` VARCHAR(45) NULL ,
  `serial_number` VARCHAR(45) NULL ,
  `primary_accessory` TINYINT(1) NULL ,
  `primary_material_number` INT NULL ,
  `primary_accessory` INT NULL ,
  `have_accessory` TINYINT(1) NULL ,
  `accessory` VARCHAR(45) NULL ,
  `accessory_inventory_number` INT NULL ,
  `sub_category_id` INT NULL ,
  PRIMARY KEY (`id_tech_materiel`) ,
  INDEX `category` (`sub_category_id` ASC) ,
  CONSTRAINT `category`
    FOREIGN KEY (`sub_category_id` )
    REFERENCES `mydb`.`sub_category` (`id_sub_category` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`history` (
  `id_calibration` INT NOT NULL AUTO_INCREMENT ,
  `type` ENUM('Maintenance', 'Etalonnage', 'Verification') NULL ,
  `date_last_calibration` DATE NULL ,
  `organism_informations` VARCHAR(100) NULL ,
  `frenquency` INT NULL ,
  `date_next_control` DATE NULL ,
  `comments` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_calibration`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`internal_loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`internal_loan` (
  `id_internal_loan` INT NOT NULL AUTO_INCREMENT ,
  `loan_date` DATE NULL ,
  `piece` VARCHAR(45) NULL ,
  `responsible` VARCHAR(45) NULL ,
  `loan_return_date` DATE NULL ,
  PRIMARY KEY (`id_internal_loan`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`external_loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`external_loan` (
  `id_external_loan` INT NOT NULL ,
  `loan_date` DATE NULL ,
  `laboratory` VARCHAR(45) NULL ,
  `responsible` VARCHAR(45) NULL ,
  `responsible_number` INT NULL ,
  `loan_return_date` DATE NULL ,
  PRIMARY KEY (`id_external_loan`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`admi_material_has_external_loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`admi_material_has_external_loan` (
  `admi_material_id_adm_material` INT NOT NULL ,
  `external_loan_id_external_loan` INT NOT NULL ,
  PRIMARY KEY (`admi_material_id_adm_material`, `external_loan_id_external_loan`) ,
  INDEX `fk_admi_material_has_external_loan_external_loan1` (`external_loan_id_external_loan` ASC) ,
  INDEX `fk_admi_material_has_external_loan_admi_material1` (`admi_material_id_adm_material` ASC) ,
  CONSTRAINT `fk_admi_material_has_external_loan_admi_material1`
    FOREIGN KEY (`admi_material_id_adm_material` )
    REFERENCES `mydb`.`admi_material` (`id_adm_material` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_admi_material_has_external_loan_external_loan1`
    FOREIGN KEY (`external_loan_id_external_loan` )
    REFERENCES `mydb`.`external_loan` (`id_external_loan` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tech_materiel_has_external_loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tech_materiel_has_external_loan` (
  `tech_materiel_id_tech_materiel` INT NOT NULL ,
  `external_loan_id_external_loan` INT NOT NULL ,
  PRIMARY KEY (`tech_materiel_id_tech_materiel`, `external_loan_id_external_loan`) ,
  INDEX `fk_tech_materiel_has_external_loan_external_loan1` (`external_loan_id_external_loan` ASC) ,
  INDEX `fk_tech_materiel_has_external_loan_tech_materiel1` (`tech_materiel_id_tech_materiel` ASC) ,
  CONSTRAINT `fk_tech_materiel_has_external_loan_tech_materiel1`
    FOREIGN KEY (`tech_materiel_id_tech_materiel` )
    REFERENCES `mydb`.`tech_materiel` (`id_tech_materiel` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tech_materiel_has_external_loan_external_loan1`
    FOREIGN KEY (`external_loan_id_external_loan` )
    REFERENCES `mydb`.`external_loan` (`id_external_loan` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`admi_material_has_internal_loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`admi_material_has_internal_loan` (
  `admi_material_id_adm_material` INT NOT NULL ,
  `internal_loan_id_internal_loan` INT NOT NULL ,
  PRIMARY KEY (`admi_material_id_adm_material`, `internal_loan_id_internal_loan`) ,
  INDEX `fk_admi_material_has_internal_loan_internal_loan1` (`internal_loan_id_internal_loan` ASC) ,
  INDEX `fk_admi_material_has_internal_loan_admi_material1` (`admi_material_id_adm_material` ASC) ,
  CONSTRAINT `fk_admi_material_has_internal_loan_admi_material1`
    FOREIGN KEY (`admi_material_id_adm_material` )
    REFERENCES `mydb`.`admi_material` (`id_adm_material` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_admi_material_has_internal_loan_internal_loan1`
    FOREIGN KEY (`internal_loan_id_internal_loan` )
    REFERENCES `mydb`.`internal_loan` (`id_internal_loan` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tech_materiel_has_internal_loan`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tech_materiel_has_internal_loan` (
  `tech_materiel_id_tech_materiel` INT NOT NULL ,
  `internal_loan_id_internal_loan` INT NOT NULL ,
  PRIMARY KEY (`tech_materiel_id_tech_materiel`, `internal_loan_id_internal_loan`) ,
  INDEX `fk_tech_materiel_has_internal_loan_internal_loan1` (`internal_loan_id_internal_loan` ASC) ,
  INDEX `fk_tech_materiel_has_internal_loan_tech_materiel1` (`tech_materiel_id_tech_materiel` ASC) ,
  CONSTRAINT `fk_tech_materiel_has_internal_loan_tech_materiel1`
    FOREIGN KEY (`tech_materiel_id_tech_materiel` )
    REFERENCES `mydb`.`tech_materiel` (`id_tech_materiel` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tech_materiel_has_internal_loan_internal_loan1`
    FOREIGN KEY (`internal_loan_id_internal_loan` )
    REFERENCES `mydb`.`internal_loan` (`id_internal_loan` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`admi_material_has_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`admi_material_has_history` (
  `admi_material_id_adm_material` INT NOT NULL ,
  `history_id_calibration` INT NOT NULL ,
  PRIMARY KEY (`admi_material_id_adm_material`, `history_id_calibration`) ,
  INDEX `fk_admi_material_has_history_history1` (`history_id_calibration` ASC) ,
  INDEX `fk_admi_material_has_history_admi_material1` (`admi_material_id_adm_material` ASC) ,
  CONSTRAINT `fk_admi_material_has_history_admi_material1`
    FOREIGN KEY (`admi_material_id_adm_material` )
    REFERENCES `mydb`.`admi_material` (`id_adm_material` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_admi_material_has_history_history1`
    FOREIGN KEY (`history_id_calibration` )
    REFERENCES `mydb`.`history` (`id_calibration` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tech_materiel_has_history`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`tech_materiel_has_history` (
  `tech_materiel_id_tech_materiel` INT NOT NULL ,
  `history_id_calibration` INT NOT NULL ,
  PRIMARY KEY (`tech_materiel_id_tech_materiel`, `history_id_calibration`) ,
  INDEX `fk_tech_materiel_has_history_history1` (`history_id_calibration` ASC) ,
  INDEX `fk_tech_materiel_has_history_tech_materiel1` (`tech_materiel_id_tech_materiel` ASC) ,
  CONSTRAINT `fk_tech_materiel_has_history_tech_materiel1`
    FOREIGN KEY (`tech_materiel_id_tech_materiel` )
    REFERENCES `mydb`.`tech_materiel` (`id_tech_materiel` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tech_materiel_has_history_history1`
    FOREIGN KEY (`history_id_calibration` )
    REFERENCES `mydb`.`history` (`id_calibration` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
