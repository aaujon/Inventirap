<?php

App::import('Component', 'Auth');

class LdapAuthComponent extends AuthComponent {
	
	public function login($user = null)
	{

		parent::allow('text');
		
//		debug($this);
//		die;

		return true;
	}
}