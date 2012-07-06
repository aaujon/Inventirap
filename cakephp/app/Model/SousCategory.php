<?php
class SousCategory extends AppModel {
	public $name = 'SousCategory';
	public $displayField = 'nom';

	var $belongsTo = 'Category';
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
