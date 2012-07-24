<?php
class SuivisController extends AppController {
    public $scaffold;
    
    public function beforeFilter() {
		$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
		if ($userAuth > 1)
			$this->LdapAuth->allow('*');
		elseif ($userAuth == 1)
			$this->LdapAuth->allow('index', 'view');
		else 
			$this->LdapAuth->deny();
	}
}
?>
