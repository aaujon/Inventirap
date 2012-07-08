#!/bin/bash

# Set these variables
export userBddName="root";
export userBddPassword="root";
export bddName="mydb";

# Don't touch to the rest of the file !
export file=logSuivis.txt;

echo "SELECT email_responsable, designation from materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 2592000 AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) > 1296000;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;

while IFS= read -r line; do
    email=`echo $line | cut -d' ' -f1`;
    designation=`echo $line | sed -e "s/$email//"` ;

    echo "Il ne vous reste qu'un mois pour effectuer la maintenant du materiel : $designation. Email = $email";
done < $file;


echo "SELECT email_responsable, designation FROM materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 1296000 AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) > 864000;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;

while IFS= read -r line; do
    email=`echo $line | cut -d' ' -f1`;
    designation=`echo $line | sed -e "s/$email//"` ;

    echo "Il ne vous reste deux semaines pour effectuer la maintenant du materiel : $designation. Email = $email";
done < $file;


echo "SELECT email_responsable, designation FROM materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 864000 AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) > 86400;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;

while IFS= read -r line; do
    email=`echo $line | cut -d' ' -f1`;
    designation=`echo $line | sed -e "s/$email//"` ;

    echo "Il ne vous reste 10 jours pour effectuer la maintenant du materiel : $designation. Email = $email";
done < $file;


echo "SELECT email_responsable, designation FROM materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 86400;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;

while IFS= read -r line; do
    email=`echo $line | cut -d' ' -f1`;
    designation=`echo $line | sed -e "s/$email//"` ;

    echo "C'est aujourd'hui que vous devez effectuer la maintenant du materiel : $designation. Email = $email";
done < $file;

echo "SELECT utilisateur_id, designation from materiels WHERE UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(date_acquisition) >= 157680000;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;

while IFS= read -r line; do
    email=`echo $line | cut -d' ' -f1`;
    designation=`echo $line | sed -e "s/$email//"` ;

    echo "Il y a plus de cinq ans que le materiel $designation est entré dans l'inventaire. Voulez-vous le concerver ? Email = $email";
done < $file;


# clean te directory
rm $file;