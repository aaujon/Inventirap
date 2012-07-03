<?php

class SpecialUsersController extends AppController {


	var $scaffold;
	
	var $name = 'SpecialUsers';

	public function loged () {
		
	}
	
	public function add() {
		if ($this->request->is('post')) {
			if ($this->SpecialUser->save($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to add your post.');
			}
		}
	}

	public function edit($id = null) {
		$this->SpecialUser->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->SpecialUser->read();
		} else {
			if ($this->SpecialUser->save($this->request->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update your post.');
			}
		}
	}
}

?>
