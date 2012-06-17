<?php
class CategoryController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('categories', $this->Category->find('all'));
    }

    public function view() {
		
		$this->set('category', $this->Category->find('all', 
			array(
				'conditions' => array(
					'Category.id' => $this->params['pass'][0])) ));
    }
}
?>
