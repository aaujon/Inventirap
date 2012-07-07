<?php
class CategoriesController extends AppController {
    public $scaffold;
    
    public function beforeFilter() {

		parent::beforeFilter();

		/*
		 * Waiting for instructions
		 */
		$this->LdapAuth->allow('*');
    }
}
?>
