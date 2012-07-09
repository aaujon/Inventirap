<?php
class UtilisateursController extends AppController {

	var $scaffold;
	
	public function login() {
		if ($this->request->is('post')) {
			// The user exists into the ldap server
			if($this->LdapAuth->connection($this->request))
			{
				// Save his name and authentification level into a session variable
				$this->Session->write('LdapUserName', $this->request->data['Utilisateur']['ldap']);
				$this->Session->write('LdapUserAuthenticationLevel', 1);
				$this->Session->write('UserName', $this->LdapAuth->getUserName());
				$this->Session->write('LdapUserMail', $this->getEmailFromLdapName($this->Session->read('LdapUserName')));
				
				$users = $this->Utilisateur->find('all', array('conditions' => array('nom' => $this->Session->read('UserName'))));
				if(count($users) == 1) {
					// Update his authentication level into a session variable
					$this->Session->write('LdapUserAuthenticationLevel', 
						$this->Utilisateur->getAuthenticationLevelFromRole($users[0]['Utilisateur']['role']));
				}
				CakeLog::write('inventirap', 'Logged in : ' . $this->Session->read('LdapUserName'));
				$this->Session->setFlash('Connexion réussie.');
				$this->redirect('/');
			} else {
				CakeLog::write('inventirap', 'Invalid login : ' . $this->Session->read('LdapUserName'));
				$this->Session->setFlash(__('Nom d\'utilisateur ou mot de passe invalide.'));
				$this->redirect('/');
			}
		}
	}
	
	public function logout() {
		CakeLog::write('inventirap', 'Logget out : '.$this->Session->read('LdapUserName'));
		
		$this->Session->delete('LdapUserName');
		$this->Session->delete('LdapUserAuthenticationLevel');
		$this->Session->delete('LdapUserMail');

		/*
		 * Delete the eventual tmp qrcode
		 */
		$fileName = $this->Session->id() . '.png';
		$cakephpPath = str_replace('webroot/index.php', '', $_SERVER['SCRIPT_FILENAME']);
		@unlink($cakephpPath . 'webroot/img/' . $fileName);
		@unlink($cakephpPath . 'Vendor/phpqrcode/' . $fileName . '-errors.txt');

		$this->Session->destroy();

		$this->LdapAuth->deny();
		$this->LdapAuth->allow($this->authLevelUnauthorized);
		
		$this->Session->setFlash('Déconnexion réussie.');
		$this->redirect('/');
	}

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

	public function getEmailFromLdapName($ldapName) {
		if(isset($ldapName)) {
			$attributes = ClassRegistry::init('LdapConnection')->getUserAttributes($ldapName);
			@$mail = $attributes[0]['mail'][0];

			return $mail;
		}
	}
}
?>
