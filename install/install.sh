#!/bin/bash

# Parametres à changer pour votre installation
export bddUserName="root";
export bddPassword="root";
export bddName="mydb"

#Mettre à jour les sources
echo "Récupération des sources..."
# rm -rf Inventirap/
# git clone git://github.com/aaujon/Inventirap.git

#Configurer l'application
echo "Mise à jour des droits des dossiers..."
cd Inventirap/
chmod -R 777 ./cakephp/app/tmp/
chmod 777 ./cakephp/app/Vendor/phpqrcode/errors.txt

# Set database ip
echo "Entrez l'adresse du serveur MySQL"
read bddIp
sed "s/192.168.1.70/$bddIp/" ./cakephp/app/Config/database.php

#Mettre à jour la bdd
echo "Mise à jour de la BDD..."
mysql -u $bddUserName --password=$bddPassword -h $bddIp $bddName < ./database/BDD_IRAP.sql

#Ajouter Super Administrateur
echo "Quel est le nom du super administrateur de l'inventaire"
read superAdminName
echo "Quel est l'adresse email du super administrateur de l'inventaire"
read superAdminEmail
mysql -u $bddUserName --password=$bddPassword -h $bddIp -D $bddName -e "INSERT INTO utilisateurs (ldap, role, email) VALUES ('$superAdminName', 'Super Administrator', '$superAdminEmail');"

# Set LDAP address
echo "Entrez l'adresse du serveur ldap"
read ldapIp
sed "s/192.168.1.65/$ldapIp/" ./cakephp/app/Config/database.php

# Set LDAP port
echo "Entrez le numéro de port du serveur ldap"
read ldapPort
sed "s/389/$ldapPort/" ./cakephp/app/Config/database.php

# Ajouter les droits en ecriture pour la creation des qrcodes
touch ./cakephp/app/Vendor/phpqrcode/test-errors.txt
chmod 777 ./cakephp/app/Vendor/phpqrcode/test-errors.txt
touch ./cakephp/app/Vendor/phpqrcode/errors.txt
chmod 777 ./cakephp/app/Vendor/phpqrcode/errors.txt
mkdir ./cakephp/app/tmp/qrcodes
chmod -R 777 ./cakephp/app/tmp/qrcodes/