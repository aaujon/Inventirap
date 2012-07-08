<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un utilisateur</h2>';
	else 
		echo '<h2>Éditer un utilisateur</h2>';

	$utilisateur = ClassRegistry::init('Utilisateur');
		
	echo $this->Form->create();
	if ($this->params['action'] == 'add')
		echo $this->Form->input('ldap', array(
			'options' => $utilisateur->getLdapUsers(), 
			'empty' => 'Choisir un utilisateur', 
			'selected' => ''));
	else 
		echo $this->Form->input('ldap', array(
			'options' => $utilisateur->getLdapUsers(), 
			'empty' => 'Choisir un utilisateur', 
			'disabled' => true));
	echo $this->Form->input('role', array('options' => $utilisateur->getAcceptedRoles()));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>