<?php
class SousCategoriesController extends AppController {
    public $scaffold;

    public function getByCategory() {
		$category_id = $this->request->data['Materiel']['category_id'];
		$subcategories = $this->SousCategory->find('list', array(
			'conditions' => array('SousCategory.category_id' => $category_id),
			'recursive' => -1
			));
 
		$this->set('souscategories',$subcategories);
		$this->layout = 'ajax';
	}
}
?>
