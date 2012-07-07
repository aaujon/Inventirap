<?php 
	echo $this->Html->script('script'); 
	$r = isset($results);
?>
<div class="index">
	<h2><i class="icon-search"></i> Recherche de matériel</h2>
	
	<h3 id="t_filter">
		<i class=<?php if ($r) echo '"icon-chevron-up"'; echo '"icon-chevron-down"'; ?> style="font-size: 14px;" id="i_filter"></i> 
		<span style="cursor: pointer; text-decoration: underline;">Filtres</span>
	</h3>
	<div id="filter" <?php if ($r) echo 'style="display: none;"'; ?>>
		<?php echo $this->element('search'); ?>
	</div>
		
	<h3 id="t_result">
		<i class=<?php if ($r) echo '"icon-chevron-down"'; echo '"icon-chevron-up"'; ?> style="font-size: 14px;" id="i_result"></i> 
		<span style="cursor: pointer; text-decoration: underline;">Résultats</span>
	</h3>
	<div id="result" <?php if (!$r) echo 'style="display: none;"'; ?>>
		<?php if (isset($results)) { ?>
		<table> 
			<tr> 
				<th>Désignation</th><th>Numéro IRAP</th><th>Catégorie</th><th>Action</th><th>Statut</th>
			</tr> 
			
			<?php foreach ($results as $material): ?> 
			<tr> 
				<td><?php echo $material['Materiel']['designation']; ?></td> 
				<td><?php echo $material['Materiel']['numero_irap']; ?></td>
				<td><?php echo $this->Html->link($material['Category']['nom'], array('controller' => 'categories', 'action' => 'view', $material['Category']['id']));?></td>
				<td></td>
				<td></td>
			</tr> 
			<?php endforeach; ?> 
		</table> 
		<?php } else { echo 'Aucun résultat.'; }?>
	</div>
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>