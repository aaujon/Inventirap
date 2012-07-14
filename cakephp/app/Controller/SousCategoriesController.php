<?php
class SousCategoriesController extends AppController {
	public $scaffold;

	public $name = 'SousCategorie';

	public function getByCategorie() {
		if (isset($this->request->data['Materiel']['s_categorie_id']))
		$categorie_id = $this->request->data['Materiel']['s_categorie_id'];
		else
		$categorie_id = $this->request->data['Materiel']['categorie_id'];
		$souscategories = $this->SousCategorie->find('list', array(
			'conditions' => array('SousCategorie.categorie_id' => $categorie_id),
			'order' => array('SousCategorie.nom'),
			'recursive' => -1
		));
		$this->set('souscategories',$souscategories);
		$this->layout = 'ajax';
	}

	public function beforeFilter() {
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if ($userAuth == 4)
		$this->LdapAuth->allow('*');
		elseif ($userAuth == 2 || $userAuth == 3)
		$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'getByCategorie');
		elseif ($userAuth == 1)
		$this->LdapAuth->allow('index', 'view', 'getByCategorie');
		else
		$this->LdapAuth->deny();
	}
}
?>
