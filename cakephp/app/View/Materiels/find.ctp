<div class="index">
	<h2>Recherche matériel</h2>
	
	<?php  
		include 'search.include.ctp'; 
	?> 
	
	<h2>Résultats</h2>
	<table> 
		<tr> 
			<th>Id</th><th>Designation</th>
		</tr> 
		
		<?php foreach ($results as $material): ?> 
		<tr> 
			<td><?php echo $material['Materiel']['id']; ?></td> 
			<td><?php echo $this->Html->link($material['Materiel']['designation'], array('action' => 'view', $material['Materiel']['id']));?></td>
		</tr> 
		<?php endforeach; ?> 
	</table> 
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>