<?php
class MaterielsController extends AppController {

	public $scaffold;
	public $helpers = array('Js', 'Paginator');
	var $paginate = array(
		'limit' => 25,
		'order' => array('Materiel.id' => 'desc'));

	public function index() {
		$data = $this->paginate('Materiel', array(
			'Materiel.status' => array('CREATED', 'VALIDATED', 'TOBEARCHIVED')));
		$this->set('data', $data);
	}

	public function find() {
		$this->loadModel('Categorie');
		$this->loadModel('SousCategorie');
		$this->set('s_categories', $this->Categorie->find('list', array('order' => array('Categorie.nom'))));
		$this->set('s_sous_categories', $this->SousCategorie->find('list', array('order' => array('SousCategorie.nom'))));
		if (isset($this->data['Materiel'])) {
			$all = $this->data['Materiel']['s_all'];
			$this->set('results', $this->Materiel->find('all', array('conditions' => array(
			//Champs spéficiques:
				'Materiel.designation LIKE' => '%'.$this->data['Materiel']['s_designation'].'%',
				'Materiel.numero_irap LIKE' => '%'.$this->data['Materiel']['s_numero_irap'].'%',
				'Materiel.categorie_id LIKE' => '%'.$this->data['Materiel']['s_categorie_id'].'%',
				'Materiel.sous_categorie_id LIKE' => '%'.$this->data['Materiel']['s_sous_categorie_id'].'%',
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
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if (($userAuth == 3) || ($userAuth == 4))
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'find', 'statusArchived', 'statusToBeArchived', 'statusValidated');
		elseif ($userAuth == 2)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'find', 'statusToBeArchived', 'statusValidated');
		elseif ($userAuth == 1)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'find');
		else
			$this->LdapAuth->deny();
	}
}
?>
