<?php 
	echo $this->Html->script('script'); 
	$r = isset($results);
?>
<div class="index">
	<h2><i class="icon-search"></i> Recherche de matériel</h2>
	
	<h3 id="t_filter" style="cursor: pointer;">
		<i class=<?php if ($r) echo '"icon-chevron-up"'; echo '"icon-chevron-down"'; ?> style="font-size: 14px;" id="i_filter"></i> 
		<span style="text-decoration: underline;">Filtres</span>
	</h3>
	<div id="filter" <?php if ($r) echo 'style="display: none;"'; ?>>
		<?php echo $this->element('search'); ?>
	</div>
		
	<h3 id="t_result" style="cursor: pointer;">
		<i class=<?php if ($r) echo '"icon-chevron-down"'; echo '"icon-chevron-up"'; ?> style="font-size: 14px;" id="i_result"></i> 
		<span style="text-decoration: underline;">Résultats <?php if ($r) echo '('.sizeof($results).')'; ?></span>
	</h3>
	<div id="result" <?php if (!$r) echo 'style="display: none;"'; ?>>
		<?php if (isset($results) && sizeof($results) != 0) { ?>
		<table> 
			<tr> 
				<th>Désignation</th>
				<th>Numéro IRAP</th>
				<th>Catégorie</th>
				<th>Statut</th>
				<th>Responsable</th>
				<th style="width:50px;">Détail</th>
			</tr> 
			
			<?php foreach ($results as $material): ?> 
			<tr> 
				<td><?php echo $material['Materiel']['designation']; ?></td> 
				<td><?php echo $material['Materiel']['numero_irap']; ?></td>
				<td><?php echo $this->Html->link($material['Category']['nom'], array('controller' => 'categories', 'action' => 'view', $material['Category']['id']));?></td>
				<td><?php echo $material['Materiel']['status']; ?></td>
				<td><?php echo $material['Utilisateur']['ldap']; ?></td>
				<td class="actions"><?php 
					echo $this->Html->link('<i class="icon-search"></i>', 
						array('controller' => 'materiels', 'action' => 'view', $material['Materiel']['id']), 
						array('escape' => false, 'style' => 'margin:0')); ?>
				</td>
			</tr> 
			<?php endforeach; ?> 
		</table> 
		<?php } else { echo 'Aucun résultat.'; }?>
	</div>
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>