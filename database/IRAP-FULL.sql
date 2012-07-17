USE mydb;

DELETE FROM `materiels`;

INSERT INTO `materiels` (`id`, `designation`, `categorie_id`, `sous_categorie_id`, `numero_irap`, `description`, `organisme`, `materiel_administratif`, `materiel_technique`, `status`, `date_acquisition`, `fournisseur`, `prix_ht`, `eotp`, `numero_commande`, `code_comptable`, `numero_serie`, `groupes_thematique_id`, `groupes_metier_id`, `ref_existante`, `lieu_stockage`, `lieu_detail`, `nom_responsable`, `email_responsable`) VALUES 

(NULL, 'Oscilloscope TDS3012B - 2 voies - 100 Mhz - 1.25Gech/s', 42, 97, 'IRAP-xx-1137', '', '', 0, 0, 'CREATED', '1980-01-01', '', '', '', '', '', 'C010222', 1, 1, 'A01 0016', '', '', 'PETIOT', ''),(NULL, 'SERVEUR', 43, 98, 'IRAP-xx-1138', '', 'UPS', 0, 0, 'CREATED', '1980-01-01', '', '15200.00', '2292512', '10332', '', 'T5140', 1, 1, '378', '', '', 'CAPELLA', ''),(NULL, 'CHASSIS', 43, 98, 'IRAP-xx-1139', '', 'UPS', 0, 0, 'CREATED', '1980-01-01', '', '1855.00', '2292512', '10448', '', 'J4400', 1, 1, '379', '', '', 'CAPELLA', '');