SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`categories` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sub_categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`sub_categories` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`sub_categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `category_id` INT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `category_id` (`category_id` ASC) ,
  CONSTRAINT `category_id`
    FOREIGN KEY (`category_id` )
    REFERENCES `mydb`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`thematic_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`thematic_groups` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`thematic_groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`work_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`work_groups` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`work_groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`materials`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`materials` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`materials` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `designation` VARCHAR(30) NULL ,
  `sub_category_id` INT NOT NULL ,
  `irap_number` VARCHAR(12) NULL ,
  `description` VARCHAR(100) NULL ,
  `organism` VARCHAR(20) NULL ,
  `isAdministrative` TINYINT(1) NULL ,
  `isTechnical` TINYINT(1) NULL ,
  `status` VARCHAR(15) NULL DEFAULT 'CREATED' ,
  `supplier_name` VARCHAR(20) NULL ,
  `price_ht` FLOAT UNSIGNED NULL ,
  `eotp` VARCHAR(45) NULL ,
  `command_number` VARCHAR(45) NULL ,
  `accountable_code` VARCHAR(45) NULL ,
  `serial_number` VARCHAR(45) NULL ,
  `thematic_group_id` INT NOT NULL ,
  `work_group_id` INT NOT NULL ,
  `ref_existante` VARCHAR(45) NULL ,
  `storage_place` VARCHAR(45) NULL ,
  `storage_description` VARCHAR(45) NULL ,
  `user_name` VARCHAR(45) NULL ,
  `user_mail` VARCHAR(45) NULL ,
  `acquisition_date` DATE NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_administrative_materials_sub_categories1` (`sub_category_id` ASC) ,
  INDEX `fk_materials_thematic_group1` (`thematic_group_id` ASC) ,
  INDEX `fk_materials_work_group1` (`work_group_id` ASC) ,
  CONSTRAINT `fk_administrative_materials_sub_categories1`
    FOREIGN KEY (`sub_category_id` )
    REFERENCES `mydb`.`sub_categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materials_thematic_group1`
    FOREIGN KEY (`thematic_group_id` )
    REFERENCES `mydb`.`thematic_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materials_work_group1`
    FOREIGN KEY (`work_group_id` )
    REFERENCES `mydb`.`work_groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`special_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`special_users` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`special_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `ldap` VARCHAR(45) NULL ,
  `role` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`histories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`histories` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`histories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `material_id` INT NOT NULL ,
  `date_last_calibration` DATE NULL ,
  `date_next_control` DATE NULL ,
  `intervention_type` VARCHAR(45) NULL ,
  `organism_informations` VARCHAR(100) NULL ,
  `frenquency` INT NULL ,
  `comments` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_admi_material_histories_admi_materials1` (`material_id` ASC) ,
  CONSTRAINT `fk_admi_material_histories_admi_materials1`
    FOREIGN KEY (`material_id` )
    REFERENCES `mydb`.`materials` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`loans`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`loans` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`loans` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `material_id` INT NOT NULL ,
  `loan_date` DATE NULL ,
  `piece` VARCHAR(45) NULL ,
  `responsible` VARCHAR(45) NULL ,
  `loan_return_date` DATE NULL ,
  `is_internal` TINYINT(1) NULL ,
  `laboratory` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_technical_materials_internal_loans_copy1_admi_materials1` (`material_id` ASC) ,
  CONSTRAINT `fk_technical_materials_internal_loans_copy1_admi_materials1`
    FOREIGN KEY (`material_id` )
    REFERENCES `mydb`.`materials` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (1, 'Multimetre');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (2, 'Oscilloscope');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (3, 'Mesure simple');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (4, 'Générateur de fonctions');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (5, 'Atténuateur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (6, 'Amplificateur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (7, 'RF/Hyperfréquence');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (8, 'Champs magnétique');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (9, 'Analyseur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (10, 'Sonde');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (11, 'Effaceur de mémoire');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (12, 'Programmateur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (13, 'Balance');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (14, 'Longeur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (15, 'Angle');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (16, 'Extensometrie');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (17, 'Couple');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (18, 'Accélération');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (19, 'Fluxmetre');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (20, 'Laser');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (21, 'Analyseur de faisceau laser');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (22, 'Optomètre');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (23, 'Source optique');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (24, 'Mesure du temps');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (25, 'Composant étalon');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (26, 'Pression');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (27, 'Température');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (28, 'Contamination');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (29, 'Hygrometrie');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (30, 'Débit');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (31, 'Centrale et data logger');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (32, 'Carte d\'aquisition PC');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (33, 'Alimentation');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (34, 'Transformateur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (35, 'Station de soudage');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (36, 'Bobineuse');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (37, 'Compresseur');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (38, 'Enceinte à vide');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (39, 'Etuve/Enceinte thermique');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (40, 'Pompes');
INSERT INTO `mydb`.`categories` (`id`, `name`) VALUES (41, 'Matériel informatique en prêt');

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`sub_categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (1, 1, 'RUI');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (2, 1, 'RUI + LC');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (3, 1, 'Précision');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (4, 2, 'Analogique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (5, 2, 'Numérique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (6, 2, 'Combiscope');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (7, 3, 'Voltmètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (8, 3, 'Ampèremètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (9, 3, 'Ohmmètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (10, 3, 'Impédencemètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (11, 3, 'Capacimètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (12, 3, 'Inductancemètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (13, 3, 'Wattmètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (14, 4, 'Pulse/Fréquences');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (15, 4, 'Polyvalent');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (16, 4, 'Arbitraire');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (17, 4, 'Bruit');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (18, 4, 'Référence U I');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (19, 5, 'Haute tension');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (20, 5, 'Alternatif');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (21, 5, 'VHF');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (22, 6, 'Tension');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (23, 6, 'Courant');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (24, 7, 'Synthétiseur');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (25, 7, 'Générateur');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (26, 7, 'Testeur de cable');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (27, 7, 'TOSmètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (28, 8, 'Gaussmetre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (29, 9, 'Spectre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (30, 9, 'Logique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (31, 9, 'Réseau');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (32, 10, 'Active');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (33, 10, 'Tension');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (34, 10, 'Différentielle');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (35, 10, 'Courant');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (36, 11, 'UV');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (37, 12, 'Composant');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (38, 12, 'FPGA');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (39, 12, 'Mémoire');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (40, 13, 'Mécanique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (41, 13, 'Analogique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (42, 13, 'Numérique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (43, 14, 'Tri Dim');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (44, 14, 'Colonne');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (45, 14, 'Comparateur');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (46, 14, 'Cales etalon');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (47, 14, 'Pied à coulisse');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (48, 15, 'Inclinomètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (49, 15, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (50, 16, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (51, 17, 'Clé dynamomètrique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (52, 17, 'Tournevis dynamomètrique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (53, 18, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (54, 19, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (55, 20, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (56, 21, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (57, 22, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (58, 23, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (59, 24, 'Chronomètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (60, 24, 'Compteur');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (61, 24, 'Fréquencemètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (62, 25, 'Diode a bruit');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (63, 25, 'Pont RLC');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (64, 26, 'Pression atmosphérique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (65, 26, 'Détendeur manomètre');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (66, 26, 'Vide primaire 10 2Pa < P < 10 5Pa');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (67, 26, 'Vide moyen 10 –1Pa < P < 10 2Pa');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (68, 26, 'Vide poussé 10 –5Pa < P < 10 – 1Pa');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (69, 26, 'Ultravide P < 10 –5Pa');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (70, 27, 'Température de surface');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (71, 27, 'Température d\'air / ambiante');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (72, 27, 'Thermocouple');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (73, 28, 'Compteur de particules');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (74, 28, 'Lampe UV');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (75, 29, 'Enregistreur');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (76, 29, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (77, 30, 'Débit volumique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (78, 30, 'Débit massique');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (79, 31, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (80, 32, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (81, 33, 'Tension');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (82, 33, 'Courant');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (83, 33, 'Tension + courant');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (84, 33, 'Puissance');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (85, 33, 'Haute Tension');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (86, 33, 'Onduleur');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (87, 33, 'Batterie');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (88, 33, 'Sondes');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (89, 34, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (90, 35, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (91, 36, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (92, 37, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (93, 38, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (94, 39, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (95, 40, 'Defaut');
INSERT INTO `mydb`.`sub_categories` (`id`, `category_id`, `name`) VALUES (96, 41, 'Defaut');

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`thematic_groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`thematic_groups` (`id`, `name`) VALUES (1, 'GPPS');
INSERT INTO `mydb`.`thematic_groups` (`id`, `name`) VALUES (2, 'PSE');
INSERT INTO `mydb`.`thematic_groups` (`id`, `name`) VALUES (3, 'MICMAC');
INSERT INTO `mydb`.`thematic_groups` (`id`, `name`) VALUES (4, 'GAHEC');
INSERT INTO `mydb`.`thematic_groups` (`id`, `name`) VALUES (5, 'SISU');
INSERT INTO `mydb`.`thematic_groups` (`id`, `name`) VALUES (6, 'SG');

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`work_groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (1, 'N/A');
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (2, 'GEDI');
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (3, 'GT2I');
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (4, 'GI');
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (5, 'GACL');
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (6, 'GGPAQ');
INSERT INTO `mydb`.`work_groups` (`id`, `name`) VALUES (7, 'GM');

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`materials`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`materials` (`id`, `designation`, `sub_category_id`, `irap_number`, `description`, `organism`, `isAdministrative`, `isTechnical`, `status`, `supplier_name`, `price_ht`, `eotp`, `command_number`, `accountable_code`, `serial_number`, `thematic_group_id`, `work_group_id`, `ref_existante`, `storage_place`, `storage_description`, `user_name`, `user_mail`, `acquisition_date`) VALUES (NULL, 'Macbook air', 2, 'IRAP-12-0001', 'Ceci est une description un peu nulle', 'IRAP', 1, 0, 'CREATED', 'Apple', 1000, 'WTF', 'ZERZE45', '44', NULL, 1, 1, NULL, 'B', 'Chambre', 'Stephane', 'steph@ne.fr', '2012-07-04');
INSERT INTO `mydb`.`materials` (`id`, `designation`, `sub_category_id`, `irap_number`, `description`, `organism`, `isAdministrative`, `isTechnical`, `status`, `supplier_name`, `price_ht`, `eotp`, `command_number`, `accountable_code`, `serial_number`, `thematic_group_id`, `work_group_id`, `ref_existante`, `storage_place`, `storage_description`, `user_name`, `user_mail`, `acquisition_date`) VALUES (NULL, 'Macbook retina', 5, 'IRAP-12-0002', 'Ceci est une description pas vraiment mieux que la premiere', NULL, 1, 1, 'CREATED', 'Apple', 2000, NULL, 'RETRT45', '44', NULL, 3, 4, NULL, 'A', 'Etagère', 'Pierrick', 'pierr@rick.com', '2012-07-04');

COMMIT;
