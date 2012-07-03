<h1> Créer un nouvel utilisateur </h1>
		
<?php
	echo $this->Form->create('SpecialUser');
	echo $this->Form->input('ldap');
	echo $this->Form->input('role', array(
		'options' => array('Apprentice' => 'Apprentice','Administrator' => 'Administrator','Super Administrator' => 'Super Administrator'),
		'default' => 'Apprentice'));
	
	
	echo $this->Form->end('Save SpecialUser');
?>