<?php 
	echo $this->Html->script('script'); 
	$r = isset($results);
?>
<div class="index">
	<h2><i class="icon-search"></i> Recherche de matériel</h2>
	
	<h3 id="t_filter" style="cursor: pointer;">
		<i class=<?php if ($r) echo '"icon-chevron-up"'; echo '"icon-chevron-down"'; ?> style="font-size: 14px;" id="i_filter"></i> 
		<span style="text-decoration: underline;">Filtres</span>
	</h3>
	<div id="filter" <?php if ($r) echo 'style="display: none;"'; ?>><?php  
		if (isset($results))
			$selected = array();
		else
			$selected = array('selected' => '');
			
	    echo $this->Form->create('Materiel', array('action' => 'find')); 
	    echo $this->Form->input('s_designation', array('label' => 'Designation'));
	    echo $this->Form->input('s_numero_irap', array('label' => 'N° IRAP')); 
	    echo $this->Form->input('s_responsable', array('label' => 'Responsable')); 
	    echo $this->Form->input('s_ref_existante', array('label' => 'Référence existante')); 
	    echo $this->Form->input('s_categorie_id', 
	    	array('label' => 'Catégorie', 'empty' => 'Toutes', $selected, 'options' => $s_categories, 'style' => 'width: 200px')); 
	    echo $this->Form->input('s_sous_categorie_id', 
	    	array('label' => 'Sous catégorie', 'empty' => 'Toutes', $selected, 'options' => $s_sous_categories, 'style' => 'width: 200px')); 
	    echo $this->Form->input('s_status', array(
	    	'label' => 'Statut', 'empty' => 'Tous', $selected, 
	    	'options' => array('CREATED' => 'Créé', 'VALIDATED' => 'Validé', 'TOBEARCHIVED' => 'À archiver', 'ARCHIVED' => 'Archivé'), 
	    	'style' => 'width: 200px')); 
	    echo $this->Form->input('s_all', array('label' => 'Tous les champs'));
	    echo $this->Form->end('Rechercher'); 
	
		$this->Js->get('#MaterielSCategorieId')->event('change', 
			$this->Js->request(array('controller' => 'sousCategories', 'action'=>'getByCategorie'), 
				array(
					'update' => '#MaterielSSousCategorieId',
					'async' => true, 'method' => 'post', 'dataExpression' => true,
					'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
			)));
		echo $this->Js->writeBuffer();
	?></div>
		
	<h3 id="t_result" style="cursor: pointer;">
		<i class=<?php if ($r) echo '"icon-chevron-down"'; echo '"icon-chevron-up"'; ?> style="font-size: 14px;" id="i_result"></i> 
		<span style="text-decoration: underline;">Résultats <?php if ($r) echo '('.sizeof($results).')'; ?></span>
	</h3>
	<div id="result" <?php if (!$r) echo 'style="display: none;"'; ?>>
		<?php if (isset($results) && sizeof($results) != 0) { ?>
		<table cellpadding="0" cellspacing="0"> 
			<tr> 
				<th>Désignation</th>
				<th>Numéro IRAP</th>
				<th>Catégorie</th>
				<th>Responsable</th>
				<th>Statut</th>
				<th style="width:20px;"></th>
				<th style="width:20px;"></th>
				<th style="width:20px;"></th>
			</tr> 
			
			<?php foreach ($results as $material): 
			echo '<tr>';
			echo '<td class="smallText">'; 
				echo $this->Html->link($material['Materiel']['designation'], 
					array('action' => 'view', $material['Materiel']['id']), 
					array('title' => 'Détails'));
			echo '</td>'; 
			echo '<td class="smallText">';
				echo $material['Materiel']['numero_irap']; 
			echo '</td>';
			echo '<td class="smallText">'; 
				echo $this->Html->link($material['Categorie']['nom'], 
					array('controller' => 'categories', 'action' => 'view', $material['Categorie']['id']));
			echo '</td>';
			echo '<td class="smallText">';
				echo $material['Materiel']['nom_responsable']; 
			echo '</td>';
			echo '<td class="smallText">'; 
				echo $material['Materiel']['status']; 
			echo '</td>';
			echo $this->element('materiel_actions', array(
				'id' => $material['Materiel']['id'], 
				'statut' => $material['Materiel']['status'], 
				'delete' => ($material['Materiel']['status'] == 'CREATED')));	
			echo '<tr>';
			endforeach;
		echo '</table>';
		} else { 
			echo 'Aucun résultat.'; 
		} ?>
	</div>
</div>
<div class="actions">
	<?php echo $this->element('menu') ?>
</div>