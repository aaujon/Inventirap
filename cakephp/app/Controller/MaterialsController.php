<?php

class MaterialsController extends AppController {
	
	public $scaffold;
	
	public function beforeFilter() {
		$this->LdapAuth->allow('*');
	}

//	/*
//	 * This method is called before each action to check if the user is allwed to execute the action
//	 */
//	public function beforeFilter() {
//		$ldapUserName = $this->Session->read('LdapUserName');
//		$ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
//
//		if(isset($ldapUserName))
//		{
//			if($ldapUserAuthenticationLevel == 1) {
//				$this->LdapAuth->allow($this->authLevelOne);
//			} elseif ($ldapUserAuthenticationLevel == 2) {
//				$this->LdapAuth->allow($this->authLevelTwo);
//			}  elseif ($ldapUserAuthenticationLevel == 3) {
//				$this->LdapAuth->allow($this->authLevelThree);
//			} else {
//				$this->LdapAuth->deny();
//				$this->LdapAuth->allow($this->authLevelZero);
//			}
//		}
//		else {
//			$this->LdapAuth->deny();
//			$this->LdapAuth->allow($this->authLevelZero);
//		}
//	}
	
	// public function changeStatus($id, $new_status) {
	//	if($new_status == 'CREATED' || $new_status == 'ARCHIVED' || $new_status == 'VALIDATED') {
	//		$this->Material->id = $id;
        //  $this->Material->saveField('status', $new_status);	
	// }

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
	
//	public function webservice() {
//		$this->set('materials', $this->Material->find('all'));
////		$this->set(compact($this->Material->find('all'), 'id'));
//	}
}
?>
