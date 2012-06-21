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
		'controller' => 'technicalMaterials')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts interne', array(
		'controller' => 'technicalMaterialInternalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts externe', array(
		'controller' => 'technicalMaterialExternalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir l\'historique', array(
		'controller' => 'technicalMaterialHistories')); ?></td></tr>
</table>

<h2>Matériel administratif</h2>
<table cellpadding="0" cellspacing="0">
	<tr><th>Actions</th></tr>
	<tr><td><?php echo $this->Html->link('Voir la liste', array(
		'controller' => 'administrativeMaterials')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts interne', array(
		'controller' => 'administrativeMaterialInternalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts externe', array(
		'controller' => 'administrativeMaterialExternalLoans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir l\'historique', array(
		'controller' => 'administrativeMaterialHistories')); ?></td></tr>
</table>