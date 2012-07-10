<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter un emprunt</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer un emprunt</h2>';

	$materiel_id = '';
	if ($this->params['action'] == 'add' && isset($this->passedArgs['mat']))
		$materiel_id = $this->passedArgs['mat'];
		
	echo $this->Form->create();
	echo $this->Form->input('materiel_id', array('label' => 'Matériel concerné', 'value' => $materiel_id));
	echo $this->Form->input('date_emprunt', array('label' => 'Date de l\'emprunt'));
	echo $this->Form->input('date_retour_emprunt', array('label' => 'Date de retour'));
	echo $this->Form->input('piece', array('label' => 'Pièce'));
	echo $this->Form->input('emprunt_interne', array('label' => 'Emprunt interne'));
	echo $this->Form->input('laboratoire');
	echo $this->Form->input('responsable');	
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>