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

1/ Get the last version of the project : 
-

   git clone https://github.com/aaujon/Inventirap.git 
   
2/ Configure the database access :
-

   Editing the file Inventirap/cakephp/app/Config/database.php
   
   The configuration file which is provide offers a good example.    
   You just have to edit the default configuration : public $default = array ( ... ); 
   Into this array you just have to edit these parameters : 
    - host
    - login
    - password
    - database

3/ Configure the ldap access :
-

   Editing the file Inventirap/cakephp/app/Config/database.php 
   
   The configuration file which is provide offers a good example. 
   You just have to set the ldap configuration : public $ldap = array ( .. ); 
   Here, you can edit all parameters. Warning, you don't have to set the name of the parameters. Else, the application will not work.

4/ Dependencies : 
-

   The application uses the ldap module written in php. You can install this module by installing the package php-ldap.i686. This package contains all what the application needs. 

5/ .htaccess configuration
-
   
   Take care about the htaccess configurations. CakePHP needs the apache module to read and re-write urls. If it does not have the right to do it, CakePHP will not work. So you have to right configure your virtual hosts and the .htaccess file in the root of the project.

6/ Temporary files
-

   CakePHH needs to write into the temporary folder. So, you have to set the write access of the folder : Inventirap/cakephp/app/tmp/

7/ Authentication 
-

   You have to be authenticated to access to the site. The authentication is divided in two steps : ldap and bdd. If the user exists into the ldap server, the site search into the bdd the authentication level of  the user. There are three levels “Apprentice”, “Administrator” and “Super Administrator”. 
   - The Apprentice level can only see all the values of the bdd. 
   - The Administrator can see the details of all values and add a new entry into the bdd
   - The Super Administrator can make all action into the bdd

There is a ldif file into the database folder with some users. There are also some users into the bdd to test the authentication level.

There are three users into the database : 
   - hrobert with "Super Administrator" level
   - gsky with "Administrator" level
   - dtruner with "Apprentice" level
   
6/ Have fun : 
-

   - login : cakephp/SpecialUsers/login
   - logout : cakephp/SpecialUsers/logout
   - index : cakephp