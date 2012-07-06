<?php
/**
 * Scaffold pour les vues par defaut
 */
?>
<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2>Ajouter '.strtolower($singularHumanName).'</h2>';
	else 
		echo '<h2>Éditer '.strtolower($singularHumanName).'</h2>';

	echo $this->Form->create();
	echo $this->Form->inputs('', array('created', 'modified', 'updated'));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('tools_form');
	?>
</div>