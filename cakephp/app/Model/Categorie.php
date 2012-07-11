<?php
class Categorie extends AppModel {
	public $name = 'Categorie';
	public $displayField = 'nom';
	
	var $hasMany = 'SousCategorie';

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
