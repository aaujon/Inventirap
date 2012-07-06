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
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'description' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'organism' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'supplier_name' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'price_ht' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'eotp' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'command_number' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'accountable_code' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'serial_number' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'ref_existante' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'user_name' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'user_mail' => array(    
			'valid' => array(            
				'rule' => 'email',
				'allowEmpty' => true,              
				'message' => 'Merci de soumettre une adresse email valide.'        
			),      
		),
		'storage_description' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		)
	);
}
?>
