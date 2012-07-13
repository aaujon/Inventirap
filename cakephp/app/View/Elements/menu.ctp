<h3>Menu</h3>
<ul>
	<li><?php echo $this->Html->link('<i class="icon-home"></i> Accueil', '/', array('escape' => false)); ?></li>
	<li><?php echo $this->Html->link('<i class="icon-search"></i> Recherche/Liste', array(
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
	<li><?php echo $this->Html->link('<i class="icon-wrench"></i> Outils', array(
	'controller' => 'pages', 'action' => 'tools'),
	array('escape' => false)); ?></li>
</ul>
<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;">Recherche</h3>
<?php
	echo $this->Form->create('Materiel', array('action' => 'find'));
	echo $this->Form->hidden('s_designation');
    echo $this->Form->hidden('s_numero_irap'); 
    echo $this->Form->hidden('s_responsable'); 
    echo $this->Form->hidden('s_categorie_id'); 
    echo $this->Form->hidden('s_sous_categorie_id'); 
    echo $this->Form->hidden('s_status');  
    echo '<input name="data[Materiel][s_all]" style="width: 100%;" type="text" id="MaterielSAll">';
    echo $this->Form->end();
?>