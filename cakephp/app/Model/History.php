<?php
class History extends AppModel {
	public $name = 'History';
	
	public $belongsTo = 'Material';
			
	var $validate = array(
		'intervention_type' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,         
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'organism_informations' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'comments' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		
	);
}
?>
