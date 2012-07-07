<?php
$toShow = array(
	'designation' => 'Désignation',
	'numero_irap' => 'Numéro IRAP',
	'category_id' => 'Catégorie'
);
?>
<div class="<?php echo $pluralVar;?> index">
<h2><i class="icon-list"></i> Liste des matériels</h2>
<table cellpadding="0" cellspacing="0">
<tr>
<?php foreach ($toShow as $_field => $label): ?>
	<th><?php echo $this->Paginator->sort($_field, $label);?></th>
<?php endforeach;?>
	<th style="text-align: center;">Actions</th>
	<th style="text-align: center;">Status</th>
</tr>
<?php
$i = 0;
foreach (${$pluralVar} as ${$singularVar}):
	echo "<tr>";
			foreach ($toShow as $_field => $label) { 
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $_alias => $_details) {
					if ($_field === $_details['foreignKey']) {
						$isKey = true;
						echo "<td>" . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . "</td>";
						break;
					}
				}
			}
			if ($isKey !== true) {
				if ($_field == 'storage_place')
					echo "<td>" . h(${$singularVar}[$modelClass]['full_storage']) . "</td>";
				else	
					echo "<td>" . h(${$singularVar}[$modelClass][$_field]) . "</td>";
			}	
		}
		

		echo '<td class="actions">';
		echo $this->Html->link('<i class="icon-search"></i>', 
			array('action' => 'view', ${$singularVar}[$modelClass][$primaryKey]), array('title' => 'Détails', 'style' => 'margin: 0 2px', 'escape' => false));
		echo $this->Html->link('<i class="icon-pencil"></i>', 
			array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), array('title' => 'Éditer', 'style' => 'margin: 0 2px', 'escape' => false));
		echo $this->Form->postLink('<i class="icon-trash"></i>',
			array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
			array('title' => 'Supprimer', 'style' => 'margin: 0 2px', 'escape' => false),
			__d('cake', 'Êtes-vous sur de supprimer').' '.${$singularVar}[$modelClass]['designation'].' ?'
		);
		echo '</td><td class="actions" style="text-align: right;">';
		if (${$singularVar}[$modelClass]['status'] == 'CREATED') {
			// echo $this->Html->link(__d('cake', 'Valider'), array('action' => 'statusValidated', ${$singularVar}[$modelClass][$primaryKey]));
			// echo $this->Html->link(__d('cake', 'Archiver'), array('action' => 'statusArchived', ${$singularVar}[$modelClass][$primaryKey]));
			echo $this->Html->link('Valider', array('controller' => 'Materiels', 'action' => 'statusValidated', ${$singularVar}[$modelClass][$primaryKey]));
			echo $this->Html->link('Archiver', array('controller' => 'Materiels', 'action' => 'statusArchived', ${$singularVar}[$modelClass][$primaryKey]));
		}
		if (${$singularVar}[$modelClass]['status'] == 'VALIDATED') {
			// echo $this->Html->link('Archiver', array('action' => 'statusArchived', ${$singularVar}[$modelClass][$primaryKey]));
			echo $this->Html->link('Archiver', array('controller' => 'Materiels', 'action' => 'statusArchived', ${$singularVar}[$modelClass][$primaryKey]));
		}
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
		echo $this->element('tools_view');
	?>
</div>
