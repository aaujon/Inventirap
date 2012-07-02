<?php

App::import('Component', 'Auth');

class LdapAuthComponent extends AuthComponent {

	public function connection($request) {

		try {
			$connection = ClassRegistry::init('LdapConnection');

			$login =  $this->getLogin($request);

			
			return $connection->ldapAuthentication($login);
			
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}

	}

	public function getAuthenticationLevel($request) {
		return '3';
	}

	public function getLogin($request) {
		return $this->request->data['SpecialUsers']['ldap'];
	}
}