<?php
class MaterielsController extends AppController {

	public $scaffold;
	public $helpers = array('Js', 'Paginator');
	public $paginate = array(
		'limit' => 30,
		'order' => array('Materiel.id' => 'desc'));

	public function index() {
		$statut = array('CREATED', 'VALIDATED', 'TOBEARCHIVED');
		if (isset($this->params['named']['what']))
			if ($this->params['named']['what'] == 'toValidate')
				$statut = array('CREATED');
			else if ($this->params['named']['what'] == 'toBeArchived')
				$statut = array('TOBEARCHIVED');
			
		//Requête SQL
		$data = $this->paginate('Materiel', array('Materiel.status' => $statut));
		$this->set('data', $data);
	}

	public function find() {
		$this->loadModel('Categorie');
		$this->loadModel('SousCategorie');
		$this->set('s_categories', $this->Categorie->find('list', array('order' => array('Categorie.nom'))));
		$this->set('s_sous_categories', $this->SousCategorie->find('list', array('order' => array('SousCategorie.nom'))));
		if (isset($this->data['Materiel'])) {
			$all = $this->data['Materiel']['s_all'];
			$this->set('results', $this->Materiel->find('all', array(
				//Limitation au vue de la taille de la base de donnée
				'limit' => '0, 100', 
				'conditions' => array(
					//Champs spéficiques:
					'Materiel.designation LIKE' => '%'.$this->data['Materiel']['s_designation'].'%',
					'Materiel.numero_irap LIKE' => '%'.$this->data['Materiel']['s_numero_irap'].'%',
					'Materiel.categorie_id LIKE' => '%'.$this->data['Materiel']['s_categorie_id'].'%',
					'Materiel.sous_categorie_id LIKE' => '%'.$this->data['Materiel']['s_sous_categorie_id'].'%',
					'Materiel.nom_responsable LIKE' => '%'.$this->data['Materiel']['s_responsable'].'%',
					'Materiel.ref_existante LIKE' => '%'.$this->data['Materiel']['s_ref_existante'].'%',
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
						'Materiel.ref_existante LIKE' => '%'.$all.'%',
						'Materiel.numero_serie LIKE' => '%'.$all.'%',
						'Materiel.lieu_detail LIKE' => '%'.$all.'%'))
			))));
		}
	}
	
	function export() {
		ini_set('max_execution_time', 600);	
		
		$filename = "export_".date("Y.m.d").".csv";
		$csv_file = fopen('php://output', 'w');
	
		header('Content-type: application/csv; charset=UTF-8');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
	
		$header_row = array(
			"id", "Désignation", "Catégorie", "Sous catégorie", "Numéro IRAP", "Description", "Organisme", 
			"Mat. administratif", "Mat. technique", "Statut", "Date d'acquisition", "Fournisseur", "Prix HT", 
			"EOTP", "Numéro de commande", "Code comptable", "Numéro de série", "Grp. thématique", "Grp. métier", 
			"Ref. existante", "Lieu de stockage", "Nom responsable", "Email responsable");
		fputcsv($csv_file,$header_row,',','"');
		
		$results = $this->Materiel->find('all');
		foreach($results as $result) {
			$row = array(
				utf8_encode($result['Materiel']['id']),
				$result['Materiel']['designation'],
				$result['Categorie']['nom'],
				$result['SousCategorie']['nom'],
				$result['Materiel']['numero_irap'],
				$result['Materiel']['description'],
				$result['Materiel']['organisme'],
				$result['Materiel']['materiel_administratif'],
				$result['Materiel']['materiel_technique'],
				$result['Materiel']['status'],
				$result['Materiel']['date_acquisition'],
				$result['Materiel']['fournisseur'],
				$result['Materiel']['prix_ht'],
				$result['Materiel']['eotp'],
				$result['Materiel']['numero_commande'],
				$result['Materiel']['code_comptable'],
				$result['Materiel']['numero_serie'],
				$result['GroupesThematique']['nom'],
				$result['GroupesMetier']['nom'],
				$result['Materiel']['ref_existante'],
				$result['Materiel']['lieu_stockage'].'-'.$result['Materiel']['lieu_detail'],
				$result['Materiel']['nom_responsable'],
				$result['Materiel']['email_responsable'],
			);
			fputcsv($csv_file,$row,',','"');
		}
		fclose($csv_file);
	}
	
	public function delete($id) {
		$this->Materiel->id = $id;
		if ($this->Materiel->field('status') != 'CREATED') {
			$this->Session->setFlash('Pas de suppression de matériel autorisé après qu\'il ait été validé.');
			$this->redirect(array('action'=> 'index'));
		}
		else {
			$this->Materiel->delete($id);
			$this->Session->setFlash('Le matériel a bien été supprimé.');
			$this->redirect(array('action'=> 'index'));
		}
	}

	public function statusToBeArchived($id = null, $from = 'view') {
		if ($this->Session->read('LdapUserAuthenticationLevel') < 1)
			$this->notAuthorized($id, $from);
			
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'TOBEARCHIVED');
		$this->logInventirap($id);
		$this->Session->setFlash('La demande de sortie d\'inventaire a bien été demandé.');
		$this->redirect(array('controller' => 'materiels', 'action'=> $from, $id));
	}

	public function statusValidated($id = null, $from = 'view') {
		if ($this->Session->read('LdapUserAuthenticationLevel') < 2)
			$this->notAuthorized($id, $from);
	
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'VALIDATED');
		$this->logInventirap($id);
		$this->Session->setFlash('Le matériel a bien été validé.');
		$this->redirect(array('controller' => 'materiels', 'action'=> $from, $id));
	}

	public function statusArchived($id = null, $from = 'view') {
		if ($this->Session->read('LdapUserAuthenticationLevel') != 3)
			$this->notAuthorized($id, $from);
			
		$this->Materiel->id = $id;
		$this->Materiel->saveField('status', 'ARCHIVED');
		$this->logInventirap($id);
		$this->Session->setFlash('Le matériel a bien été sorti de l\'inventaire.');
		$this->redirect(array('controller' => 'materiels', 'action'=> $from, $id));
	}
	
	public function jackpot() {
		//Vérification administration
		if ($this->Session->read('LdapUserAuthenticationLevel') != 3)
			$this->notAuthorized(NULL, 'index');
		
		//Traitement des update si besoin
		if (isset($this->data['materiels'])) {
			$what = $this->data['materiels']['what'];
			$nb = 0;
			if ($what == 'toValidate' || $what == 'toBeArchived') {
				foreach ($this->data['materiels'] as $id => $value) : if ($value == 1) {
					$this->Materiel->id = $id;
					$new = '"ARCHIVED"';
					if ($what == 'toValidate')
						$new = '"VALIDATED"';
					$this->Materiel->updateAll(array('Materiel.status' => $new), array('Materiel.id' => $id));
					$nb++;
				} endforeach;
				if ($nb != 0)
					if ($this->data['materiels']['what'] == 'toValidate')
						$this->Session->setFlash($nb.' matériel(s) mis à jour (validation).');
					else
						$this->Session->setFlash($nb.' matériel(s) mis à jour (sortie d\'inventaire).');
				$this->redirect(array('action' => 'index', 'what' => $what));
			}
		}
		$this->redirect(array('action' => 'index'));
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

	public function notAuthorized($id, $from) {
		$this->Session->setFlash('Nous n\'avez pas le niveau d\'authorisation nécessaire pour cette action.');
		$this->redirect(array('action'=> $from, $id));
	}
}
?>
