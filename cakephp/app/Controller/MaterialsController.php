<?php

class MaterialsController extends AppController {
	
	public $scaffold;
	
	public function beforeFilter() {
		$this->LdapAuth->allow('*');
	}
	
	public function changeStatus($id, $new_status) {
		if($new_status == 'CREATED' || $new_status == 'ARCHIVED' || $new_status == 'VALIDATED') {
			$this->Material->id = $id;
            $this->Material->saveField('status', $new_status);	
		}
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
	}
	
	public function search() { }
	
	public function find() {
        $this->set('results', $this->Material->find('all', array('conditions' => array(
			'Material.designation LIKE' => '%'.$this->data['Material']['designation'].'%',
			'Material.irap_number LIKE' => '%'.$this->data['Material']['irap_number'].'%'
			)))
		);
	}
	
//	public function webservice() {
//		$this->set('materials', $this->Material->find('all'));
////		$this->set(compact($this->Material->find('all'), 'id'));
//	}
}
?>
