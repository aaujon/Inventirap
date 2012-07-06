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

	public $authLevelUnauthorized = array('login'); // auth level 0
	public $authLevelApprentice = array('login', 'logout', 'logged', 'display', 'index', 'view'); // auth level 1
	public $authLevelResponsible = array('login', 'logout', 'logged', 'display', 'index', 'view'); // auth level 2
	public $authLevelAdministrator = array('login', 'logout', 'logged', 'display', 'index', 'view'); // auth level 3
	public $authLevelSuperAdministrator = array('*'); // auth level 4

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

		$res = $ldapUserName . ' - ' . $ldapUserAuthenticationLevel;
		
		$this->LdapAuth->deny();
		if(isset($ldapUserName))
		{

			switch ($ldapUserAuthenticationLevel) {
				case 0:
					$this->LdapAuth->allow($this->authLevelUnauthorized);
					break;
				case 1:
					$this->LdapAuth->allow($this->authLevelApprentice);
					break;
				case 2:
					$this->LdapAuth->allow($this->authLevelResponsible);
				case 3:
					$this->LdapAuth->allow($this->authLevelAdministrator);
					break;
				case 4:
					$this->LdapAuth->allow($this->authLevelSuperAdministrator);
					break;
			}
		}
	}
}
