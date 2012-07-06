<?php

class Utilisateur extends AppModel {
	var $name = 'Utilisateur';

	var $ldap;
	var $role;

	private $acceptedRoles = array ('Apprenti', 'Responsable', 'Administrateur', 'Super Administrateur');

	var $password;
	
	public function customValidation($data) {
		return in_array(current($data), $this->acceptedRoles);
	}
	
	public function getAcceptedRoles()
	{
		return $this->acceptedRoles;
	}
	
	public function getAuthenticationLevelFromRole($role)
	{
		if(strcmp($role, 'Apprenti') == 0) {
			return 1;
		} elseif (strcmp($role, 'Responsable') == 0) {
			return 2;
		} elseif (strcmp($role, 'Administrateur') == 0) {
			return 3;
		} elseif (strcmp($role, 'Super Administrateur') == 0) {
			return 4;
		} else {
			return 0;
		}
	}
	
	public function getRoleFromAuthenticationLevel($ldapUserAuthenticationLevel = 0)
	{
				switch ($ldapUserAuthenticationLevel) {
				case 1:
					return 'Apprenti';
					break;
				case 2:
					return 'Responsable';
					break;
				case 3:
					return 'Administrateur';
					break;
				case 4:
					return 'Super Administrateur';
					break;
				default :
					return 'Non authorisé';
					break;
			}
	}
	

	var $validate = array(
        'ldap' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Le champ ldap doit être rempli.'
                )
                ),
		'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Le champ mot de passe doit être rempli.'
                )
                ),
       	'role' => array(
                'rule' => array('customValidation'),
                'message' => 'Le champ role doit être une de ces trois valeurs : {"Apprentice", "Administrator", "Super Administrator"}'
                )
              	);


}
?>
