<?php
App::import('Component', 'Auth');

class LdapAuthComponent extends AuthComponent {

	public function connection($request) {
		try {			
			$login = $this->request->data['Utilisateur']['ldap'];
			$password = $this->request->data['Utilisateur']['password']; 
			
			return ClassRegistry::init('LdapConnection')->ldapAuthentication($login, $password);	
		}
		catch(Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function getUserName() {
		$ldapAuthentication =  $this->request->data['Utilisateur']['ldap'];
		
		$ldapConnection = ClassRegistry::init('LdapConnection');
		
		$user = $ldapConnection->getUserAttributes($ldapAuthentication);
		
		return $user[0]['sn'][0] . ' ' . $user[0]['givenname'][0];
	}
}
?>