<?php
class MaterielsController extends AppController {

	public $scaffold;
	public $helpers = array('Js');

	public function find() {
		$this->loadModel('Category');
		$this->loadModel('SousCategory');
		$this->set('s_categories', $this->Category->find('list'));
		$this->set('s_sous_categories', $this->SousCategory->find('list'));
		if (isset($this->data['Materiel'])) {
			$all = $this->data['Materiel']['s_all'];
			$this->set('results', $this->Materiel->find('all', array('conditions' => array(
				//Champs spéficiques:
				'Materiel.designation LIKE' => '%'.$this->data['Materiel']['s_designation'].'%',
				'Materiel.numero_irap LIKE' => '%'.$this->data['Materiel']['s_numero_irap'].'%',
				'Materiel.category_id LIKE' => '%'.$this->data['Materiel']['s_category_id'].'%',
				'Materiel.sous_category_id LIKE' => '%'.$this->data['Materiel']['s_sous_category_id'].'%',
				'Materiel.nom_responsable LIKE' => '%'.$this->data['Materiel']['s_responsable'].'%',
				'Materiel.status LIKE' => '%'.$this->data['Materiel']['s_status'].'%',
				//Pour tous les champs:
				array('OR' => array (
					'Materiel.designation LIKE' => '%'.$all.'%',
					'Materiel.numero_irap LIKE' => '%'.$all.'%',
					'Materiel.description LIKE' => '%'.$all.'%',
					'Materiel.organisme LIKE' => '%'.$all.'%',
					'Materiel.fournisseur LIKE' => '%'.$all.'%',
					'Materiel.numero_commande LIKE' => '%'.$all.'%',
					'Materiel.nom_responsable LIKE' => '%'.$all.'%',
					'Materiel.email_responsable LIKE' => '%'.$all.'%',
					'Materiel.code_comptable LIKE' => '%'.$all.'%',
					'Materiel.numero_serie LIKE' => '%'.$all.'%',
					'Materiel.lieu_detail LIKE' => '%'.$all.'%'
				))
			)))
			);
		}
		else if (isset($this->params['pass'][0])) {
			if ($this->params['pass'][0] == 'toValidate')
				$this->set('results', $this->Materiel->find('all', 
					array('conditions' => array('Materiel.status ' => 'CREATED'))));
			else if ($this->params['pass'][0] == 'toBeArchived')
				$this->set('results', $this->Materiel->find('all', 
					array('conditions' => array('Materiel.status ' => 'TOBEARCHIVED'))));
		}
	}
	public function delete() {
		$this->Session->setFlash('Pas de suppression de matériel.');
		$this->redirect(array('action'=> 'index'));
	}
	
	public function toValidate() {
		$this->set('results', $this->Materiel->find('all', array('conditions' => array(
				'Materiel.status ' => 'CREATED'))));
		$this->redirect(array('action'=> 'find'));
	}
	public function toArchive() {
		$this->set('results', $this->Materiel->find('all', array('conditions' => array(
				'Materiel.status ' => 'TOBEARCHIVED'))));
		$this->redirect(array('action'=> 'find'));
	}
	
	public function statusToBeArchived($id = null) {
		$this->checkAuthentication('statusToBeArchived');

		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'TOBEARCHIVED');
		$this->redirect(array('controller' => 'materiels', 'action'=> 'index'));
	}

	public function statusArchived($id = null) {
		$this->checkAuthentication('statusArchived');

		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'ARCHIVED');
		$this->redirect(array('controller' => 'materiels', 'action'=> 'index'));
	}

	public function statusValidated($id = null) {
		$this->checkAuthentication('statusValidated');

		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'VALIDATED');
		$this->redirect(array('controller' => 'materiels', 'action'=> 'index'));
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
	
	/* 
	 * Auth functions
	 */
	public function beforeFilter() {
		$this->LdapAuth->deny();
		$this->LdapAuth->allow($this->authLevelUnauthorized);

		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if (($userAuth > 1) && ($userAuth <= 4)) {
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'search', 'delete');
		} elseif ($userAuth == 1) {
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'search');
		}
	}

	private function checkAuthentication($action = 'null') {
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');

		if ((strcmp($action, 'statusToBeArchived') == 0) && $userAuth >= 1)
			return true;

		if ((strcmp($action, 'statusValidated') == 0) && $userAuth >= 4)
			return true;

		if ((strcmp($action, 'statusArchived') == 0) && ($userAuth >= 3))
			return true;

		$this->Session->setFlash('Vous n\'êtes pas autorisé à effectuer cette action');
		$this->redirect(array('controller' => 'Materiels', 'action'=> 'index'));
	}
}
?>
