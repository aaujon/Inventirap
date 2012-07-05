<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Détail.Scaffolds
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 
function filter($field) {
	$whatToShow = array(
		'designation',
		'irap_number',
		'sub_category_id',
		'storage_place'
	);
	foreach($whatToShow as $value) {
		if ($value == $field)
			return true;
	}
	return false;
}
?>
<div class="<?php echo $pluralVar;?> index">
<h2>Liste des matériels</h2>
<table cellpadding="0" cellspacing="0">
<tr>
<?php foreach ($scaffoldFields as $_field): if (filter($_field)) { ?>
	<th><?php echo $this->Paginator->sort($_field);?></th>
<?php } endforeach;?>
	<th style="text-align: center;">Actions</th>
	<th style="text-align: center;">Status</th>
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
			__d('cake', 'Êtes-vous sur de supprimer').' '.${$singularVar}[$modelClass]['designation'].' ?'
		);
		echo '</td><td class="actions" style="text-align: right;">';
		if (${$singularVar}[$modelClass]['status'] == 'CREATED') {
			echo $this->Html->link(__d('cake', 'Valider'), array('action' => 'changeStatus', ${$singularVar}[$modelClass][$primaryKey], 'VALIDATED'));
			echo $this->Html->link(__d('cake', 'Archiver'), array('action' => 'changeStatus', ${$singularVar}[$modelClass][$primaryKey], 'ARCHIVED'));
		}
		if (${$singularVar}[$modelClass]['status'] == 'VALIDATED') {
			echo $this->Html->link(__d('cake', 'Archiver'), array('action' => 'changeStatus', ${$singularVar}[$modelClass][$primaryKey], 'ARCHIVED'));
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