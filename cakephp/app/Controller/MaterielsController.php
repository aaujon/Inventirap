<?php

class MaterielsController extends AppController {
	
	public $scaffold;
	
	public function statusToBeArchived($id) {
                $this->Material->id = $id;
                $this->Material->saveField('status', 'TOBEARCHIVED');
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
        }

	public function statusArchived($id) {
                $this->Material->id = $id;
                $this->Material->saveField('status', 'ARCHIVED');
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
        }

	public function statusValidated($id) {
		$this->Material->id = $id;
		$this->Material->saveField('status', 'VALIDATED');
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
