<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter '.strtolower($singularHumanName).'</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer '.strtolower($singularHumanName).'</h2>';

	echo $this->Form->create();
	echo $this->Form->inputs('', array('created', 'modified', 'updated'));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_form');
	?>
</div>