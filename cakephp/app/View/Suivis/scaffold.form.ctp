<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter '.strtolower($singularHumanName).'</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer '.strtolower($singularHumanName).'</h2>';
	
	$materiel_id = '';
	if ($this->params['action'] == 'add' && isset($this->passedArgs['mat']))
		$materiel_id = $this->passedArgs['mat'];

	echo $this->Form->create();
	echo $this->Form->input('materiel_id', array('label' => 'Matériel concerné', 'value' => $materiel_id));
	echo $this->Form->input('date_controle', array('label' => 'Date du contrôle'));
	echo $this->Form->input('date_prochain_controle', array('label' => 'Date du prochain contrôle'));
	echo $this->Form->input('type_intervention', array('label' => 'Type d\'intervention'));
	echo $this->Form->input('organisme', array('label' => 'Organisme'));
	echo $this->Form->input('frequence', array('label' => 'Fréquence (en année)'));
	echo $this->Form->input('commentaire', array('label' => 'Commentaire'));	
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_form');
	?>
</div>