<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php echo $this->Html->link(__d('cake', 'Nouveau %s', strtolower($singularHumanName)), array('action' => 'add')); ?></li>
</ul>
