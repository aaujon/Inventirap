#!/bin/bash

#Aller dans le repertoire du serveur web
cd /var/www/

#Mettre à jour les sources
echo "Récupération des sources..."
#rm -rf Inventirap/
#git clone git://github.com/aaujon/Inventirap.git

#Configurer l'application
echo "Mise à jour des droits des dossiers..."
#cd Inventirap/
#chmod -R 777 cakephp/app/tmp/
#chmod 777 cakephp/app/Vendor/phpqrcode/errors.txt

# Set database ip
echo "Database ip"
read bddIp
sed "s/192.168.1.70/$bddIp/" /var/www/Inventirap/cakephp/app/Config/database.php

#Mettre à jour la bdd
echo "Mise à jour de la BDD..."
mysql -u root -p < /var/www/Inventirap/database/BDD_IRAP.sql

#Ajouter Super Administrateur
echo "Super Administrateur ?"
read superAdmin
mysql -u root -p -D mydb -e "INSERT INTO special_users (id, ldap, role) VALUES ('', '$superAdmin', 'Super Administrator');"

# Set LDAP address
echo "LDAP Address"
read ldapIp
sed "s/192.168.1.65/$ldapIp/" /var/www/Inventirap/cakephp/app/Config/database.php

# Set LDAP port
echo "LDAP port"
read ldapPort
sed "s/389/$ldapPort/" /var/www/Inventirap/cakephp/app/Config/database.php

# Ajouter les droits en ecriture pour la creation des qrcodes
chmod -R 777 /var/www/Inventirap/cakephp/app/Vendor/phpqrcode/test-errors.txt
chmod -R 777 /var/www/Inventirap/cakephp/app/Vendor/phpqrcode/errors.txt
mkdir /var/www/Inventirap/cakephp/app/tmp/qrcodes
chmod -R 777 /var/www/Inventirap/cakephp/app/tmp/qrcodes/