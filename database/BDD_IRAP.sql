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
  `nom` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`sous_categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`sous_categories` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`sous_categories` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NULL ,
  `categorie_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `category_id` (`categorie_id` ASC) ,
  CONSTRAINT `category_id`
    FOREIGN KEY (`categorie_id` )
    REFERENCES `mydb`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`groupes_thematiques`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`groupes_thematiques` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`groupes_thematiques` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NULL ,
  `description` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`groupes_metiers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`groupes_metiers` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`groupes_metiers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NULL ,
  `description` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`materiels`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`materiels` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`materiels` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `designation` VARCHAR(30) NULL ,
  `categorie_id` INT NOT NULL ,
  `sous_categorie_id` INT NOT NULL ,
  `numero_irap` VARCHAR(12) NULL ,
  `description` VARCHAR(100) NULL ,
  `organisme` VARCHAR(20) NULL ,
  `materiel_administratif` TINYINT(1) NULL ,
  `materiel_technique` TINYINT(1) NULL ,
  `status` VARCHAR(15) NULL DEFAULT 'CREATED' ,
  `date_acquisition` DATE NULL ,
  `fournisseur` VARCHAR(20) NULL ,
  `prix_ht` FLOAT UNSIGNED NULL ,
  `eotp` VARCHAR(45) NULL ,
  `numero_commande` VARCHAR(45) NULL ,
  `code_comptable` VARCHAR(45) NULL ,
  `numero_serie` VARCHAR(45) NULL ,
  `groupes_thematique_id` INT NULL ,
  `groupes_metier_id` INT NULL ,
  `numero_inventaire_organisme` VARCHAR(45) NULL ,
  `lieu_stockage` VARCHAR(45) NULL ,
  `lieu_detail` VARCHAR(45) NULL ,
  `nom_responsable` VARCHAR(45) NULL ,
  `email_responsable` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_administrative_materials_sub_categories1` (`sous_categorie_id` ASC) ,
  INDEX `fk_materials_thematic_group1` (`groupes_thematique_id` ASC) ,
  INDEX `fk_materials_work_group1` (`groupes_metier_id` ASC) ,
  INDEX `fk_materiels_categories1` (`categorie_id` ASC) ,
  CONSTRAINT `fk_administrative_materials_sub_categories1`
    FOREIGN KEY (`sous_categorie_id` )
    REFERENCES `mydb`.`sous_categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materials_thematic_group1`
    FOREIGN KEY (`groupes_thematique_id` )
    REFERENCES `mydb`.`groupes_thematiques` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materials_work_group1`
    FOREIGN KEY (`groupes_metier_id` )
    REFERENCES `mydb`.`groupes_metiers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materiels_categories1`
    FOREIGN KEY (`categorie_id` )
    REFERENCES `mydb`.`categories` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`utilisateurs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`utilisateurs` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`utilisateurs` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NULL ,
  `login` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `role` VARCHAR(45) NULL ,
  `groupes_metier_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_utilisateurs_groupes_travails1` (`groupes_metier_id` ASC) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  CONSTRAINT `fk_utilisateurs_groupes_travails1`
    FOREIGN KEY (`groupes_metier_id` )
    REFERENCES `mydb`.`groupes_metiers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`suivis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`suivis` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`suivis` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `materiel_id` INT NOT NULL ,
  `date_controle` DATE NULL ,
  `date_prochain_controle` DATE NULL ,
  `type_intervention` VARCHAR(50) NULL ,
  `organisme` VARCHAR(50) NULL ,
  `frequence` INT NULL ,
  `commentaire` VARCHAR(100) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_admi_material_histories_admi_materials1` (`materiel_id` ASC) ,
  CONSTRAINT `fk_admi_material_histories_admi_materials1`
    FOREIGN KEY (`materiel_id` )
    REFERENCES `mydb`.`materiels` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`emprunts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`emprunts` ;

CREATE  TABLE IF NOT EXISTS `mydb`.`emprunts` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `materiel_id` INT NOT NULL ,
  `date_emprunt` DATE NULL ,
  `date_retour_emprunt` DATE NULL ,
  `emprunt_interne` TINYINT(1) NULL ,
  `laboratoire` VARCHAR(45) NULL ,
  `e_lieu_stockage` VARCHAR(45) NULL ,
  `e_lieu_detail` VARCHAR(45) NULL ,
  `nom_emprunteur` VARCHAR(45) NULL ,
  `email_emprunteur` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_technical_materials_internal_loans_copy1_admi_materials1` (`materiel_id` ASC) ,
  CONSTRAINT `fk_technical_materials_internal_loans_copy1_admi_materials1`
    FOREIGN KEY (`materiel_id` )
    REFERENCES `mydb`.`materiels` (`id` )
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
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (1, 'Multimetre');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (2, 'Oscilloscope');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (3, 'Mesure simple');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (4, 'Générateur de fonctions');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (5, 'Atténuateur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (6, 'Amplificateur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (7, 'RF/Hyperfréquence');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (8, 'Champs magnétique');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (9, 'Analyseur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (10, 'Sonde');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (11, 'Effaceur de mémoire');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (12, 'Programmateur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (13, 'Balance');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (14, 'Longeur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (15, 'Angle');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (16, 'Extensometrie');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (17, 'Couple');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (18, 'Accélération');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (19, 'Fluxmetre');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (20, 'Laser');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (21, 'Analyseur de faisceau laser');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (22, 'Optomètre');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (23, 'Source optique');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (24, 'Mesure du temps');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (25, 'Composant étalon');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (26, 'Pression');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (27, 'Température');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (28, 'Contamination');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (29, 'Hygrometrie');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (30, 'Débit');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (31, 'Centrale et data logger');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (32, 'Carte d\'aquisition PC');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (33, 'Alimentation');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (34, 'Transformateur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (35, 'Station de soudage');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (36, 'Bobineuse');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (37, 'Compresseur');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (38, 'Enceinte à vide');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (39, 'Etuve/Enceinte thermique');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (40, 'Pompes');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (41, 'Matériel informatique en prêt');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (42, 'Electronique (old)');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (43, 'Informatique (old)');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (44, 'Instrumentation (old)');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (45, 'Logisitique (old)');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (46, 'Mobilier (old)');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (47, 'Optique (old)');
INSERT INTO `mydb`.`categories` (`id`, `nom`) VALUES (48, 'Autre (old)');

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`sous_categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (1, 'RUI', 1);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (2, 'RUI + LC', 1);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (3, 'Précision', 1);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (4, 'Analogique', 2);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (5, 'Numérique', 2);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (6, 'Combiscope', 2);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (7, 'Voltmètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (8, 'Ampèremètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (9, 'Ohmmètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (10, 'Impédencemètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (11, 'Capacimètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (12, 'Inductancemètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (13, 'Wattmètre', 3);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (14, 'Pulse/Fréquences', 4);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (15, 'Polyvalent', 4);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (16, 'Arbitraire', 4);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (17, 'Bruit', 4);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (18, 'Référence U I', 4);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (19, 'Haute tension', 5);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (20, 'Alternatif', 5);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (21, 'VHF', 5);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (22, 'Tension', 6);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (23, 'Courant', 6);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (24, 'Synthétiseur', 7);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (25, 'Générateur', 7);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (26, 'Testeur de cable', 7);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (27, 'TOSmètre', 7);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (28, 'Gaussmetre', 8);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (29, 'Spectre', 9);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (30, 'Logique', 9);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (31, 'Réseau', 9);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (32, 'Active', 10);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (33, 'Tension', 10);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (34, 'Différentielle', 10);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (35, 'Courant', 10);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (36, 'UV', 11);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (37, 'Composant', 12);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (38, 'FPGA', 12);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (39, 'Mémoire', 12);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (40, 'Mécanique', 13);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (41, 'Analogique', 13);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (42, 'Numérique', 13);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (43, 'Tri Dim', 14);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (44, 'Colonne', 14);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (45, 'Comparateur', 14);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (46, 'Cales etalon', 14);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (47, 'Pied à coulisse', 14);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (48, 'Inclinomètre', 15);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (49, 'Defaut', 15);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (50, 'Defaut', 16);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (51, 'Clé dynamomètrique', 17);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (52, 'Tournevis dynamomètrique', 17);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (53, 'Defaut', 18);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (54, 'Defaut', 19);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (55, 'Defaut', 20);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (56, 'Defaut', 21);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (57, 'Defaut', 22);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (58, 'Defaut', 23);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (59, 'Chronomètre', 24);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (60, 'Compteur', 24);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (61, 'Fréquencemètre', 24);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (62, 'Diode a bruit', 25);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (63, 'Pont RLC', 25);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (64, 'Pression atmosphérique', 26);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (65, 'Détendeur manomètre', 26);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (66, 'Vide primaire 10 2Pa < P < 10 5Pa', 26);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (67, 'Vide moyen 10 –1Pa < P < 10 2Pa', 26);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (68, 'Vide poussé 10 –5Pa < P < 10 – 1Pa', 26);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (69, 'Ultravide P < 10 –5Pa', 26);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (70, 'Température de surface', 27);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (71, 'Température d\'air / ambiante', 27);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (72, 'Thermocouple', 27);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (73, 'Compteur de particules', 28);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (74, 'Lampe UV', 28);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (75, 'Enregistreur', 29);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (76, 'Defaut', 29);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (77, 'Débit volumique', 30);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (78, 'Débit massique', 30);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (79, 'Defaut', 31);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (80, 'Defaut', 32);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (81, 'Tension', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (82, 'Courant', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (83, 'Tension + courant', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (84, 'Puissance', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (85, 'Haute Tension', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (86, 'Onduleur', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (87, 'Batterie', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (88, 'Sondes', 33);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (89, 'Defaut', 34);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (90, 'Defaut', 35);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (91, 'Defaut', 36);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (92, 'Defaut', 37);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (93, 'Defaut', 38);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (94, 'Defaut', 39);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (95, 'Defaut', 40);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (96, 'Defaut', 41);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (97, 'Defaut (old)', 42);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (98, 'Defaut (old)', 43);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (99, 'Defaut (old)', 44);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (100, 'Defaut (old)', 45);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (101, 'Defaut (old)', 46);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (102, 'Defaut (old)', 47);
INSERT INTO `mydb`.`sous_categories` (`id`, `nom`, `categorie_id`) VALUES (103, 'Defaut (old)', 48);

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`groupes_thematiques`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (1, 'N/A', NULL);
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (2, 'PSE', NULL);
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (3, 'MICMAC', NULL);
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (4, 'GAHEC', NULL);
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (5, 'SISU', NULL);
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (6, 'SG', NULL);
INSERT INTO `mydb`.`groupes_thematiques` (`id`, `nom`, `description`) VALUES (7, 'GPPS', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`groupes_metiers`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (1, 'N/A', NULL);
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (2, 'GEDI', NULL);
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (3, 'GT2I', NULL);
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (4, 'GI', NULL);
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (5, 'GACL', NULL);
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (6, 'GGPAQ', NULL);
INSERT INTO `mydb`.`groupes_metiers` (`id`, `nom`, `description`) VALUES (7, 'GM', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `mydb`.`utilisateurs`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`utilisateurs` (`id`, `nom`, `login`, `email`, `role`, `groupes_metier_id`) VALUES (NULL, 'Hillembrand Cedric', 'Cedric', 'Cedric.Hillembrand@irap.omp.eu', 'Super Administrateur', 1);
INSERT INTO `mydb`.`utilisateurs` (`id`, `nom`, `login`, `email`, `role`, `groupes_metier_id`) VALUES (NULL, 'Turner Daniel', 'Daniel', 'Daniel.Turner@irap.omp.eu', 'Administration', 1);
INSERT INTO `mydb`.`utilisateurs` (`id`, `nom`, `login`, `email`, `role`, `groupes_metier_id`) VALUES (NULL, 'Sky Gin', 'Gin', 'Gin.Sky@irap.omp.eu', 'Responsable', 1);
INSERT INTO `mydb`.`utilisateurs` (`id`, `nom`, `login`, `email`, `role`, `groupes_metier_id`) VALUES (NULL, 'Robert Henri', 'Henri', 'Henri.Robert', 'Utilisateur', 1);

COMMIT;
