<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php 
		echo $this->Html->link('<i class="icon-plus"></i> Nouveau '.strtolower($singularHumanName), 
			array('action' => 'add'), array('escape' => false)); 
	?></li>
</ul>
