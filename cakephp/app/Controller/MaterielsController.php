<?php
class MaterielsController extends AppController {

	public $scaffold;
	public $helpers = array('Js', 'Paginator');
	public $paginate = array(
		'limit' => 30,
		'order' => array('Materiel.id' => 'desc'));

	public function index() {
		$data = $this->paginate('Materiel', array(
			'Materiel.status' => array('CREATED', 'VALIDATED', 'TOBEARCHIVED')));
		$this->set('data', $data);
	}

	public function find() {
		$this->loadModel('Category');
		$this->loadModel('SousCategory');
		$this->set('s_categories', $this->Category->find('list', array('order' => array('Category.nom'))));
		$this->set('s_sous_categories', $this->SousCategory->find('list', array('order' => array('SousCategory.nom'))));
		if (isset($this->data['Materiel'])) {
			$all = $this->data['Materiel']['s_all'];
			$this->set('results', $this->Materiel->find('all', array(
			//Limitation au vue de la taille de la base de donnée
			'limit' => '0, 100', 
			'conditions' => array(
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
			))))));
		}
		else if (isset($this->params['named']['what'])) {
			$what = $this->params['named']['what'];
			if ($what == 'toValidate')
				$this->set('results', $this->Materiel->find('all', array(
					'limit' => '0, 100',
					'conditions' => array('Materiel.status ' => 'CREATED'))));
			else if ($what == 'toBeArchived')
				$this->set('results', $this->Materiel->find('all', array(
					'limit' => '0, 100',
					'conditions' => array('Materiel.status ' => 'TOBEARCHIVED'))));
		}
	}
	public function delete() {
		$this->Session->setFlash('Pas de suppression de matériel autorisé.');
		$this->redirect(array('action'=> 'index'));
	}

	public function statusToBeArchived($id = null, $from = 'index') {
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'TOBEARCHIVED');
		$this->logInventirap($id);
		$this->Session->setFlash('La demande d\'archivage du matériel a bien été demandé.');
		$this->redirect(array('controller' => 'materiels', 'action'=> $from, $id));
	}

	public function statusValidated($id = null, $from = 'index') {
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'VALIDATED');
		$this->logInventirap($id);
		$this->Session->setFlash('Le matériel a bien été validé.');
		$this->redirect(array('controller' => 'materiels', 'action'=> $from, $id));
	}

	public function statusArchived($id = null, $from = 'index') {
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'ARCHIVED');
		$this->logInventirap($id);
		$this->Session->setFlash('Le matériel a bien été archivé.');
		$this->redirect(array('controller' => 'materiels', 'action'=> $from, $id));
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

	public function beforeFilter() {
		$this->LdapAuth->allow('*');
		/*
		NOT WORKING PROPERLY
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if ($userAuth >= 3)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'find', 'statusArchived', 'statusToBeArchived', 'statusValidated');
		elseif ($userAuth == 2)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'find', 'statusToBeArchived', 'statusValidated');
		elseif ($userAuth == 1)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'find');
		else
			$this->LdapAuth->deny();
		*/
	}
}
?>
