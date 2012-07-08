<div class="index">
	<h2><i class="icon-key"></i> Page de connexion</h2>
	<?php
		echo $this->Form->create('Utilisateur', array('action' => 'login'));
		echo $this->Form->input('ldap');
		echo $this->Form->input('password', array('div' => 'required'));
		echo $this->Form->end('Se connecter');
	?>
</div>

<div class="actions">
	<?php echo $this->element('menu'); ?>
</div>
