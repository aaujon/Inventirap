<h1> Page de connexion </h1>


<?php

	    echo $this->Session->flash('auth');
	    
	    echo $this->Form->create('Utilisateur', array('action' => 'login'));
	    echo $this->Form->input('ldap');
	   	echo $this->Form->input('password');
	    echo $this->Form->end('Login');
	    
	
?>