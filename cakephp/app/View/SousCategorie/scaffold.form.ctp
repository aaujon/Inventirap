<div class="<?php echo $pluralVar;?> form">
<?php
	if ($this->params['action'] == 'add')
		echo '<h2><i class="icon-plus"></i> Ajouter une sous catégorie</h2>';
	else 
		echo '<h2><i class="icon-edit"></i> Éditer une sous catégorie</h2>';

	echo $this->Form->create();
	echo $this->Form->input('nom', array('label' => 'Nom'));
	echo $this->Form->input('categorie_id', array(
		'label' => 'Catégorie',
		'options' => ClassRegistry::init('Categorie')->find('list', array('order' => array('Categorie.nom')))));
	echo $this->Form->end(__d('cake', 'Valider'));
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_form');
	?>
</div>
