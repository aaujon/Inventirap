<h3 style="margin-top: 20px;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php
	
		echo $this->Html->link('<i class="icon-arrow-left"></i> Retour à la liste', 
			array('action' => 'index'), 
			array('escape' => false)); 
	?></li>
</ul>
