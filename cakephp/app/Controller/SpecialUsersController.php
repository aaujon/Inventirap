<?php

class SpecialUsersController extends AppController {


	public $scaffold;
	
	public function test() {
			
	}

	public function logout() {
		$this->Session->delete('LdapUser');
		$this->Session->destroy();
	}

	public function index() {
			
	}

	public function login() {
		
		if ($this->request->is('post')) {
			if ($this->LdapAuth->login()) {

				$this->Session->write('LdapUser', 'Indeed');
				
				$this->redirect('test');
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

}

?>
