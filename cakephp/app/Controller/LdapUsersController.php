<?php


class LdapUsersController extends AppController {

	var $helpers = array('Html', 'Form');
	var $name = 'LdapUsers';

	public function index() {

	}


	public function login() {

		if(!empty($this->data))
		{
			try {
				$connection = ClassRegistry::init('LdapConnection');

				$user =  $this->data['LdapUser']['username'];
				$password =  $this->data['LdapUser']['password'];

				if($foundedUser = $connection->auth($user, $password))
				{
					$this->Session->write('LdapUser', $foundedUser->firstName);
					$this->Session->setFlash('Connection succeeded.');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->Session->setFlash('Sorry, the authentication is imposible for the user "' . $user . '". Try again.');
				}
			}
			catch(Exception $e)
			{
				$this->Session->setFlash($e->getMessage());
			}
		}
		else {
			$this->Session->setFlash('You are already connected.');
		}
		$this->Session->delete('LdapUser');
		$this->Session->destroy();
		$this->redirect(array('action' => 'index'));
	}

	function logout() {
		$this->Session->delete('LdapUser');
		$this->Session->destroy();
	}
}

?>