<?php
$toShow = array(
	'materiel_id' => 'Matériel',
	'date_controle' => 'Date du contrôle',
	'date_prochain_controle' => 'Date prochain contrôle',
	'type_intervention' => 'Type d\'intervention'
);
?>
<div class="<?php echo $pluralVar;?> index">
<h2><i class="icon-list"></i> Liste des suivis</h2>
<table cellpadding="0" cellspacing="0">
<tr>
<?php foreach ($toShow as $_field => $label): ?>
	<th><?php echo $this->Paginator->sort($_field, $label);?></th>
<?php endforeach;?>
	<th style="width:90px;"></th>
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
						echo "<td class='smallText'>" . ${$singularVar}[$_alias][$_details['displayField']] . "</td>";
						break;
					}
				}
			}
			if ($isKey !== true) {
				if($_field == 'date_controle' || $_field == 'date_prochain_controle') {
					$date = new DateTime(${$singularVar}[$modelClass][$_field]);
					echo '<td class=\'smallText\'>' . $date->format('d M Y') . '</td>';
				} else {
					echo '<td class=\'smallText\'>' . h(${$singularVar}[$modelClass][$_field]) . '</td>';
				}
			}	
		}

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
