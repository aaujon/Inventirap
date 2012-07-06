<h3><?php echo __d('cake', 'Menu'); ?></h3>
<ul>
	<li><?php echo $this->Html->link('<i class="icon-home"></i> Accueil', '/', array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-list"></i> Liste des matériels', 
		array('controller' => 'materiels', 'action' => 'index'),
		array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-list"></i> Liste des suivis', 
		array('controller' => 'suivis', 'action' => 'index'),
		array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-list"></i> Liste des emprunts', 
		array('controller' => 'emprunts', 'action' => 'index'),
		array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-search"></i> Recherche', array(
	'controller' => 'materiels', 'action' => 'search'),
		array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-wrench"></i> Outils', array(
	'controller' => 'pages', 'action' => 'tools'),
		array('escape' => false)); ?></li>
</ul>