<?php
class MaterielsController extends AppController {

	public $scaffold;
	public $helpers = array('Js');

	/*
	 * This method is called before each action to check if the user is allwed to execute the action
	 */
	public function beforeFilter() {

		parent::beforeFilter();

		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');

		if($ldapUserAuthenticationLevel == 1 || $ldapUserAuthenticationLevel == 2) {
			$this->LdapAuth->allow('add', 'statusToBeArchived');
		}
			
		if($ldapUserAuthenticationLevel == 2 || $ldapUserAuthenticationLevel == 3) {
			$this->LdapAuth->allow('statusValidated');
		}
			
		if($ldapUserAuthenticationLevel == 3) {
			$this->LdapAuth->allow('statusArchived');
		}
	}

	public function statusToBeArchived($id) {
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'TOBEARCHIVED');
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
	}

	public function statusArchived($id) {
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'ARCHIVED');
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
	}

	public function statusValidated($id) {
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'VALIDATED');
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
	}

	public function search() { }

	public function find() {
		$this->set('results', $this->Materiel->find('all', array('conditions' => array(
			'Materiel.designation LIKE' => '%'.$this->data['Materiel']['designation'].'%',
			'Materiel.numero_irap LIKE' => '%'.$this->data['Materiel']['numero_irap'].'%'
			)))
			);
	}
}
?>
