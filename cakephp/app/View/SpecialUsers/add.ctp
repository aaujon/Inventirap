echo '<h1> Créer un nouvel utilisateur </h1>';
		
<?php
	echo $this->Form->create('SpecialUser');
	echo $form->input('Ldap');
	echo $form->input('Role');
	echo $this->Form->end('Add user');
?>