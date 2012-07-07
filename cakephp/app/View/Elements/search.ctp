<?php  
	if (isset($results))
		$selected = array();
	else
		$selected = array('selected' => '');
		
    echo $this->Form->create('Materiel', array('action' => 'find')); 
    echo $this->Form->input('s_designation', array('label' => 'Designation'));
    echo $this->Form->input('s_category_id', 
    	array('empty' => 'Toutes', $selected, 'options' => $s_categories, 'label' => 'Catégorie', 'style' => 'width: 200px')); 
    echo $this->Form->input('s_sous_category_id', 
    	array('empty' => 'Toutes', $selected, 'options' => $s_sous_categories, 'label' => 'Sous catégorie', 'style' => 'width: 200px')); 
    echo $this->Form->input('s_numero_irap', array('label' => 'N° IRAP')); 
    echo $this->Form->end('Rechercher'); 
?>