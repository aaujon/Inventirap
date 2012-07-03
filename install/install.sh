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

#Mettre à jour la bdd
echo "Mise à jour de la BDD..."
mysql -u root -p < /var/www/Inventirap/database/BDD_IRAP.sql

#Ajouter Super Administrateur
echo "Super Administrateur ?"
read superAdmin
mysql -u root -p -D mydb -e "INSERT INTO special_users (id, ldap, role) VALUES ('', '$superAdmin', 'Super Administrator');"