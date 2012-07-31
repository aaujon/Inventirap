<?php
class Categorie extends AppModel {
	public $name = 'Categorie';
	public $displayField = 'nom';
	
	var $hasMany = array('SousCategorie' => array('foreignKey' => 'categorie_id'));

	function categoryNameIsUnik($name) {
		
		$categories = $this->find('all', array('conditions' => 
					array('Categorie.nom' => $name)));
		
		return empty($categories);
	}
	
	var $validate = array(
		'nom' => array(        
			'required' => array(            
				'rule' => 'categoryNameIsUnik',              
				'message' => 'Le nom de la categorie est déjà enregistré.'         
			),        
			'valid' => array(            
				'rule' => 'check_string',              
				'message' => 'Le champ doit être valide.'        
			),      
		)
	);
}
?>
