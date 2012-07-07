<?php

//App::import('Controller', 'Materials');


class ServicesWebController extends AppController {
	
	var $layout = 'xml';
	
	public function beforeFilter() {
		
		/*
		 * The WebService is a tool, everybody can access to its functions
		 */
		$this->LdapAuth->allow('*');
    }
	
	public function materiel($id = null) {
		$mat = ClassRegistry::init('Materiel');
		
		$mat->id = $id;
		
		$this->set('materials', $mat->read());
	}
}

?>