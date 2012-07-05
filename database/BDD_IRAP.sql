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
  `name` VARCHAR(45) NULL ,
  `category_id` INT NULL ,
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
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (1, 'RUI', 1);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (2, 'RUI + LC', 1);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (3, 'Précision', 1);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (4, 'Analogique', 2);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (5, 'Numérique', 2);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (6, 'Combiscope', 2);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (7, 'Voltmètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (8, 'Ampèremètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (9, 'Ohmmètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (10, 'Impédencemètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (11, 'Capacimètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (12, 'Inductancemètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (13, 'Wattmètre', 3);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (14, 'Pulse/Fréquences', 4);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (15, 'Polyvalent', 4);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (16, 'Arbitraire', 4);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (17, 'Bruit', 4);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (18, 'Référence U I', 4);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (19, 'Haute tension', 5);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (20, 'Alternatif', 5);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (21, 'VHF', 5);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (22, 'Tension', 6);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (23, 'Courant', 6);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (24, 'Synthétiseur', 7);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (25, 'Générateur', 7);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (26, 'Testeur de cable', 7);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (27, 'TOSmètre', 7);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (28, 'Gaussmetre', 8);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (29, 'Spectre', 9);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (30, 'Logique', 9);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (31, 'Réseau', 9);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (32, 'Active', 10);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (33, 'Tension', 10);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (34, 'Différentielle', 10);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (35, 'Courant', 10);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (36, 'UV', 11);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (37, 'Composant', 12);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (38, 'FPGA', 12);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (39, 'Mémoire', 12);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (40, 'Mécanique', 13);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (41, 'Analogique', 13);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (42, 'Numérique', 13);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (43, 'Tri Dim', 14);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (44, 'Colonne', 14);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (45, 'Comparateur', 14);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (46, 'Cales etalon', 14);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (47, 'Pied à coulisse', 14);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (48, 'Inclinomètre', 15);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (49, 'Defaut', 15);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (50, 'Defaut', 16);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (51, 'Clé dynamomètrique', 17);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (52, 'Tournevis dynamomètrique', 17);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (53, 'Defaut', 18);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (54, 'Defaut', 19);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (55, 'Defaut', 20);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (56, 'Defaut', 21);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (57, 'Defaut', 22);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (58, 'Defaut', 23);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (59, 'Chronomètre', 24);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (60, 'Compteur', 24);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (61, 'Fréquencemètre', 24);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (62, 'Diode a bruit', 25);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (63, 'Pont RLC', 25);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (64, 'Pression atmosphérique', 26);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (65, 'Détendeur manomètre', 26);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (66, 'Vide primaire 10 2Pa < P < 10 5Pa', 26);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (67, 'Vide moyen 10 –1Pa < P < 10 2Pa', 26);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (68, 'Vide poussé 10 –5Pa < P < 10 – 1Pa', 26);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (69, 'Ultravide P < 10 –5Pa', 26);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (70, 'Température de surface', 27);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (71, 'Température d\'air / ambiante', 27);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (72, 'Thermocouple', 27);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (73, 'Compteur de particules', 28);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (74, 'Lampe UV', 28);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (75, 'Enregistreur', 29);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (76, 'Defaut', 29);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (77, 'Débit volumique', 30);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (78, 'Débit massique', 30);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (79, 'Defaut', 31);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (80, 'Defaut', 32);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (81, 'Tension', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (82, 'Courant', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (83, 'Tension + courant', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (84, 'Puissance', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (85, 'Haute Tension', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (86, 'Onduleur', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (87, 'Batterie', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (88, 'Sondes', 33);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (89, 'Defaut', 34);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (90, 'Defaut', 35);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (91, 'Defaut', 36);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (92, 'Defaut', 37);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (93, 'Defaut', 38);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (94, 'Defaut', 39);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (95, 'Defaut', 40);
INSERT INTO `mydb`.`sub_categories` (`id`, `name`, `category_id`) VALUES (96, 'Defaut', 41);

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
