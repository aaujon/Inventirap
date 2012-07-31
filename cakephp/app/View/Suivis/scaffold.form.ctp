<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter '.strtolower($singularHumanName).'</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer '.strtolower($singularHumanName).'</h2>';
	
	$materiel_id = '';
	if ($this->params['action'] == 'add' && isset($this->passedArgs['mat']))
		$materiel_id = $this->passedArgs['mat'];

    // Configure::write('Config.language','fr-fr'); // set the current language
	// $monthNames = __c('mon',LC_TIME,true); // returns an array with the month names in French
	// $dateFormat = __c('d_fmt',LC_TIME,true); // return the preferred dates format for France

	$months = array('01' => 'Janvier', 
					'02' => 'Février',
					'03' => 'Mars',
					'04' => 'Avril',
					'05' => 'Mai',
					'06' => 'Juin',
					'07' => 'Juillet',
					'08' => 'Aout',
					'09' => 'Septembre',
					'10' => 'Octobre',
					'11' => 'Novembre',
					'12' => 'Décembre',
					);

	echo $this->Form->create();
	echo $this->Form->input('materiel_id', array('label' => 'Matériel concerné', 'value' => $materiel_id));
	echo $this->Form->input('date_controle', array('monthNames' => $months, 'dateFormat' => 'DMY', 'label' => 'Date du contrôle'));
	echo $this->Form->input('date_prochain_controle', array('monthNames' => $months, 'dateFormat' => 'DMY', 'label' => 'Date du prochain contrôle'));
	echo $this->Form->input('type_intervention', array('label' => 'Type d\'intervention'));
	echo $this->Form->input('organisme', array('label' => 'Organisme'));
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