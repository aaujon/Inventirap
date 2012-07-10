<?php
class WorkGroupsController extends AppController {
    public $scaffold;
    
	public function beforeFilter() {
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if ($userAuth == 4)
			$this->LdapAuth->allow('*');
		elseif ($userAuth == 2 || $userAuth == 3)
			$this->LdapAuth->allow('index', 'view', 'add', 'edit');
		elseif ($userAuth == 1)
			$this->LdapAuth->allow('index', 'view');
		else 
			$this->LdapAuth->deny();
	}
}
?>
