#!/bin/bash

# Set these variables
export userBddName="root";
export userBddPassword="root";
export bddName="mydb";
export defaultMail="default@irap.fr"

# Don't touch to the rest of the file !
export file=logSuivis.txt;

function checkValues {

	email=`echo $line | cut -d' ' -f1`;
	
	if [[ "$email" != *@* ]]
	then
		email=$defaultMail
		irap=`echo "$line" | awk '{print $NF}'`;
		designation=`echo $line | sed -e "s/$irap//"`;		
	else
		email=`echo $line | cut -d' ' -f1`;
		designation=`echo $line | sed -e "s/$email//"`;
		irap=`echo $line | sed -e "s/$designation//"`;
	fi
}

####
# Thirty day reminding
####
echo "SELECT email_responsable, designation, numero_irap from materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 2592000 AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) > 1296000;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;
while read line
do
	# call the function of the script
	checkValues

    echo "Il ne vous reste qu'un mois pour effectuer la maintenant du materiel : $designation, $irap. Email = $email";
done < $file;

####
# Fifteen days reminding
####
echo "SELECT email_responsable, designation, numero_irap FROM materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 1296000 AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) > 864000;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;
while read line
do
	# call the function of the script
	checkValues

    echo "Il ne vous reste deux semaines pour effectuer la maintenant du materiel : $designation, $irap. Email = $email";
done < $file;

####
# Ten days reminding
####
echo "SELECT email_responsable, designation, numero_irap FROM materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 864000 AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) > 86400;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;
while read line
do
	# call the function of the script
	checkValues

    echo "Il ne vous reste 10 jours pour effectuer la maintenant du materiel : $designation, $irap. Email = $email";
done < $file;

####
# One day reminding
####
echo "SELECT email_responsable, designation, numero_irap FROM materiels INNER JOIN suivis ON materiels.id = suivis.materiel_id AND UNIX_TIMESTAMP(suivis.date_prochain_controle) - UNIX_TIMESTAMP(NOW()) <= 86400;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;
while read line
do
	# call the function of the script
	checkValues

    echo "C'est aujourd'hui que vous devez effectuer la maintenant du materiel : $designation, $irap. Email = $email";
done < $file;

####
# Ckeck old material
####
echo "SELECT email_responsable, designation, numero_irap from materiels WHERE UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(date_acquisition) >= 157680000;" | mysql -u $userBddName --password=$userBddPassword $bddName | sed -e '1d' > $file;
while read line
do
	# call the function of the script
	checkValues

    echo "Il y a plus de cinq ans que le materiel $designation, $irap est entré dans l'inventaire. Voulez-vous le conserver ? Email = $email";
done < $file;

# clean te directory
rm $file;
