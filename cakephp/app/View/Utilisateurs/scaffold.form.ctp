<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un utilisateur</h2>';
	else 
		echo '<h2>Éditer un utilisateur</h2>';

	$utilisateur = ClassRegistry::init('Utilisateur');
		
	echo $this->Form->create();
	if ($this->params['action'] == 'add')
		echo $this->Form->input('nom', array(
			'options' => $utilisateur->getLdapUsers(), 
			'empty' => 'Choisir un utilisateur', 
			'selected' => '',
			'div' => 'input required'));
	else 
		echo $this->Form->input('nom', array(
			'options' => $utilisateur->getLdapUsers(), 
			'empty' => 'Choisir un utilisateur', 
			'disabled' => true,
			'div' => 'input required'));
	echo $this->Form->input('login', array( 
			'label' => 'Login', 
			'disabled' => true));
	echo $this->Form->input('email', array( 
			'label' => 'E-mail', 
			'disabled' => true));
	echo $this->Form->input('role', array('label' => 'Rôle', 'options' => array(
		'Apprenti' => 'Apprenti', 
		'Responsable' => 'Responsable', 
		'Administrateur' => 'Administrateur', 
		'Super Administrateur' => 'Super Administrateur')));
	echo $this->Form->input('groupes_travail_id', array('label' => 'Groupe de travail'));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_form');
	?>
</div>