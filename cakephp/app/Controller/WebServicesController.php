<?php

//App::import('Controller', 'Materials');


class WebServicesController extends AppController {
	
	var $layout = 'xml';
	
	public function beforeFilter() {
				$this->LdapAuth->allow('*');
	}
	
	public function webservice($id = null) {
		$mat = ClassRegistry::init('Material');
		
		$mat->id = $id;
		
		$this->set('materials', $mat->read());
	}
}

?>