<?php

class UtilisateursController extends AppController {

	var $scaffold;
	public $helpers = array('Js');

	/*
	 * This method is called before each action to check if the user is allwed to execute the action
	 */
	public function beforeFilter() {

		/*
		 * The parent filter allows index and view
		 * For the Users, there is only the SuperAdministrators who can do it
		 */

		$this->LdapAuth->deny();
		$this->LdapAuth->allow($this->authLevelUnauthorized);

		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
		if ($ldapUserAuthenticationLevel == 4) {
			$this->LdapAuth->allow('display', 'index', 'view', 'add', 'edit', 'delete');
		}
	}

	public function getEmailFromName($name) {

		if(isset($name)) {
			$connection = ClassRegistry::init('LdapConnection');
			$attributes = $connection->getUserAttributes($name);
	
			@$mail = $attributes[0]['mail'][0];
			
			$this->set('email', $mail);
			$this->layout = 'xml';

			return $mail;
		}
	}

	public function logged () {

	}

	public function logout() {
		$this->Session->delete('LdapUserName');
		$this->Session->delete('LdapUserAuthenticationLevel');
		$this->Session->delete('LdapUserMail');

		/*
		 * Delete the eventual tmp qrcode
		 */
		$fileName = $_SESSION['Config']['userAgent'];
		@unlink('/var/www/Inventirap/cakephp/app/tmp/qrcodes/' . $fileName . '.png');


		$this->Session->destroy();

		$this->LdapAuth->deny();
		$this->LdapAuth->allow($this->authLevelUnauthorized);
	}

	public function login() {

		if ($this->request->is('post')) {
			// The user exists into the ldap server
			if($this->LdapAuth->connection($this->request))
			{
				// Save his name into a session variable
				$this->Session->write('LdapUserName', $this->LdapAuth->getLogin($this->request));

				// Get the user into the database
				$users = $this->Utilisateur->find('all', array('conditions' => array('ldap' => $this->LdapAuth->getLogin($this->request))));

				if(count($users) == 1){
						
					$this->Session->write('LdapUserMail', $this->getEmailFromName($this->LdapAuth->getLogin($this->request)));
						
					/*
					 * Testing instruction !
					 */
					$this->Session->setFlash('Your email is : ' . $this->Session->read('LdapUserMail'));
						
					// Save his authentication level into a session variable
					$this->Session->write('LdapUserAuthenticationLevel', $this->Utilisateur->getAuthenticationLevelFromRole($users[0]['Utilisateur']['role']));
				}
				$this->redirect('logged');
			} else {
				$this->Session->setFlash(__('Invalid login, try again'));
			}
		}
	}
}

?>
