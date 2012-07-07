<h3><?php echo __d('cake', 'Menu'); ?></h3>
<ul>
	<li><?php echo $this->Html->link('Accueil', '/'); ?></li>
	<li><?php echo $this->Html->link('Liste des matériels', array(
	'controller' => 'materiels', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Liste des suivis', array(
	'controller' => 'suivis', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Liste des emprunts', array(
	'controller' => 'emprunts', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Liste des utilisateurs', array(
	'controller' => 'utilisateurs', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Recherche', array(
	'controller' => 'materiels', 'action' => 'search')); ?></li>
	<li><?php echo $this->Html->link('Outils', array(
	'controller' => 'pages', 'action' => 'tools')); ?></li>
</ul>