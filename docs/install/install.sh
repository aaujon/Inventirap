#!/bin/bash

#Aller dans le repertoire du serveur web
cd /var/www/

#Mettre à jour les sources
rm -rf Inventirap/
git clone git://github.com/aaujon/Inventirap.git

#Configurer l'application
cd Inventirap/
chmod -R 777 cakephp/app/tmp/
chmod 777 cakephp/app/Vendor/phpqrcode/error.txt

#Mettre à jour la bdd
mysql -u root -p < database/BDD_IRAP.sql

#ENCORE NON TESTE !!
