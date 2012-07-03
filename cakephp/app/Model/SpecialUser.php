<?php

class SpecialUser extends AppModel {

	private $acceptedRole = array ('Apprentice', 'Responsible', 'Administrator', 'Super Administrator');

	public function customValidation($data) {
		return in_array(current($data), $this->acceptedRole);
	}
	
	public function getAuthenticationLevelFromRole($role)
	{
		if(strcmp($role, 'Apprentice') == 0) {
			return 1;
		} elseif (strcmp($role, 'Administrator') == 0) {
			return 2;
		} elseif (strcmp($role, 'Super Administrator') == 0) {
			return 3;
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
       	'role' => array(
                'rule' => array('customValidation'),
                'message' => 'Le champ role doit être une de ces trois valeurs : {"Apprentice", "Administrator", "Super Administrator"}'
                )
              	);


}
?>