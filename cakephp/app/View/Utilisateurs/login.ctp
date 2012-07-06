<div class="index">
	<h2>Page de connexion</h2>
	
	<?php
		echo $this->Session->flash('auth');
	
		echo $this->Form->create('Utilisateur', array('action' => 'login'));
		echo $this->Form->input('ldap');
		echo $this->Form->input('password');
		echo $this->Form->end('Se connecter');
	?>
</div>

<div class="actions">
	<?php echo $this->element('menu'); ?>
</div>
