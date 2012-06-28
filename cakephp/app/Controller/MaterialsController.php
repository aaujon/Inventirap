<?php

class MaterialsController extends AppController {
	
	public $scaffold;
	
	public function changeStatus() {
		$param = $this->request->params['pass'];
		
		if(sizeof($param) == 2) {
			$this->Material->id = $param[0];
            $this->Material->saveField('status', $param[1]);	
		}
		$this->redirect(array('controller' => $this->params['controller'], 'action'=> 'index'));
	}
}
?>
