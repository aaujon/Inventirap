<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array(
        'Session',
        'LdapAuth' => array(
            'loginRedirect' => array('controller' => 'SpecialUsers', 'action' => 'login'),
            'logoutRedirect' => array('controller' => 'SpecialUsers', 'action' => 'logout'),
			'loginAction' => array('controller' => 'SpecialUsers', 'action' => 'login')
//			'authError' => 'Did you really think you are allowed to see that?',
	)
	);

	public function beforeFilter() {
		$ldapUserName = $this->Session->read('LdapUserName');
		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');

		if(isset($ldapUserName))
		{
			if($ldapUserAuthenticationLevel == 1) {
				$this->LdapAuth->allow('login', 'logout', 'loged', 'index');
			} elseif ($ldapUserAuthenticationLevel == 2) {
				$this->LdapAuth->allow('login', 'logout', 'loged', 'index', 'add');
			}  elseif ($ldapUserAuthenticationLevel == 3) {
				$this->LdapAuth->allow('*');
			} else {
				$this->LdapAuth->deny();
				$this->LdapAuth->allow('login', 'logout', 'loged');
			}
		}
		else {
			$this->LdapAuth->deny();
			$this->LdapAuth->allow('login', 'logout', 'loged');
		}
	}

	public function logout() {
		$this->Session->delete('LdapUserName');
		$this->Session->delete('LdapUserAuthenticationLevel');
		$this->Session->destroy();

		$this->LdapAuth->deny();
		$this->LdapAuth->allow('login', 'logout', 'loged');
	}

	public function login() {

		if ($this->request->is('post')) {

				// The user exists into the ldap server
				if($this->LdapAuth->connection($this->request))
				{
					// Save his name into a session variable
					$this->Session->write('LdapUserName', $this->LdapAuth->getLogin($this->request));
        			
					// Get the user into the database
					$users = $this->SpecialUser->find('all', array('conditions' => array('ldap' => $this->LdapAuth->getLogin($this->request)))); 
						
					if(count($users) == 1){
						// Save his authentication level into a session variable 
						$this->Session->write('LdapUserAuthenticationLevel', $this->SpecialUser->getAuthenticationLevelFromRole($users[0]['SpecialUser']['role']));
					}
				$this->redirect('loged');
			} else {
				$this->Session->setFlash(__('Invalid login, try again'));
			}
		}
	}
}
