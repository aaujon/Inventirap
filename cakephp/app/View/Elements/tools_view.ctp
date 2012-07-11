<h3 style="padding-top: 10px; margin-top: 20px; border-top: 1px solid #CCC;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php 
		$t = strtolower($singularHumanName);
		if(strlen($t) > 12) 
			$t = 'Nouv. '.$t;
		else
			$t = 'Nouveau '.$t;
			
		$t = str_replace('groupes', 'groupe', $t);
		$t = str_replace('thematique', 'themat.', $t);
		
		echo $this->Html->link('<i class="icon-plus"></i> '.$t, 
			array('action' => 'add'), 
			array('escape' => false)); 
	?></li>
</ul>
