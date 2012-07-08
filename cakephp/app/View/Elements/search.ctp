<?php  
	if (isset($results))
		$selected = array();
	else
		$selected = array('selected' => '');
		
    echo $this->Form->create('Materiel', array('action' => 'find')); 
    echo $this->Form->input('s_designation', array('label' => 'Designation'));
    echo $this->Form->input('s_numero_irap', array('label' => 'N° IRAP')); 
    echo $this->Form->input('s_category_id', 
    	array('label' => 'Catégorie', 'empty' => 'Toutes', $selected, 'options' => $s_categories, 'style' => 'width: 200px')); 
    echo $this->Form->input('s_sous_category_id', 
    	array('label' => 'Sous catégorie', 'empty' => 'Toutes', $selected, 'options' => $s_sous_categories, 'style' => 'width: 200px')); 
    echo $this->Form->input('s_nom_responsable', 
    	array('label' => 'Utilisateur responsable', 'empty' => 'Tous', $selected, 'options' => $s_nom_responsable, 'style' => 'width: 200px')); 
    echo $this->Form->input('s_status', array(
    	'label' => 'Statut', 'empty' => 'Tous', $selected, 
    	'options' => array('CREATED' => 'Créé', 'VALIDATED' => 'Validé', 'TOBEARCHIVED' => 'À archiver', 'ARCHIVED' => 'Archivé'), 
    	'style' => 'width: 200px')); 
    echo $this->Form->input('s_all', array('label' => 'Tous les champs'));
    echo $this->Form->end('Rechercher'); 
?>