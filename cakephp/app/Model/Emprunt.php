<?php
class Emprunt extends AppModel {
	public $name = 'Emprunt';
	
	public $belongsTo = array('Materiel');
	
			
	var $validate = array(
		'piece' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,         
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'responsable' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'laboratoire' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		
	);
}
?>
