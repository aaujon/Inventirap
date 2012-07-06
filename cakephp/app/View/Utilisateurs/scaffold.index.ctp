<?php
 
function filter($field) {
	$whatToShow = array(
		'ldap',
		'role'
	);
	foreach($whatToShow as $value) {
		if ($value == $field)
			return true;
	}
	return false;
}
?>
<div class="<?php echo $pluralVar;?> index">
<h2>Liste des utilisateurs</h2>
<table cellpadding="0" cellspacing="0">
<tr>
<?php foreach ($scaffoldFields as $_field): if (filter($_field)) { ?>
	<th><?php echo $this->Paginator->sort($_field);?></th>
<?php } endforeach;?>
	<th style="text-align: center;">Actions</th>
</tr>
<?php
$i = 0;
foreach (${$pluralVar} as ${$singularVar}):
	echo "<tr>";
			foreach ($scaffoldFields as $_field) { if (filter($_field)) {
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
		}}
		

		echo '<td class="actions">';
		echo $this->Html->link(__d('cake', 'Détail'), array('action' => 'view', ${$singularVar}[$modelClass][$primaryKey]));
		echo $this->Html->link(__d('cake', 'Éditer'), array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]));
		echo $this->Form->postLink(
			__d('cake', 'Suppr.'),
			array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
			null,
			__d('cake', 'Êtes-vous sur de supprimer').' '.${$singularVar}[$modelClass]['ldap'].' ?'
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
		echo $this->element('tools_view');
	?>
</div>