<?php
class ServicesWebController extends AppController {
	
	var $layout = 'xml';
	
	public function beforeFilter() {
		$this->LdapAuth->allow('*');
    }
	
	public function materiel($irapNum = '') {
		if(preg_match('~IRAP-..-[0-9]*~', $irapNum)) {
			$materiel = ClassRegistry::init('Materiel')->
				find('all', array('conditions' => array('numero_irap' => $irapNum)));
                    
			$this->set('id', $irapNum);
			$this->set('materials', $materiel);
		}
	}
}

?>