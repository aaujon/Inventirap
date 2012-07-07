<h3><?php echo __d('cake', 'Menu'); ?></h3>
<ul>
	<li><?php echo $this->Html->link('<i class="icon-home"></i> Accueil', '/', array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-search"></i> Recherche', array(
	'controller' => 'materiels', 'action' => 'find'),
	array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-list"></i> Liste des matériels',
	array('controller' => 'materiels', 'action' => 'index'),
	array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-list"></i> Liste des suivis',
	array('controller' => 'suivis', 'action' => 'index'),
	array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-list"></i> Liste des emprunts',
	array('controller' => 'emprunts', 'action' => 'index'),
	array('escape' => false)); ?></li>
	
	<?php
	    $ldapUserAuthenticationLevel = $this->Session->read('LdapUserAuthenticationLevel');
	    if ($ldapUserAuthenticationLevel == 4) {
			echo '<li>' . $this->Html->link('<i class="icon-list"></i> Liste des utilisateurs',
			array('controller' => 'utilisateurs', 'action' => 'index'),
			array('escape' => false)) . '</li>';
		}
	?>
	
	<li><?php echo $this->Html->link('<i class="icon-wrench"></i> Outils', array(
	'controller' => 'pages', 'action' => 'tools'),
	array('escape' => false)); ?></li>
</ul>