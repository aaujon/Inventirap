<h3 style="margin-top: 20px;"><?php echo $pluralHumanName;?></h3>
<ul>
	<li><?php 
		$t = strtolower($singularHumanName);
		
		$t = str_replace('groupes', 'groupe', $t);
		$t = str_replace('thematique', 'thématique', $t);
		$t = str_replace('metier', 'métier', $t);
		$t = str_replace('categorie', 'catégorie', $t);
		
		if(strlen($t) > 12) {
			$t = 'Nouv. '.$t;
		}
		else {
			if(strstr($t, 'catégorie')) {
				$t = 'Nouvelle ' . $t;
			} elseif(strstr($t, 'utilisateur') || strstr($t, 'emprunt')) {
				$t = 'Nouvel ' . $t;
			} else {
				$t = 'Nouveau ' . $t;
			}	
		}
			
		echo $this->Html->link('<i class="icon-plus"></i> '.$t, 
			array('action' => 'add'), 
			array('escape' => false)); 
	?></li>
</ul>
