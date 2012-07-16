<?php
$toShow = array(
	'nom' => 'Nom',
	'role' => 'Rôle',
	'groupes_travail_id' => 'Groupe de travail'
);
?>
<div class="<?php echo $pluralVar;?> index">
<h2><i class="icon-list"></i> Liste des utilisateurs</h2>
<table cellpadding="0" cellspacing="0">
<tr>
<?php foreach ($toShow as $_field => $label): ?>
	<th><?php echo $this->Paginator->sort($_field, $label);?></th>
<?php endforeach;?>
	<th style="width:90px;"></th>
</tr>
<?php
foreach (${$pluralVar} as ${$singularVar}):
	echo '<tr>';
	echo '<td class="smallText">'.${$singularVar}[$modelClass]['nom'].'</td>';
	echo '<td class="smallText">'.${$singularVar}[$modelClass]['role'].'</td>';
	echo '<td class="smallText">'.${$singularVar}['GroupesTravail']['nom'].'</td>';

	echo '<td class="actions">';
	echo $this->Html->link('<i class="icon-eye-open"></i>', 
		array('action' => 'view', ${$singularVar}[$modelClass][$primaryKey]), array('style' => 'margin: 0 2px', 'escape' => false));
	echo $this->Html->link('<i class="icon-pencil"></i>', 
		array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), array('style' => 'margin: 0 2px', 'escape' => false));
	echo $this->Form->postLink('<i class="icon-trash"></i>',
		array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
		array('style' => 'margin: 0 2px', 'escape' => false),
		__d('cake', 'Êtes-vous sur de supprimer').' '.${$singularVar}[$modelClass]['id'].' ?'
	);
	echo '</td>';
	echo '</tr>';
endforeach;

?>
</table>
	<p><?php
	echo $this->Paginator->counter(array(
		'format' => __d('cake', 'Page {:page} sur {:pages}')
	));
	?></p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __d('cake', ''), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__d('cake', '') .' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_index');
	?>
</div>