<?php

class Utilisateur extends AppModel {
	var $name = 'Utilisateur';
	var $displayField = 'ldap';
	
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
	
	public function getRoleFromAuthenticationLevel($userAuth = 0) {
		if ($userAuth < 1 || $userAuth > 4)
			return 'Non autorisé';
		return $this->acceptedRoles[$userAuth-1];
	}
	
	public function getLdapUsers() {
		$connection = ClassRegistry::init('LdapConnection');
		$ldapUsers = array();
		$usersName = array();
		foreach($connection->getAllLdapUsers() as $userInformations) {
			if((!empty($userInformations['sn'][0])) && (!empty($userInformations['givenname'][0]))) {
				array_push($usersName, $userInformations['sn'][0] . ' ' . $userInformations['givenname'][0]);
			}
		}
		sort($usersName);
		foreach($usersName as $userName) {
			$ldapUsers[$userName] = $userName;
		}
		
		return $ldapUsers;
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
                'message' => 'Le champ role doit être valide.'
                )
	);
}
?>
