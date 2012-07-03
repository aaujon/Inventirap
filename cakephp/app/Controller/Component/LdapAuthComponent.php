<?php

App::import('Component', 'Auth');

class LdapAuthComponent extends AuthComponent {

	public function connection($request) {

		try {
			$connection = ClassRegistry::init('LdapConnection');

			$login = $this->getLogin($request);
			$password = $this->getPassword($request); 
			
			return $connection->ldapAuthentication($login, $password);
			
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}

	}

	public function getPassword($request) {
		return $this->request->data['SpecialUser']['password'];
	}
	
	public function getLogin($request) {
		return $this->request->data['SpecialUser']['ldap'];
	}
}