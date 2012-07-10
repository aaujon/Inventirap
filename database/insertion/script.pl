#!/usr/bin/perl

use DBI;
use DBD::mysql;

####
# Insert SQL requests
####

# CONFIG VARIABLES
$platform = "mysql";
$database = "test_irap";
$host = "localhost";
$port = "3306";
$user = "root";
$pw = "root";

$tableName = "utilisateurs";

# DATA SOURCE NAME
$dsn = "dbi:$platform:$database:$host:$port";

# PERL DBI CONNECT
# $connect = DBI->connect($dsn, $user, $pw);

# PREPARE THE QUERY
# $query = "INSERT INTO $tableName (nom, role) VALUES ('Pierrick', 'Super Administrateur')";
# $query_handle = $connect->prepare($query);

# EXECUTE THE QUERY
# $query_handle->execute();

####
# Select SQL requets
####










####
# Read file
####

my $fileName = "test_inventaire_IRAP_2012_V5.csv";

open(my $FH, '<', $fileName) or die "Can't open $fileName: $!";
while (my $line = readline($FH)) {

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

    # print "$designation $categorie $sousCategorie $irapNumber $description $organisme $inventoriable $technique $status $fournisseur $montant $credit $cde $comptable $refMateriel $groupeThematique $groupeTechnique $numeroInventaire $lieuStockage $descriptionLieu $nomResponsable $mailResponsable $date \n";

    # Search the date format : jj/mm/aaaa
    $date =~ s/\n//g;
    $newDate;
    if($date =~ m/^[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]$/) {
	@dateElements = split(/\//, $date);
	$newDate = $dateElements[2] . '-' . $dateElements[1] . '-' . $dateElements[0];
	print "My new date is : $newDate\n";
    } else {
	print "Failed\n";
    }


    print "My ultimate date = $newDate\n";
}
close($FH);
