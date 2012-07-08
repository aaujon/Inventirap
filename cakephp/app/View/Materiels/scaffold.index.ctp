<?php
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');

	$toShow = array(
		'designation' => 'Désignation',
		'numero_irap' => 'Numéro IRAP',
		'category_id' => 'Catégorie',
		'nom_responsable' => 'Responsable',
		'status' => 'Statut'
	);
?>
<div class="<?php echo $pluralVar;?> index">
<h2><i class="icon-list"></i> Liste des matériels</h2>
<table cellpadding="0" cellspacing="0">
<tr>
	<?php foreach ($toShow as $_field => $label): ?>
	<th><?php echo $this->Paginator->sort($_field, $label); ?></th>
	<?php endforeach;?>
	<th style="width:20px;"></th>
	<th style="width:20px;"></th>
	<th style="width:20px;"></th>
</tr>
<?php
$i = 0;
foreach (${$pluralVar} as ${$singularVar}):
	$id = 		${$singularVar}[$modelClass]['id'];
	$statut = 	${$singularVar}[$modelClass]['status'];
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
	echo $this->element('materiel_actions', array('id' => $id, 'statut' => $statut));
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
