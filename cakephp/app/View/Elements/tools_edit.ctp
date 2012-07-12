<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<?php
		$t = strtolower($singularHumanName);	
		$t = str_replace('groupes', 'groupe', $t);
		$t = str_replace('thematique', 'thémat.', $t);
		$t = str_replace('categorie', 'catégorie', $t);
	?>
	<li><?php 
		echo $this->Html->link('<i class="icon-arrow-left"></i> Retour à la liste', 
			array('action' => 'index'), 
			array('escape' => false)); 
	?></li>
	<li><?php
		$action = ''; 
		if(strstr($t, 'catégorie')) {
			$action = 'Édit. cette';
		} elseif(strstr($t, 'utilisateur')) {
			$action = 'Édit. cet';
		} else {
			$action = 'Édit. ce';
		}
		echo $this->Html->link('<i class="icon-pencil"></i>' . $action . ' ' . $t, 
			array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), 
			array('escape' => false));
	?></li>
	<li><?php 
		$action = ''; 
		if(strstr($t, 'catégorie')) {
			$action = 'Suppr. cette';
		} elseif(strstr($t, 'utilisateur')) {
			$action = 'Suppr. cet';
		} else {
			$action = 'Suppr. ce';
		}
		echo $this->Form->postLink('<i class="icon-trash"></i>' . $action . ' ' . $t,
			array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
			array('escape' => false),
			'Êtes-vous sur de supprimer '.${$singularVar}[$modelClass][$primaryKey].' ?'); 
	?></li>
</ul>
