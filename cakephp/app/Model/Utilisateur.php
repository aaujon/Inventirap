<?php

class Utilisateur extends AppModel {
	var $name = 'Utilisateur';
	var $displayField = 'nom';
	
	public $belongsTo = array('GroupesMetier');
	
	private $acceptedRoles = array ('Utilisateur', 'Responsable', 'Administration', 'Super Administrateur');
	
	public function customValidation($data) {
		return in_array(current($data), $this->acceptedRoles);
	}
	
	public function getAcceptedRoles() {
		return $this->acceptedRoles;
	}
	
	public function getAuthenticationLevelFromRole($role) {
		if ($role == 'Utilisateur')
			return 1;
		elseif ($role == 'Responsable')
			return 2;
		elseif ($role == 'Administration')
			return 3;
		elseif ($role == 'Super Administrateur')
			return 4;
		return 0;
	}
	
	public function getRoleFromAuthenticationLevel($userAuth = 0) {
		if ($userAuth < 1 || $userAuth > 4)
			return 'Non autorisé';
		return $this->acceptedRoles[$userAuth-1];
	}
	
	public function getEmailFromLdapName($ldapName) {
		if(isset($ldapName)) {
			$attributes = ClassRegistry::init('LdapConnection')->getUserAttributes($ldapName);
			@$mail = $attributes[0]['mail'][0];

			return $mail;
		}
	}
	
	public function getLdapUsers() {
		$allUsers = ClassRegistry::init('LdapConnection')->getAllLdapUsers();
		$ldapUsers = array();
		$usersName = array();
		foreach($allUsers as $user)
			if(!empty($user['sn'][0]) && !empty($user['givenname'][0]))
				array_push($usersName, $user['sn'][0] . ' ' . $user['givenname'][0]);
				
		sort($usersName);
		foreach($usersName as $userName)
			$ldapUsers[$userName] = $userName;
		
		return $ldapUsers;
	}
	
	var $validate = array(
        'nom' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Le nom d\'utilisateur doit être rempli.')),
       	'role' => array(
                'rule' => array('customValidation'),
                'message' => 'Le champ role doit être valide.')
	);
}
?>
