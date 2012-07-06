<?php

class UtilisateursController extends AppController {

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
	
	public function logout() {
		$this->Session->delete('LdapUserName');
		$this->Session->delete('LdapUserAuthenticationLevel');
		$this->Session->destroy();

		$this->LdapAuth->deny();
		$this->LdapAuth->allow('login', 'logout', 'logged');
	}

	public function login() {

		if ($this->request->is('post')) {
				// The user exists into the ldap server
				if($this->LdapAuth->connection($this->request))
				{
					// Save his name into a session variable
					$this->Session->write('LdapUserName', $this->LdapAuth->getLogin($this->request));
        			
					// Get the user into the database
					$users = $this->Utilisateurs->find('all', array('conditions' => array('ldap' => $this->LdapAuth->getLogin($this->request)))); 
						
					if(count($users) == 1){
						// Save his authentication level into a session variable 
						$this->Session->write('LdapUserAuthenticationLevel', $this->
						
						er->getAuthenticationLevelFromRole($users[0]['Utilisateur']['role']));
					}
				$this->redirect('logged');
			} else {
				$this->Session->setFlash(__('Invalid login, try again'));
			}
		}
	}
}

?>
