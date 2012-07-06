<?php

class MaterielsController extends AppController {
	
	public $scaffold;
	
	public function changeStatus($id, $new_status) {
		if($new_status == 'CREATED' || $new_status == 'ARCHIVED' || $new_status == 'VALIDATED') {
			$this->Materiel->id = $id;
            $this->Materiel->saveField('status', $new_status);	
		}
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
	}
	
	public function search() { }
	
	public function find() {
        $this->set('results', $this->Materiel->find('all', array('conditions' => array(
			'Materiel.designation LIKE' => '%'.$this->data['Materiel']['designation'].'%',
			'Materiel.numero_irap LIKE' => '%'.$this->data['Materiel']['numero_irap'].'%'
			)))
		);
	}
}
?>
