SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

USE mydb;

DELETE FROM `materiels`;

INSERT INTO `materiels` (`id`, `designation`, `category_id`, `sous_category_id`, `numero_irap`, `description`, `organisme`, `materiel_administratif`, `materiel_technique`, `status`, `date_acquisition`, `fournisseur`, `prix_ht`, `eotp`, `numero_commande`, `code_comptable`, `numero_serie`, `thematic_group_id`, `work_group_id`, `ref_existante`, `lieu_stockage`, `lieu_detail`, `nom_responsable`, `email_responsable`) VALUES
(177, 'CAT 3 CONF 4 LATITUDE', 41, 96, 'IRAP-12-1099', '', 'CNRS', 0, 1, 'CREATED', '2012-12-23', 'DELL ', 871, '297664', 'L04964', '', '', 1, 1, '14061150000--127', '', '', 'ANDRÉ', ''),
(178, 'PC ANNULE ET REMPLACE', 41, 96, 'IRAP-12-1100', '', 'CNRS', 0, 1, 'CREATED', '2012-01-21', 'HEWLETT PACKARD ', 952, '315457', 'L06347', '', '', 1, 1, '29060435000--2006-101', '', '', 'ANDRE ET RUBILLA', ''),
(179, 'PC CONFIGURATION 2 Z80', 41, 96, 'IRAP-12-1101', '', 'CNRS', 0, 1, 'CREATED', '2012-01-05', 'HEWLETT PACKARD ', 1, '315654', 'L06344', '', '', 1, 1, '14060426000--786/09', '', '', 'MOT', ''),
(180, 'PC CONFICURATION 2 Z80', 41, 96, 'IRAP-12-1102', '', 'CNRS', 0, 1, 'CREATED', '2012-02-17', 'HEWLETT PACKARD ', 2, '315654', 'L05537', '', '', 1, 1, '29060437000--2006-103', '', '', 'MOT', ''),
(181, 'MACBOOK PRO 15,4"', 41, 96, 'IRAP-12-1103', '', 'CNRS', 0, 1, 'CREATED', '2012-12-02', 'FRANCE SYSTEMES ', 1, '28749131', 'L06122', '', '', 1, 1, '29060932000--126', '', '', 'GREGOIRE', ''),
(182, 'MACBOOK PRO 15,4"', 41, 96, 'IRAP-12-1104', '', 'CNRS', 0, 1, 'CREATED', '2012-01-12', 'FRANCE SYSTEMES ', 1, 'DOTATION ', 'L05299', '', '', 1, 1, '29060326000--2006/100', '', '', 'BACHETTI', ''),
(183, 'HUBLOT AVEC BRIDE EN INOX', 41, 96, 'IRAP-12-1105', '', 'CNRS', 0, 1, 'CREATED', '2012-01-26', 'CABURN-MDC', 1, 'RP ', 'L05208', '', '', 1, 1, '29060438000--04-11-2005', '', '', 'PIRENEA', ''),
(184, 'MAC BOOK PRO 15,4"', 41, 96, 'IRAP-12-1106', '', 'CNRS', 0, 1, 'CREATED', '2012-02-20', 'FRANCE SYSTEMES ', 1, '313973', 'L05899', '', '', 1, 1, '29060529000--2006-106', '', '', 'CROS', ''),
(185, 'EQUIPEMENT DE TEST ET DE COBTR', 41, 96, 'IRAP-12-1107', '', 'CNRS', 0, 1, 'CREATED', '2012-02-17', 'MICROTEC', 9, '322201', 'L05343', '', '', 1, 1, '14060847000--CNRS789', '', '', 'WAEGEBAERT', ''),
(186, 'CARTE D''AXE 8 AXES SÉRIE ACCEL', 41, 96, 'IRAP-12-1108', '', 'CNRS', 0, 1, 'CREATED', '2012-02-20', 'A2V. APPL; VITESSE V', 3, 'RP ', 'L05634', '', '', 1, 1, '29060535000--2006-104', '', '', 'DONATI', ''),
(187, 'CAT 3 CONF 4 LATITUDE', 41, 96, 'IRAP-12-1109', '', 'CNRS', 0, 1, 'CREATED', '2012-03-15', 'DELL ', 1, '297666', 'L06306', '', '', 1, 1, '14060521000--791/09', '', '', 'ASSARD', ''),
(188, 'MACBOOK PRO 15,4"', 41, 96, 'IRAP-12-1110', '', 'CNRS', 0, 1, 'CREATED', '2012-03-12', 'FRANCE SYSTEMES ', 1, '28749131', 'L06398', '', '', 1, 1, '29060615000--1509', '', '', 'PALLIER', ''),
(189, 'PRECISION M4 600', 41, 96, 'IRAP-12-1111', '', 'CNRS', 0, 1, 'CREATED', '2012-03-14', 'DELL ', 1, '322201', 'L05909', '', '', 1, 1, '29060540000--2006-105', '', '', 'LACOMBE', ''),
(190, 'PRECISION M4 600', 41, 96, 'IRAP-12-1112', '', 'CNRS', 0, 1, 'CREATED', '2012-03-14', 'DELL ', 1, '322201', 'L05908', '', '', 1, 1, '14060469000--790/30', '', '', 'MARTIN J.L', ''),
(191, 'CAT 2 CON 2 POWEREDGE', 41, 96, 'IRAP-12-1113', '', 'CNRS', 0, 1, 'CREATED', '2012-03-15', 'DELL ', 1, 'DOTATION ', 'L05756', '', '', 1, 1, '14060522000--792/09', '', '', 'PALETOU', ''),
(192, 'CAT 2- CONF 2 - LATITUDE', 41, 96, 'IRAP-12-1114', '', 'CNRS', 0, 1, 'CREATED', '2012-04-02', 'DELL ', 0, '297844', 'L06558', '', '', 1, 1, '14060559000--796/18', '', '', 'LASSUE', ''),
(193, 'PHOTOMETRE NOVA 60 SPE', 41, 96, 'IRAP-12-1115', '', 'CNRS', 0, 1, 'CREATED', '2012-03-31', 'VWR', 2, 'DOTATION ', 'L06654', '', '', 1, 1, '14061322000--CNRS793/30', '', '', 'BERGER', ''),
(194, 'COFFRET DE REGULATION', 41, 96, 'IRAP-12-1116', '', 'CNRS', 0, 1, 'CREATED', '2012-03-26', 'PYROX THERMIQUE MATE', 4, 'RP ', 'L05009', '', '', 1, 1, '29060577000--2006-109', '', '', 'TOPLIS ET BLELLY', ''),
(195, 'SUPPORT METALLIQUE', 41, 96, 'IRAP-12-1117', '', 'CNRS', 0, 1, 'CREATED', '2012-03-26', 'PYROX THERMIQUE MATE', 940, 'RP ', 'L05009', '', '', 1, 1, '29060585000--2006-111', '', '', 'TOPLIS ET BLELLY', ''),
(196, 'CENTRALE D''ACQUISAITION ', 41, 96, 'IRAP-12-1118', '', 'CNRS', 0, 1, 'CREATED', '2012-03-28', 'DISTRAME FRANCAISE D', 1, '321803', 'L06510', '', '', 1, 1, '14060508000--795/02', '', '', 'SERAN', ''),
(197, 'CAT 2 - CONF - LATITUDE', 41, 96, 'IRAP-12-1119', '', 'CNRS', 0, 1, 'CREATED', '2012-03-26', 'DELL ', 1, '297844', 'L06559', '', '', 1, 1, '29060586000--2006-110', '', '', 'GASNAULT', ''),
(198, 'JAUGE FULL RANGE PIRAN', 41, 96, 'IRAP-12-1120', '', 'CNRS', 0, 1, 'CREATED', '2012-03-29', 'AGILENT TECHNOLOGIES', 2, 'RP ', 'L06507', '', '', 1, 1, '14060550000--794/10', '', '', 'PIRENEA', ''),
(199, 'PLATINE TRANSLATION', 41, 96, 'IRAP-12-1121', '', 'CNRS', 0, 1, 'CREATED', '2012-04-03', 'MICRO-CONTRÔLE NEWPO', 3, 'RP ', 'L06723', '', '', 1, 1, '14060748000--INVT 113-06', '', '', 'ATTEIA', ''),
(200, 'TANGO UNISTAT 705', 41, 96, 'IRAP-12-1122', '', 'CNRS', 0, 1, 'CREATED', '2012-03-19', 'AVANTEC', 16, '322201', 'L05724', '', '', 1, 1, '14060525000--99-2006', '', '', 'LACOMBE', ''),
(201, 'POMPE A SPIRALES TRISCROLL', 41, 96, 'IRAP-12-1123', '', 'CNRS', 0, 1, 'CREATED', '2012-04-12', 'AGILENT TECHNOLOGIES', 4, '321803', 'L05456', '', '', 1, 1, '14061395000--115-2006', '', '', 'FEDOROV', ''),
(202, 'STATION DE SOUDAGE WELLER', 41, 96, 'IRAP-12-1124', '', 'CNRS', 0, 1, 'CREATED', '2012-04-10', 'CLI', 2, '321803', 'L06557', '', '', 1, 1, '14061392000--1', '', '', 'SERAN', ''),
(203, 'ATTENUATEUR', 41, 96, 'IRAP-12-1125', '', ' CNRS', 0, 1, 'CREATED', '2012-04-11', 'LEASAMETRIC', 835, '313973', 'L06984', '', '', 1, 1, '14061394000--118-2006', '', '', 'RAMBAUD', ''),
(204, 'PC CAT 5 CONF 2 PRECISION', 41, 96, 'IRAP-12-1126', '', 'CNRS', 0, 1, 'CREATED', '2012-04-07', 'DELL ', 2, '322201', 'L06915', '', '', 1, 1, '14060778000--117-2006', '', '', 'MOT', ''),
(205, 'WME STANDARD 4kv/1 Ma', 41, 96, 'IRAP-12-1127', '', 'CNRS', 0, 1, 'CREATED', '2012-04-05', 'PHYSICAL INSTRUMENTS', 2, '321803', 'L05404', '', '', 1, 1, '14060762000--XLAB112-2006', '', '', 'FEDOROV', ''),
(206, 'CARTE VME64x PUISSANCE 1000w', 41, 96, 'IRAP-12-1128', '', 'CNRS', 0, 1, 'CREATED', '2012-04-05', 'PHYSICAL INSTRUMENTS', 4, '315457', 'L05403', '', '', 1, 1, '29060656000--INSU127', '', '', 'FEDOROV', ''),
(207, '3 CARTES FPGA VIRTEX', 41, 96, 'IRAP-12-1129', '', 'CNRS', 0, 1, 'CREATED', '2012-03-21', 'FARNELL FRANCE FARNE', 4, '2292362', 'L07015', '', '', 1, 1, '29060547000--102-2006', '', '', 'CROS', ''),
(208, 'CAMERA INFRAROUGE', 41, 96, 'IRAP-12-1130', '', 'CNRS', 0, 1, 'CREATED', '2012-05-06', 'LOT ORIEL', 16, 'RP ', 'L05128', '', '', 1, 1, '29060857000--2006-124', '', '', '', ''),
(209, 'PORTABLE CAT 3 CONF 6', 41, 96, 'IRAP-12-1131', '', 'CNRS', 0, 1, 'CREATED', '2012-05-03', 'DELL ', 1, '28749131', 'L07178', '', '', 1, 1, '29060854000--2006-123', '', '', 'BABY', ''),
(210, 'CAT 5 CON2 PRECISION M6600', 41, 96, 'IRAP-12-1132', '', 'CNRS', 0, 1, 'CREATED', '2012-04-26', 'DELL ', 2, '315654', 'L06916', '', '', 1, 1, '29060686000--2006-114', '', '', 'MARTY', ''),
(211, 'ALIM + 20 Kv DC SINGLE POLARIT', 41, 96, 'IRAP-12-1133', '', 'CNRS', 0, 1, 'CREATED', '2012-05-02', 'OPTOPRIM', 1, 'RP ', 'L07196', '', '', 1, 1, '29060715000--2006-119', '', '', 'SERAN', ''),
(212, 'MACBOK PRO 15,4" LEC/CORE', 41, 96, 'IRAP-12-1134', '', 'CNRS', 0, 1, 'CREATED', '2012-05-02', 'FRANCE SYSTEMES ', 1, '28749131', 'L07176', '', '', 1, 1, '29060774000--2006-122', '', '', 'BABY', ''),
(213, 'CAT 3 CONF 6 LATITUDE', 41, 96, 'IRAP-12-1135', '', 'CNRS', 0, 1, 'CREATED', '2012-05-04', 'DELL ', 877, '297844', 'L06561', '', '', 1, 1, '29060856000--2006-125', '', '', 'D''USTON', ''),
(214, 'SUPPORT WELLER VBHS', 41, 96, 'IRAP-12-1136', '', 'CNRS', 0, 1, 'CREATED', '2012-04-26', 'CLI', 1, '28749131', 'L06554', '', '', 1, 1, '29060689000--2006-115', '', '', 'THOCAVEN', '');
