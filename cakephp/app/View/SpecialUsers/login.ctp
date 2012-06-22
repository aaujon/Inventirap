<h1> Login page </h1>


<?php

	$specialUser = $this->Session->read('SpecialUser');

	 if(!isset($specialUser))
	 {

	    echo $this->Session->flash('auth');
	    
	    echo $this->Form->create('SpecialUser', array('action' => 'login'));
	    echo $this->Form->input('ldap');
	    // echo $this->Form->input('password');
	    echo $this->Form->end('Login');
	    
	 } else {
		echo '<p>You are connected with the LdapUser "' . $userName . '"</p>';
	 }
	
?>