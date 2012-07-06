<?php
class Category extends AppModel {
	public $name = 'Category';
	public $displayField = 'nom';
	
	var $hasMany = 'SousCategory';

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
