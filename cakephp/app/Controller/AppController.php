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

	public static $authLevelUnauthorized = array('login', 'logout', 'logged', 'display'); // auth level 0

	/*
	 * This component is the app/Controller/Component/LdapAuthComponent.php
	 */
	public $components = array(
        'Session',
        'LdapAuth' => array(
            'loginRedirect' => array('controller' => 'Utilisateurs', 'action' => 'login'),
            'logoutRedirect' => array('controller' => 'Utilisateurs', 'action' => 'logout'),
			'loginAction' => array('controller' => 'Utilisateurs', 'action' => 'notAuthorized')
	)
	);

	/*
	 * This method is called before each action to check if the user is allwed to execute the action
	 */
	public function beforeFilter() {
		
		$this->LdapAuth->deny();
		
		$userName = $this->Session->read('LdapUserName');
		if (isset($userName)) {
			$this->LdapAuth->allow('*');
		}
		else {
			$this->LdapAuth->allow($this->authLevelUnauthorized);
		}
	}
	
	public function beforeScaffold($action) {
		if ($action == 'delete')
			$this->logInventirap($this->params['pass'][0]);
		return true;	
	}
	
	public function afterScaffoldSave($action) {
		if ($action == 'add')
			$this->logInventirap($this->{ucfirst(substr($this->params['controller'], 0, -1))}->id);
		if ($action == 'edit')
			$this->logInventirap($this->params['pass'][0]);
			
		return true;	
	}
	
	public function logInventirap($id = -1) {
		$user = $this->Session->read('LdapUserName').' ('.$this->Session->read('LdapUserAuthenticationLevel').') ';
		$controller = substr($this->params['controller'], 0, -1).' ';
		$action = $this->params['action'].' ';
		$text = $user.$action.$controller;
		if ($id != -1)
			$text .= '#'.$id;
		CakeLog::write('inventirap', $text);
	}}
?>