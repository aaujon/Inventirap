<?php
class Material extends AppModel {
	public $name = 'Material';
	
	var $virtualFields = array(
		'full_storage' => 'CONCAT(storage_place, "-", storage_description)');
	public $displayField = 'designation';
	
	public $belongsTo = array('SubCategory', 'ThematicGroup', 'WorkGroup');
	public $hasMany = array(
		'History',
		'Loan');
	
	var $validate = array(
		'designation' => array(        
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
