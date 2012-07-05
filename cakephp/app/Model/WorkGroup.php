<?php
class WorkGroup extends AppModel {
	public $name = 'WorkGroup';
	public $displayField = 'name';

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
