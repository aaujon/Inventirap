#!/bin/bash

export userBddName="root";
export userBddPassword="root";
export bddName="mydb";

echo "select UNIX_TIMESTAMP(date_prochain_controle), UNIX_TIMESTAMP(NOW()), materiel_id from suivis" | mysql -u `echo $userBddName` --password=`echo $userBddPassword` `echo $bddName` | sed -e '1d' > logSuivis.txt

cat logSuivis.txt | cut -d'	' -f1
