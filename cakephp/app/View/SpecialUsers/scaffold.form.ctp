
<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un utilisateur</h2>';
	else 
		echo '<h2>Éditer un utilisateur</h2>';

	echo $this->Form->create();
	echo $this->Form->input('ldap');
	echo $this->Form->input('role', array('options' => array(
		'Apprentice'=>'Apprentice',
		'Responsible'=>'Responsible',
		'Administrator'=>'Administrator',
		'Super Administrator'=>'Super Administrator')));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>