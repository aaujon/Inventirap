<?php
class Materiel extends AppModel {
	public $name = 'Materiel';
	
	var $virtualFields = array(
		'full_storage' => 'CONCAT(lieu_stockage, "-", lieu_detail)');
	public $displayField = 'designation';
	
	public $belongsTo = array('SousCategory', 'ThematicGroup', 'WorkGroup');
	public $hasMany = array(
		'Suivi',
		'Emprunt');
			
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
		'organisme' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'fournisseur' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'prix_ht' => array(    
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

		'numero_commande' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'code_comptable' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),
		'numero_serie' => array(    
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

		'nom_responsable' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		),

		'email_responsable' => array(    
			'valid' => array(            
				'rule' => 'email',
				'allowEmpty' => true,              
				'message' => 'Merci de soumettre une adresse email valide.'        
			),      
		),
		'lieu_detail' => array(    
			'valid' => array(            
				'rule' => 'check_string',
				'allowEmpty' => true,              
				'message' => 'Le champ doit être valide.'        
			),      
		)
	);
}
?>
