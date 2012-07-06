<div class="index">
<h2><i class="icon-wrench"></i> Outils</h2>
<table cellpadding="0" cellspacing="0">
	<tr><th>Actions</th></tr>
	<tr><td><?php echo $this->Html->link('Gérer les utilisateurs', array(
		'controller' => 'utilisateurs')); ?></td></tr>
	
	<tr><td><?php echo $this->Html->link('Gérer les catégories', array(
		'controller' => 'categories')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Gérer les sous-catégories', array(
		'controller' => 'sous_categories')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Gérer les groupes thématiques', array(
		'controller' => 'thematic_groups')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Gérer les groupes de travail', array(
		'controller' => 'work_groups')); ?></td></tr>
</table>	

</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>