<h2>Général</h2>
<table cellpadding="0" cellspacing="0">
	<tr><th>Actions</th></tr>
	<tr><td><?php echo $this->Html->link('Gérer les utilisateurs', array(
		'controller' => 'specialUsers')); ?></td></tr>
	
	<tr><td><?php echo $this->Html->link('Gérer les catégories', array(
		'controller' => 'categories')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Gérer les sous-catégories', array(
		'controller' => 'subCategories')); ?></td></tr>
</table>	

<h2>Matériel technique</h2>
<table cellpadding="0" cellspacing="0">
	<tr><th>Actions</th></tr>
	<tr><td><?php echo $this->Html->link('Voir la liste', array(
		'controller' => 'techMaterials')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts interne', array(
		'controller' => 'internalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts externe', array(
		'controller' => 'externalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir l\'historique', array(
		'controller' => 'techMaterialHistories')); ?></td></tr>
</table>

<h2>Matériel administratif</h2>
<table cellpadding="0" cellspacing="0">
	<tr><th>Actions</th></tr>
	<tr><td><?php echo $this->Html->link('Voir la liste', array(
		'controller' => 'admiMaterials')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts interne', array(
		'controller' => 'internalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts externe', array(
		'controller' => 'externalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir l\'historique', array(
		'controller' => 'admiMaterialHistories')); ?></td></tr>
</table>