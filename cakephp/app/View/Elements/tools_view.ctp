<h3><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php echo $this->Html->link(__d('cake', 'Nouveau %s', $singularHumanName), array('action' => 'add')); ?></li>
</ul>
