<?php
class HistoriesController extends AppController {
	public $scaffold;
	
	/*
	var $components = array('Session');
	var $helpers = array('Form2'); 	
	public function index() {
		$techMaterials = $this->TechMaterial->find('all');
		$this->set('techMaterials', $techMaterials);
	}

	public function add() {
		if (!empty($this->data)) {
			$this->TechMaterial->create($this->data);
			if ($this->TechMaterial->save()) {
				$this->Session->setFlash('Le materiel technique a été sauvegardé.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Le materiel technique n\'a pas été sauvegardé.');
			}
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Le matériel technique est introuvable.');
			$this->redirect(array('action' => 'index'));
		}
		if ($this->TechMaterial->delete($id)) {
			$this->Session->setFlash('Le materiel technique a été supprimé.');
		} else {
			$this->Session->setFlash(__('Le materiel technique n\'a pas été supprimé.', true));
		}
		$this->redirect(array('action' => 'index'));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Le matériel technique est introuvable.');
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->TechMaterial->id = $id;
			if ($this->TechMaterial->save($this->data)) {
				$this->Session->setFlash('Le materiel technique a été modifié.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Le materiel technique n\'a pas été modifié.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TechMaterial->read(null, $id);
		}
	}
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Le matériel technique est introuvable.');
			$this->redirect(array('action' => 'index'));
		}
		$this->set('techMat', $this->TechMaterial->findById($id));
	}*/
}

?>
