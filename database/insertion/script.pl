#!/usr/bin/perl

use DBI;
use DBD::mysql;
use List::MoreUtils qw(uniq);
use Data::Dumper qw(Dumper);

sub formatMaterielAdministratif {

	$technique = $_[0];
	
	if($technique eq "") {
		return '1';
	}
		
	return '0';
}

sub formatMaterielTechnique {

	$technique = $_[0];
	
	if($technique eq "") {
		return '0';
	}
		
	return '1';
}

sub sqlRequest {

    $query = $_[0];

    $query_handle = $connect->prepare($query);
    $query_handle->execute();

    return $query_handle;
}

sub formatDate {

    $date = $_[0];

    $date =~ s/\n//g;
    $newDate = '';
    if($date =~ m/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]$/) {
		@dateElements = split(/\//, $date);
		$newDate = $dateElements[2] . '-' . $dateElements[1] . '-' . $dateElements[0];
    }

    return $date;
}

sub formatIrapNumber {

    $irapNumber = $_[0];

    if($irapNumber =~ m/^IRAP..-....$/) {
		$irapNumber =~ s/IRAP/IRAP-/g;
    }

    return $irapNumber;
}

sub formatMontant {
	
	$montant = $_[0];
	
	if($montant eq "") {
		return 0;
	}
	
	$montant =~ s/ //g;
	$montant =~ s/€//g;
	$montant =~ s/,/./g;
	
	return $montant;
}

# CONFIG VARIABLES
$platform = "mysql";
$database = "test_irap";
$host = "localhost";
$port = "3306";
$user = "root";
$pw = "root";

# DATA SOURCE NAME
$dsn = "dbi:$platform:$database:$host:$port";

# PERL DBI CONNECT
$connect = DBI->connect($dsn, $user, $pw);

$csvFile = $ARGV[0];
$line = '';


open($FH, '<', $csvFile) or die "Can't open $csvFile: $!";
while ($line = readline($FH)) {

    $line =~ s/"//g;
    @values = split(/;/, $line);

    $designation = $values[0];
    $categorie = $values[1];
    $sousCategorie = $values[2];
    $irapNumber = $values[3];
    $description = $values[4];
    $organisme = $values[5];
    $inventoriable = $values[6];
    $technique = $values[7];
    $status = $values[8];
    $fournisseur = $values[9];
    $montant = $values[10];
    $credit = $values[11];
    $cde = $values[12];
    $comptable = $values[13];
    $refMateriel = $values[14];
    $groupeThematique = $values[15];
    $groupeTechnique = $values[16];
    $numeroInventaire = $values[17];
    $lieuStockage = $values[18];
    $descriptionLieu = $values[19];
    $nomResponsable = $values[20];
    $mailResponsable = $values[21];
    $date = $values[22];

    $formatedDate = formatDate($date);
    $formatedIrapNumber = formatIrapNumber($irapNumber);
    $formatedMontant = formatMontant($montant);
    $formatedMaterielAdministratif = formatMaterielAdministratif($technique);
    $formatedMaterielTechnique = formatMaterielTechnique($technique);
    
    $idCategorie = '';
    $idSousCategorie = '';

    if(!$categorie eq "") {

		$query_handle = sqlRequest("SELECT id, nom FROM categories WHERE nom = \"$categorie\"");
		$query_handle->bind_columns(undef, \$idCategorie, \$nomCategorie);

		if(!$query_handle->fetch()) {

			sqlRequest("INSERT INTO categories (nom) VALUES (\"$categorie\")");
			$query_handle = sqlRequest("SELECT id, nom FROM categories WHERE nom = \"$categorie\"");
			$query_handle->bind_columns(undef, \$idCategorie, \$nomCategorie);
			$query_handle->fetch();

		}
    } else {
		$idCategorie = '45';
	}

    if(!$sousCategorie eq "") {

		$query_handle = sqlRequest("SELECT id, nom, categorie_id FROM sous_categories WHERE nom = \"$sousCategorie\"");
		$query_handle->bind_columns(undef, \$idSousCategorie, \$nomSousCategorie, \$refCategorieId);

		if(!$query_handle->fetch()) {

			sqlRequest("INSERT INTO sous_categories (nom, categorie_id) VALUES (\"$sousCategorie\", $idCategorie)");
			$query_handle = sqlRequest("SELECT id, nom, categorie_id FROM sous_categories WHERE nom = \"$sousCategorie\"");
			$query_handle->bind_columns(undef, \$idSousCategorie, \$nomSousCategorie, \$refCategorieId);
			$query_handle->fetch();

		}
	} else {
		$idSousCategorie = '99';
	}
	
	$request = "INSERT INTO materiels (designation, categorie_id, sous_categorie_id, numero_irap, description, organisme, materiel_administratif, materiel_technique, status, date_acquisition, fournisseur, prix_ht, eotp, numero_commande, code_comptable, numero_serie, groupe_thematique_id, groupe_technique_id, ref_existante, lieu_stockage, lieu_detail, nom_responsable, email_responsable) VALUES (\"$designation\", $idCategorie, $idSousCategorie, \"$formatedIrapNumber\", \"$description\", \"$organisme\", $formatedMaterielAdministratif, $formatedMaterielTechnique, \"$status\", \"$formatedDate\", \"$fournisseur\", $formatedMontant, \"$credit\", \"$cde\", \"$comptable\", \"$refMateriel\", NULL, NULL, \"$numeroInventaire\", \"$lieuStockage\", \"$descriptionLieu\", \"$nomResponsable\", \"$mailResponsable\" )";
	
	# print $request . "\n";
	
	sqlRequest($request);
}

