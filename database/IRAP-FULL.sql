USE mydb;

DELETE FROM `materiels`;

INSERT INTO `materiels` (`id`, `designation`, `category_id`, `sous_category_id`, `numero_irap`, `description`, `organisme`, `materiel_administratif`, `materiel_technique`, `status`, `date_acquisition`, `fournisseur`, `prix_ht`, `eotp`, `numero_commande`, `code_comptable`, `numero_serie`, `thematic_group_id`, `work_group_id`, `ref_existante`, `lieu_stockage`, `lieu_detail`, `nom_responsable`, `email_responsable`) VALUES 



(NULL, 'Oscilloscope TDS3012B - 2 voies - 100 Mhz - 1.25Gech/s', 42, 97, 'IRAP-xx-1137', '', '', 0, 0, 'CREATED', '1980-01-01', '', '', '', '', '', 'C010222', 1, 1, 'A01 0016', '', '', 'PETIOT', ''),