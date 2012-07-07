<?php
class MaterielsController extends AppController {

	public $scaffold;
	public $helpers = array('Js');
	public $components = array('QrCode');

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

	public function find() {
		$this->loadModel('Category');
		$this->loadModel('SousCategory');
		$this->set('s_categories', $this->Category->find('list'));
		$this->set('s_sous_categories', $this->SousCategory->find('list'));
		if (isset($this->data['Materiel'])) {
			$this->set('results', $this->Materiel->find('all', array('conditions' => array(
				'Materiel.designation LIKE' => '%'.$this->data['Materiel']['s_designation'].'%',
				'Materiel.numero_irap LIKE' => '%'.$this->data['Materiel']['s_numero_irap'].'%',
				'Materiel.category_id LIKE' => '%'.$this->data['Materiel']['s_category_id'].'%',
				'Materiel.sous_category_id LIKE' => '%'.$this->data['Materiel']['s_sous_category_id'].'%',
				)))
			);
		}
	}
	
	public function getIrapNumber($year = 2012) {
		$shortYear = substr($year, -2);
		$sql = $this->Materiel->find('first', array(
				'fields' => array('numero_irap'),
				'conditions' => array('Materiel.numero_irap LIKE' => 'IRAP-'.$shortYear.'%'),
				'order' => array('Materiel.numero_irap DESC')
		));
		$newId = substr($sql['Materiel']['numero_irap'], -4)+1;
		return 'IRAP-'.$shortYear.'-'.sprintf("%04d", $newId);
	}
}
?>
