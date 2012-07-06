<?php
class WorkGroup extends AppModel {
	public $name = 'WorkGroup';
	public $displayField = 'nom';

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
