<?php
	echo $this->Html->script('script'); 
	$userAuth = $this->Session->read('LdapUserAuthenticationLevel');
	if (isset($this->params['named']['what']) && (
		$this->params['named']['what'] == 'toValidate' || 
		$this->params['named']['what'] == 'toBeArchived'))
			$what = $this->params['named']['what'];
	$toShow = array(
		'designation' => 'Désignation',
		'numero_irap' => 'Numéro IRAP',
		'categorie_id' => 'Catégorie',
		'nom_responsable' => 'Responsable',
		'status' => 'Statut'
	);
?>
<div class="index">
<?php
	echo '<h2><i class="icon-list"></i> Liste des matériels</h2>';
	echo '<div class="actions" style="margin-bottom: 20px; width: 100%; float: none; padding: 10px 0;">';
	if ($userAuth == 3) {
		//Affichage d'actions pour les administrateurs
		$b_all = $b_val = $b_arc = '';
		if (isset($what)) {
			if ($what == 'toValidate')
				$b_val = '<i class="icon-ok"></i>';
			else if ($what == 'toBeArchived')
				$b_arc = '<i class="icon-ok"></i>';
		}
		else {
			$b_all = '<i class="icon-ok"></i>';
		}
		echo $this->Html->link($b_all.' Tous', array('action' => 'index'), 
				array('title' => 'Tous', 'style' => 'margin-right: 5px', 'escape' => false));
		echo $this->Html->link($b_val.' À valider', array('action' => 'index', 'what' => 'toValidate'), 
				array('title' => 'À valider', 'style' => 'margin-right: 5px', 'escape' => false));
		echo $this->Html->link($b_arc.' À sortir', array('action' => 'index', 'what' => 'toBeArchived'), 
				array('title' => 'À sortir de l\'inventaire', 'style' => 'margin-right: 30px', 'escape' => false));
				
		if (isset($what) && sizeof($data) != 0) {
			echo $this->Html->link('<i class="icon-check"></i> Tout sélectionner', '#all', array('onclick' => 'selectAll()', 
				'title' => 'Sélectionner tous les matériels', 'style' => 'margin-right: 5px', 'escape' => false));
			echo $this->Html->link('<i class="icon-check-empty"></i> Tout décocher', '#none', array('onclick' => 'selectNone()', 
				'title' => 'Sélectionner aucun matériel', 'style' => 'margin-right: 50px', 'escape' => false));
		
		}
	}
	echo '</div>';
	
	if (sizeof($data) != 0) {
		echo $this->Form->create('materiels', array('action' => 'jackpot'));
		if (isset($what) && $userAuth == 3)
			echo $this->Form->hidden('what', array('value' => $what));
		echo '<table cellpadding="0" cellspacing="0">';
		echo '<tr>';
		if (isset($what) && $userAuth == 3)
			echo '<th></th>';
		//Nom des colonnes
		foreach ($toShow as $_field => $label):
			echo '<th>'.$this->Paginator->sort($_field, $label).'</th>';
		endforeach;
		echo '<th style="width:20px;"></th><th style="width:20px;"></th><th style="width:20px;"></th>';
		echo '</tr>';
		
		//Remplissage des colonnes
		foreach ($data as $result):
			$id = 		$result['Materiel']['id'];
			$statut = 	$result['Materiel']['status'];
			echo '<tr>';
			if (isset($what) && $userAuth == 3)
				echo '<td class="smallText">'.$this->Form->checkbox($id, array('style' => 'margin: 3px')).'</td>';
			echo '<td class="smallText">'.$this->Html->link($result['Materiel']['designation'], 
				array('action' => 'view', $id)).'</td>';
			echo '<td class="smallText">'.$result['Materiel']['numero_irap'].'</td>';
			echo '<td class="smallText">'.$result['Categorie']['nom'].'</td>';
			echo '<td class="smallText">'.$result['Materiel']['nom_responsable'].'</td>';
			echo '<td class="smallText">'.$statut.'</td>';
			echo $this->element('materiel_actions', array(
				'id' => $id, 
				'nom' => $result['Materiel']['designation'], 
				'statut' => $statut, 
				'delete' => ($statut == 'CREATED')));
			echo '</tr>';
		endforeach;
		echo '</table>';
		
		//Validation/Archivage par groupe
		if (isset($what) && $userAuth == 3) {
			if ($this->params['named']['what'] == 'toValidate')
				echo $this->Form->submit('Valider les matériels cochés', array('style' => 'margin: 0px'));
			else 
				echo $this->Form->submit('Sortir les matériels cochés', array('style' => 'margin: 0px'));
		}
		
		//Gestion des pages
		echo '<div class="paging" style="color: black;">';
		echo $this->Paginator->counter(array('format' => 'Page {:page} sur {:pages}  '));
		echo $this->Paginator->first('<<', array('class' => 'prev')).' ';
		echo $this->Paginator->prev('< ' . __d('cake', ''), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__d('cake', '') .' >', array(), null, array('class' => 'next disabled'));
		echo ' '.$this->Paginator->last('>>', array('class' => 'next', 'style' => 'border-left: 1px solid #CCC'));
		echo '</div>';
		echo $this->Form->end();
	}
	else {
		echo 'Aucun matériel.';
	}	
?>
</div>
<div class="actions">
	<?php 
		echo $this->element('menu');
		echo $this->element('menu_index', array(
			'pluralHumanName' => 'Matériels', 'singularHumanName' => 'matériel'));
	?>
</div>
