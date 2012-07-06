<?php

//App::import('Controller', 'Materials');


class ServicesWebController extends AppController {
	
	var $layout = 'xml';
	
	public function beforeFilter() {
				$this->LdapAuth->allow('*');
	}
	
	public function materiel($id = null) {
		$mat = ClassRegistry::init('Materiel');
		
		$mat->id = $id;
		
		$this->set('materials', $mat->read());
	}
}

?>