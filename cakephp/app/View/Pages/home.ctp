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

<h2>Matériel</h2>
<table cellpadding="0" cellspacing="0">
	<tr><th>Actions</th></tr>
	<tr><td><?php echo $this->Html->link('Voir la liste', array(
		'controller' => 'materials')); ?></td></tr>
		<tr><td><?php echo $this->Html->link('Recherche', array(
		'controller' => 'materials', 'action' => 'search')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir les emprunts', array(
		'controller' => 'loans')); ?></td></tr>
	<tr><td><?php echo $this->Html->link('Voir l\'historique', array(
		'controller' => 'histories')); ?></td></tr>
</table>
