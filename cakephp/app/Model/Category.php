<?php
class Category extends AppModel {
	public $name = 'Category';
	public $displayField = 'name';
	
	var $hasMany = 'SubCategory';

	var $validate = array(
		'name' => array(        
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
