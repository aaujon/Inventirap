<h3><?php echo __d('cake', 'Menu'); ?></h3>
<ul>
	<li><?php echo $this->Html->link('Accueil', '/'); ?></li>
	<li><?php echo $this->Html->link('Liste des matériels', array(
	'controller' => 'materials')); ?></li>
	<li><?php echo $this->Html->link('Liste des suivis', array(
	'controller' => 'histories')); ?></li>
	<li><?php echo $this->Html->link('Liste des emprunts', array(
	'controller' => 'loans')); ?></li>
	<li><?php echo $this->Html->link('Recherche', array(
	'controller' => 'materials', 'action' => 'search')); ?></li>
	<li><?php echo $this->Html->link('Outils', array(
	'controller' => 'pages', 'action' => 'tools')); ?></li>
</ul>