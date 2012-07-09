<?php
App::import('Component', 'Auth');

class LdapAuthComponent extends AuthComponent {

	public function connection($request) {
		try {			
			$login = $this->getLogin();
			$password = $this->getPassword(); 
			
			return ClassRegistry::init('LdapConnection')->ldapAuthentication($login, $password);	
		}
		catch(Exception $e) {
			return $e->getMessage();
		}
	}
	public function getLogin() {
		return $this->request->data['Utilisateur']['ldap'];
	}
	public function getPassword() {
		return $this->request->data['Utilisateur']['password'];
	}
}
?>