<?php

class SpecialUsersController extends AppController {


//	var $scaffold;
	var $helpers = array('Html', 'Form');
	
//	var $name = 'SpecialUsers';

	public function loged () {
		
	}
	
	public function index () {
		$this->set('special_users', $this->SpecialUser->find('all'));
	}
	
	public function view($id = null) {
		$this->SpecialUser->id = $id;
		$this->set('special_users', $this->SpecialUser->read());
	}
	
	public function add() {
		if ($this->request->is('post')) {
			if ($this->SpecialUser->save($this->request->data)) {
				$this->Session->setFlash('The user has been saved.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to add your post.');
			}
		}
	}

	public function edit($id = null) {
		$this->SpecialUser->id = $id;
		if ($this->request->is('get')) {
			$this->set('special_users', $this->SpecialUser->read());
		} else {
			if ($this->SpecialUser->save($this->request->data)) {
				$this->Session->setFlash('The user has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update your post.');
			}
		}
	}
	
	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->SpecialUser->delete($id)) {
			$this->Session->setFlash('The user with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
}

?>
