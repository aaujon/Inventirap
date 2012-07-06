<?php

class SpecialUser extends AppModel {

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