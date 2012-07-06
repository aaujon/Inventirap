<?php

class MaterialsController extends AppController {
	
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
        $this->set('results', $this->Material->find('all', array('conditions' => array(
			'Material.designation LIKE' => '%'.$this->data['Material']['designation'].'%',
			'Material.irap_number LIKE' => '%'.$this->data['Material']['irap_number'].'%'
			)))
		);
	}
}
?>
