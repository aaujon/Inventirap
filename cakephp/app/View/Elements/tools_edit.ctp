<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php echo $this->Html->link('Retour à la liste', array('action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Éditer ce '.$singularHumanName, array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey])); ?></li>
	<li><?php echo $this->Form->postLink(
			__d('cake', 'Suppr. ce '.$singularHumanName),
			array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
			null,
			__d('cake', 'Êtes-vous sur de supprimer').' '.${$singularVar}[$modelClass][$primaryKey].' ?'
		); ?></li>
</ul>
