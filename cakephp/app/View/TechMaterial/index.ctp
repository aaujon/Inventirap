<div class="movies index">
	<h2>Matériels techniques</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>Modèle</th>
			<th>Caractéristiques</th>
			<th>Status</th>
			<th class="actions">Actions</th>
		</tr>
	<?php foreach ($techMaterials as $techMat): ?>
	<tr>
		<td><?php echo $techMat['TechMaterial']['model']; ?></td>
		<td><?php echo $techMat['TechMaterial']['caracteristic']; ?></td>
		<td><?php echo ucfirst(strtolower($techMat['TechMaterial']['status'])); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('Détails', 	array('action' => 'view', $techMat['TechMaterial']['id'])); ?>
			<?php echo $this->Html->link('Editer', 		array('action' => 'edit', $techMat['TechMaterial']['id'])); ?>
			<?php echo $this->Html->link('Supprimer',	array('action' => 'delete', $techMat['TechMaterial']['id']), 
				null, sprintf('Êtes-vous sur de supprimer %s ?', $techMat['TechMaterial']['model'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Nouveau', array('action' => 'add')); ?></li>
	</ul>
</div>
