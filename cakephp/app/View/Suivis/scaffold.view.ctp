<div class="<?php echo $pluralVar;?> view">
<h2><?php echo __d('cake', 'Détail %s', strtolower($singularHumanName)); ?></h2>
	<table style="margin-bottom: 30px;">
		<tr><th style="width: 250px;"></th><th></th></tr>
		<?php
		$i = 0;
		foreach ($scaffoldFields as $_field) { if ($_field != 'id' && $_field != 'frequence') {
			$isKey = false;
			if (!empty($associations['belongsTo'])) {
				foreach ($associations['belongsTo'] as $_alias => $_details) {
					if ($_field === $_details['foreignKey']) {
						$isKey = true;
						echo "\t\t<tr><td><strong>" . Inflector::humanize($_alias) . "</strong></td>\n";
						echo "\t\t<td>\n\t\t\t" . $this->Html->link(${$singularVar}[$_alias][$_details['displayField']], array('controller' => $_details['controller'], 'action' => 'view', ${$singularVar}[$_alias][$_details['primaryKey']])) . "\n\t\t&nbsp;</td></tr>\n";
						break;
					}
				}
			}
			if ($isKey !== true) {
				echo "\t\t<tr><td><strong>" . Inflector::humanize($_field) . "</strong></td>\n";
				
				if($_field == 'date_controle' || $_field == 'date_prochain_controle') {
					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					echo "\t\t<td>" . strftime("%e %B %Y", strtotime(${$singularVar}[$modelClass][$_field])) . "&nbsp;</td></tr>\n";
				} else {
					echo "\t\t<td>" . h(${$singularVar}[$modelClass][$_field]) . "&nbsp;</td></tr>\n";
				}
			}
		}}
		?>
	</table>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_view');
	?>
</div>
