<div class="index">
	<h2><i class="icon-wrench"></i> Outils</h2>
	<table cellpadding="0" cellspacing="0">
		<tr><th></th></tr>
		<?php if ($this->Session->read('LdapUserAuthenticationLevel') == 4) { ?>
		<tr><td><?php echo $this->Html->link('Gérer les utilisateurs', array(
			'controller' => 'utilisateurs', 'sort' => 'nom')); ?></td></tr><?php } ?>
		<tr><td><?php echo $this->Html->link('Gérer les catégories', array(
			'controller' => 'categories', 'sort' => 'nom')); ?></td></tr>
		<tr><td><?php echo $this->Html->link('Gérer les sous-catégories', array(
			'controller' => 'sous_categories', 'sort' => 'nom')); ?></td></tr>
		<tr><td><?php echo $this->Html->link('Gérer les groupes thématiques', array(
			'controller' => 'groupes_thematiques', 'sort' => 'nom')); ?></td></tr>
		<tr><td><?php echo $this->Html->link('Gérer les groupes métiers', array(
			'controller' => 'groupes_metiers', 'sort' => 'nom')); ?></td></tr>
		<tr><td><?php echo $this->Html->link('Exporter la base de donnée (.csv)', array(
			'controller' => 'materiels', 'action' => 'export')); ?></td></tr>
	</table>	
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>