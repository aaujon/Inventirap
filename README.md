Inventirap
=======================
Inventirap is an inventory software developped for IRAP laboratory (http://www.irap.omp.eu/)
It's developped under GPL v.3 Licence (view Licence directory)

It's a web application developped in PHP with CakePHP framework, with a MySQL database.

Functionnality
======================
* Create, edit and remove assets
* Create, edit and remove categories
* Organize your assets with categories and sub-categories
* assign personn in charge
* manage calibration, maintenance and anticipate them by receiving mails at important moment
* Connect application to your LDAP to manage user rights, with possibility to add special rights to users.

How to install
======================
1/ Get the last version of the project : 
   git clone https://github.com/aaujon/Inventirap.git                                                                                                                                                                                     
2/ Configure the database access :
   Editing the file Inventirap/cakephp/app/Config/database.php
   The configuration file which is provide offers a good example. 
   You just have to edit the default configuration : public $default = array ( ... ); 
   Into this array you just have to edit these parameters : 
    - host
     - login
      - password
       - database

3/ Configure the ldap access :
   Editing the file Inventirap/cakephp/app/Config/database.php 
   The configuration file which is provide offers a good example. 
   You just have to set the ldap configuration : public $ldap = array ( .. ); 
   Here, you can edit all parameters. Warning, you don't have to set the name of the paramters. Else, the application will not work.

4/ Dependancies : 
   The application uses the ldap module written in php. You can install this module by installing the package php-ldap.i686. This package contains all what the application needs. 

5/ Have fun :
You can go to these url 
 -