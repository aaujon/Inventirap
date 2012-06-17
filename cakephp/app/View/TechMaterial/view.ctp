<div class="movies view">
<h2>Matériel technique</h2>
	<dl>
		<dt>Modèle</dt><dd><?php echo $techMat['TechMaterial']['model']; ?></dd>
		<dt>Caractéristique</dt><dd><?php echo $techMat['TechMaterial']['caracteristic']; ?></dd>
		<dt>Numéro de série</dt><dd><?php echo $techMat['TechMaterial']['serial_number']; ?></dd>
		<dt>Utilisateur</dt><dd><a href="mailto:<?php echo $techMat['TechMaterial']['mail_user']; ?>"><?php echo $techMat['TechMaterial']['name_user']; ?></a></dd>
		<dt>Status</dt><dd><?php echo ucfirst(strtolower($techMat['TechMaterial']['status'])); ?></dd>	</dl>
</div>


<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Éditer', array('action' => 'edit', $techMat['TechMaterial']['id'])); ?> </li>
		<li><?php echo $this->Html->link('Supprimer', array('action' => 'delete', $techMat['TechMaterial']['id']), null, 
			sprintf('Êtes-vous sur de supprimer %s ?', $techMat['TechMaterial']['model'])); ?> </li>
		<li><?php echo $this->Html->link('Liste', array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link('Nouveau', array('action' => 'add')); ?> </li>
	</ul>
</div>