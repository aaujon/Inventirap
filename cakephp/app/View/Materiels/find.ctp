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
		<table cellpadding="0" cellspacing="0"> 
			<tr> 
				<th>Désignation</th>
				<th>Numéro IRAP</th>
				<th>Catégorie</th>
				<th>Responsable</th>
				<th>Statut</th>
				<th style="width:20px;"></th>
				<th style="width:20px;"></th>
				<th style="width:20px;"></th>
			</tr> 
			
			<?php foreach ($results as $material): ?> 
			<tr> 
				<td class="smallText"><?php echo $material['Materiel']['designation']; ?></td> 
				<td class="smallText"><?php echo $material['Materiel']['numero_irap']; ?></td>
				<td class="smallText"><?php echo $this->Html->link($material['Categorie']['nom'], array('controller' => 'categories', 'action' => 'view', $material['Categorie']['id']));?></td>
				<td class="smallText"><?php echo $material['Materiel']['nom_responsable']; ?></td>
				<td class="smallText"><?php echo $material['Materiel']['status']; ?></td>
				<?php echo $this->element('materiel_actions', array('id' => $material['Materiel']['id'], 'statut' => $material['Materiel']['status'])); ?>
				
			</tr> 
			<?php endforeach; ?> 
		</table> 
		<?php } else { echo 'Aucun résultat.'; }?>
	</div>
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>