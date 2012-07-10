<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php 
		echo $this->Html->link('<i class="icon-arrow-left"></i> Retour à la liste', 
			array('action' => 'index'), 
			array('escape' => false)); 
	?></li>
</ul>
