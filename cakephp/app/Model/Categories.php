<?php
class Categories extends AppModel {
	
	public $name = 'Categorie';
	
	var $hasMany = 'SousCategorie';
	
	public $displayField = 'nom';
	

	var $validate = array(
		'nom' => array(        
			'required' => array(            
				'rule' => 'notEmpty',              
				'message' => 'Le champ doit être rempli.'         
			),        
			'valid' => array(            
				'rule' => 'check_string',              
				'message' => 'Le champ doit être valide.'        
			),      
		)
	);
}
?>
