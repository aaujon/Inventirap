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
	
	public function materiel($irapNum = '') {
		
		if(preg_match('~IRAP-..-[0-9]*~', $irapNum)) {
			
			$this->set('id', $irapNum);
			
			$materiels = ClassRegistry::init('Materiel');	
		
			$materiel = $materiels->find('all', array(
                'conditions' => array(
                    'numero_irap' => $irapNum)));

			$this->set('materials', $materiel);
		}
	}
}

?>