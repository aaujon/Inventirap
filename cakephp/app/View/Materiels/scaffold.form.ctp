<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter un '.strtolower($singularHumanName).'</h2>';
	else 
		echo '<h2>Éditer un '.strtolower($singularHumanName).'</h2>';
	
	echo $this->Form->create();
	echo $this->Form->inputs('', array('created', 'modified', 'updated', 'status', 'storage_place', 'storage_description', 'irap_number'));
	echo $this->Form->input('storage_place', array('options' => array(
		'B'=>'Belin', 'R'=>'Roche', 'T'=>'Tarbes', 'C'=>'CNES', 'A'=>'Autre')));
	echo $this->Form->input('storage_description');
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>