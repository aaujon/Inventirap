<?php
class Suivi extends AppModel {
	public $name = 'Suivi';
	
	public $belongsTo = 'Materiel';
			
	var $validate = array(
		'type_intervention' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,         
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'organisme' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'commentaire' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		
	);
}
?>
