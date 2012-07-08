<?php

class Utilisateur extends AppModel {
	var $name = 'Utilisateur';
	var $displayField = 'ldap';

	var $hasMany = 'Materiel';
	
	private $acceptedRoles = array ('Apprenti', 'Responsable', 'Administrateur', 'Super Administrateur');
	
	public function customValidation($data) {
		return in_array(current($data), $this->acceptedRoles);
	}
	
	public function getAcceptedRoles() {
		return $this->acceptedRoles;
	}
	
	public function getAuthenticationLevelFromRole($role) {
		if(strcmp($role, 'Apprenti') == 0)
			return 1;
		elseif (strcmp($role, 'Responsable') == 0)
			return 2;
		elseif (strcmp($role, 'Administrateur') == 0)
			return 3;
		elseif (strcmp($role, 'Super Administrateur') == 0)
			return 4;
		return 0;
	}
	
	public function getRoleFromAuthenticationLevel($ldapUserAuthenticationLevel = 0) {
			switch ($ldapUserAuthenticationLevel) {
				case 1: return 'Apprenti';
				case 2: return 'Responsable';
				case 3: return 'Administrateur';
				case 4: return 'Super Administrateur';
			}
			return 'Non autorisé';
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
                'message' => 'Le champ role doit être valide.'
                )
	);
}
?>
