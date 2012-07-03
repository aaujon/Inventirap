<?php

	function writeForm($form)
	{
		
	}

	$uri =  $_SERVER['REQUEST_URI'];
	
	if(strpos($uri, 'edit'))
	{
		echo '<h1> Modifier un utilisateur </h1>';
		
		echo $this->Form->create('SpecialUsers', array('action' => 'edit'));
		writeForm($this->Form);
		echo $this->Form->input('id', array('type' => 'hidden'));
		echo $this->Form->end('Submit');
	}
	else
	{
		
	}
	
	
?>