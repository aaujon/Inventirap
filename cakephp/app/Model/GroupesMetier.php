<?php
class GroupesMetier extends AppModel {
	public $name = 'GroupesMetier';
	public $displayField = 'nom';

	var $hasMany = array('Materiel', 'Utilisateur');
	
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
