<?php
class Loan extends AppModel {
	public $name = 'Loan';
	
	public $belongsTo = array('Material');
	
			
	var $validate = array(
		'piece' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,         
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'responsible' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'laboratory' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		
	);
}
?>
