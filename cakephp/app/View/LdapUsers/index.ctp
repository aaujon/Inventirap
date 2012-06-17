<h1> Ldap user page </h1>


<?php

	$userName = $this->Session->read('LdapUser');

	 if(!isset($userName))
	 {

	    echo $this->Session->flash('auth');
	    
	    echo $this->Form->create('LdapUser', array('action' => 'login'));
	    echo $this->Form->input('username');
	    echo $this->Form->input('password');
	    echo $this->Form->end('Login');
	    
	 } else {
		echo '<p>You are connected with the LdapUser "' . $userName . '"</p>';
	 }
	
?>