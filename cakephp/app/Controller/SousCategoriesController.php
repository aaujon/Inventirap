<?php
class SousCategoriesController extends AppController {
    public $scaffold;

    public function getByCategory() {
    	if (isset($this->request->data['Materiel']['s_category_id']))
			$category_id = $this->request->data['Materiel']['s_category_id'];
		else
			$category_id = $this->request->data['Materiel']['category_id'];
		$subcategories = $this->SousCategory->find('list', array(
			'conditions' => array('SousCategory.category_id' => $category_id),
			'order' => array('SousCategory.nom'),
			'recursive' => -1
			));
		$this->set('souscategories',$subcategories);
		$this->layout = 'ajax';
	}
	
	public function beforeFilter() {
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if ($userAuth == 4)
			$this->LdapAuth->allow('*');
		elseif ($userAuth == 2 || $userAuth == 3)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit', 'getByCategory');
		elseif ($userAuth == 1)
			$this->LdapAuth->allow('index', 'view', 'getByCategory');
		else 
			$this->LdapAuth->deny();
	}
}
?>
