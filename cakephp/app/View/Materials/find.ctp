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
		<td><?php echo $material['Material']['id']; ?></td> 
		<td><?php echo $this->Html->link($material['Material']['designation'],'/materials/view/'.$material['Material']['id']);?></td>
	</tr> 
	<?php endforeach; ?> 
</table> 