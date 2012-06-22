<?php

class SpecialUser extends AppModel {

	var $name = 'SpecialUser';

	var $ldap;
	var $role;

	private $acceptedRole = array ('apprentice', 'wizard', 'The white wizard');

	var $_schema = array(
        'ldap'		=>array('type'=>'string', 'length'=>45),
		'role'		=>array('type'=>'string', 'length'=>45)
	);

	public function customValidation($data) {
		return in_array(current($data), $this->acceptedRole);
	}
	
	public function getAuthenticationLevelFromRole($role)
	{
		if(strcmp($role, 'apprentice') == 0) {
			return 1;
		} elseif (strcmp($role, 'wizard') == 0) {
			return 2;
		} elseif (strcmp($role, 'The white wizard') == 0) {
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
                'message' => 'Le champ role doit être une de ces trois valeurs : {"apprentice", "wizard", "The white wizard"}'
                )
                );


}
?>