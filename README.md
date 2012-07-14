Inventirap
=======================
Inventirap is an inventory software developed for IRAP laboratory (http://www.irap.omp.eu/)
It's developed under GPL v.3 License (view License directory)

It's a web application developed in PHP with CakePHP framework, with a MySQL database.

Functionality
======================
* Create, edit and remove assets
* Create, edit and remove categories
* Organize your assets with categories and sub-categories
* assign person in charge
* manage calibration, maintenance and anticipate them by receiving mails at important moment
* Connect application to your LDAP to manage user rights, with possibility to add special rights to users.

How to install
======================

1/ Download and run the installation script : 
-

   wget https://raw.github.com/aaujon/Inventirap/master/install/install.sh
   
   sh ./install.sh
   
2/ Answer to the questions :
-

   The script will ask some questions
   - The MySQL server address 
   - The user name of the MySQL server
   - The password to access to MySQL server
   - The name of the database
   - The "Super administrator" of the site. WARNING : the database already contains one "Super administrator" called "Cedric". You have to choose another name for your administrator. Else, the administration will not work.
   - The address of the ldap server. To use sldap, you just have to add "ldaps://" before the address.
   - The port number of the ldap server

3/ Dependencies : 
-

   The application uses the ldap module written in php. You can install this module by installing the package php-ldap.i686. This package contains all what the application needs. 

4/ .htaccess configuration
-
   
   Take care about the htaccess configurations. CakePHP needs the apache module to read and re-write urls. If it does not have the right to do it, CakePHP will not work. So you have to right configure your virtual hosts and the .htaccess file in the root of the project.

5/ Authentication 
-

   You have to be authenticated to access to the site. The authentication is divided in two steps : ldap and bdd. If the user exists into the ldap server, the site search into the bdd the authentication level of  the user. There are four levels “Apprenti”, "Responsable", “Administrateur” and “Super Administrateur”. 

   There is a ldif file into the database folder with some users. There are also some users into the bdd to test the authentication level.