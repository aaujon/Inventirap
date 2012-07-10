<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php 
		echo $this->Html->link('<i class="icon-arrow-left"></i> Retour à la liste', 
			array('action' => 'index'), 
			array('escape' => false)); 
	?></li>
	<li><?php 
		echo $this->Html->link('<i class="icon-pencil"></i> Éditer ce '.strtolower($singularHumanName), 
			array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), 
			array('escape' => false)); 
	?></li>
	<li><?php 
		echo $this->Form->postLink('<i class="icon-trash"></i> Suppr. ce '.strtolower($singularHumanName),
			array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
			array('escape' => false),
			'Êtes-vous sur de supprimer '.${$singularVar}[$modelClass][$primaryKey].' ?'); 
	?></li>
</ul>
