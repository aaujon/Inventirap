<?php
class SubCategory extends AppModel {
	public $name = 'SubCategory';
	public $displayField = 'name';

	var $belongsTo = 'Category';
	var $hasMany = 'Material';

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
