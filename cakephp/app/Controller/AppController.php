<?php
App::uses('Controller', 'Controller');

/*
 * This Controller is the main controller all authentications which are defined here are inherit into all others sub controllers
 */
class AppController extends Controller {

	public $components = array(
        'Session',
        'LdapAuth' => array(
            'loginRedirect' => array('controller' => 'Utilisateurs', 'action' => 'login'),
            'logoutRedirect' => array('controller' => 'Utilisateurs', 'action' => 'logout'),
			'loginAction' => array('controller' => 'Utilisateurs', 'action' => 'notAuthorized')
	));

	public function beforeFilter() {
		$userName = $this->Session->read('LdapUserName');
		if (isset($userName))
			$this->LdapAuth->allow('*');
		else
			$this->LdapAuth->allow('login', 'display');
	}


	/*
	 * Méthodes de log des données
	 */
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
	}
}
?>