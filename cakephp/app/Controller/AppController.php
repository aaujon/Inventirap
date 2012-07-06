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
/*
 * This Controller is the main controller all authentications which are defined here are inherit into all others sub controllers 
 */
class AppController extends Controller {

	public $authLevelZero = array('login', 'logout', 'loged', 'display');
	public $authLevelOne = array('login', 'logout', 'loged', 'display', 'index');
	public $authLevelTwo = array('login', 'logout', 'loged', 'display', 'index', 'view', 'add');
	public $authLevelThree = array('*');
	
	/*
	 * This component is the app/Controller/Component/LdapAuthComponent.php
	 */
	public $components = array(
        'Session',
        'LdapAuth' => array(
            'loginRedirect' => array('controller' => 'SpecialUsers', 'action' => 'login'),
            'logoutRedirect' => array('controller' => 'SpecialUsers', 'action' => 'logout'),
			'loginAction' => array('controller' => 'SpecialUsers', 'action' => 'login')
	)
	);

	/*
	 * This method is called before each action to check if the user is allwed to execute the action
	 */
	public function beforeFilter() {
		$ldapUserName = $this->Session->read('LdapUserName');
		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');

		if(isset($ldapUserName))
		{
			if($ldapUserAuthenticationLevel == 1) {
				$this->LdapAuth->allow($this->authLevelOne);
			} elseif ($ldapUserAuthenticationLevel == 2) {
				$this->LdapAuth->allow($this->authLevelTwo);
			}  elseif ($ldapUserAuthenticationLevel == 3) {
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
}
