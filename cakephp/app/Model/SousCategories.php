<?php
class SousCategories extends AppModel {
	
	public $name = 'SousCategorie';
	
	public $displayField = 'nom';

	var $belongsTo = 'Categorie';
	var $hasMany = 'Materiel';

	var $validate = array(
		'nom' => array(        
			'required' => array(            
				'rule' => 'notEmpty',              
				'message' => 'Le champ doit être rempli.'         
			),        
			'valid' => array(            
				'rule' => 'check_string',              
				'message' => 'Le champ doit être valide'        
			),      
		)
	);
}
?>
