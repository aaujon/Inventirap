<?php

class SpecialUsersController extends AppController {

	var $scaffold;
	
/*
	 * This method is called before each action to check if the user is allwed to execute the action
	 */
	public function beforeFilter() {
		$ldapUserName = $this->Session->read('LdapUserName');
		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');

		if(isset($ldapUserName))
		{
			if ($ldapUserAuthenticationLevel == 3) {
				$this->LdapAuth->allow($this->authLevelThree);
			} else {
				$this->LdapAuth->deny();
				$this->LdapAuth->allow($this->authLevelZero);
			}
		}
		else {
			$this->LdapAuth->deny();
			$this->LdapAuth->allow($this->authLevelZero);
		}
	}

	public function logged () {
		
	}
}

?>
