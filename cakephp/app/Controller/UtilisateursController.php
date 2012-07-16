<?php
class UtilisateursController extends AppController {

	var $scaffold;
	public $helpers = array('Js');
	
	public function login() {
		if ($this->request->is('post')) {
			// The user exists into the ldap server
			if($this->LdapAuth->connection($this->request)) {
				$ldap = $this->request->data['Utilisateur']['ldap'];
				$name = $this->LdapAuth->getUserName();
			
				// Save his name and authentification level into a session variable			
				$this->Session->write('LdapUserName', $ldap);
				$this->Session->write('LdapUserAuthenticationLevel', 1);
				$this->Session->write('UserName', $name);
				$this->Session->write('LdapUserMail', 
					ClassRegistry::init('Utilisateur')->getEmailFromLdapName($ldap));
				
				$users = $this->Utilisateur->find('all', array('conditions' => 
					array('Utilisateur.login' => $ldap)));
				if(count($users) == 1)
					// Update his authentication level into a session variable
					$this->Session->write('LdapUserAuthenticationLevel', 
						$this->Utilisateur->getAuthenticationLevelFromRole($users[0]['Utilisateur']['role']));
				CakeLog::write('inventirap', 'Logged in : ' . $name);
				//$this->Session->setFlash('Connexion réussie.');
				$this->redirect('/');
			} else {
				CakeLog::write('inventirap', 'Invalid login');
				$this->Session->setFlash(__('Nom d\'utilisateur ou mot de passe invalide.'));
				$this->redirect('/');
			}
		}
	}

	public function getLdapLogin($userName) {
		
		$ldapConnection = ClassRegistry::init('LdapConnection');
		
		$allUsers = $ldapConnection->getAllLdapUsers();
		
		foreach($allUsers as $user) {
			if(!empty($user['sn'][0]) && !empty($user['givenname'][0])) {
				if(strcmp($userName, $user['sn'][0] . ' ' . $user['givenname'][0]) == 0) {
					$this->set('login', $user[$ldapConnection->getAuthenticationType()][0]);
				}
			}
		}
		
		$this->layout = 'ajax';
	}
	
	public function getLdapEmail($userName) {
		
		$ldapConnection = ClassRegistry::init('LdapConnection');
		
		$allUsers = $ldapConnection->getAllLdapUsers();
		
		foreach($allUsers as $user) {
			if(!empty($user['sn'][0]) && !empty($user['givenname'][0])) {
				if(strcmp($userName, $user['sn'][0] . ' ' . $user['givenname'][0]) == 0) {
					$this->set('email', $user['mail'][0]);
				}
			}
		}
		
		$this->layout = 'ajax';
	}
	
	public function logout() {
		CakeLog::write('inventirap', 'Logget out : '.$this->Session->read('LdapUserName'));
		/*
		 * Delete the eventual tmp qrcode
		 */
		$fileName = $this->Session->id();
		$cakephpPath = str_replace('webroot/index.php', '', $_SERVER['SCRIPT_FILENAME']);
		@unlink($cakephpPath . 'webroot/img/' . $fileName . '.png');
		@unlink($cakephpPath . 'Vendor/phpqrcode/' . $fileName  . '.png-errors.txt');
		@exec ('rm -rf ' . $documentFolderPath = $cakephpPath . 'tmp/documents/' . $fileName);
		
		
		$this->Session->destroy();
		$this->Session->setFlash('Déconnexion réussie.');
		$this->redirect('/');
	}

	public function notAuthorized() { 
		$this->Session->setFlash('Vous n\'êtes pas autorisé à effectuer cette action.');
		$this->redirect('/');
	}
	
	public function beforeFilter() {
		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
		$this->LdapAuth->allow('login', 'logout', 'notAuthorized');
		if ($ldapUserAuthenticationLevel >= 1) {
			$this->LdapAuth->allow('login', 'logout', 'notAuthorized', 'getLdapEmail', 'getLdapLogin');
		}
		if ($ldapUserAuthenticationLevel == 4) {
			$this->LdapAuth->allow('login', 'logout', 'notAuthorized', 'getLdapEmail', 'getLdapLogin', 'display', 'index', 'view', 'add', 'edit', 'delete');
		}
	}
}
?>
