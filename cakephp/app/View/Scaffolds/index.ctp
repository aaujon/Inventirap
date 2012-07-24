<?php
function filter($field) {
	$notToShow = array('id');
	foreach($notToShow as $value) {
		if ($value == $field)
			return false;
	}
	return true;
}
?>
<div class="<?php echo $pluralVar;?> index">
<h2><i class="icon-list"></i> Liste des <?php echo strtolower($pluralHumanName);?></h2>
<table cellpadding="0" cellspacing="0">
<tr>
<?php foreach ($scaffoldFields as $_field): if (filter($_field)) { ?>
	<th><?php echo $this->Paginator->sort($_field);?></th>
<?php } endforeach;?>
	<th style="width:90px;"></th>
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
						echo "<td class='smallText'>" . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . "</td>";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "<td class='smallText'>" . h(${$singularVar}[$modelClass][$_field]) . "</td>";
			}
		}}
		$supp = ${$singularVar}[$modelClass]['id'];
		if (isset(${$singularVar}[$modelClass]['nom']))
			$supp = ${$singularVar}[$modelClass]['nom'];

		echo '<td class="actions">';
		echo $this->Html->link('<i class="icon-eye-open"></i>', 
			array('action' => 'view', ${$singularVar}[$modelClass][$primaryKey]), array('style' => 'margin: 0 2px', 'escape' => false));
		echo $this->Html->link('<i class="icon-pencil"></i>', 
			array('action' => 'edit', ${$singularVar}[$modelClass][$primaryKey]), array('style' => 'margin: 0 2px', 'escape' => false));
		echo $this->Form->postLink('<i class="icon-trash"></i>',
			array('action' => 'delete', ${$singularVar}[$modelClass][$primaryKey]),
			array('style' => 'margin: 0 2px', 'escape' => false),
			__d('cake', 'Êtes-vous sur de supprimer').' '.$supp.' ?'
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
		echo $this->Paginator->first('<<', array('class' => 'prev')).' ';
		echo $this->Paginator->prev('< ' . __d('cake', ''), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__d('cake', '') .' >', array(), null, array('class' => 'next disabled'));
		echo ' '.$this->Paginator->last('>>', array('class' => 'next', 'style' => 'border-left: 1px solid #CCC'));
	?>
	</div>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_index');
	?>
</div>
