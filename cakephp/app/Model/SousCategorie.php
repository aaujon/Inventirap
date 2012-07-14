<?php
class SousCategorie extends AppModel {
	public $name = 'SousCategorie';
	public $displayField = 'nom';

	var $belongsTo = 'Categorie';
	var $hasMany = array('Materiel' => array('foreignKey' => 'sous_categorie_id'));

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
