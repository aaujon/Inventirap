<?php

class SpecialUser extends AppModel {
	
	var $name = 'SpecialUser';

	var $ldap;
	var $role;
	
	private $acceptedRole = array ('apprentice', 'wizard', 'Gandalf the White');
	
	var $_schema = array(
        'ldap'		=>array('type'=>'string', 'length'=>45),
		'role'		=>array('type'=>'string', 'length'=>45)
	);
	
	
	var $validate = array(
        'ldap' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Le champ ldap doit être rempli.'
            )
        ),
       	'role' => array(
                'rule' => array('customValidation'),
                'message' => 'Le champ role doit être une de ces trois valeurs : {"apprentice", "wizard", "Gandalf the White"}'
            )
    );
    
	public function customValidation($data) {
		return in_array(current($data), $this->acceptedRole);
}

}
?>